<?php

namespace App\Http\Controllers;

use App\Mail\OrderShipped;
use App\Models\Carmi;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Yansongda\Pay\Pay;

class WebhookController extends Controller
{
    public function alipay(Request $request)
    {
        Log::info('Alipay Webhook Received', $request->all());

        $alipay = Pay::alipay();

        try {
            $data = $alipay->callback($request->all());

            $order = Order::where('order_sn', $data->out_trade_no)->first();

            if (!$order) {
                Log::warning('Alipay Webhook: Order not found.', ['order_sn' => $data->out_trade_no]);
                return 'fail';
            }
            
            if ($order->status != 1) {
                return $alipay->success();
            }

            if ($data->trade_status === 'TRADE_SUCCESS' || $data->trade_status === 'TRADE_FINISHED') {
                $orderProcessed = false;
                
                DB::transaction(function () use ($order, $data, &$orderProcessed) {
                    $order->status = 2; // Processing
                    $order->trade_no = $data->trade_no;
                    $order->save();

                    $carmis = Carmi::where('goods_id', $order->goods_id)->where('status', 1)->limit($order->buy_amount)->get();

                    if ($carmis->count() < $order->buy_amount) {
                        $order->status = 5; // Failed
                        $order->info = '库存不足，自动发货失败，请联系客服。';
                        $order->save();
                        Log::error('Insufficient stock for order.', ['order_sn' => $order->order_sn]);
                        return;
                    }

                    $cardDetails = $carmis->pluck('carmi')->implode("\n");
                    
                    $order->info = $cardDetails;
                    $order->status = 4; // Completed
                    $order->save();

                    Carmi::whereIn('id', $carmis->pluck('id'))->update(['status' => 2]);
                    
                    $order->goods()->increment('sales_volume', $order->buy_amount);
                    $order->goods()->decrement('in_stock', $order->buy_amount);
                    
                    $orderProcessed = true;
                });

                if ($orderProcessed) {
                    // Send email to the user
                    Mail::to($order->email)->send(new OrderShipped($order));
                }

                return $alipay->success();
            }
        } catch (\Exception $e) {
            Log::error('Alipay Webhook Error', ['exception' => $e->getMessage()]);
            return 'fail';
        }

        return 'fail';
    }
}
<?php

namespace App\Livewire\Payment;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Yansongda\Pay\Pay;

#[Layout('components.layouts.app')]
class Index extends Component
{
    public Order $order;
    public $qrCode;

    public function mount(string $orderSn)
    {
        $this->order = Order::where('order_sn', $orderSn)->where('status', 1)->firstOrFail();

        $payload = [
            'out_trade_no' => $this->order->order_sn,
            'total_amount' => $this->order->actual_price,
            'subject' => $this->order->title,
        ];

        // Using Alipay as an example
        $result = Pay::alipay()->scan($payload);
        $this->qrCode = $result->qr_code;
    }

    public function checkStatus()
    {
        $this->order->refresh();
        if ($this->order->status != 1) {
            $this->redirectRoute('order.success', ['order' => $this->order->order_sn]);
        }
    }

    public function render()
    {
        return view('livewire.payment.index');
    }
}
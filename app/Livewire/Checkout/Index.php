<?php

namespace App\Livewire\Checkout;

use App\Models\Coupon;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;
use Yansongda\Pay\Pay;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use Toast;

    public array $cart = [];
    public float $subtotal = 0.0;
    public float $discount = 0.0;
    public float $total = 0.0;
    public string $email = '';
    public string $couponCode = '';
    public ?Coupon $appliedCoupon = null;

    public function mount(): void
    {
        $this->cart = session('cart', []);
        if (empty($this->cart)) {
            $this->redirect('/');
        }
        $this->calculatePrices();
    }

    public function render()
    {
        return view('livewire.checkout.index');
    }

    public function calculatePrices(): void
    {
        $this->subtotal = collect($this->cart)->sum(fn ($item) => $item['quantity'] * $item['price']);
        $this->discount = $this->appliedCoupon ? $this->appliedCoupon->discount : 0.0;
        $this->total = max(0, $this->subtotal - $this->discount);
    }

    public function applyCoupon(): void
    {
        $coupon = Coupon::where('coupon', $this->couponCode)->where('is_open', true)->first();

        if (!$coupon) {
            $this->error('无效的优惠券。');
            return;
        }

        if ($coupon->ret <= 0) {
            $this->error('此优惠券已被使用完毕。');
            return;
        }
        
        $this->appliedCoupon = $coupon;
        $this->calculatePrices();
        $this->success('优惠券已成功应用。');
    }

    public function removeCoupon(): void
    {
        $this->appliedCoupon = null;
        $this->couponCode = '';
        $this->calculatePrices();
        $this->info('优惠券已移除。');
    }

    public function placeOrder(): void
    {
        $this->validate(['email' => 'required|email']);
        
        // Final price check
        $this->calculatePrices();

        $order = null;

        DB::transaction(function () use (&$order) {
            $order = Order::create([
                'order_sn' => date('YmdHis') . Str::random(8),
                'goods_id' => key($this->cart),
                'coupon_id' => $this->appliedCoupon?->id,
                'title' => collect($this->cart)->pluck('name')->join(', '),
                'type' => 1,
                'goods_price' => collect($this->cart)->first()['price'],
                'buy_amount' => collect($this->cart)->sum('quantity'),
                'coupon_discount_price' => $this->discount,
                'wholesale_discount_price' => 0, // Not implemented yet
                'total_price' => $this->total,
                'actual_price' => $this->total,
                'email' => $this->email,
                'search_pwd' => Str::random(6),
                'buy_ip' => request()->ip(),
                'status' => 1,
                'info' => '等待支付',
            ]);

            if ($this->appliedCoupon) {
                $this->appliedCoupon->decrement('ret');
            }
        });

        if ($order) {
            session()->forget('cart');
            $this->dispatch('cart-updated');
            $this->redirectRoute('payment.index', ['order' => $order->order_sn]);
        } else {
            $this->error('订单创建失败，请重试。');
        }
    }
}
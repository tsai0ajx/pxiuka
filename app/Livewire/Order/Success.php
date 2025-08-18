<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Success extends Component
{
    public Order $order;

    public function mount(string $orderSn)
    {
        $this->order = Order::where('order_sn', $orderSn)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.order.success');
    }
}
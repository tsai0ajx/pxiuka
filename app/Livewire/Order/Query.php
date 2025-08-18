<?php

namespace App\Livewire\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.app')]
class Query extends Component
{
    public string $search = '';
    public ?Order $order = null;

    public function searchOrder()
    {
        $this->order = Order::where('order_sn', $this->search)
                            ->orWhere('email', $this->search)
                            ->where('status', 4) // Only show completed orders for now
                            ->first();
    }

    public function render()
    {
        return view('livewire.order.query');
    }
}
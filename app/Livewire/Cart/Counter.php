<?php

namespace App\Livewire\Cart;

use Livewire\Attributes\On;
use Livewire\Component;

class Counter extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->updateCount();
    }

    #[On('cart-updated')]
    public function updateCount(): void
    {
        $this->count = count(session('cart', []));
    }

    public function render()
    {
        return view('livewire.cart.counter');
    }
}
<?php

namespace App\Livewire\Cart;

use App\Models\Goods;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.app')]
class Index extends Component
{
    use Toast;

    public array $cart = [];
    public float $total = 0.0;

    public function mount(): void
    {
        $this->updateCart();
    }

    public function render()
    {
        return view('livewire.cart.index');
    }

    public function updateCart(): void
    {
        $this->cart = session('cart', []);
        $this->calculateTotal();
    }

    public function calculateTotal(): void
    {
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['quantity'] * $item['price'];
        });
    }

    public function removeFromCart($productId): void
    {
        unset($this->cart[$productId]);
        session(['cart' => $this->cart]);
        $this->dispatch('cart-updated');
        $this->updateCart();
        $this->success('商品已从购物车中移除。');
    }

    public function increment($productId): void
    {
        $this->cart[$productId]['quantity']++;
        session(['cart' => $this->cart]);
        $this->updateCart();
    }

    public function decrement($productId): void
    {
        if ($this->cart[$productId]['quantity'] > 1) {
            $this->cart[$productId]['quantity']--;
            session(['cart' => $this->cart]);
            $this->updateCart();
        }
    }
}
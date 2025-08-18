<?php

namespace App\Livewire\Product;

use App\Models\Goods;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

#[Layout('components.layouts.app')]
class Show extends Component
{
    use Toast;

    public Goods $product;

    public function mount(Goods $product)
    {
        $this->product = $product;
    }

    public function render()
    {
        return view('livewire.product.show');
    }

    public function addToCart()
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$this->product->id])) {
            $cart[$this->product->id]['quantity']++;
        } else {
            $cart[$this->product->id] = [
                "name" => $this->product->gd_name,
                "quantity" => 1,
                "price" => $this->product->actual_price,
                "image" => $this->product->picture
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
        $this->success("`{$this->product->gd_name}` 已添加到购物车。");
    }
}
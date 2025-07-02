<?php

namespace App\Livewire\Product;

use App\Models\Goods;
use Livewire\Component;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast;

    public function render()
    {
        return view('livewire.product.index', [
            'products' => Goods::where('is_open', true)->orderBy('ord', 'desc')->paginate(12)
        ]);
    }

    public function addToCart($productId)
    {
        $product = Goods::findOrFail($productId);
        $cart = session()->get('cart', []);

        if(isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                "name" => $product->gd_name,
                "quantity" => 1,
                "price" => $product->actual_price,
                "image" => $product->picture
            ];
        }

        session()->put('cart', $cart);
        $this->dispatch('cart-updated');
        $this->success("`$product->gd_name` 已添加到购物车。");
    }
}
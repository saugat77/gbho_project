<?php

namespace App\Http\Livewire;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class AddToCartButton extends Component
{
    public $product;
    public $quantity = 1;
    public ?bool $withQuantity;
    public $buyNow;
    public bool $small;

    public function mount(Product $product, ?bool $small = false, ?bool $withQuantity = false, $buyNow = false)
    {
        $this->product = $product;
        $this->withQuantity = $withQuantity;
        $this->small = $small;
        $this->buyNow = $buyNow;
    }

    public function addToCart()
    {
        // Cart::add([
        //     'id' => $this->product->id,
        //     'name' => $this->product->name,
        //     'qty' => $this->quantity,
        //     'price' => $this->product->current_price,
        //     'weight' => 0,
        //     'options' => [
        //         'store_id' => $this->product->store->id
        //     ] 
        // ]);

        $cartItem = Cart::add($this->product, $this->quantity);

        $cartItem->associate('\App\Product');

        $this->emit('cartAdded');
        $this->emit('toast', ['default', 'Added to cart']);

        if ($this->buyNow) {
            return redirect()->route('frontend.checkout.index');
        }
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}

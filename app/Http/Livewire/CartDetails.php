<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartDetails extends Component
{
    public $cartProducts;

    public function removeItem($rowId)
    {
        Cart::remove($rowId);
        
        $this->emit('toast', ['default', 'Item removed from cart']);
        $this->emit('cartUpdated');
    }

    public function render()
    {
        synCartPrice();
        $this->cartProducts = Cart::content();

        return view('livewire.cart-details');
    }
}

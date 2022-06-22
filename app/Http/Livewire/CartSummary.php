<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class CartSummary extends Component
{
    public $cartCount;
    protected $listeners = ['cartAdded', 'cartUpdated'];

    public function cartAdded()
    {
        //
    }

    public function cartUpdated()
    {
        //
    }
    
    public function render()
    {
        $this->cartCount = Cart::count();

        return view('livewire.cart-summary');
    }
}

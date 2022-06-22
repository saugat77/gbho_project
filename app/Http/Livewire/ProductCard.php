<?php

namespace App\Http\Livewire;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;

class ProductCard extends Component
{
    public $product;

    public function mount()
    {
    }

    public function render()
    {
        return view('livewire.product-card');
    }
}

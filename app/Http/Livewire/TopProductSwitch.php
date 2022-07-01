<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class TopProductSwitch extends Component
{
    public $product;
    public $is_top;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->is_top = $product->is_top;
    }

    public function updatedIsTop($value)
    {
        $this->product->update(['is_top' => $value]);
    }

    public function render()
    {
        return view('livewire.top-product-switch');
    }
}

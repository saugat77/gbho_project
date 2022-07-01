<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class ProductStatusSwitch extends Component
{
    public $product;
    public $active;
    
    public function mount(Product $product)
    {
        $this->product = $product;
        $this->active = $product->is_active;
    }

    public function updatedActive($value)
    {
        $this->product->update(['is_active' => $value]);
    }

    public function render()
    {
        return view('livewire.product-status-switch');
    }
}

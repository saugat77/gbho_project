<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class HeaderSearch extends Component
{
    public $query;
    public $products = [];

    public function updatedQuery()
    {
        if($this->query){
            $this->products = Product::where('name', 'like', '%' . $this->query . '%')->active()->limit(10)->get();
        }else{
            $this->reset('products');
        }
    }

    public function render()
    {
        return view('livewire.header-search');
    }
}

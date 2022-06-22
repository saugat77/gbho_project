<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductSuggestionGrid extends Component
{
    public $title;
    public $products;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($products, $title)
    {
        $this->title = $title;
        $this->products = $products;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.product-suggestion-grid');
    }
}

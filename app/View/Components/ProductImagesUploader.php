<?php

namespace App\View\Components;

use App\Product;
use Illuminate\View\Component;

class ProductImagesUploader extends Component
{
    public $product;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.product-images-uploader');
    }
}

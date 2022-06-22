<?php

namespace App\View\Components;

use App\Product;
use Illuminate\View\Component;

class ProductFormTemplate extends Component
{
    public Product $product;
    public $updateMode = false;
    public $activeTab;

    /**
     * Create a new component instance.
     *
     * @return void
     */
   public function __construct(Product $product)
    {
        $this->product = $product;
        if ($product->exists) {
            $this->updateMode = true;
        }
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        switch (request()->segment(4)) {
            case 'images':
                $this->activeTab = 'images';
                break;
            case 'seo':
                $this->activeTab = 'seo';
                break;
            default:
                $this->activeTab = 'general';
                break;
        }
        
        return view('components.product-form-template');
    }
}

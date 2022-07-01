<?php

namespace App\Http\Livewire;

use App\Product;
use App\ProductRating;
use Livewire\Component;

class ProductReview extends Component
{
    public $product;
    public $productRating;

    protected $rules = [
        'productRating.rating' => 'required|in:1,2,3,4,5',
        'productRating.headline' => 'nullable',
        'productRating.description' => 'nullable|max:100',
        'productRating.product_id' => 'nullable|max:100',
        'productRating.user_id' => 'nullable|max:100',
    ];

    public function mount(Product $product)
    {
        $this->product = $product;
        $productRating = $this->product->ratings()->where('user_id', auth()->user()->id)->first();

        if ($productRating) {
            $this->productRating = $productRating;
        } else {
            $this->productRating = new ProductRating([
                'rating' => 5,
                'product_id' => $product->id,
                'user_id' => auth()->user()->id,
            ]);
        }
    }

    public function save()
    {
        $this->validate();

        // save
        $this->productRating->save();

        // emit event
        $this->emit('ratingUpdated');
        $this->dispatchBrowserEvent('close-review-modal');
        $this->emit('toast', ['default', 'Thank you for your valuable feedback.']);
    }

    public function render()
    {
        return view('livewire.product-review');
    }
}

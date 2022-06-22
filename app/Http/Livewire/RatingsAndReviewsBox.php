<?php

namespace App\Http\Livewire;

use App\Product;
use Livewire\Component;

class RatingsAndReviewsBox extends Component
{
    public $product;
    public $title;

    protected $listeners = ['ratingUpdated'];

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->title = 'Ratings & Reviews';
    }

    public function ratingUpdated()
    {
        // reload component
    }

    public function render()
    {
        $reviews = $this->product->ratings;

        $overallRating = $reviews->avg('rating') ?? 0;
        $totalReviewsCount = count($reviews);

        $starData = [];
        for($stars = 5; $stars >= 1; $stars--){
            $individualRateCount = $reviews->where('rating', $stars)->count();
            $starData[$stars]['rated_by_count'] = $individualRateCount;
            $starData[$stars]['rated_by_percent'] = $totalReviewsCount ? ($individualRateCount / $totalReviewsCount) *100 : 0; // prevent from divided by zero exxception
        }
     
        return view('livewire.ratings-and-reviews-box', compact([
            'reviews',
            'overallRating',
            'totalReviewsCount',
            'starData'
        ]));
    }
}

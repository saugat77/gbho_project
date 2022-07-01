<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RatingStars extends Component
{
    public $totalStars;
    public $stars;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($stars)
    {
        $this->totalStars = 5;
        $this->stars = $stars;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.rating-stars');
    }
}

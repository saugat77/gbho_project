<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FilterRate extends Component
{
    public $minVal;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($minVal)
    {
        $this->minVal = $minVal;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.filter-rate');
    }
}

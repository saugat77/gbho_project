<?php

namespace App\View\Components\Frontend\Partials;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AccountNavigator extends Component
{
    public $heading;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($heading = 'My Account')
    {
        $this->heading = $heading;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {

        return view('components.frontend.partials.account-navigator', [
            'user' => Auth::user()
        ]);
    }
}

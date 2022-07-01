<?php

namespace App\View\Components;

use App\Store;
use App\User;
use Illuminate\View\Component;

class StoreForm extends Component
{
    public $store;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Store $store = null)
    {
        $this->store = $store ?? new Store();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $sellers = User::role('seller')->get();

        return view('components.store-form', compact('sellers'));
    }
}

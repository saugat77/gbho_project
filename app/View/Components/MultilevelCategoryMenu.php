<?php

namespace App\View\Components;

use App\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class MultilevelCategoryMenu extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $categoryMenus = Cache::remember(config('constants.multilevel-category-menu.key'), config('constants.multilevel-category-menu.expiration_time'), function () {
            return Category::with('childcategories.childcategories')->where('parent_id', null)->active()->orderBy('name')->get();
        });

        return view('components.multilevel-category-menu', [
            'categoryMenus' => $categoryMenus
        ]);
    }
}

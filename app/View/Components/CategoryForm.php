<?php

namespace App\View\Components;

use App\Category;
use Illuminate\View\Component;

class CategoryForm extends Component
{
    public $category;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        $parentCategories = Category::with(['childCategories'])->where('parent_id', null)->active()->orderBy('name')->get();

        return view('components.category-form', compact('parentCategories'));
    }
}

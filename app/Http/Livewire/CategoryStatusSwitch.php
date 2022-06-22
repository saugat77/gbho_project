<?php

namespace App\Http\Livewire;

use App\Category;
use Livewire\Component;

class CategoryStatusSwitch extends Component
{
    public $category;
    public $active;

    public function mount(Category $category)
    {
        $this->category = $category;
        $this->active = $category->active;
    }

    public function updatedActive($value)
    {
        $this->category->update(['active' => $value]);
    }

    public function render()
    {
        return view('livewire.category-status-switch');
    }
}

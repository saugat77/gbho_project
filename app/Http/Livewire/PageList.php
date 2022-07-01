<?php

namespace App\Http\Livewire;

use App\Page;
use Livewire\Component;

class PageList extends Component
{
    public function render()
    {
        $pages = Page::with(['author', 'editor'])->withTrashed()->latest()->paginate();

        return view('livewire.page-list', compact('pages'));
    }
}

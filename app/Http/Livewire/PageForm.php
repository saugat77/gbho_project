<?php

namespace App\Http\Livewire;

use App\Page;
use App\Service\ImageService;
use Livewire\Component;
use Livewire\WithFileUploads;

class PageForm extends Component
{
    use WithFileUploads;

    public $page;
    public $updateMode = false;
    public $featuredImage;
    public $featuredImageUrl = 'https://dummyimage.com/900x600/f4f6f9/0011ff';
    public $slug = '';
    public $confirmFeaturedImageRemoval = false;
    protected $queryString = ['slug' => ['except' => '']];

    public function rules()
    {
        return [
            'page.title' => 'required',
            'page.content' => 'required',
            'page.show_breadcrumbs' => 'nullable',
            'page.show_title' => 'nullable',
            'page.excerpt' => 'nullable',
            // 'featuredImage' => $this->updateMode ? 'nullable' : 'required' . '|mimes:jpeg,jpg,png,gif,bmp,webp',
            'featuredImage' => 'nullable',
        ];
    }

    public function mount(Page $page = null)
    {
        if ($page->exists) {
            $this->page = $page;
            $this->slug = $page->slug;
            $this->featuredImageUrl = $page->featured_image_url;
            $this->updateMode = true;
        } else {
            $this->page = new Page();
            $this->page->show_title = 1;
        }
    }

    public function save()
    {
        $this->validate();

        // Delete old featured image
        if ($this->updateMode && $this->featuredImage) {
            $imageService = new ImageService();
            $imageService->unlinkImage($this->page->featured_image);
        }

        // Save featured image
        if ($this->featuredImage) {
            $this->page->featured_image = $this->featuredImage->store('pages');
        }

        $this->page->save();

        $this->reset(['featuredImage']);
        $this->updateMode = true;
        $this->slug = $this->page->slug;

        $this->emit('toast', ['default', 'Page Saved']);
    }

    public function updatedFeaturedImage()
    {
        $this->featuredImageUrl = $this->featuredImage->temporaryUrl();
    }

    public function removeFeaturedImage()
    {
        if ($this->page->hasFeaturedImage()) {
            $imageService = new ImageService();
            $imageService->unlinkImage($this->page->featured_image);
            $this->page->update(['featured_image' => null]);
        }
        
        $this->confirmFeaturedImageRemoval = false;
        $this->reset(['featuredImageUrl']);
        $this->emit('toast', ['default', 'Removed featured image']);
    }

    public function render()
    {
        return view('livewire.page-form');
    }
}

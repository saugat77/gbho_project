<?php

namespace App\Http\Livewire;

use App\ImageSlider;
use App\Service\ImageService;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImageSliderForm extends Component
{
    use WithFileUploads;

    public ImageSlider $imageSlider;
    public $imageUrl = null;
    public $updateMode = false;

    public $image;

    protected $rules = [
        // 'image' => 'required|mimes:jpeg,jpg,png,gif|max:10000',
        'imageSlider.id' => 'required|uuid',
        'imageSlider.title' => 'nullable',
        'imageSlider.group' => 'required',
        'imageSlider.active' => 'nullable|boolean',
        'imageSlider.position' => 'required|integer',
        'imageSlider.action_link' => 'nullable',
        'imageSlider.open_in_new_tab' => 'nullable',
    ];

    public function mount(ImageSlider $imageSlider = null)
    {
        if ($imageSlider->exists) {
            $this->imageSlider = $imageSlider;
            $this->updateMode = true;
        } else {
            $this->imageSlider = new ImageSlider([
                'id' => Str::uuid(),
                'active' => true,
                'open_in_new_tab' => true,
            ]);
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->updateMode) {
            $this->validate(
                ['image' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000'],
            );
        } else {
            $this->validate(
                ['image' => 'required|mimes:jpeg,jpg,png,gif|max:10000'],
            );
        }

        // delete old image 
        if ($this->updateMode && $this->image) {
            $imageService = new ImageService();
            $imageService->unlinkImage($this->imageSlider->image_path);
        }

        // save image
        if ($this->image) {
            $this->imageSlider->image_path = $this->image->store('slider_images', 'sliders');
        }

        $this->imageSlider->save();

        session()->flash('success', 'Image slider successfully added');
        return redirect()->route('image-sliders.index');
    }

    public function updatedImageSliderGroup()
    {
        $currentMaxPosition = ImageSlider::where('group', $this->imageSlider->group)->max('position');
        $this->imageSlider->position = $currentMaxPosition ? ++$currentMaxPosition : 1;
    }

    public function render()
    {
        if ($this->updateMode) {
            $this->imageUrl = $this->imageSlider->imageUrl;
        }

        if ($this->image) {
            $this->imageUrl = $this->image->temporaryUrl();
        }

        return view('livewire.image-slider-form');
    }
}

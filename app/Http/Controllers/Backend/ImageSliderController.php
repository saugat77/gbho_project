<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\ImageSlider;
use App\Service\ImageService;
use Illuminate\Http\Request;

class ImageSliderController extends Controller
{
    public function index()
    {
        $imageSliders = ImageSlider::all();
        return view('image-slider.index', compact('imageSliders'));
    }

    public function create()
    {
        $imageSlider = new ImageSlider();

        return view('image-slider.create', compact('imageSlider'));
    }

    public function edit(ImageSlider $imageSlider)
    {
        return view('image-slider.edit', compact('imageSlider'));
    }

    public function delete(ImageSlider $imageSlider, ImageService $imageService)
    {
        $imageService->unlinkImage($imageSlider->image_path);
        $imageSlider->forceDelete();

        return redirect()->back()->with('success', 'Deleted successfully');
    }
}

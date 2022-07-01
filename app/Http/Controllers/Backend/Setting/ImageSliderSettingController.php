<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\ImageSliderSettingRequest;
use App\Service\ImageService;

class ImageSliderSettingController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $title = 'Primary Image Slider';

        return view('setting.image-slider', compact([
            'title'
        ]));
    }

    public function store(ImageSliderSettingRequest $request)
    {
        $validatedSettings = $request->validated();

        settings()->set($validatedSettings);

        session()->flash('defaultAlert', 'Settings Saved');
        return redirect()->back()->with('success', 'Settings Saved');
    }
}

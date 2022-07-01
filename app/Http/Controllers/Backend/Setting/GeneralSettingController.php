<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\GeneralSettingRequest;
use App\Service\ImageService;

class GeneralSettingController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function index()
    {
        $title = 'General Settings';

        return view('setting.general', compact([
            'title'
        ]));
    }

    public function store(GeneralSettingRequest $request)
    {
        $validatedSettings = $request->validated();

        if ($request->hasFile('site_logo')) {
            $faviconPath = $this->imageService->swapImage(settings()->get('site_logo'), $request->file('site_logo'));
            $validatedSettings['site_logo'] = $faviconPath;
        }

        if ($request->hasFile('favicon')) {
            $faviconPath = $this->imageService->swapImage(settings()->get('favicon'), $request->file('favicon'));
            $validatedSettings['favicon'] = $faviconPath;
        }

        settings()->set($validatedSettings);

        session()->flash('defaultAlert', 'Settings Saved');
        return redirect()->back()->with('success', 'Settings Saved');
    }
}

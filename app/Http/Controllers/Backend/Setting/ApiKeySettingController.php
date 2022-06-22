<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\ApiKeySettingRequest;

class ApiKeySettingController extends Controller
{
    public function index()
    {
        $title = 'API and Keys Settings';

        return view('setting.api-and-keys', compact([
            'title'
        ]));
    }

    public function store(ApiKeySettingRequest $request)
    {
        $validatedSettings = $request->validated();

        settings()->set($validatedSettings);

        session()->flash('defaultAlert', 'Settings Saved');
        return redirect()->back()->with('success', 'Settings Saved');
    }
}

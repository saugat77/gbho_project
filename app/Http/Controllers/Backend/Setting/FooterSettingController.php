<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\FooterSettingRequest;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    public function index()
    {
        $title = 'Footer Settings';

        return view('setting.footer', compact([
            'title'
        ]));
    }
    
    public function store(FooterSettingRequest $request)
    {
        $validatedSettings = $request->validated();

        settings()->set($validatedSettings);

        session()->flash('defaultAlert', 'Settings Saved');
        return redirect()->back()->with('success', 'Settings Saved');
    }
}

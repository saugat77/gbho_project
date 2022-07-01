<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\EmailSettingRequest;
use App\Mail\TestEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailSettingController extends Controller
{
    public function index()
    {
        $title = 'Email Settings';

        return view('setting.email', compact([
            'title'
        ]));
    }

    public function store(EmailSettingRequest $request)
    {
        $validatedSettings = $request->validated();

        settings()->set($validatedSettings);

        session()->flash('defaultAlert', 'Email Settings Saved');
        return redirect()->back()->with('success', 'Email Settings Saved');
    }

    public function sendTestEmail(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        Mail::to('manindratamang5@gmail.com')->send(new TestEmail());

        session()->flash('defaultAlert', 'Test email sent');
        return redirect()->back()->with('success', 'Test email sent');
    }
}

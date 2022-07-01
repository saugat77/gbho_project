<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\EmailSettingRequest;
<<<<<<< HEAD
use App\Mail\RegisterMail;
=======
use App\Mail\TestEmail;
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66
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

<<<<<<< HEAD
        // $request->email    
        Mail::to('saugatpandey4@gmail.com')->send(new RegisterMail());
=======
        Mail::to($request->email)->send(new TestEmail());
>>>>>>> 7f3aedc92570ca4d6173e4fd25fa4d3e1c0edc66

        session()->flash('defaultAlert', 'Test email sent');
        return redirect()->back()->with('success', 'Test email sent');
    }
}

<?php

namespace App\Http\Controllers\Backend\Setting;

use App\Http\Controllers\Controller;
use App\Http\Requests\Setting\PaymentSettingRequest;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $title = 'Payment Settings';

        return view('setting.payment', compact([
            'title'
        ]));
    }

    public function store(PaymentSettingRequest $request)
    {
        $validatedSettings = $request->validated();

        settings()->set($validatedSettings);

        session()->flash('defaultAlert', 'Payment settings saved');
        return redirect()->back()->with('success', 'Payment settings saved');
    }
}

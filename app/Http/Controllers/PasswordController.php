<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $heading = 'Change password';

        return view('frontend.password.index', compact([
            'user',
            'heading'
        ]));
    }

    public function update(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        // we skip password match for oauth users with no password
        if (!empty($user->password)) {
            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors([
                    'old_password' => 'You have entered wrong password'
                ]);
            }
        }

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('passwordSuccess', 'Your password has been changed');
    }
}

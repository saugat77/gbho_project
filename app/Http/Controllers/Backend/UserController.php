<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:super-admin|admin');
    }

    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'nullable',
            'gender' => 'nullable',
            'roles' => 'required'
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->gender = $request->gender;
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->update();

        $user->syncRoles($request->roles);

        session()->flash('successAlert', 'use update');

        return redirect()->back()->with('successAlert', 'User updated');
    }

    public function changePassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'password_confirmation' => 'required|required_with:password',
        ]);

        $user->update([
            'password' => bcrypt($request->password)
        ]);

        session()->flash('successAlert', 'Password changed.');
        return redirect()->back()->with('successAlert', 'Password Changed.');
    }
}

<?php

namespace App\Http\Requests;
use App\User;

use Illuminate\Foundation\Http\FormRequest;

class newRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userid' => 'required',
            // 'slug' => $this->isMethod('POST') ? 'nullable' : 'required|unique:categories,slug,' . $this->category->id,
            // 'parent_id' => 'nullable',
            // 'description' => 'nullable',
            // 'thumbnail' => 'nullable',
            // 'active' => 'nullable|boolean'
        ];
    }
    public function createUser(Request $request)

    {
        
        $user = User::create([
            'userid'  => $request['userid'],
            'password' => bcrypt($request->password),
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'dob' => $request->dob,
            'parent_address' => $request->parent_address,
            'parent_apt' => $request->parent_apt,
            'parent_city' => $request->parent_city,
            'parent_state' => $request->parent_state,
            'parent_country' => $request->parent_country,
            'parent_zip' => $request->parent_zip,
            'phone' => $request->phone,
            'email' => $request->email,
            'spouse_first_name' => $request->spouse_first_name,
           'spouse_last_name' => $request->spouse_last_name,
           'child_first_name' => $request->child_first_name,
           'child_last_name' => $request->child_last_name,
            'child_age' => $request->child_age,
           'child_address' => $request->child_address,
            'child_city' => $request->child_city,
            'child_state' => $request->child_state,
            'child_country' => $request->child_country,
            'child_zip' => $request->child_zip,
        ]);
        
        $user->save();
        dd($user) ;

        
    }


}

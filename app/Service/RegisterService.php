<?php

namespace App\Service;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class RegisterService{
    
 public function createUser($request)
    {
        
        try{
        $data =new User([
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
            'payment_status' => 'payment_pending',
            
        ]);
        $data->save();
        return $data->id;
       
      
    // return $data;
     
    }

    catch (\throwable $ex) {
        DB::rollBack();
        logger('Error While persisting order.');
        report($ex);
        return $ex->getMessage();
    }
    }
}




// $data->userid  => $request->userid,
// $data->password = bcrypt($request->password),
// $data->firstname = $request->firstname;
// $data->lastname = $request->lastname;
// $data->dob = $request->dob;
// $data->parent_address = $request->parent_address;
// $data->parent_apt = $request->parent_apt;
// $data->parent_city = $request->parent_city;
// $data->parent_state = $request->parent_state;
// $data->parent_country = $request->parent_country;
// $data->parent_zip = $request->parent_zip;
// $data->phone = $request->phone;
// $data->email = $request->email;
// $data->spouse_first_name = $request->spouse_first_name;
// $data->spouse_last_name = $request->spouse_last_name;
// $data->child_first_name = $request->child_first_name;
// $data->child_last_name = $request->child_last_name;
// $data->child_age = $request->child_age;
// $data->child_address = $request->child_address;
// $data->child_city = $request->child_city;
// $data->child_state = $request->child_state;
// $data->child_country = $request->child_country;
// $data->child_zip = $request->child_zip;



?>
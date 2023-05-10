<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class Authentication extends Controller
{
    public function signUp(request $request)
    {
        $validator = Validator::make($request->all(),[
            'fullName'=>['required','regex:/^[a-zA-Zالف-ی]{2,}(?:\s[a-zA-Zالف-ی]+)+$/','max:50'],
            'email'=>'required|email|unique:App\Models\User,email',
            'userName'=>'required|regex:/^(?=.*[الف-یA-Za-z])[الف-یA-Z0-9a-z-_.]{1,50}$/|unique:App\Models\User,username',
            'password' => ['required', Password::defaults()],
        ]);

        if ($validator->fails()){
            return ['result'=>$validator->errors(),'status'=>false];
        }
        User::create([
            'name' => $request->fullName,
            'username' => $request->userName,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        return ['status'=>true];
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Profiles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{

    public function loginWithSocial($social)
    {
        try{
            $authUser = Socialite::driver($social)->user();
        }
        catch(\Exception $e){
            return redirect('/login');
        }


        $user= User::where([
            'email' => $authUser->email
        ])->first();
        if (!$user){
            $user = User::create([
                'name' => $authUser->getName(),
                'email' => $authUser->email,
                'username' => $authUser->getNickname() ?? explode("@", $authUser->email)[0],
                'email_verified_at' => now(),
            ]);
            Profiles::create([
                'user_id' => $user->id,
                'image' => $authUser->avatar
            ]);
        }
        Auth::login($user);

        return redirect('/dashboard');
    }
}

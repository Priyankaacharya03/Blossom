<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        $googleUser = Socialite::driver('google')->user();

        $exist_user = User::where('email', $googleUser->getEmail())->first();

        if (!$exist_user) {
            $user_type = UserType::create(['role' => 'customer']);

            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt(Str::random(12)),
                'profile_img' => $googleUser->avatar,
                'google_id' => $googleUser->getId(),
                'user_type_id' => $user_type->id,
            ]);
        } else {
            $user = $exist_user;
        }

        Auth::login($user);

        toastr()->success('Login Success.');
        return redirect()->route('home');
    }
}

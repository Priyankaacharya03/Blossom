<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function PasswordEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );
        //document
        // return $status === Password::RESET_LINK_SENT
        //     ? back()->with(['status' => __($status)])
        //     : back()->withErrors(['email' => __($status)]);

        //afai
        if ($status === Password::RESET_LINK_SENT) {
            toastr()->success('Email Sent');
            // return back()->with(['status' => __($status)]);
            return back();
        } else {
            toastr()->error('Email not found');
            // return back()->withErrors(['email' => __($status)]);
            return back();
        }
    }


    public function PasswordReset(string $token)
    {
        return view('auth.reset-password', ['token' => $token]);
    }


    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
                // toastr()->success('Reset Successful');

                event(new PasswordReset($user));
            }
        );

        // return $status === Password::PASSWORD_RESET
        //     ? redirect()->route('login')->with('status', __($status))
        //     : back()->withErrors(['email' => [__($status)]]);

        if ($status === Password::PASSWORD_RESET) {
            toastr()->success('Reset Successful');
            // return back()->with(['status' => __($status)]);
            return redirect()->route('login');
        } else {
            toastr()->error('Invalid token');
            // return back()->withErrors(['email' => __($status)]);
            return back();
        }
    }
}

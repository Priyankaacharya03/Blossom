<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function login()
    {
        return view('auth.login');
    }
    public function loginSubmit(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        //sab ma try catch

        if (Auth::attempt($req->only('email', 'password'))) {
            toastr()->success('Login Success');
            return redirect()->route('home');
        }

        toastr()->error('Incorrect Username or password.');
        return back();
    }


    public function register()
    {
        return view('auth.register');
    }

    public function registerSubmit(Request $req)
    {
        $req->validate([
            'name' => 'required | string',
            'email' => 'required | email | unique:users',
            'gender' => 'required',
            'password' => 'required | confirmed | min:8 | max :30',
        ]);

        // return $req->all(); //return all the values in the form submitted by user

        $user_type = UserType::create(['role' => 'customer']);

        // $user = User::create([
        //     'name' => $req->name,
        //     'email' => $req->email,
        //     'gender' => $req->gender,
        //     'password' => $req->password,
        //     'user_type_id' => $user_type->id,
        // ]);

        $otp = rand(100000, 999999); // Generate OTP
        $expiresAt = Carbon::now()->addMinutes(5); // OTP expires in 5 minutes

        $user = User::create([
            'name' => $req->name,
            'email' => $req->email,
            'gender' => $req->gender,
            'password' => Hash::make($req->password),
            'user_type_id' => $user_type->id,
            'otp' => $otp,
            'otp_expires_at' => $expiresAt,

        ]);

        $this->sendOTP($user);

        session(['email' => $user->email]); // Store email in session
        return redirect()->route('verify.form')->with('success', 'OTP sent to your email.');

        // event(new Registered($user));

        toastr()->success('Your account has been registered.');

        return redirect()->route('login');
    }

    public function logout(Request $req)
    {
        Auth::logout();
        toastr()->success('Logout Success.');
        return redirect()->route('login');
    }

    // public function home()
    // {
    //     return view('site/pages/home');
    // }

    //vendor register
    public function vendorRegister()
    {
        return view('site.pages.become_a_seller');
    }

    // Send OTP via Email
    private function sendOTP($user)
    {
        Mail::raw("Your OTP is: {$user->otp}", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Email Verification OTP');
        });
    }

    // Show OTP Verification Form
    public function showVerifyForm()
    {
        return view('auth.verify_email');
    }

    public function verifyOTP(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|numeric',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP expired. Please request a new one.']);
        }

        $user->update([
            'email_verified_at' => now(),
            'otp' => null,
            'otp_expires_at' => null,
            'otp_attempts' => 0, // Reset attempts
        ]);

        return redirect()->route('login')->with('success', 'Email verified. Please login.');
    }

    // Resend OTP
    public function resendOTP(Request $request)
    {
        $email = session('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ($user->is_verified) {
            return back()->withErrors(['email' => 'Email already verified.']);
        }

        // Limit OTP resend to 3 attempts
        if ($user->otp_attempts >= 3) {
            return back()->withErrors(['otp' => 'Too many OTP requests. Please try again later.']);
        }

        $otp = rand(100000, 999999);
        $expiresAt = Carbon::now()->addMinutes(5);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => $expiresAt,
            'otp_attempts' => $user->otp_attempts + 1,
        ]);

        $this->sendOTP($user);

        return back()->with('success', 'New OTP sent to your email.');
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }



    public function login(Request $request)
    {

        try {
            $credintials = $request->only('email', 'password');
            if (Auth::guard('web')->attempt($credintials)) {
                $user = Auth::guard('web')->user();
                $code = random_int(100000, 999999);
                session(['verification_code' => $code, 'user_id' => $user->id]);
                // Send the verification code via email or SMS here
                Mail::to($user->email)->send(new VerificationCode($code));

                Auth::logout(); // Log out the user until they verify
                return redirect()->route('custom.verification')->with('status', 'A verification code has been sent to your email.');
            }
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e]);
        }
    }

    public function showVerification()
    {
        return view('auth.verify');
    }

    public function customVerification(Request $request)
    {
        $request->validate([
            'code' => 'required|digits:6',
        ]);

        $storedCode = session('verification_code');
        $userId = session('user_id');

        if ($request->code == $storedCode) {
            // Code is valid, log the user in
            Auth::loginUsingId($userId);

            // Clear the verification code from the session
            $request->session()->forget(['verification_code', 'user_id']);

            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->withErrors(['code' => 'Invalid verification code.']);
        }
    }
}

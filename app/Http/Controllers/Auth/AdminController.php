<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
                return redirect()->route('custom.verificationform')->with('status', 'A verification code has been sent to your email.');
            }
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
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
    public function adminProfile()
    {
        $profileData = Auth::guard('web')->user();
        return view('admin.admin_profile', compact('profileData'));
    }

    public function storeProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' =>"sometimes|min:10",
            'address' => "nullable",
            'photo' =>"nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",

        ]);
        $user = Auth::guard('web')->user();

        $path = $user->photo; // Default to existing photo path

        if($request->hasFile('photo')){
            if($user->photo && Storage::exists($user->photo)){
                Storage::delete($user->photo);
            }
             $path = Storage::putFile('user_images', $request->file('photo'));

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->photo = $path;
        $user->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );


        return redirect()->back()->with($notification);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed|confirmed',
        ]);

        $user = Auth::guard('web')->user();

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect()->back()->withErrors(['old_password' => 'The provided password does not match your current password.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}

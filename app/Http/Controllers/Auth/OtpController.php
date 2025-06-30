<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class OtpController extends Controller
{
    // Show phone number input form
    public function showLoginForm()
    {
        return view('auth.login-otp');
    }

    // Send OTP to phone
    public function sendOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:9,15', // Adjust length as needed
        ]);

        $phone = $request->phone;

        // Generate 6-digit OTP
        $otp = rand(100000, 999999);

        // Save OTP in cache for 5 minutes keyed by phone
        Cache::put('otp_' . $phone, $otp, now()->addMinutes(5));

        // TODO: Integrate SMS API to send $otp to $phone
        // For now, just return otp for testing
        return back()->with('otp', $otp)->with('phone', $phone)->with('success', "OTP sent to $phone");
    }

    // Verify OTP and log in
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'phone' => 'required|digits_between:9,15',
            'otp' => 'required|digits:6',
        ]);

        $phone = $request->phone;
        $otp = $request->otp;

        $cachedOtp = Cache::get('otp_' . $phone);

        if (!$cachedOtp || $cachedOtp != $otp) {
            return back()->withErrors(['otp' => 'Invalid or expired OTP'])->withInput();
        }

        // OTP is valid: find or create user
        $user = User::firstOrCreate(
            ['phone' => $phone],
            [
                'name' => 'User ' . Str::random(5),
                'email' => null,
                'password' => bcrypt(Str::random(16)), // random password, not used
                'is_admin' => false,
            ]
        );

        // Log user in
        Auth::login($user);

        // Remove OTP from cache
        Cache::forget('otp_' . $phone);

        return redirect()->intended('/home')->with('success', 'Logged in successfully!');
    }
}

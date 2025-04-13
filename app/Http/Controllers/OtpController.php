<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class OtpController extends Controller
{
    // Send OTP to email
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
    
        $otp = rand(100000, 999999);
        $key = 'otp_' . $request->email;
        Cache::put($key, $otp, now()->addMinutes(5));
    
        Mail::to($request->email)->send(new OtpMail($otp));
    
        return response()->json(['message' => 'OTP sent successfully.']);
    }

    // Verify OTP
    public function verifyOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required|digits:6',
        ]);

        $key = 'otp_' . $request->email;
        $cachedOtp = Cache::get($key);

        if ($cachedOtp && $cachedOtp == $request->otp) {
            // Optional: Clear OTP after successful verification
            Cache::forget($key);
            return response()->json(['verified' => true]);
        }

        return response()->json(['verified' => false], 422);
    }
}

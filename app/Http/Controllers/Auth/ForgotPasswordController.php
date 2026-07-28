<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use App\Models\location\DistrictModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use DB; 
use App\Models\Common\CommonModel;
use Carbon\Carbon;
use App\Services\SmsService;
use Illuminate\Support\Facades\Cache;

class ForgotPasswordController extends Controller
{
    public function showForgetPasswordForm()
    {
        return view('auth.forgetPassword'); // Ensure this view exists
    }
    
    public function showResetPasswordForm() 
    { 
        return view('auth.forgetPasswordLink');
    }
    
    public function otpResetPasswordForm() 
    { 
        return view('auth.forgototp');
    }

    public function submitForgetPasswordForm(Request $request, SmsService $smsService)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $commonModel = new CommonModel;

        $email = $request->email;

        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'This email address was not found in our records. Please contact the administrator.');
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        // $otp = '123456'; // Uncomment only for testing

        // Save OTP
        session([
            'otp' => $otp,
            'email' => $email
        ]);

        $user->update([
            'otp' => $otp,
            'is_verify' => 0
        ]);

        // Send OTP SMS
        $smsResponse = $smsService->send(
            'LOGIN_OTP',
            $user->number,
            [
                'OTP' => $otp
            ],
            $user->id
        );

        if ($smsResponse['status'] != 200) {
            return back()->with('error', 'Unable to send OTP. Please try again.');
        }

        if (
            isset($smsResponse['body']) &&
            str_contains(strtolower($smsResponse['body']), 'insufficient')
        ) {
            return back()->with('error', $smsResponse['body']);
        }

        return redirect()
            ->route('resetpasswordotp')
            ->with('message', 'OTP sent successfully to your registered mobile number.');
    }

    public function verifyForgotOtp(Request $request)
    {
        $request->validate([
            'otp_combined' => 'required|digits:6',
            'email' => 'required|exists:users,email',
        ]);

        $email = $request->email;
        $otp = trim($request->otp_combined);

        $user = \App\Models\User::where('email', $email)->first();

        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        // Maximum 5 attempts
        $attemptKey = 'forgot_otp_attempts_' . $user->id . '_' . $request->ip();
        $attempts = Cache::get($attemptKey, 0);

        if ($attempts >= 5) {
            return back()->with('error', 'Too many invalid OTP attempts. Please request a new OTP.');
        }

        if ((string)$user->otp !== (string)$otp) {

            Cache::put(
                $attemptKey,
                $attempts + 1,
                now()->addMinutes(15)
            );

            return back()->with('error', 'Invalid OTP. Please try again.');
        }

        // OTP verified
        Cache::forget($attemptKey);

        $user->update([
            'otp' => null,
            'is_verify' => 1
        ]);

        // Remove old reset tokens
        DB::table('password_resets')
            ->where('email', $email)
            ->delete();

        // Create new token
        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        return redirect()
            ->route('reset.password.get')
            ->with([
                'email' => $email,
                'success' => 'OTP verified successfully.'
            ]);
    }

    public function changePassword(Request $request)
    {
        $commonModel = new CommonModel;
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);
        $data = [
            'password' => Hash::make($request->password)
        ];
        $res = $commonModel->updateDataByOneCondition('users', array('email' => $request->email), $data);
        if($res)
        {
            return back()->with('success', 'Password changed successfully.');
        }
        else
        {
            return back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
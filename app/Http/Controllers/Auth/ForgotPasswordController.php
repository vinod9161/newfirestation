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

    public function submitForgetPasswordForm(Request $request)
    {
        $commonModel = new CommonModel;
        $email = $request->email;
        $userExists = $commonModel->getDataByOneCondition('users', array('email' => $email));
        if(!empty($userExists))
        {
            $otp = '123456'; // For testing only

            // Save OTP to session and DB
            session(['otp' => $otp]);
            session(['email' => $email]);

            \App\Models\User::where('email', $email)->update([
                'otp' => $otp,
            ]);
            return redirect()->route('resetpasswordotp')->with('message', 'OTP sent to your registered contact.');
        }
        else
        {
            return back()->with('error', 'This email address not found in our record. Please contact to admin.');
        }
    }
    public function verifyForgotOtp(Request $request)
    {
        $commonModel = new CommonModel;
        $request->validate([
            'otp_combined' => 'required|digits:6',
            'email' => 'required|exists:users,email',
        ]);

        $otp = $request->input('otp_combined');
        $email = $request->input('email');

        $user = $commonModel->getDataByOneCondition('users', array('email' => $email));
        if($otp == $user[0]->otp)
        {
            $token = Str::random(64);
  
            DB::table('password_resets')->insert([
                'email' => $request->email, 
                'token' => $token, 
                'created_at' => Carbon::now()
            ]);
            // return view('auth.forgetPasswordLink', ['token' => $token, 'email' => $email]);
            return redirect()->route('reset.password.get')->with('email', $email);
        }
        else
        {
            return back()->with('error', 'Invalid OTP. Please try again.');
        }
        
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
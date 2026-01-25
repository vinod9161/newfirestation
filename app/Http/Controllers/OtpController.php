<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    public function sendOtp(Request $request){
        $request->validate([
            'mobile' => 'required|digits:10'
        ]);
        $otp = "123456";
        Session::put('otp', $otp);
        Session::put('otp_expire', now()->addMinutes(2));

        return response()->json([
            'success' => true,
            'otp' => $otp 
        ]);
    }
}

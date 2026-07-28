<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\CaptchaHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use App\Services\SmsService;
use App\Services\TwilioService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            session()->forget(['otp_user_id', 'otp', 'otp_required']);            
            switch ($user->type) {
                case 0:
                case 1:
                case 2:
                case 3:
                case 5:
                    return redirect()->route('admin.dashboard')->with('info', 'You are already logged in.');
                case 4:
                    return redirect()->route('citizen.account')->with('info', 'You are already logged in.');
                case 6:
                    return redirect()->route('agency.account')->with('info', 'You are already logged in.');
                case 7:
                    return redirect()->route('auditor.account')->with('info', 'You are already logged in.');
                default:
                    Auth::logout();
                    session()->flush();
                    return view('auth.login');
            }
        }        
        session()->forget(['otp_user_id', 'otp', 'otp_required']);        
        return view('auth.login');
    }

    // public function login(Request $request)
    // {
    //     $request->session()->regenerate(true);
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required|regex:/^[A-Za-z0-9@. ]+$/',
    //         'password' => 'required',
    //         'captcha'  => 'required|regex:/^[A-Za-z0-9 ]+$/',
    //         '_token'   => 'regex:/^[A-Za-z0-9 ]+$/'
    //     ]);

    //     if ($validator->fails()){
    //         return redirect()->route('login')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
    //     if (Auth::attempt(array($fieldType => $request->username, 'password' => $request->password))) {
    //         $user = Auth::user();
    //         //$otp = rand(100000, 999999);
    //         $otp = '123456';
    //         session(['otp' => $otp]);
    //         session(['otp_user_id' => $user->id]);

    //           \App\Models\User::where('id', $user->id)->update([
    //             'otp' => $otp,
    //         ]);


    //         return redirect()->route('loginotp')->with('message', 'OTP sent to your registered contact.');
    //     }


    //     // if (Auth::attempt(array($fieldType => $request->username, 'password' => $request->password))) {
    //     //     $user = Auth::user();

    //     //     $getIp = $request->ip();

    //     //     $history = $user->user_history ?? [];

    //     //     $history = [
    //     //         'ip' => $getIp,
    //     //         'date' => date('m/d/Y h:i:s a', time())
    //     //     ];

    //     //     if (count($history) > 10) {
    //     //         array_shift($history);
    //     //     }

    //     //     $user->user_history = $history;
    //     //     // $user->update();

    //     //     switch ($user->type) {
    //     //         case '0':
    //     //             return redirect()->route('admin.dashboard');
    //     //         case '1':
    //     //         case '2':
    //     //         case '3':
    //     //         case '5':
    //     //             return redirect()->route('admin.dashboard');
    //     //         case '4':
    //     //             return redirect()->route('citizen.account');
    //     //         case '6':
    //     //             return redirect()->route('agency.account');
    //     //         case '7':
    //     //             return redirect()->route('auditor.account');
    //     //         default:
    //     //             return redirect()->route('login')
    //     //                 ->with('error', 'Invalid user type');
    //     //     }
    //     // } 

    //     else {
    //         return redirect()->route('login')
    //             ->with('error', 'Username And Password Are Wrong.');
    //     }
    // }




    // public function verifyOtp(Request $request)
    // {
    //     $request->validate([
    //         'otp_combined' => 'required|digits:6',
    //         'user_id' => 'required|exists:users,id',
    //     ]);

    //     $otp = $request->input('otp_combined');
    //     $userId = $request->input('user_id');
    //     $user =  \App\Models\User::find($userId);
    //     // echo $otp; die;

    //     if (!$user) {
    //         return redirect()->back()->with('error', 'User not found.');
    //     }

    //     if ($user->otp == $otp) {

    //         \App\Models\User::where('id', $user->id)->update([
    //             'is_verify' => 1,
    //         ]);

    //         session()->regenerate();
    //         Auth::login($user);
    //         return redirect()->route('admin.dashboard')->with('success', 'OTP verified successfully.');
    //     }

    //     return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
    // }

    // public function login(Request $request, TwilioService $twilio)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'username' => 'required|regex:/^[A-Za-z0-9@. ]+$/',
    //         'password' => 'required',
    //         'captcha'  => 'required|regex:/^[A-Za-z0-9 ]+$/',
    //         '_token'   => 'regex:/^[A-Za-z0-9 ]+$/'
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->route('login')
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

    //     if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {

    //         $request->session()->regenerate();

    //         $user = Auth::user();

    //         $response = $twilio->sendOtp('+91' . $user->number);

    //         session(['otp_user_id' => $user->id]);

    //         return redirect()->route('loginotp')
    //             ->with('message', 'OTP sent to your registered mobile.');
    //     }

    //     return redirect()->route('login')
    //         ->with('error', 'Username and Password are incorrect.');
    // }


    // public function verifyOtp(Request $request, TwilioService $twilio)
    // {
    //     $request->validate([
    //         'otp_combined' => 'required|digits:6',
    //     ]);

    //     $otp = $request->otp_combined;

    //     $userId = session('otp_user_id');

    //     if (!$userId) {
    //         return redirect()->route('login')->with('error', 'Session expired. Please login again.');
    //     }

    //     $user = \App\Models\User::find($userId);

    //     if (!$user) {
    //         return redirect()->route('login')->with('error', 'User not found.');
    //     }

    //     $mobile = $user->number;

    //     // $mobile = preg_replace('/\D/', '', $mobile);
    //     // $mobile = preg_replace('/^91/', '', $mobile);
    //     $mobile = '+91' . $mobile;

    //     $response = $twilio->verifyOtp($mobile, $otp);

    //     if (isset($response['status']) && $response['status'] === 'approved') {

    //         $user->update([
    //             'is_verify' => 1,
    //         ]);

    //         session()->regenerate();
    //         Auth::login($user);

    //         session()->forget('otp_user_id');

    //         switch ($user->type) {
    //             case '0':
    //             case '1':
    //             case '2':
    //             case '3':
    //             case '5':
    //                 return redirect()->route('admin.dashboard');

    //             case '4':
    //                 return redirect()->route('citizen.account');

    //             case '6':
    //                 return redirect()->route('agency.account');

    //             case '7':
    //                 return redirect()->route('auditor.account');

    //             default:
    //                 return redirect()->route('login')->with('error', 'Invalid user type.');
    //         }
    //     }

    //     return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
    // }


    public function login(Request $request, SmsService $smsService)
    {
        // Clear any existing session
        session()->forget(['otp_user_id', 'otp', 'otp_required']);
        
        $validator = Validator::make($request->all(), [
            'username' => 'required|regex:/^[A-Za-z0-9@. ]+$/',
            'password' => 'required',
            'captcha'  => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        // CAPTCHA Validation
        if (!CaptchaHelper::validate($request->captcha)) {
            return redirect()->route('login')
                ->with('error', 'Invalid CAPTCHA. Please try again.')
                ->withInput($request->except('captcha'));
        }

        // Rate limiting
        $rateLimitKey = 'login_attempts_' . $request->ip();
        $attempts = Cache::get($rateLimitKey, 0);

        if ($attempts >= 5) {
            return redirect()->route('login')
                ->with('error', 'Too many login attempts. Please try again after 15 minutes.');
        }

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = \App\Models\User::where($fieldType, $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            Cache::put($rateLimitKey, $attempts + 1, now()->addMinutes(15));
            return redirect()->route('login')
                ->with('error', 'Username and Password are incorrect.')
                ->withInput($request->except('password', 'captcha'));
        }

        Cache::forget($rateLimitKey);

        // Generate OTP
        $otp = rand(100000,999999);
        // $otp = '123456'; // testing only

        $user->update([
            'otp' => $otp,
            'is_verify' => '0',
        ]);

        $smsResponse = $smsService->send(
            'LOGIN_OTP',
            $user->number,
            [
                'OTP'=>$otp
            ],
            $user->id
        );

        if ($smsResponse['status'] != 200) {

            return back()->with('error','Unable to send OTP.');
        }

        if (str_contains(strtolower($smsResponse['body']), 'insufficient')) {

            return back()->with('error',$smsResponse['body']);
        }

        session([
            'otp_user_id'=>$user->id
        ]);

        return redirect()->route('loginotp')
                ->with('message','OTP sent successfully.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_combined' => 'required|digits:6',
        ]);

        $userId = session('otp_user_id');

        if (!$userId) {
            return redirect()->route('login')
                ->with('error', 'Session expired. Please login again.');
        }

        $user = \App\Models\User::find($userId);

        if (!$user) {
            session()->forget('otp_user_id');
            return redirect()->route('login')
                ->with('error', 'User not found.');
        }

        $otp = trim($request->otp_combined);

        // Maximum 5 attempts
        $attemptKey = 'otp_attempts_' . $userId . '_' . $request->ip();
        $attempts = Cache::get($attemptKey, 0);

        if ($attempts >= 5) {
            session()->forget('otp_user_id');

            return redirect()->route('login')
                ->with('error', 'Too many invalid OTP attempts. Please login again.');
        }

        // Debug log (remove in production)
        \Log::info('OTP Verification', [
            'user_id' => $user->id,
            'entered_otp' => $otp,
            'db_otp' => $user->otp,
        ]);

        if ((string) $user->otp !== (string) $otp) {

            Cache::put($attemptKey, $attempts + 1, now()->addMinutes(15));

            return back()->with('error', 'Invalid OTP.');
        }

        // OTP verified successfully
        Cache::forget($attemptKey);

        $user->update([
            'otp' => null,
            'is_verify' => '1',
        ]);

        session()->forget('otp_user_id');

        Auth::login($user);

        $request->session()->regenerate();

        switch ($user->type) {
            case 0:
            case 1:
            case 2:
            case 3:
            case 5:
                return redirect()->route('admin.dashboard');

            case 4:
                return redirect()->route('citizen.account');

            case 6:
                return redirect()->route('agency.account');

            case 7:
                return redirect()->route('auditor.account');

            default:
                Auth::logout();

                return redirect()->route('login')
                    ->with('error', 'Invalid user type.');
        }
    }


    public function resendOtp(Request $request, SmsService $smsService)
    {
        // Get user ID from session
        $userId = session('otp_user_id');

        if (!$userId) {
            return response()->json([
                'error' => 'Session expired. Please login again.'
            ], 401);
        }

        // Rate limiting - 60 seconds cooldown
        $resendKey = 'otp_resend_' . $userId;
        $lastResend = \Illuminate\Support\Facades\Cache::get($resendKey);

        if ($lastResend && now()->diffInSeconds($lastResend) < 60) {
            $remaining = 60 - now()->diffInSeconds($lastResend);

            return response()->json([
                'error' => "Please wait {$remaining} seconds before requesting another OTP."
            ], 429);
        }

        // Maximum 5 resends per hour
        $hourlyKey = 'otp_resend_hourly_' . $userId;
        $hourlyCount = \Illuminate\Support\Facades\Cache::get($hourlyKey, 0);

        if ($hourlyCount >= 5) {
            return response()->json([
                'error' => 'Maximum OTP resend limit reached. Please try again after 1 hour.'
            ], 429);
        }

        $user = \App\Models\User::find($userId);

        if (!$user) {
            session()->forget('otp_user_id');

            return response()->json([
                'error' => 'User not found.'
            ], 404);
        }

        // Generate OTP
        $otp = rand(100000, 999999);
        // $otp = '123456'; // Uncomment only for testing

        // Save OTP
        session(['otp' => $otp]);

        $user->update([
            'otp' => $otp,
            'updated_at' => now(),
        ]);

        // Send SMS
        $smsResponse = $smsService->send(
            'LOGIN_OTP',
            $user->number,
            [
                'OTP' => $otp
            ],
            $user->id
        );

        // SMS API failed
        if ($smsResponse['status'] != 200) {
            return response()->json([
                'error' => 'Unable to send OTP. Please try again.'
            ], 500);
        }

        // Insufficient balance or gateway error
        if (isset($smsResponse['body']) &&
            str_contains(strtolower($smsResponse['body']), 'insufficient')) {

            return response()->json([
                'error' => $smsResponse['body']
            ], 500);
        }

        // Update rate limiting
        \Illuminate\Support\Facades\Cache::put(
            $resendKey,
            now(),
            now()->addSeconds(60)
        );

        \Illuminate\Support\Facades\Cache::put(
            $hourlyKey,
            $hourlyCount + 1,
            now()->addHours(1)
        );

        return response()->json([
            'success' => true,
            'message' => 'OTP resent successfully. Please check your registered mobile number.'
        ]);
    }



    public function logout(Request $request)
    {
        session()->flush();    
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    

    public function citizenLogout(Request $request)
    {
        Cache::flush();
        $this->guard()->logout();
        return $this->loggedOut($request) ?: redirect()->route('citizen.login');
    }
    
    protected function guard()
    {
        return Auth::guard('web');
    }
    protected function loggedOut(Request $request)
    {
        //
    }

    public function loginotpForm()
    {
        // Check if session has otp_user_id
        if (!session('otp_user_id')) {
            // If user is already logged in, redirect to dashboard
            if (Auth::check()) {
                $user = Auth::user();
                switch ($user->type) {
                    case '0':
                    case '1':
                    case '2':
                    case '3':
                    case '5':
                        return redirect()->route('admin.dashboard');
                    case '4':
                        return redirect()->route('citizen.account');
                    case '6':
                        return redirect()->route('agency.account');
                    case '7':
                        return redirect()->route('auditor.account');
                    default:
                        return redirect()->route('login');
                }
            }
            return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        }
        
        return view('auth.loginotp');
    }

    public function loginOtpPost(Request $request)
    {
        $otp1 = $request->otp1;
        $otp2 = $request->otp2;
        $otp3 = $request->otp3;
        $otp4 = $request->otp4;
        $finalOtp = $otp1.$otp2.$otp3.$otp4;
        $user_id = $request->user_id;
        // $result = $
    }
}
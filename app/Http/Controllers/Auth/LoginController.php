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

class LoginController extends Controller
{
    public function showLoginForm(){
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



    public function login(Request $request)
    {
        $request->session()->regenerate(true);

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

        // ============ FINAL CAPTCHA VALIDATION ============
        // This uses validate() which CLEARS the CAPTCHA after successful validation
        $enteredCaptcha = $request->captcha;
        
        if (!CaptchaHelper::validate($enteredCaptcha)) {
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

        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
            $user = Auth::user();
            
            Cache::forget($rateLimitKey);
            
            // Generate OTP
            // $otp = rand(100000, 999999);
            $otp = '123456';
            
            session(['otp' => $otp]);
            session(['otp_user_id' => $user->id]);

            // Store in database as backup
            \App\Models\User::where('id', $user->id)->update([
                'otp' => $otp,
                'updated_at' => now(),  // For expiry tracking
            ]);

            return redirect()->route('loginotp')->with('message', 'OTP sent to your registered contact.');
        }
        
        Cache::put($rateLimitKey, $attempts + 1, now()->addMinutes(15));

        return redirect()->route('login')
            ->with('error', 'Username and Password are incorrect.')
            ->withInput($request->except('password', 'captcha'));
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_combined' => 'required|digits:6',
        ]);

        $otp = $request->input('otp_combined');
        $userId = session('otp_user_id');
        // echo $userId; die;

        // if (!$userId) {
        //     return redirect()->route('login')->with('error', 'Session expired. Please login again.');
        // }


        $ip = $request->ip();
        $attemptKey = 'otp_attempts_' . $userId . '_' . $ip;
        $attempts = \Illuminate\Support\Facades\Cache::get($attemptKey, 0);        
        if ($attempts >= 5) {
            session()->forget('otp_user_id');
            return redirect()->route('login')
                ->with('error', 'Too many failed attempts. Please login again after 15 minutes.');
        }

        $user = \App\Models\User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }


        // if ($user->updated_at && now()->diffInMinutes($user->updated_at) > 5) {
        //     session()->forget('otp_user_id');
        //     return redirect()->route('login')
        //         ->with('error', 'OTP expired. Please login again.');
        // }

        if ($user->otp == $otp) {
            \App\Models\User::where('id', $user->id)->update([    
                'is_verify' => 1,
                'otp' => null,  // Clear OTP after use
            ]);
            
            \Illuminate\Support\Facades\Cache::forget($attemptKey);            
            session()->forget('otp_user_id');
            
            session()->regenerate();
            Auth::login($user);

            // Redirect based on user type
            switch ($user->type) {
                case '0': // Admin
                    return redirect()->route('admin.dashboard');
                case '1':
                case '2':
                case '3':
                case '5': // Admin Roles
                    return redirect()->route('admin.dashboard');
                case '4': // Citizen
                    return redirect()->route('citizen.account');
                case '6': // Agency
                    return redirect()->route('agency.account');
                case '7': // Auditor
                    return redirect()->route('auditor.account');
                default:
                    return redirect()->route('login')->with('error', 'Invalid user type.');
            }
        }

        return redirect()->back()->with('error', 'Invalid OTP. Please try again.');
    }


    public function resendOtp(Request $request)
    {
        // ============ FIX: Get user_id from SESSION, NOT from request ============
        $userId = session('otp_user_id');
        
        if (!$userId) {
            return response()->json([
                'error' => 'Session expired. Please login again.'
            ], 401);
        }
        
        // Rate limiting for resend - 60 seconds cooldown
        $resendKey = 'otp_resend_' . $userId;
        $lastResend = \Illuminate\Support\Facades\Cache::get($resendKey);
        
        if ($lastResend && now()->diffInSeconds($lastResend) < 60) {
            $remaining = 60 - now()->diffInSeconds($lastResend);
            return response()->json([
                'error' => "Please wait {$remaining} seconds before requesting another OTP."
            ], 429);
        }
        
        // Limit total resends per hour (max 5)
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
            return response()->json(['error' => 'User not found.'], 404);
        }
        
        // Generate new OTP
        // $otp = rand(100000, 999999); // Use in production
        $otp = '123456'; // For testing only
        
        // Update session and database
        session(['otp' => $otp]);
        $user->update([
            'otp' => $otp,
            'updated_at' => now(),  // Update timestamp for expiry
        ]);
        
        // Store rate limiting data
        \Illuminate\Support\Facades\Cache::put($resendKey, now(), now()->addSeconds(60));
        \Illuminate\Support\Facades\Cache::put($hourlyKey, $hourlyCount + 1, now()->addHours(1));

        return response()->json([
            'message' => 'OTP resent successfully. Please check your mobile.'
        ]);
    }



    public function logout(Request $request)
    {
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
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;

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

    public function login(Request $request)
    {
        $request->session()->regenerate(true);

        $validator = Validator::make($request->all(), [
            'username' => 'required|regex:/^[A-Za-z0-9@. ]+$/',
            'password' => 'required',
            'captcha'  => 'required|regex:/^[A-Za-z0-9 ]+$/',
            '_token'   => 'regex:/^[A-Za-z0-9 ]+$/'
        ]);

        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }

        $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if (Auth::attempt([$fieldType => $request->username, 'password' => $request->password])) {
            $user = Auth::user();

            // Generate OTP
            // $otp = rand(100000, 999999); // Use this in production
            $otp = '123456'; // For testing only

            // Save OTP to session and DB
            session(['otp' => $otp]);
            session(['otp_user_id' => $user->id]);

            \App\Models\User::where('id', $user->id)->update([
                'otp' => $otp,
            ]);

            return redirect()->route('loginotp')->with('message', 'OTP sent to your registered contact.');
        }

        return redirect()->route('login')
            ->with('error', 'Username and Password are incorrect.');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp_combined' => 'required|digits:6',
            'user_id' => 'required|exists:users,id',
        ]);

        $otp = $request->input('otp_combined');
        $userId = $request->input('user_id');

        $user = \App\Models\User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($user->otp == $otp) {
            \App\Models\User::where('id', $user->id)->update([    
                'is_verify' => 1,
            ]);

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



    public function resendOtp(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user =  \App\Models\User::find($request->user_id);

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }
        

        $otp = '123456'; 
        session(['otp' => $otp]);
        session(['otp_user_id' => $user->id]);
        \App\Models\User::where('id', $user->id)->update([
            'otp' => $otp,
        ]);

         try {
            return response()->json(['message' => 'OTP resent successfully.']);
        } catch (\Exception $e) {
            \Log::error('Resend OTP error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send OTP. Try again.'], 500);
        }
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
        return view('auth.loginotp'); // Ensure this view exists
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
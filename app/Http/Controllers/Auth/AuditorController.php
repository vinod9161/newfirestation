<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\User; 
use Illuminate\Support\Facades\Hash;
use App\Models\location\DistrictModel;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuditorController extends Controller
{
    public function __construct()
    {
    }

    public function showAuditorRegisterForm()
    {
        $data['districts'] = DistrictModel::all();
        return view('auth.auditor_register',$data); // Ensure this view exists
    }

    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|regex:/^[A-Za-z0-9@. ]+$/',
            'district_id' => 'required',
            'address'       => 'required',
            'email'       => 'required|unique:users',
            'number'       => 'required|unique:users',
            '_token'   => 'regex:/^[A-Za-z0-9 ]+$/'
        ]);

        if ($validator->fails()) {
            return redirect()->route('auditor.register')
                ->withErrors($validator)
                ->withInput();
        }

        $random_no = rand(10,100);
        $timestamp = time();
        $username = $timestamp.$random_no;

        User::create([
            'name' => $username,
            'name' => $request->name,
            'district_id' => $request->district_id,
            'address' => $request->address,
            'email'         => $request->email,
            'username'         => $username,
            'password' => Hash::make($request->number),
            'type' => '7',
            'number' => $request->number,
        ]);

        $from =  'admin@doonitrix.com';

        $message = "Dear, Agency welcome in <a href='http://fire.doonitrix.com/'>Uttarakhand Fire & Emergency Service</a>. Your signup process is completed. Your username is <b>".$username."</b> and password is <b>".$request->number."</b>. You can login using these details.";

        $name = $username;
        $email = $request->email;

        $subject = 'Signup Confirmation';
        $data = array('name'=>$name, 'body' => 'Signup Confirmation','email' => $email ,'description' => $message);

        try {
            Mail::send(['html' => 'mail_template.mail_template_signup'], $data, function ($message) use ($name, $email, $subject, $from) {
                $message->to($email, $name)
                    ->subject($subject)
                    ->from($from, 'Uttarakhand Fire & Emergency Service');
            });
            return redirect()->route('auth.login')->with('success', 'Your account is created successfully... Please check your email for login details!');
        } 
        catch (\Exception $e)
        {
            return redirect()->route('auth.login')->with('success', 'Your account is created successfully... Error in sending email!');
        }
    }
}
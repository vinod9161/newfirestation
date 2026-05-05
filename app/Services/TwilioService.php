<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TwilioService
{
    protected $sid;
    protected $token;
    protected $verifySid;

    public function __construct()
    {
        $this->sid = config('services.twilio.sid');
        $this->token = config('services.twilio.token');
        $this->verifySid = config('services.twilio.verify_sid');
    }

    public function sendOtp($mobile)
    {
        return Http::asForm()
            ->withBasicAuth($this->sid, $this->token)
            ->withOptions(['verify' => false]) // 👈 ADD THIS LINE
            ->post("https://verify.twilio.com/v2/Services/{$this->verifySid}/Verifications", [
                'To' => $mobile,
                'Channel' => 'sms',
            ])
            ->json();
    }

    public function verifyOtp($mobile, $otp)
    {
        return Http::asForm()
            ->withBasicAuth($this->sid, $this->token)
            ->withOptions(['verify' => false])
            ->post("https://verify.twilio.com/v2/Services/{$this->verifySid}/VerificationCheck", [
                'To' => $mobile,
                'Code' => $otp,
            ])
            ->json();
    }
}
<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SmsService
{
    public function sendOtp($mobile, $otp)
    {
        $message = "Your OTP is $otp. Do not share it with anyone.";

        $response = Http::withHeaders([
            'authorization' => config('services.fast2sms.api_key'),
            'accept' => 'application/json',
        ])->post('https://www.fast2sms.com/dev/bulkV2', [
            "route" => "q",
            "message" => $message,
            "language" => "english",
            "flash" => 0,
            "numbers" => $mobile,
        ]);

        return $response->json();
    }
}
<?php
namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class SecurityLogger
{
    public static function logOtpTampering($userId, $requestedUserId, $ip)
    {
        Log::warning('OTP IDOR ATTEMPT DETECTED', [
            'session_user_id' => $userId,
            'requested_user_id' => $requestedUserId,
            'ip' => $ip,
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown',
            'timestamp' => now()
        ]);
    }
    
    public static function logSuccessfulLogin($user, $ip)
    {
        Log::info('Successful login', [
            'user_id' => $user->id,
            'user_type' => $user->type,
            'email' => $user->email,
            'ip' => $ip
        ]);
    }
    
    public static function logFailedOtpAttempt($userId, $ip, $attemptNumber)
    {
        Log::warning('Failed OTP attempt', [
            'user_id' => $userId,
            'ip' => $ip,
            'attempt_number' => $attemptNumber
        ]);
    }
}
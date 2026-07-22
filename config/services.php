<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'twilio' => [
        'sid' => env('TWILIO_SID'),
        'token' => env('TWILIO_AUTH_TOKEN'),
        'verify_sid' => env('TWILIO_VERIFY_SID'),
    ],

    'fast2sms' => [
        'api_key' => env('FAST2SMS_API_KEY'),
    ],
    
    'sms' => [
        'url'          => env('SMS_API_URL'),
        'username'     => env('SMS_USERNAME'),
        'api_password' => env('SMS_API_PASSWORD'),
        'sender'       => env('SMS_SENDER'),
        'priority'     => env('SMS_PRIORITY', 4),
        'entity_id'    => env('SMS_ENTITY_ID'),
        'template_id'  => env('SMS_TEMPLATE_ID'),
    ],


];

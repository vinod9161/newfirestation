<?php

namespace App\Services;

use App\Models\SmsLog;
use App\Models\SmsTemplate;
use Illuminate\Support\Facades\Http;

class SmsService
{
    public function send(
        string $templateCode,
        string $mobile,
        array $variables = [],
        $userId = null
    ) {

        $template = SmsTemplate::where('template_code',$templateCode)
            ->where('status',1)
            ->first();

        if(!$template){

            return [
                'status'=>500,
                'body'=>'SMS template not found.'
            ];
        }

        $message = $template->message;

        foreach($variables as $key=>$value){

            $message = str_replace('{'.$key.'}', $value, $message);
        }

        try{

            $response = Http::timeout(30)
                ->asForm()
                ->post(config('services.sms.url'),[
                    'username'      => config('services.sms.username'),
                    'api_password'  => config('services.sms.api_password'),
                    'sender'        => $template->sender_id,
                    'to'            => $mobile,
                    'message'       => $message,
                    'priority'      => $template->priority,
                    'result_type'   => 2,
                    'e_id'          => $template->entity_id,
                    't_id'          => $template->template_id,
                ]);

            $messageId = null;

            if($response->successful()){

                /*
                API returns:

                alert_902096772:919xxxxxxxx

                */
                $messageId = trim($response->body());
            }

            SmsLog::create([

                'user_id'=>$userId,
                'mobile'=>$mobile,
                'template_master_id'=>$template->id,
                'message'=>$message,
                'api_response'=>$response->body(),
                'message_id'=>$messageId,
                'status'=>$response->successful()
                        ? 'SUCCESS'
                        : 'FAILED',
                'sent_at'=>now()

            ]);

            return [

                'status'=>$response->status(),
                'body'=>$response->body()

            ];

        }catch(\Exception $e){

            SmsLog::create([

                'user_id'=>$userId,
                'mobile'=>$mobile,
                'template_master_id'=>$template->id,
                'message'=>$message,
                'api_response'=>$e->getMessage(),
                'status'=>'FAILED',
                'sent_at'=>now()

            ]);

            return [

                'status'=>500,
                'body'=>$e->getMessage()

            ];

        }
    }
}
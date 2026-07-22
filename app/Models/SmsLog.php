<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model
{
    protected $fillable = [
        'user_id',
        'mobile',
        'template_master_id',
        'message',
        'api_response',
        'message_id',
        'status',
        'sent_at'
    ];

    public $timestamps = false;

    public function template()
    {
        return $this->belongsTo(SmsTemplate::class,'template_master_id');
    }
}
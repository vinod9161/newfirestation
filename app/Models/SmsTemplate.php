<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SmsTemplate extends Model
{
    protected $fillable = [
        'template_name',
        'template_code',
        'template_id',
        'entity_id',
        'sender_id',
        'priority',
        'message',
        'status'
    ];
}
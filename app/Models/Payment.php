<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'user_id',
        'service_type',
        'service_id',
        'amount',
        'status',
        'transaction_id',
        'order_id',
        'receipt_no',
        'payment_gateway',
        'payment_method',
        'response',
        'failed_reason',
        'paid_at'
    ];

    protected $casts = [
        'response' => 'array',
        'paid_at' => 'datetime'
    ];
}
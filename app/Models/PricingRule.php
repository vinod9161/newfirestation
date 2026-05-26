<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    protected $table = 'pricing_rules';

    protected $fillable = [
        'service_id',
        'min_sq_meter',
        'max_sq_meter',
        'min_height',
        'max_height',
        'min_gathering',
        'max_gathering',
        'min_hours',
        'max_hours',
        'rate',
        'rate_type',
        'processing_fee',
        'cgst_percent',
        'sgst_percent',
        'priority',
        'is_active'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function getTotalGstAttribute()
    {
        return ($this->cgst_percent ?? 0) + ($this->sgst_percent ?? 0);
    }
}
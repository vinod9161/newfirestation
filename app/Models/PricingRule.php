<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    protected $table = 'pricing_rules';

    protected $fillable = [
        'service_id',
        'min_sq_ft','max_sq_ft',
        'min_height','max_height',
        'min_gathering','max_gathering',
        'min_hours','max_hours',
        'rate','rate_type',
        'priority','is_active'
    ];

    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class);
    }
}
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VehicleModel extends Model
{
    use HasFactory;
    protected $table = "fs_vehicles";
    protected $fillable = [
        'id',
        'reg_number',
        'chassis_number',
        'engine_number',
        'district_id',
        'station_id',
        'vehicle_type',
        'make_year',
        'year',
        'capacity',
        'use_date',
        'km_drive',
        'total_invest',
        'total_fire',
        'vehicle_remark',
        'created_at',
        'updated_at',
    ];



    public function district()
    {
        return $this->belongsTo(District::class);
    }

}
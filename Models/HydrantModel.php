<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HydrantModel extends Model
{
    use HasFactory;
    protected $table = "fs_hydrant";
    protected $fillable = [
        'id',
        'district_id',
        'station_id',
        'address_of_water_sources',
        'latitude',
        'longitude',
        'type',
        'hydrant_condition',
        'created_at',
        'updated_at',
    ];
}
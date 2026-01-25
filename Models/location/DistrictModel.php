<?php

namespace App\Models\location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\location\DistrictModel;
use App\Models\Models\Station;


class DistrictModel extends Model
{
    use HasFactory;
    protected $table = "districts";
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'code',
        'state_id',
        'status',
        'created_at',
        'updated_at',
    ];

    public function stations()
    {
        return $this->hasMany(Station::class, 'district_id');
    }
}
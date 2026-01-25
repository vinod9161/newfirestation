<?php

namespace App\Models\location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PanchayatModel extends Model
{
    use HasFactory;
    protected $table = "panchayats";
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'state_id',
        'district_id',
        'tehsil_id',
        'block_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
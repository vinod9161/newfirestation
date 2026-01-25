<?php

namespace App\Models\location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockModel extends Model
{
    use HasFactory;
    protected $table = "blocks";
    protected $fillable = [
        'id',
        'name',
        'image',
        'description',
        'code',
        'state_id',
        'district_id',
        'status',
        'created_at',
        'updated_at',
    ];
}
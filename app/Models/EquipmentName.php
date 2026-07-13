<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentName extends Model
{
    protected $table = 'equipment_name';
    protected $fillable = ['category_id', 'name'];

    public function category()
    {
        return $this->belongsTo(EquipmentCategory::class, 'category_id');
    }
}
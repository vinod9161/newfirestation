<?php

namespace App\Models\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SubCategory extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name','category_id','status',
    ];

    public function type()
    {
        return $this->hasMany(Type::class, 'subcategory_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}

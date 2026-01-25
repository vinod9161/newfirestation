<?php

namespace App\Models\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Type extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name','category_id','subcategory_id','status',
    ];

  
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}

<?php

namespace App\Models\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Category extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name','status',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function subcategory()
    {
        return $this->hasMany(\App\Models\Models\SubCategory::class, 'category_id');
    }

    public function applicattion()
    {
        return $this->hasMany(\App\Models\Models\Application::class, 'category_id');
    }
}

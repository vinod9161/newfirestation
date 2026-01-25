<?php

namespace App\Models\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Project extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name','status',
    ];

    public function category()
    {
        return $this->hasMany(\App\Models\Models\Category::class, 'project_id');
    }
}

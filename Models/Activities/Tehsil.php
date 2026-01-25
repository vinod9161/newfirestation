<?php

namespace App\Models\Activities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Tehsil extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name','district_id','description',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function application()
    {
        return $this->hasMany(\App\Models\Application::class, 'tehsil_id');
    }
}

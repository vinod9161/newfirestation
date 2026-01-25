<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Tehsil extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','district_id','description',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function application()
    {
        return $this->hasMany(\App\Models\Models\Application::class, 'tehsil_id');
    }
}

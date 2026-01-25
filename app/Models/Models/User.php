<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
/**
 * The table associated with the model.
 *
 * @var string
 */
protected $table = 'users';
protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'building_name',
        'address',
        'email',
        'username',
        'role',
        'type',
        'password',
        'number',
        'district_id',
        'station_id',
        'image',
        'status',
        'apuni_sarkar_response',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function standby()
    {
        return $this->hasMany(\App\Models\Models\Standby::class, 'assigned_id');
    }

    public function awareness()
    {
        return $this->hasMany(\App\Models\Models\Standby::class, 'assigned_id');
    }

    public function incident()
    {
        return $this->hasMany(\App\Models\Models\Standby::class, 'assigned_id');
    }

    public function application()
    {
        return $this->hasMany(\App\Models\Models\Application::class, 'assigned_id');
    }
}

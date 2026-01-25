<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class FireReport extends Authenticatable
{
    use Notifiable;

    protected $table = 'fs_fire_report';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = ['id'];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }
}

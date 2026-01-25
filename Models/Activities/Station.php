<?php

namespace App\Models\Activities;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Station extends Authenticatable
{
    use Notifiable;
    protected $table = 'fire_stations';

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

     public function fireReport()
    {
        return $this->hasMany(\App\Models\FireReport::class, 'station_id');
    }

     public function rescueReport()
    {
        return $this->hasMany(\App\Models\Rescue::class, 'station_id');
    }

     public function reliefReport()
    {
        return $this->hasMany(\App\Models\Relief::class, 'station_id');
    }

     public function standby()
    {
        return $this->hasMany(\App\Models\Standby::class, 'station_id');
    }

      public function awareness()
    {
        return $this->hasMany(\App\Models\AwarenessProgram::class, 'station_id');
    }


      public function hydrant()
    {
        return $this->hasMany(\App\Models\Hydrant::class, 'station_id');
    }
}

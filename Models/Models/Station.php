<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Illuminate\Support\Facades\DB;


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

    protected $db;

    public function __construct()
    {
        $this->db  = DB::getFacadeRoot();
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function fireReport()
    {
        return $this->hasMany(\App\Models\Models\FireReport::class, 'station_id');
    }

     public function rescueReport()
    {
        return $this->hasMany(\App\Models\Models\Rescue::class, 'station_id');
    }

     public function reliefReport()
    {
        return $this->hasMany(\App\Models\Models\Relief::class, 'station_id');
    }

     public function standby()
    {
        return $this->hasMany(\App\Models\Models\Standby::class, 'station_id');
    }

      public function awareness()
    {
        return $this->hasMany(\App\Models\Models\AwarenessProgram::class, 'station_id');
    }

      public function hydrant()
    {
        return $this->hasMany(\App\Models\Models\Hydrant::class, 'station_id');
    }


    // custom query
    public function getStationByDistrict($district_id = null)
    {
        $query = Station::select(
            'fire_stations.*', 
            'districts.id as did', 
            'districts.name as dname', 
            'states.id as sid', 
            'states.name as sname'
        )
        ->join('districts', 'fire_stations.district_id', '=', 'districts.id')
        ->join('states', 'districts.state_id', '=', 'states.id');

        if (!empty($district_id)) {
            $query->where('fire_stations.district_id', $district_id);
        }

        return $query->orderBy('fire_stations.id', 'DESC')->get()->toArray();
    }



}

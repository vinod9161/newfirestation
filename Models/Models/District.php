<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class District extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','image','description',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function station()
    {
        return $this->hasMany(\App\Models\Models\Station::class, 'district_id');
    }

    public function tehsil()
    {
        return $this->hasMany(\App\Models\Models\Tehsil::class, 'district_id');
    }

    public function block()
    {
        return $this->hasMany(\App\Models\Models\Block::class, 'district_id');
    }

    public function fireReport()
    {
        return $this->hasMany(\App\Models\Models\FireReport::class, 'district_id');
    }

    public function rescue()
    {
        return $this->hasMany(\App\Models\Models\Rescue::class, 'district_id');
    }

    public function relief()
    {
        return $this->hasMany(\App\Models\Models\Relief::class, 'district_id');
    }

    public function hydrant()
    {
        return $this->hasMany(\App\Models\Models\Hydrant::class, 'district_id');
    }

    public function standby()
    {
        return $this->hasMany(\App\Models\Models\Standby::class, 'district_id');
    }

    public function awarenessProgram()
    {
        return $this->hasMany(\App\Models\Models\AwarenessProgram::class, 'district_id');
    }

    public function incidentReport()
    {
        return $this->hasMany(\App\Models\Models\IncidentReport::class, 'district_id');
    }

    public function home_district()
    {
        return $this->hasMany(\App\Models\Models\Employee::class, 'home_district');
    }

    public function application()
    {
        return $this->hasMany(\App\Models\Models\Application::class, 'district_id');
    }
}

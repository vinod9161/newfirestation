<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class BuildingMap extends Authenticatable
{
    use Notifiable;

    protected $table = 'ct_building_map';

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

}

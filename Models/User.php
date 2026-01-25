<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\location\DistrictModel;
use App\Models\Models\Station;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

 
    protected $table = 'users';
    protected $primaryKey = 'id';
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

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function district()
    {
        return $this->belongsTo(DistrictModel::class, 'district_id');
    }

    public function stations()
    {
        return $this->belongsTo(Station::class, 'district_id');
    }


    public function checkUserExist($where)
    {

        $sql = DB::table('users');
        $sql = $sql->select('*');
        $sql = $sql->where($where);
        $sql = $sql->get();
        $sql = $sql->first();
        return $sql;
    }



}

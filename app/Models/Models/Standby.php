<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Standby extends Authenticatable
{
    use Notifiable;
    protected $table = 'fs_standby_duty_request';

    protected $guarded = ['id'];

    public function district(){
        return $this->belongsTo(District::class);
    }

    public function assigned(){
        return $this->belongsTo(User::class);
    }

    public function station(){
        return $this->belongsTo(Station::class);
    }
    
  
}

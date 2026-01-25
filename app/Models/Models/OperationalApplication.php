<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OperationalApplication extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','application_id','noc_type','application_no','vendor','attachment','challan','remark','step','status','assigned_id','assigned_cfo'
    ];

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function assigned()
    {
        return $this->belongsTo(User::class);
    }
  
}

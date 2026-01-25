<?php

namespace App\Models\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Remark extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name','status',
    ];

}

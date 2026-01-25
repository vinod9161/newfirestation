<?php

namespace App\Models\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class RecentUpdates extends Authenticatable
{

    use Notifiable;

    protected $table = "recentupdates";
}

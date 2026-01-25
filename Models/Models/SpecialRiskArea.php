<?php

namespace App\Models\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class SpecialRiskArea extends Authenticatable
{

    use Notifiable;

    protected $table = "cms_specialriskarea";
}

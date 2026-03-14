<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadershipSection extends Model
{
    use HasFactory;

    protected $table = "leadership_section";

    protected $fillable = [

        'cm_name',
        'cm_designation',
        'cm_image',

        'dgp_name',
        'dgp_designation',
        'dgp_image',

        'subject',
        'content',
        'status'
    ];
}
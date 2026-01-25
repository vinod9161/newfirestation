<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class KeroseneApplication extends Authenticatable
{
    use Notifiable;

    protected $table = 'temp_kerosene_applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','user_id','application_no','noc_type','applicant_type','district_id','applicant_detail','applicant_address','organizing_address','orgnizer_contact_detail','erector_contact_detail','coordinator_contact_detail','project_area_detail','attachments','assigned_id','status','fso_approve_date','cfo_approve_date','cfo_signature','sfo_signature','cfo_name','fso_name',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}

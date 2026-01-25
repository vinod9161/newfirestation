<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireReport extends Model
{
    use HasFactory;
    protected $table = 'fs_fire_report';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id','user_id', 'fire_report_no', 'monthly_no', 'district_id', 'station_id', 'fire_incident_datetime', 'informer_name','informer_contact_no','info_medium','incident_address','info_datetime','station_depart_datetime','fire_site_arrive_datetime','station_return_datetime','personals_detail','vehicle_id','pumping_km'
        ,'distance','distance','category','fire_class','fire_area','fire_area_type','insured','fire_reason','arson_based','property_lost','property_saved','life_lost_human','life_saved_human','life_lost_animal','life_saved_animal','short_description','cfo','fso','fsso','lfm','dvr','fm','created_by','assigned_to','approved_by','status','uploa','remark'
    ];
}

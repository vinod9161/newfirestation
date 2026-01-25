<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ReliefReportModel extends Model
{
    protected $table = 'fs_relief_work_report';

    protected $fillable = [
        'id',
        'relief_report_no',
        'monthly_no',
        'incident_datetime',
        'district_id',
        'station_id',
        'informer_name',
        'informer_contact_no',
        'info_medium',
        'incident_address',
        'info_datetime',
        'station_depart_datetime',
        'site_arrive_datetime',
        'station_return_datetime',
        'personals_detail',
        'vehicle_id',
        'pumping_km',
        'distance',
        'owner_name',
        'owner_address',
        'relief_work_area',
        'relief_work_type',
        'relief_work_reason',
        'arson_based',
        'arson_based',
        'description',
        'cfo',
        'fso',
        'fsso',
        'lfm',
        'dvr',
        'fm',
        'created_by',
        'assigned_to',
        'approved_by',
        'status',
        'upload',
        'remark',
        'created_at',
        'updated_at'
    ];

    public function station()
    {
        return $this->belongsTo(\App\Models\Models\Station::class);
    }


    public function district()
    {
        return $this->belongsTo(\App\Models\Models\District::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(\App\Models\Models\Vehicle::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\VehicleCategory;

class ServiceBillVehicle extends Model
{
    protected $table='service_bill_vehicles';

    protected $guarded=['id'];

    public function vehicle()
    {
        return $this->belongsTo(
            VehicleCategory::class,
            'vehicle_type_id'
        );
    }
}
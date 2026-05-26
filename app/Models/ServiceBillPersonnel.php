<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceBillPersonnel extends Model
{
    protected $table='service_bill_personnels';

    protected $guarded=['id'];

    public function designation()
    {
        return $this->belongsTo(
            DesignationMaster::class,
            'designation_id'
        );
    }
}
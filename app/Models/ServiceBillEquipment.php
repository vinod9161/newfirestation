<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\EquipmentCategory;

class ServiceBillEquipment extends Model
{
    protected $table='service_bill_equipments';

    protected $guarded=['id'];

    public function equipment()
    {
        return $this->belongsTo(
            EquipmentCategory::class,
            'equipment_category_id'
        );
    }
}
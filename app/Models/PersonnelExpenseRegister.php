<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonnelExpenseRegister extends Model
{
    protected $table='personnel_expense_register';

    protected $fillable=[
        'designation_id',
        'monthly_basic_expense',
        'da_percent'
    ];

    public function designation()
    {
        return $this->belongsTo(
            DesignationMaster::class,
            'designation_id'
        );
    }
}
<?php 
namespace App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class EmployeeModel extends Model
{
    use HasFactory;
    protected $table = 'fs_employee';
    protected $fillable = [
        'id',
        'employee_code',
        'designation',
        'name_in_hindi',
        'father_name',
        'date_of_birth',
        'name',
        'mobile',
        'email',
        'address',
        'date_of_retirement',
        'education',
        'departmental_course',
        'district_id',
        'home_district',
        'recruitment_district',
        'entry_level',
        'station_id',
        'previous_posting',
        'remark',
        'gender',
        'category',
        'status',
        'date_of_recuirtment',
        'created_at',
        'updated_at',

    ];
}
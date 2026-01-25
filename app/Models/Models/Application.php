<?php

namespace App\Models\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class Application extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','application_no','noc_type','application_type','building_name','building_ownership','gst_pan_tan','project_id','category_id','subcategory_id','type_id','project_status','latitude','longitude','email','mobile_no','office_telephone','district_id','rural_urban','tehsil_id','block_id','panchayat_id','plot_khasra_khatauni','plot_khasra_khatauni_no','street','village','city','landmark','pincode','proprietary_rights','owner_detail','contact_person','architect_detail','total_plot_area','total_covered_area','ground_floor_covered','max_height','no_of_floor','basement_covered_area','no_of_basement','no_of_blocks','tallest_block_height','distance_bw_block','approach_road_width','provision_no_enterance','provision_no_exit','occupancy_detail','set_back_detail','ess_provision_detail','attachments','physical_ins','fire_provission','building_status','special_provission','fso_approve_date','cfo_approve_date','dd_approve_date','fso_signature','cfo_signature','dd_signature','fso_name','cfo_name','dd_name',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function panchayat()
    {
        return $this->belongsTo(Panchayat::class);
    }

    public function tehsil()
    {
        return $this->belongsTo(Panchayat::class);
    }

    public function assigned()
    {
        return $this->belongsTo(User::class);
    }

    public function operational_applications()
    {
        return $this->hasOne(\App\Models\Models\OperationalApplication::class, 'application_id');
    }

    public function renewal_applications()
    {
        return $this->hasOne(\App\Models\Models\RenewalApplication::class, 'application_id');
    }
  
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactModel extends Model
{
    use HasFactory;
    protected  $table = "tbl_contact";
    protected  $primaryKey = "id";    
    protected $fillable = ['id','email', 'phone', 'address', 'map','created_at','updated_at'];
}

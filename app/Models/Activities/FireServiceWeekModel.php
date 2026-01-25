<?php
namespace App\Models\Activities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FireServiceWeekModel extends Model
{
    use HasFactory;

    protected $table = 'fire_events';
    protected $primaryKey = 'id';
    protected $guarded = [];
    public $timestamps = false;
}

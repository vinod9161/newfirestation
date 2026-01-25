<?php

namespace App\Models\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CategoryModel extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name', 'project_id', 'description'];

    protected $db;
    protected $tbl;

    public function __construct()
    {
        $this->db  = DB::getFacadeRoot();
        $this->tbl = 'categories';
    }


    public function getCategory(){
        return $this->db->table('categories')
                        ->select('categories.*','projects.name as project_name')
                        ->join('projects', 'categories.project_id', '=', 'projects.id')
                        ->orderBy('categories.id', 'DESC')
                        ->get()
                        ->toArray();
    }

    public function getProjects()
    {
        return $this->db->table('projects')
                        ->select('*')
                        ->orderBy('id','DESC')
                        ->get()
                        ->toArray();
    }

    public function getCategoryById($id)
    {
        return $this->db->table('categories')
                        ->select('*')
                        ->where('id',$id)
                        ->first();
    }

    public function insertData(array $data)
    {
        return $this->db->table($this->tbl)->insert($data);
    }

    public function updateData($where, $data)
    {
        return $this->db->table($this->tbl)->where($where)->update($data);
    }

    public function deleteData($id)
    {
        return $this->db->table($this->tbl)->where('id', $id)->delete();
    }
}

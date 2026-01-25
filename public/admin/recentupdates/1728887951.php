<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CommonModel extends Model
{
    use HasFactory;

    protected $db;
    protected $tbl;

    public function __construct()
    {
        $this->db  = DB::getFacadeRoot();
    }
    public function getData($tbl)
    {
        return $this->db->table($tbl)->select('*')->get()->toArray();
    }
    public function getDataByOneCondition($tbl,$where)
    {
        return $this->db->table($tbl)->select('*')->where($where)->get()->toArray();
    }
    public function getDataByTwoCondition($tbl,$where,$where1)
    {
        return $this->db->table($tbl)->select('*')->where($where)->where($where1)->get()->toArray();
    }
    public function getDataByThreeCondition($tbl,$where,$where1,$where2)
    {
        return $this->db->table($tbl)->select('*')->where($where)->where($where1)->where($where2)->get()->toArray();
    }
    public function insertData($tbl, $data)
    {
        return $this->db->table($tbl)->insert($data);
    }
    public function updateDataByOneCondition($tbl, $where, $data)
    {
        return $this->db->table($tbl)->where($where)->update($data);
    }
    public function updateDataByTwoCondition($tbl, $where, $where1, $data)
    {
        return $this->db->table($tbl)->where($where)->where($where1)->update($data);
    }
    public function updateDataByThreeCondition($tbl, $where, $where1, $where2, $data)
    {
        return $this->db->table($tbl)->where($where)->where($where1)->where($where2)->update($data);
    }
    public function deleteDataByOneCondition($tbl, $where)
    {
        return $this->db->table($tbl)->where($where)->delete();
    }
    public function deleteDataByTwoCondition($tbl, $where, $where1)
    {
        return $this->db->table($tbl)->where($where)->where($where1)->delete();
    }
    public function deleteDataByThreeCondition($tbl, $where, $where1, $where2)
    {
        return $this->db->table($tbl)->where($where)->where($where1)->where($where2)->delete();
    }
}

<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FilterModel extends Model
{
    use HasFactory;

    protected $db;
    protected $tbl;

    public function __construct()
    {
        $this->db  = DB::getFacadeRoot();
    }
    

    public function countFilterData($tbl, $fields)
    {
        $dateColumn = $fields['date_column'] ?? null;
        $descColumn = $fields['desc_column'] ?? null;
        // $search = $fields['search'] ?? '';
        // if (!is_string($search))
        // {
        //     $search = '';
        // }
        $query = DB::table($tbl);
        $query->select(DB::raw('COUNT(' . $descColumn . ') AS total_count'));
        if (!empty($fields) && is_array($fields))
        {
            $hasConditions = false;
            $columnNames = Schema::getColumnListing($tbl);
            // if (!empty($search))
            // {
            //     $query->where(function($q) use ($columnNames, $search)
            //     {
            //         foreach ($columnNames as $column)
            //         {
            //             $q->orWhere($column, 'LIKE', '%' . $search . '%');
            //         }
            //     });
            //     $hasConditions = true;
            // }
            foreach ($fields as $key => $field)
            {
                if (!empty($key) && !is_null($field) && !empty($field))
                {
                    if ($key == 'date')
                    {
                        if (is_array($field) && isset($field['start']) && isset($field['end']))
                        {
                            $startDate = $field['start'];
                            $endDate = $field['end'];
                            if ($dateColumn && !empty($startDate) && !empty($endDate))
                            {
                                $query->where($dateColumn, '>=', $startDate);
                                $query->where($dateColumn, '<=', $endDate);
                                $hasConditions = true;
                            }
                        }
                    }
                    elseif($key == 'status')
                    {
                        foreach($field as $key => $stat)
                        {
                            if($stat == 'incomplete')
                            {
                                $query->where('status', '!=', $stat);
                            }
                            else
                            {
                                $query->where('status', '=', $stat);
                            }
                        }
                    }
                    elseif ($field != "" && $key != "date_column" && $key != "desc_column" && $key != "search" && $key != 'status')
                    {
                        $query->where($key, $field);
                        $hasConditions = true;
                    }
                }
            }
            if (!$hasConditions) {
                return $query->get()->toArray();
            }
        }
        return $query->first()->total_count ?? 0;
    }
    public function filterAllData($tbl, $fields, $perPage = null, $offset = null)
    {

        $dateColumn = $fields['date_column'] ?? null;
        $descColumn = $fields['desc_column'] ?? null;
        $query = DB::table($tbl);

        
        if (!empty($fields) && is_array($fields))
        {
            $hasConditions = false;
            $columnNames = Schema::getColumnListing($tbl);
            // if (!empty($search))
            // {
            //     $query->where(function($q) use ($columnNames, $search)
            //     {
            //         foreach ($columnNames as $column)
            //         {
            //             $q->orWhere($column, 'LIKE', '%' . $search . '%');
            //         }
            //     });
            //     $hasConditions = true;
            // }
            foreach ($fields as $key => $field)
            {
                if (!empty($key) && !is_null($field) && !empty($field))
                {
                    if ($key == 'date')
                    {
                        if (is_array($field) && isset($field['start']) && isset($field['end']))
                        {
                            $startDate = $field['start'];
                            $endDate = $field['end'];
                            if ($dateColumn && !empty($startDate) && !empty($endDate))
                            {
                                $query->where($dateColumn, '>=', $startDate);
                                $query->where($dateColumn, '<=', $endDate);
                                $hasConditions = true;
                            }
                        }
                    }
                    elseif($key == 'status')
                    {
                        foreach($field as $key => $stat)
                        {
                            if($stat == 'incomplete')
                            {
                                $query->where('status', '!=', $stat);
                            }
                            else
                            {
                                $query->where('status', '=', $stat);
                            }
                        }
                    }
                    elseif ($field != "" && $key != "date_column" && $key != "desc_column" && $key != "search" && $key != 'status')
                    {
                        $query->where($key, $field);
                        $hasConditions = true;
                    }
                }
            }
            if (!$hasConditions) {
                return $query->get()->toArray();
            }
        }

        $perPage = is_numeric($perPage) ? (int)$perPage : 10;
        $offset = is_numeric($offset) ? (int)$offset : 0;

        if ($descColumn) {
            $query->orderBy($descColumn, 'DESC');
        }
        return $query->paginate($perPage, ['*'], 'page', $offset / $perPage + 1);
    }

    public function updateDataByOneCondition($tbl, $where, $data)
    {
        try {
            $exists = DB::table($tbl)->where($where)->exists();
            if (!$exists) {
                return 0;
            }
            DB::table($tbl)->where($where)->update($data);
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }

}

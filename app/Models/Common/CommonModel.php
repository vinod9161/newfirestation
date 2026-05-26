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
        return $this->db->table($tbl)->select('*')->orderBy('id', 'desc')->get()->toArray();
    }

    // public function getDataWithJoin($table, $joins = [], $fields = ['*'])
    // {
    //     try {
    //         $query = DB::table($table);
    //         foreach ($joins as $join) {
    //             $query->leftJoin($join[0], $join[1], $join[2], $join[3]);
    //         }
    //         $query->select($fields);
    //         return $query->get();
    //     } catch (\Exception $e){
    //         Log::error('Error in getDataWithJoin: ' . $e->getMessage());
    //         return collect();
    //     }
    // }


    public function getFireCallCount($filters = [])
{
    $query = DB::table('fire_calls');

    if (!empty($filters)) {
        foreach ($filters as $key => $value) {
            $query->where($key, $value);
        }
    }

    return $query->count();
}



    public function getDataWithJoin($table, $joins = [], $fields = ['*'], $where = [])
    {
        try {
            $query = DB::table($table);

            // Apply Joins
            foreach ($joins as $join) {
                if (count($join) === 4) {
                    $query->leftJoin($join[0], $join[1], $join[2], $join[3]);
                }
            }

            // Apply Where Conditions
            foreach ($where as $key => $value) {
                $query->where($key, $value);
            }

            return $query->select($fields)->get();
        } catch (\Exception $e) {
            Log::error('Error in getDataWithJoin: ' . $e->getMessage());
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    public function countWhere(string $table, array $where): int
    {
        return DB::table($table)->where($where)->count();
    }


    public function getVehicleCountByDistrict()
{
    return DB::table('fs_vehicles as v')  // ✅ correct aliasing
        ->join('districts as d', 'd.id', '=', 'v.district_id') // ✅ fix join
        ->select('d.name as district', DB::raw('COUNT(*) as total')) // ✅ correct aliasing
        ->groupBy('v.district_id', 'd.name') // ✅ both needed in groupBy
        ->orderBy('d.name')
        ->get();
}

public function getMonthlyReport($table, $dateColumn)
{
    return $this->db->table($table)
        ->select("MONTH($dateColumn) AS month, COUNT(*) AS count")
        ->groupBy("MONTH($dateColumn)")
        ->orderBy("MONTH($dateColumn)", 'ASC')
        ->get()
        ->getResultArray();
}



public function getMonthlyCounts($table, $dateColumn)
{
    return DB::table($table)
        ->select(DB::raw("MONTH($dateColumn) as month"), DB::raw("COUNT(*) as total"))
        ->groupBy(DB::raw("MONTH($dateColumn)"))
        ->orderBy(DB::raw("MONTH($dateColumn)"))
        ->get();
}


public function getAwarenessProgramCounts()
{
    return DB::table('fs_awareness_program_request')
        ->select('program_type as type', DB::raw('COUNT(*) as count')) // Adjust column names as necessary
        ->groupBy('program_type')
        ->get();
}



public function getNOCStatusCounts()
{
    return DB::table('applications')
        ->select('status', DB::raw('COUNT(*) as count')) // Count applications by status
        ->groupBy('status')
        ->get();
}
public function getPendingApplicationCounts()
{
    return DB::table('applications')
        ->select(
            DB::raw('
                CASE 
                    WHEN DATEDIFF(NOW(), created_at) BETWEEN 0 AND 5 THEN "0-5 दिन"
                    WHEN DATEDIFF(NOW(), created_at) BETWEEN 6 AND 10 THEN "6-10 दिन"
                    WHEN DATEDIFF(NOW(), created_at) BETWEEN 11 AND 15 THEN "11-15 दिन"
                    WHEN DATEDIFF(NOW(), created_at) BETWEEN 16 AND 20 THEN "16-20 दिन"
                    WHEN DATEDIFF(NOW(), created_at) BETWEEN 21 AND 25 THEN "21-25 दिन"
                    WHEN DATEDIFF(NOW(), created_at) BETWEEN 26 AND 30 THEN "26-30 दिन"
                    ELSE "31 दिन से अधिक"
                END as `range`,  -- Escape the alias with backticks
                count(*) as count
            ')
        )
        ->where('status', 'PENDING')
        ->groupBy('range')
        ->get();
}



    public function getDataByOneCondition($tbl, $where){
        return $this->db->table($tbl)->select('*')->where($where)->orderBy('id', 'desc')->get()->toArray();
    }



    public function getDataByTwoCondition($tbl, $where, $where1){
        return $this->db->table($tbl)->select('*')->where($where)->where($where1)->orderBy('id', 'desc')->get()->toArray();
    }


    public function getDataByThreeCondition($tbl, $where, $where1, $where2){
        return $this->db->table($tbl)->select('*')->where($where)->where($where1)->where($where2)->orderBy('id', 'desc')->get()->toArray();
    }


    public function insertData($tbl, $data){
        return $this->db->table($tbl)->insert($data);
    }



    public function updateData($tbl, $where, $data)
    {
        // try {
        //     $exists = DB::table($tbl)->where($where)->exists();
        //     if (!$exists) {
        //         return '0'; // Not found
        //     }

        //     $updated = DB::table($tbl)->where($where)->update($data);

        //     if ($updated) {
        //         return '1'; // Updated successfully
        //     } else {
        //         return '2'; // No changes made
        //     }
        // } catch (\Exception $e) {
        //     // Optionally log the error: Log::error($e->getMessage());
        //     return '0'; // Error occurred
        // }

        $sql = DB::table($tbl)->where($where)->update($data);
        return $sql;
    }



    public function updateDataByOneCondition($tbl, $where, $data){
        $response = '0';
        try {
            $exists = DB::table($tbl)->where($where)->exists();
            if (!$exists || !isset($exists)) {
                return $response;
            }
            DB::table($tbl)->where($where)->update($data);
            $response = '1';
            return $response;
        } 
        catch (\Exception $e) {
            return $response;
        }
    }

 


    public function updateDataByTwoCondition($tbl, $where, $where1, $data){
        $response = '0';
        try {
            $exists = DB::table($tbl)->where($where)->where($where1)->exists();
            if (!$exists) {
                return $response;
            }
            DB::table($tbl)->where($where)->where($where1)->update($data);
            $response = '1';
            return $response;
        } catch (\Exception $e) {
            return $response;
        }
    }

    
    public function updateDataByThreeCondition($tbl, $where, $where1, $where2, $data)
    {
        $response = '0';
        try {
            $exists = DB::table($tbl)->where($where)->where($where1)->where($where2)->exists();
            if (!$exists) {
                return $response;
            }
            DB::table($tbl)->where($where)->where($where1)->where($where2)->update($data);
            $response = '1';
            return $response;
        } catch (\Exception $e) {
            return $response;
        }
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

    // join
    public function getDataByTwoTable($tbl, $tbl2, $col, $col2, $name, $asname)
    {

        return $this->db->table($tbl)
            ->select("$tbl.*", "$tbl2.$name as $asname")
            ->join($tbl2, "$tbl2.$col2", '=', "$tbl.$col")
            ->orderBy("$tbl.$col", 'DESC')
            ->orderBy("$tbl.id", 'desc')
            ->get()
            ->toArray();
    }

    public function getTypes()
    {
        return $this->db->table('types')
            ->select('types.*', 'categories.name as category_name', 'sub_categories.name as subcategory_name')
            ->join('categories', 'categories.id', '=', 'types.category_id')
            ->join('sub_categories', 'sub_categories.id', '=', 'types.subcategory_id')
            ->orderBy('types.id', 'DESC')
            ->get()
            ->toArray();
    }
    public function getDataByDoDont($user_id)
    {
        return $this->db->table('ct_do_and_donts')
            ->select("*")
            ->where("user_id", $user_id)
            ->orderBy("created_at", 'DESC')
            ->limit("1")
            ->get()
            ->toArray();
    }
    public function getDataByOneConditionOneLimit($tbl, $where, $limit)
    {
        return $this->db->table($tbl)->select('*')->where($where)->orderBy('id', 'DESC')->limit($limit)->get()->toArray();
    }
    public function getDataByTwoConditionOneLimit($tbl, $where, $where1, $limit)
    {
        return $this->db->table($tbl)->select('*')->where($where)->where($where1)->orderBy('id', 'DESC')->limit($limit)->get()->toArray();
    }
    public function getDataByOneConditionDesc($tbl, $where, $column, $orderType)
    {
        return $this->db->table($tbl)->select('*')->where($where)->orderBy($column, $orderType)->get()->toArray();
    }
    public function getDataByTwoConditionDesc($tbl, $where, $where1, $column, $orderType)
    {
        return $this->db->table($tbl)->select('*')->where($where)->where($where1)->orderBy($column, $orderType)->get()->toArray();
    }
    public function lastInsertData($tbl, $data)
    {
        return $this->db->table($tbl)->insertGetId($data);
    }
    protected function compareMultipleData($tbl, $data)
    {
        $where = [];
        foreach ($data as $key => $value) {
            if ($key !== 'id') {
                $where[$key] = $value;
            }
        }
        return $this->db->table($tbl)->select('*')->where($where)->get()->toArray();
    }

    public function getDataByDesc($tbl, $column, $orderType)
    {
        return $this->db->table($tbl)->select('*')->orderBy($column, $orderType)->get()->toArray();
    }


    // public function getAllStationByDistrict()
    // {
    //     $sql = $this->db->table('districts')
    //                     ->select('*')
    //                     ->orderBy('id','desc')
    //                     ->get()
    //                     ->toArray();

    //     if(!empty($sql))
    //     {
    //         foreach($sql as $key => $row)
    //         {
    //             $qry = $this->db->table('fire_stations')
    //                             ->select('*')
    //                             ->where('district_id',$row->id??'')
    //                             ->orderBy('id','desc')
    //                             ->get()
    //                             ->toArray();
    //         }

    //         if(!empty($qry))
    //         {   
    //             return $qry;
    //         }
    //         else{
    //             return 'N';
    //         }
    //     }
    //     else{
    //         return 'N';
    //     }                
    // }

    public function getAllStationByDistrict()
    {
        $districts = $this->db->table('districts')
            ->select('id', 'name')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        if (empty($districts)) {
            return 'N'; // No districts found
        }

        $result = [];

        foreach ($districts as $district) {
            $fireStations = $this->db->table('fire_stations')
                ->select('id', 'name', 'fs_contact_no', 'fs_mobile_no', 'fs_email_address')
                ->where('district_id', $district->id)
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();

            $result[] = [
                'district'     => $district,
                'fireStations' => $fireStations
            ];
        }

        return $result;
    }

    public function getStaffStrengthByDistricts()
    {
        $districts = $this->db->table('districts')
            ->select('id', 'name')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        if (empty($districts)) {
            return 'N'; // No districts found
        }

        $result = [];

        foreach ($districts as $district) {
            $fireStations = $this->db->table('fire_stations')
                ->select('sum(fire_station_officer) as total_fso', 'sum(fire_station_officer_avail) as total_fso_avail', 'sum(fire_station_second_officer) as total_fsso', 'sum(fire_station_second_officer_avail) as total_fsso_avail',)
                ->where('district_id', $district->id)
                ->orderBy('id', 'asc')
                ->get()
                ->toArray();

            $result[] = [
                'district'     => $district,
                'fireStations' => $fireStations
            ];
        }

        return $result;
    }


    // awerness program

    public function getAwarenessProgramByDistrict()
    {
        // $districts = $this->db->table('districts')
        //                     ->select('id','name')
        //                     ->orderBy('id', 'asc')
        //                     ->get()
        //                     ->toArray();

        // if (empty($districts)) {
        //     return 'N'; // No districts found
        // }

        // $result = [];

        // foreach ($districts as $district) 
        // {

        //     $fs_awareness_program_request = $this->db->table('fs_awareness_program_request')
        //                             ->select('*')
        //                             ->where('district_id', $district->id??'')
        //                             ->orderBy('id', 'asc')
        //                             ->get()
        //                             ->toArray();

        //     $result[] = [
        //         'district'     => $district??'',
        //         'awarenessProgram' => $fs_awareness_program_request??''
        //     ];
        // }

        // return $result;


        $builder = $this->db->table('districts as d');
        $builder->select([
            'd.name AS district_name',
            DB::raw('SUM(CASE WHEN ap.program_type = "mock drills" THEN 1 ELSE 0 END) AS mock_drills_count'),
            DB::raw('SUM(CASE WHEN ap.program_type = "awareness program" THEN 1 ELSE 0 END) AS awareness_program_count'),
            DB::raw('SUM(CASE WHEN ap.program_type = "training" THEN 1 ELSE 0 END) AS training_count'),
            DB::raw('SUM(ap.crowd_size) AS total_crowd_size')
        ]);
        $builder->leftJoin('fs_awareness_program_request as ap', 'd.id', '=', 'ap.district_id');
        $builder->groupBy('d.id', 'd.name');
        $builder->orderByRaw('CASE WHEN d.name = "Other" THEN 1 ELSE 0 END, d.id ASC');

        return $builder->get()->toArray();
    }


    //     public function getVehicleData()
    //     {
    //         $sql = DB::table('districts')
    //                 ->select([
    //                     'districts.id',
    //                     'districts.name',
    //                     'fs_vehicles.vehicle_type',
    //                     'vehicle_types.type',
    //                     'SUM(vehicle_type) AS vehicle_type_count'
    //                 ])
    //                 ->leftJoin('fs_vehicles', 'districts.id', '=', 'fs_vehicles.district_id') // Corrected JOIN syntax
    //                 ->leftJoin('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id') // Corrected JOIN syntax
    //                 ->whereIn('vehicle_types.id', [1,2,3,4,5,6,7,8,9,11,16,17]) // Corrected whereIn syntax
    //                 ->orderBy('districts.id', 'asc')
    //                 ->get()
    //                 ->toArray(); // Correct way to convert collection to array

    //         return $sql;
    // }

    // public function getVehicleData()
    // {
    //     // $sql = DB::table('districts')
    //     //     ->select([
    //     //         'districts.id as district_id',
    //     //         'districts.name as district_name',
    //     //         'fs_vehicles.vehicle_type',
    //     //         'vehicle_types.type as vehicle_type_name',
    //     //         DB::raw('COUNT(fs_vehicles.id) AS vehicle_type_count') // Count vehicles per type
    //     //     ])
    //     //     ->leftJoin('fs_vehicles', 'districts.id', '=', 'fs_vehicles.district_id')
    //     //     ->leftJoin('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')
    //     //     ->whereIn('vehicle_types.id', [1,2,3,4,5,6,7,8,9,11,16,17])
    //     //     ->groupBy('districts.id', 'districts.name', 'fs_vehicles.vehicle_type', 'vehicle_types.type')
    //     //     ->orderBy('districts.id', 'asc')
    //     //     ->get()
    //     //     ->toArray(); 

    //     // return $sql;

    //     $qry='';

    //     $sql = $this->db->table('districts')
    //                     ->select('id','name')
    //                     ->orderBy('id','desc')
    //                     ->get()
    //                     ->toArray();


    //     foreach($sql as $key $row)
    //     {
    //         $qry = $this->db->table('fs_vehicles')
    //                         ->select('fs_vehicles.vehicle_type','vehicle_types.type as vehicle_type_name')
    //                         ->leftJoin('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')
    //                         ->where('fs_vehicles.district_id', $row['id']??'')
    //                         ->whereInwhereIn('vehicle_types.id', [1,2,3,4,5,6,7,8,9,11,16,17])
    //                         ->orderBy('fs_vehicles.id', 'asc')
    //                         ->get()
    //                         ->toArray();

    //     }                

    //     return $qry;


    // }


    // public function getVehicleData()
    // {
    //     $qry = []; // Initialize $qry as an array

    //     $districts = $this->db->table('districts')
    //                         ->select('id', 'name')
    //                         ->orderBy('id', 'desc')
    //                         ->get()
    //                         ->toArray();

    //     foreach ($districts as $row) // Corrected the foreach syntax
    //     {
    //         $vehicles = $this->db->table('fs_vehicles')
    //                             ->select('fs_vehicles.vehicle_type', 'vehicle_types.type as vehicle_type_name')
    //                             ->leftJoin('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')
    //                             ->where('fs_vehicles.district_id', $row->id ?? '')
    //                             ->whereIn('vehicle_types.id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 16, 17]) // Fixed method name
    //                             ->orderBy('fs_vehicles.id', 'asc')
    //                             ->get()
    //                             ->toArray();

    //         // Merge the results into $qry
    //         $qry = array_merge($qry, $vehicles);
    //     }

    //     return $qry; // Return the accumulated results
    // }


    public function getVehicleData()
    {
        $qry = []; // Initialize $qry as an array

        $districts = $this->db->table('districts')
            ->select('id', 'name')
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();

        foreach ($districts as $row) // Corrected the foreach syntax
        {
            $vehicles = $this->db->table('fs_vehicles')
                ->select(
                    'fs_vehicles.vehicle_type',
                    'vehicle_types.type as vehicle_type_name',
                    'fs_vehicles.district_id', // Include district_id
                    DB::raw("'{$row->name}' as district_name") // Include district_name
                )
                ->leftJoin('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')
                ->where('fs_vehicles.district_id', $row->id ?? '')
                ->whereIn('vehicle_types.id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 11, 16, 17]) // Fixed method name
                ->orderBy('fs_vehicles.district_id', 'desc')
                ->get()
                ->toArray();

            // Merge the results into $qry
            $qry = array_merge($qry, $vehicles);
        }

        return $qry; // Return the accumulated results
    }


    // public function getVehicleData()
    // {
    //     $builder = $this->db->table('districts as d');

    //     $builder->select([
    //         'd.id AS district_id', // Include district_id
    //         'd.name AS district_name',
    //         DB::raw('COUNT(fs_vehicles.id) AS total_vehicles'), // Count of vehicles per district
    //         DB::raw('SUM(CASE WHEN fs_vehicles.vehicle_type = 1 THEN 1 ELSE 0 END) AS vehicle_type_1_count'), // Example for vehicle type 1
    //         DB::raw('SUM(CASE WHEN fs_vehicles.vehicle_type = 2 THEN 1 ELSE 0 END) AS vehicle_type_2_count'), // Example for vehicle type 2
    //         // Add more vehicle types as needed
    //     ]);

    //     $builder->leftJoin('fs_vehicles', 'd.id', '=', 'fs_vehicles.district_id');
    //     $builder->groupBy('d.id', 'd.name');
    //     $builder->orderByRaw('CASE WHEN d.name = "Other" THEN 1 ELSE 0 END, d.id ASC');

    //     return $builder->get()->toArray();
    // }



    public function getstationbydistrict($district_id){
        $sql = $this->db->table('fire_stations')
            ->select('id', 'name')
            ->where('district_id', $district_id)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
        return $sql;
    }

    public function getnamebycategory($category_id){
        $sql = $this->db->table('equipment_name')
            ->select('id', 'category_id', 'name')
            ->where('category_id', $category_id)
            ->orderBy('id', 'desc')
            ->get()
            ->toArray();
        return $sql;
    }




    public function getEquipments(){
        $sql = DB::table('equipment')
            ->select(
                'equipment.*',
                'equipment_category.name as category_name',
                'fire_stations.name as fire_station_name',
                'districts.name as district_name',
                'equipment_name.name as equipment_name'
            )
            ->leftJoin('equipment_category', 'equipment.category_id', '=', 'equipment_category.id')
            ->leftJoin('fire_stations', 'equipment.station_id', '=', 'fire_stations.id')
            ->leftJoin('districts', 'equipment.district_id', '=', 'districts.id')
            ->leftJoin('equipment_name', 'equipment.equipment_name', '=', 'equipment_name.id') // Fixed Join Condition
            ->where('equipment.status', '1')
            ->orderBy('equipment.id', 'desc')
            ->get()
            ->toArray();

        return $sql;
    }


    public function getEquipmentDataById($id){
        $sql = DB::table('equipment')
            ->select(
                'equipment.*',
                'equipment_category.name as category_name',
                'fire_stations.name as fire_station_name',
                'districts.name as district_name',
                'equipment_name.id as equipment_name_id'
            )
            ->leftJoin('equipment_category', 'equipment.category_id', '=', 'equipment_category.id')
            ->leftJoin('fire_stations', 'equipment.station_id', '=', 'fire_stations.id')
            ->leftJoin('districts', 'equipment.district_id', '=', 'districts.id')
            ->leftJoin('equipment_name', 'equipment.equipment_name', '=', 'equipment_name.id')
            ->where('equipment.id', $id)
            ->orderBy('equipment.id', 'desc')
            ->get()
            ->toArray()[0];

        return $sql;
    }



    public function getMedalCategory(){
        $sql = DB::table('medal_category')
            ->select('*')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();

        return $sql;
    }

    public function getMedalWinnerList($medalcategory){
        $sql = DB::table('medals')
            ->select(
                'medals.*',
                'medal_category.category_name',
                'medal_category.id as category_id',
                'fire_stations.name as fire_station_name',
                'districts.name as district_name'
            )
            ->leftJoin('medal_category', 'medal_category.id', '=', 'medals.medal_category')
            ->leftJoin('fire_stations', 'medals.fire_station', '=', 'fire_stations.id')
            ->leftJoin('districts', 'medals.districts', '=', 'districts.id')
            ->where('medal_category.id', $medalcategory)
            ->orderBy('medals.year', 'desc')
            ->get()
            ->toArray();

        return $sql;
    }

    public function countAllData($tbl){
        return DB::table($tbl)->count();
    }

    public function getCountReport($tbl, $column){
        $months = [
            '01' => 0, // January
            '02' => 0, // February
            '03' => 0, // March
            '04' => 0, // April
            '05' => 0, // May
            '06' => 0, // June
            '07' => 0, // July
            '08' => 0, // August
            '09' => 0, // September
            '10' => 0, // October
            '11' => 0, // November
            '12' => 0  // December
        ];
        $monthlyCounts = DB::table($tbl)->select(
                DB::raw('DATE_FORMAT('.$column.', "%m") as month')
            )
            ->groupBy('month')
            ->selectRaw('count(*) as count')
            ->get();
        foreach ($monthlyCounts as $record) {
            $months[$record->month] = $record->count;
        }
        return array_values($months);

    }


    // staff strength

    public function getStaffStrength(){
        $sql = DB::table('staff_strength')
                    ->select('staff_strength.*', 'districts.id as did', 'districts.name as d_name')
                    ->leftJoin('districts', 'staff_strength.district_id', '=', 'districts.id')
                    ->orderBy('staff_strength.id', 'DESC')
                    ->get()
                    ->toArray();
        return $sql;
    }

    public function getAllNocData()
    {
        $forApprovalNoc = $this->getDataByOneCondition('applications', array('status' => 'approved'));
        $processedNoc = $this->getDataByOneCondition('applications', array('status' => 'processed'));
        $pendingNoc = $this->getDataByOneCondition('applications', array('status' => 'pending'));
        $rejectedNoc = $this->getDataByOneCondition('applications', array('status' => 'rejected'));
        return $result = [count($forApprovalNoc), count($processedNoc), count($pendingNoc), count($rejectedNoc)];
    }



    public function trackAwarenessProgramRequest($where)
    {
        $sql = DB::table('fs_awareness_program_request')
                    ->select('fs_awareness_program_request.*', 'districts.id as did', 'districts.name as d_name')
                    ->leftJoin('districts', 'fs_awareness_program_request.district_id', '=', 'districts.id')
                    ->leftJoin('fire_stations', 'fs_awareness_program_request.station_id', '=', 'fire_stations.id')
                    ->where('fs_awareness_program_request.application_id', $where)
                    ->get()
                    ->first();
        return $sql;
    }


    public function trackFireNoc($where)
    {
        $sql = DB::table('applications')
                    ->select('applications.*', 'districts.id as did', 'districts.name as d_name','fire_stations.name as f_name','categories.name as c_name', 'sub_categories.name as s_name')
                    ->leftJoin('districts', 'applications.district_id', '=', 'districts.id')
                    ->leftJoin('fire_stations', 'applications.station_id', '=', 'fire_stations.id')
                    ->leftJoin('categories', 'applications.category_id', '=', 'categories.id')
                    ->leftJoin('sub_categories', 'applications.subcategory_id', '=', 'sub_categories.id')
                    ->where('applications.application_no', $where)
                    ->get()
                    ->first();
        return $sql;
    }



    public function getSubCategoryByProject($projectId,$status)
    {
        $sql = DB::table('sub_categories')
                    ->select('sub_categories.*', 'projects.id as pid', 'projects.name as p_name')
                    ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
                    ->leftJoin('projects', 'categories.project_id', '=', 'projects.id')
                    ->where('projects.id', $projectId)
                    ->where('sub_categories.status', $status)
                    ->get()
                    ->toArray();
        return $sql;               
    }


    public function getCategoryBySubCategory($subcategoryId,$status)
    {
        $sql = DB::table('categories')
                    ->select('categories.*', 'sub_categories.id as sid', 'sub_categories.name as s_name')
                    ->leftJoin('sub_categories', 'categories.id', '=', 'sub_categories.category_id')
                    ->where('sub_categories.id', $subcategoryId)
                    ->where('categories.status', $status)
                    ->get()
                    ->toArray();
        return $sql;            
    }


    public function getAwarenessProgrameDetails($where)
    {
         $sql = DB::table('fs_awareness_program_request')
                    ->select('fs_awareness_program_request.*', 'districts.id as did', 'districts.name as d_name', 'fire_stations.name as f_name', 'fire_stations.id as fs_id')
                    ->leftJoin('districts', 'fs_awareness_program_request.district_id', '=', 'districts.id')
                    ->leftJoin('fire_stations', 'fs_awareness_program_request.station_id', '=', 'fire_stations.id')
                    ->where('fs_awareness_program_request.id', $where)
                    ->get()
                    ->first();
        return $sql;
    }



    public function getStandByProgrameDetails($where)
    {
         $sql = DB::table('fs_standby_duty_request')
                    ->select('fs_standby_duty_request.*', 'districts.id as did', 'districts.name as d_name', 'fire_stations.name as f_name', 'fire_stations.id as fs_id')
                    ->leftJoin('districts', 'fs_standby_duty_request.district_id', '=', 'districts.id')
                    ->leftJoin('fire_stations', 'fs_standby_duty_request.station_id', '=', 'fire_stations.id')
                    ->where('fs_standby_duty_request.id', $where)
                    ->get()
                    ->first();
        return $sql;
    }


    public function countAllDataByConditions($tbl, $conditions = [])
    {
        $query = DB::table($tbl);
        foreach ($conditions as $field => $value) {
            $query->where($field, '=', $value);
        }
        $query->where('status', '!=', 'incomplete');
        return $query->count();
    }






    // Aatank Ka Dusra Name babu Bhai Ka kam 
    // public function getMonthlyEmergencyData($type, $filters = [])
    // {
    //     $query = DB::table('emergency_calls')
    //         ->selectRaw("DATE_FORMAT(created_at, '%b') as month, COUNT(*) as count")
    //         ->where('type', $type);

    //     if (!empty($filters['DATE(created_at) >='])) {
    //         $query->whereDate('created_at', '>=', $filters['DATE(created_at) >=']);
    //     }

    //     if (!empty($filters['DATE(created_at) <='])) {
    //         $query->whereDate('created_at', '<=', $filters['DATE(created_at) <=']);
    //     }

    //     if (!empty($filters['district'])) {
    //         $query->where('district', $filters['district']);
    //     }

    //     if (!empty($filters['fire_station'])) {
    //         $query->where('fire_station', $filters['fire_station']);
    //     }

    //     return $query->groupBy(DB::raw("MONTH(created_at)"))
    //         ->orderBy(DB::raw("MONTH(created_at)"))
    //         ->pluck('count', 'month')
    //         ->toArray();
    // }

    public function getFireCountsData($table, $filters = [])
    {
        // Inner subquery to perform COUNT and GROUP BY
        $subQuery = DB::table($table)
            ->selectRaw("MONTH(created_at) as month_num, YEAR(created_at) as year, COUNT(*) as count")
            ->when(!empty($filters['DATE(created_at) >=']), function ($q) use ($filters) {
                $q->whereDate('created_at', '>=', $filters['DATE(created_at) >=']);
            })
            ->when(!empty($filters['DATE(created_at) <=']), function ($q) use ($filters) {
                $q->whereDate('created_at', '<=', $filters['DATE(created_at) <=']);
            })
            ->when(!empty($filters['district']), function ($q) use ($filters) {
                $q->where('district_id', $filters['district']);
            })
            ->when(!empty($filters['fire_station']), function ($q) use ($filters) {
                $q->where('stattion_id', $filters['fire_station']);
            })
            ->groupByRaw("YEAR(created_at), MONTH(created_at)");

        // Outer query for formatting and ordering
        $query = DB::table(DB::raw("({$subQuery->toSql()}) as grouped"))
            ->mergeBindings($subQuery) // ✅ FIXED: remove ->getQuery()
            ->selectRaw("DATE_FORMAT(STR_TO_DATE(month_num, '%m'), '%b') as month, count, year, month_num")
            ->orderBy('year')
            ->orderBy('month_num');

        return $query->get()->toArray();
    }


    public function getRescueCountsData($table, $filters = [])
    {
        $subQuery = DB::table($table)
            ->selectRaw("MONTH(created_at) as month_num, YEAR(created_at) as year, COUNT(*) as count")
            ->when(!empty($filters['DATE(created_at) >=']), function ($q) use ($filters) {
                $q->whereDate('created_at', '>=', $filters['DATE(created_at) >=']);
            })
            ->when(!empty($filters['DATE(created_at) <=']), function ($q) use ($filters) {
                $q->whereDate('created_at', '<=', $filters['DATE(created_at) <=']);
            })
            ->when(!empty($filters['district']), function ($q) use ($filters) {
                $q->where('district_id', $filters['district']);
            })
            ->when(!empty($filters['fire_station']), function ($q) use ($filters) {
                $q->where('stattion_id', $filters['fire_station']);
            })
            ->groupByRaw("YEAR(created_at), MONTH(created_at)");

        // Outer query for formatting and ordering
        $query = DB::table(DB::raw("({$subQuery->toSql()}) as grouped"))
            ->mergeBindings($subQuery)
            ->selectRaw("DATE_FORMAT(STR_TO_DATE(month_num, '%m'), '%b') as month, count, year, month_num")
            ->orderBy('year')
            ->orderBy('month_num');

        // Optional: return as ['Jan' => 10, 'Feb' => 20, ...]
        return $query->pluck('count', 'month')->toArray();
    }


    public function getReliefCountsData($table, $filters = [])
    {
        // Subquery to aggregate monthly counts
        $subQuery = DB::table($table)
            ->selectRaw("MONTH(created_at) as month_num, YEAR(created_at) as year, COUNT(*) as count")
            ->when(!empty($filters['DATE(created_at) >=']), function ($q) use ($filters) {
                $q->whereDate('created_at', '>=', $filters['DATE(created_at) >=']);
            })
            ->when(!empty($filters['DATE(created_at) <=']), function ($q) use ($filters) {
                $q->whereDate('created_at', '<=', $filters['DATE(created_at) <=']);
            })
            ->when(!empty($filters['district']), function ($q) use ($filters) {
                $q->where('district_id', $filters['district']);
            })
            ->when(!empty($filters['fire_station']), function ($q) use ($filters) {
                $q->where('stattion_id', $filters['fire_station']);
            })
            ->groupByRaw("YEAR(created_at), MONTH(created_at)");

        // Wrap the subquery and format month label
        $query = DB::table(DB::raw("({$subQuery->toSql()}) as grouped"))
            ->mergeBindings($subQuery)
            ->selectRaw("DATE_FORMAT(STR_TO_DATE(month_num, '%m'), '%b') as month, count, year, month_num")
            ->orderBy('year')
            ->orderBy('month_num');

        // Return ['Jan' => 10, 'Feb' => 7, ...]
        return $query->pluck('count', 'month')->toArray();
    }



    




    // Application Status Count
    public function getApplicationStatusCounts($filters = [])
    {
        $query = DB::table('applications')
            ->select('status', DB::raw('COUNT(*) as count'));

        if (!empty($filters['DATE(created_at) >='])) {
            $query->whereDate('created_at', '>=', $filters['DATE(created_at) >=']);
        }

        if (!empty($filters['DATE(created_at) <='])) {
            $query->whereDate('created_at', '<=', $filters['DATE(created_at) <=']);
        }

        if (!empty($filters['district'])) {
            $query->where('district_id', $filters['district']);
        }

        if (!empty($filters['fire_station'])) {
            $query->where('station_id', $filters['fire_station']);
        }

        return $query->groupBy('status')->get();
    }

    public function getAwarenessProgramTypeCounts($filters = []){
        $query = DB::table('fs_awareness_program_request')
            ->select('program_type', DB::raw('COUNT(*) as count'));

        if (!empty($filters['DATE(created_at) >='])) {
            $query->whereDate('created_at', '>=', $filters['DATE(created_at) >=']);
        }

        if (!empty($filters['DATE(created_at) <='])) {
            $query->whereDate('created_at', '<=', $filters['DATE(created_at) <=']);
        }

        if (!empty($filters['district'])) {
            $query->where('district_id', $filters['district']);
        }

        if (!empty($filters['fire_station'])) {
            $query->where('station_id', $filters['fire_station']);
        }

        return $query->groupBy('program_type')->get();
    }

    // Pending Application Range Counts
    public function getPendingApplicationRangeCounts($filters = [])
    {
        $query = DB::table('applications')
            ->select(DB::raw("CASE 
                WHEN DATEDIFF(NOW(), created_at) <= 7 THEN '0-7 Days'
                WHEN DATEDIFF(NOW(), created_at) <= 15 THEN '8-15 Days'
                WHEN DATEDIFF(NOW(), created_at) <= 30 THEN '16-30 Days'
                ELSE '30+ Days' END as label"),
                DB::raw('COUNT(*) as count'))
            ->where('status', 'pending');

        if (!empty($filters['DATE(created_at) >='])) {
            $query->whereDate('created_at', '>=', $filters['DATE(created_at) >=']);
        }

        if (!empty($filters['DATE(created_at) <='])) {
            $query->whereDate('created_at', '<=', $filters['DATE(created_at) <=']);
        }

        if (!empty($filters['district'])) {
            $query->where('district_id', $filters['district']);
        }

        if (!empty($filters['fire_station'])) {
            $query->where('station_id', $filters['fire_station']);
        }

        return $query->groupBy('label')->get();
    }




    public function getDataByFilterCondition($table, $districtId = null, $fireStationId = null)
    {
        $query = DB::table($table);

        if (!empty($fireStationId)) {
            $query->where($table === 'fire_stations' ? 'id' : 'station_id', $fireStationId);
        }

        if (!empty($districtId)) {
            $query->where('district_id', $districtId);
        }
        if ($table === 'applications') {
            $query->where('status', 'approved');
        }

        return $query->get()->toArray();
    }


    public function getAllCountByNocStatus()
    {
        $table = 'applications';

        // Count all as total received
        $totalReceived = DB::table($table)->count();

        // Specific status counts
        $approved = DB::table($table)->where('status', 'approved')->count();
        $reverted = DB::table($table)->where('status', 'reverted')->count();
        $pending  = DB::table($table)->where('status', 'pending')->count();

        // In-process statuses
        $inProcessStatuses = ['for approval', 'pre approved', 'processed', 'incomplete'];
        $inProcess = DB::table($table)->whereIn('status', $inProcessStatuses)->count();

        return [
            'total_received' => $totalReceived,
            'approved'       => $approved,
            'reverted'       => $reverted,
            'pending'        => $pending,
            'in_process'     => $inProcess,
        ];
    }



    public function getTotalCountByNocStatus($districtId = null, $fireStationId = null)
    {
        $table = 'applications';

        // Base query
        $query = DB::table($table);

        if (!empty($fireStationId)) {
            $query->where('station_id', $fireStationId);
        }

        if (!empty($districtId)) {
            $query->where('district_id', $districtId);
        }

        // Count all as total received
        $totalReceived = (clone $query)->count();

        // Specific status counts
        $approved = (clone $query)->where('status', 'approved')->count();
        $reverted = (clone $query)->where('status', 'reverted')->count();
        $pending  = (clone $query)->where('status', 'pending')->count();

        // In-process statuses
        $inProcessStatuses = ['for approval', 'pre approved', 'processed', 'incomplete'];
        $inProcess = (clone $query)->whereIn('status', $inProcessStatuses)->count();

        return [
            'total_received' => $totalReceived,
            'approved'       => $approved,
            'reverted'       => $reverted,
            'pending'        => $pending,
            'in_process'     => $inProcess,
        ];
    }
    public function getPendingNocCount(string $table, int $districtId, string $column): array
    {
        return DB::table($table)
            ->selectRaw("
                CASE 
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 0 AND 5 THEN '0-5 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 6 AND 10 THEN '6-10 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 11 AND 15 THEN '11-15 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 16 AND 20 THEN '16-20 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 21 AND 25 THEN '21-25 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 26 AND 31 THEN '26-31 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) > 31 THEN 'More than 31 days'
                END AS days_since_insertion,
                COUNT(*) AS record_count
            ")
            ->where('district_id', $districtId)
            ->where('status', 'pending')
            ->groupByRaw("
                CASE 
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 0 AND 5 THEN '0-5 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 6 AND 10 THEN '6-10 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 11 AND 15 THEN '11-15 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 16 AND 20 THEN '16-20 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 21 AND 25 THEN '21-25 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) BETWEEN 26 AND 31 THEN '26-31 days'
                    WHEN DATEDIFF(CURRENT_DATE, {$column}) > 31 THEN 'More than 31 days'
                END
            ")
            ->orderBy('id', 'ASC')
            ->get()
            ->toArray();
    }


    public function allNocCountData()
    {
        $districts = DB::table('districts')->select('id', 'name')->get();

        $dataArray = [];
        $totals = [
            'not_assigned'              => 0,
            'assigned_but_not_verified' => 0,
            'Verified'                  => 0,
            'Approved'                  => 0,
            'Rejected'                  => 0,
            'Pending'                   => 0,
            'Total'                     => 0,
        ];

        foreach ($districts as $district) {
            $districtId = $district->id;

            // Counts per status
            $notAssigned = DB::table('applications')
                ->where('district_id', $districtId)
                ->whereNull('assigned_id')
                ->count();

            $assignedButNotVerified = DB::table('applications')
                ->where('district_id', $districtId)
                ->where('status', 'processed')
                ->count();

            $verified = DB::table('applications')
                ->where('district_id', $districtId)
                ->where('status', 'for approval')
                ->count();

            $approved = DB::table('applications')
                ->where('district_id', $districtId)
                ->where('status', 'approved')
                ->count();

            $rejected = DB::table('applications')
                ->where('district_id', $districtId)
                ->where('status', 'reverted')
                ->count();

            $pending = DB::table('applications')
                ->where('district_id', $districtId)
                ->where('status', 'pending')
                ->count();

            $total = $notAssigned + $assignedButNotVerified + $verified + $approved + $rejected + $pending;

            // Update column totals
            $totals['not_assigned']              += $notAssigned;
            $totals['assigned_but_not_verified'] += $assignedButNotVerified;
            $totals['Verified']                  += $verified;
            $totals['Approved']                  += $approved;
            $totals['Rejected']                  += $rejected;
            $totals['Pending']                   += $pending;
            $totals['Total']                     += $total;

            $dataArray[] = [
                'District Name'             => $district->name,
                'not_assigned'              => $notAssigned,
                'assigned_but_not_verified' => $assignedButNotVerified,
                'Verified'                  => $verified,
                'Approved'                  => $approved,
                'Rejected'                  => $rejected,
                'Total'                     => $total,
                'Pending'                   => $pending,
            ];
        }

        // Add grand total row at the bottom
        $dataArray[] = [
            'District Name'             => 'Total',
            'not_assigned'              => $totals['not_assigned'],
            'assigned_but_not_verified' => $totals['assigned_but_not_verified'],
            'Verified'                  => $totals['Verified'],
            'Approved'                  => $totals['Approved'],
            'Rejected'                  => $totals['Rejected'],
            'Pending'                   => $totals['Pending'],
            'Total'                     => $totals['Total']
            
        ];

        return $dataArray;
    }

    public function getTableData($table)
    {
        return DB::table($table)->get();
    }

    public function getTableDataByCondition(
        $table,
        $conditions = []
    )
    {
        return DB::table($table)
            ->where($conditions)
            ->get();
    }

    public function getTableDataWithOrder(
        $table,
        $orderBy = 'id',
        $direction = 'DESC'
    )
    {
        return DB::table($table)
            ->orderBy($orderBy, $direction)
            ->get();
    }

    public function getTableDataByConditionWithOrder(
        $table,
        $conditions = [],
        $orderBy = 'id',
        $direction = 'DESC'
    )
    {
        return DB::table($table)
            ->where($conditions)
            ->orderBy($orderBy, $direction)
            ->get();
    }


}
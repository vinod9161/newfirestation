<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{

    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }
 


    public function dashboard()
    {
       $districtId='';
       $fireStationId='';
       $fireStactionList =  $this->commonModel->getData('fire_stations');
       $districtList     =  $this->commonModel->getData('districts');
       $fireStationCount =  $this->commonModel->getData('fire_stations');
       $fire_station_count  = count($fireStationCount)??0;
       $manpowerCount       = $this->commonModel->getData('users');
       $man_power_count     = count($manpowerCount)??0;
       $vehiclesCount       = $this->commonModel->getData('fs_vehicles');
       $vehicles_count      = count($vehiclesCount)??0;
       $equipmentCount      = $this->commonModel->getData('equipment');
       $equipment_count     = count($equipmentCount)??0;
       $fireCallsCount      = $this->commonModel->getData('fs_fire_report');
       $fire_Calls_Count    = count($fireCallsCount)??0;
       $rescueCallsCount    = $this->commonModel->getData('fs_rescue_report');
       $rescue_Calls_Count  = count($rescueCallsCount)??0;
       $reliefCallsCount    = $this->commonModel->getData('fs_relief_work_report');
       $relief_Calls_Count  = count($reliefCallsCount)??0;
       $totalReliefRescueCount = $rescue_Calls_Count + $relief_Calls_Count;

       // get Total Saved life human  by district or fire station
        $SaveLifeCount = $this->commonModel->getData('fs_fire_report');
        $lifeSaved = 0;
        foreach ($SaveLifeCount as $row) {
            $lifeSaved += $row->life_saved_human ?? 0;
        }
        $save_life_count = $lifeSaved;


        // get Total Saved propert by district or fire station
        $SavePropertyCount = $this->commonModel->getData('fs_fire_report');
        $propertySaved = 0;
        foreach ($SavePropertyCount as $row) {
            $propertySaved += $row->property_saved ?? 0;
        }
        $save_property_count = $propertySaved;


        // get Total Noc issued by district or fire station
        $nocCount = $this->commonModel->getData('applications');
        $noc_count = count($nocCount)??0;

        // get Total awareness program by district or fire station
        $awareness_program = $this->commonModel->getData('fs_awareness_program_request');
        $awareness_program_count = count($awareness_program)??0;

        $opDutyCount = $this->commonModel->getData('operational_applications');
        $op_duty_count = count($opDutyCount)??0;

        $filterNocDat             = $this->commonModel->getAllCountByNocStatus();
        $noc_total_received       = $filterNocDat['total_received'] ?? 0;
        $noc_total_approved       = $filterNocDat['approved'] ?? 0;
        $noc_total_reverted       = $filterNocDat['reverted'] ?? 0;
        $noc_total_pending        = $filterNocDat['pending'] ?? 0;
        $noc_total_in_process     = $filterNocDat['in_process'] ?? 0;

        // pie chart data
        $nocStatusCounts = $this->commonModel->getNOCStatusCounts();

        

        $nocLabels = ['Pending', 'Reverted', 'In-Process', 'Received', 'Approved'];
        $nocCounts = array_fill(0, count($nocLabels), 0); 

        foreach ($nocStatusCounts as $row) {
            $status = ucwords(strtolower($row->status)); 
            $index = array_search($status, $nocLabels);

            if ($index !== false) {
                $nocCounts[$index] = (int) $row->count;
            }
        }



        foreach ($nocStatusCounts as $status) {
            switch ($status->status) {
                case 'PENDING':
                    $nocCounts[0] = (int)$status->count; 
                    break;
                case 'REVERTED':
                    $nocCounts[1] = (int)$status->count;
                    break;
                case 'IN-PROCESS':
                    $nocCounts[2] = (int)$status->count;
                    break;
                case 'RECEIVED':
                    $nocCounts[3] = (int)$status->count;
                    break;
                case 'APPROVED':
                    $nocCounts[4] = (int)$status->count;
                    break;
            }
        }
        // end pie chart data

       // echo "<pre>"; print_r($nocCounts);die;



       $vehicleByDistrict = $this->commonModel->getVehicleCountByDistrict();
        $districts = [];
        $vehicleCounts = [];
        foreach ($vehicleByDistrict as $row) {
            $districts[] = $row->district;
            $vehicleCounts[] = (int)$row->total;
        }

        $fire       = $this->commonModel->getCountReport('fs_fire_report', 'created_at');
        $rescue     = $this->commonModel->getCountReport('fs_rescue_report', 'created_at');
        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $fireChartData   = is_array($fire) ? array_values($fire) : array_fill(0, 12, 0);
        $rescueChartData = is_array($rescue) ? array_values($rescue) : array_fill(0, 12, 0);


        // rang biranga chart ka code
            $getNocData = $this->getNocApplicationData();
        // rang biranga chart ka code safed ho gya

        //echo "<pre>"; print_r($getNocData);die;

        // noc all status count chutiya rachit sala
       // $allNocCountData = $this->commonModel->allNocCountData();
        // end noc all status count chutiya rachit sala
        // exit('pp');
        return view('admin.dashboard', 
            compact(
                'fireStactionList','districtList','fire_station_count','man_power_count','vehicles_count','equipment_count', 'fire_Calls_Count', 'totalReliefRescueCount',
                'save_life_count','save_property_count','noc_count','awareness_program_count','op_duty_count', 'noc_total_received' ,'noc_total_approved','noc_total_reverted',
                'noc_total_pending','noc_total_in_process','nocLabels','nocCounts', 'districts','vehicleCounts','monthNames', 'fireChartData', 'rescueChartData', 'getNocData'
            )
        );

    }



    public function getNocApplicationData()
    {
        $ranges = [
            '0-5 days'          => '0-5 दिन',
            '6-10 days'         => '6-10 दिन',
            '11-15 days'        => '11-15 दिन',
            '16-20 days'        => '16-20 दिन',
            '21-25 days'        => '21-25 दिन',
            '26-31 days'        => '26-30 दिन',
            'More than 31 days' => '31 दिन से अधिक'
        ];

        $pendingNocData = [];
        $districtList = $this->commonModel->getData('districts');

        foreach ($districtList as $districtVal) {
            // Get DB result
            $dbData = $this->commonModel->getPendingNocCount('applications', $districtVal->id, 'created_at');

            // Convert DB result to associative array for quick lookup
            $dataMap = [];
            foreach ($dbData as $row) {
                $dataMap[$row->days_since_insertion] = $row->record_count;
            }

            // Build full list with missing categories filled as 0
            $finalData = [];
            foreach ($ranges as $key => $label) {
                $finalData[] = [
                    'label'        => $label,
                    'record_count' => isset($dataMap[$key]) ? $dataMap[$key] : 0
                ];
            }

            $pendingNocData[] = [
                'district_id'   => $districtVal->id,
                'district_name' => $districtVal->name,
                'noc_data'      => $finalData
            ];
        }

        return $pendingNocData;
    }



   


    public function filterDashboardData(Request $request)
    {
        $startDate     = $request->input('start_date');
        $endDate       = $request->input('end_date');
        $districtId    = $request->input('district_id');
        $fireStationId = $request->input('fire_station_id');

        // get Total fire station by district or fire station
        $table = 'fire_stations';
        $fireStationCount = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $data['fire_station_count'] = count($fireStationCount)??0;

        // get Total Man power by district or fire station
        $table = 'users';
        $manpowerCount = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $data['man_power_count'] = count($manpowerCount)??0;

        // get Total Vehciles by district or fire station
        $table = 'fs_vehicles';
        $vehiclesCount = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $data['vehicles_count'] = count($vehiclesCount)??0;

        // get Total Equipments by district or fire station
        $table = 'equipment';
        $equipmentCount = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $data['equipments_count'] = $equipmentCount[0]->total_non_working_equipment??0;

        // get Total Saved life human  by district or fire station
        $table = 'fs_fire_report';
        $SaveLifeCount = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $lifeSaved = 0;
        foreach ($SaveLifeCount as $row) {
            $lifeSaved += $row->life_saved_human ?? 0;
        }
        $data['save_life_count'] = $lifeSaved;


        // get Total Saved propert by district or fire station
        $table = 'fs_fire_report';
        $SavePropertyCount = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $propertySaved = 0;
        foreach ($SavePropertyCount as $row) {
            $propertySaved += $row->property_saved ?? 0;
        }
        $data['save_property_count'] = $propertySaved;


        // get Total Noc issued by district or fire station
        $table = 'applications';
        $nocCount = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $data['noc_count'] = count($nocCount)??0;

        // get Total awareness program by district or fire station
        $table = 'fs_awareness_program_request';
        $awareness_program = $this->commonModel->getDataByFilterCondition($table,$districtId,$fireStationId);
        $data['awareness_program_count'] = count($awareness_program)??0;


        // noc
        $filterNocDat = $this->commonModel->getTotalCountByNocStatus($districtId, $fireStationId);
        $data['total_received'] = $filterNocDat['total_received'] ?? 0;
        $data['approved']       = $filterNocDat['approved'] ?? 0;
        $data['reverted']       = $filterNocDat['reverted'] ?? 0;
        $data['pending']        = $filterNocDat['pending'] ?? 0;
        $data['in_process']     = $filterNocDat['in_process'] ?? 0; 

        




        


    //     $where = [];
    //     $reportWhere = [];

    //     // 📅 Date filters
    //     if (!empty($startDate) && !empty($endDate)) {
    //         $startDateFormatted = date('Y-m-d', strtotime($startDate));
    //         $endDateFormatted   = date('Y-m-d', strtotime($endDate));

    //         $where['DATE(created_at) >='] = $startDateFormatted;
    //         $where['DATE(created_at) <='] = $endDateFormatted;

    //         $reportWhere['DATE(created_at) >='] = $startDateFormatted;
    //         $reportWhere['DATE(created_at) <='] = $endDateFormatted;
    //     }

    //     // 🗺️ District filter
    //     if (!empty($districtId)) {
    //         $where['district'] = $districtId;
    //         $reportWhere['district'] = $districtId;
    //     }

    //     // 🚒 Fire station filter
    //     if (!empty($fireStationId)) {
    //         $where['fire_station'] = $fireStationId;
    //         $reportWhere['fire_station'] = $fireStationId;
    //     }

    //     $data = [];

    //     // 🔥 Fire/Rescue/Relief call counts (default to 0)
    //     $data['fireCount']   = "0";
    //     $data['rescueCount'] = "0";
    //     $data['reliefCount'] = "0";

    //     // 📊 Monthly Emergency Chart Data
    //     // $data['fireCounts']   = array_values($this->commonModel->getMonthlyEmergencyData('fire', $where));
    //     // $data['rescueCounts'] = array_values($this->commonModel->getMonthlyEmergencyData('rescue', $where));
    //     // $data['reliefCounts'] = array_values($this->commonModel->getMonthlyEmergencyData('relief', $where));


        
    //     $data['fireCounts']   = $this->commonModel->getFireCountsData('fs_fire_report', $where);
    //     $data['rescueCounts'] = $this->commonModel->getRescueCountsData('fs_rescue_report', $where);
    //     $data['reliefCounts'] = $this->commonModel->getReliefCountsData('fs_relief_work_report', $where);

    //    // echo "<pre>"; print_r($data, true); die;

        

    //     // 📋 Application Status Counts
    //     $data['applicationStatusCounts'] = $this->commonModel->getApplicationStatusCounts($reportWhere);

    //     // 📢 Awareness Program Types/Counts
    //     $awarenessPrograms = $this->commonModel->getAwarenessProgramTypeCounts($reportWhere);
    //     $programTypes = [];
    //     $programCounts = [];
    //     foreach ($awarenessPrograms as $program) {
    //         $programTypes[] = $program->program_type;
    //         $programCounts[] = (int) $program->count;
    //     }
    //     $data['programTypes']  = $programTypes;
    //     $data['programCounts'] = $programCounts;

         
    //     // ⏳ Pending Application Ranges
    //     $pendingApplications = $this->commonModel->getPendingApplicationRangeCounts($reportWhere);
    //     $pendingLabels = [];
    //     $pendingCounts = [];
    //     foreach ($pendingApplications as $pending) {
    //         $pendingLabels[] = $pending->label;
    //         $pendingCounts[] = (int) $pending->count;
    //     }
    //     $data['pendingLabels'] = $pendingLabels;
    //     $data['pendingCounts'] = $pendingCounts;

    //     //echo "<pre>"; print_r($data); die;

    //     // 📄 NOC Status Counts
    //     $nocStatuses = $this->commonModel->getNocStatusCounts($reportWhere);
    //     $nocLabels = [];
    //     $nocCounts = [];
    //     foreach ($nocStatuses as $noc) {
    //         $nocLabels[] = $noc->status;
    //         $nocCounts[] = (int) $noc->count;
    //     }
    //     $data['nocLabels'] = $nocLabels;
    //     $data['nocCounts'] = $nocCounts;

    //     // 🚛 Vehicle Count by District
    //     $vehicleByDistrict = $this->commonModel->getVehicleCountByDistrict($reportWhere);
    //     $districts = [];
    //     $vehicleCounts = [];
    //     foreach ($vehicleByDistrict as $row) {
    //         $districts[] = $row->district;
    //         $vehicleCounts[] = (int) $row->total;
    //     }
    //     $data['vehicleByDistrict'] = $vehicleByDistrict;
    //     $data['districts'] = $districts;
    //     $data['vehicleCounts'] = $vehicleCounts;

       // echo "<pre>"; print_r($data); die;

        return response()->json($data);
    }



    public function actions()
    {
        $tbl = 'fire_services';
        $services = $this->commonModel->getData($tbl);
        return view('admin.common.action', compact('services'));
    }

    public function postawarnessChart(Request $request)
    {
        $awarenessCount = $this->commonModel->countWhere('fs_awareness_program_request', ['program_type' => 'awareness program']);
        $mockDriilCount = $this->commonModel->countWhere('fs_awareness_program_request', ['program_type' => 'mock drills']);
        $talkCount = $this->commonModel->countWhere('fs_awareness_program_request', ['program_type' => 'talk on show']);
        $seminarCount = $this->commonModel->countWhere('fs_awareness_program_request', ['program_type' => 'seminar']);
        $conferenceCount = $this->commonModel->countWhere('fs_awareness_program_request', ['program_type' => 'conference']);
        $trainingCount = $this->commonModel->countWhere('fs_awareness_program_request', ['program_type' => 'training']);
        $otherCount = $this->commonModel->countWhere('fs_awareness_program_request', ['program_type' => 'Other']);

        $data['labels'] = ['Awareness Program', 'Mock Drills', 'Talk on show', 'Seminar', 'Conference', 'Training', 'Other'];
        $data['values'] = [$awarenessCount, $mockDriilCount, $talkCount, $seminarCount, $conferenceCount, $trainingCount, $otherCount];

        return $data;
    }

    public function postSanctionChart()
    {
        $districts = $this->commonModel->getData('districts');
        print_r($districts);die;
    }



    public function dashboardTwo()
    {
        // noc all status count chutiya rachit sala
        $allNocCountData = $this->commonModel->allNocCountData();
        // end noc all status count chutiya rachit sala
        return view('admin.dashboardtwo', compact('allNocCountData'));
    }
}
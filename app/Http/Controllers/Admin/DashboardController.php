<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }
 
    public function dashboardTwo()
    {
        $user = Auth::user();

        // 🔥 Role-based filter
        $where = [];

        if ($user->type == 3) {
            // FSO (station level)
            $where = [
                'district_id' => $user->district_id,
                'station_id'  => $user->station_id
            ];
        } elseif ($user->type == 0 || $user->type == 1) {
            // Admin (no filter)
            $where = [];
        } else {
            // CFO (district level)
            $where = [
                'district_id' => $user->district_id
            ];
        }

        // 🔁 Helper function usage
        $getData = function($table) use ($where) {
            return !empty($where)
                ? $this->commonModel->getDataByOneCondition($table, $where)
                : $this->commonModel->getData($table);
        };

        // 📊 Basic Lists
        $fireStactionList = $getData('fire_stations');
        $districtList     = $this->commonModel->getData('districts'); // usually global

        // 📊 Counts
        $fire_station_count = count($getData('fire_stations')) ?? 0;
        $man_power_count    = count($getData('users')) ?? 0;
        $vehicles_count     = count($getData('fs_vehicles')) ?? 0;
        $equipment_count    = count($getData('equipment')) ?? 0;

        $fire_Calls_Count   = count($getData('fs_fire_report')) ?? 0;
        $rescue_Calls_Count = count($getData('fs_rescue_report')) ?? 0;
        $relief_Calls_Count = count($getData('fs_relief_work_report')) ?? 0;

        $totalReliefRescueCount = $rescue_Calls_Count + $relief_Calls_Count;

        // 🔥 Life Saved
        $lifeSaved = 0;
        foreach ($getData('fs_fire_report') as $row) {
            $lifeSaved += $row->life_saved_human ?? 0;
        }
        $save_life_count = $lifeSaved;

        // 🏠 Property Saved
        $propertySaved = 0;
        foreach ($getData('fs_fire_report') as $row) {
            $propertySaved += $row->property_saved ?? 0;
        }
        $save_property_count = $propertySaved;

        // 📄 NOC & Others
        $noc_count                 = count($getData('applications')) ?? 0;
        $awareness_program_count   = count($getData('fs_awareness_program_request')) ?? 0;
        $op_duty_count            = count($getData('operational_applications')) ?? 0;

        // 📊 NOC Status Counts (Make sure function accepts $where)
        $filterNocDat = $this->commonModel->getAllCountByNocStatus($where);

        $noc_total_received   = $filterNocDat['total_received'] ?? 0;
        $noc_total_approved   = $filterNocDat['approved'] ?? 0;
        $noc_total_reverted   = $filterNocDat['reverted'] ?? 0;
        $noc_total_pending    = $filterNocDat['pending'] ?? 0;
        $noc_total_in_process = $filterNocDat['in_process'] ?? 0;

        // 🥧 Pie Chart
        $nocStatusCounts = $this->commonModel->getNOCStatusCounts($where);

        $nocLabels = ['Pending', 'Reverted', 'In-Process', 'Received', 'Approved'];
        $nocCounts = array_fill(0, count($nocLabels), 0);

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

        // 🚒 Vehicles by District (update function to accept $where if needed)
        $vehicleByDistrict = $this->commonModel->getVehicleCountByDistrict($where);

        $districts = [];
        $vehicleCounts = [];

        foreach ($vehicleByDistrict as $row) {
            $districts[] = $row->district;
            $vehicleCounts[] = (int)$row->total;
        }

        // 📈 Monthly Charts
        $fire   = $this->commonModel->getCountReport('fs_fire_report', 'created_at', $where);
        $rescue = $this->commonModel->getCountReport('fs_rescue_report', 'created_at', $where);

        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                    'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        $fireChartData   = is_array($fire) ? array_values($fire) : array_fill(0, 12, 0);
        $rescueChartData = is_array($rescue) ? array_values($rescue) : array_fill(0, 12, 0);

        // 🌈 Custom Chart
        $getNocData = $this->getNocApplicationData($where);
        
        $allNocCountData = $this->commonModel->allNocCountData();

        return view('admin.dashboardtwo', compact(
            'fireStactionList',
            'districtList',
            'fire_station_count',
            'man_power_count',
            'vehicles_count',
            'equipment_count',
            'fire_Calls_Count',
            'totalReliefRescueCount',
            'save_life_count',
            'save_property_count',
            'noc_count',
            'awareness_program_count',
            'op_duty_count',
            'noc_total_received',
            'noc_total_approved',
            'noc_total_reverted',
            'noc_total_pending',
            'noc_total_in_process',
            'nocLabels',
            'nocCounts',
            'districts',
            'vehicleCounts',
            'monthNames',
            'fireChartData',
            'rescueChartData',
            'getNocData',
            'allNocCountData'
        ));
    }

    public function getNocDashboardData(Request $request)
    {
        $where = [];

        if ($request->district_id) {
            $where['district_id'] = $request->district_id;
        }

        if ($request->station_id) {
            $where['station_id'] = $request->station_id;
        }

        $start = $request->start_date;
        $end   = $request->end_date;

        $baseQuery = DB::table('applications');

        if (!empty($where)) {
            $baseQuery->where($where);
        }

        if ($start && $end) {
            $baseQuery->whereBetween('applications.created_at', [$start, $end]);
        }

        // 🔥 helper function
        $getCounts = function($query) {
            return [
                'total_received' => (clone $query)->count(),
                'approved'       => (clone $query)->where('applications.status', 'APPROVED')->count(),
                'reverted'       => (clone $query)->where('applications.status', 'REVERTED')->count(),
                'in_process'     => (clone $query)->where('applications.status', 'PENDING')->count(),
                'pending'        => (clone $query)->where('applications.status', 'PENDING')->count(),
            ];
        };

        // 🔥 All
        $all = $getCounts(clone $baseQuery);

        // 🔥 By type
        $preEst = $getCounts(
            (clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre establishment%'")
        );

        $preOp = $getCounts(
            (clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre operational%'")
        );

        $renew = $getCounts(
            (clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%renewal%'")
        );

        // 🔥 Table helper
        $getTable = function($query, $type, $status) {

            $q = (clone $query)
                ->where('applications.status', $status)
                ->join('districts', 'districts.id', '=', 'applications.district_id');

            // 🔥 apply type filter only if exists
            if (!empty($type)) {
                $q->whereRaw("LOWER(applications.application_type) LIKE ?", ["%$type%"]);
            }

            return $q->selectRaw("
                    districts.name as district,

                    COUNT(CASE 
                        WHEN DATEDIFF(applications.updated_at, applications.created_at) <= 5 
                    THEN 1 END) as days_0_5,

                    COUNT(CASE 
                        WHEN DATEDIFF(applications.updated_at, applications.created_at) BETWEEN 6 AND 10 
                    THEN 1 END) as days_6_10,

                    COUNT(CASE 
                        WHEN DATEDIFF(applications.updated_at, applications.created_at) BETWEEN 11 AND 15 
                    THEN 1 END) as days_11_15,

                    COUNT(CASE 
                        WHEN DATEDIFF(applications.updated_at, applications.created_at) > 15 
                    THEN 1 END) as days_15_plus,

                    ROUND(AVG(
                        DATEDIFF(applications.updated_at, applications.created_at)
                    ),2) as avg_days,

                    COUNT(*) as total
                ")
                ->whereNotNull('applications.updated_at')
                ->groupBy('districts.name')
                ->orderBy('districts.name')
                ->get();
        };

        // 🔥 Table data
        $tables = [
            'all' => [
                'approved' => $getTable($baseQuery, '', 'APPROVED'),
                'reverted' => $getTable($baseQuery, '', 'REVERTED'),
            ],
            'pre_est' => [
                'approved' => $getTable($baseQuery, 'pre establishment', 'APPROVED'),
                'reverted' => $getTable($baseQuery, 'pre establishment', 'REVERTED'),
            ],
            'pre_op' => [
                'approved' => $getTable($baseQuery, 'pre operational', 'APPROVED'),
                'reverted' => $getTable($baseQuery, 'pre operational', 'REVERTED'),
            ],
            'renewal' => [
                'approved' => $getTable($baseQuery, 'renewal', 'APPROVED'),
                'reverted' => $getTable($baseQuery, 'renewal', 'REVERTED'),
            ]
        ];

        $getDistrictChart = function($query, $type = '') {

            $q = (clone $query)
                ->join('districts', 'districts.id', '=', 'applications.district_id');

            if (!empty($type)) {
                $q->whereRaw("LOWER(applications.application_type) LIKE ?", ["%$type%"]);
            }

            return $q->select('districts.name as district', DB::raw('COUNT(*) as total'))
                ->groupBy('districts.name')
                ->get();
        };

        $getTypeChart = function($query) {
            return (clone $query)
                ->select('noc_type as type', DB::raw('COUNT(*) as total'))
                ->groupBy('noc_type')
                ->get();
        };

        // $getRejectChart = function($query) {
        //     return (clone $query)
        //         ->where('status', 'REJECTED')
        //         ->select('rejection_reason as reason', DB::raw('COUNT(*) as total'))
        //         ->groupBy('rejection_reason')
        //         ->get();
        // };

        $getRejectRaw = function($query) {
            return (clone $query)
                ->where('status', 'REVERTED')
                ->pluck('revert');
        };

        $reject_chart = [
            'all' => $this->processRejectReasons(
                $getRejectRaw($baseQuery)
            ),

            'pre_est' => $this->processRejectReasons(
                $getRejectRaw(
                    (clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre establishment%'")
                )
            ),

            'pre_op' => $this->processRejectReasons(
                $getRejectRaw(
                    (clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre operational%'")
                )
            ),

            'renewal' => $this->processRejectReasons(
                $getRejectRaw(
                    (clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%renewal%'")
                )
            ),
        ];

        $getStatusTable = function($query, $type = '') {

            $q = (clone $query)
                ->join('districts', 'districts.id', '=', 'applications.district_id');

            if (!empty($type)) {
                $q->whereRaw("LOWER(applications.application_type) LIKE ?", ["%$type%"]);
            }

            return $q->selectRaw("
                districts.name as district,

                COUNT(CASE WHEN applications.status IS NULL THEN 1 END) as not_assigned,

                COUNT(CASE WHEN applications.status = 'ASSIGNED' THEN 1 END) as assigned_not_verified,

                COUNT(CASE WHEN applications.status = 'VERIFIED' THEN 1 END) as verified,

                COUNT(CASE WHEN applications.status = 'APPROVED' THEN 1 END) as approved,

                COUNT(CASE WHEN applications.status = 'REVERTED' THEN 1 END) as rejected,

                COUNT(CASE WHEN applications.status = 'PENDING' THEN 1 END) as pending,

                COUNT(*) as total
            ")
            ->groupBy('districts.name')
            ->orderBy('districts.name')
            ->get();
        };

        return response()->json([
            'all' => $all,
            'pre_est' => $preEst,
            'pre_op' => $preOp,
            'renewal' => $renew,
            'tables' => $tables,
            'district_chart' => [
                'all'      => $getDistrictChart($baseQuery),
                'pre_est'  => $getDistrictChart($baseQuery, 'pre establishment'),
                'pre_op'   => $getDistrictChart($baseQuery, 'pre operational'),
                'renewal'  => $getDistrictChart($baseQuery, 'renewal'),
            ],
            'type_chart' => [
                'all' => $getTypeChart($baseQuery),
                'pre_est' => $getTypeChart((clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre establishment%'")),
                'pre_op' => $getTypeChart((clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre operational%'")),
                'renewal' => $getTypeChart((clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%renewal%'")),
            ],

            'reject_chart' => $reject_chart,
            'status_table' => [
                'all' => $getStatusTable($baseQuery),
                'pre_est' => $getStatusTable((clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre establishment%'")),
                'pre_op' => $getStatusTable((clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%pre operational%'")),
                'renewal' => $getStatusTable((clone $baseQuery)->whereRaw("LOWER(application_type) LIKE '%renewal%'")),
            ],
        ]);
    }

    function processRejectReasons($records) {

        $counts = [];

        foreach ($records as $item) {

            $jsonArray = json_decode($item, true);

            if (!$jsonArray) continue;

            foreach ($jsonArray as $entry) {

                if (!isset($entry['reason'])) continue;

                $reasons = json_decode($entry['reason'], true);

                if (!$reasons) continue;

                foreach ($reasons as $reason) {

                    if (!empty($reason)) {
                        $counts[$reason] = ($counts[$reason] ?? 0) + 1;
                    }
                }
            }
        }

        // convert to chart format
        $result = [];

        foreach ($counts as $reason => $total) {
            $result[] = [
                'reason' => $reason,
                'total'  => $total
            ];
        }

        return $result;
    }

    public function getNocTableData(Request $request)
    {
        $where = [];

        if ($request->district_id) {
            $where['district_id'] = $request->district_id;
        }

        if ($request->station_id) {
            $where['station_id'] = $request->station_id;
        }

        $query = DB::table('applications');

        if (!empty($where)) {
            $query->where($where);
        }

        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        // 🔥 Common function
        $getTable = function($type, $status) use ($query) {

            return (clone $query)
                ->where('application_type', $type)
                ->where('status', $status)
                ->join('districts', 'districts.id', '=', 'applications.district_id')
                ->selectRaw("
                    districts.name as district,
                    COUNT(CASE WHEN DATEDIFF(applications.updated_at, applications.created_at) <= 5 THEN 1 END) as days_0_5,
                    COUNT(CASE WHEN DATEDIFF(applications.updated_at, applications.created_at) BETWEEN 6 AND 10 THEN 1 END) as days_6_10,
                    COUNT(CASE WHEN DATEDIFF(applications.updated_at, applications.created_at) BETWEEN 11 AND 15 THEN 1 END) as days_11_15,
                    ROUND(AVG(DATEDIFF(applications.updated_at, applications.created_at)),2) as avg_days,
                    COUNT(*) as total
                ")
                ->groupBy('districts.name')
                ->get();
        };

        return response()->json([
            'pre_est' => [
                'approved' => $getTable('pre establishment noc', 'APPROVED'),
                'reverted' => $getTable('pre establishment noc', 'REVERTED'),
            ],
            'pre_op' => [
                'approved' => $getTable('pre operational noc', 'APPROVED'),
                'reverted' => $getTable('pre operational noc', 'REVERTED'),
            ],
            'renewal' => [
                'approved' => $getTable('renewal noc', 'APPROVED'),
                'reverted' => $getTable('renewal noc', 'REVERTED'),
            ]
        ]);
    }

    public function getVehicleData(Request $request)
    {
        $district_id = $request->district_id;
        $station_id  = $request->station_id;

        $query = DB::table('vehicle_types as vt')
            ->leftJoin('fs_vehicles as v', 'v.vehicle_type', '=', 'vt.id') // ✅ FIX

            ->when($district_id, function ($q) use ($district_id) {
                $q->where('v.district_id', $district_id);
            })
            ->when($station_id, function ($q) use ($station_id) {
                $q->where('v.station_id', $station_id);
            })

            ->select('vt.type', DB::raw('COUNT(v.id) as total'))
            ->groupBy('vt.type')
            ->get();


        // KPI
        $kpi = $query->mapWithKeys(function ($item) {
            return [$item->type => (int) $item->total];
        });

        // PIE
        $pie = [
            'labels' => $query->pluck('type')->toArray(), // ✅ FIX
            'data'   => $query->pluck('total')->toArray() // ✅ FIX
        ];

        $bar = DB::table('fs_vehicles as v')
            ->join('districts as d', 'd.id', '=', 'v.district_id') // ✅ join
            ->select(
                'v.district_id',
                'd.name as district_name', // ✅ get name
                DB::raw("SUM(CASE WHEN vehicle_remark = 'working' THEN 1 ELSE 0 END) as working"),
                DB::raw("SUM(CASE WHEN vehicle_remark = 'under maintenance' THEN 1 ELSE 0 END) as maintenance"),
                DB::raw("SUM(CASE WHEN vehicle_remark = 'out of road' THEN 1 ELSE 0 END) as out_of_road")
            )
            ->groupBy('v.district_id', 'd.name') // ✅ include name
            ->get();

        $table = DB::table('fs_vehicles as v')
            ->join('vehicle_types as vt', 'v.vehicle_type', '=', 'vt.id') // ✅ FIX
            ->join('districts as d', 'd.id', '=', 'v.district_id') // ✅ ADD
            ->select(
                'v.district_id',
                'd.name as district_name', // ✅ ADD
                'vt.type as vehicle_type',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('v.district_id', 'd.name', 'vt.type')
            ->get();

        return response()->json([
            'kpi' => $kpi,
            'pie' => $pie,
            'bar' => $bar,
            'table' => $table
        ]);
    }

    public function getFireReportData(Request $request)
    {
        $query = DB::table('fs_fire_report')
            ->join('fire_stations', 'fs_fire_report.station_id', '=', 'fire_stations.id')
            ->join('categories', 'fs_fire_report.category', '=', 'categories.id')
            ->join('districts', 'fs_fire_report.district_id', '=', 'districts.id')
            ->select(
                'fs_fire_report.*',
                'fire_stations.name as fire_station_name',
                'categories.name as categories_name',
                'districts.name as districts_name'
            );

        if (Auth::user()->type == '3') {
            $query->where('fs_fire_report.assigned_to', Auth::user()->id);
        } elseif (Auth::user()->type != '0' && Auth::user()->type != '1') {
            $query->where('fs_fire_report.district_id', Auth::user()->district_id);
        }

        if ($request->filled('from_date')) {
            $query->where('fs_fire_report.created_at', '>=', $request->from_date . ' 00:00:00');
        }

        if ($request->filled('to_date')) {
            $query->where('fs_fire_report.created_at', '<=', $request->to_date . ' 23:59:59');
        }

        $reports = $query->get();

        // Example aggregation (customize as needed)
        $districtData = $reports->groupBy('districts_name')->map->count();

        $categoryLabelsMap = [
            1 => 'Small Fire',
            2 => 'Medium Fire',
            3 => 'Major/special Fire',
            4 => 'Serious Fire',
        ];

        $categoryGrouped = $reports->groupBy('category')->map->count();

        $categoryLabels = [];
        $categoryValues = [];

        foreach ($categoryGrouped as $key => $count) {
            $categoryLabels[] = $categoryLabelsMap[$key] ?? 'Unknown';
            $categoryValues[] = $count;
        }

        $typeLabelsMap = [
            1 => 'Commercial',
            2 => 'Residential',
            3 => 'High Rise',
            4 => 'Forest',
            5 => 'Farm',
            6 => 'Industry',
            7 => 'Vehicle',
            8 => 'Other',
        ];

        $typeGrouped = $reports->groupBy('fire_area_type')->map->count();

        $typeLabels = [];
        $typeValues = [];

        foreach ($typeGrouped as $key => $count) {
            $typeLabels[] = $typeLabelsMap[$key] ?? 'Unknown';
            $typeValues[] = $count;
        }

        return response()->json([
            'labels' => $districtData->keys(),
            'data' => $districtData->values(),
            'categoryLabels' => $categoryLabels,
            'categoryData' => $categoryValues,
            'typeLabels' => $typeLabels,
            'typeData' => $typeValues,
            'raw' => $reports
        ]);
    }

    public function getRescueDashboardData(Request $request)
    {
        $district_id = $request->district_id;
        $station_id  = $request->station_id;
        $start_date  = $request->start_date;
        $end_date    = $request->end_date;

        $query = DB::table('fs_rescue_report as r')
            ->leftJoin('districts as d', 'd.id', '=', 'r.district_id');

        // 🔐 Role filter
        if (Auth::user()->type == 3) {
            $query->where('r.assigned_to', Auth::user()->id);
        } elseif (Auth::user()->type != 0 && Auth::user()->type != 1) {
            $query->where('r.district_id', Auth::user()->district_id);
        }

        // 🔎 Filters
        if ($district_id) {
            $query->where('r.district_id', $district_id);
        }

        if ($station_id) {
            $query->where('r.station_id', $station_id);
        }

        if ($start_date) {
            $query->where('r.created_at', '>=', $start_date . ' 00:00:00');
        }

        if ($end_date) {
            $query->where('r.created_at', '<=', $end_date . ' 23:59:59');
        }

        // ================= KPI =================
        $kpi = [
            'total_call' => (clone $query)->count(),

            'report_completed' => (clone $query)->where('r.status', 3)->count(),
            'report_incompleted' => (clone $query)->where('r.status', 0)->count(),
            'pending_approval' => (clone $query)->where('r.status', 1)->count(),
            'under_investigation' => (clone $query)->where('r.status', 2)->count(),
            'report_issued' => (clone $query)->where('r.status', 4)->count(),
        ];

        // ================= BAR (District wise) =================
        $bar = (clone $query)
            ->select(
                'r.district_id',
                'd.name as district_name',
                DB::raw('COUNT(r.id) as total')
            )
            ->groupBy('r.district_id', 'd.name')
            ->orderBy('d.name')
            ->get();

        // ================= PIE (Rescue Reason) =================
        $pieData = (clone $query)
            ->select(
                'r.rescue_reason',
                DB::raw('COUNT(r.id) as total')
            )
            ->whereNotNull('r.rescue_reason')
            ->groupBy('r.rescue_reason')
            ->get();

        $pie = [
            'labels' => $pieData->pluck('rescue_reason')->toArray(),
            'data'   => $pieData->pluck('total')->toArray(),
        ];

        // ================= TABLE (Month wise) =================
        $table = (clone $query)
            ->select(
                'r.district_id',
                'd.name as district_name',
                DB::raw('MONTH(r.created_at) as month_no'),
                DB::raw('COUNT(r.id) as total')
            )
            ->groupBy('r.district_id', 'd.name', DB::raw('MONTH(r.created_at)'))
            ->orderBy('d.name')
            ->get();

        return response()->json([
            'kpi'   => $kpi,
            'bar'   => $bar,
            'pie'   => $pie,
            'table' => $table,
        ]);
    }

    public function getReliefDashboardData(Request $request)
    {
        $district_id = $request->district_id;
        $station_id  = $request->station_id;
        $start_date  = $request->start_date;
        $end_date    = $request->end_date;

        $query = DB::table('fs_relief_work_report as r')
            ->leftJoin('districts as d', 'd.id', '=', 'r.district_id');

        // 🔐 Role filter
        if (Auth::user()->type == 3) {
            $query->where('r.assigned_to', Auth::user()->id);
        } elseif (Auth::user()->type != 0 && Auth::user()->type != 1) {
            $query->where('r.district_id', Auth::user()->district_id);
        }

        // 🔎 Filters
        if ($district_id) {
            $query->where('r.district_id', $district_id);
        }

        if ($station_id) {
            $query->where('r.station_id', $station_id);
        }

        if ($start_date) {
            $query->where('r.created_at', '>=', $start_date . ' 00:00:00');
        }

        if ($end_date) {
            $query->where('r.created_at', '<=', $end_date . ' 23:59:59');
        }

        // ================= KPI =================
        $kpi = [
            'total_call' => (clone $query)->count(),

            'report_completed' => (clone $query)->where('r.status', 3)->count(),

            'report_incompleted' => (clone $query)->where('r.status', 0)->count(),

            'report_pending' => (clone $query)->where('r.status', 1)->count(),

            'report_investigation' => (clone $query)->where('r.status', 2)->count(),

            'report_issued' => (clone $query)->where('r.status', 4)->count(),
        ];

        // ================= BAR =================
        $bar = (clone $query)
            ->select(
                'r.district_id',
                'd.name as district_name',
                DB::raw('COUNT(r.id) as total')
            )
            ->groupBy('r.district_id', 'd.name')
            ->orderBy('d.name')
            ->get();

        // ================= PIE (USING TYPE) =================
        $pieData = (clone $query)
            ->select(
                'r.relief_work_type',
                DB::raw('COUNT(r.id) as total')
            )
            ->whereNotNull('r.relief_work_type')
            ->groupBy('r.relief_work_type')
            ->get();

        // 🔥 Mapping (ID → Label)

        $typeMap = [
            1 => 'Disaster Dewatering (आपदा में पानी निकलना)',
            2 => 'Removing Fallen Tree (गिरे पेड़ हटाना)',
            3 => 'Clear Passage (रास्ता सुचारू)',
            4 => 'Relief Distribution (राहत सामग्री)',
            5 => 'Public Kitchen (भोजन)',
            6 => 'Medicine Distribution (दवाई)',
            7 => 'Counseling (काउंसलिंग)',
            8 => 'Evacuation (निकासी)',
            9 => 'Other (अन्य)'
        ];

        $labels = [];
        $data   = [];

        foreach ($pieData as $item) {
            if ($item->total > 0) {
                $labels[] = $typeMap[$item->relief_work_type] ?? 'Unknown';
                $data[]   = (int) $item->total;
            }
        }

        $pie = [
            'labels' => $labels,
            'data'   => $data
        ];

        // ================= TABLE =================
        $table = (clone $query)
            ->select(
                'r.district_id',
                'd.name as district_name',
                DB::raw('MONTH(r.created_at) as month_no'),
                DB::raw('COUNT(r.id) as total')
            )
            ->groupBy('r.district_id', 'd.name', DB::raw('MONTH(r.created_at)'))
            ->orderBy('d.name')
            ->get();

        return response()->json([
            'kpi'   => $kpi,
            'bar'   => $bar,
            'pie'   => $pie,
            'table' => $table,
        ]);
    }

    public function getHydrantDashboardData(Request $request)
    {
        $district_id = $request->district_id;
        $station_id  = $request->station_id;

        $query = DB::table('fs_hydrant as h')
            ->leftJoin('districts as d', 'd.id', '=', 'h.district_id')
            ->leftJoin('hydrant_condition as hc', 'hc.id', '=', 'h.hydrant_condition');

        // 🔎 Filters
        if ($district_id) {
            $query->where('h.district_id', $district_id);
        }

        if ($station_id) {
            $query->where('h.station_id', $station_id);
        }

        // ================= BAR =================
        $bar = (clone $query)
            ->select(
                'h.district_id',
                'd.name as district_name',

                DB::raw("SUM(CASE WHEN h.hydrant_condition = 1 THEN 1 ELSE 0 END) as working"),
                DB::raw("SUM(CASE WHEN h.hydrant_condition = 2 THEN 1 ELSE 0 END) as not_working"),
                DB::raw("SUM(CASE WHEN h.hydrant_condition = 3 THEN 1 ELSE 0 END) as proposed")
            )
            ->groupBy('h.district_id', 'd.name')
            ->orderBy('d.name')
            ->get();

        // ================= PIE =================
        $pieData = (clone $query)
            ->select(
                'hc.hydrant_condition',
                DB::raw('COUNT(h.id) as total')
            )
            ->groupBy('hc.hydrant_condition')
            ->get();

        $pie = [
            'labels' => $pieData->pluck('hydrant_condition')->toArray(),
            'data'   => $pieData->pluck('total')->toArray(),
        ];

        return response()->json([
            'bar' => $bar,
            'pie' => $pie
        ]);
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
  
}
<?php

namespace App\Http\Controllers\FSO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ServiceBill;
use App\Models\ServiceBillPersonnel;
use App\Models\ServiceBillVehicle;
use App\Models\ServiceBillEquipment;
use App\Models\PersonnelExpenseRegister;
use App\Models\VehicleCategory;
use App\Models\VehicleModel;
use App\Models\EquipmentCategory;
use App\Models\EquipmentName;
use App\Models\FireReport;
use App\Models\DesignationMaster;
use Illuminate\Support\Facades\DB;

class PumpingBillController extends Controller
{
    public function create()
    {
        $query = FireReport::where('bill_generated', 0);

        $user = Auth::user();

        if ($user->type == '3') {
            $query->where(function ($q) use ($user) {
                $q->where('station_id', $user->station_id)
                ->orWhere('assigned_to', $user->id);
            })->distinct();
        } elseif ($user->type == '1' || $user->type == '2') {
            $query->where('district_id', $user->district_id);
        }

        $fireReports = $query->get();

        $reports = $fireReports;

        $designations = PersonnelExpenseRegister::with('designation')->get();
        $vehicles = VehicleCategory::select('id', 'type', 'mileage_value', 'mileage_type')->get();
        $equipments = EquipmentCategory::select('id', 'name', 'mileage_value', 'mileage_type')->get();

        return view('fso.pumping_bills.create', compact(
            'reports',
            'designations',
            'vehicles',
            'equipments'
        ));
    }

    public function getReport($type, $id)
    {
        if ($type != 'fire') abort(404);

        $report = FireReport::findOrFail($id);

        // Mapping of report columns → designation name (as stored in designation_master)
        $designationMap = [
            'cfo'  => 'Chief Fire Officer',
            'fso'  => 'Fire Station Officer',
            'fsso' => 'Fire Station Second Officer',
            'lfm'  => 'Leading Fireman',
            'dvr'  => 'Fire Service Driver',
            'fm'   => 'Fireman',
            // Add more mappings if needed (e.g., 'dm' => 'Deputy Director')
        ];

        $personnel = [];

        foreach ($designationMap as $column => $designationName) {
            $value = $report->$column;
            if (!empty($value)) {
                // Split comma‑separated names, trim spaces
                $names = array_map('trim', explode(',', $value));
                $count = count($names);

                // Find the designation ID from designation_master
                $designation = DesignationMaster::where('designation_name', $designationName)->first();
                if ($designation) {
                    // Get the expense register for this designation
                    $expenseRegister = PersonnelExpenseRegister::where('designation_id', $designation->id)->first();
                    $expense = $expenseRegister ? $expenseRegister->monthly_basic_expense : 0;
                    $da = $expenseRegister ? $expenseRegister->da_percent : 0;

                    // Calculate total = (expense * count) + DA%
                    $total = ($expense * $count) * (1 + ($da / 100)) / 30;

                    $personnel[] = [
                        'designation_id' => $designation->id,
                        'count'          => $count,
                        'expense'        => $expense,
                        'da'             => $da,
                        'total'          => $total,
                    ];
                }
            }
        }

        
        $vehicleData = json_decode($report->vehicle_data, true);

        $grouped = [];
        if (is_array($vehicleData)) {
            foreach ($vehicleData as $vehId => $km) {
                $vehicle = VehicleModel::find($vehId);
                if ($vehicle) {
                    $typeId = $vehicle->vehicle_type; // foreign key to vehicle_types
                    if (!isset($grouped[$typeId])) {
                        $grouped[$typeId] = [
                            'total_km' => 0,
                            'count' => 0,
                        ];
                    }
                    $grouped[$typeId]['total_km'] += $km;
                    $grouped[$typeId]['count']++;
                }
            }
        }

        $vehicles = [];
        foreach ($grouped as $typeId => $data) {
            // Check if the vehicle type exists in VehicleCategory
            $category = VehicleCategory::find($typeId);
            if ($category) {
                $vehicles[] = [
                    'vehicle_type_id' => $typeId,
                    'running' => $data['total_km'],
                    'count' => $data['count'],
                    // we can also pass mileage, type if needed but they are in the dropdown options
                ];
            }
        }

        // echo "<pre>";
        // print_r($vehicles);
        // exit('pp');

        $equipmentData = json_decode($report->equipment_data, true);
        $groupedEquipments = [];
        if (is_array($equipmentData)) {
            foreach ($equipmentData as $eqId => $hours) {
                $equipment = EquipmentName::find($eqId);
                if ($equipment) {
                    $catId = $equipment->category_id;
                    if (!isset($groupedEquipments[$catId])) {
                        $groupedEquipments[$catId] = ['total_hours' => 0, 'count' => 0];
                    }
                    $groupedEquipments[$catId]['total_hours'] += $hours;
                    $groupedEquipments[$catId]['count']++;
                }
            }
        }

        $equipments = [];
        foreach ($groupedEquipments as $catId => $data) {
            $category = EquipmentCategory::find($catId);
            if ($category) {
                $equipments[] = [
                    'equipment_id' => $catId, // matches dropdown value (equipment_category.id)
                    'running'      => $data['total_hours'],
                ];
            }
        }

        return response()->json([
            'organisation_name' => $report->organisation_name ?? $report->informer_name ?? '',
            'address'           => $report->address ?? $report->incident_address ?? '',
            'mobile'            => $report->mobile ?? $report->informer_contact_no ?? '',
            'email'             => $report->email ?? '',
            'service_description'=> $report->service_description ?? $report->short_description ?? '',
            'personnel'         => $personnel,
            'vehicles'          => $vehicles,
            'equipments'        => $equipments,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'report_type'        => 'nullable|in:fire',
            'report_id'          => 'nullable|integer|exists:fs_fire_report,id',
            'organisation_name'  => 'required_if:report_id,null|string|max:255',
            'address'            => 'nullable|string',
            'mobile'             => 'nullable|string',
            'email'              => 'nullable|email',
            'service_description'=> 'nullable|string',
            'diesel_rate'        => 'required|numeric|min:0',
            'fuel_expense'       => 'nullable|numeric',
            'depreciation_expense'=> 'nullable|numeric',
            'personnel_expense'  => 'nullable|numeric',
            'cgst_amount'        => 'nullable|numeric',
            'sgst_amount'        => 'nullable|numeric',
            'total_amount'       => 'nullable|numeric',
        ]);

        // 2. Determine linked report (if any)
        $report = null;
        if ($request->filled('report_id') && $request->filled('report_type')) {
            $report = FireReport::find($request->report_id);
            if (!$report) {
                return back()->with('error', 'Selected report not found.');
            }
            // Check if bill already generated for this report
            $existing = ServiceBill::where('service_type', 'pumping_work')
                ->where('service_request_id', $report->id)
                ->where('event_type', 'fire')
                ->first();
            if ($existing) {
                return redirect()->route('service-bills.show', $existing->id)
                    ->with('success', 'Pumping bill already generated for this report.');
            }
            $organisation_name = $report->organisation_name ?? $report->informer_name ?? '';
            $address = $report->address ?? $report->incident_address ?? '';
            $mobile = $report->mobile ?? $report->informer_contact_no ?? '';
            $email = $report->email ?? '';
            $service_description = $report->service_description ?? $report->short_description ?? '';
            $requestId = $report->id;
        } else {
            // Manual entry – we can create a "pumping request" record later, but for now we store details only in the bill
            $organisation_name = $request->organisation_name;
            $address = $request->address;
            $mobile = $request->mobile;
            $email = $request->email;
            $service_description = $request->service_description;
            $requestId = 'MANUAL_' . date('YmdHis');
        }

        // 3. Generate bill number
        $billNo = 'PB' . date('YmdHis');

        // 4. Create main bill record
        $bill = ServiceBill::create([
            'service_type'          => 'pumping_work',
            'service_request_id'    => $requestId,
            'bill_no'               => $billNo,
            'event_type'            => $report ? 'fire' : null,
            'recipient_name'        => $organisation_name,
            'diesel_rate'           => $request->diesel_rate,
            'fuel_expense'          => $request->fuel_expense ?? 0,
            'depreciation_expense'  => $request->depreciation_expense ?? 0,
            'personnel_expense'     => $request->personnel_expense ?? 0,
            'cgst_amount'           => $request->cgst_amount ?? 0,
            'sgst_amount'           => $request->sgst_amount ?? 0,
            'total_amount'          => $request->total_amount ?? 0,
            'payment_status'        => 'pending',
            'created_by'            => Auth::id(),
        ]);

        // 5. If report linked, update it
        if ($report) {
            $report->update([
                'bill_generated'   => 1,
                'payment_status'   => 'pending',
                'service_bill_id'  => $bill->id,
            ]);
        }

        // 6. Save personnel details
        if ($request->has('designation_id')) {
            foreach ($request->designation_id as $key => $desId) {
                if (empty($desId)) continue;
                ServiceBillPersonnel::create([
                    'bill_id'           => $bill->id,
                    'designation_id'    => $desId,
                    'no_of_person'      => $request->no_of_person[$key] ?? 0,
                    'no_of_days'        => $request->no_of_days[$key] ?? 1,
                    'per_person_expense'=> $request->expense[$key] ?? 0,
                    'da_amount'         => $request->da[$key] ?? 0,
                    'total_amount'      => $request->person_total[$key] ?? 0,
                ]);
            }
        }

        // 7. Save vehicles (category based)
        if ($request->has('vehicle_type_id')) {
            foreach ($request->vehicle_type_id as $key => $typeId) {
                if (empty($typeId)) continue;
                ServiceBillVehicle::create([
                    'bill_id'        => $bill->id,
                    'vehicle_type_id'=> $typeId,   // category ID
                    'diesel_rate'    => $request->diesel_rate,
                    'mileage_value'  => $request->vehicle_mileage[$key] ?? 0,
                    'mileage_type'   => $request->vehicle_mileage_type[$key] ?? null,
                    'running_value'  => $request->vehicle_running[$key] ?? 0,
                    'total_expense'  => $request->vehicle_total[$key] ?? 0,
                ]);
            }
        }

        // 8. Save equipment (category based)
        if ($request->has('equipment_type_id')) {
            foreach ($request->equipment_type_id as $key => $typeId) {
                if (empty($typeId)) continue;
                ServiceBillEquipment::create([
                    'bill_id'               => $bill->id,
                    'equipment_category_id' => $typeId, // category ID
                    'mileage_value'         => $request->equipment_mileage[$key] ?? 0,
                    'mileage_type'          => $request->equipment_mileage_type[$key] ?? null,
                    'running_value'         => $request->equipment_running[$key] ?? 0,
                    'total_expense'         => $request->equipment_total[$key] ?? 0,
                ]);
            }
        }

        // 9. Redirect to show bill
        return redirect()->route('service-bills.show', $bill->id)
            ->with('success', 'Pumping bill generated successfully.');
    }

    private function getModelClass($type)
    {
        // Since we only use 'fire', we can simplify, but keep for future
        return $type == 'fire' ? FireReport::class : null;
    }
}
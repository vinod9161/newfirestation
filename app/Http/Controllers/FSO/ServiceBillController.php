<?php

namespace App\Http\Controllers\FSO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Standby;
use App\Models\ServiceBill;
use App\Models\ServiceBillPersonnel;
use App\Models\ServiceBillVehicle;
use App\Models\ServiceBillEquipment;
use App\Models\PersonnelExpenseRegister;
use App\Models\VehicleCategory;
use App\Models\EquipmentCategory;
use App\Models\ReportFeeMaster;
use DB;


class ServiceBillController extends Controller
{
    public function index(Request $request)
    {
        $query = ServiceBill::query();

        if ($request->filled('bill_no'))
        {
            $query->where(
                'bill_no',
                'LIKE',
                '%' . $request->bill_no . '%'
            );
        }

        if ($request->filled('service_type'))
        {
            $query->where(
                'service_type',
                $request->service_type
            );
        }

        if ($request->filled('request_id'))
        {
            $query->where(
                'service_request_id',
                $request->request_id
            );
        }

        if ($request->filled('payment_status'))
        {
            $query->where(
                'payment_status',
                $request->payment_status
            );
        }

        if ($request->filled('from_date'))
        {
            $query->whereDate(
                'created_at',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date'))
        {
            $query->whereDate(
                'created_at',
                '<=',
                $request->to_date
            );
        }

        $bills = $query
            ->latest()
            ->paginate(20)
            ->appends($request->query());

        return view(
            'fso.service_bills.index',
            compact('bills')
        );
    }

    public function create($service_type,$request_id)
    {
        if($service_type=='standby_duty'){
            $request=Standby::where('application_id', $request_id)->firstOrFail();
        }else{
            abort(404);
        }

        $designations=PersonnelExpenseRegister::with('designation')->get();
        $vehicles=VehicleCategory::get();
        $equipments=EquipmentCategory::get();

        return view('fso.service_bills.create',
            compact(
                'request',
                'service_type',
                'designations',
                'vehicles',
                'equipments'
            )
        );
    }

    public function store(Request $request)
    {
        $billNo='SB'.date('YmdHis');
        $alreadyExists=ServiceBill::where(
                'service_type',
                $request->service_type
            )
            ->where(
                'service_request_id',
                $request->request_id
            )
            ->first();

        if($alreadyExists){

            return redirect()
                ->route(
                    'service-bills.show',
                    $alreadyExists->id
                )
                ->with(
                    'success',
                    'Bill already generated.'
                );
        }

        $bill=ServiceBill::create([
            'service_type'=>$request->service_type,
            'service_request_id'=>$request->request_id,
            'bill_no'=>$billNo,
            'diesel_rate' => $request->fuel_rate ?? $request->diesel_rate,
            'fuel_expense'=>$request->fuel_expense,
            'depreciation_expense'=>$request->depreciation_expense,
            'personnel_expense'=>$request->personnel_expense,
            'cgst_amount'=>$request->cgst_amount,
            'sgst_amount'=>$request->sgst_amount,
            'total_amount'=>$request->total_amount,
            'payment_status'=>'pending',
            'created_by'=>Auth::id()
        ]);

        if($request->service_type=='standby_duty'){
            Standby::where(
                'application_id',
                $request->request_id
            )
            ->update([
                'bill_generated'=>1,
                'payment_status'=>'pending',
                'service_bill_id'=>$bill->id
            ]);
        }

        if($request->designation_id){
            foreach($request->designation_id as $key=>$designationId){
                if(!$designationId){
                    continue;
                }

                ServiceBillPersonnel::create([
                    'bill_id'=>$bill->id,
                    'designation_id'=>$designationId,
                    'no_of_person'=>$request->no_of_person[$key] ?? 0,
                    'no_of_days' => $request->days[$key] ?? 1,
                    'per_person_expense'=>$request->expense[$key] ?? 0,
                    'da_amount'=>$request->da[$key] ?? 0,
                    'total_amount'=>$request->person_total[$key] ?? 0
                ]);
            }
        }

        if($request->vehicle_id){

            foreach($request->vehicle_id as $key=>$vehicleId){

                if(!$vehicleId){
                    continue;
                }

                ServiceBillVehicle::create([

                    'bill_id'=>$bill->id,

                    'vehicle_type_id'=>$vehicleId,

                    'diesel_rate' => $request->fuel_rate ?? $request->diesel_rate,

                    'mileage_value'=>$request->vehicle_mileage[$key] ?? 0,

                    'mileage_type'=>$request->vehicle_mileage_type[$key] ?? null,

                    'running_value'=>$request->vehicle_running[$key] ?? 0,

                    'total_expense'=>$request->vehicle_total[$key] ?? 0

                ]);

            }

        }

        if($request->equipment_id){

            foreach($request->equipment_id as $key=>$equipmentId){

                if(!$equipmentId){
                    continue;
                }

                ServiceBillEquipment::create([

                    'bill_id'=>$bill->id,

                    'equipment_category_id'=>$equipmentId,

                    'mileage_value'=>$request->equipment_mileage[$key] ?? 0,

                    'mileage_type'=>$request->equipment_mileage_type[$key] ?? null,

                    'running_value'=>$request->equipment_running[$key] ?? 0,

                    'total_expense'=>$request->equipment_total[$key] ?? 0

                ]);

            }

        }

        return redirect()->route(
            'service-bills.show',
            $bill->id
        )->with(
            'success',
            'Service bill generated successfully.'
        );
    }

    public function show($id)
    {
        $bill=ServiceBill::findOrFail($id);

        $personnels=ServiceBillPersonnel::with(
                'designation'
            )
            ->where(
                'bill_id',
                $bill->id
            )
            ->get();

        $vehicles=ServiceBillVehicle::with(
                'vehicle'
            )
            ->where(
                'bill_id',
                $bill->id
            )
            ->get();

        $equipments=ServiceBillEquipment::with(
                'equipment'
            )
            ->where(
                'bill_id',
                $bill->id
            )
            ->get();

        return view(
            'fso.service_bills.show',
            compact(
                'bill',
                'personnels',
                'vehicles',
                'equipments'
            )
        );
    }


    public function print($id)
    {
        $bill=ServiceBill::findOrFail($id);

        $personnels=ServiceBillPersonnel::with(
                'designation'
            )
            ->where(
                'bill_id',
                $bill->id
            )
            ->get();

        $vehicles=ServiceBillVehicle::with(
                'vehicle'
            )
            ->where(
                'bill_id',
                $bill->id
            )
            ->get();

        $equipments=ServiceBillEquipment::with(
                'equipment'
            )
            ->where(
                'bill_id',
                $bill->id
            )
            ->get();

        return view(
            'fso.service_bills.print',
            compact(
                'bill',
                'personnels',
                'vehicles',
                'equipments'
            )
        );
    }

    public function createReportBill($service_type,$request_id)
    {
        if(!in_array($service_type,['fire_report','rescue_report','relief_report'])){
            abort(404);
        }

        if($service_type=='fire_report'){

            $report=DB::table('fs_fire_report')
                ->where('id',$request_id)
                ->first();

        }elseif($service_type=='rescue_report'){

            $report=DB::table('fs_rescue_report')
                ->where('id',$request_id)
                ->first();

        }else{

            $report=DB::table('fs_relief_work_report')
                ->where('id',$request_id)
                ->first();

        }

        if(!$report){
            return redirect()
                ->back()
                ->with('failed','Report not found.');
        }

        $alreadyExists=ServiceBill::where('service_type',$service_type)
            ->where('service_request_id',$request_id)
            ->first();

        if($alreadyExists){
            return redirect()
                ->route('service-bills.show',$alreadyExists->id)
                ->with('success','Bill already generated.');
        }

        $reportFee=ReportFeeMaster::where('report_type',$service_type)
            ->firstOrFail();

        return view(
            'fso.service_bills.report_create',
            compact(
                'service_type',
                'request_id',
                'reportFee',
                'report'
            )
        );
    }

    public function storeReportBill(Request $request)
    {
        if(!in_array($request->service_type,[
            'fire_report',
            'rescue_report',
            'relief_report'
        ])){
            abort(404);
        }

        if($request->service_type=='fire_report'){
            $report=DB::table('fs_fire_report')
                ->where('id',$request->request_id)
                ->first();

        }elseif($request->service_type=='rescue_report'){
            $report=DB::table('fs_rescue_report')
                ->where('id',$request->request_id)
                ->first();

        }else{

            $report=DB::table('fs_relief_work_report')
                ->where('id',$request->request_id)
                ->first();

        }

        if(!$report){

            return redirect()
                ->back()
                ->with('failed','Report not found.');

        }

        $alreadyExists=ServiceBill::where('service_type',$request->service_type)
            ->where('service_request_id',$request->request_id)
            ->first();

        if($alreadyExists){

            return redirect()
                ->route('service-bills.show',$alreadyExists->id)
                ->with('success','Bill already generated.');

        }

        $processingFee=$request->processing_fee;

        $cgst=($processingFee * $request->cgst_percent)/100;

        $sgst=($processingFee * $request->sgst_percent)/100;

        $total=$processingFee + $cgst + $sgst;

        $billNo='SRB'.date('YmdHis');

        $bill=ServiceBill::create([
            'service_type'=>$request->service_type,
            'service_request_id'=>$request->request_id,
            'bill_no'=>$billNo,
            'processing_fee'=>$processingFee,
            'cgst_amount'=>$cgst,
            'sgst_amount'=>$sgst,
            'total_amount'=>$total,
            'payment_status'=>'pending',
            'created_by'=>Auth::id()
        ]);

        $this->updateReportBillStatus(
            $request->service_type,
            $request->request_id,
            $bill->id,
            'pending'
        );

        return redirect()
            ->route('service-bills.show',$bill->id)
            ->with('success','Report bill generated successfully.');
    }

    private function updateReportBillStatus(
        $service_type,
        $request_id,
        $bill_id,
        $payment_status='pending'
    )
    {
        if($service_type=='standby_duty'){
            Standby::where(
                'application_id',
                $request_id
            )
            ->update([
                'bill_generated'=>1,
                'payment_status'=>$payment_status,
                'service_bill_id'=>$bill_id
            ]);
        }
        if($service_type=='fire_report'){

            DB::table('fs_fire_report')
                ->where('id',$request_id)
                ->update([
                    'bill_generated'=>1,
                    'payment_status'=>$payment_status,
                    'service_bill_id'=>$bill_id
                ]);

        }elseif($service_type=='rescue_report'){

            DB::table('fs_rescue_report')
                ->where('id',$request_id)
                ->update([
                    'bill_generated'=>1,
                    'payment_status'=>$payment_status,
                    'service_bill_id'=>$bill_id
                ]);

        }elseif($service_type=='relief_report'){
            DB::table('fs_relief_work_report')
                ->where('id',$request_id)
                ->update([
                    'bill_generated'=>1,
                    'payment_status'=>$payment_status,
                    'service_bill_id'=>$bill_id
                ]);
        }
    }
}
<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\ReliefReportModel;
use App\Models\Models\User as NewUser;
use App\Models\Models\Station as NewStation;
use App\Models\Models\Station;
use App\Models\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Common\CommonModel;
use Carbon\Carbon;


class ReliefReportController extends Controller{

    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function index(Request $request)
    {
        $query = DB::table('fs_relief_work_report')
            ->join(
                'fire_stations',
                'fs_relief_work_report.station_id',
                '=',
                'fire_stations.id'
            )
            ->join(
                'districts',
                'fs_relief_work_report.district_id',
                '=',
                'districts.id'
            )
            ->select(
                'fs_relief_work_report.*',
                'fire_stations.name as fire_station_name',
                'districts.name as district_name'
            );


        if (Auth::user()->type == 3)
        {
            $query->where(
                'fs_relief_work_report.assigned_to',
                Auth::user()->id
            );
        }
        elseif (
            Auth::user()->type != 0
            && Auth::user()->type != 1
        )
        {
            $query->where(
                'fs_relief_work_report.district_id',
                Auth::user()->district_id
            );
        }

        if ($request->filled('relief_report_no'))
        {
            $query->where(
                'fs_relief_work_report.relief_report_no',
                'LIKE',
                '%' . $request->relief_report_no . '%'
            );
        }

        if ($request->filled('district_id'))
        {
            $query->where(
                'fs_relief_work_report.district_id',
                $request->district_id
            );
        }

        if ($request->filled('station_id'))
        {
            $query->where(
                'fs_relief_work_report.station_id',
                $request->station_id
            );
        }

        if ($request->filled('relief_work_type'))
        {
            $query->where(
                'fs_relief_work_report.relief_work_type',
                $request->relief_work_type
            );
        }

        if ($request->filled('status'))
        {
            $query->where(
                'fs_relief_work_report.status',
                $request->status
            );
        }

        if ($request->filled('from_date'))
        {
            $query->whereDate(
                'fs_relief_work_report.created_at',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date'))
        {
            $query->whereDate(
                'fs_relief_work_report.created_at',
                '<=',
                $request->to_date
            );
        }

        $data['districts'] = DB::table('districts')
            ->orderBy('name')
            ->get();

        $data['stations'] = DB::table('fire_stations')
            ->orderBy('name')
            ->get();

        $data['fs_relief_report'] = $query
            ->orderBy(
                'fs_relief_work_report.created_at',
                'DESC'
            )
            ->get()
            ->toArray();

        return view(
            'admin.ReliefReport.reliefReport',
            $data
        );
    }

    public function deleteReliefReport($id)
    {
        $record = ReliefReportModel::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.reliefReport')->with('success', 'Record deleted successfully.');
    }
    public function addReliefReport()
    {
        $vehicle = $this->commonModel->getData('fs_vehicles');
        $vehicles = [];
        foreach($vehicle as $key => $veh)
        {
            $vehicleType = $this->commonModel->getDataByOneCondition('vehicle_types', array('id' => $veh->vehicle_type));
            $vehicles[] = [
                'id' => $veh->id,
                'reg_number' => $veh->reg_number,
                'vehicle_type' => isset($vehicleType[0]->type) ? $vehicleType[0]->type : 'NA',
                
            ];
        }
        $districts = $this->commonModel->getData('districts');

        $cfo = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Chief fire officer'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));


        $fso = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fire station officer'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $fsso = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fire station second officer'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $lfm = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Leading fireman'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $dvr = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fire service driver'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $fm = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fireman'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));
        
        $stations = $this->commonModel->getData('fire_stations');

        return view('admin.ReliefReport.add',compact('vehicles','cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm', 'districts', 'stations'));
    }
    public function editReliefReport($id)
    {
        $vehicle = $this->commonModel->getData('fs_vehicles');
        $vehicles = [];
        foreach($vehicle as $key => $veh)
        {
            $vehicleType = $this->commonModel->getDataByOneCondition('vehicle_types', array('id' => $veh->vehicle_type));
            $vehicles[] = [
                'id' => $veh->id,
                'reg_number' => $veh->reg_number,
                'vehicle_type' => $vehicleType[0]->type,
            ];
        }
        $districts = $this->commonModel->getData('districts');

        $cfo = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Chief fire officer'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));


        $fso = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fire station officer'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $fsso = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fire station second officer'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $lfm = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Leading fireman'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $dvr = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fire service driver'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        $fm = $this->commonModel->getDataByThreeCondition('fs_employee', array('designation' => 'Fireman'), array('district_id' => Auth::user()->district_id), array('status' => 'Active'));

        
        $stations = $this->commonModel->getData('fire_stations');

        $reliefReport = $this->commonModel->getDataByOneCondition('fs_relief_work_report', array('id' => $id));

        return view('admin.ReliefReport.edit',compact('reliefReport', 'vehicles','cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm', 'districts', 'stations'));
    }
    public function viewReliefReport($id)
    {
        $reliefReport = $this->commonModel->getDataByOneCondition('fs_relief_work_report', array('id' => $id));
        $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $reliefReport[0]->district_id));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $reliefReport[0]->station_id));
        $vehicleArray = json_decode($reliefReport[0]->vehicle_id,true);
        $pumpArray = json_decode($reliefReport[0]->pumping_km);
        $vehicle = [];
        for($v=0;$v<count($vehicleArray);$v++)
        {
            $vehicleData = $this->commonModel->getDataByOneCondition('fs_vehicles', array('id' => $vehicleArray[$v]));
            if(!empty($vehicleData))
            { 
                $vehicleType = $this->commonModel->getDataByOneCondition('vehicle_types', array('id' => $vehicleData[0]->vehicle_type));
                $vehicle[] = [
                    'vehicle'       => isset($vehicleType[0]) ?$vehicleData[0]->reg_number: 'NA',
                    'vehicle_type'  => isset($vehicleType[0]) ? $vehicleType[0]->type : 'NA',
                    'pumping_km'    => $pumpArray[$v],
                ];
            }
            else
            {
                $vehicle[] = [
                    'vehicle'       => 'NA',
                    'vehicle_type'  => 'NA',
                    'pumping_km'    => 0,
                ];
            }
        }
        return view('admin.ReliefReport.view',compact('reliefReport','district','station','vehicle'));
    }
    public function saveReliefReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'relief_report_no' => 'required',
            'monthly_no' => 'required',
            'district_id' => 'required',
            'station_id' => 'required',
            'incident_datetime' => 'required',
            'informer_name' => 'required',
            'informer_contact_no' => 'required',
            'info_medium' => 'required',
            'incident_address' => 'required',
            'info_datetime' => 'required',
            'station_depart_datetime' => 'required',
            'site_arrive_datetime' => 'required',
            'station_return_datetime' => 'required',
            'distance' => 'required',
            'vehicle_id' => 'required',
            'pumping_km' => 'required',
            'relief_work_area' => 'required',
            'relief_work_type' => 'required',
            'relief_work_reason' => 'required',
            'description' => 'required',
            'incident_longitude' => 'required',
            'incident_latitude' => 'required',
            
            'owner_name' => 'required',
            'owner_address' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('upload_file')) {
            $imageName = time().'.'.$request->upload_file->extension();  
            $request->upload_file->move('admin/releifReport', $imageName);
            $reportPdf = 'admin/reliefReport/'.$imageName;
        }
        else
        {
            $reportPdf = null;
        }

        $incidentDateTime = Carbon::parse($request->input('incident_datetime'))->format('Y-m-d h:i A');
        $incidentFormattedDateTime = Carbon::parse($incidentDateTime)->format('Y-m-d H:i:s');

        $infoDateTime = Carbon::parse($request->input('info_datetime'))->format('Y-m-d h:i A');
        $infoFormattedDateTime = Carbon::parse($infoDateTime)->format('Y-m-d H:i:s');
        
        $departDateTime = Carbon::parse($request->input('station_depart_datetime'))->format('Y-m-d h:i A');
        $departFormattedDateTime = Carbon::parse($departDateTime)->format('Y-m-d H:i:s');
        
        $arriveDateTime = Carbon::parse($request->input('site_arrive_datetime'))->format('Y-m-d h:i A');
        $arriveFormattedDateTime = Carbon::parse($arriveDateTime)->format('Y-m-d H:i:s');
        
        $returnDateTime = Carbon::parse($request->input('station_return_datetime'))->format('Y-m-d h:i A');
        $returnFormattedDateTime = Carbon::parse($returnDateTime)->format('Y-m-d H:i:s');
        
        $cfoInput = $request->input('cfo');
        if (is_array($cfoInput) && !empty($cfoInput))
        {
            $cfo = implode(',', $cfoInput);
        }
        else
        {
            $cfo = '';
        }
        $fsoInput = $request->input('fso');
        if (is_array($fsoInput) && !empty($fsoInput))
        {
            $fso = implode(',', $fsoInput);
        }
        else
        {
            $fso = '';
        }
        $fssoInput = $request->input('fsso');
        if (is_array($fssoInput) && !empty($fssoInput))
        {
            $fsso = implode(',', $fssoInput);
        }
        else
        {
            $fsso = '';
        }
        $lfmInput = $request->input('lfm');
        if (is_array($lfmInput) && !empty($lfmInput))
        {
            $lfm = implode(',', $lfmInput);
        }
        else
        {
            $lfm = '';
        }
        $dvrInput = $request->input('dvr');
        if (is_array($dvrInput) && !empty($dvrInput))
        {
            $dvr = implode(',', $dvrInput);
        }
        else
        {
            $dvr = '';
        }
        $fmInput = $request->input('fm');
        if (is_array($fmInput) && !empty($fmInput))
        {
            $fm = implode(',', $fmInput);
        }
        else
        {
            $fm = '';
        }
        $data = [
            'relief_report_no' => $request->input('relief_report_no'),
            'monthly_no' => $request->input('monthly_no'),
            'district_id' => $request->input('district_id'),
            'station_id' => $request->input('station_id'),
            'incident_datetime' => $incidentFormattedDateTime,
            'informer_name' => $request->input('informer_name'),
            'informer_contact_no' => $request->input('informer_contact_no'),
            'info_medium' => $request->input('info_medium'),
            'incident_address' => $request->input('incident_address'),
            'info_datetime' => $infoFormattedDateTime,
            'station_depart_datetime' => $departFormattedDateTime,
            'site_arrive_datetime' => $arriveFormattedDateTime,
            'station_return_datetime' => $returnFormattedDateTime,
            'distance' => $request->input('distance'),
            'vehicle_id' => json_encode($request->input('vehicle_id')),
            'pumping_km' => json_encode($request->input('pumping_km')),
            'cfo' => $cfo,
            'fso' => $fso,
            'fsso' => $fsso,
            'lfm' => $lfm,
            'dvr' => $dvr,
            'fm' => $fm,
            'owner_name' => $request->input('owner_name'),
            'owner_address' => $request->input('owner_address'),
            'relief_work_area' => $request->input('relief_work_area'),
            'relief_work_type' => $request->input('relief_work_type'),
            'relief_work_reason' => $request->input('relief_work_reason'),
            'description' => $request->input('description'),
            'upload' => $reportPdf,
            'longitude' => $request->input('incident_longitude'),
            'latitude' => $request->input('incident_latitude'),
            'assigned_to'   => Auth::user()->id
        ];
        $result = $this->commonModel->insertDataGetId('fs_relief_work_report', $data);
        if($result)
        {
            return redirect()->route('service-bills.report.create',['service_type'=>'relief_report','request_id'=>$result])->with('success', 'Relief report saved successfully');

        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function updateReliefReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'relief_report_no' => 'required',
            'monthly_no' => 'required',
            'district_id' => 'required',
            'station_id' => 'required',
            'incident_datetime' => 'required',
            'informer_name' => 'required',
            'informer_contact_no' => 'required',
            'info_medium' => 'required',
            'incident_address' => 'required',
            'info_datetime' => 'required',
            'station_depart_datetime' => 'required',
            'site_arrive_datetime' => 'required',
            'station_return_datetime' => 'required',
            'distance' => 'required',
            'vehicle_id' => 'required',
            'pumping_km' => 'required',
            'relief_work_area' => 'required',
            'relief_work_type' => 'required',
            'relief_work_reason' => 'required',
            'description' => 'required',
            'incident_longitude' => 'required',
            'incident_latitude' => 'required',
            
            'owner_name' => 'required',
            'owner_address' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('upload_file')) {
            $imageName = time().'.'.$request->upload_file->extension();  
            $request->upload_file->move('admin/reliefReport', $imageName);
            $reportPdf = 'admin/reliefReport/'.$imageName;
        }
        else
        {
            $reportPdf = $request->input('upload');
        }
        $incidentDateTime = Carbon::parse($request->input('incident_datetime'))->format('Y-m-d h:i A');
        $incidentFormattedDateTime = Carbon::parse($incidentDateTime)->format('Y-m-d H:i:s');

        $infoDateTime = Carbon::parse($request->input('info_datetime'))->format('Y-m-d h:i A');
        $infoFormattedDateTime = Carbon::parse($infoDateTime)->format('Y-m-d H:i:s');
        
        $departDateTime = Carbon::parse($request->input('station_depart_datetime'))->format('Y-m-d h:i A');
        $departFormattedDateTime = Carbon::parse($departDateTime)->format('Y-m-d H:i:s');
        
        $arriveDateTime = Carbon::parse($request->input('site_arrive_datetime'))->format('Y-m-d h:i A');
        $arriveFormattedDateTime = Carbon::parse($arriveDateTime)->format('Y-m-d H:i:s');
        
        $returnDateTime = Carbon::parse($request->input('station_return_datetime'))->format('Y-m-d h:i A');
        $returnFormattedDateTime = Carbon::parse($returnDateTime)->format('Y-m-d H:i:s');
        
        
        $cfoInput = $request->input('cfo');
        if (is_array($cfoInput) && !empty($cfoInput))
        {
            $cfo = implode(',', $cfoInput);
        }
        else
        {
            $cfo = '';
        }
        $fsoInput = $request->input('fso');
        if (is_array($fsoInput) && !empty($fsoInput))
        {
            $fso = implode(',', $fsoInput);
        }
        else
        {
            $fso = '';
        }
        $fssoInput = $request->input('fsso');
        if (is_array($fssoInput) && !empty($fssoInput))
        {
            $fsso = implode(',', $fssoInput);
        }
        else
        {
            $fsso = '';
        }
        $lfmInput = $request->input('lfm');
        if (is_array($lfmInput) && !empty($lfmInput))
        {
            $lfm = implode(',', $lfmInput);
        }
        else
        {
            $lfm = '';
        }
        $dvrInput = $request->input('dvr');
        if (is_array($dvrInput) && !empty($dvrInput))
        {
            $dvr = implode(',', $dvrInput);
        }
        else
        {
            $dvr = '';
        }
        $fmInput = $request->input('fm');
        if (is_array($fmInput) && !empty($fmInput))
        {
            $fm = implode(',', $fmInput);
        }
        else
        {
            $fm = '';
        }
        $data = [
            'relief_report_no' => $request->input('relief_report_no'),
            'monthly_no' => $request->input('monthly_no'),
            'district_id' => $request->input('district_id'),
            'station_id' => $request->input('station_id'),
            'incident_datetime' => $incidentFormattedDateTime,
            'informer_name' => $request->input('informer_name'),
            'informer_contact_no' => $request->input('informer_contact_no'),
            'info_medium' => $request->input('info_medium'),
            'incident_address' => $request->input('incident_address'),
            'info_datetime' => $infoFormattedDateTime,
            'station_depart_datetime' => $departFormattedDateTime,
            'site_arrive_datetime' => $arriveFormattedDateTime,
            'station_return_datetime' => $returnFormattedDateTime,
            'distance' => $request->input('distance'),
            'vehicle_id' => json_encode($request->input('vehicle_id')),
            'pumping_km' => json_encode($request->input('pumping_km')),
            'cfo' => $cfo,
            'fso' => $fso,
            'fsso' => $fsso,
            'lfm' => $lfm,
            'dvr' => $dvr,
            'fm' => $fm, 
            'owner_name' => $request->input('owner_name'),
            'owner_address' => $request->input('owner_address'),
            'relief_work_area' => $request->input('relief_work_area'),
            'relief_work_type' => $request->input('relief_work_type'),
            'relief_work_reason' => $request->input('relief_work_reason'),
            'description' => $request->input('description'),
            'upload' => $reportPdf,
            'longitude' => $request->input('incident_longitude'),
            'latitude' => $request->input('incident_latitude'),
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_relief_work_report', array('id' => $request->input('id')), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Relief report updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function sentReliefApproval($id)
    {
        $data = [
            'status' => '1'
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_relief_work_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Relief report has been sent for approval');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function deleteReliefFile($id)
    {
        $reliefReport = $this->commonModel->getDataByOneCondition('fs_relief_work_report', array('id' => $id));
        if($reliefReport) {
            $filename = $reliefReport[0]->upload;
        } else {
            $filename = '';
        }
        if(file_exists($filename))
        {
            unlink($filename);
        }
        $data = [
            'upload' => ''
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_relief_work_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Relief deleted approval');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function reliefApproved($id)
    {
        $reliefReport = $this->commonModel->getDataByOneCondition('fs_relief_work_report', array('id' => $id));
        $districts = $this->commonModel->getDataByOneCondition('districts', array('id' => $reliefReport[0]->district_id));        
        $stations = $this->commonModel->getDataByOneCondition('fire_stations', array('district_id' => $reliefReport[0]->station_id));

        $reportYear = Carbon::parse($reliefReport[0]->created_at)->format('Y');
        $application_id = $districts[0]->code.'/'.$stations[0]->firestation_code.'/'.$reliefReport[0]->relief_report_no.'/'.$reportYear.'/RW';
        $data = [
            'status' => '3',
            'approved_by'   => Auth::user()->id,
            'application_no' => $application_id,
            'approved_date' => date('Y-m-d')
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_relief_work_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Relief report approved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function addReliefRemark(Request $request)
    {
        $addRemark =  $this->commonModel->getDataByOneCondition('fs_relief_work_report', array('id' => $request->id));
        $old_exist = $request->old_exist;
        if($old_exist !='')
        {
            $appendRemark  = $old_exist . ", " .$request->remark;
        }
        else
        {
            $appendRemark  = $request->remark;
        }
        $data = [
            'status' => '2',
            'remark'   => $appendRemark,
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_relief_work_report', array('id' => $request->id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Remark Updated Successfully!');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function downloadReliefReport($id)
    {   
        $reliefReport = $this->commonModel->getDataByOneCondition('fs_relief_work_report', array('id' => $id));
        $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $reliefReport[0]->district_id));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $reliefReport[0]->station_id));
        $vehicleArray = json_decode($reliefReport[0]->vehicle_id,true);
        $pumpArray = json_decode($reliefReport[0]->pumping_km);
        $vehicle = [];
        for($v=0;$v<count($vehicleArray);$v++)
        {
            $vehicleData = $this->commonModel->getDataByOneCondition('fs_vehicles', array('id' => $vehicleArray[$v]));
            if(!empty($vehicleData))
            { 
                $vehicleType = $this->commonModel->getDataByOneCondition('vehicle_types', array('id' => $vehicleData[0]->vehicle_type));
                $vehicle[] = [
                    'vehicle'       => isset($vehicleType[0]) ?$vehicleData[0]->reg_number: 'NA',
                    'vehicle_type'  => isset($vehicleType[0]) ? $vehicleType[0]->type : 'NA',
                    'pumping_km'    => $pumpArray[$v],
                ];
            }
            else
            {
                $vehicle[] = [
                    'vehicle'       => 'NA',
                    'vehicle_type'  => 'NA',
                    'pumping_km'    => 0,
                ];
            }
        }
        $explCfo = explode(',',$reliefReport[0]->cfo);
        $explfso = explode(',',$reliefReport[0]->fso);
        $explfsso = explode(',',$reliefReport[0]->fsso);
        $expllfm = explode(',',$reliefReport[0]->lfm);
        $expldvr = explode(',',$reliefReport[0]->dvr);
        $explfm = explode(',',$reliefReport[0]->fm);

        if(!empty($explCfo[0])){ $cfo = count($explCfo); } else { $cfo = "-"; }
        if(!empty($explfso[0])){ $fso = count($explfso); } else { $fso = "-"; }
        if(!empty($explfsso[0])){ $fsso = count($explfsso); } else { $fsso = "-"; }
        if(!empty($expllfm[0])){ $lfm = count($expllfm); } else { $lfm = "-"; }
        if(!empty($expldvr[0])){ $dvr = count($expldvr); } else { $dvr = "-"; }
        if(!empty($explfm[0])){ $fm = count($explfm); } else { $fm = "-"; }

        
        return view('admin.ReliefReport.download',compact('reliefReport','district','station','vehicle', 'cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm'));
    }
}

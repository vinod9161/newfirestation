<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\FireReport;
use App\Models\RescueReportModel;
use App\Models\User;
use App\Models\Station;
use App\Models\VehicleModel;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Common\CommonModel;
use Carbon\Carbon;

class RescueReportController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel();
    }

    public function index(Request $request)
    {
        $query = DB::table('fs_rescue_report');

        if (Auth::user()->type == 3) {
            $query->where('assigned_to', Auth::user()->id);
        }
        elseif (Auth::user()->type != 0 && Auth::user()->type != 1) {
            $query->where('district_id', Auth::user()->district_id);
        }

        if ($request->filled('from_date')) {
            $query->where(
                'created_at',
                '>=',
                $request->from_date . ' 00:00:00'
            );
        }

        if ($request->filled('to_date')) {
            $query->where(
                'created_at',
                '<=',
                $request->to_date . ' 23:59:59'
            );
        }

        $rescue = $query
            ->orderBy('created_at', 'desc')
            ->get();

        $district = $this->commonModel->getData('districts');
        $station  = $this->commonModel->getData('fire_stations');

        return view('admin.Rescue.index', compact('rescue', 'district', 'station'));
    }

    public function deleteRescueReport($id)
    {
        $record = RescueReportModel::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.rescueReport')->with('success', 'Record deleted successfully.');
    }
    public function addRescueReport()
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

        return view('admin.Rescue.add',compact('vehicles','cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm', 'districts', 'stations'));
    }
    public function editRescueReport($id)
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

        $rescueReport = $this->commonModel->getDataByOneCondition('fs_rescue_report', array('id' => $id));

        return view('admin.Rescue.edit',compact('rescueReport', 'vehicles','cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm', 'districts', 'stations'));
    }
    public function viewRescueReport($id)
    {
        $rescueReport = $this->commonModel->getDataByOneCondition('fs_rescue_report', array('id' => $id));
        $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $rescueReport[0]->district_id));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $rescueReport[0]->station_id));
        $vehicleArray = json_decode($rescueReport[0]->vehicle_id,true);
        $pumpArray = json_decode($rescueReport[0]->pumping_km);
        $vehicle = [];
        for($v=0;$v<count($vehicleArray);$v++)
        {
            $vehicleData = $this->commonModel->getDataByOneCondition('fs_vehicles', array('id' => $vehicleArray[$v]));
            if(!empty($vehicleData))
            {
                $vehicleType = $this->commonModel->getDataByOneCondition('vehicle_types', array('id' => $vehicleData[0]->vehicle_type));
                $vehicle[] = [
                    'vehicle'       => $vehicleData[0]->reg_number,
                    'vehicle_type'  => $vehicleType[0]->type,
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
        return view('admin.Rescue.view',compact('rescueReport','district','station','vehicle'));
    }
    public function saveRescueReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rescue_report_no' => 'required',
            'monthly_no' => 'required',
            'district_id' => 'required',
            'station_id' => 'required',
            'rescue_incident_datetime' => 'required',
            'informer_name' => 'required',
            'informer_contact_no' => 'required',
            'info_medium' => 'required',
            'incident_address' => 'required',
            'info_datetime' => 'required',
            'station_depart_datetime' => 'required',
            'rescue_site_arrive_datetime' => 'required',
            'station_return_datetime' => 'required',
            'distance' => 'required',
            'vehicle_id' => 'required',
            'pumping_km' => 'required',
            'rescue_area' => 'required',
            'rescue_area_type' => 'required',
            'insured' => 'required',
            'rescue_reason' => 'required',
            'description' => 'required',
            'incident_longitude' => 'required',
            'incident_latitude' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('upload_file')) {
            $imageName = time().'.'.$request->upload_file->extension();  
            $request->upload_file->move('admin/releifReport', $imageName);
            $reportPdf = 'admin/rescueReport/'.$imageName;
        }
        else
        {
            $reportPdf = null;
        }

        $incidentDateTime = Carbon::parse($request->input('rescue_incident_datetime'))->format('Y-m-d h:i A');
        $incidentFormattedDateTime = Carbon::parse($incidentDateTime)->format('Y-m-d H:i:s');

        $infoDateTime = Carbon::parse($request->input('info_datetime'))->format('Y-m-d h:i A');
        $infoFormattedDateTime = Carbon::parse($infoDateTime)->format('Y-m-d H:i:s');
        
        $departDateTime = Carbon::parse($request->input('station_depart_datetime'))->format('Y-m-d h:i A');
        $departFormattedDateTime = Carbon::parse($departDateTime)->format('Y-m-d H:i:s');
        
        $arriveDateTime = Carbon::parse($request->input('rescue_site_arrive_datetime'))->format('Y-m-d h:i A');
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
            'rescue_report_no' => $request->input('rescue_report_no'),
            'monthly_no' => $request->input('monthly_no'),
            'district_id' => $request->input('district_id'),
            'station_id' => $request->input('station_id'),
            'rescue_incident_datetime' => $incidentFormattedDateTime,
            'informer_name' => $request->input('informer_name'),
            'informer_contact_no' => $request->input('informer_contact_no'),
            'info_medium' => $request->input('info_medium'),
            'incident_address' => $request->input('incident_address'),
            'info_datetime' => $infoFormattedDateTime,
            'station_depart_datetime' => $departFormattedDateTime,
            'rescue_site_arrive_datetime' => $arriveFormattedDateTime,
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
            'rescue_area' => $request->input('rescue_area'),
            'rescue_area_type' => $request->input('rescue_area_type'),
            'insured' => $request->input('insured'),
            'rescue_reason' => $request->input('rescue_reason'),
            'short_description' => $request->input('description'),
            'upload' => $reportPdf,
            'longitude' => $request->input('incident_longitude'),
            'latitude' => $request->input('incident_latitude'),
            'assigned_to'   => Auth::user()->id,
            'life_lost_human' => $request->input('life_lost_human'),
            'life_saved_human' => $request->input('life_saved_human'),
            'life_lost_animal' => $request->input('life_lost_animal'),
            'life_saved_animal' => $request->input('life_saved_animal'),
        ];
        $result = $this->commonModel->insertData('fs_rescue_report', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Rescue report saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function updateRescueReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rescue_report_no' => 'required',
            'monthly_no' => 'required',
            'district_id' => 'required',
            'station_id' => 'required',
            'rescue_incident_datetime' => 'required',
            'informer_name' => 'required',
            'informer_contact_no' => 'required',
            'info_medium' => 'required',
            'incident_address' => 'required',
            'info_datetime' => 'required',
            'station_depart_datetime' => 'required',
            'rescue_site_arrive_datetime' => 'required',
            'station_return_datetime' => 'required',
            'distance' => 'required',
            'vehicle_id' => 'required',
            'pumping_km' => 'required',
            'rescue_area' => 'required',
            'rescue_area_type' => 'required',
            'insured' => 'required',
            'rescue_reason' => 'required',
            'description' => 'required',
            'incident_longitude' => 'required',
            'incident_latitude' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('upload_file')) {
            $imageName = time().'.'.$request->upload_file->extension();  
            $request->upload_file->move('admin/rescueReport', $imageName);
            $reportPdf = 'admin/rescueReport/'.$imageName;
        }
        else
        {
            $reportPdf = $request->input('upload');
        }

        $incidentDateTime = Carbon::parse($request->input('rescue_incident_datetime'))->format('Y-m-d h:i A');
        $incidentFormattedDateTime = Carbon::parse($incidentDateTime)->format('Y-m-d H:i:s');

        $infoDateTime = Carbon::parse($request->input('info_datetime'))->format('Y-m-d h:i A');
        $infoFormattedDateTime = Carbon::parse($infoDateTime)->format('Y-m-d H:i:s');
        
        $departDateTime = Carbon::parse($request->input('station_depart_datetime'))->format('Y-m-d h:i A');
        $departFormattedDateTime = Carbon::parse($departDateTime)->format('Y-m-d H:i:s');
        
        $arriveDateTime = Carbon::parse($request->input('rescue_site_arrive_datetime'))->format('Y-m-d h:i A');
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
            'rescue_report_no' => $request->input('rescue_report_no'),
            'monthly_no' => $request->input('monthly_no'),
            'district_id' => $request->input('district_id'),
            'station_id' => $request->input('station_id'),
            'rescue_incident_datetime' => $incidentFormattedDateTime,
            'informer_name' => $request->input('informer_name'),
            'informer_contact_no' => $request->input('informer_contact_no'),
            'info_medium' => $request->input('info_medium'),
            'incident_address' => $request->input('incident_address'),
            'info_datetime' => $infoFormattedDateTime,
            'station_depart_datetime' => $departFormattedDateTime,
            'rescue_site_arrive_datetime' => $arriveFormattedDateTime,
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
            'rescue_area' => $request->input('rescue_area'),
            'rescue_area_type' => $request->input('rescue_area_type'),
            'insured' => $request->input('insured'),
            'rescue_reason' => $request->input('rescue_reason'),
            'short_description' => $request->input('description'),
            'upload' => $reportPdf,
            'longitude' => $request->input('incident_longitude'),
            'latitude' => $request->input('incident_latitude'),
            'assigned_to'   => Auth::user()->id,
            'life_lost_human' => $request->input('life_lost_human'),
            'life_saved_human' => $request->input('life_saved_human'),
            'life_lost_animal' => $request->input('life_lost_animal'),
            'life_saved_animal' => $request->input('life_saved_animal'),
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_rescue_report', array('id' => $request->input('id')), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Rescue report updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function sentRescueApproval($id)
    {
        $data = [
            'status' => '1'
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_rescue_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Rescue report has been sent for approval');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function deleteRescueFile($id)
    {
        $rescueReport = $this->commonModel->getDataByOneCondition('fs_rescue_report', array('id' => $id));
        if($rescueReport) {
            $filename = $rescueReport[0]->upload;
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
        $result = $this->commonModel->updateDataByOneCondition('fs_rescue_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Rescue deleted approval');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function rescueApproved($id)
    {
        $rescueReport = $this->commonModel->getDataByOneCondition('fs_rescue_report', array('id' => $id));
        $districts = $this->commonModel->getDataByOneCondition('districts', array('id' => $rescueReport[0]->district_id));        
        $stations = $this->commonModel->getDataByOneCondition('fire_stations', array('district_id' => $rescueReport[0]->station_id));

        $reportYear = Carbon::parse($rescueReport[0]->created_at)->format('Y');
        $application_id = $districts[0]->code.'/'.$stations[0]->firestation_code.'/'.$rescueReport[0]->rescue_report_no.'/'.$reportYear.'/RR';
        $data = [
            'status' => '3',
            'approved_by'   => Auth::user()->id,
            'application_no' => $application_id
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_rescue_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Rescue report approved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function addRescueRemark(Request $request)
    {
        $addRemark =  $this->commonModel->getDataByOneCondition('fs_rescue_report', array('id' => $request->id));
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
        $result = $this->commonModel->updateDataByOneCondition('fs_rescue_report', array('id' => $request->id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Remark Updated Successfully!');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }

    public function downloadRescueReport($id)
    {
        $rescueReport = $this->commonModel->getDataByOneCondition('fs_rescue_report', array('id' => $id));
        $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $rescueReport[0]->district_id));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $rescueReport[0]->station_id));
        $vehicleArray = json_decode($rescueReport[0]->vehicle_id,true);
        $pumpArray = json_decode($rescueReport[0]->pumping_km);
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
        $explCfo = explode(',',$rescueReport[0]->cfo);
        $explfso = explode(',',$rescueReport[0]->fso);
        $explfsso = explode(',',$rescueReport[0]->fsso);
        $expllfm = explode(',',$rescueReport[0]->lfm);
        $expldvr = explode(',',$rescueReport[0]->dvr);
        $explfm = explode(',',$rescueReport[0]->fm);

        if(!empty($explCfo[0])){ $cfo = count($explCfo); } else { $cfo = "-"; }
        if(!empty($explfso[0])){ $fso = count($explfso); } else { $fso = "-"; }
        if(!empty($explfsso[0])){ $fsso = count($explfsso); } else { $fsso = "-"; }
        if(!empty($expllfm[0])){ $lfm = count($expllfm); } else { $lfm = "-"; }
        if(!empty($expldvr[0])){ $dvr = count($expldvr); } else { $dvr = "-"; }
        if(!empty($explfm[0])){ $fm = count($explfm); } else { $fm = "-"; }

        return view('admin.Rescue.download',compact('rescueReport','district','station','vehicle', 'cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm'));
    }
}

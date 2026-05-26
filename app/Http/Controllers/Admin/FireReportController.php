<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\FireReport;
use App\Models\Models\FireReport as FIR;
use App\Models\Models\User as NewUser;
use App\Models\Models\Station as NewStation;
use App\Models\VehicleModel as Vehicle;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Common\CommonModel;
use Carbon\Carbon;
use Dompdf\Dompdf;
use Dompdf\Options;


class FireReportController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel();
    }

    public function index(Request $request)
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


        if (Auth::user()->type == '3')
        {
            $query->where(
                'fs_fire_report.assigned_to',
                Auth::user()->id
            );
        }
        elseif (
            Auth::user()->type != '0'
            && Auth::user()->type != '1'
        )
        {
            $query->where(
                'fs_fire_report.district_id',
                Auth::user()->district_id
            );
        }

        if ($request->filled('fire_report_no'))
        {
            $query->where(
                'fs_fire_report.fire_report_no',
                'LIKE',
                '%' . $request->fire_report_no . '%'
            );
        }

        if ($request->filled('district_id'))
        {
            $query->where(
                'fs_fire_report.district_id',
                $request->district_id
            );
        }

        if ($request->filled('station_id'))
        {
            $query->where(
                'fs_fire_report.station_id',
                $request->station_id
            );
        }

        if ($request->filled('category'))
        {
            $query->where(
                'fs_fire_report.category',
                $request->category
            );
        }

        if ($request->filled('fire_area_type'))
        {
            $query->where(
                'fs_fire_report.fire_area_type',
                $request->fire_area_type
            );
        }

        if ($request->filled('fire_area'))
        {
            $query->where(
                'fs_fire_report.fire_area',
                $request->fire_area
            );
        }

        if ($request->filled('status'))
        {
            $query->where(
                'fs_fire_report.status',
                $request->status
            );
        }

        if ($request->filled('from_date'))
        {
            $query->whereDate(
                'fs_fire_report.created_at',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date'))
        {
            $query->whereDate(
                'fs_fire_report.created_at',
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

        $data['categories'] = DB::table('categories')
            ->orderBy('name')
            ->get();

        $data['fs_fire_report'] = $query
            ->orderBy('fs_fire_report.created_at', 'DESC')
            ->get();

        return view(
            'admin.fireReport.fireReport',
            $data
        );
    }


    public function deleteFireReport($id)
    {
        $record = FireReport::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.fireReport')->with('success', 'Record deleted successfully.');
    }
    public function addFireReport()
    {
        $vehicle = $this->commonModel->getData('fs_vehicles');
        $vehicles = [];
        foreach($vehicle as $key => $veh)
        {
            $vehicleType = $this->commonModel->getDataByOneCondition('vehicle_types', array('id' => $veh->vehicle_type));
            $vehicles[] = [
                'id' => $veh->id,
                'reg_number' => $veh->reg_number,
                'vehicle_type' => isset($vehicleType[0]->type) ? $vehicleType[0]->type : '',
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

        // $categories = $this->commonModel->getData("fire_categories");
        // $subcategories = $this->commonModel->getData("fire_subcategories");
        $categories = DB::table('fire_categories')->orderBy('id', 'ASC')->get();
        $subcategories = DB::table('fire_subcategories')->orderBy('id', 'ASC')->get();


        return view('admin.fireReport.add',compact('vehicles','cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm', 'districts', 'stations', 'categories', 'subcategories'));
    }
    public function editFireReport($id)
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

        $fireReport = $this->commonModel->getDataByOneCondition('fs_fire_report', array('id' => $id));
        return view('admin.fireReport.edit',compact('fireReport', 'vehicles','cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm', 'districts', 'stations'));
    }
    public function viewFireReport($id)
    {
        $fireReport = $this->commonModel->getDataByOneCondition('fs_fire_report', array('id' => $id));
        $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $fireReport[0]->district_id));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $fireReport[0]->station_id));
        $category = $this->commonModel->getDataByOneCondition('fire_categories', [
            'id' => $fireReport[0]->fire_category_id
        ]);

        $subcategory = $this->commonModel->getDataByOneCondition('fire_subcategories', [
            'id' => $fireReport[0]->fire_subcategory_id
        ]);

        $vehicleArray = json_decode($fireReport[0]->vehicle_id,true);
        $pumpArray = json_decode($fireReport[0]->pumping_km);
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
        return view('admin.fireReport.view',compact('fireReport','district','station','vehicle','category','subcategory'));
    }
    public function downloadFireReport($id)
    {
        $fireReport = $this->commonModel->getDataByOneCondition('fs_fire_report', array('id' => $id));
        $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $fireReport[0]->district_id));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $fireReport[0]->station_id));
        $vehicleArray = json_decode($fireReport[0]->vehicle_id,true);
        $pumpArray = json_decode($fireReport[0]->pumping_km);
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
        $explCfo = explode(',',$fireReport[0]->cfo);
        $explfso = explode(',',$fireReport[0]->fso);
        $explfsso = explode(',',$fireReport[0]->fsso);
        $expllfm = explode(',',$fireReport[0]->lfm);
        $expldvr = explode(',',$fireReport[0]->dvr);
        $explfm = explode(',',$fireReport[0]->fm);

        if(!empty($explCfo[0])){ $cfo = count($explCfo); } else { $cfo = "-"; }
        if(!empty($explfso[0])){ $fso = count($explfso); } else { $fso = "-"; }
        if(!empty($explfsso[0])){ $fsso = count($explfsso); } else { $fsso = "-"; }
        if(!empty($expllfm[0])){ $lfm = count($expllfm); } else { $lfm = "-"; }
        if(!empty($expldvr[0])){ $dvr = count($expldvr); } else { $dvr = "-"; }
        if(!empty($explfm[0])){ $fm = count($explfm); } else { $fm = "-"; }

        $category = $this->commonModel->getDataByOneCondition('fire_categories', [
            'id' => $fireReport[0]->fire_category_id
        ]);

        $subcategory = $this->commonModel->getDataByOneCondition('fire_subcategories', [
            'id' => $fireReport[0]->fire_subcategory_id
        ]);


        return view('admin.fireReport.download',compact('fireReport','district','station','vehicle', 'cfo', 'fso', 'fsso', 'lfm', 'dvr', 'fm', 'category','subcategory'));
    }
    public function saveFireReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fire_report_no' => 'required',
            'monthly_no' => 'required',
            'category' => 'required',
            'district_id' => 'required',
            'station_id' => 'required',
            'fire_incident_datetime' => 'required',
            'informer_name' => 'required',
            'informer_contact_no' => 'required',
            'info_medium' => 'required',
            'incident_address' => 'required',
            'info_datetime' => 'required',
            'station_depart_datetime' => 'required',
            'fire_site_arrive_datetime' => 'required',
            'station_return_datetime' => 'required',
            'distance' => 'required',
            'vehicle_id' => 'required',
            'pumping_km' => 'required',
            'fire_class' => 'required',
            'fire_area' => 'required',
            'fire_area_type' => 'required',
            'insured' => 'required',
            'arson_based' => 'required',
            'fire_reason' => 'required',
            'short_description' => 'required',
            'incident_longitude' => 'required',
            'incident_latitude' => 'required',
            'fire_category_id' => 'required',
            'fire_subcategory_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('upload_file')) {
            $imageName = time().'.'.$request->upload_file->extension();  
            $request->upload_file->move('admin/fireReport', $imageName);
            $reportPdf = 'admin/fireReport/'.$imageName;
        }
        else
        {
            $reportPdf = null;
        }

        $incidentDateTime = Carbon::parse($request->input('fire_incident_datetime'))->format('Y-m-d h:i A');
        $incidentFormattedDateTime = Carbon::parse($incidentDateTime)->format('Y-m-d H:i:s');

        $infoDateTime = Carbon::parse($request->input('info_datetime'))->format('Y-m-d h:i A');
        $infoFormattedDateTime = Carbon::parse($infoDateTime)->format('Y-m-d H:i:s');

        $departDateTime = Carbon::parse($request->input('station_depart_datetime'))->format('Y-m-d h:i A');
        $departFormattedDateTime = Carbon::parse($departDateTime)->format('Y-m-d H:i:s');

        $arriveDateTime = Carbon::parse($request->input('fire_site_arrive_datetime'))->format('Y-m-d h:i A');
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
            'fire_report_no' => $request->input('fire_report_no'),
            'monthly_no' => $request->input('monthly_no'),
            'category' => $request->input('category'),
            'district_id' => $request->input('district_id'),
            'station_id' => $request->input('station_id'),
            'fire_incident_datetime' => $incidentFormattedDateTime,
            'informer_name' => $request->input('informer_name'),
            'informer_contact_no' => $request->input('informer_contact_no'),
            'info_medium' => $request->input('info_medium'),
            'incident_address' => $request->input('incident_address'),
            'info_datetime' => $infoFormattedDateTime,
            'station_depart_datetime' => $departFormattedDateTime,
            'fire_site_arrive_datetime' => $arriveFormattedDateTime,
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
            'fire_class' => $request->input('fire_class'),
            'fire_area' => $request->input('fire_area'),
            'fire_area_type' => $request->input('fire_area_type'),
            'insured' => $request->input('insured'),
            'arson_based' => $request->input('arson_based'),
            'fire_reason' => $request->input('fire_reason'),
            'property_lost' => $request->input('property_lost'),
            'property_saved' => $request->input('property_saved'),
            'life_lost_human' => $request->input('life_lost_human'),
            'life_saved_human' => $request->input('life_saved_human'),
            'life_lost_animal' => $request->input('life_lost_animal'),
            'life_saved_animal' => $request->input('life_saved_animal'),
            'short_description' => $request->input('short_description'),
            'longitude' => $request->input('incident_longitude'),
            'latitude' => $request->input('incident_latitude'),
            'upload' => $reportPdf,
            'fire_category_id' => $request->input('fire_category_id'),
            'fire_subcategory_id' => $request->input('fire_subcategory_id'),
            'assigned_to'   => Auth::user()->id

        ];
        $result = $this->commonModel->insertData('fs_fire_report', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire report saved successfully');
            // return redirect()->route('service-bills.report.create',['service_type'=>'fire_report','request_id'=>$result])->with('success', 'Fire report saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function updateFireReport(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fire_report_no' => 'required',
            'monthly_no' => 'required',
            'category' => 'required',
            'district_id' => 'required',
            'station_id' => 'required',
            'fire_incident_datetime' => 'required',
            'informer_name' => 'required',
            'informer_contact_no' => 'required',
            'info_medium' => 'required',
            'incident_address' => 'required',
            'info_datetime' => 'required',
            'station_depart_datetime' => 'required',
            'fire_site_arrive_datetime' => 'required',
            'station_return_datetime' => 'required',
            'distance' => 'required',
            'vehicle_id' => 'required',
            'pumping_km' => 'required',
            'fire_class' => 'required',
            'fire_area' => 'required',
            'fire_area_type' => 'required',
            'insured' => 'required',
            'arson_based' => 'required',
            'fire_reason' => 'required',
            'short_description' => 'required',
            'incident_longitude' => 'required',
            'incident_latitude' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('upload_file')) {
            $imageName = time().'.'.$request->upload_file->extension();  
            $request->upload_file->move('admin/fireReport', $imageName);
            $reportPdf = 'admin/fireReport/'.$imageName;
        }
        else
        {
            $reportPdf = $request->input('upload');
        }
        $incidentDateTime = Carbon::parse($request->input('fire_incident_datetime'))->format('Y-m-d h:i A');
        $incidentFormattedDateTime = Carbon::parse($incidentDateTime)->format('Y-m-d H:i:s');

        $infoDateTime = Carbon::parse($request->input('info_datetime'))->format('Y-m-d h:i A');
        $infoFormattedDateTime = Carbon::parse($infoDateTime)->format('Y-m-d H:i:s');

        $departDateTime = Carbon::parse($request->input('station_depart_datetime'))->format('Y-m-d h:i A');
        $departFormattedDateTime = Carbon::parse($departDateTime)->format('Y-m-d H:i:s');

        $arriveDateTime = Carbon::parse($request->input('fire_site_arrive_datetime'))->format('Y-m-d h:i A');
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
            'fire_report_no' => $request->input('fire_report_no'),
            'monthly_no' => $request->input('monthly_no'),
            'category' => $request->input('category'),
            'district_id' => $request->input('district_id'),
            'station_id' => $request->input('station_id'),
            'fire_incident_datetime' => $incidentFormattedDateTime,
            'informer_name' => $request->input('informer_name'),
            'informer_contact_no' => $request->input('informer_contact_no'),
            'info_medium' => $request->input('info_medium'),
            'incident_address' => $request->input('incident_address'),
            'info_datetime' => $infoFormattedDateTime,
            'station_depart_datetime' => $departFormattedDateTime,
            'fire_site_arrive_datetime' => $arriveFormattedDateTime,
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
            'fire_class' => $request->input('fire_class'),
            'fire_area' => $request->input('fire_area'),
            'fire_area_type' => $request->input('fire_area_type'),
            'insured' => $request->input('insured'),
            'arson_based' => $request->input('arson_based'),
            'fire_reason' => $request->input('fire_reason'),
            'property_lost' => $request->input('property_lost'),
            'property_saved' => $request->input('property_saved'),
            'life_lost_human' => $request->input('life_lost_human'),
            'life_saved_human' => $request->input('life_saved_human'),
            'life_lost_animal' => $request->input('life_lost_animal'),
            'life_saved_animal' => $request->input('life_saved_animal'),
            'short_description' => $request->input('short_description'),
            'longitude' => $request->input('incident_longitude'),
            'latitude' => $request->input('incident_latitude'),
            'upload' => $reportPdf,
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_fire_report', array('id' => $request->input('id')), $data);
        if($result == '1')
        {
            return redirect()->back()->with('success', 'Fire report updated successfully');
        }
        if($result == '2')
        {
            return redirect()->back()->with('failed', 'Nothing to update');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function sentFireApproval($id)
    {
        $data = [
            'status' => '1'
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_fire_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire report has been sent for approval');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function deleteFireFile($id)
    {
        $fireReport = $this->commonModel->getDataByOneCondition('fs_fire_report', array('id' => $id));
        if($fireReport) {
            $filename = $fireReport[0]->upload;
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
        $result = $this->commonModel->updateDataByOneCondition('fs_fire_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire deleted approval');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
    public function fireApproved($id)
    {
        $fireReport = $this->commonModel->getDataByOneCondition('fs_fire_report', array('id' => $id));
        $districts = $this->commonModel->getDataByOneCondition('districts', array('id' => $fireReport[0]->district_id));        
        $stations = $this->commonModel->getDataByOneCondition('fire_stations', array('district_id' => $fireReport[0]->station_id));

        $reportYear = Carbon::parse($fireReport[0]->created_at)->format('Y');
        $application_id = $districts[0]->code.'/'.$stations[0]->firestation_code.'/'.$fireReport[0]->fire_report_no.'/'.$reportYear.'/FR';
        $data = [
            'status' => '3',
            'approved_by'   => Auth::user()->id,
            'application_no' => $application_id,
            'approved_date' => date('Y-m-d')
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_fire_report', array('id' => $id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire report approved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }

    public function addFireRemark(Request $request)
    {
        $addRemark = $this->commonModel->getDataByOneCondition('fs_fire_report', array('id' => $request->id));
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
        $result = $this->commonModel->updateDataByOneCondition('fs_fire_report', array('id' => $request->id), $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Remark Updated Successfully!');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try later!');
        }
    }
}

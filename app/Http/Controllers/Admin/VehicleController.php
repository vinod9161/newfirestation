<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VehicleModel;
use App\Models\Common\CommonModel;
use App\Models\VehicleStatementModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\District;
use Illuminate\Validation\Rule;


class VehicleController extends Controller
{
    public function index()
    {
        $data['fs_vehicles'] = DB::table('fs_vehicles')
                        ->join('fire_stations', 'fs_vehicles.station_id', '=', 'fire_stations.id')
                        ->join('districts', 'fs_vehicles.district_id', '=', 'districts.id')
                        ->join('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')
                        ->select('fs_vehicles.*', 'fire_stations.name as fire_station_name', 'districts.name as district_name','vehicle_types.type')
                        ->get()
                        ->toArray();    
        return view('admin.vehicle.index',$data);
    }
    

    public function destroy($id)
    {
        $record = VehicleModel::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.vehicle')->with('success', 'Vehicle deleted successfully.');
    }


    public function getfirestation(Request $request)
    {
        $districts = $request->input('districts');
        if($districts=='')
        {
            $resp=array('status' => 0, 'message' => 'Districts Data Missing');
            return response()->json($resp);
        }

        $tbl = 'fire_stations';
        $where = ['district_id'=>$districts];
        $getfirestation = $this->commonModel->getDataByOneCondition($tbl,$where);
        $resp=array('status' => 1, 'data' => $getfirestation);
        return response()->json($resp);
    }


    public function add()
    {
        $this->commonModel = new CommonModel;
        $tbl = 'districts';
        $whr = ['status'=> '1'];
        $getDistricts = $this->commonModel->getDataByOneCondition($tbl,$whr);

        $table = 'vehicle_types';
        $where = ['status'=> '1'];
        $getvehicleTypes = $this->commonModel->getDataByOneCondition($table,$where);
        return view('admin.vehicle.add',compact('getDistricts','getvehicleTypes'));
    }


    public function savevehicle(Request $request)
    {

        $this->commonModel = new CommonModel;

        $validator = Validator::make($request->all(), [
            'districts' => 'required|string',
            'firestation' => 'required|string',

            'reg_number' => 'required|string|unique:fs_vehicles,reg_number',

            'chassis_number' => 'required|string',
            'engine_number' => 'required|string',
            'vehicle_type' => 'required|string',
            'make_year' => 'required|string',
            'year' => 'required|string',
            'capacity' => 'required|string',
            'use_date' => 'required|date',
            'km_drive' => 'required|integer',
            'total_invest' => 'required|string',
            'total_fire' => 'required|string',
            'vehicle_remark' => 'nullable|string'
        ], [
            'reg_number.unique' => 'Vehicle registration number already exists.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }



        $districts = $request->input('districts');
        $firestation = $request->input('firestation');
        $reg_number = $request->input('reg_number');
        $chassis_number = $request->input('chassis_number');
        $engine_number = $request->input('engine_number');
        $vehicle_type = $request->input('vehicle_type');
        $make_year = $request->input('make_year');
        $year = $request->input('year');
        $capacity = $request->input('capacity');
        $use_date = $request->input('use_date');
        $km_drive = $request->input('km_drive');
        $total_invest = $request->input('total_invest');
        $total_fire = $request->input('total_fire');
        $vehicle_remark = $request->input('vehicle_remark');

        $tbl = 'fs_vehicles';

        $data = [
            'reg_number'        => $reg_number, 
            'chassis_number'    => $chassis_number, 
            'engine_number'     => $engine_number, 
            'district_id'       => $districts, 
            'station_id'        => $firestation, 
            'vehicle_type'      => $vehicle_type, 
            'make_year'         => $make_year, 
            'year'              => $year, 
            'capacity'          => $capacity, 
            'use_date'          => $use_date, 
            'km_drive'          => $km_drive, 
            'total_invest'      => $total_invest, 
            'total_fire'        => $total_fire, 
            'vehicle_remark'    => $vehicle_remark
        ];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Vehicle added successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function edit($id)
    {
        $fs_vehicles = DB::table('fs_vehicles')
                        ->join('fire_stations', 'fs_vehicles.station_id', '=', 'fire_stations.id')
                        ->join('districts', 'fs_vehicles.district_id', '=', 'districts.id')
                        ->join('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')
                        ->select('fs_vehicles.*', 'fire_stations.name as fire_station_name', 'districts.name as district_name','vehicle_types.type')
                        ->where('fs_vehicles.id',$id)
                        ->get()
                        ->first();   
                        
        $vehicleStatement  = VehicleStatementModel::where('vehicle_id', '=', $id)->get();
        return view('admin.vehicle.viewedit', compact('fs_vehicles','vehicleStatement'));
    }


    public function editdata($id)
    {
        $this->commonModel = new CommonModel;
        $tbl = 'districts';
        $whr = ['status'=> '1'];
        $getDistricts = $this->commonModel->getDataByOneCondition($tbl,$whr);

        $table = 'vehicle_types';
        $where = ['status'=> '1'];
        $getvehicleTypes = $this->commonModel->getDataByOneCondition($table,$where);

        $tbl = 'fire_stations';
        $where = ['status'=>'1'];
        $getfirestation = $this->commonModel->getDataByOneCondition($tbl,$where);

        $fs_vehicles = DB::table('fs_vehicles')->join('fire_stations', 'fs_vehicles.station_id', '=', 'fire_stations.id')->join('districts', 'fs_vehicles.district_id', '=', 'districts.id')->join('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')->select('fs_vehicles.*', 'fire_stations.name as fire_station_name', 'districts.name as district_name','vehicle_types.type')->where('fs_vehicles.id',$id)->get()->first();   

        $vehicleStatement  = VehicleStatementModel::where('vehicle_id', '=', $id)->get();
        $vehicle  = VehicleModel::with('district')->where('id', '=', $id)->first();

        return view('admin.vehicle.editdata',compact('getDistricts','getvehicleTypes','fs_vehicles','getfirestation','vehicle','vehicleStatement'));
    }

    public function updatevehicle(Request $request)
    {
        $this->commonModel = new CommonModel;

        // Normalize reg number (IMPORTANT)
        $request->merge([
            'reg_number' => strtoupper(trim($request->reg_number))
        ]);

        $vid = $request->input('vid');

        $validator = Validator::make($request->all(), [
            'districts' => 'required|string',
            'firestation' => 'required|string',

            'reg_number' => [
                'required',
                'string',
                Rule::unique('fs_vehicles', 'reg_number')->ignore($vid, 'id')
            ],

            'chassis_number' => 'required|string',
            'engine_number' => 'required|string',
            'vehicle_type' => 'required|string',
            'make_year' => 'required|string',
            'year' => 'required|string',
            'capacity' => 'required|string',
            'use_date' => 'required|date',
            'km_drive' => 'required|integer',
            'total_invest' => 'required|string',
            'total_fire' => 'required|string',
            'vehicle_remark' => 'nullable|string'
        ], [
            'reg_number.unique' => 'Vehicle registration number already exists.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'reg_number'        => $request->reg_number,
            'chassis_number'    => $request->chassis_number,
            'engine_number'     => $request->engine_number,
            'district_id'       => $request->districts,
            'station_id'        => $request->firestation,
            'vehicle_type'      => $request->vehicle_type,
            'make_year'         => $request->make_year,
            'year'              => $request->year,
            'capacity'          => $request->capacity,
            'use_date'          => $request->use_date,
            'km_drive'          => $request->km_drive,
            'total_invest'      => $request->total_invest,
            'total_fire'        => $request->total_fire,
            'vehicle_remark'    => $request->vehicle_remark
        ];

        $where = ['id' => $vid];

        $result = $this->commonModel->updateDataByOneCondition($tbl = 'fs_vehicles', $where, $data);

        if ($result) {
            return redirect()->back()->with('success', 'Vehicle updated successfully');
        } else {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function vehicleStatementPost(Request $request)
    {
        VehicleStatementModel::create($request->all());
        return redirect('admin/vehicle/edit/'.$request->vehicle_id.'')->with('message', 'Vehicle Statement Created Successfully!');
    }




    public function editvehiclestatement($id)
    {
        $this->commonModel = new CommonModel;
        $tbl = 'districts';
        $whr = ['status'=> '1'];
        $getDistricts = $this->commonModel->getDataByOneCondition($tbl,$whr);

        $table = 'vehicle_types';
        $where = ['status'=> '1'];
        $getvehicleTypes = $this->commonModel->getDataByOneCondition($table,$where);

        $tbl = 'fire_stations';
        $where = ['status'=>'1'];
        $getfirestation = $this->commonModel->getDataByOneCondition($tbl,$where);

        $fs_vehicles = DB::table('fs_vehicles')->join('fire_stations', 'fs_vehicles.station_id', '=', 'fire_stations.id')->join('districts', 'fs_vehicles.district_id', '=', 'districts.id')->join('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')->select('fs_vehicles.*', 'fire_stations.name as fire_station_name', 'districts.name as district_name','vehicle_types.type')->where('fs_vehicles.id',$id)->get()->first();   

        $vehicleStatement  = VehicleStatementModel::where('vehicle_id', '=', $id)->get();
        $vehicle  = VehicleModel::with('district')->where('id', '=', $id)->first();

        return view('admin.vehicle.vehiclestatement',compact('getDistricts','getvehicleTypes','fs_vehicles','getfirestation','vehicle','vehicleStatement'));
    }


    public function vehiclestatementreport($id)
    {
        $this->commonModel = new CommonModel;
        $tbl = 'districts';
        $whr = ['status'=> '1'];
        $getDistricts = $this->commonModel->getDataByOneCondition($tbl,$whr);

        $table = 'vehicle_types';
        $where = ['status'=> '1'];
        $getvehicleTypes = $this->commonModel->getDataByOneCondition($table,$where);

        $tbl = 'fire_stations';
        $where = ['status'=>'1'];
        $getfirestation = $this->commonModel->getDataByOneCondition($tbl,$where);

        $fs_vehicles = DB::table('fs_vehicles')->join('fire_stations', 'fs_vehicles.station_id', '=', 'fire_stations.id')->join('districts', 'fs_vehicles.district_id', '=', 'districts.id')->join('vehicle_types', 'fs_vehicles.vehicle_type', '=', 'vehicle_types.id')->select('fs_vehicles.*', 'fire_stations.name as fire_station_name', 'districts.name as district_name','vehicle_types.type')->where('fs_vehicles.id',$id)->get()->first();   

        $vehicleStatement  = VehicleStatementModel::where('vehicle_id', '=', $id)->get();
        $vehicle  = VehicleModel::with('district')->where('id', '=', $id)->first();

        return view('admin.vehicle.vehiclestatementreport',compact('getDistricts','getvehicleTypes','fs_vehicles','getfirestation','vehicle','vehicleStatement'));
    }


   
}
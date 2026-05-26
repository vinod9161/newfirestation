<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HydrantModel;
use Illuminate\Support\Facades\DB;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;


class HydrantController extends Controller
{

    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index(Request $request)
    {
        $query = DB::table('fs_hydrant')
            ->select(
                'fs_hydrant.*',
                'fire_stations.name as fire_station_name',
                'districts.name as district_name',
                'hydrant_type.hydrant_type',
                'hydrant_condition.hydrant_condition as condition'
            )
            ->join(
                'fire_stations',
                'fs_hydrant.station_id',
                '=',
                'fire_stations.id'
            )
            ->join(
                'districts',
                'fs_hydrant.district_id',
                '=',
                'districts.id'
            )
            ->join(
                'hydrant_type',
                'hydrant_type.id',
                '=',
                'fs_hydrant.type'
            )
            ->join(
                'hydrant_condition',
                'hydrant_condition.id',
                '=',
                'fs_hydrant.hydrant_condition'
            );

        if (
            Auth::user()->type != 0
            && Auth::user()->type != 1
        ) {
            $query->where(
                'fs_hydrant.district_id',
                Auth::user()->district_id
            );
        }

        if ($request->filled('district_id')) {
            $query->where(
                'fs_hydrant.district_id',
                $request->district_id
            );
        }

        if ($request->filled('station_id')) {
            $query->where(
                'fs_hydrant.station_id',
                $request->station_id
            );
        }

        if ($request->filled('type')) {
            $query->where(
                'fs_hydrant.type',
                $request->type
            );
        }

        if ($request->filled('hydrant_condition')) {
            $query->where(
                'fs_hydrant.hydrant_condition',
                $request->hydrant_condition
            );
        }

        if ($request->filled('address')) {
            $query->where(
                'fs_hydrant.address_of_water_sources',
                'LIKE',
                '%' . $request->address . '%'
            );
        }

        $data['districts'] = DB::table('districts')
            ->orderBy('name')
            ->get();

        $data['stations'] = DB::table('fire_stations')
            ->orderBy('name')
            ->get();

        $data['hydrantTypes'] = DB::table('hydrant_type')
            ->orderBy('hydrant_type')
            ->get();

        $data['hydrantConditions'] = DB::table('hydrant_condition')
            ->orderBy('hydrant_condition')
            ->get();

        $data['hydrantData'] = $query
            ->orderBy('fs_hydrant.id', 'DESC')
            ->get()
            ->toArray();

        return view(
            'admin.Hydrant.index',
            $data
        );
    }
    

    public function destroy($id){
        $record = HydrantModel::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.hydrant')->with('success', 'Record deleted successfully.');
    }

    public function addhydrant()
    {
        $tbl = 'districts';
        $where = ['status'=> '1'];
        $getDistricts = $this->commonModel->getDataByOneCondition($tbl,$where);

        $table2 = 'hydrant_type';
        $where2 = ['status'=>'1'];
        $getType = $this->commonModel->getDataByOneCondition($table2,$where2);

        $table3 = 'hydrant_condition';
        $where3 = ['status'=>'1'];
        $getCondition = $this->commonModel->getDataByOneCondition($table3,$where3);


        return view('admin.Hydrant.addhydrantform',compact('getDistricts','getType','getCondition'));
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

    public function savehydrant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'districts'         => 'required',
            'firestation'       => 'required',
            'water_source'      => 'required',
            'hydrant_type'      => 'required',
            'lat'               => 'required',
            'long'              => 'required',
            'hydrant_condtion'  => 'required'

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }  
        
        $districts           = $request->input('districts');
        $firestation         = $request->input('firestation');
        $water_source        = $request->input('water_source');
        $hydrant_type        = $request->input('hydrant_type');
        $lat                 = $request->input('lat');
        $long                = $request->input('long');
        $hydrant_condtion    = $request->input('hydrant_condtion');

        $tbl='fs_hydrant';
        $data = ['district_id' => $districts, 'station_id' => $firestation, 'address_of_water_sources' => $water_source, 'latitude' => $lat, 'longitude' => $long, 'type' => $hydrant_type, 'hydrant_condition' => $hydrant_condtion];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Hydrant added successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }

    }


    public function view($id)
    {
        $getData = DB::table('fs_hydrant')
                        ->select('fs_hydrant.*', 'fire_stations.name as fire_station_name', 'districts.name as district_name','hydrant_type.hydrant_type', 'hydrant_condition.hydrant_condition as condition')
                        ->join('fire_stations', 'fs_hydrant.station_id', '=', 'fire_stations.id')
                        ->join('districts', 'fs_hydrant.district_id', '=', 'districts.id')
                        ->join('hydrant_type', 'hydrant_type.id', '=', 'fs_hydrant.type')
                        ->join('hydrant_condition', 'hydrant_condition.id', '=', 'fs_hydrant.hydrant_condition')
                        ->where('fs_hydrant.id',$id)
                        ->get()
                        ->first();

        //echo "<pre>"; print_r($getData);
       return view('admin.Hydrant.viewhydrant',compact('getData'));                 
    }


    public function edit($id)
    {
        $tbl = 'districts';
        $whr = ['status'=> '1'];
        $getDistricts = $this->commonModel->getDataByOneCondition($tbl,$whr);

        $table = 'fire_stations';
        $where = ['status'=>'1'];
        $getfirestation = $this->commonModel->getDataByOneCondition($table,$where);

        $table2 = 'hydrant_type';
        $where2 = ['status'=>'1'];
        $getType = $this->commonModel->getDataByOneCondition($table2,$where2);

        $table3 = 'hydrant_condition';
        $where3 = ['status'=>'1'];
        $getCondition = $this->commonModel->getDataByOneCondition($table3,$where3);


        $getData = DB::table('fs_hydrant')
                       ->select('*')
                       ->where('id',$id)
                       ->get()
                       ->first();
        
        return view('admin.Hydrant.editHydrantForm', compact('getDistricts','getfirestation','getType','getCondition','getData'));            

    }


    public function updatehydrant(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'districts'         => 'required',
            'firestation'       => 'required',
            'water_source'      => 'required',
            'hydrant_type'      => 'required',
            'lat'               => 'required',
            'long'              => 'required',
            'hydrant_condtion'  => 'required'

        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }  
        
        $districts           = $request->input('districts');
        $firestation         = $request->input('firestation');
        $water_source        = $request->input('water_source');
        $hydrant_type        = $request->input('hydrant_type');
        $lat                 = $request->input('lat');
        $long                = $request->input('long');
        $hydrant_condtion    = $request->input('hydrant_condtion');
        $hid                 = $request->input('hid');

        $tbl='fs_hydrant';
        $data = ['district_id' => $districts, 'station_id' => $firestation, 'address_of_water_sources' => $water_source, 'latitude' => $lat, 'longitude' => $long, 'type' => $hydrant_type, 'hydrant_condition' => $hydrant_condtion];
        $where=['id'=>$hid];

        $result = $this->commonModel->updateDataByOneCondition($tbl,$where,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Hydrant updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }





   
}
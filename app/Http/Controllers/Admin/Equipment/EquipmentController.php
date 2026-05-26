<?php

namespace App\Http\Controllers\Admin\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use DB;

class EquipmentController extends Controller
{
    protected $commonModel;

    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function equipmentlist(Request $request)
    {
        $query = DB::table('equipment')
            ->select(
                'equipment.*',
                'equipment_category.name as category_name',
                'fire_stations.name as fire_station_name',
                'districts.name as district_name',
                'equipment_name.name as equipment_name'
            )
            ->leftJoin(
                'equipment_category',
                'equipment.category_id',
                '=',
                'equipment_category.id'
            )
            ->leftJoin(
                'fire_stations',
                'equipment.station_id',
                '=',
                'fire_stations.id'
            )
            ->leftJoin(
                'districts',
                'equipment.district_id',
                '=',
                'districts.id'
            )
            ->leftJoin(
                'equipment_name',
                'equipment.equipment_name',
                '=',
                'equipment_name.id'
            )
            ->where('equipment.status', '1');

        if (Auth::user()->type == 3)
        {
            $query->where(
                'equipment.district_id',
                Auth::user()->district_id
            );
        }

        if ($request->filled('district_id'))
        {
            $query->where(
                'equipment.district_id',
                $request->district_id
            );
        }

        if ($request->filled('station_id'))
        {
            $query->where(
                'equipment.station_id',
                $request->station_id
            );
        }

        if ($request->filled('category_id'))
        {
            $query->where(
                'equipment.category_id',
                $request->category_id
            );
        }

        if ($request->filled('equipment_name'))
        {
            $query->where(
                'equipment.equipment_name',
                $request->equipment_name
            );
        }

        if ($request->filled('added_date'))
        {
            $query->whereDate(
                'equipment.added_date',
                $request->added_date
            );
        }

        $getData = $query
            ->orderBy('equipment.id', 'DESC')
            ->get()
            ->toArray();

        $districts = DB::table('districts')
            ->orderBy('name')
            ->get();

        $stations = DB::table('fire_stations')
            ->orderBy('name')
            ->get();

        $categories = DB::table('equipment_category')
            ->orderBy('name')
            ->get();

        $equipmentNames = DB::table('equipment_name')
            ->orderBy('name')
            ->get();

        return view(
            'admin.equipments.index',
            compact(
                'getData',
                'districts',
                'stations',
                'categories',
                'equipmentNames'
            )
        );
    }

    public function addequipment()
    {
        $tbl='districts';
        // $getDistrict = $this->commonModel->getData($tbl);
        $tbl2='equipment_category';
        if (Auth::user()->type == 3) {
            $getDistrict = DB::table('districts')
                ->where('id', Auth::user()->district_id)
                ->get();
        } else {
            $getDistrict = $this->commonModel->getData($tbl);
        }
        $getCategory = $this->commonModel->getData($tbl2);
        return view('admin.equipments.add', compact('getDistrict','getCategory'));
    }

    public function getstationbydistrict(Request $request)
    {
        $district_id = $request->input('district_id'); 
        $getData = $this->commonModel->getstationbydistrict($district_id);
        if($getData)
        {
            $resp = ['status' => 1, 'data'=>$getData];
            return json_encode($resp);
        }
        else{
            $resp = ['status' => 0, 'message'=>'Fire station not found'];
            return json_encode($resp);   
        }

    }


    public function getnamebycategory(Request $request)
    {
        $category_id = $request->input('category_id'); 
        $getData = $this->commonModel->getnamebycategory($category_id);
        if($getData)
        {
            $resp = ['status' => 1, 'data'=>$getData];
            return json_encode($resp);
        }
        else{
            $resp = ['status' => 0, 'message'=>'Equipment name not found'];
            return json_encode($resp);   
        }

    }


    public function saveequipment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district'                      => 'required',
            'station'                       => 'required',
            'category'                      => 'required',
            'name'                          => 'required|unique:equipment,equipment_name,NULL,id,station_id,' . $request->station,
            'total_equipemnt'               => 'required|numeric',
            'total_working_equipemnt'       => 'required|numeric',
            'total_non_working_equipemnt'   => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $district                      = $request->input('district');
        $station                       = $request->input('station');
        $category                      = $request->input('category');
        $name                          = $request->input('name');
        $total_equipemnt               = $request->input('total_equipemnt');
        $total_working_equipemnt       = $request->input('total_working_equipemnt');
        $total_non_working_equipemnt   = $request->input('total_non_working_equipemnt'); // Fixed
    
        $tbl = 'equipment';
        $data = [
            'district_id'                   => $district,
            'station_id'                    => $station,
            'category_id'                   => $category,
            'equipment_name'                => $name,
            'total_equipemnt'               => $total_equipemnt,
            'total_working_equipment'       => $total_working_equipemnt,
            'total_non_working_equipment'   => $total_non_working_equipemnt
        ];
    
        $result = $this->commonModel->insertData($tbl, $data);
        if ($result) {
            return redirect()->back()->with('success', 'Equipment Added Successfully');
        } else {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    

    public function editequipment($id)
    {
        $tbl='districts';
        // $getDistrict = $this->commonModel->getData($tbl);
        if (Auth::user()->type == 3) {
            $getDistrict = DB::table('districts')
                ->where('id', Auth::user()->district_id)
                ->get();
        } else {
            $getDistrict = $this->commonModel->getData($tbl);
        }
        $tbl2='equipment_category';
        $getCategory = $this->commonModel->getData($tbl2);
        $tbl3='equipment_name';
        $getEquipmentName = $this->commonModel->getData($tbl3);
        $tbl4='fire_stations';
        $getFireStation = $this->commonModel->getData($tbl4);
        $getData = $this->commonModel->getEquipmentDataById($id);
        return view('admin.equipments.edit',compact('getData','getDistrict','getCategory','getEquipmentName','getFireStation'));
    }


    public function updateequipment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district'                      => 'required',
            'station'                       => 'required',
            'category'                      => 'required',
            'name'                          => 'required',
            'total_equipemnt'               => 'required|numeric',
            'total_working_equipemnt'       => 'required|numeric',
            'total_non_working_equipemnt'   => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $district                      = $request->input('district');
        $station                       = $request->input('station');
        $category                      = $request->input('category');
        $name                          = $request->input('name');
        $total_equipemnt               = $request->input('total_equipemnt');
        $total_working_equipemnt       = $request->input('total_working_equipemnt');
        $total_non_working_equipemnt   = $request->input('total_non_working_equipemnt');
        $eid                           = $request->input('eid');

        $tbl = 'equipment';
        $data = [
            'district_id'                   => $district,
            'station_id'                    => $station,
            'category_id'                   => $category,
            'equipment_name'                => $name,
            'total_equipemnt'               => $total_equipemnt,
            'total_working_equipment'       => $total_working_equipemnt,
            'total_non_working_equipment'   => $total_non_working_equipemnt
        ];
        $where =['id' => $eid];

        $result = $this->commonModel->updateDataByOneCondition($tbl,$where,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Equipment Updated Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function deleteequipment(Request $request)
    {
        $tbl = 'equipment';
        $where = ['id' => $request->input('id')];
        $result = $this->commonModel->deleteDataByOneCondition($tbl,$where);
        if($result)
        {
            $response = array(
                "status" => "1",
                "message" => "Equipment Deleted Successfully"
            );
            return json_encode($response);
        }
        else{
            $response = array(
                "status" => "0",
                "message" => "Something Went Wrong Try Later!"
            );
            return json_encode($response);
        }
    }

}    
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


class VehicleTypesController extends Controller
{
    
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $vehicletypes = $this->commonModel->getData('vehicle_types');
        return view('admin.vehicle_types.index', compact('vehicletypes'));
    }
    public function addVehicleTypesForm()
    {
        return view('admin.vehicle_types.add');
    }
    public function saveVehicleTypes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type'  => 'required',
            'status'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'type' => $request->input('vehicle_type'),
            'status' => $request->input('status'),
        ];
        $result = $this->commonModel->insertData('vehicle_types', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Vehicle Type saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function editVehicleTypesForm($id)
    {
        $vehicletypes = $this->commonModel->getDataByOneCondition('vehicle_types', array('id' => $id));
        return view('admin.vehicle_types.edit', compact('vehicletypes'));
    }
    public function updateVehicleTypes(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vehicle_type'  => 'required',
            'status'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id   = $request->input('id');
        $where =['id' => $id];
        $data = [
            'type' => $request->input('vehicle_type'),
            'status' => $request->input('status'),
        ];

        $result = $this->commonModel->updateDataByOneCondition('vehicle_types', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Vehicle Type updated successfully');
        }
        elseif($result == 2)
        {
            return redirect()->back()->with('failed', 'Nothing to update.');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function deleteVehicleTypes($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('vehicle_types', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Vehicle Type deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    
}
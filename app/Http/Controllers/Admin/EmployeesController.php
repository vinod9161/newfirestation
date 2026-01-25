<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HydrantModel;
use App\Models\location\BlockModel;
use App\Models\Employee\EmployeeModel as Employee;

use App\Models\location\DistrictModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller{
    public function index(){
        $data['fs_employee'] = DB::table('fs_employee')
                        ->join('fire_stations', 'fs_employee.station_id', '=', 'fire_stations.id')
                        ->join('districts', 'fs_employee.district_id', '=', 'districts.id')
                        ->select('fs_employee.*', 'fire_stations.name as fire_station_name', 'districts.name as district_name')
                        ->get()
                        ->toArray();
        return view('admin.Employee.index',$data);
    }

    public function create(){
        $data['districts'] = DistrictModel::all();
        $data['stations'] = DB::table('fire_stations')->get();
        return view('admin.Employee.add',$data);
    }

    public function store(Request $request)
    {

        $request->validate([
            'employee_code' => 'required|unique:fs_employee,employee_code',
            'name' => 'required|string|max:255'
        ], [
            'employee_code.required' => 'The employee code is required.',
            'employee_code.unique' => 'The employee code already exists.'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $request['assigned_to'] = Auth::user()->id;
        if($request->departmental_course) {
            $request['departmental_course'] = implode(", ",$request->departmental_course);
        }
        Employee::create($request->all());
        return redirect()->route('admin.employees')->with('success', 'Employee added successfully!');
    }


    public function edit($id){
        $data['employee'] = Employee::findOrFail($id);
        $data['districts'] = DistrictModel::all();
        $data['stations'] = DB::table('fire_stations')->get();
        return view('admin.Employee.edit',$data);
    }

    

    public function destroy($id){
        $record = Employee::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.employees')->with('success', 'Employee deleted successfully.');
    }
   
}
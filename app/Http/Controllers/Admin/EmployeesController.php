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
use Illuminate\Validation\Rule;
use App\Models\Common\CommonModel;

class EmployeesController extends Controller{

    protected $commonModel;
    public function __construct(){
        //  $this->middleware('auth');
        $this->commonModel = new CommonModel;
    }

    public function index(Request $request)
    {
        $user = Auth::user();

        $query = DB::table('fs_employee')
            ->join('fire_stations', 'fs_employee.station_id', '=', 'fire_stations.id')
            ->join('districts', 'fs_employee.district_id', '=', 'districts.id')
            ->select(
                'fs_employee.*',
                'fire_stations.name as fire_station_name',
                'districts.name as district_name'
            );

        // 🔒 Role-based restriction
        if ($user->type == 2) {
            $query->where('fs_employee.district_id', $user->district_id);
        } elseif ($user->type == 3) {
            $query->where('fs_employee.station_id', $user->station_id);
        }

        // 🔍 Filters
        if ($request->district) {
            $query->where('fs_employee.district_id', $request->district);
        }

        if ($request->station) {
            $query->where('fs_employee.station_id', $request->station);
        }

        if ($request->designation) {
            $query->where('fs_employee.designation', 'like', '%' . $request->designation . '%');
        }

        $data['fs_employee'] = $query->orderBy('fs_employee.id', 'desc')->get();
        if(Auth::user()->type == 1 || Auth::user()->type == 0)
        {
            $district = $this->commonModel->getData('districts');
        }
        else
        {
            $district = $this->commonModel->getDataByOneCondition('districts', array('id' => Auth::user()->district_id));
        }
        $data['districts'] = $district;
        // $data['stations'] = DB::table('fire_stations')->get();

        return view('admin.Employee.index', $data);
    }

    public function create(){
        if (Auth::user()->type != 0 && Auth::user()->type != 1) {
            abort(403, 'Unauthorized access');
        }
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

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }


        $request['assigned_to'] = Auth::user()->id;
        if($request->departmental_course) {
            $request['departmental_course'] = implode(", ",$request->departmental_course);
        }
        Employee::create($request->all());
        return redirect()->route('admin.employees')->with('success', 'Employee added successfully!');
    }


    public function edit($id){
        if (Auth::user()->type == 3) {
            abort(403, 'Unauthorized access');
        }
        $data['employee'] = Employee::findOrFail($id);
        $data['districts'] = DistrictModel::all();
        $data['stations'] = DB::table('fire_stations')->get();
        
        if (Auth::user()->type == 2) {
            $isCFO = true;
        }else{
            $isCFO = false;
        }
        $data['isCFO'] = $isCFO;
        return view('admin.Employee.edit',$data);
    }


    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $user = Auth::user();

        // Trim
        $request->merge([
            'employee_code' => trim($request->employee_code)
        ]);

        // ✅ Common validation
        $rules = [
            'designation' => 'required|string|max:255',
            'education' => 'nullable|string|max:255',
            'remark' => 'nullable|string|max:255',
            'station_id' => 'required|exists:fire_stations,id',
        ];

        // ✅ Extra validation for Admin only
        if ($user->type != 2) {
            $rules['employee_code'] = [
                'required',
                Rule::unique('fs_employee', 'employee_code')->ignore($employee->id)
            ];
            $rules['name'] = 'required|string|max:255';
        }

        $request->validate($rules);

        // ✅ Prepare data based on role
        if ($user->type == 2) {
            // CFO → restricted update
            $data = [
                'designation' => $request->designation,
                'education' => $request->education,
                'remark' => $request->remark,
                'station_id' => $request->station_id,
            ];

            if ($request->states) {
                $data['departmental_course'] = implode(", ", $request->states);
            }

        } else {
            // Admin → full update
            $data = $request->except(['_token', '_method']);

            if ($request->states) {
                $data['departmental_course'] = implode(", ", $request->states);
            }
        }

        $employee->update($data);

        return redirect()->route('admin.employees')
            ->with('success', 'Employee updated successfully!');
    }

    

    public function destroy($id){
        $record = Employee::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.employees')->with('success', 'Employee deleted successfully.');
    }
   
}
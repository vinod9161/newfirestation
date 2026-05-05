<?php

namespace App\Http\Controllers\Admin\Department;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\TehsilModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeputyController extends Controller{
    public function index(){
        $data['DeputyData'] = User::where('users.type', '1')->get();
        return view('admin.Department.deputy.index',$data);
    }

    public function destroy($id){
        $record = User::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.deptydirector')->with('success', 'Deputy deleted successfully.');
    }

    public function add()
    {

        return view('admin.Department.deputy.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|max:255|email|unique:users,email',
            'phone' => 'required|numeric|unique:users,number',
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->phone,
            'type'  => '1',
            'password'=> Hash::make(12345678),
        ]);

        return redirect()->route('admin.deptydirector')->with('success', 'Deputy added successfully!');
    }


    public function edit($id)
    {
        $data['deptydirector'] = User::findOrFail($id);
        return view('admin.Department.deputy.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|max:255|email',
            'phone' => 'required|numeric',
        ]);
        $district = User::findOrFail($id);
        $district->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->phone,
        ]);
        return redirect()->route('admin.deptydirector')->with('success', 'District updated successfully!');
    }


    public function filter(Request $request){

        $query = User::select('*')->where('users.type', '1');

        if ($request->filled('filter_name')) {
            $query->where('users.name', 'like', '%' . $request->input('filter_name') . '%');
        }

        if ($request->filled('filter_email')) {
            $query->where('users.email', 'like', '%' . $request->input('filter_email') . '%');
        }

        if ($request->filled('phone')) {
            $query->where('users.number', 'like', '%' . $request->input('phone') . '%');
        }

        if ($request->filled('status')) {
            $query->where('users.status', $request->input('status'));
        }
        $deputy = $query->get();
        $data['DeputyData'] = $deputy;
        return view('admin.Department.deputy.index', $data);
    }

}

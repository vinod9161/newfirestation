<?php

namespace App\Http\Controllers\Admin\Department;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\TehsilModel;
use App\Models\User;
use App\Models\location\DistrictModel;
use Illuminate\Support\Facades\DB;

class ReviewOfficerController extends Controller{
    public function index(){
        $data['reviewOfficer'] = User::with('district')->where('type', '5')->get();
        return view('admin.Department.review.index',$data);
    }

    public function destroy($id){
        $record = User::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.review')->with('success', 'Review deleted successfully.');
    }

    public function add()
    {

        $data['district'] =  DistrictModel::with('stations')->take(13)->get();
        return view('admin.Department.review.add', $data);
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
            'district_id' => $request->district_id,
            'type'  => '5',
            'password'=> Hash::make(12345678),
        ]);

        return redirect()->route('admin.review')->with('success', 'Review added successfully!');
    }


    // public function edit($id)
    // {
    //     $data['deptydirector'] = User::findOrFail($id);
    //     $data['district'] =  DistrictModel::with('station')->take(13)->get();
    //     return view('admin.Department.review.edit', $data);
    // }

    public function edit($id)
    {
        $data['review'] = User::findOrFail($id); // ✅ review officer
        $data['district'] = DistrictModel::all(); // ✅ dropdown list

        return view('admin.Department.review.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|max:255|email',
            'mobile' => 'required|numeric',
            'district_id' => 'required'
        ]);

        $review = User::findOrFail($id);

        $review->update([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->mobile,
            'district_id' => $request->district_id, // 👈 important
        ]);

        return redirect()->route('admin.review')
            ->with('success', 'Review updated successfully!');
    }




    public function filter(Request $request)
    {

        $query = User::select('users.*', 'districts.name as district_name')
                       ->join('districts', 'users.district_id', '=', 'districts.id')->where('type', '5');

        if ($request->filled('filter_name')) {
            $query->where('users.name', 'like', '%' . $request->input('filter_name') . '%');
        }

        if ($request->filled('filter_email')) {
            $query->where('users.email', 'like', '%' . $request->input('filter_email') . '%');
        }

        if ($request->filled('district_name')) {
            $query->where('districts.name', 'like', '%' . $request->input('district_name') . '%');
        }

        if ($request->filled('status')) {
            $query->where('users.status', $request->input('status'));
        }
        $reviewOfficer = $query->get();
        $data['reviewOfficer'] = $reviewOfficer;
        return view('admin.Department.review.index', $data);
    }

}

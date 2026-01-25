<?php

namespace App\Http\Controllers\Admin\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\TehsilModel;
use App\Models\location\DistrictModel;
use Illuminate\Support\Facades\DB;

class TehsilController extends Controller{
    public function index(){
        $data['tehsils'] = TehsilModel::select('tehsils.*', 'districts.name as district_name')
                            ->join('districts', 'tehsils.district_id', '=', 'districts.id')
                            ->orderBy('tehsils.created_at', 'desc')
                            ->get();
        return view('admin.location.tehsil.index',$data);
    }

    public function destroy($id){
        $record = TehsilModel::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.tehsil')->with('success', 'Tehsil deleted successfully.');
    }

    public function add()
    {
        $data['districts'] = DistrictModel::all(); 
        return view('admin.location.tehsil.add',$data);
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'district_name' => 'required|exists:districts,id', 
            'description' => 'nullable|string|max:500', 
        ]);
        

        TehsilModel::create([
            'name' => $request->name,
            'district_id' => $request->district_name,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.tehsil')->with('success', 'Tehsil added successfully!');
    }


    public function edit($id)
    {
        $data['tehsil'] = TehsilModel::findOrFail($id);
        $data['districts'] = DistrictModel::all(); 

        return view('admin.location.tehsil.edit', $data); 
    }   


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'district_name' => 'required|exists:districts,id', 
            'description' => 'nullable|string|max:500', 
        ]);
        $district = TehsilModel::findOrFail($id);
        $district->update([
            'name' => $request['name'],
            'district_id' => $request['district_name'],
            'description' => $request['description'],
        ]);
        return redirect()->route('admin.tehsil')->with('success', 'District updated successfully!');
    }

    public function filter(Request $request)
    {
        $query = TehsilModel::select('tehsils.*', 'districts.name as district_name')
                            ->join('districts', 'tehsils.district_id', '=', 'districts.id');
        if ($request->filled('name')) {
            $query->where('tehsils.name', 'like', '%' . $request->input('name') . '%');
        }
    
        if ($request->filled('district_name')) {    
            $query->where('districts.name', 'like', '%' . $request->input('district_name') . '%');
        }
    
        if ($request->filled('status')) {
            $query->where('tehsils.status', $request->input('status'));
        }
        $tehsils = $query->get();
        $data['tehsils'] = $tehsils;
        return view('admin.location.tehsil.index', $data);
    }
    
}
<?php

namespace App\Http\Controllers\Admin\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\BlockModel;
use App\Models\location\DistrictModel;
use Illuminate\Support\Facades\DB;

class BlockController extends Controller{
    public function index(){ 
        $data['tehsils'] = BlockModel::select('blocks.*', 'districts.name as district_name')
                            ->join('districts', 'blocks.district_id', '=', 'districts.id')
                            ->orderBy('blocks.created_at', 'desc')
                            ->get();
        return view('admin.location.block.index',$data);
    }
    

    public function destroy($id){
        $record = BlockModel::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.block')->with('success', 'Block deleted successfully.');
    }


    public function add()
    {
        $data['districts'] = DistrictModel::all(); 
        return view('admin.location.block.add',$data);
    }
   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255', 
            'district_name' => 'required|exists:districts,id', 
            'description' => 'nullable|string|max:500', 
        ]);
        

        BlockModel::create([
            'name' => $request->name,
            'district_id' => $request->district_name,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Block added successfully!');
    }


    public function edit($id)
    {
        $district = BlockModel::findOrFail($id);
        return view('admin.location.block.edit', compact('district')); 
    }   


    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        $district = BlockModel::findOrFail($id);
        $district->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);
        return redirect()->route('admin.block')->with('success', 'Block updated successfully!');
    }


    public function filter(Request $request)
    {
        $query = BlockModel::select('blocks.*', 'districts.name as district_name')
                            ->join('districts', 'blocks.district_id', '=', 'districts.id');
        if ($request->filled('name')) {
            $query->where('blocks.name', 'like', '%' . $request->input('name') . '%');
        }
    
        if ($request->filled('district_name')) {    
            $query->where('districts.name', 'like', '%' . $request->input('district_name') . '%');
        }
    
        if ($request->filled('status')) {
            $query->where('blocks.status', $request->input('status'));
        }
        $tehsils = $query->get();
        $data['tehsils'] = $tehsils;
        return view('admin.location.block.index', $data);
    }
    
   
}
<?php

namespace App\Http\Controllers\Admin\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\DistrictModel;
use App\Models\location\PanchayatModel;
use Illuminate\Support\Facades\DB;

class PanchayatController extends Controller{
        public function index(){
            $data['panchayat'] = PanchayatModel::select('panchayats.*', 'tehsils.name as tehsil_name', 'districts.name as district_name','blocks.name as blocks_name')
                                    ->join('tehsils', 'panchayats.tehsil_id', '=', 'tehsils.id') 
                                    ->join('districts', 'tehsils.district_id', '=', 'districts.id') 
                                    ->join('blocks', 'panchayats.block_id', '=', 'blocks.id') 
                                    ->orderBy('panchayats.created_at', 'desc') 
                                    ->get();

            // echo "<prE>"; print_r($data); 
            return view('admin.location.panchayat.index',$data);
        }
        

        public function destroy($id){
            
            $record = PanchayatModel::findOrFail($id);
            $record->delete();

            if($record)
            {
                return redirect()->back()->with('success', 'Panchayat deleted successfully');
            }
            else{
                return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
            }
        }
       

        public function add()
        {
            $data['districts'] = DistrictModel::all(); 
            return view('admin.location.panchayat.add',$data); 
        }
    
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500', 
            ]);
        
            PanchayatModel::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);
            return redirect()->route('admin.panchayat')->with('success', 'District added successfully!');
        }

        public function edit($id)
        {
            $district = PanchayatModel::findOrFail($id);
            return view('admin.location.panchayat.edit', compact('district')); 
        }   


        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);
            $district = PanchayatModel::findOrFail($id);
            $district->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);
            return redirect()->route('admin.panchayat')->with('success', 'District updated successfully!');
        }


        public function filter(Request $request)
        {
            $query = PanchayatModel::select('panchayats.*', 'tehsils.name as tehsil_name', 'districts.name as district_name','blocks.name as blocks_name')
                                    ->join('tehsils', 'panchayats.tehsil_id', '=', 'tehsils.id') 
                                    ->join('districts', 'tehsils.district_id', '=', 'districts.id') 
                                    ->join('blocks', 'panchayats.block_id', '=', 'blocks.id') ;

            if ($request->filled('name')) {
                $query->where('panchayats.name', 'like', '%' . $request->input('name') . '%');
            }
        
            if ($request->filled('district_name')) {    
                $query->where('districts.name', 'like', '%' . $request->input('district_name') . '%');
            }
        

            if ($request->filled('blocks_name')) {    
                $query->where('blocks.name', 'like', '%' . $request->input('blocks_name') . '%');
            }

            if ($request->filled('status')) {
                $query->where('panchayats.status', $request->input('status'));
            }
            $tehsils = $query->get();
            $data['panchayat'] = $tehsils;
            return view('admin.location.panchayat.index', $data);
        }
        

}
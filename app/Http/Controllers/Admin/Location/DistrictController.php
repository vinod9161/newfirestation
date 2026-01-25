<?php

namespace App\Http\Controllers\Admin\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\DistrictModel;
use Illuminate\Support\Facades\DB;

class DistrictController extends Controller{

        public function index(){
            $data['districts'] = DistrictModel::orderBy('created_at', 'desc')->get();   
            return view('admin.location.district.index',$data);
        }
        

        public function destroy($id){
            
            $record = DistrictModel::findOrFail($id);
            $record->delete();

            if($record)
            {
                return redirect()->back()->with('success', 'District deleted successfully');
            }
            else{
                return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
            }
            //return redirect()->route('admin.district')->with('success', 'District deleted successfully.');
        }
       

        public function add()
        {
            return view('admin.location.district.add'); 
        }
    
        public function store(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500', 
            ]);
        
            DistrictModel::create([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);
            return redirect()->route('admin.district')->with('success', 'District added successfully!');
        }

        public function edit($id)
        {
            $district = DistrictModel::findOrFail($id);
            return view('admin.location.district.edit', compact('district')); 
        }   


        public function update(Request $request, $id)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string|max:500',
            ]);
            $district = DistrictModel::findOrFail($id);
            $district->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
            ]);
            return redirect()->route('admin.district')->with('success', 'District updated successfully!');
        }


        public function filter(Request $request){
            $query = DistrictModel::query();
            if ($request->filled('page')) {
                $query->where('name', 'like', '%' . $request->input('page') . '%');
            }
            if ($request->filled('status')) {
                $query->where('status', $request->input('status'));
            }
            $sliders = $query->get();
            // echo "<pre>"; print_r(DB::getQueryLog()); die;
          

            $data['districts'] =  $sliders;   
            return view('admin.location.district.index',$data);
        }


}
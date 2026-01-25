<?php

namespace App\Http\Controllers\Admin\Department;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\TehsilModel;
use App\Models\location\DistrictModel;
use App\Models\Models\Station;

use App\Models\User;

use Illuminate\Support\Facades\DB;

class FSOController extends Controller
{
    public function index()
    {
        $data['fso'] = User::with(['district','stations'])->where('type', '=', '3')->orderBy('id', 'desc')->get();
        return view('admin.Department.fso.index',$data);
    }



    public function add()
    {
        $fso = User::with('district')->where('type', '=', '3')->get();
        $districts = DistrictModel::with('stations')->take(13)->get();
        return view('admin.Department.fso.add', [
            'fso' => $fso,
            'districts' => $districts
        ]);
    }



	public function store(Request $request)
    {
        $userModel = new User;
		$validatedData = Validator::make($request->all(), [
        'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
        'email' => 'required|max:255|email|unique:users,email',
        'phone' => 'required|numeric|unique:users,number',
        'district_id' => 'required',
        'fire_station_id' => 'required',
        ]);

        if ($validatedData->fails())
        {
            return redirect()->back()->withErrors($validatedData->errors())->withInput();
        }

        $type = '3';
        $station_id = $request->fire_station_id;
        $whereArray = ['type'=>'3', 'station_id' =>$station_id];

        $checkUserExist = $userModel->checkUserExist($whereArray);
        if($checkUserExist)
        {
            return redirect()->back()->with('failed', 'An FSO has already been assigned to this fire station.')->withInput();
            die;
        }

        

        $result = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "number" => $request->phone,
            "district_id" => $request->district_id,
            "station_id" => $request->fire_station_id,
            "type" => '3',
            "password" => Hash::make(12345678),

        ]);

        if($result)
        {
            return redirect()->route('admin.fso')->with('success', 'fso added successfully!');
        }
        else{
            return redirect()->back()->with('failed', 'Fso Not Added Something Went Wrong Try Later!')->withInput();
        }
    }



    public function edit($id)
    {
        $fso = User::with(['district', 'stations'])->findOrFail($id);
        $districts = DistrictModel::all();
        $fireStations = Station::where('district_id', $fso->district_id)->get();

        return view('admin.Department.fso.edit', [
            'fso' => $fso,
            'districts' => $districts,
            'fireStations' => $fireStations,
        ]);
    }



    public function update(Request $request, $id)
    {
        $userModel = new User;
        $request->validate([
            'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|max:255|email|unique:users,email,' . $id,
            'phone' => 'required|numeric|unique:users,number,' . $id,
            'district_id' => 'required|exists:districts,id',
            'fire_station_id' => 'required',
            'status' => 'required'
        ]);


        $type = '3';
        $station_id = $request->fire_station_id;
        $whereArray = ['type'=>'3', 'station_id' => $station_id];

        $checkUserExist = $userModel->checkUserExist($whereArray);

        $user = User::findOrFail($id);

        if($user->station_id == $station_id)
        {
            $result = $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->phone,
                'district_id' => $request->district_id,
                'station_id' => $request->fire_station_id,
                'status' => $request->status
            ]);

            if($result)
            {
            return redirect()->route('admin.fso')->with('success', 'FSO updated successfully!');
            }
            else{
                return redirect()->back()->with('failed', 'Fso Not Updated Something Went Wrong Try Later!')->withInput();
            }
        }
        else{
            $checkUserExist = $userModel->checkUserExist($whereArray);
            if(!$checkUserExist)
            {
                $result = $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number' => $request->phone,
                    'district_id' => $request->district_id,
                    'station_id' => $request->fire_station_id,
                    'status' => $request->status
                ]);

                if($result)
                {
                return redirect()->route('admin.fso')->with('success', 'FSO updated successfully!');
                }
                else{
                    return redirect()->back()->with('failed', 'Fso Not Updated Something Went Wrong Try Later!')->withInput();
                }
            }
            else{
                return redirect()->back()->with('failed', 'An FSO has already been assigned to this fire station.')->withInput();
                die;
            } 
        }
    
    }



	public function destroy($id){
        $record = User::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.fso')->with('success', 'FSO deleted successfully.');
    }


    public function getFireStations($districtId)
    {
        $fireStations = Station::where('district_id', $districtId)->get();

        return response()->json($fireStations);
    }


    public function uploadSignature($id)
    {
        $fso  = User::where('id', '=', $id)->first();
        return view('admin.Department.fso.upload_signature')->with('fso',$fso);
    }

    public function uploadSignaturePost(Request $request)
    {
        $users = User::find($request->id);
        $input_data = $request->all();
        $validator_file = Validator::make(
        $input_data, [
        'signature' => 'required|mimes:jpg,jpeg,png,bmp|max:20000'
            ],[
                'signature.required' => 'Please upload an image',
                'signature.mimes' => 'Only jpg,jpeg,png and bmp images are allowed',
            ]
        );

        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only jpg,jpeg,png and bmp images are allowed!')->withInput();
        }

        if ($request->hasFile('signature')) {
            $imageName = time().'.'.$request->signature->extension();
            $request->signature->move('admin/signature', $imageName);
            $users->signature = 'admin/signature/'.$imageName;
        }

        $users->save();

        return redirect()->back()->with('message', 'Signature Uploaded Successfully!');
    }


    public function filter(Request $request)
    {

        $query = User::select('users.*', 'districts.name as district_name')
                       ->join('districts', 'users.district_id', '=', 'districts.id')
                       ->join('fire_stations', 'users.station_id', '=', 'fire_stations.id');

        if ($request->filled('filter_name')) {
            $query->where('users.name', 'like', '%' . $request->input('filter_name') . '%');
        }

        if ($request->filled('filter_email')) {
            $query->where('users.email', 'like', '%' . $request->input('filter_email') . '%');
        }

        if ($request->filled('district_name')) {
            $query->where('districts.name', 'like', '%' . $request->input('district_name') . '%');
        }
        if ($request->filled('stations_name')) {
            $query->where('fire_stations.name', 'like', '%' . $request->input('stations_name') . '%');
        }

        if ($request->filled('status')) {
            $query->where('users.status', $request->input('status'));
        }
        $fso = $query->get();
        $data['fso'] = $fso;
        return view('admin.Department.fso.index', $data);
    }


}

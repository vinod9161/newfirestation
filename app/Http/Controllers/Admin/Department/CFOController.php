<?php

namespace App\Http\Controllers\Admin\Department;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\TehsilModel;
use App\Models\location\DistrictModel;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CFOController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with('district')
            ->where('type', '2');

        if ($request->filled('filter_name'))
        {
            $query->where(
                'name',
                'LIKE',
                '%' . $request->filter_name . '%'
            );
        }

        if ($request->filled('filter_email'))
        {
            $query->where(
                'email',
                'LIKE',
                '%' . $request->filter_email . '%'
            );
        }

        if ($request->filled('district_id'))
        {
            $query->where(
                'district_id',
                $request->district_id
            );
        }

        if ($request->filled('status'))
        {
            $query->where(
                'status',
                $request->status
            );
        }

        $data['cfos'] = $query
            ->orderBy('id', 'DESC')
            ->get();

        $data['districts'] = DB::table('districts')
            ->orderBy('name')
            ->get();

        return view(
            'admin.Department.cfo.index',
            $data
        );
    }

	public function add()
	{
        $data['districts'] = DistrictModel::all();

		return view('admin.Department.cfo.add',$data);
	}

	public function store(Request $request)
    {
        $userModel = new User;
		$validatedData = Validator::make($request->all(), [
			'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
			'email' => 'required|max:255|email|unique:users,email',
			'phone' => 'required|numeric|unique:users,number',
			'districts' => 'required',
			]);

			if ($validatedData->fails())
			{
				return redirect()->back()->withErrors($validatedData->errors())->withInput();
			}

            $type = '2';
            $districts = $request->districts;
            $whereArray = ['type'=>'2', 'district_id' =>$districts];

            $checkUserExist = $userModel->checkUserExist($whereArray);
            if($checkUserExist)
            {
                return redirect()->back()->with('failed', 'An CFO has already been assigned to this district')->withInput();
                die;
            }

			$result = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "number" => $request->phone,
                "district_id" => $request->districts,
                "station_id" => $request->station_id,
                "type" => '2',
                "password" => Hash::make(12345678),

            ]);

            if($result)
            {
                return redirect()->route('admin.cfo')->with('success', 'CFO added successfully!');
            }
            else{
                 return redirect()->back()->with('failed', 'CFO Not Added Something Went Wrong Try Later!')->withInput();
            }


        
    }


    public function edit($id)
    {
        $data['cfo'] = User::findOrFail($id);
        $data['districts'] = DistrictModel::all();
        return view('admin.Department.cfo.edit', $data);
    }


    public function update(Request $request, $id)
    {
        $userModel = new User;
        $request->validate([
            'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
            'email' => 'required|max:255|email',
            'phone' => 'required|numeric',
			'districts' => 'required',

        ]);

        $type = '2';
        $districts = $request->districts;
        $whereArray = ['type'=>'2', 'district_id' =>$districts];

        $checkUserExist = $userModel->checkUserExist($whereArray);

        $district = User::findOrFail($id);

        if($district->district_id == $request->districts)
        {
            $result = $district->update([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->phone,
                "district_id" => $request->districts,

            ]);

            if($result)
            {
                return redirect()->route('admin.cfo')->with('success', 'CFO updated successfully!');
            }
            else{
                return redirect()->back()->with('failed', 'CFO Not Updated Something Went Wrong Try Later!')->withInput();
            }
        }
        else{
            $checkUserExist = $userModel->checkUserExist($whereArray);
            if(!$checkUserExist)
            {
                $result = $district->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'number' => $request->phone,
                    "district_id" => $request->districts,

                ]);

                if($result)
                {
                    return redirect()->route('admin.cfo')->with('success', 'CFO updated successfully!');
                }
                else{
                    return redirect()->back()->with('failed', 'CFO Not Updated Something Went Wrong Try Later!')->withInput();
                }

            }
            else{
                return redirect()->back()->with('failed', 'An CFO has already been assigned to this district')->withInput();
                die;
            }
        }

        

       


        
    }


	public function destroy($id){
        $record = User::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.cfo')->with('success', 'CFO deleted successfully.');
    }

	public function uploadSignature($id)
    {
        $cfo  = User::where('id', '=', $id)->first();
        return view('admin.Department.cfo.upload_signature')->with('cfo',$cfo);
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
                // 'signature.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ]
        );

        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only jpg,jpeg,png and bmp images are allowed!')->withInput();
        }

        if ($request->hasFile('signature')) {
            //  Let's do everything here
            $imageName = time().'.'.$request->signature->extension();
            $request->signature->move('admin/signature', $imageName);
            $users->signature = 'admin/signature/'.$imageName;
        }

        $users->save();

        return redirect()->back()->with('message', 'Signature Uploaded Successfully!');
    }

    public function filter(Request $request){
       $query = User::select('users.*', 'districts.name as district_name')
                    ->join('districts', 'users.district_id', '=', 'districts.id')->where('users.type', '2');
        if ($request->filled('filter_name')) {
            $query->where('users.name', 'like', '%' . $request->input('filter_name') . '%');
        }
        if ($request->filled('filter_email')) {
            $query->where('users.email', 'like', '%' . $request->input('filter_email') . '%');
        }
        if ($request->filled('filter_phone')) {
            $query->where('users.number', 'like', '%' . $request->input('filter_phone') . '%');
        }
        if ($request->filled('filter_district')) {
            $query->where('districts.name', 'like', '%' . $request->input('filter_district') . '%');
        }
        $cfos = $query->paginate(10);
        $data['cfos'] = $cfos;
        return view('admin.Department.cfo.index', $data);

    }


}

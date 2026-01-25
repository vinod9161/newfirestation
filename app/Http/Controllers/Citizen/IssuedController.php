<?php

namespace App\Http\Controllers\Citizen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;

class IssuedController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $district = $this->commonModel->getData('districts');
        $issued = $this->commonModel->getDataByOneCondition('issued_noc', array('user_id' => Auth::user()->id));
        return view('citizen.issued.issued', compact('issued','district'));
    }
    public function addIssuedNoc()
    {
        $districts = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        return view('citizen.issued.add', compact('projects','districts'));
    }

    
    public function addIssuedNocPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload_file' => 'mimes:pdf,jpg,jpeg,png,bmp|max:2000',
            [
                'upload_file.required' => 'Please upload pdf',
                'upload_file.mimes' => 'Only pdf,jpg,jpeg,png and bmp file are allowed',
            ]
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->hasFile('upload_file')) {
            $fileName = time() . '.' . $request->upload_file->getClientOriginalExtension();
            $request->file('upload_file')->move(public_path('citizen/file'), $fileName);
            $document = 'public/citizen/file/' . $fileName;
        }
        $tbl = "issued_noc";
        $data = [
            'application_no' => $request->application_no,
            'project' => $request->project,
            'application_type' => $request->application_type,
            'building_name' => $request->building_name,
            'district_id' => $request->district_id,
            'file' => $document,
            'user_id' => Auth::user()->id,
        ];
        $result = $this->commonModel->insertData($tbl, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Issue Noc saved sucessfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}
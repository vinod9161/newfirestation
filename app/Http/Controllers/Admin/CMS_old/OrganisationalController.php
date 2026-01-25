<?php

namespace App\Http\Controllers\Admin\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class OrganisationalController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $organisational = $this->commonModel->getData('organisational');
        return view('admin.CMS.organisational.organisational',compact('organisational'));
    }

    public function addOrganisationalForm()
    {
        return view('admin.CMS.organisational.add');
    }

    public function saveOrganisational(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type'  => 'required',
            'name'  => 'required',
            'designation'  => 'required',
            'mobile'  => 'required',
            'phone'  => 'required',
            'email'  => 'required',
            'district'  => 'required',
            'firestation'  => 'required',
            'rank'  => 'required',
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'designation' => $request->input('designation'),
            'mobile' => $request->input('mobile'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'district' => $request->input('district'),
            'firestation' => $request->input('firestation'),
            'rank' => $request->input('rank'),
            'status' => $request->input('status'),
        ];

        $result = $this->commonModel->insertData('organisational', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Organisational structure saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    
    public function editOrganisationalForm($id)
    {
        $organisational = $this->commonModel->getDataByOneCondition('organisational', array('id' => $id));
        return view('admin.CMS.organisational.edit', compact('organisational'));
    }


    public function updateOrganisational(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'  => 'required',
            'name'  => 'required',
            'designation'  => 'required',
            'mobile'  => 'required',
            'phone'  => 'required',
            'email'  => 'required',
            'district'  => 'required',
            'firestation'  => 'required',
            'rank'  => 'required',
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id   = $request->input('id');
        $where =['id' => $id];
        $data = [
            'type' => $request->input('type'),
            'name' => $request->input('name'),
            'designation' => $request->input('designation'),
            'mobile' => $request->input('mobile'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'district' => $request->input('district'),
            'firestation' => $request->input('firestation'),
            'rank' => $request->input('rank'),
            'status' => $request->input('status'),
        ];

        $result = $this->commonModel->updateDataByOneCondition('organisational', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Organisational structure updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function deleteOrganisational($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('organisational', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Organisational structure deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}
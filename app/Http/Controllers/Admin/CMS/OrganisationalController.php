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
            'type' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'mobile' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'district' => 'required',
            'firestation' => 'required',
            'rank' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
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

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $imageName);
                $data['profile_pic'] = 'uploads/' . $imageName; // Store relative path
            }

            // Insert data
            $result = $this->commonModel->insertData('organisational', $data);

            if ($result) {
                return redirect()->back()->with('success', 'Organisational structure saved successfully');
            }

            return redirect()->back()->with('error', 'Failed to save organisational structure');

        } catch (\Exception $e) {
            \Log::error('Error saving organisational structure: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
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
        try {
            $where = ['id' => $request->input('id')];
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

            // Handle file upload
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $imageName);
                $data['profile_pic'] = 'uploads/' . $imageName; // Store relative path
            }

            // Insert data
            $result = $this->commonModel->updateDataByOneCondition('organisational', $where, $data);

            if ($result) {
                return redirect()->back()->with('success', 'Organisational structure updated successfully');
            }

            return redirect()->back()->with('error', 'Failed to update organisational structure');

        } catch (\Exception $e) {
            \Log::error('Error saving organisational structure: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
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
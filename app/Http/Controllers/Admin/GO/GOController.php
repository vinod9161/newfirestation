<?php

namespace App\Http\Controllers\Admin\GO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class GOController extends Controller
{
    protected $commonModel;

    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function indexGoCircularPlan()
    {
        $tbl = 'fs_go_circular';
        $getGo = $this->commonModel->getData($tbl);
        // echo "<pre>"; print_r($getGo);die;
        return view('admin.go.gocircular', compact('getGo'));
    }

    public function addGoCircular()
    {
        $userId = Auth::user()->id;
        return view('admin.go.add', compact('userId'));
    }

    public function indexGoCircularPlanPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number'  => 'required',
            'date'    => 'required',
            'type'    => 'required',
            'title'   => 'required|string|max:1024',
            'subject' => 'required|string|max:1024',
            'file'    => 'required|file|mimes:pdf',
            'id'      => 'required|integer',
            'visibility' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $number     = $request->input('number');
        $date       = $request->input('date');
        $type       = $request->input('type');
        $title      = $request->input('title');
        $subject    = $request->input('subject');
        $userId     = $request->input('id');

        // visibility convert array to string
        $visibility = implode(',', $request->visibility);

        $goFile = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $imageName);
            $goFile = 'public/citizen/file/' . $imageName;
        } 
        else 
        {
            return redirect()->back()->with('failed', 'File upload failed. Please try again.');
        }

        $tbl = 'fs_go_circular';

        $data = [
            'number'     => $number,
            'title'      => $title,
            'user_id'    => $userId,
            'type'       => $type,
            'subject'    => $subject,
            'file'       => $goFile,
            'date'       => $date,
            'visibility' => $visibility
        ];

        $result = $this->commonModel->insertData($tbl,$data);

        if($result)
        {
            return redirect()->back()->with('success', 'Go Circular Added Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function editGoCircular($id)
    {
        $tbl = 'fs_go_circular';
        $where = ['id' => $id];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where)[0];
        return view('admin.go.edit', compact('getData'));
    }

    public function indexGoCircularPlanPostUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number'  => 'required',
            'date'    => 'required',
            'type'    => 'required',
            'title'   => 'required|string|max:1024',
            'subject' => 'required|string|max:1024',
            'file'    => 'nullable|file|mimes:pdf',
            'visibility' => 'required|array'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $number     = $request->input('number');
        $date       = $request->input('date');
        $type       = $request->input('type');
        $title      = $request->input('title');
        $subject    = $request->input('subject');
        $goid       = $request->input('goid');
        $userId     = Auth::user()->id;

        // convert array to string
        $visibility = implode(',', $request->visibility);

        $data = [
            'number'     => $number,
            'title'      => $title,
            'user_id'    => $userId,
            'type'       => $type,
            'subject'    => $subject,
            'date'       => $date,
            'visibility' => $visibility
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $imageName);
            $data['file'] = 'public/citizen/file/' . $imageName;
        }

        $tbl = 'fs_go_circular';
        $where = ['id' => $goid];

        $result = $this->commonModel->updateDataByOneCondition($tbl, $where, $data);

        if ($result) {
            return redirect()->back()->with('success', 'Go Circular Updated Successfully');
        }
        else {
            return redirect()->back()->with('failed', 'Something Went Wrong. Try Again!');
        }
    }


    public function deleteGoCircularPlan($id)
    {
        $tbl = 'fs_go_circular';
        $where = ['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition($tbl,$where);
        if($result)
        {
            return redirect()->back()->with('success', 'Go Circular Deleted Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

}
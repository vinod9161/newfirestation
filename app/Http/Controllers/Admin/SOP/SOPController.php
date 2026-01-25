<?php

namespace App\Http\Controllers\Admin\SOP;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class SOPController extends Controller
{
    protected $commonModel;

    
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function indexSOP()
    {
        $tbl = 'ct_upload_sop';
        $getSop = $this->commonModel->getData($tbl);
        return view('admin.sop.soplist', compact('getSop'));
    }

    public function addSOP()
    {
        $userId = Auth::user()->id;
        return view('admin.sop.addsop', compact('userId'));
        
    }

    public function indexSOPPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:1024',
            'file'    => 'required|file|mimes:pdf',
            'status'    => 'required',
            'id'      => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $subject = $request->input('subject');
        $status = $request->input('status');
        $userId = $request->input('id');
        $sopFile = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $imageName);
            $sopFile = 'public/citizen/file/' . $imageName;
        } 
        else 
        {
            return redirect()->back()->with('failed', 'File upload failed. Please try again.');
        }


        $tbl = 'ct_upload_sop';
        $data = [
            'subject' => $subject,
            'upload_sop' => $sopFile,
            'status' => $status,
            'user_id' => $userId
        ];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'SOP Added Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function deleteSOP($id)
    {
        $tbl = 'ct_upload_sop';
        $where = ['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition($tbl,$where);
        if($result)
        {
            return redirect()->back()->with('success', 'SOP Deleted Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    
    public function editSOP($id)
    {
        $userId = Auth::user()->id;
        $tbl = 'ct_upload_sop';
        $getSop = $this->commonModel->getDataByOneCondition($tbl,array('id' => $id));
        return view('admin.sop.editsop', compact('userId','getSop'));
    }
    // public function updateSOP(Request $request)
    // {
    //     $fileRule = $request->hasFile('file') ? 'required|file|mimes:pdf' : 'nullable|file|mimes:pdf';

    //     $validator = Validator::make($request->all(), [
    //         'subject' => 'required',
    //         'file'    => $fileRule,
    //         'status'  => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return redirect()->back()
    //             ->withErrors($validator)
    //             ->withInput();
    //     }

    //     $subject = $request->input('subject');
    //     $status  = $request->input('status');
    //     $id      = $request->input('id');
    //     $userId  = Auth::user()->id;

    //     $data = [
    //         'subject' => $subject,
    //         'status'  => $status,
    //         'user_id' => $userId,
    //     ];

    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    //         $imageName = time() . '.' . $file->getClientOriginalExtension();
    //         $file->move(public_path('citizen/file'), $imageName);
    //         $sopFile = 'public/citizen/file/' . $imageName;

    //         $data['upload_sop'] = $sopFile;
    //     }

    //     $where  = ['id' => $id,'user_id' => $userId];
    //     $tbl    = 'ct_upload_sop';

    //     $result = $this->commonModel->updateDataByOneCondition($tbl, $where, $data);

    //     if ($result == 1) {
    //         return redirect()->back()->with('success', 'SOP updated successfully');
    //     } elseif ($result == 2) {
    //         return redirect()->back()->with('failed', 'Nothing to update.');
    //     } else {
    //         return redirect()->back()->with('failed', 'Something went wrong. Try again later!');
    //     }
    // }


    public function updateSOP(Request $request)
    {
        $fileRule = $request->hasFile('file') ? 'required|file|mimes:pdf' : 'nullable|file|mimes:pdf';

        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'file'    => $fileRule,
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $subject = $request->input('subject');
        $status  = $request->input('status');
        $id      = $request->input('id');
        $userId  = Auth::user()->id;

        $data = [
            'subject' => $subject,
            'status'  => $status,
            'user_id' => $userId,
        ];

        if ($request->hasFile('file'))
        {
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $imageName);
            $sopFile = 'public/citizen/file/' . $imageName;

            $data['upload_sop'] = $sopFile;
        }

        $where = ['id' => $id];
        $where1 = ['user_id' => $userId];
        $tbl = 'ct_upload_sop';

        $result = $this->commonModel->updateDataByOneCondition($tbl, $where, $data);

        if ($result === '1') {
            return redirect()->back()->with('success', 'SOP updated successfully');
        } elseif ($result === '2') {
            return redirect()->back()->with('failed', 'Nothing to update.');
        } else {
            return redirect()->back()->with('failed', 'Something went wrong. Try again later!');
        }
    }


}

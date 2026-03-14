<?php

namespace App\Http\Controllers\Admin\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeadershipSection;
use Validator;

class LeadershipSectionController extends Controller
{

    // View Form
    public function addLeadershipSectionForm()
    {
        return view('admin.CMS.leadership.add');
    }


    // Save Data
    public function saveLeadershipSection(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cm_name' => 'required',
            'cm_designation' => 'required',
            'cm_image' => 'required|image',

            'dgp_name' => 'required',
            'dgp_designation' => 'required',
            'dgp_image' => 'required|image',

            'subject' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        // Upload CM Image
        if ($request->hasFile('cm_image')) {

            $fileName = time().'_cm.'.$request->cm_image->getClientOriginalExtension();

            $request->cm_image->move(public_path('admin/leadership'), $fileName);

            $cm_image = 'admin/leadership/'.$fileName;
        }


        // Upload DGP Image
        if ($request->hasFile('dgp_image')) {

            $fileName = time().'_dgp.'.$request->dgp_image->getClientOriginalExtension();

            $request->dgp_image->move(public_path('admin/leadership'), $fileName);

            $dgp_image = 'admin/leadership/'.$fileName;
        }


        $data = [

            'cm_name' => $request->cm_name,
            'cm_designation' => $request->cm_designation,
            'cm_image' => $cm_image,

            'dgp_name' => $request->dgp_name,
            'dgp_designation' => $request->dgp_designation,
            'dgp_image' => $dgp_image,

            'subject' => $request->subject,
            'content' => $request->content,
            'status' => $request->status
        ];


        LeadershipSection::create($data);

        return redirect()->back()->with('success','Leadership Section Saved Successfully');
    }

    public function leadershipSectionList()
    {
        $leadership = LeadershipSection::orderBy('id','desc')->get();
        return view('admin.CMS.leadership.index',compact('leadership'));
    }


    public function editLeadershipSectionForm($id)
    {
        $leadership = LeadershipSection::where('id',$id)->first();
        return view('admin.CMS.leadership.edit',compact('leadership'));
    }


    public function updateLeadershipSection(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cm_name' => 'required',
            'cm_designation' => 'required',
            'dgp_name' => 'required',
            'dgp_designation' => 'required',
            'subject' => 'required',
            'content' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $id = $request->id;

        $data = [

            'cm_name' => $request->cm_name,
            'cm_designation' => $request->cm_designation,

            'dgp_name' => $request->dgp_name,
            'dgp_designation' => $request->dgp_designation,

            'subject' => $request->subject,
            'content' => $request->content,
            'status' => $request->status
        ];


        if ($request->hasFile('cm_image')) {

            $fileName = time().'_cm.'.$request->cm_image->getClientOriginalExtension();
            $request->cm_image->move(public_path('admin/leadership'), $fileName);

            $data['cm_image'] = 'admin/leadership/'.$fileName;
        }


        if ($request->hasFile('dgp_image')) {

            $fileName = time().'_dgp.'.$request->dgp_image->getClientOriginalExtension();
            $request->dgp_image->move(public_path('admin/leadership'), $fileName);

            $data['dgp_image'] = 'admin/leadership/'.$fileName;
        }


        LeadershipSection::where('id',$id)->update($data);

        return redirect()->route('admin.leadershipSectionList')
        ->with('success','Leadership Section Updated Successfully');
    }


    public function deleteLeadershipSection($id)
    {
        LeadershipSection::where('id',$id)->delete();

        return redirect()->back()->with('success','Record Deleted Successfully');
    }
}
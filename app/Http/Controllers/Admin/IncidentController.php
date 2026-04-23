<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class IncidentController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        if(Auth::user()->type == 3)
        {
            $incident = $this->commonModel->getDataByOneCondition('fs_incident_report_request', array('district_id' => Auth::user()->district_id));
        }
        elseif(Auth::user()->type == 0 || Auth::user()->type == 1)
        {
            $incident = $this->commonModel->getData('fs_incident_report_request');
        }
        else
        {
            $incident = $this->commonModel->getDataByOneCondition('fs_incident_report_request', array('district_id' => Auth::user()->district_id));
        }
        
        $district = $this->commonModel->getData('districts');
        return view('admin.incident.incident',compact('incident','district'));
    }

    public function addIncident()
    {
        // $district = $this->commonModel->getData('districts');
        if(Auth::user()->type == 1 || Auth::user()->type == 0)
        {
            $district = $this->commonModel->getData('districts');
        }
        else
        {
            $district = $this->commonModel->getDataByOneCondition('districts', array('id' => Auth::user()->district_id));
        }
        $categories = $this->commonModel->getData('categories');
        $unique_no =  Carbon::now()->timestamp;
        return view('admin.incident.add',compact('district','categories','unique_no'));
    }

    public function saveIncident(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'report_type'  => 'required',
            'date'  => 'required',
            'aadhar_no'  => 'required',
            'name'  => 'required',
            'address'  => 'required',
            'district_id'  => 'required',
            'email'  => 'required',
            'mobile_no'  => 'required',
            'contact_person'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'report_type'       =>  $request->input('report_type'),
            'date'              =>  $request->input('date'),
            'aadhar_no'         =>  $request->input('aadhar_no'),
            'name'              =>  $request->input('name'),
            'address'           =>  $request->input('address'),
            'district_id'       =>  $request->input('district_id'),
            'email'             =>  $request->input('email'),
            'mobile_no'         =>  $request->input('mobile_no'),
            'contact_person'    =>  $request->input('contact_person'),
        ];

        $result = $this->commonModel->insertData('fs_incident_report_request', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Incident Report saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Try Later!');
        }
    }

    public function viewIncident($id)
    {
        $incident = $this->commonModel->getDataByOneCondition('fs_incident_report_request', array('id' => $id));
        $assignedTo = $this->commonModel->getDataByOneCondition('users', array('id' => $incident[0]->assigned_id));
        $district = $this->commonModel->getData('districts');
        $users = $this->commonModel->getDataByTwoCondition('users', array('district_id' => Auth::user()->district_id), array('type' => '3'));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('district_id' => Auth::user()->district_id));
        return view('admin.incident.view',compact('incident','district','users','assignedTo','station'));
    }



    public function assignedToIncident(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assigned_id'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id   = $request->input('id');
        $assigned_id = $request->input('assigned_id');
        $userStation = $this->commonModel->getDataByOneCondition('users', array('id' => $assigned_id));
        $where =['id' => $id];
        $data = [
            'assigned_id' => $assigned_id,
            'station_id' => $userStation[0]->station_id,
            'status' => '1',
        ];

        $result = $this->commonModel->updateDataByOneCondition('fs_incident_report_request', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Assigned successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
        
    }

    public function assigneeResponseIncident(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'assignee_response'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id   = $request->input('id');
        $assignee_response = $request->input('assignee_response');
        $assignee_remark = $request->input('assignee_remark');
        $where =['id' => $id];
        $data = [
            'assignee_response' => $assignee_response,
            'assignee_remark' => $assignee_remark
        ];

        $result = $this->commonModel->updateDataByOneCondition('fs_incident_report_request', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Assignee response saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }

    }

    public function rejectIncidentApplication($id)
    {
        $where =['id' => $id];
        $data = [
            'status' => '2'
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_incident_report_request', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Application Rejected Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

}
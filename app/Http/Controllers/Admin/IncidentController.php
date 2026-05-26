<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IncidentController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function index(Request $request)
    {
        $query = DB::table('fs_incident_report_request');

        if (Auth::user()->type == 3)
        {
            $query->where(
                'district_id',
                Auth::user()->district_id
            )->where(
                'station_id',
                Auth::user()->station_id
            );
        }
        elseif (
            Auth::user()->type != 0
            && Auth::user()->type != 1
        )
        {
            $query->where(
                'district_id',
                Auth::user()->district_id
            );
        }

        if ($request->filled('report_type'))
        {
            $query->where(
                'report_type',
                'LIKE',
                '%' . $request->report_type . '%'
            );
        }

        if ($request->filled('name'))
        {
            $query->where(
                'name',
                'LIKE',
                '%' . $request->name . '%'
            );
        }

        if ($request->filled('mobile_no'))
        {
            $query->where(
                'mobile_no',
                'LIKE',
                '%' . $request->mobile_no . '%'
            );
        }

        if ($request->filled('district'))
        {
            $query->where(
                'district_id',
                $request->district
            );
        }

        if ($request->filled('status'))
        {
            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->filled('assignee_response'))
        {
            $query->where(
                'assignee_response',
                $request->assignee_response
            );
        }

        if ($request->filled('from_date'))
        {
            $query->whereDate(
                'date',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date'))
        {
            $query->whereDate(
                'date',
                '<=',
                $request->to_date
            );
        }

        $incident = $query
            ->orderBy('id', 'DESC')
            ->get();

        if (
            Auth::user()->type == 0
            || Auth::user()->type == 1
        ) {
            $district = DB::table('districts')
                ->orderBy('name')
                ->get();
        }
        else
        {
            $district = DB::table('districts')
                ->where('id', Auth::user()->district_id)
                ->orderBy('name')
                ->get();
        }

        return view(
            'admin.incident.incident',
            compact(
                'incident',
                'district'
            )
        );
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
<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class AwarenessController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function index(Request $request)
    {
        $query = DB::table('fs_awareness_program_request');

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

        if ($request->filled('application_id'))
        {
            $query->where(
                'application_id',
                'LIKE',
                '%' . $request->application_id . '%'
            );
        }

        if ($request->filled('district'))
        {
            $query->where(
                'district_id',
                $request->district
            );
        }

        if ($request->filled('station'))
        {
            $query->where(
                'station_id',
                $request->station
            );
        }

        if ($request->filled('program_type'))
        {
            $query->where(
                'program_type',
                'LIKE',
                '%' . $request->program_type . '%'
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
                'program_datetime',
                '>=',
                $request->from_date
            );
        }

        if ($request->filled('to_date'))
        {
            $query->whereDate(
                'program_datetime',
                '<=',
                $request->to_date
            );
        }

        $awareness = $query
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
            'admin.awareness.awareness',
            compact(
                'awareness',
                'district'
            )
        );
    }

    public function addAwareness()
    {
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
        return view('admin.awareness.add',compact('district','categories','unique_no'));
    }

    public function saveAwareness(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'program_type'  => 'required',
            'name'  => 'required',
            'address'  => 'required',
            'district_id'  => 'required',
            'email'  => 'required',
            'mobile_no'  => 'required',
            'contact_person'  => 'required',
            'program_datetime'  => 'required',
            'crowd_size'  => 'required',
            'google_address'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $appliaction_id = rand(1234567890, 9999999999);
        //$otp = rand(100000, 999999);
        $otp = "123456";
        $data = [
            'application_id'    =>  $appliaction_id,
            'program_type'      =>  $request->input('program_type'),
            'name'              =>  $request->input('name'),
            'address'           =>  $request->input('address'),
            'district_id'       =>  $request->input('district_id'),
            'email'             =>  $request->input('email'),
            'mobile_no'         =>  $request->input('mobile_no'),
            'contact_person'    =>  $request->input('contact_person'),
            'program_datetime'  =>  $request->input('program_datetime'),
            'crowd_size'        =>  $request->input('crowd_size'),
            'google_address'    =>  $request->input('google_address'),
            'latitude'          =>  $request->input('latitude'),
            'longitude'         =>  $request->input('longitude'),
            'user_id'           =>  Auth::user()->id,
            'otp'               =>  $otp??123456,
            'is_verify'         =>  1
        ];

        $result = $this->commonModel->insertData('fs_awareness_program_request', $data);
        if ($result)
        {
            $resp = [
                'code' => 1,
                'status' => 'success',
                'message' => 'Awareness saved successfully. Your application id is : "  '.$appliaction_id.'"'
            ];
            return json_encode($resp);
        }
        else{
            $resp = [
                'code' => 0,
                'status' => 'failed',
                'message' => 'Something went wrong. Please try again.'
            ];
            return json_encode($resp);
        }
    }


    public function awarenessOtpPost(Request $request)
    {
         try{
            $validator = Validator::make($request->all(), [
                'otpValue'         => 'required|integer',
                'otpMobile'        => 'required|integer'
            ]);

            if ($validator->fails()) 
            {
                $resp = [
                    'code' => 2,
                    'status' => 'Failed',
                    'errors' => $validator->errors(),
                ];

                return json_encode($resp);
            } 

            $tbl = 'fs_awareness_program_request';
            $where = ['mobile_no' => $request->input('otpMobile')];

            $otp = $request->input('otpValue');

            $getData = $this->commonModel->getDataByOneCondition($tbl,$where);

            if($otp!=$getData[0]->otp)
            {
                $resp = [
                    'code' => 0,
                    'status' => 'Failed',
                    'message' => 'Invalid OTP | OTP Not Matched',
                ];
                return json_encode($resp);
                die;
            }


            $dataArray = [
                'is_verify' => 1
            ];

            $result = $this->commonModel->updateDataByOneCondition($tbl,$where,$dataArray);

            if ($result) 
            {
                $where = ['mobile_no' => $request->input('otpMobile')];
                $getData = $this->commonModel->getDataByOneCondition($tbl,$where);

                $resp = [
                    'code' => 1,
                    'status' => 'Success',
                    'message' => 'Application has been saved successfully.| Your application id is : "  '.$getData[0]->application_id??'',
                ];

                return json_encode($resp);
            } 
            else 
            {
                $resp = [
                    'code' => 0,
                    'status' => 'Success',
                    'message' => 'Something went wrong, please try again.',
                ];

                return json_encode($resp);
            }
            
            

        }
        catch(\Exception $e)
        {
            $resp = [
                    'code' => 0,
                    'status' => 'Success',
                    'message' => 'Unexpected error: ' . $e->getMessage(),
                ];

            return json_encode($resp);
        }
    }

    

    public function viewAwareness($id)
    {
        $awareness = $this->commonModel->getDataByOneCondition('fs_awareness_program_request', array('id' => $id));
        $assignedTo = $this->commonModel->getDataByOneCondition('users', array('id' => $awareness[0]->assigned_id));
        $district = $this->commonModel->getData('districts');
        $users = $this->commonModel->getDataByTwoCondition('users', array('district_id' => Auth::user()->district_id), array('type' => '3'));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('district_id' => Auth::user()->district_id));
        return view('admin.awareness.view',compact('awareness','district','users','assignedTo','station'));
    }



    public function assignedToAwareness(Request $request)
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
            'application_status' => '1'
        ];

        $result = $this->commonModel->updateDataByOneCondition('fs_awareness_program_request', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Assigned successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
        
    }

    public function assigneeResponseAwareness(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'assignee_response' => 'required',
            'assignee_remark'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = $request->input('id');
        $assignee_response = $request->input('assignee_response');
        $assignee_remark = $request->input('assignee_remark');
        $assignee_reschedule_date = $request->input('assignee_reschedule_date');
        $where = ['id' => $id];

        $data = [
            'assignee_response' => $assignee_response,
            'assignee_remark' => $assignee_remark,
            'reschedule_date' => $assignee_reschedule_date ?? null,
            'application_status' => '2',
            'approved_by' => Auth::user()->id
        ];

        $result = $this->commonModel->updateDataByOneCondition('fs_awareness_program_request', $where, $data);

        if ($result) 
        {
            return redirect()->back()->with('success', 'Assignee response saved successfully');
        } 
        else {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function rejectAwarenessApplication($id)
    {
        $where =['id' => $id];
        $data = [
            'status' => '2'
        ];
        $result = $this->commonModel->updateDataByOneCondition('fs_awareness_program_request', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Application Rejected Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function closeAwareness(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'      => 'required|string',
            'description'      => 'required|string',
            'attachment'  => 'required|file|mimes:pdf,jpg,jpeg,png,gif,webp|max:2048',
            'attachment2' => 'required|file|mimes:pdf,jpg,jpeg,png,gif,webp|max:2048',
            'attachment3' => 'nullable|file|mimes:pdf,jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        $id = $request->input('apid');
        $userType = $request->input('userType');
        $description = $request->input('description');
        $title = $request->input('title');
        $where = ['id' => $id];

        $file1Path = '';
        $file2Path = '';
        $file3Path = '';
        

        if ($request->hasFile('attachment')) {
            $file1 = $request->file('attachment');
            $imageName = time() . '_1.' . $file1->getClientOriginalExtension();
            $file1->move(public_path('admin/awareness'), $imageName);
            $file1Path = 'public/admin/awareness/' . $imageName;
        }

        if ($request->hasFile('attachment2')) {
            $file2 = $request->file('attachment2');
            $imageName2 = time() . '_2.' . $file2->getClientOriginalExtension();
            $file2->move(public_path('admin/awareness'), $imageName2);
            $file2Path = 'public/admin/awareness/' . $imageName2;
        }

        if ($request->hasFile('attachment3')) {
            $file3 = $request->file('attachment3');
            $imageName3 = time() . '_3.' . $file3->getClientOriginalExtension();
            $file3->move(public_path('admin/awareness'), $imageName3);
            $file3Path = 'public/admin/awareness/' . $imageName3;
        }

        $attachments = null;
        if ($file1Path || $file2Path || $file3Path) 
        {
            $attachments = json_encode([
                'attachment'  => $file1Path ?: null,
                'attachment2' => $file2Path ?: null,
                'attachment3' => $file3Path ?: null,
            ]);
        }

        $data = [
            'event_title' => $title,
            'event_description' => $description,
            'assignee_attachments' => $attachments,
            'application_status' => '2',
            'approved_by' => Auth::user()->id
        ];


        $result = $this->commonModel->updateDataByOneCondition('fs_awareness_program_request', $where, $data);

        if ($result) 
        {
            return redirect()->back()->with('success', 'Data saved successfully');
        } 
        else {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }

    }

    public function awarenessEventProgram($id)
    {
        $getData = $this->commonModel->getAwarenessProgrameDetails($id);
        return view('admin.awareness.eventprogram',compact('getData'));
    }


    public function awarenessEventProgramData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'application_no' => 'required|string',
            'program_type' => 'required|string',
            'program_date' => 'required|date_format:d-m-Y H:i:s',
            'applicant_name' => 'required|string',
            'program_venue_address' => 'required|string',
            'district' => 'required|string',
            'fire_station' => 'required|string',
            'participating_person' => 'required|string',
            'participating_public' => 'required|string',
            'vehicles' => 'required|string',
            'program_details' => 'required|string',
            'program_photo_1' => 'required|image|mimes:jpeg,png,jpg,gif,', // 2MB max
            'program_photo_2' => 'required|image|mimes:jpeg,png,jpg,gif', // 2MB max
            'program_photo_3' => 'nullable|mimes:pdf', // Optional, PDF only, 2MB max
            'program_feedback_report' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $program_feedback_report = $request->input('program_feedback_report');
        $program_details = $request->input('program_details');
        $vehicles = $request->input('vehicles');
        $participating_person = $request->input('participating_person');
        $id = $request->input('apid');



        $file1Path = '';
        $file2Path = '';
        $file3Path = '';
        

        if ($request->hasFile('program_photo_1')) {
            $file1 = $request->file('program_photo_1');
            $imageName = time() . '_1.' . $file1->getClientOriginalExtension();
            $file1->move(public_path('admin/awareness'), $imageName);
            $file1Path = 'public/admin/awareness/' . $imageName;
        }

        if ($request->hasFile('program_photo_2')) {
            $file2 = $request->file('program_photo_2');
            $imageName2 = time() . '_2.' . $file2->getClientOriginalExtension();
            $file2->move(public_path('admin/awareness'), $imageName2);
            $file2Path = 'public/admin/awareness/' . $imageName2;
        }

        if ($request->hasFile('program_photo_3')) {
            $file3 = $request->file('program_photo_3');
            $imageName3 = time() . '_3.' . $file3->getClientOriginalExtension();
            $file3->move(public_path('admin/awareness'), $imageName3);
            $file3Path = 'public/admin/awareness/' . $imageName3;
        }

        $attachments = null;
        if ($file1Path || $file2Path || $file3Path) 
        {
            $attachments = json_encode([
                'attachment'  => $file1Path ?: null,
                'attachment2' => $file2Path ?: null,
                'attachment3' => $file3Path ?: null,
            ]);
        }

        $where = ['id' => $id];

        $data = [
            'participating_person' => $participating_person,
            'vehicles' => $vehicles,
            'program_details' => $program_details,
            'program_feedback_report' => $program_feedback_report, 
            'application_status' => '2',
            'event_program_status' => '0',
            'assignee_attachments' => $attachments
        ];


        $result = $this->commonModel->updateDataByOneCondition('fs_awareness_program_request', $where, $data);

        if ($result) 
        {
            return redirect('admin/awareness/view/' . $id)      
                ->with('success', 'Awareness Program Details saved successfully');

        } 
        else {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }

    }


    public function eventProgramAcceptRejectByCfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'final_remark'  => 'required|string',
            'accept'        => 'required|string',
            'apid'          => 'required|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $remark = $request->input('final_remark');
        $accept = $request->input('accept');
        $id     = $request->input('apid');

        $where = ['id' => $id];

        $data = [
            'final_remark' => $remark,
            'approved_by'  => Auth::user()->id
        ];
        if ($accept == '1') 
        {
            $data['status'] = '4';
            $data['application_status'] = '2';
            $data['event_program_status'] = '1';
        }
        elseif ($accept == '2') 
        {
            $data['status'] = '2';
            $data['application_status'] = '3';
            $data['event_program_status'] = '2';
        }

        $result = $this->commonModel->updateDataByOneCondition('fs_awareness_program_request', $where, $data);

        if ($result) 
        {
            return redirect()->back()->with('success', 'Awareness Event Program Details saved successfully');
        } 
        else 
            {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }

    }


    public function awarenessDownload(Request $request)
    {
        $tbl = 'fs_awareness_program_request';
        $where = ['id' => $request->id];
        $getData = $this->commonModel->getAwarenessProgrameDetails($where);

        $assigned_id = $getData->assigned_id??'NA';
        $getAssigneeName = $this->commonModel->getDataByOneCondition('users', ['id' => $assigned_id]);

        return view('admin.awareness.report-download-pdf', compact('getData', 'getAssigneeName'));
    }

}
<?php

namespace App\Http\Controllers\Citizen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;
use Carbon\Carbon;

class ActivitiesController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function standby()
    {
        $standby = $this->commonModel->getDataByOneCondition('fs_standby_duty_request', array('user_id' => Auth::user()->id));
        $district = $this->commonModel->getData('districts');
        return view('citizen.activities.standby.standby', compact('standby','district'));
    }

    public function addStandby()
    {
        $district = $this->commonModel->getData('districts');
        return view('citizen.activities.standby.add', compact('district'));
    }
    public function saveStandby(Request $request)
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
            'crowd_size'  => 'required'
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
            'user_id'           =>  Auth::user()->id,
            'otp'               => $otp??123456
        ];

        $result = $this->commonModel->insertData('fs_standby_duty_request', $data);
        if ($result)
        {
            $resp = [
                'code' => 1,
                'status' => 'success',
                'message' => 'Application saved successfully | One Time Password Sent to Registered Mobile Number.'
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


    public function standByOtpPost(Request $request)
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

            $tbl = 'fs_standby_duty_request';
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

    public function resendOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'PhoneNo' => 'required|digits:10',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'code' => 0,
                    'status' => 'Failed',
                    'errors' => $validator->errors(),
                ]);
            }

            $mobile = $request->input('PhoneNo');
            $tbl = 'fs_standby_duty_request';
            $where = ['mobile_no' => $mobile];

            $getData = $this->commonModel->getDataByOneCondition($tbl, $where);

            if (empty($getData)) {
                return response()->json([
                    'code' => 0,
                    'status' => 'Failed',
                    'message' => 'Mobile number not found in standby request.',
                ]);
            }

            $otp = '123456'; 
            $update = $this->commonModel->updateDataByOneCondition($tbl, $where, [
                'otp' => $otp
            ]);

            if ($update) {
                return response()->json([
                    'code' => 1,
                    'status' => 'Success',
                    'message' => 'OTP resent successfully.',
                    'otp' => $otp 
                ]);
            } else {
                return response()->json([
                    'code' => 0,
                    'status' => 'Failed',
                    'message' => 'Failed to update OTP. Please try again.'
                ]);
            }

        } catch (\Exception $e) {
            return response()->json([
                'code' => 0,
                'status' => 'Failed',
                'message' => 'Unexpected error: ' . $e->getMessage(),
            ]);
        }
    }

    public function viewStandby($id){
        $standby = $this->commonModel->getDataByOneCondition('fs_standby_duty_request', array('id' => $id));
        $district = $this->commonModel->getData('districts');
        return view('citizen.activities.standby.view', compact('standby','district'));
    }



    public function awareness(){
        $awareness = $this->commonModel->getDataByOneCondition('fs_awareness_program_request', array('user_id' => Auth::user()->id));
        $district = $this->commonModel->getData('districts');
        return view('citizen.activities.awareness.awareness', compact('awareness','district'));
    }
    public function addAwareness()
    {
        $district = $this->commonModel->getData('districts');
        $unique_no =  Carbon::now()->timestamp;
        return view('citizen.activities.awareness.add', compact('district','unique_no'));
    }
    public function saveAwareness(Request $request){
        // echo "hell"; die;
        $validator = Validator::make($request->all(), [
            'program_type'      => 'required',
            'name'              => 'required',
            'address'           => 'required',
            'district_id'       => 'required',
            'email'             => 'required',
            'mobile_no'         => 'required',
            'contact_person'    => 'required',
            'program_datetime'  => 'required',
            'crowd_size'        => 'required',
            'google_address'    => 'required',
            'latitude'          => 'required',
            'longitude'         => 'required'
        ]);

        if ($validator->fails()) {
            // echo "error"; die;
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
            'otp'               => $otp??123456
        ];

        
        $result = $this->commonModel->insertData('fs_awareness_program_request', $data);
        if ($result)
        {
            $resp = [
                'code' => 1,
                'status' => 'success',
                'message' => 'Awareness saved successfully | One Time Password Sent to Registered Mobile Number.'
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

    public function viewAwareness($id){
        $awareness = $this->commonModel->getDataByOneCondition('fs_awareness_program_request', array('id' => $id));
        $assignedTo = $this->commonModel->getDataByOneCondition('users', array('id' => $awareness[0]->assigned_id));
        $district = $this->commonModel->getData('districts');
        $users = $this->commonModel->getDataByTwoCondition('users', array('district_id' => Auth::user()->district_id), array('type' => '3'));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('district_id' => Auth::user()->district_id));
        return view('citizen.activities.awareness.view',compact('awareness','district','users','assignedTo','station'));
    }

    public function incident(){
        $incident = $this->commonModel->getDataByOneCondition('fs_incident_report_request', array('user_id' => Auth::user()->id));
        $district = $this->commonModel->getData('districts');
        return view('citizen.activities.incident.incident', compact('incident','district'));
    }

    public function addIncident(){
        $district = $this->commonModel->getData('districts');
        $categories = $this->commonModel->getData('categories');
        $unique_no =  Carbon::now()->timestamp;
        return view('citizen.activities.incident.add',compact('district','categories','unique_no'));
    }

    public function saveIncident(Request $request){
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
            'user_id'           =>  Auth::user()->id,
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
        return view('citizen.activities.incident.view',compact('incident','district','users','assignedTo','station'));
    }
}
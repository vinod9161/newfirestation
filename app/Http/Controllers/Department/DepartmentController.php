<?php

namespace App\Http\Controllers\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Models\Application;
use App\Models\Models\OperationalApplication;
use App\Models\Models\RenewalApplication;
use Validator;
use Auth;
use \stdClass;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Common\CommonModel;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        return view('department.home');
    }
    public function addPhysicalInsPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all(); 
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        unset($data['_token']);
        unset($data['application_no']);
        unset($data['inspection_step']);
        $updata = [
            'physical_ins' => json_encode($data)
        ];
        $result = $this->commonModel->updateDataByOneCondition('applications', ['application_no' => $request->application_no], $updata);
        if ($result == 1)
        {
            return ['status' => '1', 'msg' => 'Data submitted successfully.'];
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not saved. Please try again.'];
        }  
    }
    public function addFireProvissionPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all(); 
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        unset($data['_token']);
        unset($data['application_no']);
        unset($data['inspection_step']);
        $updata = [
            'fire_provission' => json_encode($data)
        ];
        $result = $this->commonModel->updateDataByOneCondition('applications', ['application_no' => $request->application_no], $updata);
        if ($result == 1)
        {
            return ['status' => '1', 'msg' => 'Data submitted successfully.'];
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not saved. Please try again.'];
        }         
    }
    public function addBuildingStatusPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all(); 
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        unset($data['_token']);
        unset($data['application_no']);
        unset($data['inspection_step']);
        $updata = [
            'building_status' => json_encode($data)
        ];
        $result = $this->commonModel->updateDataByOneCondition('applications', ['application_no' => $request->application_no], $updata);
        if ($result == 1)
        {
            return ['status' => '1', 'msg' => 'Data submitted successfully.'];
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not saved. Please try again.'];
        }          
    }
    public function addSpecialProvissionPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all(); 
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        unset($data['_token']);
        unset($data['application_no']);
        unset($data['inspection_step']);
        $updata = [
            'special_provission' => json_encode($data)
        ];
        $result = $this->commonModel->updateDataByOneCondition('applications', ['application_no' => $request->application_no], $updata);
        if ($result == 1)
        {
            return ['status' => '1', 'msg' => 'Data submitted successfully.'];
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not saved. Please try again.'];
        }       
    }
    public function applicationRejectPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        $application->status = 'rejected';
        $application->update(); 
        if($application->status == 'rejected')
        {
            return back()->with('application',$application)->with("message","Application Rejected Successfully!");
            // try
            // {
            //     $user = User::where('id', $application->user_id)->first();
            //     $client = new Client([
            //         'auth' => ['homedepartment', 'homedepartment@BdwDZ9a2s5IWHuFl40xSnBE7cHmwDlEg']
            //     ]);
            //     $params['form_params'] = array('thirdPartyApplicationId' => $application->id, 'serviceId' => json_decode($user->apuni_sarkar_response)->service->id, 'userId' => json_decode($user->apuni_sarkar_response)->user->_id, 'status' => 'Rejected');
            //     $res = $client->post('https://eservices.uk.gov.in/api/home-department-integration/application/update',$params);
            //     if($res->getStatusCode() == 200 || $res->getStatusCode() == 201)
            //     {
            //         return back()->with('application',$application)->with("message","Application Rejected Successfully!");        
            //     }
            //     else if($res->getStatusCode() == 400)
            //     {
            //         return back()->with('error','Something went wromg, Please try again!');
            //     }
            // }
            // catch(\Exception $e)
            // {
            //     return back()->with('error','Something went wromg, Please try again!');
            // }
        }
        else
        {
            return back()->with('error','Something went wromg, Please try again!');
        }
    }
    public function applicationPreApprovalPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        $application->status = 'pre approval';
        $historys = new stdClass();
        $historys->history = 'Application has been sent for Pre appoval';
        $historys->date = date('m/d/Y h:i:s a', time());
        if(empty($application->history))
        {
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($application->history);
            $history[] = $historys;
        }
        $application->history = json_encode($history);
        $application->update(); 
        return back()->with('application',$application)->with("message","Application has been sent for Pre appoval");        
    }
    public function applicationPreApprovedPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        $remark = array();
        $remarks = new stdClass();
        $remarks->remark = $request->remark_by_dd;
        $remarks->date = date('m/d/Y h:i:s a', time());
        $input_data = $request->all();
        $validator_file = Validator::make(
        $input_data, [
        'attachment' => 'mimes:pdf|max:20000'
            ],[
                'attachment.required' => 'Please upload pdf',
                'attachment.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails())
        {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }
        if ($request->hasFile('attachment'))
        {
            $imageName = time().'.'.'rl_1'.$request->attachment->extension(); 
            $request->attachment->move('uploads', $imageName);
            $remarks->attachment ='uploads/'.$imageName;
        }
        if(blank($application->remark_by_dd))
        { 
            $remark[] = $remarks;
        }
        else
        {
            $remark = json_decode($application->remark_by_dd);
            $remark[] = $remarks;
        }
        $application->remark_by_dd = json_encode($remark);
        $application->status = 'pre approved';
        $historys = new stdClass();
        $historys->history = 'Application has been pre approved';
        $historys->date = date('m/d/Y h:i:s a', time());
        if(empty($application->history))
        {
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($application->history);
            $history[] = $historys;
        }
        $application->history = json_encode($history);
        $application->dd_signature = Auth::user()->signature;
        $application->dd_designation = 'Deputy Director';
        $application->dd_approve_date = Carbon::now();
        $application->dd_name = Auth::user()->name;
        $application->update();
        return back()->with('application',$application)->with("message","Application has been pre approved");        
    }
    public function applicationAssignedToCFO(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        if($request->application_type =='established') {
            $application = Application::where('application_no',$request->application_no)->first();
        } else if($request->application_type =='operational') {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        } else if($request->application_type =='renewal') {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        
        $application->assigned_cfo = $request->cfo_list;

        $user_name = $this->commonModel->getDataByOneCondition('users', ['id' => $request->cfo_list]);
        $history = array();
        $historys = new stdClass();
        $historys->history = 'Application has been submitted to concerned CFO '.ucfirst($user_name[0]->name);
        $historys->date = date('m/d/Y h:i:s a', time());
               
        if(blank($application->history)){
            $history[] = $historys;
        }else{
            $history = json_decode($application->history);
            $history[] = $historys;
        }

        $application->history = json_encode($history);
      
        $application->update(); 

        return back()->with('application',$application)->with("message","Application has been submitted to concerned CFO ".ucfirst($user_name[0]->name));        
    }
    public function applicationApprovePost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->application_type =='established')
        {
            $tbl = 'applications';
            $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        }
        else if($request->application_type =='operational')
        {
            $tbl = 'operational_applications';
            $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        }
        else if($request->application_type =='renewal')
        {
            $tbl = 'renewal_applications';
            $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        }

        // $application->validity = $request->validity;
        // $application->status = 'approved';
        $baseUrl = config('app.url');
        $url = $baseUrl."download-noc/".$application[0]->id;
        // $qrCode = $this->generateQrCode($url);

        $historys = array();
        $historys['history'] = 'Application has been Approved Successfully';
        $historys['date'] = date('m/d/Y h:i:s a', time());
               
        if(!empty($application[0]->history))
        {
            $history = json_decode($application[0]->history);
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($application[0]->history);
            $history[] = $historys;
        }

        // $application->history = json_encode($history);
        // $application->application_qr_code = $qrCode ?? '';
        // $application->cfo_signature = Auth::user()->signature;
        // $application->cfo_designation = 'Chief Fire Officer';
        // $application->cfo_approve_date = Carbon::now();
        // $application->cfo_name = Auth::user()->name;
        // $application->update(); 

        $status = 'approved';
        $data = [
            'status' => $status,
            'validity' => $request->validity,
            'application_qr_code' => $qrCode ?? '',
            'cfo_signature' => Auth::user()->signature,
            'cfo_designation' => 'Chief Fire Officer',
            'cfo_approve_date' => Carbon::now(),
            'cfo_name' => Auth::user()->name,
            'history' => json_encode($history)
        ];
        $result = $this->commonModel->updateDataByOneCondition($tbl, array('application_no' => $application[0]->application_no), $data);
        if($result)
        {
            return back()->with('application',$application)->with("message","Application has been Approved Successfully!");
        }
        else
        {
            return back()->with('error','Something went wromg, Please try again!');
        }
    }
    public function revertNocPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->application_type =='established')
        {
            $application = Application::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='operational')
        {
            $application = OperationalApplication::where('application_no',$request->application_no)->first();
        }
        else if($request->application_type =='renewal')
        {
            $application = RenewalApplication::where('application_no',$request->application_no)->first();
        }
        $application->status = 'reverted';
        $revert = array();
        $reverts = new stdClass();
        $reverts->revert = $request->remark;
        $reverts->date = date('m/d/Y h:i:s a', time());
        $reason = new stdClass();
        $reason->reason1 = $request->reason1;
        $reason->reason2 = $request->reason2;
        $reason->reason3 = $request->reason3;
        $reason->reason4 = $request->reason4;
        $reason->reason5 = $request->reason5;
        $reason->reason6 = $request->reason6;
        $reason->reason7 = $request->reason7;
        $reason->reason8 = $request->reason8;
        $reason->reason9 = $request->reason9;
        $reverts->reason = json_encode($reason);
        $validator_file = Validator::make(
        $data, [
        'attachment' => 'mimes:pdf|max:20000'
            ],[
                'attachment.required' => 'Please upload pdf',
                'attachment.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails())
        {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }
        if ($request->hasFile('attachment'))
        {
            $imageName = time().'.'.'rl_1'.$request->attachment->extension(); 
            $request->attachment->move('uploads', $imageName);
            $reverts->attachment ='uploads/'.$imageName;
        }
        if(Auth::user()->type == 1)
        {
            $reverts->revert_from = 'Revert by Deputy Director';
        }
        else if(Auth::user()->type == 2)
        {
            $reverts->revert_from = 'Revert by CFO';
        }
        else if(Auth::user()->type == 3)
        {
            $reverts->revert_from = 'Revert by FSO';
        }
        if(blank($application->revert))
        {  
          $revert[] = $reverts;
        }
        else
        {
            $revert = json_decode($application->revert);
            $revert[] = $reverts;
        }
        $application->revert = json_encode($revert);
        $history = array();
        $historys = new stdClass();
        $historys->history = 'Application has been Reverted Please review Remark and update application again';
        $historys->date = date('m/d/Y h:i:s a', time());
        if(empty($application->history))
        {
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($application->history);
            $history[] = $historys;
        }
        $application->history = json_encode($history);
        $application->old_application_no = $request->application_no;
        $application->update(); 
        if($application->status == 'reverted')
        {
            return back()->with('application',$application)->with("message","Application Reverted Back to Citizen!"); 
            // try
            // {
            //     $user = User::where('id', $application->user_id)->first();
            //     $client = new Client([
            //         'auth' => ['homedepartment', 'homedepartment@BdwDZ9a2s5IWHuFl40xSnBE7cHmwDlEg']
            //     ]);
            //     // $params['headers'] = ['Content-Type' => 'application/json', 'Authorization' => 'Zoho-authtoken ' . $AuthCode];
            //     $params['form_params'] = array('thirdPartyApplicationId' => $application->id, 'serviceId' => json_decode($user->apuni_sarkar_response)->service->id, 'userId' => json_decode($user->apuni_sarkar_response)->user->_id, 'status' => 'Rejected');
            //     $res = $client->post('https://eservices.uk.gov.in/api/home-department-integration/application/update',$params);
            //     if($res->getStatusCode() == 200 || $res->getStatusCode() == 201)
            //     {
            //         return back()->with('application',$application)->with("message","Application Reverted Back to Citizen!"); 
            //     }
            //     else if($res->getStatusCode() == 400)
            //     {
            //         return back()->with('error','Something went wromg, Please try again!');
            //     }
            // }
            // catch(\Exception $e)
            // {
            //     return back()->with('error','Something went wromg, Please try again!');
            // }
        }
        else
        {
            return back()->with('error','Something went wromg, Please try again!');
        }
    }
    public function remarkByCFOPost(Request $request)
    {
        $user = Auth::user();

        if ($request->application_type == 'established') {
            $application = Application::where('application_no', $request->application_no)->first();
        } elseif ($request->application_type == 'operational') {
            $application = OperationalApplication::where('application_no', $request->application_no)->first();
        } elseif ($request->application_type == 'renewal') {
            $application = RenewalApplication::where('application_no', $request->application_no)->first();
        }

        if (!$application) {
            return back()->with('error', 'Application not found');
        }

        // Validate attachment
        $validator_file = Validator::make(
            $request->all(),
            ['attachment' => 'nullable|mimes:pdf|max:20000'],
            [
                'attachment.mimes' => 'Only pdf file are allowed',
            ]
        );

        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        $remarks = new \stdClass();
        $remarks->remark = $request->remark_by_cfo;
        $remarks->date   = date('m/d/Y h:i:s a', time());

        // ✅ SAME FILE NAME LOGIC AS OLD
        if ($request->hasFile('attachment')) {
            $imageName = time().'.'.'rl_1'.$request->attachment->extension();
            $request->attachment->move('uploads', $imageName);
            $remarks->attachment = 'uploads/'.$imageName;
        }

        $conditions = $request->input('conditions', []);
        $conditions = array_values(array_filter(array_map('trim', $conditions)));

        $remarks->reason = json_encode($conditions);

        $existingRemarks = [];
        if (!empty($application->remark_by_cfo)) {
            $existingRemarks = json_decode($application->remark_by_cfo, true);
        }

        $existingRemarks[] = $remarks;
        $application->remark_by_cfo = json_encode($existingRemarks);
        $application->save();

        return back()->with('application', $application)
                    ->with('message', 'Remark Added BY CFO Successfully!');
    }


    public function remarkByFSOPost(Request $request)
    {
        $user = Auth::user();

        // -----------------------------
        // Fetch application
        // -----------------------------
        if ($request->application_type == 'established') {
            $application = Application::where('application_no', $request->application_no)->first();
        } elseif ($request->application_type == 'operational') {
            $application = OperationalApplication::where('application_no', $request->application_no)->first();
        } elseif ($request->application_type == 'renewal') {
            $application = RenewalApplication::where('application_no', $request->application_no)->first();
        }

        if (!$application) {
            return back()->with('error', 'Application not found');
        }

        // -----------------------------
        // Attachment validation
        // -----------------------------
        $validator_file = Validator::make(
            $request->all(),
            ['attachment' => 'nullable|mimes:pdf|max:20000'],
            ['attachment.mimes' => 'Only pdf file are allowed']
        );

        if ($validator_file->fails()) {
            return redirect()->back()
                ->with('error', 'Only pdf file are allowed!')
                ->withInput();
        }

        // -----------------------------
        // Build remark object
        // -----------------------------
        $remarks = new \stdClass();
        $remarks->remark = $request->remark_by_fso;
        $remarks->date   = date('m/d/Y h:i:s a', time());

        // ✅ SAME FILE NAME LOGIC AS OLD
        if ($request->hasFile('attachment')) {
            $imageName = time().'.'.'rl_1'.$request->attachment->extension();
            $request->attachment->move('uploads', $imageName);
            $remarks->attachment = 'uploads/'.$imageName;
        }

        // -----------------------------
        // ✅ NEW CONDITIONS LOGIC
        // -----------------------------
        $conditions = $request->input('conditions', []);
        $conditions = array_values(array_filter(array_map('trim', $conditions)));

        $remarks->reason = json_encode($conditions);

        // -----------------------------
        // Save FSO remarks
        // -----------------------------
        $existingRemarks = [];

        if (!empty($application->remark_by_fso)) {
            $existingRemarks = json_decode($application->remark_by_fso, true);
        }

        $existingRemarks[] = $remarks;
        $application->remark_by_fso = json_encode($existingRemarks);
        $application->save();

        return back()
            ->with('application', $application)
            ->with('message', 'Remark Added BY FSO Successfully!');
    }

    public function applicationForApprovalPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->application_type =='established')
        {
            $tbl = 'applications';
            $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        }
        else if($request->application_type =='operational')
        {
            $tbl = 'applications';
            $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        }
        else if($request->application_type =='renewal')
        {
            $tbl = 'applications';
            $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        }
        $historys = array();
        $historys['history'] = 'Application has been sent for appoval';
        $historys['date'] = date('m/d/Y h:i:s a', time());
               
        if(!empty($application[0]->history))
        {
            $history = json_decode($application[0]->history);
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($application[0]->history);
            $history[] = $historys;
        }
        
        $data = [
            'status' => 'for approval',
            'fso_signature' => Auth::user()->signature,
            'fso_designation' => 'Fire Station Officer',
            'fso_approve_date' => Carbon::now(),
            'fso_name' => Auth::user()->name,
            'history' => json_encode($history)
        ];
        $this->commonModel->updateDataByOneCondition($tbl, array('application_no' => $application[0]->application_no), $data);

        return back()->with('application',$application)->with("message","Application has been sent for appoval!");        
    }
    public function get_user_name_by_district($district_id)
    {
        if($district_id!='')
        {
            $user  = User::where('district_id', '=', $district_id)->where('type', '=', '2')->first();
            $user_name = $user->name;
            return $user_name;
        }
        else
        {
            return "";
        }
    }
    
    public function generateQrCode($data)
    {
        $publicQrPath = public_path('qrcodes');
        if (!File::exists($publicQrPath)) {
            File::makeDirectory($publicQrPath, 0755, true);
        }
        $filename = 'qrcode_'.time().'.png';
        $path = 'qrcodes/'.$filename;
        QrCode::format('png')
            ->size(200)
            ->generate($data, public_path($path));
        return $filename;
    }
}



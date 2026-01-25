<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Models\{Standby,AwarenessProgram,District,Category,Station,Employee,FireReport,Rescue,Relief,Vehicle,Organisational,RecentUpdates,SpecialRiskArea,SafetyOfficer,UserGoCircular,IncidentReport};
use App\Models\ContactModel;
use App\Models\Common\CommonModel;
use Carbon\Carbon;
use Redirect;
use Auth;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Models\Activities\FireServiceWeekModel;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;


class MainController extends Controller{
     protected $commonModel;
     public function __construct(){
         $this->commonModel = new CommonModel;
     }

    public function index(){
       return view('welcome');
    }

    public function account(){
        $user = Auth::user();
        if($user->type=='0'){
            return redirect()->route('admin.home');
        }else if($user->type=='1' || $user->type=='2' || $user->type=='3'){
            return redirect()->route('admin.home');
        }else if($user->type=='4'){
            return redirect()->route('citizen.account');
        }
    }

    public function actionIndex(){
        $fireStationCount = Station::count();
        $count['fireStationCount'] = $fireStationCount;

        $fireReportCount = FireReport::count();
        $count['fireReportCount'] = $fireReportCount;

        $emergencyCallCount = FireReport::count() + Rescue::count() + Relief::count();
        $count['emergencyCallCount'] = $emergencyCallCount;

        $employeeCount = Employee::count();
        $count['employeeCount'] = $employeeCount;

        $vehicleCount = Vehicle::count();
        $count['vehicleCount'] = $vehicleCount;

        $lifeSaveCount = FireReport::sum('life_saved_human') + Rescue::sum('life_saved_human');
        $count['lifeSaveCount'] = $lifeSaveCount;


        $recentupdates  = RecentUpdates::where('status', '=', '1')->orderBy('id', 'asc')->get();

        $tbl = 'pages_card';
        $where = ['page_name' => 'home_banner_slider'];

        $getBanner = $this->commonModel->getDataByOneCondition($tbl,$where);
        $recentfireincidents = $this->commonModel->getDataByOneCondition('recentfireincidents',array('status' => '1'));

        return view('fire.index')->with('count',$count)->with('recentupdates',$recentupdates)->with('getbanner',$getBanner)->with('recentfireincidents',$recentfireincidents);
    }

    public function actionSarkar(){
        $fireStationCount = Station::count();
        $count['fireStationCount'] = $fireStationCount;

        $fireReportCount = FireReport::count();
        $count['fireReportCount'] = $fireReportCount;

        $emergencyCallCount = FireReport::count() + Rescue::count() + Relief::count();
        $count['emergencyCallCount'] = $emergencyCallCount;

        $employeeCount = Employee::count();
        $count['employeeCount'] = $employeeCount;

        $vehicleCount = Vehicle::count();
        $count['vehicleCount'] = $vehicleCount;

        $lifeSaveCount = FireReport::sum('life_saved_human') + Rescue::sum('life_saved_human');
        $count['lifeSaveCount'] = $lifeSaveCount;

        return view('fire.home_ap')->with('count',$count);
    }

    public function actionWindow(){
        $fireStationCount = Station::count();
        $count['fireStationCount'] = $fireStationCount;

        $fireReportCount = FireReport::count();
        $count['fireReportCount'] = $fireReportCount;

        $emergencyCallCount = FireReport::count() + Rescue::count() + Relief::count();
        $count['emergencyCallCount'] = $emergencyCallCount;

        $employeeCount = Employee::count();
        $count['employeeCount'] = $employeeCount;

        $vehicleCount = Vehicle::count();
        $count['vehicleCount'] = $vehicleCount;

        $lifeSaveCount = FireReport::sum('life_saved_human') + Rescue::sum('life_saved_human');
        $count['lifeSaveCount'] = $lifeSaveCount;

        return view('fire.home_sw')->with('count',$count);
    }

    //////////////////////////////

    public function actionAchivements(){
        return view('fire.achivements');
    }

    ////////////////////////////////////

    public function actionAchivementsPrevious(){
        return view('fire.achivements_in_previous_year');
    }

    /////////////////////////////////////////

    public function actionAwarenessProgramme(){
        $getData = $this->commonModel->getAwarenessProgramByDistrict();
        //echo "<pre>"; print_r($getData);
        // echo "Akk ok";
        return view('fire.awareness_programme', compact('getData'));
    }

    /////////////////////////////////////////

    public function actionActs(){

        $goCircular  = $this->commonModel->getDataByDesc('fs_go_circular','date','DESC');
        $circularType = [];
        foreach($goCircular as $circular){
            array_push($circularType,$circular->type);
        }
        $circularType = array_unique($circularType);
        $circularType = array_combine(range(0, count($circularType) - 1), $circularType);
        return view('fire.acts_rules',compact('circularType', 'goCircular'));
    }

    /////////////////////////////////////

    public function actionCallDetails()
    {
        return view('fire.call_details');
    }

    /////////////////////////////////////////////////

    public function actionCheckNoc()
    {
        return view('fire.checknoc');
    }

    /////////////////////////////////////////////////

    public function actionCmMsg()
    {
        return view('fire.cm_message');
    }

    /////////////////////////////////////////////////

    public function actionConsultation()
    {
        return view('fire.consultation');
    }

    /////////////////////////////////////////////////

    public function actionContact()
    {
        $data['contact'] = ContactModel::first();
        return view('fire.contact',$data);
    }

    /////////////////////////////////////////////////

    public function actionCopyright()
    {
        return view('fire.copyright_policy');
    }

	/////////////////////////////////////////////////

    public function actionGovMsg()
    {
        return view('fire.gov_message');
    }

    /////////////////////////////////////////////////

    public function actionDgMsg()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'dg_message');
        $dg_message = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.dg_message', compact('dg_message'));
    }

    /////////////////////////////////////////////////


    public function actionDisasterSearch()
    {
        return view('fire.disaster_search');
    }

    /////////////////////////////////////////////////


    public function actionFaq()
    {
        $tbl = "faq";
        $faq = $this->commonModel->getData($tbl);
        return view('fire.faq',compact('faq'));
    }

    /////////////////////////////////////////////////

    public function actionFaq2()
    {
        return view('fire.faq2');
    }

    /////////////////////////////////////////////////


    public function actionFeedback()
    {
        return view('fire.feedback');
    }

    /////////////////////////////////////////////////

    public function actionFireSafteyVVIP()
    {
        return view('fire.fire_saftey_vvip');
    }

    /////////////////////////////////////////////////

    public function actionSuccess(){
        return view('fire.success');
    }

    public function actionMessage(){

        return view('fire.message');
    }

    /////////////////////////////////////////////////

    public function actionFireSafteyCertificate()
    {
        return view('fire.fire_saftey_certificate');
    }

    /////////////////////////////////////////////////


    public function actionFireSafteyToAllPlaces()
    {
        return view('fire.fire_saftey_to_all_places');
    }

    /////////////////////////////////////////////////

    public function actionFireServiceDay()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'fire_service_day');
        $fire_service_day = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_service_day',compact('fire_service_day'));
    }

    /////////////////////////////////////////////////




    // public function actionFireServiceWeek()
    // {
    //     // Get the start and end of the current week
    //     $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
    //     $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

    //     // Fetch events within the current week
    //     $fireEvents = FireServiceWeekModel::whereBetween('date', [$startOfWeek, $endOfWeek])->get();
    //     echo "<pre>"; print_r($fireEvents);die;
    //     $commonModel = new CommonModel();
    //     $category = $commonModel->getData('fire_events_category');
    //     return view('fire.fire_service_week', compact('fireEvents', 'startOfWeek', 'endOfWeek', 'category'));
    // }

    public function actionFireServiceWeek()
    {
        // Fetch events in descending order of ID
        $fireEvents = FireServiceWeekModel::orderBy('id', 'desc')->get();
        
        $commonModel = new CommonModel();
        $category = $commonModel->getData('fire_events_category');
        
        return view('fire.fire_service_week', compact('fireEvents', 'category'));
    }


    /////////////////////////////////////////////////

    public function actionFireUnits()
    {
        // $station = Station::with('district.state')->get();
        // $data['stations'] = $station;

        // echo "<pre>"; print_r($station);die;
        // return view('fire.fire_units',$data);

        //echo "all ok";

        $getData = $this->commonModel->getAllStationByDistrict();
        return view('fire.fire_units', compact('getData'));
    }

    /////////////////////////////////////////////////

    public function actionFireFighting()
    {
        return view('fire.firefighting');
    }

    /////////////////////////////////////////////////

    public function actionFlagday()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'flag_day');
        $flag_day = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.flagday',compact('flag_day'));
    }

    /////////////////////////////////////////////////

    public function actionG1(){
        $tbl = "gallery";
        $data['galalry'] = $this->commonModel->getData($tbl);
        return view('fire.G1',$data);
    }

    /////////////////////////////////////////////////

    public function actionGrivances()
    {
        return view('fire.grivances');
    }

    /////////////////////////////////////////////////


    public function actionGrowthInStaffStrength()
    {
        return view('fire.growth_in_staff_strength');
    }

    /////////////////////////////////////////////////

    public function actionHistory()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'history');
        $history = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.history',compact('history'));
    }

    /////////////////////////////////////////////////

    public function actionHyperlinkingPolicy()
    {
        return view('fire.hyperlinking_policy');
    }

    /////////////////////////////////////////////////


    public function actionMedalWinner()
    {
        $medalCategotryList = $this->commonModel->getMedalCategory();
        
        $meddalArray = [];
        foreach ($medalCategotryList as $row) {
            $medalCategotryId = !empty($row->id) ? $row->id : '';

            // Fetch the list of medal winners for the current category
            $medalWinners = $this->commonModel->getMedalWinnerList($medalCategotryId);

            // Store the results grouped by category
            $meddalArray[$medalCategotryId] = [
                'category_name' => $row->category_name ?? 'Unknown',
                'medals' => $medalWinners
            ];
        }

       // echo "<pre>"; print_r($meddalArray);
        $data['grouped_medal_winners'] = $meddalArray;
        return view('fire.medal_winner', $data);
    }




    // public function actionMedalWinner()
    // {
    //     $medalCategotryList = $this->commonModel->getMedalCategory();
    //     //echo "<pre>"; print_r($medalCategotryList);
    //     $meddalArray = [];
    //     foreach($medalCategotryList as $key => $row)
    //     {
    //         $medalCategotryId = !empty($row->id)?$row->id:'';
    //         $meddalArray = $this->commonModel->getMedalWinnerList($medalCategotryId)
    //     }
    //     // $tbl = "medal_category";
    //     // $medalWinners = $this->commonModel->getDataWithJoin(
    //     //     $tbl,
    //     //     [
    //     //         ['medals', 'medal_category.id', '=', 'medals.medal_category'],
    //     //         ['fire_stations', 'medals.fire_station', '=', 'fire_stations.id'],
    //     //         ['districts', 'medals.districts', '=', 'districts.id']
    //     //     ],
    //     //     ['medals.*', 'medal_category.category_name', 'fire_stations.name as fire_station_name', 'districts.name as district_name']
    //     // );

    //     // $groupedData = [];
    //     // foreach ($medalWinners as $winner) 
    //     // {
    //     //     $categoryName = $winner->category_name;
    //     //     if (!isset($groupedData[$categoryName])) 
    //     //     {
    //     //         $groupedData[$categoryName] = [];
    //     //     }
    //     //     else if(isset($winner->category_name))
    //     //     {
    //     //         $groupedData[$categoryName][] = $winner;
    //     //     }
    //     // }
    //     // $data['grouped_medal_winners'] = $groupedData;
    //     // return view('fire.medal_winner', $data);
    // }


    /////////////////////////////////////////////////

    public function actionMissionVision()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'mission_vision');
        $mission_vision = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.mission_vision',compact('mission_vision'));
    }


    /////////////////////////////////////////////////

    public function actionNoc1()
    {
        return view('fire.noc1');
    }

    /////////////////////////////////////////////////

    public function actionObjective()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'our_objective');
        $objective = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.objective',compact('objective'));
    }

    /////////////////////////////////////////////////

    public function actionOrganisationStructure()
    {
        $headquater  = Organisational::where('status', '=', '1')->where('type', '=', '1')->orderBy('rank', 'asc')->get();
        $district  = Organisational::where('status', '=', '1')->where('type', '=', '2')->orderBy('rank', 'asc')->get();
        $firestation  = Organisational::where('status', '=', '1')->where('type', '=', '3')->orderBy('rank', 'asc')->get();
        return view('fire.organisation_structure')->with('headquater',$headquater)->with('district',$district)->with('firestation',$firestation);
    }



    public function actionRecentUpdates()
    {
        $recentupdates  = RecentUpdates::where('status', '=', '1')->orderBy('id', 'asc')->get();
        return view('fire.recentupdates')->with('recentupdates',$recentupdates);
    }

    /////////////////////////////////////////////////

    public function actionPriorityListOfFireStation()
    {
        return view('fire.priority_list_of_fire_station');
    }

    /////////////////////////////////////////////////

    public function actionSpecialRiskArea()
    {
        $specialriskarea  = SpecialRiskArea::where('status', '=', '1')->get();
        return view('fire.special_risk_area')->with('specialriskarea',$specialriskarea);
    }

    /////////////////////////////////////////////////

    public function actionPrivacyPolicy()
    {
        return view('fire.privacy_policy');
    }

    /////////////////////////////////////////////////

    public function actionPublicAwareness()
    {
        $unique_no =  Carbon::now()->timestamp; // Produces something like 1552296328

        return view('fire.public_awareness', [
            'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
            'categories' => Category::all(),
            'unique_no' =>$unique_no,
        ]);
    }

    // public function publicAwarenessPost(Request $request)
    // {
    //     try{
            
    //         // $this->validate($request, [
    //         //     'captcha' => 'required|string', // Ensure it's a string
    //         // ]);


    //         $validator = Validator::make($request->all(), [
    //             'captcha'  => 'required|string',
    //             'program_type'  => 'required|string',
    //             'name'  => 'required|string',
    //             'address'  => 'required|string',
    //             'district_id'  => 'required',
    //             'email'  => 'required',
    //             'mobile_no'  => 'required|number',
    //             'contact_person'  => 'required|string',
    //             'program_datetime'  => 'required',
    //             'crowd_size'  => 'required|number'
    //         ]);
    
    //         if ($validator->fails()) {
    //             return redirect()->back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }

    //         $tbl = 'fs_awareness_program_request';

    //         $dataArray = [
    //             'captcha' => $request->input('captcha'),
    //             'program_type' => $request->input('program_type'),
    //             'name' => $request->input('name'),
    //             'address' => $request->input('address'),
    //             'district_id' => $request->input('district_id'),
    //             'email' => $request->input('email'),
    //             'mobile_no' => $request->input('mobile_no'),
    //             'contact_person' => $request->input('contact_person'),
    //             'program_datetime' => $request->input('program_datetime'),
    //             'crowd_size' => $request->input('crowd_size'),
    //             ''
    //         ];
             


    //         $result =   $this->commonModel->insertData($tbl,$dataArray);//AwarenessProgram::create($request->all());
    //         if($result)
    //         {
    //             echo "success";
    //            // return redirect()->back()->with('success', 'Data Saved successfully');
    //         }
    //         else{
    //             echo "failed";
    //             //return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
    //         }

    //         //return redirect()->route('actionPublicAwareness');
    //     }
    //     catch(\Exception $e)
    //     {
    //         echo "failed : " . $e->getMessage();
    //         //return redirect()->back()->with('error', 'Something went wrong!');
    //     }
    // }


    // public function publicAwarenessPost(Request $request)
    // {
    //     //die;
    //     try {
    //         // Validate request
    //         $validator = Validator::make($request->all(), [
    //             'captcha'          => 'required|string',
    //             'program_type'     => 'required|string',
    //             'name'             => 'required|string',
    //             'address'          => 'required|string',
    //             'district_id'      => 'required|integer',
    //             'email'            => 'required|email',
    //             'mobile_no'        => 'required|numeric',
    //             'contact_person'   => 'required|string',
    //             'program_datetime' => 'required|date',
    //             'crowd_size'       => 'required|integer'
    //         ]);

    //         if ($validator->fails()) 
    //         {
    //            // echo "<pre>"; print_r($validator);
    //             return redirect()->back()->withErrors($validator)->withInput();
    //             die;
    //         }

    //         // Table Name
    //         $tbl = 'fs_awareness_program_request';

    //         $appliaction_id = rand(1234567890, 9999999999); 

    //         // Data Array
    //         $dataArray = [
    //             'application_id'   => $appliaction_id,
    //             'program_type'     => $request->input('program_type'),
    //             'name'             => $request->input('name'),
    //             'address'          => $request->input('address'),
    //             'district_id'      => $request->input('district_id'),
    //             'email'            => $request->input('email'),
    //             'mobile_no'        => $request->input('mobile_no'),
    //             'contact_person'   => $request->input('contact_person'),
    //             'program_datetime' => $request->input('program_datetime'),
    //             'crowd_size'       => $request->input('crowd_size'),
    //         ];

    //         // Insert Data
    //         $result = $this->commonModel->insertData($tbl, $dataArray);

    //         if ($result) 
    //         {
    //             //echo "success";
    //             return redirect()->back()->with('success', 'Data saved successfully | Your application id is : ' . $appliaction_id);
    //             die;
    //         } 
    //         else 
    //         {
    //             //echo "failed";
    //             return redirect()->back()->with('error', 'Something went wrong, please try again.');
    //             die;
    //         }

    //     } 
    //     catch (\Exception $e) 
    //     {
    //         //echo "failed 2 : ".$e->getMessage();
    //        // \Log::error("Error in publicAwarenessPost: " . $e->getMessage());
    //         return redirect()->back()->with('error', 'An unexpected error occurred. Please try again later.' . $e->getMessage());
    //         die;
    //     }
    // }





    public function publicAwarenessPost(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'captcha'          => 'required|string',
                'program_type'     => 'required|string',
                'name'             => 'required|string',
                'address'          => 'required|string',
                'district_id'      => 'required|integer',
                'email'            => 'required|email',
                'mobile_no'        => 'required|numeric|digits:10',
                'contact_person'   => 'required|string',
                'program_datetime' => 'required|date',
                'crowd_size'       => 'required|integer',
            ]);

            if ($validator->fails()){
                $resp = [
                    'code' => 2,
                    'status' => 'Failed',
                    'errors' => $validator->errors(),
                ];
                return json_encode($resp);
            }

           
            $tbl = 'fs_awareness_program_request';
            $appliaction_id = rand(1234567890, 9999999999);
            // $otp = rand(100000, 999999);
            $otp = 123456;
            $dataArray = [
                'application_id'   => $appliaction_id,
                'program_type'     => $request->input('program_type'),
                'name'             => $request->input('name'),
                'address'          => $request->input('address'),
                'district_id'      => $request->input('district_id'),
                'station_id'       => $request->input('station_id'),
                'email'            => $request->input('email'),
                'mobile_no'        => $request->input('mobile_no'),
                'contact_person'   => $request->input('contact_person'),
                'program_datetime' => $request->input('program_datetime'),
                'crowd_size'       => $request->input('crowd_size'),
                'otp'              => $otp??123456
            ];

            $result = $this->commonModel->insertData($tbl, $dataArray);

            if ($result) 
            {
                $resp = [
                    'code' => 1,
                    'status' => 'Success',
                    'message' => 'Data saved successfully.| One Time Password is sent to your  registered mobile number.',
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
        catch (\Exception $e) {
            $resp = [
                    'code' => 0,
                    'status' => 'Success',
                    'message' => 'Unexpected error: ' . $e->getMessage(),
                ];

            return json_encode($resp);
        }
    }


    public function publicAwarenessOtpPost(Request $request)
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
                    'message' => 'Application has been saved successfully.| Your application id is "  '.$getData[0]->application_id??'',
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



    /////////////////////////////////////////////////

    public function actionPumpingWork()
    {
        return view('fire.pumping_work');
    }

    /////////////////////////////////////////////////

    public function actionRTI()
    {
        $tbl = 'tbl_rti';
        $getData = $this->commonModel->getData($tbl);
        return view('fire.rti', compact('getData'));
    }

    /////////////////////////////////////////////////

    public function actionRTS()
    {
        return view('fire.rts');
    }

    /////////////////////////////////////////////////

    public function rtsAction()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'rti_service'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.rtsaction', compact('getData'));
    }

    /////////////////////////////////////////////////
    

    public function actionSafetyCorner()
    {
        return view('fire.safety_corner');
    }

    /////////////////////////////////////////////////


    public function actionScreenReaderAccess()
    {
        return view('fire.screen_reader_access');
    }

    /////////////////////////////////////////////////

    public function actionServicerenderedpaid()
    {

        $tbl = "pages_card";
        $where = array('page_name' => 'service_rendered_paid');
        $data['paid_data'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.servicerenderedpaid',$data);
    }

    /////////////////////////////////////////////////

    public function actionServicerenderunpaid(){
        $tbl = "pages_card";
        $where = array('page_name' => 'service_rendered_unpaid');
        $data['unpaid_data'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.servicerenderunpaid',$data);
    }

    /////////////////////////////////////////////////

    public function actionSitemap(){
        return view('fire.sitemap');
    }

    /////////////////////////////////////////////////


    public function actionStaffStrength(){
        // $getData = $this->commonModel->getStaffStrength();
        // echo "All ok";
        $getData = $this->commonModel->getStaffStrength();
        return view('fire.staff_strength', compact('getData'));
    }

    /////////////////////////////////////////////////


    public function actionStandby(){
        // return redirect()->route('actionSuccess');
        return view('fire.standby', [
            'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
            'categories' => Category::all(),
        ]);
    }

    // public function actionStandbyPost(Request $request){

    //     echo "<pre>"; print_r($request->all()); die;
    //     Standby::create($request->all());
    //     return redirect()->route('actionSuccess');
    // }




    public function actionStandbyPost(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'program_type'     => 'required|string',
                'name'             => 'required|string',
                'address'          => 'required|string',
                'district_id'      => 'required|integer',
                'station_id'       => 'required|integer',
                'email'            => 'required|email',
                'mobile_no'        => 'required|numeric|digits_between:10,11',
                'contact_person'   => 'required|string',
                'program_datetime' => 'required|date',
                'crowd_size'       => 'required|integer',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $otp = 123456;
            $application_id = rand(1234567890, 9999999999);
            $mobile = ltrim($request->input('mobile_no'), '0');

            $data = [
                'application_id'   => $application_id,
                'program_type'     => $request->input('program_type'),
                'name'             => $request->input('name'),
                'address'          => $request->input('address'),
                'district_id'      => $request->input('district_id'),
                'station_id'       => $request->input('station_id'),
                'email'            => $request->input('email'),
                'mobile_no'        => $mobile,
                'contact_person'   => $request->input('contact_person'),
                'program_datetime' => $request->input('program_datetime'),
                'crowd_size'       => $request->input('crowd_size'),
                'otp'              => $otp
            ];
            // echo "<pre>"; print_r($data); die;
           $result = Standby::create($data);

             if ($result) 
            {
                $resp = [
                    'code' => 1,
                    'status' => 'Success',
                    'message' => 'Data saved successfully.| One Time Password is sent to your  registered mobile number.',
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

            // return redirect()->route('actionSuccess')->with('success', 'Data saved successfully. OTP sent to your mobile.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unexpected error: ' . $e->getMessage())->withInput();
        }
    }




    public function actionStandbyOtpPost(Request $request){
        try{
        
            $validator = Validator::make($request->all(), [
                'otpValue'         => 'required|integer',
                'otpMobile'        => 'required|integer'
            ]);

            if ($validator->fails()){
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
            if ($result){
                $where = ['mobile_no' => $request->input('otpMobile')];
                $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
                $resp = [
                    'code' => 1,
                    'status' => 'Success',
                    'message' => "Application has been saved successfully.| Your application id is: ".$getData[0]->application_id??'',
                ];
                return json_encode($resp);
            }
            else{
                $resp = [
                    'code' => 0,
                    'status' => 'Failed',
                    'message' => 'Something went wrong, please try again.',
                ];
                return json_encode($resp);
            }
        } catch(\Exception $e) {
            $resp = [
                    'code' => 0,
                    'status' => 'Failed',
                    'message' => 'Unexpected error: ' . $e->getMessage(),
                ];
            return json_encode($resp);
        }
    }


    /////////////////////////////////////////////////


    public function actionTermsCondition(){
        return view('fire.terms_condition');
    }

    /////////////////////////////////////////////////

    public function actionTraningCourse(){
        return view('fire.traning_course');
    }

    /////////////////////////////////////////////////


    public function actionVehicle()
    {
        $getData = $this->commonModel->getVehicleData();

        $groupedData = [];
        
        // Grouping the data by district_id
        foreach ($getData as $vehicle) {
            $districtId = $vehicle->district_id;
            
            // Initialize the district entry if it doesn't exist
            if (!isset($groupedData[$districtId])) {
                $groupedData[$districtId] = [
                    'district_name' => $vehicle->district_name,
                    'vehicles' => []
                ];
            }
            
            // Check if the vehicle type already exists in the district's vehicle list
            $vehicleTypeKey = $vehicle->vehicle_type;
            if (!isset($groupedData[$districtId]['vehicles'][$vehicleTypeKey])) {
                $groupedData[$districtId]['vehicles'][$vehicleTypeKey] = [
                    'vehicle_type' => $vehicleTypeKey,
                    'vehicle_type_name' => $vehicle->vehicle_type_name,
                    'count_vehicle_type' => 0 // Initialize count
                ];
            }
            
            // Increment the count for the vehicle type
            $groupedData[$districtId]['vehicles'][$vehicleTypeKey]['count_vehicle_type']++;
        }

        $result = [];
        
        // Preparing the result array for the view
        foreach ($groupedData as $districtId => $data) {
            $result[] = [
                'district_id' => $districtId,
                'district_name' => $data['district_name'],
                'vehicles' => array_values($data['vehicles']) // Convert associative array to indexed array
            ];
        }

        // Uncomment the following line for debugging purposes
       // echo "<pre>"; print_r($result); die;

        // Pass the data to the view
        return view('fire.vehicle', ['data' => $result]);
    }

    /////////////////////////////////////////////////

    public function actionPreEstNoc()
    {
        return view('citizen.pre_est_noc');
    }

    /////////////////////////////////////////////////

    public function actionIncidentReport()
    {
        return view('fire.fire_incident_report', [
                    'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
                    'categories' => Category::all(),
                ]);
    }

    /////////////////////////////////////////////////

    public function incidentReportPost(Request $request)
    {
        $incident_report = IncidentReport::create($request->all());
        $user = Auth::user();
        if(!empty($user) && isset($user->id))
        {
            try{
                $client = new Client([
                    'auth' => ['homedepartment', 'homedepartment@BdwDZ9a2s5IWHuFl40xSnBE7cHmwDlEg']
                ]);
    
                // $params['headers'] = ['Content-Type' => 'application/json', 'Authorization' => 'Zoho-authtoken ' . $AuthCode];
                $params['form_params'] = array('thirdPartyApplicationId' => $incident_report->id, 'serviceId' => json_decode($user->apuni_sarkar_response)->service->id, 'userId' => json_decode($user->apuni_sarkar_response)->user->_id, 'status' => 'Pending');
    
                $res = $client->post('https://eservices.uk.gov.in/api/home-department-integration/application/submit',$params);
    
                if($res->getStatusCode() == 200 || $res->getStatusCode() == 201)
                {
                    return redirect()->back()->with('message', 'Report submited Successfully!');
                }else if($res->getStatusCode() == 400){
    
                    $delet_application = IncidentReport::where('user_id', $user->id)->orderBy("id", "DESC")->take(1)->delete();
                    return back()->with('error','Something went wromg, Please try again!');
                }
            }catch(\Exception $e){
                $delet_application = IncidentReport::where('user_id', $user->id)->orderBy("id", "DESC")->take(1)->delete();
                return back()->with('error','Something went wromg, Please try again1!');
            }
        }
        else
        {
            return redirect()->back()->with('message', 'Report submited Successfully!');
        }
        // Apuni Sarkar Submit API
        
        // /Apuni Sarkar Submit API
    }



    public function serviceorderdata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'establishment_service_order'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.service_order', compact('getData'));

    }

    public function publicarticledata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'activities_public_articles'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.public_article', compact('getData'));

    }

    public function recruitmentdata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'recruitment'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.recruitments', compact('getData'));

    }


    public function historydata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'academy_history'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_history', compact('getData'));

    }

    public function routemapdata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'academy_routemap'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_route_map', compact('getData'));

    }


    public function istitutionalstructuredata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'academy_istitutionalstructure'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_institutional_structure', compact('getData'));
    }


    public function resultdata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'academy_result'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_result', compact('getData'));
    }


    public function trainingscheduledata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'academy_traningschedule'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_traningschedule', compact('getData'));
    }


    public function coursedata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'academy_course'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_traningschedule', compact('getData'));
    }


    public function nocdocrequiredata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'noc_Required_document_for_noc'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_noc_req_doc', compact('getData'));
    }



    public function checklistdata()
    {
        $tbl = 'pages_card';
        $where = ['page_name' => 'noc_checklist'];
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('fire.fire_noc_checklist', compact('getData'));
    }


    public function welfareamenitydata()
    {
        $goCircular  = $this->commonModel->getDataByDesc('fs_walfare_amenity','date','DESC');
        $circularType = [];
        foreach($goCircular as $circular){
            array_push($circularType,$circular->type);
        }
        $circularType = array_unique($circularType);
        $circularType = array_combine(range(0, count($circularType) - 1), $circularType);
        return view('fire.walefare_amenity',compact('circularType', 'goCircular'));
    }


    public function applicationtrackstatus()
    {
        return view('fire.application_track');
    }
    public function applicationverificationtrackstatus()
    {
        return view('fire.application_verification_track');
    }



    // public function applicationtrackstatusPost(Request $request)
    // {

    //     try {

    //             $application_type = $request->input('application_type');
    //             $application_id  = $request->input('application_number');

    //             if(empty($application_type) && empty($application_id))
    //             {
    //                 $response = array(
    //                     'status' => 0,
    //                     'message' => 'Please enter application type and application number',
    //                 );
    //                 echo json_encode($response);
    //                 exit;
    //             }

    //             $tbl ='';
    //             $where='';
    //             if($application_type== 1)
    //             {
    //                 $tbl = 'fs_awareness_program_request';
    //                 $where = $application_id;
    //                 $getData = $this->commonModel->trackAwarenessProgramRequest($where);
    //                 if(!empty($getData))
    //                 {
    //                     $response = array(
    //                         'status' => 1,
    //                         'type'   => $application_type,
    //                         'data' => $getData,
    //                     );
    //                     echo json_encode($response);
    //                     exit;
    //                 }
    //                 else{
    //                     $response = array(
    //                         'status' => 0,
    //                         'message' => 'Invalid Tracking Number',
    //                     );
    //                     echo json_encode($response);
    //                     exit;
    //                 }
 
    //             }
    //             else{
    //                 $tbl = 'applications';
    //                 $where = $application_id;
    //                 $getData = $this->commonModel->trackFireNoc($where);
    //                 if(!empty($getData))
    //                 {
    //                     $response = array(
    //                         'status' => 1,
    //                         'type'   => $application_type,
    //                         'data' => $getData,
    //                     );
    //                     echo json_encode($response);
    //                     exit;
    //                 }
    //                 else{
    //                     $response = array(
    //                         'status' => 0,
    //                         'message' => 'Invalid Tracking Number',
    //                     );
    //                     echo json_encode($response);
    //                     exit;
    //                 }
    //             }


    //     } 
    //     catch (\Exception $e) 
    //     {
    //         $response = array(
    //             'status' => 0,
    //             'message' => 'An unexpected error occurred. Please try again later.' . $e->getMessage(),
    //         );
    //         echo json_encode($response);
    //         exit;
    //     }
    // }

    public function applicationtrackstatusPost(Request $request)
    {
        try {
            $type   = $request->application_type;
            $number = $request->application_number;

            if (!$type || !$number) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Please enter application type and number'
                ]);
            }

            // MAP TABLE
            $map = [
                'awareness' => ['table' => 'fs_awareness_program_request', 'column' => 'application_id'],
                'firenoc'   => ['table' => 'applications', 'column' => 'application_no'],
                'standby'   => ['table' => 'fs_standby_duty_request', 'column' => 'application_id'],
                'fire'      => ['table' => 'fs_fire_report', 'column' => 'application_no'],
                'rescue'    => ['table' => 'fs_rescue_report', 'column' => 'application_no'],
                'relief'    => ['table' => 'fs_relief_report', 'column' => 'application_no'],
            ];

            if (!isset($map[$type])) {
                return response()->json([
                    'status' => 0,
                    'message' => 'Invalid application type'
                ]);
            }

            $table  = $map[$type]['table'];
            $column = $map[$type]['column'];

            // FETCH RECORD
            $record = DB::table($table)->where($column, $number)->first();

            if (!$record) {
                return response()->json([
                    'status' => 0,
                    'message' => 'No report found.'
                ]);
            }

            $otp = rand(100000, 999999);

            session([
                'track_otp'    => $otp,
                'track_record' => $record,
                'track_type'   => $type,
                'track_number'   => $number,
            ]);

            // SEND OTP TO MOBILE
            $mobile = $record->mobile_no ?? null;

            return response()->json([
                'status' => 1,
                'otp_sent' => true,
                'mobile' => $mobile,
                'otp' => $otp   // REMOVE later
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => "Unexpected error: " . $e->getMessage(),
            ]);
        }
    }

    public function verifyTrackOtp(Request $request)
    {
        $userOtp = $request->otp;
        $sessionOtp = session('track_otp');

        if ($userOtp != $sessionOtp) {
            return response()->json([
                'status' => 0,
                'message' => 'Incorrect OTP'
            ]);
        }

        // OTP verified → get data
        $record = session('track_record');
        $type   = session('track_type');
        $number = session('track_number');

        session()->forget('track_otp');
        $validTillDate = null;

        if ($record && $record->updated_at) {
            $startDate = \Carbon\Carbon::parse($record->updated_at);

            // validity: 3 years or 5 years
            if ($record->validity == 3) {
                $validTillDate = $startDate->copy()->addYears(3);
            } else {
                $validTillDate = $startDate->copy()->addYears(5);
            }
        }

        $status = strtolower($record->status);
        $today  = date('Y-m-d');
        $endDate = $record->end_date ?? null; // adjust column name if different

        $statusMessage = "";
        $messageClass  = "track-warning"; // default style

        if (!$record) {
            $statusMessage = "No Record Found. Please verify and try again, or contact Uttarakhand Fire & Emergency Services.";
            $messageClass  = "track-error";
        }
        elseif (in_array($status, [
            "pending", "incomplete", "processed", "for approval",
            "pre approval", "pre approved"
        ])) {
            $statusMessage = "NOC No. {$record->application_no} is Invalid (Expired / Pending / In-Process / Under Verification).
                            For queries, please contact Uttarakhand Fire & Emergency Services.";
            $messageClass  = "track-warning";
        }
        elseif ($status == "approved") {

            $validTill = $validTillDate
                ? $validTillDate->format('d-M-Y')
                : 'N/A';

            $statusMessage = "
                NOC No. {$record->application_no} is Active and Valid till Date {$validTill}.
            ";

            $messageClass = "track-success";
        }
        elseif ($status == "reverted") {
            $statusMessage = "Application No. {$record->application_no} has been reverted for further action.
                            Please log in to your account to respond.";
            $messageClass  = "track-error";
        }
        else {
            $statusMessage = "No Record Found. Please verify your input.";
            $messageClass  = "track-error";
        }

        $designationMap = [
            0 => "Admin",
            1 => "Deputy Director",
            2 => "CFO",
            3 => "FSO",
            4 => "Citizen",
            5 => "Deputy Manager",
            6 => "Agency",
            7 => "Auditor",
        ];


        if ($type == "awareness" || $type == "standby") {

            $districtName = DB::table('districts')
                ->where('id', $record->district_id)
                ->value('name') ?? "";

            $stationName = DB::table('fire_stations')
                ->where('id', $record->station_id)
                ->value('name') ?? "";

            $assignedOfficer = DB::table('users')
                ->select('name', 'type')
                ->where('id', $record->assigned_id)
                ->first();

            $assignedName  = $assignedOfficer->name ?? "";
            $assignedType  = $assignedOfficer->type ?? null;
            $assignedDesig = $assignedType !== null ? ($designationMap[$assignedType] ?? "Officer") : "Officer";

            $approvedOfficer = DB::table('users')
                ->select('name', 'type')
                ->where('id', $record->approved_by)
                ->first();

            $approvedName  = $approvedOfficer->name ?? "";
            $approvedType  = $approvedOfficer->type ?? null;
            $approvedDesig = $approvedType !== null ? ($designationMap[$approvedType] ?? "Officer") : "Officer";
        }


        if ($type == "awareness" || $type == "standby") {

            $status = (int) $record->status;
            $applicationNo = $record->application_id;

            // 1. PENDING / IN PROCESS / NEED REASSIGNMENT (0,1,3)
            if (in_array($status, [0,1,3])) {

                $statusMessage = "
                    Application No. {$applicationNo} is Pending / In-Process / Under Verification with 
                    {$assignedDesig} {$assignedName}, ({$stationName}), {$districtName}. 
                    For queries, please contact Uttarakhand Fire & Emergency Services.
                ";

                $messageClass = "track-warning";
            }

            // 2. REJECTED / REVERTED (2)
            elseif ($status == 2) {

                $statusMessage = "
                    Application No. {$applicationNo} has been reverted by 
                    {$assignedDesig} {$assignedName}, ({$stationName}), {$districtName} 
                    for further action. Please contact your concerned fire station.
                ";

                $messageClass = "track-error";
            }

            // 3. COMPLETED / APPROVED (4)
            elseif ($status == 4) {

                $statusMessage = "
                    Application No. {$applicationNo} is Approved by 
                    {$approvedDesig} {$approvedName}, ({$stationName}), {$districtName}.
                ";

                $messageClass = "track-success";
            }

            // 4. FALLBACK — Should not occur ideally
            else {
                $statusMessage = "No Record Found. Please verify your input.";
                $messageClass  = "track-error";
            }
        }

        $html = view('fire.track.result', [
            'type'          => $type,
            'data'          => $record,
            'number' => $number,
            'statusMessage' => $statusMessage,
            'messageClass'  => $messageClass,
        ])->render();

        return response()->json([
            'status' => 1,
            'html'   => $html,
            'data' => $record
        ]);
    }


    public function trackFetchMobile(Request $req)
    {
        $type = $req->application_type;
        $number = $req->application_number;
        
        // find table according to type
        $map = [
            'awareness' => ['table' => 'fs_awareness_program_request', 'column' => 'application_id'],
            'firenoc'   => ['table' => 'applications', 'column' => 'application_no'],
            'standby'   => ['table' => 'fs_standby_duty_request', 'column' => 'application_id'],
            'fire'      => ['table' => 'fs_fire_report', 'column' => 'application_no'],
            'rescue'    => ['table' => 'fs_rescue_report', 'column' => 'application_no'],
            'relief'    => ['table' => 'fs_relief_report', 'column' => 'application_no'],
        ];
        
        if(!isset($map[$type])){
            return response()->json(['status'=>0,'message'=>"Invalid Type"]);
        }
        
        $tbl = $map[$type]['table'];
        $col = $map[$type]['column'];
        
        $record = DB::table($tbl)->where($col, $number)->first();
        
        if(!$record){
            return response()->json(['status'=>0,'message'=>"No report found.<br><strong>Please verify input and try again.</strong>"]);
        }
        
        // assume record->mobile exists (adjust column name accordingly)
        $mobile = $record->mobile_no ?? null;
        
        if(!$mobile){
            return response()->json(['status'=>0,'message'=>"Mobile number not available"]);
        }
        
        // generate OTP
        $otp = rand(100000,999999);
        
        session(['track_otp'=>$otp, 'track_record'=>$record]);
        
        // send SMS using your SMS gateway
        // SmsHelper::send($mobile,"Your OTP is: $otp");
        
        return response()->json([
            'status'=>1,
            'mobile'=>$mobile,
            'message'=>"OTP sent",
            'record'=>$record,
            'otp'=>$otp,
        ]);
    }

    public function trackVerifyOtp(Request $req)
    {
        if($req->otp != session('track_otp')){
            return response()->json(['status'=>0,'message'=>"Invalid OTP"]);
        }
        
        $record = session('track_record');
        
        return response()->json([
            'status'=>1,
            'data'=>$record
        ]);
    }


    public function actionFireStationByDistrict(Request $request)
    {
        $distrcit_id = $request->input('district_id');

        if (empty($distrcit_id)) {
            $response = array(
                'code' => 0,
                'status' => 'Failed',
                'message' => 'Please select a district.',
            );
            echo json_encode($response);
            exit;
        }

        $tbl = 'fire_stations';
        $where = ['district_id' => $distrcit_id];
        $getData = $this->commonModel->getDataByOneCondition($tbl, $where);
        if (!empty($getData)) {
            $response = array(
                'code' => 1,
                'status' => 'Success',
                'data' => $getData,
            );
            echo json_encode($response);
            exit;
        } else {
            $response = array(
                'code' => 0,
                'status' => 'Failed',
                'message' => 'No fire station found for the selected district.',
            );
            echo json_encode($response);
            exit;
        }
    }


    public function view_awareness_details($id)
    {
        $tbl = 'fs_awareness_program_request';
        $where = ['id' => $id];
        $getData = $this->commonModel->getAwarenessProgrameDetails($where);
        return view('fire.view_awareness_details', compact('getData'));
    }



    public function awarenessPdfDownload()
    {
        return view('admin.awareness.report-download-pdf');
    }

    public function verificationSendOtp(Request $request)
    {
        try {

            $type = $request->application_type;
            $number = $request->application_number;
            $mobile = $request->mobile;

            if ($type != "2") {
                return response()->json([
                    'status' => 0,
                    'message' => "Only Fire NOC verification is supported."
                ]);
            }

            if (!$number || !$mobile) {
                return response()->json([
                    'status' => 0,
                    'message' => "Application number and mobile number are required."
                ]);
            }

            // Fire NOC table
            $record = DB::table('applications')
                ->where('application_no', $number)
                ->first();

            if (!$record) {
                return response()->json([
                    'status' => 0,
                    'message' => "No record found. Please verify the application number and try again."
                ]);
            }

            // Check mobile number match
            // if ($record->mobile != $mobile) {
            //     return response()->json([
            //         'status' => 0,
            //         'message' => "Mobile number does not match the application record."
            //     ]);
            // }

            // Generate OTP
            $otp = rand(111111, 999999);

            // Save OTP in session (or database)
            session(['verification_otp' => $otp]);
            session(['verification_app_no' => $number]);

            // SEND OTP (Your SMS API)
            // sendSms($mobile, "Your verification OTP is $otp");

            return response()->json([
                'status' => 1,
                'message' => "OTP sent successfully.",
                'otp' => $otp   // remove this in live mode
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => 0,
                'message' => "Error: " . $e->getMessage()
            ]);
        }
    }
    public function verificationVerifyOtp(Request $request)
    {
        $otp = $request->otp;

        if (!$otp || session('verification_otp') != $otp) {
            return response()->json([
                'status' => 0,
                'message' => "Invalid OTP. Please try again."
            ]);
        }

        // Get application number from session
        $number = session('verification_app_no');

        // Fetch NOC record
        $record = DB::table('applications')
            ->where('application_no', $number)
            ->first();
        
        $validTillDate = null;

        if ($record && $record->updated_at) {
            $startDate = \Carbon\Carbon::parse($record->updated_at);

            // validity: 3 years or 5 years
            if ($record->validity == 3) {
                $validTillDate = $startDate->copy()->addYears(3);
            } else {
                $validTillDate = $startDate->copy()->addYears(5);
            }
        }

        if (!$record) {
            return response()->json([
                'status' => 1,
                'html' => "
                    <div class='track-wrapper'>
                        <div class='track-card track-error'>
                            <strong>No record found.</strong><br>
                            Please verify the application number and try again, 
                            or contact Uttarakhand Fire & Emergency Services.
                        </div>
                    </div>"
            ]);
        }

        // Normalize status
        $status = strtolower($record->status);
        // $endDate = $record->valid_upto ?? $record->end_date ?? null;
        $validTill = $validTillDate
        ? $validTillDate->format('d-M-Y')
        : 'N/A';
        
        $statusMessage = "
        NOC No. {$record->application_no} is Active and Valid till Date {$validTill}.
        ";
        $endDate = $validTill;

        // Check expired
        $isExpired = ($endDate && strtotime($endDate) < strtotime('today'));

        // INVALID: pending, processed, for approval, reverted, expired
        $invalidStatuses = [
            'pending', 'processed', 'for approval', 'pre approval',
            'pre approved', 'incomplete', 'reverted'
        ];

        if (in_array($status, $invalidStatuses) || $isExpired) {

            return response()->json([
                'status' => 1,
                'html' => "
                    <div class='track-wrapper'>
                        <div class='track-card track-warning'>
                            <strong>NOC No. {$number} is invalid (Expired, Pending, In-Process, Under Verification, or Reverted).</strong><br>
                            For assistance, please contact Uttarakhand Fire & Emergency Services.
                        </div>
                    </div>"
            ]);
        }

        // APPROVED & ACTIVE
        if ($status == 'approved') {

            return response()->json([
                'status' => 1,
                'html' => "
                    <div class='track-wrapper'>
                        <div class='track-card track-success'>
                            <strong>NOC No. {$number} is active and valid until {$endDate}.</strong>
                        </div>
                    </div>"
            ]);
        }

        // DEFAULT
        return response()->json([
            'status' => 1,
            'html' => "
                <div class='alert alert-danger'>
                    <strong>No record found.</strong><br>
                    Please verify the details and try again.
                </div>"
        ]);
    }


}

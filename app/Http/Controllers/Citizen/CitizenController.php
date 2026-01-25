<?php

namespace App\Http\Controllers\Citizen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\DB;


class CitizenController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        return view('citizen.index_noc');
    }
    // public function noc()
    // {
    //     $user_id = Auth::user()->id;
    //     $application = $this->commonModel->getDataByOneConditionDesc('applications', array('user_id' => $user_id), 'id', "DESC");
    //     $approvedApplication = $this->commonModel->getDataByTwoCondition('applications', array('user_id' => $user_id), array('status' => 'approved'));
    //     return view('citizen.home', compact('application', 'approvedApplication'));
    // }

    public function noc()
    {
        $user_id = Auth::user()->id;
        
        $apps = DB::table('applications')
                    ->where('user_id', $user_id)
                    ->orderBy('id', 'DESC')
                    ->get();
        
        $approved  = $apps->where('status', 'approved');

        $inProcess = $apps->whereIn('status', [
            'pending', 'processed', 'incomplete', 'for approval', 'pre approved'
        ]);

        $reverted  = $apps->where('status', 'reverted');

        $preEstApproved = $apps
            ->where('application_type', 'pre establishment noc')
            ->where('status', 'approved');

        $preOpApproved = $apps
            ->where('application_type', 'pre operational noc')
            ->where('status', 'approved');

        $renewalApproved = $apps
            ->where('application_type', 'renewal noc')
            ->where('status', 'approved');

        $preEstApps = $apps->where('application_type', 'pre establishment noc');
        $preOpApps = $apps->where('application_type', 'pre operational noc');
        $renewalApps = $apps->where('application_type', 'renewal noc');

        $nocTypes = DB::table('projects')
            ->where('status', 1)
            ->get();
        
        return view('citizen.home', compact(
            'apps',
            'approved',
            'inProcess',
            'reverted',
            'nocTypes',

            'preEstApproved',
            'preOpApproved',
            'renewalApproved',

            'preEstApps',
            'preOpApps',
            'renewalApps'
        ));
    }






    
    public function indexNoc()
    {
        $user_id = Auth::user()->id;
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        $sub_categories = $this->commonModel->getData('sub_categories');
        $application = $this->commonModel->getDataByOneCondition('applications', array('user_id' => $user_id));

        $count = 0;
        foreach ($application as $app) {
            if ($app->status === 'pending' || $app->status === 'processed') {
                $count++;
            }
        }
        $countStatus = 'N';
        if($count > 0)
        {
            $countStatus = 'Y';
        }
        return view('citizen.noc.index', compact('application','district','projects','categories','sub_categories', 'countStatus'));
    }
    public function indexTemporaryNoc()
    {
        return view('citizen.temporary.index_temporary_noc');
    }
    public function listTemporaryNoc(Request $request, $type)
    {
        $user_id = Auth::user()->id;
        if($type =='pandal') {

            $application = $this->commonModel->getDataByOneCondition('temp_pandal_applications', array('user_id' => $user_id));

        } elseif($type =='public-function') {

            $application = $this->commonModel->getDataByOneCondition('temp_public_function_applications', array('user_id' => $user_id));

        } elseif($type =='entertainment-activity') {

            $application = $this->commonModel->getDataByOneCondition('temp_entertainment_activity_applications', array('user_id' => $user_id));
            
        } elseif($type =='film-shooting') {

            $application = $this->commonModel->getDataByOneCondition('temp_film_shooting_applications', array('user_id' => $user_id));
            
        } elseif($type =='games') {

            $application = $this->commonModel->getDataByOneCondition('temp_games_applications', array('user_id' => $user_id));
            
        } elseif($type =='helipad') {

            $application = $this->commonModel->getDataByOneCondition('temp_helipad_applications', array('user_id' => $user_id));
            
        } elseif($type =='kerosene') {

            $application = $this->commonModel->getDataByOneCondition('temp_kerosene_applications', array('user_id' => $user_id));
            
        } elseif($type =='fire-crackers') {

            $application = $this->commonModel->getDataByOneCondition('temp_fire_crackers_applications', array('user_id' => $user_id));
            
        } elseif($type =='transportation') {

            $application = $this->commonModel->getDataByOneCondition('temp_transportation_applications', array('user_id' => $user_id));
            
        } elseif($type =='other-services') {

            $application = $this->commonModel->getDataByOneCondition('temp_other_services_applications', array('user_id' => $user_id));
            
        } else {
            $application  = "";
        }
        return view('citizen.temporary.list_temporary_noc', compact('application','type'));
    }
    public function activities()
    {
        return view('citizen.index_activity');
    }
    public function building_map()
    {
        $user_id = Auth::user()->id;
        $citizen = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        $buildingPlan = $this->commonModel->getDataByOneCondition('ct_building_map', array('user_id' => $user_id));
        return view('citizen.index_building_map', compact('citizen','buildingPlan'));
    }
    public function fire_escape_plan()
    {
        $user_id = Auth::user()->id;
        $citizen = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        $firePlan = $this->commonModel->getDataByOneCondition('ct_fire_escape_plan', array('user_id' => $user_id));
        return view('citizen.index_fire_escape_plan', compact('citizen','firePlan'));
    }
    public function chemical_use()
    {
        $user_id = Auth::user()->id;
        $citizen = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        $chemical = $this->commonModel->getDataByOneCondition('ct_chemical_use', array('user_id' => $user_id));
        return view('citizen.index_chemical_use', compact('citizen','chemical'));
    }
    public function listSop()
    {
        $user_id = Auth::user()->id;
        $citizen = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        $sop = $this->commonModel->getDataByOneCondition('ct_upload_sop', array('user_id' => $user_id));
        return view('citizen.listSOP', compact('citizen','sop'));
    }
    public function upload_sop()
    {
        $user_id = Auth::user()->id;
        $citizen = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        return view('citizen.index_upload_sop', compact('citizen'));
    }
    public function safety_officer()
    {
        $user_id = Auth::user()->id;
        $citizen = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        $safety = $this->commonModel->getDataByOneCondition('ct_safety_officer', array('user_id' => $user_id));
        return view('citizen.index_safety_officer', compact('citizen','safety'));
    }
    public function do_dont()
    {
        $user_id = Auth::user()->id;
        $citizen = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        $doDonts = $this->commonModel->getDataByDoDont($user_id);
        return view('citizen.index_do_dont', compact('citizen','doDonts'));
    }
    public function uploadDocument(Request $request)
    {
        $type = $request->type;
        $validator = Validator::make($request->all(), [
            'file' => 'mimes:pdf,jpg,jpeg,png,bmp|max:2000',
            [
                'upload_file.required' => 'Please upload pdf',
                'upload_file.mimes' => 'Only pdf,jpg,jpeg,png and bmp file are allowed',
            ]
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        if($type =='building-map') {
            if ($request->hasFile('file')) {
                $fileName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file('file')->move(public_path('citizen/file'), $fileName);
                $document = 'public/citizen/file/' . $fileName;
            }
            $tbl = "ct_building_map";
            $data = [
                'building_map' => $document,
                'user_id'   => $request->id
            ];
        }
        elseif($type == 'upload-sop')
        {
            if ($request->hasFile('file')) {
                $fileName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file('file')->move(public_path('citizen/file'), $fileName);
                $document = 'public/citizen/file/' . $fileName;
            }
            $tbl = "ct_upload_sop";
            $data = [
                'subject' => $request->subject,
                'upload_sop' => $document,
                'user_id'   => $request->id
            ];
        }
        elseif($type == 'do-dont')
        {
            if ($request->hasFile('file')) {
                $fileName = time() . '.' . $request->file->getClientOriginalExtension();
                $request->file('file')->move(public_path('citizen/file'), $fileName);
                $document = 'public/citizen/file/' . $fileName;
            }
            $tbl = "ct_do_and_donts";
            $data = [
                'do_and_dont' => $document,
                'user_id'   => $request->id
            ];
        }
        $result = $this->commonModel->insertData($tbl, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Recent Updates saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    
    public function saveFireEscapePlan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:jpg,jpeg,png,bmp|max:2000',
            [
                'upload_file.required' => 'Please upload pdf',
                'upload_file.mimes' => 'Only jpg,jpeg,png and bmp files are allowed',
            ]
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if ($request->hasFile('file')) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file('file')->move(public_path('citizen/file'), $fileName);
            $document = 'public/citizen/file/' . $fileName;
        }
        
        $data = [
            'floor' => $request->floor,
            'fire_escape_plan' => $document,
            'user_id'   => $request->id
        ];
        $result = $this->commonModel->insertData('ct_fire_escape_plan', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Recent Updates saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function deleteFireEscapePlan($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('ct_fire_escape_plan', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Recent Updates deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function SaveChemicalUse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'chemical_form' => 'required',
            'health' => 'required',
            'fire' => 'required',
            'reactivity' => 'required',
            'note' => 'required',
            'comment' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $data = [
            'name' => $request->name,
            'chemical_form' => $request->chemical_form,
            'health' => $request->health,
            'fire' => $request->fire,
            'reactivity' => $request->reactivity,
            'note' => $request->note,
            'comment' => $request->comment,
            'user_id'   => $request->user_id
        ];
        $result = $this->commonModel->insertData('ct_chemical_use', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Chemical use saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function chemicalUseDelete($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('ct_chemical_use', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Chemical use deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function uploadSopDelete($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('ct_upload_sop', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'SOP deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function saveSafetyOfficer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'minimum_qualification' => 'required',
            'phone_no' => 'required',
            'mobile_no' => 'required',
            'person' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $data = [
            'name' => $request->name,
            'minimum_qualification' => $request->minimum_qualification,
            'phone_no' => $request->phone_no,
            'mobile_no' => $request->mobile_no,
            'person' => $request->person,
            'user_id'   => $request->user_id
        ];
        $result = $this->commonModel->insertData('ct_safety_officer', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Safety officer saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function safetyOfficerDelete($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('ct_safety_officer', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Safety officer deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function addNocStepFirst(Request $request)
    {
        $pre_perational = '0';
        if( $request->has('noc') )
        {
            $noc = $request->query('noc');
        }
        else if($request->session()->get('noc_type') !='')
        {
            $noc = $request->session()->get('noc_type');
            $pre_perational = '1';
        }
        else
        {
            $noc = '';
            $pre_perational = '';
        }

        if( $request->has('type') )
        {
            $type = $request->query('type');
        }
        $user_id = Auth::user()->id;
        $nocProject = $this->commonModel->getDataByOneCondition('projects', array('name' => $noc));
        $application = $this->commonModel->getDataByTwoConditionOneLimit('applications', array('user_id' => $user_id), array('status' => 'incomplete'),'1');
        if(empty($application))
        {
            $step = '0';
            $noc_type = $noc;
            $pre_perational = $pre_perational;
        }
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        $nocfor = isset($nocProject) ? $nocProject[0]->id : '';
        return view('citizen.noc.apply_noc', compact('application','district','pre_perational','step','noc_type','projects','categories','nocfor'));
    }
    public function addNocStepSecond()
    {
        $user_id = Auth::user()->id;
        $application = $this->commonModel->getDataByTwoConditionOneLimit('applications', array('user_id' => $user_id), array('status' => 'incomplete'),'1');
        if(empty($application))
        {
           $step = '0';
        }
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        return view('citizen.noc.noc_step_two', compact('application','district','pre_perational','step','noc_type','projects','categories'));
            
    }
    public function addNocStepThird()
    {
        $user_id = Auth::user()->id;
        $application = $this->commonModel->getDataByTwoConditionOneLimit('applications', array('user_id' => $user_id), array('status' => 'incomplete'),'1');
        if(empty($application))
        {
           $step = '0';
        }
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        return view('citizen.noc.noc_step_three',  compact('application','district','pre_perational','step','noc_type','projects','categories'));
                
    }
    public function addNocStepForth()
    {
        $user_id = Auth::user()->id;
        $application = $this->commonModel->getDataByTwoConditionOneLimit('applications', array('user_id' => $user_id), array('status' => 'incomplete'),'1');
        if(empty($application))
        {
           $step = '0';
        }
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        return view('citizen.noc.noc_step_four',  compact('application','district','pre_perational','step','noc_type','projects','categories'));
    }
    public function addNocStepFive()
    {
        $user_id = Auth::user()->id;
        $application = $this->commonModel->getDataByTwoConditionOneLimit('applications', array('user_id' => $user_id), array('status' => 'incomplete'),'1');
        if(empty($application))
        {
           $step = '0';
        }
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        return view('citizen.noc.noc_step_five', compact('application','district','pre_perational','step','noc_type','projects','categories'));
                
    } 
    public function addNocStepSix(Request $request)
    {
        $user_id = Auth::user()->id;
        $application = $this->commonModel->getDataByTwoConditionOneLimit('applications', array('application_no' => $request->application_no), array('status' => 'incomplete'),'1');
        if(empty($application)){
            $step = '0';
        }
        else
        {
            $step = 5;
            $data = ['step' => $step];
            $res = $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $request->application_no), $data);
        }
        $pre_perational = $request->pre_perational;
        $districts = $this->commonModel->getData('districts');
        $block = $this->commonModel->getData('blocks');
        $panchayat = $this->commonModel->getData('categories');
        // return view('citizen.noc.noc_step_payment', compact('application','districts','block','panchayat','pre_perational','step'));

        return view('citizen.noc.noc_step_submit', compact('application','districts','block','panchayat','pre_perational','step'));
                
    }  
    public function addNocStepSeven(Request $request)
    {
        $user = Auth::user();
        $application = Application::where('user_id',$user->id)->where('status','incomplete')->first();
      
        if(blank($application)){
            $application = new Application();
            $application->step = '0';
        }else{
            if (isset($application->challan)) {
                $application->step = '6';
                $application->update();
            }
        }
        return view('citizen.noc.noc_step_submit', [
            'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
        ])->with('application',$application)->with('pre_perational',$request->pre_perational);
    }
    public function deleteBuildingMap($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('ct_building_map', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Building Map deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function temporary_noc()
    {
        $user_id = Auth::user()->id;
        return view('citizen.temporary.temporary_noc');
    }

    public function applyNoc(Request $request)
    {
        $pre_perational = '0';
        $step = '0';
        $noc_type = $request->query('noc');

        if ($request->has('noc')) {
            $noc = $request->query('noc');
        } else if ($request->session()->get('noc_type') != '') {
            $noc = $request->session()->get('noc_type');
            $pre_perational = '1';
        } else {
            $noc = '';
            $pre_perational = '';
        }

        if ($request->has('type')) {
            $type = $request->query('type');
            if ($type == 'established') {
                $application_type = 'pre establishment noc';
            } else if ($type == 'pre operational') {
                $application_type = 'pre operational noc';
            } else if ($type == 'renewal noc') {
                $application_type = 'renewal noc';
            } else {
                $application_type = '';
            }
        }

        $user_id = Auth::user()->id;

        $nocProject = $this->commonModel->getDataByOneCondition(
            'projects',
            ['entity' => $noc]
        );

        $application = $this->commonModel->getDataByTwoConditionOneLimit(
            'applications',
            ['user_id' => $user_id],
            ['status' => 'incomplete'],
            '1'
        );

        if (!empty($application)) {
            $application = $application[0];
        } else {
            $application = null;
        }

        if ($request->has('application_id') && !empty($request->query('application_id'))) {
            $application_id = $request->query('application_id');

            $applicationDetail = $this->commonModel->getDataByOneCondition(
                'applications',
                ['application_no' => $application_id]
            );

            $application = $this->commonModel->getDataByTwoConditionOneLimit(
                'applications',
                ['application_no' => $application_id],
                [],
                '1'
            );
            $application = $application[0];
        } else {
            $applicationDetail = [];
        }

        $oldApplication = null;

        if (!empty($application) && !empty($application->old_application_no)) {
            $oldData = $this->commonModel->getDataByOneCondition(
                'applications',
                ['application_no' => $application->old_application_no]
            );
            $oldApplication = $oldData[0] ?? null;
        }

        // STEP → COLUMN OWNERSHIP MAP
        $stepOwnership = [

            1 => [
                'building_name','building_ownership','gst_pan_tan','gst_pan_tan_no',
                'project_type','subcategory_id','category_id','project_status',
                'application_type','noc_type','pre_perational',
                'email','mobile_no','office_telephone',
                'latitude','longitude','google_address',
                'district_id','rural_urban','tehsil_id','urban_body_id','ward_id',
                'street','block_id','panchayat_id','village',
                'plot_khasra_khatauni','plot_khasra_khatauni_no',
                'pincode','landmark','occupancy_detail',
            ],

            2 => [
                'proprietary_rights',
                'owner_detail','partner_detail','contact_person','architect_detail',
            ],

            3 => [
                'total_plot_area','total_covered_area','ground_floor_covered',
                'max_height_building','basement_covered_area',
                'no_of_floor','no_of_basement','no_of_blocks',
                'height_of_tallest_block','min_distance_block','approach_road_width',
                'provision_no_enterance','provision_no_exit',
                'set_back_detail',
            ],

            4 => [
                'ess_provision_detail',
            ],

            5 => [
                'attachments',
            ],
        ];

        // MERGE OLD DATA FOR INCOMPLETE STEPS
        if (!empty($application) && $oldApplication) {
            $currentStep = (int) ($application->step ?? 0);
            $mergedApplication = clone $application;

            foreach ($stepOwnership as $stepNo => $columns) {
                if ($stepNo > $currentStep) {
                    foreach ($columns as $column) {
                        if (isset($oldApplication->$column)) {
                            $mergedApplication->$column = $oldApplication->$column;
                        }
                    }
                }
            }

            // IMPORTANT: overwrite application used by Blade
            $application = $mergedApplication;
        }

        $owner_detail = [];
        $partner_detail = [];
        $contact_person = [];
        $architect_detail = [];

        if (!empty($application->owner_detail)) {
            $owner_detail = json_decode($application->owner_detail, true);
        }

        if (!empty($application->partner_detail)) {
            $partner_detail = json_decode($application->partner_detail, true);
            $partner_detail = $partner_detail[0] ?? [];
        }

        if (!empty($application->contact_person)) {
            $contact_person = json_decode($application->contact_person, true);
        }

        if (!empty($application->architect_detail)) {
            $architect_detail = json_decode($application->architect_detail, true);
        }

        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');

        $nocfor = isset($nocProject[0]) ? $nocProject[0]->id : '';

        $approvedApplication = $this->commonModel->getDataByTwoConditionOneLimit(
            'applications',
            ['user_id' => $user_id],
            ['status' => 'approved'],
            '1'
        );

        $hasApprovedNoc = !empty($approvedApplication);
        $lockedAddress = $hasApprovedNoc ? $approvedApplication[0] : null;

        $noc_id = $request->query('noc_id', '');

        $status = 1;
        $subCategoryByProject = $this->commonModel->getSubCategoryByProject(
            $nocfor,
            $status
        );

        return view('citizen.noc.apply_noc', compact(
            'noc_id',
            'lockedAddress',
            'hasApprovedNoc',
            'owner_detail',
            'partner_detail',
            'contact_person',
            'architect_detail',
            'applicationDetail',
            'application',
            'district',
            'pre_perational',
            'step',
            'noc_type',
            'projects',
            'categories',
            'nocfor',
            'application_type',
            'subCategoryByProject'
        ));
    }



    public function citizen_profile()
    {
        $fireStactionList =  $this->commonModel->getData('fire_stations');
        $districtList =  $this->commonModel->getData('districts');
        $stateList =  $this->commonModel->getData('states');
        return view('citizen.citizen_profile', compact('fireStactionList', 'districtList', 'stateList'));
    }
}
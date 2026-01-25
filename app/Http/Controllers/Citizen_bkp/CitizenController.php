<?php

namespace App\Http\Controllers\Citizen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;

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
    public function noc()
    {
        $user_id = Auth::user()->id;
        
        $application = $this->commonModel->getDataByOneConditionDesc('applications', array('user_id' => $user_id), 'id', "DESC");
        return view('citizen.home', compact('application'));
    }
    public function addNocStepFirst(Request $request)
    {
        $pre_perational = '0';
        if( $request->has('noc') ) {
            $noc = $request->query('noc');
        } else if($request->session()->get('noc_type') !='') {
            $noc = $request->session()->get('noc_type');
            $pre_perational = '1';
        } else {
            $noc = '';
        }

        if( $request->has('type') ) {
            $type = $request->query('type');
        }
        
        $user_id = Auth::user()->id;
        $application = $this->commonModel->getDataByTwoConditionOneLimit('applications', array('user_id' => $user_id), array('status' => 'incomplete'),'1');
        
        $district = $this->commonModel->getData('districts');
        return view('citizen.noc.noc_step_one', compact('application','district'));
    }
    public function indexNoc()
    {
        $user_id = Auth::user()->id;
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        $sub_categories = $this->commonModel->getData('sub_categories');
        $application = $this->commonModel->getDataByOneCondition('applications', array('user_id' => $user_id));
        return view('citizen.noc.index', compact('application','district','projects','categories','sub_categories'));
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
        return view('citizen.index_building_map', compact('citizen'));
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
    public function declaration()
    {
        return view('citizen.index_noc');
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

    public function viewTemporaryNocDetail($type,$id)
    {
        if($type =='pandal') {

            $application = $this->commonModel->getDataByOneCondition('temp_pandal_applications', array('id' => $id));

        } elseif($type =='public-function') {

            $application = $this->commonModel->getDataByOneCondition('temp_public_function_applications', array('id' => $id));

        } elseif($type =='entertainment-activity') {

            $application = $this->commonModel->getDataByOneCondition('temp_entertainment_activity_applications', array('id' => $id));
            
        } elseif($type =='film-shooting') {

            $application = $this->commonModel->getDataByOneCondition('temp_film_shooting_applications', array('id' => $id));
            
        } elseif($type =='games') {

            $application = $this->commonModel->getDataByOneCondition('temp_games_applications', array('id' => $id));
            
        } elseif($type =='helipad') {

            $application = $this->commonModel->getDataByOneCondition('temp_helipad_applications', array('id' => $id));
            
        } elseif($type =='kerosene') {

            $application = $this->commonModel->getDataByOneCondition('temp_kerosene_applications', array('id' => $id));
            
        } elseif($type =='fire-crackers') {

            $application = $this->commonModel->getDataByOneCondition('temp_fire_crackers_applications', array('id' => $id));
            
        } elseif($type =='transportation') {

            $application = $this->commonModel->getDataByOneCondition('temp_transportation_applications', array('id' => $id));
            
        } elseif($type =='other-services') {

            $application = $this->commonModel->getDataByOneCondition('temp_other_services_applications', array('id' => $id));
            
        } else {
            $application  = "";
        }
        return view('citizen.temporary.view_temporary_noc', compact('application','type'));
    }
}
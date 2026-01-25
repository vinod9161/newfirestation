<?php

namespace App\Http\Controllers\Citizen;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use App\Models\Models\{Application,User,BuildingMap,FireEscapePlan,ChemicalUse,UploadSop,SafetyOfficer,DoAndDonts,Declaration,Issued,Project,District};
use Auth;

class NocController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }


    public function indexNoc(Request $request){
       $application = array();
        if($request->type=='all'){
            if(Auth::user()->type == 3) {
                $application  = Application::with('operational_applications','renewal_applications')->where('assigned_id', '=', Auth::user()->id)->where('status', '!=', 'incomplete')->orderBy('id', 'desc')->get();
            } else if(Auth::user()->type == 0) {
                $application  = Application::with('operational_applications','renewal_applications')->where('status', '!=', 'incomplete')->orderBy('id', 'desc')->get();
            } else if(Auth::user()->type == 1) {
                $application  = Application::with('operational_applications','renewal_applications')->where('status', '!=', 'incomplete')->where('large_small_category', '1')->orderBy('id', 'desc')->get();
            } else if(Auth::user()->type == 2){
                $application  = Application::with('operational_applications','renewal_applications')->where('district_id', '=', Auth::user()->district_id)->where('status', '!=', 'incomplete')->where('assigned_cfo', '1')->orderBy('id', 'desc')->get();
            } else  if(Auth::user()->type == 5 && Auth::user()->district_id !=''){
                $application  = Application::with('operational_applications','renewal_applications')->where('district_id', '=', Auth::user()->district_id)->where('status', 'pre approval')->orwhere('status', 'pending')->orwhere('status', 'approved')->orderBy('id', 'desc')->get();
            } else  if(Auth::user()->type == 5 && Auth::user()->district_id ==''){
                $application  = Application::with('operational_applications','renewal_applications')->where('status', 'pre approval')->orwhere('status', 'pending')->orwhere('status', 'approved')->orderBy('id', 'desc')->get();
            }
    } else{

            if(Auth::user()->type == 3) {
                $application  = Application::with('operational_applications','renewal_applications')->where('assigned_id', '=', Auth::user()->id)->orderBy('id', 'desc')->where('status',$request->type)->get();
            } else if(Auth::user()->type == 0 || Auth::user()->type == 1) {
                $application  = Application::with('operational_applications','renewal_applications')->where('status',$request->type)->orderBy('id', 'desc')->get();
            } else  if(Auth::user()->type == 2){
                $application  = Application::with('operational_applications','renewal_applications')->where('district_id', '=', Auth::user()->district_id)->where('status',$request->type)->orderBy('id', 'desc')->get();
            } else  if(Auth::user()->type == 5 && Auth::user()->district_id !=''){
                $application  = Application::with('operational_applications','renewal_applications')->where('district_id', '=', Auth::user()->district_id)->where('status',$request->type)->orderBy('id', 'desc')->get();
            } else  if(Auth::user()->type == 5 && Auth::user()->district_id ==''){
                $application  = Application::with('operational_applications','renewal_applications')->where('status', 'pre approval')->orwhere('status', 'pending')->orwhere('status', 'approved')->orderBy('id', 'desc')->get();
            }
        }

        return view('admin.Noc.list_noc', [
            'applications' => $application,
        ]); 
    }



    public function adminviewNocDetail($id){
        $users = User::with('station')->where('type', '=', '3')->get();
        $app = Application::find($id);
        if(Auth::user()->type == 0) {
            $app->admin_read = '1';
        } else if(Auth::user()->type == 1) {
            $app->dd_read = '1';
        } else if(Auth::user()->type == 2) {
            $app->cfo_read = '1';
        } else if(Auth::user()->type == 3) {
            $app->fso_read = '1';
        } else if(Auth::user()->type == 5) {
            $app->dm_read = '1';
        }
        $app->update();

        $applicationDetail  = Application::with('category','subcategory','type','district','assigned','block','panchayat','tehsil')->where('id', '=', $id)->first();
        
        // dd($applicationDetail);
        // echo "<pre>";
        // print_r(json_decode($applicationDetail->user_id)); exit;

        $buildingMap  = BuildingMap::where('user_id', '=', $applicationDetail->user_id)->first();

        $firePlan  = FireEscapePlan::where('user_id', '=', $applicationDetail->user_id)->get();

        $chemical = ChemicalUse::where('user_id', '=', $applicationDetail->user_id)->get();

        $sop  = UploadSop::where('user_id', '=', $applicationDetail->user_id)->first();

        $officer = SafetyOfficer::where('user_id', '=', $applicationDetail->user_id)->get();

        $doDonts  = DoAndDonts::where('user_id', '=', $applicationDetail->user_id)->first();

        $declaration  = Declaration::where('user_id', '=', $applicationDetail->user_id)->first();


        $issued = Issued::with('district')->where('user_id', '=', $applicationDetail->user_id)->orderBy('id', 'desc')->get();

        $user_id = Auth::user()->id;
        $citizen  = User::where('id', '=', $user_id)->first();
        if(Auth::user()->type == 4)
        {
            $declaration  = Declaration::where('user_id', '=', $user_id)->get();
        }else{
            $applicationDetail  = Application::with('category','subcategory','type','district','assigned','block','panchayat','tehsil')->where('id', '=', $id)->first();
            $declaration  = Declaration::where('user_id', '=', $applicationDetail->user_id)->get();
        }
        
        return view('admin.Noc.view_noc', [
            'projects' => Project::with('category')->get(),
            'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
        ])->with('applicationDetail',$applicationDetail)->with('users',$users)->with('inspection_step','')->with('buildingMap',$buildingMap)->with('firePlan',$firePlan)->with('chemical',$chemical)->with('sop',$sop)->with('officer',$officer)->with('doDonts',$doDonts)->with('declaration',$declaration)->with('issued',$issued);
    }



    public function viewOperationalNocDetail($id)
    {
        return view('citizen.noc.view_operational_noc');
    }
    public function viewNocDetail($id, Request $request)
    {
        return view('citizen.noc.view_noc');
    }
    public function downloadApplication(Request $request)
    {
        return view('admin.noc.reports.noc_building_report');
    }
    public function editNoc($id)
    {
        $applicationDetail = $this->commonModel->getDataByOneCondition('applications', array('id' => $id));
        
        $district = $this->commonModel->getData('districts');
        $categories = $this->commonModel->getData('categories');
        $sub_categories = $this->commonModel->getData('sub_categories');
        $projects = $this->commonModel->getData('projects');
        $types = $this->commonModel->getData('types');
        return view('citizen.noc.edit_noc', compact('applicationDetail','district','categories','sub_categories','projects','types'));
    }
}
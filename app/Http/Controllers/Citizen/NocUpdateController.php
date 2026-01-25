<?php

namespace App\Http\Controllers\Citizen;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Common\CommonModel;
use DB;
use App\Models\Category;
use App\Models\State;
use App\Models\Tehsil;
use App\Models\Block;
use App\Models\Panchayat;
use \stdClass;
use Validator;
use PDF;
use App\Models\OperationalApplication;
use App\Models\RenewalApplication;
use App\Models\Models\{Application, User, BuildingMap, FireEscapePlan, ChemicalUse, UploadSop, SafetyOfficer, DoAndDonts, Declaration, Issued, Project, District};
use App\Models\TemporaryApplication;

class NocUpdateController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function index()
    {
        $user = Auth::user();
        return view('citizen.home');
    }
    public function updateNocStepFirstPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $occupancy_data = new stdClass();

        if(isset($request->no_of_rooms) && $request->no_of_rooms!='') {
            $occupancy_data->no_of_rooms = $request->no_of_rooms;
        }

        if(isset($request->no_of_beds) && $request->no_of_beds!='') {
            $occupancy_data->no_of_beds = $request->no_of_beds;
        }

        if(isset($request->for_educational) && $request->for_educational!='') {
            $occupancy_data->for_educational = $request->for_educational;
        }

        if(isset($request->seating_capacity) && $request->seating_capacity!='') {
            $occupancy_data->seating_capacity = $request->seating_capacity;
        }

        if(isset($request->no_of_employee) && $request->no_of_employee!='') {
            $occupancy_data->no_of_employee = $request->no_of_employee;
        }

        if(isset($request->is_hazardous_material) && $request->is_hazardous_material!='') {
            $occupancy_data->is_hazardous_material = $request->is_hazardous_material;
        }

        if(isset($request->hazardous_material) && $request->hazardous_material!='') {
            $occupancy_data->hazardous_material = $request->hazardous_material;
        }

        $app =  '';

        $application = Application::where('application_no',$request->application_no)->first();
         
        foreach ($data as $key => $value) {
            if($key!="_token" && $key!="no_of_rooms" && $key!="no_of_flats" && $key!="no_of_beds" && $key!="for_educational" && $key!="seating_capacity" && $key!="no_of_employee" && $key!="is_hazardous_material" && $key!="hazardous_material" && $key!="pre_perational") {
              $application->$key = $value;  
            }
        }

        $application->occupancy_detail = json_encode($occupancy_data);

        $application->pre_perational = '0';

        $application->status = 'incomplete';

        $application->admin_read = 0;
        $application->dd_read = 0;
        $application->cfo_read = 0;
        $application->fso_read = 0;
        $application->dm_read = 0;

        $res = $application->update(); 
        $app = Application::where('application_no',$application->application_no)->with('category.subcategory.type')->first();

        return redirect()->back()->with('message', 'Application Updated Successfully!');
    }
    public function updateNocStepSecondPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $application = Application::where('application_no',$request->application_no)->first();

        $person_data = new stdClass();
        $person_data = [];
        $p_salutation = $request->p_salutation;
        $p_first_name = $request->p_first_name;
        $p_middle_name = $request->p_middle_name;
        $p_last_name = $request->p_last_name;
        $p_mobile_no = $request->p_mobile_no;
        $p_percentage_share = $request->p_percentage_share;
        $p_point_of_contact = $request->p_point_of_contact;
        for($i=0;$i<count($p_salutation);$i++)
        {
            if($i == "0")
            {
                $p_point_of_contact = $p_point_of_contact[0];
            }
            else
            {
                $p_point_of_contact = "no";
            }
            $newArr = [
                'p_salutation' => $p_salutation[$i],
                'p_first_name' => $p_first_name[$i],
                'p_middle_name' => $p_middle_name[$i],
                'p_last_name' => $p_last_name[$i],
                'p_mobile_no' => $p_mobile_no[$i],
                'p_percentage_share' => $p_percentage_share[$i],
                'p_point_of_contact' => $p_point_of_contact,
            ];
            array_push($person_data,$newArr);
        }

        $own_data = new stdClass();
        $own_data->salutation = $request->salutation;
        $own_data->first_name = $request->first_name;
        $own_data->middle_name = $request->middle_name;
        $own_data->last_name = $request->last_name;
        $own_data->mobile_no = $request->mobile_no;
        $own_data->percentage_share = $request->percentage_share;
        $own_data->point_of_contact = $request->point_of_contact;

        $contact_data = new stdClass();
        $contact_data->person_appointed = $request->person_appointed;
        $contact_data->con_salutation = $request->con_salutation;
        $contact_data->con_first_name = $request->con_first_name;
        $contact_data->con_middle_name = $request->con_middle_name;
        $contact_data->con_last_name = $request->con_last_name;
        $contact_data->con_mobile_no = $request->con_mobile_no;
        $contact_data->con_email = $request->con_email;

        $arc_data = new stdClass();
        $arc_data->arc_salutation = $request->arc_salutation;
        $arc_data->arc_first_name = $request->arc_first_name;
        $arc_data->arc_middle_name = $request->name_of_firm;
        $arc_data->arc_last_name = $request->arc_last_name;
        $arc_data->name_of_firm = $request->name_of_firm;
        $arc_data->architect_mobile_no = $request->architect_mobile_no;
        $arc_data->architect_email = $request->architect_email;
        $arc_data->firm_gst_pan_tan = $request->firm_gst_pan_tan;
        $arc_data->firm_gst_pan_tan_no = $request->firm_gst_pan_tan_no;
        
     
        $application->proprietary_rights  = $request->proprietary_rights;
        $application->partner_detail  = json_encode($person_data);
        $application->owner_detail  = json_encode($own_data);
        $application->contact_person  = json_encode($contact_data);
        $application->architect_detail  = json_encode($arc_data);
        
        $res = $application->update();

        return redirect()->back()->with('message', 'Application Updated Successfully!');  
    }
    public function updateNocStepThirdPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $total_plot_area = new stdClass();
        $total_plot_area->total_plot_area = $request->total_plot_area;

        $total_covered_area = new stdClass();
        $total_covered_area->total_covered_area = $request->total_covered_area;

        $ground_floor_covered = new stdClass();
        $ground_floor_covered->ground_floor_covered = $request->ground_floor_covered;

        $max_height_building = new stdClass();
        $max_height_building->max_height_building = $request->max_height_building;

        $basement_covered_area = new stdClass();
        $basement_covered_area->basement_covered_area = $request->basement_covered_area;

        $height_of_tallest_block = new stdClass();
        $height_of_tallest_block->height_of_tallest_block = $request->height_of_tallest_block;

        $min_distance_block = new stdClass();
        $min_distance_block->min_distance_block = $request->min_distance_block;


        $approach_road_width = new stdClass();
        $approach_road_width->approach_road_width = $request->approach_road_width;

        $setback = new stdClass();
        $setback->front = $request->front;
        $setback->rear = $request->rear;
        $setback->side1 = $request->side1;
        $setback->side2 = $request->side2;

        $application = Application::where('application_no',$request->application_no)->first();

        $application->total_plot_area = json_encode($total_plot_area);
        $application->total_covered_area = json_encode($total_covered_area);
        $application->ground_floor_covered = json_encode($ground_floor_covered);
        $application->max_height_building = json_encode($max_height_building);
        $application->no_of_floor = $request->no_of_floor;
        $application->basement_covered_area = json_encode($basement_covered_area);
        $application->no_of_basement = $request->no_of_basement;
        $application->no_of_blocks = $request->no_of_blocks;
        $application->height_of_tallest_block = json_encode($height_of_tallest_block);
        $application->min_distance_block = json_encode($min_distance_block);
        $application->approach_road_width = json_encode($approach_road_width);
        $application->provision_no_enterance = $request->provision_no_enterance;
        $application->provision_no_exit = $request->provision_no_exit;
        $application->set_back_detail = json_encode($setback);

        $res = $application->update();

        return redirect()->back()->with('message', 'Application Updated Successfully!');  
            
    }
    public function updateNocStepForthPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        unset($data['_token']);

        unset($data['application_no']);
        $application = Application::where('application_no',$request->application_no)->first();
           $application->ess_provision_detail = json_encode($data);

        $res = $application->update();

        $app = Application::where('application_no',$request->application_no)->with('category.subcategory.type')->first();

        return redirect()->back()->with('message', 'Application Updated Successfully!');
    }
    public function updateNocStepFinalPost(Request $request)
    {
        $input_data = $request->all();

        $application = Application::where('application_no',$request->application_no)->first();

        $history = array();
        $historys = new stdClass();
        $historys->history = 'Application has been Updated By Citizen';
        $historys->date = date('m/d/Y h:i:s a', time());
               
        if(blank($application->history)){
            $history[] = $historys;
        }else{
            $history = json_decode($application->history);
            $history[] = $historys;
        }

        $application->history = json_encode($history);

        $application->status = 'processed';
       
        $res = $application->update();
        
        return redirect()->back()->with('message', 'Application Updated Successfully!');
    }
    public function editOperationalNoc(Request $request)
    {
        $user = Auth::user();
        $application = Application::where('id',$request->id)->first();
        return view('citizen.noc.edit_operational_noc', [
            'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
            'categories' => Category::with('subcategory.type')->get(),
        ])->with('applicationDetail',$application);
    }
    public function preOprationalUpdatePost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $vendor_data = new stdClass();
        $vendor_data->vendor_name = $request->vendor_name;
        $vendor_data->vendor_firm_name = $request->vendor_firm_name;
        $vendor_data->vendor_number = $request->vendor_number;
        $vendor_data->vendor_email = $request->vendor_email;
        $vendor_data->vendor_gst_pan_tan = $request->vendor_gst_pan_tan;
        $vendor_data->vendor_gst_pan_tan_no = $request->vendor_gst_pan_tan_no;

        $attachment = new stdClass();

        $input_data = $request->all();
        
        //upload reference letter pdf
        $validator_file = Validator::make(
        $input_data, [
        'reference_letter' => 'mimes:pdf|max:20000'
            ],[
                'reference_letter.required' => 'Please upload pdf',
                'reference_letter.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('reference_letter')) {
            $imageName = time().'.'.'rl_1'.$request->reference_letter->extension(); 
            $request->reference_letter->move('uploads', $imageName);
            $attachment->reference_letter ='uploads/'.$imageName;
        } else {
            $attachment->reference_letter = $request->reference_letter_old;
        }

        //upload approved map pdf
        $validator_file = Validator::make(
        $input_data, [
        'approved_map' => 'mimes:pdf|max:20000'
            ],[
                'approved_map.required' => 'Please upload pdf',
                'approved_map.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('approved_map')) {
            $imageName = time().'.'.'ap_2'.$request->approved_map->extension(); 
            $request->approved_map->move('uploads', $imageName);
            $attachment->approved_map ='uploads/'.$imageName;
        } else {
            $attachment->approved_map = $request->approved_map_old;
        }

        //upload est noc pdf
        $validator_file = Validator::make(
        $input_data, [
        'est_noc' => 'mimes:pdf|max:20000'
            ],[
                'est_noc.required' => 'Please upload pdf',
                'est_noc.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('est_noc')) {
            $imageName = time().'.'.'es_3'.$request->est_noc->extension(); 
            $request->est_noc->move('uploads', $imageName);
            $attachment->est_noc ='uploads/'.$imageName;
        } else {
            $attachment->est_noc = $request->est_noc_old;
        }

        //upload challan pdf
        $validator_file = Validator::make(
        $input_data, [
        'challan' => 'mimes:pdf|max:20000'
            ],[
                'challan.required' => 'Please upload pdf',
                'challan.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('challan')) {
            $imageName = time().'.'.'ch_4'.$request->challan->extension(); 
            $request->challan->move('uploads', $imageName);
            $challan_pdf ='uploads/'.$imageName;
        } else {
            $challan_pdf = $request->challan_old;
        }
        

        $application = OperationalApplication::where('application_no',$request->application_no)->first();

        $application->application_no = strtotime(now());
        $application->application_id  = $request->application_id;
        $application->user_id = $user->id;
        $application->noc_type  = 'building';
        $application->application_type = 'pre operational noc';
        $application->vendor  = json_encode($vendor_data);
        $application->attachment  = json_encode($attachment);
        $application->challan  = $challan_pdf;
        $application->status  = "processed";

        $application->admin_read = 0;
        $application->dd_read = 0;
        $application->cfo_read = 0;
        $application->fso_read = 0;
        $application->dm_read = 0;

        $history = array();
        $historys = new stdClass();
        $historys->history = 'Application has been Updated By Citizen';
        $historys->date = date('m/d/Y h:i:s a', time());
               
        if(blank($app->history)){
            $history[] = $historys;
        }else{
            $history = json_decode($app->history);
            $history[] = $historys;
        }

        $application->history = json_encode($history);
               
        $res = $application->update();

        $app = Application::where('application_no',$request->application_no)->with('category.subcategory.type','operational')->first();

        return redirect()->route('noc')->with('application',$app)->with('message','Pre Operational Application Update Successfully!');
    }
    public function editRenewalNocDetail($id)
    {
        $users = User::where('type', '=', '3')->get();
        $user = Auth::user();

        $applicationDetail  = Application::with('operational_applications','category','subcategory','type','district','assigned','block','panchayat','tehsil')->where('id', '=', $id)->first();
        
        return view('citizen.noc.edit_renewal_noc')->with('applicationDetail',$applicationDetail)->with('users',$users);
    }
    public function renewalUpdatePost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        $attachment = new stdClass();

        $input_data = $request->all();
        
        //upload reference letter pdf
        $validator_file = Validator::make(
        $input_data, [
        'competent_authority' => 'mimes:pdf|max:20000'
            ],[
                'competent_authority.required' => 'Please upload pdf',
                'competent_authority.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('competent_authority')) {
            $imageName = time().'.'.'ca_1'.$request->competent_authority->extension(); 
            $request->competent_authority->move('uploads', $imageName);
            $attachment->competent_authority ='uploads/'.$imageName;
        } else {
            $attachment->competent_authority = $request->competent_authority_old;
        }

        //upload est noc pdf
        $validator_file = Validator::make(
        $input_data, [
        'po_noc' => 'mimes:pdf|max:20000'
            ],[
                'po_noc.required' => 'Please upload pdf',
                'po_noc.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('po_noc')) {
            $imageName = time().'.'.'po_2'.$request->po_noc->extension(); 
            $request->po_noc->move('uploads', $imageName);
            $attachment->po_noc ='uploads/'.$imageName;
        } else {
            $attachment->po_noc = $request->po_noc_old;
        }

        //upload challan pdf
        $validator_file = Validator::make(
        $input_data, [
        'hp_test_cetificate' => 'mimes:pdf|max:20000'
            ],[
                'hp_test_cetificate.required' => 'Please upload pdf',
                'hp_test_cetificate.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('hp_test_cetificate')) {
            $imageName = time().'.'.'hp_3'.$request->hp_test_cetificate->extension(); 
            $request->hp_test_cetificate->move('uploads', $imageName);
            $attachment->hp_test_cetificate ='uploads/'.$imageName;
        } else {
            $attachment->hp_test_cetificate = $request->hp_test_cetificate_old;
        }

        //upload approved map pdf
        $validator_file = Validator::make(
        $input_data, [
        'approved_map' => 'mimes:pdf|max:20000'
            ],[
                'approved_map.required' => 'Please upload pdf',
                'approved_map.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('approved_map')) {
            $imageName = time().'.'.'am_4'.$request->approved_map->extension(); 
            $request->approved_map->move('uploads', $imageName);
            $attachment->approved_map ='uploads/'.$imageName;
        } else {
            $attachment->approved_map = $request->approved_map_old;
        }

        //upload challan pdf
        $validator_file = Validator::make(
        $input_data, [
        'challan' => 'mimes:pdf|max:20000'
            ],[
                'challan.required' => 'Please upload pdf',
                'challan.mimes' => 'Only pdf file are allowed',
            ]
        );
        if ($validator_file->fails()) {
            return redirect()->back()->with('error', 'Only pdf file are allowed!')->withInput();
        }

        if ($request->hasFile('challan')) {
            $imageName = time().'.'.'ch_5'.$request->challan->extension(); 
            $request->challan->move('uploads', $imageName);
            $challan_pdf ='uploads/'.$imageName;
        } else {
            $challan_pdf = $request->challan_old;
        }
        
        // $attachment->refrence_letter = $request->refrence_letter;
        // $attachment->approved_map = $request->approved_map;
        // $attachment->est_noc = $request->est_noc;

        $application = RenewalApplication::where('application_no',$request->application_no)->first();

        $application->application_no = strtotime(now());
        $application->application_id  = $request->application_id;
        $application->user_id = $user->id;
        $application->noc_type  = 'building';
        $application->application_type = 'pre renewal noc';
        $application->attachment  = json_encode($attachment);
        $application->challan  = $challan_pdf;
        $application->status  = "processed";

        $application->admin_read = 0;
        $application->dd_read = 0;
        $application->cfo_read = 0;
        $application->fso_read = 0;
        $application->dm_read = 0;

        $history = array();
        $historys = new stdClass();
        $historys->history = 'Application has been Updated By Citizen';
        $historys->date = date('m/d/Y h:i:s a', time());
               
        if(blank($app->history)){
            $history[] = $historys;
        }else{
            $history = json_decode($app->history);
            $history[] = $historys;
        }

        $application->history = json_encode($history);
               
        $res = $application->update();

        $app = Application::where('application_no',$request->application_no)->with('category.subcategory.type','operational')->first();

        return redirect()->route('noc')->with('application',$app)->with('message','Renewal Application Updated Successfully!');
    }
}

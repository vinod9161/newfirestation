<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;

class OtherServicesNocController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $user = Auth::user();
        $districts = $this->commonModel->getData('districts');
        $tehsil = $this->commonModel->getData('tehsils');
        $block = $this->commonModel->getData('blocks');
        $panchayat = $this->commonModel->getData('panchayats');
        return view('citizen.temporary..other_services.other_services', compact('districts','tehsil','block','panchayat'));
            
    }
    public function addOtherServicesBasicDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $application_no = strtotime(now());
        $data = [
            'application_no' => $application_no,
            'user_id' => $user_id,
            'noc_type' => 'other-services',
            'applicant_type' => $request->applicant_type,
            'status' => 'pending',
        ];
        $result = $this->commonModel->insertData('temp_other_services_applications', $data);
        if ($result == 1)
        {
            return ['status' => '1', 'msg' => 'Data submitted successfully.', 'application_no' => $application_no];
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
    public function addOtherServicesApplicantDetails(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'salutation' => 'required|string',
            'first_name' => 'required|string',
            'email' => 'required|email',
            'mobile_no' => 'required|string',
            'rural_urban' => 'required|string|in:urban,rural'
        ]);

        $user_id = Auth::user()->id;
        $applicant_address = [];
        $applicant_address['district_id'] = $request->district_id;
        $applicant_address['rural_urban'] = $request->rural_urban;
        if ($request->rural_urban == 'urban') {
            $applicant_address['tehsil_id'] = $request->tehsil_id;
            $applicant_address['street'] = $request->street;
            $applicant_address['landmark'] = $request->landmark;
            $applicant_address['city'] = $request->city;
            $applicant_address['plot_khasra_khatauni'] = $request->plot_khasra_khatauni;
            $applicant_address['plot_khasra_khatauni_no'] = $request->plot_khasra_khatauni_no;
            $applicant_address['pincode'] = $request->pincode;
        } elseif ($request->rural_urban == 'rural') { // Corrected from 'rular' to 'rural'
            $applicant_address['block_id'] = $request->block_id;
            $applicant_address['panchayat_id'] = $request->panchayat_id;
            $applicant_address['village'] = $request->village;
            $applicant_address['landmark'] = $request->rlandmark;
            $applicant_address['plot_khasra_khatauni'] = $request->rplot_khasra_khatauni;
            $applicant_address['plot_khasra_khatauni_no'] = $request->rplot_khasra_khatauni_no;
            $applicant_address['pincode'] = $request->rpincode;
        }

        $applicant_detail = [ 
            'salutation' => $request->salutation,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no 
        ];

        $data = [
            'district_id' => $request->district_id,
            'applicant_detail' => json_encode($applicant_detail),
            'applicant_address' => json_encode($applicant_address)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_other_services_applications', ['application_no' => $request->application_no], $data);
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
    public function addOtherServicesOrganizingDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $organizing_address = [];
        $organizing_address['org_district_id'] = $request->org_district_id;
        $organizing_address['org_rural_urban'] = $request->org_rural_urban;
        if ($request->org_rural_urban == 'urban')
        {
            $organizing_address['org_tehsil_id'] = $request->org_tehsil_id;
            $organizing_address['org_street'] = $request->org_street;
            $organizing_address['org_landmark'] = $request->org_landmark;
            $organizing_address['org_city'] = $request->org_city;
            $organizing_address['org_plot_khasra_khatauni'] = $request->org_plot_khasra_khatauni;
            $organizing_address['org_plot_khasra_khatauni_no'] = $request->org_plot_khasra_khatauni_no;
            $organizing_address['org_pincode'] = $request->org_pincode;
        }
        elseif ($request->org_rural_urban == 'rural')
        {
            $organizing_address['org_block_id'] = $request->org_block_id;
            $organizing_address['org_panchayat_id'] = $request->org_panchayat_id;
            $organizing_address['org_village'] = $request->org_village;
            $organizing_address['org_landmark'] = $request->org_rlandmark;
            $organizing_address['org_plot_khasra_khatauni'] = $request->org_rplot_khasra_khatauni;
            $organizing_address['org_plot_khasra_khatauni_no'] = $request->org_rplot_khasra_khatauni_no;
            $organizing_address['org_pincode'] = $request->org_rpincode;
        }
        
        $organizing_address['latitude'] = $request->org_latitude;
        $organizing_address['longitude'] = $request->org_longitude;
        $data = [
            'organizing_address' => json_encode($organizing_address),
        ];

        $result = $this->commonModel->updateDataByOneCondition('temp_other_services_applications', ['application_no' => $request->application_no], $data);
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
    public function addOtherServicesOrganizerDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $orgnizer_contact_detail = [];
        $orgnizer_contact_detail['org_salutation'] = $request->org_salutation;
        $orgnizer_contact_detail['org_first_name'] = $request->org_first_name;
        $orgnizer_contact_detail['org_middle_name'] = $request->org_middle_name;
        $orgnizer_contact_detail['org_last_name'] = $request->org_last_name;
        $orgnizer_contact_detail['org_name'] = $request->org_name;
        $orgnizer_contact_detail['org_email'] = $request->org_email;
        $orgnizer_contact_detail['org_mobile_no'] = $request->org_mobile_no;
        $data = [
            'orgnizer_contact_detail' => json_encode($orgnizer_contact_detail)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_other_services_applications', ['application_no' => $request->application_no], $data);
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
    public function addOtherServicesErectorDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $erector_contact_detail = [];
        $erector_contact_detail['ere_salutation'] = $request->ere_salutation;
        $erector_contact_detail['ere_first_name'] = $request->ere_first_name;
        $erector_contact_detail['ere_middle_name'] = $request->ere_middle_name;
        $erector_contact_detail['ere_last_name'] = $request->ere_last_name;
        $erector_contact_detail['org_name'] = $request->ere_name;
        $erector_contact_detail['ere_email'] = $request->ere_email;
        $erector_contact_detail['ere_mobile_no'] = $request->ere_mobile_no;
        $data = [
            'erector_contact_detail' => json_encode($erector_contact_detail)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_other_services_applications', ['application_no' => $request->application_no], $data);
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
    public function addOtherServicesCoordinatorDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $coordinator_contact_detail = [];
        $coordinator_contact_detail['coor_salutation'] = $request->coor_salutation;
        $coordinator_contact_detail['coor_first_name'] = $request->coor_first_name;
        $coordinator_contact_detail['coor_middle_name'] = $request->coor_middle_name;
        $coordinator_contact_detail['coor_last_name'] = $request->coor_last_name;
        $coordinator_contact_detail['coor_email'] = $request->coor_email;
        $coordinator_contact_detail['coor_mobile_no'] = $request->coor_mobile_no;
        $data = [
            'coordinator_contact_detail' => json_encode($coordinator_contact_detail)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_other_services_applications', ['application_no' => $request->application_no], $data);
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
    public function addOtherServicesProjectDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $project_area_detail = [];

        $project_area_detail['total_plot_area'] = $request->total_plot_area;
        $project_area_detail['plot_area_unit'] = $request->plot_area_unit;
        $project_area_detail['total_covered_area'] = $request->total_covered_area;
        $project_area_detail['covered_area_unit'] = $request->covered_area_unit;
        $project_area_detail['function_type'] = $request->function_type;
        $project_area_detail['start_date'] = $request->start_date;
        $project_area_detail['end_date'] = $request->end_date;
        $project_area_detail['no_camps'] = $request->no_camps;
        $project_area_detail['no_stalls'] = $request->no_stalls;
        $project_area_detail['pro_kitchen'] = $request->pro_kitchen;
        $project_area_detail['boundary'] = $request->boundary;
        $project_area_detail['inflammable'] = $request->inflammable;
        $project_area_detail['inflamable_type'] = $request->inflamable_type;
        $project_area_detail['open_indoor'] = $request->open_indoor;
        $project_area_detail['seating_capacity'] = $request->seating_capacity;
        $project_area_detail['security_person'] = $request->security_person;
        $project_area_detail['road_width'] = $request->road_width;
        $project_area_detail['parking'] = $request->parking;
        $project_area_detail['no_entrance'] = $request->no_entrance;
        $project_area_detail['entrance_height'] = $request->entrance_height;
        $project_area_detail['entrance_width'] = $request->entrance_width;
        $project_area_detail['no_exit'] = $request->no_exit;
        $project_area_detail['exit_height'] = $request->exit_height;
        $project_area_detail['exit_width'] = $request->exit_width;
        $data = [
            'project_area_detail' => json_encode($project_area_detail)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_other_services_applications', ['application_no' => $request->application_no], $data);
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
    public function addOtherServicesAttachmentsDetails(Request $request)
    {
        $reference_letter = '';
        $route_plan = '';
        $fire_plan = '';
        $other_doc = '';
        if ($request->hasFile('reference_letter')) {
            $file = $request->file('reference_letter'); // Correctly get the file
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $fileName);
            $reference_letter = 'public/citizen/file/' . $fileName;
        }
    
        if ($request->hasFile('route_plan')) {
            $file = $request->file('route_plan'); // Correctly get the file
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $fileName);
            $route_plan = 'public/citizen/file/' . $fileName;
        }
        
        if ($request->hasFile('fire_plan')) {
            $file = $request->file('fire_plan'); // Correctly get the file
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $fileName);
            $fire_plan = 'public/citizen/file/' . $fileName;
        }
        
        
        if ($request->hasFile('other_doc')) {
            $file = $request->file('other_doc'); // Correctly get the file
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $fileName);
            $other_doc = 'public/citizen/file/' . $fileName;
        }
        
        $attachments = [
            'reference_letter' => $reference_letter,
            'route_plan' => $route_plan,
            'fire_plan' => $fire_plan,
            'other_doc' => $other_doc,
        ];
        $data = [
            'attachments' => json_encode($attachments)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_other_services_applications', ['application_no' => $request->application_no], $data);
        if($result == 1)
        {
            return ['status' => '1', 'msg' => 'Data saved successfully'];
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
}

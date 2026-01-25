<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;

class FireCrackersNocController extends Controller
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
        return view('citizen.temporary.fire_crackers.fire_crackers', compact('districts','tehsil','block','panchayat'));
            
    }

    public function addFireCrackersBasicDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $application_no = strtotime(now());
        $data = [
            'application_no' => $application_no,
            'user_id' => $user_id,
            'noc_type' => 'fire-crackers',
            'applicant_type' => $request->applicant_type,
            'status' => 'pending',
        ];
        $result = $this->commonModel->insertData('temp_fire_crackers_applications', $data);
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
    public function addFireCrackersApplicantDetails(Request $request)
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
        $result = $this->commonModel->updateDataByOneCondition('temp_fire_crackers_applications', ['application_no' => $request->application_no], $data);
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
    public function addFireCrackersOrganizingDetails(Request $request)
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

        $result = $this->commonModel->updateDataByOneCondition('temp_fire_crackers_applications', ['application_no' => $request->application_no], $data);
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
    public function addFireCrackersOrganizerDetails(Request $request)
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
        $result = $this->commonModel->updateDataByOneCondition('temp_fire_crackers_applications', ['application_no' => $request->application_no], $data);
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
    public function addFireCrackersErectorDetails(Request $request)
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
        $result = $this->commonModel->updateDataByOneCondition('temp_fire_crackers_applications', ['application_no' => $request->application_no], $data);
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
    public function addFireCrackersCoordinatorDetails(Request $request)
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
        $result = $this->commonModel->updateDataByOneCondition('temp_fire_crackers_applications', ['application_no' => $request->application_no], $data);
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
    public function addFireCrackersProjectDetails(Request $request)
    {
        $user_id = Auth::user()->id;
        $project_area_detail = [];

        $project_area_detail['from_date'] = $request->from_date;
        $project_area_detail['to_date'] = $request->to_date;
        $project_area_detail['capacity'] = $request->capacity;
        $project_area_detail['distance_from_nearest_petrol_pump'] = $request->distance_from_nearest_petrol_pump;
        $project_area_detail['shop_building'] = $request->shop_building;
        $project_area_detail['name_of_item'] = $request->name_of_item;
        $project_area_detail['other_detail'] = $request->other_detail;
        $data = [
            'project_area_detail' => json_encode($project_area_detail)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_fire_crackers_applications', ['application_no' => $request->application_no], $data);
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
    public function addFireCrackersAttachmentsDetails(Request $request)
    {
        $reference_letter = '';
        if ($request->hasFile('reference_letter')) {
            $file = $request->file('reference_letter'); // Correctly get the file
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $fileName);
            $reference_letter = 'public/citizen/file/' . $fileName;
        }
        
        $attachments = [
            'reference_letter' => $reference_letter
        ];
        $data = [
            'attachments' => json_encode($attachments)
        ];
        $result = $this->commonModel->updateDataByOneCondition('temp_fire_crackers_applications', ['application_no' => $request->application_no], $data);
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

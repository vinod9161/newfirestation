<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\DB;

class CommonController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function getCategoryByProject(Request $request)
    {
        $project_id = $request->input('project_id');
        $getCategory = $this->commonModel->getDataByTwoCondition('categories', array('project_id' => $project_id), array('status' => '1'));
        $output = "";
        $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
        foreach($getCategory as $key => $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
    }
    public function getSubcategoryByCategory(Request $request)
    {
        $category_id = $request->input('category_id');

        $getCategory = $this->commonModel->getDataByTwoCondition('sub_categories', array('category_id' => $category_id), array('status' => '1'));
        $output = "";
        $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
        foreach($getCategory as $key => $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
    }

    public function getSubCategoryByProject(Request $request)
    {
        $project_id = $request->input('project_id');
        $status=1;
        $getSubCategoryByProject = $this->commonModel->getSubCategoryByProject($project_id,$status);
        if(!empty($getSubCategoryByProject) && is_array($getSubCategoryByProject))
        {
            $resp = [
                'status' => 1,
                'data' => $getSubCategoryByProject
            ];
            return json_encode($resp);
        }
        else{
            $resp = [
                'status' => 0,
                'message' => 'No sub category available for this project'
            ];
            return json_encode($resp);
        }
    }


    public function getCategoryBySubCategory(Request $request)
    {
        $subcategory_id = $request->input('subcategory_id');
        $status=1;
        $getCategoryBySubCategory = $this->commonModel->getCategoryBySubCategory($subcategory_id,$status);
        if(!empty($getCategoryBySubCategory) && is_array($getCategoryBySubCategory))
        {
            $resp = [
                'status' => 1,
                'data' => $getCategoryBySubCategory
            ];
            return json_encode($resp);
        }
        else{
            $resp = [
                'status' => 0,
                'message' => 'No category available for this project'
            ];
            return json_encode($resp);
        }
    }

    public function getTypeBySubcategory(Request $request)
    {
        $subcategory_id = $request->input('subcategory_id');
        $getType = $this->commonModel->getDataByTwoCondition('types', array('subcategory_id' => $subcategory_id), array('status' => '1'));
        $output = "";
        if(!empty($getType))
        {
            $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
            foreach($getType as $key => $row)
            {
                $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
        }
        else
        {
            $output .= '<option value="">No Sub Type available for this subcategory</option>';
        }
        return $output;
    }
    public function getTehsilByDistrict(Request $request)
    {
        $district_id = $request->input('district_id');
        $dictrict_code = DB::table('districts')->where('id',$district_id)->value('district_code');
        $getTehsils = $this->commonModel->getDataByTwoCondition('tehsils', array('district_id' => $dictrict_code), array('status' => '1'));
        $output = "";
        $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
        foreach($getTehsils as $key => $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
    }
    
    public function getUrbanBodyByTehsil(Request $request)
    {
        $district_id = $request->input('district_id');
        $dictrict_code = DB::table('districts')->where('id',$district_id)->value('district_code');
        $getTehsils = $this->commonModel->getDataByTwoCondition('urban_bodies', array('district_code' => $dictrict_code), array('status' => '1'));
        $output = "";
        $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
        foreach($getTehsils as $key => $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->urban_body_name.'</option>';
        }
        return $output;
    }
    
    public function getWardByUrbanBody(Request $request)
    {
        $urban_body_id = $request->input('urban_body_id');
        $urban_body_code = DB::table('urban_bodies')->where('id',$urban_body_id)->value('urban_body_code');
        $getTehsils = $this->commonModel->getDataByTwoCondition('wards', array('urban_body_code' => $urban_body_code), array('status' => '1'));
        $output = "";
        $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
        foreach($getTehsils as $key => $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
    }

    // Admin Agency License
    public function indexAgencyLicense()
    {
        $tbl = 'agency_licence';
        $getagency = $this->commonModel->getData($tbl);
        return view('admin.common.agency_licence_list', compact('getagency'));
    }


    public function indexAgencyLicenceView($id)
    {
        $where = array('id' => $id);
        $licence = $this->commonModel->getDataByOneCondition('agency_licence',$where);
        return view('admin.Agency-License.view_agency_licence')->with('licence',$licence);
    }


    public function revertedAgencyLicence(Request $request){
        $where = array('id' => $request->id);
        $licence = $this->commonModel->getDataByOneCondition('agency_licence',$where);
        $data = array('status' => 'Reverted','remark' => $request->remark);
        $licence = $this->commonModel->getDataByOneCondition('agency_licence',$where,$data);
        if($licence){
            $this->commonModel->update($licence,$data);
        }
        return redirect()->back()->with('message', 'Agency Licence Reverted Successfully!');
    }


    // Admin Risk Auditor
    public function indexRiskAuditor()
    {
        $tbl = 'risk_auditor';
        $getriskauditor = $this->commonModel->getData($tbl);
        return view('admin.common.risk_auditor_list', compact('getriskauditor'));
    }


    // Admin Activities
    public function indexActivities()
    {
        return view('admin.common.activities');
    }

    public function indexRiskAuditorView($id)
    {
        $where = array('id' => $id);
        $auditor = $this->commonModel->getDataByOneCondition('risk_auditor',$where);
        return view('admin.Auditor.view_risk_auditor')->with('auditor',$auditor);
    }

    public function getBlockByDistrict(Request $request)
    {
        $district_id = $request->input('district_id');
        $getBlocks = $this->commonModel->getDataByTwoCondition('blocks', array('district_id' => $district_id), array('status' => '1'));
        $output = "";
        $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
        foreach($getBlocks as $key => $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
    }
    public function getPanchayatByBlock(Request $request)
    {
        $block_id = $request->input('block_id');
        $getPanchayats = $this->commonModel->getDataByTwoCondition('panchayats', array('block_id' => $block_id), array('status' => '1'));
        $output = "";
        $output .= '<option value="" style="dispaly:none;">Select An Option</option>';
        foreach($getPanchayats as $key => $row)
        {
            $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
        }
        return $output;
    }

    public function indexPeriodicEmployee()
    {
        return view('admin.common.periodic.employee');
    }

    public function indexPeriodicInspectionOfficers()
    {
        return view('admin.common.periodic.inspectionofficer');
    }

    public function indexPeriodicRewards()
    {
        return view('admin.common.periodic.rewards');
    }

    public function indexPeriodicPunishment()
    {
        return view('admin.common.periodic.punishment');
    }

    public function indexPeriodicCommunication()
    {
        return view('admin.common.periodic.communication');
    }

    public function indexPeriodicFireStations()
    {
        return view('admin.common.periodic.firestations');
    }

    public function indexPeriodicFireIncidents()
    {
        return view('admin.common.periodic.fireincidents');
    }

    public function indexPeriodicRescueIncidents()
    {
        return view('admin.common.periodic.rescueincidents');
    }

    public function indexPeriodicReliefIncidents()
    {
        return view('admin.common.periodic.reliefincidents');
    }

    public function indexPeriodicServiceDuties()
    {
        return view('admin.common.periodic.serviceduties');
    }

    public function indexPeriodicHydrants()
    {
        return view('admin.common.periodic.hydrants');
    }

    public function indexPeriodicAwarenessPrograms()
    {
        return view('admin.common.periodic.awareness');
    }

    public function indexPeriodicFireNoc()
    {
        return view('admin.common.periodic.firenoc');
    }

    public function indexPeriodicFireInspections()
    {
        return view('admin.common.periodic.fireinspections');
    }

    public function indexPeriodicFireVehicles()
    {
        return view('admin.common.periodic.firevehicles');
    }



    public function staffstrength()
    {
        $getData = $this->commonModel->getStaffStrength();
        return view('admin.CMS.staffstrength.view', compact('getData'));
    }


    public function addstaffstrength()
    {
        $getData = $this->commonModel->getData('districts');
        return view('admin.CMS.staffstrength.add', compact('getData'));
    }

    public function savestaffstrength(Request $request)
    {
        $messages = [
            'district.required'       => 'The district field is required.',
            'district.integer'        => 'The district must be a valid number.',
            'district.min'            => 'The district must be at least 0.',

            'cfo_accepted.required'   => 'Chief Fire Officer (CFO) accepted count is required.',
            'cfo_accepted.integer'    => 'Chief Fire Officer (CFO) accepted count must be a valid number.',
            'cfo_accepted.min'        => 'Chief Fire Officer (CFO) accepted count must be at least 0.',
            'cfo_available.required'  => 'Chief Fire Officer (CFO) available count is required.',
            'cfo_available.integer'   => 'Chief Fire Officer (CFO) available count must be a valid number.',
            'cfo_available.min'       => 'Chief Fire Officer (CFO) available count must be at least 0.',

            'fso_accepted.required'   => 'Fire Station Officer (FSO) accepted count is required.',
            'fso_accepted.integer'    => 'Fire Station Officer (FSO) accepted count must be a valid number.',
            'fso_accepted.min'        => 'Fire Station Officer (FSO) accepted count must be at least 0.',
            'fso_available.required'  => 'Fire Station Officer (FSO) available count is required.',
            'fso_available.integer'   => 'Fire Station Officer (FSO) available count must be a valid number.',
            'fso_available.min'       => 'Fire Station Officer (FSO) available count must be at least 0.',

            'fsso_accepted.required'  => 'Fire Station Second Officer (FSSO) accepted count is required.',
            'fsso_accepted.integer'   => 'Fire Station Second Officer (FSSO) accepted count must be a valid number.',
            'fsso_accepted.min'       => 'Fire Station Second Officer (FSSO) accepted count must be at least 0.',
            'fsso_available.required' => 'Fire Station Second Officer (FSSO) available count is required.',
            'fsso_available.integer'  => 'Fire Station Second Officer (FSSO) available count must be a valid number.',
            'fsso_available.min'      => 'Fire Station Second Officer (FSSO) available count must be at least 0.',

            'lf_accepted.required'    => 'Leading Fireman (LF) accepted count is required.',
            'lf_accepted.integer'     => 'Leading Fireman (LF) accepted count must be a valid number.',
            'lf_accepted.min'         => 'Leading Fireman (LF) accepted count must be at least 0.',
            'lf_available.required'   => 'Leading Fireman (LF) available count is required.',
            'lf_available.integer'    => 'Leading Fireman (LF) available count must be a valid number.',
            'lf_available.min'        => 'Leading Fireman (LF) available count must be at least 0.',

            'fm_accepted.required'    => 'Fireman (FM) accepted count is required.',
            'fm_accepted.integer'     => 'Fireman (FM) accepted count must be a valid number.',
            'fm_accepted.min'         => 'Fireman (FM) accepted count must be at least 0.',
            'fm_available.required'   => 'Fireman (FM) available count is required.',
            'fm_available.integer'    => 'Fireman (FM) available count must be a valid number.',
            'fm_available.min'        => 'Fireman (FM) available count must be at least 0.',

            'fsd_accepted.required'   => 'Fire Service Driver (FSD) accepted count is required.',
            'fsd_accepted.integer'    => 'Fire Service Driver (FSD) accepted count must be a valid number.',
            'fsd_accepted.min'        => 'Fire Service Driver (FSD) accepted count must be at least 0.',
            'fsd_available.required'  => 'Fire Service Driver (FSD) available count is required.',
            'fsd_available.integer'   => 'Fire Service Driver (FSD) available count must be a valid number.',
            'fsd_available.min'       => 'Fire Service Driver (FSD) available count must be at least 0.',
        ];

        $validator = Validator::make($request->all(), [
            'district'          => 'required|integer|min:0',
            'cfo_accepted'      => 'required|integer|min:0',
            'cfo_available'     => 'required|integer|min:0',
            'fso_accepted'      => 'required|integer|min:0',
            'fso_available'     => 'required|integer|min:0',
            'fsso_accepted'     => 'required|integer|min:0',
            'fsso_available'    => 'required|integer|min:0',
            'lf_accepted'       => 'required|integer|min:0',
            'lf_available'      => 'required|integer|min:0',
            'fm_accepted'       => 'required|integer|min:0',
            'fm_available'      => 'required|integer|min:0',
            'fsd_accepted'      => 'required|integer|min:0',
            'fsd_available'     => 'required|integer|min:0',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $district       = $request->input('district');
        $cfo_accepted   = $request->input('cfo_accepted');
        $cfo_available  = $request->input('cfo_available');
        $fso_accepted   = $request->input('fso_accepted');
        $fso_available  = $request->input('fso_available');
        $fsso_accepted  = $request->input('fsso_accepted');
        $fsso_available = $request->input('fsso_available');
        $lf_accepted    = $request->input('lf_accepted');
        $lf_available   = $request->input('lf_available');
        $fm_accepted    = $request->input('fm_accepted');
        $fm_available   = $request->input('fm_available');
        $fsd_accepted   = $request->input('fsd_accepted');
        $fsd_available  = $request->input('fsd_available');

        $tbl = 'staff_strength';
        $data = [
            'district_id'               => $district,
            'cfo_approve'               => $cfo_accepted,
            'cfo_available'             => $cfo_available,
            'fso_approve'               => $fso_accepted,
            'fso_available'             => $fso_available,
            'fsso_approve'              => $fsso_accepted,
            'fsso_available'            => $fsso_available,
            'leading_fireman_aprove'    => $lf_accepted,
            'leading_fireman_available' => $lf_available,
            'fs_driver_approve'         => $fsd_accepted,
            'fs_driver_available'       => $fsd_available,
            'fireman_approve'           => $fm_accepted,
            'fireman_available'         => $fm_available,
            'added_date'                => @date('Y-m-d H:i:s')
        ];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Staff Strength Added Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }

    }


    public function editstaffstrength($id)
    {
        $where = ['id'=>$id];
        $getval = $this->commonModel->getDataByOneCondition('staff_strength',$where)[0];
        $getData = $this->commonModel->getData('districts');
        return view('admin.CMS.staffstrength.edit', compact('getval','getData'));
    }

    public function updatestaffstrength(Request $request)
    {
        $messages = [
            'district.required'       => 'The district field is required.',
            'district.integer'        => 'The district must be a valid number.',
            'district.min'            => 'The district must be at least 0.',

            'cfo_accepted.required'   => 'Chief Fire Officer (CFO) accepted count is required.',
            'cfo_accepted.integer'    => 'Chief Fire Officer (CFO) accepted count must be a valid number.',
            'cfo_accepted.min'        => 'Chief Fire Officer (CFO) accepted count must be at least 0.',
            'cfo_available.required'  => 'Chief Fire Officer (CFO) available count is required.',
            'cfo_available.integer'   => 'Chief Fire Officer (CFO) available count must be a valid number.',
            'cfo_available.min'       => 'Chief Fire Officer (CFO) available count must be at least 0.',

            'fso_accepted.required'   => 'Fire Station Officer (FSO) accepted count is required.',
            'fso_accepted.integer'    => 'Fire Station Officer (FSO) accepted count must be a valid number.',
            'fso_accepted.min'        => 'Fire Station Officer (FSO) accepted count must be at least 0.',
            'fso_available.required'  => 'Fire Station Officer (FSO) available count is required.',
            'fso_available.integer'   => 'Fire Station Officer (FSO) available count must be a valid number.',
            'fso_available.min'       => 'Fire Station Officer (FSO) available count must be at least 0.',

            'fsso_accepted.required'  => 'Fire Station Second Officer (FSSO) accepted count is required.',
            'fsso_accepted.integer'   => 'Fire Station Second Officer (FSSO) accepted count must be a valid number.',
            'fsso_accepted.min'       => 'Fire Station Second Officer (FSSO) accepted count must be at least 0.',
            'fsso_available.required' => 'Fire Station Second Officer (FSSO) available count is required.',
            'fsso_available.integer'  => 'Fire Station Second Officer (FSSO) available count must be a valid number.',
            'fsso_available.min'      => 'Fire Station Second Officer (FSSO) available count must be at least 0.',

            'lf_accepted.required'    => 'Leading Fireman (LF) accepted count is required.',
            'lf_accepted.integer'     => 'Leading Fireman (LF) accepted count must be a valid number.',
            'lf_accepted.min'         => 'Leading Fireman (LF) accepted count must be at least 0.',
            'lf_available.required'   => 'Leading Fireman (LF) available count is required.',
            'lf_available.integer'    => 'Leading Fireman (LF) available count must be a valid number.',
            'lf_available.min'        => 'Leading Fireman (LF) available count must be at least 0.',

            'fm_accepted.required'    => 'Fireman (FM) accepted count is required.',
            'fm_accepted.integer'     => 'Fireman (FM) accepted count must be a valid number.',
            'fm_accepted.min'         => 'Fireman (FM) accepted count must be at least 0.',
            'fm_available.required'   => 'Fireman (FM) available count is required.',
            'fm_available.integer'    => 'Fireman (FM) available count must be a valid number.',
            'fm_available.min'        => 'Fireman (FM) available count must be at least 0.',

            'fsd_accepted.required'   => 'Fire Service Driver (FSD) accepted count is required.',
            'fsd_accepted.integer'    => 'Fire Service Driver (FSD) accepted count must be a valid number.',
            'fsd_accepted.min'        => 'Fire Service Driver (FSD) accepted count must be at least 0.',
            'fsd_available.required'  => 'Fire Service Driver (FSD) available count is required.',
            'fsd_available.integer'   => 'Fire Service Driver (FSD) available count must be a valid number.',
            'fsd_available.min'       => 'Fire Service Driver (FSD) available count must be at least 0.',
        ];

        $validator = Validator::make($request->all(), [
            'district'          => 'required|integer|min:0',
            'cfo_accepted'      => 'required|integer|min:0',
            'cfo_available'     => 'required|integer|min:0',
            'fso_accepted'      => 'required|integer|min:0',
            'fso_available'     => 'required|integer|min:0',
            'fsso_accepted'     => 'required|integer|min:0',
            'fsso_available'    => 'required|integer|min:0',
            'lf_accepted'       => 'required|integer|min:0',
            'lf_available'      => 'required|integer|min:0',
            'fm_accepted'       => 'required|integer|min:0',
            'fm_available'      => 'required|integer|min:0',
            'fsd_accepted'      => 'required|integer|min:0',
            'fsd_available'     => 'required|integer|min:0',
        ], $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $district       = $request->input('district');
        $cfo_accepted   = $request->input('cfo_accepted');
        $cfo_available  = $request->input('cfo_available');
        $fso_accepted   = $request->input('fso_accepted');
        $fso_available  = $request->input('fso_available');
        $fsso_accepted  = $request->input('fsso_accepted');
        $fsso_available = $request->input('fsso_available');
        $lf_accepted    = $request->input('lf_accepted');
        $lf_available   = $request->input('lf_available');
        $fm_accepted    = $request->input('fm_accepted');
        $fm_available   = $request->input('fm_available');
        $fsd_accepted   = $request->input('fsd_accepted');
        $fsd_available  = $request->input('fsd_available');
        $ssid           = $request->input('ssid');

        $tbl = 'staff_strength';
        $data = [
            'district_id'               => $district,
            'cfo_approve'               => $cfo_accepted,
            'cfo_available'             => $cfo_available,
            'fso_approve'               => $fso_accepted,
            'fso_available'             => $fso_available,
            'fsso_approve'              => $fsso_accepted,
            'fsso_available'            => $fsso_available,
            'leading_fireman_aprove'    => $lf_accepted,
            'leading_fireman_available' => $lf_available,
            'fs_driver_approve'         => $fsd_accepted,
            'fs_driver_available'       => $fsd_available,
            'fireman_approve'           => $fm_accepted,
            'fireman_available'         => $fm_available
        ];
        $where=['id'=>$ssid];
        $result = $this->commonModel->updateDataByOneCondition($tbl,$where,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Staff Strength Updated Successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    // dont use this controller
    public function test()
    {
        return view('admin.common.test');
    }

    // cms service order
    public function getserviceorder()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'establishment_service_order');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Services.serviceorder.index',compact('getData'));
    }

    public function serviceorderadd()
    {
        return view('admin.CMS.Services.serviceorder.add');
    }

    public function serviceorderedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Services.serviceorder.edit',compact('getData'));
    }

    public function serviceordersave(Request $request){
        // echo "trea"; die;
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);


        $data = [
            'page_name' => "establishment_service_order",
            'hadding' => $serviceName,
            'content' => "establishment service order",
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.serviceorder.add')->with('success', 'Service Order PDF Upload successfully.');
    }



    public function serviceorderupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');

        $card_image = $request->file('image');

        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile; 
        }

        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];

        $where = ['id' => $serviceId];

        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.getserviceorder')->with('success', 'Service Order PDF Update successfully.');
    }


    public function serviceorderdelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.getserviceorder')->with('success', 'Service Order PDF deleted successfully.');
    }

    // cms Public Articles
    public function getpublicarticle()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'activities_public_articles');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Activities.publicArticles.index',compact('getData'));
    }

    public function publicarticleadd()
    {
        return view('admin.CMS.Activities.publicArticles.add');
    }

    public function publicarticleedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Activities.publicArticles.edit',compact('getData'));
    }

    public function publicarticlesave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);


        $data = [
            'page_name' => "activities_public_articles",
            'hadding' => $serviceName,
            'content' => "activities public articles",
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.publicarticle.add')->with('success', 'Public Article PDF Upload successfully.');
    }



    public function publicarticleupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');

        $card_image = $request->file('image');

        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile; 
        }

        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];

        $where = ['id' => $serviceId];

        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.getpublicarticle')->with('success', 'Public Article PDF Update successfully.');
    }


    public function publicarticledelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.getpublicarticle')->with('success', 'Public Article PDF deleted successfully.');
    }


    // cms Recruitments
    public function getrecruitment()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'recruitment');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.Recruitment.index',compact('getData'));
    }

    public function recruitmentadd()
    {
        return view('admin.CMS.Academy.Recruitment.add');
    }

    public function recruitmentedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.Recruitment.edit',compact('getData'));
    }

    public function recruitmentsave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);


        $data = [
            'page_name' => "recruitment",
            'hadding' => $serviceName,
            'content' => "recruitment",
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.recruitment.add')->with('success', 'Recruitment PDF Upload successfully.');
    }



    public function recruitmentupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');

        $card_image = $request->file('image');

        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile; 
        }

        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];

        $where = ['id' => $serviceId];

        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.getrecruitment')->with('success', 'Recruitment PDF Update successfully.');
    }


    public function recruitmentdelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.getrecruitment')->with('success', 'Recruitment PDF deleted successfully.');
    }


    // cms History
    public function gethistory()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'academy_history');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.History.index',compact('getData'));
    }

    public function historyadd()
    {
        return view('admin.CMS.Academy.History.add');
    }

    public function historyedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.History.edit',compact('getData'));
    }

    public function historysave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);


        $data = [
            'page_name' => "academy_history",
            'hadding' => $serviceName,
            'content' => "history",
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.history.add')->with('success', 'History PDF Upload successfully.');
    }



    public function historyupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');

        $card_image = $request->file('image');

        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile; 
        }

        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];

        $where = ['id' => $serviceId];

        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.gethistory')->with('success', 'History PDF Update successfully.');
    }


    public function historydelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.gethistory')->with('success', 'History PDF deleted successfully.');
    }



    // cms Route map
    public function getroutemap()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'academy_routemap');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.Routemap.index',compact('getData'));
    }

    public function routemapadd()
    {
        return view('admin.CMS.Academy.Routemap.add');
    }

    public function routemapedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.Routemap.edit',compact('getData'));
    }

    public function routemapsave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);


        $data = [
            'page_name' => "academy_routemap",
            'hadding' => $serviceName,
            'content' => "routemap",
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.routemap.add')->with('success', 'Routemap PDF Upload successfully.');
    }



    public function routemapupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');

        $card_image = $request->file('image');

        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile; 
        }

        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];

        $where = ['id' => $serviceId];

        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.getroutemap')->with('success', 'Routemap PDF Update successfully.');
    }


    public function routemapdelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.getroutemap')->with('success', 'Routemap PDF deleted successfully.');
    }


    // cms Istitutional Structure
    public function getistitutionalstructure()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'academy_istitutionalstructure');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.IstitutionalStructure.index',compact('getData'));
    }

    public function istitutionalstructureadd()
    {
        return view('admin.CMS.Academy.IstitutionalStructure.add');
    }

    public function istitutionalstructureedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.IstitutionalStructure.edit',compact('getData'));
    }

    public function istitutionalstructuresave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);


        $data = [
            'page_name' => "academy_istitutionalstructure",
            'hadding' => $serviceName,
            'content' => "istitutionalstructure",
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.istitutionalstructure.add')->with('success', 'Institutional Structure PDF Upload successfully.');
    }



    public function istitutionalstructureupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');

        $card_image = $request->file('image');

        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile; 
        }

        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];

        $where = ['id' => $serviceId];

        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.getistitutionalstructure')->with('success', 'Institutional Structure PDF Update successfully.');
    }


    public function istitutionalstructuredelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.getistitutionalstructure')->with('success', 'Institutional Structure PDF deleted successfully.');
    }

    // cms Result
    public function getresult()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'result');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.Result.index',compact('getData'));
    }
 
    public function resultadd()
    {
        return view('admin.CMS.Academy.Result.add');
    }
 
    public function resultedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.Result.edit',compact('getData'));
    }
 
    public function resultsave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);
 
 
        $data = [
            'page_name' => "academy_result",
            'hadding' => $serviceName,
            'content' => "result",
            'image' => $card_image_name,
            'create_by' =>'',
        ];
 
        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.result.add')->with('success', 'Result PDF Upload successfully.');
    }
 
 
 
    public function resultupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');
 
        $card_image = $request->file('image');
 
        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile;
        }
 
        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];
 
        $where = ['id' => $serviceId];
 
        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.getresult')->with('success', 'Result PDF Update successfully.');
    }
 
 
    public function resultdelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.getresult')->with('success', 'Result PDF deleted successfully.');
    }

    // cms Traning schedule
    public function gettrainingschedule()
    {
        $tbl = "pages_card";
        $where = array('page_name' => 'traningschedule');
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.TraningSchedule.index',compact('getData'));
    }
 
    public function trainingscheduleadd()
    {
        return view('admin.CMS.Academy.TraningSchedule.add');
    }
 
    public function trainingscheduleedit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Academy.TraningSchedule.edit',compact('getData'));
    }
 
    public function trainingschedulesave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:pdf',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('fire/service'), $card_image_name);
 
 
        $data = [
            'page_name' => "academy_traningschedule",
            'hadding' => $serviceName,
            'content' => "traningschedule",
            'image' => $card_image_name,
            'create_by' =>'',
        ];
 
        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.trainingschedule.add')->with('success', 'Traning Schedule PDF Upload successfully.');
    }
 
 
 
    public function trainingscheduleupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
        ]);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $serviceId = $request->input('soid');
        $serviceOldFile = $request->input('oldFile');
 
        $card_image = $request->file('image');
 
        if(!empty($card_image))
        {
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('fire/service'), $card_image_name);
        }
        else{
            $card_image_name = $serviceOldFile;
        }
 
        $data = [
            'hadding' => $serviceName,
            'image' => $card_image_name,
        ];
 
        $where = ['id' => $serviceId];
 
        $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
        return redirect()->route('admin.gettrainingschedule')->with('success', 'Traning Schedule PDF Update successfully.');
    }
 
 
    public function trainingscheduledelete($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.gettrainingschedule')->with('success', 'Traning Schedule PDF deleted successfully.');
    }

     // cms Course
     public function getcourse()
     {
         $tbl = "pages_card";
         $where = array('page_name' => 'course');
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Academy.Course.index',compact('getData'));
     }
  
     public function courseadd()
     {
         return view('admin.CMS.Academy.Course.add');
     }
  
     public function courseedit($id)
     {
         $tbl = "pages_card";
         $where = array('id' => $id);
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Academy.Course.edit',compact('getData'));
     }
  
     public function coursesave(Request $request){
         $validator = Validator::make($request->all(), [
             'service_name' => 'required',
             'image'        => 'required|mimes:pdf',
         ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $card_image = $request->file('image');
         $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
         $card_image->move(public_path('fire/service'), $card_image_name);
  
  
         $data = [
             'page_name' => "academy_course",
             'hadding' => $serviceName,
             'content' => "course",
             'image' => $card_image_name,
             'create_by' =>'',
         ];
  
         $this->commonModel->insertData('pages_card',$data);
         return redirect()->route('admin.course.add')->with('success', 'Course PDF Upload successfully.');
     }
  
  
  
     public function courseupdate(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'service_name' => 'required',
         ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $serviceId = $request->input('soid');
         $serviceOldFile = $request->input('oldFile');
  
         $card_image = $request->file('image');
  
         if(!empty($card_image))
         {
             $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
             $card_image->move(public_path('fire/service'), $card_image_name);
         }
         else{
             $card_image_name = $serviceOldFile;
         }
  
         $data = [
             'hadding' => $serviceName,
             'image' => $card_image_name,
         ];
  
         $where = ['id' => $serviceId];
  
         $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
         return redirect()->route('admin.getcourse')->with('success', 'Course PDF Update successfully.');
     }
  
  
     public function coursedelete($id){
         $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
         return redirect()->route('admin.getcourse')->with('success', 'Course PDF deleted successfully.');
     }



     // cms noc document 
     public function getnocdocrequire()
     {
         $tbl = "pages_card";
         $where = array('page_name' => 'noc_Required_document_for_noc');
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Noc.Document.index',compact('getData'));
     }
  
     public function nocdocrequireadd()
     {
         return view('admin.CMS.Noc.Document.add');
     }
  
     public function nocdocrequireedit($id)
     {
         $tbl = "pages_card";
         $where = array('id' => $id);
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Noc.Document.edit',compact('getData'));
     }
  
     public function nocdocrequiresave(Request $request){
         $validator = Validator::make($request->all(), [
             'service_name' => 'required',
             'image'        => 'required|mimes:pdf',
         ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $card_image = $request->file('image');
         $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
         $card_image->move(public_path('fire/service'), $card_image_name);
  
  
         $data = [
             'page_name' => "noc_Required_document_for_noc",
             'hadding' => $serviceName,
             'content' => "nocdocrequire",
             'image' => $card_image_name,
             'create_by' =>'',
         ];
  
         $this->commonModel->insertData('pages_card',$data);
         return redirect()->route('admin.nocdocrequire.add')->with('success', 'Noc Document PDF Upload successfully.');
     }
  
  
  
     public function nocdocrequireupdate(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'service_name' => 'required',
         ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $serviceId = $request->input('soid');
         $serviceOldFile = $request->input('oldFile');
  
         $card_image = $request->file('image');
  
         if(!empty($card_image))
         {
             $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
             $card_image->move(public_path('fire/service'), $card_image_name);
         }
         else{
             $card_image_name = $serviceOldFile;
         }
  
         $data = [
             'hadding' => $serviceName,
             'image' => $card_image_name,
         ];
  
         $where = ['id' => $serviceId];
  
         $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
         return redirect()->route('admin.getnocdocrequire')->with('success', 'Noc Document PDF Update successfully.');
     }
  
  
     public function nocdocrequiredelete($id){
         $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
         return redirect()->route('admin.getnocdocrequire')->with('success', 'Noc Document PDF deleted successfully.');
    }
    
    

     // cms Checklist
     public function getchecklist()
     {
         $tbl = "pages_card";
         $where = array('page_name' => 'noc_checklist');
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Noc.Checklist.index',compact('getData'));
     }
  
     public function checklistadd()
     {
         return view('admin.CMS.Noc.Checklist.add');
     }
  
     public function checklistedit($id)
     {
         $tbl = "pages_card";
         $where = array('id' => $id);
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Noc.Checklist.edit',compact('getData'));
     }
  
     public function checklistsave(Request $request){
         $validator = Validator::make($request->all(), [
             'service_name' => 'required',
             'image'        => 'required|mimes:pdf',
         ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $card_image = $request->file('image');
         $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
         $card_image->move(public_path('fire/service'), $card_image_name);
  
  
         $data = [
             'page_name' => "noc_checklist",
             'hadding' => $serviceName,
             'content' => "checklist",
             'image' => $card_image_name,
             'create_by' =>'',
         ];
  
         $this->commonModel->insertData('pages_card',$data);
         return redirect()->route('admin.checklist.add')->with('success', 'Checklist PDF Upload successfully.');
     }
  
  
  
     public function checklistupdate(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'service_name' => 'required',
         ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $serviceId = $request->input('soid');
         $serviceOldFile = $request->input('oldFile');
  
         $card_image = $request->file('image');
  
         if(!empty($card_image))
         {
             $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
             $card_image->move(public_path('fire/service'), $card_image_name);
         }
         else{
             $card_image_name = $serviceOldFile;
         }
  
         $data = [
             'hadding' => $serviceName,
             'image' => $card_image_name,
         ];
  
         $where = ['id' => $serviceId];
  
         $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
         return redirect()->route('admin.getchecklist')->with('success', 'Checklist PDF Update successfully.');
     }
  
  
     public function checklistdelete($id){
         $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
         return redirect()->route('admin.getchecklist')->with('success', 'Checklist PDF deleted successfully.');
     }




     // cms banner slider
     public function getbannerslider()
     {
         $tbl = "pages_card";
         $where = array('page_name' => 'home_banner_slider');
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Banner.index',compact('getData'));
     }
  
     public function bannerslideradd()
     {
         return view('admin.CMS.Banner.add');
     }
  
     public function bannerslideredit($id)
     {
         $tbl = "pages_card";
         $where = array('id' => $id);
         $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
         return view('admin.CMS.Banner.edit',compact('getData'));
     }
  
     public function bannerslidersave(Request $request){
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image'        => 'required|mimes:jpg,jpeg,png,gif,webp',
        ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $card_image = $request->file('image');
         $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
         $card_image->move(public_path('fire/service'), $card_image_name);
  
  
         $data = [
             'page_name' => "home_banner_slider",
             'hadding' => $serviceName,
             'content' => "Welcome to",
             'image' => $card_image_name,
             'create_by' =>'',
         ];
  
         $this->commonModel->insertData('pages_card',$data);
         return redirect()->route('admin.bannerslider.add')->with('success', 'Banner slider Upload successfully.');
     }
  
  
  
     public function bannersliderupdate(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'service_name' => 'required',
         ]);
  
         if ($validator->fails()) {
             return redirect()->back()->withErrors($validator)->withInput();
         }
         $serviceName = $request->input('service_name');
         $serviceId = $request->input('soid');
         $serviceOldFile = $request->input('oldFile');
  
         $card_image = $request->file('image');
  
         if(!empty($card_image))
         {
             $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
             $card_image->move(public_path('fire/service'), $card_image_name);
         }
         else{
             $card_image_name = $serviceOldFile;
         }
  
         $data = [
             'hadding' => $serviceName,
             'image' => $card_image_name,
         ];
  
         $where = ['id' => $serviceId];
  
         $this->commonModel->updateDataByOneCondition('pages_card',$where,$data);
         return redirect()->route('admin.getbannerslider')->with('success', 'Banner slider  Update successfully.');
     }
  
  
     public function bannersliderdelete($id){
         $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
         return redirect()->route('admin.getbannerslider')->with('success', 'Banner slider deleted successfully.');
    }


    // cms Welfare and Amenity Fund
    public function getwelfareamenity()
    {
        $tbl = 'fs_walfare_amenity';
        $getData = $this->commonModel->getData($tbl);
        return view('admin.CMS.Welfare.index',compact('getData'));
    }
 
    public function welfareamenityadd()
    {
        $userId = Auth::user()->id;
        return view('admin.CMS.Welfare.add', compact('userId'));
    }
 
    public function welfareamenityedit($id)
    {
        $tbl = "fs_walfare_amenity";
        $where = array('id' => $id);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);
        $userId = Auth::user()->id;
        return view('admin.CMS.Welfare.edit',compact('getData','userId'));
    }
 
    public function welfareamenitysave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number'  => 'required',
            'date'    => 'required',
            'type'    => 'required',
            'title'   => 'required|string|max:1024',
            'subject' => 'required|string|max:1024',
            'file'    => 'required|file|mimes:pdf',
            'id'      => 'required|integer',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $number     = $request->input('number');
        $date       = $request->input('date');
        $type       = $request->input('type');
        $title      = $request->input('title');
        $subject    = $request->input('subject');
        $userId     = $request->input('id');

        $WalfareFile = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('fire/service'), $imageName);
            $WalfareFile = 'public/fire/service/' . $imageName;
        } 
        else 
        {
            return redirect()->back()->with('failed', 'File upload failed. Please try again.');
        }

        $tbl = 'fs_walfare_amenity';
        $data = [
            'number'    => $number,
            'title'     => $title,
            'user_id'   => $userId,
            'type'      => $type,
            'subject'   => $subject,
            'file'      => $WalfareFile,
            'date'      => $date
        ];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Walfare Amenity Added Successfully');
        }
        else
        {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }

    }
 


    public function welfareamenityupdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'number'  => 'required',
            'date'    => 'required',
            'type'    => 'required',
            'title'   => 'required|string|max:1024',
            'subject' => 'required|string|max:1024',
            'wfid'    => 'required|integer',
        ]);

        if ($validator->fails()) 
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $wfid       = $request->input('wfid');
        $number     = $request->input('number');
        $date       = $request->input('date');
        $type       = $request->input('type');
        $title      = $request->input('title');
        $subject    = $request->input('subject');

        $tbl = "fs_walfare_amenity";
        $where = array('id' => $wfid);
        $getData = $this->commonModel->getDataByOneCondition($tbl,$where);


        if (!$getData) {
            return redirect()->back()->with('failed', 'Record not found.');
        }

        $WalfareFile = ''; 
       

        if ($request->hasFile('file')) 
        {
            $file = $request->file('file');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('fire/service'), $imageName);
            $WalfareFile = 'public/fire/service/' . $imageName;
            

            // Optional: delete old file if needed
            if (file_exists(public_path(str_replace('public/', '', $getData[0]->file)))) {
                unlink(public_path(str_replace('public/', '', $getData[0]->file)));
            }
        }
        else{
            $WalfareFile = $getData[0]->file; 
        }

        $data = [
            'number'    => $number,
            'title'     => $title,
            'type'      => $type,
            'subject'   => $subject,
            'file'      => $WalfareFile,
            'date'      => $date
        ];
        $result = $this->commonModel->updateDataByOneCondition($tbl,$where,$data);

        if ($result) {
            return redirect()->back()->with('success', 'Walfare Amenity Updated Successfully');
        }
        else {
            return redirect()->back()->with('failed', 'Something Went Wrong, Try Later!');
        }
    }

 
    public function welfareamenitydelete($id)
    {
        $this->commonModel->deleteDataByOneCondition('fs_walfare_amenity', array('id'=>$id));
        return redirect()->route('admin.getwelfareamenity')->with('success', 'Walfare amenity deleted successfully.');
    }


    public function getCategoriesByProject(Request $request)
    {
        $categories = DB::table('categories')
            ->where('project_id', $request->project_id)
            ->orderBy('name')
            ->get();

        return response()->json($categories);
    }

    public function getSubCategories(Request $request)
    {
        $sub = DB::table('sub_categories')
            ->where('category_id', $request->category_id)
            ->orderBy('name')
            ->get();

        return response()->json($sub);
    }

    public function getSubCategoriesByProject(Request $request)
    {
        $sub = DB::table('sub_categories')
            ->where('project_id', $request->project_id)
            ->orderBy('name')
            ->get();

        return response()->json($sub);
    }

    public function getCategoriesBySubCategory(Request $request)
    {
        $cat = DB::table('categories')
            ->join('sub_categories', 'categories.id', '=', 'sub_categories.category_id')
            ->where('sub_categories.id', $request->subcategory_id)
            ->select('categories.id', 'categories.name')
            ->get();

        return response()->json($cat);
    }

    public function getOccupancyInputType(Request $request)
    {
        $rule = DB::table('occupancy_input_types')
            ->where('project_id', $request->project_id)
            ->where('category_id', $request->category_id)
            ->where('sub_category_id', $request->sub_category_id)
            ->first();

        if (!$rule) {
            return response()->json(null);
        }

        return response()->json([
            'input_type' => $rule->input_type,
            'caption' => $rule->caption,
            'options_json' => json_decode($rule->options_json ?? '[]', true)
        ]);
    }
}

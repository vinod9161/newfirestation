<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ReliefReportModel;
use App\Models\Models\Station;
use App\Models\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Models\Common\CommonModel;
use Carbon\Carbon;


class TemporaryNocController extends Controller{

    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
        $this->db  = DB::getFacadeRoot();
    }

    public function indexTemporaryNoc(Request $request)
    {
        return view('admin.temporary_noc.home_temporary_noc');
    }
    public function listTemporaryNoc(Request $request, $type)
    {
        
        if($type =='pandal')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_pandal_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_pandal_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_pandal_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_pandal_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_pandal_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='public-function')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_public_function_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_public_function_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_public_function_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_public_function_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_public_function_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='entertainment-activity')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_entertainment_activity_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_entertainment_activity_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_entertainment_activity_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_entertainment_activity_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_entertainment_activity_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='film-shooting')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_film_shooting_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_film_shooting_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_film_shooting_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_film_shooting_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_film_shooting_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='games')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_games_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_games_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_games_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_games_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_games_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='helipad')
        {           
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_helipad_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_helipad_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_helipad_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_helipad_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_helipad_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='kerosene')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_kerosene_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_kerosene_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_kerosene_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_kerosene_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_kerosene_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='fire-crackers')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_fire_crackers_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_fire_crackers_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_fire_crackers_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_fire_crackers_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_fire_crackers_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='transportation')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_transportation_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_transportation_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_transportation_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_transportation_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_transportation_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        elseif($type =='other-services')
        {
            if(Auth::user()->type == 3)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_other_services_applications', array('assigned_id' => Auth::user()->id));
            }
            else if(Auth::user()->type == 0 || Auth::user()->type == 1)
            {
                $application  = $this->commonModel->getData('temp_other_services_applications');;
            }
            else if(Auth::user()->type == 4)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_other_services_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 2)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_other_services_applications', array('district_id' => Auth::user()->district_id));
            }
            else  if(Auth::user()->type == 5)
            {
                $application  = $this->commonModel->getDataByOneCondition('temp_other_services_applications', array('district_id' => Auth::user()->district_id));
            }
        }
        else
        {
            $application  = "";
        }
        
        $districts = $this->commonModel->getDataByOneCondition('districts',array('status' => '1'));
        return view('admin.temporary_noc.list_temporary_noc',compact('application','type','districts'));
    }
    public function viewTemporaryNocDetail($type,$id)
    {
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('status' => '1'));
        $users = $this->commonModel->getDataByOneCondition('users',array('type' => '3'));
        $districts = $this->commonModel->getDataByOneCondition('districts',array('status' => '1'));
        $tehsils = $this->commonModel->getDataByOneCondition('tehsils',array('status' => '1'));
        $block = $this->commonModel->getDataByOneCondition('blocks',array('status' => '1'));
        $remarks = $this->commonModel->getDataByOneCondition('remarks',array('status' => '1'));
        if($type =='pandal')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_pandal_applications', array('id' => $id));
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='public-function')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_public_function_applications', array('id' => $id));
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='entertainment-activity')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_entertainment_activity_applications', array('id' => $id));
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='film-shooting')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_film_shooting_applications', array('id' => $id));
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='games')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_games_applications', array('id' => $id));
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='helipad')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_helipad_applications', array('id' => $id));
            return view('admin.temporary_noc.view_helipad_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='kerosene')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_kerosene_applications', array('id' => $id));
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='fire-crackers')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_fire_crackers_applications', array('id' => $id));
            return view('admin.temporary_noc.view_fire_crackers_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='transportation')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_transportation_applications', array('id' => $id));
            return view('admin.temporary_noc.view_transportation_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        elseif($type =='other-services')
        {
            $applicationDetail  = $this->commonModel->getDataByOneCondition('temp_other_services_applications', array('id' => $id));
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','users','station'));
        }
        else
        {
            $applicationDetail  = "";
            return view('admin.temporary_noc.view_temporary_noc',compact('applicationDetail','districts','tehsils','block','remarks','station'));
        }
    }
    public function temporaryAddPhysicalInsPost(Request $request)
    {
        $user = Auth::user();
        $inspection_detail = [];
        $inspection_detail['high_tension_line_pass'] = $request->high_tension_line_pass;
        if($request->high_tension_line_pass =='yes')
        {
            $inspection_detail['safety_distance'] = $request->safety_distance;
            $inspection_detail['distance'] = $request->distance;
        }
        $inspection_detail['fire_fighting'] = $request->fire_fighting;
        $inspection_detail['high_inflammable'] = $request->high_inflammable;
        if($request->high_inflammable =='yes')
        {
           $inspection_detail['detail'] = $request->detail; 
        }
        $inspection_detail['other'] = $request->other;
        $inspection_detail['specific_requirement_one'] = $request->specific_requirement_one;
        $inspection_detail['specific_requirement_two'] = $request->specific_requirement_two;
        $data['physical_inspection_detail']  = json_encode($inspection_detail);
        if($request->noc_type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($request->noc_type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($request->noc_type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($request->noc_type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($request->noc_type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($request->noc_type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($request->noc_type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($request->noc_type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($request->noc_type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($request->noc_type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $result = $this->db->table($tbl)->where(array('application_no'=>$request->application_no))->update($data);
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
    public function temporaryNocAssignedNocToFSO(Request $request)
    {
        if($request->noc_type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($request->noc_type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($request->noc_type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($request->noc_type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($request->noc_type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($request->noc_type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($request->noc_type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($request->noc_type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($request->noc_type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($request->noc_type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        $data = [
            'assigned_id' => $request->assigned_id,
            'status' => 'processed'
        ];
        $result = $this->db->table($tbl)->where(array('application_no'=>$request->application_no))->update($data);
        if($result == 1)
        {
            return ['status' => '1', 'msg' => 'Application has been Assined to FSO Successfully!'];
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to assigned'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Application has not been Assined to FSO!'];
        }
    }
    public function temporaryNocApplicationForApprovalPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->noc_type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($request->noc_type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($request->noc_type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($request->noc_type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($request->noc_type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($request->noc_type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($request->noc_type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($request->noc_type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($request->noc_type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($request->noc_type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        $data = [
            'status' => 'for approval',
            'sfo_signature' => $user->signature,
            'fso_approve_date' => Carbon::now(),
            'fso_name' => $user->name
        ];
        $result = $this->db->table($tbl)->where(array('application_no'=>$request->application_no))->update($data);
        if($result == 1)
        {
            return ['status' => '1', 'msg' => 'Data updated successfully'];
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
        }       
    }
    public function temporaryNocApplicationApprovePost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();

        if($request->noc_type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($request->noc_type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($request->noc_type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($request->noc_type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($request->noc_type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($request->noc_type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($request->noc_type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($request->noc_type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($request->noc_type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($request->noc_type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        $data = [
            'status' => 'approved',
            'cfo_signature' => $user->signature,
            'cfo_approve_date' => Carbon::now(),
            'cfo_name' => Auth::user()->name
        ];
        $result = $this->db->table($tbl)->where(array('application_no'=>$request->application_no))->update($data);
        if($result == 1)
        {
            // Apuni Sarkar Update API 
            // if($application->status == 'approved')
            // {
            //     try
            //     {
            //         $user = User::where('id', $request->user_id)->first();
            //         $client = new Client([
            //             'auth' => ['homedepartment', 'homedepartment@BdwDZ9a2s5IWHuFl40xSnBE7cHmwDlEg']
            //         ]);
            //         $params['form_params'] = array('thirdPartyApplicationId' => $request->id, 'serviceId' => json_decode($user->apuni_sarkar_response)->service->id, 'userId' => json_decode($user->apuni_sarkar_response)->user->_id, 'status' => 'Approved');
            //         $res = $client->post('https://eservices.uk.gov.in/api/home-department-integration/application/update',$params);
            //         if($res->getStatusCode() == 200 || $res->getStatusCode() == 201)
            //         {
            //             return ['status' => '1', 'msg' => 'Data updated successfully'];      
            //         }
            //         else if($res->getStatusCode() == 400)
            //         {
            //             return ['status' => '0', 'msg' => 'Something went wromg, Please try again!'];
            //         }
            //     }
            //     catch(\Exception $e)
            //     {
            //         return ['status' => '0', 'msg' => 'Something went wromg, Please try again!'];
            //     }
            // }
            // else
            // {
            //     return ['status' => '0', 'msg' => 'Something went wromg, Please try again!'];
            // }
            return ['status' => '1', 'msg' => 'Data updated successfully']; 
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
        }   
    }
    public function temporaryNocApplicationRejectPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if($request->noc_type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($request->noc_type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($request->noc_type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($request->noc_type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($request->noc_type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($request->noc_type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($request->noc_type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($request->noc_type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($request->noc_type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($request->noc_type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        $data = [
            'status' => 'rejected',
            'cfo_signature' => $user->signature,
            'cfo_approve_date' => Carbon::now(),
            'cfo_name' => Auth::user()->name
        ];
        $result = $this->db->table($tbl)->where(array('application_no'=>$request->application_no))->update($data);
        if($result == 1)
        {
            // Apuni Sarkar Update API 
            // if($request->status == 'rejected')
            // {
            //     try{
            //         $user = User::where('id', $request->user_id)->first();
            //         $client = new Client([
            //             'auth' => ['homedepartment', 'homedepartment@BdwDZ9a2s5IWHuFl40xSnBE7cHmwDlEg']
            //         ]);
            //         $params['form_params'] = array('thirdPartyApplicationId' => $request->id, 'serviceId' => json_decode($user->apuni_sarkar_response)->service->id, 'userId' => json_decode($user->apuni_sarkar_response)->user->_id, 'status' => 'Rejected');
            //         $res = $client->post('https://eservices.uk.gov.in/api/home-department-integration/application/update',$params);
            //         if($res->getStatusCode() == 200 || $res->getStatusCode() == 201)
            //         {
            //             return ['status' => '1', 'msg' => 'Application Rejected Successfully!'];        
            //         }
            //         else if($res->getStatusCode() == 400)
            //         {
            //             return ['status' => '0', 'msg' => 'message','Something went wromg, Please try again!'];
            //         }
            //     }
            //     catch(\Exception $e)
            //     {
            //         return ['status' => '0', 'msg' => 'message','Something went wromg, Please try again!'];
            //     }
            // }
            // else
            // {
            //     return ['status' => '0', 'msg' => 'message','Something went wromg, Please try again!'];
            // }
            return ['status' => '1', 'msg' => 'Application Rejected Successfully!'];   
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
        }  
    }
    public function temporaryNocRevertNocPost(Request $request)
    {
        if($request->noc_type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($request->noc_type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($request->noc_type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($request->noc_type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($request->noc_type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($request->noc_type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($request->noc_type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($request->noc_type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($request->noc_type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($request->noc_type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));
        $revert = [];
        $reverts = [];
        $reverts['revert'] = $request->revert;
        $reverts['date'] = date('m/d/Y h:i:s a', time());
        $reverts['reason'] = $request->reason;
        if(empty($application[0]->revert))
        {     
          $revert[] = $reverts;
        }
        else
        {
            $revert = json_decode($application[0]->revert,true);
            $revert[] = $reverts;
        }
        $data = [
            'status' => 'processed',
            'revert' => json_encode($revert)
        ];
        $result = $this->db->table($tbl)->where(array('application_no'=>$request->application_no))->update($data);
        if($result == 1)
        {
            // Apuni Sarkar Update API 
            // if($application->status == 'processed')
            // {
            //     try{
            //         $user = User::where('id', $application->user_id)->first();
            //         $client = new Client([
            //             'auth' => ['homedepartment', 'homedepartment@BdwDZ9a2s5IWHuFl40xSnBE7cHmwDlEg']
            //         ]);
            //         $params['form_params'] = array('thirdPartyApplicationId' => $application->id, 'serviceId' => json_decode($user->apuni_sarkar_response)->service->id, 'userId' => json_decode($user->apuni_sarkar_response)->user->_id, 'status' => 'Rejected');
            
            //         $res = $client->post('https://eservices.uk.gov.in/api/home-department-integration/application/update',$params);
            
            //         if($res->getStatusCode() == 200 || $res->getStatusCode() == 201)
            //         {
            //             return back()->with('application',$application)->with("message","Application Reverted Back to Citizen!"); 
            //         }else if($res->getStatusCode() == 400){
            //             return back()->with('error','Something went wromg, Please try again!');
            //         }
            //     }catch(\Exception $e){
            //         return back()->with('error','Something went wromg, Please try again!');
            //     }
            // }else{
            //     return back()->with('error','Something went wromg, Please try again!');
            // }
        // /Apuni Sarkar Update API
        
            return ['status' => '1', 'msg' => 'Application Reverted Back to Citizen!'];   
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
        }  
    }
    public function downloadTemporaryNoc($type,$id)
    {
        $user = Auth::user();
        if($type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $applicationDetail = $this->commonModel->getDataByOneCondition($tbl, array('id' => $id));
        $cfo = $this->commonModel->getDataByTwoCondition('users', array('district_id' => $applicationDetail[0]->district_id), array('type' => '2'));
        $fso = $this->commonModel->getDataByTwoCondition('users', array('id' => $applicationDetail[0]->assigned_id), array('type' => '3'));
        $dd = $this->commonModel->getDataByOneCondition('users', array('type' => '1'));
        $districts = $this->commonModel->getDataByOneCondition('districts',array('status' => '1'));
        $tehsils = $this->commonModel->getDataByOneCondition('tehsils',array('status' => '1'));
        $block = $this->commonModel->getDataByOneCondition('blocks',array('status' => '1'));
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('status' => '1'));
        $remarks = $this->commonModel->getDataByOneCondition('remarks',array('status' => '1'));
        return view('admin.temporary_noc.download',compact('applicationDetail','districts','tehsils','block','remarks','station', 'type'));
    }
    public function temporaryNocRemark(Request $request)
    {

        $user = Auth::user();
        $data = $request->all();

        if($request->noc_type =='pandal')
        {
            $tbl  = 'temp_pandal_applications';
        }
        elseif($request->noc_type =='public-function')
        {
            $tbl  = 'temp_public_function_applications';
        } 
        elseif($request->noc_type =='entertainment-activity')
        {
            $tbl  = 'temp_entertainment_activity_applications';
        } 
        elseif($request->noc_type =='film-shooting')
        {
            $tbl  = 'temp_film_shooting_applications';
        } 
        elseif($request->noc_type =='games')
        {
            $tbl  = 'temp_games_applications';
        } 
        elseif($request->noc_type =='helipad')
        {
            $tbl  = 'temp_helipad_applications';
        } 
        elseif($request->noc_type =='kerosene')
        {
            $tbl  = 'temp_kerosene_applications';
        } 
        elseif($request->noc_type =='fire-crackers')
        {
            $tbl  = 'temp_fire_crackers_applications';
        }
        elseif($request->noc_type =='transportation')
        {
            $tbl  = 'temp_transportation_applications';
        } 
        elseif($request->noc_type =='other-services')
        {
            $tbl  = 'temp_other_services_applications';
        } 
        $application = $this->commonModel->getDataByOneCondition($tbl, array('application_no' => $request->application_no));

        $remark = [];
        $remarks = [];
        $remarks['remark'] = $request->remark;
        $remarks['date'] = date('m/d/Y h:i:s a', time());

        $remarks['reason'] = json_encode($request->remark_reason);

        if(empty($application[0]->remark))
        {      
            $remark[] = $remarks;
        }
        else
        {
            $remark = json_decode($application[0]->remark);
            $remark[] = $remarks;
        }

        $data = [
            'remark' => json_encode($remark)
        ];
        $result = $this->db->table($tbl)->where(array('application_no'=>$request->application_no))->update($data);
        if($result == 1)
        {
            return ['status' => '1', 'msg' => 'Application Rejected Successfully!'];   
        }
        else if ($result == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
        } 
    }
}
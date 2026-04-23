<?php

namespace App\Http\Controllers\Admin\Activities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\District;
use App\Models\Models\Station;
use App\Models\Models\Category;
use App\Models\Activities\InspectionByOfficer;
use App\Models\Models\RewardPunishment;
use App\Models\Models\FireInspection;
use App\Models\Employee;
use App\Models\State;
use App\Models\User;
use Auth;
use Validator;
use Illuminate\Support\Carbon;

use App\Models\Common\CommonModel;

class InspectionController extends Controller
{
    protected $commonModel;
    public function __construct(){
        //  $this->middleware('auth');
        $this->commonModel = new CommonModel;
    }

    public function inspectionByOfficer()
    {
        if(Auth::user()->type == 2)
        {
            $inspection = InspectionByOfficer::where('district_id', Auth::user()->district_id)->orderBy('id', 'desc')->get();
        }else if(Auth::user()->type == 3){
            $inspection = InspectionByOfficer::where('station_id', Auth::user()->station_id)->orderBy('id', 'desc')->get();
        }else{
            $inspection = InspectionByOfficer::with('district','station')->orderBy('id', 'desc')->get();
        }
        return view('admin.Activities.InspectionByOfficer.index')->with('inspection',$inspection);
    }

    public function addInspectionByOfficer(){
        $fso_station = Station::where('id', '=', Auth::user()->station_id)->first();
        // echo "<pre>";
        // print_r($fso_station->toarray()); exit;
        if(Auth::user()->type == 1 || Auth::user()->type == 0)
        {
            $district = $this->commonModel->getData('districts');
        }
        else
        {
            $district = $this->commonModel->getDataByOneCondition('districts', array('id' => Auth::user()->district_id));
        }
        return view('admin.Activities.InspectionByOfficer.add', [
            'districts' => $district,
            'categories' => Category::all(),
            'fso_station' =>$fso_station,
        ]);
    }

    public function addInspectionByOfficerPost(Request $request){

        InspectionByOfficer::create($request->all());

        return redirect('admin/inspection-by-officer')->with('message', 'Inspection By Officer Created Successfully!');
    }

    public function viewInspectionByOfficer($id)
    {
        if(Auth::user()->type == 1 || Auth::user()->type == 0)
        {
            $district = $this->commonModel->getData('districts');
        }
        else
        {
            $district = $this->commonModel->getDataByOneCondition('districts', array('id' => Auth::user()->district_id));
        }
        $inspection  = InspectionByOfficer::with('district','station')->where('id', '=', $id)->first();

        $users = User::where('type', '=', '3')->get();

        // echo "<pre>";
        // print_r($inspection->toarray()); exit;
        $station_id = $inspection->station_id;
        $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $station_id));
        return view('admin.Activities.InspectionByOfficer.view')->with('inspection',$inspection)->with('users',$users)->with('district',$district)->with('station',$station);
    }

    public function deleteInspectionByOfficer($id){

        $delete = InspectionByOfficer::where('id', '=', $id)->delete();

        return redirect()->back()->with('message', 'Inspection By Officer Deleted Successfully!');
    }


    public function rewardPanishment()
    {
        if(Auth::user()->type == 2)
        {
            $reward = RewardPunishment::where('district_id', Auth::user()->district_id)->orderBy('id', 'desc')->get();
        }else if(Auth::user()->type == 3){
            $reward = RewardPunishment::where('station_id', Auth::user()->station_id)->orderBy('id', 'desc')->get();
        }else{
            $reward = RewardPunishment::with('district','station')->orderBy('id', 'desc')->get();
        }
        return view('admin.Activities.rewardPunishment.index')->with('reward',$reward);
    }

    public function addRewardPanishment()
    {
        $commonModel = new CommonModel();
        $station = $commonModel->getDataByOneCondition('fire_stations', array('id' => Auth::user()->station_id));
        $districts = $commonModel->getDataByOneCondition('districts', array('id' => Auth::user()->district_id));
        $employees = $commonModel->getDataByOneCondition('fs_employee', array('status' => 'Active'));
        return view('admin.Activities.rewardPunishment.add', compact('districts', 'station', 'employees'));
    }

    public function addRewardPanishmentPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district_id'  => 'required',
            'station_id'  => 'required',
            'activity'  => 'required',
            'district_id'  => 'required',
            'awarded_by'  => 'required',
            'recipient'  => 'required',
            'date'  => 'required',
            'comment'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        if($request->activity =='Reward') {
            $reward_type = $request->reward_type_rwd;
        } else {
            $reward_type = $request->reward_type_pun;
        }
        $data = [
            'district_id' => $request->district_id,
            'station_id' => $request->station_id,
            'activity' => $request->activity,
            'reward_type' => $reward_type,
            'awarded_by' => $request->awarded_by,
            'recipient' => $request->recipient,
            'date' => $request->date,
            'comment' => $request->comment,
        ];
        $commonModel = new CommonModel();

        $result = $commonModel->insertData('reward_punishment', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Reward/Punishment saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try again later.!');
        }
    }

    public function viewRewardPanishment($id)
    {
        $commonModel = new CommonModel();
        $rewardData = $commonModel->getDataByOneCondition('reward_punishment', array('id' => $id));
        $district = $commonModel->getDataByOneCondition('districts', array('id' => $rewardData[0]->district_id));
        $station = $commonModel->getDataByOneCondition('fire_stations', array('id' => $rewardData[0]->station_id));
        $data = [
            'district' => $district[0]->name,
            'station' => $station[0]->name,
            'activity' => $rewardData[0]->activity,
            'reward_type' => $rewardData[0]->reward_type,
            'awarded_by' => $rewardData[0]->awarded_by,
            'recipient' => $rewardData[0]->recipient,
            'date' => $rewardData[0]->date,
            'comment' => $rewardData[0]->comment,
        ];
        return view('admin.Activities.rewardPunishment.view', $data);
    }

    public function deleteRewardPanishment($id)
    {
        $commonModel = new CommonModel();
        $where =['id' => $id];
        $result = $commonModel->deleteDataByOneCondition('reward_punishment', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Reward / Punishment deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }



    public function fireInspection()
    {
        $commonModel = new CommonModel();
        if(Auth::user()->type == 2)
        {
            $fireInspection = $commonModel->getDataByOneCondition('fire_inspection', array('district_id' => Auth::user()->district_id));
        }
        else if(Auth::user()->type == 3)
        {
            $fireInspection = $commonModel->getDataByTwoCondition('fire_inspection', array('district_id' => Auth::user()->district_id), array('station_id' => Auth::user()->station_id));
        }
        else
        {
            $fireInspection = $commonModel->getData('fire_inspection');
        }
        $station = $commonModel->getData('fire_stations');
        $districts = $commonModel->getData('districts');
        $employees = $commonModel->getDataByOneCondition('fs_employee', array('status' => 'Active'));
        return view('admin.Activities.fireInspection.index', compact('fireInspection', 'districts', 'station', 'employees'));
    }


    public function addFireInspection()
    {
        $commonModel = new CommonModel();
        $station = $commonModel->getDataByOneCondition('fire_stations', array('id' => Auth::user()->station_id));
        $districts = $commonModel->getDataByOneCondition('districts', array('id' => Auth::user()->district_id));
        $employees = $commonModel->getDataByOneCondition('fs_employee', array('status' => 'Active'));
        return view('admin.Activities.fireInspection.add', compact('districts', 'station', 'employees'));
    }

    public function addFireInspectionPost(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district_id' => 'required',
            'station_id' => 'required',
            'date' => 'required',
            'category' => 'required',
            'firm_name' => 'required',
            'condition' => 'required',
            'action' => 'required',
            'comment' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'district_id' => $request->district_id,
            'station_id' => $request->station_id,
            'date' => $request->date,
            'category' => $request->category,
            'firm_name' => $request->firm_name,
            'condition' => $request->condition,
            'action' => $request->action,
            'comment' => $request->comment,
        ];
        $commonModel = new CommonModel();

        $result = $commonModel->insertData('fire_inspection', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire inspection saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something went wrong. Please try again later.!');
        }
    }

    public function viewFireInspection($id)
    {
        
        $commonModel = new CommonModel();
        $rewardData = $commonModel->getDataByOneCondition('fire_inspection', array('id' => $id));
        $district = $commonModel->getDataByOneCondition('districts', array('id' => $rewardData[0]->district_id));
        $station = $commonModel->getDataByOneCondition('fire_stations', array('id' => $rewardData[0]->station_id));
        $data = [
            'district' => $district[0]->name,
            'station' => $station[0]->name,
            'date' => $rewardData[0]->date,
            'category' => $rewardData[0]->category,
            'firm_name' => $rewardData[0]->firm_name,
            'condition' => $rewardData[0]->condition,
            'action' => $rewardData[0]->action,
            'comment' => $rewardData[0]->comment,
        ];
        return view('admin.Activities.fireInspection.view', $data);
    }

    public function deleteFireInspection($id)
    {
        $commonModel = new CommonModel();
        $where =['id' => $id];
        $result = $commonModel->deleteDataByOneCondition('fire_inspection', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire Inspection deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}

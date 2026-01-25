<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Common\CommonModel;
use Carbon\Carbon;

class DeclarionController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $user = Auth::user();
        return view('citizen.index_noc');
    }


    public function indexDeclaration()
    {
        $user_id = Auth::user()->id;
        $citizen  = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        $declaration  = $this->commonModel->getDataByOneConditionOneLimit('ct_declaration', array('user_id' => $user_id), '1');
        $inspection_step = '';
        return view('citizen.index_declaration', compact('citizen','declaration', 'inspection_step'));
    }

    public function declarationList(Request $request)
    {
        $user_id = Auth::user()->id;
        $citizen  = $this->commonModel->getDataByOneCondition('users', array('id' => $user_id));
        if(Auth::user()->type == 4)
        {
            $declaration  = $this->commonModel->getDataByOneCondition('ct_declaration', array('user_id' => $user_id));
        }
        else
        {
            $declaration  = $this->commonModel->getDataByOneCondition('ct_declaration', array('user_id' => $user_id));
        }
        return view('citizen.declaration_list')->with('citizen',$citizen)->with('declaration',$declaration)->with('inspection_step','');
    }

    public function declarationStatus(Request $request)
    {
        if($request->status == 'approved')
        {
            $approved = Declaration::where('id', $request->id)->update(['status' => 'Approved']);
    
            if($approved)
            {
                return response()->json(
                        [
                            'status' => 200,
                            'message' => 'Application approved successfully.',
                        ]);
            }

        }else if($request->status == 'rejected'){

            $rejected = Declaration::where('id', $request->id)->update(['status' => 'Rejected']);
    
            if($rejected)
            {
                return response()->json(
                        [
                            'status' => 200,
                            'message' => 'Application rejected successfully.',
                        ]);
            }
        }
        return response()->json(
            [
                'status' => 500,
                'message' => 'Something went wrong. Pease try again.',
            ]);
    }

    public function addPhysicalInsPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all(); 

        $declaration  = $this->commonModel->getDataByOneCondition('ct_declaration', array('user_id' => $user_id));

        if(!$declaration) {
            unset($data['_token']);
            unset($data['inspection_step']);
            $data = [
                'physical_ins' => json_encode($data),
                'user_id' => $user_id
            ];     
            $result = $this->commonModel->insertData('ct_declaration', $data);
        } else {
            unset($data['_token']);
            unset($data['inspection_step']);
            $data = [
                'physical_ins' => json_encode($data),
                'user_id' => $user_id
            ];     
            $result = $this->commonModel->updateDataByOneCondition('ct_declaration',array('user_id' => $user_id),$data);
        }

        $declaration  = $this->commonModel->getDataByOneCondition('ct_declaration', array('user_id' => $user_id));
        if($result)
        {
            return redirect()->back()->with('declaration',$declaration)->with('success', 'Physical Inspection Saved Successffully!')->with('inspection_step',$request->inspection_step);
        }
        else{
            return redirect()->back()->with('declaration',$declaration)->with('failed', 'Something Went Wrong Try Later!')->with('inspection_step',$request->inspection_step);
        }       
    }

    public function addBuildingStatusPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $filteredData = array_filter($data, function($key) {
            return !in_array($key, ['_token', 'declaration_id', 'inspection_step']);
        }, ARRAY_FILTER_USE_KEY);
        
        $declaration = $this->commonModel->getDataByOneCondition('ct_declaration', ['id' => $data['declaration_id']]);
        $result = false;
        if ($declaration) {
            
            $today = Carbon::now();
            $inputDate = Carbon::parse($declaration[0]->created_at);
            $interval = $today->diff($inputDate);
            $monthsDifference = ($interval->y * 12) + $interval->m;
            
            if ($monthsDifference > 6)
            {
                $bdata = [
                    'building_status' => json_encode($filteredData),
                    'user_id' => $user_id
                ];
                $result = $this->commonModel->insertData('ct_declaration', $bdata);
            }
            else
            {
                $bdata = [
                    'building_status' => json_encode($filteredData)
                ];
                $result = $this->commonModel->updateDataByOneCondition('ct_declaration', ['id' => $data['declaration_id']], $bdata);
            }
        }
        else
        {
            $bdata = [
                'building_status' => json_encode($filteredData),
                'user_id' => $user_id
            ];
            $result = $this->commonModel->insertData('ct_declaration', $bdata);
        }
        if($result)
        {
            echo "1";
        }
        else{
            echo "0";
        }
    }

    public function addFireProvissionPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $declaration = $this->commonModel->getDataByOneConditionOneLimit('ct_declaration', ['user_id' => $user_id],'1');
        $result = false;
        $filteredData = array_filter($data, function($key) {
            return !in_array($key, ['_token', 'declaration_id', 'inspection_step']);
        }, ARRAY_FILTER_USE_KEY);
            
        $today = Carbon::now();
        $inputDate = Carbon::parse($declaration[0]->created_at);
        $interval = $today->diff($inputDate);
        $monthsDifference = ($interval->y * 12) + $interval->m;
        
        if ($monthsDifference > 6)
        {
            $bdata = [
                'fire_provission' => json_encode($filteredData),
                'user_id' => $user_id
            ];
            $result = $this->commonModel->insertData('ct_declaration', $bdata);
        }
        else
        {
            
            $bdata = [
                'fire_provission' => json_encode($filteredData),
                'user_id' => $user_id
            ];
            $result = $this->commonModel->updateDataByOneCondition('ct_declaration', ['id' => $declaration[0]->id], $bdata);
        }
        if($result)
        {
            echo "1";
        }
        else{
            echo "0";
        }     
    }

    public function addSpecialProvissionPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $filteredData = array_filter($data, function($key) {
            return !in_array($key, ['_token', 'declaration_id', 'inspection_step']);
        }, ARRAY_FILTER_USE_KEY);
        $declaration = $this->commonModel->getDataByOneConditionOneLimit('ct_declaration', ['user_id' => $user_id],'1');
        $result = false;
        $today = Carbon::now();
        $inputDate = Carbon::parse($declaration[0]->created_at);
        $interval = $today->diff($inputDate);
        $monthsDifference = ($interval->y * 12) + $interval->m;
        
        if ($monthsDifference > 6) {
            $bdata = [
                'special_provission' => json_encode($filteredData),
                'user_id' => $user_id
            ];
            $result = $this->commonModel->insertData('ct_declaration', $bdata);
        } else {
            
            $bdata = [
                'special_provission' => json_encode($filteredData),
                'user_id' => $user_id
            ];
            $result = $this->commonModel->updateDataByOneCondition('ct_declaration', ['id' => $declaration[0]->id], $bdata);
        }
        if($result)
        {
            echo "1";
        }
        else{
            echo "0";
        }
    }

    public function addFinalSubmitPost(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = $request->all();
        $filteredData = array_filter($data, function($key) {
            return !in_array($key, ['_token', 'declaration_id', 'inspection_step']);
        }, ARRAY_FILTER_USE_KEY);
        $declaration = $this->commonModel->getDataByOneConditionOneLimit('ct_declaration', ['user_id' => $user_id],'1');
        $result = false;
        $today = Carbon::now();
        $inputDate = Carbon::parse($declaration[0]->created_at);
        $interval = $today->diff($inputDate);
        $monthsDifference = ($interval->y * 12) + $interval->m;
        
        if ($monthsDifference > 6) {
            $bdata = [
                'final_submit' => $data['declaration'],
                'final_submit1' => $data['declaration1'],
                'status' => 'Pending',
                'user_id' => $user_id
            ];
            $result = $this->commonModel->insertData('ct_declaration', $bdata);
        } else {
            
            $bdata = [
                'final_submit' => $data['declaration'],
                'final_submit1' => $data['declaration1'],
                'status' => 'Pending',
                'user_id' => $user_id
            ];
            $result = $this->commonModel->updateDataByOneCondition('ct_declaration', ['id' => $declaration[0]->id], $bdata);
        }
        if($result)
        {
            echo "1";
        }
        else{
            echo "0";
        }
    }

    
}

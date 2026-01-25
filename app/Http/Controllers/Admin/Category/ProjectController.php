<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;



class ProjectController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index()
    {
        $tbl = 'projects';
        $getProjects = $this->commonModel->getData($tbl);
        return view('admin.project.projects', compact('getProjects'));
    }


    public function addProjectForm()
    {
       return view('admin.project.addprojectform');
    }


    public function saveproject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $project = $request->input('project');
        $cleanedString = preg_replace('/[\s\W]+/', '_', $project);
        $tbl='projects';
        $data = ['name' => $project, 'entity' => strtolower($cleanedString)];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Projects added successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function edit($id)
    {
        $tbl = 'projects';
        $where = ['id'=>$id];
        $getProject = $this->commonModel->getDataByOneCondition($tbl,$where)[0];
        return view('admin.project.editprojectform', compact('getProject'));
    }


    public function updateproject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project'  => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $project = $request->input('project');
        $status  = $request->input('status');
        $pid     = $request->input('pid');
        
        $cleanedString = preg_replace('/[\s\W]+/', '_', $project);
        $tbl = 'projects';
        $data = ['name' => $project, 'status' => $status, 'entity' => strtolower($cleanedString)];
        $where =['id' => $pid];

        $result = $this->commonModel->updateDataByOneCondition($tbl, $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Projects updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function destroy($id)
    {
        $tbl='projects';
        $where=['id'=>$id];
        $result = $this->commonModel->deleteDataByOneCondition($tbl,$where);
        if($result)
        {
            return redirect()->back()->with('success', 'Project deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function filter(Request $request){
        $tbl = 'projects';
        $query = DB::table($tbl);
        $where = [];
        if ($request->filled('filter_name')) {
            $query->where('name', 'like', '%' . $request->get('filter_name') . '%');
            $where['name'] = $request->get('filter_name');
        }

        if ($request->filled('status')) {
            $query->where('status', 'like', '%' . $request->get('status') . '%');
            $where['status'] = $request->get('status');
        }

        $getProjects = $query->get();

        return view('admin.project.projects', compact('getProjects'));
    }
}

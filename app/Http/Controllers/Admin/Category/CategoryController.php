<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category\CategoryModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    protected $categoryModel;
    public function __construct(){
        $this->categoryModel = new CategoryModel;
    }

    public function index()
    {
        $getCategory = $this->categoryModel->getCategory();
        return view('admin.category.category', compact('getCategory'));
    }

    public function addCategoryForm()
    {
       $getProjects = $this->categoryModel->getProjects();
       return view('admin.category.addcategoryform', compact('getProjects'));
    }

    public function savecategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'  => 'required',
            'projects'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = $request->input('category');
        $projects = $request->input('projects');

        $data = ['name' => $category, 'project_id' => $projects];

        $result = $this->categoryModel->insertData($data);
        if($result)
        {
            return redirect()->back()->with('success', 'Category added successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function edit($id)
    {
        $getProjects = $this->categoryModel->getProjects();
        $getCategory = $this->categoryModel->getCategoryById($id);
        return view('admin.category.editcategoryform', compact('getProjects','getCategory'));
    }


    public function updatecategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'  => 'required',
            'projects'  => 'required',
            'status'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = $request->input('category');
        $projects = $request->input('projects');
        $status = $request->input('status');
        $cateid   = $request->input('cateid');

        $data = ['name' => $category, 'project_id' => $projects, 'status' => $status];
        $where =['id' => $cateid];

        $result = $this->categoryModel->updateData($where,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Category updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function destroy($id)
    {
        $result = $this->categoryModel->deleteData($id);
        if($result)
        {
            return redirect()->back()->with('success', 'Category deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function filter(Request $request){
        $query = DB::table('categories')
                    ->select('categories.*', 'projects.name as project_name')
                    ->join('projects', 'categories.project_id', '=', 'projects.id');

       if($request->get('filter_category') != null){
        $query->where('categories.name', 'like', '%'.$request->get('filter_category').'%');
       }
       if($request->get('filter_projects') != null){
        $query->where('projects.name', 'like', '%'.$request->get('filter_projects').'%');
       }
       if($request->get('status') != null){
        $query->where('categories.status', 'like', '%'.$request->get('status').'%');
       }
       $getCategory = $query->get();
       return view('admin.category.category', compact('getCategory'));
    }


}

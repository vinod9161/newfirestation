<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class SubcategoryController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index()
    {
        $tbl  = 'sub_categories';
        $tbl2 = 'categories';
        $col  = 'category_id';
        $col2 = 'id';
        $name = 'name';
        $asname = 'category_name';

        $getSubcategory = $this->commonModel->getDataByTwoTable($tbl,$tbl2,$col,$col2,$name,$asname);
        return view('admin.category.subcategory', compact('getSubcategory'));
    }

    public function addSubcategoryForm()
    {
        $tbl  = 'categories';
        $getCategory = $this->commonModel->getData($tbl);
        return view('admin.category.addsubcategoryform', compact('getCategory'));
    }

    public function savesubcategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'  => 'required',
            'subcategory'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = $request->input('category');
        $subcategory = $request->input('subcategory');

        $tbl  = 'sub_categories';
        $data = ['name' => $subcategory, 'category_id' => $category];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Sub category added successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }


    public function edit($id)
    {
        $table = 'categories';
        $tbl = 'sub_categories';
        $where = ['id' => $id];
        $getCategories = $this->commonModel->getData($table);
        $getSubcategory = $this->commonModel->getDataByOneCondition($tbl,$where)[0];
        return view('admin.category.editsubcategoryform', compact('getCategories','getSubcategory'));
    }

    public function updatesubcategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category'  => 'required',
            'subcategory'  => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $status = $request->input('status');
        $scid = $request->input('scid');

        $tbl  = 'sub_categories';
        $where =['id' => $scid];
        $data = ['name' => $subcategory, 'category_id' => $category, 'status' => $status];
        $result = $this->commonModel->updateDataByOneCondition($tbl, $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Sub category updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function destroy($id)
    {
        $tbl='sub_categories';
        $where=['id'=>$id];
        $result = $this->commonModel->deleteDataByOneCondition($tbl,$where);
        if($result)
        {
            return redirect()->back()->with('success', 'Sub category deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function filter(Request $request){

        $query = DB::table('sub_categories')
        ->select('sub_categories.*', 'categories.name as project_name')
        ->join('categories', 'sub_categories.category_id', '=', 'categories.id');

        if($request->get('filter_name') != null){
        $query->where('sub_categories.name', 'like', '%'.$request->get('filter_name').'%');
        }
        if($request->get('filter_category') != null){
        $query->where('categories.name', 'like', '%'.$request->get('filter_category').'%');
        }
        if($request->get('status') != null){
        $query->where('sub_categories.status', 'like', '%'.$request->get('status').'%');
        }
        $getCategory = $query->get();
        return view('admin.category.category', compact('getCategory'));
    }





}

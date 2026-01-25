<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class TypeController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index()
    {
       
        $getTypes = $this->commonModel->getTypes();
        return view('admin.category.types', compact('getTypes'));
    }

    public function addTypeForm()
    {
        $table = 'categories';
        $getCategory = $this->commonModel->getData($table);
        return view('admin.category.addtypeform', compact('getCategory'));
    }

    public function getsubcategory(Request $request)
    {
        $category = $request->input('category');
        if($category=='')
        {
            $resp=array('status' => 0, 'message' => 'Category Data Missing');
            return response()->json($resp);
        }

        $tbl = 'sub_categories';
        $where = ['category_id'=>$category];
        $getSubCategory = $this->commonModel->getDataByOneCondition($tbl,$where);
        $resp=array('status' => 1, 'data' => $getSubCategory);
        return response()->json($resp);
    }

    public function savetype(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'  => 'required',
            'category'  => 'required',
            'subcategory'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $type           = $request->input('type');
        $category       = $request->input('category');
        $subcategory    = $request->input('subcategory');

        $tbl='types';
        $data = ['name' => $type, 'category_id' => $category, 'subcategory_id' => $subcategory, 'created_at' => @date('Y-m-d H:i:s')];

        $result = $this->commonModel->insertData($tbl,$data);
        if($result)
        {
            return redirect()->back()->with('success', 'Type added successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function edit($id)
    {
        $tbl = 'types';
        $where = ['id'=>$id];
        $table = 'categories';
        $table2 = 'sub_categories';
        $getCategories      = $this->commonModel->getData($table);
        $getSubCategories   = $this->commonModel->getData($table2);
        $getType = $this->commonModel->getDataByOneCondition($tbl,$where)[0];
        return view('admin.category.edittypeform', compact('getType','getCategories','getSubCategories'));
    }

    
    public function updatetype(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type'  => 'required',
            'category'  => 'required',
            'subcategory'  => 'required',
            'status'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $type           = $request->input('type');
        $category       = $request->input('category');
        $subcategory    = $request->input('subcategory');
        $status    = $request->input('status');
        $tid    = $request->input('tid');

        $tbl='types';
        $where=['id' => $tid];
        $data = ['name' => $type, 'category_id' => $category, 'subcategory_id' => $subcategory, 'status' => $status, 'updated_at' => @date('Y-m-d H:i:s')];

        $result = $this->commonModel->updateDataByOneCondition($tbl, $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Type updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function destroy($id)
    {
        $tbl='types';
        $where=['id'=>$id];
        $result = $this->commonModel->deleteDataByOneCondition($tbl,$where);
        if($result)
        {
            return redirect()->back()->with('success', 'Type deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}

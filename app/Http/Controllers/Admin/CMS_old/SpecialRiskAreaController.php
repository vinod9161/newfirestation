<?php

namespace App\Http\Controllers\Admin\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class SpecialRiskAreaController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $specialriskarea = $this->commonModel->getData('cms_specialriskarea');
        return view('admin.CMS.specialriskarea.specialriskarea', compact('specialriskarea'));
    }
    public function addSpecialRiskAreaForm()
    {
        $districts = $this->commonModel->getDataByOneCondition('districts',array('status' => '1'));
        $firestation = $this->commonModel->getDataByOneCondition('fire_stations',array('status' => '1'));
        return view('admin.CMS.specialriskarea.add', compact('districts','firestation'));
    }
    public function saveSpecialRiskArea(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district'  => 'required',
            'firestation'  => 'required',
            'vulnerable_areas'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'district' => $request->input('district'),
            'firestation' => $request->input('firestation'),
            'vulnerable_areas' => $request->input('vulnerable_areas'),
            'status' => $request->input('status'),
        ];
        $result = $this->commonModel->insertData('cms_specialriskarea', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Special Risk Area saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function editSpecialRiskAreaForm($id)
    {
        $specialriskarea = $this->commonModel->getDataByOneCondition('cms_specialriskarea', array('id' => $id));
        $districts = $this->commonModel->getDataByOneCondition('districts',array('status' => '1'));
        $firestation = $this->commonModel->getDataByOneCondition('fire_stations',array('status' => '1'));
        return view('admin.CMS.specialriskarea.edit', compact('specialriskarea','districts','firestation'));
    }
    public function updateSpecialRiskArea(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'district'  => 'required',
            'firestation'  => 'required',
            'vulnerable_areas'  => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id   = $request->input('id');
        $where =['id' => $id];
        $data = [
            'district' => $request->input('district'),
            'firestation' => $request->input('firestation'),
            'vulnerable_areas' => $request->input('vulnerable_areas'),
            'status' => $request->input('status'),
        ];

        $result = $this->commonModel->updateDataByOneCondition('cms_specialriskarea', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Special Risk Area updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function deleteSpecialRiskArea($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('cms_specialriskarea', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Special Risk Area deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}
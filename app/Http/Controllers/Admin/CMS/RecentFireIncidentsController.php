<?php

namespace App\Http\Controllers\Admin\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class RecentFireIncidentsController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $recentfireincidents = $this->commonModel->getData('recentfireincidents');
        return view('admin.CMS.RecentFireIncidents.recentfireincidents', compact('recentfireincidents'));
    }
    public function addRecentFireIncidentsForm()
    {
        return view('admin.CMS.RecentFireIncidents.add');
    }
    public function saveRecentFireIncidents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'description'  => 'required',
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status')
        ];

        $result = $this->commonModel->insertData('recentfireincidents', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Recent Fire Incidents saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function editRecentFireIncidentsForm($id)
    {
        $recentfireincidents = $this->commonModel->getDataByOneCondition('recentfireincidents', array('id' => $id));
        return view('admin.CMS.RecentFireIncidents.edit', compact('recentfireincidents'));
    }
    public function updateRecentFireIncidents(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'  => 'required',
            'description'  => 'required',
            'status'  => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id   = $request->input('id');
        $where =['id' => $id];
        $data = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'status' => $request->input('status')
        ];
        $result = $this->commonModel->updateDataByOneCondition('recentfireincidents', $where, $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Recent Fire Incidents updated successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function deleteRecentFireIncidents($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('recentfireincidents', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Recent Fire Incidents deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}
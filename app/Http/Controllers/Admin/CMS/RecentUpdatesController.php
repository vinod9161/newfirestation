<?php

namespace App\Http\Controllers\Admin\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;

class RecentUpdatesController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index()
    {
        $recentupdates = $this->commonModel->getData('recentupdates');
        return view('admin.CMS.recentupdates.recentupdates', compact('recentupdates'));
    }
    public function addRecentUpdatesForm()
    {
        return view('admin.CMS.recentupdates.add');
    }
    public function saveRecentUpdates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'document' => 'nullable|mimes:pdf',
            'route_url' => 'nullable|string|max:500'
        ],[
            'document.mimes' => 'Only PDF files are allowed'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $document = null;

        if ($request->hasFile('document')) {

            $fileName = time().'.'.$request->document->getClientOriginalExtension();

            $request->file('document')->move(public_path('admin/recentupdates'), $fileName);

            $document = 'admin/recentupdates/'.$fileName;
        }

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'route_url' => $request->route_url,
            'is_highlight' => $request->has('is_highlight') ? 1 : 0,
            'document' => $document
        ];

        $result = $this->commonModel->insertData('recentupdates', $data);

        if($result)
        {
            return redirect()->back()->with('success', 'Recent Updates saved successfully');
        }
        else
        {
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function editRecentUpdatesForm($id)
    {
        $recentupdates = $this->commonModel->getDataByOneCondition('recentupdates', array('id' => $id));
        return view('admin.CMS.recentupdates.edit', compact('recentupdates'));
    }
    public function updateRecentUpdates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'status' => 'required',
            'route_url' => 'nullable|string|max:500'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $id = $request->id;
        $where = ['id' => $id];

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'route_url' => $request->route_url,
            'is_highlight' => $request->has('is_highlight') ? 1 : 0
        ];

        if ($request->hasFile('document')) {

            $fileName = time().'.'.$request->document->getClientOriginalExtension();

            $request->file('document')->move(public_path('admin/recentupdates'), $fileName);

            $data['document'] = 'admin/recentupdates/'.$fileName;
        }

        $result = $this->commonModel->updateDataByOneCondition('recentupdates', $where, $data);

        if($result){
            return redirect()->back()->with('success', 'Recent Updates updated successfully');
        }else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
    public function deleteRecentUpdates($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('recentupdates', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Recent Updates deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}
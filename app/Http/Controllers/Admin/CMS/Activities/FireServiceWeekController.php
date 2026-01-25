<?php

namespace App\Http\Controllers\Admin\CMS\Activities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\EstablishmentModel;
use App\Models\Activities\FireServiceWeekModel;
use Illuminate\Support\Facades\Validator;

class FireServiceWeekController extends Controller{

    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }
    public function index(){
        $fireEvents = FireServiceWeekModel::all();
        return view('admin.CMS.Activities.fire-events.index', compact('fireEvents'));
    }

    public function create(){
        return view('admin.CMS.Activities.fire-events.create');
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'month' => 'required|string|max:20',
            'year' => 'required|integer',
        ]);

        FireServiceWeekModel::create($request->all());
        return redirect()->route('admin.Activities.fire_service_week')->with('success', 'Event added successfully!');
    }

    public function edit($id){
        $fireEvent = FireServiceWeekModel::findOrFail($id);
        return view('admin.CMS.Activities.fire-events.edit', compact('fireEvent'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'month' => 'required|string|max:20',
            'year' => 'required|integer',
        ]);
        $fireEvent = FireServiceWeekModel::findOrFail($id);
        $fireEvent->update($request->all());

        return redirect()->route('admin.Activities.fire_service_week')->with('success', 'Event updated successfully!');
    }

    public function destroy($id) {
        $fireEvent = FireServiceWeekModel::findOrFail($id);
        $fireEvent->delete();
        return redirect()->route('admin.Activities.fire_service_week')->with('success', 'Event deleted successfully!');
    }

    public Function category()
    {
        $commonModel = new CommonModel();
        $fireEventsCategory = $commonModel->getData('fire_events_category');
        return view('admin.CMS.Activities.fire-events.category', compact('fireEventsCategory'));
    }
    public function saveCategory(Request $request)
    {
        $data = [
            'title' => $request->input('title'),
            'hindi_title' => $request->input('hindi_title')
        ];
        $result = $this->commonModel->insertData('fire_events_category', $data);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire Service Week Category saved successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }

    public function destroyCategory($id)
    {
        $where =['id' => $id];
        $result = $this->commonModel->deleteDataByOneCondition('fire_events_category', $where);
        if($result)
        {
            return redirect()->back()->with('success', 'Fire Service Week Category deleted successfully');
        }
        else{
            return redirect()->back()->with('failed', 'Something Went Wrong Try Later!');
        }
    }
}

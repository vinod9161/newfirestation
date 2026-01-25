<?php

namespace App\Http\Controllers\Admin\CMS\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;


class HistoryController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'history');
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.About.history.index',$data);
    }

    public function addHistory(){
        return view('admin.CMS.About.history.add');
    }
    public function Savehistory(Request $request){
        // echo "trea"; die;
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('admin/about/history'), $card_image_name);

        $data = [
            'page_name' => "history",
            'hadding' => '',
            'content' => $request->description,
            'image' => $card_image_name,
            'create_by' =>'',
        ];
        // echo "<pre>";print_r($data); die;
        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.about.history')->with('success', 'History added successfully.');
    }

    public function destroyhistory($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.about.history')->with('success', 'History deleted successfully.');
    }

}

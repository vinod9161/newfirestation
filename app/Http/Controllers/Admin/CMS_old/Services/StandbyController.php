<?php

namespace App\Http\Controllers\Admin\CMS\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;


class StandbyController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'dg_message');
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.About.dg_massage.index',$data);
    }

    public function add(){
        return view('admin.CMS.About.dg_massage.add');
    }
    public function Save(Request $request){
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
        $card_image->move(public_path('admin/about/dg_massage'), $card_image_name);


        $data = [
            'page_name' => "dg_message",
            'hadding' => '',
            'content' => $request->description,
            'image' => $card_image_name,
            'create_by' =>'',
        ];
        // echo "<pre>";print_r($data); die;
        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.about.dg_message')->with('success', 'dg_message added successfully.');
    }

    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.about.dg_message')->with('success', 'dg_message deleted successfully.');
    }

}

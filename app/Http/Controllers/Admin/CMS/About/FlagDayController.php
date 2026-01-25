<?php

namespace App\Http\Controllers\Admin\CMS\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;


class FlagDayController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'flag_day');
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.About.flag_day.index',$data);
    }

    public function addflag_day(){
        return view('admin.CMS.About.flag_day.add');
    }
    public function Saveflag_day(Request $request){
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the first image
        $card_image = $request->file('image');
        $card_image_name = uniqid() . '.' . $card_image->getClientOriginalExtension();
        $card_image->move(public_path('admin/about/flag_day'), $card_image_name);

        // Handle the second image
        $card_image1 = $request->file('image1');
        $card_image_name1 = uniqid() . '.' . $card_image1->getClientOriginalExtension();
        $card_image1->move(public_path('admin/about/flag_day'), $card_image_name1);

        $data = [
            'page_name' => "flag_day",
            'hadding' => '',
            'content' => $request->description,
            'image' => $card_image_name,
            'image1' => $card_image_name1,
            'create_by' =>'',
        ];
        // echo "<pre>";print_r($data); die;
        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.about.flag_day')->with('success', 'flag_day added successfully.');
    }

    public function destroyflag_day($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.about.flag_day')->with('success', 'flag_day deleted successfully.');
    }

}

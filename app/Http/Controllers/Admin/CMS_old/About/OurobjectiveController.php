<?php

namespace App\Http\Controllers\Admin\CMS\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;


class OurobjectiveController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'our_objective');
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.About.our_objective.index',$data);
    }

    public function add(){
        return view('admin.CMS.About.our_objective.add');
    }
    public function Save(Request $request){
        // echo "<pre>"; print_r($request->all()); die;
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'description' => 'required',
            'imageposition' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('admin/about/our_objective'), $card_image_name);

        $data = [
            'page_name' => "our_objective",
            'image_position' => $request->imageposition,
            'hadding' => $request->hadding,
            'content' => $request->description,
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.about.our_objective')->with('success', 'our_objective added successfully.');
    }

    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.about.our_objective')->with('success', 'our_objective deleted successfully.');
    }

}

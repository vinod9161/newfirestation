<?php

namespace App\Http\Controllers\Admin\CMS\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;

class FAQController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "faq";
        $data['history'] = $this->commonModel->getData($tbl);
        return view('admin.CMS.About.faq.index',$data);
    }

    public function add(){
        return view('admin.CMS.About.faq.add');
    }
    public function Save(Request $request){
        // echo "trea"; die;
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'question' => $request->question,
            'answer' => $request->description,
        ];
        $this->commonModel->insertData('faq',$data);
        return redirect()->route('admin.about.faq')->with('success', 'FAQ added successfully.');
    }

    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('faq', array('id'=>$id));
        return redirect()->route('admin.about.faq')->with('success', 'FAQ deleted successfully.');
    }

}

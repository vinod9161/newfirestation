<?php

namespace App\Http\Controllers\Admin\CMS\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
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
        return view('admin.CMS.About.faq.index', $data);
    }

    public function add(){
        return view('admin.CMS.About.faq.add');
    }

    public function save(Request $request){
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

        $this->commonModel->insertData('faq', $data);
        return redirect()->route('admin.about.faq')->with('success', 'FAQ added successfully.');
    }

    public function edit($id){
        $faq = $this->commonModel->getDataByOneCondition('faq', array('id' => $id));
        if (!$faq) {
            return redirect()->route('admin.about.faq')->with('error', 'FAQ not found.');
        }
        return view('admin.CMS.About.faq.edit', compact('faq'));
    }

    public function update(Request $request, $id){

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
        $where = array('id' => $id);
        $update = $this->commonModel->updateDataByOneCondition('faq', array('id' => $id),$data);
        // echo "<pre>";print_r($update); die;
        if(!$update){
            return redirect()->route('admin.about.faq')->with('error', 'FAQ not found.');
        }else{

            return redirect()->route('admin.about.faq')->with('success', 'FAQ updated successfully.');
        }
    }

    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('faq', array('id' => $id));
        return redirect()->route('admin.about.faq')->with('success', 'FAQ deleted successfully.');
    }
}

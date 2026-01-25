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
            'heading'    => 'required',
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
            'hadding' => $request->heading,
            'content' => $request->description,
            'image' => $card_image_name,
            'create_by' =>'',
        ];
        // echo "<pre>";print_r($data); die;
        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.about.history')->with('success', 'History added successfully.');
    }


    public function edithistory($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        //echo "<pre>"; print_r($data['history']);die;
        return view('admin.CMS.About.history.edit',$data);
        
    }

    public function Updatehistory(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate input
            $validator = Validator::make($request->all(), [
                'heading'     => 'required',
                'description' => 'required',
                'status'      => 'required',
                'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $id = $request->input('hid');
            $hiddenimg = $request->input('hiddenimg');
            $status = $request->input('status');
            $heading = $request->input('heading');
            $description = $request->input('description');

            // Prepare data for update
            $data = [
                'hadding' => $heading,
                'status'  => $status,
                'content' => $description,
            ];

            // Handle image update if a new image is uploaded
            if ($request->hasFile('image')) {
                $card_image = $request->file('image');
                $card_image_name = time() . '.' . $card_image->getClientOriginalExtension();
                $card_image->move(public_path('admin/about/history'), $card_image_name);

                // Delete old image if exists
                if ($hiddenimg && file_exists(public_path('admin/about/history/' . $hiddenimg))) {
                    unlink(public_path('admin/about/history/' . $hiddenimg));
                }

                $data['image'] = $card_image_name;
            } else {
                // If no new image is uploaded, use the hidden image
                $data['image'] = $hiddenimg;
            }

            $tbl = 'pages_card';
            $where = ['id' => $id];

            // Update the database
            $this->commonModel->updateDataByOneCondition($tbl, $where, $data);

            return redirect()->route('admin.about.history')->with('success', 'History updated successfully.');
        }

        // Return edit view with history data
        return view('admin.about.edit_history', compact('history'));
    }


    public function destroyhistory($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.about.history')->with('success', 'History deleted successfully.');
    }

}

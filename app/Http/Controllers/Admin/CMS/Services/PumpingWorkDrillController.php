<?php

namespace App\Http\Controllers\Admin\CMS\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;


class PumpingWorkDrillController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'pumping_work');
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Services.pumping_work.index',$data);
    }

    public function add(){
        return view('admin.CMS.Services.pumping_work.add');
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
        $card_image->move(public_path('admin/services/pumping_work'), $card_image_name);

        $data = [
            'page_name' => "pumping_work",
            'image_position' => $request->imageposition,
            'hadding' => $request->hadding,
            'content' => $request->description,
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.services.pumping_work')->with('success', 'pumping_work added successfully.');
    }


    public function edit($id){
        $tbl = "pages_card";
        $where = array('id' => $id);
        $history = $this->commonModel->getDataByOneCondition($tbl,$where);
        $data['pumpingWork'] = $history[0];
        return view('admin.CMS.Services.pumping_work.edit',$data);
    }


    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'description' => 'required',
            'imageposition' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $pumpingWork = $this->commonModel->getDataByOneCondition('pages_card', ['id' => $id]);
        $pumpingWork = $pumpingWork[0];

        if ($request->file('image')) {
            // echo "hii"; die;
            // Check if old image exists and delete it from the folder
            if ($pumpingWork && file_exists(public_path('admin/services/pumping_work/'.$pumpingWork->image))) {
                unlink(public_path('admin/services/pumping_work/'.$pumpingWork->image)); // Delete the old image
            }

            // Handle the new image upload
            $card_image = $request->file('image');
            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
            $card_image->move(public_path('admin/services/pumping_work'), $card_image_name);
            $card_image_name = $card_image_name;
        } else {
            // If no new image is uploaded, keep the old image
            $card_image_name = $pumpingWork->image;
        }

        // Prepare the data for updating
        $data = [
            'page_name' => "pumping_work",
            'image_position' => $request->imageposition,
            'hadding' => $request->hadding,
            'content' => $request->description,
            'image' => $card_image_name,
            'create_by' => '',
        ];
        // echo "<pre>"; print_r($data); die;
        // Update the record in the database
        $this->commonModel->updateDataByOneCondition('pages_card', $data, ['id' => $id]);

        // Redirect back with success message
        return redirect()->route('admin.services.pumping_work')->with('success', 'Pumping work updated successfully.');
    }


    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.services.pumping_work')->with('success', 'pumping_work deleted successfully.');
    }

}

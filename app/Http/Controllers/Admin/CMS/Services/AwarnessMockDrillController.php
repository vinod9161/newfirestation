<?php

namespace App\Http\Controllers\Admin\CMS\Services;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;


class AwarnessMockDrillController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'awarness_mock_drill');
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.Services.awarness_mock_drill.index',$data);
    }

    public function add(){
        return view('admin.CMS.Services.awarness_mock_drill.add');
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
        $card_image->move(public_path('admin/services/awarness_mock_drill'), $card_image_name);

        $data = [
            'page_name' => "awarness_mock_drill",
            'image_position' => $request->imageposition,
            'hadding' => $request->hadding,
            'content' => $request->description,
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.services.awarness_mock_drill')->with('success', 'awarness_mock_drill added successfully.');
    }

    public function edit($id)
    {
        $tbl = "pages_card";
        $where = array('id' => $id);
        $awarness = $this->commonModel
            ->getDataByOneCondition($tbl,$where);
            $data['awarness_mock_drill'] = $awarness[0];

        return view(
            'admin.CMS.Services.awarness_mock_drill.edit',
            $data
        );
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'hadding' => 'required',

            'description' => 'required',

            'imageposition' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [

            'image_position' => $request->imageposition,

            'hadding' => $request->hadding,

            'content' => $request->description,

        ];

        if ($request->hasFile('image')) {

            $card_image = $request->file('image');

            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();

            $card_image->move(
                public_path('admin/services/awarness_mock_drill'),
                $card_image_name
            );

            $data['image'] = $card_image_name;
        }

        $this->commonModel->updateData(
            'pages_card',
            ['id' => $id],
            $data
        );

        return redirect()
            ->route('admin.services.awarness_mock_drill')
            ->with(
                'success',
                'Awarness Mock Drill updated successfully.'
            );
    }



    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.services.awarness_mock_drill')->with('success', 'awarness_mock_drill deleted successfully.');
    }

}

<?php

namespace App\Http\Controllers\Admin\CMS\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;
use DB;


class AboutController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function MissionVision(){
        $tbl = "pages_card";
        $where = array('page_name' => 'mission_vision');
        $mission_vision = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.About.MissionVision.index',compact('mission_vision'));
    }

    public function AddMissionVision(){
        return view('admin.CMS.About.MissionVision.add');
    }

    public function SaveMissionVision(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'section_type' => 'required',

            'description' => 'required',

            'status' => 'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $card_image = $request->file('image');

        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();

        $card_image->move(
            public_path('admin/about/mission_vision'),
            $card_image_name
        );

        $data = [

            'page_name' => "mission_vision",

            'image_position' => $request->section_type,

            'hadding' => $request->hadding ?? '',

            'content' => $request->description,

            'image' => $card_image_name,

            'status' => $request->status,

            'create_by' => '',

        ];

        $this->commonModel->insertData(
            'pages_card',
            $data
        );

        return redirect()
            ->route('admin.about.missionvision')
            ->with(
                'success',
                'Mission & Vision added successfully.'
            );
    }

    public function EditMissionVision($id)
    {
        $data['missionvision'] = DB::table('pages_card')
            ->where('id', $id)
            ->first();

        return view(
            'admin.CMS.About.MissionVision.edit',
            $data
        );
    }

    public function UpdateMissionVision(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [

            'section_type' => 'required',

            'description' => 'required',

            'status' => 'required',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [

            'image_position' => $request->section_type,

            'hadding' => $request->hadding ?? '',

            'content' => $request->description,

            'status' => $request->status,

        ];

        if ($request->hasFile('image')) {

            $card_image = $request->file('image');

            $card_image_name = time().'.'.$card_image->getClientOriginalExtension();

            $card_image->move(
                public_path('admin/about/mission_vision'),
                $card_image_name
            );

            $data['image'] = $card_image_name;
        }

        DB::table('pages_card')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.about.missionvision')
            ->with(
                'success',
                'Mission & Vision updated successfully.'
            );
    }

    public function destroyMissionVision($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.about.missionvision')->with('success', 'Mission & Vision deleted successfully.');
    }
}

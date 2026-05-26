<?php

namespace App\Http\Controllers\Admin\CMS\About;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;
use DB;


class FireserviceController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'fire_service_day');
        $data['history'] = $this->commonModel->getDataByOneCondition($tbl,$where);
        return view('admin.CMS.About.fire_service_day.index',$data);
    }

    public function addFire_Service_Day()
    {
        return view('admin.CMS.About.fire_service_day.add');
    }

    public function SaveFire_Service_Day(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $imageName = '';
        $imageName1 = '';

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time().'_1.'.$image->getClientOriginalExtension();

            $image->move(
                public_path('admin/about/fire_service_day'),
                $imageName
            );
        }

        if ($request->hasFile('image1')) {

            $image1 = $request->file('image1');

            $imageName1 = time().'_2.'.$image1->getClientOriginalExtension();

            $image1->move(
                public_path('admin/about/fire_service_day'),
                $imageName1
            );
        }

        $data = [
            'page_name' => 'fire_service_day',
            'hadding' => $request->hadding,
            'content' => $request->description,
            'image' => $imageName,
            'image1' => $imageName1,
            'status' => 'Active',
            'create_by' => '',
        ];

        DB::table('pages_card')->insert($data);

        return redirect()
            ->route('admin.about.Fire_Service_Day')
            ->with('success', 'Fire Service Day added successfully.');
    }


    public function editFire_Service_Day($id)
    {
        $data['fireServiceDay'] = DB::table('pages_card')
            ->where('id', $id)
            ->first();

        return view(
            'admin.CMS.About.fire_service_day.edit',
            $data
        );
    }

    public function updateFire_Service_Day(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'hadding' => $request->hadding,
            'content' => $request->description,
        ];

        if ($request->hasFile('image')) {

            $image = $request->file('image');

            $imageName = time().'_1.'.$image->getClientOriginalExtension();

            $image->move(
                public_path('admin/about/fire_service_day'),
                $imageName
            );

            $data['image'] = $imageName;
        }

        if ($request->hasFile('image1')) {

            $image1 = $request->file('image1');

            $imageName1 = time().'_2.'.$image1->getClientOriginalExtension();

            $image1->move(
                public_path('admin/about/fire_service_day'),
                $imageName1
            );

            $data['image1'] = $imageName1;
        }

        DB::table('pages_card')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.about.Fire_Service_Day')
            ->with('success', 'Fire Service Day updated successfully.');
    }

    public function addflag_day(){
        return view('admin.CMS.About.fire_service_day.add');
    }
    public function Saveflag_day(Request $request){
        // echo "trea"; die;
        $validator = Validator::make($request->all(), [
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $card_image = $request->file('image');
        $card_image_name = uniqid() . '.' . $card_image->getClientOriginalExtension();
        $card_image->move(public_path('admin/about/fire_service_day'), $card_image_name);

        // Handle the second image
        $card_image1 = $request->file('image1');
        $card_image_name1 = uniqid() . '.' . $card_image1->getClientOriginalExtension();
        $card_image1->move(public_path('admin/about/fire_service_day'), $card_image_name1);

        $data = [
            'page_name' => "fire_service_day",
            'hadding' => '',
            'content' => $request->description,
            'image' => $card_image_name,
            'image1' => $card_image_name1,
            'create_by' =>'',
        ];
        // echo "<pre>";print_r($data); die;
        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.about.Fire_Service_Day')->with('success', 'flag_day added successfully.');
    }

    public function destroyflag_day($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.about.Fire_Service_Day')->with('success', 'flag_day deleted successfully.');
    }

}

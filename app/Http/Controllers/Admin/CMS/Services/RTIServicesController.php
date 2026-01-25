<?php
namespace App\Http\Controllers\Admin\CMS\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class RTIServicesController extends Controller
{
    protected $commonModel;

    public function __construct(CommonModel $commonModel){
        $this->commonModel = $commonModel;
    }

    public function index(){
        $tbl = "pages_card";
        $where = array('page_name' => 'rti_service');
        $data = array(
            'rti_service' =>  $this->commonModel->getDataByOneCondition($tbl,$where)
        );
        // echo "<pre>"; print_r( $data); die;
        return view('admin.CMS.Services.rtiservices.index',$data);
    }


    public function add()
    {
        return view('admin.CMS.Services.rtiservices.add');
    }

    public function Save(Request $request){
        // echo "trea"; die;
        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'image' => 'required|mimes:pdf',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $serviceName = $request->input('service_name');
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('admin/services/rti_service'), $card_image_name);


        $data = [
            'page_name' => "rti_service",
            'hadding' => $serviceName,
            'content' => "rti_service content",
            'image' => $card_image_name,
            'create_by' =>'',
        ];

        $this->commonModel->insertData('pages_card',$data);
        return redirect()->route('admin.Service.rtiservices')->with('success', 'RTI Service PDF Upload successfully.');
    }



    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('pages_card', array('id'=>$id));
        return redirect()->route('admin.Service.rtiservices')->with('success', 'RTI Service PDF deleted successfully.');
    }
}

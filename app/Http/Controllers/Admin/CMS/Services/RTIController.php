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

class RTIController extends Controller
{
    protected $commonModel;

    public function __construct(CommonModel $commonModel){
        $this->commonModel = $commonModel;
    }

    public function index(){
        $data = array(
            'rti_data' => $this->commonModel->getData('tbl_rti')
        );
        return view('admin.CMS.Services.rti.index', $data);
    }


    public function add(){
        return view('admin.CMS.Services.rti.add');
    }

    public function Save(Request $request){
        $validator = Validator::make($request->all(), [
            'officer_name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'phone' => 'required|digits_between:7,15|regex:/^[0-9+\-\s()]+$/',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'name' => $request->officer_name,
            'category_name' => $request->category,
            'address' => $request->address,
            'phone' => $request->phone,
        ];
        $this->commonModel->insertData('tbl_rti',$data);
        return redirect()->route('admin.Service.RTI')->with('success', 'RTI  added successfully.');
    }

    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('tbl_rti', array('id'=>$id));
        return redirect()->route('admin.Service.RTI')->with('success', 'RTI deleted successfully.');
    }
}

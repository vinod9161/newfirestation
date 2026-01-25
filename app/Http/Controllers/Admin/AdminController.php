<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Auth;

class AdminController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function admin_profile()
    {
        $fireStactionList =  $this->commonModel->getData('fire_stations');
        $districtList =  $this->commonModel->getData('districts');
        $stateList =  $this->commonModel->getData('states');
        return view('admin.common.admin_profile', compact('fireStactionList', 'districtList', 'stateList'));
    }
}
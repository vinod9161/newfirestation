<?php

namespace App\Http\Controllers\Admin\Agency;

use Illuminate\Http\Request;
use App\Models\Models\User;
use Auth;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Models\District;
use App\Models\Models\AgencyLicence;
use Validator;

class AgencyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();
        return view('agency.index_agency');
    }

    public function indexAgency()
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;

        $licence  = AgencyLicence::where('user_id', '=', $user_id)->get();

        // echo "<pre>";
        // print_r($application); exit;
        return view('agency.home', [
            'user' => $user,
            'licence' => $licence,
        ]);
    }

    public function agencyLicence()
    {
        $user_id = Auth::user()->id;
        $user  = User::where('id', '=', $user_id)->first();

        return view('agency.index_licence', [
            'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
        ])->with('user',$user);
    }

    public function agencyLicencePost(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['number'] = strtotime(now());
        $request['status'] = 'Pending';
        AgencyLicence::create($request->all());
        return redirect()->back()->with('message', 'Agency Licence Submited Successfully!');
    }

    public function agencyLicenceView($id)
    {
        $licence  = AgencyLicence::where('id', '=', $id)->first();
        return view('agency.view_agency')->with('licence',$licence);
    }

    public function agencyLicenceEdit($id)
    {
        $licence  = AgencyLicence::where('id', '=', $id)->first();
        return view('agency.edit_agency')->with('licence',$licence);
    }

    public function agencyLicenceUpdatePost(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['number'] = strtotime(now());
        $request['status'] = 'Pending';

        AgencyLicence::where('id', $request->id)->update($request->except('_token'));
        return redirect()->back()->with('message', 'Agency Licence Submited Successfully!');
    }

    public function agencyLicenceDelete($id){

        $delete = AgencyLicence::where('id', '=', $id)->delete();

        return redirect()->back()->with('message', 'Agency Licence Deleted Successfully!');
    }

    public function agencyLicenceDownload($id)
    {
        $licence  = AgencyLicence::where('id', '=', $id)->first();

        $user = User::with('district','station')->where('id',$licence->user_id)->first();

        return view('admin.Agency-License.download_agency')->with('licence',$licence)->with('user',$user);
    }

}

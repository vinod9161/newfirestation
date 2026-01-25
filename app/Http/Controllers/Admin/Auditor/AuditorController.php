<?php

namespace App\Http\Controllers\Admin\Auditor;

use Illuminate\Http\Request;
use App\Models\Models\User;
use Auth;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Models\District;
use App\Models\Models\RiskAuditor;
use Validator;

class AuditorController extends Controller
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
        return view('auditor.index_auditor');
    }

    public function indexAuditor()
    {
        $user = Auth::user();
        $user_id = Auth::user()->id;

        $auditor  = RiskAuditor::where('user_id', '=', $user_id)->get();

        // echo "<pre>";
        // print_r($user); exit;
        return view('auditor.home', [
            'user' => $user,
            'auditor' => $auditor,
        ]);
    }

    public function auditorReport()
    {
        $user_id = Auth::user()->id;
        $user  = User::where('id', '=', $user_id)->first();

        return view('auditor.auditor_report', [
            'districts' => District::with('tehsil','block.panchayat')->take(13)->get(),
        ])->with('user',$user);
    }

    public function riskAuditorPost(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['number'] = strtotime(now());
        $request['status'] = 'Pending';
        RiskAuditor::create($request->all());
        return redirect()->back()->with('message', 'Risk Auditor Submited Successfully!');
    }

    public function riskAuditorView($id)
    {
        $auditor  = RiskAuditor::where('id', '=', $id)->first();
        return view('auditor.view_auditor')->with('auditor',$auditor);
    }

    public function riskAuditorEdit($id)
    {
        $auditor  = RiskAuditor::where('id', '=', $id)->first();
        return view('auditor.edit_auditor')->with('auditor',$auditor);
    }

    public function riskAuditorUpdatePost(Request $request)
    {
        $request['user_id'] = Auth::user()->id;
        $request['number'] = strtotime(now());
        $request['status'] = 'Pending';

        RiskAuditor::where('id', $request->id)->update($request->except('_token'));
        return redirect()->back()->with('message', 'Risk Auditor Submited Successfully!');
    }

    public function riskAuditorDelete($id){

        $delete = RiskAuditor::where('id', '=', $id)->delete();

        return redirect()->back()->with('message', 'Risk Auditor Deleted Successfully!');
    }

    public function riskAuditorDownload($id)
    {
        $auditor  = RiskAuditor::where('id', '=', $id)->first();

        $user = User::with('district','station')->where('id',$auditor->user_id)->first();

        return view('admin.Auditor.download_auditor')->with('auditor',$auditor)->with('user',$user);
    }


}

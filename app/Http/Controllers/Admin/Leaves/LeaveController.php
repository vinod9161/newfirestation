<?php

namespace App\Http\Controllers\Admin\Leaves;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\{User, ManageWorks};
use Auth;

class LeaveController extends Controller{

    public function manageLeaves(Request $request)
    {
        if(Auth::user()->type == 0)
        {
            $manage_work = ManageWorks::orderBy('id', 'DESC')->get();
        }else{
            $manage_work_1 = ManageWorks::where('assign_to', Auth::user()->id)->get();
            $manage_work_2 = ManageWorks::where('user_id', Auth::user()->id)->get();
            $manage_work = $manage_work_1->merge($manage_work_2);
        }
        // echo "<pre>"; print_r($manage_work); die;
        return view('admin.Leaves.leaves', compact('manage_work'));
    }
}

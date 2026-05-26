<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Remark;
use Validator;
use DB;

class RemarkController extends Controller
{
  
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {

    //     $remarks  = DB::table('remarks')->orderBy('id', 'DESC')->paginate(20);

    //     return view('admin.master.remark.index')->with('remarks',$remarks);
    // }
    public function index(Request $request)
    {
        $query = DB::table('remarks');

        // Filter by title
        if ($request->filled('title'))
        {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        // Filter by status
        if ($request->filled('status'))
        {
            $query->where('status', $request->status);
        }

        $remarks = $query
            ->orderBy('id', 'DESC')
            ->paginate(20)
            ->appends($request->all());

        return view('admin.master.remark.index', compact('remarks'));
    }

    public function addRemark()
    {
        return view('admin.master.remark.add');
    }

    public function addRemarkPost(Request $request)
    {
        $remark = new Remark();
        $remark->title = $request->title;
 
        $remark->save();

        return redirect('admin/remark')->with('success', 'Remark Added Successfully!');
    }

    public function editRemark($id)
    {
        $remark  = Remark::where('id', '=', $id)->first();

        return view('admin.master.remark.edit')->with('remark',$remark);
    }

    public function updateRemarkPost(Request $request)
    {
        $remark = Remark::find($request->id);
        
        $remark->title = $request->title;
        $remark->status = $request->status;

        $remark->update();

        return redirect('admin/remark')->with('success', 'Remark Updated Successfully!');
    }

    public function deleteRemark($id){

        $delete = Remark::where('id', '=', $id)->delete();

        return redirect()->back()->with('success', 'Remark Deleted Successfully!');
    }   
}

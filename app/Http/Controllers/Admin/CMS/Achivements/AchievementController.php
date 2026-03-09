<?php

namespace App\Http\Controllers\Admin\CMS\Achivements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class AchievementController extends Controller
{

    // LIST
    public function index()
    {
        $achievements = DB::table('fs_achievements')
                        ->orderBy('year','DESC')
                        ->get();
        return view('admin.CMS.Achivements.index',compact('achievements'));
    }

    // ADD FORM
    public function create()
    {
        return view('admin.CMS.Achivements.add');
    }

    // STORE
    public function store(Request $request)
    {

        $request->validate([
            'year' => 'required',
            'overview' => 'required'
        ]);

        DB::table('fs_achievements')->insert([
            'year' => $request->year,
            'overview' => $request->overview,
            'infrastructure' => $request->infrastructure,
            'recruitment_training' => $request->recruitment_training,
            'fire_rescue' => $request->fire_rescue,
            'public_awareness' => $request->public_awareness,
            'vip_duties' => $request->vip_duties,
            'created_at' => now()
        ]);

        return redirect()->route('admin.achievement')->with('success','Achievement Added Successfully');

    }


    // EDIT
    public function edit($id)
    {
        $data = DB::table('fs_achievements')->where('id',$id)->first();

        return view('admin.CMS.Achivements.edit',compact('data'));
    }


    // UPDATE
    public function update(Request $request)
    {

        $request->validate([
            'year' => 'required',
            'overview' => 'required'
        ]);

        DB::table('fs_achievements')
        ->where('id',$request->id)
        ->update([
            'year' => $request->year,
            'overview' => $request->overview,
            'infrastructure' => $request->infrastructure,
            'recruitment_training' => $request->recruitment_training,
            'fire_rescue' => $request->fire_rescue,
            'public_awareness' => $request->public_awareness,
            'vip_duties' => $request->vip_duties,
            'updated_at' => now()
        ]);

        return redirect()->route('admin.CMS.Achivements')->with('success','Achievement Updated Successfully');

    }


    // DELETE
    public function delete($id)
    {
        DB::table('fs_achievements')->where('id',$id)->delete();

        return redirect()->back()->with('success','Achievement Deleted Successfully');
    }

}
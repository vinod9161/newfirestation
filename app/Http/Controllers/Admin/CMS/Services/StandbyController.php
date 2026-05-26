<?php

namespace App\Http\Controllers\Admin\CMS\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class StandbyController extends Controller
{
    public function index()
    {
        $data['standby'] = DB::table('pages_card')
            ->where('page_name', 'standby')
            ->orderBy('id', 'DESC')
            ->get();

        return view(
            'admin.CMS.Services.standby.index',
            $data
        );
    }



    public function add()
    {
        return view('admin.CMS.Services.standby.add');
    }



    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'hadding' => 'required',

            'description' => 'required',

            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',

        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $image = '';

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $image = time().'.'.$file->getClientOriginalExtension();

            $file->move(
                public_path('admin/services/standby'),
                $image
            );
        }

        $data = [

            'page_name' => 'standby',

            'hadding' => $request->hadding,

            'content' => $request->description,

            'image' => $image,

            'status' => 'Active',

            'create_by' => '',

        ];

        DB::table('pages_card')->insert($data);

        return redirect()
            ->route('admin.services.standby')
            ->with('success', 'Standby content added successfully.');
    }



    public function edit($id)
    {
        $data['standby'] = DB::table('pages_card')
            ->where('id', $id)
            ->first();

        return view(
            'admin.CMS.Services.standby.edit',
            $data
        );
    }



    public function update(Request $request, $id)
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

            $file = $request->file('image');

            $image = time().'.'.$file->getClientOriginalExtension();

            $file->move(
                public_path('admin/services/standby'),
                $image
            );

            $data['image'] = $image;
        }

        DB::table('pages_card')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.services.standby')
            ->with('success', 'Standby content updated successfully.');
    }



    public function destroy($id)
    {
        DB::table('pages_card')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.services.standby')
            ->with('success', 'Standby content deleted successfully.');
    }
}

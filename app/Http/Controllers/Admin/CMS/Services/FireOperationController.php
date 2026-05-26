<?php

namespace App\Http\Controllers\Admin\CMS\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FireOperationController extends Controller
{
    public function adminIndex()
    {
        $data['operations'] = DB::table('pages_card')
            ->where('page_name', 'fire_operation')
            ->orderBy('id', 'DESC')
            ->get();

        return view(
            'admin.CMS.Services.fire_operation.index',
            $data
        );
    }



    public function add()
    {
        return view('admin.CMS.Services.fire_operation.add');
    }



    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'operation_type' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'page_name' => 'fire_operation',
            'hadding' => $request->hadding,
            'image_position' => $request->operation_type,
            'content' => $request->description,
            'image' => '',
            'image1' => '',
            'status' => 'Active',
            'create_by' => '',
        ];

        DB::table('pages_card')->insert($data);

        return redirect()
            ->route('admin.services.fire-operation')
            ->with('success', 'Operation added successfully.');
    }



    public function edit($id)
    {
        $data['operation'] = DB::table('pages_card')
            ->where('id', $id)
            ->first();

        return view(
            'admin.CMS.Services.fire_operation.edit',
            $data
        );
    }



    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'operation_type' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'hadding' => $request->hadding,
            'image_position' => $request->operation_type,
            'content' => $request->description,
        ];

        DB::table('pages_card')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.services.fire-operation')
            ->with('success', 'Operation updated successfully.');
    }



    public function destroy($id)
    {
        DB::table('pages_card')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.services.fire-operation')
            ->with('success', 'Operation deleted successfully.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Service::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->is_active ? 1 : 0
        ]);

        return redirect()->route('services.index')->with('success','Created');
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);

        $service->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'is_active' => $request->is_active ? 1 : 0
        ]);

        return redirect()->route('services.index')->with('success','Updated');
    }

    public function destroy($id)
    {
        Service::destroy($id);
        return back()->with('success','Deleted');
    }

    // 🔥 Toggle Active/Inactive
    public function toggle($id)
    {
        $service = Service::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();

        return back()->with('success','Status Updated');
    }
}
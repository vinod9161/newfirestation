<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingRule;
use App\Models\Service;
use Illuminate\Http\Request;

class PricingRuleController extends Controller
{
    public function index()
    {
        $rules = PricingRule::with('service')->orderBy('priority')->get();
        return view('admin.pricing_rules.index', compact('rules'));
    }

    public function create()
    {
        $services = Service::pluck('name','id');
        return view('admin.pricing_rules.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required',
            'rate' => 'required|numeric',
            'rate_type' => 'required'
        ]);

        PricingRule::create([
            'service_id' => $request->service_id,
            'min_sq_ft' => $request->min_sq_ft,
            'max_sq_ft' => $request->max_sq_ft,
            'min_height' => $request->min_height,
            'max_height' => $request->max_height,
            'min_gathering' => $request->min_gathering,
            'max_gathering' => $request->max_gathering,
            'min_hours' => $request->min_hours,
            'max_hours' => $request->max_hours,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'priority' => $request->priority ?? 1,
            'is_active' => $request->is_active ? 1 : 0,
        ]);

        return redirect()->route('pricing-rules.index')
            ->with('success','Pricing rule created successfully');
    }

    public function edit($id)
    {
        $rule = PricingRule::findOrFail($id);
        $services = Service::pluck('name','id');

        return view('admin.pricing_rules.edit', compact('rule','services'));
    }

    public function update(Request $request, $id)
    {
        $rule = PricingRule::findOrFail($id);

        $rule->update([
            'service_id' => $request->service_id,
            'min_sq_ft' => $request->min_sq_ft,
            'max_sq_ft' => $request->max_sq_ft,
            'min_height' => $request->min_height,
            'max_height' => $request->max_height,
            'min_gathering' => $request->min_gathering,
            'max_gathering' => $request->max_gathering,
            'min_hours' => $request->min_hours,
            'max_hours' => $request->max_hours,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'priority' => $request->priority ?? 1,
            'is_active' => $request->is_active ? 1 : 0,
        ]);

        return redirect()->route('pricing-rules.index')
            ->with('success','Pricing rule updated');
    }

    public function toggle($id)
    {
        $rule = PricingRule::findOrFail($id);

        // toggle status
        $rule->is_active = $rule->is_active ? 0 : 1;
        $rule->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    public function destroy($id)
    {
        PricingRule::destroy($id);
        return redirect()->back()->with('success','Deleted');
    }
}
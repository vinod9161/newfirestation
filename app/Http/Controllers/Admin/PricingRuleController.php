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
        $rules = PricingRule::with('service')
            ->orderBy('priority')
            ->get();

        return view('admin.pricing_rules.index', compact('rules'));
    }

    public function create()
    {
        $services = Service::where('is_active', 1)
            ->pluck('name', 'id');

        return view('admin.pricing_rules.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id'        => 'required|exists:services,id',
            'rate'              => 'required|numeric|min:0',
            'rate_type'         => 'required',

            'processing_fee'    => 'nullable|numeric|min:0',
            'cgst_percent'      => 'nullable|numeric|min:0',
            'sgst_percent'      => 'nullable|numeric|min:0',

            'min_sq_meter'      => 'nullable|numeric|min:0',
            'max_sq_meter'      => 'nullable|numeric|min:0',

            'min_height'        => 'nullable|numeric|min:0',
            'max_height'        => 'nullable|numeric|min:0',

            'min_gathering'     => 'nullable|integer|min:0',
            'max_gathering'     => 'nullable|integer|min:0',

            'min_hours'         => 'nullable|numeric|min:0',
            'max_hours'         => 'nullable|numeric|min:0',
        ]);

        PricingRule::create([

            'service_id'        => $request->service_id,

            // CONDITIONS
            'min_sq_meter'      => $request->min_sq_meter,
            'max_sq_meter'      => $request->max_sq_meter,

            'min_height'        => $request->min_height,
            'max_height'        => $request->max_height,

            'min_gathering'     => $request->min_gathering,
            'max_gathering'     => $request->max_gathering,

            'min_hours'         => $request->min_hours,
            'max_hours'         => $request->max_hours,

            // PRICING
            'rate'              => $request->rate,
            'rate_type'         => $request->rate_type,

            'processing_fee'    => $request->processing_fee ?? 0,
            'cgst_percent'      => $request->cgst_percent ?? 9,
            'sgst_percent'      => $request->sgst_percent ?? 9,

            // CONTROL
            'priority'          => $request->priority ?? 1,
            'is_active'         => $request->is_active ? 1 : 0,
        ]);

        return redirect()
            ->route('pricing-rules.index')
            ->with('success', 'Pricing rule created successfully');
    }

    public function edit($id)
    {
        $rule = PricingRule::findOrFail($id);

        $services = Service::where('is_active', 1)
            ->pluck('name', 'id');

        return view(
            'admin.pricing_rules.edit',
            compact('rule', 'services')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_id'        => 'required|exists:services,id',
            'rate'              => 'required|numeric|min:0',
            'rate_type'         => 'required',

            'processing_fee'    => 'nullable|numeric|min:0',
            'cgst_percent'      => 'nullable|numeric|min:0',
            'sgst_percent'      => 'nullable|numeric|min:0',

            'min_sq_meter'      => 'nullable|numeric|min:0',
            'max_sq_meter'      => 'nullable|numeric|min:0',

            'min_height'        => 'nullable|numeric|min:0',
            'max_height'        => 'nullable|numeric|min:0',

            'min_gathering'     => 'nullable|integer|min:0',
            'max_gathering'     => 'nullable|integer|min:0',

            'min_hours'         => 'nullable|numeric|min:0',
            'max_hours'         => 'nullable|numeric|min:0',
        ]);

        $rule = PricingRule::findOrFail($id);
        

        $rule->update([

            'service_id'        => $request->service_id,

            // CONDITIONS
            'min_sq_meter'      => $request->min_sq_meter,
            'max_sq_meter'      => $request->max_sq_meter,

            'min_height'        => $request->min_height,
            'max_height'        => $request->max_height,

            'min_gathering'     => $request->min_gathering,
            'max_gathering'     => $request->max_gathering,

            'min_hours'         => $request->min_hours,
            'max_hours'         => $request->max_hours,

            // PRICING
            'rate'              => $request->rate,
            'rate_type'         => $request->rate_type,

            'processing_fee'    => $request->processing_fee ?? 0,
            'cgst_percent'      => $request->cgst_percent ?? 9,
            'sgst_percent'      => $request->sgst_percent ?? 9,

            // CONTROL
            'priority'          => $request->priority ?? 1,
            'is_active'         => $request->is_active ? 1 : 0,
        ]);

        return redirect()
            ->route('pricing-rules.index')
            ->with('success', 'Pricing rule updated successfully');
    }

    public function toggle($id)
    {
        $rule = PricingRule::findOrFail($id);

        $rule->is_active = $rule->is_active ? 0 : 1;

        $rule->save();

        return redirect()
            ->back()
            ->with('success', 'Status updated successfully');
    }

    public function destroy($id)
    {
        PricingRule::destroy($id);

        return redirect()
            ->back()
            ->with('success', 'Deleted successfully');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportFeeMaster;

class ReportFeeMasterController extends Controller
{
    public function index()
    {
        $reports=ReportFeeMaster::get();

        return view(
            'admin.report_fee_master.index',
            compact('reports')
        );
    }

    public function edit($id)
    {
        $report=ReportFeeMaster::findOrFail($id);

        return view(
            'admin.report_fee_master.edit',
            compact('report')
        );
    }

    public function update(Request $request,$id)
    {
        $request->validate([

            'processing_fee'=>'required|numeric',

            'cgst_percent'=>'required|numeric',

            'sgst_percent'=>'required|numeric'

        ]);

        $report=ReportFeeMaster::findOrFail($id);

        $report->update([

            'processing_fee'=>$request->processing_fee,

            'cgst_percent'=>$request->cgst_percent,

            'sgst_percent'=>$request->sgst_percent

        ]);

        return redirect()
            ->route('report-fee-master.index')
            ->with(
                'success',
                'Report fee updated successfully.'
            );
    }
}
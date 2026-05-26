<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PersonnelExpenseRegister;
use App\Models\DesignationMaster;

class PersonnelExpenseController extends Controller
{
    public function index()
    {
        $expenses=PersonnelExpenseRegister::with(
                'designation'
            )
            ->latest()
            ->get();

        return view(
            'admin.personnel_expense.index',
            compact('expenses')
        );
    }

    public function create()
    {
        $designations=DesignationMaster::where(
                'is_active',
                1
            )
            ->pluck(
                'designation_name',
                'id'
            );

        return view(
            'admin.personnel_expense.create',
            compact('designations')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'designation_id'=>'required',
            'monthly_basic_expense'=>'required',
            'da_percent'=>'required'
        ]);

        PersonnelExpenseRegister::create([
            'designation_id'=>$request->designation_id,
            'monthly_basic_expense'=>$request->monthly_basic_expense,
            'da_percent'=>$request->da_percent
        ]);

        return redirect()
            ->route('personnel-expense.index')
            ->with(
                'success',
                'Personnel expense created successfully'
            );
    }

    public function edit($id)
    {
        $expense=PersonnelExpenseRegister::findOrFail($id);

        $designations=DesignationMaster::where(
                'is_active',
                1
            )
            ->pluck(
                'designation_name',
                'id'
            );

        return view(
            'admin.personnel_expense.edit',
            compact(
                'expense',
                'designations'
            )
        );
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'designation_id'=>'required',
            'monthly_basic_expense'=>'required',
            'da_percent'=>'required'
        ]);

        $expense=PersonnelExpenseRegister::findOrFail($id);

        $expense->update([
            'designation_id'=>$request->designation_id,
            'monthly_basic_expense'=>$request->monthly_basic_expense,
            'da_percent'=>$request->da_percent
        ]);

        return redirect()
            ->route('personnel-expense.index')
            ->with(
                'success',
                'Personnel expense updated successfully'
            );
    }

    public function destroy($id)
    {
        PersonnelExpenseRegister::findOrFail($id)
            ->delete();

        return redirect()
            ->back()
            ->with(
                'success',
                'Personnel expense deleted successfully'
            );
    }
}
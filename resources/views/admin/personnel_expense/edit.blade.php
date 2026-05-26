@extends('layouts.admin.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>
        <h5 class="main-content-title fs-24 mb-0">
            Edit Personnel Expense
        </h5>
    </div>

    <div>

        <a href="{{ route('personnel-expense.index') }}"
            class="btn btn-success">
            Expense List
        </a>

    </div>

</div>

<div class="card custom-card">

    <div class="card-body">

        @if ($errors->any())

        <div class="alert alert-danger">

            <ul style="margin-bottom:0;">

                @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

        @endif

        <form
            method="POST"
            action="{{ route('personnel-expense.update',$expense->id) }}">

            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            Designation
                        </label>

                        <select
                            name="designation_id"
                            class="form-control js-example-basic-single"
                            required>

                            <option value="">
                                Select Designation
                            </option>

                            @foreach($designations as $id=>$name)

                            <option
                                value="{{ $id }}"
                                {{ $expense->designation_id==$id ? 'selected' : '' }}>
                                {{ $name }}
                            </option>

                            @endforeach

                        </select>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            Monthly Basic Expense
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="monthly_basic_expense"
                            class="form-control"
                            value="{{ $expense->monthly_basic_expense }}"
                            required>

                    </div>

                </div>

                <div class="col-md-4">

                    <div class="form-group">

                        <label>
                            DA %
                        </label>

                        <input
                            type="number"
                            step="0.01"
                            name="da_percent"
                            class="form-control"
                            value="{{ $expense->da_percent }}"
                            required>

                    </div>

                </div>

                <div class="col-md-12 mt-3">

                    <button
                        type="submit"
                        class="btn btn-primary"
                        style="width:20%;">
                        Update
                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection
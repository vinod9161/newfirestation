@extends('layouts.admin.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>
        <h5 class="main-content-title fs-24 mb-0">
            Personnel Expense List
        </h5>
    </div>

    <div>
        <a href="{{ route('personnel-expense.create') }}"
            class="btn btn-primary">
            Add Personnel Expense
        </a>
    </div>

</div>

<div class="card custom-card">

    <div class="card-body">

        @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

        @endif

        <div class="table-responsive">

            <table class="table table-bordered">

                <thead>

                    <tr>
                        <th>#</th>
                        <th>Designation</th>
                        <th>Monthly Basic Expense</th>
                        <th>DA %</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    @foreach($expenses as $key=>$expense)

                    <tr>

                        <td>
                            {{ $key+1 }}
                        </td>

                        <td>
                            {{ $expense->designation->designation_name ?? '' }}
                        </td>

                        <td>
                            {{ number_format($expense->monthly_basic_expense,2) }}
                        </td>

                        <td>
                            {{ $expense->da_percent }}%
                        </td>

                        <td>

                            <a href="{{ route('personnel-expense.edit',$expense->id) }}"
                                class="btn btn-success btn-sm">
                                Edit
                            </a>

                            <form
                                action="{{ route('personnel-expense.destroy',$expense->id) }}"
                                method="POST"
                                style="display:inline-block;">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
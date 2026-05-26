@extends('layouts.admin.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>

        <h5 class="main-content-title fs-24 mb-0">
            Report Fee Master
        </h5>

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

                        <th>
                            #
                        </th>

                        <th>
                            Report Type
                        </th>

                        <th>
                            Processing Fee
                        </th>

                        <th>
                            CGST %
                        </th>

                        <th>
                            SGST %
                        </th>

                        <th width="100">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($reports as $key=>$report)

                    <tr>

                        <td>
                            {{ $key+1 }}
                        </td>

                        <td>
                            {{ ucwords(str_replace('_',' ',$report->report_type)) }}
                        </td>

                        <td>
                            ₹ {{ number_format($report->processing_fee,2) }}
                        </td>

                        <td>
                            {{ $report->cgst_percent }} %
                        </td>

                        <td>
                            {{ $report->sgst_percent }} %
                        </td>

                        <td>

                            <a href="{{ route('report-fee-master.edit',$report->id) }}"
                                class="btn btn-primary btn-sm">

                                Edit

                            </a>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
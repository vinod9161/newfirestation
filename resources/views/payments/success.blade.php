@extends('layouts.citizen.template')

@section('content')

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body text-center">

            <div class="mb-4">

                <i
                    class="fa fa-check-circle text-success"
                    style="font-size:80px;"
                ></i>

            </div>

            <h2 class="text-success mb-3">
                Payment Successful
            </h2>

            <p class="mb-4">
                Your application payment has been completed successfully.
            </p>

            <table class="table table-bordered">

                <tr>
                    <th width="40%">Application No</th>
                    <td>
                        {{ $application->application_no }}
                    </td>
                </tr>

                <tr>
                    <th>Transaction ID</th>
                    <td>
                        {{ $payment->transaction_id ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Amount Paid</th>
                    <td>
                        ₹ {{ number_format($payment->amount,2) }}
                    </td>
                </tr>

                <tr>
                    <th>Payment Date</th>
                    <td>
                        {{ $payment->paid_at ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="badge bg-success">
                            SUCCESS
                        </span>
                    </td>
                </tr>
            </table>
            <!-- <a href="{{ url('/') }}" class="btn btn-primary mt-3" > Go To Dashboard </a> -->
            <a href="{{ route('invoice.view',$application->application_no) }}" class="btn btn-success mt-3" target="_blank"> Download Invoice </a>
        </div>
    </div>
</div>

@endsection
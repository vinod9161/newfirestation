@extends('layouts.admin.template')
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title fs-24 mb-0">Service Bills</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div class="me-2">
            <a href="javascript:void(0);" class="btn ripple btn-wave  btn-secondary navresponsive-toggler mb-0"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1 fs-10"></i>
            </a>
        </div>
        <div>
        </div>
    </div>
</div>

<div class="responsive-background mb-3">

    <div class="collapse navbar-collapse"
         id="navbarSupportedContent">

        <form method="GET"
              action="{{ url()->current() }}"
              id="filterForm"
              class="advanced-search br-3 p-3">

            <div class="row">

                <div class="col-md-2 mb-3">
                    <label>Bill No</label>
                    <input type="text"
                           class="form-control"
                           name="bill_no"
                           value="{{ request('bill_no') }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label>Service Type</label>
                    <select class="form-control"
                            name="service_type">

                        <option value="">Select</option>

                        <option value="standby_duty"
                            {{ request('service_type')=='standby_duty'?'selected':'' }}>
                            Standby Duty
                        </option>

                        <option value="fire_report"
                            {{ request('service_type')=='fire_report'?'selected':'' }}>
                            Fire Report
                        </option>

                        <option value="rescue_report"
                            {{ request('service_type')=='rescue_report'?'selected':'' }}>
                            Rescue Report
                        </option>

                        <option value="relief_report"
                            {{ request('service_type')=='relief_report'?'selected':'' }}>
                            Relief Report
                        </option>

                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label>Request ID</label>
                    <input type="text"
                           class="form-control"
                           name="request_id"
                           value="{{ request('request_id') }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label>Payment Status</label>
                    <select class="form-control"
                            name="payment_status">

                        <option value="">Select</option>

                        <option value="pending"
                            {{ request('payment_status')=='pending'?'selected':'' }}>
                            Pending
                        </option>

                        <option value="paid"
                            {{ request('payment_status')=='paid'?'selected':'' }}>
                            Paid
                        </option>

                    </select>
                </div>

                <div class="col-md-2 mb-3">
                    <label>From Date</label>
                    <input type="date"
                           class="form-control"
                           name="from_date"
                           value="{{ request('from_date') }}">
                </div>

                <div class="col-md-2 mb-3">
                    <label>To Date</label>
                    <input type="date"
                           class="form-control"
                           name="to_date"
                           value="{{ request('to_date') }}">
                </div>

            </div>

            <div class="text-end">

                <button type="submit"
                        class="btn btn-primary">
                    Apply
                </button>

                <a href="{{ url()->current() }}"
                   class="btn btn-secondary">
                    Reset
                </a>

            </div>

        </form>

    </div>

</div>
<div class="card custom-card">
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">#</th>
                        <th>Bill No</th>
                        <th>Service Type</th>
                        <th>Request ID</th>
                        <th>Fuel Expense</th>
                        <th>Personnel Expense</th>
                        <th>Total Amount</th>
                        <th>Payment Status</th>
                        <th>Created Date</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($bills as $key=>$bill)
                    <tr>
                        <td>{{ $bills->firstItem()+$key }}</td>
                        <td>{{ $bill->bill_no }}</td>
                        <td>
                            <span class="badge bg-info">{{ ucwords(str_replace('_',' ',$bill->service_type)) }}</span>
                        </td>
                        <td>{{ $bill->service_request_id }}</td>
                        <td>₹ {{ number_format($bill->fuel_expense,2) }}</td>
                        <td>₹ {{ number_format($bill->personnel_expense,2) }}</td>
                        <td><strong>₹ {{ number_format($bill->total_amount,2) }}</strong></td>
                        <td>
                            @if($bill->payment_status=='paid')
                            <span class="badge bg-success">Paid</span>
                            @else
                            <span class="badge bg-danger">Pending</span>
                            @endif
                        </td>
                        <td>{{ date('d-m-Y h:i A',strtotime($bill->created_at)) }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('service-bills.show',$bill->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('service-bills.print',$bill->id) }}" class="btn btn-dark btn-sm" target="_blank">Print</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="10" class="text-center">No bills found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $bills->links() }}
        </div>
    </div>
</div>
<script>
    $('#filterForm').on('submit', function () {

        $(this).find(':input').each(function () {

            let type = $(this).attr('type');

            if (
                !$(this).val() &&
                type !== 'submit' &&
                type !== 'button' &&
                type !== 'hidden'
            ) {
                $(this).prop('disabled', true);
            }

        });

    });
</script>
@endsection
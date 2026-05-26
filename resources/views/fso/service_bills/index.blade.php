@extends('layouts.admin.template')
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title fs-24 mb-0">Service Bills</h5>
    </div>
    <div class="d-flex gap-2">
        <!-- <a href="{{ route('service-bills.export') }}" class="btn btn-success">
            <i class="fe fe-download"></i> Export CSV
        </a> -->
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
@endsection
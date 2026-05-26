@extends('layouts.admin.template')

@section('content')

<div class="card custom-card">

<div class="card-header d-flex justify-content-between align-items-center">

<div class="card-title">
Service Bill Details
</div>

<div>

@if($bill->payment_status=='paid')

<span class="badge bg-success">
Paid
</span>

@else

<span class="badge bg-danger">
Pending
</span>

@endif

</div>

</div>

<div class="card-body">

<div class="row mb-4">

<div class="col-md-3">

<label class="fw-bold">
Bill No
</label>

<p>
{{ $bill->bill_no }}
</p>

</div>

<div class="col-md-3">

<label class="fw-bold">
Service Type
</label>

<p>
{{ ucwords(str_replace('_',' ',$bill->service_type)) }}
</p>

</div>

<div class="col-md-3">

<label class="fw-bold">
Total Amount
</label>

<p>
₹ {{ number_format($bill->total_amount,2) }}
</p>

</div>

<div class="col-md-3">

<label class="fw-bold">
Generated Date
</label>

<p>
{{ date('d-m-Y h:i A',strtotime($bill->created_at)) }}
</p>

</div>

</div>

@if(
in_array($bill->service_type,[
'standby_duty',
'pumping_work'
])
)

<hr>

<h5 class="mb-3">
Personnel Expense
</h5>

<div class="table-responsive mb-4">

<table class="table table-bordered">

<thead>

<tr>

<th>
Designation
</th>

<th>
No Of Person
</th>

<th>
Per Person Expense
</th>

<th>
DA %
</th>

<th>
Total
</th>

</tr>

</thead>

<tbody>

@foreach($personnels as $person)

<tr>

<td>
{{ $person->designation->designation_name ?? '' }}
</td>

<td>
{{ $person->no_of_person }}
</td>

<td>
₹ {{ number_format($person->per_person_expense,2) }}
</td>

<td>
{{ number_format($person->da_amount,2) }} %
</td>

<td>
₹ {{ number_format($person->total_amount,2) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<h5 class="mb-3">
Vehicle Expense
</h5>

<div class="table-responsive mb-4">

<table class="table table-bordered">

<thead>

<tr>

<th>
Vehicle
</th>

<th>
Mileage Type
</th>

<th>
Mileage
</th>

<th>
Running Value
</th>

<th>
Total
</th>

</tr>

</thead>

<tbody>

@foreach($vehicles as $vehicle)

<tr>

<td>
{{ $vehicle->vehicle->type ?? '' }}
</td>

<td>
{{ $vehicle->mileage_type }}
</td>

<td>
{{ $vehicle->mileage_value }}
</td>

<td>
{{ $vehicle->running_value }}
</td>

<td>
₹ {{ number_format($vehicle->total_expense,2) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

<h5 class="mb-3">
Equipment Expense
</h5>

<div class="table-responsive mb-4">

<table class="table table-bordered">

<thead>

<tr>

<th>
Equipment
</th>

<th>
Mileage Type
</th>

<th>
Mileage
</th>

<th>
Running Value
</th>

<th>
Total
</th>

</tr>

</thead>

<tbody>

@foreach($equipments as $equipment)

<tr>

<td>
{{ $equipment->equipment->name ?? '' }}
</td>

<td>
{{ $equipment->mileage_type }}
</td>

<td>
{{ $equipment->mileage_value }}
</td>

<td>
{{ $equipment->running_value }}
</td>

<td>
₹ {{ number_format($equipment->total_expense,2) }}
</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endif

<div class="card">

<div class="card-header bg-primary text-white">
Billing Summary
</div>

<div class="card-body p-0">

<table class="table table-bordered mb-0">

@if(
in_array($bill->service_type,[
'standby_duty',
'pumping_work'
])
)

<tr>

<th width="70%">
Fuel expense for movement of Fire Vehicles & Equipments
</th>

<td width="30%">
₹ {{ number_format($bill->fuel_expense,2) }}
</td>

</tr>

<tr>

<th>
Depreciation expenses of vehicle 25% of fuel expenses
</th>

<td>
₹ {{ number_format($bill->depreciation_expense,2) }}
</td>

</tr>

<tr>

<th>
Salary / Allowances for Personnel etc.
</th>

<td>
₹ {{ number_format($bill->personnel_expense,2) }}
</td>

</tr>

@else

<tr>

<th width="70%">
Processing Fee
</th>

<td width="30%">
₹ {{ number_format($bill->processing_fee,2) }}
</td>

</tr>

@endif

<tr>

<th>
CGST @9%
</th>

<td>
₹ {{ number_format($bill->cgst_amount,2) }}
</td>

</tr>

<tr>

<th>
SGST @9%
</th>

<td>
₹ {{ number_format($bill->sgst_amount,2) }}
</td>

</tr>

<tr class="table-primary">

<th>
Total Amount
</th>

<th>
₹ {{ number_format($bill->total_amount,2) }}
</th>

</tr>

</table>

</div>

</div>

@if($bill->payment_status=='pending')

<div class="text-center mt-4">

<img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data={{ urlencode('upi://pay?pa=9161830835@okaxis&pn=Vinod Sharma&am='.$bill->total_amount.'&cu=INR') }}"
alt="QR Code">

<p class="mt-3 fw-bold">
Scan QR To Pay
</p>

</div>

@endif

<div class="mt-4 text-center">

<a href="{{ route('service-bills.index') }}"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</div>

@endsection
<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">

<title>
Service Bill
</title>

<style>

body{
margin:0;
padding:0;
font-family:Arial,sans-serif;
background:#f2f2f2;
font-size:12px;
color:#000;
}

.pdf-wrapper{
width:900px;
margin:20px auto;
background:#fff;
padding:15px;
border:1px solid #000;
}

table{
width:100%;
border-collapse:collapse;
margin-top:10px;
}

table,th,td{
border:1px solid #cfcfcf;
}

th,td{
padding:6px 10px;
font-size:12px;
vertical-align:middle;
}

th{
background:#efefef;
text-align:left;
}

.text-center{
text-align:center;
}

.border-none{
border:none !important;
}

.heading{
font-size:22px;
font-weight:bold;
line-height:30px;
}

.sub-heading{
font-size:16px;
font-weight:bold;
margin-top:10px;
}

.section-title{
background:#d9d9d9;
font-weight:bold;
text-align:center;
font-size:13px;
}

.footer-text{
font-size:11px;
text-align:center;
margin-top:20px;
line-height:18px;
}

.signature-box{
width:33%;
text-align:center;
display:inline-block;
vertical-align:top;
margin-top:30px;
}

.print-btn{
text-align:center;
margin-top:20px;
}

.print-btn button{
padding:8px 20px;
background:#000;
color:#fff;
border:none;
cursor:pointer;
}

</style>

</head>

<body>

<div class="pdf-wrapper" id="printArea">

<table class="border-none">

<tr>

<td class="border-none" width="20%">

<img src="{{ asset('/public/admin/images/fire-logo.png') }}"
style="width:120px;">

</td>

<td class="border-none text-center" width="60%">

<div class="heading">
उत्तराखण्ड अग्निशमन एवं आपात सेवा
</div>

<div class="heading">
Uttarakhand Fire & Emergency Service
</div>

<div style="line-height:20px;margin-top:8px;">

मुख्यालय - चतुर्थ तल, सरदार पटेल भवन<br>

कोर्ट रोड, देहरादून, उत्तराखंड - 248001<br>

Headquarter - IV Floor, Sardar Patel Bhavan<br>

Court Road, Dehradun, Uttarakhand - 248001

</div>

<div class="sub-heading">
SERVICE BILL
</div>

</td>

<td class="border-none text-center" width="20%">

@if($bill->payment_status=='pending')

<img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=upi://pay?pa=test@upi&pn=FireService&am={{ $bill->total_amount }}">

@endif

</td>

</tr>

</table>

<table>

<tr>

<th width="25%">
Bill No
</th>

<td width="25%">
{{ $bill->bill_no }}
</td>

<th width="25%">
Service Type
</th>

<td width="25%">
{{ ucwords(str_replace('_',' ',$bill->service_type)) }}
</td>

</tr>

<tr>

<th>
Request ID
</th>

<td>
{{ $bill->service_request_id }}
</td>

<th>
Generated Date
</th>

<td>
{{ date('d-m-Y h:i A',strtotime($bill->created_at)) }}
</td>

</tr>

<tr>

<th>
Payment Status
</th>

<td colspan="3">

@if($bill->payment_status=='paid')

<span style="color:green;font-weight:bold;">
PAID
</span>

@else

<span style="color:red;font-weight:bold;">
PENDING
</span>

@endif

</td>

</tr>

</table>

@if(
in_array($bill->service_type,[
'standby_duty',
'pumping_work'
])
)

<table>

<tr>

<th colspan="5" class="section-title">
Personnel Expense Details
</th>

</tr>

<tr>

<th>
Designation
</th>

<th>
No Of Person
</th>

<th>
Expense
</th>

<th>
DA %
</th>

<th>
Total
</th>

</tr>

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

</table>

<table>

<tr>

<th colspan="5" class="section-title">
Vehicle Expense Details
</th>

</tr>

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

</table>

<table>

<tr>

<th colspan="5" class="section-title">
Equipment Expense Details
</th>

</tr>

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

</table>

@endif

<table>

<tr>

<th colspan="2" class="section-title">
Billing Summary
</th>

</tr>

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

<tr>

<th>
Total Amount
</th>

<th>
₹ {{ number_format($bill->total_amount,2) }}
</th>

</tr>

</table>

<div style="margin-top:20px;">

<div class="signature-box">

<strong>
Prepared By
</strong>

<br><br>

__________________

</div>

<div class="signature-box">

<strong>
Verified By
</strong>

<br><br>

__________________

</div>

<div class="signature-box">

<strong>
Approved By
</strong>

<br><br>

__________________

</div>

</div>

<div class="footer-text">

Bill No : {{ $bill->bill_no }}

<br>

Printed Date Time : {{ date('Y-m-d H:i:s') }}

<br>

This is computer generated service bill.

</div>

</div>

<div class="print-btn">

<button onclick="printDiv()">
Print
</button>

</div>

<script>

function printDiv(){

var printContents=document.getElementById('printArea').innerHTML;

var originalContents=document.body.innerHTML;

document.body.innerHTML=printContents;

window.print();

document.body.innerHTML=originalContents;

location.reload();

}

</script>

</body>

</html>
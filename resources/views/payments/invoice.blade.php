<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Payment Invoice</title>

<style>

body{
    margin:0;
    padding:0;
    font-family:Arial,sans-serif;
    background:#000;
}

.pdf-wrapper{
    background-color:#fff;
    width:100%;
    max-width:800px;
    margin:50px auto;
    padding:20px;
    box-sizing:border-box;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}

th,td{
    border:1px solid #ddd;
    padding:5px 10px;
    text-align:left;
    font-size:12px;
    vertical-align:middle;
    color:#000;
}

th{
    font-weight:bold;
}

.border-none{
    border:none !important;
}

.section-title{
    background:#cccccc;
    text-align:center;
    font-weight:bold;
}

.print-btn{
    padding:8px 20px;
    background:#0d6efd;
    color:#fff;
    border:none;
    cursor:pointer;
    border-radius:4px;
    font-size:13px;
}

@media print{

    .print-btn-box{
        display:none;
    }

    body{
        background:#fff;
    }

    .pdf-wrapper{
        margin:0;
        max-width:100%;
    }

}

</style>

</head>

<body>

<div class="pdf-wrapper">

<div id="invoice-content" style="width:95%;border:1px solid #000;margin:0 auto;padding:5px 10px;box-shadow:none;height:auto;margin-bottom:20px;margin-top:20px;">

<div style="text-align:center;margin-bottom:10px;display:flex;">

<div style="width:20%;">

<img src="{{ asset('/public/admin/images/fire-logo.png') }}" style="width:130px;height:auto;display:block;margin:0 auto;">

</div>

<div style="width:60%;text-align:center;">

<p style="line-height:20px;text-align:center;color:#000;font-weight:bold;margin-top:10px;font-size:16px;">
उत्तराखंड अग्निशमन एवं आपात सेवा <br>
Uttarakhand Fire & Emergency Service
</p>

<p style="font-size:12px;color:#000;line-height:20px;">
मुख्यालय - चतुर्थ तल, सरदार पटेल भवन <br>
कोर्ट रोड, देहरादून, उत्तराखंड - 248001 <br>
Headquarter - IV Floor, Sardar Patel Bhavan <br>
Court Road, Dehradun, Uttarakhand - 248001 <br>
GST No : 05ABCDE1234F1Z5
</p>

<p style="line-height:20px;text-align:center;color:#000;font-weight:bold;font-size:15px;margin-top:10px;">
भुगतान चालान / PAYMENT INVOICE
</p>

</div>

<div style="width:20%;text-align:right;margin-top:10px;">

@if(!empty($application->application_qr_code))

<img
src="{{ asset('public/qrcodes/'.$application->application_qr_code) }}"
style="width:120px;height:auto;display:block;margin:0 auto;"
>

@endif

</div>

</div>

<table>

<tr>

<th colspan="4" class="section-title">
Application Details / आवेदन विवरण
</th>

</tr>

<tr>

<th width="25%">
Application No
</th>

<td width="25%">
{{ $application->application_no }}
</td>

<th width="25%">
Invoice ID
</th>

<td width="25%">
INV-{{ date('Y') }}-{{ $payment->id }}
</td>

</tr>

<tr>

<th>
Payment Status
</th>

<td>
SUCCESS
</td>

<th>
Payment Date
</th>

<td>
{{ date('d-m-Y h:i A',strtotime($payment->paid_at)) }}
</td>

</tr>

<tr>

<th>
Applicant Name
</th>

<td>
{{ $application->building_name }}
</td>

<th>
Transaction ID
</th>

<td>
{{ $payment->transaction_id }}
</td>

</tr>

<tr>

<th>
Order ID
</th>

<td>
{{ $payment->order_id }}
</td>

<th>
Service Type
</th>

<td>
{{ strtoupper(str_replace('_',' ',$payment->service_type)) }}
</td>

</tr>

</table>

<table>

<tr>

<th colspan="2" class="section-title">
Payment Calculation Details / शुल्क विवरण
</th>

</tr>

<tr>

<th width="70%">
Total Covered Area
</th>

<td width="30%">
{{ number_format($covered_area,2) }} Sqmt
</td>

</tr>

<tr>

<th>
Per Sq. Meter Rate
</th>

<td>
₹ {{ number_format($per_meter_rate,2) }}
</td>

</tr>

<tr>

<th>
NOC Charges
</th>

<td>
₹ {{ number_format($noc_charges,2) }}
</td>

</tr>

<tr>

<th>
Processing Fee
</th>

<td>
₹ {{ number_format($processing_fee,2) }}
</td>

</tr>

<tr>

<th>
CGST (9%)
</th>

<td>
₹ {{ number_format($cgst_amount,2) }}
</td>

</tr>

<tr>

<th>
SGST (9%)
</th>

<td>
₹ {{ number_format($sgst_amount,2) }}
</td>

</tr>

<tr>

<th>
Amount In Words
</th>

<td>
{{ ucwords(getIndianCurrency($total_amount)) }} Only
</td>

</tr>

<tr>

<th class="section-title">
Total Paid Amount
</th>

<th class="section-title">
₹ {{ number_format($total_amount,2) }}
</th>

</tr>

</table>

<div style="margin-top:20px;font-size:12px;text-align:center;color:#000;">
This is a computer generated invoice.
</div>

</div>

<div class="print-btn-box" style="text-align:center;">

<button
type="button"
class="print-btn"
onclick="printInvoice()"
>
Print Invoice
</button>

</div>

</div>

@php

function getIndianCurrency($number)
{
    $decimal=round($number-($no=floor($number)),2)*100;

    $hundred=null;

    $digits_length=strlen($no);

    $i=0;

    $str=[];

    $words=[
        0=>'',
        1=>'one',
        2=>'two',
        3=>'three',
        4=>'four',
        5=>'five',
        6=>'six',
        7=>'seven',
        8=>'eight',
        9=>'nine',
        10=>'ten',
        11=>'eleven',
        12=>'twelve',
        13=>'thirteen',
        14=>'fourteen',
        15=>'fifteen',
        16=>'sixteen',
        17=>'seventeen',
        18=>'eighteen',
        19=>'nineteen',
        20=>'twenty',
        30=>'thirty',
        40=>'forty',
        50=>'fifty',
        60=>'sixty',
        70=>'seventy',
        80=>'eighty',
        90=>'ninety'
    ];

    $digits=['','hundred','thousand','lakh','crore'];

    while($i < $digits_length){

        $divider=($i == 2) ? 10 : 100;

        $number=floor($no % $divider);

        $no=floor($no / $divider);

        $i += ($divider == 10) ? 1 : 2;

        if($number){

            $plural=((count($str) && $number > 9) ? 's' : null);

            $hundred=(count($str) == 1 && $str[0]) ? ' and ' : null;

            $str[] = ($number < 21)
                ? $words[$number]." ".$digits[count($str)].$plural." ".$hundred
                :
                $words[floor($number / 10) * 10]
                ." ".
                $words[$number % 10]
                ." ".
                $digits[count($str)]
                .$plural
                ." ".
                $hundred;
        }else{
            $str[] = null;
        }
    }

    $rupees=implode('',array_reverse($str));

    $paise=($decimal)
        ? " And ".$words[$decimal-$decimal%10]." ".$words[$decimal%10]." Paise"
        : '';

    return $rupees.'Rupees '.$paise;
}

@endphp

<script>

function printInvoice()
{
    var printContents=document.getElementById('invoice-content').innerHTML;

    var originalContents=document.body.innerHTML;

    document.body.innerHTML=printContents;

    window.print();

    document.body.innerHTML=originalContents;

    location.reload();
}

</script>

</body>

</html>
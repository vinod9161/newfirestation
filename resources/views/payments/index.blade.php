@extends('layouts.citizen.template')

@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container mt-4">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">

            <div class="d-flex justify-content-between align-items-center">

                <h4 class="mb-0">
                    {{ $title }}
                </h4>

                <span class="badge bg-light text-dark">
                    {{ strtoupper($service_type) }}
                </span>

            </div>

        </div>

        <div class="card-body">

            <div class="row">

                <div class="col-md-6">

                    <table class="table table-bordered">

                        <tr>
                            <th width="40%">Application No</th>
                            <td>
                                {{ $service->application_no ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Applicant Name</th>
                            <td>
                                {{ $service->building_name ?? '-' }}
                            </td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <td>
                                {{ Auth::user()->email }}
                            </td>
                        </tr>

                        <tr>
                            <th>Mobile</th>
                            <td>
                                {{ Auth::user()->number }}
                            </td>
                        </tr>

                        <tr>
                            <th>Total Covered Area</th>
                            <td>
                                {{ number_format($covered_area,2) }} Sq. Meter
                            </td>
                        </tr>

                    </table>

                </div>

                <div class="col-md-6">

                    <table class="table table-bordered">

                        <thead class="table-light">

                            <tr>
                                <th>Description</th>
                                <th width="30%">Amount</th>
                            </tr>

                        </thead>

                        <tbody>

                            <tr>
                                <td>Per Sq. Meter Rate</td>
                                <td>
                                    ₹ {{ number_format($per_meter_rate,2) }}
                                </td>
                            </tr>

                            <tr>
                                <td>NOC Charges</td>
                                <td>
                                    ₹ {{ number_format($noc_charges,2) }}
                                </td>
                            </tr>

                            <tr>
                                <td>Processing Fee</td>
                                <td>
                                    ₹ {{ number_format($processing_fee,2) }}
                                </td>
                            </tr>

                            <tr>
                                <td>CGST ({{ $cgst_percent }}%)</td>
                                <td>
                                    ₹ {{ number_format($cgst_amount,2) }}
                                </td>
                            </tr>

                            <tr>
                                <td>SGST ({{ $sgst_percent }}%)</td>
                                <td>
                                    ₹ {{ number_format($sgst_amount,2) }}
                                </td>
                            </tr>

                            <tr class="table-success">

                                <th>Total Payable</th>

                                <th>
                                    ₹ {{ number_format($total_amount,2) }}
                                </th>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            @if(!$payment || $payment->status!='success')

                <div class="text-end">

                    <button
                        type="button"
                        class="btn btn-success btn-lg"
                        id="payNowBtn"
                    >
                        Pay ₹ {{ number_format($total_amount,2) }}
                    </button>

                </div>

            @else

                <div class="alert alert-success">

                    Payment Completed Successfully

                </div>

            @endif

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>

$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click','#payNowBtn',function(){

    $.ajax({

        url:"{{ route('payment.createOrder') }}",

        type:"POST",

        data:{
            service_type:"{{ $service_type }}",
            application_no:"{{ $application_no }}",
            amount:"{{ $total_amount }}"
        },

        success:function(response){

            if(!response.status){

                alert('Unable to create payment');

                return;
            }

            var options={

                key:response.key,

                amount:response.amount,

                currency:"INR",

                name:"Fire Department",

                description:"Application Payment",

                order_id:response.order_id,

                handler:function(paymentResponse){

                    $.ajax({

                        url:"{{ route('payment.verify') }}",

                        type:"POST",

                        data:{
                            razorpay_order_id:paymentResponse.razorpay_order_id,
                            razorpay_payment_id:paymentResponse.razorpay_payment_id,
                            razorpay_signature:paymentResponse.razorpay_signature
                        },

                        success:function(res){

                            if(res.status){

                                window.location.href= "{{ url('payment-success/'.$application_no) }}";

                            }else{

                                alert('Payment Verification Failed');
                            }
                        }

                    });

                },

                prefill:{
                    name:"{{ Auth::user()->name ?? '' }}",
                    email:"{{ Auth::user()->email ?? '' }}",
                    contact:"{{ Auth::user()->number ?? '' }}"
                },

                notes:{
                    service_type:"{{ $service_type }}",
                    application_no:"{{ $application_no }}"
                },

                theme:{
                    color:"#198754"
                }

            };

            var rzp=new Razorpay(options);

            rzp.open();

        }

    });

});

</script>

@endsection
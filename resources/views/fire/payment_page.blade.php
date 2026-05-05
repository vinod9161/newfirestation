@extends('layouts.fire_new')

@section('content')

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
        <h1 class="breadcrumb-item">Standby Duties Payment</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('actionIndex') }}">
                        Home <i class="fa fa-angle-double-right"></i>
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="#">Services <i class="fa fa-angle-double-right"></i></a>
                </li>
                <li class="breadcrumb-item active">Payment</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Payment Section -->
<section class="contact-section" style="padding:40px 0;">
<div class="container">

<div class="row justify-content-center">
<div class="col-md-8">

<div class="card shadow-lg">

<div class="card-header bg-danger text-white">
    <h4 class="mb-0">Payment Details</h4>
</div>

<div class="card-body">

    <table class="table table-bordered">
        <tr>
            <th>Application ID</th>
            <td>{{ $id }}</td>
        </tr>

        <tr>
            <th>Name</th>
            <td>{{ $data[0]->name }}</td>
        </tr>

        <tr>
            <th>Program Type</th>
            <td>{{ $data[0]->program_type }}</td>
        </tr>

        <tr>
            <th>Crowd Size</th>
            <td>{{ $data[0]->crowd_size }}</td>
        </tr>

        <tr>
            <th>Total Amount</th>
            <td><strong>₹ {{ $amount }}</strong></td>
        </tr>
    </table>

    <div class="text-center mt-4">
        <button class="btn btn-success btn-lg" onclick="payNow('{{ $id }}')">
            Pay Now
        </button>
    </div>

</div>

</div>

</div>
</div>

</div>
</section>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
function payNow(applicationId) {

    $.post("{{ route('create.order') }}", {
        _token: "{{ csrf_token() }}",
        application_id: applicationId
    }, function(res) {

        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": res.amount * 100,
            "currency": "INR",
            "name": "Fire Service Department",
            "description": "Standby Duty Payment",
            "order_id": res.order_id,

            "handler": function (response) {

                $.post("{{ route('verify.payment') }}", {
                    _token: "{{ csrf_token() }}",
                    razorpay_order_id: response.razorpay_order_id,
                    razorpay_payment_id: response.razorpay_payment_id
                }, function() {

                    alert("Payment Successful");

                    window.location.href = "{{ url('payment-success') }}";
                });
            }
        };

        var rzp = new Razorpay(options);
        rzp.open();
    });
}
</script>

@endsection
@extends('layouts.fire_new')

@section('content')

<section class="contact-section" style="padding:60px 0;">
<div class="container text-center">

    <div class="card shadow-lg p-5">

        <h2 class="text-success mb-3">✅ Payment Successful</h2>

        <p>Your payment has been completed successfully.</p>

        <a href="{{ url('/') }}" class="btn btn-primary mt-3">
            Go to Home
        </a>

    </div>

</div>
</section>

@endsection
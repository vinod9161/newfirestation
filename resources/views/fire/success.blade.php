@extends('layouts.main')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Success</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Success</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

    <!-- ======= About Section ======= -->
    <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
        <div class="container">
  
          <div class="row">
            <div class="col-lg-12 d-flex flex-column justify-content-center p-5 text-center">
                <p class="description">Your request is submitted successfully.</p>

                <a href="{{ url()->previous() }}">Go Back</a>              
            </div>
  
          </div>
        </div>
    </section>
@endsection
@section('scripts')
@stop

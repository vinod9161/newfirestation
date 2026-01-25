@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Hyperlinking Policy</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Hyperlinking Policy</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- End About Us Section -->

 <!-- ======= Why Us Section ======= -->
 <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
    <div class="container">

      <div class="row">
  
  
        <div class="col-lg-12 d-flex flex-column justify-content-center p-5">
            <h2 style="text-align: center;">Hyperlinking Policy of Fire service</h2>

     <p>We do not object to you linking directly to the information that is hosted on our site and no prior permission is required for the same. However, we would like you to inform us about any links provided to our site so that you can be informed of any changes or updations therein. Also, we do not permit our pages to be loaded into frames on your site. Our Department's pages must load into a newly opened browser window of the user.
        </p>

        </div>
      </div>

    </div>
  </section><!-- End Why Us Section -->
@endsection
@section('scripts')
@stop

  
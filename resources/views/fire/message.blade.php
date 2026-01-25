@extends('layouts.fire_new')
@section('content')

<!-- ======= About Us Section ======= -->
<div class="breadcrumbs">
  <div class="container">

    <div class="d-flex justify-content-between align-items-center">
      <h2>Message</h2>
      <ol style="padding-top: 45px;">
        <li><a href="{{ route('actionIndex')}}">Home</a></li>
        <li>Message</li>
      </ol>
    </div>

  </div>
</div><!-- End About Us Section -->

<!-- ======= About Section ======= -->
<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
  <div class="container">

    <div class="row">

      <div class="col-lg-12 d-flex flex-column justify-content-center p-5 d-none">
        <?php
        // foreach (Yii::app()->user->getFlashes('failure_msg') as $key => $message) {
          // if ($key == 'failure_msg') {
            // echo '<div role="alert" class="alert alert-danger flash-' . $key . '">' . $message . "</div>\n";
          // }
          // if ($key == 'success') {
            // echo '<div role="alert" class="alert alert-success flash-' . $key . '">' . $message . "</div>\n";
          // }
        // }
        ?>
      </div>
      <div class="col-lg-12 d-flex flex-column justify-content-center p-5">
        @if (session('failure_msg'))
        <div role="alert" class="alert alert-danger">
          {{ session('failure_msg') }}
        </div>
        @endif

        @if (session('success'))
        <div role="alert" class="alert alert-success">
          {{ session('success') }}
        </div>
        @endif
      </div>


    </div>
  </div>
</section>
@endsection
@section('scripts')
@stop
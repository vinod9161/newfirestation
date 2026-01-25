@extends('layouts.fire_new')
@section('content')

    <!--Sub Header Start-->
    <section class="breadcrumb-section">
      <div class="overlay"></div>
      <div class="breadcrumb-content">
        <h1 class="breadcrumb-item">History</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
            <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
            <li class="breadcrumb-item active" aria-current="page">History</li>
          </ol>
        </nav>
      </div>
    </section>
    <!--Sub Header End-->


 <!-- ======= Why Us Section ======= -->
    <!-- ======= About Section ======= -->
    <section class="about" data-aos="fade-up">
        <div class="container">
  
          <div class="row">
            <div class="col-lg-6">
              <img src="{{asset('/public/fire/gallery/history.jpg')}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 pt-4 pt-lg-0">
              <h3 style="margin-top: 80px;">Uttarakhand Fire department came into existence with the formation of Uttarakhand state i.e. on <strong>9 NOV 2000.</strong></h3>
              
              <ul>
                <li><i class="icofont-check-circled"></i> Earlier it has 22 fire station. </li>
                <li><i class="icofont-check-circled"></i>  In present time Uttarakhand Fire and Emergency service has 34 fire station and 11 fire units including 4 fire station dedicated to industrial area. </li>
              </ul>
            </div>
          </div>
  
        </div>
      </section><!-- End About Section -->
@endsection
@section('scripts')
@stop

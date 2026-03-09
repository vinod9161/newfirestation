@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Pumping Work</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Pumping Work</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->

    <!-- ======= About Section ======= -->
    <section class="why-us section-bg flagday-section py-5" data-aos="fade-up" date-aos-delay="200">
        <div class="container">
  
          <div class="row content-card content-text">
        
            <div class="col-lg-6 video-box">
              <img src="{{asset('/public/fire/gallery/standby.jpg')}}" class="img-fluid img-reponsive rounded" alt="">
            </div>
  
            <div class="col-lg-6 d-flex flex-column justify-content-center">
              <h4 class="title">Pumping Work</a></h4>
  
                <p class="description">
                  The Uttarakhand Fire and Emergency Service Department undertakes pumping operations during disasters, emergencies, or on the orders of competent government authorities, such as for dewatering flooded areas to prevent loss of life and property.
                  Pumping services may also be provided for cinematography and other approved purposes, subject to availability of equipment and manpower. In such non-emergency cases, nominal charges are applicable as per departmental norms. The service is aimed at ensuring safety, damage control, and effective water management.
                </p>              
              </div>
  
        </div>
        </div>
      </section>


            <!-- start Facts Section -->
            <!-- <section class="facts section-bg" data-aos="fade-up" style="background-color: #fff;">
                <div class="container">
          
                  <div class="row counters">
          
                    <div class="col-lg-2 col-6 text-center">
                      <span><img src="{{asset('/public/fire/gallery/B1.png')}}"></span>
                      <span data-toggle="counter-up">33</span>
                      <p>Fire Stations</p>
                    </div>
          
                    <div class="col-lg-2 col-6 text-center">
                      <span><img src="{{asset('/public/fire/gallery/incident.png')}}"></span>
                      <span data-toggle="counter-up">46</span>
                      <p>Wildfire Incidents</p>
                    </div>
          
                    <div class="col-lg-2 col-6 text-center">
                      <span><img src="{{asset('/public/fire/gallery/em-call.png')}}"></span>
                      <span data-toggle="counter-up">24</span>
                      <p>Total Emergency Call</p>
                    </div>
          
                    <div class="col-lg-2 col-6 text-center">
                      <span><img src="{{asset('/public/fire/gallery/work1.png')}}"></span>
                      <span data-toggle="counter-up">1422</span>
                      <p>Total strength</p>
                    </div>
          
                    <div class="col-lg-2 col-6 text-center">
                      <span><img src="{{asset('/public/fire/gallery/fire-truck.png')}}"></span>
                      <span data-toggle="counter-up">50</span>
                      <p>Fire Vehicle</p>
                    </div>
          
                    <div class="col-lg-2 col-6 text-center">
                      <span><img src="{{asset('/public/fire/gallery/life.png')}}"></span>
                      <span data-toggle="counter-up">100</span>
                      <p>Life Saved</p>
                    </div>
          
                  </div>
          
                </div>
              </section> -->
              <!-- End Facts Section -->

@endsection
@section('scripts')
@stop

  
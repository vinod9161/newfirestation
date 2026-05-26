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
              @if(!empty($pumping_work->image))

              <img
                  src="{{ asset('/public/admin/services/pumping_work/'.$pumping_work->image) }}"
                  class="img-fluid img-reponsive rounded"
                  alt="{{ $pumping_work->hadding }}"
              >

              @endif
            </div>
  
            <div class="col-lg-6 d-flex flex-column justify-content-center">
              <h4 class="title">

                  {{ $pumping_work->hadding ?? 'Pumping Work' }}

              </h4>

              <div class="description">

                  {!! $pumping_work->content ?? '' !!}

              </div>            
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

  
@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Flag Day</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Flag Day</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->



<!-- ======= Why Us Section ======= -->
@if(!empty($flag_day))
@foreach($flag_day as $flag)
<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">

    <div class="container">

        <div class="row">
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/admin/about/flag_day/'.$flag->image)}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/admin/about/flag_day/'.$flag->image1)}}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-12 d-flex flex-column justify-content-center p-5">

                <p>{!! $flag->content !!}</p>

            </div>
        </div>
    </div>
</section>

@endforeach
@else
<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">

    <div class="container">

        <div class="row">
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/fire/gallery/fsd.jpg')}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/fire/gallery/f1.jpg')}}" class="img-fluid" alt="">
            </div>

            <div class="col-lg-12 d-flex flex-column justify-content-center p-5">

                <p>The <strong>14th Apri</strong>l each year was nominated as the National Fire Services Commemorations
                    Day. On this day the great explosion on the Bombay Docks occurred and claimed many lives including
                    the lives of firemen of Bombay. This commemoration day is also observed on a full scale to make the
                    public conscious of the fire hazards and the necessity of fire prevention. On this day, it is also
                    necessary to pay tribute to the gallant firemen who work selflessly and in many cases laid down
                    their lives so that others might live.
                    On this day the Fire department sells Fire Day Flags and the amount collected to be used for the
                    benefit of the fireman.later on it was directed that the same procedure may continue. However,
                    instead of collecting the money in sealed containers (hundis), it is suggested that such donations
                    may be obtained under proper receipts. </p>

            </div>
        </div>
    </div>
</section>


@endif

@endsection
@section('scripts')
@stop

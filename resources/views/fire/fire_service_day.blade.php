@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Fire Service Day</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Fire Service Day</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

@if(!empty($flag_day))
@foreach($flag_day as $flag)
<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">

    <div class="container">

        <div class="row">
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/admin/about/fire_service_day/'.$flag->image)}}" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/admin/about/fire_service_day/'.$flag->image1)}}" class="img-fluid" alt="">
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

                <p>Fire Service Week celebrated from 14th April to 20 april every year to enhance general public
                    awareness about the necessity of minimizing losses due to fire. 14th April will also be observed as
                    <strong>“MARTYR’S DAY”</strong> to pay homage to those brave firefighters who sacrificed their lives
                    while discharging their duties.
                </p>
                <p> Lectures, workshops and presentations including demonstrations on fire prevention and fire
                    protection organize by the Fire Service personnel at busy public places. Fire Prevention hands-out
                    distributed to members of the public during these functions. All India Radio FM Channels,
                    Doordarshan & other TV Channels (Regional channels) are also requested to broadcast fire safety
                    related audio material so that the campaign is worked-out on sound lines to create maximum impact.
                    In addition, discussions on common fire hazards in industries, commercial and office complexes,
                    schools as well as in residential premises and the appropriate fire prevention measures for these
                    premises may be arranged for broadcast/telecast through local radio/T.V. stations. </p>

            </div>
        </div>

    </div>
</section><!-- End Why Us Section -->

@endif

@endsection
@section('scripts')
@stop

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
<section class="flagday-section py-5">
    <div class="container">
        <div class="row align-items-stretch">
            <div class="col-lg-6 mb-4">
                <div class="content-card h-100">
                    <img src="{{asset('/public/fire/gallery/fsd.jpg')}}" class="img-fluid rounded" alt="">
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="content-card h-100">
                    <img src="{{asset('/public/fire/gallery/f1.jpg')}}" class="img-fluid rounded" alt="">
                </div>
            </div>
            <div class="col-12">
                <div class="content-card content-text">
                    <p>
                        Every year, <strong>14 April</strong> is observed as Fire Service Day. <strong>14 April</strong> is also observed as <strong>“Martyrs’ Day”</strong> to pay homage to the brave firefighters who laid down their lives in the line of duty.
                        <strong>Fire Service Week</strong> is observed every year from <strong>14 April to 20 April</strong> to raise public awareness about the importance of minimizing losses caused by fire. 
                        During this week, Fire Service personnel organize <strong>lectures, workshops, presentations, and live demonstrations</strong> on fire prevention and fire protection at busy public places. <strong>Fire safety handouts</strong> are distributed to the general public as part of these activities.
                        <strong>All India Radio FM channels, Doordarshan, and other regional TV channels</strong> are requested to broadcast fire safety–related audio and visual material to ensure the campaign achieves maximum reach and impact. In addition, discussions on <strong>common fire hazards</strong> in industries, commercial and office complexes, schools, and residential premises, along with appropriate <strong>fire prevention measures</strong>, may be arranged for broadcast or telecast through local radio and television stations.
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</section>

@endif

@endsection
@section('scripts')
@stop

@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">DG's Message</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">DG's Message</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<section class="flagday-section py-5">
    <div class="container">
        @if(!empty($dg_message))
            @foreach($dg_message as $mission)
            <div class="row message content-card content-text">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 text-center">
                    <img src="{{asset('public/admin/about/dg_massage/'. $mission->image)}}" class="img-fluid img-responsive"
                        style="height:600px;object-fit:cover">
                </div>
                <div class="col-md-2">
                </div>

                <div class="col-md-12 message dg-message">
                    <p>  {!! $mission->content !!}</p>
                </div>
            </div>
            @endforeach
        @else

            <div class="row message content-card content-text">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 text-center">
                    <img src="{{asset('/public/fire/gallery/dgp_new_image.jpg')}}" class="img-fluid img-responsive"
                        style="height:350px;object-fit:cover">
                    <h3 style="padding-top: 10px;">Dr. Deepam Seth</h3>
                    <h6>Director General of Police, Uttarakhand Fire Service</h6>
                </div>
                <div class="col-md-2">
                </div>

                <div class="col-md-12 message dg-message">
                    <p>Dear Friends,

                        Fire & Emergency Service is one of the most essential service of an organized society. Fire defines the
                        essence of life, yet it causes many deaths every year.<br>

                        Fire & Emergency Service, a unique part of Uttarakhand Police Department, Government of Uttarakhand is
                        entrusted with the task of fire fighting and rescue operations in times of emergency and disaster. Each
                        personnel in the department has the onerous task of saving the people in distress. It is the endeavour
                        of the department to ensure that the delivery of service to the public reaches with minimum delay. <br>


                        Uttarakhand Fire and Emergency Service is presently equipped with modern Fire Service Machines to
                        address fire contingencies. The main task of the fire fighters is to save and protect life and
                        properties of the people in any kind of calamity either natural or man-made. It needs physical strength
                        and sensitivity. For any emergency, all the fire service personals are trained for fire fighting and
                        other natural disasters. Since Uttarakhand is prone to natural disasters, Uttarakhand Fire and Emergency
                        Service needs to play a vital role. Department did their work very passionately and with dedication
                        during various disasters like 2012 Uttarakashi disaster, 2013 Kedarnath disaster, 2016 Forest fire, 2019
                        Aarakot disaster, 2020 Raini disaster, 2021 Kumayun disaster etc<br>

                        Police and Fire Service alone cannot fully serve people if people themselves also don’t take preventive
                        measures. We appeal to industrialists, owners and occupants of multi-storied buildings, commercial
                        complexes, educational institutions, cracker manufacturers etc. to follow the fire safety norms to
                        ensure safer society.
                        I wish happiness and safety to all.</p>
                </div>
            </div>

        @endif
    </div>
</section>
@endsection
@section('scripts')
@stop

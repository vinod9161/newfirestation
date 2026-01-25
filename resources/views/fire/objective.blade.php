@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Our Objective</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Our Objective</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<!-- ======= About Section ======= -->
<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/fire/gallery/event/3a.jpg')}}" class="img-fluid img-reponsive" alt="">
            </div>

            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
                <h4 class="title">Objectives of the Uttrakhand Fire and Emergency service Department</a></h4>

                <p class="description"> The motto of Uttarakhand Fire and Emergency service Fire Services asserts “ WE
                    SERVE TO SAVE.” A translated idea of original motto in Sanskrit that is “ TRANAY SEVA MAHE.” Based
                    on this motto there are three priority wise objective concepts.<br>

                    (A) Primary Objective: SAVING LIFE.<br>
                    (B) Secondary Objective: SAVE National and Public PROPERTY.<br>
                    (C) Tertiary Objective: Salvage and Preservation.
                </p>
            </div>

        </div>
    </div>
</section>

<section class="features">
    <div class="container">
        @if(!empty($objective))
            @foreach($objective as $objective)
            <div class="row" data-aos="fade-up">
            <div class="col-md-5 <?php echo ($objective->image_position == 'left') ? '' : 'order-1 order-md-2';?>">

                <img src="{{asset('/public/admin/about/our_objective/'.$objective->image)}}" class="img-fluid" alt="">
            </div>
            <div class="col-md-7 pt-4" style="padding-bottom:10px">
                <h3>{{ $objective->hadding }}</h3>
                <p>{!! $objective->content !!}
                </p>

            </div>
        </div>

            @endforeach
        @else
        <div class="row" data-aos="fade-up">
            <div class="col-md-5">
                <img src="{{asset('/public/fire/gallery/event/p1.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col-md-7 pt-4" style="padding-bottom:10px">
                <h3>SAVING LIFE. </h3>
                <p>
                    This is the most essential part of Fire Service, which requires personnel to be well trained. In
                    case of fire the SMOKE evolving from fire that is the main culprit for taking toll of life contrary
                    to the fire itself. It is the SMOKE that kills first by asphyxiating.
                    Fire Service personnel are rigorously trained to withstand HOT and HUMID conditions filled with
                    SMOKE with the help of breathing equipments and to search for casualties by following proper SEARCH
                    PROCEDURES. Modern technology has given products like PVC, FOAM textiles and furnishings that evolve
                    noxious smoke, which have toxic effect. They are a boon for human comforts but if catch fire they
                    prove as instant killers. Apart from Fire Service there are disasters, cloud brust,
                    earthquackbuilding collapse, drowning rescues etc that require immediate life saving.
                </p>

            </div>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-md-5 order-1 order-md-2">
                <img src="{{asset('/public/fire/gallery/event/p2.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col-md-7 pt-5 order-2 order-md-1" style="padding-bottom:10px">
                <h3>SAVE National and Public PROPERTY.</h3>
                <p>
                    Fire Service has to keep abreast of latest technological developments in fire-fighting so as to curb
                    and check this damage. There are different wings and training programs teaching practical
                    fireman-ship for mitigating fire loss.
                    Uttarakhand Fire and Emergency service takes care to extinguish fire at its seat such that property
                    does not get spoiled or damaged because of water used by the Fire Service for fire fighting.
                </p>

            </div>
        </div>

        <div class="row" data-aos="fade-up">
            <div class="col-md-5">
                <img src="{{asset('/public/fire/gallery/event/p3.png')}}" class="img-fluid" alt="">
            </div>
            <div class="col-md-7 pt-5" style="padding-bottom:10px">
                <h3> Salvage or preservation</h3>
                <p>Humanitarian services and salvage services. Services like Ambulance service; offering First Aid
                    helping humans in distress to safety are provided by Uttarakhand Fire and Emergency service. At the
                    fire scene a wing is busy in preserving property from fire, smoke and water due to firefighting.</p>

            </div>
        </div>
        @endif
        <div class="row" data-aos="fade-up">
            <div class="col-md-12" style="margin-top: 40px;">
                <h3>Apart from above tasks, Uttarakhand fire and emergency service also performs following tasks : </h3>
                <ul>
                    <li><i class="icofont-fire-burn"></i> Render Advise in general on Fire Protection and Fire
                        Prevention.</li>
                    <li><i class="icofont-fire-burn"></i> It also provides fire protection to the public during the
                        exigencies, like communal riots, strikes, Festival, public gatherings, Large Processions etc..
                    </li>
                    <li><i class="icofont-fire-burn"></i> Uttarakhand Fire and Emergency service organises public
                        education, fire prevention campaign through lecture and demonstration at different places.</li>
                    <li><i class="icofont-fire-burn"></i> Fire and emergency Service observes Fire Service Day on 14th
                        April every year to commemorate the Fire Service Personnel who laid down their lives during
                        public service. The message of fire prevention is carried to the public by means of
                        demonstrations, film shows, Cultural Programs, distribution of pamphlets, Seminar and lectures.
                        The help of mass media like films, television, Radio and newspapers plays an important role in
                        the successful execution of FIRE PREVENTION MESSAGE. Fire Service Department also organizes
                        lectures/ demonstrations in schools and colleges and in Places where the management requests on
                        fire prevention. Fire prevention education plays a VITAL role in saving the lives and property
                        of people.</li>
                    <li><i class="icofont-fire-burn"></i> Uttarakhand Fire and Emergency service is playing a vital role
                        in saving the lives and property of people from fire apart from discharging preliminary role. It
                        is an exceedingly important agency, and deserves strong support from Government and Society at
                        large.</li>

                </ul>
            </div>

        </div>


    </div>
</section>

@endsection
@section('scripts')
@stop

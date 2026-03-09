@extends('layouts.fire_new')
@section('content')
<style>
  .flagday-section {
      background: #f5f7fb;
  }

  .content-card {
      background: #ffffff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 16px rgba(0,0,0,0.08);
  }

  .content-text {
      font-size: 20px;
      line-height: 1.6;
      color: #333;
  }

  .page-title {
    color: #0b2a6f;
    font-weight: 600;
  }

  .objective-row {
    border: 1px solid #dee2e6;
    border-left: 5px solid #0b2a6f;
    padding: 15px;
    margin-bottom: 10px;
    cursor: pointer;
    transition: 0.2s;
    background: #fff;
  }

  .objective-row:hover {
    background: #f8f9fa;
  }

  .number-box {
    width: 42px;
    height: 42px;
    background: #0b2a6f;
    color: #fff;
    font-weight: 600;
    text-align: center;
    line-height: 42px;
    border-radius: 4px;
  }

  .objective-title {
    color: #0b2a6f;
    font-weight: 600;
  }

  .detail-section {
    margin-bottom: 15px;
  }

  .detail-box {
    background: #f8f9fa;
    padding: 15px 20px;
    border-left: 5px solid #0b2a6f;
  }

  .function-list {
    padding-left: 18px;
  }

  .function-list li {
    margin-bottom: 8px;
  }
  .detail-box, p, ul {
    font-weight: 400;
    color: #222;
    font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif;
  }

</style>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
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

<section class="flagday-section py-5">
    <div class="container">

        <div class="row align-items-stretch">
            <div class="col-lg-6 mb-4">
                <div class="content-card h-100">
                    <img src="{{ asset('/public/fire/gallery/f1.jpg') }}"
                         class="img-fluid rounded"
                         alt="Fire Safety">
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="content-card content-text">
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

    </div>
</section>

<section class="flagday-section py-1">
  <div class="container">

    <!-- Primary Objective -->
    <div class="objective-row"
        data-toggle="collapse"
        data-target="#objPrimary">
      <div class="row align-items-center">
        <div class="col-2 col-md-1">
          <div class="number-box">A</div>
        </div>
        <div class="col-10 col-md-11">
          <h6 class="objective-title mb-1">Primary Objective</h6>
          <p class="mb-0 text-muted">Saving Life</p>
        </div>
      </div>
    </div>

    <div id="objPrimary" class="collapse detail-section">
      <div class="detail-box">
          This is the most essential part of Fire Service, which requires personnel to be well trained. In
          case of fire the SMOKE evolving from fire that is the main culprit for taking toll of life contrary
          to the fire itself. It is the SMOKE that kills first by asphyxiating.
          Fire Service personnel are rigorously trained to withstand HOT and HUMID conditions filled with
          SMOKE with the help of breathing equipments and to search for casualties by following proper SEARCH
          PROCEDURES. Modern technology has given products like PVC, FOAM textiles and furnishings that evolve
          noxious smoke, which have toxic effect. They are a boon for human comforts but if catch fire they
          prove as instant killers. Apart from Fire Service there are disasters, cloud brust,
          earthquackbuilding collapse, drowning rescues etc that require immediate life saving.
      </div>
    </div>

    <!-- Secondary Objective -->
    <div class="objective-row"
        data-toggle="collapse"
        data-target="#objSecondary">
      <div class="row align-items-center">
        <div class="col-2 col-md-1">
          <div class="number-box">B</div>
        </div>
        <div class="col-10 col-md-11">
          <h6 class="objective-title mb-1">Secondary Objective</h6>
          <p class="mb-0 text-muted">
            Protection of National & Public Property
          </p>
        </div>
      </div>
    </div>

    <div id="objSecondary" class="collapse detail-section">
      <div class="detail-box">
        Fire Service has to keep abreast of latest technological developments in fire-fighting so as to curb
        and check this damage. There are different wings and training programs teaching practical
        fireman-ship for mitigating fire loss.
        Uttarakhand Fire and Emergency service takes care to extinguish fire at its seat such that property
        does not get spoiled or damaged because of water used by the Fire Service for fire fighting.
    
      </div>
    </div>

    <!-- Tertiary Objective -->
    <div class="objective-row"
        data-toggle="collapse"
        data-target="#objTertiary">
      <div class="row align-items-center">
        <div class="col-2 col-md-1">
          <div class="number-box">C</div>
        </div>
        <div class="col-10 col-md-11">
          <h6 class="objective-title mb-1">Tertiary Objective</h6>
          <p class="mb-0 text-muted">
            Salvage & Preservation
          </p>
        </div>
      </div>
    </div>

    <div id="objTertiary" class="collapse detail-section">
      <div class="detail-box">
        Humanitarian services and salvage services. Services like Ambulance service; offering First Aid
        helping humans in distress to safety are provided by Uttarakhand Fire and Emergency service. At the
        fire scene a wing is busy in preserving property from fire, smoke and water due to firefighting.

      </div>
    </div>

  </div>

</section>


<section class="flagday-section py-5">
    <div class="container">

        <div class="row align-items-stretch">

            <div class="col-12">
                <div class="content-card content-text">
                    <h4 class="title">Apart from above tasks, Uttarakhand fire and emergency service also performs following tasks :</a></h4>
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

    </div>
</section>


@endsection
@section('scripts')
@stop

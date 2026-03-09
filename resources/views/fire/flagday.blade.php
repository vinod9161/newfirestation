@extends('layouts.fire_new')
@section('content')
<style>
    /* Flag Day Content Styling */
    .flagday-section {
        background: #f5f7fb;
    }

    .section-title {
        font-size: 32px;
        font-weight: 600;
        color: #0b2c6d;
    }

    .section-subtitle {
        font-size: 16px;
        color: #555;
        margin-top: 8px;
    }

    .content-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }

    .content-text {
        font-size: 16px;
        line-height: 1.8;
        color: #333;
    }

</style>

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

<!-- ===== Content Section ===== -->
<section class="flagday-section py-5">
    <div class="container">
        @if(!empty($flag_day))
            @foreach($flag_day as $flag)

            <div class="row align-items-stretch mb-4">

                <!-- Image 1 -->
                <div class="col-lg-6 mb-4">
                    <div class="content-card h-100">
                        <img src="{{ asset('/public/admin/about/flag_day/'.$flag->image) }}"
                             class="img-fluid rounded"
                             alt="Flag Day Image">
                    </div>
                </div>

                <!-- Image 2 -->
                <div class="col-lg-6 mb-4">
                    <div class="content-card h-100">
                        <img src="{{ asset('/public/admin/about/flag_day/'.$flag->image1) }}"
                             class="img-fluid rounded"
                             alt="Flag Day Activity">
                    </div>
                </div>

                <!-- Text Content -->
                <div class="col-12">
                    <div class="content-card content-text">
                        <!-- {!! $flag->content !!} -->
                        <p>
                            <strong> Flag Day of the Fire Service in India</strong> is observed every year during <strong> Fire Service Week in April</strong>. It is a significant occasion dedicated to the fire services, aimed at <strong>raising funds</strong> and <strong>promoting awareness about fire safety</strong>. The day honors the invaluable contributions and sacrifices of firefighters and supports the welfare of fire service personnel.
                        </p>
                        <style>
                            ul {
                                margin: revert;
                                padding: revert;
                                list-style: revert;
                            }
                        </style>
                        <ul>
                            <li>
                                A primary objective of Flag Day is to <strong>raise funds for firefighter's</strong> welfare. These funds are utilized for improved equipment, advanced training, welfare measures, upgradation of fire stations, and support to the families of firefighters who have sacrificed their lives in the line of duty.
                            </li>
                            <li>
                                The day <strong>recognizes the vital role of firefighters</strong> in protecting lives and property during emergencies, acknowledging their courage, dedication, and selfless service.

                            </li>
                            <li>
                                Flag Day also <strong>strengthens community engagement</strong>. Through flag collection drives and participation in fire safety programs, citizens actively contribute to creating a safer environment.
                            </li>
                        </ul>

                    </div>
                </div>

            </div>

            @endforeach
        @else

        <div class="row align-items-stretch">

            <div class="col-lg-6 mb-4">
                <div class="content-card h-100">
                    <img src="{{ asset('/public/fire/gallery/fsd.jpg') }}"
                         class="img-fluid rounded"
                         alt="Fire Service Day">
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="content-card h-100">
                    <img src="{{ asset('/public/fire/gallery/f1.jpg') }}"
                         class="img-fluid rounded"
                         alt="Fire Safety">
                </div>
            </div>

            <div class="col-12">
                <div class="content-card content-text">
                    <!--<p>-->
                    <!--    <strong>14th April</strong> each year is observed as National Fire Service Commemoration Day.-->
                    <!--    This day marks the tragic explosion at the Bombay Docks and honours the brave firefighters-->
                    <!--    who sacrificed their lives in the line of duty.-->
                    <!--</p>-->
                    <!--<p>-->
                    <!--    The Fire Service Flag Day aims to raise awareness about fire safety and collect funds for-->
                    <!--    the welfare of firefighters and their families. Contributions help improve equipment,-->
                    <!--    training and emergency preparedness.-->
                    <!--</p>-->
                    
                    <p>
                        <strong> Flag Day of the Fire Service in India</strong> is observed every year during <strong> Fire Service Week in April</strong>. It is a significant occasion dedicated to the fire services, aimed at <strong>raising funds</strong> and <strong>promoting awareness about fire safety</strong>. The day honors the invaluable contributions and sacrifices of firefighters and supports the welfare of fire service personnel.
                    </p>
                    <style>
                        ul {
                            margin: revert;
                            padding: revert;
                            list-style: revert;
                        }
                    </style>
                    <ul>
                        <li>
                            A primary objective of Flag Day is to <strong>raise funds for firefighter's</strong> welfare. These funds are utilized for improved equipment, advanced training, welfare measures, upgradation of fire stations, and support to the families of firefighters who have sacrificed their lives in the line of duty.
                        </li>
                        <li>
                            The day <strong>recognizes the vital role of firefighters</strong> in protecting lives and property during emergencies, acknowledging their courage, dedication, and selfless service.

                        </li>
                        <li>
                            Flag Day also <strong>strengthens community engagement</strong>. Through flag collection drives and participation in fire safety programs, citizens actively contribute to creating a safer environment.
                        </li>
                    </ul>
                    
                </div>
            </div>

        </div>
        @endif

    </div>
</section>

@endsection
@section('scripts')
@stop

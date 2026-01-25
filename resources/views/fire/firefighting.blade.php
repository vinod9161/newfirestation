@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Fire Fighting and Rescue Operation</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Fire Fighting and Rescue Operation</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
    

    <section class="services">
        <div class="container">
  
          <div class="row" style="margin-top: 40px;">
              <div class="col-md-12">
                  <h5 class="text-center"> Fire and Emergency service department is entrusted with the task of fire fighting and rescue operations in times of emergency and disasters. Fire and emergency service provide its services during following emergencies in Uttarakhand. </h5>
              </div>

                <div class="col-lg-12" style="margin-top: 30px; margin-bottom: 20px;">
                  <h3 class="text-center">Fire Fighting </h3>
                </div>
  
              <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up">
                <div class="icon-box icon-box-red" style="background: #d82a2a;">
                  <img src="{{asset('/public/fire/gallery/firein.png')}}">
                  <p class="description" style="color:white">Structural and nonstructural fire fighting </p>
                </div>
              </div>
    

            <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up">
              <div class="icon-box icon-box-red" style="background: #d82a2a;">
                <img src="{{asset('/public/fire/gallery/firein.png')}}">
                <p class="description" style="color:white">Aircraft fire fighting</p>
              </div>
            </div>
  
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-red" style="background: #d82a2a;">
                <img src="{{asset('/public/fire/gallery/firein.png')}}">
                <p class="description" style="color:white">Forest fire fighting </p>
              </div>
            </div>
  
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
              <div class="icon-box icon-box-red" style="background: #d82a2a;">
                <img src="{{asset('/public/fire/gallery/firein.png')}}">
                <p class="description" style="color:white">Industrial and chemical fire fighting </p>
              </div>
            </div>
  
            <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
              <div class="icon-box icon-box-red" style="background: #d82a2a;">
                <img src="{{asset('/public/fire/gallery/firein.png')}}">
                <p class="description" style="color:white">Other fire fighting</p>
              </div>
            </div>
  
          </div>
  
        </div>

   
  

      </section><!-- End Services Section -->
  
      <!-- ======= Why Us Section ======= -->
      <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
        <div class="container">
       
          <div class="row">
            <div class="col-md-12">
                <h2 class="heading">Rescue</h2>
            </div>
  
           
          
  
            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
  
              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                  <p class="description">Industrial accidents </p>
              </div>
  
              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>   
                  <p class="description">Chemical spillage </p>
              </div>

              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Structure collapse</p>
              </div>

              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Vehicle accidents </p>
              </div>

              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Earthquake & Landslide  </p>
              </div>
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">

              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Flash flood</p>
              </div>

              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Flood  </p>
              </div>

              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Mountain search and rescue  </p>
              </div>
              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Highrise building rescue  </p>
              </div>
              <div class="icon-box">
                <div class="icon"><img src="{{asset('/public/fire/gallery/vision.png')}}" ></div>
                <p class="description">Other type of rescue  </p>
              </div>
  
            </div>
          </div>
  
        </div>
      </section><!-- End Why Us Section -->
      <div class="container">

      <div class="row">
        <div class="col-md-12">
          <h3 class="text-center">Contact to fire service during emergency<br><a href="tel:112">call 112 </a><br><a href="{{route('actionFireUnits')}}" target="_blank">or direct contact to fire stations</a></h3>

        </div>
      </div>
      </div>
@endsection
@section('scripts')
@stop

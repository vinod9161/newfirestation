@extends('layouts.main')
@section('content')
<style>
   .services .icon-box 
   {
      background: transparent;
      border: none;
      box-shadow: none;
   }
</style>



<?php if(!empty($getbanner)):?>
<style>
   #hero::after {
    content: '';
    position: absolute;
    left: 50%;
    top: 0;
    width: 130%;
    height: 95%;
    background: linear-gradient(to right, rgb(255 177 90 / 13%), rgb(227 135 6 / 7%)), url( {{ asset('public/fire/service/'. $getbanner[0]->image) }}) center top no-repeat;
    z-index: 0;
    border-radius: 0 0 50% 50%;
    transform: translateX(-50%) rotate(0deg);
}
</style>
<?php endif;?>
<section id="hero" class="d-flex justify-cntent-center align-items-center">
   <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">
      <!-- Slide 1 -->
      <div class="carousel-item active">
         <div class="carousel-container">
            <canvas id="snowCanvas" title="Uttarakhand Fire Services">
            </canvas>
            <h2 class="animate__animated animate__fadeInDown" style="position: absolute;">{{ $getbanner[0]->content ?? 'Welcome to'; }}</span></h2>
            <h2 class="animate__animated animate__fadeInUp" style="position: absolute; margin-top: 200px; margin-bottom: 50px;">{{ $getbanner[0]->hadding ?? 'Uttarakhand Fire and Emergency Service'; }}</h2>
            <!--   <a href="" class="btn-get-started animate__animated animate__fadeInUp"  style="position: absolute;  margin-top: 300px;">Read More</a> -->
         </div>
      </div>
   </div>
</section>




<!-- End Hero -->
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h1 class="ml11 text-center" style="margin-top: 20px;">
            <span class="text-wrapper">
               <span class="line line1"></span>
               <span class="letters">Emergency Number: 112</span>
            </span>
         </h1>
      </div>
   </div>
</div>
<!-- ======= Message Section ======= -->
<section class="service-details" id="main" style="margin-top:0">
   <div class="container">
      <div class="row">
         <!--<div class="col-md-5 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img">
                  <img src="{{ asset('fire/gallery/cmu.png')}}" class="ml-3" alt="..." width="80%">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionGovMsg')}}">Shri Pushkar Singh Dhami</a></h5>
                  <h6 class="card-title">Chief Minister<br>Uttarakhand</h6>
                  <div class="read-more text-center"><a href="{{route('actionGovMsg')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
               </div>
            </div>
         </div>-->
         <div class="col-md-4 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img ml-5">
                  <img src="{{ asset('/public/fire/gallery/cm-uk.png')}}" alt="..." style="height:200px" class="mt-5">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="javascript:;">SH. Pushkar Singh Dhami</a></h5>
                  <h6 class="card-title">Hon'ble Chief Minister<br> Uttarakhand</h6>
               </div>
            </div>
         </div>
		 <div class="col-md-4 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img ml-5">
                  <img src="{{ asset('/public/fire/gallery/governer.jpg')}}" alt="..." style="height:180px" class="mt-5">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="javascript:;" style="font-size: 1rem">SH. Lt. Gen. Gurmit Singh, PVSM, UYSM, AVSM, VSM (Retd.)</a></h5>
                  <h6 class="card-title">Hon'ble Governor<br> Uttarakhand</h6>
               </div>
            </div>
         </div>
		 
         <div class="col-md-4 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img ml-5">
                  <img src="{{ asset('/public/fire/gallery/dgp_new_image.jpg')}}" alt="..." style="height:150px" class="mt-5">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionDgMsg')}}">SH. Dr. Deepam Seth</a></h5>
                  <h6 class="card-title">DGP<br> Uttarakhand
                  </h6>
                  <div class="read-more text-center"><a href="{{route('actionDgMsg')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End Meassage Section -->
<!-- ======= About Section ======= -->
<section class="services" style="background-color: #dbe3fc;">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
               <div class="icon"><i class="bx bx-bullseye"></i></div>
               <h4 class="title"><a href="{{route('actionObjective')}}">Our Objective</a></h4>
               <p class="description">The motto of Uttarakhand Fire and Emergency service is <br><span style="font-weight:600; color:#1d4ed8;">“WE SERVE TO SAVE”</span></p>
            </div>
         </div>
         <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-green">
               <div class="icon"><i class="bx bx-question-mark"></i></div>
               <h4 class="title"><a href="{{route('actionFaq')}}">FAQ's</a></h4>
               <p class="description">Here you will find the questions we get asked the most.</p>
            </div>
         </div>
         <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-pink">
               <div class="icon"><img src="{{ asset('/public/fire/gallery/faq-logo.png')}}"></div>
               <h4 class="title"><a href="{{route('actionSafetyCorner')}}">Safety Corner</a></h4>
               <p class="description">This section shall provide the knowledge of primary saftey points surrounding you</p>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End about Section -->
<!-- start news Section -->
<!-- <section class="team" data-aos="" data-aos-easing="ease-in-out" data-aos-duration="500">
   <div class="container">
      <div class="row">
         <div class="col-md-6">
            <h1 class="text-left" style="padding-bottom:10px;">Latest News</h1>
         </div>
         <div class="col-md-6">
            <h1 class="text-center" style="padding-bottom:10px; margin-left:100px;">Recent Updates...</h1>
         </div>
         <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
               <div class="member-img">
                  <img src="{{ asset('fire/gallery/event1.jpg')}}" class="img-fluid" alt="">
                  <div class="social">
                     <h6>Fake Photos Of Uttarakhand Forest Fire On Social Media</h6>
                  </div>
               </div>
               <div class="member-info">
                  <p>"Photos on social media are showing entire trees on fire. Such forest fires take place in Canada, US and Australia," said Principal Chief Conservator of Forest, Jai Raj said.</p>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member">
               <div class="member-img">
                  <img src="{{ asset('fire/gallery/cm.jpg')}}" class="img-fluid" alt="">
                  <div class="social">
                     <h6>Uttarakhand Forest Fire Pictures False: Pushkar Singh Dhaami</h6>
                  </div>
               </div>
               <div class="member-info">
                  <p>Pushkar Singh Dhaami dismissed such social media photos as part of a "misleading propaganda", even as the state police threatened to take stern action against those responsible for spreading rumours</p>
               </div>
            </div>
         </div>
         <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="member" >
               <marquee direction="up" class="tenders" style="color: #000!important;" behavior="scroll" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();" >
                  <p><a href="#">Fake Photos Of Uttarakhand Forest Fire On Social Media: Official</a></p>
                   <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                     <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                     <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                     <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                     <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                     <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
               </marquee>
               <div class="member-info">
               </div>
            </div>
         </div>
      </div>
   </div>
</section> -->
<!-- End news Section -->
<!-- start Facts Section -->
<section class="facts section-bg" data-aos="" style="background-color: #fff;">
   <div class="container">
      <div class="row counters">
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{ asset('/public/fire/gallery/B1.png')}}"></span>
            <span data-toggle="counter-up">{{$count['fireStationCount']}}</span>
            <p>Fire Stations</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{ asset('/public/fire/gallery/incident.png')}}"></span>
            <span data-toggle="counter-up">{{$count['fireReportCount']}}</span>
            <p>Fire Call</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{ asset('/public/fire/gallery/em-call.png')}}"></span>
            <span data-toggle="counter-up">{{$count['emergencyCallCount']}}</span>
            <p>Total Emergency Call</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{ asset('/public/fire/gallery/work1.png')}}"></span>
            <span data-toggle="counter-up">{{$count['employeeCount']}}</span>
            <p>Total strength</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{ asset('/public/fire/gallery/fire-truck.png')}}"></span>
            <span data-toggle="counter-up">{{$count['vehicleCount']}}</span>
            <p>Fire Vehicle</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{ asset('/public/fire/gallery/life.png')}}"></span>
            <span data-toggle="counter-up">{{$count['lifeSaveCount']}}</span>
            <p>Life Saved</p>
         </div>
      </div>
   </div>
</section>
<!-- End Facts Section -->
<!-- Start Service Section -->
<section class="services we-offer" style="background-color: #dbe3fc;">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="text-center" style="color: #1d4ed8;">Services We Offer</h1>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="">
            <div class="icon-box icon-box-pink">
               <img src="{{ asset('/public/fire/service/24X7support.png')}}" style="width:150px;">
               <h4 class="title" style="color:#1d4ed8">24 hour emergency<br>support</h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
               <img src="{{ asset('/public/fire/service/consultation.png')}}" style="width:132px;">
               <h4 class="title"><a href="{{route('actionConsultation')}}" style="color:#1d4ed8 !important;">Consultation in case of fire and life safety</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-green">
               <img src="{{ asset('/public/fire/service/fire_safety_certificate.png')}}" style="width:150px;">
               <h4 class="title"><a href="{{route('actionFireSafteyCertificate')}}" style="color:#1d4ed8 !important;">Fire saftey Certificate</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
               <img src="{{ asset('/public/fire/service/public_awareness.png')}}" style="width:138px;">
               <h4 class="title"><a href="{{route('actionPublicAwareness')}}" style="color:#1d4ed8 !important;">Public awareness program/Mock drills</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-green">
               <img src="{{ asset('/public/fire/service/fire_safety_all_places.png')}}" style="width:150px;">
               <h4 class="title"><a href="{{route('actionFireSafteyToAllPlaces')}}" style="color:#1d4ed8 !important;">Fire saftey to all sensitive places of state</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-pink">
               <img src="{{ asset('/public/fire/service/fire_safety_all_public_events.png')}}" style="width:150px;">
               <h4 class="title"><a href="{{route('actionFireSafteyVVIP')}}" style="color:#1d4ed8 !important;">fire saftey in all public events</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
               <img src="{{ asset('/public/fire/service/training_courses.png')}}" style="width:150px;">
               <h4 class="title"><a href="{{route('actionTraningCourse')}}" style="color:#1d4ed8 !important;">Training Course</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-cyan">
               <img src="{{ asset('/public/fire/service/disaster_search.jpeg')}}" style="width:150px;">
               <h4 class="title"><a href="{{route('actionDisasterSearch')}}" style="color:#1d4ed8 !important;">Disaster search, rescue and relief work</a></h4>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End Service Section -->
<!-- start video Section -->
<section class="why-us section-bg" data-aos="" date-aos-delay="200">
   <div class="container">
      <div class="row ">
         <div class="col-lg-4">
            <h2 class="text-center" style=" padding-top: 20px;">Fire Incidents</h2>
            <div class="row scroll">
               @foreach($recentfireincidents as $key => $rfi)
               <div class="col-md-12">
                  <div class="news">
                     <span class="badge badge-primary">News</span>
                     <div class="news-body">
                        <h2 class="news-title">{{ $rfi->title }}</h2>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         <div class="col-lg-4 video-box">
            <h2 class="text-center" style="padding-top:20px;">Useful Videos</h2>
            <img src="{{ asset('/public/fire/gallery/noc-c.jpg')}}" class="img-fluid img-reponsive tenders" alt="">
            <a href="https://www.youtube.com/watch?v=gy5WfxiP0RI&feature=youtu.be" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
         </div>
         <div class="col-lg-4">
            <h2 class="text-center" style="padding-top:20px;">Recent Updates</h2>
            <div class="row">
               <div class="col-lg-12 col-md-12 d-flex align-items-stretch">
                  <div class="member">
                     <marquee direction="up" class="tenders" style="color: #000!important;" behavior="scroll" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();">
                        @foreach($recentupdates as $ru)
                        <p><a href="{{route('actionRecentUpdates')}}" style="color: #1d4ed8;">{{$ru->title}}</a></p>
                        @endforeach
                     </marquee>
                     <div class="member-info">
                        <!--  <h4><a href="#">Read full News</a></h4> -->
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End video Section -->
<!-- ======= Event Details Section ======= -->
<section class="service-details">
   <div class="container">
      <h1 class="text-center" style="padding-bottom: 20px;">Our Events</h1>
      <div class="row">
         <div class="col-md-4 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img">
                  <img src="{{ asset('/public/fire/gallery/event/4.jpg')}}" alt="official event" class="img-reponsive">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionG1')}}">Official Event</a></h5>
                  <div class="read-more text-center"><a href="{{route('actionG1')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
               </div>
            </div>
         </div>
         <div class="col-md-4 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img">
                  <img src="{{ asset('/public/fire/gallery/event/6.jpg')}}" alt="indoor-event" class="img-reponsive">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionG1')}}">Indoor Event</a></h5>
                  <div class="read-more text-center"><a href="{{route('actionG1')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
               </div>
            </div>
         </div>
         <div class="col-md-4 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img">
                  <img src="{{ asset('/public/fire/gallery/event/2.jpg')}}" alt="outdoor-event" class="img-reponsive">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionG1')}}">Outdoor Event</a></h5>
                  <div class="read-more text-center"><a href="{{route('actionG1')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- End Event Details Section -->
<!-- Start FAQ Section -->
<section class="why-us section-bg" data-aos="" date-aos-delay="200">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="card example-1 square scrollbar-cyan bordered-cyan" style="height: auto">
               <div class="card-body">
                  <a href="https://x.com/ukfireservices" target="_blank"><h4 id="section1" class="tw-title" style="background-color: #000;"><strong><i class="bx bx-x" style="background-color: #ffffff;border-radius: 50%;color: #000;"></i> &nbsp;Our Twitter Feeds</strong></h4></a>
                  <a href="https://www.facebook.com/uttarakhandfireservice/" target="_blank"><h4 id="section1" class="tw-title" style="background-color: #0866ff;"><strong><i class="bx bxl-facebook" style="background-color: #ffffff;border-radius: 50%;color: #0866ff;"></i> &nbsp;Our Facebook Feeds</strong></h4></a>
                  <a href="https://www.instagram.com/uttarakhandfireservice/" target="_blank"><h4 id="section1" class="tw-title" style="background-color: #e4405f;"><strong><i class="bx bxl-instagram" style="background-color: #ffffff;border-radius: 50%;color: #e4405f;"></i> &nbsp;Our Facebook Feeds</strong></h4></a>
               </div>
            </div>
         </div>
		 
		 <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="card example-1 square scrollbar-cyan bordered-cyan" style="height: auto">
               <div class="card-body">
					<a href="{{ route('actionActs')}}" class="btn btn-new" style="margin:5px"> Fire service acts & rules</a>
					<a href="#" class="btn btn-new2" style="margin:5px"> Right to information</a>
					<a href="{{route('actionOrganisationStructure')}}" class="btn btn-new" style="margin:5px"> Organisational structure</a>
					<a href="{{route('actionFireUnits')}}" class="btn btn-new2" style="margin:5px"> Fire stations List</a>
               </div>
            </div>
         </div>
		 
		 <!--div class="col-md-4 col-sm-12 col-xs-12">
            <div class="card example-1 square scrollbar-cyan bordered-cyan" style="height: auto">
               <div class="card-body">
					<div class="box">
					   <h4>Emergency Numbers</h4>
					   <br>
					   <strong> In an emergency call <span style="color:#dc4e21">One One Two (112)</span></strong> <br>
					   Medical Emergency: 108
					</div>
               </div>
            </div>
         </div-->
		
      </div>
   </div>
   </div>
</section>
@endsection
@section('scripts')
@stop
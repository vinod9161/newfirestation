@extends('layouts.main')
<style>
   .service-details .card-img{
      height:380px !important;
   }
</style>
@section('content')

<section id="hero" class="d-flex justify-cntent-center align-items-center">
   <div id="heroCarousel" class="container carousel carousel-fade" data-ride="carousel">
      <!-- Slide 1 -->
      <div class="carousel-item active">
         <div class="carousel-container">
            <canvas id = "snowCanvas" title = "Uttarakhand Fire Services">
            </canvas>
            <h2 class="animate__animated animate__fadeInDown" style="position: absolute;">Welcome to</span></h2>
            <h2 class="animate__animated animate__fadeInUp"  style="position: absolute; margin-top: 200px; margin-bottom: 50px;">Uttarakhand Fire and Emergency Service</h2>
            <!--   <a href="" class="btn-get-started animate__animated animate__fadeInUp"  style="position: absolute;  margin-top: 300px;">Read More</a> -->
         </div>
      </div>
   </div>
</section>
<!-- End Hero -->
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h1 class="ml11 text-center" style="margin-bottom: 20px;">
            <span class="text-wrapper">
            <span class="line line1"></span>
            <span class="letters">Emergency Number: 112</span>
            </span>
         </h1>
      </div>
   </div>
</div>
<!-- ======= Message Section ======= -->
<section class="service-details" id="main">
   <div class="container">
      <div class="row">
         <div class="col-md-6 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img">
                  <img src="{{ asset('/public/fire/gallery/governer.png')}}" alt="...">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionCmMsg')}}">Lt. Gen. Gurmit Singh, PVSM, UYSM, AVSM, VSM (Retd.)</a></h5>
                  <h6 class="card-title">Governor<br> Uttarakhand</h6>
                  <div class="read-more text-center"><a href="{{route('actionCmMsg')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
               </div>
            </div>
         </div>
         <div class="col-md-6 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img">
                  <img src="{{ asset('/public/fire/gallery/dgp_new_image.jpg')}}" alt="..." class="img-responsive">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionDgMsg')}}">Shri Ashok Kumar, IPS</a></h5>
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
<section class="services" style="background-image: url('/fire/gallery/about_bg.jpg'); background-repeat: no-repeat; background-size:cover;padding: 75px 0 35px 0;">
   <div class="container">
      <div class="row">
         <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
               <div class="icon"><i class="bx bx-bullseye"></i></div>
               <h4 class="title"><a href="{{route('actionObjective')}}">Our Objective</a></h4>
               <p class="description">The motto of Uttarakhand Fire and Emergency service is <br><span style="font-weight:600; color:#d73502de;">“WE SERVE TO SAVE”</span></p>
            </div>
         </div>
         <div class="col-md-6 col-lg-4 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-green">
               <div class="icon"><i class="bx bx-question-mark"></i></div>
               <h4 class="title"><a href="{{route('actionFaq2')}}">FAQ's</a></h4>
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
<section class="services we-offer" style="background-image: url('/fire/gallery/service-bg.jpg'); background-repeat: no-repeat; background-size: cover;">
   <div class="container">
      <div class="row">
         <div class="col-md-12">
            <h1 class="text-center" style="padding-bottom:10px; color: #fff;">Services We Offer</h1>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="">
            <div class="icon-box icon-box-pink">
               <img src="{{ asset('/public/fire/gallery/24.png')}}">
               <h4 class="title" style="color:#fd7e14">24 hour emergency support</h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="100">
            <div class="icon-box icon-box-cyan">
               <img src="{{ asset('/public/fire/gallery/consultation.png')}}">
               <h4 class="title"><a href="{{route('actionConsultation')}}" style="color:#fd7e14 !important;">Consultation in case of fire and life safety</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-green">
               <img src="{{ asset('/public/fire/gallery/fire-certificate.png')}}">
               <h4 class="title"><a href="{{route('actionFireSafteyCertificate')}}" style="color:#fd7e14 !important;">Fire saftey<br> Certificate</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
               <img src="{{ asset('/public/fire/gallery/public-awareness.png')}}">
               <h4 class="title"><a href="{{route('actionPublicAwareness')}}" style="color:#fd7e14 !important;">Public awareness program/Mock drills</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-green">
               <img src="{{ asset('/public/fire/gallery/fire-vip.png')}}">
               <h4 class="title"><a href="{{route('actionFireSafteyToAllPlaces')}}" style="color:#fd7e14 !important;">Fire saftey to all sensitive places of state</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-pink">
               <img src="{{ asset('/public/fire/gallery/fire-vip.png')}}">
               <h4 class="title"><a href="{{route('actionFireSafteyVVIP')}}" style="color:#fd7e14 !important;">fire saftey in all public events</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-blue">
               <img src="{{ asset('/public/fire/gallery/course.png')}}">
               <h4 class="title"><a href="{{route('actionTraningCourse')}}" style="color:#fd7e14 !important;">Training Course</a></h4>
            </div>
         </div>
         <div class="col-md-6 col-lg-3 d-flex align-items-stretch" data-aos="" data-aos-delay="200">
            <div class="icon-box icon-box-cyan">
               <img src="{{ asset('/public/fire/gallery/rescue-emergency.png')}}">
               <h4 class="title"><a href="{{route('actionDisasterSearch')}}" style="color:#fd7e14 !important;">Disaster search, rescue and relief work</a></h4>
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
               <div class="col-md-12">
                  <div class="news">
                     <span class="badge badge-danger" >News</span>
                     <div class="news-body">
                        <h2 class="news-title">Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</h2>
                     </div>
                     <p class="news-time  "><em>3 mins ago</em></small></p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="news">
                     <span class="badge badge-danger" >News</span>
                     <div class="news-body">
                        <h2 class="news-title">Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</h2>
                     </div>
                     <p class="news-time  "><em>3 mins ago</em></small></p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="news">
                     <span class="badge badge-danger" >News</span>
                     <div class="news-body">
                        <h2 class="news-title">Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</h2>
                     </div>
                     <p class="news-time  "><em>3 mins ago</em></small></p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="news">
                     <span class="badge badge-danger" >News</span>
                     <div class="news-body">
                        <h2 class="news-title">Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</h2>
                     </div>
                     <p class="news-time  "><em>3 mins ago</em></small></p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="news">
                     <span class="badge badge-danger" >News</span>
                     <div class="news-body">
                        <h2 class="news-title">Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</h2>
                     </div>
                     <p class="news-time  "><em>3 mins ago</em></small></p>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="news">
                     <span class="badge badge-danger" >News</span>
                     <div class="news-body">
                        <h2 class="news-title">Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</h2>
                     </div>
                     <p class="news-time  "><em>3 mins ago</em></small></p>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4 video-box">
            <h2 class="text-center" style="padding-top:20px;">Useful Videos</h2>
            <img src="{{ asset('/public/fire/gallery/noc-c.jpg')}}" class="img-fluid img-reponsive tenders" alt="">
            <a href="https://www.youtube.com/watch?v=gy5WfxiP0RI&feature=youtu.be" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
         </div>
         <div class="col-lg-4">
            <h2 class="text-center" style="padding-top:20px;">Recent Updates</h2
            >
            <div class="row">
               <div class="col-lg-12 col-md-12 d-flex align-items-stretch">
                  <div class="member" >
                     <marquee direction="up" class="tenders" style="color: #000!important;" behavior="scroll" scrollamount="2" onmouseover="this.stop();" onmouseout="this.start();" >
                        <p><a href="#">Fake Photos Of Uttarakhand Forest Fire On Social Media: Official</a></p>
                        <!--  <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                           <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                           <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                           <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                           <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p>
                           <p><a href="#">Uttarakhand Forest Fire Pictures False: Trivendra Singh Rawat</a></p> -->
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
      <h1 class="text-center" style="padding-bottom: 50px;">Our Events</h1>
      <div class="row">
         <div class="col-md-4 d-flex align-items-stretch" data-aos="">
            <div class="card">
               <div class="card-img">
                  <img src="{{ asset('/public/fire/gallery/event/4.jpg')}}" alt="official event" class="img-reponsive">
               </div>
               <div class="card-body">
                  <h5 class="card-title"><a href="{{route('actionG1')}}">Official Event</a></h5>
                  <div class="read-more"><a href="{{route('actionG1')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
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
                  <div class="read-more"><a href="{{route('actionG1')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
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
                  <div class="read-more"><a href="{{route('actionG1')}}"><i class="icofont-arrow-right"></i> Read More</a></div>
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
         <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="card example-1 square scrollbar-cyan bordered-cyan">
               <div class="card-body">
                  <h4 id="section1" class="tw-title"><strong>Our Twitter feeds</strong></h4>
                  <a class="twitter-timeline" href="https://twitter.com/UKFireServices?ref_src=twsrc%5Etfw">Tweets by UKFireServices</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>            
               </div>
            </div>
         </div>
         <div class="col-md-4 col-sm-12 col-xs-12">
            <div class="card example-1 square scrollbar-cyan bordered-cyan">
               <div class="card-body">
                  <h4 id="section1" class="tw-title"><strong>Our Facebook feeds</strong></h4>
                  <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FUttarakhandFireService%2F&tabs=timeline&width=340&height=500&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>          
               </div>
            </div>
         </div>
         <div class="col-lg-4" style="margin-top: 40px;" >
            <a href="{{ route('actionActs')}}" class="btn btn-new"> Fire service acts & rules</a>
            <a href="#" class="btn btn-new2"> Right to information</a>
            <div class="box">
               <h4>Emergency Numbers</h4>
               <br>
               <strong> In an emergency call <span style="color:#dc4e21">One One Two (112)</span></strong> <br>
               Medical Emergency: 108
            </div>
            <a href="{{route('actionOrganisationStructure')}}" class="btn btn-new"> Organisational structure</a>
            <a href="{{route('actionFireUnits')}}" class="btn btn-new2"> Fire stations List</a>
         </div>
      </div>
   </div>
   </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
   $(document).ready(function(){
      let token = "{{ request()->token }}";
      $.ajax({
         type: "GET",
         url: "/token-verification",
         cache: false,
         data: { token: token },

         success: function(response){
            if(response.status == 200)
            {
	       if(response.data.service.slug == "noc-for-temporary-structure-pandal-mela"){
               window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-pandal"+"/"+"citizen-noc-pandal";
	       }else if(response.data.service.slug == "noc-for-organizing-public-function"){
		         window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-public-function"+"/"+"citizen-noc-public-function";
	       }else if(response.data.service.slug == "noc-for-temporary-permission-of-entertainment-activities"){
	      	   window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-entertainment-activity"+"/"+"citizen-noc-entertainment-activity";
   	   }else if(response.data.service.slug == "noc-for-film-shooting"){
               window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-film-shooting"+"/"+"citizen-noc-film-shooting";
	       }else if(response.data.service.slug == "noc-for-organizing-games"){
		         window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-games"+"/"+"citizen-noc-games";
	       }else if(response.data.service.slug == "noc-for-helipad"){
	      	   window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-helipad"+"/"+"citizen-noc-helipad";
   	   }else if(response.data.service.slug == "noc-for-small-scale-kerosene-diesel-station"){
               window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-kerosene"+"/"+"citizen-noc-kerosene";
	       }else if(response.data.service.slug == "noc-for-temporary-sale-of-firecrackers"){
		         window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-fire-crackers"+"/"+"citizen-noc-fire-crackers";
	       }else if(response.data.service.slug == "noc-for-temporary-permission-to-allow-transportation-of-harmful-and-hazardous-materials"){
	      	   window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-transportation-material"+"/"+"citizen-noc-transportation-material";
   	   }else if(response.data.service.slug == "noc-for-temporary-permission-of-other-activities"){
               window.location = "https://fireservice.uk.gov.in"+"/citizen-noc-other-services"+"/"+"citizen-noc-other-services";
	       }else if(response.data.service.slug == "fire-report" || response.data.service.slug == "rescue-report" || response.data.service.slug == "relief-work-report"){
               window.location = "https://fireservice.uk.gov.in"+"/incidentReport";

	       }else if(response.data.service.slug == "noc-for-fire-safety-of-building"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-cinema-hall-multiplex"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-license-to-repair-arms"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-renewal-of-license-to-repair-arms"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-license-to-sell-arms"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-renewal-of-license-to-sell-arms"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-license-to-store-arms"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-renewal-of-license-to-store-arms"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-gas-warehouse-and-agency"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-gas-oil-depot"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-sale-of-sulphur"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-storage-magazine-of-explosive"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-petrol-pump-cng-station"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-license-to-sell-fireworks"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-license-to-store-fireworks"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else if(response.data.service.slug == "noc-for-license-to-manufacture-fireworks"){
               window.location = "https://fireservice.uk.gov.in"+"/my-noc-ap"+"/"+response.data.service.slug;
	       }else{
             window.location = "https://fireservice.uk.gov.in"+"/my-account";
	       }
            }else{
	       location.reload();
	    }
         }
      });
   });
</script>
@endsection
@section('scripts')
@stop
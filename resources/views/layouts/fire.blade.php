<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">
      <title>Uttarakhand Fire and Emergency Services</title>
      <meta content="Uttarakhand Fire and Emergency Services" name="descriptison">
      <meta content="Uttarakhand Fire and Emergency Services" name="keywords">
      <!-- Favicons -->
      <link href="{{ asset('/public/fire/gallery/fav.png') }}" rel="icon">
      <link href="{{ asset('/public/fire/gallery/app-fav.png') }}" rel="apple-touch-icon">
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
      <!-- Vendor CSS Files -->
      <link href="{{ asset('/public/fire/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/icofont/icofont.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/venobox/venobox.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/owl.carousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/aos/aos.css') }}" rel="stylesheet">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
      <!-- Template Main CSS File -->
      <link href="{{ asset('/public/fire/css/style.css') }}" rel="stylesheet">
      <link href="{{ asset('/public/fire/vendor/aos/aos.css') }}" rel="stylesheet">
   </head>
   <body>
      <div class="top1 fixed-top">
         <div class="container-fluid">
            <div class="row" >
               <div class="col-md-1">
               </div>
               <div class="col-md-10 text-right">
                  <p><a href="#main" style="color: #fff;">Skip to main content</a>| <a href="#header" style="color: #fff;">Skip to navigation</a>|<a href="#" style="color: #fff;">Hindi</a> |<a href="#" style="color: #fff;">English</a> |<a href="javascript:ts('body',1)" style="color: #fff;">A+</a> |<a href="javascript:ts('body',-2)" style="color: #fff;">A-</a>  &nbsp;<a href="#" style="color: #fff;"><i class='bx bx-sitemap'></i></a></p>
               </div>
            </div>
         </div>
      </div>
      <!-- ======= Header ======= -->
      <header id="header" class="fixed-top">
         <div class="container-fluid">
         </div>
         <div class="logo float-left">
            <a href="/"><img src="{{ asset('/public/fire/gallery/logort1.png') }}" alt=""  style="margin-top: 10px;" class=" img-fluid img-reponsive"></a>
         </div>
         <div class="logo float-right">
            <a href="/"><img src="{{ asset('/public/fire/gallery/uk-logo.png') }}" alt="" style="margin-top: 10px;" class="img-fluid img-reponsive"></a>
         </div>
         <nav class="nav-menu d-none d-lg-block" >
            <ul>
               <li class="active"><a href="/">HOME</a></li>
               <li class="drop-down">
                  <a href="#">About Us</a>
                  <ul>
                     <li><a href="{{ route('actionMissionVision')}}">Mission & Vision</a></li>
                     <li><a href="{{ route('actionHistory')}}">History</a></li>
                     <li><a href="{{ route('actionOrganisationStructure')}}">Organization Structure</a></li>
                     <li><a href="{{ route('actionFireServiceDay')}}">Fire Service Day </a></li>
                     <li><a href="{{ route('actionFlagday')}}">Flag Day</a></li>
                     <li><a href="{{ route('actionObjective')}}">Our Objective</a></li>
                     <li><a href="{{ route('actionDgMsg')}}">DG's Message</a></li>
                     <li><a href="{{ route('actionFireUnits')}}">Fire Station List</a></li>
                     <li><a href="{{ route('actionStaffStrength')}}">Staff Strength</a></li>
                     <li><a href="{{ route('actionFaq')}}">FAQ's</a></li>
                  </ul>
               </li>
               <li class="drop-down">
                  <a href="#">Services</a>
                  <ul>
                     <li class="drop-down">
                        <a href="#">NOC</a>
                        <ul>
                           <li class="drop-down">
                              <a href="{{ route('login') }}">Apply For NOC</a>
                              <ul>
                                 <li><a href="{{ route('login') }}">Pre Establishment NOC</a></li>
                                 <li><a href="{{ route('login') }}">Pre- Operation NOC</a></li>
                                 <li><a href="{{ route('login') }}">Annual Clearance Certificate</a></li>
                                 <li><a href="{{ route('login') }}">Temporary/ other</a></li>
                              </ul>
                           </li>
                           <!-- <li><a href="{{ asset('/public/fire/pdf/required_documents.pdf') }}" target="_blank">Required Document for NOC</a></li>
                           <li><a href="{{ asset('/public/fire/fire_checklist (1).pdf') }}" target="_blank">Checklist for NOC</a></li> -->
                           <li><a href="{{ route('nocdocrequiredata') }}">Required Document for NOC</a></li>
                           <li><a href="{{ route('checklistdata') }}">Checklist for NOC</a></li>
                           <li><a href="{{ route('login') }}" >Check NOC Status</a></li>
                           <li><a href="{{ route('login') }}">NOC Verification</a></li>
                           <li><a href="https://ifms.uk.gov.in">Fire Service Fee Challan</a></li>
                        </ul>
                     </li>
                     <li class="drop-down">
                        <a href="#">RTI & RTS</a>
                        <ul>
                           <li><a href="{{ route('actionRTI')}}" >RTI</a></li>
                           <li><a href="{{ route('rtsAction')}}" >Right to Service</a></li>
                           <!-- <li><a href="{{ asset('/public/fire/pdf/Right_to_Service_Act_2011_in_English.pdf') }}" target="_blank">Right to Service</a></li> -->
                        </ul>
                     </li>

                     <li><a href="{{ route('applicationtrackstatus')}}">Track Application Status</a></li>
                     <li><a href="{{ route('applicationverificationtrackstatus')}}">NOC Verification</a></li>

                     <li class="drop-down">
                        <a href="#">Help</a>
                        <ul>
                           <!-- <li><a href="{{ asset('/public/fire/pdf/ukfireservices_SWCS.pdf') }}" target="_blank">Filling NOC Through Single Window</a></li> -->
                           <li><a href="https://investuttarakhand.uk.gov.in/" >Filling NOC Through Single Window</a></li>
                           <li><a href="{{ asset('/public/fire/pdf/ukfireservices_standalone_application.pdf') }}" target="_blank">Filling NOC Directly From Website</a></li>
                           <li><a href="{{ asset('/public/fire/pdf/flow_chart_of_fire_noc_approval-.pdf') }}" target="_blank">Flow Chart of Fire NOC Approval </a></li>
                           <li><a href="{{ asset('/public/fire/pdf/required_documents.pdf') }}" target="_blank">Documents Required for Fire NOC</a></li>
                        </ul>
                     </li>
                     <li><a href="{{ route('actionFireFighting')}}">Fire fighting & rescue Operation</a></li>
                     <li><a href="{{ route('actionStandby')}}">Standby Duties</a></li>
                     <li><a href="{{ route('actionPumpingWork')}}">Pumping Works</a></li>
                     <li><a href="{{ route('actionPublicAwareness')}}">Awareness classes/Mock Drills</a></li>
                     <li><a href="{{ route('login') }}">Training</a></li>
                     <li><a href="{{ route('actionIncidentReport')}}">Fire service / Incident Reports</a></li>
                     <li><a href="{{ route('actionServicerenderunpaid')}}">Services Rendered Unpaid</a></li>
                     <li><a href="{{ route('actionServicerenderedpaid')}}">Services Rendered Paid</a></li>
                  </ul>
               </li>
               <li class="drop-down">
                  <a href="#">Achivements</a>
                  <ul style="display:none;">
                     <li><a href="{{ route('actionAchivementsPrevious')}}">Achievements in previous years</a></li>
                     <li><a href="{{ route('actionMedalWinner')}}">Medal Winners</a></li>
                     <li><a href="{{ route('actionGrowthInStaffStrength')}}">Growth in Staff Strength</a></li>
                     <li><a href="{{ route('actionCallDetails')}}">Call Details 2000-2019</a></li>
                     <li><a href="#">Seminars</a></li>
                     <li><a href="#">Conferences</a></li>
                     <li><a href="{{ asset('/public/fire/pdf/9 fire unit.pdf') }}" target="_blank">New station Opening</a></li>
                     <li><a href="{{ route('actionPriorityListOfFireStation')}}">Priority List of Stations</a></li>
                  </ul>
                  <ul>
                  <li><a href="{{ route('actionMedalWinner')}}">Medal Winners</a></li>
                     <li><a href="{{ route('actionAwarenessProgramme')}}">Awareness Programme</a></li>
                     <li><a href="{{ route('actionSpecialRiskArea')}}">Special Risk Area</a></li>
                  </ul>
               </li>
               <li>
                  <a href="{{ route('actionActs')}}">Acts & Rules</a>
                  <ul style="display:none;">
                     <li><a href="#">Uttarakhand Fire service act</a></li>
                     <li><a href="{{ asset('/public/fire/pdf/UKFS-Subordinate-Officers-Employees-Service-Rules-2016_compressed.pdf') }}">Subordinates Service Rules</a></li>
                     <li><a href="#">GO/Standing Orders</a></li>
                     <li><a href="{{ asset('/public/fire/pdf/Order-to-All-SSP-SP-and-CFO-Online-100.pdf') }}" target="_blank">Circulars</a></li>
                     <li><a href="{{ route('login') }}">NOC Related</a></li>
                     <li><a href="{{ route('login') }}">Welfare and Amenity Fund By-Law</a></li>
                     <li><a href="{{ route('login') }}">Store Purchase Manual</a></li>
                     <li><a href="{{ route('login') }}">Uttarakhand Service Rules</a></li>
                     <li><a href="{{ route('login') }}">Fire Service Manual</a></li>
                     <li><a href="{{ route('login') }}">RMSI Study Report</a></li>
                     <li><a href="{{ route('login') }}">Others</a></li>
                  </ul>
               </li>
               <li class="drop-down">
                  <a href="#">Activities</a>
                  <ul>
                     <li><a href="{{ route('actionG1')}}">Gallery</a></li>
                     <li><a href="{{ route('actionG1')}}">Present Activities</a></li>
                     <li><a href="{{ route('publicarticledata')}}">Public Articles</a></li>
                     <li><a href="{{ route('actionFireServiceWeek')}}">Fire Service Week </a></li>
                  </ul>
               </li>
               <li class="drop-down">
                  <a href="#"> Establishment</a>
                  <ul>
                     <li><a href="{{ route('serviceorderdata') }}">Service Orders</a></li>
                     <li><a href="{{ route('actionStaffStrength')}}">Strength Statement</a></li>
                     <li><a href="{{ route('actionVehicle')}}">Vehicles & Equipment</a></li>
                     <li><a href="{{ route('welfareamenitydata') }}">Welfare and Amenity Fund</a></li>
                     <li><a href="{{ route('recruitmentdata')}}">Recruitment</a></li>
                  </ul>
               </li>
               <li class="drop-down">
                  <a href="#"> Academy</a>
                  <ul>
                     <li><a href="{{ route('recruitmentdata')}}">Recruitments</a></li>
                     <!-- <li><a href="{{ route('actionHistory')}}">History</a></li> -->
                     <li><a href="{{ route('historydata') }}">History</a></li>
                     <li><a href="{{ route('routemapdata') }}">Route Map</a></li>
                     <li><a href="{{ route('istitutionalstructuredata') }}">Instituational Structure</a></li>
                     <li><a href="{{ route('coursedata') }}">Courses</a></li>
                     <li><a href="{{ route('trainingscheduledata') }}">Training Schedule</a></li>
                     <li><a href="{{ route('resultdata') }}">Result </a></li>
                  </ul>
               </li>
               <li><a href="{{ route('actionContact')}}">Contact</a></li>
               @if(auth()->user()!='')
               @if(auth()->user()->type==0)
               <li><a href="{{route('admin.home')}}" >My Account</a></li>
               @elseif(auth()->user()->type==1 || auth()->user()->user_type=='2'|| auth()->user()->type=='3')
               <li><a href="{{route('admin.home')}}" >My Account</a></li>
               @elseif(auth()->user()->type==4)
               <li><a href="#" >My Account</a></li>
               @endif 
               @else
               <li><a href="{{ route('login')}}">Login</a></li>
               @endif
            </ul>
         </nav>
         <!-- .nav-menu -->
         </div>
      </header>
      <!-- End Header -->
      <main id="main">
         @yield('content')
      </main>
      <!-- ======= Footer ======= -->
            <footer id="footer" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500"> 
         <div class="footer-top">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-1 col-md-6 footer-links">
                  </div>
                  <div class="col-lg-2 col-md-6 footer-links">
                     <h4>Useful Links</h4>
                     <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="/">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionHistory')}}">History</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionDgMsg')}}">Leadership Message</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionOrganisationStructure')}}">Organisation Structure</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionFireUnits')}}">Fire station's List</a></li>
                     </ul>
                  </div>
                  <div class="col-lg-2 col-md-6 footer-links">
                     <h4>Policies</h4>
                     <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionCopyright')}}">Copyright Policy</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionHyperlinkingPolicy')}}">Hyperlinking Policy</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionTermsCondition')}}">Terms & Conditions</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionPrivacyPolicy')}}">Privacy Policy</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionSitemap')}}">Sitemap</a></li>
                     </ul>
                  </div>
                  <div class="col-lg-2 col-md-6 footer-contact">
                     <h4>Address</h4>
                     <p>
                        <strong>Location:</strong> Police Headquater, <br>12 Subhash Road,<br>Dehradun, Uttarakhand<br>
                        <strong>Phone:</strong> 9412070164<br>
                        <strong>Email:</strong> fshq[dot]ukfs[at]gmail[dot]com<br>
                     </p>
                     <!-- <div class="social-links mt-3">
                        <a href="https://twitter.com/ukfireservices" class="twitter"><i class="bx bxl-twitter"></i></a>
                        <a href="https://www.facebook.com/uttarakhandfireservice/" class="facebook"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/uttarakhandfireservice/" class="instagram"><i class="bx bxl-instagram"></i></a>
                        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                        <div class="hit">
                        <h5 class="text-center">Hit Counter</h5>
                        <div text-align="center"><a href='#'><img src='http://www.hit-counts.com/counter.php?t=MTQ1MjE5Mw==' alt='since'></a><BR><a href='#'>Since: 05-10-2020
                           </a>
                        </div>
                        </div> -->
                  </div>
                  <div class="col-lg-2 col-md-6 footer-links">
                     <h4>Useful Links</h4>
                     <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionFaq')}}">FAQ's</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionFeedback')}}">Feedback</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionGrivances')}}">Grievance</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{ route('actionActs')}}">Download</a></li>
                     </ul>
                  </div>
                  <div class="col-lg-2 col-md-6 footer-links">
                    <h4>Social Links</h4>
                     <div class="social-links mt-3">
                        <a href="https://x.com/ukfireservices" class="twitter" target="_blank"><i class="bx bxl-twitter"></i></a>
                        <a href="https://www.facebook.com/uttarakhandfireservice/" class="facebook" target="_blank"><i class="bx bxl-facebook"></i></a>
                        <a href="https://www.instagram.com/uttarakhandfireservice/" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
                     </div>
                     <div class="hit">
                        <h5 class="text-center">Hit Counter</h5>
                        <div text-align="center"><a href='#'><img src='http://www.hit-counts.com/counter.php?t=MTQ1MjE5Mw==' alt='since'></a><BR><a href='#'>Since: 05-10-2020
                           </a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-1 col-md-6 footer-links">
                  </div>
               </div>
            </div>
         </div>
         <div class="footer-2">
            <div class="container">
               <div class="row">
                  <div class="col-md-3">
                     <a href="https://uk.gov.in/" target="_blank"><img src="{{ asset('/public/fire/gallery/nic-portal.gif') }}" class="img-responsive"></a>
                  </div>
                  <div class="col-md-3">
                     <a href="http://www.india.gov.in/" target="_blank"><img src="{{ asset('/public/fire/gallery/portal.gif') }}" class="img-responsive"></a>
                  </div>
                  <div class="col-md-3">
                     <a href="http://uttarakhandpolice.uk.gov.in/" target="_blank"><img src="{{ asset('/public/fire/gallery/logo1.jpg') }}" class="img-responsive"></a>
                  </div>
                  <div class="col-md-3">
                     <a href="http://www.bis.org.in/" target="_blank"><img src="{{ asset('/public/fire/gallery/logo2.jpg') }}" class="img-responsive"></a>
                  </div>
               </div>
            </div>
         </div>
         <div class="container">
            <div class="copyright">
               &copy; Copyright 2023 <strong><span>Uttarakhand Fire Service</span></strong>. All Rights Reserved <br>
               <!-- Display container -->
               <p stype="font-size:22px;">Total Visitors (simulated): <span id="visitor-count">Loading...</span></p>

            </div>
            <div class="text-center">
               Designed and Developed by <a href="https://itda.uk.gov.in/" style="color: #dbe3fc">Information Technology Development Agency (ITDA) Government of Uttarakhand</a>
            </div>
            <!-- <p style="text-align: center;">Contents of this website is published and managed by Information Technology Development Ageny, Department of IT, Government of Uttarakhand.
               For any queries regarding this website please contact <a href="#">Web Information Manager</a>.</p> -->
         </div>
      </footer>
      <!-- End Footer -->
      <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
      <script src="{{ asset('/public/fire/vendor/jquery/jquery.min.js') }}"></script>
      <!-- Vendor JS Files -->
      <script src="{{ asset('/public/fire/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('/public/fire/vendor/jquery.easing/jquery.easing.min.js') }}"></script>
      <!-- <script src="{{ asset('/fire/vendor/php-email-form/validate.js') }}"></script> -->
      <script src="{{ asset('/public/fire/vendor/venobox/venobox.min.js') }}"></script>
      <script src="{{ asset('/public/fire/vendor/waypoints/jquery.waypoints.min.js') }}"></script>
      <script src="{{ asset('/public/fire/vendor/counterup/counterup.min.js') }}"></script>
      <script src="{{ asset('/public/fire/vendor/owl.carousel/owl.carousel.min.js') }}"></script>
      <script src="{{ asset('/public/fire/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('/public/fire/vendor/aos/aos.js') }}"></script>
      <script src="{{ asset('/public/fire/js/anime.min.js') }}"></script>
      <!-- Template Main JS File -->
      <script src="{{ asset('/public/fire/js/main.js') }}"></script>
      <script>
         AOS.init();
         // Wrap every letter in a span
         // var textWrapper = document.querySelector('.ml11 .letters');
         // textWrapper.innerHTML = textWrapper.textContent.replace(/([^\x00-\x80]|\w)/g, "<span class='letter'>$&</span>");
         
         // anime.timeline({loop: true})
         //   .add({
         //     targets: '.ml11 .line',
         //     scaleY: [0,1],
         //     opacity: [0.5,1],
         //     easing: "easeOutExpo",
         //     duration: 700
         //   })
         //   .add({
         //     targets: '.ml11 .line',
         //     translateX: [0, document.querySelector('.ml11 .letters').getBoundingClientRect().width + 10],
         //     easing: "easeOutExpo",
         //     duration: 700,
         //     delay: 100
         //   }).add({
         //     targets: '.ml11 .letter',
         //     opacity: [0,1],
         //     easing: "easeOutExpo",
         //     duration: 600,
         //     offset: '-=775',
         //     delay: (el, i) => 34 * (i+1)
         //   }).add({
         //     targets: '.ml11',
         //     opacity: 0,
         //     duration: 1000,
         //     easing: "easeOutExpo",
         //     delay: 1000
         //   });
           
      </script>
      <script src="{{ asset('/public/fire/js/snow.js') }}"></script>
      <script>
         // window.onload = _snowCanvas({
         //     el: document.getElementById("snowCanvas"),
         //     snowColor: "#fff",
         //     background: "transparent",
         //     maxSpeed: 4,
         //     minSpeed: 1,
         //     width: "",
         //     height: "",
         //     amount: 150,
         //     rMax: 2,
         //     rMin: 1
         // });
      </script>
      <script src="{{ asset('/public/fire/js/textsizer.js') }}"></script>


      <script>
         document.addEventListener("DOMContentLoaded", function () {
            const VISIT_KEY = "site_visit_home";
            const COUNT_KEY = "visitor_count_simulated";

            // Check if already visited
            if (!localStorage.getItem(VISIT_KEY)) {
               localStorage.setItem(VISIT_KEY, "true");

               // Simulate counter: store in localStorage (per user only)
               let count = parseInt(localStorage.getItem(COUNT_KEY) || "0");
               count++;
               localStorage.setItem(COUNT_KEY, count);
            }

            // Display (simulated) visitor count
            const display = document.getElementById("visitor-count");
            if (display) {
               display.textContent = localStorage.getItem(COUNT_KEY) || "1";
            }
         });
         </script>


      <script type="text/javascript">
         @yield ('scripts');
      </script>
   </body>
</html>
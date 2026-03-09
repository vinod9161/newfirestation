<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Uttarakhand Fire Service" />
    <meta name="description" content="Uttarakhand Fire Service" />
    <meta name="keywords" content="Uttarakhand Fire Service">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- SITE TITLE -->
    <title>Home | Uttarakhand Fire Service</title>

    <!-- FAVICON AND TOUCH ICONS  -->
    <link rel="shortcut icon" href="{{ asset('public/new_assets/img/Fire_Service_Logo.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('public/new_assets/img/Fire_Service_Logo.png') }}" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('public/new_assets/img/Fire_Service_Logo.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('public/new_assets/img/Fire_Service_Logo.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('public/new_assets/img/Fire_Service_Logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('public/new_assets/img/Fire_Service_Logo.png') }}">

    <!-- GOOGLE FONTS -->
    <link href="{{ asset('public/new_assets/css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('public/new_assets/css/fonts2.css') }}" rel="stylesheet">
    <link href="{{ asset('public/new_assets/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- BOOTSTRAP CSS -->
    <link href="{{ asset('public/new_assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- PLUGINS STYLESHEET -->
    <link href="{{ asset('public/new_assets/css/menu.css') }}" rel="stylesheet">
    <link id="effect" href="{{ asset('public/new_assets/css/dropdown-effects/fade-down.css') }}" media="all" rel="stylesheet">
    <link href="{{ asset('public/new_assets/css/magnific-popup.css') }}" rel="stylesheet">
    <link href="{{ asset('public/new_assets/css/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/new_assets/css/owl.theme.default.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/new_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public/new_assets/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <!-- TEMPLATE CSS -->
    <link href="{{ asset('public/new_assets/css/style.css') }}" rel="stylesheet">

    <!-- RESPONSIVE CSS -->
    <link href="{{ asset('public/new_assets/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('public/new_assets/css/my-style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- <script src="{{ asset('../cdn.jsdelivr.net/npm/bootstrap%405.0.2/dist/js/bootstrap.bundle.min.js') }}" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <script src="{{ asset('/public/fire/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <style>
        .btn-primary:hover {
            background-color: #006270;
            border-color: #006270;
            color: #fff;
        }

        .btn-primary{
            background-color: #006270;
            border-color: #006270;
            color: #fff;
        }
        .flagday-section {
            background: #f5f7fb;
        }

        .content-card {
            text-align: justify;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        }

        .content-text, p, li {
            
            font-size: 20px;
            line-height: 1.6;
            color: #333;
        }
        .detail-box, p, ul, li{
            
            font-weight: 400;
            color: #333;
            font-family: 'Roboto', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        .content-card ul, .objective-detail ul {
            margin: revert;
            padding: revert;
            list-style: revert;
        }

        .form-group {
            margin-bottom: 20px !important;
        }

        .form-control, .custom-select {
            padding: 5px;
        }
  </style>

</head>

<body>

    <div id="page" class="page">
        <div class="header"></div>
        <header id="header-2" class="header">
            <div class="wsmobileheader clearfix">
                <a id="wsnavtoggle" class="wsanimated-arrow"><span></span></a>
                <a href="">
                    <span class="smllogo">
                        <img src="{{ asset('public/new_assets/img/logo_header.png') }}" height="50px" alt="mobile-logo" /></span>
                </a>
                <a class="mlngbtn" data-bs-toggle="modal" data-bs-target="#exampleModal">हिन्दी</a>
            </div>

            <div class="headtoppart bg-steelblue clearfix">
                <div class="headerwp clearfix" style="margin-top: -5px;">
                    <!-- Address -->
                    <div class="headertopleft">
                        <div class="address clearfix">
                            <span>Government Of Uttarakhand | उत्तराखंड सरकार</span>
                            <a href="mailto:dig.ukfs@gmail.com"><i class="fas fa-envelope"></i><strong>dig.ukfs@gmail.com</strong></a>
                        </div>
                    </div>

                    <div class="headertopright">
                        <a href="https://www.youtube.com/@UttarakhandFireService" class="ico-youtube" target="_blank"><i class="fab fa-youtube" style="line-height: 3 !important"></i></a>
                        <a href="https://x.com/UKFireServices" class="ico-twitter" target="_blank"><i class="fa-brands fa-x-twitter"></i><i class="fab fa-x-twitter" style="padding: 5px 0px;"></i></a>
                        <a href="https://www.instagram.com/uttarakhandfireservice/?hl=en" class="ico-instagram" target="_blank"><i class="fab fa-instagram" style="line-height: 3 !important"></i></a>
                        <a href="https://www.facebook.com/UttarakhandFireService/" class="ico-facebook" target="_blank"><i class="fab fa-facebook-f" style="line-height: 3 !important;"></i></a>
                        <!--a class="lngbtn"  data-bs-toggle="modal" data-bs-target="#exampleModal">हिन्दी</a-->
                        <!-- Modal -->
                    </div>
                </div>
            </div>

            <div class="hero-widget clearfix">
                <div class="container-fluid">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6 col-xl-8">
                            <div class="desktoplogo"><a href=""><img src="{{ asset('public/new_assets/img/logo_header.png') }}" height="100px" alt="header-logo"></a></div>
                        </div>

                        <div class="col-md-6 col-xl-4">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="header-widget icon-xs">
                                        <span class="flaticon-092-clock blue-color"></span>
                                        <div class="header-widget-txt">
                                            <a href="tel: 112"><img src="{{ asset('public/new_assets/img/help.png') }}" width="220"></a>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <a href="https://state.Uttarakhand.gov.in/gad/" target="_blank">
                                        <div class="header-widget icon-xs">
                                            <span class="flaticon-092-clock blue-color"></span>
                                            <div class="header-widget-txt">
                                                <img src="{{ asset('public/new_assets/img/uttarakhand-sasan.png') }}" height="90">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NAVIGATION MENU -->
            <div class="wsmainfull menu clearfix">
                <div class="wsmainwp clearfix">
                    <div class="desktoplogo"><a href=""><img src="{{ asset('public/new_assets/img/logo_footer.png') }}" height="40px" alt="header-logo"></a></div>
                    <!-- MAIN MENU -->
                    <nav class="wsmenu clearfix">
                        <ul class="wsmenu-list">
                            <!-- DROPDOWN MENU -->
                            <li class="{{ request()->routeIs('actionIndex') ? 'active' : '' }}">
                                <a href="{{ route('actionIndex') }}">Home</a>
                            </li>
                            <li class="{{ request()->routeIs('actionMissionVision','actionHistory','actionOrganisationStructure','actionFireServiceDay','actionFlagday','actionObjective','actionDgMsg','actionFireUnits','actionFaq','actionTutorials') ? 'active' : '' }}">
                                <a href="#">About Us<span class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('actionMissionVision')}}">Mission & Vision</a></li>
                                    <li><a href="{{ route('actionHistory')}}">History</a></li>
                                    <li><a href="{{ route('actionOrganisationStructure')}}">Organization Structure</a></li>
                                    <li><a href="{{ route('actionFireServiceDay')}}">Fire Service Day </a></li>
                                    <li><a href="{{ route('actionFlagday')}}">Flag Day</a></li>
                                    <li><a href="{{ route('actionObjective')}}">Our Objective</a></li>
                                    <li><a href="{{ route('actionDgMsg')}}">DG's Message</a></li>
                                    <li><a href="{{ route('actionFireUnits')}}">Fire Station List</a></li>
                                    <!-- <li><a href="{{ route('actionStaffStrength')}}">Sanctioned strength</a></li> -->
                                    <li><a href="{{ route('actionFaq')}}">FAQ's</a></li>
                                    <li><a href="{{ route('actionTutorials')}}">Tutorial </a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true" class="{{ request()->routeIs('nocdocrequiredata','checklistdata','actionRTI','rtsAction','applicationtrackstatus','applicationverificationtrackstatus','actionFireFighting','actionStandby','actionPumpingWork','actionPublicAwareness','actionIncidentReport') ? 'active' : '' }}">
                                <a href="">Services<span class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li aria-haspopup="true"><a href="#">NOC<span class="wsarrow"></span></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('login')}}">Apply For NOC</a></li>
                                            <li><a href="{{ route('nocdocrequiredata') }}">Require Documents for NOC</a></li>
                                            <li><a href="{{ route('checklistdata') }}">Checklist for NOC</a></li>
                                            <li><a href="{{ route('login') }}" >Check NOC Status</a></li>
                                            <li><a href="{{ route('login') }}">NOC Verification</a></li>
                                            <li><a href="https://ifms.uk.gov.in">Fire Service Fee Challan</a></li>
                                        </ul>
                                    </li>
                                    <li aria-haspopup="true"><a href="#">RTI & RTS<span class="wsarrow"></span></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ route('actionRTI')}}" target="_blank">RTI</a></li>
                                            <li><a href="{{ route('rtsAction') }}" target="_blank">Right to Service</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('applicationtrackstatus')}}">Application Status</a></li>
                                    <li><a href="{{ route('applicationverificationtrackstatus')}}">NOC Verification</a></li>
                                    <li aria-haspopup="true"><a href="#">Help<span class="wsarrow"></span></a>
                                        <ul class="sub-menu">
                                            <li><a href="{{ asset('/public/fire/pdf/ukfireservices_SWCS.pdf') }}" target="_blank">Filling NOC Through Single Window</a></li>
                                            <li><a href="{{ asset('/public/fire/pdf/ukfireservices_standalone_application.pdf') }}" target="_blank">Filling NOC Directly From Website</a></li>
                                            <li><a href="{{ asset('/public/fire/pdf/flow_chart_of_fire_noc_approval-.pdf') }}" target="_blank">Flow Chart of Fire NOC Approval </a></li>
                                            <li><a href="{{ asset('/public/fire/pdf/required_documents.pdf') }}" target="_blank">Documents Required for Fire NOC</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('actionFireFighting')}}">Fire Fighting & Rescue Opretion</a></li>
                                    <li><a href="{{ route('actionStandby')}}">Standby Duties</a></li>
                                    <li><a href="{{ route('actionPumpingWork')}}">Pumping Works</a></li>
                                    <li><a href="{{ route('actionPublicAwareness')}}">Awareness classes/Mock Drills</a></li>
                                    <!-- <li><a href="{{ route('login') }}">Training</a></li> -->
                                    <li><a href="{{ route('actionIncidentReport')}}">Fire Service / Incident Report</a></li>
                                    <!-- <li><a href="{{ route('actionServicerenderunpaid')}}">Service rendered unpaid</a></li> -->
                                    <!-- <li><a href="{{ route('actionServicerenderedpaid')}}">Service rendered paid</a></li> -->
                                </ul>
                            </li>
                            <li class="{{ request()->routeIs('actionAchivementsPrevious','actionMedalWinner','actionCallDetails','actionAwarenessProgramme') ? 'active' : '' }}">
                                <a href="#">Achievements<span class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('actionAchivementsPrevious')}}">Achievement in previous year</a></li>
                                    <li><a href="{{ route('actionMedalWinner')}}">Medal Winners</a></li>
                                    <li><a href="{{ route('actionCallDetails')}}">Emergency Calls (Fire & Rescue)</a></li>
                                    <li><a href="{{ route('actionAwarenessProgramme')}}">Awareness Programme</a></li>
                                    <!-- <li><a href="{{ route('actionSpecialRiskArea')}}">Identified Special Risk Area</a></li> -->
                                    <!-- <li><a href="{{ route('actionGrowthInStaffStrength')}}">Growth In Staff strength</a></li> -->
                                    <!-- <li><a href="#">Seminars</a></li>
                                    <li><a href="#">Conferences</a></li>
                                    <li><a href="{{ asset('/public/fire/pdf/9 fire unit.pdf') }}" target="_blank">New station Opening</a></li>
                                    <li><a href="{{ route('actionPriorityListOfFireStation')}}">Priority List of Stations</a></li> -->
                                    
                                    
                                </ul>
                                
                            </li>
                            <li class="{{ request()->routeIs('actionActs') ? 'active' : '' }}">
                                <a href="{{ route('actionActs') }}">Acts & Rules</a>
                            </li>
                            <li aria-haspopup="true" class="{{ request()->routeIs('actionG1','publicarticledata','actionFireServiceWeek') ? 'active' : '' }}">
                                <a href="#">Activities<span class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('actionG1')}}">Gallery</a></li>
                                    <!-- <li><a href="{{ route('actionG1')}}">Present Activities</a></li> -->
                                    <li><a href="{{ route('publicarticledata')}}">Public Articles</a></li>
                                    <li><a href="{{ route('actionFireServiceWeek')}}">Fire Service Week </a></li>
                                </ul>
                            </li>
                            <li aria-haspopup="true" class="{{ request()->routeIs('serviceorderdata','welfareamenitydata') ? 'active' : '' }}">
                                <a href="#">Establishment<span class="wsarrow"></span></a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('serviceorderdata') }}">Service Orders</a></li>
                                    <!-- <li><a href="{{ route('actionStaffStrength')}}">Statement of available strength</a></li> -->
                                    <!-- <li><a href="{{ route('actionVehicle')}}">Vehicle & Equipment</a></li> -->
                                    <li><a href="{{ route('welfareamenitydata') }}">Welfare and Amenity Fund</a></li>
                                </ul>
                            </li>
                            <!-- <li aria-haspopup="true"><a href="#">Academy<span class="wsarrow"></span></a>

                                <ul  class="sub-menu">
                                    <li><a href="{{ route('recruitmentdata')}}">Recruitments</a></li>
                                    <li><a href="{{ route('actionHistory')}}">History</a></li>
                                    <li><a href="{{ route('historydata') }}">History</a></li>
                                    <li><a href="{{ route('routemapdata') }}">Route Map</a></li>
                                    <li><a href="{{ route('istitutionalstructuredata') }}">Institutional Structure</a></li>
                                    <li><a href="{{ route('coursedata') }}">Courses</a></li>
                                    <li><a href="{{ route('trainingscheduledata') }}">Training Schedule</a></li>
                                    <li><a href="{{ route('resultdata') }}">Result </a></li>
                                </ul>
                            </li> -->
                            <li class="{{ request()->routeIs('actionContact') ? 'active' : '' }}">
                                <a href="{{ route('actionContact')}}">Contact</a>
                            </li>
                            @if(auth()->user()!='')
                            @if(auth()->user()->type!=4)
                            <li class="{{ request()->routeIs('admin.home') ? 'active' : '' }}">
                                <a href="{{route('admin.home')}}">My Account</a>
                            </li>
                            @else
                            <li class="{{ request()->routeIs('citizen.account') ? 'active' : '' }}">
                                <a href="{{route('citizen.account')}}">My Account</a>
                            </li>
                            @endif
                            @if(auth()->user()->type==4)
                            <li class="{{ request()->routeIs('citizenLogout') ? 'active' : '' }}">
                                <a href="{{ route('citizenLogout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @else
                            <li class="{{ request()->routeIs('logout') ? 'active' : '' }}">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign Out</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                            @endif
                            @else
                            @if(!(request()->is('apuni-sarkar') || request()->is('single-window')))
                            <li class="{{ request()->routeIs('login') ? 'active' : '' }}">
                                <a href="{{ route('login')}}">Login</a>
                            </li>
                            @endif
                            @endif
                            </li>
                        </ul>
                    </nav>
                    <!-- END MAIN MENU -->
                </div>
            </div>
        </header>

        @yield('content')

        <!-- FOOTER-1============================================= -->
        <footer id="footer-1" class="bg-image wide-20 footer division">
            <div class="container">
                <!-- FOOTER CONTENT -->
                <div class="row">
                    <!-- FOOTER INFO -->
                    <div class="col-md-4 col-lg-4">
                        <div class="footer-info mb-20">
                            <img src="{{ asset('public/new_assets/img/logo_footer.png') }}" height="55px" alt="footer-logo">
                            <!-- <p class="para pt-2">Welcome to the official website of the Uttarakhand Fire Service. We are dedicated to ensuring the safety and well-being of our community through rapid response to fire emergencies and fire safety awareness </p> -->
                            <div class="footer-socials-links mt-20">
                                <ul class="foo-socials text-center clearfix">
                                    <li><a href="https://www.facebook.com/UttarakhandFireService/" class="ico-facebook" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="https://x.com/UKFireServices" class="ico-twitter" target="_blank"><i class="fa fa-x-twitter"></i></a></li>
                                    <li><a href="https://www.instagram.com/uttarakhandfireservice/?hl=en" class="ico-instagram" target="_blank"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="https://www.youtube.com/@UttarakhandFireService" class="ico-youtube" target="_blank"><i class="fab fa-youtube"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- FOOTER CONTACTS -->
                    <div class="col-md-4 col-lg-4">
                        <div class="footer-box mb-20">
                            <!-- Title -->
                            <h5 class="h5-xs">Our Location</h5>
                            <!-- Address -->
                            <p class="para"><b>Office Address: </b><a href="https://maps.app.goo.gl/PvQanqsL2yZ3FXKm9" class="text-white" target="_blank"><i class="fas fa-route text-white"></i>
                                    Uttarakhand Fire & Emergency Services, 4th Floor, Sardar Patel Bhavan Court Road, Opposite Doon hospital Dehradun, Uttarakhand</a></p>
                        </div>
                    </div>
                    <!-- FOOTER WORKING HOURS -->
                     <!-- FOOTER CONTACTS -->
                    <div class="col-md-4 col-lg-4">
                        <div class="footer-box mb-20">
                            <!-- Title -->
                            <h5 class="h5-xs">Our Contacts</h5>
                            <!-- Email -->
                            <p class="foo-email mt-20">Email ID: <a href="mailto:dig.ukfs@gmail.com">dig.ukfs@gmail.com</a></p>
                            <!-- Phone -->
                            <p>Phone: <a href="tel:9412070164" style="color:white;">+91 - 9412070164</a></p>
                            <p>Helpline Number: <a href="tel:01352716201" style="color:white;">0135-2716201</a></p>
                        </div>
                    </div>
                    <!-- FOOTER WORKING HOURS -->

                    <!-- FOOTER PHONE NUMBER -->
                    <!-- <div class="col-md-6 col-lg-4">
                        <div class="footer-box mb-20">
                            <h5 class="h5-xs">Quick Links</h5>
                            <ul>
                                <li><a href="javascript:void(0);" style="color:#fff"><i class="fas fa-angle-double-right"></i> Urban Development & Housing Department</a></li>

                                <li><a href="javascript:void(0);" style="color:#fff"><i class="fas fa-angle-double-right"></i> RERA</a></li>

                                <li><a href="javascript:void(0);" style="color:#fff"><i class="fas fa-angle-double-right"></i> GRS Departmental Login</a></li>
                            </ul>
                        </div>
                    </div> -->
                </div> <!-- END FOOTER CONTENT -->

                <!-- FOOTER COPYRIGHT -->
                <div class="bottom-footer">
                    <div class="row text-center">
                        <div class="col-md-12">
                            <p class="footer-copyright">&copy; <span>Uttarakhand Fire Service </span>| All Rights Reserved | <a href="#" class="text-white">Website Policies</a></p>
                        </div>
                    </div>
                </div>


            </div> <!-- End container -->
        </footer> <!-- END FOOTER-1 -->

    </div> <!-- END PAGE CONTENT -->

    <!-- EXTERNAL SCRIPTS
		============================================= -->
    <script src="{{ asset('public/new_assets/js/jquery-3.3.1.min.js') }}"></script>
    <!-- <script src="{{ asset('public/new_assets/js/bootstrap.min.js') }}"></script> -->
    <script src="{{ asset('public/new_assets/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.appear.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/menu.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/sticky.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.scrollto.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/materialize.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/hero-form.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/contact-form.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/comment-form.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/appointment-form.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.datetimepicker.full.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/wow.js') }}"></script>

    <!-- Custom Script -->
    <script src="{{ asset('public/new_assets/js/custom.js') }}"></script>
    <script src="{{ asset('public/new_assets/js/my-script.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('/public/fire/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


    <script>
        new WOW().init();
    </script>

    <script src="{{ asset('public/new_assets/js/changer.js') }}"></script>
    <script defer src="{{ asset('public/new_assets/js/styleswitch.js') }}"></script>
    <script src="https://cdn.ux4g.gov.in/tools/accessibility-widget.js" async></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
        @yield('scripts');
    </script>
</body>

</html>
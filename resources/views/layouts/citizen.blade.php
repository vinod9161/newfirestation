<!DOCTYPE html>
<html class="no-js">
   <head>
      <meta charset="utf-8">
      <meta name="description" content="Uttrakhand Fire and Emergency Services">
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap&amp;subset=vietnamese">
      <!-- Favicons -->
      <link href="/fire/gallery/fav.png" rel="icon">
      <link href="/fire/gallery/app-fav.png" rel="apple-touch-icon">
      <title>Uttrakhand Fire and Emergency Services</title>
      <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/fontawesome.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/flaticon-category.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/jquery-ui.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/jquery.mCustomScrollbar.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
   </head>
   <body>
      <div class="wrapper" id="wrapper">
         <header class="header-site" id="header">
            <div class="container-fluid">
               <div class="header-wrap">
                  <div class="header-left">
                     <div class="header-main-toggle">
                        <button class="btn-toggle" type="button" data-toggle="offcanvas"><i class="fas fa-bars"></i></button>
                     </div>
                     <div class="header-logo"><a class="qdesk-logo" href="#" title="QDesk"><img class="qdesk-logo-white" src="{{ asset('/assets/images/fire-logo.png') }}" alt="Uttrakhand Fire and Emergency Services" style="max-width: 50%;"><img class="qdesk-logo-black" src="{{ asset('/assets/images/fire-logo.png') }}" alt="Uttrakhand Fire and Emergency Services" style="max-width: 50%;"></a></div>
                     @if(request()->data || auth()->user()->user_id)
                     <div class="navigation" id="navigation">
                        <ul class="main-menu">
                           <li class="active"><a href="#">HOME</a></li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#">About Us<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                           </li>
                           <li class="drop-down">
                              <a href="#" style="padding-left:5px; padding-right: 5px;">Services<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#">Achivements<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                           </li>
                           <li >
                              <a  style="padding-left:5px; padding-right: 5px;" href="#">Acts & Rules<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#">Activities<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#"> Establishment<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#"> Academy<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                           </li>
                           <li><a href="#">Contact</a></li>
                        </ul>
                     </div>
                     @else
                     <div class="navigation" id="navigation">
                        <ul class="main-menu">
                           <li class="active"><a href="{{route('citizen.account')}}">HOME</a></li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#">About Us<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                              <ul class="sub-menu">
                                 <li><a href="{{ route('actionMissionVision')}}">Mission & Vision</a></li>
                                 <li><a href="{{ route('actionHistory')}}">History</a></li>
                                 <li><a href="{{ route('actionOrganisationStructure')}}">Organization Structure</a></li>
                                 <li><a href="{{ route('actionFireServiceDay')}}">Fire Service Day </a></li>
                                 <li><a href="{{ route('actionFlagday')}}">Flag Day</a></li>
                                 <li><a href="{{ route('actionObjective')}}">Our Objective</a></li>
                                 <li><a href="{{ route('actionDgMsg')}}">IG's Message</a></li>
                                 <li><a href="{{ route('actionFireUnits')}}">Fire Station List</a></li>
                                 <li><a href="{{ route('actionStaffStrength')}}">Staff Strength</a></li>
                                 <li><a href="{{ route('actionFaq')}}">FAQ's</a></li>
                              </ul>
                           </li>
                           <li class="drop-down">
                              <a href="#" style="padding-left:5px; padding-right: 5px;">Services<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                              <ul class="sub-menu">
                                 <li class="drop-down">
                                    <a href="#">NOC <i class="fas fa-caret-right"></i></a>
                                    <ul >
                                       <li class="drop-down">
                                          <a href="#">Apply For NOC</a>
                                          <ul >
                                             <li><a href="#">Pre Establishment NOC</a></li>
                                             <li><a href="#">Pre- Operation NOC</a></li>
                                             <li><a href="#">Annual Clearance Certificate</a></li>
                                             <li><a href="loginform.html">Temporary/ other</a></li>
                                          </ul>
                                       </li>
                                       <li><a  href="/fire/pdf/required_documents.pdf" target="_blank">Required Document for NOC</a></li>
                                       <li><a href="/fire/pdf/fire_checklist (1).pdf" target="_blank">Checklist for NOC</a></li>
                                       <li><a href="#" target="_blank">Check NOC Status</a></li>
                                       <li><a href="#" target="_blank">NOC Verification</a></li>
                                       <li><a href="/fire/pdf/challan-fire-service-fee.pdf" target="_blank">Fire Service Fee Challan</a></li>
                                    </ul>
                                 </li>
                                 <li >
                                    <a href="#">RTI & RTS</a>
                                    <ul >
                                       <li><a href="{{ route('actionRTI')}}" target="_blank">RTI</a></li>
                                       <li><a href="/fire/pdf/Right_to_Service_Act_2011_in_English.pdf" target="_blank">Right to Service</a></li>
                                    </ul>
                                 </li>
                                 <li >
                                    <a href="#">Help</a>
                                    <ul >
                                       <li><a href="/fire/pdf/ukfireservices_SWCS.pdf" target="_blank">Filling NOC Through Single Window</a></li>
                                       <li><a href="/fire/pdf/ukfireservices_standalone_application.pdf" target="_blank">Filling NOC Directly From Website</a></li>
                                       <li><a href="/fire/pdf/flow_chart_of_fire_noc_approval-.pdf" target="_blank">Flow Chart of Fire NOC Approval </a></li>
                                       <li><a href="/fire/pdf/required_documents.pdf" target="_blank">Documents Required for Fire NOC</a></li>
                                    </ul>
                                 </li>
                                 <li><a href="{{ route('actionFireFighting')}}">Fire fighting & rescue Operation</a></li>
                                 <li><a href="#">Standby Duties</a></li>
                                 <li><a href="{{ route('actionPumpingWork')}}">Pumping Works</a></li>
                                 <li><a href="#">Awareness classes/Mock Drills</a></li>
                                 <li><a href="#">Training</a></li>
                                 <li><a href="#">Incident Reports</a></li>
                                 <li><a href="{{ route('actionServicerenderunpaid')}}">Services Rendered Unpaid</a></li>
                                 <li><a href="{{ route('actionServicerenderedpaid')}}">Services Rendered Paid</a></li>
                              </ul>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#">Achivements<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                              <ul class="sub-menu">
                                 <li><a href="{{ route('actionAchivementsPrevious')}}">Achievements in previous years</a></li>
                                 <li><a href="{{ route('actionMedalWinner')}}">Medal Winners</a></li>
                                 <li><a href="{{ route('actionGrowthInStaffStrength')}}">Growth in Staff Strength</a></li>
                                 <li><a href="{{ route('actionCallDetails')}}">Call Details 2000-2019</a></li>
                                 <li><a href="#">Seminars</a></li>
                                 <li><a href="#">Conferences</a></li>
                                 <li><a href="/fire/pdf/9 fire unit.pdf" target="_blank">New station Opening</a></li>
                                 <li><a href="{{ route('actionPriorityListOfFireStation')}}">Priority List of Stations</a></li>
                              </ul>
                           </li>
                           <li >
                              <a  style="padding-left:5px; padding-right: 5px;" href="{{ route('actionActs')}}">Acts & Rules<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                              <ul class="sub-menu">
                                 <li><a href="#">Uttarakhand Fire service act</a></li>
                                 <li><a href="/fire/pdf/UKFS-Subordinate-Officers-Employees-Service-Rules-2016_compressed.pdf">Subordinates Service Rules</a></li>
                                 <li><a href="#">GO/Standing Orders</a></li>
                                 <li><a href="/fire/pdf/Order-to-All-SSP-SP-and-CFO-Online-100.pdf" target="_blank">Circulars</a></li>
                                 <li><a href="#">NOC Related</a></li>
                                 <li><a href="#">Welfare and Amenity Fund By-Law</a></li>
                                 <li><a href="#">Store Purchase Manual</a></li>
                                 <li><a href="#">Uttarakhand Service Rules</a></li>
                                 <li><a href="#">Fire Service Manual</a></li>
                                 <li><a href="#">RMSI Study Report</a></li>
                                 <li><a href="#">Others</a></li>
                              </ul>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#">Activities<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                              <ul class="sub-menu">
                                 <li><a href="{{ route('actionG1')}}">Gallery</a></li>
                                 <li><a href="{{ route('actionG1')}}">Present Activities</a></li>
                                 <li><a href="{{ route('actionG1')}}">Public Articles</a></li>
                                 <li><a href="{{ route('actionFireServiceWeek')}}">Fire Service Week </a></li>
                              </ul>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#"> Establishment<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                              <ul class="sub-menu">
                                 <li><a href="#">Service Orders</a></li>
                                 <li><a href="{{ route('actionStaffStrength')}}">Strength Statement</a></li>
                                 <li><a href="{{ route('actionVehicle')}}">Vehicles & Equipment</a></li>
                                 <li><a href="#">Welfare and Amenity Fund</a></li>
                                 <li><a href="#">Recruitment</a></li>
                              </ul>
                           </li>
                           <li >
                              <a style="padding-left:5px; padding-right: 5px;" href="#"> Academy<i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a>
                              <ul class="sub-menu">
                                 <li><a href="{{ route('actionHistory')}}">History</a></li>
                                 <li><a href="#">Route Map</a></li>
                                 <li><a href="#">Instituational Structure</a></li>
                                 <li><a href="#">Courses</a></li>
                                 <li><a href="#">Training Schedule</a></li>
                                 <li><a href="#">Result </a></li>
                              </ul>
                           </li>
                           <li><a href="{{ route('actionContact')}}">Contact</a></li>
                        </ul>
                     </div>
                     @endif
                  </div>
                  <div class="header-right">
                     @if(auth()->user()!='')
                     <div class="header-right-logined">
                        <div class="user-profile-logined">
                           <div class="header-user">
                              <div class="avatar" style="max-width: 50px;"><a href="#"><img src="{{Auth::user()->profile->image ?? '{{ asset('/assets/images/placeholder.png'}}" alt="{{Auth::user()->first_name }}"></a><span class="status active"></span></div>
                              <div class="info-user">
                                 <h3> <a data-toggle="collapse" href="#user-profile-dropdown">{{ucwords(Auth::user()->name)}} <i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a></h3>
                                 <div class="user-profile-dropdown collapse" id="user-profile-dropdown">
                                    <ul>
                                       @if(auth()->user()->type==0)
                                       <li><a href="javascript:void(0)" style="color: #000;">Admin Dashboard</a></li>
                                       @elseif(auth()->user()->type==1 || auth()->user()->type==2 || auth()->user()->type==3 || auth()->user()->type==5)
                                       <li><a href="javascript:void(0)" style="color: #000;">Department Dashboard</a></li>
                                       <li><a href="#">Upload Signature</a></li>
                                       @elseif(auth()->user()->type==4)
                                       <li><a href="javascript:void(0)" style="color: #000;">Citizen Dashboard</a></li>
                                       @elseif(auth()->user()->type==6)
                                       <li><a href="javascript:void(0)" style="color: #000;">Agency Dashboard</a></li>
                                       @elseif(auth()->user()->type==7)
                                       <li><a href="javascript:void(0)" style="color: #000;">Auditor Dashboard</a></li>
                                       @endif
                                       <li>
                                          <a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #000;">Sign Out</a>
                                          <form id="logout-form" action="" method="POST" style="display: none;">
                                             @csrf
                                          </form>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                   
                     @endif
                  </div>
               </div>
            </div>
         </header>
        
         <main class="main-content">
            @yield('content')
         </main>
         <footer class="footer-site" id="footer" style="margin-top: 0px;">
            <div class="container">
               <!-- <div class="footer-top" style="padding: 0px;margin-bottom: 0px;">
                  <div class="row align-items-center text-center text-lg-left">
                     <div class="col-lg-4 mb-2 mb-lg-0"><img src="{{ asset('/assets/images/fire-logo.png" alt="Uttrakhand Fire and Emergency Services" style="max-width: 26%;"></div>
                     <div class="col-lg-8">
                        <ul class="nav-footer">
                           <li><a href="#">Privacy Policy</a></li>
                           <li><a href="#">Terms & Conditions</a></li>
                           <li><a href="#">Help</a></li>
                           <li><a href="#">Partners</a></li>
                        </ul>
                     </div>
                  </div>
               </div> -->
               <div class="footer-bottom">
                  <div class="copyright">© {{ now()->year }} <span class="text-green">Uttrakhand Fire and Emergency Services</span><span class="text-white"> </span> Design by <span class="text-white">Information Technology Development Agency (ITDA), Department of IT, Good Governance & Science Technology, Government of Uttarakhand.</span>. All Rights Reserved</div>
               </div>
            </div>
         </footer>
      </div>
      <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
      <script src="{{ asset('/assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('/assets/js/slick.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery-ui.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('/assets/js/imagesloaded.pkgd.js') }}"></script>
      <script src="{{ asset('/assets/js/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ asset('/assets/js/main.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/admin/js/jquery.dataTables.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/admin/js/dataTables.bootstrap.min.js') }}"></script>
      <script type="text/javascript">
         @yield ('scripts')
      </script>
   </body>
</html>
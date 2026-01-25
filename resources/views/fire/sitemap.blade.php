@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Sitemap</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Sitemap</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

    <!-- ======= About Section ======= -->
    <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
        <div class="container">
  
          <div class="row">
        
        
  
            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
                <h4>Top Menu</h4>
                    <ul>
                          <li class="active"><a href="{{ route('actionIndex')}}">HOME</a></li>
                          <li class="drop-down"><a href="#">About Us</a>
                
                            <ul>
                              <li><a href="mission-vision.html">Mission & Vision</a></li>
                              <li><a href="history.html">History</a></li>
                              <li><a href="organisation_structure.html">Organization Structure</a></li>
                              <li><a href="fire-service-day.html">Fire Service Day </a></li>
                              <li><a href="flagday.html">Flag Day</a></li>
                              <li><a href="objective.html">Our Objective</a></li>
                              <li><a href="dg_message.html">IG's Message</a></li>
                              <li><a href="fire_units.html">Fire Station List</a></li>
                              <li><a href="staff-strength.html">Staff Strength</a></li>
                
                              <li><a href="faq2.html">FAQ's</a></li>
                
                            </ul>
                          
                          </li>
                            
                          <li class="drop-down"><a href="#">Services</a>
                            <ul>
                              <li class="drop-down"><a href="#">NOC</a>
                                <ul>
                                  <li class="drop-down"><a href="loginform.html">Apply For NOC</a>
                
                                    <ul>
                                      <li><a href="loginform.html">Pre Establishment NOC</a></li>
                                      <li><a href="loginform.html">Pre- Operation NOC</a></li>
                                      <li><a href="loginform.html">Annual Clearance Certificate</a></li>
                                      <li><a href="loginform.html">Temporary/ other</a></li>
                                      
                                    </ul>
                                  
                                  </li>
                                  <li><a href="#" target="_blank">Required Document for NOC</a></li>
                
                
                                  <li><a href="{{asset('/public/fire/gallery/pdf/fire_checklist (1).pdf')}}" target="_blank">Checklist for NOC</a></li>
                
                                  <li><a href="#" target="_blank">Check NOC Status</a></li>
                                  <li><a href="#" target="_blank">NOC Verification</a></li>
                                  <li><a href="{{asset('/public/fire/gallery/pdf/challan-fire-service-fee.pdf')}}" target="_blank">Fire Service Fee Challan</a></li>
                
                
                                </ul>
                              </li>
                
                              <li class="drop-down"><a href="#">RTI & RTS</a>
                                <ul>
                                  <li><a href="{{route('actionRTI')}}" target="_blank">RTI</a></li>
                                  <li><a href="{{asset('/public/fire/gallery/pdf/Right_to_Service_Act_2011_in_English.pdf')}}" target="_blank">Right to Service</a></li>
                  
                                
                                </ul>
                              </li>
                
                
                              
                              <li class="drop-down"><a href="#">Help</a>
                                <ul>
                                  <li><a href="{{asset('/public/fire/gallery/pdf/ukfireservices_SWCS.pdf')}}" target="_blank">Filling NOC Through Single Window</a></li>
                                  <li><a href="{{asset('/public/fire/gallery/pdf/ukfireservices_standalone_application.pdf')}}" target="_blank">Filling NOC Directly From Website</a></li>
                                  <li><a href="{{asset('/public/fire/gallery/pdf/flow_chart_of_fire_noc_approval-.pdf')}}" target="_blank">Flow Chart of Fire NOC Approval </a></li>
                
                                  <li><a href="{{asset('/public/fire/gallery/pdf/required_documents.pdf')}}" target="_blank">Documents Required for Fire NOC</a></li>
                
                                  <li><a href="{{asset('/public/fire/gallery/pdf/BBL(2016).pdf')}}" target="_blank">Uttarakhand Building BYE-LAWS</a></li>
                
                                  <li><a href="{{asset('/public/fire/gallery/pdf/nbc_part4_fls.pdf')}}" target="_blank">National Building Code Part 4</a></li>
                
                  
                                
                                </ul>
                              </li>
                  
                             
                              <li><a href="firefighting.html">Fire fighting & rescue Operation</a></li>
                              <li><a href="standby.html">Standby Duties</a></li>
                              <li><a href="pumping-work.html">Pumping Works</a></li>
                              <li><a href="public-awareness.html">Awareness classes/Mock Drills</a></li>
                              <li><a href="#">Traning</a></li>
                              <li><a href="fire-incident-report.html">Fire/ Incident Reports</a></li>
                              <li><a href="servicerenderunpaid.html">Services Rendered Unpaid</a></li>
                              <li><a href="servicerenderedpaid.html">Services Rendered Paid</a></li>
                            </ul>
                        
                        </li>
                        
                          <li class="drop-down"><a href="#">Achivements</a>
                            <ul>
                              <li><a href="achivements-in-previous-year.html">Achievements in previous years</a></li>
                              <li><a href="medal_winner.html">Medal Winners</a></li>
                              <li><a href="Growth in Staff strength.html">Growth in Staff Strength</a></li>
                              <li><a href="call details.html">Call Details 2000-2019</a></li>
                              <li><a href="#">Seminars</a></li>
                              <li><a href="#">Conferences</a></li>
                              <li><a href="{{asset('/public/fire/gallery/pdf/9 fire unit.pdf')}}" target="_blank">New station Opening</a></li>
                              <li><a href="Priority list of fire station.html">Priority List of Stations</a></li>
                
                            </ul>
                          </li>
                
                          <li class="drop-down"><a href="acts_rules.html">Acts & Rules</a>
                            <ul>
                              <li><a href="#">Uttarakhand Fire service act</a></li>
                              <li><a href="{{asset('/public/fire/gallery/pdf/UKFS-Subordinate-Officers-Employees-Service-Rules-2016_compressed.pdf')}}">Subordinates Service Rules</a></li>
                              <li><a href="#">GO/Standing Orders</a></li>
                              <li><a href="{{asset('/public/fire/gallery/pdf/Order-to-All-SSP-SP-and-CFO-Online-100.pdf')}}" target="_blank">Circulars</a></li>
                              <li><a href="#">NOC Related</a></li>
                              <li><a href="#">Welfare and Amenity Fund By-Law</a></li>
                              <li><a href="#">Store Purchase Manual</a></li>
                              <li><a href="#">Uttarakhand Service Rules</a></li>
                            
                              <li><a href="#">Fire Service Manual</a></li>
                              <li><a href="#">RMSI Study Report</a></li>
                              <li><a href="#">Others</a></li>
                            </ul>
                          </li>
                
                          <li class="drop-down"><a href="#">Activities</a>
                
                            <ul>
                              <li><a href="G1.html">Gallery</a></li>
                              <li><a href="#">Present Activities</a></li>
                              <li><a href="#">Public Articles</a></li>
                            
                              <li><a href="fire_service_week.html">Fire Service Week </a></li>
                             
                
                            </ul>
                          
                          </li>
                
                
                
                
                          <li class="drop-down"><a href="#"> Establishment</a>
                            <ul>
                              <li><a href="#">Service Orders</a></li>
                              <li><a href="staff -strength.html">Strength Statement</a></li>
                              <li><a href="Vehicle.html">Vehicles & Equipment</a></li>
                              <li><a href="#">Welfare and Amenity Fund</a></li>
                              <li><a href="#">Recruitment</a></li>
                            
                            </ul>
                          </li>
                
                
                    
                
                          <li class="drop-down"><a href="#"> Academy</a>
                            <ul>
                              <li><a href="#">History</a></li>
                              <li><a href="#">Route Map</a></li>
                              <li><a href="#">Instituational Structure</a></li>
                              <li><a href="#">Courses</a></li>
                              <li><a href="#">Traning Schedule</a></li>
                              <li><a href="#">Result </a></li>
                            
                            </ul>
                          </li>
                
                         
                
                
                          <li><a href="contact.html">Contact</a></li>
                
                          <li><a href="https://ukfireservices.com/fireservice/admin">Login</a></li>
                      
                          </li>
                        </ul>

                        <h4>Footer Menu</h4>
               
                            <ul>
                                Useful Links
                                <li><a href="index.html">Home</a></li>
                                <li><a href="history.html">History</a></li>
                                <li> <a href="dg_message.html">Leadership Message</a></li>
                                <li> <a href="organisation_structure.html">Organisation Structure</a></li>
                                <li><a href="fire_units.html">Fire station's List</a></li>
                              </ul>

                              <ul>Policies
                                <li><a href="#">Copyright Policy</a></li>
                                <li><a href="#">Hyperlinking Policy</a></li>
                                <li><a href="#">Terms & Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Sitemap</a></li>
                              </ul>

                              <ul> Useful Links
               
                                <li><a href="#">FAQ's</a></li>
                                <li><a href="#">Feedback</a></li>
                                <li><a href="#">Grievance</a></li>
                                <li><a href="#">Download</a></li>
                  
                              </ul>
              </div>



      </section>

@endsection
@section('scripts')
@stop

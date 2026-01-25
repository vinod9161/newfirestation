@extends('layouts.admin.template')
@section('title')
<title>Citizen Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Citizen Management</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div class="me-2">
            <a href="javascript:void(0);" class="btn ripple btn-wave  btn-secondary navresponsive-toggler mb-0"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1 fs-10"></i>
            </a>
        </div>
    </div>
</div>
<!-- End Row -->


<!--Navbar-->
<div class="responsive-background">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="advanced-search br-3">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Application For :</label>
                                <select class="form-control" data-trigger name="choices-single-default" id="filter_type">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="1">Image</option>
                                    <option value="2">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Type :</label>
                                <select class="form-control" data-trigger name="choices-single-default" id="filter_type">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="1">Image</option>
                                    <option value="2">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Building Name :</label>
                                <select class="form-control" data-trigger name="choices-single-default" id="filter_type">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="1">Image</option>
                                    <option value="2">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>District :</label>
                                <select class="form-control" data-trigger name="choices-single-default" id="filter_type">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="1">Image</option>
                                    <option value="2">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Status :</label>
                                <select class="form-control" data-trigger name="choices-single-default" id="filter_status">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-end">
                <a href="javascript:void(0);" onclick="filter_slider();" class="btn btn-primary">Apply</a>
                <a href="javascript:void(0);" class="btn btn-secondary">Reset</a>
            </div>
        </div>
    </div>
</div>
<!--End Navbar -->

<div class="card custom-card" id="hori">
   <div class="card-body">
      <div>
         <h6 class="card-title mb-1">NOC Details</h6>
      </div>
      <div class="text-wrap">
         <div class="example">
            <nav class="nav nav-style-1 nav-pills mb-3" role="tablist"> 
            	<a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page" href="#nav-products" aria-selected="true">BASIC DETAILS</a> 
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-cart" aria-selected="false" tabindex="-1">BUILDING ADDRESS</a> 
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-orders" aria-selected="false" tabindex="-1">PROPRIETARY DETAILS</a> 
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-offers" aria-selected="false" tabindex="-1">AREA & SET BACK DETAILS</a>
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-Essential" aria-selected="false" tabindex="-1">ESSENTIAL PROVISION DETAIL</a>
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-Attachments" aria-selected="false" tabindex="-1">ATTACHMENTS</a>
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-Fire" aria-selected="false" tabindex="-1">FIRE VENDOR DETAIL</a> 
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-Remarks" aria-selected="false" tabindex="-1">REMARKS & REVERT INFORMATION</a>
            	<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-History" aria-selected="false" tabindex="-1">APPLICATION HISTORY</a> 
            </nav>
            <div class="tab-content">
                <div class="tab-pane text-muted active show" id="nav-products" role="tabpanel"> 
               		<h5>
               			Basic Details
               		</h5>
               		<hr>
               		<div class="row">
		               <div class="col-md-4">
		                  <label class="form-label">Application No. : </label><br>
		                  <span>1648717966</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Application Type : </label><br>
		                  <span>Pre Establishment Noc</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Building Name : </label><br>
		                  <span>Doonitric</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Building Category : </label><br>
		                  <span>Industrial</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Building Sub Category : </label><br>
		                  <span>Low Hazard Industries</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Type Of Industry : </label><br>
		                  <span>Abrasive Manufacturing Premises</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Building Ownership : </label><br>
		                  <span>Occupied</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">GST Pan Tan : </label><br>
		                  <span>Tan</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">GST Pan Tan No. : </label><br>
		                  <span>65464564564</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Project Status : </label><br>
		                  <span>New</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Latitude : </label><br>
		                  <span>55555555555</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Longitude : </label><br>
		                  <span>88888888888</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Email :</label><br>
		                  <span>ct@gmail.com</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Mobile No : .</label><br>
		                  <span>12345678</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Office Telephone : </label><br>
		                  <span>8909075607</span>
		               </div>
		            </div>
               	</div>
               <div class="tab-pane text-muted" id="nav-cart" role="tabpanel">
               		<h5>
               			Building Address
               		</h5> 
               		<hr>
               		<div class="row">
		               <div class="col-md-4">
		                  <label class="form-label">District : </label><br>
		                  <span>Dehradun देहरादून</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Rural / Urban : </label><br>
		                  <span>Rural</span>
		               </div>
		                              <div class="col-md-4">
		                  <label class="form-label">Block : </label><br>
		                  <span>Chakrata चकराता</span>
		               </div>
		                                             <div class="col-md-4">
		                  <label class="form-label">Panchayat : </label><br>
		                  <span>Panchayat chakrata</span>
		               </div>
		                                             <div class="col-md-4">
		                  <label class="form-label">Plot / Khasra / Khatauni :</label><br>
		                  <span>Khatoni</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Plot Khasra Khatauni No.:</label><br>
		                  <span>46456546</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Street :</label><br>
		                  <span></span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Village : </label><br>
		                  <span>Dehradun</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">City :</label><br>
		                  <span></span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Landmark : </label><br>
		                  <span>Rispana pull</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Pincode : </label><br>
		                  <span>248001</span>
		               </div>
		            </div>
               </div>
               <div class="tab-pane text-muted" id="nav-orders" role="tabpanel"> 
               		<h5>
               			Proprietary Details
               		</h5>
               		<hr>
               		<div class="row">
		               <div class="col-md-4">
		                  <label class="form-label">Proprietary Rights :</label><br>
		                  <span>Single</span>
		               </div>
		               <div class="col-md-12">
		                  <label class="form-label">Owner Detail : </label><br>
		                  <div class="row">
		                     <div class="col-md-3">
		                        <span><b style="margin-left:20px">Name : </b>Mr Xyz Y Z
		                        </span>
		                     </div>
		                     <div class="col-md-3">
		                        <span>   <b style="margin-left:20px">Mobile No : </b> 12345 
		                        </span>
		                     </div>
		                     <div class="col-md-3">
		                        <span>    <b style="margin-left:20px">Percentage Share : </b> 12 
		                        </span>
		                     </div>
		                     <div class="col-md-3">
		                        <span>
		                        <b style="margin-left:20px">Point Of Contact : </b> No</span>
		                     </div>
		                  </div>
		               </div>
		               <div class="col-md-12">
		                  <label class="form-label">Contact Person :</label><br>
		                  <div class="row">
		                     <div class="col-md-3">
		                        <span>
		                        <b style="margin-left:20px">Person Appointed : </b>Director
		                        </span>
		                     </div>
		                     <div class="col-md-3">
		                        <span> 
		                        <b style="margin-left:20px">Name : </b>Mr Abc B C
		                        </span>
		                     </div>
		                     <div class="col-md-3">
		                        <span> 
		                        <b style="margin-left:20px">Mobile No : </b> 8909075603
		                        </span>
		                     </div>
		                     <div class="col-md-3">
		                        <span> 
		                        <b style="margin-left:20px">Email Address : </b> rohit.esdc@gmail.com
		                        </span>
		                     </div>
		                  </div>
		               </div>
		               <div class="col-md-12">
		                  <label class="form-label">Architect Detail :</label><br>
		                  <div class="row">
		                     <div class="col-md-3">
		                        <span>
		                        <b style="margin-left:20px">Name : </b>Mr Pqr Doonitrix R
		                        </span>    
		                     </div>
		                     <div class="col-md-3">
		                        <span> 
		                        <b style="margin-left:20px">Mobile No : </b> 8909075603
		                        </span>   
		                     </div>
		                     <div class="col-md-3">
		                        <span> 
		                        <b style="margin-left:20px">Email Address : </b> doonitrix@gmail.com
		                        <br>
		                        </span>   
		                     </div>
		                     <div class="col-md-3">
		                        <span> 
		                        <b style="margin-left:20px">Firm Gst Pan Tan : </b> gst
		                        </span>  
		                     </div>
		                     <div class="col-md-3">
		                        <span> 
		                        <b style="margin-left:20px">Firm Gst Pan Tan No. : </b> 464656456456
		                        </span>
		                     </div>
		                  </div>
		               </div>
		            </div>
               	</div>
                <div class="tab-pane text-muted" id="nav-offers" role="tabpanel"> 
               		<h5>Area and Set Back Details</h5>
               		<hr>
               		<div class="row">
		               <div class="col-md-4">
		                  <label class="form-label">Total Plot Area : </label><br>
		                  <span><b>Area : </b>34
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Total Covered Area : </label><br>
		                  <span>
		                  <b>Area : </b>32
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Ground Floor Covered : </label><br>
		                  <span>
		                  <b>Area : </b>45
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Max Height Building : </label><br>
		                  <span>
		                  <b>Height : </b>43
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">No. Of Floor : </label><br>
		                  <span>45</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Basement Covered Area : </label><br>
		                  <span>
		                  <b>Area : </b>45
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">No Of Basement : </label><br>
		                  <span>45</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">No Of Blocks : </label><br>
		                  <span>45</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Height Of Tallest Block : </label><br>
		                  <span>
		                  <b>Height : </b>45
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Min Distance Block : </label><br>
		                  <span>
		                  <b>Height : </b>54
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Approach Road Width : </label><br>
		                  <span>
		                  <b>Width : </b>55
		                  </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Provision No Enterance : </label><br>
		                  <span>5</span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Provision No Exit : </label><br>
		                  <span>5</span>
		               </div>
		            </div>
               	</div>
               	<div class="tab-pane text-muted" id="nav-Essential" role="tabpanel"> 
               		<h5>Essential</h5>
               		<hr>
               		<div class="row">
		               <div class="col-md-4">
		                  <label class="form-label">Compartmentation :</label><br><span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">No. Of Stairs : </label><br>
		                  <span>4 </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Minimum Width of Stairs : </label><br>
		                  <span>56 </span>
		               </div>
		              
		               <div class="col-md-4">
		                  <label class="form-label">Emergency Exit : </label><br>
		                  <span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Provision Of Lift : </label><br>
		                  <span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Electric Suppy : </label><br>
		                  <span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Emergency Lighting System : </label><br>
		                  <span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Provision Of Smoke : </label><br>
		                  <span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Emergency Lighting System : </label><br>
		                  <span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Refuse Area : </label><br>
		                  <span>yes </span>
		               </div>
		               <div class="col-md-4">
		                  <label class="form-label">Travel Distance : </label><br>
		                  <span>554 </span>
		               </div>
		               
		               <div class="col-md-4">
		                  <label class="form-label">Other Comment : </label><br>
		                  <span>565 </span>
		               </div>
		            </div>
               	</div>
               	<div class="tab-pane text-muted" id="nav-Attachments" role="tabpanel"> 
               		<h5>Attachments</h5>
               		<hr>
               		<div class="row">
		               <div class="col-md-12">
		                  <span>
		                                    <b>Reference Letter : </b><a href="https://www.fireservice.uk.gov.in/uploads/1648718078.pdf" target="blank" title="View Reference Letter"><img src="https://www.fireservice.uk.gov.in/assets/icon/pdf_icon.png" class="img-reponsive" style="width:50px;"></a>
		                                                      <b>Propossed Map : </b><a href="https://www.fireservice.uk.gov.in/uploads/1648718091.pdf" target="blank" title="View Propossed Map"><img src="https://www.fireservice.uk.gov.in/assets/icon/pdf_icon.png" class="img-reponsive" style="width:50px;"></a>
		                                                      <b>Fire Plan : </b><a href="https://www.fireservice.uk.gov.in/uploads/1648718099.pdf" target="blank" title="View Fire Plan"><img src="https://www.fireservice.uk.gov.in/assets/icon/pdf_icon.png" class="img-reponsive" style="width:50px;"></a><br>
		                                    </span>
		               </div>
		            </div> 
               	</div>
               	<div class="tab-pane text-muted" id="nav-Fire" role="tabpanel"> 
               		<h5>Vendor detail</h5>
               		<hr> 
               		<div class="row">
				         <div class="col-md-4">
				            <label class="form-label">Name of Fire Vendor :</label><br><span>Doon Fire Vendor </span>
				         </div>
				         <div class="col-md-4">
				            <label class="form-label">Name Of Firm : </label><br>
				            <span>Doon Fire Vendor Firm </span>
				         </div>
				         <div class="col-md-4">
				            <label class="form-label">Mobile No. : </label><br>
				            <span>12345 </span>
				         </div>
				         <div class="col-md-4">
				            <label class="form-label">GST/PAN/TAN</label><br>
				            <span>Gst </span>
				         </div>
				         <div class="col-md-4">
				            <label class="form-label">GST/PAN/TAN No. : </label><br>
				            <span>12345 </span>
				         </div>
				         <div class="col-md-4">
				            <label class="form-label">Email : </label><br>
				            <span>mail@mail.com </span>
				         </div>
				      </div>
               	</div>
               	<div class="tab-pane text-muted" id="nav-Remarks" role="tabpanel"> 
               		

               		<div class="row">
					   <div class="col-xl-3">
					      <nav class="nav nav-tabs flex-column nav-style-5" role="tablist"> 
						      	<a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page" href="#home-vertical-link" aria-selected="true">
						      		Remarks By CFO
						      	</a> 
						      	<a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#about-vertical-link" aria-selected="false" tabindex="-1">
						      		Remarks By FSO
						      	</a> 
						      	<a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#services-vertical-link" aria-selected="false" tabindex="-1">
						      		Revert Information
						      	</a>
					      </nav>
					   </div>
					   <div class="col-xl-9">
					      <div class="tab-content">
					          <div class="tab-pane text-muted active show" id="home-vertical-link" role="tabpanel">
					          	<h5>Remarks By CFO</h5>
					          	<hr> 
					          	<div class="row mb-3">
					               <div class="col-md-6">
					                  <label class="form-label">1. This certificate shall not valid for illegal construction</label><br>
					               </div>
					               <div class="col-md-4">
					                  <span>03/31/2022 09:40:33 am</span>
					               </div>
					            </div>
					             <div class="row mb-3">
					               <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
						               <label class="form-label">Reason for Remark : </label><br>
						               <div class="col-md-12"><span><b>=&gt;</b> Applicant shall take pre operational NOC before occupied (operation) the building</span></div>
						               <div class="col-md-12"><span><b>=&gt;</b> Applicant shall inform fire department in case of change in the map</span></div>
					              </div>
					            </div>
					      	 </div>

					         <div class="tab-pane text-muted" id="about-vertical-link" role="tabpanel"> 
					         	<h5>Remarks By FSO</h5>
					         	<hr>
					         	<div class="row mb-3">
					               <div class="col-md-6">
					                  <label class="form-label">1. Applicant shall take pre operational NOC before occupied (operation) the building</label><br>
					               </div>
					               <div class="col-md-4">
					                  <span>03/31/2022 09:37:49 am</span>
					               </div>
					            </div>

					            <div class="row mb-3">
					               <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
					              		<label class="form-label">Reason for Remark : </label><br>
					                    <div class="col-md-12"><span><b>=&gt;</b> Applicant shall take pre operational NOC before occupied (operation) the building</span></div>
					                    <div class="col-md-12"><span><b>=&gt;</b> The construction shall not violate the NBC Part-IV norms or state building by-Laws</span></div>
					               </div>
					            </div>
					          </div>

					         <div class="tab-pane text-muted" id="services-vertical-link" role="tabpanel"> 
					         	<h5>Revert</h5>
					         	<hr>
					         	<div class="row mb-3">
					               <h4 style="text-align:center;">No Remark Found</h4>
					            </div>
					          </div>
					      </div>
					   </div>
					</div>
               	</div>
               	<div class="tab-pane text-muted" id="nav-History" role="tabpanel"> 
               		<h5>Application History</h5>
               		<hr>
               		<div class="row mb-3">
                     <div class="col-md-12">
			               <div class="desc" style="padding:20px;background:rgb(243,251,232);">
			                  <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
			                     <div class="thumb">
			                        <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
			                        <p style="display:inline-block;font-size:14px;margin-left:15px"><muted>2022-03-31 09:15:24am</muted></p>
			                     </div>
			                     <div class="details" style="font-size:14px;padding-left:40px">
			                        <p style="color:#1c90c0;">Application has been forwarded to Deputy Director</p>
			                     <!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
			                     </div>
			                  </div>
			               </div>
			            </div>
			                     <div class="col-md-12">
			               <div class="desc" style="padding:20px;background:rgb(243,251,232);">
			                  <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
			                     <div class="thumb">
			                        <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
			                        <p style="display:inline-block;font-size:14px;margin-left:15px"><muted>2022-03-31 09:20:23am</muted></p>
			                     </div>
			                     <div class="details" style="font-size:14px;padding-left:40px">
			                        <p style="color:#1c90c0;">Application has been forwarded to concerned CFO Rajendra Singh Khati</p>
			                     <!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
			                     </div>
			                  </div>
			               </div>
			            </div>
			                     <div class="col-md-12">
			               <div class="desc" style="padding:20px;background:rgb(243,251,232);">
			                  <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
			                     <div class="thumb">
			                        <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
			                        <p style="display:inline-block;font-size:14px;margin-left:15px"><muted>2022-03-31 09:20:44am</muted></p>
			                     </div>
			                     <div class="details" style="font-size:14px;padding-left:40px">
			                        <p style="color:#1c90c0;">Application has been assigned to FSO Sunil Dutt Tiwari</p>
			                     <!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
			                     </div>
			                  </div>
			               </div>
			            </div>
			                     <div class="col-md-12">
			               <div class="desc" style="padding:20px;background:rgb(243,251,232);">
			                  <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
			                     <div class="thumb">
			                        <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
			                        <p style="display:inline-block;font-size:14px;margin-left:15px"><muted>2022-03-31 09:38:55am</muted></p>
			                     </div>
			                     <div class="details" style="font-size:14px;padding-left:40px">
			                        <p style="color:#1c90c0;">Application has been Sent for appoval..!</p>
			                     <!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
			                     </div>
			                  </div>
			               </div>
			            </div>
			                     <div class="col-md-12">
			               <div class="desc" style="padding:20px;background:rgb(243,251,232);">
			                  <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
			                     <div class="thumb">
			                        <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
			                        <p style="display:inline-block;font-size:14px;margin-left:15px"><muted>2022-03-31 09:39:13am</muted></p>
			                     </div>
			                     <div class="details" style="font-size:14px;padding-left:40px">
			                        <p style="color:#1c90c0;">Application has been Sent for Pre appoval..!</p>
			                     <!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
			                     </div>
			                  </div>
			               </div>
			            </div>
			                     <div class="col-md-12">
			               <div class="desc" style="padding:20px;background:rgb(243,251,232);">
			                  <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
			                     <div class="thumb">
			                        <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
			                        <p style="display:inline-block;font-size:14px;margin-left:15px"><muted>2022-03-31 09:39:43am</muted></p>
			                     </div>
			                     <div class="details" style="font-size:14px;padding-left:40px">
			                        <p style="color:#1c90c0;">Application has been Pre approved..!</p>
			                     <!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
			                     </div>
			                  </div>
			               </div>
			            </div>
			                     <div class="col-md-12">
			               <div class="desc" style="padding:20px;background:rgb(243,251,232);">
			                  <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
			                     <div class="thumb">
			                        <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
			                        <p style="display:inline-block;font-size:14px;margin-left:15px"><muted>2022-03-31 09:40:48am</muted></p>
			                     </div>
			                     <div class="details" style="font-size:14px;padding-left:40px">
			                        <p style="color:#1c90c0;">Application has been Approved Successfully</p>
			                     <!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
			                     </div>
			                  </div>
			               </div>
			            </div>
                  </div>
               	</div>
            </div>
         </div>
      </div>
   </div>
</div>


@endsection
@section('scripts')

<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

@stop
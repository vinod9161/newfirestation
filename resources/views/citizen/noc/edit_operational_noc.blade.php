@extends('layouts.citizen.template')
@section('content')
<div class="row">
    <div class="card custom-card" id="navigation" style="margin-top: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                     <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link mb-3  shadow" id="v-pills-home-tab"  href="{{route('citizen.account')}}" role="tab"  >
                        <span class="font-weight-bold small text-uppercase">Dashboard</span></a>
                        <a class="nav-link mb-3  shadow" id="v-pills-home-tab"  href="{{route('noc')}}" role="tab"  >
                        <span class="font-weight-bold small text-uppercase">All NOC</span></a>

                        <a class="nav-link mb-3  shadow" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <span class="font-weight-bold small text-uppercase">Basic Details</span></a>
                        <a class="nav-link mb-3  shadow" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Building Address</span></a>
                        <a class="nav-link mb-3  shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Proprietary Details</span></a>
                        <a class="nav-link mb-3  shadow" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Area and Set Back Details</span></a>
                        <a class="nav-link mb-3  shadow" id="v-pills-provison-tab" data-toggle="pill" href="#v-pills-provison" role="tab" aria-controls="v-pills-provison" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Essential Provision Detail</span></a>
                        <a class="nav-link mb-3  shadow" id="v-pills-attachment-tab" data-toggle="pill" href="#v-pills-attachment" role="tab" aria-controls="v-pills-attachment" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Attachments </span></a>
                        @if(Auth::user()->type== 4 && $applicationDetail->status=='approved')
                        <a class="nav-link mb-3  shadow active" id="v-pills-operational-tab" data-toggle="pill" href="#v-pills-operational" role="tab" aria-controls="v-pills-operational" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Edit Pre Operational NOC</span></a>
                        @endif
                        @if($applicationDetail->operational_applications)
                        <a class="nav-link mb-3  shadow" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab" aria-controls="v-pills-vendor" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Fire Vendor Detail</span></a>
                        @if(Auth::user()->type== 4 && $applicationDetail->operational_applications->status=='approved' && $applicationDetail->operational_applications->application_type == 'pre operational noc' && !$applicationDetail->renewal_applications)

                        <a class="nav-link mb-3  shadow" id="v-pills-renewal-tab" data-toggle="pill" href="#v-pills-renewal" role="tab" aria-controls="v-pills-renewal" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Apply for Annual Clearance NOC </span></a>
                        @endif
                        @endif
                        @if(Auth::user()->type != 4)
                        <a class="nav-link mb-3 p-3 shadow" id="v-pills-pro-tab" data-toggle="pill" href="#v-pills-pro" role="tab" aria-controls="v-pills-pro" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Physical Inspection of Site by FSO </span></a>
                        @endif
                    </div>
                </div>
                <!-- Tabs content -->
                  <div class="col-md-9 tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="font-italic mb-4">Basic Details</h4>
                        <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Application No. : </label><br>
                            <span >{{$applicationDetail->application_no}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Application Type : </label><br>
                            <span >{{ucwords($applicationDetail->application_type)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Building Name : </label><br>
                            <span >{{ucwords($applicationDetail->building_name)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Building Category : </label><br>
                            <span >{{ucwords($applicationDetail->category->name)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Building Sub Category : </label><br>
                            <span >{{ucwords($applicationDetail->subcategory->name)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Type Of Industry : </label><br>
                            <span >{{ucwords($applicationDetail->type->name)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Building Ownership : </label><br>
                            <span >{{ucwords($applicationDetail->building_ownership)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">GST Pan Tan : </label><br>
                            <span >{{ucfirst($applicationDetail->gst_pan_tan)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">GST Pan Tan No. : </label><br>
                            <span >{{$applicationDetail->gst_pan_tan_no}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Project Status : </label><br>
                            <span >{{ucfirst($applicationDetail->project_status)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Latitude : </label><br>
                            <span >{{$applicationDetail->latitude}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Longitude : </label><br>
                            <span >{{$applicationDetail->longitude}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email :</label><br>
                            <span >{{$applicationDetail->email}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mobile No : .</label><br>
                            <span >{{$applicationDetail->mobile_no}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Office Telephone : </label><br>
                            <span >{{$applicationDetail->office_telephone}}</span>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                        <h4 class="font-italic mb-4">Building Address</h4>
                        <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">District : </label><br>
                            <span >{{ucfirst($applicationDetail->district->name)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Rural / Urban : </label><br>
                            <span >{{ucfirst($applicationDetail->rural_urban)}}</span>
                        </div>
                        @if($applicationDetail->block)
                        <div class="col-md-4">
                            <label class="form-label">Block : </label><br>
                            <span >{{ucfirst($applicationDetail->block->name)}}</span>
                        </div>
                        @endif
                        @if($applicationDetail->panchayat)
                        <div class="col-md-4">
                            <label class="form-label">Panchayat : </label><br>
                            <span >{{ucfirst($applicationDetail->panchayat->name)}}</span>
                        </div>
                        @endif
                        @if($applicationDetail->tehsil)
                        <div class="col-md-4">
                            <label class="form-label">Tehsil : </label><br>
                            <span >{{ucfirst($applicationDetail->tehsil->name)}}</span>
                        </div>
                        @endif
                        <div class="col-md-4">
                            <label class="form-label">Plot / Khasra / Khatauni :</label><br>
                            <span >{{ucfirst($applicationDetail->plot_khasra_khatauni)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Plot Khasra Khatauni No.:</label><br>
                            <span >{{$applicationDetail->plot_khasra_khatauni_no}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Street :</label><br>
                            <span >{{ucfirst($applicationDetail->street)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Village : </label><br>
                            <span >{{ucfirst($applicationDetail->village)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">City :</label><br>
                            <span >{{ucfirst($applicationDetail->city)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Landmark : </label><br>
                            <span >{{ucfirst($applicationDetail->landmark)}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Pincode : </label><br>
                            <span >{{ucfirst($applicationDetail->pincode)}}</span>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4 class="font-italic mb-4">Proprietary Details</h4>
                        <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Proprietary Rights :</label><br>
                            <span >{{ucfirst($applicationDetail->proprietary_rights)}}</span>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Owner Detail : </label><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <span ><b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail->owner_detail)->salutation}} {{ucfirst(json_decode($applicationDetail->owner_detail)->first_name)}} {{ucfirst(json_decode($applicationDetail->owner_detail)->middle_name)}} {{ucfirst(json_decode($applicationDetail->owner_detail)->last_name)}}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span>   <b style="margin-left:20px">Mobile No : </b> {{json_decode($applicationDetail->owner_detail)->mobile_no}} 
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span>    <b style="margin-left:20px">Percentage Share : </b> {{json_decode($applicationDetail->owner_detail)->percentage_share}} 
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span>
                                    <b style="margin-left:20px">Point Of Contact : </b> {{ucfirst(json_decode($applicationDetail->owner_detail)->point_of_contact)}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Contact Person :</label><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <span >
                                    <b style="margin-left:20px">Person Appointed : </b>{{json_decode($applicationDetail->contact_person)->person_appointed ?? ''}}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span> 
                                    <b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail->contact_person)->con_salutation}} {{ucfirst(json_decode($applicationDetail->contact_person)->con_first_name)}} {{ucfirst(json_decode($applicationDetail->contact_person)->con_middle_name)}} {{ucfirst(json_decode($applicationDetail->contact_person)->con_last_name)}}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span> 
                                    <b style="margin-left:20px">Mobile No : </b> {{json_decode($applicationDetail->contact_person)->con_mobile_no}}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <span> 
                                    <b style="margin-left:20px">Email Address : </b> {{json_decode($applicationDetail->contact_person)->con_email}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Architect Detail :</label><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <span >
                                    <b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail->architect_detail)->arc_salutation}} {{ucfirst(json_decode($applicationDetail->architect_detail)->arc_first_name)}} {{ucfirst(json_decode($applicationDetail->architect_detail)->arc_middle_name)}} {{ucfirst(json_decode($applicationDetail->architect_detail)->arc_last_name)}}
                                    </span>    
                                </div>
                                <div class="col-md-3">
                                    <span> 
                                    <b style="margin-left:20px">Mobile No : </b> {{json_decode($applicationDetail->architect_detail)->architect_mobile_no}}
                                    </span>   
                                </div>
                                <div class="col-md-3">
                                    <span> 
                                    <b style="margin-left:20px">Email Address : </b> {{json_decode($applicationDetail->architect_detail)->architect_email}}
                                    <br>
                                    </span>   
                                </div>
                                <div class="col-md-3">
                                    <span> 
                                    <b style="margin-left:20px">Firm Gst Pan Tan : </b> {{json_decode($applicationDetail->architect_detail)->firm_gst_pan_tan}}
                                    </span>  
                                </div>
                                <div class="col-md-3">
                                    <span> 
                                    <b style="margin-left:20px">Firm Gst Pan Tan No. : </b> {{json_decode($applicationDetail->architect_detail)->firm_gst_pan_tan_no}}
                                    </span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h4 class="font-italic mb-4">Area and Set Back Details</h4>
                        <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span>
                        <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Total Plot Area : </label><br>
                            <span ><b>Area : </b>{{json_decode($applicationDetail->total_plot_area)->total_plot_area." Sqmt"}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Total Covered Area : </label><br>
                            <span >
                            <b>Area : </b>{{json_decode($applicationDetail->total_covered_area)->total_covered_area." Sqmt"}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Ground Floor Covered : </label><br>
                            <span >
                            <b>Area : </b>{{json_decode($applicationDetail->ground_floor_covered)->ground_floor_covered." Sqmt"}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Max Height Building : </label><br>
                            <span >
                            <b>Height : </b>{{json_decode($applicationDetail->max_height_building)->max_height_building}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. Of Floor : </label><br>
                            <span >{{$applicationDetail->no_of_floor}}</span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Basement Covered Area : </label><br>
                            <span >
                            <b>Area : </b>{{json_decode($applicationDetail->basement_covered_area)->basement_covered_area." Sqmt"}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No Of Basement : </label><br>
                            <span >{{$applicationDetail->no_of_basement}}</span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No Of Blocks : </label><br>
                            <span >{{$applicationDetail->no_of_blocks}}</span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Height Of Tallest Block : </label><br>
                            <span >
                            <b>Height : </b>{{json_decode($applicationDetail->height_of_tallest_block)->height_of_tallest_block}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Min Distance Block : </label><br>
                            <span >
                            <b>Height : </b>{{json_decode($applicationDetail->min_distance_block)->min_distance_block}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Approach Road Width : </label><br>
                            <span >
                            <b>Width : </b>{{json_decode($applicationDetail->approach_road_width)->approach_road_width}}
                            </span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provision No Enterance : </label><br>
                            <span >{{$applicationDetail->provision_no_enterance}}</span >
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provision No Exit : </label><br>
                            <span >{{$applicationDetail->provision_no_exit}}</span >
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Set Back Detail : </label><br>
                            <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span><br>
                            <span>
                            <b style="margin-left:20px">Front Area : </b>{{json_decode($applicationDetail->set_back_detail)->front}}<br>
                            <b style="margin-left:20px">Rear Area : </b>{{json_decode($applicationDetail->set_back_detail)->rear}}<br>
                            <b style="margin-left:20px">Side 1 Area : </b>{{json_decode($applicationDetail->set_back_detail)->side1}}<br>
                            <b style="margin-left:20px">Side 2 Area : </b>{{json_decode($applicationDetail->set_back_detail)->side2}}<br>
                            </span >
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white  p-5" id="v-pills-provison" role="tabpanel" aria-labelledby="v-pills-provison-tab">
                        <h4 class="font-italic mb-4">Essential Provision Detail</h4>
                        <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Compartmentation :</label><br><span>{{json_decode($applicationDetail->ess_provision_detail)->compartmentation}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">No. Of Stairs : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->no_of_stairs}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Minimum Minimum Width of Stairs : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->width_of_stairs}} </span>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Emergency Exit : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->emergency_exit}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provision Of Lift : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->provision_of_lift}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Electric Suppy : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->electric_suppy}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Emergency Lighting System : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->emergency_lighting_system}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Provision Of Smoke : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->provision_of_smoke}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Emergency Lighting System : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->emergency_lighting_system}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Refuse Area : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->refuse_area}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Travel Distance : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->travel_distance}} </span>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="form-label">Other Comment : </label><br>
                            <span>{{json_decode($applicationDetail->ess_provision_detail)->other_comment}} </span>
                        </div>
                        </div>
                    </div>
                    <div class="tab-pane fade shadow rounded bg-white  p-5" id="v-pills-attachment" role="tabpanel" aria-labelledby="v-pills-attachment-tab">
                        <h4 class="font-italic mb-4">Attachments</h4>
                        <div class="row">
                        <div class="col-md-12">
                            <span >
                            @if(isset(json_decode($applicationDetail->attachments)->reference_letter))
                            <b>Reference Letter : </b><a href="{{ asset(json_decode($applicationDetail->attachments)->reference_letter)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            @if(isset(json_decode($applicationDetail->attachments)->proposed_map))
                            <b>Propossed Map : </b><a href="{{ asset(json_decode($applicationDetail->attachments)->proposed_map)}}" target="blank" title="View Propossed Map"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            @if(isset(json_decode($applicationDetail->attachments)->fire_plan))
                            <b>Fire Plan : </b><a href="{{ asset(json_decode($applicationDetail->attachments)->fire_plan)}}" target="blank" title="View Fire Plan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a><br>
                            @endif
                            </span>
                        </div>
                        </div>
                        <h4 class="font-italic">Payment Challan</h4>
                        <div class="row">
                        <div class="col-md-12">
                            <span >
                            @if($applicationDetail->challan !='')
                            <b>Payment Challan : </b><a href="{{ asset($applicationDetail->challan)}}" target="blank" title="View Payment Challan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            </span>
                        </div>
                        </div>
                        <br>

                    </div>
                    <div class="tab-pane fade shadow rounded bg-white" id="v-pills-pro" role="tabpanel" aria-labelledby="v-pills-pro-tab" style="padding-right:3rem; padding-left: 3rem;">
                        <!-- nav options -->
                        <ul class="nav nav-pills mb-5 shadow-sm" id="pills-tab" role="tablist" style="padding:10px">
                        <li class="nav-item"> <a class="nav-link active" id="pills-physical-tab" data-toggle="pill" href="#pills-physical" role="tab" aria-controls="pills-physical" aria-selected="true">Physical Inspection</a> </li>
                        <li class="nav-item"> <a class="nav-link" id="pills-fire-fight-tab" data-toggle="pill" href="#pills-fire-fight" role="tab" aria-controls="pills-fire-fight" aria-selected="false">Fire Fighting Provision</a> </li>
                        <li class="nav-item"> <a class="nav-link" id="pills-building-tab" data-toggle="pill" href="#pills-building" role="tab" aria-controls="pills-building" aria-selected="false">Building Status</a> </li>
                        <li class="nav-item"> <a class="nav-link" id="pills-special-tab" data-toggle="pill" href="#pills-special" role="tab" aria-controls="pills-special" aria-selected="false">Special Provision</a> </li>
                        </ul>
                        <!-- content -->
                        <div class="tab-content" id="pills-tabContent p-3">
                        <!-- 1st card -->
                        <div class="tab-pane fade show active" id="pills-physical" role="tabpanel" aria-labelledby="pills-physical-tab">
                            <form  method="POST" enctype="multipart/form-data" action="{{route('fso.addPhysicalInsPost')}}" id="form_physical">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Does any high tension electric line passing over the site? <span class="span_required">*</span></label>
                                        @if(Auth::user()->type == 2)
                                        <input type="text"  name="line" value="{{ json_decode($applicationDetail->physical_ins)->line ?? ''}}" class="form-control">
                                        @else
                                        <div class="radio-toolbar">
                                            <input type="radio" id="lineYes" name="line" value="yes" checked class="rb">
                                            <label for="yes" class="rb">Yes</label>
                                            <input type="radio" id="lineNo" name="line" value="no" class="rb">
                                            <label for="no" class="rb">No</label>
                                        </div>
                                        @if($errors->has('line'))
                                        <div class="validation-error">{{ $errors->first('line') }}</div>
                                        @endif
                                        @endif
                                    </div>
                                    </div>
                                    <input type="hidden" name="application_no"  value="{{ $applicationDetail->application_no }}" >
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">if yes. is it situated on proper safety distance? <span class="span_required">*</span></label>
                                        @if(Auth::user()->type == 2)
                                        <input type="text" id="line_status_yes" name="line_status" value="{{ json_decode($applicationDetail->physical_ins)->line_status ?? ''}}" class="form-control">
                                        @else
                                        <div class="radio-toolbar">
                                            <input type="radio" id="line_status_yes" name="line_status" value="yes" checked class="rb">
                                            <label for="yes" class="rb">Yes</label>
                                            <input type="radio" id="line_status_no" name="line_status" value="no" class="rb">
                                            <label for="no" class="rb">No</label>
                                        </div>
                                        @if($errors->has('line_status'))
                                        <div class="validation-error">{{ $errors->first('line_status') }}</div>
                                        @endif
                                        @endif
                                    </div>
                                    </div>
                                    <hr class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Does fire fighting vehicle approach to the site? <span class="span_required">*</span></label>
                                        @if(Auth::user()->type == 2)
                                        <input type="text"  name="vehicle_approach" value="{{ json_decode($applicationDetail->physical_ins)->vehicle_approach ?? ''}}" class="form-control">
                                        @else
                                        <div class="radio-toolbar">
                                            <input type="radio" id="vehicle_approach_yes" name="vehicle_approach" value="yes" checked class="rb">
                                            <label for="yes" class="rb">Yes</label>
                                            <input type="radio" id="vehicle_approach_no" name="vehicle_approach" value="no" class="rb">
                                            <label for="no" class="rb">No</label>
                                        </div>
                                        @if($errors->has('vehicle_approach'))
                                        <div class="validation-error">{{ $errors->first('vehicle_approach') }}</div>
                                        @endif
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Does any high inflammable installation situated nearby the building? <span class="span_required">*</span></label>
                                        @if(Auth::user()->type == 2)
                                        <input type="text"  name="inflammable" value="{{ json_decode($applicationDetail->physical_ins)->inflammable ?? ''}}" class="form-control">
                                        @else
                                        <div class="radio-toolbar">
                                            <input type="radio" id="inflammable_yes" name="inflammable" value="yes" checked class="rb">
                                            <label for="yes" class="rb">Yes</label>
                                            <input type="radio" id="inflammable_no" name="inflammable" value="no" class="rb">
                                            <label for="no" class="rb">No</label>
                                        </div>
                                        @if($errors->has('inflammable'))
                                        <div class="validation-error">{{ $errors->first('inflammable') }}</div>
                                        @endif
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-10 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Other <span class="span_required">*</span></label>
                                        <input type="textarea" class="form-control" id="other" name="other" placeholder="Other" value="{{ json_decode($applicationDetail->physical_ins)->other ?? ''}}" required rows="3">
                                        @if($errors->has('Other'))
                                        <div class="validation-error">{{ $errors->first('Other') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-10 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Specific Requirement <span class="span_required">*</span></label>
                                        <input type="textarea" class="form-control" id="specific" name="specific" placeholder="Specific Requirement" value="{{ json_decode($applicationDetail->physical_ins)->specific ?? ''}}" required rows="3">
                                        @if($errors->has('specific'))
                                        <div class="validation-error">{{ $errors->first('specific') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                @if(Auth::user()->id == $applicationDetail->assigned_id)
                                <div class="pl-lg-4 text-right ">
                                    <button class="save-btn hover-btn btn btn-primary mb-3" type="submit">Save</button>
                                </div>
                                @endif
                            </form>
                        </div>
                        <!-- 2nd card -->
                        <div class="tab-pane fade" id="pills-fire-fight" role="tabpanel" aria-labelledby="pills-fire-fight-tab">
                            <form  method="POST" enctype="multipart/form-data" action="{{route('fso.addFireProvissionPost')}}" id="form_provission">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Under-ground Static water Storage Tank  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="under_ground" name="under_ground" placeholder="Under-ground Static water Storage Tank" value="{{ json_decode($applicationDetail->fire_provission)->under_ground ?? ''}}" required rows="3">
                                        @if($errors->has('under_ground'))
                                        <div class="validation-error">{{ $errors->first('under_ground') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <input type="hidden" name="application_no"  value="{{ $applicationDetail->application_no }}" >
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Pump near underground static water Storage Tank (fire pump with minimum Pressure of 3.5 kg/cm² at Remotest Location) <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="under_ground_tank" name="under_ground_tank" placeholder="Pump near underground static water Storage Tank" value="{{ json_decode($applicationDetail->fire_provission)->under_ground_tank ?? ''}}" required rows="3">
                                        @if($errors->has('under_ground_tank'))
                                        <div class="validation-error">{{ $errors->first('under_ground_tank') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Yard  Hydrant <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="yard_hydrant" name="yard_hydrant" placeholder="Yard  Hydrant" value="{{ json_decode($applicationDetail->fire_provission)->yard_hydrant ?? ''}}" required rows="3">
                                        @if($errors->has('yard_hydrant'))
                                        <div class="validation-error">{{ $errors->first('yard_hydrant') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Fire cabin <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fire_cabin" name="fire_cabin" placeholder="Fire Cabin" value="{{ json_decode($applicationDetail->fire_provission)->fire_cabin ?? ''}}" required rows="3">
                                        @if($errors->has('fire_cabin'))
                                        <div class="validation-error">{{ $errors->first('fire_cabin') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Wet Riser <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="wet_riser" name="wet_riser" placeholder="Wet Riser" value="{{ json_decode($applicationDetail->fire_provission)->wet_riser ?? ''}}" required rows="3">
                                        @if($errors->has('wet_riser'))
                                        <div class="validation-error">{{ $errors->first('wet_riser') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Terrace Tank Respective Tower Terrace <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="terrace_tank" name="terrace_tank" placeholder="Terrace Tank Respective Tower Terrace" value="{{ json_decode($applicationDetail->fire_provission)->terrace_tank ?? ''}}" required rows="3">
                                        @if($errors->has('terrace_tank'))
                                        <div class="validation-error">{{ $errors->first('terrace_tank') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Terrace pump <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="terrace_pump" name="terrace_pump" placeholder="Terrace pump" value="{{ json_decode($applicationDetail->fire_provission)->terrace_pump ?? ''}}" required rows="3">
                                        @if($errors->has('terrace_pump'))
                                        <div class="validation-error">{{ $errors->first('terrace_pump') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Down Comer <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="down_comer" name="down_comer" placeholder="Down Comer" value="{{ json_decode($applicationDetail->fire_provission)->down_comer ?? ''}}" required rows="3">
                                        @if($errors->has('down_comer'))
                                        <div class="validation-error">{{ $errors->first('down_comer') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">First Aid Hose Real <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="first_aid" name="first_aid" placeholder="First Aid Hose Real" value="{{ json_decode($applicationDetail->fire_provission)->first_aid ?? ''}}" required rows="3">
                                        @if($errors->has('first_aid'))
                                        <div class="validation-error">{{ $errors->first('first_aid') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Landing valve <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="landing_valve" name="landing_valve" placeholder="Landing valve" value="{{ json_decode($applicationDetail->fire_provission)->landing_valve ?? ''}}" required rows="3">
                                        @if($errors->has('landing_valve'))
                                        <div class="validation-error">{{ $errors->first('landing_valve') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Manually Operated Electronic Fire Alarm System <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="manual_alarm" name="manual_alarm" placeholder="Manually Operated Electronic Fire Alarm System" value="{{ json_decode($applicationDetail->fire_provission)->manual_alarm ?? ''}}" required rows="3">
                                        @if($errors->has('manual_alarm'))
                                        <div class="validation-error">{{ $errors->first('manual_alarm') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Automatic Detection and Alarm System <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="automatic_alarm" name="automatic_alarm" placeholder="Automatic Detection and Alarm System" value="{{ json_decode($applicationDetail->fire_provission)->automatic_alarm ?? ''}}" required rows="3">
                                        @if($errors->has('automatic_alarm'))
                                        <div class="validation-error">{{ $errors->first('automatic_alarm') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Automatic Sprinkler System <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="automatic_sprinkler" name="automatic_sprinkler" placeholder="Automatic Sprinkler System" value="{{ json_decode($applicationDetail->fire_provission)->automatic_sprinkler ?? ''}}" required rows="3">
                                        @if($errors->has('automatic_sprinkler'))
                                        <div class="validation-error">{{ $errors->first('automatic_sprinkler') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Fire Extinguisher  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fire_extinguisher" name="fire_extinguisher" placeholder="Fire Extinguisher " value="{{ json_decode($applicationDetail->fire_provission)->fire_extinguisher ?? ''}}" required rows="3">
                                        @if($errors->has('fire_extinguisher'))
                                        <div class="validation-error">{{ $errors->first('fire_extinguisher') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                @if(Auth::user()->id == $applicationDetail->assigned_id)
                                <div class="pl-lg-4 text-right " >
                                    <button class="save-btn hover-btn btn btn-primary mb-3" type="submit">Save</button>
                                </div>
                                @endif
                            </form>
                        </div>
                        <!-- 3nd card -->
                        <div class="tab-pane fade third" id="pills-building" role="tabpanel" aria-labelledby="pills-building-tab">
                            <form  method="POST" enctype="multipart/form-data" action="{{route('fso.addBuildingStatusPost')}}" id="form_building">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Set Back  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="set_back" name="set_back" placeholder="Set Back" value="{{ json_decode($applicationDetail->building_status)->set_back ?? ''}}" required rows="3">
                                        @if($errors->has('set_back'))
                                        <div class="validation-error">{{ $errors->first('set_back') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <input type="hidden" name="application_no"  value="{{ $applicationDetail->application_no }}" >
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Compartmentation  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="compartmentation" name="compartmentation" placeholder="Compartmentation " value="{{ json_decode($applicationDetail->building_status)->compartmentation ?? ''}}" required rows="3">
                                        @if($errors->has('compartmentation'))
                                        <div class="validation-error">{{ $errors->first('compartmentation') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Minimum Width of Stairs <span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="stair_width" name="stair_width" placeholder="Minimum Width of Stairs" value="{{ json_decode($applicationDetail->building_status)->stair_width ?? ''}}" required rows="3">
                                        @if($errors->has('stair_width'))
                                        <div class="validation-error">{{ $errors->first('stair_width') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Fire cabin <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fire_cabin" name="fire_cabin" placeholder="Fire Cabin" value="{{ json_decode($applicationDetail->building_status)->fire_cabin ?? ''}}" required rows="3">
                                        @if($errors->has('fire_cabin'))
                                        <div class="validation-error">{{ $errors->first('fire_cabin') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">No. of Stairs in Each Block <span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="stair_in_block" name="stair_in_block" placeholder="No. of Stairs in Each Block" value="{{ json_decode($applicationDetail->building_status)->stair_in_block ?? ''}}" required rows="3">
                                        @if($errors->has('stair_in_block'))
                                        <div class="validation-error">{{ $errors->first('stair_in_block') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Emergency Exit <span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="emergency_exit" name="emergency_exit" placeholder="Emergency Exit" value="{{ json_decode($applicationDetail->building_status)->emergency_exit ?? ''}}" required rows="3">
                                        @if($errors->has('emergency_exit'))
                                        <div class="validation-error">{{ $errors->first('emergency_exit') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Fireman switch in lift <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fire_switch" name="fire_switch" placeholder="Fireman switch in lift" value="{{ json_decode($applicationDetail->building_status)->fire_switch ?? ''}}" required rows="3">
                                        @if($errors->has('fire_switch'))
                                        <div class="validation-error">{{ $errors->first('fire_switch') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Alternative Electric Supply <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="alt_electric" name="alt_electric" placeholder="Alternative Electric Supply" value="{{ json_decode($applicationDetail->building_status)->alt_electric ?? ''}}" required rows="3">
                                        @if($errors->has('alt_electric'))
                                        <div class="validation-error">{{ $errors->first('alt_electric') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Emergency lighting system  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="emergency_light" name="emergency_light" placeholder="Emergency lighting system " value="{{ json_decode($applicationDetail->building_status)->emergency_light ?? ''}}" required rows="3">
                                        @if($errors->has('emergency_light'))
                                        <div class="validation-error">{{ $errors->first('emergency_light') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Fluorescent exit sign <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fluorescent_exit" name="fluorescent_exit" placeholder="Fluorescent exit sign" value="{{ json_decode($applicationDetail->building_status)->fluorescent_exit ?? ''}}" required rows="3">
                                        @if($errors->has('fluorescent_exit'))
                                        <div class="validation-error">{{ $errors->first('fluorescent_exit') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Provision of Smoke/Fire check Doors <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="pro_smoke" name="pro_smoke" placeholder="Provision of Smoke/Fire check Doors" value="{{ json_decode($applicationDetail->building_status)->pro_smoke ?? ''}}" required rows="3">
                                        @if($errors->has('pro_smoke'))
                                        <div class="validation-error">{{ $errors->first('pro_smoke') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Refuse area in case of high rise buildings <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="refuse_area" name="refuse_area" placeholder="Refuse area in case of high rise buildings" value="{{ json_decode($applicationDetail->building_status)->refuse_area ?? ''}}" required rows="3">
                                        @if($errors->has('refuse_area'))
                                        <div class="validation-error">{{ $errors->first('refuse_area') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Maximum Travel Distance in Building  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="max_travel" name="max_travel" placeholder="Maximum Travel Distance in Building " value="{{ json_decode($applicationDetail->building_status)->max_travel ?? ''}}" required rows="3">
                                        @if($errors->has('max_travel'))
                                        <div class="validation-error">{{ $errors->first('max_travel') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Electric Installation(ELCB,MCB)  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="elec_install" name="elec_install" placeholder="Fire Extinguisher " value="{{ json_decode($applicationDetail->building_status)->elec_install ?? ''}}" required rows="3">
                                        @if($errors->has('elec_install'))
                                        <div class="validation-error">{{ $errors->first('elec_install') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                @if(Auth::user()->id == $applicationDetail->assigned_id)
                                <div class="pl-lg-4 text-right ">
                                    <button class="save-btn hover-btn btn btn-primary mb-3" type="submit">Save</button>
                                </div>
                                @endif
                            </form>
                        </div>
                        <!-- 4th card -->
                        <div class="tab-pane fade third" id="pills-special" role="tabpanel" aria-labelledby="pills-special-tab">
                            <form  method="POST" enctype="multipart/form-data" action="{{route('fso.addSpecialProvissionPost')}}" id="form_special">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Smoke Extraction System  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="smoke_extraction" name="smoke_extraction" placeholder="Smoke Extraction System" value="{{ json_decode($applicationDetail->special_provission)->smoke_extraction ?? ''}}" required rows="3">
                                        @if($errors->has('smoke_extraction'))
                                        <div class="validation-error">{{ $errors->first('smoke_extraction') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <input type="hidden" name="application_no"  value="{{ $applicationDetail->application_no }}" >
                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Fresh Air Induction System  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fresh_air" name="fresh_air" placeholder="Fresh Air Induction System " value="{{ json_decode($applicationDetail->special_provission)->fresh_air ?? ''}}" required rows="3">
                                        @if($errors->has('fresh_air'))
                                        <div class="validation-error">{{ $errors->first('fresh_air') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Response Indicator <span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="response_indicator" name="response_indicator" placeholder="Response Indicator" value="{{ json_decode($applicationDetail->special_provission)->response_indicator ?? ''}}" required rows="3">
                                        @if($errors->has('response_indicator'))
                                        <div class="validation-error">{{ $errors->first('response_indicator') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="">Water Spray System <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="water_spray" name="water_spray" placeholder="Water spray system" value="{{ json_decode($applicationDetail->special_provission)->water_spray ?? ''}}" required rows="3">
                                        @if($errors->has('water_spray'))
                                        <div class="validation-error">{{ $errors->first('water_spray') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Foam Spray System <span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="foam_spray" name="foam_spray" placeholder="No. of Foam Spray System" value="{{ json_decode($applicationDetail->special_provission)->foam_spray ?? ''}}" required rows="3">
                                        @if($errors->has('foam_spray'))
                                        <div class="validation-error">{{ $errors->first('foam_spray') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Gas type flooding system <span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="flooding_system" name="flooding_system" placeholder="Gas type flooding system" value="{{ json_decode($applicationDetail->special_provission)->flooding_system ?? ''}}" required rows="3">
                                        @if($errors->has('flooding_system'))
                                        <div class="validation-error">{{ $errors->first('flooding_system') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Fireman switch in lift <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fire_switch_lift" name="fire_switch_lift" placeholder="Fireman switch in lift" value="{{ json_decode($applicationDetail->special_provission)->fire_switch_lift ?? ''}}" required rows="3">
                                        @if($errors->has('fire_switch_lift'))
                                        <div class="validation-error">{{ $errors->first('fire_switch_lift') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Fire Cart Room <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fire_cart" name="fire_cart" placeholder="Fire Cart Room" value="{{ json_decode($applicationDetail->special_provission)->fire_cart ?? ''}}" required rows="3">
                                        @if($errors->has('fire_cart'))
                                        <div class="validation-error">{{ $errors->first('fire_cart') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Beam Detector  <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="beam_detector" name="beam_detector" placeholder="Beam Detector" value="{{ json_decode($applicationDetail->special_provission)->beam_detector ?? ''}}" required rows="3">
                                        @if($errors->has('beam_detector'))
                                        <div class="validation-error">{{ $errors->first('beam_detector') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Gas Detector <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="gas_detector" name="gas_detector" placeholder="Gas Detector" value="{{ json_decode($applicationDetail->special_provission)->gas_detector ?? ''}}" required rows="3">
                                        @if($errors->has('gas_detector'))
                                        <div class="validation-error">{{ $errors->first('gas_detector') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Fire Bucket <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="fire_bucket" name="fire_bucket" placeholder="Fire Bucket" value="{{ json_decode($applicationDetail->special_provission)->fire_bucket ?? ''}}" required rows="3">
                                        @if($errors->has('fire_bucket'))
                                        <div class="validation-error">{{ $errors->first('fire_bucket') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Emergency No <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="emergency_no" name="emergency_no" placeholder="Emergency No" value="{{ json_decode($applicationDetail->special_provission)->emergency_no ?? ''}}" required rows="3">
                                        @if($errors->has('emergency_no'))
                                        <div class="validation-error">{{ $errors->first('emergency_no') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Fire Safety Trained Staff   <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="trained_staff" name="trained_staff" placeholder="Fire Safety Trained Staff" value="{{ json_decode($applicationDetail->special_provission)->trained_staff ?? ''}}" required rows="3">
                                        @if($errors->has('trained_staff'))
                                        <div class="validation-error">{{ $errors->first('trained_staff') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Other Comment   <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="other_comment" name="other_comment" placeholder="Other Comment  " value="{{ json_decode($applicationDetail->special_provission)->other_comment ?? ''}}" required rows="3">
                                        @if($errors->has('other_comment'))
                                        <div class="validation-error">{{ $errors->first('other_comment') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                </div>
                                @if(Auth::user()->id == $applicationDetail->assigned_id)
                                <div class="pl-lg-4 text-right ">
                                    <button class="save-btn hover-btn btn btn-primary mb-3" type="submit">Save</button>
                                </div>
                                @endif
                            </form>
                        </div>
                        </div>
                    </div>

                    <div class="tab-pane fade shadow rounded bg-white show active" id="v-pills-operational" role="tabpanel" aria-labelledby="v-pills-operational-tab" style="padding-right:3rem; padding-left: 3rem;">
                        <h4 class="font-italic mb-4" style="text-align:center;padding-top:50px;">Edir Pre operational NOC</h4>
                        <div class="tab-content" id="pills-tabContent p-3">
                        <!-- 1st card -->
                        <div class="tab-pane fade show active" id="pills-vendor" role="tabpanel" aria-labelledby="pills-vendor-tab">
                            <form  method="POST" enctype="multipart/form-data" action="{{route('noc.pre.operational.update.post')}}" id="form_vendor">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="application_id" value="{{$applicationDetail->operational_applications->id}}">

                                    <input type="hidden" name="application_no" value="{{$applicationDetail->operational_applications->application_no}}">

                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Name of Fire Vendor <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Name of Fire Vendor" value="{{json_decode($applicationDetail->operational_applications->vendor)->vendor_name ?? ''}}" required>
                                    </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Name Of Firm</label>
                                        <input type="text" class="form-control" id="vendor_firm_name" name="vendor_firm_name" placeholder="Name Of Firm" value="{{json_decode($applicationDetail->operational_applications->vendor)->vendor_firm_name ?? ''}}" required>
                                    </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Mobile No.<span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="vendor_number" name="vendor_number" placeholder="Mobile No." value="{{json_decode($applicationDetail->operational_applications->vendor)->vendor_number ?? ''}}" required>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4 col-sm-10 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" >GST/PAN/TAN</label>
                                        @if(isset(json_decode($applicationDetail->operational_applications->vendor)->vendor_gst_pan_tan))
                                        @php
                                        $vendor_gst_pan_tan = json_decode($applicationDetail->operational_applications->vendor)->vendor_gst_pan_tan;
                                        @endphp
                                        @else
                                        @php $vendor_gst_pan_tan = ''; @endphp
                                        @endif
                                        <div class="radio-toolbar">
                                            <input type="radio" id="vendor_gst" name="vendor_gst_pan_tan" value="gst" @if($vendor_gst_pan_tan== 'gst') checked @endif style="height: auto;">
                                            <label for="vendor_gst">GST</label>
                                            <input type="radio" id="vendor_pan" name="vendor_gst_pan_tan" value="pan" @if($vendor_gst_pan_tan== 'pan') checked @endif style="height: auto;">
                                            <label for="vendor_pan">PAN</label>
                                            <input type="radio" id="vendor_tan" name="vendor_gst_pan_tan" value="tan" @if($vendor_gst_pan_tan== 'tan') checked @endif style="height: auto;">
                                            <label for="vendor_tan">TAN</label>
                                        </div>
                                        @if($errors->has('vendor_gst_pan_tan'))
                                        <div class="validation-error">{{ $errors->first('vendor_gst_pan_tan') }}</div>
                                        @endif
                                    </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">GST/PAN/TAN No.</label>
                                        <input type="text" class="form-control" id="vendor_gst_pan_tan_no" name="vendor_gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="{{json_decode($applicationDetail->operational_applications->vendor)->vendor_gst_pan_tan_no ?? ''}}" required>
                                    </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Email<span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="vendor_email" name="vendor_email" placeholder="Email" value="{{json_decode($applicationDetail->operational_applications->vendor)->vendor_email ?? ''}}" required>
                                    </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Reference Letter from Competent Authority<span class="span_required">*</span></label>
                                        <input type="file" class="form-control" id="reference_letter" name="reference_letter" style="height: 36px;">
                                        @if($errors->has('reference_letter'))
                                        <div class="validation-error">{{ $errors->first('reference_letter') }}</div>
                                        @endif
                                        <input type="hidden" name="reference_letter_old" value="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->reference_letter)}}">
                                    </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                    @if(isset($applicationDetail->operational_applications->attachment))
                                    @if(isset(json_decode($applicationDetail->operational_applications->attachment)->reference_letter))
                                    <a href="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->reference_letter)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                                    @endif
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Approved Map<span class="span_required">*</span></label>
                                        <input type="file" class="form-control" id="approved_map" name="approved_map" style="height: 36px;">
                                        @if($errors->has('approved_map'))
                                        <div class="validation-error">{{ $errors->first('approved_map') }}</div>
                                        @endif
                                        <input type="hidden" name="approved_map_old" value="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->approved_map)}}">
                                    </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                    @if(isset($applicationDetail->operational_applications->attachment))
                                    @if(isset(json_decode($applicationDetail->operational_applications->attachment)->approved_map))
                                    <a href="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->approved_map)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                                    @endif
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Est Noc<span class="span_required">*</span></label>
                                        <input type="file" class="form-control" id="est_noc" name="est_noc" style="height: 36px;">
                                        @if($errors->has('est_noc'))
                                        <div class="validation-error">{{ $errors->first('est_noc') }}</div>
                                        @endif
                                        <input type="hidden" name="est_noc_old" value="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->est_noc)}}">
                                    </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                    @if(isset($applicationDetail->operational_applications->attachment))
                                    @if(isset(json_decode($applicationDetail->operational_applications->attachment)->est_noc))
                                    <a href="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->est_noc)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                                    @endif
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Challan<span class="span_required">*</span></label>
                                        <input type="file" class="form-control" id="challan" name="challan" style="height: 36px;">
                                        @if($errors->has('challan'))
                                        <div class="validation-error">{{ $errors->first('challan') }}</div>
                                        @endif
                                        <input type="hidden" name="challan_old" value="{{ asset($applicationDetail->operational_applications->challan)}}">
                                    </div>
                                    </div>
                                    <div class="col-lg-4 mt-4">
                                    @if(isset($applicationDetail->operational_applications->challan))
                                    <a href="{{ asset($applicationDetail->operational_applications->challan)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                                    @endif
                                    </div>
                                </div>

                                <hr>
                                @if(isset($applicationDetail->operational_applications))
                                @if(json_decode($applicationDetail->operational_applications))
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-lg-12 text-right mt-3">
                                    <a href="{{route('noc')}}" class="btn btn-sm btn-neutral">Cancel</a>
                                    <button class="save-btn hover-btn btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                                @endif
                                @endif
                            </form>
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
@stop
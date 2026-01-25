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
                        @if(Auth::user()->type== 4 && $applicationDetail->status=='approved' && $applicationDetail->application_type == 'pre establishment noc' && !$applicationDetail->operational_applications)
                        <a class="nav-link mb-3  shadow @if ($applicationDetail->pre_perational ==1) active @endif" id="v-pills-operational-tab" data-toggle="pill" href="#v-pills-operational" role="tab" aria-controls="v-pills-operational" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Apply for Pre Operational NOC</span></a>
                        @endif
                        @if($applicationDetail->operational_applications)
                        <a class="nav-link mb-3  shadow" id="v-pills-vendor-tab" data-toggle="pill" href="#v-pills-vendor" role="tab" aria-controls="v-pills-vendor" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Fire Vendor Detail</span></a>
                        @if(Auth::user()->type== 4 && $applicationDetail->operational_applications->status=='approved')
                        <a class="nav-link mb-3 shadow active" id="v-pills-renewal-tab" data-toggle="pill" href="#v-pills-renewal" role="tab" aria-controls="v-pills-renewal" aria-selected="false">
                        <span class="font-weight-bold small text-uppercase">Edit Annual Clearance NOC </span></a>
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
                            <span >{{$applicationDetail->renewal_applications->application_no}}</span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Application Type : </label><br>
                            <span >{{ucwords($applicationDetail->renewal_applications->application_type)}}</span>
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
                                <b style="margin-left:20px">Person Appointed : </b>{{json_decode($applicationDetail->contact_person)->person_appointed}}
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
                            <span >
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
                            <label class="form-label">Minimum Width of Stairs : </label><br>
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
                    <h4 class="font-italic mb-4" style="text-align:center;text-decoration:underline;margin-top:30px;">Pre Established Attachments</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <span>
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
                    <br><h4 class="font-italic">Payment Challan</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <span >
                            @if($applicationDetail->challan !='')
                            <b>Payment Challan : </b><a href="{{ asset($applicationDetail->challan)}}" target="blank" title="View Payment Challan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            </span>
                        </div>
                    </div>

                    <h4 class="font-italic mb-4" style="text-align:center;text-decoration:underline;margin-top:30px;">Pre Operational Attachments</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <span>
                            @if(isset(json_decode($applicationDetail->operational_applications->attachment)->reference_letter))
                            <b>Reference Letter : </b><a href="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->reference_letter)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif

                            @if(isset(json_decode($applicationDetail->operational_applications->attachment)->approved_map))
                            <b>Approved Map : </b><a href="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->approved_map)}}" target="blank" title="View Propossed Map"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            
                            @if(isset(json_decode($applicationDetail->operational_applications->attachment)->est_noc))
                            <b>Est Noc : </b><a href="{{ asset(json_decode($applicationDetail->operational_applications->attachment)->est_noc)}}" target="blank" title="View Fire Plan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a><br>
                            @endif

                            <br>
                            <h4 class="font-italic">Payment Challan</h4>
                            @if(isset($applicationDetail->operational_applications->challan))
                            <b>Payment Challan : </b><a href="{{ asset($applicationDetail->operational_applications->challan)}}" target="blank" title="View Payment Challan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            </span>
                        </div>
                    </div>

                    <h4 class="font-italic mb-4" style="text-align:center;text-decoration:underline;margin-top:30px;">Pre Renewal Attachments</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <span>
                            @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->competent_authority))
                            <b>Letter from the concerned Competent Authority (D.M.) : </b><a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->competent_authority)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif

                            @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->po_noc))
                            <b>Pre-Operational NOC or previous year NOC : </b><a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->po_noc)}}" target="blank" title="View Fire Plan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a><br>
                            @endif

                            @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->hp_test_cetificate))
                            <b>Valid Hydro pressure test certificate : </b><a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->hp_test_cetificate)}}" target="blank" title="View Fire Plan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a><br>
                            @endif

                            @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->approved_map))
                            <b>Approved Map : </b><a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->approved_map)}}" target="blank" title="View Propossed Map"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            
                            <br><br>
                            <h4 class="font-italic">Payment Challan</h4>
                            @if(isset($applicationDetail->renewal_applications->challan))
                            <b>Payment Challan : </b><a href="{{ asset($applicationDetail->renewal_applications->challan)}}" target="blank" title="View Payment Challan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                            @endif
                            </span>
                        </div>
                    </div>

                        
                </div>
                <!--vendor detail-->
                <div class="tab-pane fade shadow rounded bg-white  p-5" id="v-pills-vendor" role="tabpanel" aria-labelledby="v-pills-vendor-tab">
                    <h4 class="font-italic mb-4">Vendor detail</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">Name of Fire Vendor :</label><br><span>{{json_decode($applicationDetail->operational_applications->vendor)->vendor_name ?? ''}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Name Of Firm : </label><br>
                            <span>{{json_decode($applicationDetail->operational_applications->vendor)->vendor_firm_name ?? ''}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mobile No. : </label><br>
                            <span>{{json_decode($applicationDetail->operational_applications->vendor)->vendor_number ?? ''}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">GST/PAN/TAN</label><br>
                            <span>{{ucfirst(json_decode($applicationDetail->operational_applications->vendor)->vendor_gst_pan_tan ?? '')}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">GST/PAN/TAN No. : </label><br>
                            <span>{{json_decode($applicationDetail->operational_applications->vendor)->vendor_gst_pan_tan_no ?? ''}} </span>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Email : </label><br>
                            <span>{{json_decode($applicationDetail->operational_applications->vendor)->vendor_email ?? ''}} </span>
                        </div>
                    </div>
                </div>

                <!-- Edit Renewal noc application-->
                <div class="tab-pane fade shadow rounded bg-white show active" id="v-pills-renewal" role="tabpanel" aria-labelledby="v-pills-renewal-tab" style="padding-right:3rem; padding-left: 3rem;">
                            <h4 class="font-italic mb-4" style="text-align:center;padding-top:50px;">Edit Renewal NOC</h4>
                            <div class="tab-content" id="pills-tabContent p-3">
                            <!-- 1st card -->
                            <div class="tab-pane fade show active" id="pills-vendor" role="tabpanel" aria-labelledby="pills-vendor-tab">
                                <form  method="POST" enctype="multipart/form-data" action="{{route('noc.renewal.update.post')}}" id="form_vendor">
                                    @csrf
                                    <div class="row">
                                        <input type="hidden" name="application_id" value="{{$applicationDetail->renewal_applications->id}}">
                                        <input type="hidden" name="application_no" value="{{$applicationDetail->renewal_applications->application_no}}">

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Letter from the concerned Competent Authority (D.M.)<span class="span_required">*</span></label>
                                            <input type="file" class="form-control" id="competent_authority" name="competent_authority" style="height: 36px;">
                                            @if($errors->has('competent_authority'))
                                            <div class="validation-error">{{ $errors->first('competent_authority') }}</div>
                                            @endif
                                            <input type="hidden" name="competent_authority_old" value="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->competent_authority)}}">
                                        </div>
                                        </div>
                                        <div class="col-lg-4 mt-4">
                                        @if(isset($applicationDetail->renewal_applications->attachment))
                                        @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->competent_authority))
                                        <a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->competent_authority)}}" target="blank" title="View Letter from the concerned Competent  Authority"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                                        @endif
                                        @endif
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Pre-Operational NOC or previous year NOC.<span class="span_required">*</span></label>
                                            <input type="file" class="form-control" id="po_noc" name="po_noc" style="height: 36px;">
                                            @if($errors->has('po_noc'))
                                            <div class="validation-error">{{ $errors->first('po_noc') }}</div>
                                            @endif
                                            <input type="hidden" name="po_noc_old" value="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->po_noc)}}">
                                        </div>
                                        </div>
                                        <div class="col-lg-4 mt-4">
                                        @if(isset($applicationDetail->renewal_applications->attachment))
                                        @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->po_noc))
                                        <a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->po_noc)}}" target="blank" title="View Pre-Operational NOC or previous year NOC"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                                        @endif
                                        @endif
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Valid Hydro pressure test certificate.<span class="span_required">*</span></label>
                                            <input type="file" class="form-control" id="hp_test_cetificate" name="hp_test_cetificate" style="height: 36px;">
                                            @if($errors->has('hp_test_cetificate'))
                                            <div class="validation-error">{{ $errors->first('hp_test_cetificate') }}</div>
                                            @endif
                                            <input type="hidden" name="hp_test_cetificate_old" value="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->hp_test_cetificate)}}">
                                        </div>
                                        </div>
                                        <div class="col-lg-4 mt-4">
                                        @if(isset($applicationDetail->renewal_applications->attachment))
                                        @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->hp_test_cetificate))
                                        <a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->po_noc)}}" target="blank" title="View Valid Hydro pressure test certificate"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
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
                                            <input type="hidden" name="approved_map_old" value="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->approved_map)}}">
                                        </div>
                                        </div>
                                        <div class="col-lg-4 mt-4">
                                        @if(isset($applicationDetail->renewal_applications->attachment))
                                        @if(isset(json_decode($applicationDetail->renewal_applications->attachment)->approved_map))
                                        <a href="{{ asset(json_decode($applicationDetail->renewal_applications->attachment)->approved_map)}}" target="blank" title="View Approved Map"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
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
                                            <input type="hidden" name="challan_old" value="{{ asset($applicationDetail->renewal_applications->challan)}}">
                                        </div>
                                        </div>
                                        <div class="col-lg-4 mt-4">
                                        @if(isset($applicationDetail->renewal_applications->challan))
                                        <a href="{{ asset($applicationDetail->renewal_applications->challan)}}" target="blank" title="View Challan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                                        @endif
                                        </div>
                                    </div>

                                    <hr>
                                    @if(isset($applicationDetail->renewal_applications))
                                    @if(json_decode($applicationDetail->renewal_applications))
                                    <div class="row">
                                        <div class="col-lg-12 text-right mt-3" style="padding-bottom:20px;">
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
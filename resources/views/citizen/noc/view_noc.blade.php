@extends('layouts.citizen.template')
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
		<h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">NOC Details!</h5>
	</div>
</div>
<!-- End Row -->


<div class="card custom-card" id="hori">
	<div class="card-body">
		<div class="text-wrap">
			@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			@if (session('success'))
			<div class="alert alert-success">
				{{ session('success') }}
			</div>
			@endif
			@if (session('failed'))
			<div class="alert alert-danger">
				{{ session('failed') }}
			</div>
			@endif
			<br>
			<div class="example">
				<nav class="nav nav-style-1 nav-pills mb-3" role="tablist">
					<a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page" href="#nav-products" aria-selected="true">BASIC DETAILS</a>
					<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-cart" aria-selected="false" tabindex="-1">BUILDING ADDRESS</a>
					<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-orders" aria-selected="false" tabindex="-1">PROPRIETARY DETAILS</a>
					<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-offers" aria-selected="false" tabindex="-1">AREA & SET BACK DETAILS</a>
					<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-Essential" aria-selected="false" tabindex="-1">ESSENTIAL PROVISION DETAIL</a>
					<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-Attachments" aria-selected="false" tabindex="-1">ATTACHMENTS</a>
					@if(Auth::user()->type== 4 && $applicationDetail[0]->status=='approved' && $applicationDetail[0]->application_type == 'pre establishment noc' && empty($operational_application))
               		<a class="nav-link" data-bs-toggle="tab" role="tab" href="#nav-operational" aria-selected="false" tabindex="-1">Apply for Pre Operational NOC</a>
               		@endif
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
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Application No. : </label><br>
								<span>{{$applicationDetail[0]->application_no}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Application Type : </label><br>
								<span>{{ucwords($applicationDetail[0]->application_type)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Building Name : </label><br>
								<span>{{ucwords($applicationDetail[0]->building_name)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Building Category : </label><br>
								<span>
									@foreach($categories as $row => $cat)
									@if($cat->id == $applicationDetail[0]->category_id)
									{{ucwords($cat->name)}}
									@endif
									@endforeach
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Building Sub Category : </label><br>
								<span>
									@foreach($sub_categories as $row => $sub)
									@if($sub->id == $applicationDetail[0]->subcategory_id)
									{{ucwords($sub->name)}}
									@endif
									@endforeach
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Type Of Industry : </label><br>
								<span>
									@foreach($types as $row => $typ)
									@if($typ->id == $applicationDetail[0]->type_id)
									{{ucwords($typ->name)}}
									@endif
									@endforeach
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Building Ownership : </label><br>
								<span>{{ucwords($applicationDetail[0]->building_ownership)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">GST Pan Tan : </label><br>
								<span>{{ucfirst($applicationDetail[0]->gst_pan_tan)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">GST Pan Tan No. : </label><br>
								<span>{{$applicationDetail[0]->gst_pan_tan_no}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Project Status : </label><br>
								<span>{{ucfirst($applicationDetail[0]->project_status)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Latitude : </label><br>
								<span>{{$applicationDetail[0]->latitude}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Longitude : </label><br>
								<span>{{$applicationDetail[0]->longitude}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Email :</label><br>
								<span>{{$applicationDetail[0]->email}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Mobile No : .</label><br>
								<span>{{$applicationDetail[0]->mobile_no}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Office Telephone : </label><br>
								<span>{{$applicationDetail[0]->office_telephone}}</span>
							</div>
						</div>
					</div>
					<div class="tab-pane text-muted" id="nav-cart" role="tabpanel">
						<h5>
							Building Address
						</h5>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">District : </label><br>
								<span>
									@foreach($district as $row => $dist)
									@if($dist->id == $applicationDetail[0]->district_id)
									{{ucwords($dist->name)}}
									@endif
									@endforeach
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Rural / Urban : </label><br>
								<span>{{ucfirst($applicationDetail[0]->rural_urban)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Block : </label><br>
								<span>
									@foreach($block as $row => $blk)
									@if($blk->id == $applicationDetail[0]->block_id)
									{{ucwords($blk->name)}}
									@endif
									@endforeach
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Panchayat : </label><br>
								<span>
									@foreach($panchayat as $row => $pnt)
									@if($pnt->id == $applicationDetail[0]->panchayat_id)
									{{ucwords($pnt->name)}}
									@endif
									@endforeach
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Tehsil : </label><br>
								<span>
									@foreach($tehsil as $row => $thl)
									@if($thl->id == $applicationDetail[0]->tehsil_id)
									{{ucwords($thl->name)}}
									@endif
									@endforeach
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Plot / Khasra / Khatauni :</label><br>
								<span>{{ucfirst($applicationDetail[0]->plot_khasra_khatauni)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Plot Khasra Khatauni No.:</label><br>
								<span>{{$applicationDetail[0]->plot_khasra_khatauni_no}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Street :</label><br>
								<span>{{ucfirst($applicationDetail[0]->street)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Village : </label><br>
								<span>{{ucfirst($applicationDetail[0]->village)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">City :</label><br>
								<span>{{ucfirst($applicationDetail[0]->city)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Landmark : </label><br>
								<span>{{ucfirst($applicationDetail[0]->landmark)}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Pincode : </label><br>
								<span>{{ucfirst($applicationDetail[0]->pincode)}}</span>
							</div>
						</div>
					</div>
					<div class="tab-pane text-muted" id="nav-orders" role="tabpanel">
						<h5>
							Proprietary Details
						</h5>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Proprietary Rights :</label><br>
								<span>{{ucfirst($applicationDetail[0]->proprietary_rights)}}</span>
							</div>
							<div class="col-md-12">
								<label class="form-label">Owner Detail : </label><br>
								<div class="row">
									<div class="col-md-3">
										<span><b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail[0]->owner_detail)->salutation ?? ''}} {{ucfirst(json_decode($applicationDetail[0]->owner_detail)->first_name ?? '')}} {{ucfirst(json_decode($applicationDetail[0]->owner_detail)->middle_name ?? '')}} {{ucfirst(json_decode($applicationDetail[0]->owner_detail)->last_name ?? '')}}</span>
									</div>
									<div class="col-md-3">
										<span> <b style="margin-left:20px">Mobile No : </b> {{json_decode($applicationDetail[0]->owner_detail)->mobile_no ?? ''}}</span>
									</div>
									<div class="col-md-3">
										<span> <b style="margin-left:20px">Percentage Share : </b> {{json_decode($applicationDetail[0]->owner_detail)->percentage_share ?? ''}}</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Point Of Contact : </b>  {{ucfirst(json_decode($applicationDetail[0]->owner_detail)->point_of_contact ?? '')}}</span>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<label class="form-label">Contact Person :</label><br>
								<div class="row">
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Person Appointed : </b>{{json_decode($applicationDetail[0]->contact_person)->person_appointed ?? ''}}
										</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail[0]->contact_person)->con_salutation ?? ''}} {{ucfirst(json_decode($applicationDetail[0]->contact_person)->con_first_name ?? '')}} {{ucfirst(json_decode($applicationDetail[0]->contact_person)->con_middle_name ?? '')}} {{ucfirst(json_decode($applicationDetail[0]->contact_person)->con_last_name ?? '')}}
										</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Mobile No : </b>  {{json_decode($applicationDetail[0]->contact_person)->con_mobile_no ?? ''}}
										</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Email Address : </b> {{json_decode($applicationDetail[0]->contact_person)->con_email ?? ''}}
										</span>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<label class="form-label">Architect Detail :</label><br>
								<div class="row">
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail[0]->architect_detail)->arc_salutation ?? ''}} {{ucfirst(json_decode($applicationDetail[0]->architect_detail)->arc_first_name ?? '')}} {{ucfirst(json_decode($applicationDetail[0]->architect_detail)->arc_middle_name ?? '')}} {{ucfirst(json_decode($applicationDetail[0]->architect_detail)->arc_last_name ?? '')}}
										</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Mobile No : </b>  {{json_decode($applicationDetail[0]->architect_detail)->architect_mobile_no ?? ''}}
										</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Email Address : </b> {{json_decode($applicationDetail[0]->architect_detail)->architect_email ?? ''}}
											<br>
										</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Firm Gst Pan Tan : </b>  {{json_decode($applicationDetail[0]->architect_detail)->firm_gst_pan_tan ?? ''}}
										</span>
									</div>
									<div class="col-md-3">
										<span>
											<b style="margin-left:20px">Firm Gst Pan Tan No. : </b> {{json_decode($applicationDetail[0]->architect_detail)->firm_gst_pan_tan_no ?? ''}}
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
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Total Plot Area : </label><br>
								<span>
									<b>Area : </b>{{ json_decode($applicationDetail[0]->total_plot_area)->total_plot_area ?? '' }} Sqmt
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Total Covered Area : </label><br>
								<span>
									<b>Area : </b>{{ json_decode($applicationDetail[0]->total_covered_area)->total_covered_area ?? '' }} Sqmt
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Ground Floor Covered : </label><br>
								<span>
									<b>Area : </b>{{ json_decode($applicationDetail[0]->ground_floor_covered)->ground_floor_covered ?? '' }} Sqmt
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Max Height Building : </label><br>
								<span>
									<b>Height : </b>{{ json_decode($applicationDetail[0]->max_height_building)->max_height_building ?? '' }}
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">No. Of Floor : </label><br>
								<span>{{ $applicationDetail[0]->no_of_floor ?? '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Basement Covered Area : </label><br>
								<span>
									<b>Area : </b>{{ json_decode($applicationDetail[0]->basement_covered_area)->basement_covered_area ?? '' }} Sqmt
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">No Of Basement : </label><br>
								<span>{{ $applicationDetail[0]->no_of_basement ?? '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">No Of Blocks : </label><br>
								<span>{{ $applicationDetail[0]->no_of_blocks ?? '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Height Of Tallest Block : </label><br>
								<span>
									<b>Height : </b>{{ json_decode($applicationDetail[0]->height_of_tallest_block)->height_of_tallest_block ?? '' }}
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Min Distance Block : </label><br>
								<span>
									<b>Height : </b>{{ json_decode($applicationDetail[0]->min_distance_block)->min_distance_block ?? '' }}
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Approach Road Width : </label><br>
								<span>
									<b>Width : </b>{{ json_decode($applicationDetail[0]->approach_road_width)->approach_road_width ?? '' }}
								</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Provision No Enterance : </label><br>
								<span>{{ $applicationDetail[0]->provision_no_enterance ?? '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Provision No Exit : </label><br>
								<span>{{ $applicationDetail[0]->provision_no_exit ?? '' }}</span>
							</div>
						</div>
					
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Set Back Detail : </label><br>
								<span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Front Area : </label>
								<span>{{ json_decode($applicationDetail[0]->set_back_detail)->front ?? '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Rear Area : </label>
								<span>{{ json_decode($applicationDetail[0]->set_back_detail)->rear ?? '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Side 1 Area : </label>
								<span>{{ json_decode($applicationDetail[0]->set_back_detail)->side1 ?? '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Side 2 Area : </label>
								<span>{{ json_decode($applicationDetail[0]->set_back_detail)->side2 ?? '' }}</span>
							</div>
						</div>
					</div>
					
					<div class="tab-pane text-muted" id="nav-Essential" role="tabpanel">
						<h5>Essential Provision Detail</h5>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Compartmentation :</label><br><span>{{json_decode($applicationDetail[0]->ess_provision_detail)->compartmentation ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">No. Of Stairs : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->no_of_stairs ?? ''}}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Minimum Width of Stairs : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->width_of_stairs ?? ''}}</span>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Emergency Exit : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->emergency_exit ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Provision Of Lift : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->provision_of_lift ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Electric Suppy : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->electric_suppy ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Emergency Lighting System : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->emergency_lighting_system ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Provision Of Smoke : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->provision_of_smoke ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Emergency Lighting System : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->emergency_lighting_system  ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Refuse Area : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->refuse_area ?? ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Travel Distance : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->travel_distance ?? ''}} </span>
							</div>

							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Other Comment : </label><br>
								<span>{{json_decode($applicationDetail[0]->ess_provision_detail)->other_comment ?? ''}} </span>
							</div>
						</div>
					</div>
					<div class="tab-pane text-muted" id="nav-Attachments" role="tabpanel">
						<h5>Attachments</h5>
						<hr>
						<div class="row">
							<div class="col-md-12">
								<span>
									@if(isset(json_decode($applicationDetail[0]->attachments)->reference_letter))
									<b>Reference Letter : </b><a href="{{ asset(json_decode($applicationDetail[0]->attachments)->reference_letter)}}" target="blank" title="View Reference Letter"><i class="fa fa-download"></i></a>
									@endif
									@if(isset(json_decode($applicationDetail[0]->attachments)->proposed_map))
									<b>Propossed Map : </b><a href="{{ asset(json_decode($applicationDetail[0]->attachments)->proposed_map)}}" target="blank" title="View Propossed Map"><i class="fa fa-download"></i></a>
									@endif
									@if(isset(json_decode($applicationDetail[0]->attachments)->fire_plan))
									<b>Fire Plan : </b><a href="{{ asset(json_decode($applicationDetail[0]->attachments)->fire_plan)}}" target="blank" title="View Fire Plan"><i class="fa fa-download"></i></a><br>
									@endif
								</span>
							</div>
						</div>
						<h4 class="font-italic">Payment Challan</h4>
						<div class="row">
							<div class="col-md-12">
								<span >
								@if($applicationDetail[0]->challan !='')
								<b>Payment Challan : </b><a href="{{ asset($applicationDetail[0]->challan)}}" target="blank" title="View Payment Challan"><i class="fa fa-download"></i></a>
								@endif
								</span>
							</div>
						</div>
					</div>
					@if(empty($operational_application))
					<div class="tab-pane text-muted" id="nav-Fire" role="tabpanel">
						<h5>Vendor detail</h5>
						<hr>
						<div class="row">
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Name of Fire Vendor :</label><br><span>{{ isset($operational_application->vendor) ? json_decode($operational_application->vendor)->vendor_name : '' }} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Name Of Firm : </label><br>
								<span>{{ isset($operational_application->vendor) ? json_decode($operational_application->vendor)->vendor_firm_name : '' }}</span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Mobile No. : </label><br>
								<span>{{ isset($operational_application->vendor) ? json_decode($operational_application->vendor)->vendor_number : '' }} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">GST/PAN/TAN</label><br>
								<span>{{ isset($operational_application->vendor) ? ucfirst(json_decode($operational_application->vendor)->vendor_gst_pan_tan ) : ''}} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">GST/PAN/TAN No. : </label><br>
								<span>{{ isset($operational_application->vendor) ? json_decode($operational_application->vendor)->vendor_gst_pan_tan_no : '' }} </span>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="form-label">Email : </label><br>
								<span>{{ isset($operational_application->vendor) ? json_decode($operational_application->vendor)->vendor_email : '' }}</span>
							</div>
						</div>
					</div>
					@endif
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
										@if(isset($applicationDetail[0]->remark_by_cfo))
                     					@foreach(json_decode($applicationDetail[0]->remark_by_cfo) as $key => $remark)
										<div class="row mb-3">
											<div class="col-md-6">
												<label class="form-label">1. {{$remark->remark}}</label><br>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<span>{{$remark->date}}</span>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-md-12" style="padding-bottom:30px;line-height:2;">
												<label class="form-label">Reason for Remark : </label><br>
												@if((json_decode($remark->reason))->reason1 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason1}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason2 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason2}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason3 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason3}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason4 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason4}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason5 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason5}}</span></div>
												@endif
											</div>
										</div>
										@endforeach
										@else
										<div class="row mb-12">
											<h4 style="text-align:center;margin-left: auto;margin-right: auto;">No Remark Found</h4>
										</div>
										@endif
									</div>

									<div class="tab-pane text-muted" id="about-vertical-link" role="tabpanel">
										<h5>Remarks By FSO</h5>
										<hr>
										@if(isset($applicationDetail[0]->remark_by_fso))
										@foreach(json_decode($applicationDetail[0]->remark_by_fso) as $key => $remark)
										<div class="row mb-3">
											<div class="col-md-6">
												<label class="form-label">{{$key + 1}}. {{$remark->remark}}</label><br>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
												<span>{{$remark->date}}</span>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-md-12" style="padding-bottom:30px;line-height:2;">
												<label class="form-label">Reason for Remark : </label><br>
												@if((json_decode($remark->reason))->reason1 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason1}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason2 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason2}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason3 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason3}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason4 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason4}}</span></div>
												@endif
												@if((json_decode($remark->reason))->reason5 !='')
												<div class="col-md-12"><span><b>=></b> {{(json_decode($remark->reason))->reason5}}</span></div>
												@endif
											</div>
										</div>
										@endforeach
										@else
										<div class="row mb-12">
											<h4 style="text-align:center;margin-left: auto;margin-right: auto;">No Remark Found</h4>
										</div>
										@endif
									</div>

									<div class="tab-pane text-muted" id="services-vertical-link" role="tabpanel">
										<h5>Revert</h5>
										<hr>
										@if(isset($applicationDetail[0]->revert))
										@foreach(json_decode($applicationDetail[0]->revert) as $revert)
										<div class="row mb-3">
											<div class="col-md-6">
											<label class="form-label">Revert Information : </label><br>
											<span>{{$revert->revert}}</span>
											</div>
											<div class="col-md-4 col-sm-4 col-xs-12">
											<label class="form-label">Date. : </label><br>
											<span>{{$revert->date}}</span>
											</div>
										</div>

										<div class="row mb-3">
											<div class="col-md-12" style="padding-bottom:30px;line-height:2;">
											<label class="form-label">Reason for Revert : </label><br>
											@if((json_decode($revert->reason))->reason1 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason1}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason2 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason2}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason3 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason3}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason4 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason4}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason5 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason5}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason6 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason6}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason7 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason7}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason8 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason8}}</span></div>
											@endif
											@if((json_decode($revert->reason))->reason9 !='')
											<div class="col-md-12"><span><b>=></b> {{(json_decode($revert->reason))->reason9}}</span></div>
											@endif
											</div>
										</div>

										 @if(isset($revert->attachment))
											<b>Supportive Document :</b><a href="{{ asset($revert->attachment)}}" target="blank" title="View Reference Letter"> <i class="fa fa-cloud-download" style="font-size: 26px;"></i></a>
										@endif	
										@endforeach
										@else
										<div class="row mb-3">
											<h4 style="text-align:center;">No Remark Found</h4>
										</div>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane text-muted" id="nav-History" role="tabpanel">
						<h5>Application History</h5>
						<hr>
						@if(isset($applicationDetail[0]->history))
						<div class="row mb-3">
							@foreach(json_decode($applicationDetail[0]->history) as $history)
							<div class="col-md-12">
								<div class="desc" style="padding:20px;background:rgb(243,251,232);">
									<div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
										<div class="thumb">
											<span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
											<p style="display:inline-block;font-size:14px;margin-left:15px">
												<muted>{{date('d-m-Y h:i:sa', strtotime($history->date))}}</muted>
											</p>
										</div>
										<div class="details" style="font-size:14px;padding-left:40px">
											<p style="color:#1c90c0;">{{$history->history}}</p>
											<!-- <p>Reason : Approved (Application has been approved. granted annual clearance certificate for year 2022-2025)</p> -->
										</div>
									</div>
								</div>
							</div>
							@endforeach
						</div>
						@else
						<div class="row mb-3">
							<div class="col-md-12">
								<h4 style="text-align:center;">No History Found</h4>
							</div>
						</div>
						@endif
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
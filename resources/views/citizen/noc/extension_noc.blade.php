@extends('layouts.citizen.template')
@section('content')
<style>
    .error {
        color: red;
    }
    .form-control{
        border: 1px solid #aaa !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered{
        border: 1px solid #aaa !important;
    }
    .tab-content .tab-pane{
        border: 2px solid #ddd !important;
    }
    .radio-toolbar{
        margin-top: 8px;
    }

    #pac-input{
        height: 40px;
        font-size: 16px;
        margin-top: 11px;
        padding: 5px 10px;
        width: 400px;
    }
    .tab-pane{
        background-color: #eff3ff;
        box-shadow: 0px 0px 10px #9db5ff;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link{
        background-color: #1d4ed830;
    }
    
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active{
        background-color: #1d4ed8;
        color: #fff;
    }
	.progress-bar{
		background-color: #1d4ed8;
	}
	.form-label{
		font-size: 16px !important;
		font-weight: 600;
	}
	
	label{
		color: #000;
	}
</style>
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">Apply Noc</h5>
    </div>
</div>
<div class="card custom-card" id="hori">
    <div class="card-body">
        <div class="text-wrap">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="basicTabLink">Basic Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="proprietaryTabLink">Proprietary Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="areaTabLink">Area Details of Site</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="essentialTabLink">Essential Provision</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="attachmentsTabLink">Attachments</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="finalTabLink">Final Submit</a>
                </li>
            </ul>
            <div class="tab-content">
                    <div class="alert alert-success" id="successBlock" style="display:none;"></div>
                    <div class="alert alert-danger" id="errorBlock" style="display:none;"></div>
                    <div class="progress mb-3 mt-3" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" id="bar_value">
                        <div class="progress-bar" style="width: 2%;" id="bar_text">2%</div>
                    </div>
                <div class="tab-pane text-muted show active" id="basicTab" role="tabpanel">
                    <form method="POST" id="basic_details">
                        @csrf
                        <div class="row">
                            <input type="hidden" id="application_no" name="application_no" value="">
                            <input type="hidden" name="application_type" id="application_type" value="pre establishment noc">
                            <input type="hidden" name="noc_type" id="noc_type" value="{{ $applicationDetail[0]->noc_type }}">
                            <input type="hidden" name="pre_perational" id="pre_perational" value="">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Building Name <span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="building_name" name="building_name" placeholder="Building Name" value="{{ $applicationDetail[0]->building_name }}">
                                    <span class="error" id="error1"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-right: 0;">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Building Ownership भवन का स्वामित्व <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input @if($applicationDetail[0]->building_ownership == 'owned') checked @endif type="radio" id="owned" name="building_ownership" value="owned">
                                        <label for="owned">Owned स्वयं की</label>
                                        <input @if($applicationDetail[0]->building_ownership == 'occupied') checked @endif type="radio" id="occupied" name="building_ownership" value="occupied">
                                        <label for="occupied">Occupied अधिभोगी</label>
                                    </div>
                                    <span class="error" id="error2"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-right: 0;">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">GST/PAN/TAN जीएसटी/पैन/टैन</label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="gst" name="gst_pan_tan" value="gst" @if($applicationDetail[0]->gst_pan_tan == 'gst') checked @endif>
                                        <label for="gst">GST</label>
                                        <input type="radio" id="pan" name="gst_pan_tan" value="pan" @if($applicationDetail[0]->gst_pan_tan == 'pan') checked @endif>
                                        <label for="pan">PAN</label>
                                        <input type="radio" id="tan" name="gst_pan_tan" value="tan" @if($applicationDetail[0]->gst_pan_tan == 'tan') checked @endif>
                                        <label for="tan">TAN</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">GST/PAN/TAN No. जीएसटी/पैन/टैन</label>
                                    <input type="text" class="form-control" id="gst_pan_tan_no" name="gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="{{ $applicationDetail[0]->gst_pan_tan_no }}">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Category Of Project परियोजना का वर्गीकरण<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="project_type" id="project_id" disabled>
                                        @foreach ($projects as $prd)
                                            <option {{ $prd->id == $applicationDetail[0]->project_type ? 'selected' : '' }} value="{{ $prd->id }}" selected>{{ ucfirst($prd->name) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error" id="error3"></span>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Sub Category Of Building भवन का उप-वर्गीकरण <span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="subcategory_id" id="subcategory_id">
                                        <option value="" style="display:none;">Select Sub Category</option>
                                    </select>
                                    <span class="error" id="error5"></span>
                                </div>
                            </div>


                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username" style="margin-top:22px">Building Category भवन का वर्गीकरण<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="category_id" id="category_id">
                                        <option value="" style="display:none;">Select Category</option>
                                    </select>
                                    <span class="error" id="error4"></span>
                                </div>
                            </div>
                            
                            
                           
                            <!-- <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Sub Type (Optional)</label>
                                    <select class="form-control js-example-basic-single" name="type_id" id="type_id">
                                        <option value="" style="display:none;">Select Sub Category</option>
                                    </select>
                                </div>
                            </div> -->

                            <div class="col-md-3 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username" style="margin-top:22px">Project Status परियोजना की स्थिति<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="project_status" id="project_status">
                                        <option value="" style="display:none;">Select Project Status</option>
                                        <option @if($applicationDetail[0]->project_status == 'New') selected @endif  value="New">New</option>
                                        <option @if($applicationDetail[0]->project_status == 'Extension') selected @endif  value="Extension">Extension आवर्धन</option>
                                        <option @if($applicationDetail[0]->project_status == 'Diversification') selected @endif  value="Diversification">Diversification विवर्तन</option>
                                        <option @if($applicationDetail[0]->project_status == 'Compounding') selected @endif  value="Compounding">Compounding शमन</option>
                                    </select>
                                    <span class="error" id="error6"></span>
                                </div>
                            </div>
                            @if($applicationDetail[0]->building_ownership == 'occupied')
                                $occupancyDetails = json_decode(applicationDetail[0]->$occupancy_data) ?? '';
                            <div class="col-md-12 col-sm-12 col-xs-12 occupency_heading" style="display:none;">
                                <h5 style="padding:5px">Occupency Detail अधिभोग का विवरण</h5>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div1" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">Number of Rooms कमरों की संख्या </label>
                                    <input type="number" class="form-control" id="no_of_rooms" name="no_of_rooms" placeholder="Number of Rooms" value="{{ $occupancyDetails->no_of_rooms ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div2" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">Number of Flats फ्लैटों की संख्या </label>
                                    <input type="number" class="form-control" id="no_of_flats" name="no_of_flats" placeholder="Number of Flats" value="{{ $occupancyDetails->no_of_flats ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div3" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">Number of Beds बेडस् की संख्या </label>
                                    <input type="number" class="form-control" id="no_of_beds" name="no_of_beds" placeholder="Number of Beds" value="{{ $occupancyDetails->no_of_beds ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div4" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">For Educationals शिक्षण संस्थानों का लिए<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="for_educational" id="for_educational">
                                        <option value="" style="display:none;">Select For Educational</option>
                                        <option @if($occupancyDetails->for_educational == 'kindergarten') selected @endif value="kindergarten">Kindergarten</option>
                                        <option @if($occupancyDetails->for_educational == 'senior') selected @endif value="senior">Senior</option>
                                        <option @if($occupancyDetails->for_educational == 'secondary') selected @endif value="secondary">Secondary</option>
                                        <option @if($occupancyDetails->for_educational == 'other') selected @endif value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div5" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">Seating Capacity बैठने की क्षमता</label>
                                    <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" placeholder="Seating Capacity" value="{{ $occupancyDetails->seating_capacity ?? '' }}">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div6" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">Number of Employee कार्मिकों की संख्या</label>
                                    <input type="number" class="form-control" id="no_of_employee" name="no_of_employee" placeholder="Number of Employee" value="{{ $occupancyDetails->no_of_employee ?? '' }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div7" style="padding-right:0;display:none;">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Is any hazardous material used क्या कोई हैजार्डस् मैटीरियल का प्रयोग किया जायेगा<span class="span_required">*</span></label>

                                    <div class="radio-toolbar">
                                        <input @if($occupancyDetails->is_hazardous_material == 'yes') selected @endif type="radio" id="yes" name="is_hazardous_material" value="yes" onclick="chooseHazardous(this);">
                                        <label for="yes">Yes हाँ</label>
                                        <input @if($occupancyDetails->is_hazardous_material == 'no') selected @endif type="radio" id="no" name="is_hazardous_material" value="no" onclick="chooseHazardous(this);">
                                        <label for="no">No नहीं</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div8" style="display:none;">
                                <div class="form-group">
                                    <label class="form-label">Details of Hazardous Materials हैजार्डस् मैटीरियल का विवरण</label>
                                    <input type="text" class="form-control" id="hazardous_material" name="hazardous_material" placeholder="Details of Hazardous Materials" value="{{ $occupancyDetails->hazardous_material ?? '' }}">
                                </div>
                            </div>
                            @endif

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Email ई-मेल <span class="span_required">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $applicationDetail[0]->email ?? ''}}" readonly>
                                    <span class="error" id="error7"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Mobile No. मोबाइल नं0 <span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="{{ $applicationDetail[0]->mobile_no ?? ''}}" readonly maxlength="10" minlength="10">
                                    <span class="error" id="error8"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Other Contact No. अन्य सम्पर्क नं0</label>
                                    <input type="number" class="form-control" id="office_telephone" name="office_telephone" placeholder="Other Telephone No." value="{{ $applicationDetail[0]->office_telephone ?? ''}}" maxlength="10" minlength="10">
                                    <span class="error" id="error9"></span>
                                </div>
                            </div>


                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <h5>Location:</h5>
                            </div>

                            <div class="col-md-12 col-md-12 col-md-12">
                                <input id="pac-input" class="controls" value="" type="text" placeholder="Start typing a location..." required>
                                <div id="map" style="height: 450px;width: 100%"></div>
                                <input type="hidden" name="latitude" id="lat" value="{{ $applicationDetail[0]->latitude ?? ''}}" required>
                                <input type="hidden" name="longitude" id="lng" value="{{ $applicationDetail[0]->longitude ?? ''}}" required>
                                <input type="hidden" name="google_address" id="location" value="" required>
                            </div>


                            <!-- <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" id="google_address" name="google_address" placeholder="Serach your address" value="" step="any">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Latitude अक्षांश</label>
                                    <input type="number" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="{{ $application->latitude ?? ''}}" step="any" pattern="^\d*(\.\d{0,4})?$" readonly>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Longitude देशान्तर</label>
                                    <input type="number" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="{{ $application->longitude ?? ''}}" step="any" pattern="^\d*(\.\d{0,4})?$" readonly>
                                </div>
                            </div> -->


                            
                        </div>
                        <div class="row" style="margin-top:30px;">
                            <div class="col-md-12 col-sm-6 col-xs-12">
                                <h5>Building Address भवन का पता:</h5>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">District जनपद<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="district_id" id="district_id">
                                        <option value="" style="display:none;">Select District जनपद</option>
                                        @foreach ($district as $dist)

                                        @if(Auth::user()->district_id !=$dist->id)
                                        <option @if($applicationDetail[0]->district_id == $dist->id) selected @endif value="{{ $dist->id }}" s>{{ ucfirst($dist->name) }} </option>
                                        @else
                                        <option @if($applicationDetail[0]->district_id == $dist->id) selected @endif value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                        @endif

                                        @endforeach
                                    </select>
                                    <span class="error" id="error10"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-8 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Urban नगर / Rural ग्रामीण<span class="span_required">*</span></label>
                                    <div class="radio-toolbar">

                                        <input @if($applicationDetail[0]->rural_urban == 'urban') checked @endif type="radio" id="urban" name="rural_urban" value="urban" onclick="chooseRularUrban(this);">
                                        <label for="urban">Urban नगर</label>

                                        <input @if($applicationDetail[0]->rural_urban == 'rural') checked @endif type="radio" id="rular" name="rural_urban" value="rural" onclick="chooseRularUrban(this);">
                                        <label for="rular">Rulal ग्रामीण</label>

                                    </div>
                                    <span class="error" id="error11"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="urban_div" style="display:none;">
                            <div class="col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Tehsil तहसील <span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="tehsil_id" id="tehsil_id">
                                        <option value="" style="display:none;">Select Tehsil तहसील चुनें</option>
                                    </select>
                                    <span class="error" id="error12"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Street गली <span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="{{ $applicationDetail[0]->street }}">
                                    <span class="error" id="error13"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">City शहर <span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $applicationDetail[0]->city ?? ''}}">
                                    <span class="error" id="error14"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="rular_div" style="display:none;">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Block विकासखण्ड <span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="block_id" id="block_id">
                                        <option value="" style="display:none;">Select Block विकासखण्ड चुनें</option>
                                    </select>
                                    <span class="error" id="error15"></span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Panchayat पंचायत<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="panchayat_id" id="panchayat_id">
                                        <option value="" style="display:none;">Select Panchayat</option>
                                    </select>
                                    <span class="error" id="error16"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Village ग्राम<span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="village" name="village" placeholder="Village" value="{{ $applicationDetail[0]->village ?? ''}}">
                                    <span class="error" id="error17"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Landmark लेण्डमार्क <span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" value="{{ $applicationDetail[0]->landmark ?? ''}}">
                                    <span class="error" id="error18"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-right:0px;">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Choose Plot/ Khasra/ Khatoni <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="plot" name="plot_khasra_khatauni" value="plot" checked>
                                        <label for="plot">Plot No.</label>
                                        <input type="radio" id="khasra" name="plot_khasra_khatauni" value="khasra">
                                        <label for="khasra">Khasra No.</label>
                                        <input type="radio" id="khatoni" name="plot_khasra_khatauni" value="khatoni">
                                        <label for="khatoni">Khatoni No.</label>
                                    </div>
                                    <span class="error" id="error19"></span>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="plot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="{{ $applicationDetail[0]->plot_khasra_khatauni_no ?? ''}}">
                                    <span class="error" id="error20"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Pincode पिनकोड <span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{ $applicationDetail[0]->pincode ?? ''}}" maxlength="6" minlength="6">
                                    <span class="error" id="error21"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">

                            </div>
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-primary" id="submitBasic" style="float:right;">Save & Next</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane text-muted" id="proprietaryTab" role="tabpanel">
                    <form id="step_two_form" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <!--   <label class="form-control-label" >Proprietary Rights <span class="span_required">*</span></label> -->
                                    <div class="radio-toolbar">
                                        <input type="radio" id="single" name="proprietary_rights" value="single" checked onclick="singlePartner(this);">
                                        <label for="single">Single एकल</label>
                                        <input type="radio" id="partnership" name="proprietary_rights" value="partnership" onclick="singlePartner(this);">
                                        <label for="partnership">Partnership संयुक्त या भागीदारी</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="single_proprietary" style="display:none;">
                            <div class="row">
                                <h5>Name Of Owner स्वामी का नाम</h5>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label" for="salutation">Salutation<span class="span_required">*</span></label>
                                        <select class="form-control js-example-basic-single" name="salutation" id="salutation">
                                            <option value="" disabled selected>Select</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Ms">Ms</option>
                                            <option value="Mrs">Mrs</option>
                                        </select>
                                        <span class="error" id="error22"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">First Name पर्थम नाम<span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="">
                                        <span class="error" id="error23"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Middle Name मध्य नाम</label>
                                        <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Last Name अन्तिम नाम</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="">
                                        <span class="error" id="error24"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Email Address ई-मेल<span class="span_required">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="">
                                        <span class="error" id="error25"></span>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Percentage Share भागीदारी पर्तिशत<span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="percentage_share" name="percentage_share" placeholder="Percentage Share" value="">
                                        <span class="error" id="error26"></span>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Is this person the point of contact क्या यह व्यक्ति सम्परक् किये जाने हेतु है<span class="span_required">*</span></label>
                                        <div class="radio-toolbar">
                                            <input type="radio" id="owner_yes" name="point_of_contact" class="point_of_contact" value="yes">
                                            <label for="owner_yes">Yes</label>
                                            <input type="radio" id="owner_no" name="point_of_contact" class="point_of_contact" value="no" checked>
                                            <label for="owner_no">No</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div  id="partmership_proprietary" style="display:none;">
                            <h5>Partners Detail भागीदरों का विवरण</h5>
                            <div class="input_fields_wrap">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Salutation<span class="span_required">*</span></label>
                                            <select class="form-control js-example-basic-single" name="p_salutation[]" id="p_salutation" required>
                                                <option value="" disabled selected>Select Salutation</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Ms">Ms</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                            <span class="error" id="error27"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="p_first_name" name="p_first_name[]" placeholder="First Name" value="">
                                            <span class="error" id="error28"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Middle Name मध्य नाम</label>
                                            <input type="text" class="form-control" id="p_middle_name" name="p_middle_name[]" placeholder="Middle Name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Last Name अन्तिम नाम</label>
                                            <input type="text" class="form-control" id="p_last_name" name="p_last_name[]" placeholder="Last Name" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="p_mobile_no" name="p_mobile_no[]" placeholder="Mobile No." value="">
                                            <span class="error" id="error29"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Percentage Share भागीदारी प्रतिशत<span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="p_percentage_share" name="p_percentage_share[]" placeholder="Percentage Share" value="">
                                            <span class="error" id="error30"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-8 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Is this person the point of contact क्या यह व्यक्ति सम्परक् किये जाने हेतु है <span class="span_required">*</span></label>
                                            <div class="radio-toolbar">
                                                <input type="radio" id="yes_1" name="p_point_of_contact[]" value="yes">
                                                <label for="yes_1">Yes</label>
                                                <input type="radio" id="no_1" name="p_point_of_contact[]" value="no">
                                                <label for="no_1">No</label>
                                            </div>
                                            <span class="error" id="error31"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <a class="btn btn-primary" style="float:right;margin-bottom:5px;color:#fff" onclick="add_field_button();">Add More Fields</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5>Contact Person Details सम्पर्क हेतु व्यक्ति का विवरण:</h5>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Appointed as<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="person_appointed" id="person_appointed" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Director">Director</option>
                                        <option value="CEO">CEO</option>
                                        <option value="Proprietor">Proprietor</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <span class="error" id="error32"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Salutation<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="con_salutation" id="con_salutation" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                    <span class="error" id="error33"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="con_first_name" name="con_first_name" placeholder="First Name" value="">
                                    <span class="error" id="error34"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Middle Name मध्य नाम</label>
                                    <input type="text" class="form-control" id="con_middle_name" name="con_middle_name" placeholder="Middle Name" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Last Name अन्तिम नाम</label>
                                    <input type="text" class="form-control" id="con_last_name" name="con_last_name" placeholder="Last Name" value="">
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="con_mobile_no" name="con_mobile_no" placeholder="Mobile No." value="">
                                    <span class="error" id="error35"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Email Address ई-मेल<span class="span_required">*</span></label>
                                    <input type="email" class="form-control" id="con_email" name="con_email" placeholder="Email Address" value="">
                                    <span class="error" id="error36"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5>Architect Details आर्किटेक्ट का विवरण:</h5>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Salutation<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="arc_salutation" id="arc_salutation" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                    <span class="error" id="error37"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="arc_first_name" name="arc_first_name" placeholder="First Name" value="">
                                    <span class="error" id="error38"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Middle Name मध्य नाम</label>
                                    <input type="text" class="form-control" id="arc_middle_name" name="arc_middle_name" placeholder="Middle Name" value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Last Name अन्तिम नाम</label>
                                    <input type="text" class="form-control" id="arc_last_name" name="arc_last_name" placeholder="Last Name" value="">
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Name Of Firm फर्म का नाम</label>
                                    <input type="text" class="form-control" id="name_of_firm" name="name_of_firm" placeholder="Name Of Firm" value="">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="arc_mobile_no" name="arc_mobile_no" placeholder="Mobile No." value="">
                                    <span class="error" id="error39"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Email ई-मेल<span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="arc_email" name="arc_email" placeholder="Email" value="">
                                    <span class="error" id="error40"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">GST/PAN/TAN जीएसटी/पैन/टैन</label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="first_gst" name="firm_gst_pan_tan" value="gst" checked="checked">
                                        <label for="first_gst">GST</label>
                                        <input type="radio" id="first_pan" name="firm_gst_pan_tan" value="pan">
                                        <label for="first_pan">PAN</label>
                                        <input type="radio" id="first_tan" name="firm_gst_pan_tan" value="tan">
                                        <label for="first_tan">TAN</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">GST/PAN/TAN No.जीएसटी/पैन/टैन</label>
                                    <input type="text" class="form-control" id="firm_gst_pan_tan_no" name="firm_gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-danger" id="backToBasic">Edit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-primary" id="submitProprietary" style="float:right;">Save & Next</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane text-muted" id="areaTab" role="tabpanel">
                    <span style="color:red;font-size:16px;margin-bottom:10px;">Note : Unit Should be Meter or Square Meter</span><br>
                    <form method="POST" enctype="multipart/form-data" id="step_three_form">
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Total Plot Area प्लॉट का कुल क्षत्रफल<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="total_plot_area" name="total_plot_area" placeholder="Total Area" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error41"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Total Covered Area कुल आच्छादित क्षत्रफल<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="total_covered_area" name="total_covered_area" placeholder="Covered Area" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error42"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Ground Floor Covered Area भू-तल का आच्छादित क्षत्रफल<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="ground_floor_covered" name="ground_floor_covered" placeholder="Ground Floor Covered" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error43"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Maximum height of Building भवन की अधिकतम ऊँचाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="max_height_building" name="max_height_building" placeholder="Ground Floor Covered" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error44"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Basement Covered Area भूमिगत तलों का आच्छादित क्षत्रफल <span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="basement_covered_area" name="basement_covered_area" placeholder="Ground Floor Covered" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error45"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No. of Floors तलों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_floor" name="no_of_floor" placeholder="No. of Floors" value="">
                                    <span class="error" id="error46"></span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No of Basement(s) भूमिगत तलों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_basement" name="no_of_basement" placeholder="No of Basement(s)" value="">
                                    <span class="error" id="error47"></span>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No. of Blocks ब्लॉकों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_blocks" name="no_of_blocks" placeholder="No. of Blocks" value="">
                                    <span class="error" id="error48"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Height of Tallest Block सबसे ऊँचे ब्लॉक की ऊँचाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="height_of_tallest_block" name="height_of_tallest_block" placeholder="Height of Tallest Block" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error49"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Distance b/w Blocks ब्लॉकों के बीच की दूरी <span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="min_distance_block" name="min_distance_block" placeholder="Minimum Distance between Blocks" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error50"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Approach Road width पहुँच मार्ग की चौड़ाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="approach_road_width" name="approach_road_width" placeholder="Approach Road width" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error51"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Provision of no. of entrance प्रवेश द्वारों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="provision_no_enterance" name="provision_no_enterance" placeholder="Provision of no. of entrance" value="">
                                    <span class="error" id="error52"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Provision of no. of exit निकास द्वारों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="provision_no_exit" name="provision_no_exit" placeholder="Provision of no. of exit" value="">
                                    <span class="error" id="error53"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <h5>Set Back Details सैट बैक एरिया विवरण:</h5>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Front अग्र भाग<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="front" name="front" placeholder="Front" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error54"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Rear पृष्ठ भाग<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="rear" name="rear" placeholder="Rear" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error55"></span>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Side-1 पार्श्व-1<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="side1" name="side1" placeholder="Side-1" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error56"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Side-2 पार्श्व-2<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="side2" name="side2" placeholder="Side-2" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error57"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-danger" id="backToProprietary">Edit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-primary" id="submitArea" style="float:right;">Save & Next</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane text-muted" id="essentialTab" role="tabpanel">
                    <form action="" id="step_four_form" method="POST" enctype="multipart/form-data">
                        <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Compartmentation कम्पार्टमेन्टेशन <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="compartmentation_yes" name="compartmentation" value="yes" checked>
                                        <label for="compartmentation_yes">Yes हाँ</label>
                                        <input type="radio" id="compartmentation_no" name="compartmentation" value="no">
                                        <label for="compartmentation_no">No नहीं</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No. of Stairs जीने की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_stairs" name="no_of_stairs" placeholder="No. of Stairs" value="">
                                    <span class="error" id="error58"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Minimum Width of Stairs जीने की न्यूनतम चौड़ाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="width_of_stairs" name="width_of_stairs" placeholder="Minimum Width of Stairs" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error59"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Emergency Exit आपातकालीन निकास <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="emergency_yes" name="emergency_exit" value="yes" checked>
                                        <label for="emergency_yes">Yes हाँ</label>
                                        <input type="radio" id="emergency_no" name="emergency_exit" value="no">
                                        <label for="emergency_no">No नहीं</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Provision of lift लिफ्ट का प्राविधान<span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="provision_yes" name="provision_of_lift" value="yes" checked>
                                        <label for="provision_yes">Yes हाँ</label>
                                        <input type="radio" id="provision_no" name="provision_of_lift" value="no">
                                        <label for="provision_no">No नहीं</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Alternative Electric Supply वैकल्पिक विद्युत व्यवस्था <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="electric_suppy_yes" name="electric_suppy" value="yes" checked>
                                        <label for="electric_suppy_yes">Yes</label>
                                        <input type="radio" id="electric_suppy_no" name="electric_suppy" value="no">
                                        <label for="electric_suppy_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Emergency lighting system आपातकालीन प्रकाश व्यवस्था <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="emergency_lighting_yes" name="emergency_lighting_system" value="yes" checked>
                                        <label for="emergency_lighting_yes">Yes</label>
                                        <input type="radio" id="emergency_lighting_no" name="emergency_lighting_system" value="no">
                                        <label for="emergency_lighting_no">No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Provision of Smoke / Fire check Doors धुँआ/फायर चैक डोर का प्राविधान <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="provision_of_smoke_yes" name="provision_of_smoke" value="yes" checked>
                                        <label for="provision_of_smoke_yes">Yes हाँ</label>
                                        <input type="radio" id="provision_of_smoke_no" name="provision_of_smoke" value="no">
                                        <label for="provision_of_smoke_no">No नहीं </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="input-username">Refuge area in case of high-rise buildings बहुमंजिला इमारतों का मामले में शरणागत स्थल<span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="refuse_area_yes" name="refuse_area" value="yes" checked>
                                        <label for="refuse_area_yes">Yes हाँ</label>
                                        <input type="radio" id="refuse_area_no" name="refuse_area" value="no">
                                        <label for="refuse_area_no">No नहीं</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Maximum Travel Distance in Building भवन में अधिकतम ट्रैवल डिस्टेन्स<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="travel_distance" name="travel_distance" placeholder="Maximum Travel Distance in Building" value="" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    <span class="error" id="error60"></span>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Other comment अन्य टिप्पणी<span class="span_required">*</span></label>
                                    <textarea class="form-control" id="other_comment" name="other_comment" placeholder="Write something here.." style="height:70px;"></textarea>
                                    <span class="error" id="error61"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-danger" id="backToArea">Edit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-primary" id="submitEssential" style="float:right;">Save & Next</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane text-muted" id="attachmentsTab" role="tabpanel">
                    <form method="POST" enctype="multipart/form-data" id="step_five_form">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Reference Letter from Competent Authority सम्बन्धित प्राधिकरण का सन्दर्भ पत्र<span class="span_required">*</span></label>
                                    <input type="file" class="form-control file" id="reference_letter" name="reference_letter" style="height: 36px;">
                                    <span class="error" id="error62"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Proposed Map भवन का प्रस्तावित मानचित्र<span class="span_required">*</span></label>
                                    <input type="file" class="form-control col-md-6 file" id="proposed_map" name="proposed_map" style="height: 36px;">
                                    <span class="error" id="error63"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Fire Plan with Fire legend फायर लीजेण्ड सहित फायर प्लान<span class="span_required">*</span></label>
                                    <input type="file" class="form-control" id="fire_plan" name="fire_plan" style="height: 36px;">
                                    <span class="error" id="error65"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-danger" id="backToEssential">Edit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-primary" id="submitAttachment" style="float:right;">Save & Next</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane text-muted" id="finalTab" role="tabpanel">
                    <form  method="POST" enctype="multipart/form-data" id="step_submit_form">
                        <div id="final_review">
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-danger" id="backToAttachment">Edit</button>
                            </div>
                            <div class="col-md-6">
                                <button type="button" class="save-btn hover-btn btn btn-primary" id="submitFinal" style="float:right;">Final Submit</button>
                            </div>
                        </div>
                    </form>
                    <div class="row" id="final_result" style="display:none;">
                        <div class="col-md-6">
                            <input type="hidden" id="application_no" name="application_no"  value="{{ $application[0]->application_no ?? ''}}">
                            <h3>Your Application No is (आपका आवेदन संख्या है) : <span id="final_application_no"></span> </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
    window.onload = function() {
        chooseRularUrban();
    };

    function chooseRularUrban() {
        var rular_urban = $("input[name='rural_urban']:checked").val();
        if (rular_urban == 'rural') {
            $("#plot1").prop('checked', true);
            $("#rular_div").slideToggle("slow", function() {
                $("#rular_div").show();
                $("#rular_div *").prop('disabled', false);
            });
            $("#urban_div").slideToggle("slow", function() {
                $("#urban_div").hide();
                $("#urban_div *").prop('disabled', true);
            });
        } else {
            $("#plot").prop('checked', true);
            $("#urban_div").slideToggle("slow", function() {
                $("#urban_div").show();
                $("#urban_div *").prop('disabled', false);
            });
            $("#rular_div").slideToggle("slow", function() {
                $("#rular_div").hide();
                $("#rular_div *").prop('disabled', true);
            });
        }
    }
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('change', '#project_id', function() {
            var project_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "../getCategoryByProject",
                data: {
                    project_id: project_id
                },
                success: function(response) {
                    $('#category_id').html(response)
                },
            });
        });
        $(document).on('change', '#category_id', function() {
            var category_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "../getSubcategoryByCategory",
                data: {
                    category_id: category_id
                },
                success: function(response) {
                    $('#subcategory_id').html(response)
                },
            });
        });
        $(document).on('change', '#subcategory_id', function() {
            var subcategory_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "../getTypeBySubcategory",
                data: {
                    subcategory_id: subcategory_id
                },
                success: function(response) {
                    $('#type_id').html(response)
                },
            });
        });
        $(document).on('change', '#district_id', function() {
            var district_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "../getTehsilByDistrict",
                data: {
                    district_id: district_id
                },
                success: function(response) {
                    $('#tehsil_id').html(response);
                },
            });
        });
        $(document).on('change', '#district_id', function() {
            var district_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "../getBlockByDistrict",
                data: {
                    district_id: district_id
                },
                success: function(response) {
                    $('#block_id').html(response)
                },
            });
        });
        $(document).on('change', '#block_id', function() {
            var block_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "getPanchayatByBlock",
                data: {
                    block_id: block_id
                },
                success: function(response) {
                    $('#panchayat_id').html(response)
                },
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Initialize form validation
        $('#step_one_form').validate({
            errorPlacement: function(error, element) {
                // Place the error message after the label
                error.insertAfter(element.prev('label'));
            },
        });
        getCategoryByProject();
        getTehsilByDistrict();
        getBlockByDistrict();
        chooseRularUrban();
    });
    function chooseRularUrban() {
        var rular_urban = $("input[name='rural_urban']:checked").val();
        if (rular_urban == 'rural') {
            $("#plot1").prop('checked', true);
            $("#rular_div").slideToggle("slow", function() {
                $("#rular_div").show();
                $("#rular_div *").prop('disabled', false);
            });
            $("#urban_div").slideToggle("slow", function() {
                $("#urban_div").hide();
                $("#urban_div *").prop('disabled', true);
            });
        } else {
            $("#plot").prop('checked', true);
            $("#urban_div").slideToggle("slow", function() {
                $("#urban_div").show();
                $("#urban_div *").prop('disabled', false);
            });
            $("#rular_div").slideToggle("slow", function() {
                $("#rular_div").hide();
                $("#rular_div *").prop('disabled', true);
            });
        }
    }
    function getCategoryByProject(){
        var project_id = $('#project_id').val();
        var categoryId = '{{ $applicationDetail[0]->category_id }}';
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "../getCategoryByProject",
            data: {
                project_id: project_id
            },
            success: function(response) {
                $('#category_id').html(response);
                $('#category_id').val(categoryId);
                getSubcategoryByCategory();
            },
        });
    }
    function getSubcategoryByCategory(){
        var category_id = $('#category_id').val();
        var subcategoryId = '{{ $applicationDetail[0]->subcategory_id  }}';
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "../getSubcategoryByCategory",
            data: {
                category_id: category_id
            },
            success: function(response) {
                $('#subcategory_id').html(response);
                $('#subcategory_id').val(subcategoryId);
            },
        });
    }
    function getTehsilByDistrict() {
        var district_id = $('#district_id').val();
        var tehsilId = '{{ $applicationDetail[0]->tehsil_id  }}';
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "../getTehsilByDistrict",
            data: {
                district_id: district_id
            },
            success: function(response) {
                $('#tehsil_id').html(response);
                $('#tehsil_id').val(tehsilId);
            },
        });
    };
    function getBlockByDistrict() {
        var district_id = $('#district_id').val();
        var blockId = '{{ $applicationDetail[0]->block_id  }}';
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "../getBlockByDistrict",
            data: {
                district_id: district_id
            },
            success: function(response) {
                $('#block_id').html(response);
                $('#block_id').val(blockId);
                getPanchayatByBlock();
            },
        });
    };
    function getPanchayatByBlock() {
        var block_id = $('#block_id').val();
        var panchayatId = '{{ $applicationDetail[0]->panchayat_id  }}';
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "../getPanchayatByBlock",
            data: {
                block_id: block_id
            },
            success: function(response) {
                console.log(response);
                $('#panchayat_id').html(response);
                $('#panchayat_id').val(panchayatId);
            },
        });
    };
</script>

<script>
    window.onload = function() {
        singlePartner();
    };
    function singlePartner() {
        var proprietary_rights = $("input[name='proprietary_rights']:checked").val();
        if (proprietary_rights == 'single') {
            $("#single_proprietary").slideToggle("slow", function() {
                $("#single_proprietary").show();
                $("#single_proprietary  *").prop('disabled', false);
            });

            $("#partmership_proprietary").slideToggle("slow", function() {
                $("#partmership_proprietary").hide();
                $("#partmership_proprietary  *").prop('disabled', true);
            });
            $("#add_field_button").hide();
        } else {
            $("#partmership_proprietary").slideToggle("slow", function() {
                $("#partmership_proprietary").show();
                $("#partmership_proprietary  *").prop('disabled', false);
            });

            $("#single_proprietary").slideToggle("slow", function() {
                $("#single_proprietary").hide();
                $("#single_proprietary  *").prop('disabled', true);

            });
            $("#add_field_button").show();
        }
    }
    var a = 1;
    function add_field_button() {
        var output = '<div class="row mt-2" id="partner_' + a + '"><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label" >Salutation<span class="span_required">*</span></label><select class="form-control"  name="p_salutation[]" id="p_salutation" required><option value="" disabled selected>Select Salutation</option><option value="Mr">Mr</option><option value="Ms">Ms</option><option value="Mrs">Mrs</option></select></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">First Name<span class="span_required">*</span></label><input type="text" class="form-control" id="p_first_name" name="p_first_name[]" placeholder="First Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Middle Name</label><input type="text" class="form-control" id="p_middle_name" name="p_middle_name[]" placeholder="Middle Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Last Name</label><input type="text" class="form-control" id="p_last_name" name="p_last_name[]" placeholder="Last Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label" >Mobile No.<span class="span_required">*</span></label><input type="number" class="form-control" id="p_mobile_no" name="p_mobile_no[]" placeholder="Mobile No." value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Percentage Share<span class="span_required">*</span></label><input type="number" class="form-control" id="p_percentage_share" name="p_percentage_share[]" placeholder="Percentage Share" value=""></div></div><div class=" col-md-4 col-sm-6 col-xs-12"><a href="#" class="btn btn-danger col-md-4 remove_field" id="' + a + '" onclick="removePartnerRow(this.id)">Remove</a></div></div>';
        var newRow = $(output);
        $(".input_fields_wrap").append(newRow);
        a++;
    };
    function removePartnerRow(e) {
        $('#partner_' + e).remove();
    }

    $(document).ready(function () {
        $(document).on('click', '[id^="backTo"]', function () {
            const targetTab = $(this).attr('id').replace('backTo', '').toLowerCase();
            const tabs = ['basic', 'proprietary', 'area', 'essential', 'attachments', 'final'];

            // Update tab links
            tabs.forEach(tab => {
                $(`#${tab}TabLink`).toggleClass('active', tab === targetTab);
            });

            // Update tabs
            tabs.forEach(tab => {
                $(`#${tab}Tab`).toggleClass('show active', tab === targetTab);
            });
        });

        $(document).on("click", "#submitBasic", function (e) {
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val()?.trim(),
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                application_type: $('input[name="application_type"]').val()?.trim() || '',
                noc_type: $('input[name="noc_type"]').val()?.trim() || '',
                building_name: $('input[name="building_name"]').val()?.trim() || '',
                building_ownership: $('input[name="building_ownership"]:checked').val() || '',
                gst_pan_tan: $('input[name="gst_pan_tan"]:checked').val() || '',
                gst_pan_tan_no: $('input[name="gst_pan_tan_no"]').val()?.trim() || '',
                project_type: $("#project_id").val()?.trim() || '',
                category_id: $("#category_id").val()?.trim() || '',
                subcategory_id: $("#subcategory_id").val()?.trim() || '',
                type_id: $("#type_id").val()?.trim() || '',
                project_status: $("#project_status").val()?.trim() || '',
                no_of_rooms: $('input[name="no_of_rooms"]').val()?.trim() || '',
                no_of_flats: $('input[name="no_of_flats"]').val()?.trim() || '',
                no_of_beds: $('input[name="no_of_beds"]').val()?.trim() || '',
                for_educational: $('input[name="for_educational"]').val()?.trim() || '',
                seating_capacity: $('input[name="seating_capacity"]').val()?.trim() || '',
                no_of_employee: $('input[name="no_of_employee"]').val()?.trim() || '',
                is_hazardous_material: $('input[name="is_hazardous_material"]:checked').val() || '',
                hazardous_material: $('input[name="hazardous_material"]').val()?.trim() || '',
                latitude: $('input[name="latitude"]').val()?.trim() || '',
                longitude: $('input[name="longitude"]').val()?.trim() || '',
                email: $('input[name="email"]').val()?.trim() || '',
                mobile_no: $('input[name="mobile_no"]').val()?.trim() || '',
                office_telephone: $('input[name="office_telephone"]').val()?.trim() || '',
                district_id: $("#district_id").val()?.trim() || '',
                rural_urban: $('input[name="rural_urban"]:checked').val() || '',
                tehsil_id: $("#tehsil_id").val()?.trim() || '',
                street: $('input[name="street"]').val()?.trim() || '',
                city: $('input[name="city"]').val()?.trim() || '',
                block_id: $("#block_id").val()?.trim() || '',
                panchayat_id: $("#panchayat_id").val()?.trim() || '',
                village: $('input[name="village"]').val()?.trim() || '',
                plot_khasra_khatauni: $('input[name="plot_khasra_khatauni"]:checked').val() || '',
                plot_khasra_khatauni_no: $('input[name="plot_khasra_khatauni_no"]').val()?.trim() || '',
                landmark: $('input[name="landmark"]').val()?.trim() || '',
                pincode: $('input[name="pincode"]').val()?.trim() || ''
            };
            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobileRegex = /^[6-9]\d{9}$/;
            const pincodeRegex = /^\d{6}$/;
            if (!formData.building_name) errors.push({ id: "error1", msg: "Building name is required" });
            if (!formData.building_ownership) errors.push({ id: "error2", msg: "Building ownership is required" });
            if (!formData.project_type) errors.push({ id: "error3", msg: "Project type is required" });
            if (!formData.category_id) errors.push({ id: "error4", msg: "Category is required" });
            if (!formData.subcategory_id) errors.push({ id: "error5", msg: "Subcategory is required" });
            if (!formData.project_status) errors.push({ id: "error6", msg: "Project status is required" });
            if (!formData.email) {
                errors.push({ id: "error7", msg: "Email is required" });
            } else if (!emailRegex.test(formData.email)) {
                errors.push({ id: "error7", msg: "Invalid email format" });
            }
            if (!formData.mobile_no) {
                errors.push({ id: "error8", msg: "Mobile number is required" });
            } else if (!mobileRegex.test(formData.mobile_no)) {
                errors.push({ id: "error8", msg: "Invalid mobile number (10 digits, starting with 6-9)" });
            }
            if (!formData.district_id) errors.push({ id: "error10", msg: "District is required" });
            if (!formData.rural_urban) errors.push({ id: "error11", msg: "Rural/Urban selection is required" });
            if (formData.rural_urban === "rural") {
                if (!formData.block_id) errors.push({ id: "error15", msg: "Block is required" });
                if (!formData.panchayat_id) errors.push({ id: "error16", msg: "Panchayat is required" });
                if (!formData.village) errors.push({ id: "error17", msg: "Village is required" });
            } else if (formData.rural_urban === "urban") {
                if (!formData.tehsil_id) errors.push({ id: "error12", msg: "Tehsil is required" });
                if (!formData.street) errors.push({ id: "error13", msg: "Street is required" });
                if (!formData.city) errors.push({ id: "error14", msg: "City is required" });
            }
            if (!formData.landmark) errors.push({ id: "error18", msg: "Landmark is required" });
            if (!formData.plot_khasra_khatauni) errors.push({ id: "error19", msg: "Plot/Khasra/Khatauni is required" });
            if (!formData.plot_khasra_khatauni_no) errors.push({ id: "error20", msg: "Plot/Khasra/Khatauni number is required" });
            if (!formData.pincode) {
                errors.push({ id: "error21", msg: "PIN code is required" });
            } else if (!pincodeRegex.test(formData.pincode)) {
                errors.push({ id: "error21", msg: "Invalid PIN code (6 digits)" });
            }
            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });
            $.ajax({
                url: "{{route('noc.step.first.post')}}", // Ensure this route is defined
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {
                    
                    if (response.status === "1") {
                        const errorIds = [
                            'error1', 'error2', 'error3', 'error4', 'error5', 'error6',
                            'error7', 'error8', 'error10', 'error11', 'error12', 'error13',
                            'error14', 'error15', 'error16', 'error17', 'error18', 'error19',
                            'error20', 'error21'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#proprietaryTabLink").addClass('active');
                        $("#proprietaryTab").addClass('show active');
                        $('input[name="application_no"]').val(response.application_no);
                        $('#final_application_no').html(response.application_no);
                        const newValue = 17;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", { status, error, response: xhr.responseText });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
        $(document).on('click', '#submitProprietary', function(e) {
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val()?.trim() || '',
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                proprietary_rights: $('input[name="proprietary_rights"]:checked').val()?.trim() || '',
                salutation: $('#salutation').val()?.trim() || '',
                first_name: $('input[name="first_name"]').val()?.trim() || '',
                middle_name: $('input[name="middle_name"]').val()?.trim() || '',
                last_name: $('input[name="last_name"]').val()?.trim() || '',
                mobile_no: $('input[name="mobile_no"]').val()?.trim() || '',
                email: $('input[name="email"]').val()?.trim() || '',
                percentage_share: $('input[name="percentage_share"]').val()?.trim() || '',
                point_of_contact: $('input[name="point_of_contact"]:checked').val()?.trim() || '',
                // Array inputs for partnership
                p_salutation: $('select[name="p_salutation[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_first_name: $('input[name="p_first_name[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_middle_name: $('input[name="p_middle_name[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_last_name: $('input[name="p_last_name[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_mobile_no: $('input[name="p_mobile_no[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_percentage_share: $('input[name="p_percentage_share[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_point_of_contact: $('input[name="p_point_of_contact[]"]:checked').map((_, el) => $(el).val()?.trim() || '').get(),
                person_appointed: $('#person_appointed').val()?.trim() || '',
                con_salutation: $('#con_salutation').val()?.trim() || '',
                con_first_name: $('input[name="con_first_name"]').val()?.trim() || '',
                con_middle_name: $('input[name="con_middle_name"]').val()?.trim() || '',
                con_last_name: $('input[name="con_last_name"]').val()?.trim() || '',
                con_mobile_no: $('input[name="con_mobile_no"]').val()?.trim() || '',
                con_email: $('input[name="con_email"]').val()?.trim() || '',
                arc_salutation: $('#arc_salutation').val()?.trim() || '',
                arc_first_name: $('input[name="arc_first_name"]').val()?.trim() || '',
                arc_middle_name: $('input[name="arc_middle_name[]"]').val()?.trim() || '',
                arc_last_name: $('input[name="arc_last_name"]').val()?.trim() || '',
                name_of_firm: $('input[name="name_of_firm"]').val()?.trim() || '',
                arc_mobile_no: $('input[name="arc_mobile_no"]').val()?.trim() || '',
                arc_email: $('input[name="arc_email"]').val()?.trim() || '',
                firm_gst_pan_tan: $('input[name="firm_gst_pan_tan"]').val()?.trim() || '',
                firm_gst_pan_tan_no: $('input[name="firm_gst_pan_tan_no"]').val()?.trim() || ''
            };
            // Clear previous errors
            $('[id^=error]').html('');
            $('#errorBlock').hide();
            
            // Validation
            const errors = [];
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobileRegex = /^[6-9]\d{10}$/;
            const percentageRegex = /^\d+(\.\d{1,2})?$/; // Allow integers or decimals up to 2 places

            // Validate single proprietary rights
            if (formData.proprietary_rights === 'single') {
                if (!formData.salutation) errors.push({ id: 'error22', msg: 'Salutation is required' });
                if (!formData.first_name) errors.push({ id: 'error23', msg: 'First name is required' });
                if (!formData.mobile_no) errors.push({ id: 'error24', msg: 'Valid mobile number is required' });
                if (!formData.email || !emailRegex.test(formData.email)) errors.push({ id: 'error25', msg: 'Valid email is required' });
                if (!formData.percentage_share || !percentageRegex.test(formData.percentage_share)) {
                    errors.push({ id: 'error26', msg: 'Valid percentage share (e.g., 100 or 100.00) is required' });
                } else if (parseFloat(formData.percentage_share) !== 100) {
                    errors.push({ id: 'error26', msg: 'Percentage share must be 100 for single proprietary' });
                }
            } 
            // Validate partnership (multiple entries)
            else if (formData.proprietary_rights === 'partnership') {
                const partnerCount = formData.p_first_name.length;
                if (partnerCount === 0) {
                    errors.push({ id: 'error27', msg: 'At least one partner is required' });
                } else {
                    let totalPercentage = 0;
                    formData.p_first_name.forEach((_, index) => {
                        if (!formData.p_salutation[index]) errors.push({ id: `error27_${index}`, msg: `Partner ${index + 1}: Salutation is required` });
                        if (!formData.p_first_name[index]) errors.push({ id: `error28_${index}`, msg: `Partner ${index + 1}: First name is required` });
                        if (!formData.p_mobile_no[index]) {
                            errors.push({ id: `error29_${index}`, msg: `Partner ${index + 1}: Valid mobile number is required` });
                        }
                        if (!formData.p_percentage_share[index] || !percentageRegex.test(formData.p_percentage_share[index])) {
                            errors.push({ id: `error30_${index}`, msg: `Partner ${index + 1}: Valid percentage share is required` });
                        } else {
                            totalPercentage += parseFloat(formData.p_percentage_share[index] || 0);
                        }
                        if (!formData.p_point_of_contact[0]) errors.push({ id: `error31_${0}`, msg: `Partner ${0 + 1}: Point of contact is required` });
                    });
                    if (totalPercentage !== 100) {
                        errors.push({ id: 'error30', msg: 'Total percentage share for all partners must equal 100' });
                    }
                }
            } else {
                errors.push({ id: 'error21', msg: 'Proprietary rights selection is required' });
            }

            // Validate other fields
            if (!formData.person_appointed) errors.push({ id: 'error32', msg: 'Person appointed is required' });
            if (!formData.con_salutation) errors.push({ id: 'error33', msg: 'Contact salutation is required' });
            if (!formData.con_first_name) errors.push({ id: 'error34', msg: 'Contact first name is required' });
            if (!formData.con_mobile_no) errors.push({ id: 'error35', msg: 'Valid contact mobile number is required' });
            if (!formData.con_email || !emailRegex.test(formData.con_email)) errors.push({ id: 'error36', msg: 'Valid contact email is required' });
            if (!formData.arc_salutation) errors.push({ id: 'error37', msg: 'ARC salutation is required' });
            if (!formData.arc_first_name) errors.push({ id: 'error38', msg: 'ARC first name is required' });
            if (!formData.arc_mobile_no) errors.push({ id: 'error39', msg: 'Valid ARC mobile number is required' });
            if (!formData.arc_email || !emailRegex.test(formData.arc_email)) errors.push({ id: 'error40', msg: 'Valid ARC email is required' });

            // Display errors if any
            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                
                $('#errorBlock').show();
                return false;
            }

            // Prepare FormData for AJAX
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                if (Array.isArray(formData[key])) {
                    formData[key].forEach((value, index) => {
                        ajaxFormData.append(`${key}[${index}]`, value);
                    });
                } else {
                    ajaxFormData.append(key, formData[key]);
                }
            });

            // AJAX submission
            $.ajax({
                url: "{{route('noc.step.second.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {
                    
                    if (response.status === '1') {
                        // Clear all error messages
                        $('[id^=error]').html('');
                        // Switch to areaTab
                        const tabs = ['basic', 'proprietary', 'area', 'essential', 'attachments', 'final'];
                        tabs.forEach(tab => {
                            $(`#${tab}TabLink`).toggleClass('active', tab === 'area');
                            $(`#${tab}Tab`).toggleClass('show active', tab === 'area');
                        });
                        // Update progress bar
                        const newValue = 34;
                        $('#bar_value').attr('aria-valuenow', newValue);
                        $('#bar_text').css('width', `${newValue}%`).text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || 'An error occurred').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', { status, error, response: xhr.responseText });
                    const errorMsg = xhr.responseJSON?.msg || xhr.responseJSON?.message || 'An error occurred';
                    $('#errorBlock').html(errorMsg).show();
                }
            });
        });
        $(document).on('click', '#submitArea', function(e){
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val()?.trim() || '',
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                total_plot_area: $('input[name="total_plot_area"]').val()?.trim() || '',
                total_covered_area: $('input[name="total_covered_area"]').val()?.trim() || '',
                ground_floor_covered: $('input[name="ground_floor_covered"]').val()?.trim() || '',
                max_height_building: $('input[name="max_height_building"]').val()?.trim() || '',
                basement_covered_area: $('input[name="basement_covered_area"]').val()?.trim() || '',
                no_of_floor: $('input[name="no_of_floor"]').val()?.trim() || '',
                no_of_basement: $('input[name="no_of_basement"]').val()?.trim() || '',
                no_of_blocks: $('input[name="no_of_blocks"]').val()?.trim() || '',
                height_of_tallest_block: $('input[name="height_of_tallest_block"]').val()?.trim() || '',
                min_distance_block: $('input[name="min_distance_block"]').val()?.trim() || '',
                approach_road_width: $('input[name="approach_road_width"]').val()?.trim() || '',
                provision_no_enterance: $('input[name="provision_no_enterance"]').val()?.trim() || '',
                provision_no_exit: $('input[name="provision_no_exit"]').val()?.trim() || '',
                front: $('input[name="front"]').val()?.trim() || '',
                rear: $('input[name="rear"]').val()?.trim() || '',
                side1: $('input[name="side1"]').val()?.trim() || '',
                side2: $('input[name="side2"]').val()?.trim() || '',
            };
            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            if (!formData.total_plot_area) errors.push({ id: "error41", msg: "Total plot area is required" });
            if (!formData.total_covered_area) errors.push({ id: "error42", msg: "Total covered area is required" });
            if (!formData.ground_floor_covered) errors.push({ id: "error43", msg: "Ground floor overed is required" });
            if (!formData.max_height_building) errors.push({ id: "error44", msg: "Max height building is required" });
            if (!formData.basement_covered_area) errors.push({ id: "error45", msg: "Basement covered area is required" });
            if (!formData.no_of_floor) errors.push({ id: "error46", msg: "No of floor is required" });
            if (!formData.no_of_basement) errors.push({ id: "error47", msg: "No of _basement is required" });
            if (!formData.no_of_blocks) errors.push({ id: "error48", msg: "No of blocks is required" });
            if (!formData.height_of_tallest_block) errors.push({ id: "error49", msg: "Height of tallest block is required" });
            if (!formData.min_distance_block) errors.push({ id: "error50", msg: "Min distance block is required" });
            if (!formData.approach_road_width) errors.push({ id: "error51", msg: "Approach road width is required" });
            if (!formData.provision_no_enterance) errors.push({ id: "error52", msg: "Provision no enterance is required" });
            if (!formData.provision_no_exit) errors.push({ id: "error53", msg: "Provision no exit is required" });
            if (!formData.front) errors.push({ id: "error54", msg: "Front is required" });
            if (!formData.rear) errors.push({ id: "error55", msg: "Rear is required" });
            if (!formData.side1) errors.push({ id: "error56", msg: "Side 1 is required" });
            if (!formData.side2) errors.push({ id: "error57", msg: "Side 2 is required" });

            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.third.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {
                    
                    if (response.status === "1") {
                        const errorIds = [
                            'error22', 'error23', 'error24', 'error25', 'error26',
                            'error27', 'error28', 'error29', 'error30', 'error31', 'error32',
                            'error33', 'error34', 'error35', 'error36', 'error37', 'error38',
                            'error39', 'error40'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#essentialTabLink").addClass('active');
                        $("#essentialTab").addClass('show active');
                        const newValue = 51;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", { status, error, response: xhr.responseText });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
        $(document).on('click', '#submitEssential', function(e){
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val()?.trim() || '',
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                compartmentation: $('input[name="compartmentation"]:checked').val()?.trim() || '',
                no_of_stairs: $('input[name="no_of_stairs"]').val()?.trim() || '',
                width_of_stairs: $('input[name="width_of_stairs"]').val()?.trim() || '',
                emergency_exit: $('input[name="emergency_exit"]:checked').val()?.trim() || '',
                provision_of_lift: $('input[name="provision_of_lift"]:checked').val()?.trim() || '',
                electric_suppy: $('input[name="electric_suppy"]:checked').val()?.trim() || '',
                emergency_lighting_system: $('input[name="emergency_lighting_system"]:checked').val()?.trim() || '',
                provision_of_smoke: $('input[name="provision_of_smoke"]:checked').val()?.trim() || '',
                refuse_area: $('input[name="refuse_area"]:checked').val()?.trim() || '',
                travel_distance: $('input[name="travel_distance"]').val()?.trim() || '',
                other_comment: $('#other_comment').val()?.trim() || '',
            };
            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            if (!formData.no_of_stairs) errors.push({ id: "error58", msg: "No of stairs is required" });
            if (!formData.width_of_stairs) errors.push({ id: "error59", msg: "Width of stairs is required" });
            if (!formData.travel_distance) errors.push({ id: "error60", msg: "Travel distance is required" });
            if (!formData.other_comment) errors.push({ id: "error61", msg: "Other comment is required" });

            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.forth.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {
                    
                    if (response.status === "1") {
                        const errorIds = [
                            'error58', 'error59', 'error60', 'error61'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#attachmentsTabLink").addClass('active');
                        $("#attachmentsTab").addClass('show active');
                        const newValue = 68;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", { status, error, response: xhr.responseText });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
        $(document).on('click', '#submitAttachment', function(e){
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val(),
                application_no: $('#application_no').val(),
                reference_letter: $('#reference_letter')[0].files[0],
                proposed_map: $('#proposed_map')[0].files[0],
                fire_plan: $('#fire_plan')[0].files[0]
            };
            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            if (!formData.reference_letter) errors.push({ id: "error62", msg: "Reference letter is required" });
            if (!formData.proposed_map) errors.push({ id: "error63", msg: "Proposed map is required" });
            if (!formData.fire_plan) errors.push({ id: "error64", msg: "Fire plan is required" });

            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.five.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {
                    
                    if (response.status === "1") {
                        const errorIds = [
                            'error62', 'error63', 'error64'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#finalTabLink").addClass('active');
                        $("#finalTab").addClass('show active');
                        const origin = window.location.origin;
                        const application_no =$('#application_no').val();
                        const url = origin + '/preview-noc/' + application_no;
                        fetch(url)
                        .then(response => {
                            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                            return response.text();
                        })
                        .then(html => {
                            let parser = new DOMParser();
                            let doc = parser.parseFromString(html, 'text/html');
                            let content = doc.getElementById('content');
                            if (!content) throw new Error('No element with ID "content" found');
                            $('#final_review').html(content);
                        })
                        .catch(error => console.error('Error fetching Fire Report:', error));
                        const newValue = 85;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", { status, error, response: xhr.responseText });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
        $(document).on('click', '#submitFinal', function(e){
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val(),
                application_no: $('input[name="application_no"]').val()
            };
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.seven.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {
                    if (response.status === "1") {
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#finalTabLink").addClass('active');
                        $("#finalTab").addClass('show active');
                        const newValue = 100;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                        $('#successBlock').html(response.msg).show();
                        $('#final_result').css("display","block");
                        $('#step_submit_form').css("display","none");
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", { status, error, response: xhr.responseText });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
    });
</script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_eIyP2oTRYMfeG3PdSDYFv8o5cYVI7ZA&libraries=places&callback=initMap" async defer></script>

<script>
    function initMap() {
  const defaultLocation = { lat: 30.3165, lng: 78.0322 }; // Dehradun

  map = new google.maps.Map(document.getElementById("map"), {
    center: defaultLocation,
    zoom: 13,
  });

  const input = document.getElementById("pac-input");
  const latInput = document.getElementById("lat");
  const lngInput = document.getElementById("lng");

  // Marker initialization with default position
  marker = new google.maps.Marker({
    map: map,
    position: defaultLocation,
    draggable: true,
    visible: true
  });

  // Set default lat/lng input values
  latInput.value = defaultLocation.lat;
  lngInput.value = defaultLocation.lng;

  const searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  map.addListener("bounds_changed", () => {
    searchBox.setBounds(map.getBounds());
  });

  searchBox.addListener("places_changed", () => {
    const places = searchBox.getPlaces();
    if (places.length === 0) return;

    const place = places[0];
    if (!place.geometry) return;

    const location = place.geometry.location;
    map.setCenter(location);
    map.setZoom(16);
    marker.setPosition(location);
    marker.setVisible(true);

    latInput.value = location.lat();
    lngInput.value = location.lng();
  });

  map.addListener("click", function (e) {
    const clickedLocation = e.latLng;
    marker.setPosition(clickedLocation);
    marker.setVisible(true);
    latInput.value = clickedLocation.lat();
    lngInput.value = clickedLocation.lng();
  });

  marker.addListener("dragend", function () {
    const pos = marker.getPosition();
    latInput.value = pos.lat();
    lngInput.value = pos.lng();
  });
}
    </script>


@stop
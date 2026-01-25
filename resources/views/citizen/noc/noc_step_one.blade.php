@extends('layouts.citizen.template')
@section('content')
<style>
    .error {
        color: red;
    }
</style>
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">Basic Details</h5>
    </div>
</div>
<!-- End Row -->


<div class="card custom-card" id="hori">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active">Basic Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Proprietary Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Area Details of Site</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Essential Provision</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Attachments</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Final Submit</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-wrap">
            <div class="progress mb-3 mt-3" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 2%;">2%</div>
            </div>
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

            <form method="POST" enctype="multipart/form-data" id="step_one_form" action="{{route('noc.step.first.post')}}">
                @csrf
                <div class="body-box-admin">
                    <fieldset>
                        <fieldset>
                            <div class="row">
                                <input type="hidden" id="application_no" name="application_no" value="{{ $application->application_no ?? ''}}">
                                <input type="hidden" name="application_type" id="application_type" value="pre establishment noc">
                                <input type="hidden" name="noc_type" id="noc_type" value="{{ $noc_type ?? ''}}">
                                <input type="hidden" name="pre_perational" id="pre_perational" value="{{$pre_perational}}">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Building Name <span class="span_required">*</span></label>
                                        <input type="text" class="form-control" id="building_name" name="building_name" placeholder="Building Name" value="{{ ucfirst(Auth::user()->building_name) ?? ''}}" required>
                                        @if($errors->has('building_name'))
                                        <div class="validation-error">{{ $errors->first('building_name') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Building Ownership भवन का स्वामित्व <span class="span_required">*</span></label>
                                        <div class="radio-toolbar">
                                            <input type="radio" id="owned" name="building_ownership" value="owned" checked>
                                            <label for="owned">Owned स्वयं की</label>
                                            <input type="radio" id="occupied" name="building_ownership" value="occupied">
                                            <label for="occupied">Occupied अधिभोगी</label>
                                        </div>
                                        @if($errors->has('ownership'))
                                        <div class="validation-error">{{ $errors->first('ownership') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right: 0;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">GST/PAN/TAN जीएसटी/पैन/टैन</label>
                                        <div class="radio-toolbar">
                                            <input type="radio" id="gst" name="gst_pan_tan" value="gst" checked>
                                            <label for="gst">GST</label>
                                            <input type="radio" id="pan" name="gst_pan_tan" value="pan">
                                            <label for="pan">PAN</label>
                                            <input type="radio" id="tan" name="gst_pan_tan" value="tan">
                                            <label for="tan">TAN</label>
                                        </div>
                                        @if($errors->has('gst_pan_tan'))
                                        <div class="validation-error">{{ $errors->first('gst_pan_tan') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">GST/PAN/TAN No. जीएसटी/पैन/टैन</label>
                                        <input type="text" class="form-control" id="gst_pan_tan_no" name="gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="{{ $application->gst_pan_tan_no ?? ''}}">
                                        @if($errors->has('gst_pan_tan_no'))
                                        <div class="validation-error">{{ $errors->first('gst_pan_tan_no') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Category Of Project परियोजना का वर्गीकरण<span class="span_required">*</span></label>
                                        <select class="form-control" name="project_type" id="project_id" required readonly>
                                            <option value="" style="display:none;">Select Project</option>
                                            @foreach ($projects as $prd)
                                            @php
                                                $nocfor='';
                                            @endphp 
                                            <option {{ $prd->id == $nocfor ? 'selected' : '' }} value="{{ $prd->id }}">{{ ucfirst($prd->name) }} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Building Category भवन का वर्गीकरण<span class="span_required">*</span></label>
                                        <select class="form-control  js-example-basic-single" name="category_id" id="category_id" required onclick="chooseCategory();">
                                            <option value="" style="display:none;">Select Category</option>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Sub Category Of Building भवन का उप-वर्गीकरण <span class="span_required">*</span></label>
                                        <select class="form-control  js-example-basic-single" name="subcategory_id" id="subcategory_id" required onclick="chooseType();">
                                            <option value="" style="display:none;">Select Sub Category</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Sub Type (Optional)</label>
                                        <select class="form-control  js-example-basic-single" name="type_id" id="type_id">
                                            <option value="" style="display:none;">Select Sub Category</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Project Status परियोजना की स्थिति<span class="span_required">*</span></label>
                                        <select class="form-control  js-example-basic-single" name="project_status" id="project_status" required>
                                            <option value="" style="display:none;">Select Project Status</option>
                                            <option value="New">New</option>
                                            <option value="Extension">Extension आवर्धन</option>
                                            <option value="Diversification">Diversification विवर्तन</option>
                                            <option value="Compounding">Compounding शमन</option>
                                        </select>
                                        @if($errors->has('project_status'))
                                        <div class="validation-error">{{ $errors->first('project_status') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="occupency_row">
                                <div class="col-md-12 col-sm-12 col-xs-12 occupency_heading" style="display:none;">
                                    <h3 style="padding:5px">Occupency Detail अधिभोग का विवरण</h3>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div1" style="display:none;">
                                    <div class="form-group">
                                        <label class="form-label">Number of Rooms कमरों की संख्या </label>
                                        <input type="number" class="form-control" id="no_of_rooms" name="no_of_rooms" placeholder="Number of Rooms" value="">
                                        @if($errors->has('no_of_rooms'))
                                        <div class="validation-error">{{ $errors->first('no_of_rooms') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div2" style="display:none;">
                                    <div class="form-group">
                                        <label class="form-label">Number of Flats फ्लैटों की संख्या </label>
                                        <input type="number" class="form-control" id="no_of_flats" name="no_of_flats" placeholder="Number of Flats" value="">
                                        @if($errors->has('no_of_flats'))
                                        <div class="validation-error">{{ $errors->first('no_of_flats') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div3" style="display:none;">
                                    <div class="form-group">
                                        <label class="form-label">Number of Beds बेडस् की संख्या </label>
                                        <input type="number" class="form-control" id="no_of_beds" name="no_of_beds" placeholder="Number of Beds" value="">
                                        @if($errors->has('no_of_beds'))
                                        <div class="validation-error">{{ $errors->first('no_of_beds') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div4" style="display:none;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">For Educationals शिक्षण संस्थानों का लिए<span class="span_required">*</span></label>

                                        <select class="form-control  js-example-basic-single" name="for_educational" id="for_educational">
                                            <option value="" style="display:none;">Select For Educational</option>
                                            <option value="kindergarten">Kindergarten</option>
                                            <option value="senior">Senior</option>
                                            <option value="secondary">Secondary</option>
                                            <option value="other">Other</option>
                                        </select>
                                        @if($errors->has('for_educational'))
                                        <div class="validation-error">{{ $errors->first('for_educational') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div5" style="display:none;">
                                    <div class="form-group">
                                        <label class="form-label">Seating Capacity बैठने की क्षमता</label>
                                        <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" placeholder="Seating Capacity" value="">
                                        @if($errors->has('seating_capacity'))
                                        <div class="validation-error">{{ $errors->first('seating_capacity') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div6" style="display:none;">
                                    <div class="form-group">
                                        <label class="form-label">Number of Employee कार्मिकों की संख्या</label>
                                        <input type="number" class="form-control" id="no_of_employee" name="no_of_employee" placeholder="Number of Employee" value="">
                                        @if($errors->has('no_of_employee'))
                                        <div class="validation-error">{{ $errors->first('no_of_employee') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div7" style="padding-right:0;display:none;">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Is any hazardous material used क्या कोई हैजार्डस् मैटीरियल का प्रयोग किया जायेगा<span class="span_required">*</span></label>

                                        <div class="radio-toolbar">
                                            <input type="radio" id="yes" name="is_hazardous_material" value="yes" onclick="chooseHazardous(this);">
                                            <label for="yes">Yes हाँ</label>
                                            <input type="radio" id="no" name="is_hazardous_material" value="no" onclick="chooseHazardous(this);">
                                            <label for="no">No नहीं</label>
                                        </div>
                                        @if($errors->has('is_hazardous_material'))
                                        <div class="validation-error">{{ $errors->first('is_hazardous_material') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-6 col-xs-12 occupency_div" id="occupency_div8" style="display:none;">
                                    <div class="form-group">
                                        <label class="form-label">Details of Hazardous Materials हैजार्डस् मैटीरियल का विवरण</label>
                                        <input type="text" class="form-control" id="hazardous_material" name="hazardous_material" placeholder="Details of Hazardous Materials" value="">
                                        @if($errors->has('hazardous_material'))
                                        <div class="validation-error">{{ $errors->first('hazardous_material') }}</div>
                                        @endif
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Latitude अक्षांश</label>
                                        <input type="number" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="{{ $application->latitude ?? ''}}" step="any" pattern="^\d*(\.\d{0,4})?$">
                                        @if($errors->has('latitude'))
                                        <div class="validation-error">{{ $errors->first('latitude') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Longitude देशान्तर</label>
                                        <input type="number" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="{{ $application->longitude ?? ''}}" step="any" pattern="^\d*(\.\d{0,4})?$">
                                        @if($errors->has('longitude'))
                                        <div class="validation-error">{{ $errors->first('longitude') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Email ई-मेल <span class="span_required">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email ?? ''}}" readonly required>
                                        @if($errors->has('email'))
                                        <div class="validation-error">{{ $errors->first('email') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Mobile No. मोबाइल नं0 <span class="span_required">*</span></label>
                                        <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="{{ Auth::user()->number ?? ''}}" readonly required maxlength="10" minlength="10">
                                        @if($errors->has('mobile_no'))
                                        <div class="validation-error">{{ $errors->first('mobile_no') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-label">Other Contact No. अन्य सम्पर्क नं0</label>
                                        <input type="number" class="form-control" id="office_telephone" name="office_telephone" placeholder="Other Telephone No." value="{{ $application->office_telephone ?? ''}}" maxlength="10" minlength="10">
                                        @if($errors->has('office_telephone'))
                                        <div class="validation-error">{{ $errors->first('office_telephone') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>Building Address भवन का पता:</legend>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">District जनपद<span class="span_required">*</span></label>
                                        <select class="form-control  js-example-basic-single" name="district_id" id="district_id" required>
                                            <option value="" style="display:none;">Select District जनपद</option>
                                            @foreach ($district as $dist)

                                            @if(Auth::user()->district_id !=$dist->id)
                                            <option value="{{ $dist->id }}" s>{{ ucfirst($dist->name) }} </option>
                                            @else
                                            <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                            @endif

                                            @endforeach
                                        </select>
                                        @if($errors->has('district_id'))
                                        <div class="validation-error">{{ $errors->first('district_id') }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="input-username">Urban नगर / Rural ग्रामीण<span class="span_required">*</span></label>
                                        <div class="radio-toolbar">

                                            <input type="radio" id="urban" name="rural_urban" value="urban" onclick="chooseRularUrban(this);" required>
                                            <label for="urban">Urban नगर</label>

                                            <input type="radio" id="rular" name="rural_urban" value="rural" onclick="chooseRularUrban(this);" required checked>
                                            <label for="rular">Rulal ग्रामीण</label>

                                        </div>
                                        @if($errors->has('rural_urban'))
                                        <div class="validation-error">{{ $errors->first('rural_urban') }}</div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div id="urban_div" style="display:none;">
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Tehsil तहसील <span class="span_required">*</span></label>
                                            <select class="form-control  js-example-basic-single" name="tehsil_id" id="tehsil_id" required>
                                                <option value="" style="display:none;">Select Tehsil तहसील चुनें</option>
                                            </select>
                                            @if($errors->has('tehsil_id'))
                                            <div class="validation-error">{{ $errors->first('tehsil_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0px;">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Choose Plot/ Khasra/ Khatoni <span class="span_required">*</span></label>
                                            <div class="radio-toolbar">
                                                <input type="radio" id="plot" name="plot_khasra_khatauni" value="plot" required>
                                                <label for="plot">Plot No.</label>
                                                <input type="radio" id="khasra" name="plot_khasra_khatauni" value="khasra" required>
                                                <label for="khasra">Khasra No.</label>
                                                <input type="radio" id="khatoni" name="plot_khasra_khatauni" value="khatoni" required>
                                                <label for="khatoni">Khatoni No.</label>
                                            </div>
                                            @if($errors->has('plot_khasra_khatauni'))
                                            <div class="validation-error">{{ $errors->first('plot_khasra_khatauni') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="plot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="{{ $application->plot_khasra_khatauni_no ?? ''}}" required>
                                            @if($errors->has('plot_khasra_khatauni_no'))
                                            <div class="validation-error">{{ $errors->first('plot_khasra_khatauni_no') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Street गली <span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="{{ $application->street ?? ''}}" required>
                                            @if($errors->has('street'))
                                            <div class="validation-error">{{ $errors->first('street') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Landmark लेण्डमार्क <span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" value="{{ $application->landmark ?? ''}}" required>
                                            @if($errors->has('landmark'))
                                            <div class="validation-error">{{ $errors->first('landmark') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">City शहर <span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $application->city ?? ''}}" required>
                                            @if($errors->has('city'))
                                            <div class="validation-error">{{ $errors->first('city') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Pincode पिनकोड <span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{ $application->pincode ?? ''}}" maxlength="6" minlength="6" required>
                                            @if($errors->has('pincode'))
                                            <div class="validation-error">{{ $errors->first('pincode') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="rular_div" style="display:none;">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Block विकासखण्ड <span class="span_required">*</span></label>
                                            <select class="form-control  js-example-basic-single" name="block_id" id="block_id" required>
                                                <option value="" style="display:none;">Select Block विकासखण्ड चुनें</option>

                                            </select>
                                            @if($errors->has('block_id'))
                                            <div class="validation-error">{{ $errors->first('block_id') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Panchayat पंचायत<span class="span_required">*</span></label>
                                            <select class="form-control  js-example-basic-single" name="panchayat_id" id="panchayat_id" required>
                                                <option value="" style="display:none;">Select Panchayat</option>

                                            </select>
                                            @if($errors->has('panchayat_id'))
                                            <div class="validation-error">{{ $errors->first('panchayat_id') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Village ग्राम<span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="village" name="village" placeholder="Village" value="{{ $application->village ?? ''}}" required>
                                            @if($errors->has('village'))
                                            <div class="validation-error">{{ $errors->first('village') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0px">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Choose Plot/Khasra/Khatoni <span class="span_required">*</span></label>
                                            <div class="radio-toolbar">
                                                <input type="radio" id="plot1" name="plot_khasra_khatauni" value="plot" required>
                                                <label for="plot1">Plot No.</label>
                                                <input type="radio" id="khasra1" name="plot_khasra_khatauni" value="khasra" required>
                                                <label for="khasra1">Khasra No.</label>
                                                <input type="radio" id="khatoni1" name="plot_khasra_khatauni" value="khatoni" required>
                                                <label for="khatoni1">Khatoni No.</label>
                                            </div>
                                            @if($errors->has('plot_khasra_khatauni'))
                                            <div class="validation-error">{{ $errors->first('plot_khasra_khatauni') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="plot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="{{ $application->plot_khasra_khatauni_no ?? ''}}" required>
                                            @if($errors->has('plot_khasra_khatauni_no'))
                                            <div class="validation-error">{{ $errors->first('plot_khasra_khatauni_no') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Landmark लैण्डमार्क <span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" value="{{ $application->landmark ?? ''}}" required>
                                            @if($errors->has('landmark'))
                                            <div class="validation-error">{{ $errors->first('landmark') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Pincode पिनकोड<span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{ $application->pincode ?? ''}}" maxlength="6" minlength="6" required>
                                            @if($errors->has('pincode'))
                                            <div class="validation-error">{{ $errors->first('pincode') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                    </fieldset>
                    <div class="row">
                        <div class="col-lg-6 text-right mt-3">
                            <a href="{{route('noc')}}" class="save-btn hover-btn btn btn-primary">Cancel</a>
                        </div>
                        <div class="col-lg-6 text-right mt-3">
                            <button class="save-btn hover-btn btn btn-primary" type="submit" style="float:right;">Save and Next</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
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
                url: "getCategoryByProject",
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
                url: "getSubcategoryByCategory",
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
                url: "getTypeBySubcategory",
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
                url: "getTehsilByDistrict",
                data: {
                    district_id: district_id
                },
                success: function(response) {
                    $('#tehsil_id').html(response)
                },
            });
        });
        $(document).on('change', '#district_id', function() {
            var district_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "getBlockByDistrict",
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
        getProjectType();
    });

    function getProjectType() {
        var project_id = $('#project_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "getCategoryByProject",
            data: {
                project_id: project_id
            },
            success: function(response) {
                $('#category_id').html(response)
            },
        });
    }
</script>
@stop
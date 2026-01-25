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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">Proprietary Details:</h5>
    </div>
</div>
<!-- End Row -->


<div class="card custom-card" id="hori">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Basic Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active">Proprietary Details</a>
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
            <div class="progress mb-3 mt-3" role="progressbar" aria-valuenow="16.67" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 16.67%;">16.67%</div>
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

            <form action="{{route('noc.step.second.post')}}" id="step_two_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="body-box-admin">
                    <fieldset>
                        <div class="row">
                            <input type="hidden" name="pre_perational" id="pre_perational" value="{{$applicationDetail[0]->pre_perational ?? ''}}">
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <!--   <label class="form-control-label" >Proprietary Rights <span class="span_required">*</span></label> -->
                                    <div class="radio-toolbar">
                                        <input type="radio" id="single" name="proprietary_rights" value="single" checked onclick="singlePartner(this);">
                                        <label for="single">Single एकल</label>
                                        <input type="radio" id="partnership" name="proprietary_rights" value="partnership" onclick="singlePartner(this);">
                                        <label for="partnership">Partnership संयुक्त या भागीदारी</label>
                                    </div>
                                    @if($errors->has('proprietary_rights'))
                                    <div class="validation-error">{{ $errors->first('proprietary_rights') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="application_no" name="application_no" value="{{ $applicationDetail[0]->application_no ?? ''}}">
                        <fieldset id="single_proprietary" style="display:none;">
                            <legend>Name Of Owner स्वामी का नाम</legend>
                            <div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label" for="salutation">Salutation<span class="span_required">*</span></label>
                                            <select class="form-control js-example-basic-single" name="salutation" id="salutation" required>
                                                <option value="" disabled selected>Select</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Ms">Ms</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                            @if($errors->has('salutation'))
                                            <div class="validation-error">{{ $errors->first('salutation') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" id="application_no" name="application_no" value="{{ $applicationDetail[0]->application_no }}">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">First Name पर्थम नाम<span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ json_decode($applicationDetail[0]->owner_detail)->first_name ?? '' }}" required>
                                            @if($errors->has('first_name')) required
                                            <div class="validation-error">{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Middle Name मध्य नाम</label>
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ json_decode($applicationDetail[0]->owner_detail)->middle_name ?? '' }}">
                                            @if($errors->has('middle_name'))
                                            <div class="validation-error">{{ $errors->first('middle_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Last Name अन्तिम नाम</label>
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ json_decode($applicationDetail[0]->owner_detail)->last_name ?? ''}}">
                                            @if($errors->has('last_name'))
                                            <div class="validation-error">{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="{{ json_decode($applicationDetail[0]->owner_detail)->mobile_no ?? '' }}" required>
                                            @if($errors->has('mobile_no'))
                                            <div class="validation-error">{{ $errors->first('mobile_no') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Email Address ई-मेल<span class="span_required">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ json_decode($applicationDetail[0]->owner_detail)->email ?? '' }}" required>
                                            @if($errors->has('con_email'))
                                            <div class="validation-error">{{ $errors->first('con_email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Percentage Share भागीदारी पर्तिशत<span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="percentage_share" name="percentage_share" placeholder="Percentage Share" value="{{ json_decode($applicationDetail[0]->owner_detail)->percentage_share ?? '' }}" required>
                                            @if($errors->has('percentage_share'))
                                            <div class="validation-error">{{ $errors->first('percentage_share') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Is this person the point of contact क्या यह व्यक्ति सम्परक् किये जाने हेतु है<span class="span_required">*</span></label>
                                            <div class="radio-toolbar">
                                                <input type="radio" id="owner_yes" name="point_of_contact" value="yes" onclick="contactPerson(this.value);" required>
                                                <label for="owner_yes">Yes</label>
                                                <input type="radio" id="owner_no" name="point_of_contact" value="no" checked="checked" onclick="contactPerson(this.value);" required>
                                                <label for="owner_no">No</label>
                                            </div>
                                            @if($errors->has('point_of_contact'))
                                            <div class="validation-error">{{ $errors->first('point_of_contact') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset id="partmership_proprietary" style="display:none;">
                            <legend>Partners Detail भागीदरों का विवरण</legend>
                            <div class="input_fields_wrap">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Salutation<span class="span_required">*</span></label>
                                            <select class="form-control js-example-basic-single" name="p_salutation[]" id="p_salutation" required>
                                                <option value="" disabled selected>Select Salutation</option>
                                                <option value="Mr">Mr</option>
                                                <option value="Ms">Ms</option>
                                                <option value="Mrs">Mrs</option>
                                            </select>
                                            @if($errors->has('salutation1'))
                                            <div class="validation-error">{{ $errors->first('salutation1') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                                            <input type="text" class="form-control" id="p_first_name" name="p_first_name[]" placeholder="First Name" value="{{  '' }}">
                                            @if($errors->has('first_name'))
                                            <div class="validation-error">{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Middle Name मध्य नाम</label>
                                            <input type="text" class="form-control" id="p_middle_name" name="p_middle_name[]" placeholder="Middle Name" value="{{  '' }}">
                                            @if($errors->has('middle_name'))
                                            <div class="validation-error">{{ $errors->first('middle_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Last Name अन्तिम नाम</label>
                                            <input type="text" class="form-control" id="p_last_name" name="p_last_name[]" placeholder="Last Name" value="{{ ''}}">
                                            @if($errors->has('last_name'))
                                            <div class="validation-error">{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="p_mobile_no" name="p_mobile_no[]" placeholder="Mobile No." value="{{ '' }}">
                                            @if($errors->has('mobile_no'))
                                            <div class="validation-error">{{ $errors->first('mobile_no') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-label">Percentage Share भागीदारी प्रतिशत<span class="span_required">*</span></label>
                                            <input type="number" class="form-control" id="p_percentage_share" name="p_percentage_share[]" placeholder="Percentage Share" value="">
                                            @if($errors->has('percentage_share'))
                                            <div class="validation-error">{{ $errors->first('percentage_share') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6  col-sm-6 col-xs-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Is this person the point of contact क्या यह व्यक्ति सम्परक् किये जाने हेतु है <span class="span_required">*</span></label>
                                            <div class="radio-toolbar">
                                                <input type="radio" id="yes_1" name="p_point_of_contact[]" value="yes">
                                                <label for="yes_1">Yes</label>
                                                <input type="radio" id="no_1" name="p_point_of_contact[]" value="no">
                                                <label for="no_1">No</label>
                                            </div>
                                            @if($errors->has('point_of_contact'))
                                            <div class="validation-error">{{ $errors->first('point_of_contact') }}</div>
                                            @endif
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
                        </fieldset>
                    </fieldset>
                    <fieldset>
                        <legend>Contact Person Details सम्पर्क हेतु व्यक्ति का विवरण:</legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Appointed as<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="person_appointed" id="person_appointed" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Director">Director</option>
                                        <option value="CEO">CEO</option>
                                        <option value="Proprietor">Proprietor</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    @if($errors->has('person_appointed'))
                                    <div class="validation-error">{{ $errors->first('person_appointed') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Salutation<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="con_salutation" id="con_salutation" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                    @if($errors->has('con_salutation'))
                                    <div class="validation-error">{{ $errors->first('con_salutation') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="con_first_name" name="con_first_name" placeholder="First Name" value="{{ json_decode($applicationDetail[0]->contact_person)->con_first_name ?? '' }}">
                                    @if($errors->has('con_first_name'))
                                    <div class="validation-error">{{ $errors->first('con_first_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Middle Name मध्य नाम</label>
                                    <input type="text" class="form-control" id="con_middle_name" name="con_middle_name" placeholder="Middle Name" value="{{ json_decode($applicationDetail[0]->contact_person)->con_middle_name ?? '' }}">
                                    @if($errors->has('con_middle_name'))
                                    <div class="validation-error">{{ $errors->first('con_middle_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Last Name अन्तिम नाम</label>
                                    <input type="text" class="form-control" id="con_last_name" name="con_last_name" placeholder="Last Name" value="{{ json_decode($applicationDetail[0]->contact_person)->con_last_name ?? '' }}">
                                    @if($errors->has('con_last_name'))
                                    <div class="validation-error">{{ $errors->first('con_last_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="con_mobile_no" name="con_mobile_no" placeholder="Mobile No." value="{{json_decode($applicationDetail[0]->contact_person)->con_mobile_no ?? '' }}">
                                    @if($errors->has('con_mobile_no'))
                                    <div class="validation-error">{{ $errors->first('con_mobile_no') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Email Address ई-मेल<span class="span_required">*</span></label>
                                    <input type="email" class="form-control" id="con_email" name="con_email" placeholder="Email Address" value="{{ json_decode($applicationDetail[0]->contact_person)->con_email ?? '' }}">
                                    @if($errors->has('con_email'))
                                    <div class="validation-error">{{ $errors->first('con_email') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset id="arc">
                        <legend>Architect Details आर्किटेक्ट का विवरण:</legend>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Salutation<span class="span_required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="arc_salutation" id="arc_salutation" required>
                                        <option value="" disabled selected>Select</option>
                                        <option value="Mr">Mr</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Mrs">Mrs</option>
                                    </select>
                                    @if($errors->has('arc_salutation'))
                                    <div class="validation-error">{{ $errors->first('arc_salutation') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="arc_first_name" name="arc_first_name" placeholder="First Name" value="{{ json_decode($applicationDetail[0]->architect_detail)->arc_first_name ?? '' }}">
                                    @if($errors->has('arc_first_name'))
                                    <div class="validation-error">{{ $errors->first('arc_first_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Middle Name मध्य नाम</label>
                                    <input type="text" class="form-control" id="arc_middle_name" name="arc_middle_name" placeholder="Middle Name" value="{{json_decode($applicationDetail[0]->architect_detail)->arc_middle_name ?? '' }}">
                                    @if($errors->has('arc_middle_name'))
                                    <div class="validation-error">{{ $errors->first('arc_middle_name') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Last Name अन्तिम नाम</label>
                                    <input type="text" class="form-control" id="arc_last_name" name="arc_last_name" placeholder="Last Name" value="{{ json_decode($applicationDetail[0]->architect_detail)->arc_last_name ?? '' }}">
                                    @if($errors->has('arc_last_name'))
                                    <div class="validation-error">{{ $errors->first('arc_last_name') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6  col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Name Of Firm फर्म का नाम</label>
                                    <input type="text" class="form-control" id="name_of_firm" name="name_of_firm" placeholder="Name Of Firm" value="{{ json_decode($applicationDetail[0]->architect_detail)->name_of_firm ?? '' }}">
                                    @if($errors->has('name_of_firm'))
                                    <div class="validation-error">{{ $errors->first('name_of_firm') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="architect_mobile_no" name="architect_mobile_no" placeholder="Mobile No." value="{{json_decode($applicationDetail[0]->architect_detail)->architect_mobile_no ?? '' }}">
                                    @if($errors->has('architect_mobile_no'))
                                    <div class="validation-error">{{ $errors->first('architect_mobile_no') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Email ई-मेल<span class="span_required">*</span></label>
                                    <input type="text" class="form-control" id="architect_email" name="architect_email" placeholder="Email" value="{{ json_decode($applicationDetail[0]->architect_detail)->architect_email ?? '' }}">
                                    @if($errors->has('architect_email'))
                                    <div class="validation-error">{{ $errors->first('architect_email') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label">GST/PAN/TAN जीएसटी/पैन/टैन</label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="first_gst" name="firm_gst_pan_tan" value="gst" checked="checked">
                                        <label for="first_gst">GST</label>
                                        <input type="radio" id="first_pan" name="firm_gst_pan_tan" value="pan">
                                        <label for="first_pan">PAN</label>
                                        <input type="radio" id="first_tan" name="firm_gst_pan_tan" value="tan">
                                        <label for="first_tan">TAN</label>
                                    </div>
                                    @if($errors->has('firm_gst_pan_tan'))
                                    <div class="validation-error">{{ $errors->first('firm_gst_pan_tan') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">GST/PAN/TAN No.जीएसटी/पैन/टैन</label>
                                    <input type="text" class="form-control" id="firm_gst_pan_tan_no" name="firm_gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="{{ json_decode($applicationDetail[0]->architect_detail)->firm_gst_pan_tan_no ?? '' }}">
                                    @if($errors->has('firm_gst_pan_tan_no'))
                                    <div class="validation-error">{{ $errors->first('firm_gst_pan_tan_no') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });

    function contactPerson(value) {
        var contactPerson = $("input[name='point_of_contact']:checked").val();
        if (contactPerson == 'yes') {
            $('#con_salutation').val($('#salutation').val());
            $('#con_first_name').val($('#first_name').val());
            $('#con_middle_name').val($('#middle_name').val());
            $('#con_last_name').val($('#last_name').val());
            $('#con_mobile_no').val($('#mobile_no').val());
            $('#con_email').val($('#email').val());
        } else {
            $('#con_first_name').val('');
            $('#con_middle_name').val('');
            $('#con_last_name').val('');
            $('#con_mobile_no').val('');
            $('#con_email').val('');
        }
    }

    var a = 1;

    function add_field_button() {
        var output = '<div class="row mt-2" id="partner_' + a + '"><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-control-label" >Salutation<span class="span_required">*</span></label><select class="form-control"  name="p_salutation[]" id="p_salutation" required><option value="" disabled selected>Select Salutation</option><option value="Mr">Mr</option><option value="Ms">Ms</option><option value="Mrs">Mrs</option></select></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">First Name<span class="span_required">*</span></label><input type="text" class="form-control" id="p_first_name" name="p_first_name[]" placeholder="First Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Middle Name</label><input type="text" class="form-control" id="p_middle_name" name="p_middle_name[]" placeholder="Middle Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Last Name</label><input type="text" class="form-control" id="p_last_name" name="p_last_name[]" placeholder="Last Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-control-label" >Mobile No.<span class="span_required">*</span></label><input type="number" class="form-control" id="p_mobile_no" name="p_mobile_no[]" placeholder="Mobile No." value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Percentage Share<span class="span_required">*</span></label><input type="number" class="form-control" id="p_percentage_share" name="p_percentage_share[]" placeholder="Percentage Share" value=""></div></div><div class=" col-md-4 col-sm-6 col-xs-12"><a href="#" class="btn btn-danger col-md-4 remove_field" id="' + a + '" onclick="removePartnerRow(this.id)">Remove</a></div></div>';
        var newRow = $(output);
        $(".input_fields_wrap").append(newRow);
        a++;
    };

    function removePartnerRow(e) {
        $('#partner_' + e).remove();
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // Initialize form validation
        $('#step_two_form').validate({
            errorPlacement: function(error, element) {
                // Place the error message after the label
                error.insertAfter(element.prev('label'));
            },
        });
    });
</script>
@stop
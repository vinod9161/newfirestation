@extends('layouts.citizen.template')
@section('title')
<title>Declaration | Citizen Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    .span_required {
        color: #ff0000;
    }

    .error {
        color: red;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        color: #fff;
        background-color: #8760fb;
        border-color: var(--default-border);
    }

    .nav.nav-style-4 .nav-link.active {
        background-color: #8760fb;
        color: #fff;
        border: 0;
    }

    .nav.nav-style-4 .nav-link {
        border-bottom-left-radius: .375rem;
        border-bottom-right-radius: .375rem;
        margin-bottom: .5rem;
    }
</style>
@endsection
@section('content')
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">NOC For Temporary Permission of Helipad</h5>
    </div>
</div>
<!-- End Row -->
<div class="row">
    <div class="card custom-card">
        <div class="card-body">
            <div class="row">

                <div class="text-wrap">
                    <div class="example">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            <li class="nav-item basic active" role="presentation">
                                <a class="nav-link active tab1" data-bs-toggle="tab" role="tab" href="#tab1" aria-selected="false" tabindex="-1">Basic Details</a>
                            </li>
                            <li class="nav-item applicant" role="presentation">
                                <a class="nav-link tab2" data-bs-toggle="tab" role="tab" href="#tab2" aria-selected="false" tabindex="-1">Applicant Detail</a>
                            </li>
                            <li class="nav-item organizing" role="presentation">
                                <a class="nav-link tab3" data-bs-toggle="tab" role="tab" href="#tab3" aria-selected="true">Organizing Place and Address</a>
                            </li>
                            <li class="nav-item orgnizer" role="presentation">
                                <a class="nav-link tab4" data-bs-toggle="tab" role="tab" href="#tab4" aria-selected="false" tabindex="-1">Orgnizer Contact Detail</a>
                            </li>
                            <li class="nav-item erector" role="presentation">
                                <a class="nav-link tab5" data-bs-toggle="tab" role="tab" href="#tab5" aria-selected="false" tabindex="-1">Erector Contact Detail</a>
                            </li>
                            <li class="nav-item coordinator" role="presentation">
                                <a class="nav-link tab6" data-bs-toggle="tab" role="tab" href="#tab6" aria-selected="false" tabindex="-1">Coordinator Contact Detail</a>
                            </li>
                            <li class="nav-item project" role="presentation">
                                <a class="nav-link tab7" data-bs-toggle="tab" role="tab" href="#tab7" aria-selected="false" tabindex="-1">Project / Area Detail</a>
                            </li>
                            <li class="nav-item attachments" role="presentation">
                                <a class="nav-link tab8" data-bs-toggle="tab" role="tab" href="#tab8" aria-selected="false" tabindex="-1">Attachments</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="alert alert-success" id="successBlock" style="display:none;"></div>
                            <div class="alert alert-danger" id="errorBlock" style="display:none;"></div>
                            <input type="hidden" id="application_no" value="">
                            <div class="tab-pane show active text-muted" id="tab1" role="tabpanel">
                                <form method="POST" id="basic_details">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Applicant Type<span class="span_required">*</span></label>
                                                <select class="form-control js-example-basic-multiple" name="applicant_type" id="applicant_type">
                                                    <option value="" disabled selected>Select Applicant Type</option>
                                                    <option value="Owner">Owner</option>
                                                    <option value="Organizer">Organizer</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <span class="error" id="error1"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-7 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formBasicDetails()">Save And Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane text-muted" id="tab2" role="tabpanel">
                                <form method="POST" id="applicant_details">
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="salutation">Salutation<span class="span_required">*</span></label>
                                                <select class="form-control" name="salutation" id="salutation">
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                                <span class="error" id="error2"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name<span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="">
                                                <span class="error" id="error3"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="span_required">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $application->email ?? ''}}">
                                                <span class="error" id="error4"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile No. <span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="{{ $application->mobile_no ?? ''}}" maxlength="10" minlength="10">
                                                <span class="error" id="error5"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="mt-5" style="background: #5678f4;padding: 6px;width: 100%; color: white;">Address of Applicant</label>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">District<span class="span_required">*</span></label>
                                                <select class="form-control" name="district_id" id="district_id">
                                                    <option value="" disabled selected>Select District</option>
                                                    @foreach ($districts as $dist)
                                                    <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                                    @endforeach
                                                </select>
                                                <span class="error" id="error6"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Urban / Rural <span class="span_required">*</span></label>
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="urban" name="rural_urban" value="urban" onclick="chooseRularUrban(this);" style="height: auto">
                                                    <label for="urban">Urban</label>
                                                    <input type="radio" id="rular" name="rural_urban" value="rural" onclick="chooseRularUrban(this);" style="height: auto">
                                                    <label for="rural">Rural</label>
                                                </div>
                                                <span class="error" id="error7"></span>
                                            </div>
                                        </div>
                                        <div id="urban_div" style="display:none;">
                                            <div class="row">
                                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Tehsil <span class="span_required">*</span></label>
                                                        <select class="form-control" name="tehsil_id" id="tehsil_id">
                                                            <option value="" disabled selected>Select Tehsil</option>
                                                        </select>
                                                        <span class="error" id="error8"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Street <span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="">
                                                        <span class="error" id="error9"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Landmark <span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" value="">
                                                        <span class="error" id="error10"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">City <span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="city" name="city" placeholder="City" value="">
                                                        <span class="error" id="error11"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0px;">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Choose Plot/ Khasra/ Khatoni <span class="span_required">*</span></label>
                                                        <div class="radio-toolbar" style="margin-left: 20px;">
                                                            <input type="radio" id="plot" name="plot_khasra_khatauni" value="plot" style="height: auto">
                                                            <label for="plot" style="margin-right: 10px;">Plot No.</label>
                                                            <input type="radio" id="khasra" name="plot_khasra_khatauni" value="khasra" style="height: auto">
                                                            <label for="khasra" style="margin-right: 10px;">Khasra No.</label>
                                                            <input type="radio" id="khatoni" name="plot_khasra_khatauni" value="khatoni" style="height: auto">
                                                            <label for="khatoni">Khatoni No.</label>
                                                        </div>
                                                        <span class="error" id="error12"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="plot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="">
                                                        <span class="error" id="error13"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Pincode <span class="span_required">*</span></label>
                                                        <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="" maxlength="6" minlength="6">
                                                        <span class="error" id="error14"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="rular_div" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Block <span class="span_required">*</span></label>
                                                        <select class="form-control" name="block_id" id="block_id">
                                                            <option value="" disabled selected>Select Block</option>
                                                        </select>
                                                        <span class="error" id="error15"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Panchayat<span class="span_required">*</span></label>
                                                        <select class="form-control" name="panchayat_id" id="panchayat_id">
                                                            <option value="" disabled selected>Select Panchayat</option>
                                                        </select>
                                                        <span class="error" id="error16"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Village<span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="village" name="village" placeholder="Village" value="">
                                                        <span class="error" id="error17"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Landmark <span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="rlandmark" name="landmark" placeholder="Landmark" value="">
                                                        <span class="error" id="error18"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0px;">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Choose Plot/ Khasra/ Khatoni <span class="span_required">*</span></label>
                                                        <div class="radio-toolbar" style="margin-left: 20px;">
                                                            <input type="radio" id="plot1" name="plotkhasrakhatauni" value="plot" style="height: auto">
                                                            <label for="plot1" style="margin-right: 10px;">Plot No.</label>
                                                            <input type="radio" id="khasra1" name="plotkhasrakhatauni" value="khasra" style="height: auto">
                                                            <label for="khasra1" style="margin-right: 10px;">Khasra No.</label>
                                                            <input type="radio" id="khatoni1" name="plotkhasrakhatauni" value="khatoni" style="height: auto">
                                                            <label for="khatoni1">Khatoni No.</label>
                                                        </div>
                                                        <span class="error" id="error19"></span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-left:0px">
                                                    <div class="form-group">
                                                        <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="rplot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="">
                                                        <span class="error" id="error20"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Pincode <span class="span_required">*</span></label>
                                                        <input type="number" class="form-control" id="rpincode" name="pincode" placeholder="Pincode" value="" maxlength="6" minlength="6">
                                                        <span class="error" id="error21"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formApplicantDetails()">Save And Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane text-muted" id="tab3" role="tabpanel">
                                <form method="POST" id="organizing">
                                    <div class="row" style="margin-top:0px">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">District<span class="span_required">*</span></label>
                                                <select class="form-control" name="org_district_id" id="org_district_id">
                                                    <option value="" disabled selected>Select District</option>
                                                    @foreach ($districts as $dist)
                                                    <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                                    @endforeach
                                                </select>
                                                <span class="error" id="error22"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Urban / Rural <span class="span_required">*</span></label>
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="org_urban" name="org_rural_urban" value="urban" onclick="chooseRularUrbanOrg(this);" style="height: auto">
                                                    <label for="org_urban">Urban</label>
                                                    <input type="radio" id="org_rular" name="org_rural_urban" value="rural" onclick="chooseRularUrbanOrg(this);" style="height: auto">
                                                    <label for="org_rular">Rural</label>
                                                </div>
                                                <span class="error" id="error23"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="org_urban_div" style="display:none;">
                                        <div class="row">
                                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Tehsil <span class="span_required">*</span></label>
                                                    <select class="form-control" name="org_tehsil_id" id="org_tehsil_id">
                                                        <option value="" disabled selected>Select Tehsil</option>
                                                    </select>
                                                    <span class="error" id="error24"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">Street <span class="span_required">*</span></label>
                                                    <input type="text" class="form-control" id="org_street" name="org_street" placeholder="Street" value="">
                                                    <span class="error" id="error25"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">Landmark <span class="span_required">*</span></label>
                                                    <input type="text" class="form-control" id="org_landmark" name="org_landmark" placeholder="Landmark" value="">
                                                    <span class="error" id="error26"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">City <span class="span_required">*</span></label>
                                                    <input type="text" class="form-control" id="org_city" name="org_city" placeholder="City" value="">
                                                    <span class="error" id="error27"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0px;">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Choose Plot/ Khasra/ Khatoni <span class="span_required">*</span></label>
                                                    <div class="radio-toolbar" style="margin-left: 20px;">
                                                        <input type="radio" id="org_plot" name="org_plot_khasra_khatauni" value="plot" style="height: auto">
                                                        <label for="org_plot" style="margin-right: 10px;">Plot No.</label>
                                                        <input type="radio" id="org_khasra" name="org_plot_khasra_khatauni" value="khasra" style="height: auto">
                                                        <label for="org_khasra" style="margin-right: 10px;">Khasra No.</label>
                                                        <input type="radio" id="org_khatoni" name="org_plot_khasra_khatauni" value="khatoni" style="height: auto">
                                                        <label for="org_khatoni">Khatoni No.</label>
                                                    </div>
                                                    <span class="error" id="error28"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                                                    <input type="text" class="form-control" id="org_plot_khasra_khatauni_no" name="org_plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="">
                                                    <span class="error" id="error29"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">Pincode <span class="span_required">*</span></label>
                                                    <input type="number" class="form-control" id="org_pincode" name="org_pincode" placeholder="Pincode" value="" maxlength="6" minlength="6">
                                                    <span class="error" id="error30"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="org_rular_div" style="display:none;">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Block <span class="span_required">*</span></label>
                                                    <select class="form-control" name="org_block_id" id="org_block_id">
                                                        <option value="" disabled selected>Select Block</option>
                                                    </select>
                                                    <span class="error" id="error31"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Panchayat<span class="span_required">*</span></label>
                                                    <select class="form-control" name="org_panchayat_id" id="org_panchayat_id">
                                                        <option value="" disabled selected>Select Panchayat</option>
                                                    </select>
                                                    <span class="error" id="error32"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">Village<span class="span_required">*</span></label>
                                                    <input type="text" class="form-control" id="org_village" name="org_village" placeholder="Village" value="">
                                                    <span class="error" id="error33"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">Landmark <span class="span_required">*</span></label>
                                                    <input type="text" class="form-control" id="org_rlandmark" name="org_rlandmark" placeholder="Landmark" value="">
                                                    <span class="error" id="error34"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0px;">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="input-username">Choose Plot/ Khasra/ Khatoni <span class="span_required">*</span></label>
                                                    <div class="radio-toolbar" style="margin-left: 20px;">
                                                        <input type="radio" id="org_plot1" name="org_rplot_khasra_khatauni" value="plot" style="height: auto">
                                                        <label for="org_plot1" style="margin-right: 10px;">Plot No.</label>
                                                        <input type="radio" id="org_khasra1" name="org_rplot_khasra_khatauni" value="khasra" style="height: auto">
                                                        <label for="org_khasra1" style="margin-right: 10px;">Khasra No.</label>
                                                        <input type="radio" id="org_khatoni1" name="org_rplot_khasra_khatauni" value="khatoni" style="height: auto">
                                                        <label for="org_khatoni1">Khatoni No.</label>
                                                    </div>
                                                    <span class="error" id="error35"></span>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-left:0px">
                                                <div class="form-group">
                                                    <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                                                    <input type="text" class="form-control" id="org_rplot_khasra_khatauni_no" name="org_rplot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="">
                                                    <span class="error" id="error36"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-12">
                                                <div class="form-group">
                                                    <label class="form-label">Pincode <span class="span_required">*</span></label>
                                                    <input type="number" class="form-control" id="org_rpincode" name="org_rpincode" placeholder="Pincode" value="" maxlength="6" minlength="6">
                                                    <span class="error" id="error37"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Latitude</label>
                                                <input type="number" class="form-control" id="org_latitude" name="org_latitude" placeholder="Latitude" value="{{ $application->latitude ?? ''}}">
                                                <span class="error" id="error38"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Longitude</label>
                                                <input type="number" class="form-control" id="org_longitude" name="org_longitude" placeholder="Longitude" value="{{ $application->longitude ?? ''}}">
                                                <span class="error" id="error39"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formOrganizingDetails()">Save And Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane text-muted" id="tab4" role="tabpanel">
                                <form method="POST" id="orgnizer">
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="org_salutation">Salutation<span class="span_required">*</span></label>
                                                <select class="form-control"  name="org_salutation" id="org_salutation">
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                                <span class="error" id="error40"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name<span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="org_first_name" name="org_first_name" placeholder="First Name" value="">
                                                <span class="error" id="error41"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="org_middle_name" name="org_middle_name" placeholder="Middle Name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="org_last_name" name="org_last_name" placeholder="Last Name" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Name of Organizing Firm <span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="org_name" name="org_name" placeholder="Name" value="{{ $application->org_name ?? ''}}">
                                                <span class="error" id="error42"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="span_required">*</span></label>
                                                <input type="email" class="form-control" id="org_email" name="org_email" placeholder="Email" value="{{ $application->org_email ?? ''}}">
                                                <span class="error" id="error43"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile No. <span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="org_mobile_no" name="org_mobile_no" placeholder="Mobile No." value="{{ $application->org_mobile_no ?? ''}}" maxlength="10" minlength="10">
                                                <span class="error" id="error44"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formOrganizerDetails()">Save And Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane text-muted" id="tab5" role="tabpanel">
                                <form method="POST" id="erector">
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="ere_salutation">Salutation<span class="span_required">*</span></label>
                                                <select class="form-control"  name="ere_salutation" id="ere_salutation">
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                                <span class="error" id="error45"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name<span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="ere_first_name" name="ere_first_name" placeholder="First Name" value="">
                                                <span class="error" id="error46"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="ere_middle_name" name="ere_middle_name" placeholder="Middle Name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="ere_last_name" name="ere_last_name" placeholder="Last Name" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Name of Erector Firm <span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="ere_name" name="ere_name" placeholder="Name" value="{{ $application->ere_name ?? ''}}">
                                                <span class="error" id="error47"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="span_required">*</span></label>
                                                <input type="email" class="form-control" id="ere_email" name="ere_email" placeholder="Email" value="{{ $application->ere_email ?? ''}}">
                                                <span class="error" id="error48"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile No. <span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="ere_mobile_no" name="ere_mobile_no" placeholder="Mobile No." value="{{ $application->ere_mobile_no ?? ''}}" maxlength="10" minlength="10">
                                                <span class="error" id="error49"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formErectorDetails()">Save And Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane text-muted" id="tab6" role="tabpanel">
                                <form method="POST" id="coordinator">
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="coor_salutation">Salutation<span class="span_required">*</span></label>
                                                <select class="form-control"  name="coor_salutation" id="coor_salutation">
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                                <span class="error" id="error50"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name<span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="coor_first_name" name="coor_first_name" placeholder="First Name" value="">
                                                <span class="error" id="error51"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="coor_middle_name" name="coor_middle_name" placeholder="Middle Name" value="">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="coor_last_name" name="coor_last_name" placeholder="Last Name" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="span_required">*</span></label>
                                                <input type="email" class="form-control" id="coor_email" name="coor_email" placeholder="Email" value="{{ $application->coor_email ?? ''}}">
                                                <span class="error" id="error52"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile No. <span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="coor_mobile_no" name="coor_mobile_no" placeholder="Mobile No." value="{{ $application->coor_mobile_no ?? ''}}" maxlength="10" minlength="10">
                                                <span class="error" id="error53"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formCoordinatorDetails()">Save And Next</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane text-muted" id="tab7" role="tabpanel">
                                <form method="POST" id="project">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Type of Project<span class="span_required">*</span></label>
                                                <select class="form-control"  name="project_type" id="project_type">
                                                    <option value="" disabled selected>Select Type</option>
                                                    <option value="Helipad">Helipad</option>
                                                    <option value="Air strip">Air strip</option>
                                                </select>
                                                <span class="error" id="error54"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6 col-xs-12" id="helipad_div" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-label">Type of Helipad<span class="span_required">*</span></label>
                                                <select class="form-control"  name="helipad_type" id="helipad_type">
                                                    <option value="" disabled selected>Select Type</option>
                                                    <option value="H1 -Length of helicopter upto but not including upto 15 meters">H1 -Length of helicopter upto but not including upto 15 meters</option>
                                                    <option value="H2 - Length of helicopter from 15 meter upto but not including 24 meters">H2 - Length of helicopter from 15 meter upto but not including 24 meters</option>
                                                    <option value="H3 - Length of helicopter from 24 meter upto but not including 30 meters">H3 - Length of helicopter from 24 meter upto but not including 30 meters</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <span class="error" id="error55"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12" id="air_div" style="display:none;">
                                            <div class="form-group">
                                                <label class="form-label">Type of Air Strip<span class="span_required">*</span></label>
                                                <select class="form-control"  name="air_strip_type" id="air_strip_type">
                                                    <option value="" disabled selected>Select Type</option>
                                                    <option value="Category 1- Aeroplane length Upto but not including 9 meters">Category 1- Aeroplane length Upto but not including 9 meters</option>
                                                    <option value="Category 2- Aeroplane length from 9 meters upto but not including 12 meters">Category 2- Aeroplane length from 9 meters upto but not including 12 meters</option>
                                                    <option value="Category 3 -  Aeroplane length from 12 meters upto but not including 18 meters">Category 3 -  Aeroplane length from 12 meters upto but not including 18 meters</option>
                                                    <option value="Category 4 -  Aeroplane length from 18 meters upto but not including 24 meters">Category 4 -  Aeroplane length from 18 meters upto but not including 24 meters</option>
                                                    <option value="Category 5 -  Aeroplane length from 24 meters upto but not including 28 meters">Category 5 -  Aeroplane length from 24 meters upto but not including 28 meters</option>
                                                    <option value="Category 6-  Aeroplane length from 28 meters upto but not including 39 meters">Category 6-  Aeroplane length from 28 meters upto but not including 39 meters</option>
                                                </select>
                                                <span class="error" id="error56"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Capacity of Helipad/airport (based on no of airplane/ helicopter)<span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="capacity" name="capacity" placeholder="Capacity of Helipad/airport" value="">
                                                <span class="error" id="error57"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Capacity (in terms of sitting)<span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="sitting_capacity" name="sitting_capacity" placeholder="Capacity (in terms of sitting)" value="">
                                                <span class="error" id="error58"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Event Start Date<span class="span_required">*</span></label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" placeholder="Date" value="">
                                                <span class="error" id="error59"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Event End Date <span class="span_required">*</span></label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" placeholder="Date" value="">
                                                <span class="error" id="error60"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Total Covered Area<span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="total_covered_area" name="total_covered_area" placeholder="Covered Area" value="">
                                                <span class="error" id="error61"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Unit<span class="span_required">*</span></label>
                                                <select class="form-control"  name="covered_area_unit" id="covered_area_unit" required>
                                                    <option value="Sqmt" selected>Sqmt</option>
                                                </select>
                                                <span class="error" id="error62"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">No. of Exit<span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="no_exit" name="no_exit" placeholder="No. of exit" value="">
                                                <span class="error" id="error63"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Provision of fuel storage in the premises<span class="span_required">*</span></label>
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="fuel_storage_yes" name="fuel_storage" value="yes" style="height: auto">
                                                    <label for="fuel_storage_yes">Yes</label>
                                                    <input type="radio" id="fuel_storage_no" name="fuel_storage" value="no" style="height: auto">
                                                    <label for="fuel_storage_no">No</label>
                                                </div>
                                                <span class="error" id="error64"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Provision of separate road<span class="span_required">*</span></label>
                                                <div class="radio-toolbar">
                                                    <input type="radio" id="separate_road_yes" name="separate_road" value="yes" style="height: auto">
                                                    <label for="separate_road_yes">Yes</label>
                                                    <input type="radio" id="separate_road_no" name="separate_road" value="no" style="height: auto">
                                                    <label for="separate_road_no">No</label>
                                                </div>
                                                <span class="error" id="error65"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Other comment<span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="other_comment" name="other_comment" placeholder="Other comment" value="">
                                                <span class="error" id="error66"></span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formProjectDetails()">Save And Next</button>
                                        </div>
                                    </div>
                                    <!-- Additional sections follow the same structure -->
                                </form>
                            </div>
                            <div class="tab-pane text-muted" id="tab8" role="tabpanel">
                                <form method="POST" id="attachments" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Reference Letter or Reference Number from Magistrate<span class="span_required">*</span></label>
                                                <input type="file" class="form-control" id="reference_letter" name="reference_letter" style="height: 36px;">
                                                <span class="error" id="error67"></span>
                                              
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Attach Fire escape plan.<span class="span_required">*</span></label>
                                                <input type="file" class="form-control" id="fire_plan" name="fire_plan" style="height: 36px;">
                                                <span class="error" id="error68"></span>
                                               
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-6 col-xs-12">
                                            <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formAttachmentDetails()">Save And Next</button>
                                        </div>
                                    </div>    
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://newfirestation.test-uat.site/public/admin/js/select2.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
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
                    $('#tehsil_id').append(response)
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
                    $('#block_id').append(response)
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
                    $('#panchayat_id').append(response)
                },
            });
        });
        $(document).on('change', '#org_district_id', function() {
            var org_district_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "getTehsilByDistrict",
                data: {
                    district_id: org_district_id
                },
                success: function(response) {
                    $('#org_tehsil_id').append(response)
                },
            });
        });
        $(document).on('change', '#org_district_id', function() {
            var org_district_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "getBlockByDistrict",
                data: {
                    district_id: org_district_id
                },
                success: function(response) {
                    $('#org_block_id').append(response)
                },
            });
        });
        $(document).on('change', '#org_block_id', function() {
            var org_block_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                type: "POST",
                url: "getPanchayatByBlock",
                data: {
                    block_id: org_block_id
                },
                success: function(response) {
                    $('#org_panchayat_id').append(response)
                },
            });
        });

        
        $(document).on('change', '#project_type', function() {
            var project_type = $(this).val();
            if (project_type == 'Helipad') 
            {
                document.getElementById('helipad_div').style.display = 'block';
                document.getElementById('air_div').style.display = 'none';
            } 
            else if (project_type == 'Air strip')
            {
                document.getElementById('air_div').style.display = 'block';
                document.getElementById('helipad_div').style.display = 'none';
            }
            else
            {
                document.getElementById('helipad_div').style.display = 'none';
                document.getElementById('air_div').style.display = 'none';
            }
        });
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
    function chooseRularUrbanOrg()
    {
        var rular_urban = $("input[name='org_rural_urban']:checked").val();
        if(rular_urban=='rural')
        {
            $("#org_plot1").prop('checked',true);
            $( "#org_rular_div" ).slideToggle( "slow", function()
            {
                $("#org_rular_div").show();
                $("#org_rular_div *").prop('disabled',false);
            });
            $( "#org_urban_div" ).slideToggle( "slow", function()
            {
                $("#org_urban_div").hide();
                $("#org_urban_div *").prop('disabled',true);
            });
        }
        else
        {
            $("#org_plot").prop('checked',true);
            $( "#org_urban_div" ).slideToggle( "slow", function()
            {
                $("#org_urban_div").show();
                $("#org_urban_div *").prop('disabled',false);
            });
            $( "#org_rular_div" ).slideToggle( "slow", function()
            {
                $("#org_rular_div").hide();
                $("#org_rular_div *").prop('disabled',true);
            });
        }
    }
    function formBasicDetails()
    {
        const _token = $('input[name="_token"]').val();
        const applicant_type = $('#applicant_type').val();
        if (!applicant_type)
        {
            var msg = "This field is";
            $('#error1').html(msg);
            return;
        }
        else
        {
            $('#error1').html("");
            // Create FormData object
            const formData = new FormData();
            formData.append('_token', _token);
            formData.append('applicant_type', applicant_type);
            $.ajax({
                url: "{{route('noc.helipad.basic.post')}}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json', // Expecting a JSON response
                success: function(response)
                {
                    if (response.status == "1")
                    {
                        $('#application_no').val(response.application_no);
                        $('.basic').removeClass('active');
                        $('.tab1').removeClass('active');
                        $('#tab1').removeClass('active show');
                        $('.applicant').addClass('active');
                        $('.tab2').addClass('active');
                        $('#tab2').addClass('active show');
                    }
                    else
                    {
                        var msg = "Something went wrong. Please try again.";
                        document.getElementById('errorBlock').style.display = 'block';
                        $('#errorBlock').html(msg);
                    }
                }
            });
        }
    }
    function formApplicantDetails()
    {
        const _token = $('input[name="_token"]').val();
        const application_no = $('#application_no').val();
        const salutation = $('#salutation').val();
        const first_name = $('#first_name').val();
        const middle_name = $('#middle_name').val();
        const last_name = $('#last_name').val();
        const email = $('#email').val();
        const mobile_no = $('#mobile_no').val();
        const district_id = $('#district_id').val();
        const rural_urban = document.querySelector('input[name="rural_urban"]:checked');
        const tehsil_id = $('#tehsil_id').val();
        const street = $('#street').val();
        const landmark = $('#landmark').val();
        const city = $('#city').val();
        const plot_khasra_khatauni = document.querySelector('input[name="plot_khasra_khatauni"]:checked');
        const plot_khasra_khatauni_no = $('#plot_khasra_khatauni_no').val();
        const pincode = $('#pincode').val();
        const block_id = $('#block_id').val();
        const panchayat_id = $('#panchayat_id').val();
        const village = $('#village').val();
        const rlandmark = $('#rlandmark').val();
        const rplot_khasra_khatauni = document.querySelector('input[name="plotkhasrakhatauni"]:checked');
        const rplotkhasrakhatauni = rplot_khasra_khatauni ? rplot_khasra_khatauni.value : null; // Set to null if not found
        const rplot_khasra_khatauni_no = $('#rplot_khasra_khatauni_no').val();
        const rpincode = $('#rpincode').val();
        function validateField(field, errorId)
        {
            if (!field)
            {
                $('#' + errorId).html("This field is.");
                return false;
            }
            return true;
        }
        const errorIds = [
            'error2', 'error3', 'error4', 'error5', 'error6',
            'error7', 'error8', 'error9', 'error10', 'error11',
            'error12', 'error13', 'error14', 'error15', 'error16',
            'error17', 'error18', 'error19', 'error20', 'error21'
        ];
        errorIds.forEach(id => $('#' + id).html(""));
        if (!validateField(salutation, 'error2') || !validateField(first_name, 'error3') || !validateField(email, 'error4') || !validateField(mobile_no, 'error5') || !validateField(district_id, 'error6') || !validateField(rural_urban, 'error7'))
        {
            return;
        }
        if (rural_urban.value === 'urban')
        {
            if (!validateField(tehsil_id, 'error8') || !validateField(street, 'error9') || !validateField(landmark, 'error10') || !validateField(city, 'error11') || !validateField(plot_khasra_khatauni, 'error12') || !validateField(plot_khasra_khatauni_no, 'error13') || !validateField(pincode, 'error14'))
            {
                return;
            }
        }
        else if (rural_urban.value === 'rural')
        {
            if (!validateField(block_id, 'error15') || !validateField(panchayat_id, 'error16') || !validateField(village, 'error17') || !validateField(rlandmark, 'error18') || !validateField(rplot_khasra_khatauni, 'error19') || !validateField(rplot_khasra_khatauni_no, 'error20') || !validateField(rpincode, 'error21'))
            {
                return;
            }
        }
        else
        {
            alert('Please select either rural or urban.');
            return;
        }
        const formData = new FormData();
        formData.append('_token', _token);
        formData.append('application_no', application_no);
        formData.append('salutation', salutation);
        formData.append('first_name', first_name);
        formData.append('middle_name', middle_name);
        formData.append('last_name', last_name);
        formData.append('email', email);
        formData.append('mobile_no', mobile_no);
        formData.append('district_id', district_id);
        formData.append('rural_urban', rural_urban.value);
        formData.append('tehsil_id', tehsil_id);
        formData.append('street', street);
        formData.append('landmark', landmark);
        formData.append('city', city);
        formData.append('plot_khasra_khatauni', plot_khasra_khatauni ? plot_khasra_khatauni.value : null);
        formData.append('plot_khasra_khatauni_no', plot_khasra_khatauni_no);
        formData.append('pincode', pincode);
        formData.append('block_id', block_id);
        formData.append('panchayat_id', panchayat_id);
        formData.append('village', village);
        formData.append('rlandmark', rlandmark);
        formData.append('rplot_khasra_khatauni', rplotkhasrakhatauni);
        formData.append('rplot_khasra_khatauni_no', rplot_khasra_khatauni_no);
        formData.append('rpincode', rpincode);
        $.ajax({
            url: "{{route('noc.helipad.applicant.post')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == "1")
                {
                    $('.applicant').removeClass('active');
                    $('.tab2').removeClass('active');
                    $('#tab2').removeClass('active show');
                    $('.organizing').addClass('active');
                    $('.tab3').addClass('active');
                    $('#tab3').addClass('active show');
                }
                else
                {
                    $('#errorBlock').html("Something went wrong. Please try again.").show();
                }
            }
        });
    }
    function formOrganizingDetails()
    {
        const _token = $('input[name="_token"]').val();
        const application_no = $('#application_no').val();
        const org_district_id = $('#org_district_id').val();
        const org_rural_urban = document.querySelector('input[name="org_rural_urban"]:checked');
        const org_tehsil_id = $('#org_tehsil_id').val();
        const org_street = $('#org_street').val();
        const org_landmark = $('#org_landmark').val();
        const org_city = $('#org_city').val();
        const org_plot_khasra_khatauni = document.querySelector('input[name="org_plot_khasra_khatauni"]:checked');
        const org_plot_khasra_khatauni_no = $('#org_plot_khasra_khatauni_no').val();
        const org_pincode = $('#org_pincode').val();
        const org_block_id = $('#org_block_id').val();
        const org_panchayat_id = $('#org_panchayat_id').val();
        const org_village = $('#org_village').val();
        const org_rlandmark = $('#org_rlandmark').val();
        const org_rplot_khasra_khatauni = document.querySelector('input[name="org_rplot_khasra_khatauni"]:checked');
        const org_rplotkhasrakhatauni = org_rplot_khasra_khatauni ? org_rplot_khasra_khatauni.value : null;
        const org_rplot_khasra_khatauni_no = $('#org_rplot_khasra_khatauni_no').val();
        const org_rpincode = $('#org_rpincode').val();
        const org_latitude = $('#org_latitude').val();
        const org_longitude = $('#org_longitude').val();
        function validateField(field, errorId)
        {
            if (!field)
            {
                $('#' + errorId).html("This field is.");
                return false;
            }
            return true;
        }
        const errorIds = [
            'error22', 'error23', 'error24', 'error25', 'error26',
            'error27', 'error28', 'error29', 'error30', 'error31',
            'error32', 'error33', 'error34', 'error35', 'error36',
            'error37', 'error38', 'error39'
        ];
        errorIds.forEach(id => $('#' + id).html(""));
        if (!validateField(org_district_id, 'error22') || !validateField(org_rural_urban, 'error23') || !validateField(org_rural_urban, 'error38') || !validateField(org_rural_urban, 'error39'))
        {
            return;
        }
        if (org_rural_urban.value === 'urban')
        {
            if (!validateField(org_tehsil_id, 'error24') || !validateField(org_street, 'error25') || !validateField(org_landmark, 'error26') || !validateField(org_city, 'error27') || !validateField(org_plot_khasra_khatauni, 'error28') || !validateField(org_plot_khasra_khatauni_no, 'error29') || !validateField(org_pincode, 'error30'))
            {
                return;
            }
        }
        else if (org_rural_urban.value === 'rural')
        {
            if (!validateField(org_block_id, 'error31') || !validateField(org_panchayat_id, 'error32') || !validateField(org_village, 'error33') || !validateField(org_rlandmark, 'error34') || !validateField(org_rplot_khasra_khatauni, 'error35') || !validateField(org_rplot_khasra_khatauni_no, 'error36') || !validateField(org_rpincode, 'error37'))
            {
                return;
            }
        }
        else
        {
            alert('Please select either rural or urban.');
            return;
        }
        const formData = new FormData();
        formData.append('_token', _token);
        formData.append('application_no', application_no);
        formData.append('org_district_id', org_district_id);
        formData.append('org_rural_urban', org_rural_urban.value);
        formData.append('org_tehsil_id', org_tehsil_id);
        formData.append('org_street', org_street);
        formData.append('org_landmark', org_landmark);
        formData.append('org_city', org_city);
        formData.append('org_plot_khasra_khatauni', org_plot_khasra_khatauni ? org_plot_khasra_khatauni.value : null);
        formData.append('org_plot_khasra_khatauni_no', org_plot_khasra_khatauni_no);
        formData.append('org_pincode', org_pincode);
        formData.append('org_block_id', org_block_id);
        formData.append('org_panchayat_id', org_panchayat_id);
        formData.append('org_village', org_village);
        formData.append('org_rlandmark', org_rlandmark);
        formData.append('org_rplot_khasra_khatauni', org_rplotkhasrakhatauni);
        formData.append('org_rplot_khasra_khatauni_no', org_rplot_khasra_khatauni_no);
        formData.append('org_rpincode', org_rpincode);
        formData.append('org_latitude', org_latitude);
        formData.append('org_longitude', org_longitude);
        $.ajax({
            url: "{{route('noc.helipad.organizing.post')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == "1")
                {
                    $('.organizing').removeClass('active');
                    $('.tab3').removeClass('active');
                    $('#tab3').removeClass('active show');
                    $('.organizer').addClass('active');
                    $('.tab4').addClass('active');
                    $('#tab4').addClass('active show');
                }
                else
                {
                    $('#errorBlock').html("Something went wrong. Please try again.").show();
                }
            }
        });
    }
    function formOrganizerDetails()
    {
        const _token = $('input[name="_token"]').val();
        const application_no = $('#application_no').val();
        const org_salutation = $('#org_salutation').val();
        const org_first_name = $('#org_first_name').val();
        const org_middle_name = $('#org_middle_name').val();
        const org_last_name = $('#org_last_name').val();
        const org_name = $('#org_name').val();
        const org_email = $('#org_email').val();
        const org_mobile_no = $('#org_mobile_no').val();
        function validateField(field, errorId)
        {
            if (!field)
            {
                $('#' + errorId).html("This field is.");
                return false;
            }
            return true;
        }
        const errorIds = [
            'error40', 'error41', 'error42', 'error43', 'error44'
        ];
        errorIds.forEach(id => $('#' + id).html(""));
        if (!validateField(org_salutation, 'error40') || !validateField(org_first_name, 'error41') || !validateField(org_name, 'error42') || !validateField(org_email, 'error43') || !validateField(org_mobile_no, 'error44'))
        {
            return;
        }
        const formData = new FormData();
        formData.append('_token', _token);
        formData.append('application_no', application_no);
        formData.append('org_salutation', org_salutation);
        formData.append('org_first_name', org_first_name);
        formData.append('org_middle_name', org_middle_name);
        formData.append('org_last_name', org_last_name);
        formData.append('org_name', org_name);
        formData.append('org_email', org_email);
        formData.append('org_mobile_no', org_mobile_no);
        $.ajax({
            url: "{{route('noc.helipad.organizer.post')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == "1")
                {
                    $('.organizer').removeClass('active');
                    $('.tab4').removeClass('active');
                    $('#tab4').removeClass('active show');
                    $('.erector').addClass('active');
                    $('.tab5').addClass('active');
                    $('#tab5').addClass('active show');
                }
                else
                {
                    $('#errorBlock').html("Something went wrong. Please try again.").show();
                }
            }
        });
    }
    function formErectorDetails()
    {
        const _token = $('input[name="_token"]').val();
        const application_no = $('#application_no').val();
        const ere_salutation = $('#ere_salutation').val();
        const ere_first_name = $('#ere_first_name').val();
        const ere_middle_name = $('#ere_middle_name').val();
        const ere_last_name = $('#ere_last_name').val();
        const ere_name = $('#ere_name').val();
        const ere_email = $('#ere_email').val();
        const ere_mobile_no = $('#ere_mobile_no').val();
        function validateField(field, errorId)
        {
            if (!field)
            {
                $('#' + errorId).html("This field is.");
                return false;
            }
            return true;
        }
        const errorIds = [
            'error45', 'error46', 'error47', 'error48', 'error49'
        ];
        errorIds.forEach(id => $('#' + id).html(""));
        if (!validateField(ere_salutation, 'error45') || !validateField(ere_first_name, 'error46') || !validateField(ere_name, 'error47') || !validateField(ere_email, 'error48') || !validateField(ere_mobile_no, 'error49'))
        {
            return;
        }
        const formData = new FormData();
        formData.append('_token', _token);
        formData.append('application_no', application_no);
        formData.append('ere_salutation', ere_salutation);
        formData.append('ere_first_name', ere_first_name);
        formData.append('ere_middle_name', ere_middle_name);
        formData.append('ere_last_name', ere_last_name);
        formData.append('ere_name', ere_name);
        formData.append('ere_email', ere_email);
        formData.append('ere_mobile_no', ere_mobile_no);
        $.ajax({
            url: "{{route('noc.helipad.erector.post')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == "1")
                {
                    $('.erector').removeClass('active');
                    $('.tab5').removeClass('active');
                    $('#tab5').removeClass('active show');
                    $('.coordinator').addClass('active');
                    $('.tab6').addClass('active');
                    $('#tab6').addClass('active show');
                }
                else
                {
                    $('#errorBlock').html("Something went wrong. Please try again.").show();
                }
            }
        });
    }
    function formCoordinatorDetails()
    {
        const _token = $('input[name="_token"]').val();
        const application_no = $('#application_no').val();
        const coor_salutation = $('#coor_salutation').val();
        const coor_first_name = $('#coor_first_name').val();
        const coor_middle_name = $('#coor_middle_name').val();
        const coor_last_name = $('#coor_last_name').val();
        const coor_email = $('#coor_email').val();
        const coor_mobile_no = $('#coor_mobile_no').val();
        function validateField(field, errorId)
        {
            if (!field)
            {
                $('#' + errorId).html("This field is.");
                return false;
            }
            return true;
        }
        const errorIds = [
            'error50', 'error51', 'error52', 'error53'
        ];
        errorIds.forEach(id => $('#' + id).html(""));
        if (!validateField(coor_salutation, 'error50') || !validateField(coor_first_name, 'error51') || !validateField(coor_email, 'error52') || !validateField(coor_mobile_no, 'error53'))
        {
            return;
        }
        const formData = new FormData();
        formData.append('_token', _token);
        formData.append('application_no', application_no);
        formData.append('coor_salutation', coor_salutation);
        formData.append('coor_first_name', coor_first_name);
        formData.append('coor_middle_name', coor_middle_name);
        formData.append('coor_last_name', coor_last_name);
        formData.append('coor_email', coor_email);
        formData.append('coor_mobile_no', coor_mobile_no);
        $.ajax({
            url: "{{route('noc.helipad.coordinator.post')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == "1")
                {
                    $('.coordinator').removeClass('active');
                    $('.tab6').removeClass('active');
                    $('#tab6').removeClass('active show');
                    $('.project').addClass('active');
                    $('.tab7').addClass('active');
                    $('#tab7').addClass('active show');
                }
                else
                {
                    $('#errorBlock').html("Something went wrong. Please try again.").show();
                }
            }
        });
    }
    function formProjectDetails()
    {
        const _token = $('input[name="_token"]').val();
        const application_no = $('#application_no').val();
        const project_type = $('#project_type').val();
        console.log(project_type);
        const helipad_type = $('#helipad_type').val();
        const air_strip_type = $('input[name="air_strip_type"]').val();
        const capacity = $('input[name="capacity"]').val();
        const sitting_capacity = $('input[name="sitting_capacity"]').val();
        const start_date = $('input[name="start_date"]').val();
        const end_date = $('input[name="end_date"]').val();
        const total_covered_area = $('input[name="total_covered_area"]').val();
        const covered_area_unit = $('#covered_area_unit').val();
        const no_exit = $('input[name="no_exit"]').val();
        const fuel_storage = $('input[name="fuel_storage"]').val();
        const separate_road = $('input[name="separate_road"]').val();
        const other_comment = $('input[name="other_comment"]').val();
        function validateField(field, errorId)
        {
            if (!field)
            {
                $('#' + errorId).html("This field is requred.");
                return false;
            }
            return true;
        }
        const errorIds = [
            'error54', 'error55', 'error56', 'error57', 'error58',
            'error59', 'error60', 'error61', 'error62', 'error63',
            'error64', 'error65', 'error66'
        ];
        errorIds.forEach(id => $('#' + id).html(""));
        if (!validateField(project_type, 'error54') || !validateField(capacity, 'error57') || !validateField(sitting_capacity, 'error58') || !validateField(start_date, 'error59') || !validateField(end_date, 'error60') || !validateField(total_covered_area, 'error61') || !validateField(covered_area_unit, 'error62') || !validateField(no_exit, 'error63') || !validateField(fuel_storage, 'error64') || !validateField(separate_road, 'error65') || !validateField(other_comment, 'error66'))
        {
            return;
        }
        if (project_type === 'Helipad')
        {
            if (!validateField(helipad_type, 'error55'))
            {
                return;
            }
        }
        else if (project_type === 'Air strip')
        {
            if (!validateField(air_strip_type, 'error56'))
            {
                return;
            }
        }
        const formData = new FormData();
        formData.append('_token', _token);
        formData.append('application_no', application_no);
        formData.append('project_type', project_type);
        formData.append('helipad_type', helipad_type);
        formData.append('air_strip_type', air_strip_type);
        formData.append('capacity', capacity);
        formData.append('sitting_capacity', sitting_capacity);
        formData.append('start_date', start_date);
        formData.append('end_date', end_date);
        formData.append('total_covered_area', total_covered_area);
        formData.append('covered_area_unit', covered_area_unit);
        formData.append('no_exit', no_exit);
        formData.append('fuel_storage', fuel_storage);
        formData.append('separate_road', separate_road);
        formData.append('other_comment', other_comment);
        $.ajax({
            url: "{{route('noc.helipad.project.post')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == "1")
                {
                    $('.project').removeClass('active');
                    $('.tab7').removeClass('active');
                    $('#tab7').removeClass('active show');
                    $('.attachments').addClass('active');
                    $('.tab8').addClass('active');
                    $('#tab8').addClass('active show');
                }
                else
                {
                    $('#errorBlock').html(response.msg).show();
                }
            }
        });
    }
    function formAttachmentDetails()
    {
        const _token = $('input[name="_token"]').val();
        const application_no = $('#application_no').val();
        const reference_letter = $('input[name="reference_letter"]')[0].files[0];
        const fire_plan = $('input[name="fire_plan"]')[0].files[0];
        function validateField(field, errorId)
        {
            if (!field) {
                $('#' + errorId).html("This field is.");
                const errorElement = document.getElementById(errorId);
                if (errorElement) {
                    errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    errorElement.focus();
                }
                return false;
            }
            else
            {
                return true;
            }
        }
        const fieldsToValidate = [
            { field: reference_letter, errorId: 'error67' },
            { field: fire_plan, errorId: 'error68' }
        ];
        fieldsToValidate.forEach(({ errorId }) => $('#' + errorId).html(""));
        const isValid = fieldsToValidate.every(({ field, errorId }) => validateField(field, errorId));
        if (!isValid)
        {
            return false;
        }
        const formData = new FormData();
        formData.append('_token', _token);
        formData.append('application_no', application_no);
        formData.append('reference_letter', reference_letter);
        formData.append('fire_plan', fire_plan);
        $.ajax({
            url: "{{route('noc.helipad.attachments.post')}}",
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function(response)
            {
                if (response.status == "1")
                {
                    $('#successBlock').html(response.msg).show();
                }
                else
                {
                    $('#errorBlock').html(response.msg).show();
                }
            }
        });
    }
</script>
@stop
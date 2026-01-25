@extends('layouts.admin.template')
@section('title')
<title>Admin Application</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">


<style>
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

    .error {
        color: red;
    }
</style>
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Application</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="{{route('admin.Noc',['type'=>'all'])}}" class="btn ripple btn-wave  btn-danger mb-0">
                <i class="fe fe-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>
</div>

<!-- Start::row-2 -->
 <div class="row">
    <div class="col-md-12 mb-2" style="justify-content: center; ">
        @if(session()->has('message'))
        <div class="alert alert-success fade in alert-dismissible show" style="margin-bottom: 0px;"> <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button>
            {{ session()->get('message') }}
        </div>
        @elseif(session()->has('error'))
        <div class="alert alert-danger fade in alert-dismissible show" style="margin-bottom: 0px;">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true" style="font-size:20px">×</span>
            </button>
            {{ session()->get('error') }}
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
    </div>
 </div>
<!-- messages -->

<!-- End messages --> 


<!-- card 1 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Citizen Application Details
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item active" role="presentation"> <a class="nav-link active" data-bs-toggle="tab" role="tab" href="#tab2" aria-selected="false" tabindex="-1">User Details</a> </li>
                        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab3" aria-selected="true">User Declaration</a> </li>
                    </ul>

                    <!--  Tab content -->
                    <div class="tab-content">
                        <div class="tab-pane show active text-muted" id="tab2" role="tabpanel">
                            <div class="row">
                                <div class="col-xl-3">
                                    <ul class="nav nav-tabs flex-column nav-style-4" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab1" aria-selected="true">Building Map</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab2" aria-selected="false" tabindex="-1">Fire Escape Plan</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab3" aria-selected="false" tabindex="-1">Chemical Use</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab4" aria-selected="false" tabindex="-1">Upload SOP</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab8" aria-selected="false" tabindex="-1">Safety Officer</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab5" aria-selected="false" tabindex="-1">Do & Dont's</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab6" aria-selected="false" tabindex="-1">Issues Noc</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab1innerTab7" aria-selected="false" tabindex="-1">Add Issues Noc</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-xl-9">
                                    <div class="tab-content">
                                        <div class="tab-pane show active text-muted" id="tab1innerTab1" role="tabpanel">
                                            <h4 class="text-center">Building Map</h4>
                                            <hr>
                                            @if(isset($buildingMap->building_map))
                                            <a href="{{ asset($buildingMap->building_map) }}" target="_blank" download><img src="{{ asset($buildingMap->building_map) }}" alt="client" width="70" height="70" class="shadow-sm mr-3" /></a>
                                            @endif
                                        </div>
                                        <div class="tab-pane text-muted" id="tab1innerTab2" role="tabpanel">
                                            <h4 class="text-center">Fire Escape Plan</h4>
                                            <hr>
                                            <table class="table ucp-table table-hover table-bordered display" id="standby-table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Type Of Program</th>
                                                        <th>Program Datetime</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach ($firePlan as $plan)
                                                    <tr class="my-job-item">
                                                        <td class="d-none d-xl-table-cell text-center number-application" style="width: 9%;">{{$i }}</td>
                                                        <td>{{$plan->floor}}</td>
                                                        <td><img src="{{ asset($plan->fire_escape_plan) }}" alt="client" class="shadow-sm mr-3" style="width:150px;"></td>
                                                        <td class="d-none d-md-table-cell text-right">
                                                            <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('fire.escape.plan.delete', $plan->id)}}" class="btn btn-light btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane text-muted" id="tab1innerTab3" role="tabpanel">
                                            <h4 class="text-center">Chemical Use</h4>
                                            <hr>
                                            <table class="table ucp-table table-hover table-bordered display" id="standby-table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Chemical Name</th>
                                                        <th>Chemical Form</th>
                                                        <th>Health</th>
                                                        <th>Fire</th>
                                                        <th>Reactivity</th>
                                                        <th>Special Note</th>
                                                        <th>Other Comment</th>
                                                        <th>Delete</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach ($chemical as $chem)
                                                    <tr class="my-job-item">
                                                        <td class="d-none d-xl-table-cell text-center number-application" style="width: 9%;">{{$i }}</td>
                                                        <td>{{ucfirst($chem->name)}}</td>
                                                        <td>{{$chem->chemical_form}}</td>
                                                        <td>{{$chem->health}}</td>
                                                        <td>{{$chem->fire}}</td>
                                                        <td>{{$chem->reactivity}}</td>
                                                        <td>{{$chem->note}}</td>
                                                        <td>{{ucfirst($chem->comment)}}</td>
                                                        <td class="d-none d-md-table-cell text-right">
                                                            <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('citizen.chemical.use.delete', $chem->id)}}" class="btn btn-light btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane text-muted" id="tab1innerTab4" role="tabpanel">
                                            <h4 class="text-center">SOP</h4>
                                            <hr>
                                            @if(isset($sop->upload_sop))
                                            <a href="{{ asset($sop->upload_sop) }}" target="_blank" download><img src="{{ asset($sop->upload_sop) }}" alt="client" width="70" height="70" class="shadow-sm mr-3" /></a>
                                            @endif
                                        </div>
                                        <div class="tab-pane text-muted" id="tab1innerTab8" role="tabpanel">
                                            <h4 class="text-center">Safety Officer</h4>
                                            <hr>
                                            <table class="table ucp-table table-hover table-bordered display" id="standby-table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Name of fire safety officer</th>
                                                        <th>Minimum Qualifications</th>
                                                        <th>Phone No. (Office)</th>
                                                        <th>Mobile No.</th>
                                                        <th>Number of fire safety trained person in Institution</th>
                                                        <th>Active</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach ($officer as $of)
                                                    <tr class="my-job-item">
                                                        <td class="d-none d-xl-table-cell text-center number-application" style="width: 9%;">{{$i }}</td>
                                                        <td>{{ucfirst($of->name)}}</td>
                                                        <td>{{$of->minimum_qualification}}</td>
                                                        <td>{{$of->phone_no}}</td>
                                                        <td>{{$of->mobile_no}}</td>
                                                        <td>{{$of->person}}</td>
                                                        <td class="d-none d-md-table-cell text-right">
                                                            <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('citizen.safety.officer.delete', $of->id)}}" class="btn btn-light btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a>
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane text-muted" id="tab1innerTab5" role="tabpanel">
                                            <h4 class="text-center">Do & Dont's</h4>
                                            <hr>
                                            @if(isset($doDonts->do_and_dont))
                                            <a href="{{ asset($doDonts->do_and_dont) }}" target="_blank" download><img src="{{ asset($doDonts->do_and_dont) }}" alt="client" width="70" height="70" class="shadow-sm mr-3" /></a>
                                            @endif
                                        </div>
                                        <div class="tab-pane text-muted" id="tab1innerTab6" role="tabpanel">
                                            <h4 class="text-center">Issued Noc</h4>
                                            <hr>
                                            <table class="table ucp-table table-hover table-bordered display" id="standby-table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.</th>
                                                        <th>Application No.</th>
                                                        <th>Application For</th>
                                                        <th>Type</th>
                                                        <th>Building</th>
                                                        <th>District</th>
                                                        <th>Issued On</th>
                                                        <th>Status</th>
                                                        <th>Download</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach ($issued as $iss)
                                                    <tr class="my-job-item">
                                                        <td style="width: 9%;">{{$i }}</td>
                                                        <td>{{$iss->application_no}}</td>
                                                        <td>{{$iss->project}}</td>
                                                        <td>{{$iss->application_type}}</td>
                                                        <td>{{$iss->building_name}}</td>
                                                        <td>{{ucwords($iss->district->name) }}</td>
                                                        <td>{{$iss->created_at}}</td>
                                                        <td>{{ucwords($iss->status)}}</td>
                                                        <td><a href="{{ asset($iss->file) }}" alt="client" class="shadow-sm mr-3" title="View File" target="_blank"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a></td>
                                                    </tr>
                                                    @php
                                                    $i++;
                                                    @endphp
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane text-muted" id="tab1innerTab7" role="tabpanel">
                                            <h4 class="text-center">Add Issued Noc</h4>
                                            <hr>
                                            <form enctype="multipart/form-data" id="{{route('citizen.addIssuedNocPost')}}" action="#" method="post">
                                                @csrf
                                                <div class="body-box-admin">
                                                    <div class="body-box-admin tab-content card" style="padding:0px">
                                                        <p class="note" style="margin-left:10px">Fields with <span class="required">*</span> are required.</p>
                                                        <div class="row mt-3" style="padding: 0 30px 25px;">
                                                            <input type="hidden" name="user_id" id="user_id" value="{{$applicationDetail->user_id}}">
                                                            <div class="col-md-4 col-sm-6 col-xs-12" style="float: right">
                                                                <div class="form-group">
                                                                    <label class="control-label required" style="text-align: right;" for="RescueReport_rescue_report_no">Application Number <span class="required">*</span></label>
                                                                    <input class="form-control" size="60" maxlength="255" name="application_no" id="application_no" type="number" placeholder="Application Number" required />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12" style="float: right">
                                                                <div class="form-group">
                                                                    <label class="control-label required" style="text-align: right;" for="RescueReport_rescue_report_no">Application For<span class="required">*</span></label>
                                                                    <select class="form-control js-example-basic-single" name="project" id="project" required>
                                                                        <option value="" disabled selected>Select Application For</option>
                                                                        @foreach ($projects as $prd)
                                                                        <option value="{{ ucfirst($prd->name) }}">{{ ucfirst($prd->name) }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-username">Application Type<span class="span_required">*</span></label>
                                                                    <select class="form-control js-example-basic-single" name="application_type" id="application_type" required onclick="chooseCategory();">
                                                                        <option value="" disabled selected>Select Application Type</option>
                                                                        <option value="Pre Establishment">Select Pre Establishment</option>
                                                                        <option value="Pre Operational">Select Pre Operational</option>
                                                                        <option value="Renewal">Select Renewal</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-username">Building Name<span class="span_required">*</span></label>
                                                                    <input class="form-control" size="60" maxlength="255" name="building_name" id="building_name" type="text" value="{{ ucfirst($applicationDetail->building_name) ?? ''}}" required readonly />
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label class="form-control-label" for="input-username">District जनपद<span class="span_required">*</span></label>
                                                                    <select class="form-control js-example-basic-single" name="district_id" id="district_id" required>
                                                                        @foreach ($districts as $dist)
                                                                        <option value="{{ $dist->id }}" <?php if ($districts[0]->id == $dist->id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>>{{ ucfirst($dist->name) }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label" style="text-align: right;" for="RescueReport_upload">Uploaded New File</label>
                                                                    <input class="form-control" name="upload_file" id="upload_file" type="file" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3 mb-3">
                                                            <div class="col-md-12" style="justify-content:center;display: flex;">
                                                                <input class="btn btn-primary col-md-4" type="submit" name="yt0" value="Create Report" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane text-muted" id="tab3" role="tabpanel">
                            <div class="row">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab2innerTab1" aria-selected="true">Building Statu</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab2innerTab2" aria-selected="false" tabindex="-1">Fire Fighting Provision</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab2innerTab3" aria-selected="false" tabindex="-1">Special Provision</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab2innerTab4" aria-selected="false" tabindex="-1">Declaration Submit</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#tab2innerTab5" aria-selected="false" tabindex="-1">Declaration List</a>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane show active text-muted" id="tab2innerTab1" role="tabpanel">
                                        <div class="row">
                                            @php
                                            $building_status = isset($declaration[0]->building_status) ? json_decode($declaration[0]->building_status) : '';
                                            @endphp
                                            <div class="col-md-6">
                                                <label class="form-label">Set Back : </label>
                                                <span style="float: right;">{{ isset($building_status->set_back) ? $building_status->set_back : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Compartmentation : </label>
                                                <span style="float: right;">{{ isset($building_status->compartmentation) ? $building_status->compartmentation : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Minimum Width of Stairs : </label>
                                                <span style="float: right;">{{ isset($building_status->stair_width) ? $building_status->stair_width : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fire Hose Cabin : </label>
                                                <span style="float: right;">{{ isset($building_status->fire_cabin) ? $building_status->fire_cabin : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">No. of Stairs in Each Block : </label>
                                                <span style="float: right;">{{ isset($building_status->stair_in_block) ? $building_status->stair_in_block : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Emergency Exit : </label>
                                                <span style="float: right;">{{ isset($building_status->emergency_exit) ? $building_status->emergency_exit : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fireman switch in lift : </label>
                                                <span style="float: right;">{{ isset($building_status->fire_switch) ? $building_status->fire_switch : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Alternative Electric Supply : </label>
                                                <span style="float: right;">{{ isset($building_status->alt_electric) ? $building_status->alt_electric : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Emergency lighting system : </label>
                                                <span style="float: right;">{{ isset($building_status->emergency_light) ? $building_status->emergency_light : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fluorescent exit sign : </label>
                                                <span style="float: right;">{{ isset($building_status->fluorescent_exit) ? $building_status->fluorescent_exit : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Provision of Smoke/Fire check Doors : </label>
                                                <span style="float: right;">{{ isset($building_status->pro_smoke) ? $building_status->pro_smoke : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Refuse area in case of high rise buildings : </label>
                                                <span style="float: right;">{{ isset($building_status->refuse_area) ? $building_status->refuse_area : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Maximum Travel Distance in Building : </label>
                                                <span style="float: right;">{{ isset($building_status->max_travel) ? $building_status->max_travel : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Electric Installation(ELCB,MCB) : </label>
                                                <span style="float: right;">{{ isset($building_status->elec_install) ? $building_status->elec_install : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-muted" id="tab2innerTab2" role="tabpanel">
                                        <div class="row">
                                            @php
                                            $fire_provission = isset($declaration[0]->fire_provission) ? json_decode($declaration[0]->fire_provission) : '';
                                            @endphp
                                            <div class="col-md-6">
                                                <label class="form-label">Under-ground Static water Storage Tank : </label>
                                                <span style="float: right;">{{ isset($fire_provission->is_under_ground) ? $fire_provission->is_under_ground : '' }}</span>
                                            </div>
                                            @if(isset($declaration[0]->fire_provission) && $fire_provission->is_under_ground == 'Available')
                                            <div class="col-md-6">
                                                <label class="form-label">Under-ground Static water Storage Tank Capacity (Ltr) : </label>
                                                <span style="float: right;">{{ isset($fire_provission->under_ground_storage_capacity) ? $fire_provission->under_ground_storage_capacity : '' }}</span>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <label class="form-label">Pump near underground static water Storage Tank : </label>
                                                <span style="float: right;">{{ isset($fire_provission->is_under_ground_tank) ? $fire_provission->is_under_ground_tank : '' }}</span>
                                            </div>
                                            @if(isset($declaration[0]->fire_provission) && $fire_provission->is_under_ground_tank == 'Available')
                                            @if(isset($fire_provission->type_electric_under_ground_tank))
                                            <div class="col-md-6">
                                                <label class="form-label">Type of under ground tank : </label>
                                                <span style="float: right;">{{ isset($fire_provission->type_electric_under_ground_tank) ? $fire_provission->type_electric_under_ground_tank : '' }}</span>
                                            </div>
                                            @elseif(isset($fire_provission->type_diesel_under_ground_tank))
                                            <div class="col-md-6">
                                                <label class="form-label">Type of under ground tank : </label>
                                                <span style="float: right;">{{ isset($fire_provission->type_diesel_under_ground_tank) ? $fire_provission->type_diesel_under_ground_tank : '' }}</span>
                                            </div>
                                            @elseif(isset($fire_provission->type_jockey_under_ground_tank))
                                            <div class="col-md-6">
                                                <label class="form-label">Type of under ground tank : </label>
                                                <span style="float: right;">{{ isset($fire_provission->type_jockey_under_ground_tank) ? $fire_provission->type_jockey_under_ground_tank : '' }}</span>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <label class="form-label">Electric Capacity (LPM) : </label>
                                                <span style="float: right;">{{ isset($fire_provission->electric_ground_tank_capacity) ? $fire_provission->electric_ground_tank_capacity : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Diesel Capacity (LPM) : </label>
                                                <span style="float: right;">{{ isset($fire_provission->diesel_ground_tank_capacity) ? $fire_provission->diesel_ground_tank_capacity : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Jockey Capacity (LPM) : </label>
                                                <span style="float: right;">{{ isset($fire_provission->jockey_ground_tank_capacity) ? $fire_provission->jockey_ground_tank_capacity : '' }}</span>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <label class="form-label">Yard Hydrant : </label>
                                                <span style="float: right;">{{ isset($fire_provission->yard_hydrant) ? $fire_provission->yard_hydrant : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fire Hose Cabin : </label>
                                                <span style="float: right;">{{ isset($fire_provission->fire_cabin) ? $fire_provission->fire_cabin : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Wet Riser : </label>
                                                <span style="float: right;">{{ isset($fire_provission->wet_riser) ? $fire_provission->wet_riser : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Is Terrace Tank Respective Tower Terrace : </label>
                                                <span style="float: right;">{{ isset($fire_provission->is_terrace_tank) ? $fire_provission->is_terrace_tank : '' }}</span>
                                            </div>
                                            @if(isset($declaration[0]->fire_provission) && $fire_provission->is_terrace_tank == 'Available')
                                            <div class="col-md-6">
                                                <label class="form-label">Terrace tank capacity of respective tower : </label>
                                                <span style="float: right;">{{ isset($fire_provission->terrace_tank) ? $fire_provission->terrace_tank : '' }}</span>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <label class="form-label">Is Terrace pump : </label>
                                                <span style="float: right;">{{ isset($fire_provission->is_terrace_pump) ? $fire_provission->is_terrace_pump : '' }}</span>
                                            </div>
                                            @if(isset($declaration[0]->fire_provission) && $fire_provission->is_terrace_pump == 'Available')
                                            <div class="col-md-6">
                                                <label class="form-label">Terrace pump Capacity (LPM) : </label>
                                                <span style="float: right;">{{ isset($fire_provission->terrace_pump_capacity) ? $fire_provission->terrace_pump_capacity : '' }}</span>
                                            </div>
                                            @endif
                                            <div class="col-md-6">
                                                <label class="form-label">Down Comer : </label>
                                                <span style="float: right;">{{ isset($fire_provission->down_comer) ? $fire_provission->down_comer : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">First Aid Hose Real : </label>
                                                <span style="float: right;">{{ isset($fire_provission->first_aid) ? $fire_provission->first_aid : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Landing valve : </label>
                                                <span style="float: right;">{{ isset($fire_provission->landing_valve) ? $fire_provission->landing_valve : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Manually Operated Electronic Fire Alarm System : </label>
                                                <span style="float: right;">{{ isset($fire_provission->manual_alarm) ? $fire_provission->manual_alarm : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Automatic Detection and Alarm System : </label>
                                                <span style="float: right;">{{ isset($fire_provission->automatic_alarm) ? $fire_provission->automatic_alarm : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Automatic Sprinkler System : </label>
                                                <span style="float: right;">{{ isset($fire_provission->automatic_sprinkler) ? $fire_provission->automatic_sprinkler : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fire Extinguisher : </label>
                                                <span style="float: right;">{{ isset($fire_provission->fire_extinguisher) ? $fire_provission->fire_extinguisher : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-muted" id="tab2innerTab3" role="tabpanel">
                                        <div class="row">
                                            @php
                                            $special_provission = isset($declaration[0]->special_provission) ? json_decode($declaration[0]->special_provission) : '';
                                            @endphp
                                            <div class="col-md-6">
                                                <label class="form-label">Smoke Extraction System : </label>
                                                <span style="float: right;">{{ isset($special_provission->smoke_extraction) ? $special_provission->smoke_extraction : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fresh Air Induction System : </label>
                                                <span style="float: right;">{{ isset($special_provission->fresh_air) ? $special_provission->fresh_air : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Response Indicator : </label>
                                                <span style="float: right;">{{ isset($special_provission->response_indicator) ? $special_provission->response_indicator : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Water Spray System : </label>
                                                <span style="float: right;">{{ isset($special_provission->water_spray) ? $special_provission->water_spray : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Foam Spray System : </label>
                                                <span style="float: right;">{{ isset($special_provission->foam_spray) ? $special_provission->foam_spray : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Gas type flooding system : </label>
                                                <span style="float: right;">{{ isset($special_provission->flooding_system) ? $special_provission->flooding_system : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fireman switch in lift : </label>
                                                <span style="float: right;">{{ isset($special_provission->fire_switch_lift) ? $special_provission->fire_switch_lift : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fire Cart Room : </label>
                                                <span style="float: right;">{{ isset($special_provission->fire_cart) ? $special_provission->fire_cart : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Beam Detector : </label>
                                                <span style="float: right;">{{ isset($special_provission->beam_detector) ? $special_provission->beam_detector : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Gas Detector : </label>
                                                <span style="float: right;">{{ isset($special_provission->gas_detector) ? $special_provission->gas_detector : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fire Bucket : </label>
                                                <span style="float: right;">{{ isset($special_provission->fire_bucket) ? $special_provission->fire_bucket : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Emergency No : </label>
                                                <span style="float: right;">{{ isset($special_provission->emergency_no) ? $special_provission->emergency_no : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Fire Safety Trained Staff : </label>
                                                <span style="float: right;">{{ isset($special_provission->trained_staff) ? $special_provission->trained_staff : '' }}</span>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Other Comment : </label><br>
                                                <span>{{ isset($special_provission->other_comment) ? $special_provission->other_comment : '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-muted" id="tab2innerTab4" role="tabpanel">
                                        <form method="POST" enctype="multipart/form-data" action="#" id="form_physical">
                                            @csrf
                                            <div class="row">
                                                <input type="hidden" name="inspection_step" value="">
                                                <div class="col-lg-12 col-sm-10 col-xs-12" style="padding-right: 0;">
                                                    <div class="form-group">
                                                        @if(isset($declaration[0]->final_submit))
                                                        @php
                                                        $dec = $declaration[0]->final_submit;
                                                        @endphp
                                                        @else
                                                        @php $dec = ''; @endphp
                                                        @endif
                                                        <div class="radio-toolbar">
                                                            <input type="checkbox" value="1" class="rb" @if ($dec=='1' ) checked @endif required> I hereby declare that the information furnished above is true, complete and correct to the best of my knowledge and belief
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane text-muted" id="tab2innerTab5" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table ucp-table table-hover table-bordered display" id="GO-table" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>S No.</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        @if(auth()->user()->type == 2 || auth()->user()->type == 0)
                                                        <th>Action</th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                    $i = 1;
                                                    @endphp
                                                    @foreach($declaration as $data)
                                                    <tr class="">
                                                        <td class="d-none d-xl-table-cell text-center number-application">{{$i++ }}</td>
                                                        <td>{{date('d-m-Y', strtotime($data->created_at))}}</td>
                                                        <td>{{$data->status}}</td>
                                                        @if(auth()->user()->type == 2 || auth()->user()->type == 0 && $data->status == 'Pending')
                                                        @if($data->status == 'Pending')
                                                        <td>
                                                            <a class="btn btn-success approved" style="background:green" data-id="{{$data->id}}">Approve</a>
                                                            <a class="btn btn-danger ml-4 rejected" data-id="{{$data->id}}">Reject</a>
                                                        </td>
                                                        @else
                                                        <td>{{$data->status}}</td>
                                                        @endif
                                                        @endif
                                                        <!-- @if(auth()->user()->type == 2 && $data->status != 'Pending')
                                                    <td></td>
                                                    @endif -->
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>      
                      
                    <!-- End Tab content -->  
                </div>


            </div>    
        </div>    
    </div>    
</div>
<!-- end card 1 -->





<!-- card 2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Citizen Basic Details
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item active" role="presentation"> <a class="nav-link active" data-bs-toggle="tab" role="tab" href="#tab4" aria-selected="false" tabindex="-1">Basic Details</a> </li>
                        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab5" aria-selected="false" tabindex="-1">Building Address</a> </li>
                        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab6" aria-selected="false" tabindex="-1">Proprietary Details</a> </li>
                        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab7" aria-selected="false" tabindex="-1">Area and Set Back Details</a> </li>
                        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab8" aria-selected="false" tabindex="-1">Essential Provision Detail</a> </li>
                        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab9" aria-selected="false" tabindex="-1">Attachments</a> </li>
                    </ul>

                    <!--  Tab content -->
                    <div class="tab-content">
                        <div class="tab-pane show active text-muted" id="tab4" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Application No. : </label><br>
                                    <span>{{ $applicationDetail->application_no }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Application Type : </label><br>
                                    <span>{{ $applicationDetail->application_type }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Building Name : </label><br>
                                    <span>{{ $applicationDetail->building_name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Building Category : </label><br>
                                    <span>{{ $applicationDetail->category->name }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Building Sub Category : </label><br>
                                    <span>{{ucwords($applicationDetail->subcategory->name)}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Type Of Industry : </label><br>
                                    <span>{{ucwords($applicationDetail->type->name ?? '')}}</span>
                                </div>
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->no_of_rooms))
                                <div class="col-md-4">
                                    <label class="form-label">Number of Rooms : </label><br>
                                    <span>{{ json_decode($applicationDetail->occupancy_detail)->no_of_rooms ?? '' }}</span>
                                </div>
                                @endif
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->no_of_flats))
                                <div class="col-md-4">
                                    <label class="form-label">Number of Flats : </label><br>
                                    <span>{{ json_decode($applicationDetail->occupancy_detail)->no_of_flats ?? '' }}</span>
                                </div>
                                @endif
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->no_of_beds))
                                <div class="col-md-4">
                                    <label class="form-label">Number of Beds : </label><br>
                                    <span>{{ json_decode($applicationDetail->occupancy_detail)->no_of_beds ?? '' }}</span>
                                </div>
                                @endif
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->for_educational))
                                <div class="col-md-4">
                                    <label class="form-label">For Educationals : </label><br>
                                    <span>{{ ucwords(json_decode($applicationDetail->occupancy_detail)->for_educational) ?? '' }}</span>
                                </div>
                                @endif
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->seating_capacity))
                                <div class="col-md-4">
                                    <label class="form-label">Seating Capacity: </label><br>
                                    <span>{{ json_decode($applicationDetail->occupancy_detail)->seating_capacity ?? '' }}</span>
                                </div>
                                @endif
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->no_of_employee))
                                <div class="col-md-4">
                                    <label class="form-label">Number of Employee : </label><br>
                                    <span>{{ json_decode($applicationDetail->occupancy_detail)->no_of_employee ?? '' }}</span>
                                </div>
                                @endif
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->is_hazardous_material))
                                <div class="col-md-4">
                                    <label class="form-label">Is any hazardous material used : </label><br>
                                    <span>{{ ucfirst(json_decode($applicationDetail->occupancy_detail)->is_hazardous_material) ?? '' }}</span>
                                </div>
                                @endif
                                @if(isset(json_decode($applicationDetail->occupancy_detail)->hazardous_material))
                                <div class="col-md-4">
                                    <label class="form-label">Details of Hazardous Materials : </label><br>
                                    <span>{{ ucfirst(json_decode($applicationDetail->occupancy_detail)->hazardous_material) ?? '' }}</span>
                                </div>
                                @endif
                                <div class="col-md-4">
                                    <label class="form-label">Building Ownership : </label><br>
                                    <span>{{ $applicationDetail->building_ownership }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">GST Pan Tan : </label><br>
                                    <span>{{ $applicationDetail->gst_pan_tan }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">GST Pan Tan No. : </label><br>
                                    <span>{{ $applicationDetail->gst_pan_tan_no }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Project Status : </label><br>
                                    <span>{{ $applicationDetail->project_status }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Latitude : </label><br>
                                    <span>{{ $applicationDetail->latitude }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Longitude : </label><br>
                                    <span>{{ $applicationDetail->longitude }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Email :</label><br>
                                    <span>{{ $applicationDetail->email }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Mobile No : </label><br>
                                    <span>{{ $applicationDetail->mobile_no }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Office Telephone : </label><br>
                                    <span>{{ $applicationDetail->office_telephone }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane text-muted" id="tab5" role="tabpanel">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">District : </label>
                                    <span style="float:right;color:#8c9097;">{{ $districts[0]->name ?? 'NA' }}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Rural / Urban : </label>
                                    <span style="float:right;color:#8c9097;">{{ ucfirst($applicationDetail->rural_urban) ?? 'NA'}}</span>
                                </div>
                                @if($applicationDetail->block)
                                <div class="col-md-4">
                                    <label class="form-label">Block : </label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->block->name) ?? 'NA'}}</span>
                                </div>
                                @endif
                                @if($applicationDetail->panchayat)
                                <div class="col-md-4">
                                    <label class="form-label">Panchayat : </label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->panchayat->name ?? 'NA')}}</span>
                                </div>
                                @endif
                                @if($applicationDetail->tehsil)
                                <div class="col-md-4">
                                    <label class="form-label">Tehsil : </label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->tehsil->name ?? 'NA')}}</span>
                                </div>
                                @endif
                                <div class="col-md-4">
                                    <label class="form-label">Plot / Khasra / Khatauni :</label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->plot_khasra_khatauni ?? 'NA')}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Plot Khasra Khatauni No.:</label>
                                    <span style="float:right;color:#8c9097;">{{$applicationDetail->plot_khasra_khatauni_no ?? 'NA'}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Street :</label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->street) ?? 'NA'}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Village : </label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->village) ?? 'NA'}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">City :</label>
                                    <span style="float:right;color:#8c9097;">{{isset($applicationDetail->city) ? ucfirst($applicationDetail->city) : 'NA'}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Landmark : </label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->landmark) ?? 'NA'}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Pincode : </label>
                                    <span style="float:right;color:#8c9097;">{{ucfirst($applicationDetail->pincode) ?? 'NA'}}</span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane text-muted" id="tab6" role="tabpanel">
                            @if(auth()->user()->type != 0)
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Proprietary Rights :</label><br>
                                    <span>{{ucfirst($applicationDetail->proprietary_rights)}}</span>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Owner Detail : </label><br>
                                    <div class="row">
                                        <div class="Owner Detailscol-md-3">
                                            <span><b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail->owner_detail)->salutation ?? ''}} {{ucfirst(json_decode($applicationDetail->owner_detail)->first_name ?? '')}} {{ucfirst(json_decode($applicationDetail->owner_detail)->middle_name ?? '')}} {{ucfirst(json_decode($applicationDetail->owner_detail)->last_name ?? '')}} </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span> <b style="margin-left:20px">Mobile No : </b>{{json_decode($applicationDetail->owner_detail)->mobile_no ?? ''}} </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span> <b style="margin-left:20px">Percentage Share : </b>{{json_decode($applicationDetail->owner_detail)->percentage_share ?? ''}} </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Point Of Contact : </b>{{ucfirst(json_decode($applicationDetail->owner_detail)->point_of_contact ?? '')}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Contact Person :</label><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span> <b style="margin-left:20px">Person Appointed : </b> {{json_decode($applicationDetail->contact_person)->person_appointed ?? ''}}</span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail->contact_person)->con_salutation ?? ''}} {{ucfirst(json_decode($applicationDetail->contact_person)->con_first_name ?? '')}} {{ucfirst(json_decode($applicationDetail->contact_person)->con_middle_name ?? '')}} {{ucfirst(json_decode($applicationDetail->contact_person)->con_last_name ?? '')}}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Mobile No : </b>{{json_decode($applicationDetail->contact_person)->con_mobile_no ?? ''}}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Email Address : </b> {{json_decode($applicationDetail->contact_person)->con_email ?? ''}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Architect Detail :</label><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Name : </b>{{json_decode($applicationDetail->architect_detail)->arc_salutation ?? ''}} {{ucfirst(json_decode($applicationDetail->architect_detail)->arc_first_name ?? '')}} {{ucfirst(json_decode($applicationDetail->architect_detail)->arc_middle_name ?? '')}} {{ucfirst(json_decode($applicationDetail->architect_detail)->arc_last_name ?? '')}}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Mobile No : </b> {{json_decode($applicationDetail->architect_detail)->architect_mobile_no ?? ''}}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Email Address : </b>{{json_decode($applicationDetail->architect_detail)->architect_email ?? ''}}
                                                <br>
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Firm Gst Pan Tan : </b>{{json_decode($applicationDetail->architect_detail)->firm_gst_pan_tan ?? ''}}
                                            </span>
                                        </div>
                                        <div class="col-md-3">
                                            <span>
                                                <b style="margin-left:20px">Firm Gst Pan Tan No. : </b>{{json_decode($applicationDetail->architect_detail)->firm_gst_pan_tan_no ?? ''}}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div>
                                <div class="col-md-9 mb-2" style="justify-content: center; ">
                                    @if(session()->has('success'))
                                    <div class="alert alert-success fade in alert-dismissible show" style="margin-bottom: 0px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" style="font-size:20px">×</span>
                                        </button>
                                        {{ session()->get('success') }}
                                    </div>
                                    @elseif(session()->has('error'))
                                    <div class="alert alert-danger fade in alert-dismissible show" style="margin-bottom: 0px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true" style="font-size:20px">×</span>
                                        </button>
                                        {{ session()->get('error') }}
                                    </div>
                                    @endif
                                </div>
                                <form action="#" method="post">
                                    @csrf
                                    <div class="col-md-4">
                                        <label class="form-label">Proprietary Rights :</label><br>
                                        <span></span>
                                    </div>
                                    <label class="mt-5">Owner Details : </label>
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="salutation">Salutation<span class="span_required">*</span></label>
                                                <select class="form-control" name="salutation" id="salutation" required>
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name<span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="">

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
                                        <div class="col-md-3 col-sm-6 col-xs-12" hidden>
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="span_required">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12" hidden>
                                            <div class="form-group">
                                                <label class="form-label">Mobile No. <span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="" required maxlength="10" minlength="10">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Percentage Share <span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="percentage_share" name="percentage_share" placeholder="Percentage Share" value="" required maxlength="10" minlength="10">
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Point of Contact <span class="span_required">*</span></label>
                                                <select class="form-control" name="point_of_contact" id="point_of_contact" required="">
                                                    <option value="" disabled="" selected="">Select</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <label class="mt-5">Contact Person : </label>
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="salutation">Person Appointed<span class="span_required">*</span></label>
                                                <select class="form-control" name="person_appointed" id="person_appointed" required="">
                                                    <option value="" disabled="" selected="">Select</option>
                                                    <option value="Director">Director</option>
                                                    <option value="CEO">CEO</option>
                                                    <option value="Proprietor">Proprietor</option>
                                                    <option value="Manager">Manager</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="salutation">Salutation<span class="span_required">*</span></label>
                                                <select class="form-control" name="con_salutation" id="con_salutation" required>
                                                    <option value="" disabled selected>Select</option>
                                                    <option value="Mr">Mr</option>
                                                    <option value="Ms">Ms</option>
                                                    <option value="Mrs">Mrs</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">First Name<span class="span_required">*</span></label>
                                                <input type="text" class="form-control" id="con_first_name" name="con_first_name" placeholder="First Name" value="">

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" id="con_middle_name" name="con_middle_name" placeholder="Middle Name" value="">

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Last Name</label>
                                                <input type="text" class="form-control" id="con_last_name" name="con_last_name" placeholder="Last Name" value="">

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Email <span class="span_required">*</span></label>
                                                <input type="email" class="form-control" id="con_email" name="con_email" placeholder="Email" value="" required>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile No. <span class="span_required">*</span></label>
                                                <input type="number" class="form-control" id="con_mobile_no" name="con_mobile_no" placeholder="Mobile No." value="" required maxlength="10" minlength="10">

                                            </div>
                                        </div>
                                    </div>

                                    <label class="mt-5">Architect Details : </label>
                                    <div class="row" style="margin-top: 0px;">
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="org_salutation">Name</label>
                                                <input type="text" class="form-control" id="architect_name" name="architect_name" placeholder="Enter Name" value="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Mobile No</label>
                                                <input type="text" class="form-control" id="architect_phone" name="architect_phone" placeholder="Enter Phone" value="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Email Address</label>
                                                <input type="text" class="form-control" id="architect_email" name="architect_email" placeholder="Email Address" value="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Firm Gst Pan Tan</label>
                                                <input type="text" class="form-control" id="firm_gst_pan_tan" name="firm_gst_pan_tan" placeholder="Firm Gst Pan Tan" value="" readonly>

                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Firm Gst Pan Tan No</label>
                                                <input type="text" class="form-control" id="firm_gst_pan_tan_no" name="firm_gst_pan_tan_no" placeholder="Firm Gst Pan Tan No." value="" readonly>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-right mt-3">
                                        <button class="save-btn hover-btn btn btn-primary" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                            @endif
                        </div>

                        <div class="tab-pane text-muted" id="tab7" role="tabpanel">

                            <h4 class="font-italic mb-4">Area and Set Back Details क्षेत्रफल एवं सैट बेक विवरण</h4>
                            <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Total Plot Area प्लाट का कुल क्षेत्रफल: </label><br>
                                    <span><b>Area : </b>{{json_decode($applicationDetail->total_plot_area)->total_plot_area ?? ''." Sqmt"}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Total Covered Area कुल आच्छादित क्षेत्रफल : </label><br>
                                    <span>
                                        <b>Area : </b>{{json_decode($applicationDetail->total_covered_area)->total_covered_area ?? ''." Sqmt"}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Ground Floor Covered भू-तल का आच्छादित क्षेत्रफल : </label><br>
                                    <span>
                                        <b>Area : </b>{{json_decode($applicationDetail->ground_floor_covered)->ground_floor_covered ?? ''." Sqmt"}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Max Height Building भवन की अधिकतम ऊँचाई : </label><br>
                                    <span>
                                        <b>Height : </b>{{json_decode($applicationDetail->max_height_building)->max_height_building ?? ''}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. Of Floor तलों की संख्या : </label><br>
                                    <span>{{$applicationDetail->no_of_floor ?? ''}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Basement Covered Area भूमिगत तलों का आच्छादित क्षेत्रफल: </label><br>
                                    <span>
                                        <b>Area : </b>{{json_decode($applicationDetail->basement_covered_area)->basement_covered_area ?? ''." Sqmt"}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No Of Basement भूमिगत तलों की संख्या : </label><br>
                                    <span>{{$applicationDetail->no_of_basement ?? ''}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No Of Blocks ब्लॉकों की संख्या : </label><br>
                                    <span>{{$applicationDetail->no_of_blocks ?? ''}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Height Of Tallest Block सबसे ऊँची ब्लॉक की ऊँचाई : </label><br>
                                    <span>
                                        <b>Height : </b>{{json_decode($applicationDetail->height_of_tallest_block)->height_of_tallest_block ?? ''}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Min Distance Between Blocks ब्लॉकों के बीच न्यूनतम दूरी : </label><br>
                                    <span>
                                        <b>Height : </b>{{json_decode($applicationDetail->min_distance_block)->min_distance_block ?? ''}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Approach Road Width पहुँच मार्ग की चौड़ाई : </label><br>
                                    <span>
                                        <b>Width : </b>{{json_decode($applicationDetail->approach_road_width)->approach_road_width ?? ''}}
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Provision No. of Enterance प्रवेश द्वारों प्रावधानित संख्या : </label><br>
                                    <span>{{$applicationDetail->provision_no_enterance ?? ''}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Provision No. of Exit निकास द्वारों प्रावधानित संख्या : </label><br>
                                    <span>{{$applicationDetail->provision_no_exit ?? ''}}</span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label">Set Back Detail सैट बेक विवरण : </label><br>
                                    <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span><br><br>
                                    <span>
                                        <b>Front Area : </b>{{json_decode($applicationDetail->set_back_detail)->front ?? ''}}<br>
                                        <b>Rear Area : </b>{{json_decode($applicationDetail->set_back_detail)->rear ?? ''}}<br>
                                        <b>Side 1 Area : </b>{{json_decode($applicationDetail->set_back_detail)->side1 ?? ''}}<br>
                                        <b>Side 2 Area : </b>{{json_decode($applicationDetail->set_back_detail)->side2 ?? ''}}<br>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane text-muted" id="tab8" role="tabpanel">
                            <h4 class="font-italic mb-4">Essential Provision Detail</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label">Compartmentation कम्पार्टमेन्टेशन :</label><br><span>{{json_decode($applicationDetail->ess_provision_detail)->compartmentation ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">No. Of Stairs जीने की संख्या: </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->no_of_stairs ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Minimum Width of Stairs जीने की न्यूनतम चौड़ाई : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->width_of_stairs ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Emergency Exit आपातकालीन निकास : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->emergency_exit ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Provision Of Lift : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->provision_of_lift ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Electric Suppy : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->electric_suppy ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Emergency Lighting System आपातकालीन पर्काश व्यवस्था : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->emergency_lighting_system ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Provision Of Smoke : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->provision_of_smoke ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Emergency Lighting System आपातकालीन पर्काश व्यवस्था : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->emergency_lighting_system ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Refuse Area शरणागत स्थल<span class="span_required">*</span></label>: </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->refuse_area ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Travel Distance ट्रैवल डिस्टेन्स: </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->travel_distance ?? ''}} </span>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Other Comment : </label><br>
                                    <span>{{json_decode($applicationDetail->ess_provision_detail)->other_comment ?? ''}} </span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane text-muted" id="tab9" role="tabpanel">
                            <h4 class="font-italic mb-4">Attachments</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <span>
                                        @if(isset(json_decode($applicationDetail->attachments)->reference_letter))
                                        <b>Reference Letter : </b><a href="{{ asset(json_decode($applicationDetail->attachments)->reference_letter)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <span>
                                        @if(isset(json_decode($applicationDetail->attachments)->proposed_map))
                                        <b>Propossed Map : </b><a href="{{ asset(json_decode($applicationDetail->attachments)->proposed_map)}}" target="blank" title="View Propossed Map"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-4">
                                    <span>
                                        @if(isset(json_decode($applicationDetail->attachments)->fire_plan))
                                        <b>Fire Plan : </b><a href="{{ asset(json_decode($applicationDetail->attachments)->fire_plan)}}" target="blank" title="View Fire Plan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a><br>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <h4 class="font-italic mb-4">Payment Challan</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <span>
                                        @if($applicationDetail->challan !='')
                                        <b>Payment Challan : </b><a href="{{ asset($applicationDetail->challan)}}" target="blank" title="View Payment Challan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>      
                      
                    <!-- End Tab content -->  
                </div>


            </div>    
        </div>    
    </div>    
</div>
<!-- end card 2 -->




<!-- card 3 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Application Inspection
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item active" role="presentation"> <a class="nav-link active" data-bs-toggle="tab" role="tab" href="#tab10" aria-selected="false" tabindex="-1">Physical Inspection of Site by FSO </a> </li>
                        <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab11" aria-selected="false" tabindex="-1">Application History</a> </li>
                    </ul>

                    <!--  Tab content -->
                    <div class="tab-content">
                      <div class="tab-pane show active text-muted" id="tab10" role="tabpanel">
                            <div class="text-wrap">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item active" role="presentation"> <a class="nav-link active" id="tab_physical_ins" data-bs-toggle="tab" role="tab" href="#ins_physical_inspection" aria-selected="true" tabindex="-1">Physical Inspection</a> </li>
                                    <li class="nav-item" role="presentation"> <a class="nav-link" id="tab_fire_fighting_provision" data-bs-toggle="tab" role="tab" href="#ins_fire_fighting_provision" aria-selected="false" tabindex="-1">Fire Fighting Provision</a> </li>

                                    <li class="nav-item" role="presentation"> <a class="nav-link" id="tab_builiding_status" data-bs-toggle="tab" role="tab" href="#ins_builiding_status" aria-selected="true">Building Status</a> </li>

                                    <li class="nav-item" role="presentation"> <a class="nav-link" id="tab_special_provision" data-bs-toggle="tab" role="tab" href="#ins_special_provision" aria-selected="false" tabindex="-1">Special Provision</a> </li>

                                    <li class="nav-item" role="presentation"> <a class="nav-link" id="tab_remark_fso" data-bs-toggle="tab" role="tab" href="#ins_remark_fso" aria-selected="false" tabindex="-1">Remark by FSO</a> </li>
                                    <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#ins_remark_cfo" aria-selected="false" tabindex="-1">Remark by CFO</a> </li>
                                    <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#ins_remark_dd" aria-selected="false" tabindex="-1">Remark by DD</a> </li>
                                    <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#ins_revert" aria-selected="false" tabindex="-1">Revert Information</a> </li>
                                </ul>
                                <!-- content -->
                                <div class="tab-content">
                                    <div class="alert alert-success" id="successBlock" style="display:none;"></div>
                                    <div class="alert alert-danger" id="errorBlock" style="display:none;"></div>
                                    <div class="tab-pane show active text-muted" id="ins_physical_inspection" role="tabpanel">
                                        <div class="row">
                                            <form method="POST" enctype="multipart/form-data" id="form_physical">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="application_type" value="established">
                                                    <input type="hidden" name="application_no" id="application_number" value="{{ $applicationDetail->application_no }}">
                                                    <input type="hidden" name="inspection_step" id="inspection_step_physical" value="2">
                                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Does any high tension electric line passing over the site? <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->physical_ins)->line))
                                                            @php
                                                            $line = json_decode($applicationDetail->physical_ins)->line;
                                                            @endphp
                                                            @else
                                                            @php $line = ''; @endphp
                                                            @endif
                                                            <div class="radio-toolbar">
                                                                <input type="radio" id="lineYes" name="line" value="yes" class="rb" @if ($line=='yes' ) checked @endif onclick="highTensionLine(this);">
                                                                <label for="yes" class="rb">Yes</label>
                                                                <input type="radio" id="lineNo" name="line" value="no" class="rb" @if ($line=='no' ) checked @endif onclick="highTensionLine(this);">
                                                                <label for="no" class="rb">No</label>
                                                            </div>
                                                            <span class="error errorPhyIns1"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12 line_status" style="padding-right: 0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">if yes. is it situated on proper safety distance? <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->physical_ins)->line_status))
                                                            @php
                                                            $line_status = json_decode($applicationDetail->physical_ins)->line_status;
                                                            @endphp
                                                            @else
                                                            @php $line_status = ''; @endphp
                                                            @endif
                                                            <div class="radio-toolbar">
                                                                <input type="radio" id="line_status_yes" name="line_status" value="yes" class="rb" @if ($line_status=='yes' ) checked @endif>
                                                                <label for="yes" class="rb">Yes</label>
                                                                <input type="radio" id="line_status_no" name="line_status" value="no" class="rb" @if ($line_status=='no' ) checked @endif>
                                                                <label for="no" class="rb">No</label>
                                                            </div>
                                                            <span class="error errorPhyIns2"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Does fire fighting vehicle approach to the site? <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->physical_ins)->vehicle_approach))
                                                            @php
                                                            $vehicle_approach = json_decode($applicationDetail->physical_ins)->vehicle_approach;
                                                            @endphp
                                                            @else
                                                            @php $vehicle_approach = ''; @endphp
                                                            @endif
                                                            <div class="radio-toolbar">
                                                                <input type="radio" id="vehicle_approach_yes" name="vehicle_approach" value="yes" class="rb" @if ($vehicle_approach=='yes' ) checked @endif required>
                                                                <label for="yes" class="rb">Yes</label>
                                                                <input type="radio" id="vehicle_approach_no" name="vehicle_approach" value="no" class="rb" @if ($vehicle_approach=='no' ) checked @endif required>
                                                                <label for="no" class="rb">No</label>
                                                            </div>
                                                            <span class="error errorPhyIns3"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Does any high inflammable installation situated nearby the building? <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->physical_ins)->inflammable))
                                                            @php
                                                            $inflammable = json_decode($applicationDetail->physical_ins)->inflammable;
                                                            @endphp
                                                            @else
                                                            @php $inflammable = ''; @endphp
                                                            @endif
                                                            <div class="radio-toolbar">
                                                                <input type="radio" id="inflammable_yes" name="inflammable" value="yes" class="rb" @if ($inflammable=='yes' ) checked @endif required>
                                                                <label for="yes" class="rb">Yes</label>
                                                                <input type="radio" id="inflammable_no" name="inflammable" value="no" class="rb" @if ($inflammable=='no' ) checked @endif required>
                                                                <label for="no" class="rb">No</label>
                                                            </div>
                                                            <span class="error errorPhyIns4"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Other <span class="span_required">*</span></label>
                                                            <input type="textarea" class="form-control" id="other" name="other" placeholder="Other" value="{{ json_decode($applicationDetail->physical_ins)->other ?? ''}}" required rows="3">
                                                            <span class="error errorPhyIns5"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Specific Requirement <span class="span_required">*</span></label>
                                                            <input type="textarea" class="form-control" id="specific" name="specific" placeholder="Specific Requirement" value="{{ json_decode($applicationDetail->physical_ins)->specific ?? ''}}" required rows="3">
                                                            <span class="error errorPhyIns5"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->type == 2 && $applicationDetail->status=='for approval' || Auth::user()->type == 3 && $applicationDetail->status=='processed')
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-10 col-xs-12"></div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <button class="save-btn hover-btn btn btn-primary mb-3" type="button" id="savePhysical" style="float:right;">Save & Next</button>
                                                    </div>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-muted" id="ins_fire_fighting_provision" role="tabpanel">
                                        <div class="row">
                                            <form method="POST" enctype="multipart/form-data" id="form_provission">
                                                @csrf

                                                <input type="hidden" name="application_type" value="established">

                                                <input type="hidden" name="application_no" value="{{ $applicationDetail->application_no }}">
                                                <input type="hidden" name="inspection_step" id="inspection_step_fire" value="3">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Under-ground Static water Storage Tank भूमिगत स्थैतिक जल भण्डारण टैंक<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->is_under_ground))
                                                            @php
                                                            $is_under_ground = json_decode($applicationDetail->fire_provission)->is_under_ground;
                                                            @endphp
                                                            @else
                                                            @php $is_under_ground = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="is_under_ground" id="is_under_ground">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($is_under_ground=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($is_under_ground=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns1"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12 is_under_ground_storage" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Under-ground Static water Storage Tank Capacity (Ltr) भूमिगत स्थैतिक जल भण्डारण टैंक की क्षमता (ली0 में)<span class="span_required">*</span></label>
                                                            <input type="number" class="form-control" id="under_ground_storage_capacity" name="under_ground_storage_capacity" placeholder="Under-ground Static water Storage Tank Capacity (Ltr)" value="{{ json_decode($applicationDetail->fire_provission)->under_ground_storage_capacity ?? ''}}">
                                                            <span class="error errorFireIns2"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Pump near underground static water Storage Tank भूमिगत स्थैतिक जल भण्डारण टैंक के पास पम्प (fire pump with minimum Pressure of 3.5 kg/cm² at Remotest Location)<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->is_under_ground_tank))
                                                            @php
                                                            $is_under_ground_tank = json_decode($applicationDetail->fire_provission)->is_under_ground_tank;
                                                            @endphp
                                                            @else
                                                            @php $is_under_ground_tank = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="is_under_ground_tank" id="is_under_ground_tank">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($is_under_ground_tank=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($is_under_ground_tank=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns3"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                                                        <div class="form-group">
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->type_under_ground_tank))
                                                            @php
                                                            $type_under_ground_tank = json_decode($applicationDetail->fire_provission)->type_under_ground_tank;
                                                            @endphp
                                                            @else
                                                            @php $type_under_ground_tank = ''; @endphp
                                                            @endif
                                                            <div class="radio-toolbar">
                                                                <input type="checkbox" id="type1" name="type_electric_under_ground_tank" value="Electric" @if ($type_under_ground_tank=='Electric' ) checked @endif>
                                                                <label for="type1">Electric</label>
                                                                <input type="checkbox" id="type2" name="type_diesel_under_ground_tank" value="Diesel" @if ($type_under_ground_tank=='Diesel' ) checked @endif>
                                                                <label for="type2">Diesel</label>
                                                                <input type="checkbox" id="type3" name="type_jockey_under_ground_tank" value="Jockey" @if ($type_under_ground_tank=='Jockey' ) checked @endif>
                                                                <label for="type3">Jockey</label>
                                                            </div>
                                                            <span class="error errorFireIns4"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Electric Capacity (LPM)<span class="span_required">*</span></label>
                                                            <input type="number" class="form-control" id="electric_ground_tank_capacity" name="electric_ground_tank_capacity" placeholder="Electric Capacity (LPM)" value="{{ json_decode($applicationDetail->fire_provission)->electric_ground_tank_capacity ?? ''}}">
                                                            <span class="error errorFireIns5"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Diesel Capacity (LPM)<span class="span_required">*</span></label>
                                                            <input type="number" class="form-control" id="diesel_ground_tank_capacity" name="diesel_ground_tank_capacity" placeholder="Diesel Capacity (LPM)" value="{{ json_decode($applicationDetail->fire_provission)->diesel_ground_tank_capacity ?? ''}}">
                                                            <span class="error errorFireIns6"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Jockey Capacity (LPM)<span class="span_required">*</span></label>
                                                            <input type="number" class="form-control" id="jockey_ground_tank_capacity" name="jockey_ground_tank_capacity" placeholder="Jockey Capacity (LPM)" value="{{ json_decode($applicationDetail->fire_provission)->jockey_ground_tank_capacity ?? ''}}">
                                                            <span class="error errorFireIns7"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Yard Hydrant<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->yard_hydrant))
                                                            @php
                                                            $yard_hydrant = json_decode($applicationDetail->fire_provission)->yard_hydrant;
                                                            @endphp
                                                            @else
                                                            @php $yard_hydrant = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="yard_hydrant" id="yard_hydrant">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($yard_hydrant=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($yard_hydrant=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns8"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Fire Hose Cabin फायर हौज केविन<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->fire_cabin))
                                                            @php
                                                            $fire_cabin = json_decode($applicationDetail->fire_provission)->fire_cabin;
                                                            @endphp
                                                            @else
                                                            @php $fire_cabin = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fire_cabin" id="fire_cabin">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fire_cabin=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fire_cabin=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns9"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Wet Riser वेट राइ़़जर<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->wet_riser))
                                                            @php
                                                            $wet_riser = json_decode($applicationDetail->fire_provission)->wet_riser;
                                                            @endphp
                                                            @else
                                                            @php $wet_riser = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="wet_riser" id="wet_riser">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($wet_riser=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($wet_riser=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns10"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Is Terrace Tank Respective Tower Terrace क्या सम्बन्धित टैरेस पर टैरेस टैंक है <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->is_terrace_tank))
                                                            @php
                                                            $is_terrace_tank = json_decode($applicationDetail->fire_provission)->is_terrace_tank;
                                                            @endphp
                                                            @else
                                                            @php $is_terrace_tank = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="is_terrace_tank" id="is_terrace_tank">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($is_terrace_tank=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if($is_terrace_tank=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns11"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12 is_terrace_tank">
                                                        <div class="form-group">
                                                            <label class="form-label">Terrace tank capacity of respective tower <span class="span_required">*</span></label>
                                                            <input type="text" class="form-control" name="terrace_tank" placeholder="Terrace tank capacity of respective tower" value="{{ json_decode($applicationDetail->fire_provission)->terrace_tank ?? ''}}" rows="3">
                                                            @if($errors->has('terrace_tank'))
                                                            <div class="validation-error">{{ $errors->first('terrace_tank') }}</div>
                                                            @endif
                                                            <span class="error errorFireIns12"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Is Terrace pump क्या टैरेस पम्प है?<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->is_terrace_pump))
                                                            @php
                                                            $is_terrace_pump = json_decode($applicationDetail->fire_provission)->is_terrace_pump;
                                                            @endphp
                                                            @else
                                                            @php $is_terrace_pump = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="is_terrace_pump" id="is_terrace_pump">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($is_terrace_pump=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($is_terrace_pump=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns13"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12 is_terrace_pump">
                                                        <div class="form-group">
                                                            <label class="form-label">Terrace pump Capacity (LPM) टैरेस पम्प की क्षमता (लीटर पर्ति मिनट) <span class="span_required">*</span></label>
                                                            <input type="text" class="form-control" id="terrace_pump_capacity" name="terrace_pump_capacity" placeholder="Terrace pump capacity (LPM)" value="{{ json_decode($applicationDetail->fire_provission)->terrace_pump_capacity ?? ''}}">
                                                            <span class="error errorFireIns14"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Down Comer डाउन कमर<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->down_comer))
                                                            @php
                                                            $down_comer = json_decode($applicationDetail->fire_provission)->down_comer;
                                                            @endphp
                                                            @else
                                                            @php $down_comer = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="down_comer" id="down_comer">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($down_comer=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($down_comer=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns15"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">First Aid Hose Real प्राथमिक हौजरील<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->first_aid))
                                                            @php
                                                            $first_aid = json_decode($applicationDetail->fire_provission)->first_aid;
                                                            @endphp
                                                            @else
                                                            @php $first_aid = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="first_aid" id="first_aid">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($first_aid=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($first_aid=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns16"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Landing valve लैण्डिंग वाल्व<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->landing_valve))
                                                            @php
                                                            $landing_valve = json_decode($applicationDetail->fire_provission)->landing_valve;
                                                            @endphp
                                                            @else
                                                            @php $landing_valve = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="landing_valve" id="landing_valve">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($landing_valve=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($landing_valve=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns17"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Manually Operated Electronic Fire Alarm System मानव चालित इलैक्टॉनिक फायर अलार्म सिस्टम<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->manual_alarm))
                                                            @php
                                                            $manual_alarm = json_decode($applicationDetail->fire_provission)->manual_alarm;
                                                            @endphp
                                                            @else
                                                            @php $manual_alarm = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="manual_alarm" id="manual_alarm">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($manual_alarm=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($manual_alarm=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns18"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-label">Automatic Detection and Alarm System स्वचालित डिटेक्शन एवं अलार्म सिस्टम<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->automatic_alarm))
                                                            @php
                                                            $automatic_alarm = json_decode($applicationDetail->fire_provission)->automatic_alarm;
                                                            @endphp
                                                            @else
                                                            @php $automatic_alarm = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="automatic_alarm" id="automatic_alarm">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($automatic_alarm=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($automatic_alarm=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns19"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Automatic Sprinkler System स्वचालित स्प्रिंक्लर्स सिस्टम <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->automatic_sprinkler))
                                                            @php
                                                            $automatic_sprinkler = json_decode($applicationDetail->fire_provission)->automatic_sprinkler;
                                                            @endphp
                                                            @else
                                                            @php $automatic_sprinkler = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="automatic_sprinkler" id="automatic_sprinkler">
                                                                <option value="">Select</option>
                                                                <option value="Not Required" @if ($automatic_sprinkler=='Not Required' ) selected @endif>Not Required</option>
                                                                <option value="Required in Basement" @if ($automatic_sprinkler=='Required in Basement' ) selected @endif>Required in Basement</option>
                                                                <option value="Required in Whole Building" @if ($automatic_sprinkler=='Required in Whole Building' ) selected @endif>Required in Whole Building</option>
                                                            </select>
                                                            <span class="error errorFireIns20"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0;">
                                                        <div class="form-group">
                                                            <label class="form-label">Fire Extinguisher फायर एक्सटिंग्यूशर<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->fire_provission)->fire_extinguisher))
                                                            @php
                                                            $fire_extinguisher = json_decode($applicationDetail->fire_provission)->fire_extinguisher;
                                                            @endphp
                                                            @else
                                                            @php $fire_extinguisher = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fire_extinguisher" id="fire_extinguisher">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fire_extinguisher=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fire_extinguisher=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorFireIns21"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->type == 2 && $applicationDetail->status=='for approval' || Auth::user()->type == 3 && $applicationDetail->status=='processed')
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <button class="save-btn hover-btn btn btn-danger mb-3" type="button" id="backToPhysical">Back</button>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <button class="save-btn hover-btn btn btn-primary mb-3" type="button" id="saveFireFighting" style="float:right;">Save & Next</button>
                                                    </div>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-muted" id="ins_builiding_status" role="tabpanel">
                                        <div class="row">
                                            <form method="POST" enctype="multipart/form-data" id="form_building">
                                                @csrf
                                                <input type="hidden" name="application_type" value="established">
                                                <input type="hidden" name="application_no" value="{{ $applicationDetail->application_no }}">
                                                <input type="hidden" name="inspection_step" id="inspection_step_build" value="4">
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Set Back सैट बेक <span class="span_required">*</span></label>
                                                            <input type="text" class="form-control" id="set_back" name="set_back" placeholder="Set Back" value="{{ json_decode($applicationDetail->building_status)->set_back ?? ''}}" rows="3">
                                                            @if($errors->has('set_back'))
                                                            <div class="validation-error">{{ $errors->first('set_back') }}</div>
                                                            @endif
                                                            <span class="error errorBuildIns1"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Compartmentation कम्पार्टमेन्टेशन<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->compartmentation))
                                                            @php
                                                            $compartmentation = json_decode($applicationDetail->building_status)->compartmentation;
                                                            @endphp
                                                            @else
                                                            @php $compartmentation = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="compartmentation" id="compartmentation">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($compartmentation=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($compartmentation=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns2"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Minimum Width of Stairs जीने की न्यूनतम चौड़ाई <span class="span_required">*</span></label>
                                                            <input type="number" class="form-control" id="stair_width" name="stair_width" placeholder="Minimum Width of Stairs" value="{{ json_decode($applicationDetail->building_status)->stair_width ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$">
                                                            @if($errors->has('stair_width'))
                                                            <div class="validation-error">{{ $errors->first('stair_width') }}</div>
                                                            @endif
                                                            <span class="error errorBuildIns3"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Fire Hose Cabin फायर हौज केविन <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->fire_cabin))
                                                            @php
                                                            $fire_cabin = json_decode($applicationDetail->building_status)->fire_cabin;
                                                            @endphp
                                                            @else
                                                            @php $fire_cabin = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fire_cabin" id="fire_cabin">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fire_cabin=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fire_cabin=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns4"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">No. of Stairs in Each Block प्रत्येक ब्लॉक में जीने की संख्या <span class="span_required">*</span></label>
                                                            <input type="number" class="form-control" id="stair_in_block" name="stair_in_block" placeholder="No. of Stairs in Each Block" value="{{ json_decode($applicationDetail->building_status)->stair_in_block ?? ''}}" rows="3">
                                                            @if($errors->has('stair_in_block'))
                                                            <div class="validation-error">{{ $errors->first('stair_in_block') }}</div>
                                                            @endif
                                                            <span class="error errorBuildIns5"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Emergency Exit आपातकालीन निकास <span class="span_required">*</span></label>
                                                            <input type="number" class="form-control" id="emergency_exit" name="emergency_exit" placeholder="Emergency Exit" value="{{ json_decode($applicationDetail->building_status)->emergency_exit ?? ''}}" rows="3">
                                                            @if($errors->has('emergency_exit'))
                                                            <div class="validation-error">{{ $errors->first('emergency_exit') }}</div>
                                                            @endif
                                                            <span class="error errorBuildIns6"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Fireman switch in lift लिफ्ट में फायरमैन स्विच का प्राविधान<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->fire_switch))
                                                            @php
                                                            $fire_switch = json_decode($applicationDetail->building_status)->fire_switch;
                                                            @endphp
                                                            @else
                                                            @php $fire_switch = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fire_switch" id="fire_switch">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fire_switch=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fire_switch=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns7"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Alternative Electric Supply वैकल्पिक विद्युत व्यवस्था<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->alt_electric))
                                                            @php
                                                            $alt_electric = json_decode($applicationDetail->building_status)->alt_electric;
                                                            @endphp
                                                            @else
                                                            @php $alt_electric = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="alt_electric" id="alt_electric">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($alt_electric=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($alt_electric=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns8"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Emergency lighting system आपातकालीन पर्काश व्यवस्था <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->emergency_light))
                                                            @php
                                                            $emergency_light = json_decode($applicationDetail->building_status)->emergency_light;
                                                            @endphp
                                                            @else
                                                            @php $emergency_light = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="emergency_light" id="emergency_light">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($emergency_light=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($emergency_light=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns9"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Fluorescent exit sign <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->fluorescent_exit))
                                                            @php
                                                            $fluorescent_exit = json_decode($applicationDetail->building_status)->fluorescent_exit;
                                                            @endphp
                                                            @else
                                                            @php $fluorescent_exit = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fluorescent_exit" id="fluorescent_exit">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fluorescent_exit=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fluorescent_exit=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns10"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Provision of Smoke/Fire check Doors धुआँ/फायर चैक डोर का प्राविधान<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->pro_smoke))
                                                            @php
                                                            $pro_smoke = json_decode($applicationDetail->building_status)->pro_smoke;
                                                            @endphp
                                                            @else
                                                            @php $pro_smoke = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="pro_smoke" id="pro_smoke">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($pro_smoke=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($pro_smoke=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns11"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Refuse area in case of high rise buildings बहुमंजिला इमारतों के मामले में शरणागत स्थल<span class="span_required">*</span></label> <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->refuse_area))
                                                            @php
                                                            $refuse_area = json_decode($applicationDetail->building_status)->refuse_area;
                                                            @endphp
                                                            @else
                                                            @php $refuse_area = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="refuse_area" id="refuse_area">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($refuse_area=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($refuse_area=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns12"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Maximum Travel Distance in Building भवन में अधिकतम ट्रैवल डिस्टेन्स<span class="span_required">*</span></label>
                                                            <input type="text" class="form-control" id="max_travel" name="max_travel" placeholder="Maximum Travel Distance in Building " value="{{ json_decode($applicationDetail->building_status)->max_travel ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$">
                                                            @if($errors->has('max_travel'))
                                                            <div class="validation-error">{{ $errors->first('max_travel') }}</div>
                                                            @endif
                                                            <span class="error errorBuildIns13"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Electric Installation(ELCB,MCB) ईएलसीबी/एमसीबी आधारित विद्युत व्यवस्थापन <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->building_status)->elec_install))
                                                            @php
                                                            $elec_install = json_decode($applicationDetail->building_status)->elec_install;
                                                            @endphp
                                                            @else
                                                            @php $elec_install = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="elec_install" id="elec_install">
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($elec_install=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($elec_install=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorBuildIns14"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->type == 2 && $applicationDetail->status=='for approval' || Auth::user()->type == 3 && $applicationDetail->status=='processed')
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <button class="save-btn hover-btn btn btn-danger mb-3" type="button" id="backToFire">Back</button>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <button class="save-btn hover-btn btn btn-primary mb-3" type="button" id="saveBuildingStatus" style="float:right;">Save & Next</button>
                                                    </div>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-muted" id="ins_special_provision" role="tabpanel">
                                        <div class="row">

                                            <form method="POST" enctype="multipart/form-data" action="" id="form_special">
                                                @csrf

                                                <input type="hidden" name="application_type" value="established">

                                                <input type="hidden" name="application_no" value="{{ $applicationDetail->application_no }}">
                                                <input type="hidden" name="inspection_step" value="5">

                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="input-username">Smoke Extraction System धुआँ निकासी प्रणाली<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->smoke_extraction))
                                                            @php
                                                            $smoke_extraction = json_decode($applicationDetail->special_provission)->smoke_extraction;
                                                            @endphp
                                                            @else
                                                            @php $smoke_extraction = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="smoke_extraction" id="smoke_extraction" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($smoke_extraction=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($smoke_extraction=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns1"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Fresh Air Induction System ताजा वायु प्रेरण प्रणाली <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->fresh_air))
                                                            @php
                                                            $fresh_air = json_decode($applicationDetail->special_provission)->fresh_air;
                                                            @endphp
                                                            @else
                                                            @php $fresh_air = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fresh_air" id="fresh_air" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fresh_air=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fresh_air=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns2"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Response Indicator प्रतिक्रिया संकेतक <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->response_indicator))
                                                            @php
                                                            $response_indicator = json_decode($applicationDetail->special_provission)->response_indicator;
                                                            @endphp
                                                            @else
                                                            @php $response_indicator = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="response_indicator" id="response_indicator" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($response_indicator=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($response_indicator=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns3"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="">Water Spray System जल स्प्रे प्रणाली<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->water_spray))
                                                            @php
                                                            $water_spray = json_decode($applicationDetail->special_provission)->water_spray;
                                                            @endphp
                                                            @else
                                                            @php $water_spray = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="water_spray" id="water_spray" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($water_spray=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($water_spray=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns4"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Foam Spray System फोम स्प्रे प्रणाली<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->foam_spray))
                                                            @php
                                                            $foam_spray = json_decode($applicationDetail->special_provission)->foam_spray;
                                                            @endphp
                                                            @else
                                                            @php $foam_spray = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="foam_spray" id="foam_spray" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($foam_spray=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($foam_spray=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns5"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Gas type flooding system गैसीय फ्लडिंग प्रणाली<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->flooding_system))
                                                            @php
                                                            $flooding_system = json_decode($applicationDetail->special_provission)->flooding_system;
                                                            @endphp
                                                            @else
                                                            @php $flooding_system = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="flooding_system" id="flooding_system" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($flooding_system=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($flooding_system=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns6"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Fireman switch in lift लिफ्ट में फायरमैन स्विच का प्राविधान<span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->fire_switch_lift))
                                                            @php
                                                            $fire_switch_lift = json_decode($applicationDetail->special_provission)->fire_switch_lift;
                                                            @endphp
                                                            @else
                                                            @php $fire_switch_lift = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fire_switch_lift" id="fire_switch_lift" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fire_switch_lift=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fire_switch_lift=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns7"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Fire Cart Room <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->fire_cart))
                                                            @php
                                                            $fire_cart = json_decode($applicationDetail->special_provission)->fire_cart;
                                                            @endphp
                                                            @else
                                                            @php $fire_cart = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fire_cart" id="fire_cart" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fire_cart=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fire_cart=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns8"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Beam Detector <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->beam_detector))
                                                            @php
                                                            $beam_detector = json_decode($applicationDetail->special_provission)->beam_detector;
                                                            @endphp
                                                            @else
                                                            @php $beam_detector = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="beam_detector" id="beam_detector" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($beam_detector=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($beam_detector=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns9"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Gas Detector <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->gas_detector))
                                                            @php
                                                            $gas_detector = json_decode($applicationDetail->special_provission)->gas_detector;
                                                            @endphp
                                                            @else
                                                            @php $gas_detector = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="gas_detector" id="gas_detector" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($gas_detector=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($gas_detector=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns10"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Fire Bucket <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->fire_bucket))
                                                            @php
                                                            $fire_bucket = json_decode($applicationDetail->special_provission)->fire_bucket;
                                                            @endphp
                                                            @else
                                                            @php $fire_bucket = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="fire_bucket" id="fire_bucket" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($fire_bucket=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($fire_bucket=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns11"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Emergency No <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->emergency_no))
                                                            @php
                                                            $emergency_no = json_decode($applicationDetail->special_provission)->emergency_no;
                                                            @endphp
                                                            @else
                                                            @php $emergency_no = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="emergency_no" id="emergency_no" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($emergency_no=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($emergency_no=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns12"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Fire Safety Trained Staff <span class="span_required">*</span></label>
                                                            @if(isset(json_decode($applicationDetail->special_provission)->trained_staff))
                                                            @php
                                                            $trained_staff = json_decode($applicationDetail->special_provission)->trained_staff;
                                                            @endphp
                                                            @else
                                                            @php $trained_staff = ''; @endphp
                                                            @endif
                                                            <select class="form-control" name="trained_staff" id="trained_staff" required>
                                                                <option value="">Select</option>
                                                                <option value="Required" @if ($trained_staff=='Required' ) selected @endif>Required</option>
                                                                <option value="Not Required" @if ($trained_staff=='Not Required' ) selected @endif>Not Required</option>
                                                            </select>
                                                            <span class="error errorSpecialIns13"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <div class="form-group">
                                                            <label class="form-label">Other Comment <span class="span_required">*</span></label>
                                                            <input type="text" class="form-control" id="other_comment" name="other_comment" placeholder="Other Comment  " value="{{ json_decode($applicationDetail->special_provission)->other_comment ?? ''}}" required rows="3">
                                                            @if($errors->has('other_comment'))
                                                            <div class="validation-error">{{ $errors->first('other_comment') }}</div>
                                                            @endif
                                                            <span class="error errorSpecialIns14"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if(Auth::user()->type == 2 && $applicationDetail->status=='for approval' || Auth::user()->type == 3 && $applicationDetail->status=='processed')
                                                <div class="row">
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <button class="save-btn hover-btn btn btn-danger mb-3" type="button" id="backToBuilding">Back</button>
                                                    </div>
                                                    <div class="col-lg-6 col-sm-10 col-xs-12">
                                                        <button class="save-btn hover-btn btn btn-primary mb-3" type="button" id="saveSpecial" style="float:right;">Save & Next</button>
                                                    </div>
                                                </div>
                                                @endif
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane text-muted" id="ins_remark_fso" role="tabpanel">
                                        <div class="row">
                                            @if(Auth::user()->type == 3 && $applicationDetail->remark_by_fso == "")
                                            <form enctype="multipart/form-data" id="revert-form" action="{{route('fso.remark')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <input type="hidden" name="application_type" value="established">
                                                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">
                                                    <input type="hidden" name="inspection_step" value="5">

                                                    <div class="col-md-12">
                                                        <div class="form-group" style="margin-top:20px;">
                                                            <label class="form-label">Reason*</label>
                                                            <div class="radio-toolbar">
                                                                <label><input type="checkbox" id="reason1" name="reason1" value="Applicant shall take pre operational NOC before occupied (operation) the building" style="margin-right: 10px;height: auto;">Applicant shall take pre operational NOC before occupied (operation) the building</label><br>
                                                                <label><input type="checkbox" id="reason2" name="reason2" value="Applicant shall inform fire department in case of change in the map" style="margin-right: 10px;height: auto;">Applicant shall inform fire department in case of change in the map</label><br>
                                                                <label><input type="checkbox" id="reason3" name="reason3" value="The construction shall not violate the NBC Part-IV norms or state building by-Laws" style="margin-right: 10px;height: auto;">The construction shall not violate the NBC Part-IV norms or state building by-Laws</label><br>
                                                                <label><input type="checkbox" id="reason4" name="reason4" value="This certificate shall not valid for illegal construction" style="margin-right: 10px;height: auto;">This certificate shall not valid for illegal construction</label><br>
                                                                <label><input type="checkbox" id="reason5" name="reason5" value="Applicant must submit his declaration certificate (working condition of fire safety system) in every 6 month" style="margin-right: 10px;height: auto;">Applicant must submit his declaration certificate (working condition of fire safety system) in every 6 month</label><br>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <textarea class="form-control" maxlength="512" name="remark_by_fso" placeholder="Enter Remark" style="height:100px;" required></textarea>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label class="form-label" style="margin-top:20px;">Support Document (Optional)</label>
                                                        <input type="file" class="form-control" id="attachment" name="attachment" style="margin-bottom:20px;">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button class="save-btn hover-btn btn btn-danger mb-3" type="button" id="backToSpecial">Back</button>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <button type="submit" class="btn btn-primary" style="float:right;">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                            @endif
                                            @if(isset($applicationDetail->remark_by_fso))
                                                @foreach(json_decode($applicationDetail->remark_by_fso) as $key => $remark)
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">{{$key + 1}}. {{ucfirst($remark->remark)}}</label><br>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span>{{$remark->date}}</span>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
                                                        <label class="form-label">Remarks : </label><br>
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

                                                <div class="row mb-3">
                                                    <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
                                                        @if(isset($remark->attachment))
                                                        <b>Supportive Document :</b><a href="{{ asset($remark->attachment)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
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
                                    </div>
                                    <div class="tab-pane text-muted" id="ins_remark_cfo" role="tabpanel">
                                        <div class="row">

                                            @if(Auth::user()->type == 2 && $applicationDetail->remark_by_cfo == "")
                                            <form enctype="multipart/form-data" id="revert-form" action="{{route('cfo.remark')}}" method="post">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="application_type" value="established">
                                                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">
                                                    <div class="form-group" style="margin-left:20px;margin-top:20px;">
                                                        <label class="form-label">Reason*</label>
                                                        <div class="radio-toolbar">
                                                            <label><input type="checkbox" id="reason1" name="reason1" value="Applicant shall take pre operational NOC before occupied (operation) the building" style="margin-right: 10px;height: auto;">Applicant shall take pre operational NOC before occupie (operation) the building</label><br>
                                                            <label><input type="checkbox" id="reason2" name="reason2" value="Applicant shall inform fire department in case of change in the map" style="margin-right: 10px;height: auto;">Applicant shall inform fire department in case of change in the map</label><br>
                                                            <label><input type="checkbox" id="reason3" name="reason3" value="The construction shall not violate the NBC Part-IV norms or state building by-Laws" style="margin-right: 10px;height: auto;">The construction shall not violate the NBC Part-IV norms and state building by-Laws</label><br>
                                                            <label><input type="checkbox" id="reason4" name="reason4" value="This certificate shall not valid for illegal construction" style="margin-right: 10px;height: auto;">This certificate shall not valid for illegal construction</label><br>
                                                            <label><input type="checkbox" id="reason5" name="reason5" value="Applicant must submit his declaration certificate (working condition of fire safety system) in every 6 month" style="margin-right: 10px;height: auto;">Applicant must submit his declaration certificate (working condition of fire safety system) in every 6 month</label><br>
                                                        </div>
                                                        <textarea class="form-control" maxlength="512" name="remark_by_cfo" placeholder="Enter Remark" style="height:100px;width:600px;margin:20px auto auto auto;" required></textarea>


                                                        <label class="form-label text-center" style="margin:20px auto auto 13pc;">Support Document (Optional)</label>
                                                        <input type="file" class="form-control" id="attachment" name="attachment" style="height:50px;width:600px;margin:20px auto auto auto;">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                            @endif
                                            @if(isset($applicationDetail->remark_by_cfo))
                                            @foreach(json_decode($applicationDetail->remark_by_cfo) as $key => $remark)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">{{$key + 1}}. {{ucfirst($remark->remark)}}</label><br>
                                                </div>
                                                <div class="col-md-4">
                                                    <span>{{$remark->date}}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
                                                    <label class="form-label">Remarks : </label><br>
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

                                            <div class="row mb-3">
                                                <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
                                                    @if(isset($remark->attachment))
                                                    <b>Supportive Document :</b><a href="{{ asset($remark->attachment)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
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
                                    </div>
                                    <div class="tab-pane text-muted" id="ins_remark_dd" role="tabpanel">
                                        <div class="row">


                                            @if(isset($applicationDetail->remark_by_dd))
                                            @foreach(json_decode($applicationDetail->remark_by_dd) as $key => $remark)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">{{$key + 1}}. {{ucfirst($remark->remark)}}</label><br>
                                                </div>
                                                <div class="col-md-4">
                                                    <span>{{$remark->date}}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
                                                    @if(isset($remark->attachment))
                                                    <b>Supportive Document :</b><a href="{{ asset($remark->attachment)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;"></a>
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
                                    </div>
                                    <div class="tab-pane text-muted" id="ins_revert" role="tabpanel">
                                        <div class="row">

                                            @if(isset($applicationDetail->revert))
                                            @foreach(json_decode($applicationDetail->revert) as $revert)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Revert Information : </label><br>
                                                    <span>{{ucfirst($revert->revert)}}</span>
                                                </div>
                                                <div class="col-md-4">
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

                        <div class="tab-pane text-muted" id="tab11" role="tabpanel">
                            <h4 class="font-italic mb-4">Application History</h4>
                            @if(isset($applicationDetail->history))
                            <div class="row mb-3">
                                @foreach(json_decode($applicationDetail->history) as $history)
                                <div class="col-md-12">
                                    <div class="desc" style="padding:20px;background:rgb(243,251,232);">
                                        <div class="grouping_div" style="border: 2px solid rgb(118,133,172);margin: 0px auto;width: 70%;padding:15px;">
                                            <div class="thumb">
                                                <span class="badge bg-theme" style="display:inline"><i class="fa fa-clock-o" style="font-size:18px;color:blue;"></i></span>
                                                <p style="display:inline-block;font-size:14px;margin-left:15px">
                                                    <muted>{{date('Y-m-d h:i:sa', strtotime($history->date))}}</muted>
                                                </p>
                                            </div>
                                            <div class="details" style="font-size:14px;padding-left:40px">
                                                <p style="color:#1c90c0;">{{$history->history}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="row mb-3">
                                <h4 style="text-align:center;">No Remark Found</h4>
                            </div>
                            @endif
                        </div>
                        @if(Auth::user()->type == 2 && $applicationDetail->assigned_id =='')
                        <form action="{{route('admin.assignedNocToFSO')}}" method="post" style="margin-top:10px;">
                            @csrf
                            <input type="hidden" name="application_type" value="established">
                            <div class="row">
                                <input type="hidden" name="id" value="{{$applicationDetail->id}}">
                                <div class="col-md-2">
                                    <label class="control-label required" style="text-align: left;" for="FireReport_category"><strong>Assign Request To: </strong></label>
                                </div>
                                <div class="col-md-8">
                                    <select class="form-control" name="assigned_id" id="assigned_id" required>
                                        <option value="">--Select FSO--</option>
                                        @foreach ($users as $usr)
                                        <option value="{{$usr->id}}">{{$usr->station->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <input class="btn btn-success" type="submit" value="Assign" style="width:100%;">
                                </div>
                            </div>
                        </form>
                        @endif
                        @if(Auth::user()->type == 2 )
                        <div class="row" style="margin-top:10px;">
                            @if($applicationDetail->status=='for approval' || $applicationDetail->status=='pre approved')
                            <div class="col-md-6">
                                <button type="button" id="send-for-review-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revert_modal">Revert</button>
                            </div>
                            @if($applicationDetail->large_small_category =='1' && $applicationDetail->status=='pre approved')
                            @if($applicationDetail->remark_by_cfo =='')
                            <div class="col-md-6">
                                <button title="Approve Application" onclick="return alert('Please enter remark before Approved')" type="button" class="btn btn-success" style="padding: 10px;float:right;">Approve</button>
                            </div>
                            @else
                            <div class="col-md-6">
                                <button data-bs-toggle="modal" data-bs-target="#approved_modal" title="Approve Application" type="button" class="btn btn-success" style="padding: 10px;float:right;">Approve </button>
                            </div>
                            @endif
                            @elseif($applicationDetail->large_small_category =='0')
                            @if($applicationDetail->remark_by_cfo =='')
                            <div class="col-md-6">
                                <button title="Approve Application" data-bs-toggle="modal" data-bs-target="#approved_modal" onclick="return alert('Please enter remark before Approved')" type="button" class="btn btn-success" style="padding: 10px;float:right;">Approve</button>
                            </div>
                            @else
                            <div class="col-md-6">
                                <button data-bs-toggle="modal" data-bs-target="#approved_modal" title="Approve Application" type="button" class="btn btn-success" style="padding: 10px;float:right;">Approve </button>
                            </div>
                            @endif
                            @endif
                            @if($applicationDetail->large_small_category =='1' && $applicationDetail->status=='for approval')
                            <div class="col-md-6">
                                <form action="{{route('cfo.pre.approval')}}" method="POST" enctype="multipart/form-data" style="margin-left: 20px;">
                                    @csrf
                                    <input type="hidden" name="application_type" value="established">
                                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">
                                    <button title="Pre Approval Application" type="submit" class="btn btn-success" style="padding: 10px;float:right;">Pre Approval </button>
                                </form>
                            </div>
                            @endif
                            @elseif($applicationDetail->status=='pending')
                            <div class="col-md-6">
                                <button type="button" id="send-for-review-btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#revert_modal">Revert</button>
                            </div>
                            @endif
                        </div>
                        @elseif(Auth::user()->type == 1 )
                        <div class="row" style="margin-top:10px;">
                            <div class="col-md-6">
                                <button type="button" id="send-for-review-btn" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#revert_modal" style="padding: 10px;">Revert</button>
                            </div>
                            @if($applicationDetail->status=='pre approval')
                            <div class="col-md-6">
                                <button type="button" id="pre-approved-btn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#pre_approved_modal" style="padding:10px;margin-left:10px;float:right;">Pre Approved</button>
                            </div>
                            @endif
                            @if($applicationDetail->assigned_cfo=='0')
                            <div class="col-md-6">
                                <form action="{{route('dd.assignedTo.cfo')}}" method="POST" enctype="multipart/form-data" style="margin-left: 20px;">
                                    @csrf
                                    <input type="hidden" name="application_type" value="established">
                                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">
                                    <button title="Approve Application" type="submit" class="btn btn-success" style="padding: 10px;float:right;"> Assign To CFO </button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @elseif(Auth::user()->type == 3)
                        @if($applicationDetail->status=='processed')
                        <div class="row" style="margin-top:10px;">
                            @if($applicationDetail->physical_ins !='' && $applicationDetail->fire_provission !='' && $applicationDetail->building_status !='' && $applicationDetail->special_provission !='' && $applicationDetail->remark_by_fso !='')
                            <div class="col-md-6">
                                <button type="button" id="send-for-review-btn" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#revert_modal" style="padding: 10px;">Revert</button>
                            </div>
                            <div class="col-md-6 text-right">
                                <form action="{{route('fso.approval')}}" method="POST" enctype="multipart/form-data" style="margin-left: 20px;">
                                    @csrf
                                    <input type="hidden" name="application_type" value="established">
                                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">
                                    <button title="Send For Approval" onclick="return confirm('Are you sure you Want to Send For Approval ?')" type="submit" class="btn btn-success" style="float: right;">Send For Approval </button>
                                </form>
                            </div>
                            @endif
                        </div>
                        @endif
                        @endif
                    </div>      
                      
                    <!-- End Tab content -->  
                </div>


            </div>    
        </div>    
    </div>    
</div>
<!-- end card 3 -->




<!-- Modal Revert -->
<div class="modal fade" id="revert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:700px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Revert</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="revert-form" action="{{route('cfo.revert')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="application_type" value="established">
                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">
                    <div class="form-group" style="margin-left:20px;margin-top:20px;">
                        <label class="form-label">Reason*</label>
                        <div class="radio-toolbar">
                            <label><input type="checkbox" id="reason1" name="reason1" value="Required documents are not attached/complete आवश्यक दस्तावेज पूर्ण/संलग्न नहीं हैं।" style="margin-right: 10px;height: auto;">Required documents are not attached/complete आवश्यक दस्तावेज पूर्ण/संलग्न नहीं हैं।</label><br>

                            <label><input type="checkbox" id="reason2" name="reason2" value="Building name/address is not correct भवन का नाम/पता सही नहीं है।" style="margin-right: 10px;height: auto;">Building name/address is not correct भवन का नाम/पता सही नहीं है।</label><br>

                            <label><input type="checkbox" id="reason3" name="reason3" value="Required fields have not been correctly filled/provided information is not correct आवश्यक फ़ील्ड सही ढंग से नहीं भरे गए हैं/दी गई जानकारी सही नहीं है।" style="margin-right: 10px;height: auto;">Required fields have not been correctly filled/provided information is not correct आवश्यक फ़ील्ड सही ढंग से नहीं भरे गए हैं/दी गई जानकारी सही नहीं है। </label><br>

                            <label><input type="checkbox" id="reason4" name="reason4" value="Sufficient Fire equipments are not installed in the building भवन में पर्याप्त अग्नि सुरक्षा व्यवस्था/उपकरण स्थापित नहीं हैं।" style="margin-right: 10px;height: auto;">Sufficient Fire equipments are not installed in the building भवन में पर्याप्त अग्नि सुरक्षा व्यवस्था/उपकरण स्थापित नहीं हैं।</label><br>

                            <label><input type="checkbox" id="reason5" name="reason5" value="High tension line is passing over the building/have not enough safety distance from the building हाई टेंशन लाइन भवन के ऊपर से गुजर रही है/इमारत से पर्याप्त सुरक्षित दूरी पर नहीं है।" style="margin-right: 10px;height: auto;">High tension line is passing over the building/have not enough safety distance from the building हाई टेंशन लाइन भवन के ऊपर से गुजर रही है/इमारत से पर्याप्त सुरक्षित दूरी पर नहीं है।</label><br>

                            <label><input type="checkbox" id="reason6" name="reason6" value="Approach road is not provided पहुँच मार्ग पर्याप्त/उपलब्ध नहीं है।" style="margin-right: 10px;height: auto;">Approach road is not provided पहुँच मार्ग पर्याप्त/उपलब्ध नहीं है।</label><br>

                            <label><input type="checkbox" id="reason7" name="reason7" value="Site inspection could not be done due to unavailability of the address of land प्रश्नगत स्थल का पता सही नहीं होने के कारण स्थल निरीक्षण नहीं हो सका है।" style="margin-right: 10px;height: auto;">Site inspection could not be done due to unavailability of the address of land प्रश्नगत स्थल का पता सही नहीं होने के कारण स्थल निरीक्षण नहीं हो सका है।</label><br>

                            <label><input type="checkbox" id="reason8" name="reason8" value="Travel distance is not sufficient/emergency exit not provided as per norms ट्रैवल डिस्टेन्स पर्याप्त नहीं है/आपातकालीन निकास मानकों के अनुसार प्रदान नहीं किया गया है।" style="margin-right: 10px;height: auto;">Travel distance is not sufficient/emergency exit not provided as per norms ट्रैवल डिस्टेन्स पर्याप्त नहीं है/आपातकालीन निकास मानकों के अनुसार प्रदान नहीं किया गया है।</label><br>

                            <label><input type="checkbox" id="reason10" name="reason10" value="Set Back Area are not sufficient/not provided as per norms सैट बैक एरिया पर्याप्त नहीं है/मानकों के अनुसार प्रदान नहीं किया गया है।" style="margin-right: 10px;height: auto;">Set Back Area are not sufficient/not provided as per norms सैट बैक एरिया पर्याप्त नहीं है/मानकों के अनुसार प्रदान नहीं किया गया है।</label><br>
                            <label><input type="checkbox" id="reason9" name="reason9" value="Other comment" style="margin-right: 10px;height: auto;">Other comment अन्य कारण</label><br>
                        </div>
                    </div>
                    <textarea class="form-control" maxlength="512" name="remark" placeholder="Enter Remark" style="height:100px;width:600px;margin:auto;" required></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approved Modal -->
<div class="modal fade" id="approved_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:700px;padding:20px;">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel" style="text-align:center;color:red;margin-left: auto;">Are you sure you Want to Approved this application ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="revert-form" action="{{route('cfo.approve')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="application_type" value="established">
                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">
                    <label class="form-label text-center" style="margin-left:20%;">Choose Noc Application Validity before Approved*</label>
                    <div class="radio-toolbar">
                        <div class="row">
                            <div class="col-md-12">
                                <label><input type="radio" name="validity" value="3" required style="margin-right:5px;height: auto;">This certificate is valid for 3 year from the issue date, although the applicant must submit his declaration certificate (working condition of fire safety system) in every 6 month.</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label><input type="radio" name="validity" value="5" style="margin-right:5px;height: auto;">This certificate is valid for 5 year from the issue date, although the applicant must submit his declaration certificate (working condition of fire safety system) in every 6 month.</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Pre Approved Modal -->
<div class="modal fade" id="pre_approved_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:500px;padding:20px;">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-align:center;">Enter Pre Approved Remark</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="revert-form" action="{{route('dd.pre.approved')}}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="application_type" value="established">
                    <input type="hidden" name="application_no" value="{{$applicationDetail->application_no}}">

                    <div class="radio-toolbar" style="padding-bottom:20px;">
                        <label class="form-label text-center">Remark*</label>
                        <div class="row">
                            <div class="col-md-12">
                                <textarea rows="3" class="form-control" id="remark_by_dd" name="remark_by_dd" placeholder="Pre Approved Remark" value="" style="height:100px;" required></textarea>
                            </div>
                        </div>

                        <label class="form-label text-center" style="margin-top:20px;">Support Document*</label>

                        <div class="row">
                            <div class="col-md-12">
                                <input type="file" class="form-control" id="attachment" name="attachment" style="height:50px;">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Approved</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>

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
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
        $(".is_under_ground_storage").hide();
        $(".is_under_ground_tank").hide();
        $(".is_terrace_tank").hide();
        $(".is_terrace_pump").hide();
        highTensionLine();
    });
    $(function(e) {

        // file export datatable
        $('#datatable-basic').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            },
        });
    });
    $(document).ready(function() {
        $(document).on('click', '#savePhysical', function() {
            let isValid = true;
            $('.errorPhyIns1, .errorPhyIns2, .errorPhyIns3, .errorPhyIns4, .errorPhyIns5, .errorPhyIns6').hide();
            const _token = $('input[name="_token"]').val();
            const application_type = $('input[name="application_type"]').val();
            const application_no = $('#application_number').val();
            const inspection_step = $('#inspection_step_physical').val();
            const line = $('input[name="line"]:checked').val();
            const line_status = $('input[name="line_status"]:checked').val();
            const vehicle_approach = $('input[name="vehicle_approach"]:checked').val();
            const inflammable = $('input[name="inflammable"]:checked').val();
            const other = $('input[name="other"]').val();
            const specific = $('input[name="specific"]').val();

            if (!line) {
                $('.errorPhyIns1').text('This field is required.').show();
                isValid = false;
            }
            if (!line_status) {
                $('.errorPhyIns2').text('This field is required.').show();
                isValid = false;
            }
            if (!vehicle_approach) {
                $('.errorPhyIns3').text('This field is required.').show();
                isValid = false;
            }
            if (!inflammable) {
                $('.errorPhyIns4').text('This field is required.').show();
                isValid = false;
            }
            if (other.trim() === '') {
                $('.errorPhyIns5').text('This field is required.').show();
                isValid = false;
            }
            if (specific.trim() === '') {
                $('.errorPhyIns6').text('This field is required.').show();
                isValid = false;
            }
            if (isValid) {
                document.getElementById('errorBlock').style.display = "none";
                const formData = new FormData();
                formData.append('_token', _token);
                formData.append('application_no', application_no);
                formData.append('application_type', application_type);
                formData.append('inspection_step', inspection_step);
                formData.append('line', line);
                formData.append('line_status', line_status);
                formData.append('vehicle_approach', vehicle_approach);
                formData.append('inflammable', inflammable);
                formData.append('other', other);
                formData.append('specific', specific);
                $.ajax({
                    type: "POST",
                    url: "{{route('fso.addPhysicalInsPost')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "1") {
                            $('#tab_physical_ins').removeClass('active');
                            $('#ins_physical_inspection').removeClass('show active');
                            $('#tab_fire_fighting_provision').addClass('active');
                            $('#ins_fire_fighting_provision').addClass('show active');
                        } else {
                            document.getElementById('errorBlock').style.display = "block";
                            $('#errorBlock').html(response.msg).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        $('#errorBlock').html("Error", "An error occurred while processing your request.").show();
                    }
                });
            }
        });
        $(document).on('click', '#saveFireFighting', function() {
            let isValid = true;
            const _token = $('input[name="_token"]').val();
            const application_type = $('input[name="application_type"]').val();
            const application_no = $('#application_number').val();
            const inspection_step = $('#inspection_step_fire').val();
            const is_under_ground = $('[name="is_under_ground"]').val();
            const under_ground_storage_capacity = $('input[name="under_ground_storage_capacity"]').val();
            const is_under_ground_tank = $('[name="is_under_ground_tank"]').val();
            const type_electric_under_ground_tank = $('input[name="type_electric_under_ground_tank"]:checked').val();
            const type_diesel_under_ground_tank = $('input[name="type_diesel_under_ground_tank"]:checked').val();
            const type_jockey_under_ground_tank = $('input[name="type_jockey_under_ground_tank"]:checked').val();
            const electric_ground_tank_capacity = $('input[name="electric_ground_tank_capacity"]').val();
            const diesel_ground_tank_capacity = $('input[name="diesel_ground_tank_capacity"]').val();
            const jockey_ground_tank_capacity = $('input[name="jockey_ground_tank_capacity"]').val();
            const yard_hydrant = $('[name="yard_hydrant"]').val();
            const fire_cabin = $('[name="fire_cabin"]').val();
            const wet_riser = $('[name="wet_riser"]').val();
            const is_terrace_tank = $('[name="is_terrace_tank"]').val();
            const terrace_tank = $('input[name="terrace_tank"]').val();
            const is_terrace_pump = $('[name="is_terrace_pump"]').val();
            const terrace_pump_capacity = $('input[name="terrace_pump_capacity"]').val();
            const down_comer = $('[name="down_comer"]').val();
            const first_aid = $('[name="first_aid"]').val();
            const landing_valve = $('[name="landing_valve"]').val();
            const manual_alarm = $('[name="manual_alarm"]').val();
            const automatic_alarm = $('[name="automatic_alarm"]').val();
            const automatic_sprinkler = $('[name="automatic_sprinkler"]').val();
            const fire_extinguisher = $('[name="fire_extinguisher"]').val();

            // Function to validate a field
            function validateField(fieldValue, errorClass) {
                if (!fieldValue) {
                    $(errorClass).text('This field is required.').show();
                    isValid = false;
                    return false; // Stop validation on first error
                } else {
                    $(errorClass).hide();
                    return true;
                }
            }

            // Validate each field one by one
            if (validateField(is_under_ground, '.errorFireIns1') &&
                validateField(is_under_ground_tank, '.errorFireIns3') &&
                validateField(yard_hydrant, '.errorFireIns8') &&
                validateField(fire_cabin, '.errorFireIns9') &&
                validateField(wet_riser, '.errorFireIns10') &&
                validateField(is_terrace_tank, '.errorFireIns11') &&
                validateField(is_terrace_pump, '.errorFireIns13') &&
                validateField(down_comer, '.errorFireIns15') &&
                validateField(first_aid, '.errorFireIns16') &&
                validateField(landing_valve, '.errorFireIns17') &&
                validateField(manual_alarm, '.errorFireIns18') &&
                validateField(automatic_alarm, '.errorFireIns19') &&
                validateField(automatic_sprinkler, '.errorFireIns20') &&
                validateField(fire_extinguisher, '.errorFireIns21')) {
                
                document.getElementById('errorBlock').style.display = "none";
                const formData = new FormData();
                formData.append('_token', _token);
                formData.append('application_no', application_no);
                formData.append('application_type', application_type);
                formData.append('inspection_step', inspection_step);
                formData.append('is_under_ground', is_under_ground);
                formData.append('under_ground_storage_capacity', under_ground_storage_capacity);
                formData.append('is_under_ground_tank', is_under_ground_tank);
                formData.append('type_electric_under_ground_tank', type_electric_under_ground_tank);
                formData.append('type_diesel_under_ground_tank', type_diesel_under_ground_tank);
                formData.append('type_jockey_under_ground_tank', type_jockey_under_ground_tank);
                formData.append('electric_ground_tank_capacity', electric_ground_tank_capacity);
                formData.append('diesel_ground_tank_capacity', diesel_ground_tank_capacity);
                formData.append('jockey_ground_tank_capacity', jockey_ground_tank_capacity);
                formData.append('yard_hydrant', yard_hydrant);
                formData.append('fire_cabin', fire_cabin);
                formData.append('wet_riser', wet_riser);
                formData.append('is_terrace_tank', is_terrace_tank);
                formData.append('terrace_tank', terrace_tank);
                formData.append('is_terrace_pump', is_terrace_pump);
                formData.append('terrace_pump_capacity', terrace_pump_capacity);
                formData.append('down_comer', down_comer);
                formData.append('first_aid', first_aid);
                formData.append('landing_valve', landing_valve);
                formData.append('manual_alarm', manual_alarm);
                formData.append('automatic_alarm', automatic_alarm);
                formData.append('automatic_sprinkler', automatic_sprinkler);
                formData.append('fire_extinguisher', fire_extinguisher);
                
                $.ajax({
                    type: "POST",
                    url: "{{route('fso.addFireProvissionPost')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "1") {
                            $('#tab_fire_fighting_provision').removeClass('active');
                            $('#ins_fire_fighting_provision').removeClass('show active');
                            $('#tab_builiding_status').addClass('active');
                            $('#ins_builiding_status').addClass('show active');
                        } else {
                            document.getElementById('errorBlock').style.display = "block";
                            $('#errorBlock').html(response.msg).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        $('#errorBlock').html("Error", "An error occurred while processing your request.").show();
                    }
                });
            }
        });

        $(document).on('click', '#saveBuildingStatus', function() {
            let isValid = true;
            $('.errorBuildIns1, .errorBuildIns2, .errorBuildIns3, .errorBuildIns4, .errorBuildIns5, .errorBuildIns6, .errorBuildIns7, .errorBuildIns8, .errorBuildIns9, .errorBuildIns10, .errorBuildIns11, .errorBuildIns12, .errorBuildIns13, .errorBuildIns14').hide();
            const _token = $('input[name="_token"]').val();
            const application_type = $('input[name="application_type"]').val();
            const application_no = $('#application_number').val();
            const inspection_step = $('input[name="inspection_step_build"]').val();
            const set_back = $('input[name="set_back"]').val();
            const compartmentation = $('[name="compartmentation"]').val();
            const stair_width = $('input[name="stair_width"]').val();
            const fire_cabin = $('[name="fire_cabin"]').val();
            const stair_in_block = $('input[name="stair_in_block"]').val();
            const emergency_exit = $('input[name="emergency_exit"]').val();
            const fire_switch = $('[name="fire_switch"]').val();
            const alt_electric = $('[name="alt_electric"]').val();
            const emergency_light = $('[name="emergency_light"]').val();
            const fluorescent_exit = $('[name="fluorescent_exit"]').val();
            const pro_smoke = $('[name="pro_smoke"]').val();
            const refuse_area = $('[name="refuse_area"]').val();
            const max_travel = $('input[name="max_travel"]').val();
            const elec_install = $('[name="elec_install"]').val();


            if (!set_back.trim() === '') {
                $('.errorBuildIns1').text('This field is required.').show();
                isValid = false;
            }
            if (!compartmentation) {
                $('.errorBuildIns2').text('This field is required.').show();
                isValid = false;
            }
            if (!stair_width.trim() === '') {
                $('.errorBuildIns3').text('This field is required.').show();
                isValid = false;
            }
            if (!fire_cabin) {
                $('.errorBuildIns4').text('This field is required.').show();
                isValid = false;
            }
            if (stair_in_block.trim() === '') {
                $('.errorBuildIns5').text('This field is required.').show();
                isValid = false;
            }
            if (emergency_exit.trim() === '') {
                $('.errorBuildIns6').text('This field is required.').show();
                isValid = false;
            }
            if (!fire_switch) {
                $('.errorBuildIns7').text('This field is required.').show();
                isValid = false;
            }
            if (!alt_electric) {
                $('.errorBuildIns8').text('This field is required.').show();
                isValid = false;
            }
            if (!emergency_light) {
                $('.errorBuildIns9').text('This field is required.').show();
                isValid = false;
            }
            if (!fluorescent_exit) {
                $('.errorBuildIns10').text('This field is required.').show();
                isValid = false;
            }
            if (!pro_smoke) {
                $('.errorBuildIns11').text('This field is required.').show();
                isValid = false;
            }
            if (!refuse_area) {
                $('.errorBuildIns12').text('This field is required.').show();
                isValid = false;
            }
            if (max_travel.trim() === '') {
                $('.errorBuildIns13').text('This field is required.').show();
                isValid = false;
            }
            if (!elec_install) {
                $('.errorBuildIns14').text('This field is required.').show();
                isValid = false;
            }
            if (isValid) {
                document.getElementById('errorBlock').style.display = "none";
                const formData = new FormData();
                formData.append('_token', _token);
                formData.append('application_no', application_no);
                formData.append('application_type', application_type);
                formData.append('inspection_step', inspection_step);
                formData.append('set_back', set_back);
                formData.append('compartmentation', compartmentation);
                formData.append('stair_width', stair_width);
                formData.append('fire_cabin', fire_cabin);
                formData.append('stair_in_block', stair_in_block);
                formData.append('emergency_exit', emergency_exit);
                formData.append('fire_switch', fire_switch);
                formData.append('alt_electric', alt_electric);
                formData.append('emergency_light', emergency_light);
                formData.append('fluorescent_exit', fluorescent_exit);
                formData.append('pro_smoke', pro_smoke);
                formData.append('refuse_area', refuse_area);
                formData.append('max_travel', max_travel);
                formData.append('elec_install', elec_install);

                $.ajax({
                    type: "POST",
                    url: "{{route('fso.addBuildingStatusPost')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "1") {
                            $('#tab_builiding_status').removeClass('active');
                            $('#ins_builiding_status').removeClass('show active');
                            $('#tab_special_provision').addClass('active');
                            $('#ins_special_provision').addClass('show active');
                        } else {
                            document.getElementById('errorBlock').style.display = "block";
                            $('#errorBlock').html(response.msg).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        $('#errorBlock').html("Error", "An error occurred while processing your request.").show();
                    }
                });
            }
        });
        $(document).on('click', '#backToPhysical', function() {
            $('#tab_fire_fighting_provision').removeClass('active');
            $('#ins_fire_fighting_provision').removeClass('show active');
            $('#tab_builiding_status').removeClass('active');
            $('#ins_builiding_status').removeClass('show active');
            $('#tab_special_provision').removeClass('active');
            $('#ins_special_provision').removeClass('show active');
            $('#tab_remark_fso').removeClass('active');
            $('#ins_remark_fso').removeClass('show active');
            $('#tab_physical_ins').addClass('active');
            $('#ins_physical_inspection').addClass('show active');
        });
        $(document).on('click', '#backToFire', function() {
            $('#tab_physical_ins').removeClass('active');
            $('#ins_physical_inspection').removeClass('show active');
            $('#tab_builiding_status').removeClass('active');
            $('#ins_builiding_status').removeClass('show active');
            $('#tab_special_provision').removeClass('active');
            $('#ins_special_provision').removeClass('show active');
            $('#tab_remark_fso').removeClass('active');
            $('#ins_remark_fso').removeClass('show active');
            $('#tab_fire_fighting_provision').addClass('active');
            $('#ins_fire_fighting_provision').addClass('show active');
        });
        $(document).on('click', '#backToBuilding', function() {
            $('#tab_physical_ins').removeClass('active');
            $('#ins_physical_inspection').removeClass('show active');
            $('#tab_special_provision').removeClass('active');
            $('#ins_special_provision').removeClass('show active');
            $('#tab_special_provision').removeClass('active');
            $('#ins_special_provision').removeClass('show active');
            $('#tab_remark_fso').removeClass('active');
            $('#ins_remark_fso').removeClass('show active');
            $('#tab_builiding_status').addClass('active');
            $('#ins_builiding_status').addClass('show active');
        });
        $(document).on('click', '#backToSpecial', function() {
            $('#tab_physical_ins').removeClass('active');
            $('#ins_physical_inspection').removeClass('show active');
            $('#tab_special_provision').removeClass('active');
            $('#ins_special_provision').removeClass('show active');
            $('#tab_builiding_status').removeClass('active');
            $('#ins_builiding_status').removeClass('show active');
            $('#tab_remark_fso').removeClass('active');
            $('#ins_remark_fso').removeClass('show active');
            $('#tab_special_provision').addClass('active');
            $('#ins_special_provision').addClass('show active');
        });
        $(document).on('change', '#is_under_ground', function() {
            var yes_no = $(this).val();
            if (yes_no == 'Required') {
                $(".is_under_ground_storage").show();
            } else {
                $(".is_under_ground_storage").hide();
            }
        });
        $(document).on('change', '#is_under_ground_tank', function() {
            var yes_no = $(this).val();
            if (yes_no == 'Required') {
                $(".is_under_ground_tank").show();
            } else {
                $(".is_under_ground_tank").hide();
            }
        });
        $(document).on('change', '#is_terrace_tank', function() {
            var yes_no = $(this).val();
            if (yes_no == 'Required') {
                $(".is_terrace_tank").show();
            } else {
                $(".is_terrace_tank").hide();
            }
        });
        $(document).on('change', '#is_terrace_pump', function() {
            var yes_no = $(this).val();
            if (yes_no == 'Required') {
                $(".is_terrace_pump").show();
            } else {
                $(".is_terrace_pump").hide();
            }
        });

        $(document).on('click', '#saveSpecial', function() {
            let isValid = true;
            $('.errorSpecialIns1, .errorSpecialIns2, .errorSpecialIns3, .errorSpecialIns4, .errorSpecialIns5, .errorSpecialIns6, .errorSpecialIns7, .errorSpecialIns8, .errorSpecialIns9, .errorSpecialIns10, .errorSpecialIns11, .errorSpecialIns12, .errorSpecialIns13, .errorSpecialIns14').hide();
            const _token = $('input[name="_token"]').val();
            const application_type = $('input[name="application_type"]').val();
            const application_no = $('#application_number').val();
            const inspection_step = $('input[name="inspection_step_build"]').val();
            const smoke_extraction = $('[name="smoke_extraction"]').val();
            const fresh_air = $('[name="fresh_air"]').val();
            const response_indicator = $('[name="response_indicator"]').val();
            const water_spray = $('[name="water_spray"]').val();
            const foam_spray = $('[name="foam_spray"]').val();
            const flooding_system = $('[name="flooding_system"]').val();
            const fire_switch_lift = $('[name="fire_switch_lift"]').val();
            const fire_cart = $('[name="fire_cart"]').val();
            const beam_detector = $('[name="beam_detector"]').val();
            const gas_detector = $('[name="gas_detector"]').val();
            const fire_bucket = $('[name="fire_bucket"]').val();
            const emergency_no = $('[name="emergency_no"]').val();
            const trained_staff = $('[name="trained_staff"]').val();
            const other_comment = $('input[name="other_comment"]').val();


            if (!smoke_extraction) {
                $('.errorSpecialIns1').text('This field is required.').show();
                isValid = false;
            }
            if (!fresh_air) {
                $('.errorSpecialIns2').text('This field is required.').show();
                isValid = false;
            }
            if (!response_indicator) {
                $('.errorSpecialIns3').text('This field is required.').show();
                isValid = false;
            }
            if (!water_spray) {
                $('.errorSpecialIns4').text('This field is required.').show();
                isValid = false;
            }
            if (!foam_spray) {
                $('.errorSpecialIns5').text('This field is required.').show();
                isValid = false;
            }
            if (!flooding_system) {
                $('.errorSpecialIns6').text('This field is required.').show();
                isValid = false;
            }
            if (!fire_switch_lift) {
                $('.errorSpecialIns7').text('This field is required.').show();
                isValid = false;
            }
            if (!fire_cart) {
                $('.errorSpecialIns8').text('This field is required.').show();
                isValid = false;
            }
            if (!beam_detector) {
                $('.errorSpecialIns9').text('This field is required.').show();
                isValid = false;
            }
            if (!gas_detector) {
                $('.errorSpecialIns10').text('This field is required.').show();
                isValid = false;
            }
            if (!fire_bucket) {
                $('.errorSpecialIns11').text('This field is required.').show();
                isValid = false;
            }
            if (!emergency_no) {
                $('.errorSpecialIns12').text('This field is required.').show();
                isValid = false;
            }
            if (!trained_staff) {
                $('.errorSpecialIns13').text('This field is required.').show();
                isValid = false;
            }
            if (!other_comment.trim() === '') {
                $('.errorSpecialIns14').text('This field is required.').show();
                isValid = false;
            }
            if (isValid) {
                document.getElementById('errorBlock').style.display = "none";
                const formData = new FormData();
                formData.append('_token', _token);
                formData.append('application_no', application_no);
                formData.append('application_type', application_type);
                formData.append('inspection_step', inspection_step);
                formData.append('smoke_extraction', smoke_extraction);
                formData.append('fresh_air', fresh_air);
                formData.append('response_indicator', response_indicator);
                formData.append('water_spray', water_spray);
                formData.append('foam_spray', foam_spray);
                formData.append('flooding_system', flooding_system);
                formData.append('fire_switch_lift', fire_switch_lift);
                formData.append('fire_cart', fire_cart);
                formData.append('beam_detector', beam_detector);
                formData.append('gas_detector', gas_detector);
                formData.append('fire_bucket', fire_bucket);
                formData.append('emergency_no', emergency_no);
                formData.append('trained_staff', trained_staff);
                formData.append('other_comment', other_comment);

                $.ajax({
                    type: "POST",
                    url: "{{route('fso.addSpecialProvissionPost')}}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == "1") {
                            $('#tab_special_provision').removeClass('active');
                            $('#ins_special_provision').removeClass('show active');
                            $('#tab_remark_fso').addClass('active');
                            $('#ins_remark_fso').addClass('show active');
                        } else {
                            document.getElementById('errorBlock').style.display = "block";
                            $('#errorBlock').html(response.msg).show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: ", status, error);
                        $('#errorBlock').html("Error", "An error occurred while processing your request.").show();
                    }
                });
            }
        });
    });
    function highTensionLine()
    {
        var yes_no = $("input[type='radio'][name='line']:checked").val();
        if(yes_no=='yes')
        {
            $(".line_status").show();
            $("input[type='radio'][name='line_status']").prop('required',true);

        }
        else
        {
            $(".line_status").hide();
            $("input[type='radio'][name='line_status']").prop('required',false);
        }
    }
</script>
@stop
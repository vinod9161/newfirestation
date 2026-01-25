@extends('layouts.admin.template')
@section('title')
<title>View Fire Report Details | Uttrakhand Fireservice</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<style>
    .custom-flex {
        display: flex;
        justify-content: space-between;
        width: 100%;
    }

    .report-details {
        margin-left: auto;
        /* Ensures it stays pushed to the right */
    }

    .heading_info {
        background: #42425d;
        color: white;
        padding: 4px;
        font-size: 1.2rem;
        width: 98%;
        margin: 10px 10px;
    }
    .line_pass_div
    {
        display:none;
    }
    .detail_div
    {
        display:none;
    }
    .error
    {
        color:red;
    }
    .reason-label label 
    {
        font-size: 14px;
    }
</style>
@endsection
@section('content')
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">View Temporary Noc</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <input type="hidden" id="noc_type" name="noc_type" value="{{$applicationDetail[0]->noc_type}}">
        <input type="hidden" id="application_no" name="application_no" value="{{$applicationDetail[0]->application_no}}">
        <input type="hidden" id="id" name="id" value="{{$applicationDetail[0]->id}}">
        @if(Auth::user()->type == 2)
            @if($applicationDetail[0]->status=='for approval')  
            <div class="me-2">                        
                <button type="button" id="send-for-review-btn" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#revert_modal">Revert</button>
            </div>
            <div class="me-2">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <button  title="Approve Application" type="button" class="btn ripple btn-wave  btn-success mb-0" onclick="approved()"> Approve </button>
                </form>
            </div>
            <div class="me-2">
                <form action="{{route('temporary.cfo.reject')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <button  title="Reject Application" type="button" class="btn ripple btn-wave  btn-danger mb-0" onclick="reject()">Reject </button>
                </form>
            </div>
            @elseif($applicationDetail[0]->status=='pending')
            <div class="me-2">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <button  title="Approve Application" type="button" class="btn ripple btn-wave btn-success mb-0" onclick="approved()"> Approve </button>
                </form>
            </div>
            <div class="me-2">
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <button  title="Reject Application" type="button" class="btn ripple btn-wave btn-danger mb-0" onclick="reject()">Reject </button>
                </form>
            </div>
            @endif
        </div>
        @elseif(Auth::user()->type == 3)
        @if($applicationDetail[0]->status=='processed')
        <div class="me-2">
            <form method="POST" enctype="multipart/form-data">
                @csrf
                <button type="button" class="btn ripple btn-wave  btn-success mb-0" onclick="sendForApproval();">Send For Approval </button>
            </form>
        </div>
        @endif
        @endif
    </div>
</div>
<!-- End Row -->
<!-- Start::row-2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="row">
                    <div class="text-wrap">
                        <div class="example">
                            <ul class="nav nav-tabs mb-3" role="tablist">
                                <li class="nav-item active" role="presentation"> <a class="nav-link active" data-bs-toggle="tab" role="tab" href="#tab1" aria-selected="false" tabindex="-1">NOC</a> </li>
                                <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab4" aria-selected="false" tabindex="-1">Physical Inspection</a> </li>
                                <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab2" aria-selected="false" tabindex="-1">Remarks</a> </li>
                                <li class="nav-item" role="presentation"> <a class="nav-link" data-bs-toggle="tab" role="tab" href="#tab3" aria-selected="true">Revert</a> </li>
                            </ul>
                            <div class="tab-content">
                                <div class="alert alert-success" id="successBlock" style="display:none;"></div>
                                <div class="alert alert-danger" id="errorBlock" style="display:none;"></div>
                                <div class="tab-pane show active text-muted" id="tab1" role="tabpanel"> 
                                    <div class="row">
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

                                        <h5 class="text-center table-dark heading_info">Basic Details</h5>
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Applicant Type</td>
                                                        <td> {{ $applicationDetail[0]->applicant_type }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center table-dark heading_info">Applicant Detail</h5>
                                        <div class="table-responsive">
                                            @php $applicantDetails = json_decode($applicationDetail[0]->applicant_detail);@endphp
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Salutation</td>
                                                        <td> {{ $applicantDetails->salutation ?? 'NA' }} </td>
                                                        <td>First Name</td>
                                                        <td> {{ $applicantDetails->first_name ?? 'NA' }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Middle Name</td>
                                                        <td> {{ $applicantDetails->middle_name ?? 'NA' }} </td>
                                                        <td>Last Name</td>
                                                        <td> {{ $applicantDetails->last_name ?? 'NA' }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email Address</td>
                                                        <td> {{ $applicantDetails->email ?? 'NA' }} </td>
                                                        <td>Mobile No.</td>
                                                        <td> {{ $applicantDetails->mobile_no ?? 'NA' }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            
                                            <table class="table table-bordered table-striped table-hover mt-2">
                                                <tbody>
                                                    <tr>
                                                        <td colspan="4">Address of Applicant</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            @php $applicantAddress = json_decode($applicationDetail[0]->applicant_address);;@endphp
                                            
                                            <table class="table table-bordered table-striped table-hover mt-2">
                                                <tbody>
                                                    <tr>
                                                        <td>District</td>
                                                        <td>
                                                            @foreach($districts as $row => $dist)
                                                            @if($dist->id == $applicantAddress->district_id)
                                                            {{ $dist->name ?? 'NA' }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>Urban / Rural</td>
                                                        <td>{{ strtoupper($applicantAddress->rural_urban)  ?? 'NA' }}</td>
                                                    </tr>

                                                    @if(strtoupper($applicantAddress->rural_urban) == 'URBAN')
                                                    <tr>
                                                        <td>Tehsil</td>
                                                        <td>
                                                            @foreach($tehsils as $row => $teh)
                                                            @if($teh->id == $applicantAddress->tehsil_id)
                                                            {{ $teh->name ?? 'NA' }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>Street</td>
                                                        <td>{{ $applicantAddress->street ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Landmark</td>
                                                        <td>{{ $applicantAddress->landmark ?? 'NA' }}</td>
                                                        <td>City</td>
                                                        <td>{{ $applicantAddress->city ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Choose Plot/ Khasra/ Khatoni</td>
                                                        <td>{{ $applicantAddress->plot_khasra_khatauni ?? 'NA' }}</td>
                                                        <td>Plot/Khasra/Khatoni No</td>
                                                        <td>{{ $applicantAddress->plot_khasra_khatauni_no ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pincode</td>
                                                        <td>{{ $applicantAddress->pincode ?? 'NA' }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endif
                                                    <!-- Rural Div -->
                                                    @if(strtoupper($applicantAddress->rural_urban) == 'RURAL')
                                                    <tr>
                                                        <td>Block</td>
                                                        <td>
                                                            @foreach($block as $row => $blk)
                                                            @if($blk->id == $applicantAddress->block_id)
                                                            {{ $blk->name ?? 'NA' }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>Panchayat</td>
                                                        <td>{{ $applicantAddress->Panchayat ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Village</td>
                                                        <td>{{ $applicantAddress->village ?? 'NA' }}</td>
                                                        <td>Landmark</td>
                                                        <td>{{ $applicantAddress->landmark ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Choose Plot/ Khasra/ Khatoni</td>
                                                        <td>{{ $applicantAddress->plot_khasra_khatauni ?? 'NA' }}</td>
                                                        <td>Plot/Khasra/Khatoni No.</td>
                                                        <td>{{ $applicantAddress->plot_khasra_khatauni_no ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pincode</td>
                                                        <td>{{ $applicantAddress->pincode ?? 'NA' }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center table-dark heading_info">Organizing Place and Address</h5>
                                        <div class="table-responsive">
                                            
                                            @php $organizingAddress = json_decode($applicationDetail[0]->organizing_address);@endphp
                                            <table class="table table-bordered table-striped table-hover mt-2">
                                                <tbody>
                                                    <tr>
                                                        <td>District</td>
                                                        <td>
                                                            @foreach($districts as $row => $dist)
                                                            @if($dist->id == $organizingAddress->org_district_id)
                                                            {{ $dist->name ?? 'NA' }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>Urban / Rural</td>
                                                        <td>{{ strtoupper($organizingAddress->org_rural_urban)  ?? 'NA' }}</td>
                                                    </tr>

                                                    @if(strtoupper($organizingAddress->org_rural_urban) == 'URBAN')
                                                    <tr>
                                                        <td>Tehsil</td>
                                                        <td>
                                                            @foreach($tehsils as $row => $teh)
                                                            @if($teh->id == $organizingAddress->org_tehsil_id)
                                                            {{ $teh->name ?? 'NA' }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>Street</td>
                                                        <td>{{ $organizingAddress->org_street ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Landmark</td>
                                                        <td>{{ $organizingAddress->org_landmark ?? 'NA' }}</td>
                                                        <td>City</td>
                                                        <td>{{ $organizingAddress->org_city ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Choose Plot/ Khasra/ Khatoni</td>
                                                        <td>{{ $organizingAddress->org_plot_khasra_khatauni ?? 'NA' }}</td>
                                                        <td>Plot/Khasra/Khatoni No</td>
                                                        <td>{{ $organizingAddress->org_plot_khasra_khatauni_no ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pincode</td>
                                                        <td>{{ $organizingAddress->org_pincode ?? 'NA' }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endif
                                                    <!-- Rural Div -->
                                                    @if(strtoupper($organizingAddress->org_rural_urban) == 'RURAL')
                                                    <tr>
                                                        <td>Block</td>
                                                        <td>
                                                            @foreach($block as $row => $blk)
                                                            @if($blk->id == $organizingAddress->org_block_id)
                                                            {{ $blk->name ?? 'NA' }}
                                                            @endif
                                                            @endforeach
                                                        </td>
                                                        <td>Panchayat</td>
                                                        <td>{{ $organizingAddress->org_Panchayat ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Village</td>
                                                        <td>{{ $organizingAddress->org_village ?? 'NA' }}</td>
                                                        <td>Landmark</td>
                                                        <td>{{ $organizingAddress->org_landmark ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Choose Plot/ Khasra/ Khatoni</td>
                                                        <td>{{ $organizingAddress->org_plot_khasra_khatauni ?? 'NA' }}</td>
                                                        <td>Plot/Khasra/Khatoni No.</td>
                                                        <td>{{ $organizingAddress->org_plot_khasra_khatauni_no ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Pincode</td>
                                                        <td>{{ $organizingAddress->org_pincode ?? 'NA' }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    @endif
                                                    <tr>
                                                        <td>Latitude</td>
                                                        <td>{{ $organizingAddress->latitude ?? 'NA' }}</td>
                                                        <td>Longitude</td>
                                                        <td>{{ $organizingAddress->longitude ?? 'NA' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center table-dark heading_info">Orgnizer Contact Detail</h5>
                                        <div class="table-responsive">
                                            
                                            @php $organizer_contact_detail = json_decode($applicationDetail[0]->orgnizer_contact_detail);@endphp
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Salutation</td>
                                                        <td>{{ $organizer_contact_detail->org_salutation ?? 'NA' }}</td>
                                                        <td>First Name</td>
                                                        <td>{{ $organizer_contact_detail->org_first_name ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Middle Name</td>
                                                        <td>{{ $organizer_contact_detail->org_middle_name ?? 'NA' }}</td>
                                                        <td>Last Name</td>
                                                        <td>{{ $organizer_contact_detail->org_last_name ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name of Organizing Firm</td>
                                                        <td>{{ $organizer_contact_detail->org_name ?? 'NA' }}</td>
                                                        <td>Email Address</td>
                                                        <td>{{ $organizer_contact_detail->org_email ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile No.</td>
                                                        <td>{{ $organizer_contact_detail->org_mobile_no ?? 'NA' }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center table-dark heading_info">Erector Contact Detail</h5>
                                        <div class="table-responsive">   
                                            @php $erector_contact_detail = json_decode($applicationDetail[0]->erector_contact_detail);@endphp
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Salutation</td>
                                                        <td>{{ $erector_contact_detail->ere_salutation ?? 'NA' }}</td>
                                                        <td>First Name</td>
                                                        <td>{{ $erector_contact_detail->ere_first_name ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Middle Name</td>
                                                        <td>{{ $erector_contact_detail->ere_middle_name ?? 'NA' }}</td>
                                                        <td>Last Name</td>
                                                        <td>{{ $erector_contact_detail->ere_last_name ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Name of Erector Firm</td>
                                                        <td>{{ $erector_contact_detail->ere_name ?? 'NA' }}</td>
                                                        <td>Email Address</td>
                                                        <td>{{ $erector_contact_detail->ere_email ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Mobile No.</td>
                                                        <td>{{ $erector_contact_detail->ere_mobile_no ?? 'NA' }}</td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center table-dark heading_info">Coordinator Contact Detail</h5>
                                        <div class="table-responsive">
                                            @php $coordinator_contact_detail = json_decode($applicationDetail[0]->coordinator_contact_detail);@endphp
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Salutation</td>
                                                        <td>{{ $coordinator_contact_detail->coor_salutation ?? 'NA' }}</td>
                                                        <td>First Name</td>
                                                        <td>{{ $coordinator_contact_detail->coor_first_name ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Middle Name</td>
                                                        <td>{{ $coordinator_contact_detail->coor_middle_name ?? 'NA' }}</td>
                                                        <td>Last Name</td>
                                                        <td>{{ $coordinator_contact_detail->coor_last_name ?? 'NA' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Email Address</td>
                                                        <td>{{ $coordinator_contact_detail->coor_email ?? 'NA' }}</td>
                                                        <td>Mobile No.</td>
                                                        <td>{{ $coordinator_contact_detail->coor_mobile_no ?? 'NA' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center table-dark heading_info">Project / Area Detail</h5>
                                        <div class="table-responsive">
                                            @php $project_area_detail = json_decode($applicationDetail[0]->project_area_detail);@endphp
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    <tr>
                                                        <td>Type of Project</td>
                                                        <td> {{ $project_area_detail->project_type }} </td>
                                                        @if ($project_area_detail->project_type == 'Helipad')
                                                        <td>Type of Helipad</td>
                                                        <td> {{ $project_area_detail->helipad_type }} </td>
                                                        @elseif($project_area_detail->project_type == 'Air strip')
                                                        <td>Type of Air Strip</td>
                                                        <td> {{ $project_area_detail->air_strip_type }} </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Capacity of Helipad/airport</td>
                                                        <td> {{ $project_area_detail->helipad_type }} </td>
                                                        <td>Capacity (in terms of sitting)</td>
                                                        <td> {{ $project_area_detail->capacity }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Event Start Date</td>
                                                        <td> {{ $project_area_detail->start_date }} </td>
                                                        <td>Event End Date</td>
                                                        <td> {{ $project_area_detail->end_date }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total Covered Area</td>
                                                        <td> {{ $project_area_detail->total_covered_area }} </td>
                                                        <td>Unit</td>
                                                        <td> {{ $project_area_detail->covered_area_unit }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Number of Exi</td>
                                                        <td> {{ $project_area_detail->no_exit }} </td>
                                                        <td>Provision of fuel storage in the premises</td>
                                                        <td> {{ $project_area_detail->fuel_storage }} </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Provision of separate road</td>
                                                        <td> {{ ucfirst($project_area_detail->separate_road) }} </td>
                                                        <td>Other comment</td>
                                                        <td> {{ ucfirst($project_area_detail->other_comment) }} </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <h5 class="text-center table-dark heading_info">Attachment</h5>
                                        <div class="table-responsive">
                                            @php $attachments =  json_decode($applicationDetail[0]->attachments);@endphp
                                            <table class="table table-bordered table-striped table-hover">
                                                <tbody>
                                                    @if(isset($attachments->reference_letter))
                                                    <tr>
                                                        <td colspan="2">Reference Letter or Reference Number from Magistrate</label>
                                                    </tr>
                                                    <tr>
                                                        <td>Reference Letter</td>
                                                        <td><a href="{{ asset($attachments->reference_letter)}}" target="blank" title="View Reference Letter"><i class="fa fa-download"></i></a></td>
                                                    </tr>
                                                    @endif
                                                    @if(isset($attachments->fire_plan))
                                                    <tr>
                                                        <td colspan="2">Attach Fire escape plan.</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Reference Letter</td>
                                                        <td><a href="{{ asset($attachments->fire_plan) }}" target="blank" title="View Reference Letter"><i class="fa fa-download"></i></a></td>
                                                    </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if(Auth::user()->type == 2 && $applicationDetail[0]->assigned_id =='')
                                        <form method="post">
                                            @csrf
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Assign Request To:<span class="span_required">*</span></label>
                                                        <select class="col-md-4 form-control" name="assigned_id" id="assigned_id">
                                                            <option value="">--Select FSO--</option>
                                                            @foreach($users as $usr)
                                                                @foreach($station as $st)
                                                                @if($st->id == $usr->station_id)
                                                                <option value="{{ $usr->id }}">{{ $st->name }}</option>
                                                                @endif
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                        <span class="error" id="error10"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                    <input class="btn btn-success" type="button" value="Assign" style="float:right;margin-bottom:25px;" onclick="assignedFso();">
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane text-muted" id="tab4" role="tabpanel"> 
                                    <div class="row">
                                    @if(Auth::user()->type == 3 || Auth::user()->type == 2)
                                        <h5 class="text-center table-dark heading_info">Physical Inspection of the Site</h5>
                                        <form method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Does any high-tension electric line pass over the site? <span class="span_required">*</span></label>
                                                        @if(isset(json_decode($applicationDetail[0]->physical_inspection_detail)->high_tension_line_pass))
                                                        @php
                                                        $high_tension_line_pass = json_decode($applicationDetail[0]->physical_inspection_detail)->high_tension_line_pass;
                                                        @endphp
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes" name="high_tension_line_pass" @if ($high_tension_line_pass=='yes' ) checked @endif value="yes" onclick="chooseHighTension(this);" style="height: auto">
                                                            <label for="yes">Yes</label>
                                                            <input type="radio" id="no" name="high_tension_line_pass" @if ($high_tension_line_pass=='no' ) checked @endif value="no" onclick="chooseHighTension(this);" style="height: auto">
                                                            <label for="no">No</label>
                                                        </div>
                                                        @else
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes" name="high_tension_line_pass" checked value="yes" onclick="chooseHighTension(this);" style="height: auto">
                                                            <label for="yes">Yes</label>
                                                            <input type="radio" id="no" name="high_tension_line_pass" value="no" onclick="chooseHighTension(this);" style="height: auto">
                                                            <label for="no">No</label>
                                                        </div>
                                                        @endif
                                                        <span class="error" id="error1"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-4 col-xs-12 line_pass_div">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">If yes, is it situated at a proper safety distance? <span class="span_required">*</span></label>
                                                        @if(isset(json_decode($applicationDetail[0]->physical_inspection_detail)->safety_distance))
                                                        @php
                                                        $safety_distance = json_decode($applicationDetail[0]->physical_inspection_detail)->safety_distance;
                                                        @endphp
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes1" name="safety_distance" value="yes" @if ($safety_distance=='yes' ) checked @endif style="height: auto">
                                                            <label for="yes1">Yes</label>
                                                            <input type="radio" id="no1" name="safety_distance" @if ($safety_distance=='no' ) checked @endif value="no" style="height: auto">
                                                            <label for="no1">No</label>
                                                        </div>
                                                        @else
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes1" name="safety_distance" value="yes" checked style="height: auto">
                                                            <label for="yes1">Yes</label>
                                                            <input type="radio" id="no1" name="safety_distance" value="no" style="height: auto">
                                                            <label for="no1">No</label>
                                                        </div>
                                                        @endif
                                                        <span class="error" id="error2"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12 line_pass_div">
                                                    <div class="form-group">
                                                        <label class="form-label">Distance<span class="span_required">*</span></label>
                                                        <input type="number" class="form-control" id="distance" name="distance" step="any" value="{{ json_decode($applicationDetail[0]->physical_inspection_detail)->distance ?? '' }}" placeholder="Distance">
                                                        <span class="error" id="error3"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12 line_pass_div">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Unit<span class="span_required">*</span></label>
                                                        <select class="form-control" name="unit" id="unit">
                                                            <option value="meter" selected>Meter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username">Can a fire fighting vehicle approach the site? <span class="span_required">*</span></label>
                                                        @if(isset(json_decode($applicationDetail[0]->physical_inspection_detail)->fire_fighting))
                                                        @php
                                                        $fire_fighting = json_decode($applicationDetail[0]->physical_inspection_detail)->fire_fighting;
                                                        @endphp
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes2" name="fire_fighting" value="yes" @if ($fire_fighting=='yes' ) checked @endif style="height: auto">
                                                            <label for="yes2">Yes</label>
                                                            <input type="radio" id="no2" name="fire_fighting" @if ($fire_fighting=='no' ) checked @endif value="no" style="height: auto">
                                                            <label for="no2">No</label>
                                                        </div>
                                                        @else
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes2" name="fire_fighting" value="yes" checked style="height: auto">
                                                            <label for="yes2">Yes</label>
                                                            <input type="radio" id="no2" name="fire_fighting" value="no" style="height: auto">
                                                            <label for="no2">No</label>
                                                        </div>
                                                        @endif
                                                        <span class="error" id="error4"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="input-username" style="font-size:14px;">Is any high inflammable object situated near the building? <span class="span_required">*</span></label>
                                                        @if(isset(json_decode($applicationDetail[0]->physical_inspection_detail)->high_inflammable))
                                                        @php
                                                        $high_inflammable = json_decode($applicationDetail[0]->physical_inspection_detail)->high_inflammable;
                                                        @endphp
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes3" name="high_inflammable" value="yes" @if ($high_inflammable=='yes' ) checked @endif onclick="highInflammable(this);" style="height: auto">
                                                            <label for="yes3">Yes</label>
                                                            <input type="radio" id="no3" name="high_inflammable" @if ($high_inflammable=='no' ) checked @endif value="no" onclick="highInflammable(this);" style="height: auto">
                                                            <label for="no3">No</label>
                                                        </div>
                                                        @else
                                                        <div class="radio-toolbar">
                                                            <input type="radio" id="yes3" name="high_inflammable" value="yes" checked onclick="highInflammable(this);" style="height: auto">
                                                            <label for="yes3">Yes</label>
                                                            <input type="radio" id="no3" name="high_inflammable" value="no" onclick="highInflammable(this);" style="height: auto">
                                                            <label for="no3">No</label>
                                                        </div>
                                                        @endif
                                                        <span class="error" id="error5"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12 detail_div">
                                                    <div class="form-group">
                                                        <label class="form-label">Detail<span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="detail" name="detail" value="{{ json_decode($applicationDetail[0]->physical_inspection_detail)->detail ?? '' }}" placeholder="Detail" required>
                                                        <span class="error" id="error6"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Other<span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="other" name="other" value="{{ json_decode($applicationDetail[0]->physical_inspection_detail)->other ?? '' }}" placeholder="Other">
                                                        <span class="error" id="error7"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Specific Requirement 1 (If Any)<span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="specific_requirement_one" name="specific_requirement_one" value="{{ json_decode($applicationDetail[0]->physical_inspection_detail)->specific_requirement_one ?? '' }}" placeholder="Specific Requirement 1" value="">
                                                        <span class="error" id="error8"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label class="form-label">Specific Requirement 2 (If Any)<span class="span_required">*</span></label>
                                                        <input type="text" class="form-control" id="specific_requirement_two" name="specific_requirement_two" value="{{ json_decode($applicationDetail[0]->physical_inspection_detail)->specific_requirement_two ?? '' }}" placeholder="Specific Requirement 2" value="">
                                                        <span class="error" id="error9"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-sm-6 col-xs-12">
                                                    <input class="btn btn-success" type="button" value="Physical Inspection" style="float:right;margin-bottom:25px;" onclick="physicalInspection()">
                                                </div>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane text-muted" id="tab2" role="tabpanel"> 
                                    @if(empty($applicationDetail[0]->remark))
                                    @if(Auth::user()->type == 3)
                                    <div class="row">
                                        <form enctype="multipart/form-data" id="revert-form" action="" method="post">
                                            @csrf
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="form-label">Reason*</label>
                                                    <div class="radio-toolbar">
                                                        @foreach ($remarks as $key => $remark)
                                                        <label><input type="checkbox" id="reason_{{$key}}" name="remark_reason[]" value="{{$remark->id}}"> {{$remark->title}}</label><br>
                                                        @endforeach
                                                    </div>
                                                    <span class="error" id="error11"></span>
                                                </div>
                                                <div class="form-group">
                                                    <textarea class="form-control" maxlength="512" id="remark" name="remark" placeholder="Enter Remark"></textarea>
                                                    <span class="error" id="error12"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-primary" onclick="remarkApplication()" style="float:right;">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                    @endif
                                    @endif
                                    @if(isset($applicationDetail[0]->remark))
                                        @if(!empty($applicationDetail[0]->remark))
                                            @foreach(json_decode($applicationDetail[0]->remark) as $key => $remark)
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">{{$key + 1}}. {{ucfirst($remark->remark)}}</label><br>
                                                </div>
                                                <div class="col-md-4">
                                                    <span >{{$remark->date}}</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
                                                    <label class="form-label">Remarks : </label><br>
                                                    @foreach(explode(',',json_decode($remark->reason,true)) as $value)
                                                        @foreach ($remarks as $key => $rmk)
                                                            @if ($rmk->id == $value)
                                                            <div class="col-md-12"><span><b>=></b> {{$rmk->title}}</span></div>
                                                            @endif
                                                        @endforeach
                                                    @endforeach
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
                                            <h6>No Remark Found</h6>
                                        </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="tab-pane text-muted" id="tab3" role="tabpanel"> 
                                    <h4 class="font-italic mb-4">Revert Information</h4>
                                    @if(isset($applicationDetail[0]->revert))
                                    @foreach(json_decode($applicationDetail[0]->revert,true) as $revert)
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Remark. : </label><br>
                                            <span >{{$revert['revert']}}</span>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label">Date. : </label><br>
                                            <span >{{$revert['date']}}</span>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12" style="padding-bottom:30px;line-height:2;">
                                            <label class="form-label">Reason by CFO : </label><br>
                                            @foreach(explode(',',$revert['reason']) as $key => $rea)
                                            <div class="col-md-12"><span >{{$key + 1}}. {{$rea}}</span></div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal Enter Remark -->
<div class="modal fade" id="revert_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document" style="max-width:700px;">
      <div class="modal-content" style="width:700px;">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Revert Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form enctype="multipart/form-data" id="revert-form" method="post">
            @csrf
            <div class="modal-body">
                <div class="form-group">
                <label class="form-label"><b>Remark*</b></label>
                    <textarea class="form-control" maxlength="512" id="revert" name="revert" placeholder="Enter Remark"></textarea>
                </div>
               <div class="form-group reason-label">
                  <label class="form-label"><b>Staff access*</b></label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Required documents are not attached/complete"> Required documents are not attached/complete</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Building name/address is not correct"> Building name/address is not correct</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Required fields have not been correctly filled/provided information is not correct"> Required fields have not been correctly filled/provided information is not correct</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Sufficient Fire equipments are not installed in the building"> Sufficient Fire equipments are not installed in the building</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="High tension line is passing over the building/have not enough safety distance from the building"> High tension line is passing over the building/have not enough safety distance from the building</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Approach road is not provided"> Approach road is not provided</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Site inspection could not be done due to unavailability of the address of land"> Site inspection could not be done due to unavailability of the address of land</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Travel distance is not sufficient/emergency exit not provided as per norms"> Travel distance is not sufficient/emergency exit not provided as per norms</label>
                  <br>
                  <label><input type="checkbox" id="reason" name="reason[]" value="Other comment"> Other comment</label>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="button" class="btn btn-primary" onclick="revertApplication()">Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script>
jQuery(document).ready(chooseHighTension);
jQuery(document).ready(highInflammable);
$(document).ready(function(){  
    $('.js-example-basic-single').select2();
});
function chooseHighTension()
{
    var high_tension_line_pass = $("input[name='high_tension_line_pass']:checked").val();
    if(high_tension_line_pass=='yes') {
        $(".line_pass_div").show();
        $("#distance").prop('required',true);
    } else {
        $(".line_pass_div").hide();
        $("#distance").prop('required',false);
    }
}
function highInflammable()
{

    var high_inflammable = $("input[name='high_inflammable']:checked").val();

    if(high_inflammable=='yes') {
        $(".detail_div").show();
        $("#detail").prop('required',true);
    } else {
        $(".detail_div").hide();
        $("#detail").prop('required',false);
    }
}
function physicalInspection()
{
    const _token = $('input[name="_token"]').val();
    const noc_type = $('#noc_type').val();
    const application_no = $('#application_no').val();
    const high_tension_line_pass = document.querySelector('input[name="high_tension_line_pass"]:checked');
    const safety_distance = document.querySelector('input[name="safety_distance"]:checked');
    const distance = $('#distance').val();
    const fire_fighting = document.querySelector('input[name="fire_fighting"]:checked');
    const high_inflammable = document.querySelector('input[name="high_inflammable"]:checked');
    const detail = $('#detail').val();
    const other = $('#other').val();
    const specific_requirement_one = $('#specific_requirement_one').val();
    const specific_requirement_two = $('#specific_requirement_two').val();
    function validateField(field, errorId)
    {
        if (!field)
        {
            $('#' + errorId).html("This field is required.");
            return false;
        }
        return true;
    }
    const errorIds = [
        'error1', 'error4', 'error5', 'error7', 'error8',
        'error9'
    ];
    errorIds.forEach(id => $('#' + id).html(""));
    if (!validateField(high_tension_line_pass, 'error1') || !validateField(fire_fighting, 'error4') || !validateField(high_inflammable, 'error5') || !validateField(other, 'error7') || !validateField(specific_requirement_one, 'error8') || !validateField(specific_requirement_two, 'error9'))
    {
        return;
    }

    if (high_tension_line_pass.value === 'yes')
    { if (!validateField(safety_distance, 'error2') || !validateField(distance, 'error3')) { return; } }
    else if (high_inflammable.value === 'yes')
    { if (!validateField(detail, 'error6')){ return; } }
    const formData = new FormData();
    formData.append('_token', _token);
    formData.append('noc_type', noc_type);
    formData.append('application_no', application_no);
    formData.append('high_tension_line_pass', high_tension_line_pass.value);
    formData.append('safety_distance', safety_distance.value);
    formData.append('distance', distance);
    formData.append('fire_fighting', fire_fighting.value);
    formData.append('high_inflammable', high_inflammable.value);
    formData.append('detail', detail);
    formData.append('other', other);
    formData.append('specific_requirement_one', specific_requirement_one);
    formData.append('specific_requirement_two', specific_requirement_two);
    $.ajax({
        url: "{{route('fso.temporaryAddPhysicalInsPost')}}",
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
                setTimeout(function(){ window.location.reload();},3000);
            }
            else
            {
                $('#errorBlock').html(response.msg).show();
            }
        }
    });
}
function assignedFso()
{
    const _token = $('input[name="_token"]').val();
    const noc_type = $('#noc_type').val();
    const application_no = $('#application_no').val();
    const assigned_id = $('#assigned_id').val();
    function validateField(field, errorId)
    {
        if (!field)
        {
            $('#' + errorId).html("This field is required.");
            return false;
        }
        return true;
    }
    const errorIds = [ 'error10' ];
    errorIds.forEach(id => $('#' + id).html(""));
    if (!validateField(assigned_id, 'error10')) { return; }
    const formData = new FormData();
    formData.append('_token', _token);
    formData.append('noc_type', noc_type);
    formData.append('application_no', application_no);
    formData.append('assigned_id', assigned_id);
    $.ajax({
        url: "{{route('temporary.assignedNocToFSO')}}",
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
                setTimeout(function(){ window.location.reload();},3000);
            }
            else
            {
                $('#errorBlock').html(response.msg).show();
            }
        }
    });
}
function sendForApproval()
{
    const _token = $('input[name="_token"]').val();
    const noc_type = $('#noc_type').val();
    const application_no = $('#application_no').val();
    const formData = new FormData();
    formData.append('_token', _token);
    formData.append('noc_type', noc_type);
    formData.append('application_no', application_no);
    $.ajax({
        url: "{{route('temporary.fso.approval')}}",
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
                setTimeout(function(){ window.location.reload();},3000);
            }
            else
            {
                $('#errorBlock').html(response.msg).show();
            }
        }
    });
}
function approved()
{
    const _token = $('input[name="_token"]').val();
    const noc_type = $('#noc_type').val();
    const application_no = $('#application_no').val();
    const formData = new FormData();
    formData.append('_token', _token);
    formData.append('noc_type', noc_type);
    formData.append('application_no', application_no);
    $.ajax({
        url: "{{route('temporary.cfo.approve')}}",
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
                setTimeout(function(){ window.location.reload();},3000);
            }
            else
            {
                $('#errorBlock').html(response.msg).show();
            }
        }
    });
}
function reject()
{
    const _token = $('input[name="_token"]').val();
    const noc_type = $('#noc_type').val();
    const application_no = $('#application_no').val();
    const formData = new FormData();
    formData.append('_token', _token);
    formData.append('noc_type', noc_type);
    formData.append('application_no', application_no);
    $.ajax({
        url: "{{route('temporary.cfo.reject')}}",
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
                setTimeout(function(){ window.location.reload();},3000);
            }
            else
            {
                $('#errorBlock').html(response.msg).show();
            }
        }
    });
}
function revertApplication()
{
    const _token = $('input[name="_token"]').val();
    const noc_type = $('#noc_type').val();
    const application_no = $('#application_no').val();
    const revert = $('#revert').val();
    const reason = $('input[name="reason[]"]:checked').map(function() {
        return $(this).val();
    }).get();
    const formData = new FormData();
    formData.append('_token', _token);
    formData.append('noc_type', noc_type);
    formData.append('application_no', application_no);
    formData.append('revert', revert);
    formData.append('reason', reason);
    $.ajax({
        url: "{{route('temporary.cfo.revert')}}",
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
                setTimeout(function(){ window.location.reload();},3000);
            }
            else
            {
                $('#errorBlock').html(response.msg).show();
            }
        }
    });
}

function remarkApplication()
{
    const _token = $('input[name="_token"]').val();
    const noc_type = $('#noc_type').val();
    const application_no = $('#application_no').val();
    const remark_reason = $('input[name="remark_reason[]"]:checked').map(function() {
        return $(this).val();
    }).get();
    const remark = $('#remark').val();
    function validateField(field, errorId) {
        if (Array.isArray(field) && field.length === 0) {
            $('#' + errorId).html("This field is required.");
            return false;
        } else if (!field) {
            $('#' + errorId).html("This field is required.");
            return false;
        }
        return true;
    }

    const errorIds = ['error11', 'error12'];
    errorIds.forEach(id => $('#' + id).html(""));

    // Validate remark_reason as an array and remark as a string
    if (!validateField(remark_reason, 'error11') || !validateField(remark, 'error12')) {
        return;
    }

    const formData = new FormData();
    formData.append('_token', _token);
    formData.append('noc_type', noc_type);
    formData.append('application_no', application_no);
    formData.append('remark_reason', remark_reason);
    formData.append('remark', remark);

    $.ajax({
        url: "{{route('temporary.cfo.remark')}}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response) {
            if (response.status == "1") {
                $('#successBlock').html(response.msg).show();
                setTimeout(function(){ window.location.reload();},3000);
            } else {
                $('#errorBlock').html(response.msg).show();
            }
        }
    });
}
</script>


@stop
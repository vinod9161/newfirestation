@extends('layouts.citizen.template')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Application Listings</h5>
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

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Application Listings
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Application Number</th>
                                <th>Application For</th>
                                <th>Type</th>
                                <th>Building Name</th>
                                <th>District</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($application as $key => $app)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $app->application_no }}</td>
                                <td>
                                    @if($app->noc_type =='building')
                                        Noc For Building
                                    @elseif($app->noc_type =='cinema_hall_multiplex')
                                        Noc For Cinema Hall- Multiplex
                                    @elseif($app->noc_type =='fire_arms_repair')
                                        Noc For Fire Arms Repair
                                    @elseif($app->noc_type =='fire_arms_selling')
                                        Noc For Fire Arms Selling
                                    @elseif($app->noc_type =='fire_arms_storage')
                                        Noc For Fire Arms Storage
                                    @elseif($app->noc_type =='gas_warehouse')
                                        Noc For Gas Warehouse and Agency
                                    @elseif($app->noc_type =='gas_oil_depot')
                                        Noc For Gas-Oil-Depot
                                    @elseif($app->noc_type =='sale_of_sulphur')
                                        Noc For Sale Of Sulphur
                                    @elseif($app->noc_type =='storage_magazine')
                                        Noc For Storage - Magazine
                                    @elseif($app->noc_type =='petrol_pump_cng_station')
                                        Noc For Petrol Pump-CNG Station
                                    @elseif($app->noc_type =='fire_works')
                                        Noc For Fire Works
                                    @else
                                        Noc For
                                    @endif
                                </td>
                                <td>{{ $app->application_type }}</td>
                                <td>{{ $app->building_name }}</td>
                                <td>
                                    @foreach($district as $key => $dist)
                                        @if($dist->id == $app->district_id)
                                            {{ $dist->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($app->status =='incomplete') 
                                        Incomplete
                                    @elseif($app->status =='pending') 
                                        New
                                    @elseif($app->status =='processed')
                                        Verifier Assign
                                    @elseif($app->status =='for approval')
                                        Verified
                                    @elseif($app->status =='pre approval')
                                        For Pre Approval
                                    @elseif($app->status =='pre approved')
                                        Pre Approved
                                    @elseif($app->status =='reverted')
                                        Reverted
                                    @elseif($app->status =='approved')
                                        Approved
                                    @endif
                                </td>
                                <td>
                                    @if($app->status=='reverted' || $app->status=='incomplete')
                                        <a href="{{route('noc.editNoc', $app->id)}}" class="btn btn-light btn-warning" title="Edit Application"><i class="fa fa-edit"></i> &nbsp;</a>
                                    @endif

                                    <a href="{{route('citizen.viewNocDetail', $app->id)}}" class="btn btn-light btn-edit" title="View"><i class="fa fa-eye"></i> &nbsp;</a>

                                    @if($app->status=='approved')
                                        <a onclick="return confirm('Are you sure you Want to Download NOC ?')" href="{{route('noc.download',$app->id)}}" class="btn btn-light btn-delete" title="Download NOC" target="_blank"><i class="fa fa-download"></i> </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

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
<script>
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
</script>
@stop
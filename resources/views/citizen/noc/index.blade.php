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
                <form method="GET" action="">
                    <div class="responsive-background">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <div class="advanced-search br-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label>Type</label>
                                        <input type="text" class="form-control" name="type" value="{{ request('type') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label>Building Name</label>
                                        <input type="text" class="form-control" name="building_name" value="{{ request('building_name') }}">
                                    </div>
                                    <div class="col-md-3">
                                        <label>District</label>
                                        <select class="form-control" name="district">
                                            <option value=""> Select District </option>
                                            @foreach($district as $dist)

                                                <option
                                                    value="{{ $dist->id }}"
                                                    {{ request('district')==$dist->id ? 'selected' : '' }}
                                                >
                                                    {{ $dist->name }}
                                                </option>

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="col-md-3">

                                        <label>Status</label>

                                        <select
                                            class="form-control"
                                            name="status"
                                        >

                                            <option value="">
                                                Select Status
                                            </option>

                                            <option
                                                value="pending"
                                                {{ request('status')=='pending' ? 'selected' : '' }}
                                            >
                                                Pending
                                            </option>

                                            <option
                                                value="approved"
                                                {{ request('status')=='approved' ? 'selected' : '' }}
                                            >
                                                Approved
                                            </option>

                                            <option
                                                value="reverted"
                                                {{ request('status')=='reverted' ? 'selected' : '' }}
                                            >
                                                Reverted
                                            </option>

                                        </select>

                                    </div>

                                    <div class="col-md-3 mt-3">

                                        <label>Payment Status</label>

                                        <select
                                            class="form-control"
                                            name="payment_status"
                                        >

                                            <option value="">
                                                Select Payment Status
                                            </option>

                                            <option
                                                value="pending"
                                                {{ request('payment_status')=='pending' ? 'selected' : '' }}
                                            >
                                                Pending
                                            </option>

                                            <option
                                                value="paid"
                                                {{ request('payment_status')=='paid' ? 'selected' : '' }}
                                            >
                                                Paid
                                            </option>

                                            <option
                                                value="failed"
                                                {{ request('payment_status')=='failed' ? 'selected' : '' }}
                                            >
                                                Failed
                                            </option>

                                        </select>

                                    </div>
                                    
                                    <div class="col-md-3" style="margin-top: 45px;">
                                        <button type="button" class="btn btn-primary" id="applyFilterBtn"> Apply </button>
                                        <a href="{{ url()->current() }}" class="btn btn-secondary"> Reset </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </form>
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
                                <th>Payment Status</th>
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
                                    @if($app->payment_status=='paid')
                                        <span class="badge bg-success"> Paid </span>
                                    @elseif($app->payment_status=='failed')
                                        <span class="badge bg-danger"> Failed </span>
                                    @else
                                        <span class="badge bg-warning">  Pending </span>
                                    @endif
                                    @if(!empty($app->submitted_at) && $app->payment_status!='paid')
                                        <a href="{{ url('payment/pre-establishment/'.$app->application_no) }}" class="btn btn-success" title="Pay Now" target="_blank"> Pay Now </a>
                                    @endif
                                    @if($app->payment_status=='paid')
                                        <a href="{{ route('invoice.view',$app->application_no) }}"
                                            class="btn btn-info"
                                            title="Download Invoice"
                                            target="_blank">
                                            <i class="fa fa-download"></i>
                                        </a>
                                    @endif
                                </td>

                                <td>
                                    @if ($countStatus == 'N' && ($app->status == 'reverted' || $app->status == 'incomplete'))
                                        <!-- <a href="{{ route('noc.editNoc', $app->id) }}" class="btn btn-light btn-warning" title="Edit Application">
                                            <i class="fa fa-edit"></i> &nbsp;
                                        </a> -->
                                        <a href="{{ route('noc.apply', ['noc' => $app->noc_type, 'type' => 'established', 'noc_id' => $app->id]) }}" class="btn btn-light btn-warning" title="Edit Application">
                                            <i class="fa fa-edit"></i> &nbsp;
                                        </a>
                                    @elseif ($countStatus == 'Y' && $app->status != 'pending' && $app->status != 'processed')
                                        <button type="button" class="btn btn-light btn-warning" data-bs-toggle="modal" data-bs-target="#warningModal">
                                            <i class="fa fa-edit"></i>
                                    </button>
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
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3>One of yor application is under review, you can't do this action until any action has been taken agianst it.</h3>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        
        document.getElementById('alert-text').onclick = function () {
           Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            })
        }
    });

    $(document).on('click','#applyFilterBtn',function(){
        let params=new URLSearchParams();

        let type=$('[name="type"]').val();
        let building_name=$('[name="building_name"]').val();
        let district=$('[name="district"]').val();
        let status=$('[name="status"]').val();
        let payment_status=$('[name="payment_status"]').val();

        if(type) params.append('type',type);

        if(building_name) params.append(
            'building_name',
            building_name
        );

        if(district) params.append(
            'district',
            district
        );

        if(status) params.append(
            'status',
            status
        );

        if(payment_status) params.append(
            'payment_status',
            payment_status
        );

        let url="{{ url()->current() }}";

        if(params.toString()){
            url+='?'+params.toString();
        }

        window.location.href=url;

        });
</script>
@stop
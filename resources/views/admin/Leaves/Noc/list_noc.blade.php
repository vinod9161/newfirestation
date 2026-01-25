@extends('layouts.admin.template')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Location / District</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div class="me-2">
            <a href="javascript:void(0);" class="btn ripple btn-wave  btn-secondary navresponsive-toggler mb-0"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1 fs-10"></i>
            </a>
        </div>
        <div>
            <!-- <a href="<//?php echo route('admin.addFireReport');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Fire Report
            </a> -->
            <a href="<?php echo route('admin.adddistrict');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New District
            </a>
        </div>
    </div>
</div>


<!--Navbar-->
<div class="responsive-background">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="advanced-search br-3">
        <form action="{{ route('admin.districtfilter') }}" method="GET" class="advanced-search br-3">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group mb-lg-0">
                        <label>Name :</label>
                        <input type="text" class="form-control" name="page" placeholder="Enter Name" value="{{ request('page') }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="form-group mb-lg-0">
                        <label>Status :</label>
                        <select class="form-control" name="status">
                            <option value="" disabled selected>-- Select An Option --</option>
                            <option value="1" {{ request('type') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="2" {{ request('type') == '2' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Apply</button>
        <a href="{{ route('admin.district') }}" class="btn btn-secondary">Reset</a>
    </div>
</form>

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
                    Slider List
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
                                <th style="width: 76px;" class="sorting_asc" tabindex="0"
                                    aria-controls="employee-table" rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="S No.: activate to sort column descending">S No.<div
                                        style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Employee Code: activate to sort column ascending"
                                    style="width: 134px;">Application Number<div style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Name: activate to sort column ascending"
                                    style="width: 153px;">Application For<div style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Gender: activate to sort column ascending"
                                    style="width: 67px;">Type
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Gender: activate to sort column ascending"
                                    style="width: 67px;">Building Name
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Gender: activate to sort column ascending"
                                    style="width: 67px;">District
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Gender: activate to sort column ascending"
                                    style="width: 67px;">Fire Station
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Gender: activate to sort column ascending"
                                    style="width: 67px;">Status
                                </th>

                                
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Designation: activate to sort column ascending"
                                    style="width: 127px;">Declaration Status
                                </th>
                                
                                <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;"
                                    tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Actions: activate to sort column ascending">Actions<div
                                        style="height: 25px;"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>


                        @php
               $i = 1;
               @endphp 
               @foreach ($applications as $application)

               @php $read = ''; @endphp
               @if(Auth::user()->type == 0)
                  @php $read = $application->admin_read; @endphp
               @elseif(Auth::user()->type == 1)
                  @php $read = $application->dd_read; @endphp
               @elseif(Auth::user()->type == 2)
                  @php $read = $application->cfo_read; @endphp
               @elseif(Auth::user()->type == 3)
                  @php $read = $application->fso_read; @endphp
               @elseif(Auth::user()->type == 5)
                  @php $read = $application->dm_read; @endphp
               @endif

               @php $color = ''; @endphp
               @if($application->status=='pending')

               @php $added_time = $application->created_at; @endphp

               @if(strtotime($added_time) < strtotime('-30 days'))
                   @php $color = 'red'; @endphp
               @elseif(strtotime($added_time) < strtotime('-15 days'))
                   @php $color = 'orange'; @endphp
               @else
                  @php $color = ''; @endphp
               @endif
               @endif

               <tr class="my-job-item text-center {{$color}} color @if ($read!= '1') application-read @endif">
                <td class="d-none d-xl-table-cell text-center number-application" style="width: 9%;">{{$i }}</td>
                  <td class="d-none d-xl-table-cell text-center number-application">
                     {{$application->application_no}}
                  </td>
                  <td class="d-none d-xl-table-cell text-center number-application">
                     @if($application->noc_type =='building')
                        Noc For Building
                     @elseif($application->noc_type =='cinema_hall_multiplex')
                        Noc For Cinema Hall- Multiplex
                     @elseif($application->noc_type =='fire_arms_repair')
                        Noc For Fire Arms Repair
                     @elseif($application->noc_type =='fire_arms_selling')
                        Noc For Fire Arms Selling
                     @elseif($application->noc_type =='fire_arms_storage')
                        Noc For Fire Arms Storage
                     @elseif($application->noc_type =='gas_warehouse')
                        Noc For Gas Warehouse and Agency
                     @elseif($application->noc_type =='gas_oil_depot')
                        Noc For Gas-Oil-Depot
                     @elseif($application->noc_type =='sale_of_sulphur')
                        Noc For Sale Of Sulphur
                     @elseif($application->noc_type =='storage_magazine')
                        Noc For Storage - Magazine
                     @elseif($application->noc_type =='petrol_pump_cng_station')
                        Noc For Petrol Pump-CNG Station
                     @elseif($application->noc_type =='fire_works')
                        Noc For Fire Works
                     @else
                        Noc For
                     @endif
                  </td>
                  <td class="d-none d-xl-table-cell text-center number-application">{{ucwords($application->application_type) }}</td>
                  <td class="d-none d-xl-table-cell text-center number-application">{{ucwords($application->application_type) }}</td>
                  <td class="d-none d-xl-table-cell text-center number-application">{{ucwords($application->building_name) }}</td>
                  <td class="d-none d-xl-table-cell text-center number-application">{{ucwords($application->dd_name) }}</td>
                  <td class="d-none d-xl-table-cell text-center number-application">
                     @if($application->status =='pending') 
                        New
                     @elseif($application->status =='processed')
                        Verifier Assign
                     @elseif($application->status =='for approval')
                        Verified
                     @elseif($application->status =='pre approval')
                        For Pre Approval
                     @elseif($application->status =='pre approved')
                        Pre Approved
                     @elseif($application->status =='reverted')
                        Reverted
                     @elseif($application->status =='approved')
                        Approved
                     @endif
                  </td>

                  <td class="d-none d-xl-table-cell text-center number-application">
                      <!-- @if($application->status =='Valid') 
                      Valid
                     @elseif($application->status =='Pending')
                     Pending
                     @endif -->
                     Valid
                  </td>

                  <td class="d-none d-md-table-cell text-right">
                     <a href="{{route('admin.adminviewNocDetail',$application->id)}}" class="btn btn-light btn-edit" title="View"><i class="fa fa-eye"></i> &nbsp;</a>

                     @if($application->status=='approved' || $application->status=='processed')
                     <a onclick="return confirm('Are you sure you Want to Download NOC ?')" href="{{route('noc.download',$application->id)}}" class="btn btn-light btn-delete" title="Download NOC" target="_blank"><i class="fa fa-download"></i> </a>
                     @endif

                     
                  </td>

                  @if($application->operational_applications)
                  </tr>
              @endif

               @php
               $i++;
               @endphp 
               @endforeach 
                     
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
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
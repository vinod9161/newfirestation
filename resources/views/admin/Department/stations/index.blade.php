@extends('layouts.admin.template')
@section('title')
<title>Department - Station</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Department / Stations</h5>
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

            <a href="<?php echo route('admin.addstations');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add Fire Station
            </a>
        </div>
    </div>
</div>



<?php // echo "<pre>"; print_r($station); die; ?>
<!--Navbar-->
<div class="responsive-background">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form action="{{ route('admin.reviewfilter') }}" method="GET" class="advanced-search br-3">
            <div class="advanced-search br-3">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-lg-0">
                                    <label>Name :</label>
                                    <input type="text" class="form-control" name="filter_name"
                                        value="{{ request('filter_name') }}" id="filter_name" placeholder=" Enter Name">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-lg-0">
                                    <label>District :</label>
                                    <input type="text" class="form-control" name="district_name" id="district_name"
                                        placeholder=" Enter District">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-lg-0">
                                    <label>Status :</label>
                                    <select class="form-control" name="status">
                                        <option value="" disabled selected>-- Select An Option --</option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Inactive
                                        </option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Active
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Apply</button>
                    <a href="{{ route('admin.stations') }}" class="btn btn-secondary">Reset</a>
                </div>
            </div>
        </form>
    </div>
</div>
<!--End Navbar -->

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Station List
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
                                <th style="width: 76px;" class="sorting_asc" tabindex="0" aria-controls="employee-table"
                                    rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="S No.: activate to sort column descending">S No.<div
                                        style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 153px;">District
                                    <div style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Employee Code: activate to sort column ascending" style="width: 134px;">
                                    Fire Station Name<div style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Gender: activate to sort column ascending" style="width: 67px;">Land
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Gender: activate to sort column ascending" style="width: 67px;">Building
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Gender: activate to sort column ascending" style="width: 67px;">
                                    Sanctioned Strength
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Gender: activate to sort column ascending" style="width: 67px;">
                                    Available Strength
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Designation: activate to sort column ascending" style="width: 127px;">
                                    Status
                                </th>

                                <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;" tabindex="0"
                                    aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Actions: activate to sort column ascending">Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($stations))
                            @foreach($stations as $key => $row)
                                <tr>
                                    <td class="d-none d-xl-table-cell text-center number-application">{{ $key+1 }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application">{{ ucfirst($row['dname']) }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application">{{ ucfirst($row['name']) }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application">
                                        @if($row['land'] =='Available')
                                        @php echo "Available" @endphp
                                        @else
                                        @php echo "Not Available" @endphp
                                        @endif
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center number-application">
                                        @if($row['building'] =='Available')
                                        @php echo "Available" @endphp
                                        @else
                                        @php echo "Not Available" @endphp
                                        @endif
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center number-application">
                                        {{ $row['count_strength'] }}
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center number-application">
                                        {{ $row['count_avail'] }}
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center number-application">
                                        @if($row['status']==0)
                                        @php echo "In-active" @endphp
                                        @else
                                        @php echo "Active" @endphp
                                        @endif
                                    </td>
                                    <td class="d-none d-md-table-cell text-right">
                                        @if(Auth::user()->type == 3 || Auth::user()->type == 0 || Auth::user()->type == 2 ||
                                        Auth::user()->type == 1)
                                        <a href="{{ route('admin.editStation', $row['id']) }}"
                                            class="btn btn-primary btn-view" title="View">Edit &nbsp;</a>
                                        @endif
                                        <form action="{{ route('admin.deletestations', $row['id']) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this Stations?');">
                                                <i class="fe fe-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center text-danger" colspan="9">No Data Found</td>
                            </tr>
                            @endif

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

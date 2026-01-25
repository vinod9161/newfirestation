@extends('layouts.admin.template')
@section('title')
<title>Employee List | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Employee</h5>
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
            <a href="<?php echo route('admin.addemployees');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Employee
            </a>
        </div>
    </div>
</div>


<!--Navbar-->
<div class="responsive-background">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="advanced-search br-3">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Page :</label>
                                <input type="text" class="form-control" id="filter_page" placeholder=" Enter Page">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Title :</label>
                                <input type="text" class="form-control" id="filter_title" placeholder=" Enter Title">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Type :</label>
                                <select class="form-control" data-trigger name="choices-single-default"
                                    id="filter_type">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="1">Image</option>
                                    <option value="2">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Status :</label>
                                <select class="form-control" data-trigger name="choices-single-default"
                                    id="filter_status">
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
                    Employees
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
                                    aria-label="Employee Code: activate to sort column ascending" style="width: 134px;">
                                    Employee Code<div style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Name: activate to sort column ascending" style="width: 153px;">Name<div
                                        style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Gender: activate to sort column ascending" style="width: 67px;">Gender
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Designation: activate to sort column ascending" style="width: 127px;">
                                    Designation
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="District: activate to sort column ascending" style="width: 132px;">
                                    district_id</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Fire Station: activate to sort column ascending" style="width: 106px;">
                                    Fire Station
                                </th>
                                <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;" tabindex="0"
                                    aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Actions: activate to sort column ascending">Actions<div
                                        style="height: 25px;"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fs_employee as $index => $employee)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $employee->employee_code }}</td>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->gender }}</td>
                                <td>{{ $employee->designation }}</td>
                                <td>{{ $employee->district_name }}</td>
                                <td>{{ $employee->fire_station_name }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.editemployees', $employee->id) }}"
                                        class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <form action="{{ route('admin.deleteemployees', $employee->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this Employee?');">
                                            <i class="fe fe-trash"></i>
                                        </button>
                                    </form>
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
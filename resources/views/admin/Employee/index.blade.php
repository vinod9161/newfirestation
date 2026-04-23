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
            @if(Auth::user()->type == 0 || Auth::user()->type == 1)
            <a href="<?php echo route('admin.addemployees');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Employee
            </a>
            @endif
        </div>
    </div>
</div>


<!--Navbar-->
<div class="responsive-background">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="advanced-search br-3">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <select id="filter_district" class="form-control" {{ Auth::user()->type == 2 ? 'disabled' : '' }}>
                                <option value="">All District</option>
                                @foreach($districts as $district)
                                    <option value="{{ $district->id }}"
                                        {{ request('district', Auth::user()->district_id) == $district->id ? 'selected' : '' }}>
                                        {{ $district->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select id="filter_station" class="form-control">
                                <option value="">All Station</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" id="filter_designation" class="form-control" placeholder="Designation">
                        </div>

                        <div class="col-md-3">
                            <button class="btn btn-primary" onclick="applyFilter()">Apply</button>
                            <a href="{{ url()->current() }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <hr>
            <div class="text-end">
                <a href="javascript:void(0);" onclick="filter_slider();" class="btn btn-primary">Apply</a>
                <a href="javascript:void(0);" class="btn btn-secondary">Reset</a>
            </div> -->
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
                                @if(Auth::user()->type != 3)
                                    <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;" tabindex="0"
                                        aria-controls="employee-table" rowspan="1" colspan="1"
                                        aria-label="Actions: activate to sort column ascending">Actions<div
                                            style="height: 25px;"></div>
                                    </th>
                                @endif
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
                                @if(Auth::user()->type != 3)
                                    <td class="text-right">
                                        <a href="{{ route('admin.editemployees', $employee->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        @if(Auth::user()->type == 0)
                                        <form action="{{ route('admin.deleteemployees', $employee->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this Employee?');">
                                                <i class="fe fe-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                @endif
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


    $(document).ready(function(){
        // $(document).on('change', '#filter_district', function() {
        //     let districts = $(this).val();
        //     let filter_station = '';

        //     if (districts === '') {
        //         $('#error1').html('Missing Districts Data').delay(3000).fadeOut().css('display', 'block');
        //         return false;
        //     }

        //     $.ajax({
        //         url: '{{ route("admin.getfirestation") }}',
        //         type: 'POST',
        //         data: {
        //             districts: districts,
        //             _token: '{{ csrf_token() }}'
        //         },
        //         success: function(resp) 
        //         {
        //             station = '<option value="">Select Station फायर स्टेशन</option>';

        //             console.log(resp);
                    
        //             if (resp.status === 0) 
        //             {
        //                 station += '<option value="" class="text-danger">No fire station found against this districts</option>';
        //             } 
        //             else 
        //             {
        //                 $.each(resp.data, function(key, value) 
        //                 {
        //                     station += '<option value="' + value.id + '">' + value.name + '</option>';
        //                 });
        //             }
        //             $('#filter_station').html(station);

        //             if ($('#filter_station').data('select2')) {
        //                 $('#filter_station').select2().val(null).trigger('change'); // Reset and refresh
        //             } 
        //             else {
        //                 $('#filter_station').val(null); // If not using a plugin, just reset the value
        //             }
        //         }
        //     });
        // });
    });

    $(document).ready(function () {

        function loadStations(districtId, selectedStation = '') {
            if (!districtId) return;

            $.ajax({
                url: '{{ route("admin.getfirestation") }}',
                type: 'POST',
                data: {
                    districts: districtId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (resp) {
                    let station = '<option value="">All Station</option>';

                    if (resp.status === 0) {
                        station += '<option value="">No station found</option>';
                    } else {
                        $.each(resp.data, function (key, value) {
                            let selected = (value.id == selectedStation) ? 'selected' : '';
                            station += `<option value="${value.id}" ${selected}>${value.name}</option>`;
                        });
                    }

                    $('#filter_station').html(station);
                }
            });
        }

        // 🔥 AUTO LOAD for CFO / page reload
        let districtId = $('#filter_district').val();
        let selectedStation = "{{ request('station') }}";

        if (districtId) {
            loadStations(districtId, selectedStation);
        }

        // 🔁 On change
        $(document).on('change', '#filter_district', function () {
            loadStations($(this).val());
        });

    });

    function applyFilter() {
        let district = $('#filter_district').val();
        let station = $('#filter_station').val();
        let designation = $('#filter_designation').val();

        window.location.href =
            `?district=${district}&station=${station}&designation=${designation}`;
    }
</script>
@stop
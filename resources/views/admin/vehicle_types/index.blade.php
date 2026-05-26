@extends('layouts.admin.template')
@section('title')
<title>Vehicle Types</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Vehicle</h5>
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
            <a href="<?php echo route('admin.addVehicleTypesForm');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Vehicle Type
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
                    <form method="GET"
                        action="{{ route('admin.vehicletypes') }}"
                        id="filterForm">

                        <div class="row">

                            <!-- Vehicle Type -->
                            <div class="col-md-4 mb-3">

                                <label>Vehicle Type</label>

                                <input type="text"
                                    class="form-control"
                                    name="type"
                                    placeholder="Enter Vehicle Type"
                                    value="{{ request('type') }}">

                            </div>

                            <!-- Status -->
                            <div class="col-md-4 mb-3">

                                <label>Status</label>

                                <select class="form-control" name="status">

                                    <option value="">Select Status</option>

                                    <option value="1"
                                        {{ request('status') == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>

                                    <option value="0"
                                        {{ request('status') == '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>

                                </select>

                            </div>

                            <!-- Buttons -->
                            <div class="col-md-4 mb-3 d-flex align-items-end">

                                <button type="submit"
                                        class="btn btn-primary me-2">
                                    Filter
                                </button>

                                <a href="{{ route('admin.vehicletypes') }}"
                                class="btn btn-secondary">
                                Reset
                                </a>

                            </div>

                        </div>

                    </form>

                </div>
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
                    Vehicle Types List
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
                                    colspan="1" aria-label="Designation: activate to sort column ascending"
                                    style="width: 127px;">Vehicle Type
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Employee Code: activate to sort column ascending"
                                    style="width: 134px;">Status<div style="height: 25px;"></div>
                                </th>
                                <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;"
                                    tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Actions: activate to sort column ascending">Actions<div
                                        style="height: 25px;"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicletypes as $index => $vehicle)
                                <tr>
                                    <td>{{ $index + 1 }}</td> 
                                    <td>{{ $vehicle->type }}</td> 
                                    <td>{{ $vehicle->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.editVehicleTypes', $vehicle->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                        <a href="{{ route('admin.deleteVehicleTypes', $vehicle->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vehicle type?');"><i class="fe fe-trash"></i></a>
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

<script>

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

    $('#filterForm').on('submit', function () {

        $(this).find(':input').each(function () {

            if (
                !$(this).val()
                && $(this).attr('type') != 'submit'
            ) {
                $(this).prop('disabled', true);
            }

        });

    });

</script>
@stop
@extends('layouts.admin.template')
@section('title')
<title>Equipment List</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Equipment</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div class="me-2">
            <a href="javascript:void(0);"
            class="btn ripple btn-wave btn-secondary navresponsive-toggler mb-0"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">

                <i class="fe fe-filter me-1"></i>
                Filter
                <i class="fa fa-caret-down ms-1 fs-10"></i>

            </a>
        </div>
        <div>
            <a href="<?php echo route('admin.add-equipment');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add Equipment
            </a>
        </div>    


    </div>
</div>

<div class="responsive-background mb-3">

    <div class="collapse navbar-collapse"
         id="navbarSupportedContent">

        <div class="advanced-search br-3 p-3">

            <form method="GET"
                  action="{{ url()->current() }}"
                  id="filterForm">

                <div class="row">

                    <!-- District -->
                    <div class="col-md-2 mb-3">

                        <select name="district_id"
                                class="form-control" id="filter_district">

                            <option value="">District</option>

                            @foreach($districts as $district)

                                <option value="{{ $district->id }}"
                                    {{ request('district_id') == $district->id ? 'selected' : '' }}>

                                    {{ $district->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Station -->
                    <div class="col-md-2 mb-3">

                        <select name="station_id"
                                class="form-control" id="filter_station">

                            <option value="">Station</option>

                            @foreach($stations as $station)

                                <option value="{{ $station->id }}"
                                    {{ request('station_id') == $station->id ? 'selected' : '' }}>

                                    {{ $station->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Category -->
                    <div class="col-md-2 mb-3">

                        <select name="category_id"
                                class="form-control" id="filter_category">

                            <option value="">Category</option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    {{ request('category_id') == $category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Equipment Name -->
                    <div class="col-md-3 mb-3">

                        <select name="equipment_name"
                                class="form-control" id="filter_equipment_name">

                            <option value="">Equipment Name</option>

                            @foreach($equipmentNames as $equipment)

                                <option value="{{ $equipment->id }}"
                                    {{ request('equipment_name') == $equipment->id ? 'selected' : '' }}>

                                    {{ $equipment->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Added Date -->
                    <div class="col-md-3 mb-3">

                        <input type="date"
                               name="added_date"
                               class="form-control"
                               id="filter_added_date"
                               value="{{ request('added_date') }}">

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-12 text-end">

                        <button type="submit"
                                class="btn btn-primary">
                            Apply
                        </button>

                        <a href="{{ url()->current() }}"
                           class="btn btn-secondary">
                           Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Equipment List
                </div>
            </div>
            <div class="card-body">
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
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Districts</th>
                                <th>Fire Stations</th>
                                <th>Categories</th>
                                <th>Equipment Name</th>
                                <th>Total Equipment</th> 
                                <th>Total Working Equipment</th>
                                <th>Total Non Working Equipment</th>
                                <th>Status</th>
                                <th>Added Date</th>
                                <th>Action</th>    
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($getData)):?>
                                <?php foreach($getData as $key => $val):?>
                                    <tr>
                                        <td><?= $key+1; ?></td>
                                        <td><?= $val->district_name; ?></td>
                                        <td><?= $val->fire_station_name; ?></td>
                                        <td><?= $val->category_name; ?></td>
                                        <td><?= $val->equipment_name; ?></td>
                                        <td><?= $val->total_equipemnt; ?></td>
                                        <td><?= $val->total_working_equipment; ?></td>
                                        <td><?= $val->total_non_working_equipment; ?></td>
                                        <td>
                                            <?php if($val->status == '1'):?>
                                                <span class="badge bg-success-transparent">Active</span>
                                            <?php else:?>   
                                                <span class="badge bg-danger-transparent">Inactive</span> 
                                            <?php endif;?>    
                                        </td>
                                        <td>
                                            {{ $val->added_date }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.editequipment', $val->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <?php if(Auth::user()->type == '0'):?>
                                            <a href="javascript:void(0)" data-id="{{ $val->id }}" class="btn btn-danger btn-sm delete">Delete</a>
                                            <?php endif;?> 
                                            
                                        </td>
                                    </tr>   
                                <?php endforeach; ?>    
                            <?php else:?>
                            <tr>
                                <td colspan="9" class="text-danger">No Data Found</td>
                            </tr>            
                            <?php endif;?>    
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
    $(document).on('click', '.delete', function() {
        let id = $(this).data('id');

        if(id=='')
        {
            alert("Required Equipment Id");
            return false;
        }
        else{
            if (confirm("Are you sure you want to remove this data?")) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.deleteequipment') }}",
                    data:{id:id, _token: "{{ csrf_token() }}"},
                    success:function(resp)
                    {
                        let obj = JSON.parse(resp);
                        if(obj.status == 1)
                        {
                            alert(obj.message);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                        else{
                            alert(obj.message);
                        }
                    }
                })
            }
        }

        
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
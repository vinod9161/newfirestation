@extends('layouts.admin.template')

@section('title')
<title>Department - FSO</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')

@php
    use Illuminate\Support\Facades\DB;
@endphp
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Department / FSO</h5>
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

            <a href="<?php echo route('admin.addfso');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New FSO
            </a>
        </div>
    </div>
</div>


<!--Navbar-->
<div class="responsive-background">

    <div class="collapse navbar-collapse"
         id="navbarSupportedContent">

        <form action="{{ route('admin.fso') }}"
              method="GET"
              class="advanced-search br-3"
              id="filterForm">

            <div class="advanced-search br-3">

                <div class="row align-items-center">

                    <!-- Name -->
                    <div class="col-md-3">

                        <div class="form-group mb-lg-0">

                            <label>Name :</label>

                            <input type="text"
                                   class="form-control"
                                   name="filter_name"
                                   value="{{ request('filter_name') }}"
                                   placeholder="Enter Name">

                        </div>

                    </div>

                    <!-- Email -->
                    <div class="col-md-3">

                        <div class="form-group mb-lg-0">

                            <label>Email :</label>

                            <input type="text"
                                   class="form-control"
                                   name="filter_email"
                                   value="{{ request('filter_email') }}"
                                   placeholder="Enter Email">

                        </div>

                    </div>

                    <!-- District -->
                    <div class="col-md-3">

                        <div class="form-group mb-lg-0">

                            <label>District :</label>

                            <select class="form-control"
                                    name="district_id">

                                <option value="">
                                    -- Select District --
                                </option>

                                @foreach($districts as $district)

                                    <option value="{{ $district->id }}"
                                        {{ request('district_id') == $district->id ? 'selected' : '' }}>

                                        {{ $district->name }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                    </div>

                    <!-- Status -->
                    <div class="col-md-3">

                        <div class="form-group mb-lg-0">

                            <label>Status :</label>

                            <select class="form-control"
                                    name="status">

                                <option value="">
                                    -- Select Status --
                                </option>

                                <option value="0"
                                    {{ request('status') == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                                <option value="1"
                                    {{ request('status') == '1' ? 'selected' : '' }}>
                                    Active
                                </option>

                            </select>

                        </div>

                    </div>

                </div>

                <hr>

                <div class="text-end">

                    <button type="submit"
                            class="btn btn-primary">
                        Apply
                    </button>

                    <a href="{{ route('admin.fso') }}"
                       class="btn btn-secondary">
                        Reset
                    </a>

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
                    FSO List
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>District</th>
                                <th>Station</th>
                                <th>Status</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($fso as $index => $user)
                            @php
                            $stationName = DB::table('fire_stations')->where('id', $user->station_id)->value('name');
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->number }}</td>
                                <td>{{ $user->district->name ?? 'N/A' }}</td>
                                <td>{{ $stationName ?? 'N/A' }}</td>
                                <td>{{ $user->status == 1 ? 'Active' : 'Inactive' }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.editfso', $user->id) }}" class="btn btn-sm btn-primary"><i
                                            class="fa fa-edit"></i></a>
                                    <a href="{{ route('admin.uploadSignature', $user->id) }}"
                                        class="btn btn-sm btn-success"><i
                                            class="fa fa-assistive-listening-systems"></i></a>
                                    <form action="{{ route('admin.deletefso', $user->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this Depty Director?');">
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

<script>

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

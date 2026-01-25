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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Issued Noc</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div class="me-2">
            <a href="{{route('citizen.addIssuedNoc')}}" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Noc
            </a>
        </div>
    </div>
</div>
<!-- End Row -->

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
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
                                <th>Building</th>
                                <th>District</th>
                                <th>Issued On</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($issued as $key => $iss)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $iss->application_no }}</td>
                                <td>{{$iss->project}}</td>
                                <td>{{ $iss->application_type }}</td>
                                <td>{{ $iss->building_name }}</td>
                                <td>
                                    @foreach($district as $key => $dist)
                                        @if($dist->id == $iss->district_id)
                                            {{ $dist->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{$iss->created_at}}</td>
                                <td>{{$iss->status}}</td>
                                <td><a href="{{ asset($iss->file) }}" class="btn btn-light btn-delete" title="Download NOC" target="_blank"><i class="fa fa-download"></i> </a>
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
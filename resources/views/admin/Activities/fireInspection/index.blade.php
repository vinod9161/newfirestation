@extends('layouts.admin.template')
@section('title')
<title>Categories | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Fire Inspection</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('admin.addFireInspection'); ?>"
                class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add Fire Inspection
            </a>
        </div>
    </div>
</div>
<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive---">
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
                    <table id="datatable-basic" class="table table-bordered">
                        <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>District</th>
                                <th>Station</th>
                                <th>Date</th>
                                <th>Category</th>
                                <th>Name of Firm</th>
                                <th>Condition</th>
                                <th>Action taken</th>
                                <th>Comments</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($fireInspection as $ins)
                            <tr class="my-job-item">
                                <td class="d-none d-xl-table-cell text-center number-application"
                                    style="width: 9%;">{{$i }}</td>
                                <td>
                                    @foreach($districts as $key => $dist)
                                    @if($ins->district_id == $dist->id)
                                    {{ $dist->name }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>
                                    
                                    @foreach($station as $key => $st)
                                    @if($ins->station_id == $st->id)
                                    {{ $st->name }}
                                    @endif
                                    @endforeach
                                </td>
                                <td>{{date('d-M-Y', strtotime($ins->date))}}</td>
                                <td>{{$ins->category}}</td>
                                <td>{{$ins->firm_name}}</td>
                                <td>{{$ins->condition}}</td>
                                <td>{{$ins->action}}</td>
                                <td>{{$ins->comment}}</td>
                                <td class="d-none d-md-table-cell text-right">
                                    <a href="{{route('admin.viewFireInspection', $ins->id)}}"
                                        class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-eye"></i>
                                        &nbsp;</a>

                                    <!-- <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('admin.deleteFireInspection', $ins->id)}}" class="btn btn-danger btn-sm" title="Delete"><i class="far fa-trash-alt"></i> </a> -->

                                </td>
                            </tr>
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
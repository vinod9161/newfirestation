@extends('layouts.admin.template')
@section('title')
<title>Fire Risk Auditor अग्नि जोखिम लेखाकार</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Fire Risk Auditor अग्नि जोखिम लेखाकार</h5>
    </div>
</div>

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Fire Risk Auditor अग्नि जोखिम लेखाकार
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
                                <th>Registration No.</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                            <?php $sn=1; if(!empty($getriskauditor)):?>
                            <?php foreach($getriskauditor as $key => $val):?>
                                <tr>
                                    <td>{{ $sn; }}</td>
                                    <td>{{ $val->number; }}</td>
                                    <td>{{ $val->status }}</td>
                                    <td>{{ ucfirst($val->remark) }}</td>
                                    <td class="d-none d-md-table-cell text-right">

                                            @if($val->status =='Approved')
                                            <a onclick="return confirm('Are you sure you Want to Download Certificate ?')" href="{{route('riskAuditorDownload', $val->id)}}" class="btn btn-primary btn-edit" title="Download" target="_blank"><i class="fa fa-cloud-download"></i> Download</a>
                                            @endif


                                            <a href="{{ route('admin.auditor.risk.view', $val->id)}}" class="btn btn-info btn-view" title="View"><i class="fa fa-eye"></i> View </a>


                                            <!-- <a onclick="return confirm('Are you sure you Want to Delete ?')" href="#" class="btn btn-light btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a> -->

                                    </td>

                                </tr>
                            <?php $sn++; endforeach?>
                            <?php else:?>
                                <tr>
                                    <td colspan="7" class="text-danger">No Data Found</td>
                                </tr>
                            <?php endif;?>


                        <tbody>
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

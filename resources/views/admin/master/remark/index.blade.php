@extends('layouts.admin.template')
@section('title')
<title>Remark Noc</title>
@endsection()
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Remark</h5>
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
            <a href="<?php echo route('admin.addRemark');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add Remark
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
                    Remark List
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table ucp-table table-hover table-bordered display" cellpadding="0" cellspacing="0" width="100%" id="datatable-basic">
                     <thead>
                        <tr>
                           <th style="width:9%;">S No.</th>
                           <th style="width:40%;">Remark Details</th>
                           <th>Status</th>
                           <th class="d-none d-md-table-cell text-right">Actions</th>
                        </tr>
                     </thead>
                     @php
                     $i = 1;
                     @endphp 
                     @foreach($remarks as $cat)
                     <tr class="my-job-item">
                        <td class="d-none d-xl-table-cell text-center number-application" style="width: 9%;">{{$i }}</td>
                        <td class="d-none d-xl-table-cell  number-application">{{ucfirst($cat->title)}}</td>
                        <td class="d-none d-xl-table-cell text-center number-application">
                           @if($cat->status ==0)
                           @php echo "In-active" @endphp
                           @else 
                           @php echo "Active" @endphp
                           @endif
                        </td>
                        <td class="d-none d-md-table-cell text-right">
                           <a href="{{route('admin.editRemark', $cat->id)}}" class="btn btn-info btn-sm btn-edit" title="Edit"><i class="fas fa-pencil-alt"></i> &nbsp;</a>
                           <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('admin.deleteRemark', $cat->id)}}" class="btn btn-danger btn-sm btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a>
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
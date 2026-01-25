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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Recent Updates</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.recentupdates');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Recent Updates List
            </a>
        </div>
    </div>
</div>




<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add Recent Updates
                </div>
            </div>
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

                    <form action="{{ route('admin.saveRecentUpdates') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Title">
                                    <span class="text-danger" id="error_1"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Document <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="document" name="document">
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status" data-trigger>
                                        <option value="" disabled="" selected="">Select An Option</option>
                                        <option value="0">Inactive </option>
                                        <option value="1">Active </option>
                                    </select>
                                    <span class="text-danger" id="error_3"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Rank <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="description" name="description" rows="10"></textarea>
                                    <span class="text-danger" id="error_4"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" id="addRecentUpdates" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
                            </div>
                        </div>
                    </form>  
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


// form validation

$(document).ready(function(){
    $('#addRecentUpdates').on('click', function(){
        let title = $('#title').val();
        let document = $('#document').val();
        let status = $('#status').val();
        let description = $('#description').val();
        if(title == '')
        {
            var msg = "Title field is required.";
            $('#error_1').text(msg);
            return false;
        }
        else if(document == '')
        {
            var msg = "Document field is required.";
            $('#error_1').text('');
            $('#error_2').text(msg);
            return false;
        }
        else if(status == '')
        {
            var msg = "Status field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text(msg);
            return false;
        }
        else if(description == '')
        {
            var msg = "Description field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text(msg);
            return false;
        }
        else
        {
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            return true;
        }
    });
});


</script>
@stop
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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Organisational Structure</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.organisational');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Organisational Structure List
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
                    Edit Organisational Structure
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

                    <form action="{{ route('admin.updateOrganisational') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Organisational Structure Type <span class="text-danger">*</span></label>
                                    <select class="form-control" name="type" id="type" data-trigger>
                                        <option value="" disabled="" selected="">Select An Option</option>
                                            <option {{ $organisational[0]->type == 1 ? 'selected' : '' }} value="1">Headquater </option>
                                            <option {{ $organisational[0]->type == 2 ? 'selected' : '' }} value="2">District </option>
                                            <option {{ $organisational[0]->type == 3 ? 'selected' : '' }} value="3">Fire Station </option>
                                    </select>
                                    <span class="text-danger" id="error_1"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Name Of Officer <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $organisational[0]->name }}">
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Designation <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="designation" name="designation" value="{{ $organisational[0]->designation }}">
                                    <span class="text-danger" id="error_3"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Mobile No. <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $organisational[0]->mobile }}">
                                    <span class="text-danger" id="error_4"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Phone No. <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ $organisational[0]->phone }}">
                                    <span class="text-danger" id="error_5"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ $organisational[0]->email }}">
                                    <span class="text-danger" id="error_6"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">District <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="district" name="district" value="{{ $organisational[0]->district }}">
                                    <span class="text-danger" id="error_7"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Fire Station <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="firestation" name="firestation" value="{{ $organisational[0]->firestation }}">
                                    <span class="text-danger" id="error_8"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Rank <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="rank" name="rank" value="{{ $organisational[0]->rank }}">
                                    <span class="text-danger" id="error_9"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Profile Pic</label>
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status" data-trigger>
                                        <option value="" disabled="" selected="">Select An Option</option>
                                        <option {{ $organisational[0]->status == 0 ? 'selected' : '' }} value="0">Inactive </option>
                                        <option {{ $organisational[0]->status == 1 ? 'selected' : '' }} value="1">Active </option>
                                    </select>
                                    <span class="text-danger" id="error_10"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" id="id" name="id" value="{{ $organisational[0]->id }}">
                                <button type="submit" id="addOrganisational" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
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
            searchvalue: 'Search...',
            sSearch: '',
        },
    });
});


// form validation

$(document).ready(function(){
    $('#addOrganisational').on('click', function(){
        let type = $('#type').val();
        let name = $('#name').val();
        let designation = $('#designation').val();
        let mobile = $('#mobile').val();
        let phone = $('#phone').val();
        let email = $('#email').val();
        let district = $('#district').val();
        let firestation = $('#firestation').val();
        let rank = $('#rank').val();
        let status = $('#status').val();
        if(type == '')
        {
            var msg = "Type field is required.";
            $('#error_1').text(msg);
            return false;
        }
        else if(name == '')
        {
            var msg = "Name field is required.";
            $('#error_1').text('');
            $('#error_2').text(msg);
            return false;
        }
        else if(designation == '')
        {
            var msg = "Designation field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text(msg);
            return false;
        }
        else if(mobile == '')
        {
            var msg = "Mobile field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text(msg);
            return false;
        }
        else if(phone == '')
        {
            var msg = "Phone field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            $('#error_5').text(msg);
            return false;
        }
        else if(email == '')
        {
            var msg = "Email address field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            $('#error_5').text('');
            $('#error_6').text(msg);
            return false;
        }
        else if(district == '')
        {
            var msg = "District field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            $('#error_5').text('');
            $('#error_6').text('');
            $('#error_7').text(msg);
            return false;
        }
        else if(firestation == '')
        {
            var msg = "Fire station field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            $('#error_5').text('');
            $('#error_6').text('');
            $('#error_7').text('');
            $('#error_8').text(msg);
            return false;
        }
        else if(rank == '')
        {
            var msg = "Rank field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            $('#error_5').text('');
            $('#error_6').text('');
            $('#error_7').text('');
            $('#error_8').text('');
            $('#error_9').text(msg);
            return false;
        }
        else if(status == '')
        {
            var msg = "Status field is required.";
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            $('#error_5').text('');
            $('#error_6').text('');
            $('#error_7').text('');
            $('#error_8').text('');
            $('#error_9').text('');
            $('#error_10').text(msg);
            return false;
        }
        else
        {
            $('#error_1').text('');
            $('#error_2').text('');
            $('#error_3').text('');
            $('#error_4').text('');
            $('#error_5').text('');
            $('#error_6').text('');
            $('#error_7').text('');
            $('#error_8').text('');
            $('#error_9').text('');
            $('#error_10').text('');
            return true;
        }
    });
});


</script>
@stop
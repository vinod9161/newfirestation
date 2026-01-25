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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Special Risk Area</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.specialriskarea');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Special Risk Area List
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
                    Edit Special Risk Area
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

                    <form action="{{ route('admin.updateSpecialRiskArea') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Districts <span class="text-danger">*</span></label>
                                    <select class="form-control" name="district" id="district" data-trigger>
                                        <option value="" disabled="" selected="">Select An Option</option>
                                        @foreach($districts as $index => $dist)
                                        <option {{ $specialriskarea[0]->district == $dist->name ? 'selected' : '' }} value="{{ $dist->name }}"> {{ $dist->name }} </option>
                                        @endforeach;
                                    </select>
                                    <span class="text-danger" id="error_1"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Fire Stations <span class="text-danger">*</span></label>
                                    <select class="form-control" name="firestation" id="firestation" data-trigger>
                                        <option value="" disabled="" selected="">Select An Option</option>
                                        @foreach($firestation as $index => $fs)
                                        <option {{ $specialriskarea[0]->firestation == $fs->name ? 'selected' : '' }} value="{{ $fs->name }}"> {{ $fs->name }} </option>
                                        @endforeach;
                                    </select>
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">status <span class="text-danger">*</span></label>
                                    <select class="form-control" name="status" id="status" data-trigger>
                                        <option value="" disabled="" selected="">Select An Option</option>
                                        <option {{ $specialriskarea[0]->status == 0 ? 'selected' : '' }} value="0">Inactive </option>
                                        <option {{ $specialriskarea[0]->status == 1 ? 'selected' : '' }} value="1">Active </option>
                                    </select>
                                    <span class="text-danger" id="error_3"></span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Vulnerable Areas <span class="text-danger">*</span></label>
                                    <textarea class="form-control" name="vulnerable_areas" id="vulnerable_areas" rows="10">{{ $specialriskarea[0]->vulnerable_areas }}</textarea>
                                    <span class="text-danger" id="error_4"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" id="id" name="id" value="{{ $specialriskarea[0]->id }}">
                                <button type="submit" id="addSpecialRiskArea" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
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
    $('#addSpecialRiskArea').on('click', function(){
        let district = $('#district').val();
        let firestation = $('#firestation').val();
        let vulnerable_areas = $('#vulnerable_areas').val();
        let status = $('#status').val();
         if(district == '')
        {
            var msg = "District field is required.";
            $('#error_1').text(msg);
            return false;
        }
        else if(firestation == '')
        {
            var msg = "Fire station field is required.";
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
        else if(vulnerable_areas == '')
        {
            var msg = "Vulnerable areas field is required.";
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
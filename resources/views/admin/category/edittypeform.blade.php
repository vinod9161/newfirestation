@extends('layouts.admin.template')
@section('title')
<title>Types | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Category / Types</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.type');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Type List
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
                    Edit Type
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    
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

                    <div class="col-md-12">
                        <div class="col-md-10" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.updatetype') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Type <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="type" id="type" class="form-control" placeholder="Enter Category" value="{{ $getType->name }}">
                                                    <span class="text-danger" id="subcategoryError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Category <sup class="text-danger">*</sup></label>
                                                    <select name="category" id="category" class="form-control js-example-basic-single">
                                                        <option value="">--- Select Categories ---</option>
                                                        @if ($getCategories)
                                                            @foreach ($getCategories as $key => $row)
                                                                @if($row->id == $getType->category_id)
                                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                                                @else
                                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                                @endif    
                                                            @endforeach
                                                        @else
                                                           <option value="" class="text-danger"> No Categories Available</option> 
                                                        @endif
                                                    </select>
                                                    <span class="text-danger" id="categoryError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Sub Category <sup class="text-danger">*</sup></label>
                                                    <select name="subcategory" id="subcategory" class="form-control js-example-basic-single">
                                                        <option value="">--- Select Sub Categories ---</option>
                                                        @if ($getSubCategories)
                                                            @foreach ($getSubCategories as $key => $row)
                                                                @if($row->id == $getType->subcategory_id)
                                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                                                @else
                                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                                @endif    
                                                            @endforeach
                                                        @else
                                                           <option value="" class="text-danger"> No Sub Categories Available</option> 
                                                        @endif
                                                    </select>
                                                    <span class="text-danger" id="categoryError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status <sup class="text-danger">*</sup></label>
                                                    <select name="status" id="status" class="form-control js-example-basic-single">
                                                        <option value="">--- Select Status ---</option>
                                                        <option value="1" <?php if($getType->status == 1){ echo 'selected';}?>>Active</option>
                                                        <option value="0" <?php if($getType->status == 0){ echo 'selected';}?>>Inactive</option>
                                                       
                                                    </select>
                                                    <span class="text-danger" id="statusError"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="hidden" name="tid" id="tid" value="{{ $getType->id }}">
                                                <button type="submit" id="addSubCategory" class="btn btn-primary btn-sm" style="width:20%">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>    
                                </div>
                            </div>
                        </div>
                    </div>  
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
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
    $('#addType').on('click', function(){
        let type = $('#type').val();
        let category = $('#category').val();
        let subcategory = $('#subcategory').val();
        
        if(type=='')
        {
            $('#typeError').html('Required Type').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(category=='')
        {
            $('#categoryError').html('Required Category').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(subcategory=='')
        {
            $('#subcategoryError').html('Required Sub Category').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else{
            return true;
        }
    });
});

$(document).on('change', '#category', function() {
    let category = $(this).val();
    let subcategory = '';

    if (category === '') {
        $('#categoryError').html('Missing Category Data').delay(3000).fadeOut().css('display', 'block');
        return false;
    }

    $.ajax({
        url: '{{ route("admin.getsubcategory") }}',
        type: 'POST',
        data: {
            category: category,
            _token: '{{ csrf_token() }}'
        },
        success: function(resp) 
        {
            subcategory = '<option value="">Select Sub category</option>';

            console.log(resp);
            
            if (resp.status === 0) 
            {
                subcategory += '<option value="" class="text-danger">No Sub category found against this category</option>';
            } 
            else 
            {
                $.each(resp.data, function(key, value) 
                {
                    subcategory += '<option value="' + value.id + '">' + value.name + '</option>';
                });
            }
            $('#subcategory').html(subcategory);

            if ($('#subcategory').data('select2')) {
                $('#subcategory').select2().val(null).trigger('change');
            } 
            else {
                $('#subcategory').val(null);
            }
        }
    });
});


</script>
@stop
@extends('layouts.admin.template')
@section('title')
<title>Sub Categories | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Category / Sub Category</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.subcategory');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Sub Categories List
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
                    Edit Sub Category
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
                        <div class="col-md-8" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.updatesubcategory') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Sub Category Name <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="subcategory" id="subcategory" class="form-control" placeholder="Enter Category" value="{{ $getSubcategory->name }}">
                                                    <span class="text-danger" id="subcategoryError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category <sup class="text-danger">*</sup></label>
                                                    <select name="category" id="category" class="form-control" data-trigger>
                                                        <option value="">--- Select Categories ---</option>
                                                        @if ($getCategories)
                                                            @foreach ($getCategories as $key => $row)
                                                                @if($row->id == $getSubcategory->category_id)
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

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Status <sup class="text-danger">*</sup></label>
                                                    <select name="status" id="status" class="form-control" data-trigger>
                                                        <option value="">--- Select Status ---</option>
                                                        <option value="1" <?php if($getSubcategory->status == 1){ echo 'selected';}?>>Active</option>
                                                        <option value="0" <?php if($getSubcategory->status == 0){ echo 'selected';}?>>Inactive</option>
                                                       
                                                    </select>
                                                    <span class="text-danger" id="statusError"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="hidden" name="scid" id="scid" value="{{ $getSubcategory->id }}">
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
    $('#addSubCategory').on('click', function(){
        let category = $('#category').val();
        let subcategory = $('#subcategory').val();
        
        if(subcategory=='')
        {
            $('#subcategoryError').html('Required Sub Category').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(category=='')
        {
            $('#categoryError').html('Required Category').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else{
            return true;
        }
    });
});


</script>
@stop
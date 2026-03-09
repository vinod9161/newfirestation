@extends('layouts.admin.template')
@section('title')
<title>Edit Medal Category | Admin Dashboard</title>
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Edit Medal Category</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.achivements.medal_category') }}" class="btn ripple btn-wave btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View All List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Edit Medal Category</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.achivements.medal_category.update', $medal_category[0]->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <!-- Name -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Category Name <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="category_name" id="category_name" value="{{ old('category_name', $medal_category[0]->category_name) }}" class="form-control">
                                                    <span class="text-danger" id="categoryError"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Image <sup class="text-danger">*</sup></label>
                                                    <input type="file" name="image" id="image" class="form-control">
                                                    <span class="text-danger" id="imageError"></span>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-md-12">
                                                <button type="submit" id="update_category" class="btn btn-primary btn-sm" style="width:20%">Update</button>
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
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#update_category').on('click', function(e) 
    {
        let category_name = $('#category_name').val();
        let image = $('#image').val();
        if(category_name == '')
        {
            $('#categoryError').html("Category Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else if(image == '')
        {
            $('#imageError').html("Image Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else
        {
            return true;
        }
    });
        
});
</script>
@endsection

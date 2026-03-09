@extends('layouts.admin.template')
@section('title')
<title>Activites | Gallery | Admin Dashboard</title>
@endsection

@section('style')
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Uplode Photo
        </h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.services.pumping_work') }}" class="btn ripple btn-wave btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View All List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Uplode Gallery Photo

                </div>
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
                        <div class="col-md-8" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.activities.galary.update', $gallery->id) }}" 
                                        method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row">
                                            <!-- Category -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Select Category <sup class="text-danger">*</sup></label>
                                                    <select name="category_id" class="form-control">
                                                        <option value="">Select Category</option>
                                                        <option value="Firefighting_Model" {{ $gallery->category == 'Firefighting_Model' ? 'selected' : '' }}>Firefighting Model</option>
                                                        <option value="Rescue_Operations" {{ $gallery->category == 'Rescue_Operations' ? 'selected' : '' }}>Rescue Operations</option>
                                                        <option value="Firefighting_Mock_Drill" {{ $gallery->category == 'Firefighting_Mock_Drill' ? 'selected' : '' }}>Firefighting Mock Drill</option>
                                                        <option value="Indoor_Event" {{ $gallery->category == 'Indoor_Event' ? 'selected' : '' }}>Indoor Event</option>
                                                        <option value="Outdoor_Event" {{ $gallery->category == 'Outdoor_Event' ? 'selected' : '' }}>Outdoor Event</option>
                                                        <option value="Official_Event" {{ $gallery->category == 'Official_Event' ? 'selected' : '' }}>Official Event</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Image -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Change Image (Optional)</label>
                                                    <input type="file" name="image" class="form-control">

                                                    <br>
                                                    <img src="{{ asset('admin/activities/galary/'.$gallery->image) }}" 
                                                        width="120">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-primary btn-sm"
                                                    style="width:20%">Update</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#addcard').on('click', function (e) {
            let category = $('select[name="category_id"]').val();
            let image = $('#card_image').val();
            let hasError = false;

            if (!category) {
                $('#card_categoryError').html('Category is required').show().delay(3000).fadeOut();
                hasError = true;
            }

            if (!image) {
                $('#card_imageError').html('Image is required').show().delay(3000).fadeOut();
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
            }
        });
    });
</script>

@endsection

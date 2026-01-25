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
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Fire Service Week Add
        </h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.Activities.fire_service_week') }}" class="btn ripple btn-wave btn-success mb-0">
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
                Fire Service Week Add

                </div>
            </div>
            <div class="card-body">
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
                    <form action="{{ route('admin.Activities.fire_service_week.save') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title <sup class="text-danger">*</sup></label>
                                    <input type="title" name="title" id="title"
                                    class="form-control">
                                    <input type="hidden" name="month" id="month" value="<?php echo date('M'); ?>"
                                    class="form-control">
                                    <input type="hidden" name="year" id="year"   value="<?php echo date('Y'); ?>"
                                    class="form-control">
                                    <span class="text-danger" id="titleError"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Sub Title <sup class="text-danger">*</sup></label>
                                    <input type="title" name="subtitle" id="subtitle" class="form-control">
                                    <span class="text-danger" id="subtitleError"></span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date <sup class="text-danger">*</sup></label>
                                    <input type="date" name="date" id="date"
                                        class="form-control">
                                    <span class="text-danger" id="dateError"></span>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" id="addcard" class="btn btn-primary btn-sm"
                                    style="width:20%">Submit</button>
                            </div>
                        </div>
                    </form>
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
        // alert('hrrr');

            let title = $('#title').val();
            let subtitle = $('#subtitle').val();
            let date = $('#date').val();
            let hasError = false;

            if (!title) {
                $('#titleError').html('Title is required').show().delay(3000).fadeOut();
                hasError = true;
            }

            if (!subtitle) {
                $('#subtitleError').html('Sub Title is required').show().delay(3000).fadeOut();
                hasError = true;
            }

            if (!date) {
                $('#dateError').html('Date is required').show().delay(3000).fadeOut();
                hasError = true;
            }

            if (hasError) {
                e.preventDefault();
            }
        });
    });
</script>

@endsection

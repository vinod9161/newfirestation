@extends('layouts.admin.template')
@section('title')
<title>NOC Checklist | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">NOC Checklist</h5>
    </div>
    <div class="d-flex app-header-btn">
 
        <div>
            <a href="<?php echo route('admin.getchecklist'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Noc Checklist
            </a>
        </div>
    </div>
</div>
 
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add Noc Checklist
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
                                    <form action="{{ route('admin.checklist.save') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Checklist Name <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="service_name" id="service_name" class="form-control" placeholder="Enter Service Name">
                                                    <span class="text-danger" id="serviceNameErrorr"></span>
                                                </div>
                                            </div>
 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Upload <sup class="text-danger">*</sup></label>
                                                    <input type="file" name="image" id="card_image" class="form-control">
                                                    <span class="text-danger" id="card_imageError"></span>
                                                </div>
                                            </div>
 
                                            <div class="col-md-12">
                                                <button type="submit" id="addcard" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
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
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Quill editor
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Write your content here...',
            modules: {
                toolbar: [
                    [{ header: [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ list: 'ordered' }, { list: 'bullet' }],
                    ['link', 'image'],
                    ['clean']
                ]
            }
        });
 
        // Synchronize Quill content with the hidden input field
        var cardContentField = document.getElementById('card_content');
        quill.on('text-change', function () {
            cardContentField.value = quill.root.innerHTML;
        });
 
        // Form validation
        $('#addcard').on('click', function (e) {
            let cardImage = $('#card_image').val();
            let service_name = $('#service_name').val();
            // let cardContent = cardContentField.value;
 
            if (!cardImage) {
                $('#card_imageError').html('Noc Checklist File is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }
 
 
            if (!service_name) {
                $('#serviceNameErrorr').html('Noc Checklist Name is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }
        });
    });
</script>
@endsection
 
 
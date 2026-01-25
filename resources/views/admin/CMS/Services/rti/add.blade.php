@extends('layouts.admin.template')
@section('title')
<title>Service RTI | Admin Dashboard</title>
@endsection

@section('style')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Add Service RTI</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.Service.RTI') }}" class="btn ripple btn-wave btn-success mb-0">
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
                    Add Service RTI
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
                                    <form action="{{ route('admin.Service.RTI.save') }}" method="post"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Category <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="category" id="category"
                                                        class="form-control">
                                                    <span class="text-danger" id="card_heddingError"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Officer Name<sup class="text-danger">*</sup></label>
                                                    <input type="text" name="officer_name" id="officer_name"
                                                        class="form-control">
                                                    <span class="text-danger" id="card_imagepositionError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Phone <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="phone" id="phone" class="form-control">
                                                    <span class="text-danger" id="card_imageError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Address <sup class="text-danger">*</sup></label>
                                                    <div id="editor-container" style="height: 300px;"></div>
                                                    <input type="hidden" name="address" id="address">
                                                    <span class="text-danger" id="card_contentError"></span>
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
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Quill editor
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        placeholder: 'Write your content here...',
        modules: {
            toolbar: [
                [{
                    header: [1, 2, 3, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    list: 'ordered'
                }, {
                    list: 'bullet'
                }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    // Synchronize Quill content with the hidden input field
    var cardContentField = document.getElementById('address');
    quill.on('text-change', function() {
        cardContentField.value = quill.root.innerHTML;
    });

    // Form validation
    $('#addcard').on('click', function(e) {
        let category = $('#category').val();
        let officer_name = $('#officer_name').val();
        let phone = $('#phone').val();
        let cardContent = cardContentField.value;


        if (!category) {
            $('#card_heddingError').html('Category is required').show().delay(3000).fadeOut();
            e.preventDefault();
        }

        if (!officer_name) {
            $('#card_imagepositionError').html('Officer Name  is required').show().delay(3000)
                .fadeOut();
            e.preventDefault();
        }
        if (!phone) {
            $('#card_imageError').html('Phone is required').show().delay(3000).fadeOut();
            e.preventDefault();
        }
        if (!cardContent) {
            $('#card_contentError').html('Address is required').show().delay(3000).fadeOut();
            e.preventDefault();
        }
    });
});
</script>
@endsection

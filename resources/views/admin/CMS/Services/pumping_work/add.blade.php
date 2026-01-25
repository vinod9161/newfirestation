@extends('layouts.admin.template')
@section('title')
<title>Mission & Vision Card | Admin Dashboard</title>
@endsection

@section('style')
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Add Pumping Work
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
                    Add Pumping Work

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
                                    <form action="{{ route('admin.services.pumping_work.save') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Hadding <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="hadding" id="hadding" class="form-control">
                                                    <span class="text-danger" id="card_heddingError"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Image Position <sup class="text-danger">*</sup></label>
                                                    <select name="imageposition" id="imageposition" class="form-control">
                                                        <option value="">Select Position</option>
                                                        <option value="right">Right</option>
                                                        <option value="left">Left</option>
                                                    </select>
                                                    <span class="text-danger" id="card_imagepositionError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Upload <sup class="text-danger">*</sup></label>
                                                    <input type="file" name="image" id="card_image" class="form-control">
                                                    <span class="text-danger" id="card_imageError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Content <sup class="text-danger">*</sup></label>
                                                    <div id="editor-container" style="height: 300px;"></div>
                                                    <input type="hidden" name="description" id="card_content">
                                                    <span class="text-danger" id="card_contentError"></span>
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
            let hadding = $('#hadding').val();
            let imageposition = $('#imageposition').val();
            let cardImage = $('#card_image').val();
            let cardContent = cardContentField.value;


            if (!hadding) {
                $('#card_heddingError').html('Hedding is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }

            if (!imageposition) {
                $('#card_imagepositionError').html('Image Position is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }
            if (!cardImage) {
                $('#card_imageError').html('Card Image is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }
            if (!cardContent) {
                $('#card_contentError').html('Card Content is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }
        });
    });
</script>
@endsection

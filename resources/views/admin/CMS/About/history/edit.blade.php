@extends('layouts.admin.template')
@section('title')
<title>Edit History | Admin Dashboard</title>
@endsection

@section('style')
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Edit History</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.about.history') }}" class="btn ripple btn-wave btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View History List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Edit History
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
                                    <form action="{{ route('admin.about.history.update') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Heading Title <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="heading" id="heading" class="form-control" value="{{ $history[0]->hadding??'' }}">
                                                    <span class="text-danger" id="card_headingError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Image Upload <sup class="text-danger">*</sup></label>
                                                    <input type="file" name="image" id="card_image" class="form-control">
                                                    <span class="text-danger" id="card_imageError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Status <sup class="text-danger">*</sup></label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="Active" <?php if($history[0]->status == 'Active'){echo 'selected';}?>>Active</option>
                                                        <option value="Inactive" <?php if($history[0]->status == 'Inctive'){echo 'selected';}?>>Inactive</option>
                                                    </select>
                                                    <span class="text-danger" id="card_statusError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Content <sup class="text-danger">*</sup></label>
                                                    <div id="editor-container" style="height: 300px;"></div>
                                                    <input type="hidden" name="description" id="card_content" value="{{ $history[0]->content }}">
                                                    <span class="text-danger" id="card_contentError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <input type="hidden" name="hiddenimg" id="hiddenimg" value="{{ $history[0]->image }}">
                                                <input type="hidden" name="hid" id="hid" value="{{ $history[0]->id }}">
                                                <button type="submit" id="addcard" class="btn btn-primary btn-sm" style="width:20%">Update</button>
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
            let headingTitle = $('#heading').val();

            if (!headingTitle) {
                $('#card_headingError').html('History Heading Title is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }
            if (!cardContent) {
                $('#card_contentError').html('Content is required').show().delay(3000).fadeOut();
                e.preventDefault();
            }
        });
    });
</script>
@endsection

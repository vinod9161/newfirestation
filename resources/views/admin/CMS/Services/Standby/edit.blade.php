@extends('layouts.admin.template')

@section('title')
<title>Edit Standby Content</title>
@endsection

@section('style')

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>

        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Add Standby Content
        </h5>

    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.services.standby') }}" class="btn ripple btn-wave btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Standby Content
            </a>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-body">

                <div class="col-md-8" style="margin:0 auto;">

                    <form
                        action="{{ route('admin.services.standby.update',$standby->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="mb-3">

                            <label>Title</label>

                            <input
                                type="text"
                                name="hadding"
                                class="form-control"
                                value="{{ $standby->hadding }}"
                            >

                        </div>

                        <div class="mb-3">

                            <label>Image</label>

                            <input
                                type="file"
                                name="image"
                                class="form-control"
                            >

                            <img
                                src="{{ asset('public/admin/services/standby/'.$standby->image) }}"
                                width="120"
                                class="mt-2"
                            >

                        </div>

                        <div class="mb-3">

                            <label>Description</label>

                            <div
                                id="editor-container"
                                style="height:300px;"
                            >
                                {!! $standby->content !!}
                            </div>

                            <input
                                type="hidden"
                                name="description"
                                id="description"
                                value="{{ $standby->content }}"
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary"
                        >
                            Update
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

@section('scripts')

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<script>

var quill = new Quill('#editor-container', {

    theme: 'snow'

});

quill.root.innerHTML = `{!! addslashes($standby->content) !!}`;

quill.on('text-change', function () {

    document.getElementById('description').value =
        quill.root.innerHTML;

});

</script>

@endsection
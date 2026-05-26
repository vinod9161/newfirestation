@extends('layouts.admin.template')

@section('title')
<title>Edit Objective Content</title>
@endsection

@section('style')
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Edit Objective Content
        </h5>
    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-body">

                <div class="col-md-8" style="margin:0 auto;">

                    <form
                        action="{{ route('admin.about.our_objective.update', $objective->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Hadding</label>

                                    <input
                                        type="text"
                                        name="hadding"
                                        class="form-control"
                                        value="{{ $objective->hadding }}"
                                    >

                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Short Content</label>

                                    <input
                                        type="text"
                                        name="short_content"
                                        class="form-control"
                                        value="{{ $objective->short_content }}"
                                    >
                                </div>
                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Section Type</label>

                                    <select
                                        name="imageposition"
                                        class="form-control"
                                    >

                                        <option value="top"
                                            {{ $objective->image_position == 'top' ? 'selected' : '' }}>
                                            Top Section
                                        </option>

                                        <option value="card"
                                            {{ $objective->image_position == 'card' ? 'selected' : '' }}>
                                            Objective Card
                                        </option>

                                        <option value="bottom"
                                            {{ $objective->image_position == 'bottom' ? 'selected' : '' }}>
                                            Bottom Section
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label>Upload</label>

                                    <input
                                        type="file"
                                        name="image"
                                        class="form-control"
                                    >

                                </div>

                            </div>

                            <div class="col-md-12 mb-3">

                                <img
                                    src="{{ asset('public/admin/about/our_objective/'.$objective->image) }}"
                                    width="120"
                                >

                            </div>

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label>Content</label>

                                    <div id="editor-container" style="height:300px;">
                                        {!! $objective->content !!}
                                    </div>

                                    <input
                                        type="hidden"
                                        name="description"
                                        id="card_content"
                                        value="{{ $objective->content }}"
                                    >

                                </div>

                            </div>

                            <div class="col-md-12 mt-4">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Update
                                </button>

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

<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>

<script>

var quill = new Quill('#editor-container', {
    theme: 'snow'
});

quill.on('text-change', function () {
    document.getElementById('card_content').value =
        quill.root.innerHTML;
});

</script>

@endsection
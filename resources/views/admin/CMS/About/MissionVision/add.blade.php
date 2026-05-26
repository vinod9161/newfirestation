@extends('layouts.admin.template')

@section('title')
<title>Mission & Vision CMS</title>
@endsection

@section('style')

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>

        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Add Mission & Vision Content
        </h5>

    </div>

    <div class="d-flex app-header-btn">

        <div>

            <a
                href="{{ route('admin.about.missionvision') }}"
                class="btn ripple btn-wave btn-success mb-0"
            >
                <i class="fe fe-eye me-1"></i>
                View List
            </a>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">

                <div class="card-title">
                    Add Mission & Vision Content
                </div>

            </div>

            <div class="card-body">

                <div class="col-md-10" style="margin:0 auto;">

                    <form
                        action="{{ route('admin.about.missionvision.save') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Section Type
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <select
                                        name="section_type"
                                        class="form-control"
                                    >

                                        <option value="">
                                            Select Type
                                        </option>

                                        <option value="mission">
                                            Mission Card
                                        </option>

                                        <option value="vision">
                                            Vision Section
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Title
                                    </label>

                                    <input
                                        type="text"
                                        name="hadding"
                                        class="form-control"
                                    >

                                </div>

                            </div>

                            <div class="col-md-6 mt-3">

                                <div class="form-group">

                                    <label>
                                        Upload Image
                                    </label>

                                    <input
                                        type="file"
                                        name="image"
                                        class="form-control"
                                    >

                                </div>

                            </div>

                            <div class="col-md-6 mt-3">

                                <div class="form-group">

                                    <label>
                                        Status
                                    </label>

                                    <select
                                        name="status"
                                        class="form-control"
                                    >

                                        <option value="Active">
                                            Active
                                        </option>

                                        <option value="Inactive">
                                            Inactive
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-12 mt-3">

                                <div class="form-group">

                                    <label>
                                        Description
                                        <sup class="text-danger">*</sup>
                                    </label>

                                    <div
                                        id="editor-container"
                                        style="height:300px;"
                                    ></div>

                                    <input
                                        type="hidden"
                                        name="description"
                                        id="card_content"
                                    >

                                </div>

                            </div>

                            <div class="col-md-12 mt-5">

                                <button
                                    type="submit"
                                    class="btn btn-primary"
                                >
                                    Submit
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

    theme: 'snow',

    placeholder: 'Write your content here...',

    modules: {

        toolbar: [

            [{ header: [1, 2, 3, false] }],

            ['bold', 'italic', 'underline'],

            [{ list: 'ordered' }, { list: 'bullet' }],

            ['link', 'image'],

            ['clean']

        ]

    }

});

quill.on('text-change', function () {

    document.getElementById('card_content').value =
        quill.root.innerHTML;

});

</script>

@endsection
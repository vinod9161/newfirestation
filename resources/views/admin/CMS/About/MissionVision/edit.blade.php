@extends('layouts.admin.template')

@section('title')
<title>Edit Mission & Vision</title>
@endsection

@section('style')

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>

        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Edit Mission & Vision
        </h5>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">

                <div class="card-title">
                    Edit Mission & Vision Content
                </div>

            </div>

            <div class="card-body">

                <div class="col-md-10" style="margin:0 auto;">

                    <form
                        action="{{ route('admin.about.missionvision.update',$missionvision->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Section Type
                                    </label>

                                    <select
                                        name="section_type"
                                        class="form-control"
                                    >

                                        <option value="">
                                            Select Type
                                        </option>

                                        <option
                                            value="mission"
                                            {{ $missionvision->image_position == 'mission' ? 'selected' : '' }}
                                        >
                                            Mission Card
                                        </option>

                                        <option
                                            value="vision"
                                            {{ $missionvision->image_position == 'vision' ? 'selected' : '' }}
                                        >
                                            Vision Section
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>
                                        Optional Title
                                    </label>

                                    <input
                                        type="text"
                                        name="hadding"
                                        class="form-control"
                                        value="{{ $missionvision->hadding }}"
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

                                    <img
                                        src="{{ asset('public/admin/about/mission_vision/'.$missionvision->image) }}"
                                        width="120"
                                        class="mt-2"
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

                                        <option
                                            value="Active"
                                            {{ $missionvision->status == 'Active' ? 'selected' : '' }}
                                        >
                                            Active
                                        </option>

                                        <option
                                            value="Inactive"
                                            {{ $missionvision->status == 'Inactive' ? 'selected' : '' }}
                                        >
                                            Inactive
                                        </option>

                                    </select>

                                </div>

                            </div>

                            <div class="col-md-12 mt-3">

                                <div class="form-group">

                                    <label>
                                        Description
                                    </label>

                                    <div
                                        id="editor-container"
                                        style="height:300px;"
                                    >
                                        {!! $missionvision->content !!}
                                    </div>

                                    <input
                                        type="hidden"
                                        name="description"
                                        id="card_content"
                                        value="{{ $missionvision->content }}"
                                    >

                                </div>

                            </div>

                            <div class="col-md-12 mt-5">

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

quill.root.innerHTML =
    `{!! addslashes($missionvision->content) !!}`;

quill.on('text-change', function () {

    document.getElementById('card_content').value =
        quill.root.innerHTML;

});

</script>

@endsection
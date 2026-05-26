@extends('layouts.admin.template')

@section('title')
<title>Edit Awarness Mock Drill | Admin Dashboard</title>
@endsection

@section('style')

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>

        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Edit Awarness Mock Drill
        </h5>

    </div>

    <div class="d-flex app-header-btn">

        <div>

            <a
                href="{{ route('admin.services.awarness_mock_drill') }}"
                class="btn ripple btn-wave btn-success mb-0"
            >
                <i class="fe fe-eye me-1"></i>
                View All List
            </a>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">

                <div class="card-title">
                    Edit Awarness Mock Drill
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

                                    <form
                                        action="{{ route('admin.services.awarness_mock_drill.update',$awarness_mock_drill->id) }}"
                                        method="post"
                                        enctype="multipart/form-data"
                                    >

                                        @csrf

                                        <div class="row">

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>
                                                        Hadding
                                                        <sup class="text-danger">*</sup>
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="hadding"
                                                        id="hadding"
                                                        class="form-control"
                                                        value="{{ $awarness_mock_drill->hadding }}"
                                                    >

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>
                                                        Image Position
                                                        <sup class="text-danger">*</sup>
                                                    </label>

                                                    <select
                                                        name="imageposition"
                                                        class="form-control"
                                                    >

                                                        <option value="">
                                                            Select Position
                                                        </option>

                                                        <option
                                                            value="right"
                                                            {{ $awarness_mock_drill->image_position == 'right' ? 'selected' : '' }}
                                                        >
                                                            Right
                                                        </option>

                                                        <option
                                                            value="left"
                                                            {{ $awarness_mock_drill->image_position == 'left' ? 'selected' : '' }}
                                                        >
                                                            Left
                                                        </option>

                                                    </select>

                                                </div>

                                            </div>

                                            <div class="col-md-4">

                                                <div class="form-group">

                                                    <label>
                                                        Upload
                                                    </label>

                                                    <input
                                                        type="file"
                                                        name="image"
                                                        class="form-control"
                                                    >

                                                    <img
                                                        src="{{ asset('public/admin/services/awarness_mock_drill/'.$awarness_mock_drill->image) }}"
                                                        width="100"
                                                        class="mt-2"
                                                    >

                                                </div>

                                            </div>

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label>
                                                        Content
                                                        <sup class="text-danger">*</sup>
                                                    </label>

                                                    <div
                                                        id="editor-container"
                                                        style="height:300px;"
                                                    >
                                                        {!! $awarness_mock_drill->content !!}
                                                    </div>

                                                    <input
                                                        type="hidden"
                                                        name="description"
                                                        id="card_content"
                                                        value="{{ $awarness_mock_drill->content }}"
                                                    >

                                                </div>

                                            </div>

                                            <div class="col-md-12 mt-4">

                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-sm"
                                                    style="width:20%"
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

            ['bold', 'italic', 'underline', 'strike'],

            [{ list: 'ordered' }, { list: 'bullet' }],

            ['link', 'image'],

            ['clean']

        ]

    }

});

quill.root.innerHTML =
    `{!! addslashes($awarness_mock_drill->content) !!}`;

quill.on('text-change', function () {

    document.getElementById('card_content').value =
        quill.root.innerHTML;

});

</script>

@endsection
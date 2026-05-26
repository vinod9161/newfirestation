@extends('layouts.admin.template')

@section('title')
<title>Add Fire Service Day</title>
@endsection

@section('style')

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Add Fire Service Day
        </h5>
    </div>

    <div class="d-flex app-header-btn">

        <a
            href="{{ route('admin.about.Fire_Service_Day') }}"
            class="btn ripple btn-wave btn-success mb-0"
        >
            <i class="fe fe-eye me-1"></i>
            View List
        </a>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">

                <div class="card-title">
                    Add Fire Service Day
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

                <div class="col-md-8" style="margin:0 auto;">

                    <form
                        action="{{ route('admin.about.Fire_Service_Day.save') }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="row">

                            <div class="col-md-12 mb-3">

                                <label>
                                    Heading
                                    <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="text"
                                    name="hadding"
                                    class="form-control"
                                    value="{{ old('hadding') }}"
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    First Image
                                    <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Second Image
                                    <sup class="text-danger">*</sup>
                                </label>

                                <input
                                    type="file"
                                    name="image1"
                                    class="form-control"
                                >

                            </div>

                            <div class="col-md-12 mb-3">

                                <label>
                                    Content
                                    <sup class="text-danger">*</sup>
                                </label>

                                <div
                                    id="editor-container"
                                    style="height:300px;"
                                ></div>

                                <input
                                    type="hidden"
                                    name="description"
                                    id="description"
                                >

                            </div>

                            <div class="col-md-12 mt-4">

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
    theme: 'snow'
});

quill.on('text-change', function () {

    document.getElementById('description').value =
        quill.root.innerHTML;

});

</script>

@endsection
@extends('layouts.admin.template')

@section('title')
<title>Edit Flag Day</title>
@endsection

@section('style')

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Edit Flag Day
        </h5>
    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-body">

                <div class="col-md-8" style="margin:0 auto;">

                    <form
                        action="{{ route('admin.about.flag_day.update',$flag_day->id) }}"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        @csrf

                        <div class="row">

                            <div class="col-md-12 mb-3">

                                <label>
                                    Heading
                                </label>

                                <input
                                    type="text"
                                    name="hadding"
                                    class="form-control"
                                    value="{{ $flag_day->hadding }}"
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Image 1
                                </label>

                                <input
                                    type="file"
                                    name="image"
                                    class="form-control"
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <label>
                                    Image 2
                                </label>

                                <input
                                    type="file"
                                    name="image1"
                                    class="form-control"
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <img
                                    src="{{ asset('public/admin/about/flag_day/'.$flag_day->image) }}"
                                    width="100%"
                                    style="height:200px;object-fit:cover;"
                                >

                            </div>

                            <div class="col-md-6 mb-3">

                                <img
                                    src="{{ asset('public/admin/about/flag_day/'.$flag_day->image1) }}"
                                    width="100%"
                                    style="height:200px;object-fit:cover;"
                                >

                            </div>

                            <div class="col-md-12 mb-3">

                                <label>
                                    Content
                                </label>

                                <div
                                    id="editor-container"
                                    style="height:300px;"
                                >
                                    {!! $flag_day->content !!}
                                </div>

                                <input
                                    type="hidden"
                                    name="description"
                                    id="description"
                                    value="{{ $flag_day->content }}"
                                >

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
    theme: 'snow'
});

quill.on('text-change', function () {

    document.getElementById('description').value =
        quill.root.innerHTML;

});

</script>

@endsection
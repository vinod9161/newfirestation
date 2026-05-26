@extends('layouts.admin.template')

@section('title')
<title>Edit Fire Operation | Admin Dashboard</title>
@endsection

@section('style')

<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">

@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>

        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Edit Fire Operation
        </h5>

    </div>

    <div class="d-flex app-header-btn">

        <div>

            <a
                href="{{ route('admin.services.fire-operation') }}"
                class="btn ripple btn-wave btn-success mb-0"
            >
                <i class="fe fe-eye me-1"></i>
                View Operation List
            </a>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">

                <div class="card-title">
                    Edit Fire Operation
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
                                        action="{{ route('admin.services.fire-operation.update',$operation->id) }}"
                                        method="POST"
                                    >

                                        @csrf

                                        <div class="row">

                                            <div class="col-md-12">

                                                <div class="form-group">

                                                    <label>
                                                        Title
                                                        <sup class="text-danger">*</sup>
                                                    </label>

                                                    <input
                                                        type="text"
                                                        name="hadding"
                                                        id="hadding"
                                                        class="form-control"
                                                        value="{{ $operation->hadding }}"
                                                    >

                                                    <span
                                                        class="text-danger"
                                                        id="titleError"
                                                    ></span>

                                                </div>

                                            </div>

                                            <div class="col-md-12 mt-3">

                                                <div class="form-group">

                                                    <label>
                                                        Operation Type
                                                        <sup class="text-danger">*</sup>
                                                    </label>

                                                    <select
                                                        name="operation_type"
                                                        id="operation_type"
                                                        class="form-control"
                                                    >

                                                        <option value="">
                                                            Select Type
                                                        </option>

                                                        <option
                                                            value="Top Section"
                                                            {{ $operation->image_position == 'Top Section' ? 'selected' : '' }}
                                                        >
                                                            Top Section
                                                        </option>

                                                        <option
                                                            value="Fire Fighting"
                                                            {{ $operation->image_position == 'Fire Fighting' ? 'selected' : '' }}
                                                        >
                                                            Fire Fighting
                                                        </option>

                                                        <option
                                                            value="Rescue"
                                                            {{ $operation->image_position == 'Rescue' ? 'selected' : '' }}
                                                        >
                                                            Rescue
                                                        </option>

                                                    </select>

                                                    <span
                                                        class="text-danger"
                                                        id="typeError"
                                                    ></span>

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
                                                    >
                                                        {!! $operation->content !!}
                                                    </div>

                                                    <input
                                                        type="hidden"
                                                        name="description"
                                                        id="card_content"
                                                        value="{{ $operation->content }}"
                                                    >

                                                    <span
                                                        class="text-danger"
                                                        id="contentError"
                                                    ></span>

                                                </div>

                                            </div>

                                            <div class="col-md-12 mt-4">

                                                <button
                                                    type="submit"
                                                    id="updatecard"
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

document.addEventListener('DOMContentLoaded', function () {

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

    quill.root.innerHTML = `{!! addslashes($operation->content) !!}`;

    var cardContentField = document.getElementById('card_content');

    quill.on('text-change', function () {

        cardContentField.value = quill.root.innerHTML;

    });

    $('#updatecard').on('click', function (e) {

        let hadding = $('#hadding').val();

        let type = $('#operation_type').val();

        let content = cardContentField.value;

        if (!hadding) {

            $('#titleError')
                .html('Title is required')
                .show()
                .delay(3000)
                .fadeOut();

            e.preventDefault();
        }

        if (!type) {

            $('#typeError')
                .html('Operation Type is required')
                .show()
                .delay(3000)
                .fadeOut();

            e.preventDefault();
        }

        if (!content || content == '<p><br></p>') {

            $('#contentError')
                .html('Description is required')
                .show()
                .delay(3000)
                .fadeOut();

            e.preventDefault();
        }

    });

});

</script>

@endsection
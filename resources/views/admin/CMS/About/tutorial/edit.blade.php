@extends('layouts.admin.template')

@section('title')
<title>Edit Tutorial | Admin Dashboard</title>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">
            Edit Tutorial
        </h5>
    </div>

    <div class="d-flex app-header-btn">

        <div>

            <a
                href="{{ route('admin.about.tutorial') }}"
                class="btn ripple btn-wave btn-success mb-0"
            >
                <i class="fe fe-eye me-1"></i>
                View Tutorial List
            </a>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">

                <div class="card-title">
                    Edit Tutorial
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

                <div class="col-md-12">

                    <div class="col-md-8" style="margin:0 auto;">

                        <div class="card">

                            <div class="card-body">

                                <form
                                    action="{{ route('admin.about.tutorial.update',$tutorial->id) }}"
                                    method="POST"
                                >

                                    @csrf

                                    <div class="row">

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label>
                                                    Heading Title
                                                    <sup class="text-danger">*</sup>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="hadding"
                                                    id="hadding"
                                                    class="form-control"
                                                    value="{{ $tutorial->hadding }}"
                                                >

                                                <span
                                                    class="text-danger"
                                                    id="haddingError"
                                                ></span>

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <div class="form-group">

                                                <label>
                                                    YouTube URL
                                                    <sup class="text-danger">*</sup>
                                                </label>

                                                <input
                                                    type="text"
                                                    name="youtube_url"
                                                    id="youtube_url"
                                                    class="form-control"
                                                    value="{{ $tutorial->content }}"
                                                >

                                                <span
                                                    class="text-danger"
                                                    id="youtubeError"
                                                ></span>

                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <button
                                                type="submit"
                                                id="updatetutorial"
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

@endsection

@section('scripts')

<script>

$('#updatetutorial').on('click', function (e) {

    let hadding = $('#hadding').val();

    let youtubeUrl = $('#youtube_url').val();

    if (!hadding) {

        $('#haddingError')
            .html('Tutorial Heading is required')
            .show()
            .delay(3000)
            .fadeOut();

        e.preventDefault();
    }

    if (!youtubeUrl) {

        $('#youtubeError')
            .html('YouTube URL is required')
            .show()
            .delay(3000)
            .fadeOut();

        e.preventDefault();
    }

});

</script>

@endsection
@extends('layouts.admin.template')
@section('title')
<title>Edit Achievement | Admin Dashboard</title>
@endsection

@section('content')
<style>

.ck-editor__editable {
    min-height: 300px;
}

</style>
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mb-0">Edit Achievement</h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('admin.achievement') }}" class="btn ripple btn-wave btn-success">
            <i class="fe fe-eye me-1"></i> View All List
        </a>
    </div>
</div>


<div class="row">
    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">
                <div class="card-title">
                    Edit Achievement
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


                <form action="{{ route('admin.achievement.update') }}" method="POST">
                    @csrf

                    <input type="hidden" name="id" value="{{ $data->id }}">

                    <div class="row">

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Year <sup class="text-danger">*</sup></label>
                                <input type="text" name="year" class="form-control"
                                    value="{{ $data->year }}">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Overview</label>
                                <textarea name="overview" class="form-control" rows="4">{{ $data->overview }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Infrastructure Development</label>
                                <textarea name="infrastructure" class="form-control" rows="4">{{ $data->infrastructure }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Recruitment, Promotion & Training</label>
                                <textarea name="recruitment_training" class="form-control" rows="4">{{ $data->recruitment_training }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Fire & Rescue Operations</label>
                                <textarea name="fire_rescue" class="form-control" rows="4">{{ $data->fire_rescue }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Public Awareness & Capacity Building</label>
                                <textarea name="public_awareness" class="form-control" rows="4">{{ $data->public_awareness }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>VIP Duties & Safety Enforcement</label>
                                <textarea name="vip_duties" class="form-control" rows="4">{{ $data->vip_duties }}</textarea>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm" style="width:20%">
                                Update
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>

    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>

ClassicEditor.create(document.querySelector('#overview'));
ClassicEditor.create(document.querySelector('#infrastructure'));
ClassicEditor.create(document.querySelector('#recruitment_training'));
ClassicEditor.create(document.querySelector('#fire_rescue'));
ClassicEditor.create(document.querySelector('#public_awareness'));
ClassicEditor.create(document.querySelector('#vip_duties'));

</script>
@endsection
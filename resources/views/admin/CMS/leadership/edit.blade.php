@extends('layouts.admin.template')

@section('title')
<title>Edit Leadership Section | Admin</title>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <h5 class="main-content-title fs-24 mb-0">Edit Leadership Section</h5>
    <div class="d-flex app-header-btn">
        <a href="<?php echo route('admin.leadershipSectionList'); ?>" class="btn ripple btn-wave  btn-success mb-0">
            <i class="fe fe-eye me-1"></i> View Leadership List
        </a>
    </div>
</div>


<div class="row">
    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">
                <div class="card-title">
                    Edit Leadership Section
                </div>
            </div>


            <div class="card-body">

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif


                <form action="{{ route('admin.updateLeadershipSection') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <input type="hidden" name="id" value="{{ $leadership->id }}">


                    <div class="row">

                        {{-- CM SECTION --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CM Name *</label>
                                <input type="text" class="form-control" name="cm_name" value="{{ $leadership->cm_name }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CM Designation *</label>
                                <input type="text" class="form-control" name="cm_designation" value="{{ $leadership->cm_designation }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CM Image</label>
                                <input type="file" class="form-control" name="cm_image">

                                @if($leadership->cm_image)
                                <br>
                                <img src="{{ url('public/'.$leadership->cm_image) }}" width="80">
                                @endif

                            </div>
                        </div>



                        {{-- DGP SECTION --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DGP Name *</label>
                                <input type="text" class="form-control" name="dgp_name" value="{{ $leadership->dgp_name }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DGP Designation *</label>
                                <input type="text" class="form-control" name="dgp_designation" value="{{ $leadership->dgp_designation }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DGP Image</label>
                                <input type="file" class="form-control" name="dgp_image">

                                @if($leadership->dgp_image)
                                <br>
                                <img src="{{ url('public/'.$leadership->dgp_image) }}" width="80">
                                @endif

                            </div>
                        </div>



                        {{-- CENTER CONTENT --}}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Subject *</label>
                                <input type="text" class="form-control" name="subject" value="{{ $leadership->subject }}">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content *</label>
                                <textarea class="form-control" name="content" rows="6">{{ $leadership->content }}</textarea>
                            </div>
                        </div>



                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status *</label>
                                <select class="form-control" name="status">

                                    <option value="1" {{ $leadership->status == 1 ? 'selected' : '' }}>Active</option>

                                    <option value="0" {{ $leadership->status == 0 ? 'selected' : '' }}>Inactive</option>

                                </select>
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

@endsection
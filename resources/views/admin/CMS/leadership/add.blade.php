@extends('layouts.admin.template')

@section('title')
<title>Leadership Section | Admin</title>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <h5 class="main-content-title fs-24 mb-0">Manage Leadership Section</h5>
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
                    Add Leadership Section
                </div>
            </div>


            <div class="card-body">

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif


                <form action="{{ route('admin.saveLeadershipSection') }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="row">


                        {{-- CM SECTION --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CM Name *</label>
                                <input type="text" class="form-control" name="cm_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CM Designation *</label>
                                <input type="text" class="form-control" name="cm_designation">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>CM Image *</label>
                                <input type="file" class="form-control" name="cm_image">
                            </div>
                        </div>



                        {{-- DGP SECTION --}}

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DGP Name *</label>
                                <input type="text" class="form-control" name="dgp_name">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DGP Designation *</label>
                                <input type="text" class="form-control" name="dgp_designation">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DGP Image *</label>
                                <input type="file" class="form-control" name="dgp_image">
                            </div>
                        </div>



                        {{-- CENTER CONTENT --}}

                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Subject *</label>
                                <input type="text" class="form-control" name="subject">
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Content *</label>
                                <textarea class="form-control" name="content" rows="6"></textarea>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status *</label>
                                <select class="form-control" name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm" style="width:20%">
                                Submit
                            </button>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
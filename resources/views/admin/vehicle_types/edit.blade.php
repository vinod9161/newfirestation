@extends('layouts.admin.template')
@section('title')
<title>Vehicle &amp; Machine</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Vehicle Types</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.vehicletypes');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Vehicle Types List
            </a>
        </div>
    </div>
</div>



<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Edit Vehicle Types
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

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
                        <form action="{{ route('admin.updateVehicleTypes') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Vehicle Type<sup class="text-danger">*</sup></label>      
                                        <input class="form-control"  name="vehicle_type" id="vehicle_type" type="text" value="{{ $vehicletypes[0]->type }}" required />               
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status <sup class="text-danger">*</sup></label>      
                                        <select class="form-control js-example-basic-single" name="status" id="status" required>
                                        <option value="">--- Select An Option ---</option>
                                        <option {{ $vehicletypes[0]->status == 1 ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ $vehicletypes[0]->status == 0 ? 'selected' : '' }} value="0">Inactive</option>
                                        </select>
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <input type="hidden" name="id" id="id" value="{{ $vehicletypes[0]->id }}">
                                    <button type="submit" id="addVehicle" class="btn btn-primary btn-sm" style="width:20%">Update</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
@stop
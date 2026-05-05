@extends('layouts.admin.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title fs-24 mb-0">Manage Services</h5>
    </div>
    <div class="d-flex app-header-btn">
        <a href="{{ route('services.index') }}" class="btn btn-success">
            <i class="fe fe-eye me-1"></i> Service List
        </a>
    </div>
</div>

<div class="row">
<div class="col-xl-12">
<div class="card custom-card">

<div class="card-header">
    <div class="card-title">
        Add Service
    </div>
</div>

<div class="card-body">

<div class="col-md-12 servicetoaster"></div>

<form method="POST" action="{{ route('services.store') }}" id="serviceForm">
@csrf

<div class="row">

{{-- SERVICE NAME --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Service Name <sup class="text-danger">*</sup></label>
        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Service Name">
        <span class="text-danger" id="error_name"></span>
    </div>
</div>

{{-- SERVICE CODE --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Service Code</label>
        <input type="text" name="code" id="code" class="form-control" placeholder="Enter Service Code">
        <span class="text-danger" id="error_code"></span>
    </div>
</div>

{{-- STATUS --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Status</label><br>
        <input type="checkbox" name="is_active" value="1" checked> Active
    </div>
</div>

{{-- DESCRIPTION --}}
<div class="col-md-12">
    <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description"></textarea>
    </div>
</div>

{{-- SUBMIT --}}
<div class="col-md-12 mt-3">
    <button type="submit" class="btn btn-primary" style="width:20%">Submit</button>
</div>

</div>
</form>

</div>
</div>
</div>
</div>

@endsection
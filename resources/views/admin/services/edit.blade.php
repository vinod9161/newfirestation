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
        Edit Service
    </div>
</div>

<div class="card-body">

<form method="POST" action="{{ route('services.update',$service->id) }}">
@csrf

<div class="row">

{{-- NAME --}}
<div class="col-md-4">
    <label>Service Name <span class="text-danger">*</span></label>
    <input type="text" name="name" value="{{ $service->name }}" class="form-control">
</div>

{{-- CODE --}}
<div class="col-md-4">
    <label>Service Code</label>
    <input type="text" name="code" value="{{ $service->code }}" class="form-control">
</div>

{{-- STATUS --}}
<div class="col-md-4">
    <label>Status</label><br>
    <input type="checkbox" name="is_active" value="1"
        {{ $service->is_active ? 'checked' : '' }}> Active
</div>

{{-- DESCRIPTION --}}
<div class="col-md-12">
    <label>Description</label>
    <textarea name="description" class="form-control">{{ $service->description }}</textarea>
</div>

{{-- SUBMIT --}}
<div class="col-md-12 mt-3">
    <button class="btn btn-primary" style="width:20%">Update</button>
</div>

</div>
</form>

</div>
</div>
</div>
</div>

@endsection
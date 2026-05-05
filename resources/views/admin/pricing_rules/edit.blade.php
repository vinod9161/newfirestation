@extends('layouts.admin.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title fs-24 mb-0">Manage Pricing Rules</h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('pricing-rules.index') }}" class="btn btn-success">
            <i class="fe fe-eye me-1"></i> Pricing Rule List
        </a>
    </div>
</div>

<div class="row">
<div class="col-xl-12">
<div class="card custom-card">

<div class="card-header">
    <div class="card-title">Edit Pricing Rule</div>
</div>

<div class="card-body">

<form method="POST" action="{{ route('pricing-rules.update',$rule->id) }}">
@csrf

<div class="row">

{{-- SERVICE --}}
<div class="col-md-4">
    <label>Service <span class="text-danger">*</span></label>
    <select name="service_id" class="form-control">
        @foreach($services as $id => $name)
            <option value="{{ $id }}"
                {{ $rule->service_id == $id ? 'selected' : '' }}>
                {{ $name }}
            </option>
        @endforeach
    </select>
</div>

{{-- GATHERING --}}
<div class="col-md-4">
    <label>Min Gathering</label>
    <input type="number" name="min_gathering"
        value="{{ $rule->min_gathering }}" class="form-control">
</div>

<div class="col-md-4">
    <label>Max Gathering</label>
    <input type="number" name="max_gathering"
        value="{{ $rule->max_gathering }}" class="form-control">
</div>

{{-- SQ FT --}}
<div class="col-md-4">
    <label>Min Sq Ft</label>
    <input type="number" name="min_sq_ft"
        value="{{ $rule->min_sq_ft }}" class="form-control">
</div>

<div class="col-md-4">
    <label>Max Sq Ft</label>
    <input type="number" name="max_sq_ft"
        value="{{ $rule->max_sq_ft }}" class="form-control">
</div>

{{-- HEIGHT --}}
<div class="col-md-4">
    <label>Min Height</label>
    <input type="number" step="0.01" name="min_height"
        value="{{ $rule->min_height }}" class="form-control">
</div>

<div class="col-md-4">
    <label>Max Height</label>
    <input type="number" step="0.01" name="max_height"
        value="{{ $rule->max_height }}" class="form-control">
</div>

{{-- HOURS --}}
<div class="col-md-4">
    <label>Min Hours</label>
    <input type="number" name="min_hours"
        value="{{ $rule->min_hours }}" class="form-control">
</div>

<div class="col-md-4">
    <label>Max Hours</label>
    <input type="number" name="max_hours"
        value="{{ $rule->max_hours }}" class="form-control">
</div>

{{-- RATE --}}
<div class="col-md-4">
    <label>Rate</label>
    <input type="number" step="0.01" name="rate"
        value="{{ $rule->rate }}" class="form-control">
</div>

{{-- RATE TYPE --}}
<div class="col-md-4">
    <label>Rate Type</label>
    <select name="rate_type" class="form-control">
        <option value="fixed" {{ $rule->rate_type=='fixed'?'selected':'' }}>Fixed</option>
        <option value="per_person" {{ $rule->rate_type=='per_person'?'selected':'' }}>Per Person</option>
        <option value="per_sq_ft" {{ $rule->rate_type=='per_sq_ft'?'selected':'' }}>Per Sq Ft</option>
        <option value="per_hour" {{ $rule->rate_type=='per_hour'?'selected':'' }}>Per Hour</option>
    </select>
</div>

{{-- PRIORITY --}}
<div class="col-md-4">
    <label>Priority</label>
    <input type="number" name="priority"
        value="{{ $rule->priority }}" class="form-control">
</div>

{{-- STATUS --}}
<div class="col-md-4">
    <label>Status</label><br>
    <input type="checkbox" name="is_active" value="1"
        {{ $rule->is_active ? 'checked' : '' }}> Active
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
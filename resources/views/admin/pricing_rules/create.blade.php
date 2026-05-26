@extends('layouts.admin.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title fs-24 mb-0">Manage Pricing Rules</h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('pricing-rules.index') }}" class="btn ripple btn-wave btn-success mb-0">
            <i class="fe fe-eye me-1"></i> Pricing Rule List
        </a>
    </div>
</div>

<div class="row">
<div class="col-xl-12">
<div class="card custom-card">

<div class="card-header">
    <div class="card-title">
        Add Pricing Rule
    </div>
</div>

<div class="card-body">

<div class="col-md-12 pricingtoaster"></div>

<form method="POST" action="{{ route('pricing-rules.store') }}" id="pricingForm">
@csrf

<div class="row">

{{-- SERVICE --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Service <sup class="text-danger">*</sup></label>
        <select name="service_id" class="form-control js-example-basic-single" required>
            <option value="">Select Service</option>
            @foreach($services as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
            @endforeach
        </select>
    </div>
</div>

{{-- GATHERING --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Min Gathering</label>
        <input type="number" name="min_gathering" class="form-control">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>Max Gathering</label>
        <input type="number" name="max_gathering" class="form-control">
    </div>
</div>

{{-- SQ FT --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Min Square Meter</label>
        <input type="number" name="min_sq_meter" class="form-control">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>Max Square Meter</label>
        <input type="number" name="max_sq_meter" class="form-control">
    </div>
</div>

{{-- HEIGHT --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Min Height</label>
        <input type="number" step="0.01" name="min_height" class="form-control">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>Max Height</label>
        <input type="number" step="0.01" name="max_height" class="form-control">
    </div>
</div>

{{-- HOURS --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Min Hours</label>
        <input type="number" name="min_hours" class="form-control">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>Max Hours</label>
        <input type="number" name="max_hours" class="form-control">
    </div>
</div>

{{-- RATE --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Rate <sup class="text-danger">*</sup></label>
        <input type="number" step="0.01" name="rate" class="form-control" required>
    </div>
</div>

{{-- RATE TYPE --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Rate Type</label>
        <select name="rate_type" class="form-control">
            <option value="fixed">Fixed</option>
            <option value="per_person"> Per Person </option>
            <option value="per_sq_meter"> Per Square Meter </option>
            <option value="per_hour"> Per Hour </option>
            <option value="per_extinguisher"> Per Extinguisher </option>
        </select>
    </div>
</div>

{{-- PRIORITY --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Priority</label>
        <input type="number" name="priority" value="1" class="form-control">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>Processing Fee</label>
        <input type="number" step="0.01"
               name="processing_fee"
               class="form-control">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>CGST %</label>
        <input type="number"
               step="0.01"
               name="cgst_percent"
               value="9"
               class="form-control">
    </div>
</div>

<div class="col-md-4">
    <div class="form-group">
        <label>SGST %</label>
        <input type="number"
               step="0.01"
               name="sgst_percent"
               value="9"
               class="form-control">
    </div>
</div>

{{-- STATUS --}}
<div class="col-md-4">
    <div class="form-group">
        <label>Status</label><br>
        <input type="checkbox" name="is_active" value="1" checked> Active
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
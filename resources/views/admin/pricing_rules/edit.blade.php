@extends('layouts.admin.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title fs-24 mb-0">
            Manage Pricing Rules
        </h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('pricing-rules.index') }}"
           class="btn ripple btn-wave btn-success mb-0">

            <i class="fe fe-eye me-1"></i>
            Pricing Rule List
        </a>
    </div>
</div>

<div class="row">
<div class="col-xl-12">
<div class="card custom-card">

<div class="card-header">
    <div class="card-title">
        Edit Pricing Rule
    </div>
</div>

<div class="card-body">

{{-- VALIDATION ERRORS --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST"
      action="{{ route('pricing-rules.update', $rule->id) }}"
      id="pricingForm">

@csrf

<div class="row">

{{-- SERVICE --}}
<div class="col-md-4">
    <div class="form-group">

        <label>
            Service
            <sup class="text-danger">*</sup>
        </label>

        <select name="service_id"
                class="form-control js-example-basic-single"
                required>

            <option value="">Select Service</option>

            @foreach($services as $id => $name)

                <option value="{{ $id }}"
                    {{ $rule->service_id == $id ? 'selected' : '' }}>

                    {{ $name }}

                </option>

            @endforeach

        </select>

    </div>
</div>


{{-- MIN GATHERING --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Min Gathering</label>

        <input type="number"
               name="min_gathering"
               value="{{ $rule->min_gathering }}"
               class="form-control">

    </div>
</div>


{{-- MAX GATHERING --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Max Gathering</label>

        <input type="number"
               name="max_gathering"
               value="{{ $rule->max_gathering }}"
               class="form-control">

    </div>
</div>


{{-- MIN SQ METER --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Min Square Meter</label>

        <input type="number"
               step="0.01"
               name="min_sq_meter"
               value="{{ $rule->min_sq_meter }}"
               class="form-control">

    </div>
</div>


{{-- MAX SQ METER --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Max Square Meter</label>

        <input type="number"
               step="0.01"
               name="max_sq_meter"
               value="{{ $rule->max_sq_meter }}"
               class="form-control">

    </div>
</div>


{{-- MIN HEIGHT --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Min Height</label>

        <input type="number"
               step="0.01"
               name="min_height"
               value="{{ $rule->min_height }}"
               class="form-control">

    </div>
</div>


{{-- MAX HEIGHT --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Max Height</label>

        <input type="number"
               step="0.01"
               name="max_height"
               value="{{ $rule->max_height }}"
               class="form-control">

    </div>
</div>


{{-- MIN HOURS --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Min Hours</label>

        <input type="number"
               step="0.01"
               name="min_hours"
               value="{{ $rule->min_hours }}"
               class="form-control">

    </div>
</div>


{{-- MAX HOURS --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Max Hours</label>

        <input type="number"
               step="0.01"
               name="max_hours"
               value="{{ $rule->max_hours }}"
               class="form-control">

    </div>
</div>


{{-- RATE --}}
<div class="col-md-4">
    <div class="form-group">

        <label>
            Rate
            <sup class="text-danger">*</sup>
        </label>

        <input type="number"
               step="0.01"
               name="rate"
               value="{{ $rule->rate }}"
               class="form-control"
               required>

    </div>
</div>


{{-- RATE TYPE --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Rate Type</label>

        <select name="rate_type" class="form-control">

            <option value="fixed"
                {{ $rule->rate_type == 'fixed' ? 'selected' : '' }}>
                Fixed
            </option>

            <option value="per_person"
                {{ $rule->rate_type == 'per_person' ? 'selected' : '' }}>
                Per Person
            </option>

            <option value="per_sq_meter"
                {{ $rule->rate_type == 'per_sq_meter' ? 'selected' : '' }}>
                Per Square Meter
            </option>

            <option value="per_hour"
                {{ $rule->rate_type == 'per_hour' ? 'selected' : '' }}>
                Per Hour
            </option>

            <option value="per_extinguisher"
                {{ $rule->rate_type == 'per_extinguisher' ? 'selected' : '' }}>
                Per Extinguisher
            </option>

        </select>

    </div>
</div>


{{-- PRIORITY --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Priority</label>

        <input type="number"
               name="priority"
               value="{{ $rule->priority }}"
               class="form-control">

    </div>
</div>


{{-- PROCESSING FEE --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Processing Fee</label>

        <input type="number"
               step="0.01"
               name="processing_fee"
               value="{{ $rule->processing_fee }}"
               class="form-control">

    </div>
</div>


{{-- CGST --}}
<div class="col-md-4">
    <div class="form-group">

        <label>CGST %</label>

        <input type="number"
               step="0.01"
               name="cgst_percent"
               value="{{ $rule->cgst_percent }}"
               class="form-control">

    </div>
</div>


{{-- SGST --}}
<div class="col-md-4">
    <div class="form-group">

        <label>SGST %</label>

        <input type="number"
               step="0.01"
               name="sgst_percent"
               value="{{ $rule->sgst_percent }}"
               class="form-control">

    </div>
</div>


{{-- STATUS --}}
<div class="col-md-4">
    <div class="form-group">

        <label>Status</label>
        <br>

        <input type="checkbox"
               name="is_active"
               value="1"
               {{ $rule->is_active ? 'checked' : '' }}>

        Active

    </div>
</div>


{{-- SUBMIT --}}
<div class="col-md-12 mt-4">

    <button type="submit"
            class="btn btn-primary"
            style="width:20%">

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
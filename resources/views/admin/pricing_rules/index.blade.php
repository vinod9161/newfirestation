@extends('layouts.admin.template')

@section('title')
<title>Pricing Rules | Admin Dashboard</title>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mb-0">Manage Pricing Rules</h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('pricing-rules.create') }}" class="btn ripple btn-wave btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Pricing Rule
        </a>
    </div>
</div>

<!-- Start::row -->
<div class="row">
<div class="col-xl-12">
<div class="card custom-card">

<div class="card-header">
    <div class="card-title">
        Pricing Rules List
    </div>
</div>

<div class="card-body">

{{-- Alerts --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if (session('failed'))
    <div class="alert alert-danger">{{ session('failed') }}</div>
@endif

<div class="table-responsive">

<table class="table table-bordered table-striped table-hover">
<thead>
<tr>
    <th>#</th>
    <th>Service</th>
    <th>Conditions</th>
    <th>Rate</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@foreach($rules as $key => $rule)
<tr>
    <td>{{ $key + 1 }}</td>

    {{-- SERVICE --}}
    <td>{{ $rule->service->name ?? '-' }}</td>

    {{-- CONDITIONS --}}
    <td>
        @if($rule->min_gathering || $rule->max_gathering)
            <div><b>Gathering:</b> {{ $rule->min_gathering ?? 0 }} - {{ $rule->max_gathering ?? '∞' }}</div>
        @endif

        @if($rule->min_sq_ft || $rule->max_sq_ft)
            <div><b>Sq Ft:</b> {{ $rule->min_sq_ft ?? 0 }} - {{ $rule->max_sq_ft ?? '∞' }}</div>
        @endif

        @if($rule->min_height || $rule->max_height)
            <div><b>Height:</b> {{ $rule->min_height ?? 0 }} - {{ $rule->max_height ?? '∞' }}</div>
        @endif

        @if($rule->min_hours || $rule->max_hours)
            <div><b>Hours:</b> {{ $rule->min_hours ?? 0 }} - {{ $rule->max_hours ?? '∞' }}</div>
        @endif
    </td>

    {{-- RATE --}}
    <td>
        {{ $rule->rate }} 
        <br>
        <small class="text-muted">{{ $rule->rate_type }}</small>
    </td>

    {{-- STATUS --}}
    <td>
        @if($rule->is_active)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </td>

    {{-- ACTION --}}
    <td>

        {{-- EDIT --}}
        <a href="{{ route('pricing-rules.edit',$rule->id) }}"
           class="btn btn-sm btn-primary">
           <i class="fe fe-edit"></i>
        </a>

        {{-- DELETE --}}
        <form method="POST"
              action="{{ route('pricing-rules.delete',$rule->id) }}"
              style="display:inline;">
            @csrf
            <button class="btn btn-sm btn-danger"
                onclick="return confirm('Delete this rule?')">
                <i class="fe fe-trash"></i>
            </button>
        </form>

        {{-- TOGGLE --}}
        <a href="{{ route('pricing-rules.toggle',$rule->id) }}"
           class="btn btn-sm {{ $rule->is_active ? 'btn-success' : 'btn-warning' }}">
           <i class="fe fe-power"></i>
        </a>

    </td>

</tr>
@endforeach
</tbody>

</table>

</div>
</div>

</div>
</div>
</div>

<!-- End::row -->

@endsection
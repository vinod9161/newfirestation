@extends('layouts.admin.template')

@section('title')
<title>Pricing Rules | Admin Dashboard</title>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mb-0">
            Manage Pricing Rules
        </h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('pricing-rules.create') }}"
           class="btn ripple btn-wave btn-success mb-0">

            <i class="fe fe-plus me-1"></i>
            Add Pricing Rule
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
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('failed'))
    <div class="alert alert-danger">
        {{ session('failed') }}
    </div>
@endif

<div class="table-responsive">

<table class="table table-bordered table-striped table-hover align-middle">

<thead>
<tr>
    <th>#</th>
    <th>Service</th>
    <th>Conditions</th>
    <th>Pricing Details</th>
    <th>Status</th>
    <th width="180">Action</th>
</tr>
</thead>

<tbody>

@forelse($rules as $key => $rule)

<tr>

    {{-- SERIAL --}}
    <td>{{ $key + 1 }}</td>

    {{-- SERVICE --}}
    <td>
        <strong>
            {{ $rule->service->name ?? '-' }}
        </strong>
    </td>

    {{-- CONDITIONS --}}
    <td>

        {{-- GATHERING --}}
        @if($rule->min_gathering || $rule->max_gathering)
            <div class="mb-1">
                <b>Gathering:</b>

                {{ $rule->min_gathering ?? 0 }}
                -

                {{ $rule->max_gathering ?? '∞' }}
            </div>
        @endif


        {{-- SQUARE METER --}}
        @if($rule->min_sq_meter || $rule->max_sq_meter)
            <div class="mb-1">
                <b>Square Meter:</b>

                {{ $rule->min_sq_meter ?? 0 }}
                -

                {{ $rule->max_sq_meter ?? '∞' }}
            </div>
        @endif


        {{-- HEIGHT --}}
        @if($rule->min_height || $rule->max_height)
            <div class="mb-1">
                <b>Height:</b>

                {{ $rule->min_height ?? 0 }}
                -

                {{ $rule->max_height ?? '∞' }}
            </div>
        @endif


        {{-- HOURS --}}
        @if($rule->min_hours || $rule->max_hours)
            <div class="mb-1">
                <b>Hours:</b>

                {{ $rule->min_hours ?? 0 }}
                -

                {{ $rule->max_hours ?? '∞' }}
            </div>
        @endif

    </td>


    {{-- PRICING --}}
    <td>

        <div>
            <b>Rate:</b>

            ₹{{ number_format($rule->rate, 2) }}
        </div>

        <div>
            <b>Type:</b>

            <span class="badge bg-info">

                {{ ucwords(str_replace('_', ' ', $rule->rate_type)) }}

            </span>
        </div>

        <div>
            <b>Processing Fee:</b>

            ₹{{ number_format($rule->processing_fee ?? 0, 2) }}
        </div>

        <div>
            <b>GST:</b>

            {{ $rule->cgst_percent ?? 0 }}%
            +
            {{ $rule->sgst_percent ?? 0 }}%

            =
            <strong>
                {{ ($rule->cgst_percent ?? 0) + ($rule->sgst_percent ?? 0) }}%
            </strong>
        </div>

        <div>
            <b>Priority:</b>

            {{ $rule->priority }}
        </div>

    </td>


    {{-- STATUS --}}
    <td>

        @if($rule->is_active)

            <span class="badge bg-success">
                Active
            </span>

        @else

            <span class="badge bg-danger">
                Inactive
            </span>

        @endif

    </td>


    {{-- ACTION --}}
    <td>

        <div class="d-flex gap-1">

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

                <button type="submit"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Delete this pricing rule?')">

                    <i class="fe fe-trash"></i>

                </button>
            </form>


            {{-- TOGGLE --}}
            <a href="{{ route('pricing-rules.toggle',$rule->id) }}"
               class="btn btn-sm {{ $rule->is_active ? 'btn-success' : 'btn-warning' }}">

                <i class="fe fe-power"></i>

            </a>

        </div>

    </td>

</tr>

@empty

<tr>
    <td colspan="6" class="text-center">
        No pricing rules found
    </td>
</tr>

@endforelse

</tbody>

</table>

</div>
</div>

</div>
</div>
</div>

<!-- End::row -->

@endsection
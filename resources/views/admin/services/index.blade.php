@extends('layouts.admin.template')

@section('title')
<title>Services | Admin Dashboard</title>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mb-0">Manage Services</h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('services.create') }}" class="btn ripple btn-wave btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Service
        </a>
    </div>
</div>

<!-- Start::row -->
<div class="row">
<div class="col-xl-12">
<div class="card custom-card">

<div class="card-header">
    <div class="card-title">
        Service List
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
    <th>Service Name</th>
    <th>Code</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@foreach($services as $key => $service)
<tr>
    <td>{{ $key + 1 }}</td>

    <td>{{ $service->name }}</td>

    <td>{{ $service->code ?? '-' }}</td>

    {{-- STATUS --}}
    <td>
        @if($service->is_active)
            <span class="badge bg-success">Active</span>
        @else
            <span class="badge bg-danger">Inactive</span>
        @endif
    </td>

    {{-- ACTION --}}
    <td>

        {{-- EDIT --}}
        <a href="{{ route('services.edit',$service->id) }}"
           class="btn btn-sm btn-primary">
           <i class="fe fe-edit"></i>
        </a>

        {{-- DELETE --}}
        <!-- <form method="POST"
              action="{{ route('services.delete',$service->id) }}"
              style="display:inline;">
            @csrf
            <button class="btn btn-sm btn-danger"
                onclick="return confirm('Delete this service?')">
                <i class="fe fe-trash"></i>
            </button>
        </form> -->

        {{-- TOGGLE STATUS --}}
        <a href="{{ route('services.toggle',$service->id) }}"
           class="btn btn-sm {{ $service->is_active ? 'btn-success' : 'btn-warning' }}">
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
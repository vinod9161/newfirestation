@extends('layouts.admin.template')
@section('title')
<title>CMS - Contact Info | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Contact Information</h5>
    </div>
    <div class="d-flex app-header-btn">  
        <!-- <div>
            <a href="<?php // echo route('admin.organisational');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Organisational Structure List
            </a>
        </div> -->
    </div>
</div>
<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    View Contact Information
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">
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

                    <?php //echo "<pre>"; print_r($contact->email); die;?>

                    <form action="{{ isset($contact) ? route('admin.updatecontactinfo', $contact->id) : route('admin.addcontactinfo') }}" method="post">
    @csrf
    @if (isset($contact))
        @method('PUT')
    @endif

    <div class="form-group">
        <label>Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control" 
               value="{{ old('email', isset($contact) ? $contact->email : '') }}" 
               placeholder="Enter email">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Phone <span class="text-danger">*</span></label>
        <input type="text" name="phone" class="form-control" 
               value="{{ old('phone', isset($contact) ? $contact->phone : '') }}" 
               placeholder="Enter phone number">
        @error('phone')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Address <span class="text-danger">*</span></label>
        <textarea name="address" class="form-control" placeholder="Enter address">{{ old('address', isset($contact) ? $contact->address : '') }}</textarea>
        @error('address')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Map <span class="text-danger">*</span></label>
        <input type="text" name="map" class="form-control" 
               value="{{ old('map', isset($contact) ? $contact->map : '') }}" 
               placeholder="Enter Google Map iframe code">
        @error('map')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ isset($contact) ? 'Update' : 'Submit' }}</button>
</form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
@stop
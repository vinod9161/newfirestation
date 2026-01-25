@extends('layouts.admin.template')
@section('title')
<title>Departments | Admin Dashboard</title>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Departments / FSO</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.fso');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View FSO List
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
                    Update FSO
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
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                <form action="{{ route('admin.updatefso', $fso->id) }}" method="post">
    @csrf
    @method('PUT') <!-- Use PUT method for updating -->
    <div class="row">

        <div class="col-md-4">
            <div class="form-group">
                <label>Name <sup class="text-danger">*</sup></label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="{{ old('name', $fso->name) }}" required>
                <span class="text-danger" id="nameError"></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Email <sup class="text-danger">*</sup></label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address" value="{{ old('email', $fso->email) }}" required>
                <span class="text-danger" id="emailError"></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Mobile <sup class="text-danger">*</sup></label>
                <input type="number" name="phone" id="phone" class="form-control" size="13" maxlength="13" placeholder="Enter Mobile Number" value="{{ old('phone', $fso->number) }}" required>
                <span class="text-danger" id="phoneError"></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>District जनपद <sup class="text-danger">*</sup></label>
                <select name="district_id" id="districts" class="form-control js-example-basic-single" required>
                    <option value="">--- Select District जनपद ---</option>
                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ $district->id == $fso->district_id ? 'selected' : '' }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>
                <span class="text-danger" id="districtsError"></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Fire Station <sup class="text-danger">*</sup></label>
                <select name="fire_station_id" id="fire_station" class="form-control js-example-basic-single" required>
                    <option value="">--- Select Fire Station ---</option>
                    <!-- Populate fire stations dynamically based on selected district -->
                    @foreach($fireStations as $fireStation)
                        <option value="{{ $fireStation->id }}" {{ $fireStation->id == $fso->station_id ? 'selected' : '' }}>
                            {{ $fireStation->name }}
                        </option>
                    @endforeach
                </select>
                <span class="text-danger" id="stationError"></span>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label>Status <sup class="text-danger">*</sup></label>
                <select name="status" id="status" class="form-control js-example-basic-single" required>
                    <option value="">--- Select Status ---</option>
                    <option value="1" {{ $fso->status == '1' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $fso->status == '0' ? 'selected' : '' }}>Inactive</option>
                </select>
                <span class="text-danger" id="statusError"></span>
            </div>
        </div>

        <div class="col-md-12">
            <button type="submit" id="addCfo" class="btn btn-primary btn-sm" style="width:20%">Update</button>
        </div>
    </div>
</form>


                                </div>
                            </div>
                        </div>
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

<script>
    $(document).ready(function() {
        $('#districts').change(function() {
            var districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: '/get-fire-stations/' + districtId, // Adjust the route as necessary
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#fire_station').empty();
                        $('#fire_station').append('<option value="">--- Select Fire Station ---</option>');
                        $.each(data, function(key, value) {
                            $('#fire_station').append('<option value="' + value.id + '">' + value.name + '</option>'); // Adjust property names based on your model
                        });
                    }
                });
            } else {
                $('#fire_station').empty();
                $('#fire_station').append('<option value="">--- Select Fire Station ---</option>');
            }
        });
    });
</script>

@stop
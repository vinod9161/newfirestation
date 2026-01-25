@extends('layouts.citizen.template')

@section('title')
<title> Profile Settings | Admin Dashboard</title>
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
    input[readonly], input[disabled], select[disabled], select[readonly] {
        background-color: #f0f0f0 !important;
        color: #333;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
@php
    $user = Auth::user();
    $isEditable = $user->type == 0;
    $typeMap = [
        4 => 'Citizen',
    ];
    $type = $typeMap[$user->type] ?? 'Unknown';
@endphp

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">View Profile</h5>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="card-title mb-0">View Profile</div>
                @if($isEditable)
                    <a href="javascript:void(0)" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#updateModal">Change Password</a>
                @endif
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-12">
                        <form action="#" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="col-md-3 form-group">
                                    <label>User Type <sup class="text-danger">*</sup></label>
                                    @if($isEditable)
                                        <select name="type" id="type" class="form-control">
                                            <option value="{{ $user->type }}">{{ $type }}</option>
                                        </select>
                                    @else
                                        <input type="text" class="form-control" value="{{ $type }}" {{ $isEditable ? '' : 'readonly' }}>
                                    @endif
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Name <sup class="text-danger">*</sup></label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" {{ $isEditable ? '' : 'readonly' }}>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Email <sup class="text-danger">*</sup></label>
                                    <input type="text" name="email" id="email" class="form-control" value="{{ $user->email }}" {{ $isEditable ? '' : 'readonly' }}>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Phone <sup class="text-danger">*</sup></label>
                                    <input type="text" name="phone" id="phone" class="form-control" value="{{ $user->number }}" {{ $isEditable ? '' : 'readonly' }}>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Address <sup class="text-danger">*</sup></label>
                                    <input type="text" name="address" id="address" class="form-control" value="{{ $user->address ?? '' }}" {{ $isEditable ? '' : 'readonly' }}>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>State</label>
                                    <select class="form-control" id="state_id" name="state_id" {{ $isEditable ? '' : 'disabled' }}>
                                        <option value="">--- Select State ---</option>
                                        @foreach($stateList ?? [] as $stData)
                                            <option value="{{ $stData->id }}" {{ $user->state_id == $stData->id ? 'selected' : '' }}>
                                                {{ $stData->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>District</label>
                                    <select class="form-control" id="dashboard_dis" name="dashboard_dis" {{ $isEditable ? '' : 'disabled' }}>
                                        <option value="">--- Select District ---</option>
                                        @foreach($districtList ?? [] as $disData)
                                            <option value="{{ $disData->id }}" {{ $user->district_id == $disData->id ? 'selected' : '' }}>
                                                {{ $disData->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 form-group">
                                    <label>Fire Station</label>
                                    <select class="form-control" id="dashboard_fire" name="dashboard_fire" {{ $isEditable ? '' : 'disabled' }}>
                                        <option value="">--- Select Fire Station ---</option>
                                        @foreach($fireStactionList ?? [] as $fs)
                                            <option value="{{ $fs->id }}" {{ $user->station_id == $fs->id ? 'selected' : '' }}>
                                                {{ $fs->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                               

                            </div> 
                        </form>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('change', '#dashboard_dis', function() {
        let districtId = $(this).val().trim();
        let _token = $('input[name="_token"]').val();

        if (districtId == '') {
            alert("Required District");
            return false;
        }

        $.ajax({
            url: "{{ route('actionFireStationByDistrict') }}",
            type: "POST",
            data: {
                district_id: districtId,
                _token: _token
            },
            success: function(response) {
                let dataObj = JSON.parse(response);
                let fireStation = '<option value="">---- Select Fire Station ----</option>';

                if (dataObj.code === 1) {
                    $.each(dataObj.data, function(key, value) {
                        fireStation += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                } else {
                    fireStation = '<option value="">' + dataObj.message + '</option>';
                }

                $('#dashboard_fire').html(fireStation);
            }
        });
    });
</script>
@endsection

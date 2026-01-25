@extends('layouts.admin.template')
@section('title')
<title>Edit Medal Winner | Admin Dashboard</title>
@endsection

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Edit Medal Winner</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.achivements.medal_winners') }}" class="btn ripple btn-wave btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View All List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Edit Medal Winner</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
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
                                    <form action="{{ route('admin.achivements.medal_winners.update', $medal_winners->id) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Select Category <sup class="text-danger">*</sup></label>
                                                    <select name="category_id" id="category_id" class="form-control js-example-basic-single">
                                                        <option value="">Select Category</option>
                                                        @foreach ($medal_category as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $medal_winners->medal_category ? 'selected' : '' }}>
                                                            {{ $category->category_name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="categoryError"></span>
                                                </div>
                                            </div>

                                            <!-- Fire Station -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Fire Station<sup class="text-danger">*</sup></label>
                                                    <select name="fire_station" id="fire_station" class="form-control js-example-basic-single">
                                                        <option value="">Select Fire Station</option>
                                                        @foreach ($fire_stations as $station)
                                                        <option value="{{ $station->id }}" {{ $station->id == $medal_winners->fire_station ? 'selected' : '' }}>
                                                            {{ $station->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="firestationError"></span>
                                                </div>
                                            </div>

                                            <!-- District -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>District<sup class="text-danger">*</sup></label>
                                                    <select name="district" id="district" class="form-control js-example-basic-single">
                                                        <option value="">Select District</option>
                                                        @foreach ($districts as $district)
                                                        <option value="{{ $district->id }}" {{ $district->id == $medal_winners->districts ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="districtError"></span>
                                                </div>
                                            </div>

                                            <!-- Year -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Year <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="year" id="year" value="{{ old('year', $medal_winners->year) }}" placeholder="YYYY" class="form-control">
                                                    <span class="text-danger" id="yearError"></span>
                                                </div>
                                            </div>

                                            <!-- Name -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Name <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="name" id="name" value="{{ old('name', $medal_winners->name) }}" class="form-control">
                                                    <span class="text-danger" id="nameError"></span>
                                                </div>
                                            </div>

                                            <!-- Designation -->
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Designation <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="designation" id="designation" value="{{ old('designation', $medal_winners->designation) }}" class="form-control">
                                                    <span class="text-danger" id="designationError"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Occassion <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="occassion" id="occassion" placeholder="Occassion" value="{{ old('occassion', $medal_winners->occassion) }}" class="form-control">
                                                    <span class="text-danger" id="occassionError"></span>
                                                </div>
                                            </div>

                                            <!-- Submit Button -->
                                            <div class="col-md-12">
                                                <button type="submit" id="addcard" class="btn btn-primary btn-sm" style="width:20%">Update</button>
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
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#addcard').on('click', function(e) 
    {
        let category_id     = $('#category_id').val();
        let fire_station    = $('#fire_station').val();
        let district        = $('#district').val();
        let name            = $('#name').val();
        let yearVal         = $('#year').val();
        let designation     = $('#designation').val();
        let occassion       = $('#occassion').val();

        if(category_id == '')
        {
            $('#categoryError').html("Category Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else if(fire_station == '')
        {
            $('#firestationError').html("Fire Station Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else if(district == '')
        {
            $('#districtError').html("District Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        
        else if(yearVal == '')
        {
            $('#yearError').html("Year Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else if(name == '')
        {
            $('#nameError').html("Name Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else if(designation == '')
        {
            $('#designationError').html("Designation Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else if(occassion == '')
        {
            $('#occassionError').html("occassion Required").delay(2500).fadeOut().css('display', 'block');
            return false;
        }
        else
        {
            return true;
        }


    });
});
</script>
@endsection

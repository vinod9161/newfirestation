@extends('layouts.admin.template')

@section('title')
<title>Location - Tahsil</title>
@endsection
@section('style')


@endsection
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('admin.updatetehsil', $tehsil->id) }}" method="POST">
    @csrf
    @method('PUT') <!-- Use PUT method for updates -->
    <div class="body-box-admin tab-content card" style="padding:0px">
        <h2 class="text-center" style="background-color:#42425d;color:#ffffff">Edit Tehsil Details</h2>
        <p class="note" style="margin-left:10px; color:red">Fields with <span class="required">*</span> are required.</p>
        <div class="row mt-3" style="padding: 0 30px 25px;">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">Tehsil Name <span class="required" style="color:red">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Tehsil Name" value="{{ old('name', $tehsil->name) }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4 col-sm-10 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Select District <span class="required" style="color:red">*</span></label>
                    <select class="form-control" name="district_name" id="district_name" required>
                        <option value="">--Select District--</option>
                        @foreach($districts as $district)
                            <option value="{{ $district->id }}" {{ old('district_name', $tehsil->district_id) == $district->id ? 'selected' : '' }}>{{ $district->name }}</option>
                        @endforeach
                    </select>
                    @error('district_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-md-4 col-sm-10 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <input class="form-control" name="description" id="description" placeholder="Description" value="{{ old('description', $tehsil->description) }}">
                </div>
            </div>
        </div>
        <div class="pl-lg-4 text-center mb-3" style="margin-right:85%;">
            <a href="{{ route('admin.tehsil') }}" class="save-btn hover-btn btn btn-secondary">Back</a>
            <button class="save-btn hover-btn btn btn-primary" type="submit">Update</button>
        </div>
    </div>
</form>



@endsection

@section('scripts')
@stop
@extends('layouts.admin.template')

@section('title')
<title>Department - Edit Review Officer</title>
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

<form action="{{ route('admin.updatereview', $review->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="body-box-admin tab-content card" style="padding:0px">
        <h2 class="text-center" style="background-color:#42425d;color:#ffffff">
            Edit Review Officer Details
        </h2>

        <p class="note" style="margin-left:10px; color:red">
            Fields with <span class="required">*</span> are required.
        </p>

        <div class="row mt-3" style="padding: 0 30px 25px;">

            <!-- Name -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">
                        Name <span style="color:red">*</span>
                    </label>
                    <input type="text" class="form-control"
                        name="name"
                        value="{{ old('name', $review->name) }}"
                        required>
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">
                        Email <span style="color:red">*</span>
                    </label>
                    <input type="email" class="form-control"
                        name="email"
                        value="{{ old('email', $review->email) }}"
                        required>
                </div>
            </div>

            <!-- Mobile -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">
                        Mobile Number <span style="color:red">*</span>
                    </label>
                    <input type="text" class="form-control"
                        name="mobile"
                        value="{{ old('mobile', $review->number) }}"
                        required>
                </div>
            </div>

            <!-- District -->
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">
                        Select District <span style="color:red">*</span>
                    </label>

                    <select class="form-control js-example-basic-single"
                        name="district_id" required>

                        <option value="">Select District</option>

                        @foreach ($district as $dis)
                            <option value="{{ $dis->id }}"
                                {{ $review->district_id == $dis->id ? 'selected' : '' }}>
                                {{ ucfirst($dis->name) }}
                            </option>
                        @endforeach

                    </select>
                </div>
            </div>

        </div>

        <div class="pl-lg-4 text-center mb-3" style="margin-right:85%;">
            <a href="{{ route('admin.review') }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </div>
</form>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
@stop
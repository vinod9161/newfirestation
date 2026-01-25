@extends('layouts.admin.template')

@section('title')
<title>Department - Review Officer </title>
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
<form action="{{ route('admin.reviewadd') }}" method="POST">
    @csrf
    <div class="body-box-admin tab-content card" style="padding:0px">
    <h2 class="text-center" style="background-color:#42425d;color:#ffffff">Add Review Officer Details</h2>
       <p class="note" style="margin-left:10px; color:red">Fields with <span class="required">*</span> are required.</p>
       <div class="row mt-3" style="padding: 0 30px 25px;">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                <label class="form-label"> Name <span class="required" style="color:red">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Review Officer Name" value="" required="">
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                <label class="form-label"> Email <span class="required" style="color:red">*</span></label>
                <input type="text" class="form-control" id="name" name="email" placeholder="Review Officer Email" value="" required="">
                </div>
            </div>


            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                <label class="form-label"> Mobile Number <span class="required" style="color:red">*</span></label>
                <input type="text" class="form-control" id="name" name="mobile" placeholder="Review Officer Mobile" value="" required="">
                </div>
            </div>


            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label"> Select District <span class="required" style="color:red">*</span></label>
                   
                     <select class="form-control js-example-basic-single"  name="district_id" id="district_id">
                        <option value="" disabled selected>Select District</option>
                        @foreach ($district as $dis)
                        <option value="{{ $dis->id }}">{{ ucfirst($dis->name) }} </option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>
        <div class="pl-lg-4 text-center mb-3" style="margin-right:85%;">
          <a href="" class="save-btn hover-btn btn btn-secondary">Back</a>
          <button class="save-btn hover-btn btn btn-primary" type="submit">Save</button>
       </div>
   </div>
</form>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
@stop
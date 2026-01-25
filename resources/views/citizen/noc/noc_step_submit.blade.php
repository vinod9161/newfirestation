@extends('layouts.citizen.template')
@section('content')
<style>
    .error {
        color: red;
    }
</style>

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4 mt-10"">
    <div>
        <h5 class=" main-content-title text-default fs-24 mg-b-4 mb-0 mt-10">Application Ready to Submit</h5>
    </div>
</div>
<!-- End Row -->
<div class="card custom-card" id="hori">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Basic Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Proprietary Details</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Area Details of Site</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Essential Provision</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Attachments</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active">Final Submit</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-wrap">
            <div class="progress mb-3 mt-3" role="progressbar" aria-valuenow="83.35" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 83.35%;">83.35%</div>
            </div>
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
            <br>
            <form  method="POST" enctype="multipart/form-data" action="{{route('noc.step.seven.post')}}" id="step_submit_form">
                @csrf
                <input type="hidden" name="pre_perational" id="pre_perational" value="{{$application[0]->pre_perational ?? ''}}">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <input type="hidden" id="application_no" name="application_no"  value="{{ $application[0]->application_no ?? ''}}">
                        <h3>Your Application No is (आपका आवेदन संख्या है) : {{ $application[0]->application_no ?? ''}} </h3>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-primary">Submit Application</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // Initialize form validation
        $('#step_submit_form').validate({
            errorPlacement: function(error, element) {
                // Place the error message after the label
                error.insertAfter(element.prev('label'));
            },
        });
    });
</script>
@stop
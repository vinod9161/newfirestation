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
        <h5 class=" main-content-title text-default fs-24 mg-b-4 mb-0 mt-10">Upload Payment Challan भुगतान किये गये चालान की प्रति अपलोड करें</h5>
</div>
</div>
<!-- End Row -->
<div class="card custom-card" id="hori">
    <div class="card-body">
        <div class="text-wrap">
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

            <form method="POST" enctype="multipart/form-data" action="{{route('noc.step.six.post')}}" id="step_payment_form">
                @csrf
                <h3 class="form-label" style="color:red;margin-bottom:20px;margin-top:10px;">Link for e-challan <a href="https://cts.uk.gov.in/e-chalan/elogin.aspx" target="_blank">https://cts.uk.gov.in/e-chalan/elogin.aspx</h3>
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Payment Challan<span class="span_required">*</span></label>
                            <input type="file" class="form-control" id="payment_challan" name="payment_challan" style="height: 36px;">
                            @if($errors->has('payment_challan'))
                            <div class="validation-error">{{ $errors->first('payment_challan') }}</div>
                            @endif
                        </div>
                    </div>

                    <input type="hidden" id="application_no" name="application_no" value="{{ $application[0]->application_no ?? ''}}">
                    <div class="col-lg-4 mt-3">
                        <button class="save-btn hover-btn btn btn-primary" type="submit" style="padding:5px">Upload</button>
                        @if(isset($application[0]->challan))
                        <a href="{{ asset($application[0]->challan)}}" target="blank" title="View Challan"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                        @endif
                    </div>
                </div>
                @if(isset($application[0]->challan))
                <div class="col-lg-12 text-right mt-3" style="position: absolute;bottom: 58px;left: 0;">
                    <a href="{{route('noc')}}" class="save-btn hover-btn btn btn-primary" style="margin-right:10px">Cancel</a>
                    <button class="save-btn hover-btn btn btn-primary" type="submit">Preview and Submit</button>
                </div>
                @endif
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
        $('#step_payment_form').validate({
            errorPlacement: function(error, element) {
                // Place the error message after the label
                error.insertAfter(element.prev('label'));
            },
        });
    });
</script>
@stop
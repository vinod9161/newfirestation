@extends('layouts.citizen.template')
@section('content')
<style>
    .error {
        color: red;
    }
</style>

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">Essential Provision आवश्यक प्राविधान:</h5>
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
                        <a class="nav-link active">Essential Provision</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Attachments</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Final Submit</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-wrap">
            <div class="progress mb-3 mt-3" role="progressbar" aria-valuenow="50.01" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 50.01%;">50.01%</div>
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

            <form action="{{route('noc.step.forth.post')}}" id="step_four_form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="body-box-admin">
                    <fieldset>
                        <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span>

                        <input type="hidden" name="pre_perational" id="pre_perational" value="{{$application[0]->pre_perational ?? ''}}">

                        <input type="hidden" id="application_no" name="application_no" value="{{ $application[0]->application_no ?? ''}}">

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Compartmentation कम्पार्टमेन्टेशन <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="compartmentation_yes" name="compartmentation" value="yes" checked>
                                        <label for="compartmentation_yes">Yes हाँ</label>
                                        <input type="radio" id="compartmentation_no" name="compartmentation" value="no">
                                        <label for="compartmentation_no">No नहीं</label>
                                    </div>
                                    @if($errors->has('compartmentation'))
                                    <div class="validation-error">{{ $errors->first('compartmentation') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No. of Stairs जीने की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_stairs" name="no_of_stairs" placeholder="No. of Stairs" value="{{json_decode($application[0]->ess_provision_detail)->no_of_stairs ?? old('no_of_stairs') ?? '' }}" required>
                                    @if($errors->has('no_of_stairs'))
                                    <div class="validation-error">{{ $errors->first('no_of_stairs') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Minimum Width of Stairs जीने की न्यूनतम चौड़ाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="width_of_stairs" name="width_of_stairs" placeholder="Minimum Width of Stairs" value="{{json_decode($application[0]->ess_provision_detail)->width_of_stairs ?? old('width_of_stairs') ?? '' }}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('width_of_stairs'))
                                    <div class="validation-error">{{ $errors->first('width_of_stairs') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Emergency Exit आपातकालीन निकास <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="emergency_yes" name="emergency_exit" value="yes" checked>
                                        <label for="emergency_yes">Yes हाँ</label>
                                        <input type="radio" id="emergency_no" name="emergency_exit" value="no">
                                        <label for="emergency_no">No नहीं</label>
                                    </div>
                                    @if($errors->has('emergency_exit'))
                                    <div class="validation-error">{{ $errors->first('emergency_exit') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Provision of lift लिफ्ट का प्राविधान<span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="provision_yes" name="provision_of_lift" value="yes" checked>
                                        <label for="provision_yes">Yes हाँ</label>
                                        <input type="radio" id="provision_no" name="provision_of_lift" value="no">
                                        <label for="provision_no">No नहीं</label>
                                    </div>
                                    @if($errors->has('provision_of_lift'))
                                    <div class="validation-error">{{ $errors->first('provision_of_lift') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Alternative Electric Supply वैकल्पिक विद्युत व्यवस्था <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="electric_suppy_yes" name="electric_suppy" value="yes" checked>
                                        <label for="electric_suppy_yes">Yes</label>
                                        <input type="radio" id="electric_suppy_no" name="electric_suppy" value="no">
                                        <label for="electric_suppy_no">No</label>
                                    </div>
                                    @if($errors->has('electric_suppy'))
                                    <div class="validation-error">{{ $errors->first('electric_suppy') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Emergency lighting system आपातकालीन प्रकाश व्यवस्था <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="emergency_lighting_yes" name="emergency_lighting_system" value="yes" checked>
                                        <label for="emergency_lighting_yes">Yes</label>
                                        <input type="radio" id="emergency_lighting_no" name="emergency_lighting_system" value="no">
                                        <label for="emergency_lighting_no">No</label>
                                    </div>
                                    @if($errors->has('emergency_lighting_system'))
                                    <div class="validation-error">{{ $errors->first('emergency_lighting_system') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Provision of Smoke / Fire check Doors धुँआ/फायर चैक डोर का प्राविधान <span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="provision_of_smoke_yes" name="provision_of_smoke" value="yes" checked>
                                        <label for="provision_of_smoke_yes">Yes हाँ</label>
                                        <input type="radio" id="provision_of_smoke_no" name="provision_of_smoke" value="no">
                                        <label for="provision_of_smoke_no">No नहीं </label>
                                    </div>
                                    @if($errors->has('provision_of_smoke'))
                                    <div class="validation-error">{{ $errors->first('provision_of_smoke') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-control-label" for="input-username">Refuge area in case of high-rise buildings बहुमंजिला इमारतों का मामले में शरणागत स्थल<span class="span_required">*</span></label>
                                    <div class="radio-toolbar">
                                        <input type="radio" id="refuse_area_yes" name="refuse_area" value="yes" checked>
                                        <label for="refuse_area_yes">Yes हाँ</label>
                                        <input type="radio" id="refuse_area_no" name="refuse_area" value="no">
                                        <label for="refuse_area_no">No नहीं</label>
                                    </div>
                                    @if($errors->has('refuse_area'))
                                    <div class="validation-error">{{ $errors->first('refuse_area') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Maximum Travel Distance in Building भवन में अधिकतम ट्रैवल डिस्टेन्स<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="travel_distance" name="travel_distance" placeholder="Maximum Travel Distance in Building" value="{{ json_decode($application[0]->ess_provision_detail)->travel_distance ?? old('travel_distance') ?? '' }}" step="any" pattern="^\d*(\.\d{0,2})?$">
                                    @if($errors->has('travel_distance'))
                                    <div class="validation-error">{{ $errors->first('travel_distance') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Other comment अन्य टिप्पणी<span class="span_required">*</span></label>
                                    <textarea class="form-control" id="other_comment" name="other_comment" placeholder="Write something here.." style="height:70px;">{{ json_decode($application[0]->ess_provision_detail)->other_comment ?? old('travel_distance') ?? '' }}</textarea>
                                    @if($errors->has('other_comment'))
                                    <div class="validation-error">{{ $errors->first('other_comment') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <div clas="row">
                        <div class="col-lg-12 text-right mt-3">
                            <a href="{{route('noc')}}" class="save-btn hover-btn btn btn-primary">Cancel</a>
                        </div>
                        <div class="col-lg-6 text-right mt-3">
                            <button class="save-btn hover-btn btn btn-primary" type="submit">Save and Next</button>
                        </div>
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
        $('#step_four_form').validate({
            errorPlacement: function(error, element) {
                // Place the error message after the label
                error.insertAfter(element.prev('label'));
            },
        });
    });
</script>
@stop
@extends('layouts.citizen.template')
@section('content')

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">Basic Details</h5>
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

            <form action="{{route('noc.step.third.post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="body-box-admin">
                    <fieldset>
                        <legend>Area Details of Site स्थल का क्षेत्र विवरण</legend>

                        <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span>

                        <input type="hidden" name="pre_perational" id="pre_perational" value="{{$application->pre_perational ?? ''}}">

                        <input type="hidden" id="application_no" name="application_no" value="{{ $application->application_no ?? ''}}">

                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Total Plot Area प्लॉट का कुल क्षेत्रफल<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="total_plot_area" name="total_plot_area" placeholder="Total Area" value="{{ json_decode($application->total_plot_area)->total_plot_area ?? old('total_plot_area') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('total_plot_area'))
                                    <div class="validation-error">{{ $errors->first('total_plot_area') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Total Covered Area कुल आच्छादित क्षेत्रफल<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="total_covered_area" name="total_covered_area" placeholder="Covered Area" value="{{ json_decode($application->total_covered_area)->total_covered_area ?? old('total_covered_area') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('total_covered_area'))
                                    <div class="validation-error">{{ $errors->first('total_covered_area') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Ground Floor Covered Area भू-तल का आच्छादित क्षेत्रफल<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="ground_floor_covered" name="ground_floor_covered" placeholder="Ground Floor Covered" value="{{ json_decode($application->ground_floor_covered)->ground_floor_covered ?? old('ground_floor_covered') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('ground_floor_covered'))
                                    <div class="validation-error">{{ $errors->first('ground_floor_covered') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Maximum height of Building भवन की अधिकतम ऊँचाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="max_height_building" name="max_height_building" placeholder="Ground Floor Covered" value="{{ json_decode($application->max_height_building)->max_height_building ?? old('max_height_building') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('max_height_building'))
                                    <div class="validation-error">{{ $errors->first('max_height_building') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Basement Covered Area भूमिगत तलों का आच्छादित क्षेत्रफल <span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="basement_covered_area" name="basement_covered_area" placeholder="Ground Floor Covered" value="{{ json_decode($application->basement_covered_area)->basement_covered_area ?? old('basement_covered_area') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('basement_covered_area'))
                                    <div class="validation-error">{{ $errors->first('basement_covered_area') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No. of Floors तलों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_floor" name="no_of_floor" placeholder="No. of Floors" value="{{ $application->no_of_floor ?? old('no_of_floor') ?? ''}}" required>
                                    @if($errors->has('no_of_floor'))
                                    <div class="validation-error">{{ $errors->first('no_of_floor') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No of Basement(s) भूमिगत तलों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_basement" name="no_of_basement" placeholder="No of Basement(s)" value="{{ $application->no_of_basement ?? old('no_of_basement') ?? ''}}" required>
                                    @if($errors->has('no_of_basement'))
                                    <div class="validation-error">{{ $errors->first('no_of_basement') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">No. of Blocks ब्लॉकों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="no_of_blocks" name="no_of_blocks" placeholder="No. of Blocks" value="{{ $application->no_of_blocks ?? old('no_of_blocks') ?? ''}}" required>
                                    @if($errors->has('no_of_blocks'))
                                    <div class="validation-error">{{ $errors->first('no_of_blocks') }}</div>
                                    @endif
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Height of Tallest Block सबसे ऊँचे ब्लॉक की ऊँचाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="height_of_tallest_block" name="height_of_tallest_block" placeholder="Height of Tallest Block" value="{{ json_decode($application->height_of_tallest_block)->height_of_tallest_block ?? old('height_of_tallest_block') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('height_of_tallest_block'))
                                    <div class="validation-error">{{ $errors->first('height_of_tallest_block') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Distance b/w Blocks ब्लॉकों के बीच की दूरी <span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="min_distance_block" name="min_distance_block" placeholder="Minimum Distance between Blocks" value="{{ json_decode($application->min_distance_block)->min_distance_block ?? old('min_distance_block') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('min_distance_block'))
                                    <div class="validation-error">{{ $errors->first('min_distance_block') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Approach Road width पहुँच मार्ग की चौड़ाई<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="approach_road_width" name="approach_road_width" placeholder="Approach Road width" value="{{ json_decode($application->approach_road_width)->approach_road_width ?? old('approach_road_width') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('approach_road_width'))
                                    <div class="validation-error">{{ $errors->first('approach_road_width') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Provision of no. of entrance प्रवेश द्वारों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="provision_no_enterance" name="provision_no_enterance" placeholder="Provision of no. of entrance" value="{{ $application->provision_no_enterance ?? old('provision_no_enterance') ?? ''}}" required>
                                    @if($errors->has('provision_no_enterance'))
                                    <div class="validation-error">{{ $errors->first('provision_no_enterance') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Provision of no. of exit निकास द्वारों की संख्या<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="provision_no_exit" name="provision_no_exit" placeholder="Provision of no. of exit" value="{{ $application->provision_no_exit ?? old('provision_no_exit') ?? ''}}" required>
                                    @if($errors->has('provision_no_exit'))
                                    <div class="validation-error">{{ $errors->first('provision_no_exit') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend>Set Back Details सैट बैक एरिया विवरण:</legend>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Front अग्र भाग<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="front" name="front" placeholder="Front" value="{{ json_decode($application->set_back_detail)->front ?? old('front') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('front'))
                                    <div class="validation-error">{{ $errors->first('front') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Rear पृष्ठ भाग<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="rear" name="rear" placeholder="Rear" value="{{ json_decode($application->set_back_detail)->rear ?? old('rear') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('rear'))
                                    <div class="validation-error">{{ $errors->first('rear') }}</div>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Side-1 पार्श्व-1<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="side1" name="side1" placeholder="Side-1" value="{{ json_decode($application->set_back_detail)->side1 ?? old('side1') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('side1'))
                                    <div class="validation-error">{{ $errors->first('side1') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="form-label">Side-2 पार्श्व-1<span class="span_required">*</span></label>
                                    <input type="number" class="form-control" id="side2" name="side2" placeholder="Side-2" value="{{ json_decode($application->set_back_detail)->side2 ?? old('side2') ?? ''}}" step="any" pattern="^\d*(\.\d{0,2})?$" required>
                                    @if($errors->has('side2'))
                                    <div class="validation-error">{{ $errors->first('side2') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <div class="col-lg-12 text-right mt-3">
                        <a href="{{route('admin.tehsil')}}" class="btn btn-sm btn-neutral">Cancel</a>
                        <button class="save-btn hover-btn btn btn-primary" type="submit">Save and Next</button>
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
<script>
    window.onload = function() {
        chooseRularUrban();
    };

    function chooseRularUrban() {
        var rular_urban = $("input[name='rural_urban']:checked").val();
        if (rular_urban == 'rural') {
            $("#plot1").prop('checked', true);
            $("#rular_div").slideToggle("slow", function() {
                $("#rular_div").show();
                $("#rular_div *").prop('disabled', false);
            });
            $("#urban_div").slideToggle("slow", function() {
                $("#urban_div").hide();
                $("#urban_div *").prop('disabled', true);
            });
        } else {
            $("#plot").prop('checked', true);
            $("#urban_div").slideToggle("slow", function() {
                $("#urban_div").show();
                $("#urban_div *").prop('disabled', false);
            });
            $("#rular_div").slideToggle("slow", function() {
                $("#rular_div").hide();
                $("#rular_div *").prop('disabled', true);
            });
        }
    }
</script>
@stop
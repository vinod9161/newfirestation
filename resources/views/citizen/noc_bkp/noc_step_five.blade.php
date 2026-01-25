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
            <div class="alert alert-danger" id="message" style="display:none;">
                {{ session('failed') }}
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{route('noc.step.five.post')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Reference Letter from Competent Authority सम्बन्धित प्राधिकरण का सन्दर्भ पत्र<span class="span_required">*</span></label>
                            <input type="file" class="form-control file" id="reference_letter" name="reference_letter" style="height: 36px;" required>
                            @if($errors->has('reference_letter'))
                            <div class="validation-error">{{ $errors->first('reference_letter') }}</div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" id="application_no" name="application_no" value="{{ $application->application_no ?? ''}}">
                    <div class="col-lg-4 mt-4">
                        <input type="hidden" name="letter_type" value="reference_letter">
                        <button class="save-btn hover-btn btn btn-primary" type="submit" style="padding:5px">Upload</button>
                        @if(json_decode($application->attachments) !='')
                        @if(isset(json_decode($application->attachments)->reference_letter))
                        <a href="{{ asset(json_decode($application->attachments)->reference_letter)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                        @endif
                        @endif
                    </div>
                </div>
            </form>
            <form method="POST" enctype="multipart/form-data" action="{{route('noc.step.five.post')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-8 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Proposed Map भवन का प्रस्तावित मानचित्र<span class="span_required" style="font-size:15px">*(map with Key, Site, Floor, Elevation, Terrace Plan with area Statement)</span></label>
                            <input type="file" class="form-control col-md-6 file" id="proposed_map" name="proposed_map" style="height: 36px;" required>
                            @if($errors->has('proposed_map'))
                            <div class="validation-error">{{ $errors->first('proposed_map') }}</div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" id="application_no" name="application_no" value="{{ $application->application_no ?? ''}}">
                    <div class="col-lg-4 mt-4">
                    <input type="hidden" name="letter_type" value="proposed_map">
                        <button class="save-btn hover-btn btn btn-primary" type="submit" style="padding:5px">Upload</button>
                        @if(json_decode($application->attachments) !='')
                        @if(isset(json_decode($application->attachments)->proposed_map))
                        <a href="{{ asset(json_decode($application->attachments)->proposed_map)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                        @endif
                        @endif
                    </div>
                </div>
            </form>
            <form method="POST" enctype="multipart/form-data" action="{{route('noc.step.five.post')}}">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Fire Plan with Fire legend फायर लीजेण्ड सहित फायर प्लान<span class="span_required">*</span></label>
                            <input type="file" class="form-control file" id="fire_plan" name="fire_plan" style="height: 36px;" required>
                            @if($errors->has('fire_plan'))
                            <div class="validation-error">{{ $errors->first('fire_plan') }}</div>
                            @endif
                        </div>
                    </div>
                    <input type="hidden" id="application_no" name="application_no" value="{{ $application->application_no ?? ''}}">
                    <div class="col-lg-4 mt-4">
                    <input type="hidden" name="letter_type" value="fire_plan">
                        <button class="save-btn hover-btn btn btn-primary" type="submit" style="padding:5px">Upload</button>
                        @if(json_decode($application->attachments) !='')
                        @if(isset(json_decode($application->attachments)->fire_plan))
                        <a href="{{ asset(json_decode($application->attachments)->fire_plan)}}" target="blank" title="View Reference Letter"><img src="{{ asset('assets/icon/pdf_icon.png')}}" class="img-reponsive" style="width:50px;margin-left: 20px;"></a>
                        @endif
                        @endif
                    </div>
                </div>
            </form>

            <div class="col-lg-12 text-right mt-3">
                <form method="POST" enctype="multipart/form-data" action="{{route('noc.step.six')}}">
                    @csrf
                    <input type="hidden" name="pre_perational" id="pre_perational" value="{{$application->pre_perational ?? ''}}">

                    @if(isset(json_decode($application->attachments)->reference_letter) && isset(json_decode($application->attachments)->proposed_map) && isset(json_decode($application->attachments)->fire_plan))
                    <input type="hidden" id="application_no" name="application_no" value="{{ $application->application_no ?? ''}}">
                    <a href="{{route('noc.step.first')}}" class="btn btn-sm btn-neutral">Cancel</a>
                    <button class="save-btn hover-btn btn btn-primary" type="submit">Proceed To Payment</button>
                    @endif
                </form>
            </div>
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
    $(document).ready(function(){
        $(document).on('change', '.file', function(){
            alert('hi');
            const file = event.target.files[0];
            const messageElement = document.getElementById('message');
            if (file)
            {
                if (file.type === 'application/pdf' || file.name.endsWith('.pdf'))
                {
                    document.getElementById('message').style.display = "none";
                    return true;
                }
                else
                {
                    document.getElementById('message').style.display = "block";
                    messageElement.textContent = 'The uploaded file is not a PDF. Please upload a valid PDF file.';
                }
            }
            else
            {
                messageElement.textContent = 'No file selected.';
            }
        });
    });
</script>
@stop
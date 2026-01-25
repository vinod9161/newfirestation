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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">Attachments आवश्यक दस्तावेज</h5>
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
                        <a class="nav-link active">Attachments</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link">Final Submit</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="text-wrap">
            <div class="progress mb-3 mt-3" role="progressbar" aria-valuenow="66.68" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar" style="width: 66.68%;">66.68%</div>
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
            <br>
            <div class="alert alert-danger" id="message" style="display:none;">
                {{ session('failed') }}
            </div>
            
            <div class="alert alert-success" id="successBlock" style="display:none;"></div>
            <div class="alert alert-danger" id="errorBlock" style="display:none;"></div>

            <form method="POST" enctype="multipart/form-data" id="step_five_form">
                @csrf
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Reference Letter from Competent Authority सम्बन्धित प्राधिकरण का सन्दर्भ पत्र<span class="span_required">*</span></label>
                            <input type="file" class="form-control file" id="reference_letter" name="reference_letter" style="height: 36px;" required>
                            @if($errors->has('reference_letter'))
                            <div class="validation-error">{{ $errors->first('reference_letter') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 mt-4">
                        <input type="hidden" id="application_no" name="application_no"  value="{{ $application[0]->application_no ?? ''}}">
                        <button class="save-btn hover-btn btn btn-primary check" id="referenceletter" type="button" style="padding:5px">Upload</button>
                        @if(json_decode($application[0]->attachments) !='')
                        @if(isset(json_decode($application[0]->attachments)->reference_letter))
                        <a href="{{ asset(json_decode($application[0]->attachments)->reference_letter)}}" target="blank" title="View Reference Letter"><i class="fa fa-download" style="font-size:25px;margin-left: 20px;"></i></a>
                        @endif
                        @endif
                    </div>
                </div>
            </form>
            <form  method="POST" enctype="multipart/form-data" action="">
                @csrf
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Proposed Map भवन का प्रस्तावित मानचित्र<span class="span_required">*(map with Key, Site, Floor, Elevation, Terrace Plan with area Statement)</span></label>
                            <input type="file" class="form-control col-md-6 file" id="proposed_map" name="proposed_map" style="height: 36px;" required>
                            @if($errors->has('proposed_map'))
                            <div class="validation-error">{{ $errors->first('proposed_map') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 mt-4">
                        <input type="hidden" id="application_no" name="application_no"  value="{{ $application[0]->application_no ?? ''}}">
                        <button class="save-btn hover-btn btn btn-primary check" id="proposedmap" type="button" style="padding:5px">Upload</button>
                        @if(json_decode($application[0]->attachments) !='')
                        @if(isset(json_decode($application[0]->attachments)->proposed_map))
                        <a href="{{ asset(json_decode($application[0]->attachments)->proposed_map)}}" target="blank" title="View Reference Letter"><i class="fa fa-download" style="font-size:25px;margin-left: 20px;"></i></a>
                        @endif
                        @endif
                    </div>
                </div>
            </form>
            <form  method="POST" enctype="multipart/form-data" action="">
                @csrf
                <div class="row">
                    <div class="col-md-10 col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label class="form-label">Fire Plan with Fire legend फायर लीजेण्ड सहित फायर प्लान<span class="span_required">*</span></label>
                            <input type="file" class="form-control" id="fire_plan" name="fire_plan" style="height: 36px;" required>
                            @if($errors->has('fire_plan'))
                            <div class="validation-error">{{ $errors->first('fire_plan') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 mt-4">
                        <input type="hidden" id="application_no" name="application_no"  value="{{ $application[0]->application_no ?? ''}}">
                        <button class="save-btn hover-btn btn btn-primary check" id="fireplan" type="button" style="padding:5px">Upload</button>
                        @if(json_decode($application[0]->attachments) !='')
                        @if(isset(json_decode($application[0]->attachments)->fire_plan))
                        <a href="{{ asset(json_decode($application[0]->attachments)->fire_plan)}}" target="blank" title="View Reference Letter"><i class="fa fa-download" style="font-size:25px;margin-left: 20px;"></i></a>
                        @endif
                        @endif
                    </div>
                </div>
            </form>
            <div class="col-lg-12 text-right mt-3">
                <form method="POST" enctype="multipart/form-data" action="{{route('noc.step.six')}}">
                    @csrf
                    <input type="hidden" name="pre_perational" id="pre_perational" value="{{$application[0]->pre_perational ?? ''}}">
                    @if(isset(json_decode($application[0]->attachments)->reference_letter) && isset(json_decode($application[0]->attachments)->proposed_map) && isset(json_decode($application[0]->attachments)->fire_plan))
                    <input type="hidden" id="application_no" name="application_no" value="{{ $application[0]->application_no ?? ''}}">
                    <div clas="row">
                        <div class="col-lg-12 text-right mt-3">
                            <a href="{{route('noc')}}" class="save-btn hover-btn btn btn-primary">Cancel</a>
                        </div>
                        <div class="col-lg-6 text-right mt-3">
                            <!-- <button class="save-btn hover-btn btn btn-primary" type="submit">Proceed To Payment</button> -->
                            <button class="save-btn hover-btn btn btn-primary" type="submit">Save and Next</button>
                        </div>
                    </div>
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
        $(document).on('click','#referenceletter', function(){
            addButtonDisabled("#referenceletter");
            let file = $('#reference_letter')[0].files[0];
            const _token = $('input[name="_token"]').val();
            const application_no = $('#application_no').val();
            const messageElement = document.getElementById('message');
            if(file)
            {
                if (file.type === 'application/pdf' || file.name.endsWith('.pdf'))
                {
                    var formData = new FormData();
                    formData.append('_token', _token);
                    formData.append('application_no', application_no);
                    formData.append('reference_letter', file);
                    $.ajax({
                        type: "POST",
                        url: "{{route('noc.step.five.post')}}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status == "1")
                            {
                                setTimeout(function () {
                                    removeButtonDisabled("#referenceletter","Upload");
                                    window.location.reload();
                                }, 2000);
                            }
                            else
                            {
                                $('#errorBlock').html("Something went wrong. Please try again.").show();
                            }
                        },
                    });
                }
                else
                {
                    messageElement.style.display = "block";
                    messageElement.textContent = 'The uploaded file is not a PDF. Please upload a valid PDF file.';
                    return false;
                }
            }
            else
            {
                messageElement.style.display = "block";
                messageElement.textContent = 'No file selected.';
                return false;
            }
        });
        $(document).on('click','#proposedmap', function(){
            addButtonDisabled("#proposedmap");
            let file = $('#proposed_map')[0].files[0];
            const _token = $('input[name="_token"]').val();
            const application_no = $('#application_no').val();
            const messageElement = document.getElementById('message');
            if(file)
            {
                if (file.type === 'application/pdf' || file.name.endsWith('.pdf'))
                {
                    var formData = new FormData();
                    formData.append('_token', _token);
                    formData.append('application_no', application_no);
                    formData.append('proposed_map', file);
                    $.ajax({
                        type: "POST",
                        url: "{{route('noc.step.five.post')}}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status == "1")
                            {
                                setTimeout(function () {
                                    removeButtonDisabled("#proposedmap","Upload");
                                    window.location.reload();
                                }, 2000);
                            }
                            else
                            {
                                $('#errorBlock').html("Something went wrong. Please try again.").show();
                            }
                        },
                    });
                }
                else
                {
                    messageElement.style.display = "block";
                    messageElement.textContent = 'The uploaded file is not a PDF. Please upload a valid PDF file.';
                    return false;
                }
            }
            else
            {
                messageElement.style.display = "block";
                messageElement.textContent = 'No file selected.';
                return false;
            }
        });
        $(document).on('click','#fireplan', function(){
            addButtonDisabled("#fireplan");
            let file = $('#fire_plan')[0].files[0];
            const _token = $('input[name="_token"]').val();
            const application_no = $('#application_no').val();
            const messageElement = document.getElementById('message');
            if(file)
            {
                if (file.type === 'application/pdf' || file.name.endsWith('.pdf'))
                {
                    var formData = new FormData();
                    formData.append('_token', _token);
                    formData.append('application_no', application_no);
                    formData.append('fire_plan', file);
                    $.ajax({
                        type: "POST",
                        url: "{{route('noc.step.five.post')}}",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            if (response.status == "1")
                            {
                                setTimeout(function () {
                                    removeButtonDisabled("#fireplan","Upload");
                                    window.location.reload();
                                }, 2000);
                            }
                            else
                            {
                                $('#errorBlock').html("Something went wrong. Please try again.").show();
                            }
                        },
                    });
                }
                else
                {
                    messageElement.style.display = "block";
                    messageElement.textContent = 'The uploaded file is not a PDF. Please upload a valid PDF file.';
                    return false;
                }
            }
            else
            {
                messageElement.style.display = "block";
                messageElement.textContent = 'No file selected.';
                return false;
            }
        });
    });
    
    function addButtonDisabled(bclass)
    {
        $(bclass).html('Please wait...');
        $(bclass).css('cursor','not-allowed');
        $(bclass).attr('disabled');
    }
    function removeButtonDisabled(bclass,text)
    {
        $(bclass).html(text);
        $(bclass).css('cursor','pointer');
        $(bclass).removeAttr('disabled');
    }
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
        // Initialize form validation
        $('#step_five_form').validate({
            errorPlacement: function(error, element) {
                // Place the error message after the label
                error.insertAfter(element.prev('label'));
            },
        });
    });
</script>
@stop
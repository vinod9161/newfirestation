@extends('layouts.admin.template')
@section('title')
<title>Fire Reports</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<style>
    .span_required {
        color: #ff0000;
    }

    .error {
        color: red;
    }

    .divborder {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        border-top: none;
    }

    input:required {
        display: block;
    }

    input,
    select,
    .form-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        background-clip: padding-box;
        border: 1px solid #acafb4;
        border-radius: 3px;
        /*        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;*/
    }

    input:focus,
    select:focus,
    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: none;
    }

    label {
        font-size: 12px;
    }
</style>
@endsection
@section('content')

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Rescue Reports</h5>
    </div>
</div>
<!-- End Row -->

<!-- Start::row-2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add New Rescue Report
                </div>
            </div>
            <div class="card-body">
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
                <form method="post" enctype="multipart/form-data" action="{{route('admin.saveRescueReport')}}">
                    @csrf
                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Rescue Report - General Details</div>
                        <p class="text-danger" style="margin-left: 10px;">Fields with * are required.</p>
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Annual Number वार्षिक संख्या<sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="255" name="rescue_report_no" id="rescue_report_no" type="number" placeholder="Report Number">
                                    <span class="error" id="error1"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Monthly Number मासिक संख्या <sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="255" name="monthly_no" id="monthly_no" type="number" placeholder="Monthly Number">
                                    <span class="error" id="error2"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>District जपपद <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="district_id" id="district_id" readonly>
                                        @foreach($districts as $index => $dist)
                                        <option {{ Auth::user()->district_id == $dist->id ? 'selected' : '' }} value="{{ $dist->id }}">{{ ucfirst($dist->name) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error" id="error3"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fire Station फायर स्टेशन <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="station_id" id="station_id" readonly="">
                                        @foreach($stations as $index => $stn)
                                        <option {{ Auth::user()->station_id == $dist->id ? 'selected' : '' }} value="{{ $stn->id }}">{{ ucfirst($stn->name) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error" id="error4"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date and Time of Rescue Incident अग्निकाण्ड का दिनांक एवं समय <sip class="text-danger">*</sup></label>
                                    <input class="form-control" type="datetime-local" id="rescue_incident_datetime" name="rescue_incident_datetime" value="" max="">
                                    <span class="error" id="error5"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Information Details सूचना का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name of Informer सूचना देने वाले का नाम<sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="225" name="informer_name" id="informer_name" type="text" placeholder="Name of Informer">
                                    <span class="error" id="error6"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Number of Informer सूचना देने वाले का सम्पर्क नम्बर <sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="255" name="informer_contact_no" id="informer_contact_no" type="number" placeholder="Contact Number of Informer">
                                    <span class="error" id="error7"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Medium of Information सूचना प्राप्ति का माधयम <sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="255" name="info_medium" id="info_medium" type="text" placeholder="Medium of Information">
                                    <span class="error" id="error8"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address of Incident Place घटनास्थल का पता <sup class="text-danger">*</sup></label>
                                    <input class="form-control" maxlength="512" name="incident_address" id="incident_address">
                                    <span class="error" id="error9"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date and Time of Information सूचना प्राप्ति का दिनांक एवं समय <sup class="text-danger">*</sup></label>
                                    <input class="form-control" type="datetime-local" id="info_datetime" name="info_datetime" value="" max="">
                                    <span class="error" id="error10"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Longitude <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" name="incident_longitude" id="incident_longitude">
                                    <span class="error" id="error11"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Latitude <sup class="text-danger">*</sup></label>
                                    <input type="text" class="form-control" name="incident_latitude" id="incident_latitude">
                                    <span class="error" id="error12"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Action Details कार्यवाही का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Departure Time from Rescue Station फायर स्टेशन से प्रस्थान का समय <sup class="text-dnager">*</sup></label>
                                    <input class="form-control" type="datetime-local" id="station_depart_datetime" name="station_depart_datetime" value="" max="">
                                    <span class="error" id="error13"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Arrival Time on Incident Place घटनास्थल पर पहुँचने का समय <sup class="text-dnager">*</sup></label>
                                    <input class="form-control" type="datetime-local" id="rescue_site_arrive_datetime" name="rescue_site_arrive_datetime" value="" max="">
                                    <span class="error" id="error14"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Return Time to Fire Station फायर स्टेशन पर वापसी का समय <sup class="text-dnager">*</sup></label>
                                    <input class="form-control" type="datetime-local" id="station_return_datetime" name="station_return_datetime" value="" max="">
                                    <span class="error" id="error15"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Distance of Incident Place from Fire Station फायर स्टेशन से घटनास्थल की दूरी (in KM eg. 10.255) <sup class="text-danger">*</sup></label>
                                    <input class="form-control" name="distance" id="distance" type="number" step="any" pattern="^\d*(\.\d{0,3})?$">
                                    <span class="error" id="error16"></span>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Fire Fighting Machine used अग्निशमन कार्य हेतु प्रयुक्त मशीनों का विवरण</div>

                        <div class="row" id="dynamicFields" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Details of Fire Fighting Machine used अग्निशमन कार्य हेतु प्रयुक्त मशीनों का विवरण <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="vehicle_id[]" id="vehicle_id">

                                        @foreach($vehicles as $index => $veh)
                                        <option value="{{ $veh['id'] }}">{{ ucfirst($veh['reg_number']) }}, {{ ucfirst($veh['vehicle_type']) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error" id="error17"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Pumping in KM <sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="255" name="pumping_km[]" id="pumping_km" type="number" placeholder="Pumping in KM">
                                    <span class="error" id="error18"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a class="btn btn-primary add_field_button" id="add_field_button" style="margin-top:27px;"> + Add More Fields</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Fire Service Personals on Incident Place घटनास्थल पर फायर सर्विस कार्मिकों का विवरण</div>
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CFO</label>
                                    <select class="form-control js-example-basic-multiple" name="cfo[]" id="cfo" multiple="multiple">
                                        @foreach($cfo as $index => $cf)
                                        <option value="{{ $cf->name }}">{{ ucfirst($cf->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>FSO</label>
                                    <select class="form-control js-example-basic-multiple" name="fso[]" id="fso" multiple="multiple">
                                        @foreach($fso as $index => $fs)
                                        <option value="{{ $fs->name }}">{{ ucfirst($fs->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>FSSO</label>
                                    <select class="form-control js-example-basic-multiple" name="fsso[]" id="fsso" multiple="multiple">
                                        @foreach($fsso as $index => $fss)
                                        <option value="{{ $fss->name }}">{{ ucfirst($fss->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>LFM</label>
                                    <select class="form-control js-example-basic-multiple" name="lfm[]" id="lfm" multiple="multiple">
                                        @foreach($lfm as $index => $lm)
                                        <option value="{{ $lm->name }}">{{ ucfirst($lm->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>DVR</label>
                                    <select class="form-control js-example-basic-multiple" name="dvr[]" id="dvr" multiple="multiple">
                                        @foreach($dvr as $index => $dv)
                                        <option value="{{ $dv->name }}">{{ ucfirst($dv->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>FM</label>
                                    <select class="form-control js-example-basic-multiple" name="fm[]" id="fm" multiple="multiple">
                                        @foreach($fm as $index => $f)
                                        <option value="{{ $f->name }}">{{ ucfirst($f->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Rescue Operation Details रेस्क्यू ऑपरेशन का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Area of Rescue रेस्क्यू का क्षेत्र <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="rescue_area" id="rescue_area">
                                        <option value="1">Rural ग्रामीण</option>
                                        <option value="2">City शहरी</option>
                                    </select>
                                    <span class="error" id="error19"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type of Rescue Area रेस्क्यू क्षेत्र का प्रकार<sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="rescue_area_type" id="rescue_area_type">
                                        <option value="1">Disaster आपदा</option>
                                        <option value="2">Earth Quick भूकम्प</option>
                                        <option value="3">Land Slide भूस्खलन</option>
                                        <option value="4">Flood बाढ़</option>
                                        <option value="5">Road Accident सड़क दुर्घटना</option>
                                        <option value="6">Building Colipase भवन धंसना</option>
                                        <option value="7">Gas Leak गैस लीकेज</option>
                                        <option value="8">Patient मरीज</option>
                                        <option value="9">Rescue of Animal/Bird पशु पक्षियों का रेस्क्यू</option>
                                        <option value="10">Other अन्य</option>
                                    </select>
                                    <span class="error" id="error20"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Insured बीमित: Yes हाँ or No नहीं <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="insured" id="insured">
                                        <option value="0">Not known</option>
                                        <option value="1">No</option>
                                        <option value="2">Yes</option>
                                    </select>
                                    <span class="error" id="error21"></span>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Reason of Rescue घटना का कारण <sup class="text-danger">*</sup></label>
                                    <input class="form-control" maxlength="1000" name="rescue_reason" id="rescue_reason">
                                    <span class="error" id="error22"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Loss Details / क्षति विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Life Lost Human मनुष्य मरे</label>
                                    <input class="form-control" size="60" maxlength="255" name="life_lost_human" id="life_lost_human" type="number" placeholder="Life Lost Human" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Life Saved Human मनुष्य बचाये</label>
                                    <input class="form-control" size="60" maxlength="255" name="life_saved_human" id="life_saved_human" type="number" placeholder="Life Saved Human" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Life Lost Animal पशु मरे</label>
                                    <input class="form-control" size="60" maxlength="255" name="life_lost_animal" id="life_lost_animal" type="number" placeholder="Life Lost Animal" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Life Saved Animal पशु बचाये</label>
                                    <input class="form-control" size="60" maxlength="255" name="life_saved_animal" id="life_saved_animal" type="number" placeholder="Life Saved Animal" />
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Description विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Description विवरण <sup class="text-danger">*</sup></label>
                                    <textarea class="form-control" maxlength="1000" name="description" id="description" style="height:50px;"></textarea>
                                    <span class="error" id="error23"></span>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Upload Report</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Upload New File </label>
                                    <input id="ytupload" type="hidden" value="" name="upload" />
                                    <input class="form-control" name="upload_file" id="upload_file" type="file">
                                </div>
                            </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12" align="center">
                            <button type="submit" id="submitButton" class="btn btn-primary w-30" style="width:30%">Create Report</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
    $(document).ready(function() {

        var i = 1;

        $('#add_field_button').click(function(e) {
            e.preventDefault();
            i++;
            $('#dynamicFields').append(`
                <div class="row" id="row${i}" style="padding-left: 10px; padding-right: 10px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Details of Fire Fighting Machine used अग्निशमन कार्य हेतु प्रयुक्त मशीनों का विवरण
                                <sup class="text-danger">*</sup>
                            </label>
                            <select class="form-control js-example-basic-single" name="vehicle_id[]">
                                @foreach($vehicles as $index => $veh)
                                <option value="{{ $veh['id'] }}">{{ ucfirst($veh['reg_number']) }}, {{ ucfirst($veh['vehicle_type']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Pumping in KM<sup class="text-danger">*</sup></label>
                            <input class="form-control" size="60" maxlength="255" name="pumping_km[]" type="number" placeholder="Pumping in KM">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <a class="btn btn-danger btn_remove" id="${i}" style="margin-top:27px;"> - Remove Fields</a>
                        </div>
                    </div>
                </div>
            `);
            $('.js-example-basic-single').select2();
        });


        $(document).on('click', '.btn_remove', function(e) {
            e.preventDefault();
            var button_id = $(this).attr("id");
            $('#row' + button_id).remove();
        });

        $('.js-example-basic-multiple').select2();
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#submitButton', function(event) {
            const _token = $('input[name="_token"]').val();
            const rescue_report_no = $('#rescue_report_no').val();
            const monthly_no = $('#monthly_no').val();
            const district_id = $('#district_id').val();
            const station_id = $('#station_id').val();
            const rescue_incident_datetime = $('#rescue_incident_datetime').val();
            const informer_name = $('#informer_name').val();
            const informer_contact_no = $('#informer_contact_no').val();
            const info_medium = $('#info_medium').val();
            const incident_address = $('#incident_address').val();
            const info_datetime = $('#info_datetime').val();
            const station_depart_datetime = $('#station_depart_datetime').val();
            const rescue_site_arrive_datetime = $('#rescue_site_arrive_datetime').val();
            const station_return_datetime = $('#station_return_datetime').val();
            const distance = $('#distance').val();
            const vehicle_id = $('#vehicle_id').val();
            const pumping_km = $('#pumping_km').val();
            const cfo = $('#cfo').val();
            const fso = $('#fso').val();
            const fsso = $('#fsso').val();
            const lfm = $('#lfm').val();
            const dvr = $('#dvr').val();
            const fm = $('#fm').val();
            const rescue_area = $('#rescue_area').val();
            const rescue_area_type = $('#rescue_area_type').val();
            const insured = $('#insured').val();
            const rescue_reason = $('#rescue_reason').val();
            const life_lost_human = $('#life_lost_human').val();
            const life_saved_human = $('#life_saved_human').val();
            const life_lost_animal = $('#life_lost_animal').val();
            const life_saved_animal = $('#life_saved_animal').val();
            const description = $('#description').val();
            const incident_longitude = $('#incident_longitude').val();
            const incident_latitude = $('#incident_latitude').val();
            const upload_file = $('#upload_file')[0].files[0];

            function validateField(field, errorId) {
                if (!field) {
                    $('#' + errorId).html("This field is required.");
                    const errorElement = document.getElementById(errorId);
                    if (errorElement) {
                        errorElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        errorElement.focus();
                    }
                    return false;
                } else {
                    return true;
                }
            }
            const fieldsToValidate = [{
                    field: rescue_report_no,
                    errorId: 'error1'
                },
                {
                    field: monthly_no,
                    errorId: 'error2'
                },
                {
                    field: district_id,
                    errorId: 'error3'
                },
                {
                    field: station_id,
                    errorId: 'error4'
                },
                {
                    field: rescue_incident_datetime,
                    errorId: 'error5'
                },
                {
                    field: informer_name,
                    errorId: 'error6'
                },
                {
                    field: informer_contact_no,
                    errorId: 'error7'
                },
                {
                    field: info_medium,
                    errorId: 'error8'
                },
                {
                    field: incident_address,
                    errorId: 'error9'
                },
                {
                    field: info_datetime,
                    errorId: 'error10'
                },
                {
                    field: incident_longitude,
                    errorId: 'error11'
                },
                {
                    field: incident_latitude,
                    errorId: 'error12'
                },
                {
                    field: station_depart_datetime,
                    errorId: 'error13'
                },
                {
                    field: rescue_site_arrive_datetime,
                    errorId: 'error14'
                },
                {
                    field: station_return_datetime,
                    errorId: 'error15'
                },
                {
                    field: distance,
                    errorId: 'error16'
                },
                {
                    field: vehicle_id,
                    errorId: 'error17'
                },
                {
                    field: pumping_km,
                    errorId: 'error18'
                },
                {
                    field: rescue_area,
                    errorId: 'error19'
                },
                {
                    field: rescue_area_type,
                    errorId: 'error20'
                },
                {
                    field: insured,
                    errorId: 'error21'
                },
                {
                    field: rescue_reason,
                    errorId: 'error22'
                },
                {
                    field: short_description,
                    errorId: 'error23'
                }
            ];
            fieldsToValidate.forEach(({
                errorId
            }) => $('#' + errorId).html(""));
            const isValid = fieldsToValidate.every(({
                field,
                errorId
            }) => validateField(field, errorId));
            if (!isValid) {
                return false;
            }
        });
    });
</script>
@stop
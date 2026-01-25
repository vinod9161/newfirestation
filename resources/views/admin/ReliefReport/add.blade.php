@extends('layouts.admin.template')
@section('title')
<title>Relief Reports</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<style>
    .divborder {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        border-top: none;
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
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
    .error 
    {
        color:red;
    }
</style>
@endsection
@section('content')

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Relief Reports</h5>
    </div>
</div>
<!-- End Row -->

<!-- Start::row-2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add New Relief Report
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
                <form method="post" enctype="multipart/form-data" action="{{ route('admin.saveReliefReport') }}">
                    @csrf
                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Relief Report-General Details राहत कार्य- सामान्य विवरण</div>
                        <p class="text-danger" style="margin-left: 10px;">Fields with * are required.</p>
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label required" for="relief_report_no">Annual Number वार्षिक संख्या <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="relief_report_no" id="relief_report_no" type="number"/>
                                    <span class="error" id="error1"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label required" for="monthly_no">Monthly Number मासिक संख्या<span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="monthly_no" id="monthly_no" type="number"/>
                                    <span class="error" id="error2"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label required" for="district_id">District जनपद <span class="required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="district_id" id="district_id" readonly required>
                                        @foreach($districts as $index => $dist)
                                        <option {{ Auth::user()->district_id == $dist->id ? 'selected' : '' }} value="{{ $dist->id }}">{{ ucfirst($dist->name) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error" id="error3"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label required" for="fire_station_id">Fire Station फायर स्टेशन <span class="required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="station_id" id="station_id" readonly required>
                                        @foreach($stations as $index => $stn)
                                        <option {{ Auth::user()->station_id == $dist->id ? 'selected' : '' }} value="{{ $stn->id }}">{{ ucfirst($stn->name) }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error" id="error4"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label required" for="incident_datetime">Date and Time of Relief Work Incident राहत कार्य हेतु घटना का दिनांक एवं समय<span class="required">*</span></label>
                                    <input class="form-control" name="incident_datetime" id="incident_datetime" type="datetime-local"/>
                                    <span class="error" id="error5"></span>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Information Details सूचना का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="informer_name">Name of Informer सूचना देने वाले का नाम <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="225" name="informer_name" id="informer_name" type="text"/>
                                    <span class="error" id="error6"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="informer_contact_no">Contact Number of Informer सूचना देने वाले का सम्पर्क नं0 <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="informer_contact_no" id="informer_contact_no" type="number"/>
                                    <span class="error" id="error7"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="info_medium">Medium of Information सूचना प्राप्ति का माध्यम <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="info_medium" id="info_medium" type="text"/>
                                    <span class="error" id="error8"></span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="info_datetime">Date and Time of Information सूचना प्राप्ति का दिनांक एवं समय <span class="required">*</span></label>
                                    <input class="form-control" name="info_datetime" id="info_datetime" type="datetime-local"/>
                                    <span class="error" id="error9"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required" for="incident_address">Address of Incident Place राहत कार्य स्थल का पता <span class="required">*</span></label>
                                    <textarea class="form-control" maxlength="512" name="incident_address" id="incident_address" style="height:50px;" required></textarea>
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
                        <div class="col-md-12 alert alert-dark text-center card-title">Action Details कार्वाही का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="station_depart_datetime">Departure Date and Time from Fire Station फायर स्टेशम से प्रस्थान का समय <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="station_depart_datetime" id="station_depart_datetime" type="datetime-local" />     
                                    <span class="error" id="error13"></span>   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="site_arrive_datetime">Arrival Date and Time on Incident Place घटनास्थल पर पहुँचने का समय <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="site_arrive_datetime" id="site_arrive_datetime" type="datetime-local" />     
                                    <span class="error" id="error14"></span>   
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="station_return_datetime">Return Date and Time to Fire Station फायर स्टेशन पर वापसी का समय <span class="required">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="station_return_datetime" id="station_return_datetime" type="datetime-local" />     
                                    <span class="error" id="error15"></span>   
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="control-label required" for="distance">Distance of incident place from Fire station घटनास्थल की फायर स्टेशन से दूरी <span class="required">*</span></label>
                                    <input class="form-control" name="distance" id="distance" type="number" step="any" pattern="^\d*(\.\d{0,3})?$" />     
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
                                    <select class="form-control" name="vehicle_id[]" id="vehicle_id" required>
                                        <option value="">Select Fighting Machine </option>
                                        @foreach ($vehicles as $veh)
                                        <option value="{{ ucfirst($veh['id']) }}">{{ ucfirst($veh['reg_number']) }}, {{ ucfirst($veh['vehicle_type']) }} </option>
                                        @endforeach
                                    </select>     
                                    <span class="error" id="error17"></span>   
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Pumping in KM <sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="255" name="pumping_km[]" id="pumping_km" type="number" placeholder="Pumping in KM" required="">     
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
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Fire Service Personals in Relief Work राहत कार्य में फायर सर्विस कारमिकों का विवरण</div>

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
                                    <label>FSO </label>
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
                                    <label>LFM </label>
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
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Relief Work</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label" for="owner_name">Name of the owner/Occupier of property (if any) स्वामी/अधिभोगी का नाम (यदि हो)</label>
                                    <input class="form-control" size="60" maxlength="225" name="owner_name" id="owner_name" type="text" />     
                                    <span class="error" id="error19"></span>   
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label required" for="relief_work_area">Area of Relief Work राहत कार्य का क्षेत्र <span class="required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="relief_work_area" id="relief_work_area">
                                        <option value="1">Rural ग्रामीण</option>
                                        <option value="2">City शहरी</option>
                                    </select>    
                                    <span class="error" id="error20"></span>   
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="control-label required" for="relief_work_type">Type of Relief Work राहत कार्य का प्रकार <span class="required">*</span></label>
                                    <select class="form-control js-example-basic-single" name="relief_work_type" id="relief_work_type">
                                        <option value="1">Disaster Dewatering आपदा में पानी निकलना</option>
                                        <option value="2">Removing Fallen tree गिरे पेड़ो को हटाना</option>
                                        <option value="3">Clear the passage पेड़ो को हटाकर रास्ता सुचारू करना</option>
                                        <option value="4">Distribution of relief goods राहत सामग्री का वितरण</option>
                                        <option value="5">Organising a public kitchen आम जनता हेतु भोजन प्रबन्धन</option>
                                        <option value="6">Distribution of medicine आवश्यक दवाइयों का वितरण</option>
                                        <option value="7">Counseling of victims घायलों की काउंसलिंग </option>
                                        <option value="8">Safely evacuation of people from denger zone जोन में लोगों को सुरक्षित पार कराना</option>
                                        <option value="9">Other अन्य</option>
                                    </select>    
                                    <span class="error" id="error21"></span>   
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label" for="owner_address">Address of the owner/Occupier of property (if any) स्वामी/अधिभोगी का पता (यदि हो)</label>
                                    <textarea class="form-control" maxlength="512" name="owner_address" id="owner_address" style="height:50px;"></textarea>    
                                    <span class="error" id="error22"></span>   
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label required" for="relief_work_reason">Reason of Relief Work <span class="required">*</span></label>
                                    <textarea class="form-control" maxlength="1000" name="relief_work_reason" id="relief_work_reason" style="height:50px;"></textarea>    
                                    <span class="error" id="error23"></span>   
                                </div>
                            </div>
                            <!-- <div class="col-md-4">
                          <div class="form-group">
                             <label class="control-label required" for="arson_based">Was it arson based? क्या जान-बूझकर किया गया <span class="required">*</span></label>      
                             <select class="form-control" name="arson_based" id="arson_based" >
                                <option value="0">Not known</option>
                                <option value="1">No</option>
                                <option value="2">Yes</option>
                             </select>
                          </div>
                       </div> -->
                        </div>

                    </div>




                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Description विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label class="control-label required" for="description"> Description विवरण <span class="required">*</span></label>
                                    <textarea class="form-control" maxlength="1000" name="description" id="description" style="height:50px;"></textarea>    
                                    <span class="error" id="error24"></span>   
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Upload Report</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label>Upload New File</label>
                                    <input id="ytupload" type="hidden" value="" name="upload" />
                                    <input class="form-control" name="upload_file" id="upload" type="file" />
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
                            <select class="form-control js-example-basic-single" name="vehicle_id[]" required="">
                                @foreach($vehicles as $index => $veh)
                                <option value="{{ $veh['id'] }}">{{ ucfirst($veh['reg_number']) }}, {{ ucfirst($veh['vehicle_type']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Pumping in KM<sup class="text-danger">*</sup></label>
                            <input class="form-control" size="60" maxlength="255" name="pumping_km[]" type="number" placeholder="Pumping in KM" required="">
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
            const relief_report_no = $('#relief_report_no').val();
            const monthly_no = $('#monthly_no').val();
            const district_id = $('#district_id').val();
            const station_id = $('#station_id').val();
            const incident_datetime = $('#incident_datetime').val();
            const informer_name = $('#informer_name').val();
            const informer_contact_no = $('#informer_contact_no').val();
            const info_medium = $('#info_medium').val();
            const info_datetime = $('#info_datetime').val();
            const incident_address = $('#incident_address').val();
            const incident_longitude = $('#incident_longitude').val();
            const incident_latitude = $('#incident_latitude').val();
            const station_depart_datetime = $('#station_depart_datetime').val();
            const site_arrive_datetime = $('#site_arrive_datetime').val();
            const station_return_datetime = $('#station_return_datetime').val();
            const distance = $('#distance').val();
            const vehicle_id = $('#vehicle_id').val();
            const pumping_km = $('#pumping_km').val();
            const owner_name = $('#owner_name').val();
            const relief_work_area = $('#relief_work_area').val();
            const relief_work_type = $('#relief_work_type').val();
            const owner_address = $('#owner_address').val();
            const relief_work_reason = $('#relief_work_reason').val();
            const description = $('#description').val();

            function validateField(field, errorId)
            {
                if (!field) {
                    $('#' + errorId).html("This field is required.");
                    const errorElement = document.getElementById(errorId);
                    if (errorElement) {
                        errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        errorElement.focus();
                    }
                    return false;
                }
                else
                {
                    return true;
                }
            }
            const fieldsToValidate = [
                { field: relief_report_no, errorId: 'error1' },
                { field: monthly_no, errorId: 'error2' },
                { field: district_id, errorId: 'error3' },
                { field: station_id, errorId: 'error4' },
                { field: incident_datetime, errorId: 'error5' },
                { field: informer_name, errorId: 'error6' },
                { field: informer_contact_no, errorId: 'error7' },
                { field: info_medium, errorId: 'error8' },
                { field: info_datetime, errorId: 'error9' },
                { field: incident_address, errorId: 'error10' },
                { field: incident_longitude, errorId: 'error11' },
                { field: incident_latitude, errorId: 'error12' },
                { field: station_depart_datetime, errorId: 'error13' },
                { field: site_arrive_datetime, errorId: 'error14' },
                { field: station_return_datetime, errorId: 'error15' },
                { field: distance, errorId: 'error16' },
                { field: vehicle_id, errorId: 'error17' },
                { field: pumping_km , errorId: 'error18' },
                { field: owner_name, errorId: 'error19' },
                { field: relief_work_area, errorId: 'error20' },
                { field: relief_work_type, errorId: 'error21' },
                { field: owner_address, errorId: 'error22' },
                { field: relief_work_reason, errorId: 'error23' },
                { field: description, errorId: 'error24' },
            ];
            fieldsToValidate.forEach(({ errorId }) => $('#' + errorId).html(""));
            const isValid = fieldsToValidate.every(({ field, errorId }) => validateField(field, errorId));
            if (!isValid)
            {
                return false;
            }
        });
    });
</script>


@stop
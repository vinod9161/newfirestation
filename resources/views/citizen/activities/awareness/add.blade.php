@extends('layouts.citizen.template')
@section('title')
<title>Awareness | Citizen Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
label {
    font-size: 12px;
}
</style>


<style>
    #otpInputs {
        display: flex;
        gap: 6px;
        justify-content: center;
    }

    .otp-input {
        width: 38px;
        height: 42px;
        text-align: center;
        font-size: 18px;
        padding: 0;
        border-radius: 4px;
    }

    #timerCircle svg {
        transform: rotate(-90deg);
    }

    .circle {
        stroke-linecap: round;
        transition: stroke-dasharray 1s linear;
    }
</style>
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Public Awareness Program Request</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('citizen.awareness');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Public Awareness Program List
            </a>
        </div>
    </div>
</div>

<!-- Start::row-2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add Public Awareness Program Details
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

                    

                    <div class="col-md-12">
                         <div class="toaster"></div>
                        <div id='addFormDiv'>
                            <form method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" value="{{ $unique_no }}" name="application_id">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Type of program कार्यक्रम का प्रकार <sup
                                                    class="text-danger">*</sup></label>
                                            <select name="program_type" id="program_type"
                                                class="form-control js-example-basic-single">
                                                <option value="">--- Select Type of program ---</option>
                                                <option value="awareness program"> Awareness Program जन-जागरूकता
                                                    कार्यक्रम
                                                </option>
                                                <option value="mock drills">Mock Drills मॉक ड्रिल</option>
                                                <option value="talk on show">Talk on show चर्चा </option>
                                                <option value="seminar">Seminar गोष्ठी </option>
                                                <option value="conference">Conference सम्मेलन</option>
                                                <option value="Other">Other</option>
                                            </select>
                                            <span class="text-danger" id="error_1"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name of the person/institution व्यक्ति अथवा संस्था का नाम <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                value="{{ Auth::user()->building_name }}">
                                            <span class="text-danger" id="error_2"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Address पता <sup class="text-danger">*</sup></label>
                                            <input type="text" name="address" id="address" class="form-control"
                                                value="{{ Auth::user()->address }}">
                                            <span class="text-danger" id="error_3"></span>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>District जनपद <sup class="text-danger">*</sup></label>
                                            <select name="district_id" id="district_id"
                                                class="form-control js-example-basic-single">
                                                <option value="">--- Select District ---</option>
                                                @foreach($district as $index => $dist)
                                                <option value="{{ $dist->id }}" @if($dist->id ==
                                                    Auth::user()->district_id)
                                                    selected @endif>{{ $dist->name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="text-danger" id="error_4"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Email Address ई-मेल <sup class="text-danger">*</sup></label>
                                            <input type="text" name="email" id="email" class="form-control"
                                                value="{{ Auth::user()->email }}">
                                            <span class="text-danger" id="error_5"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Your Mobile Number मोबाइल नं0 <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="text" name="mobile_no" id="mobile_no" class="form-control"
                                                value="{{ Auth::user()->number }}">
                                            <span class="text-danger" id="error_6"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact person सम्पर्क हेतु व्यक्ति <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="text" name="contact_person" id="contact_person"
                                                class="form-control" placeholder="Enter Contact person">
                                            <span class="text-danger" id="error_7"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Proposed date and time प्रस्तावित तिथि एवं समय <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="date" name="program_datetime" id="program_datetime"
                                                class="form-control" placeholder="Enter Type">
                                            <span class="text-danger" id="error_8"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Expected gathering अनुमानित भीड़ <sup
                                                    class="text-danger">*</sup></label>
                                            <input type="number" name="crowd_size" id="crowd_size" class="form-control"
                                                placeholder="Enter Expected gathering">
                                            <span class="text-danger" id="error_9"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Address <sup class="text-danger">*</sup></label>
                                            <input type="text" name="google_address" id="google_address"
                                                class="form-control" placeholder="Enter Address">
                                            <span class="text-danger" id="error_10"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Latitude <sup class="text-danger">*</sup></label>
                                            <input type="text" name="latitude" id="latitude" class="form-control"
                                                placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Longitude <sup class="text-danger">*</sup></label>
                                            <input type="text" name="longitude" id="longitude" class="form-control"
                                                placeholder="" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <button type="button" id="addAwareness" class="btn btn-primary btn-sm"
                                            style="width:20%">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>






                        <div class="col-md-12" id="otpVerifydiv" style="display:none; margin-bottom:50px;">
                           
                            <div class="col-md-7" style="margin:0 auto">
                                <form id="OtpPostverify" method="post">
                                    @csrf
                                    <div class="col-md-8" style="margin:0 auto; max-width:360px">
                                        <label>Verify OTP</label>
                                        <div id="otpInputs" class="d-flex justify-content-between mb-2">
                                            <input type="text" maxlength="1" class="form-control otp-input"
                                                name="optinput0" id="optinput0" />
                                            <input type="text" maxlength="1" class="form-control otp-input"
                                                name="optinput1" id="optinput1" />
                                            <input type="text" maxlength="1" class="form-control otp-input"
                                                name="optinput2" id="optinput2" />
                                            <input type="text" maxlength="1" class="form-control otp-input"
                                                name="optinput3" id="optinput3" />
                                            <input type="text" maxlength="1" class="form-control otp-input"
                                                name="optinput4" id="optinput4" />
                                            <input type="text" maxlength="1" class="form-control otp-input"
                                                name="optinput5" id="optinput5" />
                                        </div>

                                        <span class="text-danger" id="otp_error"></span>

                                        <!-- Timer with loader -->
                                        <div class="d-flex align-items-center mb-2">
                                            <div id="timerCircle" class="me-2">
                                                <svg width="24" height="24" viewBox="0 0 36 36">
                                                    <path class="circle-bg" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee"
                                                        stroke-width="2" />
                                                    <path id="circleProgress" class="circle" d="M18 2.0845
                                                a 15.9155 15.9155 0 0 1 0 31.831
                                                a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#dc3545"
                                                        stroke-width="2" stroke-dasharray="100, 100" />
                                                </svg>
                                            </div>
                                            <div id="otpTimer" class="text-muted">Time remaining: 03:00</div>
                                        </div>
                                        <input type="text" class="form-control" name="otpMobile" id="otpMobile">
                                        <button type="submit" class="btn btn-primary w-100">Verify</button>
                                        <!-- <div class="text-center mt-2">
                                            <a href="javascript:void(0);" id="resendOtpLink" class="text-danger fw-bold">Resend
                                                OTP</a>
                                            <span id="resendTimer" class="text-muted ms-2"></span>
                                        </div> -->
                                            <a  href="javascript:void(0);" id="resendOtpLink">Resend OTP</a>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script>
    $(document).ready(function () {
        const $timerDisplay = $('#otpTimer');
        const $resendLink = $('#resendOtpLink');
        const $resendTimer = $('#resendTimer');
        const $progressCircle = $('#circleProgress');

        let totalTime = 180;
        let timeLeft = totalTime;
        let timer;

        function updateProgress() {
            const percent = (timeLeft / totalTime);
            const dash = percent * 100;
            $progressCircle.attr('stroke-dasharray', `${dash}, 100`);
        }

        function startTimer() {
            clearInterval(timer);
            timeLeft = totalTime;

            $resendLink.css({ 'pointer-events': 'none', 'opacity': 0.5 });
            $resendTimer.text('');
            updateProgress();

            timer = setInterval(function () {
                if (timeLeft <= 0) {
                    clearInterval(timer);
                    $timerDisplay.text('OTP expired.');
                    $progressCircle.attr('stroke-dasharray', '0, 100');
                    $resendLink.css({ 'pointer-events': 'auto', 'opacity': 1 });
                    $resendTimer.text('(Click to resend)');
                } else {
                    const minutes = Math.floor(timeLeft / 60).toString().padStart(2, '0');
                    const seconds = (timeLeft % 60).toString().padStart(2, '0');
                    $timerDisplay.text(`Time remaining: ${minutes}:${seconds}`);
                    updateProgress();
                    timeLeft--;
                }
            }, 1000);
        }

        $resendLink.on('click', function () {
            alert("OTP resent!");
            startTimer();
        });

        startTimer();
    });
</script>
<script>



// form validation

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', '#addAwareness', function(e) {
        e.preventDefault();
        const formData = {
            _token: $('input[name="_token"]').val(),
            program_type: $('select[name="program_type"]').val()?.trim() || '',
            name: $('input[name="name"]').val()?.trim() || '',
            address: $('input[name="address"]').val()?.trim() || '',
            district_id: $('select[name="district_id"]').val()?.trim() || '',
            email: $('input[name="email"]').val()?.trim() || '',
            mobile_no: $('input[name="mobile_no"]').val()?.trim() || '',
            contact_person: $('input[name="contact_person"]').val()?.trim() || '',
            program_datetime: $('input[name="program_datetime"]').val()?.trim() || '',
            crowd_size: $('input[name="crowd_size"]').val()?.trim() || '',
            google_address: $('input[name="google_address"]').val()?.trim() || '',
            latitude: $('input[name="latitude"]').val()?.trim() || '',
            longitude: $('input[name="longitude"]').val()?.trim() || ''
        };
        $("[id^=error]").html("");
        $("#errorBlock").hide();
        let errors = [];
        if (!formData.program_type) errors.push({
            id: "error_1",
            msg: "Select program Type"
        });
        if (!formData.name) errors.push({
            id: "error_2",
            msg: "Enter Name"
        });
        if (!formData.address) errors.push({
            id: "error_3",
            msg: "Enter Address"
        });
        if (!formData.district_id) errors.push({
            id: "error_4",
            msg: "Select District"
        });
        if (!formData.email) errors.push({
            id: "error_5",
            msg: "Enter Email Address"
        });
        if (!formData.mobile_no) errors.push({
            id: "error_6",
            msg: " Enter Mobile Number"
        });
        if (!formData.contact_person) errors.push({
            id: "error_7",
            msg: "Enter Contact Person"
        });
        if (!formData.program_datetime) errors.push({
            id: "error_8",
            msg: "Choose Program Date and Time"
        });
        if (!formData.crowd_size) errors.push({
            id: "error_9",
            msg: "Enter Crowd Size"
        });
        if (!formData.google_address) errors.push({
            id: "error_10",
            msg: "Enter Google Address"
        });

        if (errors.length > 0) {
            errors.forEach(error => $(`#${error.id}`).html(error.msg));
            console.log("Validation Errors:", errors);
            return false;
        }
        const ajaxFormData = new FormData();
        Object.keys(formData).forEach(key => {
            ajaxFormData.append(key, formData[key]);
        });

        // AJAX request
        $.ajax({
            url: "{{ route('citizen.saveAwareness') }}",
            type: 'POST',
            data: ajaxFormData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': formData._token
            },
            success: function(response)
            {
                console.log(response);
                let obj = JSON.parse(response);
                let Phone = $('#mobile_no').val();
                if (obj.code === 1)
                {
                    $('.toaster').addClass('alert alert-success').html(obj.message).delay(5000).fadeOut().css('display', 'block');
                    $('#addFormDiv').hide();
                    $('#otpVerifydiv').show();
                    $('#otpMobile').val(Phone);
                } 
                else {
                    $('.toaster').addClass('alert alert-danger').html(obj.message).delay(3000).fadeOut().css('display', 'block');
                }
            }
        });
    });




    $(document).on('submit', '#OtpPostverify', function(e) {
        e.preventDefault();
        let otpinput0 = $('#optinput0').val();
        let otpinput1 = $('#optinput1').val();
        let otpinput2 = $('#optinput2').val();
        let otpinput3 = $('#optinput3').val();
        let otpinput4 = $('#optinput4').val();
        let otpinput5 = $('#optinput5').val();
        // alert(otpinput0);
        if (otpinput0 == '' || otpinput1 == '' || otpinput2 == '' || otpinput3 == '' || otpinput4 ==
            '' || otpinput5 == '') {
            $('#otp_error').html('All fields are required').delay(3000).fadeOut().css('display',
                'block');
            return false;
        } else {
            let otpMobile = $('#otpMobile').val();
            let otpValue = otpinput0 + otpinput1 + otpinput2 + otpinput3 + otpinput4 + otpinput5;

            $.ajax({
                url: "{{ route('citizen.awarenessOtpPost') }}",
                method: "POST",
                data: {
                    otpValue: otpValue,
                    otpMobile: otpMobile,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response)
                {
                    console.log(response)
                    let obj = JSON.parse(response);

                    if (obj.code === 1)
                    {
                        $('.toaster').addClass('alert alert-success').html(obj.message).delay(5000).fadeOut().css('display', 'block');
                        $('#addFormDiv').show();
                        $('#otpVerifydiv').hide();
                        setTimeout(() => {
                            window.location.reload();
                        }, 3000);

                        return false;
                    }
                    else if (obj.code === 2) {
                        $.each(obj.errors, function(key, value) {
                            $('.toaster').addClass('alert alert-danger').html(value)
                                .delay(3000)
                                .fadeOut().css('display', 'block');
                        });
                        return false;
                    } else {
                        $('.toaster').addClass('alert alert-danger').html(obj.message)
                            .delay(3000)
                            .fadeOut().css('display', 'block');
                        return false;
                    }
                }
            });
        }
    });





     $(document).ready(function() {
        var resendCooldown = 120;
        var timerInterval;

        function startResendTimer() {
            var timeLeft = resendCooldown;
            $('#resendOtpLink').addClass('disabled').css('pointer-events', 'none');
            updateTimerDisplay(timeLeft);

            timerInterval = setInterval(function() {
                timeLeft--;
                updateTimerDisplay(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    $('#resendOtpLink').removeClass('disabled').css('pointer-events', 'auto');
                    $('#resendTimer').text('');
                }
            }, 1000);
        }

        function updateTimerDisplay(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remaining = seconds % 60;
            $('#resendTimer').text(`(${minutes}:${remaining.toString().padStart(2, '0')})`);
        }

        $('#resendOtpLink').click(function() {
            var userId = $('#otpMobile').val();
            startResendTimer(); 
            $.ajax({
                url: "{{ route('citizen.resendOtp') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    user_id: userId
                },
                success: function(response) {
                    if (response.message) {
                        alert(response.message);
                    } else if (response.error) {
                        alert(response.error);
                    }
                },
                error: function(xhr) {
                    clearInterval(timerInterval);
                    $('#resendOtpLink').removeClass('disabled').css('pointer-events',
                        'auto');
                    $('#resendTimer').text('');
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
    
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_eIyP2oTRYMfeG3PdSDYFv8o5cYVI7ZA&libraries=places">
</script>
<script>
function initialize() {
    const input = document.getElementById('google_address');
    const autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.addListener('place_changed', function() {
        const place = autocomplete.getPlace();
        if (!place.geometry || !place.geometry.location) {
            alert("No details available for input: '" + place.name + "'");
            return;
        }
        const lat = place.geometry.location.lat();
        const lng = place.geometry.location.lng();
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
    });
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
@stop
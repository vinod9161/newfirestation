@extends('layouts.fire_new')
@section('content')


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

<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Public Awareness/Mock drill</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Public Awareness/Mock drill</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<section class="why-us section-bg flagday-section py-5" data-aos="fade-up" date-aos-delay="200">
    <div class="container">
        <div class="row content-card content-text">
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/fire/gallery/mockdrill.jpg')}}" class="img-fluid img-reponsive rounded" alt="">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <p class="description"> 
                    Uttarakhand Fire & Emergency Service conducts firefighting training, mock drills, and fire safety awareness programmes. Industries, residential societies, schools, and other institutions may submit requests to the Fire Department for organizing awareness programmes, mock drills, talk shows, seminars, or conferences.
                    These services are provided free of cost, subject to the availability of resources. Members of the public, schools, and institutions may also schedule visits to fire stations with prior permission from the concerned Fire Station Officer.
                    For requests or coordination, please contact the nearest fire station directly or communicate via email with the concerned fire station.

                </p>
            </div>
        </div>
    </div>
</section>

<section class="flagday-section pb-5">
    <div class="container">
        <div class="row content-card content-text">
            <div class="col-md-12">
                <h4 style="margin:20px ;" class="text-center">Request for awareness program/mock drills/talk on
                    show/seminar/conference/others</h4>
                <hr>
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

                <div class="toaster"></div>


                <div class="col-md-12" id="awarenessForm">
                    <form id="awarenessProgramForm" method="post" role="form" enctype="multipart/form-data"
                        class="php-email-form" style="margin-top:20px; margin-bottom:20px;">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <input type="hidden" value="{{$unique_no}}" name="application_id">
                                <select name="program_type" id="program_type" class="custom-select" required>
                                    <option value="">Type of program</option>
                                    <option value="awareness program"> Awareness Program</option>
                                    <option value="mock drills">Mock Drills</option>
                                    <option value="talk on show">Talk on show</option>
                                    <option value="seminar">Seminar</option>
                                    <option value="conference">Conference</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Name of the person/institution" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="address" class="form-control" id="address"
                                    placeholder="Address" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <select class="form-control" name="district_id" id="district_id" required>
                                    <option value="">Select Your District</option>
                                    @foreach ($districts as $dist)
                                    <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 form-group">
                                <select class="form-control" name="station_id" id="station_id" required>
                                    <option value="">Select Your Fire Station</option>
                                </select>
                                <div class="validate"></div>
                            </div>


                            <div class="col-md-4 form-group">
                                <input type="email" class="form-control" name="email" id="email"
                                    placeholder="Your Email Address" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="number" name="mobile_no" class="form-control" id="mobile_no"
                                    placeholder="Your Mobile  Number" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="contact_person" class="form-control" id="contact_person"
                                    placeholder="Contact person" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="datetime-local" name="program_datetime" class="form-control"
                                    id="program_datetime" placeholder="Proposed date" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="number" name="crowd_size" class="form-control" id="crowd_size"
                                    placeholder="Expected Participants" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input id="generated-captcha" type="text" class="form-control" readonly><i
                                    class="ni ni-atom" title="Refresh Captcha" onclick="generate()"></i>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" class="form-control" name="captcha" id="entered-captcha"
                                    placeholder="Enter the captcha..">
                                <span class="text-danger" id="captcha_error"></span>
                            </div>

                            <div class="col-md-4 form-group">
                                <button type="submit" id="loginFormBtn"
                                    class="btn btn-danger mb-2 w-100">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row" id="otpVerify" style="display:none">
            <div class="col-md-7" style="margin:0 auto">
                <form id="awarenessOtpVerifyForm" method="post" role="form">
                     <div class="col-md-8" style="margin:0 auto; max-width:360px">
                        <label>Verify OTP</label>
                        <div id="otpInputs" class="d-flex justify-content-between mb-2">
                            <input type="text" maxlength="1" class="form-control otp-input" name="optinput"  id="otpinput" />
                            <input type="text" maxlength="1" class="form-control otp-input" name="optinput1" id="otpinput1" />
                            <input type="text" maxlength="1" class="form-control otp-input" name="optinput2" id="otpinput2" />
                            <input type="text" maxlength="1" class="form-control otp-input" name="optinput3" id="otpinput3" />
                            <input type="text" maxlength="1" class="form-control otp-input" name="optinput4" id="otpinput4" />
                            <input type="text" maxlength="1" class="form-control otp-input" name="optinput5" id="otpinput5" />
                        </div>

                        <span class="text-danger" id="otp_error"></span>

                        <!-- Timer with loader -->
                        <div class="d-flex align-items-center mb-2">
                            <div id="timerCircle" class="me-2">
                                <svg width="24" height="24" viewBox="0 0 36 36">
                                    <path class="circle-bg" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#eee" stroke-width="2" />
                                    <path id="circleProgress" class="circle" d="M18 2.0845
                                a 15.9155 15.9155 0 0 1 0 31.831
                                a 15.9155 15.9155 0 0 1 0 -31.831" fill="none" stroke="#dc3545" stroke-width="2"
                                        stroke-dasharray="100, 100" />
                                </svg>
                            </div>
                            <div id="otpTimer" class="text-muted">Time remaining: 03:00</div>
                        </div>
                        @csrf
                        <input type="hidden" class="form-control" name="otpMobile" id="otpMobile">
                        <button type="submit" id="verifyOtp" class="btn btn-danger w-100">Verify</button>
                        <button type="button" id="resendOtp" class="btn btn-link w-100 mt-2 d-none">Resend OTP</button>
                    </div>
                </form>
               
            </div>
        </div>


    </div>
</section>
<!-- form -->

</div>
<!-- End form -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
const inputs = document.querySelectorAll('.otp-input');
const timerDisplay = document.getElementById('otpTimer');
const resendBtn = document.getElementById('resendOtp');
const progressCircle = document.getElementById('circleProgress');

let timeLeft = 180;
const totalTime = 180;
let timer;

// Handle input restrictions and navigation
inputs.forEach((input, index) => {
    input.addEventListener('input', (e) => {
        let value = e.target.value;

        // Accept only digits
        if (!/^\d$/.test(value)) {
            e.target.value = '';
            return;
        }

        if (value.length === 1 && index < inputs.length - 1) {
            inputs[index + 1].focus();
        }
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && input.value === '' && index > 0) {
            inputs[index - 1].focus();
        }
    });

    input.addEventListener('paste', (e) => {
        const paste = e.clipboardData.getData('text');
        if (/^\d{6}$/.test(paste)) {
            paste.split('').forEach((num, i) => {
                if (inputs[i]) inputs[i].value = num;
            });
            e.preventDefault();
        }
    });
});

function updateProgress() {
    const percent = (timeLeft / totalTime) * 100;
    progressCircle.setAttribute('stroke-dasharray', `${percent}, 100`);
}

function startTimer() {
    timeLeft = totalTime;
    resendBtn.classList.add('d-none');
    updateProgress();
    timerDisplay.textContent = `Time remaining: 01:00`;

    timer = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(timer);
            timerDisplay.textContent = "OTP expired.";
            progressCircle.setAttribute('stroke-dasharray', '0, 100');
            resendBtn.classList.remove('d-none');
        } else {
            let min = Math.floor(timeLeft / 180).toString().padStart(2, '0');
            let sec = (timeLeft % 1800).toString().padStart(2, '0');
            timerDisplay.textContent = `Time remaining: ${min}:${sec}`;
            updateProgress();
            timeLeft--;
        }
    }, 1000);
}

document.getElementById('resendOtp').addEventListener('click', () => {
    inputs.forEach(input => input.value = "");
    startTimer();
    alert("OTP resent!");
});

startTimer(); // Start on page load
</script>


<script>
$(document).on('submit', '#awarenessProgramForm', function(e) {
    e.preventDefault();
    let Phone = $('#mobile_no').val();

    $.ajax({
        url: "{{ route('publicAwarenessPost') }}",
        method: "POST",
        data: $('#awarenessProgramForm').serialize(),
        success: function(response) {
            // console.log(response);
            // return false;
            let obj = JSON.parse(response);
            if (obj.code === 1) {
                $('.toaster').addClass('alert alert-success').html(obj.message).delay(5000)
                .fadeOut().css('display', 'block');
                $('#awarenessProgramForm')[0].reset();
                $('#awarenessForm').hide();
                $('#otpVerify').show();
                $('#otpMobile').val(Phone);
            } else if (obj.code === 2) {
                $.each(obj.errors, function(key, value) {
                    $('.toaster').addClass('alert alert-danger').html(value).delay(3000)
                        .fadeOut().css('display', 'block');
                })
            } else {
                $('.toaster').addClass('alert alert-danger').html(obj.message).delay(3000).fadeOut()
                    .css('display', 'block');
            }
        }
    });
});
</script>

<script>
$(document).on('submit', '#awarenessOtpVerifyForm', function(e) {
    e.preventDefault();

    let otpinput  = $('#otpinput').val();
    let otpinput1 = $('#otpinput1').val();
    let otpinput2 = $('#otpinput2').val();
    let otpinput3 = $('#otpinput3').val();
    let otpinput4 = $('#otpinput4').val();
    let otpinput5 = $('#otpinput5').val();

    let _token = $('input[name="_token"]').val();
    

    if (otpinput == '' || otpinput1 == '' || otpinput2 == '' || otpinput3 == '' || otpinput4 == '' ||
        otpinput5 == '') {
        $('#otp_error').html('All fields are required').delay(3000).fadeOut().css('display', 'block');
        return false;
    } else {
        let otpMobile = $('#otpMobile').val();

        let otpValue = otpinput + otpinput1 + otpinput2 + otpinput3 + otpinput4 + otpinput5;

        $.ajax({
            url: "{{ route('publicAwarenessOtpPost') }}",
            method: "POST",
            data: {
                otpValue: otpValue,
                otpMobile: otpMobile,
                _token: _token
            },
            success: function(response) {
                // console.log(response);
                // return false;
                let obj = JSON.parse(response);
                if (obj.code === 1) {
                    $('.toaster').addClass('alert alert-success').html(obj.message).delay(5000).fadeOut().css('display', 'block');
                    $('#otpVerify').hide();
                    $('#awarenessProgramForm')[0].reset();
                    $('#awarenessForm').show();
                    return false;
                }
                else if (obj.code === 2) {
                    $.each(obj.errors, function(key, value) {
                        $('.toaster').addClass('alert alert-danger').html(value).delay(3000)
                            .fadeOut().css('display', 'block');
                    });
                    return false;
                } else {
                    $('.toaster').addClass('alert alert-danger').html(obj.message).delay(3000)
                        .fadeOut().css('display', 'block');
                    return false;
                }
            }
        });
    }

})
</script>










<script type="text/javascript">
jQuery(document).ready(generate());

var captcha;
var alphabets = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
// console.log(alphabets.length);

function generate() {
    alphabets = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
    // console.log(alphabets.length);
    var status = document.getElementById('status');
    let first = alphabets[Math.floor(Math.random() * alphabets.length)];
    let second = Math.floor(Math.random() * 10);
    let third = Math.floor(Math.random() * 10);
    let fourth = alphabets[Math.floor(Math.random() * alphabets.length)];
    let fifth = alphabets[Math.floor(Math.random() * alphabets.length)];
    let sixth = Math.floor(Math.random() * 10);
    captcha = first.toString() + second.toString() + third.toString() + fourth.toString() + fifth.toString() + sixth
        .toString();
    // console.log(captcha);
    document.getElementById('generated-captcha').value = captcha;
    document.getElementById("entered-captcha").value = '';
}

function check() {
    let userValue = document.getElementById("entered-captcha").value;
    if (userValue == captcha) {
        $('#captcha_error').text('Captcha Verify Successful');
        document.getElementById("loginForm").submit();
        return true;
    } else if (userValue == '') {
        $('#captcha_error').text('Please Enter Captcha...');
        return false;
    } else {
        $('#captcha_error').text('Invalid Captcha...! Please Try Again');
        return false;
    }
}
</script>



<script>
    $(document).on('change', '#district_id', function() {

        let district_id = $(this).val().trim();
        let _token = $('input[name="_token"]').val();
        if(district_id=='')
        {
            alert("Required District Name");
            return false;
        }

        $.ajax({
            url: "{{ route('actionFireStationByDistrict') }}",
            type: "POST",
            data: {
                district_id: district_id,
                _token: _token
            },
            success: function(response) 
            {
                let dataObj = JSON.parse(response);
                if (dataObj.code === 1) 
                {
                    let fireStation = '<option value="">---- Select Fire Station ----</option>';
                    $.each(dataObj.data, function(key, value) {
                        fireStation += '<option value="' + value.id + '">' + value.name + '</option>';
                    });

                    $('#station_id').html(fireStation);
                } 
                else {
                    let fireStation = '<option value="">'   + dataObj.message + '</option>';
                    $('#station_id').html(fireStation);
                }
            }
        })    

    });
</script>


@endsection
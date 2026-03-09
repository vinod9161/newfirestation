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
    <h1 class="breadcrumb-item">Standby Duties</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Standby Duties</li>
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
                <img src="{{asset('/public/fire/gallery/standby.jpg')}}" class="img-fluid img-reponsive rounded" alt="">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center">
                <h4 class="title">Standby Duties</a></h4>
                <p class="description"> 
                    The Uttarakhand Fire and Emergency Service Department provides standby duty services to ensure the safety of citizens and the public from potential fire-related incidents during events and activities. These services are deployed at public functions, religious events, festivals, large gatherings, and other occasions where fire risk is anticipated.
                    Standby duties are arranged on request, subject to the availability of manpower and equipment. Nominal charges are applicable for services provided on personal or private requests, as per departmental norms. The objective of standby deployment is to ensure immediate response, prevent mishaps, and enhance overall public safety.

                </p>
            </div>
        </div>
    </div>
</section>
<!-- start Facts Section -->
<!-- <section class="facts section-bg" data-aos="fade-up" style="background-color: #fff;">
   <div class="container">
      <div class="row counters">
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{asset('/public/fire/gallery/B1.png')}}"></span>
            <span data-toggle="counter-up">33</span>
            <p>Fire Stations</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{asset('/public/fire/gallery/incident.png')}}"></span>
            <span data-toggle="counter-up">46</span>
            <p>Wildfire Incidents</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{asset('/public/fire/gallery/em-call.png')}}"></span>
            <span data-toggle="counter-up">24</span>
            <p>Total Emergency Call</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{asset('/public/fire/gallery/work1.png')}}"></span>
            <span data-toggle="counter-up">1422</span>
            <p>Total strength</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{asset('/public/fire/gallery/fire-truck.png')}}"></span>
            <span data-toggle="counter-up">50</span>
            <p>Fire Vehicle</p>
         </div>
         <div class="col-lg-2 col-6 text-center">
            <span><img src="{{asset('/public/fire/gallery/life.png')}}"></span>
            <span data-toggle="counter-up">100</span>
            <p>Life Saved</p>
         </div>
      </div>
   </div>
</section> -->
<!-- End Facts Section -->
<!-- form -->
<section class="flagday-section pb-5">
    <div class="container">
        <div class="row why-us section-bg content-card content-text">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <h3 style="margin:20px ;" class="text-center">Request for standby duties </h3>

                

                <div class="col-md-12" id="standbyFormdiv" style="margin-bottom:50px;">
                    <div class="toaster"></div>
                    <!-- <form action="{{route('actionStandbyPost')}}" enctype="multipart/form-data" method="post" role="form" class="php-email-form"> -->
                    <form id="standbyForm" enctype="multipart/form-data" method="post" role="form" class="php-email-form">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 form-group">
                                <select class="form-control" name="program_type" id="program_type" required>
                                    <option value="">Select Program Type</option>
                                    <option value="Government">Government</option>
                                    <option value="Private">Private</option>
                                </select>
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="name" class="form-control" id="name"
                                    placeholder="Name of the person/institution" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="address" class="form-control" id="address" placeholder="Address"
                                    required />
                            </div>
                            
                            <div class="col-md-4 form-group">
                                <select class="form-control" name="district_id" id="district_id" required>
                                    <option value="">Select Your District</option>
                                    @foreach ($districts as $dist)
                                    <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                    @endforeach
                                </select>
                                <div class="validate"></div>
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
                                <input type="tel" name="mobile_no" class="form-control" id="mobile_no"
                                    placeholder="Your Mobile  Number" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="text" name="contact_person" class="form-control" id="contact_person"
                                    placeholder="Contact person" required />
                            </div>
                            <div class="col-md-4 form-group">
                                <input type="datetime-local" name="program_datetime" title="Proposed date and time"
                                    class="form-control" id="program_datetime" placeholder="Proposed date and time"
                                    required />
                            </div>

                            <div class="col-md-4 form-group">
                                <input type="number" name="crowd_size" class="form-control" id="crowd_size"
                                    placeholder="Expected gathering" required />
                            </div>

                            <div class="col-md-4 form-group">
                                <button type="submit" id="loginFormBtn" class="btn btn-danger mb-2 w-100">Submit</button>
                            </div>


                        </div>
                        
                    </form>
                </div>


                <div class="col-md-12" id="otpVerifydiv" style="display:none; margin-bottom:50px;">
                    <div class="col-md-7" style="margin:0 auto">
                        <form id="standbyOtpPostverify"  method="post">
                            @csrf
                            <div class="col-md-8" style="margin:0 auto; max-width:360px">
                                <label>Verify OTP</label>
                                <div id="otpInputs" class="d-flex justify-content-between mb-2">
                                    <input type="text" maxlength="1" class="form-control otp-input" name="optinput0" id="optinput0" />
                                    <input type="text" maxlength="1" class="form-control otp-input" name="optinput1" id="optinput1" />
                                    <input type="text" maxlength="1" class="form-control otp-input" name="optinput2" id="optinput2" />
                                    <input type="text" maxlength="1" class="form-control otp-input" name="optinput3" id="optinput3" />
                                    <input type="text" maxlength="1" class="form-control otp-input" name="optinput4" id="optinput4" />
                                    <input type="text" maxlength="1" class="form-control otp-input" name="optinput5" id="optinput5" />
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
                                <input type="hidden" class="form-control" name="otpMobile" id="otpMobile">
                                <button type="submit"  class="btn btn-danger w-100">Verify</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</section>

</div>
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
$(document).on('submit', '#standbyForm', function(e) {
    e.preventDefault();
    let Phone = $('#mobile_no').val();

    $.ajax({
        url: "{{ route('actionStandbyPost') }}",
        method: "POST",
        data: $('#standbyForm').serialize(),
        success: function(response) {
            let obj = JSON.parse(response);
            if (obj.code === 1)
            {
                $('#standbyForm')[0].reset();
                $('.toaster').addClass('alert alert-success').html(obj.message).delay(5000)
                    .fadeOut().css('display', 'block');
                $('#standbyFormdiv').hide();
                $('#otpVerifydiv').show();
                $('#otpMobile').val(Phone);
            } 
            else if (obj.code === 2) {
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
$(document).on('submit', '#standbyOtpPostverify', function(e) {
    e.preventDefault();
    let otpinput0 = $('#optinput0').val();
    let otpinput1 = $('#optinput1').val();
    let otpinput2 = $('#optinput2').val();
    let otpinput3 = $('#optinput3').val();
    let otpinput4 = $('#optinput4').val();
    let otpinput5 = $('#optinput5').val();
    // alert(otpinput0);
    if (otpinput0 == '' || otpinput1 == '' || otpinput2 == '' || otpinput3 == '' || otpinput4 == '' || otpinput5 == '') {
        $('#otp_error').html('All fields are required').delay(3000).fadeOut().css('display', 'block');
        return false;
    } else {
        let otpMobile = $('#otpMobile').val();
        let otpValue = otpinput0 + otpinput1 + otpinput2 + otpinput3 + otpinput4 + otpinput5;

        $.ajax({
            url: "{{ route('actionStandbyOtpPostVerify') }}",
            method: "POST",
            data: {
                otpValue: otpValue,
                otpMobile: otpMobile,
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                let obj = JSON.parse(response);

                if (obj.code === 1) {
                    $('.toaster').addClass('alert alert-success').html(obj.message).delay(5000)
                        .fadeOut().css('display', 'block');
                    $('#otpVerifydiv').hide();
                    $('#standbyForm')[0].reset();
                    $('#standbyFormdiv').show();
                    return false;
                } else if (obj.code === 2) {
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
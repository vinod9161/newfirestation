<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Verify OTP - Uttarakhand Fire Services</title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <link rel="icon" href="{{ asset('/public/admin/images/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('/public/admin/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/admin/css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/admin/css/icons.min.css') }}" rel="stylesheet">

    <style>
    body {
        background-image: url(../public/admin/images/login_bg.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
    }

    .otp-input {
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 24px;
        margin-right: 10px;
        border: 2px solid #ccc;
        border-radius: 6px;
    }

    .otp-input:focus {
        border-color: #dc3545;
        outline: none;
    }

    .web-color {
        color: #dc3545;
    }
	
	.card-body{
		background-color: #fff !important;
		box-shadow: 0px 0px 0px #9db5ff !important;
		padding: 20px !important;
	}
    </style>
</head>

<body>
    <div class="page main-signin-wrapper">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-6">
                <div class="card custom-card mt-5">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="logo" class="img-fluid"
                                style="height: 100px;">
                        </div>
                        <h5 class="web-color">Uttarakhand Fire and Emergency Services</h5>
                        <p class="mt-2">Please enter the 6-digit OTP sent to your registered mobile/email</p>

                        @if(session()->has('success'))
                        <div class="alert alert-success">{{ session()->get('success') }}</div>
                        @elseif(session()->has('error'))
                        <div class="alert alert-danger">{{ session()->get('error') }}</div>
                        @endif

                        <form method="POST" action="{{ route('auth.submit.otp') }}" id="otpForm">
                            @csrf
                            <div class="d-flex justify-content-center mb-3" id="otpContainer">
                                @for ($i = 1; $i <= 6; $i++) 
                                    <input type="text" maxlength="1" class="otp-input" id="otp{{ $i }}" 
                                        oninput="moveToNext(this)" onkeydown="handleBackspace(event, this)">
                                @endfor
                            </div>
                            <input type="hidden" name="otp_combined" id="otp_combined">
                            <!-- REMOVED: <input type="hidden" name="user_id" value="{{ session('otp_user_id') }}"> -->
                            <button type="submit" class="btn btn-danger w-100">Verify OTP</button>
                            <div class="text-center mt-2">
                                <a href="javascript:void(0);" id="resendOtpLink" class="text-danger fw-bold">Resend OTP</a>
                                <span id="resendTimer" class="text-muted ms-2"></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('/public/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

    <script>

// timer 
 let resendOtpLink = document.getElementById("resendOtpLink");
    let resendTimer = document.getElementById("resendTimer");

    // Disable resend link initially
    resendOtpLink.style.pointerEvents = "none";
    resendOtpLink.style.opacity = "0.6";

    // Start 2-minute countdown
    let timeLeft = 120;
    let timerInterval = setInterval(() => {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;
        resendTimer.textContent = `(${minutes}:${seconds < 10 ? '0' + seconds : seconds})`;

        timeLeft--;

        if (timeLeft < 0) {
            clearInterval(timerInterval);
            resendTimer.textContent = ""; // remove timer text
            resendOtpLink.style.pointerEvents = "auto";
            resendOtpLink.style.opacity = "1";
        }
    }, 1000);

    // Optionally: If user clicks "Resend OTP", you can reset the timer
    resendOtpLink.addEventListener("click", function () {
        resendOtpLink.style.pointerEvents = "none";
        resendOtpLink.style.opacity = "0.6";
        timeLeft = 120;
        resendTimer.textContent = "(2:00)";
        timerInterval = setInterval(() => {
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            resendTimer.textContent = `(${minutes}:${seconds < 10 ? '0' + seconds : seconds})`;

            timeLeft--;

            if (timeLeft < 0) {
                clearInterval(timerInterval);
                resendTimer.textContent = "";
                resendOtpLink.style.pointerEvents = "auto";
                resendOtpLink.style.opacity = "1";
            }
        }, 1000);
    });





    const inputs = document.querySelectorAll('.otp-input');

    function moveToNext(el) {
        if (el.value.length === 1) {
            let next = el.nextElementSibling;
            while (next && !next.classList.contains('otp-input')) {
                next = next.nextElementSibling;
            }
            if (next) next.focus();
        }
    }

    function handleBackspace(e, el) {
        if (e.key === "Backspace" && el.value === '') {
            let prev = el.previousElementSibling;
            while (prev && !prev.classList.contains('otp-input')) {
                prev = prev.previousElementSibling;
            }
            if (prev) prev.focus();
        }
    }

    $('#otpForm').on('submit', function(e) {
        let fullOtp = '';
        $('.otp-input').each(function() {
            fullOtp += $(this).val();
        });
        $('#otp_combined').val(fullOtp);

        // Optional validation before submit
        if (fullOtp.length !== 6) {
            e.preventDefault();
            alert('Please enter 6 digits');
            return false;
        }
    });

    @if(session('error'))
    // Clear inputs on error
    setTimeout(() => {
        $('.otp-input').val('');
        $('#otp1').focus();
    }, 200);
    @endif




    // resend otp 

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
            // No need to get userId - server will get from session
            startResendTimer();

            $.ajax({
                url: "{{ route('resend.otp') }}",
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                    // user_id removed - server gets from session
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
                    $('#resendOtpLink').removeClass('disabled').css('pointer-events', 'auto');
                    $('#resendTimer').text('');
                    alert('Something went wrong. Please try again.');
                }
            });
        });
    });
    </script>
</body>

</html>
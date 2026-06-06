<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Uttarakhand Fire Services</title>
    <link rel="icon" href="{{ asset('/public/admin/images/favicon.ico') }}" type="image/x-icon">
    <script src="{{ asset('/public/admin/js/authentication-main.js') }}"></script>
    <link id="style" href="{{ asset('/public/admin/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/admin/css/styles.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/public/admin/css/icons.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        .web-color { color:#dc3545; }
        .text-dec-ul { text-decoration: underline; }
        body {
            background-image: url(../public/admin/images/login_bg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .card-body {
            background-color: #fff !important;
            box-shadow: 0px 0px 0px #9db5ff !important;
            padding: 20px !important;
        }
        .captcha-loading {
            opacity: 0.5;
            pointer-events: none;
        }
        .refresh-btn-loading {
            opacity: 0.6;
            cursor: not-allowed !important;
        }
    </style>
</head>
<body>
    <div class="page main-signin-wrapper">
        <div class="row ps-0 pe-0 ms-0 me-0">
            <div class="col-xl-5 col-lg-5 col-md-5 d-block mx-auto">
                <div class="card custom-card">
                    <div class="card-body pd-45">
                        <div class="text-center mb-2">
                            <a href="index.html" class="custom-logo">
                                <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" class="desktop-logo" alt="logo" style="height:9.1rem;">
                                <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" class="desktop-dark" alt="logo" style="height:9.1rem;">
                            </a>
                        </div>
                        <h6 class="text-center web-color">Uttarakhand Fire and Emergency Services</h6>
                        <br>
                        
                        @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <button aria-label="Close" class="btn-close float-end" data-bs-dismiss="alert" type="button">×</button>
                                <strong>Well done!</strong> {{ session()->get('success') }}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger mg-b-0" role="alert">
                                <button aria-label="Close" class="btn-close float-end" data-bs-dismiss="alert" type="button">×</button>
                                <strong>Oh snap!</strong> {{ session()->get('error') }}
                            </div>
                        @endif
                        
                        <form id="loginForm" action="{{ route('auth.login') }}" method="post">
                            @csrf

                            <div class="form-group text-start">
                                <label>Email / Username</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" 
                                    name="username" value="{{ old('username') }}" required autocomplete="username" autofocus 
                                    placeholder="Email or Username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <div class="form-group text-start">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                    name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                            
                            <!-- CAPTCHA Section -->
                            <div class="form-group text-start">
                                <label>Enter CAPTCHA <span class="text-danger">*</span></label>
                                <div class="row align-items-center">
                                    <div class="col-12 mb-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <!-- CAPTCHA Image -->
                                            <div id="captcha_container">
                                                <img src="{{ route('captcha.generate') }}" 
                                                    alt="CAPTCHA" 
                                                    id="captcha_image" 
                                                    class="img-fluid rounded border"
                                                    style="height: 50px; width: 160px; background-color: #ede7f6;">
                                            </div>
                                            
                                            <!-- Refresh Button -->
                                            <button type="button" 
                                                id="refresh_captcha_btn" 
                                                class="btn btn-outline-secondary"
                                                style="height: 50px;">
                                                <i class="bi bi-arrow-repeat"></i> Refresh
                                            </button>
                                        </div>
                                        <small class="text-muted">Click Refresh button to get new code</small>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" 
                                            class="form-control @error('captcha') is-invalid @enderror" 
                                            name="captcha" 
                                            id="captcha_input" 
                                            placeholder="Enter the code shown above" 
                                            maxlength="6"
                                            autocomplete="off"
                                            required>
                                        <div id="captcha_status" class="small mt-1"></div>
                                        @error('captcha')
                                            <span class="invalid-feedback d-block" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn ripple btn-primary btn-block w-100 mt-3">Sign In</button>
                        </form>
                        
                        <div class="mt-3">
                            <p class="mb-1">
                                <a href="{{ route('auth.forgotpassword') }}" class="web-color text-dec-ul">Forgot password?</a>
                                <a href="{{ route('citizen.register') }}" class="web-color text-dec-ul" style="float:right;">Register as Citizen</a>
                            </p>
                            <p class="mb-0">
                                <a href="{{ route('agency.register') }}" class="web-color text-dec-ul">Register as Licence Agency</a>
                                <a href="{{ route('auditor.register') }}" class="web-color text-dec-ul" style="float:right;">Register as Fire Risk Auditor</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('/public/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    
    <script>
        $(document).ready(function() {
            
            let refreshInProgress = false;
            let captchaValidated = false;
            
            // Function to refresh CAPTCHA
            function refreshCaptcha() {
                if (refreshInProgress) return;
                
                refreshInProgress = true;
                captchaValidated = false;
                
                $('#refresh_captcha_btn').prop('disabled', true);
                $('#captcha_status').html('<span class="text-muted">Refreshing...</span>');
                
                $.ajax({
                    url: "{{ route('captcha.refresh') }}",
                    method: 'GET',
                    cache: false,
                    success: function(response) {
                        if (response.success) {
                            $('#captcha_image').attr('src', response.image);
                            $('#captcha_input').val('');
                            $('#captcha_input').removeClass('is-valid is-invalid');
                            $('#captcha_status').html('<span class="text-success">✓ CAPTCHA refreshed! Enter new code.</span>');
                            setTimeout(function() {
                                $('#captcha_status').fadeOut();
                            }, 2000);
                        }
                    },
                    error: function() {
                        var timestamp = new Date().getTime();
                        $('#captcha_image').attr('src', "{{ route('captcha.generate') }}?t=" + timestamp);
                        $('#captcha_input').val('');
                        $('#captcha_input').removeClass('is-valid is-invalid');
                        $('#captcha_status').html('<span class="text-danger">✗ Failed to refresh. Please try again.</span>');
                    },
                    complete: function() {
                        refreshInProgress = false;
                        $('#refresh_captcha_btn').prop('disabled', false);
                    }
                });
            }
            
            // Function to validate CAPTCHA in real-time (does NOT clear session)
            let validationTimeout;
            
            function validateCaptchaRealTime() {
                var captchaValue = $('#captcha_input').val().trim();
                
                if (captchaValue === '' || refreshInProgress) {
                    $('#captcha_input').removeClass('is-valid is-invalid');
                    $('#captcha_status').html('');
                    captchaValidated = false;
                    return;
                }
                
                if (captchaValue.length === 6) {
                    $.ajax({
                        url: "{{ route('captcha.validate') }}",
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            captcha: captchaValue
                        },
                        success: function(response) {
                            if (response.valid) {
                                $('#captcha_input').addClass('is-valid').removeClass('is-invalid');
                                $('#captcha_status').html('<span class="text-success">✓ CAPTCHA verified!</span>');
                                captchaValidated = true;
                            } else {
                                $('#captcha_input').addClass('is-invalid').removeClass('is-valid');
                                $('#captcha_status').html('<span class="text-danger">✗ Invalid CAPTCHA. Please refresh and try again.</span>');
                                captchaValidated = false;
                            }
                        }
                    });
                } else if (captchaValue.length > 0 && captchaValue.length < 6) {
                    $('#captcha_input').removeClass('is-valid is-invalid');
                    $('#captcha_status').html('<span class="text-muted">Enter ' + (6 - captchaValue.length) + ' more character(s)</span>');
                    captchaValidated = false;
                } else {
                    $('#captcha_input').removeClass('is-valid is-invalid');
                    $('#captcha_status').html('');
                    captchaValidated = false;
                }
            }
            
            // Attach refresh button click
            $('#refresh_captcha_btn').on('click', function(e) {
                e.preventDefault();
                refreshCaptcha();
            });
            
            // Debounced real-time validation
            $('#captcha_input').on('input', function() {
                clearTimeout(validationTimeout);
                validationTimeout = setTimeout(function() {
                    validateCaptchaRealTime();
                }, 300);
            });
            
            // Validate on blur
            $('#captcha_input').on('blur', function() {
                validateCaptchaRealTime();
            });
            
            // Clear on focus
            $('#captcha_input').on('focus', function() {
                $(this).removeClass('is-invalid');
            });
            
            // Form submission - final validation will happen on server
            // The server-side validate() will clear the CAPTCHA
            $('#loginForm').on('submit', function(e) {
                var captchaValue = $('#captcha_input').val().trim();
                
                if (captchaValue.length !== 6) {
                    e.preventDefault();
                    $('#captcha_status').html('<span class="text-danger">✗ Please enter the 6-digit CAPTCHA code.</span>');
                    $('#captcha_input').addClass('is-invalid');
                    return false;
                }
                
                // Optional: Show loading state
                $('button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Verifying...');
            });
            
            // Initial refresh
            setTimeout(function() {
                refreshCaptcha();
            }, 100);
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">
<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Uttarakhand Fire Services </title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/public/admin/images/favicon.ico') }}" type="image/x-icon">
    <!-- Main Theme Js -->
    <script src="{{ asset('/public/admin/js/authentication-main.js') }}"></script>
    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('/public/admin/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" >
    <!-- Style Css -->
    <link href="{{ asset('/public/admin/css/styles.min.css') }}" rel="stylesheet" >
    <!-- Icons Css -->
    <link href="{{ asset('/public/admin/css/icons.min.css') }}" rel="stylesheet" >
    <style>
        .web-color 
        {
            color:#dc3545;
        }
        .text-dec-ul
        {
            text-decoration: underline;
        }
        #generated-captcha {
            text-decoration: line-through;
            font-weight: bold;
            text-align: center;
            font-size: 20px;
            background-color: #ede7f6;
            border-radius: 6px;
            border: none;
            padding: 6px;
            outline: none;
            color: #1d1d1d;
        }

        body{
            background-image: url(../public/admin/images/login_bg.jpg);
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
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
        <!-- Row -->
        <div class="row ps-0 pe-0 ms-0 me-0">
            <div class=" col-xl-5 col-lg-5 col-md-5 d-block mx-auto">
                <div class="card custom-card">
                    <div class="card-body pd-45">
                        <div class="text-center mb-2">
                            <a  href="index.html" class="custom-logo">
                                <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" class="desktop-logo" alt="logo" style="height:9.1rem;">
                                <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" class="desktop-dark" alt="logo" style="height:9.1rem;">
                            </a>
                        </div>
                        <h6 class="text-center web-color">Uttarakhand Fire and Emergency Services</h6>
                        <br>
                        @if(session()->has('success'))
                            <div class="alert alert-success" role="alert">
                                <button aria-label="Close" class="btn-close float-end" data-bs-dismiss="alert" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Well done!</strong> {{ session()->get('success') }}
                            </div>
                        @elseif(session()->has('error'))
                            <div class="alert alert-danger mg-b-0" role="alert">
                                <button aria-label="Close" class="btn-close float-end" data-bs-dismiss="alert" type="button">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Oh snap!</strong> {{ session()->get('error') }}
                            </div>
                        @endif
                        <form id="loginForm" action="{{ route('auth.login') }}" method="post">
                            @csrf

                            <div class="form-group text-start">
                                <label>Email</label>
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="Email or Username">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="validation_error" id="email_error"></span>
                            </div>
                            <div class="form-group text-start">
                                <label>Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span class="validation_error" id="password_error"></span>
                            </div>
                            
                            <div>
                                <input id="generated-captcha" type="text" class="" readonly style="width:85%;">
                                <i class="ion-refresh" title="Refresh Captcha" style="font-size:34px;margin-left:14px;vertical-align:middle;color:#f02b0b;cursor:pointer;" onclick="generate()"></i>
                            </div>
                            <div style="margin:10px 0px;">
                                <input type="text" class="form-control" name="captcha" id="entered-captcha" placeholder="Enter the captcha..">
                                <span class="validation_error" id="captcha_error"></span>
                            </div>
                            <button type="submit" class="btn ripple btn-primary btn-block">Sign In</button>
                        </form>
                        <div class="mt-3">
                            <p class="mb-1">
                                <a href="{{ route('auth.forgotpassword') }}" class="web-color text-dec-ul">Forgot password?</a>
                                <a href="{{ route('citizen.register') }}" class="web-color text-dec-ul" style="float:right;">Register as Citizen</a>
                            </p>
                            <p class="mb-0">
                                <a href="{{ route('agency.register') }}" class="web-color text-dec-ul">Register as Licence Agency</a>
                                <a href="{{ route('auditor.register') }}"class="web-color text-dec-ul" style="float:right;">Register as Fire Risk Auditor</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Row -->
    </div>
    <!-- Bootstrap JS -->
    <script src="{{ asset('/public/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Jquery Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            generate();

            $('#entered-captcha').on('keypress', function (event) {
                var regex = new RegExp("^[a-zA-Z0-9]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            });
            $(function () {
                $("#username").keypress(function (e) {
                    var keyCode = e.keyCode || e.which;
                    var regex = /^[ 0-9A-Za-z@./]+$/;
                    var isValid = regex.test(String.fromCharCode(keyCode));
                    return isValid;
                });
            });
        });
        
        var captcha;
        var alphabets = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
        
        function generate()
        {
            alphabets = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz";
            // console.log(alphabets.length);
            var status = document.getElementById('status');
            let first = alphabets[Math.floor(Math.random() * alphabets.length)];
            let second = Math.floor(Math.random() * 10);
            let third = Math.floor(Math.random() * 10);
            let fourth = alphabets[Math.floor(Math.random() * alphabets.length)];
            let fifth = alphabets[Math.floor(Math.random() * alphabets.length)];
            let sixth = Math.floor(Math.random() * 10);
            captcha = first.toString()+second.toString()+third.toString()+fourth.toString()+fifth.toString()+sixth.toString();
            // console.log(captcha);
            document.getElementById('generated-captcha').value = captcha;
            document.getElementById("entered-captcha").value = '';
        }
        function check(){
            let email = document.getElementById('username').value;
            let password = document.getElementById('password').value;

            let userValue = document.getElementById("entered-captcha").value;

            if(email =='') {
                $('#email_error').text('Please Enter Email');
                return false;
            } else {
                $('#email_error').text('');
            }

            if(password =='') {
                $('#password_error').text('Please Enter Password');
                return false;
            } else {
                $('#password_error').text('');
            }
        
            if(userValue == captcha){
                $('#captcha_error').text('Valid Captcha... Login Successfully');
                document.getElementById("loginForm").submit();
            } 
            else if(userValue ==''){
                $('#captcha_error').text('Please Enter Captcha...');
                return false;
            } else
            {
                $('#captcha_error').text('Invalid Captcha...! Please Try Again');
                document.getElementById("entered-captcha").value = '';
            }
        }
    </script>
</body>
</html>
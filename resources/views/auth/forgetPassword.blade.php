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
                        <form id="loginForm" action="{{ route('submitForgetPasswordForm') }}" method="post">
                            @csrf

                            <div class="form-group text-start">
                                <label>Request a Password Reset</label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <span class="validation_error" id="email_error"></span>
                            </div>
                            <button type="submit" class="btn ripple btn-primary btn-block">Send Password Reset Link</button>
                        </form>
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
            $(function () {
                $("#username").keypress(function (e) {
                    var keyCode = e.keyCode || e.which;
                    var regex = /^[ 0-9A-Za-z@./]+$/;
                    var isValid = regex.test(String.fromCharCode(keyCode));
                    return isValid;
                });
            });
        });
    </script>
</body>
</html>
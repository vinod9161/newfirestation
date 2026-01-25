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
    <link rel="stylesheet" href="{{ asset('/public/admin/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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
                        <form id="loginForm" action="{{ route('citizenRegister') }}" method="post">
                            @csrf
                            <div class="form-group text-start">
                                <label>Building Name <span style="color:red;">*</span></label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}" required autocomplete="email" autofocus placeholder="Building Name">
                                <span class="text-danger" id="nameError"></span>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger" id="nameError">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-start">
                                <label>District <span style="color:red;">*</span></label>      
                                <select class="form-control" name="district_id" id="district_id" data-trigger required="">
                                    <option value="">--Select An Option--</option>
                                    @foreach ($districts as $dist)
                                    <option value="{{ $dist->id }}" @if ($dist->id == old('district_id')) selected @endif>{{ ucfirst($dist->name) }} </option>
                                    @endforeach
                                </select>
                                <span class="text-danger" id="districtError"></span>
                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger" id="districtError">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-start">
                                <label>Address <span style="color:red;">*</span></label>
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus placeholder="Address">
                                <span class="text-danger" id="addressError"></span>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger" id="addressError">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-start">
                                <label>Email Address <span style="color:red;">*</span></label>
                                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address">
                                <span class="text-danger" id="emailError"></span>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger" id="emailError">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group text-start">
                                <label>Mobile No. <span style="color:red;">*</span></label>
                                <input id="number" type="text" class="form-control @error('number') is-invalid @enderror" name="number" id="number" value="{{ old('number') }}" required autocomplete="number" autofocus placeholder="Mobile Number">
                                <span class="text-danger" id="mobileError"></span>
                                @error('number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong class="text-danger" id="mobileError">{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" id="citizenRegister" class="btn ripple btn-primary btn-block">Register</button>
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
    <script src="{{ asset('/public/admin/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var genericExamples = document.querySelectorAll("[data-trigger]");
            for (let i = 0; i < genericExamples.length; ++i) {
            var element = genericExamples[i];
            new Choices(element, {
                allowHTML: true,
                placeholderValue: " -- Select An Option -- ",
                searchPlaceholderValue: "Search",
            });
            }
        });
    </script>

    <script>
        $(document).ready(function(){
            $(document).on('click', '#citizenRegister', function(){
                let name = $('#name').val();
                let email = $('#email').val();
                let number = $('#number').val();
                let address = $('#address').val();
                let district = $('#district_id').val();
                if (name == '')
                {
                    $('#nameError').text('Please enter building name').delay(3000).fadeOut().css('display','block');
                    return false;

                }
                else if (district == '') 
                {
                    $('#districtError').text('Please select district').delay(3000).fadeOut().css('display','block');
                    return false;
                } 
                 else if (address == '') 
                {
                    $('#addressError').text('Please enter address').delay(3000).fadeOut().css('display','block');
                    return false;
                }
                else if (email == '') 
                {
                    $('#emailError').text('Please enter email').delay(3000).fadeOut().css('display','block');
                    return false;

                } 
                else if (number == '') 
                {
                    $('#mobileError').text('Please enter mobile number').delay(3000).fadeOut().css('display','block');
                    return false;
                } 
                else{
                    return true
                }
            });
        });
    </script>
</body>
</html>
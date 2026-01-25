<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/public/admin/images/fire-logo.webp') }}" type="image/png">

    <!-- Choices JS -->
    <script src="{{ asset('/public/admin/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <!-- Main Theme Js -->
    <script src="{{ asset('/public/admin/js/main.js') }}"></script>
    <!-- Bootstrap Css -->
    <link id="style" href="{{ asset('/public/admin/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Style Css -->
    <link href="{{ asset('/public/admin/css/styles.min.css') }}" rel="stylesheet">
    <!-- Icons Css -->
    <link href="{{ asset('/public/admin/css/icons.css') }}" rel="stylesheet">
    <!-- Node Waves Css -->
    <link href="{{ asset('/public/admin/libs/node-waves/waves.min.css') }}" rel="stylesheet">
    <!-- Simplebar Css -->
    <link href="{{ asset('/public/admin/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('/public/admin/libs/flatpickr/flatpickr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/admin/libs/@simonwep/pickr/themes/nano.min.css') }}">
    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('/public/admin/libs/choices.js/public/assets/styles/choices.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/admin/libs/jsvectormap/css/jsvectormap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/public/admin/libs/swiper/swiper-bundle.min.css') }}">
    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="{{ asset('/public/admin/libs/flatpickr/flatpickr.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    @yield ('style')
</head>
<body>
    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('/public/admin/images/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        @include('layouts.citizen.common.header')
        
        
        <aside class="app-sidebar sticky" id="sidebar" style="height: auto;">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header" style="border-inline-end:none;">
                <a href="index.html" class="header-logo">
                    <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-logo">
                    <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-logo">
                    <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-dark">
                    <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-dark">
                    <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-white">
                    <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-white">
                </a>
            </div>
            <!-- End::main-sidebar-header -->
        </aside>
        <!-- End::main-sidebar-header -->
        <div class="main-content app-content" style="margin-inline-start:0px;">
            <div class="container-fluid">
                <!-- Start::page-header -->
                @yield('content')
                <!-- End::page-header --> 
            </div>
        </div>
        <!-- End::app-content -->
        <!-- Start::app-footer -->
        @include('layouts.citizen.common.footer')
    </div>
    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow"><i class="fe fe-arrow-up"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Popper JS -->
    <script src="{{ asset('/public/admin/libs/@popperjs/core/umd/popper.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('/public/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Defaultmenu JS -->
    <script src="{{ asset('/public/admin/js/defaultmenu.min.js') }}"></script>
    <!-- Node Waves JS-->
    <script src="{{ asset('/public/admin/libs/node-waves/waves.min.js') }}"></script>
    <!-- Sticky JS -->
    <script src="{{ asset('/public/admin/js/sticky.js') }}"></script>
    <!-- Simplebar JS -->
    <script src="{{ asset('/public/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('/public/admin/js/simplebar.js') }}"></script>
    <!-- Color Picker JS -->
    <script src="{{ asset('/public/admin/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>
    <script src="{{ asset('/public/admin/libs/flatpickr/flatpickr.min.js') }}"></script>
    <!-- Jquery Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Select2 Cdn -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(function (e) {
            /* To choose date */
            flatpickr(".date-picker", {
                enableTime: true,
                dateFormat: "d-m-Y h:i K",
                placeholder: "Select date and time (dd-mm-yyyy hh:mm AM/PM)"
            });
        });
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
    @yield ('scripts');
</body>
</html>
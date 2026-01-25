<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    @yield ('title');
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
    @yield ('style');
</head>
<body>
    <!-- Loader -->
    <div id="loader">
        <img src="{{ asset('/public/admin/images/loader.svg') }}" alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        @include('layouts.admin.common.header')
        <!-- Start::app-sidebar -->
        @include('layouts.admin.common.sidebar')
        <!-- Start::app-content -->
        <div class="main-content app-content">
            <div class="container-fluid">
                <!-- Start::page-header -->
                @yield('content')
                <!-- End::page-header --> 
            </div>
        </div>
        <!-- End::app-content -->
        <!-- Start::app-footer -->
        @include('layouts.admin.common.footer')
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
    
    <script src="{{ asset('/public/admin/libs/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Jquery Cdn -->
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <!-- Select2 Cdn -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ asset('/public/admin/js/custom.js') }}"></script>
    <script>
        $(function (e) {
            /* To choose date */
            flatpickr(".date-picker", {
                enableTime: true,
                dateFormat: "d-m-Y H:i",
                placeholder: "Select date and time (dd-mm-yyyy hh:mm AM/PM)",
                time_24hr: true, // Use 24-hour time format
                allowInput: true
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


<script>
    $(document).ready(function() {
        // Target all <input type="text"> and <textarea> elements
        $('input[type="text"], textarea').on('input', function() {
            const $inputElement = $(this); // Get the current element as a jQuery object
            const currentValue = $inputElement.val(); // Get its current value

            // Replace all occurrences of '<' or '>' with an empty string
            const cleanedValue = currentValue.replace(/[<>]/g, '');

            // Update the element's value only if a change occurred
            if (cleanedValue !== currentValue) {
                $inputElement.val(cleanedValue);
            }
        });

        // For <select> elements:
        // Since users don't type directly into them, the 'input' event isn't relevant.
        // If you need to validate the *value* of a selected option for these characters,
        // you'd typically do it on 'change' or form submission, and decide
        // what action to take (e.g., prevent selection, show warning).
        // Example for basic validation on change (not removal, as removal isn't applicable):
        $('select').on('change', function() {
            const $selectElement = $(this);
            const selectedValue = $selectElement.val();

            if (selectedValue && (selectedValue.includes('<') || selectedValue.includes('>'))) {
                // console.warn("Selected option value contains forbidden characters:", selectedValue);
                // You might reset the select, show a message, or prevent form submission.
                // alert('The selected option has forbidden characters in its value. Please choose another.');
                // $selectElement.val(''); // Optional: reset selection
            }
        });
    });
</script>
    @yield ('scripts');
</body>
</html>
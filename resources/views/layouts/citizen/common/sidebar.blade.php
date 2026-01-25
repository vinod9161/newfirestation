<aside class="app-sidebar sticky" id="sidebar">

    <!-- Start::main-sidebar-header -->
    <div class="main-sidebar-header">
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

    <!-- Start::main-sidebar -->
    <div class="main-sidebar" id="sidebar-scroll">

        <!-- Start::nav -->
        <nav class="main-menu-container nav nav-pills flex-column sub-open">
            <div class="slide-left" id="slide-left">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
                </svg>
            </div>
            <ul class="main-menu">

                <!-- Start::slide -->
                <li class="slide">
                    <a href="{{route('citizen.account')}}" class="side-menu__item">
                        <span class="side-menu__label">Dashboard</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.noc.home')}}">
                        <span class="side-menu__label">Apply Noc</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('noc')}}">
                        <span class="side-menu__label">View All NOC</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('indexTemporaryNoc')}}">
                        <span class="side-menu__label">View Temporary NOC</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.issuedNoc')}}">
                        <span class="side-menu__label">View Issued NOC</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.standby')}}">
                        <span class="side-menu__label">StandBy Duties</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.awareness')}}">
                        <span class="side-menu__label">Awareness Drills/Training</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.incident')}}">
                        <span class="side-menu__label">Incident Report</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.building.map')}}">
                        <span class="side-menu__label">Building Map</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.fire.escape.plan')}}">
                        <span class="side-menu__label">Fire Escape Plan</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.chemical.use')}}">
                        <span class="side-menu__label">Chemical Use</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.upload.sop')}}">
                        <span class="side-menu__label">Upload Sop</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.safety.officer')}}">
                        <span class="side-menu__label">Safety Officer</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.do.dont')}}">
                        <span class="side-menu__label">Do &amp; Dont's</span>
                    </a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" href="{{route('citizen.declaration')}}">
                        <span class="side-menu__label">Declaration</span>
                    </a>
                </li>
                <!-- End::slide -->
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
                </svg></div>
        </nav>
        <!-- End::nav -->
    </div>
    <!-- End::main-sidebar -->
</aside>
<!-- End::app-sidebar -->
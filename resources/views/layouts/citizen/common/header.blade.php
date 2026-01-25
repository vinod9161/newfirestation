<!-- app-header -->
<header class="app-header">
    <!-- Start::main-header-container -->
    <div class="main-header-container container-fluid">

        <!-- Start::header-content-left -->
        <div class="header-content-left">

            <!-- Start::header-element -->
            <div class="header-element  d-flex align-items-center">
                <div class="horizontal-logo">
                    <a href="{{ route('admin.dashboard') }}" class="header-logo">
                        <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-logo">
                        <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-logo">
                        <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-dark">
                        <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-dark">
                        <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="desktop-white">
                        <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="Logo" class="toggle-white">
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-left -->

        <!-- Start::header-content-right -->
        <div class="header-content-right">

        
            <!-- Start::header-element -->
            <div class="header-element">
                <!-- Start::header-link|dropdown-toggle -->
                <a href="javascript:void(0);" class="header-link  dropdown-toggle" id="mainHeaderProfile"
                    data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                    <div class="d-flex align-items-center">
                        <div>
                            <img src="{{ asset('/public/admin/images/fire-logo.webp') }}" alt="img" width="30" height="30"
                                class="rounded-circle">
                        </div>
                    </div>
                </a>
                <!-- End::header-link|dropdown-toggle -->
                <div class="main-header-dropdown dropdown-menu pt-0 overflow-hidden header-profile-dropdown dropdown-menu-end"
                    aria-labelledby="mainHeaderProfile">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">{{ Auth::user()->name }}</h6>
                    </div>
                    
                    <a class="dropdown-item fs-13 border-top text-wrap" href="{{route('citizen.account')}}">
                        <i class="fe fe-user fs-15 me-2 d-inline-flex"></i> Dashboard
                    </a>

                    <a class="dropdown-item fs-13 text-wrap" href="{{ route('citizen.profile') }}">
                        <i class="fa fa-cog fs-15 me-2 d-inline-flex"></i> Profile
                    </a>

                    <a class="dropdown-item fs-13 text-wrap" href="{{ route('auth.logout') }}">
                        <i class="fe fe-power fs-15 me-2 d-inline-flex"></i> Sign Out
                    </a>
                </div>
            </div>
            <!-- End::header-element -->

        </div>
        <!-- End::header-content-right -->

    </div>
    <!-- End::main-header-container -->

</header>
<!-- /app-header -->
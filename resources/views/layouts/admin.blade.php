<!DOCTYPE html>
<html lang="en">
   <!-- Mirrored from gambolthemes.net/html-items/gambo_admin/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 08 Jun 2021 13:22:53 GMT -->
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description-gambolthemes" content="">
      <meta name="author-gambolthemes" content="">
      <!-- Favicons -->
      <link href="{{ asset('/fire/gallery/fav.png') }}" rel="icon">
      <link href="{{ asset('/fire/gallery/app-fav.png') }}" rel="apple-touch-icon">
      <title>Uttarakhand Fire Services</title>
      <link href="{{ asset('/admin/css/styles.css') }}" rel="stylesheet">
      <link href="{{ asset('/admin/css/admin-style.css') }}" rel="stylesheet">
      <link href="{{ asset('/admin/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
      <link href="{{ asset('/admin/css/bootstrap-glyphicons.css') }}" rel="stylesheet">
      <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
      <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/amsify.select.css') }}">
      @font-face {
         font-family: Kruti Dev 010;
         font-style: normal;
         font-weight: normal;
         src: url("font/kurtidev.ttf") format("truetype");
      }
   </head>
   <body class="sb-nav-fixed">
      <nav class="sb-topnav navbar navbar-expand navbar-light bg-clr">
         <a class="navbar-brand logo-brand" style="color: #fff!important;width: 194px!important">UK Fire Services</a>
         <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#" style=""><i class="fas fa-bars"></i></button>
         <ul class="navbar-nav ml-auto mr-md-0">
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
               <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                  <a class="dropdown-item admin-dropdown-item" href="#">Welcome {{ Auth::user()->name }}</a>
                  <a class="dropdown-item admin-dropdown-item" href="#">Edit Profile</a>
                  <a class="dropdown-item admin-dropdown-item" href="#">Change Password</a>
                  <a class="dropdown-item admin-dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                     @csrf
                  </form>
               </div>
            </li>
         </ul>
      </nav>
      <div id="layoutSidenav">
         <div id="layoutSidenav_nav">
            @include('layouts.side_bar')
         </div>
         <div id="layoutSidenav_content">
            <main class="main-content" style="padding:0 20px 0 20px;">
               @yield('content')
            </main>
            <footer class="py-4 bg-footer mt-auto">
               <div class="container-fluid">
                  <div class="d-flex align-items-center justify-content-between small">
                     <div class="text-muted-1">© {{ now()->year }} <b>Uttarakhand Fire Services</b>. by Information Technology Development Agency (ITDA), Department of IT, Good Governance & Science Technology, Government of Uttarakhand.</div>
                     <div class="footer-links">
                        <a href="">Privacy Policy</a>
                        <a href="">Terms &amp; Conditions</a>
                     </div>
                  </div>
               </div>
            </footer>
         </div>
      </div>

      <script src="{{ asset('/admin/js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('/admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
      <script src="{{ asset('/admin/js/scripts.js') }}"></script>
      <script src="{{ asset('/assets/js/popper.min.js') }}"></script>
      <script src="{{ asset('/assets/js/bootstrap.min.js') }}"></script>
      <script src="{{ asset('/assets/js/slick.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery-ui.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
      <script src="{{ asset('/assets/js/imagesloaded.pkgd.js') }}"></script>
      <script src="{{ asset('/assets/js/isotope.pkgd.min.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery.magnific-popup.min.js') }}"></script>
      <script src="{{ asset('/assets/js/zabuto_calendar.js') }}"></script>
      <script src="{{ asset('/assets/js/main.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/admin/js/jquery.dataTables.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/admin/js/dataTables.bootstrap.min.js') }}"></script>

      <script type="text/javascript" src="{{ asset('/assets/js/jquery.amsifyselect.js') }}"></script>
      <script type="text/javascript">
         @yield ('scripts');
      </script>
   </body>
</html>
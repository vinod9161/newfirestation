<!DOCTYPE html>
<html class="no-js">
   <head>
      <meta charset="utf-8">
      <meta name="description" content="Uttrakhand Fire and Emergency Services">
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
      <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap&amp;subset=vietnamese"> -->
      <!-- Favicons -->
      <link href="/fire/gallery/fav.png" rel="icon">
      <link href="/fire/gallery/app-fav.png" rel="apple-touch-icon">
      <title>Uttrakhand Fire and Emergency Services</title>
      <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.min.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/fontawesome.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/flaticon-category.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/slick.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/jquery-ui.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/jquery.mCustomScrollbar.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/magnific-popup.css') }}">
      <link rel="stylesheet" href="{{ asset('/assets/css/main.css') }}">
      <link href="{{ asset('/assets/css/bootstrap-multiselect.min.css') }}" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/amsify.select.css') }}">
     <!--  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->

      <style type="text/css">
      .edit-profile label {
          margin-bottom: 5px;
          margin-top: 10px;
      }

      body{
         overflow-x: hidden;
      }

      .rb{
         vertical-align: middle;
      }

      .form-group label {
         font-size: 12px;
         margin-bottom:4px;
         font-weight: 600;
      }

      .form-group  input{
         height: 30px;
         font-size: .8em;
      }
      .form-group  select{
         height: 30px;
         font-size: .8em;
      }

      .form-group {
         margin-bottom: 0px;
      }

      .row {
         margin-top: 10px;
      }

      .header-site{
         margin-bottom: 0px;
      }
      </style>
      
   </head>
   <body>
      <div class="wrapper" id="wrapper">
         <header class="header-site" id="header">
            <div class="container-fluid">
               <div class="header-wrap">
                  <div class="header-left">
                     <div class="header-main-toggle">
                        <button class="btn-toggle" type="button" data-toggle="offcanvas"><i class="fas fa-bars"></i></button>
                     </div>
                     <div class="header-logo"><a class="qdesk-logo" href="#" title="QDesk"><img class="qdesk-logo-white" src="{{ asset('/assets/images/fire-logo.png') }}" alt="Uttrakhand Fire and Emergency Services" style="max-width: 50%;"><img class="qdesk-logo-black" src="{{ asset('/assets/images/fire-logo.png') }}" alt="Uttrakhand Fire and Emergency Services" style="max-width: 50%;"></a></div>
                     <div class="navigation" id="navigation">
                        <ul class="main-menu">
                           <li class="" id="home-lis"><a href="{{route('admin.index')}}">Home</a></li>
                           <li class="" id="home-lis"><a href="{{route('admin.home')}}">Actions</a></li>
                           <li class="" id="home-lis"><a href="{{route('leave')}}">Leaves</a></li>
                            <li class="" id="home-lis"><a href="{{route('admin.noc',['type'=>'all'])}}">Applications</a></li>
                           <li class="" id="fireReport-lis"><a href="{{route('admin.fireReport')}}">Fire Report</a></li>
                           <li class="" id="rescue-lis"><a href="{{route('admin.rescue')}}">Rescue Report</a></li>
                           <li class="" id="relief-lis"><a href="{{route('admin.relief')}}">Relief Report</a></li>
                           <li class="" id="hydrant-lis"><a href="{{route('admin.hydrant')}}">Hydrant</a></li>
                           <li class="" id="employee-lis"><a href="{{route('admin.employee')}}">Employees</a></li>
                           <li class="" id="vehicle-lis"><a href="{{route('admin.vehicle')}}">Vehicle and Machine</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="header-right">
                     @if(auth()->user()!='')
                     <div class="header-right-logined">
                        <div class="user-profile-logined">
                           <div class="header-user">
                              <div class="avatar" style="max-width: 50px;"><a href="#"><img src="{{Auth::user()->profile->image ?? '/assets/images/placeholder.png' }}" alt="{{Auth::user()->first_name }}"></a><span class="status active"></span></div>
                              <div class="info-user">
                                 <h3> <a data-toggle="collapse" href="#user-profile-dropdown">{{ucwords(Auth::user()->name)}} <i class="fas fa-caret-down" style="margin-right:5px;margin-left: 5px;"></i></a></h3>
                                 <div class="user-profile-dropdown collapse" id="user-profile-dropdown">
                                    <ul>
                                       @if(auth()->user()->type==0)
                                       <li><a href="javascript:void(0)" style="color: #000;">Admin Dashboard</a></li>
                                       @elseif(auth()->user()->type==1 || auth()->user()->type==2 || auth()->user()->type==3 || auth()->user()->type==5)
                                       <li><a href="javascript:void(0)" style="color: #000;">Department Dashboard</a></li>
                                       <li><a href="{{route('admin.uploadUserSignature')}}" style="color: #000;">Upload Signature</a></li>
                                       @elseif(auth()->user()->type==4)
                                       <li><a href="javascript:void(0)" style="color: #000;">Citizen Dashboard</a></li>
                                       @endif
                                       <li>
                                          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #000;">Sign Out</a>
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                             @csrf
                                          </form>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     @else
                     <ul  id="login-menu">
                        <li id="post-lis"><a id="pos-lis-a" href="{{route('login')}}"><i class="fas fa-plus-circle"></i> Post a Job</a></li>
                        <li id="login-lis"><a id="login-lis-a" href="{{route('login')}}"><i class="fas fa-sign-out-alt"></i> Sign In</a></li>
                        <li id="register-lis"><a id="register-lis-a" href=""><i class="fas fa-registered"></i> Register</a></li>
                     </ul>
                     @endif
                  </div>
               </div>
            </div>
         </header>
         <div class="menu-mobile-wrap">
            <div class="menu-mobile-content">
               <div class="menu-mobile-profile">
                  <div class="line">
                     <button class="button btn-menu-close" type="button"></button>
                  </div>
                  <ul class="user-profile" id="login-menu">
                     <li><a href="#"><i class="fas fa-plus-circle"></i> Post a Job</a></li>
                     <li id="login-lis"><a href="29_sign_in.html"><i class="fas fa-sign-out-alt"></i> Sign In</a></li>
                     <li id="register-lis"><a href="30_register.html"><i class="fas fa-registered"></i> Register</a></li>
                  </ul>
               </div>
            </div>
         </div>
         <main class="main-content">
            @yield('content')
         </main>
         <footer class="footer-site" id="footer" style="margin-top: 0px;">
            <div class="container">
               <!-- <div class="footer-top" style="padding: 0px;margin-bottom: 0px;">
                  <div class="row align-items-center text-center text-lg-left">
                     <div class="col-lg-4 mb-2 mb-lg-0"><img src="{{ asset('/assets/images/fire-logo.png') }}" alt="Uttrakhand Fire and Emergency Services" style="max-width: 26%;"></div>
                     <div class="col-lg-8">
                        <ul class="nav-footer">
                           <li><a href="#">Privacy Policy</a></li>
                           <li><a href="#">Terms & Conditions</a></li>
                           <li><a href="#">Help</a></li>
                           <li><a href="#">Partners</a></li>
                        </ul>
                     </div>
                  </div>
               </div> -->
               <div class="footer-bottom">
                  <div class="copyright">© {{ now()->year }} <span class="text-green">Uttrakhand Fire and Emergency Services</span><span class="text-white"> </span> Design by <span class="text-white">Information Technology Development Agency (ITDA), Department of IT, Good Governance & Science Technology, Government of Uttarakhand.</span>. All Rights Reserved</div>
               </div>
            </div>
         </footer>
      </div>
      <!-- <script src="{{ asset('/assets/js/jquery.min.js') }}"></script> -->
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
      <script src="{{ asset('/assets/js/bootstrap-multiselect.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/admin/js/jquery.dataTables.min.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/admin/js/dataTables.bootstrap.min.js') }}"></script>
      <script src="{{ asset('/assets/js/jquery-searchbox.js') }}"></script>
      <script type="text/javascript" src="{{ asset('/assets/js/jquery.amsifyselect.js') }}"></script>
      <script type="text/javascript">
         @yield ('scripts');
      </script>
   </body>
</html>
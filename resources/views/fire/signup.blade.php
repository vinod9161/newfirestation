<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Signup- fire & emergency services</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="gallery/fav.png" rel="icon">
  <link href="gallery/app-fav.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

<div class="top1 fixed-top">
    <div class="container-fluid">
        <div class="row" >
            <div class="col-md-1">
            </div>
            <div class="col-md-10 text-right">
              <p><i class="fa fa-phone" aria-hidden="true"></i> Toll Free : 180027012513</p>
             </div>
        </div>
    </div>
</div>
     
  

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top ">

    <div class="container-fluid">

      <div class="logo float-left">
         <a href="{{ route('actionIndex')}}"><img src="gallery/logort1.png" alt="" class="img-fluid"></a>

      </div>

      <div class="logo float-right">
        <a href="{{ route('actionIndex')}}"><img src="gallery/uk-logo.png" alt="" class="img-fluid"></a>

     </div>

    </div>
  </header><!-- End Header -->








  <main id="main">
    <div class="container">
        <div class="row">
            <div class="col-md-2">

            </div>

      <div class="col-md-8 sign-up" >
        <h2 style="margin-bottom: 20px;">Sign-up</h2>


        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
            <div class="form-row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="First Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validate"></div>
              </div>

              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Last Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                <div class="validate"></div>
              </div>
              <div class="col-md-6 form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validate"></div>
              </div>

              <div class="col-md-6 form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="Re-Enter Email" data-rule="email" data-msg="Please enter a valid email" />
                <div class="validate"></div>
              </div>

              <div class="col-md-6 form-group">
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" required>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
              </div>

              <div class="col-md-6 form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                <div class="validate"></div>
              </div>
            </div>
   
            <div class="text-center"><button type="submit" class="signup-btn">Send Message</button></div>
          </form>

          
            </div>


        </div>
    </div>

  </main><!-- End #main -->

  
<div class="login-footer">


  <div class="container">
    <div class="row">
      <div class="col-md-12">
      <p>© Copyright 2020 uttarakhandfireservice.com. All Rights Reserved<br>
   </div>
    </div>
   
  </div>
</div>


  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
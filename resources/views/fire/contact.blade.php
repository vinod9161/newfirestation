@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Contact</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Contact</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
    <section class="contact flagday-section py-5" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
  
          <div class="row content-card content-text">
  
            <div class="col-lg-6">
  
              <div class="row">
                <div class="col-md-12">
                  <div class="info-box">
                    <i class="bx bx-map"></i>
                    <h3>Our Address</h3>
                    <!-- <p>Uttarakhand Fir Service,<br>4<sup>th</sup> Floor, Police Complex Building <br> Kutchery Road, Dehradun</p> -->
                    <p>{{ $contact->address}}</p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box">
                    <i class="bx bx-envelope"></i>
                    <h3>Email Us</h3>
                    <!-- <p>fshq.ukfs@gmail.com</p> -->
                    <p>{{ $contact->email}}</p>

                  </div>
                </div>
                <div class="col-md-6">
                  <div class="info-box">
                    <i class="bx bx-phone-call"></i>
                    <h3>Call Us</h3>
                    <!-- <p>0135-2716201</p> -->
                    <p>{{ $contact->phone}}</p>

                  </div>
                </div>
              </div>
  
            </div>
  
            <div class="col-lg-6">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="form-row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validate"></div>
                  </div>
                </div>

                <div class="form-row">
                  <div class="col-md-6 form-group">
                    <input type="tel" name="phone" class="form-control" id="phone" placeholder="Your Phone Number" data-rule="minlen:4" data-msg="Please enter a valid number" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="text" class="form-control" name="Subject" id="subject" placeholder="Subject" data-rule="email" data-msg="Please enter at least 8 chars of subject" />
                    <div class="validate"></div>
                  </div>
                </div>

                
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                  <div class="validate"></div>
                </div>
                <div class="mb-3">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>
                </div>
                <div class="text-center"><button type="submit">Send Message</button></div>
              </form>
            </div>
  
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3444.142184363954!2d78.03797076545017!3d30.318473281783376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39092995a877e34d%3A0xd501c1e577d4d8cb!2spolice%20Fire%20Station!5e0!3m2!1sen!2sin!4v1599112175596!5m2!1sen!2sin" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>  
    </div>
  </div>
</section>
  <!-- End Map Section -->
@endsection
@section('scripts')
@stop
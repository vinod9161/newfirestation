@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Grievance</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Grievance</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->



    <section class="contact" data-aos="fade-up" data-aos-easing="ease-in-out" data-aos-duration="500">
        <div class="container">
  
          <div class="row">
  
    
  
            <div class="col-lg-12">
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="form-row">
                  <div class="col-md-6 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <input type="tel" class="form-control" name="email" id="phone" placeholder="Your Phone Number" data-rule="number" data-msg="Please enter a valid number" />
                    <div class="validate"></div>
                  </div>
                  
                  <div class="col-md-6 form-group">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validate"></div>
                  </div>
                <div class=" col-md-6 form-group">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
                  <div class="validate"></div>
                </div>

                <div class="col-md-6 form-group">
                    <input type="text" name="District" class="form-control" id="district" placeholder="District" data-rule="minlen:4" data-msg="Please enter valid text" />
                    <div class="validate"></div>
                  </div>

                
            </div>

            
         

                <div class="form-group">
                  <textarea class="form-control" name="Your Grivances" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Feedback/Suggestions"></textarea>
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
  
          </div>
  
        </div>
      </section><!-- End Contact Section -->
@endsection
@section('scripts')
@stop

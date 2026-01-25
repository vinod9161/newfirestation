@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Fire Safety in different Program</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Fire Safety in different Programe</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

    <!-- ======= About Section ======= -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center"> Fire Safety in different Program</h3>
                    <p class="why-us section-bg aos-init aos-animate" style="padding: 30px;">Uttarakhand Fire and Emergency department issue fire safety guidelines /provide standby duty service to protect citizen/public from mishappening due to fire. Nominal charges shall be apply on the personal request subject to availability
                    </p>
                </div>
            </div>
            </div>
    </section>


    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>

            <div class="col-lg-10">
                     <h3 style="margin:20px ;" class="text-center">Request for standby duties </h3>
              <form action="forms/contact.php" method="post" role="form" class="php-email-form">
                <div class="form-row">
         
                  <div class="col-md-6 form-group">
                    <label><strong>Name</strong></label>

                    <input type="text" name="Name" class="form-control" id="name" placeholder="Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
                    <div class="validate"></div>
                  </div>
                  <div class="col-md-6 form-group">
                    <label><strong>District</strong></label>

                    <select name="district" class="custom-select" data-msg="Please enter at least 4 chars" >
                      <option selected>Your District</option>
                      <option value="  Dehradun"> Dehradun</option>
                      <option value="Haridwar">Haridwar</option>
                      <option value="Tehri">Tehri</option>
                      <option value="Pauri Gharwal">Pauri Gharwal</option>
                      <option value="Uttarakashi">Uttarakashi</option>
                      <option value="Chamoli">Chamoli</option>
                      <option value=" Rudraprayag"> Rudraprayag</option>
                      <option value="Almora">Almora</option>
                      <option value="Nanital">Nanital</option>
                      <option value="Bageshwar">Bageshwar</option>
                      <option value="Champawat">Champawat</option>
                      <option value="Pithoraghar">Pithoraghar</option>
                      <option value="Udham Singh Nagar">Udham Singh Nagar</option>
                  
                    </select>
                  </div>

                  <div class="col-md-6 form-group">
                    <label><strong>Mobile Number</strong></label>

                    <input type="tel" name="phone" class="form-control" id="phone" placeholder="Your Mobile  Number" data-rule="minlen:4" data-msg="Please enter a valid number" />
                    <div class="validate"></div>
                  </div>

                  <div class="col-md-6 form-group">
                    <label><strong>Email</strong></label>

                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email Address" data-rule="email" data-msg="Please enter a valid email" />
                    <div class="validate"></div>
                  </div>

                  <div class="col-md-6 form-group">
                    <label><strong>From Date</strong></label>

                    <input type="date" name="From date" class="form-control" id="fromdate" placeholder="From date" data-rule="minlen:4" data-msg="Please enter a valid date" />
                    <div class="validate"></div>
                  </div>
        

                    <div class="col-md-6 form-group">
                        <label><strong>To Date</strong></label>
                      <input type="date" name="To date" class="form-control" id="todate" placeholder="To date" data-rule="minlen:4" data-msg="Please enter a valid date" />
                      <div class="validate"></div>
                    </div>

                    <div class=" col-md-12 form-group">
                        <label><strong>Your Message</strong></label>

                        <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                        <div class="validate"></div>
                      </div>

 
                 
                </div>
      
             
        
                <button type="submit" class="btn btnc mb-2">Submit</button>  
               </form>
            </div>

            <div class="col-lg-1"></div>

        </div>
    </div>

@endsection
@section('scripts')
@stop

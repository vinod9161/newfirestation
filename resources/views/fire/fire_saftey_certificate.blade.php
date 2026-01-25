@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Fire Saftey Certificate</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Fire Saftey Certificate</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

   <!-- ======= About Section ======= -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">NOC from the Fire Department</h3>
                    <p class="why-us section-bg aos-init aos-animate" style="padding: 30px;">The no-objection certificate is issued by the Fire department after verifying and auditing the building's fire resistance and fire safety mechanism which should be at par with the fire safety standards and guidelines as stated by The Bureau of Indian         Standards(BIS) and concerned state government respectively. After complete        inspection when the fire department finds the safety mechanism meets the required standards, it issues the NOC (Non-Objection Certificate) for the building of the applicant.
                    </p>
                </div>
            </div>
            </div>
    </section>


    <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>

            <div class="col-md-4">
                <a href="#" class="btn btnc">Required document for fire NOC</a>
            </div>

            <div class="col-md-4">
                <a href="=#" class="btn btnc">How to apply for fire NOC</a>
            </div>

            <div class="col-md-2">
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12 why-us section-bg aos-init aos-animate" style="padding: 30px; margin: 20px 0px 30px 0px;">
              <h3 class="text-center"><strong>Why it is so important to take fire NOC</strong></h3>
              <p> Fire safety, timely safety measures, and precautions are few of the important factors which are concerning everyone these days. As with the growing incidents of break of fire in office buildings, hospitals, coaching centers, commercial buildings, industries,  the Fire Department is under the direction of government to make the necessary audit of all buildings falling under the category of NBC Part 4 and taking legal action an can stop/seal it from further use till the compliance is done as per recommendations. Hence, In order to avoid any undesirable happenings or danger to life due to sudden break of fire, it is need of the hour for all users to strictly comply with provisions and procedures of fire safety measures not only in papers but practically too. </p>

              <div class="row">
              <div class="col-md-3">
              </div>
      
              <div class="col-md-6">
                <a href="loginform.html" class="btn btnc">Apply For Fire NOC</a>
              </div>
      
              <div class="col-md-3">
              </div>

              </div>
            </div>
        </div>


    </div>

@endsection
@section('scripts')
@stop

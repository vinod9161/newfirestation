@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Consultation in fire and safety</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li>Consultation in fire and safety </li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->


<div class="container">
  <div class="row">
      <div class="col-md-12">
        <h5 style="padding: 20px;">Thousands of new homes and business premises are built in Uttarakhand  every year – we help to reduce fire risks as they are constructed. Uttarkhand fire and emergency service provide its free of cost consultancy to the people regarding fire and life safety of the mega infrastructure/ city/ area/ function/  building or in town planning. we help the people to be safe during emergency by consultancy in case of fire and life safety, to preparing their escape plan, doubt about keeping their safety equipments in working condition. 
        </h5>
      </div>
    </div>
</div>


<div class="container">
  <div class="row">
        <div class="col-md-12" style="padding: 20px;">
          <h5><strong>Do you know most of the fire incident occur in residential building. What is good routine to prevent fire in home </strong></h5>
          <p><li>Close all your internal doors to prevent smoke spreading if a fire starts</li>
            <li>Check you wire regularly, don't put many switches in one plug. don't use loose wire for operating any equipments. 
            </li>
            <li>Turn off and unplug electrical appliances unless they are designed to be left on – like your fridge or freezer.</li>
            <li>Don’t leave the washing machine, tumble dryer or dishwasher on overnight and unattended.</li>
            <li>Don’t leave mobile phones, tablets,  charging overnight</li>
            <li>Check that your hob and oven switches are all off.    </li>
            <li>Turn heaters off, rake out fires and put a fire guard in place. </li>
            <li>Put candles, incense sticks and oil burners out and never leave them burning when you are aslee</li>
            <li>Make sure cigarettes are completely out – wet them to be sure.    </li>
            <li>Never smoke in bed – it's best to quit.  </li>
            <li>Check your LPG gas cylinder before installation, cooking gas pipe. </li>
            <li>Make sure escape routes are clear of anything that may slow your escape down.</li>
            <li>Keep door and window keys where everyone you live with can find them. </li>
            <li>If you or anyone else in the home has mobility issues, ensure mobility aids and methods of calling for help (like emergency pendants) are close to hand in case help is needed to assist with an escape</li>
        </p>

        </div>
  </div>
</div>
<div class="container">
  <!-- <div class="row">
    <div class="col-md-12">
      <div class="col-sm-12 ">
        <h3 style="margin-top: 40px;">
          Know your building's fire risk
      
        </h3>
      
      
        <div class="row" style="margin-bottom: 50px;">
      
            <div class="col-md-12">
                <div class="pull-right">
                    <button type="button" class="collapsible">Click Here </button>
                    <div class="content">
                        <form id="verifier-forms" action="/fireservice/application/applicationstatus" method="post">    
                            <div class="form-group" style="margin-top: 10px ;">
                              <label for="email">(1) Type Your Previous UID Here</label>
                          <input placeholder="Application UID" class="form-control" name="ApplicationStatus[uuid]" id="ApplicationStatus_uuid" type="text">                <div class="errorMessage" id="ApplicationStatus_uuid_em_" style="display:none"></div>                </div>
              
                           <input class="btn btn-success" style="margin-bottom: 10px;"type="submit" name="yt0" value="Submit"></form> 
                    </div>
                    </div>
                </div>
      
                <div class="col-md-6">
      
                </div>
            </div>
      </div>
    </div> -->

<div class="col-md-12">
  <div class="col-sm-12 ">
    <h3 style="margin-top: 40px;">
      For other consultation please write to us. or feel free to visit your nearest fire station
  
    </h3>
    <div class="col-lg-12">
      <!-- <form method="post" id="contactForm" class="contactForm"> -->
        <div class="form-row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
            <div class="validate"></div>
          </div>

          <div class="col-md-6 form-group">
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
              <input type="tel" name="phone" class="form-control" id="phone" placeholder="Your Phone Number" data-rule="minlen:4" data-msg="Please enter a valid number" />
              <div class="validate"></div>
            </div>
         
            <div class="col-md-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validate"></div>
            </div>
        
        </div>
  
        <div class="form-group">
          <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
          <div class="validate"></div>
        </div>
     

        <button type="submit" id="infoBtn" class="btn btn-primary mb-2">Submit</button>        
      <!-- </form> -->
    </div>
  </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  $(document).ready(function () {
    $('#infoBtn').click(function () {
      // alert("ok");
      // return false;
      let name = $('#name').val();
      let email = $('#email').val();
      let phone = $('#phone').val();
      let district = $('#district');
      let message = $('#message');

      if (name === '' || email === '' || phone === '' || district === '' || message === '') {
        alert("Please fill all the fields.");
      } else {
        alert("Your message has been sent successfully.");
      }
    });
  });
</script>

 @endsection
@section('scripts')


@stop
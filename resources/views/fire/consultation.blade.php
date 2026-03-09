@extends('layouts.fire_new')
@section('content')
<style>
   /* Move submit button to right */
   .form-submit-right {
      display: flex;
      justify-content: flex-end;
   }

   /* Optional: fixed button width */
   .form-submit-right .btn {
      min-width: 150px;
   }
   .btn-danger{
      color: #fff; background-color: #00258e; border-color: #00258e;
   }
   .btn-danger:hover{
      color: #fff; background-color: #00258e; border-color: #00258e;
   }

</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Consultation in fire and safety</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Consultation in fire and safety</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<section class="flagday-section py-5">
  <div class="container">
    <div class="row content-card content-text">
      <div class="col-md-12">
        <h4 class="title">Consultation in Fire and Life Safety</a></h4>
        <p>Thousands of residential and commercial buildings are constructed in Uttarakhand every year. Uttarakhand Fire and Emergency Service provides free fire and life safety consultancy to help reduce fire risks at the planning, construction, and occupancy stages.
          The department offers expert guidance for mega infrastructure projects, urban areas, public functions, buildings, and town-planning initiatives. The consultancy aims to enhance public safety by advising on:
        </p>
        <p>

          <li>Fire and life safety measures</li>
          <li>Emergency evacuation and escape planning</li>
          <li>Proper installation and maintenance of fire safety equipment</li>
          <li>Operational readiness of safety systems</li>
        </p>
        <!-- <p>
            General Fire Safety measures in Residential Buildings:-
            A majority of fire incidents occur in residential premises. Adopting safe daily practices can significantly reduce the risk of fire.
            Essential Fire Prevention Guidelines for Homes
          </p>
          <p>
            <li>Keep internal doors closed at night to limit smoke spread during a fire.</li>
            <li>Inspect electrical wiring regularly; avoid overloading sockets and using loose or damaged wires.</li>
            <li>Switch off and unplug electrical appliances when not in use, except those designed for continuous operation.</li>
            <li>Do not operate washing machines, dryers, or dishwashers unattended or overnight.</li>
            <li>Avoid charging mobile phones and electronic devices overnight.</li>
            <li>Ensure cooking appliances and gas stoves are completely switched off after use.</li>
            <li>Turn off heaters and use fire guards where applicable.</li>
            <li>Extinguish candles, incense sticks, and oil lamps before sleeping.</li>
            <li>Ensure cigarettes are fully extinguished; never smoke in bed.</li>
            <li>Check LPG cylinders and gas pipelines</li>
            <li>before installation and during use.</li>
            <li>Keep all escape routes free from obstructions.</li>
            <li>Store door and window keys in easily accessible locations.</li>
            <li>For occupants with mobility challenges, ensure assistive devices and emergency communication systems are readily available.</li>
          </p> -->

      </div>





      <!-- <div class="col-md-12">
        <h3 style="margin-top: 40px;">
          For consultation please feel free to contact your nearest fire station      
        </h3>
        <div class="col-lg-12">
            <div class="form-row">

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
        </div>
      </div> -->


    </div>
  </div>
</section>

<section class="flagday-section pb-5">
  <div class="container">
    <div class="row justify-content-center content-card content-text">
      <div class="col-lg-10">

        <h2 class="mb-4">
          For consultation please feel free to contact your nearest fire station
        </h2>

        <form>
          <div class="form-row">
            <div class="col-md-6 form-group">
              <select name="district" id="district" class="custom-select" style="padding:8px">
                <option value="">Your District</option>
                @foreach($district as $dist)
                <option value="{{$dist->id}}">
                  {{ucfirst($dist->name)}}
                </option>
                @endforeach
              </select>
            </div>

            <div class="col-md-6 form-group">
              <select name="fire_station" id="fire_station" class="custom-select" style="padding:8px">
                <option value="">Your Fire Station</option>
              </select>
            </div>
            <div class="col-md-12 form-group form-submit-right">
              <button type="button" id="viewDetails" class="btn btn-danger px-4">
                View Details
              </button>
            </div>
          </div>

        </form>

        <div id="stationDetails" class="mt-4" style="display:none;">
          <h4>Fire Station Details</h4>
          <table class="table table-bordered">
            <tbody id="detailsBody"></tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  var fireStations = @json($firestation);
  var officers = @json($officers);
  document.getElementById("district").addEventListener("change", function() {

    var districtId = this.value;
    var stationDropdown = document.getElementById("fire_station");

    // Reset dropdown
    stationDropdown.innerHTML = '<option value="">Your Fire Station</option>';

    if (districtId === "") return;

    // Filter stations
    var filteredStations = fireStations.filter(function(station) {
      return station.district_id == districtId && station.status == 1;
    });

    // Append options
    filteredStations.forEach(function(station) {
      var option = document.createElement("option");
      option.value = station.id;
      option.text = station.name;
      stationDropdown.appendChild(option);
    });

  });
</script>
<script>
document.getElementById("viewDetails").addEventListener("click", function () {

    var stationId = document.getElementById("fire_station").value;
    var detailsSection = document.getElementById("stationDetails");
    var button = this;

    if (!stationId) {
        alert("Please select a fire station");
        return;
    }

    // If already visible and same station selected → toggle hide
    if (detailsSection.style.display === "block" && button.dataset.station == stationId) {
        detailsSection.style.display = "none";
        button.innerText = "View Details";
        button.dataset.station = "";
        return;
    }

    var station = fireStations.find(function(s) {
        return s.id == stationId;
    });

    if (!station) return;

    // Get all users assigned to this station
    var stationUsers = officers.filter(o => o.station_id == station.id);

    // If only one officer per station
    var officer = stationUsers.length > 0 ? stationUsers[0] : null;

    var officerName = officer ? officer.name : '-';
    var officerEmail = officer ? officer.email : '-';
    var officerMob = officer ? officer.number : '-';

    var tableContent = `
        <tr><th>Fire Station Name</th><td>${station.name}</td></tr>
        <tr><th>Address</th><td>${station.address ?? '-'}</td></tr>
        <tr><th>Building</th><td>${station.building ?? '-'}</td></tr>
        <tr><th>Fire Station Officer</th><td>${officerName}</td></tr>
        <tr><th>FSO Email ID</th><td>${officerEmail}</td></tr>
        <tr><th>FSO Mobile No</th><td>${officerMob}</td></tr>
    `;


    document.getElementById("detailsBody").innerHTML = tableContent;
    detailsSection.style.display = "block";

    // Change button text
    button.innerText = "Hide Details";
    button.dataset.station = stationId;

    // Smooth scroll
    detailsSection.scrollIntoView({ behavior: "smooth" });

});
</script>


@endsection
@section('scripts')


@stop
@extends('layouts.fire_new')
@section('content')
    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Disaster search,rescue and relief work</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Disaster search,rescue and relief work</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

   <!-- ======= About Section ======= -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 ><strong>Disaster Search, Rescue and Relief Work</strong></h3>
                    <p class="why-us section-bg aos-init aos-animate" style="padding: 30px;">Fire Service in Uttarakhand state  broadly extinguishing fire and protecting life and property in case of fire.  Fire Service role has changed dramatically in the last few years.   The fire service responds to every manmade or natural disaster, hazardous material incidents, advanced emergency medical situations, high angle rescue and confined space rescue incidents, trench and collapse operations, underwater rescue and more.  In the immediate aftermath of any disaster fire service become the first responder and save the life of people. this department also provide its services in relief work
                    </p>
                </div>
            </div>
            </div>
    </section>


    <div class="container">
        <div class="row" style="margin-bottom: 30px;">
            <div class="col-md-12">
                <h4>Process of Report of Disaster Incident</h4>
                <li>Call 112</li>
                <li>Tell your name and place you are calling from</li>
                <li>Provide the Details asked by Department/Operator</li>
                <li>You can provide further detail also, if you know </li>
                <li>Provide the details of nearest road/landmark if you know</li>
                <li>Provide the coordinate or share the location of incident place, if you know</li>
                <li>Provide the photographs in the chat box if you can</li>
            </div>


        </div>
    </div>
@endsection
@section('scripts')
@stop

  
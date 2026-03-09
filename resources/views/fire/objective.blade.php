@extends('layouts.fire_new')
@section('content')
<style>
    .flagday-section {
      background: #f5f7fb;
    }
    
    .content-card {
        background: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    }
    .page-title {
      color: #0b2a6f;
      font-weight: 600;
    }


    .page-title {
    color: #0b2a6f;
    font-weight: 600;
    }

    .objective-card {
    border: 1px solid #dee2e6;
    border-top: 4px solid #0b2a6f;
    transition: 0.3s;
    height: 100%;
    }

    .objective-card:hover {
    box-shadow: 0 4px 14px rgba(0,0,0,0.15);
    }
    .objective-card:hover .objective-title,
    .objective-card:hover .text-muted,
    .objective-card:hover .read-more,
    .objective-card:hover .objective-icon {
        color: #ffffff !important;
    }
    .card:hover p {
        color: #fff !important;
    }

    .objective-icon {
    font-size: 40px;
    color: #0b2a6f;
    margin-bottom: 10px;
    }

    .objective-title {
    /* color: #0b2a6f; */
    font-weight: 600;
    }

    .read-more {
    /* color: #0b2a6f; */
    font-weight: 500;
    }

    .read-more:hover {
    text-decoration: underline;
    }

    .detail-card {
    background: #f8f9fa;
    border-left: 5px solid #0b2a6f;
    border-color: #0b2a6f;
    }

    .task-list {
    padding-left: 18px;
    }

    .task-list li {
    margin-bottom: 8px;
    }
    .card-body{
      color: #fff;
    }

    


</style>

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Our Objective</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Our Objective</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<!-- ======= About Section ======= -->
<section class="flagday-section py-5">
    <div class="container">

        <div class="row align-items-stretch content-text">
            <div class="col-lg-6 mb-4">
                <div class="content-card h-100">
                    <img src="{{ asset('/public/fire/gallery/f1-new.jpg') }}" class="img-fluid rounded" alt="Fire Safety">
                </div>
            </div>

            <div class="col-lg-6 mb-4">
                <div class="content-card content-text">
                  <!-- <h4 class="title">Objectives of the Uttrakhand Fire and Emergency service Department</a></h4> -->

                  <p class="description">The motto of the Uttarakhand Fire and Emergency Service is “We Serve to Save.”
                    It is derived from the original Sanskrit motto “Tranay Seva Mahe,” which conveys the same spirit of service and protection.
                    Based on this motto, the objectives of the Fire Service are defined in order of priority:</p>
                    
                    <p class="description"> (A) Primary Objective: Saving Life</p>
                    <p class="description"> (B) Secondary Objective: Protection of National and Public Property</p>
                    <p class="description" style="padding-bottom: 18px;"> (C) Tertiary Objective: Salvage and Preservation</p>
                  </p>
                </div>
            </div>

        </div>

    </div>
</section>

<section class="flagday-section">
  <div class="container pb-5">

    <!-- OBJECTIVE CARDS -->
    <div class="row">

      <!-- Primary -->
      <div class="col-md-4 mb-4">
        <div class="card objective-card text-center">
          <div class="card-body">
            <div class="objective-icon">🛡️</div>
            <h5 class="objective-title">Primary Objective</h5>
            <p class="text-muted">Saving Life</p>
            <a class="read-more"
              data-toggle="collapse"
              href="#primaryObj">
              Read More →
            </a>
          </div>
        </div>
      </div>

      <!-- Secondary -->
      <div class="col-md-4 mb-4">
        <div class="card objective-card text-center">
          <div class="card-body">
            <div class="objective-icon">🏛️</div>
            <h5 class="objective-title">Secondary Objective</h5>
            <p class="text-muted">Protection of Property</p>
            <a class="read-more"
              data-toggle="collapse"
              href="#secondaryObj">
              Read More →
            </a>
          </div>
        </div>
      </div>

      <!-- Tertiary -->
      <div class="col-md-4 mb-4">
        <div class="card objective-card text-center">
          <div class="card-body">
            <div class="objective-icon">🚑</div>
            <h5 class="objective-title">Tertiary Objective</h5>
            <p class="text-muted">Salvage & Preservation</p>
            <a class="read-more"
              data-toggle="collapse"
              href="#tertiaryObj">
              Read More →
            </a>
          </div>
        </div>
      </div>

    </div>

    <!-- DETAILS SECTION -->

    <div id="primaryObj" class="collapse objective-detail mt-4">
      <div class="card detail-card">
        <div class="card-body">
          <!-- <h5 class="objective-title">Primary Objective – Saving Life</h5> -->
          <p>
            Smoke is the leading cause of death in fire incidents due to rapid asphyxiation. Fire Service personnel are specially trained to operate in hot, smoke-filled conditions using breathing apparatus and systematic search procedures. Modern materials release highly toxic smoke when burning, making rapid rescue critical. The Fire Service also provides immediate life-saving response during disasters such as building collapses, earthquakes, cloudbursts, and drowning incidents.
          </p>
        </div>
      </div>
    </div>

    <div id="secondaryObj" class="collapse objective-detail mt-4">
      <div class="card detail-card">
        <div class="card-body">
          <!-- <h5 class="objective-title">
            Secondary Objective – Protection of National & Public Property
          </h5> -->
          <p>
            The Fire Service adopts modern firefighting technologies and specialized training to minimize fire damage. Through skilled firemanship, fires are controlled at their source, ensuring effective extinguishment while preventing unnecessary property loss, including damage caused by excessive use of water.
          </p>
        </div>
      </div>
    </div>

    <div id="tertiaryObj" class="collapse objective-detail mt-4">
      <div class="card detail-card">
        <div class="card-body">
          <!-- <h5 class="objective-title">Tertiary Objective – Salvage & Preservation</h5> -->
          <p>
            Uttarakhand Fire and Emergency Service provides ambulance support, first aid, and assistance to people in distress. During fire incidents, a dedicated salvage team works to protect property from damage caused by fire, smoke, and firefighting water.
          </p>
        </div>
      </div>
    </div>


  </div>
</section>

<section class="flagday-section pb-5">
    <div class="container">

        <div class="row align-items-stretch">

            <div class="col-12">
                <div class="content-card content-text">
                  <h4 class="title">Additional Functions of Uttarakhand Fire & Emergency Service:</a></h4>
                  <style>
                      ul {
                          margin: revert;
                          padding: revert;
                          list-style: revert;
                      }
                  </style>
                  <ul>
                    <li>Provides free fire safety advisory to public and institutions.</li>
                    <li>Deploys fire protection during festivals, processions, strikes, and public events.</li>
                    <li>Conducts fire prevention awareness programmes and live demonstrations.</li>
                    <li>Observes Fire Service Day (14 April) to honor martyrs and promote fire safety awareness.</li>
                    <li>Delivers fire safety education in schools, colleges, and institutions on request.</li>
                    <li>Provide fire safety certificate/NOC as per Govt Noms.</li>
                    <li>Safeguards life and property as a core public safety agency.</li>                    
                  </ul>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
@section('scripts')
@stop

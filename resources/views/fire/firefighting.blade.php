@extends('layouts.fire_new')
@section('content')
<style>
  body {
    background: #f4f6f9;
  }

  .status-card {
    border-radius: 15px;
    border: none;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
  }

  .card:hover {
    transform: translateY(-10px) !important;
  }

  .status-card .card-body {
    padding: 15px;
  }

  .left-border {
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    border-radius: 15px 0 0 15px;
  }

  .count-badge {
    font-size: 20px;
    padding: 6px 14px;
    border-radius: 8px;
    font-weight: 600;
    color: #fff;
  }

  .status-title {
    font-size: 14px;
    color: #6c757d;
  }

  .status-text {
    font-size: 20px;
    font-weight: 600;
  }

  .icon-style {
    font-size: 30px;
  }
</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Fire Fighting and Rescue Operation</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Fire Fighting and Rescue Operation</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<section class="services flagday-section py-5">
  <div class="container">
    <div class="row content-card content-text">
      <div class="col-md-12">
        <h3 class="text-center">Fire Fighting and Rescue operation </h3>
        <p class="why-us section-bg aos-init aos-animate">
          The Uttarakhand <b>Fire and Emergency Service</b> is entrusted with the responsibility of <b>firefighting and rescue operations</b> during emergencies and disasters. In Uttarakhand, the department provides its services during the following types of emergencies:
        </p>
        <h3 class="text-center heading pb-4">Fire Fighting </h3>
      </div>

      <div class="col-md-6 mb-4">
        <div class="status-card">
          <div class="left-border bg-success"></div>
          <div class="card-body">
            <div class="status-text text-dark">Structural and non-structural fire fighting</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="status-card">
          <div class="left-border bg-primary"></div>
          <div class="card-body">
            <div class="status-text text-dark">Aircraft fire fighting</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#6f42c1;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Forest fire fighting</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="status-card">
          <div class="left-border bg-warning"></div>
          <div class="card-body">
            <div class="status-text text-dark">Industrial and chemical fire fighting </div>
          </div>
        </div>
      </div>


      <div class="col-md-6 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#00258e;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Confined Space Firefighting</div>
          </div>
        </div>
      </div>

      <div class="col-md-6 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#f44336;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Other specialized fire fighting</div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <h3 class="text-center heading py-4">Rescue </h3>
      </div>
      

      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border bg-success"></div>
          <div class="card-body">
            <div class="status-text text-dark">Industrial accidents</div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border bg-primary"></div>
          <div class="card-body">
            <div class="status-text text-dark">Chemical spillage</div>
          </div>
        </div>
      </div>
    
      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#6f42c1;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Structure collapse</div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border bg-warning"></div>
          <div class="card-body">
            <div class="status-text text-dark">Vehicle accidents</div>
          </div>
        </div>
      </div>


      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#00258e;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Earthquake & Landslide </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#f44336;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Flash flood</div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#8bc34a;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Flood</div>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#9e9e9e;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Mountain search and rescue</div>
          </div>
        </div>
      </div>     
      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#2a16e9d1;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Highrise building rescue </div>
          </div>
        </div>
      </div>     
      <div class="col-md-4 mb-4">
        <div class="status-card">
          <div class="left-border" style="background:#fa00d8d1;"></div>
          <div class="card-body">
            <div class="status-text text-dark">Other type of rescue  </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-md-12 pt-5">
        <h3 class="text-center">Contact to fire service during emergency<br><a href="tel:112">call 112 </a><br><a href="{{route('actionFireUnits')}}" target="_blank">or direct contact to fire stations</a></h3>

      </div>  -->
    </div>
  </div>
</section>

@endsection
@section('scripts')
@stop
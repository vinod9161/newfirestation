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
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
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
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15);
  }

  .objective-card:hover .objective-title,
  .objective-card:hover .text-muted,
  .objective-card:hover .read-more,
  .objective-card:hover .objective-icon {
    color: #ffffff !important;
  }

  .card:hover p,
  .card:hover li,
  .card:hover h5 {
    color: #fff !important;
  }

  .objective-icon {
    font-size: 40px;
    color: #0b2a6f;
    margin-bottom: 10px;
  }

  .objective-title {
    color: #0b2a6f;
    font-weight: 600;
  }

  .read-more {
    color: #0b2a6f;
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
</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Achievements</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Achievements</li>
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
    <div class="row content-card content-text">
      <div class="col-lg-12 d-flex flex-column justify-content-center p-5">
        <h4 class="title text-center">ANNUAL ACHIEVEMENT REPORT</h4>
        <h4 class="title text-center">Uttarakhand Fire and Emergency Service</h4>
        <!-- <h4 class="title ">Year: 2025–26</h4> -->
        <form method="GET">

          <div class="col-md-2">

            <select name="year" class="form-control" onchange="this.form.submit()">

              <option value="">Select Year</option>

              @foreach($years as $yr)

              <option value="{{ $yr }}" {{ $year == $yr ? 'selected' : '' }}>
                {{ $yr }}
              </option>

              @endforeach

            </select>

          </div>
        </form>
      </div>

      <h3 class="text-center heading pb-4" style="width: 100%;">Overview </h3>
      @if($achievement)
      <p>{!! $achievement->overview !!}</p>
      @endif
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
            <h5 class="objective-title">Infrastructure Development</h5>
            <!-- <p class="text-muted">Saving Life</p> -->
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
            <h5 class="objective-title">Recruitment, Promotion & Training</h5>
            <!-- <p class="text-muted">Protection of Property</p> -->
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
            <h5 class="objective-title">Fire & Rescue Operations</h5>
            <!-- <p class="text-muted">During Previous Year (till date):</p> -->
            <a class="read-more"
              data-toggle="collapse"
              href="#tertiaryObj">
              Read More →
            </a>
          </div>
        </div>
      </div>

      <div class="col-md-4 mb-4">
        <div class="card objective-card text-center">
          <div class="card-body">
            <div class="objective-icon">🛡️</div>
            <h5 class="objective-title">Public Awareness & Capacity Building</h5>
            <!-- <p class="text-muted">Saving Life</p> -->
            <a class="read-more"
              data-toggle="collapse"
              href="#primaryObj2">
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
            <h5 class="objective-title">VIP Duties & Safety Enforcement </h5>
            <!-- <p class="text-muted">Protection of Property</p> -->
            <a class="read-more"
              data-toggle="collapse"
              href="#secondaryObj2">
              Read More →
            </a>
          </div>
        </div>
      </div>

    </div>

    <!-- DETAILS SECTION -->

    <div id="primaryObj" class="collapse objective-detail mt-4">
      <div class="card detail-card text-left">
        <div class="card-body">
          <h5 class="objective-title">Infrastructure Development</h5>
          @if($achievement)
          <p>{!! $achievement->infrastructure !!}</p>
          @endif
        </div>
      </div>
    </div>

    <div id="secondaryObj" class="collapse objective-detail mt-4">
      <div class="card detail-card text-left">
        <div class="card-body">
          <h5 class="objective-title">Recruitment, Promotion & Training</h5>
          @if($achievement)
          <p>{!! $achievement->recruitment_training !!}</p>
          @endif
        </div>
      </div>
    </div>

    <div id="tertiaryObj" class="collapse objective-detail mt-4">
      <div class="card detail-card text-left">
        <div class="card-body">
          <h5 class="objective-title">Fire & Rescue Operations</h5>
          @if($achievement)
          <p>{!! $achievement->fire_rescue !!}</p>
          @endif
        </div>
      </div>
    </div>

    <div id="primaryObj2" class="collapse objective-detail mt-4">
      <div class="card detail-card text-left">
        <div class="card-body">
          <h5 class="objective-title">Public Awareness & Capacity Building</h5>
          @if($achievement)
          <p>{!! $achievement->public_awareness !!}</p>
          @endif
        </div>
      </div>
    </div>

    <div id="secondaryObj2" class="collapse objective-detail mt-4">
      <div class="card detail-card text-left">
        <div class="card-body">
          <h5 class="objective-title">VIP Duties & Safety Enforcement </h5>
          @if($achievement)
          <p>{!! $achievement->vip_duties !!}</p>
          @endif
        </div>
      </div>
    </div>


  </div>
</section>

@endsection
@section('scripts')
@stop
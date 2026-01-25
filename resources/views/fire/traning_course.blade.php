@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Traning Courses</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Traning Courses</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->
 <!-- ======= About Section ======= -->
    <section class="services">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="why-us section-bg aos-init aos-animate" style="padding: 30px;">Uttarkhand fire and emergency services Provide Comprehensive Range Of  fire fighting Courses and practical training program at fire and emergency training center/fire stations.
                    </p>
                </div>
            </div>
            </div>
    </section>

@endsection
@section('scripts')
@stop

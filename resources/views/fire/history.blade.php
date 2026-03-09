@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">History</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">History</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->


<!-- ======= About Section ======= -->
<section class="about flagday-section py-5" data-aos="fade-up">
  <div class="container">

    <div class="row content-card content-text">
      <div class="col-lg-6">
        <img src="{{asset('/public/fire/gallery/history.jpg')}}" class="img-fluid rounded" alt="">
      </div>
      <div class="col-lg-6 pt-4 pt-lg-0">
        <p>
          The first fire station in Dehradun was established in <b>1946</b>, when Uttarakhand was part of Uttar Pradesh. Its foundation stone plaque is still preserved at <b>Fire Station Water Works, Dilaram Chowk, Dehradun</b>. In <b>1974</b>, following efforts initiated in 1968, the Dehradun Fire Station was formally brought under the <b>Police Department</b> by the Government of Uttar Pradesh, ensuring centralized command and better administrative control.
          This integration led to standardized operations, uniforms, training, and equipment, strengthened disaster response with specialized rescue training, enabled quicker decision-making, and improved coordination with police for security and escorts.
          At the time of Uttarakhand’s formation, the state had only <b>22 fire stations</b> across <b>13 districts</b>, with none in <b>Rudraprayag</b> and <b>Champawat</b>. Since then, the network has expanded to <b>52 fire stations/units</b> statewide. Today, Uttarakhand Fire Service plays a vital role in ensuring the safety of <b>Char Dham Yatra</b>, Kanwad Yatra, important <b>airstrips</b>, and other <b>sensitive locations/Buildings</b> across the state.
        </p>
      </div>
    </div>

  </div>
</section><!-- End About Section -->
@endsection
@section('scripts')
@stop
@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Tutorial</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Tutorial</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<style>
    .divHeader {
        line-height: 10px !important;
        width: 100%;
    }
</style>
<section class="flagday-section py-5">
    <div class="container">
        <div class="content-card content-text">
            <!-- <h6 class="divHeader">Useful Links</h6> -->
            <iframe style="width:100%; height: 310px;" src="https://www.youtube.com/embed/gy5WfxiP0RI" title="Building fire NOC for construction /फायर एन0ओ0सी0 के लिए कैसे आवेदन करें #UttarakhandFireService" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

        </div>
    </div>
</section>



<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>


@endsection
@section('scripts')
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
         this.classList.toggle("active");
         var panel=this.nextElementSibling;
          if (panel.style.display==="block" ) {
            panel.style.display="none" ;
         } else {
             panel.style.display="block" ;
        }
     });
}
@stop

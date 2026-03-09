@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">FAQ</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<style>
    /* FAQ Wrapper */
    .faq-card {
    border: 1px solid #cfd8ea;
    margin-bottom: 8px;
    border-radius: 6px;
    overflow: hidden;
    }
    
    /* Question Button */
    .faq-question {
        width: 100%;
        background: #0b2c6d;
        color: #fff;
        font-size: 17px;
        font-weight: 500;
        padding: 14px 18px;
        text-align: left;
        border: none;
        position: relative;
    }
    
    /* Arrow Icon (Bootstrap 5 style) */
    .faq-question::after {
    content: '';
    width: 10px;
    height: 10px;
    border-right: 2px solid #fff;
    border-bottom: 2px solid #fff;
    transform: rotate(45deg);
    position: absolute;
    right: 24px;
    top: 50%;
    margin-top: -6px;
    transition: transform 0.3s;
    }
    
    /* Rotate arrow when open */
    .faq-question:not(.collapsed)::after {
    transform: rotate(-135deg);
    }
    
    .faq-question:hover,
    .faq-question:focus {
    background: #071d4a;
    outline: none;
    }
    
    .card-header {
    padding: 0;
    background: none;
    border: none;
    }
    
    .card-body {
    background: #ffffff;
    font-size: 16px;
    line-height: 1.7;
    }
    .card {
        background-color: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        text-align: center;
        padding: 0 !important;
    }
    .card-body {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        padding: .75rem !important;
        text-align: left;
    }
</style>
<section class="flagday-section py-5">
    <div class="container">
        <div class="content-card content-text">
            <h2 class="mb-4">Frequently Asked Questions</h2>

            <div id="faqAccordion">
            @if(!empty($faq) && count($faq) > 0)
                @foreach($faq as $index => $faqloop)
                    @php $i = $index + 1; @endphp
                    <div class="card faq-card">
                        <div class="card-header">
                            <button class="faq-question collapsed" data-toggle="collapse" data-target="#faq{{ $i }}">{{ $faqloop->question }}</button>
                        </div>
                        <div id="faq{{ $i }}" class="collapse" data-parent="#faqAccordion">
                            <div class="card-body">{!! $faqloop->answer !!}</div>
                        </div>
                    </div>
                @endforeach
            @endif

            </div>
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

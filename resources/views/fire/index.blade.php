@extends('layouts.fire_new')
@section('content')
<style>
    .cm-img{
        height:300px;
        object-fit:contain;
        padding:15px;
    }

    .dgp-img{
        height:200px;
        object-fit:contain;
        padding:15px;
    }
</style>

<div class="breaking" style="padding-bottom: 24px;">
    <div id="breHead" style="width: 200px;">
        RECENT UPDATE
    </div>
    <div id="breContant">
        <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="7">
            <!-- <nobr>
                <span>केदारनाथ धाम में हैलीक्रेश सम्बन्धी मॉक ड्रिल</span>
                <span>चारधाम यात्रा के मध्यनजर अग्नि सुरक्षा सम्बन्धी चैकिंग</span>
                <span>Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</span>
                <span>Uttarakhand Home Guard</span>
                <span>Uttarakhand Police Building Construction Corporation</span>
                @foreach($recentupdates as $ru)
                <span><a href="{{route('actionRecentUpdates')}}" style="color: #1d4ed8;">{{$ru->title}}</a></span>
                @endforeach
            </nobr> -->
            <nobr>
                @foreach($recentupdates as $ru)

                    <span>
                    <a href="{{ $ru->route_url ? url($ru->route_url) : asset($ru->document) }}"
                    style="color: {{ $ru->is_highlight ? '#dc2626' : '#00258e' }}; font-weight: {{ $ru->is_highlight ? '700' : '600' }}">

                    @if($ru->is_highlight)
                    🔥
                    @endif

                    {{$ru->title}}

                    </a>
                    </span>

                @endforeach
            </nobr>
        </marquee>
    </div>
</div>

<section id="hero-2" class="hero-section division">
    <script type="text/javascript" src="{{ asset('public/new_assets/slide/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/new_assets/slide/jssor.slider.min.js') }}"></script>

    <div id="jssor_1" style="position:relative; margin:0 auto; top:0px; left:0px; width:2200px; height:550px; overflow:hidden; visibility:hidden; margin-top: -25px;">

        <div data-u="slides" style="cursor:default; position:relative; top:0px; left:0px; width:2200px; height:550px; overflow:hidden; ">
            @forelse($getbanner as $banner)
            <div>
                <img data-u="image"
                    src="{{ asset('public/fire/service/'. $banner->image) }}"
                    alt="{{ $banner->title ?? 'Home Banner' }}" />
            </div>
            @empty
            <div>
                <img data-u="image"
                    src="{{ asset('public/new_assets/img/slides/fire-slide5.jpg') }}" />
            </div>
            @endforelse
            <!-- <div><img data-u="image" src="{{ asset('public/new_assets/img/slides/fire-slide5.jpg') }}" /></div>
        <div><img data-u="image" src="{{ asset('public/new_assets/img/slides/fire-slide4.avif') }}" /></div>
        <div><img data-u="image" src="{{ asset('public/new_assets/img/slides/fire-slide6.jpg') }}" /></div> -->
        </div>

        <!-- Arrow Navigator -->
        <div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:30px; background:#00258e; border-radius:100%" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline>
                <line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px; background:#00258e; border-radius:100%" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%; ">
                <circle class="c" cx="8000" cy="8000" r="5920"></circle>
                <polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline>
                <line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line>
            </svg>
        </div>
    </div>
    <!-- #endregion Jssor Slider End -->
</section>
@if($leadership)
<section id="blog-1" class="blog-section division flagday-section py-5">

    <div class="container">
        <div class="row content-card content-text align-items-center">

            {{-- CM SECTION (Larger Image) --}}
            <div class="col-md-4 text-center">
                <!-- <div style="box-shadow:0px 0px 10px 4px #eee;padding:20px 10px;border-radius:5px;"> -->

                <img src="{{ url('public/'.$leadership->cm_image) }}"
                    alt="{{ $leadership->cm_name }}"
                    class="img-fluid cm-img">

                <h5 class="profile-name">
                    {{ $leadership->cm_name }}
                </h5>

                <p class="profile-info">
                    {{ $leadership->cm_designation }}
                </p>

            </div>



            {{-- CENTER CONTENT --}}
            <div class="col-md-5">

                <h3 class="mb-3">
                    {{ $leadership->subject }}
                </h3>

                <p id="fireText" align="justify" style="line-height:30px;">
                    {{ $leadership->content }}
                </p>

                <button id="toggleBtn"
                    class="btn btn-primary btn-sm"
                    style="color:#fff;background-color:#006270;border-color:#006270;">
                    Read More
                </button>

            </div>



            {{-- DGP SECTION (Smaller Image) --}}
            <div class="col-md-3 text-center">

                <img src="{{ url('public/'.$leadership->dgp_image) }}"
                    alt="{{ $leadership->dgp_name }}"
                    class="img-fluid dgp-img">

                <h5 class="profile-name">
                    {{ $leadership->dgp_name }}
                </h5>

                <p class="profile-info">
                    {!! nl2br(e($leadership->dgp_designation)) !!}
                </p>

            </div>

        </div>
    </div>
</section>
@endif
<section id="blog-1" class="blog-section division flagday-section">
    <div class="container">
        <div class="row content-card content-text">
            <div class="col-md-12 body1">
                <style>
                    .container1 {
                        display: grid;
                        grid-template-columns: repeat(4, 1fr);
                        gap: 20px;
                    }
                    .card:hover {
                        transform: translateY(-10px) !important;
                    }

                    .card {
                        text-align: center;
                        padding: 20px;
                        border-radius: 10px;
                    }

                    @media (max-width: 992px) {
                        .container1 {
                            grid-template-columns: repeat(2, 1fr);
                        }
                    }

                    @media (max-width: 576px) {
                        .container1 {
                            grid-template-columns: repeat(1, 1fr);
                        }
                    }

                    .body1 {
                        align-self: flex-start;
                        background-color:#00627080 !important;
                    }

                    .services {
                        text-align: center;
                        padding: 0px 20px;
                    }

                    .service-card {
                        padding: 14px 15px;
                    }
                    .card h3 {
                        font-size: 20px;
                        font-weight: 700;
                    }
                    .service-card p {
                        font-weight: 700;
                    }
                </style>
                <h2 style="text-align: center; font-weight: 600;color: #00258e; margin-bottom: 10px;">Services We Offer</h2>
                <div class="container1">
                    
                    <div class="card">
                        <a href="{{route('actionConsultation')}}">
                            <img src="{{ asset('public/new_assets/img/content/s2.png') }}" style="height: 120px">
                            <h3>Consultation in case of fire and life safety</h3>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{route('actionFireSafteyCertificate')}}">
                            <img src="{{ asset('public/new_assets/img/content/s3.png') }}" style="height: 120px">
                            <h3>Fire saftey Certificate/NOC</h3>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{route('actionPublicAwareness')}}">
                            <img src="{{ asset('public/new_assets/img/content/s4.png') }}" style="height: 120px">
                            <h3>Public awareness program/Mock drills</h3>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{route('actionStandby')}}">
                            <img src="{{ asset('public/new_assets/img/content/s6.png') }}" style="height: 120px">
                            <h3>Fire saftey in all public events</h3>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{route('actionDisasterSearch')}}">
                            <img src="{{ asset('public/new_assets/img/content/s8.jpeg') }}" style="height: 120px">
                            <h3>Disaster search, rescue and relief work</h3>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{route('actionIncidentReport')}}">
                            <img src="{{ asset('/public/fire/service/fire_safety_all_places.png') }}" style="height: 120px">
                            <h3>Fire / Rescue / Other Incident Report</h3>
                        </a>
                    </div>
                    <div class="card">
                        <a href="{{route('actionPumpingWork')}}">
                            <img src="{{ asset('public/new_assets/img/content/s8.jpeg') }}" style="height: 120px">
                            <h3>Pumping work</h3>
                        </a>
                    </div>                    
                    <div class="card">
                        <a href="{{route('actionRTI')}}">
                            <img src="{{ asset('public/new_assets/img/content/rti2.png') }}" style="height: 120px">
                            <h3>RTI</h3>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>
<section id="blog-1" class="blog-section division flagday-section py-5">
    <div class="container">
        <div class="row content-card content-text">
            <div class="col-md-12 ">
                <div class="services">
                    <h2>Overview</h2>
                    <div class="service-grid">
                        <div class="service-card">
                            <a href="{{route('actionFireUnits')}}">
                                <img src="{{ asset('public/new_assets/img/content/1.png') }}" width="80px">
                                <h3 class="service-number">{{$count['fireStationCount'] ?? 0}}</h3>
                                <p class="service-title">Fire Stations</p>
                            </a>
                        </div>
                        <div class="service-card">
                            <a href="{{route('actionCallDetails')}}">
                                <img src="{{ asset('public/new_assets/img/content/2.png') }}" width="80px">
                                <h3 class="service-number">{{$count['fireCallsCount'] ?? 0}}</h3>
                                <p class="service-title">Fire Calls</p>
                            </a>
                        </div>
                        <div class="service-card">
                            <a href="{{route('actionCallDetails')}}">
                                <img src="{{ asset('public/new_assets/img/content/3.png') }}" width="80px">
                                <h3 class="service-number">{{$count['emergencyCallCount'] ?? 0}}</h3>
                                <p class="service-title">Total Emergency Calls</p>
                            </a>
                        </div>
                        <div class="service-card">
                            <img src="{{ asset('public/new_assets/img/content/4.png') }}" width="80px">
                            <h3 class="service-number">{{$count['manpowerCount'] ?? 0}}</h3>
                            <p class="service-title">Total Strength</p>
                        </div>
                        <div class="service-card">
                            <img src="{{ asset('public/new_assets/img/content/5.png') }}" width="90px">
                            <h3 class="service-number">{{$count['vehicleCount'] ?? 0}}</h3>
                            <p class="service-title">Fire Vehicles</p>
                        </div>
                        <div class="service-card">
                            <a href="{{route('actionCallDetails')}}">
                                <img src="{{ asset('public/new_assets/img/content/6.png') }}" width="80px">
                                <h3 class="service-number">{{$count['lifeSaveCount'] ?? 0}}</h3>
                                <p class="service-title">Lives Saved</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.divHeader {
    line-height: 10px !important;
    width: 100%;
}

.important-section{
    padding:60px 40px;
    text-align:center;
}

.important-section h2{
    font-size:42px;
    margin-bottom:40px;
}

/* Slider Wrapper */
.slider-container{
    position:relative;
    overflow:hidden;
    max-width:1200px;
    margin:auto;
}

/* Slider Track */
.slider-track{
    display:flex;
    gap:30px;
    transition:transform 0.5s ease-in-out;
}

/* Link Box */
.link-box{
    min-width:220px;
    height:150px; /* increased height */
    background:#fff;
    display:flex;
    flex-direction:column;   /* important */
    align-items:center;
    justify-content:center;
    border-radius:6px;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
    transition:0.3s;
    padding:10px;
    text-align:center;
}

.link-box img{
    max-width:90%;
    max-height:80%;
    margin-bottom:10px;
    object-fit: contain;
}

.link-box p{
    margin:0;
    font-size:14px;
    font-weight:600;
    color:#333;
}

/* Arrows */
.arrow{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:#4b2e83;
    color:#fff;
    border:none;
    font-size:22px;
    width:45px;
    height:45px;
    border-radius:50%;
    cursor:pointer;
    z-index:10;
}

.arrow-left{ left:10px; }
.arrow-right{ right:10px; }

.arrow:hover{
    background:#2e1b57;
}

/* Responsive */
@media(max-width:768px){
    .link-box{
        min-width:180px;
        height:100px;
    }
}
</style>
<section id="blog-1" class="blog-section division flagday-section pb-5">
    <div class="container">
        <div class="row content-card content-text">
            <h6 class="divHeader">Useful Links</h6>
            <div class="col-md-12">
                <div class="row text-center justify-content-center">

                    <div class="col-md-12">
                        <div class="slider-container">
                            <button class="arrow arrow-left">&#10094;</button>
                            <button class="arrow arrow-right">&#10095;</button>
                    
                            <div class="slider-track" id="sliderTrack">
                    
                                <a href="{{ route('actionActs')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/fire-service.png') }}">
                                        <p>Acts & Rules</p>
                                    </div>
                                </a>
                    
                                <a href="{{ route('actionOrganisationStructure')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/organisational-structure.png') }}">
                                        <p>Organisational Structure</p>
                                    </div>
                                </a>
                    
                                <a href="{{ route('actionFireUnits')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/fire-station.png') }}">
                                        <p>Fire Stations List</p>
                                    </div>
                                </a>
                    
                                <a href="{{ route('actionFaq')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/faq.png') }}">
                                        <p>FAQ's</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('actionTutorials')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/tutorials.png') }}">
                                        <p>Tutorials</p>
                                    </div>
                                </a>
                                
                                <a href="#" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/kavach.png') }}">
                                        <p>Safety Corner</p>
                                    </div>
                                </a>
                                
                                
                                <a href="{{ route('actionActs')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/fire-service.png') }}">
                                        <p>Acts & Rules</p>
                                    </div>
                                </a>
                    
                                <a href="{{ route('actionOrganisationStructure')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/organisational-structure.png') }}">
                                        <p>Organisational Structure</p>
                                    </div>
                                </a>
                    
                                <a href="{{ route('actionFireUnits')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/fire-station.png') }}">
                                        <p>Fire Stations List</p>
                                    </div>
                                </a>
                    
                                <a href="{{ route('actionFaq')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/faq.png') }}">
                                        <p>FAQ's</p>
                                    </div>
                                </a>
                                
                                <a href="{{ route('actionTutorials')}}" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/tutorials.png') }}">
                                        <p>Tutorials</p>
                                    </div>
                                </a>
                                
                                <a href="#" style="margin: 5px 0px;">
                                    <div class="link-box">
                                        <img src="{{ asset('public/new_assets/img/content/kavach.png') }}">
                                        <p>Safety Corner</p>
                                    </div>
                                </a>
                                
                                
                    
                            </div>
                        </div>
                        
                    </div>

                    
                </div>
            </div>

        </div>
    </div>
</section>
<script>
const track = document.getElementById('sliderTrack');
const leftBtn = document.querySelector('.arrow-left');
const rightBtn = document.querySelector('.arrow-right');

let position = 0;
const moveAmount = 250; // width + gap
let autoSlide;

/* Right Arrow */
rightBtn.addEventListener('click', () => {
    position -= moveAmount;
    if(Math.abs(position) >= track.scrollWidth - track.clientWidth){
        position = 0;
    }
    track.style.transform = `translateX(${position}px)`;
});

/* Left Arrow */
leftBtn.addEventListener('click', () => {
    position += moveAmount;
    if(position > 0){
        position = -(track.scrollWidth - track.clientWidth);
    }
    track.style.transform = `translateX(${position}px)`;
});

/* Auto Slide */
function startAutoSlide(){
    autoSlide = setInterval(()=>{
        rightBtn.click();
    },3000);
}

function stopAutoSlide(){
    clearInterval(autoSlide);
}

track.addEventListener('mouseenter', stopAutoSlide);
track.addEventListener('mouseleave', startAutoSlide);

startAutoSlide();
</script>




<script>
    document.addEventListener("DOMContentLoaded", function () {
        var fullText = document.getElementById("fireText").innerHTML;
        var maxLength = 350;
        var shortText = fullText.substring(0, maxLength) + "...";

        var isExpanded = false;

        if (fullText.length > maxLength) {
            document.getElementById("fireText").innerHTML = shortText;
        } else {
            document.getElementById("toggleBtn").style.display = "none";
        }

        document.getElementById("toggleBtn").addEventListener("click", function () {
            if (isExpanded) {
                document.getElementById("fireText").innerHTML = shortText;
                this.innerHTML = "Read More";
            } else {
                document.getElementById("fireText").innerHTML = fullText;
                this.innerHTML = "Show Less";
            }
            isExpanded = !isExpanded;
        });
    });
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){

    $("#faqToggle").click(function(e){
        e.stopPropagation();
        $("#faqPopup").fadeToggle(200);
    });

    $(document).click(function(){
        $("#faqPopup").fadeOut(200);
    });

});
</script>
@endsection
@section('scripts')
@stop
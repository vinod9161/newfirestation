@extends('layouts.fire_new')
@section('content')
<section id="hero-2" class="hero-section division">
    <script type="text/javascript" src="{{ asset('public/new_assets/slide/jquery-1.9.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('public/new_assets/slide/jssor.slider.min.js') }}"></script>

    <div id="jssor_1" style="position:relative; margin:0 auto; top:0px; left:0px; width:1900px; height:800px; overflow:hidden; visibility:hidden; margin-top: -25px;">

    <div data-u="slides" style="cursor:default; position:relative; top:0px; left:0px; width:1900px; height:800px; overflow:hidden; ">
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
<div class="breaking">
    <div id="breHead">
    Helpline
    </div>
    <div id="breContant">
    <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="7">
        <nobr>
            <span>Helpline Number: <b>0135-2716201</b></span>
            <span>Child Protection: <b>1098</b></span>
            <span>Women Helpline: <b>181</b></span>
            <span>Cyber Crime: <b>1930</b></span>
            <span>Prohibition: <b>15545</b></span>
            <span>Emergency Helpline (ERSS): <b>112</b></span>
        </nobr>
    </marquee>
    </div>
</div>
<section id="blog-1" class="pt-40 blog-section division">
    <div class="container">
    <div class="row">
        <div class="col-md-3 pb-40 text-center">
            <img src="{{ asset('public/new_assets/img/cm-uk.png') }}" alt="Shri Pushkar Singh Dhami" class="img-fluid" style="height: 200px;">
            <h5 class="profile-name">Shri Pushkar Singh Dhami</h5>
            <p class="profile-info pb-40">Honourable Chief Minister, Uttarakhand</p>
        </div>
        <div class="col-md-6 pb-40">
            <div class="row">
                <div class="col-md-12">
                <h3 class="mb-3">Uttarakhand Fire Services</h3>
                <p align="justify" style="line-height: 30px;">Uttarakhand Fire Services is a specialized department of the State Government dedicated to fire safety, prevention, and emergency response. Working 24x7, the department’s mission is to protect lives and property during fire emergencies and related incidents. Uttarakhand Fire Services issues Fire No-Objection Certificates (FIRE NOC) for new buildings, conducts fire safety audits of existing structures, and promotes public awareness through education and social media platforms.</p>
                </div>
                <div class="col-md-3 ml-md-auto form-group" style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                <a href="javascript:void(0);" class="btn btn-blue blue-hover form-control"> Read More</a>
                </div>
            </div>
        </div>

        <div class="col-md-3 ml-md-auto pb-40 text-center">
            <img src="{{ asset('public/new_assets/img/dgp.png') }}" alt="Smt Shoba Ohatker (IPS)" class="img-fluid" style="height: 180px;margin-top:20px">
            <h5 class="profile-name">Dr. Deepam Seth</h5>
            <p class="profile-info">Director General of Police, Uttarakhand Fire Service</p>
        </div>
    </div>
    </div>
</section>

<section id="blog-1" class="blog-section division" style="margin-bottom: 50px;">
    <div class="container">
    <div class="row">
        <div class="col-md-8 body1">
            <style>
                .container1 {
                    display: grid;
                    grid-template-columns: repeat(4, 1fr);
                    gap: 20px;
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
                }

                .services {
                    text-align: center;
                    padding: 0px 20px;
                }
                .service-card {
                    padding: 14px 15px;
                }

            </style>
            <h2 style="text-align: center; font-weight: 600;color: #fff; margin-bottom: 30px;">Services We Offer</h2>
            <div class="container1">

                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s1.png') }}" style="height: 120px">
                <h3>24 hour emergency support</h3>
                </div>
                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s2.png') }}" style="height: 120px">
                <h3>Consultation in case of fire and life safety</h3>
                </div>
                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s3.png') }}" style="height: 120px">
                <h3>Fire saftey Certificate</h3>
                </div>
                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s4.png') }}" style="height: 120px">
                <h3>Public awareness program/Mock drills</h3>
                </div>
                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s5.png') }}" style="height: 120px">
                <h3>Fire saftey to all sensitive places of state</h3>
                </div>
                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s6.png') }}" style="height: 120px">
                <h3>fire saftey in all public events</h3>
                </div>
                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s7.png') }}" style="height: 120px">
                <h3>Training Course</h3>
                </div>
                <div class="card">
                <img src="{{ asset('public/new_assets/img/content/s8.jpeg') }}" style="height: 120px">
                <h3>Disaster search, rescue and relief work</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="services">
                <h2>Overview</h2>
                <div class="service-grid">
                <div class="service-card">
                    <img src="{{ asset('public/new_assets/img/content/1.png') }}">
                    <h3 class="service-number">50</h3>
                    <p class="service-title">Fire Stations</p>
                </div>
                <div class="service-card">
                    <img src="{{ asset('public/new_assets/img/content/2.png') }}">
                    <h3 class="service-number">50</h3>
                    <p class="service-title">Fire Call</p>
                </div>
                <div class="service-card">
                    <img src="{{ asset('public/new_assets/img/content/3.png') }}">
                    <h3 class="service-number">50</h3>
                    <p class="service-title">Total Emergency Call</p>
                </div>
                <div class="service-card">
                    <img src="{{ asset('public/new_assets/img/content/4.png') }}">
                    <h3 class="service-number">50</h3>
                    <p class="service-title">Total Strength</p>
                </div>
                <div class="service-card">
                    <img src="{{ asset('public/new_assets/img/content/5.png') }}">
                    <h3 class="service-number">50</h3>
                    <p class="service-title">Fire Vehicle</p>
                </div>
                <div class="service-card">
                    <img src="{{ asset('public/new_assets/img/content/6.png') }}">
                    <h3 class="service-number">50</h3>
                    <p class="service-title">Life Saved</p>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>


<section id="blog-1" class="blog-section division" style="margin-bottom: 50px;">
    <div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="article">
                <div class="entry-block-small">
                    <div class="entry-image"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('public/new_assets/img/content/objective.png') }}" style="height: 180px"></a></div>
                    <div class="entry-content text-center">
                        <h4><span class="day">Our Objective</span></h4>
                        <p>The motto of Uttarakhand Fire and Emergency service is<br /><strong>“WE SERVE TO SAVE”</strong></p>
                    </div>
                </div>
                <div class="entry-block-small">
                    <div class="entry-image"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('public/new_assets/img/content/faq.png') }}" style="height: 180px"></a></div>
                    <div class="entry-content text-center">
                        <h4><span class="day">FAQ's</span></h4>
                        <p>Here you will find the questions we get asked the most.</p>
                    </div>
                </div>
                <div class="entry-block-small">
                    <div class="entry-image"><a class="img-link" href="#"><img class="img-responsive img-full" src="{{ asset('public/new_assets/img/content/kavach.png') }}" style="height: 180px"></a></div>
                    <div class="entry-content text-center">
                        <h4><span class="day">Safety Corner</span></h4>
                        <p>This section shall provide the knowledge of primary saftey points surrounding you</p>
                    </div>
                </div>
                </div>
            </div>

        </div>
        <div class="col-md-1"></div>

    </div>
    </div>
</section>

<section id="blog-1" class="blog-section division">
    <div class="container">
    <div class="row">
        <div class="col-md-6 pb-40">
            <h5 class="divHeader">RECENT UPDATE</h5>
            <div class="marquee-container">
                <div class="marquee-content">
                <div class="col-12">
                    <a href="javascript:void(0);" target="_blank">
                        <div class="vicon-box">
                            <h6>केदारनाथ धाम में हैलीक्रेश सम्बन्धी मॉक ड्रिल</h6>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="javascript:void(0);" target="_blank">
                        <div class="vicon-box">
                            <h6>चारधाम यात्रा के मध्यनजर अग्नि सुरक्षा सम्बन्धी चैकिंग</h6>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="javascript:void(0);" target="_blank">
                        <div class="vicon-box">
                            <h6>Uttarakhand burning since 4 days, nearly 50 acres of land destroyed?</h6>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="javascript:void(0);" target="_blank">
                        <div class="vicon-box">
                            <h6>Uttarakhand Home Guard</h6>
                        </div>
                    </a>
                </div>
                <div class="col-12">
                    <a href="javascript:void(0);" target="_blank">
                        <div class="vicon-box">
                            <h6>Uttarakhand Police Building Construction Corporation</h6>
                        </div>
                    </a>
                </div>

                </div>
            </div>
        </div>

        <div class="col-md-6 pb-40">
            <h5 class="divHeader">USEFUL VIDEOS LINK</h5>
            <iframe style="width:100%; height: 310px;" src="https://www.youtube.com/embed/gy5WfxiP0RI" title="Building fire NOC for construction /फायर एन0ओ0सी0 के लिए कैसे आवेदन करें #UttarakhandFireService" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
    </div>
    </div>
</section>


<section id="blog-1" class="blog-section division">
    <div class="container">

    <div class="row">
        <div class="col-md-12">
            <h5 class="divHeader">OUR EVENTS</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 pb-40">
            <div class="row">
                <div class="col-6 col-md-4 col-lg-3">
                <a href="javascript:void(0);" target="_blank">
                    <div class="icon-box">
                        <img src="{{ asset('public/new_assets/img/content/event1.jpg') }}" style="width: 100%">
                        <h6>Official Event</h6>
                        <p>Dedicated and best community focused Fire & Rescue Services ensuring a safe and secure environment for all.</p>
                    </div>
                </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                <a href="javascript:void(0);" target="_blank">
                    <div class="icon-box">
                        <img src="{{ asset('public/new_assets/img/content/event2.jpg') }}" style="width: 100%">
                        <h6>Indoor Event</h6>
                        <p>Dedicated and best community focused Fire & Rescue Services ensuring a safe and secure environment for all.</p>
                    </div>
                </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                <a href="javascript:void(0);" target="_blank">
                    <div class="icon-box">
                        <img src="{{ asset('public/new_assets/img/content/event3.jpg') }}" style="width: 100%">
                        <h6>Outdoor Event</h6>
                        <p>Dedicated and best community focused Fire & Rescue Services ensuring a safe and secure environment for all.</p>
                    </div>
                </a>
                </div>
                <div class="col-6 col-md-4 col-lg-3">
                <a href="javascript:void(0);" target="_blank">
                    <div class="icon-box">
                        <img src="{{ asset('public/new_assets/img/content/event4.jpg') }}" style="width: 100%">
                        <h6>Annual Event</h6>
                        <p>Dedicated and best community focused Fire & Rescue Services ensuring a safe and secure environment for all.</p>
                    </div>
                </a>
                </div>

            </div>
        </div>

    </div>
    </div>

</section>

<section id="blog-1" class="blog-section division">
    <div class="container">
    <div class="row">
        <div class="col-md-8 pb-40">
            <h5 class="divHeader">OTHERS LINKS</h5>
            <div class="row text-center">
                <div class="col-md-3">
                <a href="#"><img src="{{ asset('public/new_assets/img/content/fire-service.png') }}" style="width: 80%; height: 130px; object-fit: contain; margin-bottom: 15px;"></a>
                <h6>Acts & Rules</h6>
                </div>
                <div class="col-md-3">
                <a href="#"><img src="{{ asset('public/new_assets/img/content/rti2.png') }}" style="width: 80%; height: 130px; object-fit: contain; margin-bottom: 15px;"></a>
                <h6>Right to Information</h6>
                </div>
                <div class="col-md-3">
                <a href="#"><img src="{{ asset('public/new_assets/img/content/organisational-structure.png') }}" style="width: 80%; height: 130px; object-fit: contain; margin-bottom: 15px;"></a>
                <h6>Organisational Structure</h6>
                </div>
                <div class="col-md-3">
                <a href="#"><img src="{{ asset('public/new_assets/img/content/fire-station.png') }}" style="width: 80%; height: 130px; object-fit: contain; margin-bottom: 15px;"></a>
                <h6>Fire Stations List</h6>
                </div>


            </div>
        </div>

        <div class="col-md-4 pb-40">
            <h5 class="divHeader">SOCIAL MEDIA FEED</h5>
            <a href="#"><img style="width: 70px; margin-right: 15px" src="{{ asset('public/new_assets/img/content/x-icon.webp') }}" alt=""></a>
            <a href="#"><img style="width: 70px; margin-right: 20px" src="{{ asset('public/new_assets/img/content/facebook-icon.webp') }}" alt=""></a>
            <a href="#"><img style="width: 70px; margin-right: 20px" src="{{ asset('public/new_assets/img/content/instagram-icon.webp') }}" alt=""></a>
            <a href="#"><img style="width: 70px; border-radius: 13px;" src="{{ asset('public/new_assets/img/content/youtube-icon.png') }}" alt=""></a>
        </div>
    </div>
    </div>
</section>

@endsection
@section('scripts')
@stop
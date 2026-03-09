@extends('layouts.fire_new')
@section('content')
<style>
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
        <h1 class="breadcrumb-item">Disaster search,rescue and relief work</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
                <li class="breadcrumb-item active" aria-current="page">Disaster search,rescue and relief work</li>
            </ol>
        </nav>
    </div>
</section>
<!--Sub Header End-->

<!-- ======= About Section ======= -->
<section class="flagday-section py-5">
    <div class="container">
        <div class="row content-card content-text">
            <div class="col-md-12 pb-4">
                <h3><strong>Disaster Search, Rescue, and Relief Operations</strong></h3>
                <p>
                    The Uttarakhand Fire and Emergency Service is primarily responsible for firefighting and for protecting life and property during fire incidents. However, in recent years, the role of the Fire Service has expanded significantly.
                    Today, the Fire Service responds to both natural and man-made disasters, including hazardous material incidents, flash flood, avalanches, high-angle rescues, confined space rescues, trench and building collapse operations, underwater rescues, and other complex emergencies. In the immediate aftermath of any disaster, the Fire Service acts as a first responder, playing a crucial role in saving lives and providing emergency relief.
                    The department also actively supports relief and rehabilitation operations as directed by the authorities.
                </p>
                <h3><strong>Procedure for Reporting a Disaster or Emergency Incident</strong></h3>
                <p>
                    To report a disaster or emergency incident, follow the steps below:
                </p>
                <!-- <ol>
                    <li>Dial 112 (Emergency Helpline).</li>
                    <li>Clearly state your name and the location from where you are calling.</li>
                    <li>Provide the details requested by the operator.</li>
                    <li>Share any additional information that may assist emergency responders.</li>
                    <li>Inform about the nearest road, landmark, or access point, if known.</li>
                    <li>Provide GPS coordinates or share the live location of the incident, if possible.</li>
                    <li>Upload or share photographs of the incident through the chat facility, if available.</li>
                </ol> -->
            </div>

            <!-- Primary -->
            <div class="col-md-4 mb-4">
                <div class="card objective-card text-center">
                    <a href="https://112.gov.in/" target="_blank">
                        <div class="card-body">
                            <img src="{{ asset('public/new_assets/img/112.png') }}" style="height: 120px;margin-bottom: 30px; border-radius: 50%">
                            <h5 class="objective-title">Dial 112</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Secondary -->
            <div class="col-md-4 mb-4">
                <div class="card objective-card text-center">
                    <a href="{{ route('actionFireUnits') }}" target="_blank">
                        <div class="card-body">
                            <img src="{{ asset('public/new_assets/img/fire.png') }}" style="height: 120px;margin-bottom: 30px; border-radius: 50%">
                            <h5 class="objective-title">Fire Services</h5>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Tertiary -->
            <div class="col-md-4 mb-4">
                <div class="card objective-card text-center">
                    <a href="{{ route('actionEmergencyContact') }}" target="_blank">
                        <div class="card-body">
                            <img src="{{ asset('public/new_assets/img/sdrf.png') }}" style="height: 120px; width: 120px;margin-bottom: 30px; border-radius: 50%; object-fit: cover">
                            <h5 class="objective-title">Other Emergency No.</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('scripts')
@stop
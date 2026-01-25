@extends('layouts.citizen.template')
@section('content')
<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Welcome To Dashboard</h5>
        <ol class="breadcrumb mb-sm-0 mb-4">
            <li class="breadcrumb-item"><a href="javascript:void(0);" class="fs-14">Home</a></li>
            <li class="breadcrumb-item active fs-14" aria-current="page">Fire Service Dashboard</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.noc.home')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/noc.png') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">NOC</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.building.map')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/building.jpg') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Building Map</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.fire.escape.plan')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/fire_escape.jpg') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Fire Escape Plan</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.chemical.use')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/chemical_use.jpg') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Chemical Use</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.upload.sop')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/sop.jpg') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Upload SOP/ Emergency action plan</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.safety.officer')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/safety_officer.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Safety Officer</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.do.dont')}}">
                <div class="card-body d-flex align-items-center">
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/do_and_donts.jpg') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div>  
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Do & Don'ts</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
</div>    
<!--End::row-1 -->
@endsection
@section('scripts')
@stop
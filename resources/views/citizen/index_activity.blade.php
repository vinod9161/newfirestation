@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Activites</h5>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card" style="height:100px;""> 
            <a href="{{route('actionStandby')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/stand_by.jpg') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Standby Duties</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card" style="height:100px;""> 
            <a href="{{route('actionPublicAwareness')}}">
                <div class="card-body d-flex align-items-center">
                    <div class="service-image" style="width:60px; height:60px;"> 
                        <img src="{{ asset('/public/citizen/classes.png') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div>  
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Awareness Classes/Mock Drills/Training</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card" style="height:100px;""> 
            <a href="{{route('actionIncidentReport')}}">
                <div class="card-body d-flex align-items-center"> 
                    <div class="service-image"> 
                        <img src="{{ asset('/public/citizen/fire-truck.jpg') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    </div> 
                    <div class="service-info"> 
                        <h6 class="dash-12 mb-2" style="padding-left:10px;">Fire/Rescue/Other Incident Report</h6> 
                    </div> 
                </div>
            </a>
        </div>
    </div>
</div>    
@endsection
@section('scripts')
@stop
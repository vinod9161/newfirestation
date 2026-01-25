@extends('layouts.citizen.template')
@section('content')

<div class="row" style="padding-top:15px;">
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'pandal')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Pandal</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'public-function')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Public Function</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'entertainment-activity')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Entertainment Activity</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'film-shooting')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Film Shooting</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'games')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Game</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'helipad')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Helipad</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'kerosene')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Kerosene</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'fire-crackers')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Fire Cracker</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'transportation')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Transportaion Of Material</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('citizen.temporary.noc.list', 'other-services')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Other service</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>  
@endsection
@section('scripts')
@stop
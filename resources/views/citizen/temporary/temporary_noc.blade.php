@extends('layouts.citizen.template')
@section('title')
<title>Temporary Noc | Citizen Dashboard</title>
@endsection
@section('style')
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Temporary NOC</h5>
    </div>
</div>

<div class="row">
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('apply.temp.noc', ['type' => 'pandal'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'public-function'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'entertainment-activity'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'film-shooting'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'games'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'helipad'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'kerosene'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'fire-crackers'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'transportation'])}}">
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
            <a href="{{route('apply.temp.noc', ['type' => 'other-services'])}}">
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
<!--End::row-1 -->
@endsection
@section('scripts')
@stop
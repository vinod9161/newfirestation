@extends('layouts.admin.template')
@section('title')
<title>Update Station | Admin Dashboard</title>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

<style>
  #map {
	height: 400px;
  }

  #pac-input {
	position: absolute;
	top: 10px;
	left: 61%;
	transform: translateX(-50%);
	width: 300px;
	z-index: 5;
	padding: 8px;
	font-size: 14px;
	border: 1px solid #777777;
  }

</style>

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Departments / Stations</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.stations');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Station List
            </a>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Edit Fire Station
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                    @endif

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                       <form action="{{ route('admin.updateStation',$station->id) }}" method="POST">
                                          @csrf
                                          @method('PUT')
                                          <div class="row">
                                                <p class="alert alert-default text-primary" style="background-color:#F3EFFF">Fire station details</p>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Select District</label>
                                                         @if(Auth::user()->type == 0 || Auth::user()->type == 1)
                                                         <select class="form-control js-example-basic-single"  name="district_id" id="district_id" required>
                                                            <option value="" disabled selected>Select District</option>
                                                            @foreach ($districts as $dis)
                                                            <option value="{{ $dis->id }}" @if ($dis->id == $station->district_id) selected @endif>{{ ucfirst($dis->name) }} </option>
                                                            @endforeach
                                                         </select>
                                                         @if($errors->has('district_id'))
                                                         <div class="validation-error">{{ $errors->first('district_id') }}</div>
                                                         @endif
                                                         @else
                                                         @foreach ($districts as $dis)
                                                         @if($dis->id == Auth::user()->state_id)
                                                         <input type="text" class="form-control" value="{{ ucfirst($dis->name) }}" readonly>
                                                         @endif
                                                         @endforeach
                                                         @endif
                                                   </div>
                                                </div>

                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-label">Name of Fire Station*</label>
                                                      <input type="text" class="form-control" id="name" name="name" placeholder="Name of Fire Station" value="{{$station->name ?? '' }}">
                                                      @if($errors->has('name'))
                                                      <div class="validation-error">{{ $errors->first('name') }}</div>
                                                      @endif
                                                   </div>
                                                </div>

                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Address</label>
                                                      <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$station->address ?? '' }}" required>
                                                      @if($errors->has('address'))
                                                      <div class="validation-error">{{ $errors->first('address') }}</div>
                                                      @endif
                                                   </div>
                                                </div>
												
												<div class="col-md-12">
                                                   <div class="form-group">
														<input id="pac-input" type="text" placeholder="Search Location..." />
														<div id="map"></div>
														<input type="hidden" name="PolygonCoordinates" id="polygon-coordinates">
                                                   </div>
                                                </div>
												
												
                                          </div>


                                          <div class="row">
                                                <p class="alert alert-default text-primary" style="background-color:#F3EFFF">Land and Building Details</p>
                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Land</label>
                                                      <select class="form-control js-example-basic-single" name="land" id="land" required>
                                                         <option value="">Select Land</option>
                                                         <option value="Available" @if ($station->land =='Available') selected @endif>Available</option>
                                                         <option value="Not Available" @if ($station->land =='Not Available') selected @endif>Not Available</option>
                                                      </select>
                                                      @if($errors->has('category'))
                                                      <div class="validation-error">{{ $errors->first('category') }}</div>
                                                      @endif
                                                   </div>
                                                </div>

                                                <div class="col-md-4 area_of_land">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Area Of Land</label>
                                                      <input type="number" class="form-control" id="area_of_land" name="area_of_land" placeholder="Area Of Land" value="{{$station->area_of_land ?? '' }}">
                                                      @if($errors->has('area_of_land'))
                                                      <div class="validation-error">{{ $errors->first('area_of_land') }}</div>
                                                      @endif
                                                   </div>
                                                </div>

                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Building</label>
                                                      <select class="form-control js-example-basic-single" name="building" id="building" onchange="is_building(this);" required>
                                                         <option value="">Select Building</option>
                                                         <option value="Available" @if ($station->building =='Available') selected @endif>Available</option>
                                                         <option value="Not Available" @if ($station->building =='Not Available') selected @endif>Not Available</option>
                                                      </select>
                                                      @if($errors->has('category'))
                                                      <div class="validation-error">{{ $errors->first('category') }}</div>
                                                      @endif
                                                   </div>
                                                </div>


                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <div class="form-check"> 
                                                         <input class="form-check-input" type="checkbox" id="adminitrative" name="adminitrative" id="checkebox-sm" value="Adminitrative" @if ($station->adminitrative =='Adminitrative') checked @endif> 
                                                         <label class="form-check-label" for="checkebox-sm"> Adminitrative </label> 
                                                      </div>
                                                   </div>

                                                   <div class="form-group">
                                                      <div class="form-check"> 
                                                         <input class="form-check-input" type="checkbox" id="residential" name="residential" id="checkebox-sm" value="Residential" @if ($station->residential =='Residential') checked @endif> 
                                                         <label class="form-check-label" for="checkebox-sm"> Residential </label> 
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Building Status</label>
                                                      <select class="form-control js-example-basic-single" name="building_status" id="building_status" required>
                                                         <option value="">Select Building</option>
                                                         <option value="Own" @if ($station->building_status =='Own') selected @endif>Own</option>
                                                         <option value="Rented" @if ($station->building_status =='Rented') selected @endif>Rented</option>
                                                         <option value="Under demolish" @if ($station->building_status =='Under demolish') selected @endif>Under demolish</option>
                                                         <option value="Not available" @if ($station->building_status =='Not available') selected @endif>Not available</option>
                                                         <option value="Other" @if ($station->building_status =='Other') selected @endif>Other</option>
                                                      </select>
                                                   </div>
                                                </div>
                                          </div>


                                          <div class="row">
                                             <p class="alert alert-default text-primary" style="background-color:#F3EFFF">Sanctioned Strength</p>
                                              
                                              <div class="col-md-3" >
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Station Officer</label>
                                                   @if(auth()->user()->type == 2 || auth()->user()->type == 3)
                                                      <input type="number" class="form-control" id="fire_station_officer" name="fire_station_officer" placeholder="Fire Station Officer" value="{{$station->fire_station_officer ?? '' }}" required readonly>
                                                   @else
                                                      <input type="number" class="form-control" id="fire_station_officer" name="fire_station_officer" placeholder="Fire Station Officer" value="{{$station->fire_station_officer ?? '' }}" required>
                                                   @endif
                                                   @if($errors->has('fire_station_officer'))
                                                   <div class="validation-error">{{ $errors->first('fire_station_officer') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Station Second Officer</label>
                                                   @if(auth()->user()->type == 2 || auth()->user()->type == 3)
                                                      <input type="number" class="form-control" id="fire_station_second_officer" name="fire_station_second_officer" placeholder="Fire Station Second Officer" value="{{$station->fire_station_second_officer ?? '' }}" required readonly>
                                                   @else
                                                      <input type="number" class="form-control" id="fire_station_second_officer" name="fire_station_second_officer" placeholder="Fire Station Second Officer" value="{{$station->fire_station_second_officer ?? '' }}" required>
                                                   @endif
                                                   @if($errors->has('fire_station_second_officer'))
                                                   <div class="validation-error">{{ $errors->first('fire_station_second_officer') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Leading Fireman</label>
                                                   @if(auth()->user()->type == 2 || auth()->user()->type == 3)
                                                      <input type="number" class="form-control" id="leading_fireman" name="leading_fireman" placeholder="Leading Fireman" value="{{$station->leading_fireman ?? '' }}" required readonly>
                                                   @else
                                                      <input type="number" class="form-control" id="leading_fireman" name="leading_fireman" placeholder="Leading Fireman" value="{{$station->leading_fireman ?? '' }}" required>
                                                   @endif
                                                   @if($errors->has('leading_fireman'))
                                                   <div class="validation-error">{{ $errors->first('leading_fireman') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Service Driver</label>
                                                   @if(auth()->user()->type == 2 || auth()->user()->type == 3)
                                                      <input type="number" class="form-control" id="fire_service_driver" name="fire_service_driver" placeholder="Fire Service Driver" value="{{$station->fire_service_driver ?? '' }}" required readonly>
                                                   @else
                                                      <input type="number" class="form-control" id="fire_service_driver" name="fire_service_driver" placeholder="Fire Service Driver" value="{{$station->fire_service_driver ?? '' }}" required>
                                                   @endif
                                                   @if($errors->has('fire_service_driver'))
                                                   <div class="validation-error">{{ $errors->first('fire_service_driver') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fireman</label>
                                                   @if(auth()->user()->type == 2 || auth()->user()->type == 3)
                                                      <input type="number" class="form-control" id="fireman" name="fireman" placeholder="Fireman" value="{{$station->fireman ?? '' }}" required readonly>
                                                   @else
                                                      <input type="number" class="form-control" id="fireman" name="fireman" placeholder="Fireman" value="{{$station->fireman ?? '' }}" required>
                                                   @endif
                                                   @if($errors->has('fireman'))
                                                   <div class="validation-error">{{ $errors->first('fireman') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Cook/Peon/Followers</label>
                                                   @if(auth()->user()->type == 2 || auth()->user()->type == 3)
                                                      <input type="number" class="form-control" id="cook_peon_followers" name="cook_peon_followers" placeholder="Cook/Peon/Followers" value="{{$station->cook_peon_followers ?? '' }}" required readonly>
                                                   @else
                                                      <input type="number" class="form-control" id="cook_peon_followers" name="cook_peon_followers" placeholder="Cook/Peon/Followers" value="{{$station->cook_peon_followers ?? '' }}" required>
                                                   @endif
                                                   @if($errors->has('cook_peon_followers'))
                                                   <div class="validation-error">{{ $errors->first('cook_peon_followers') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Sweeper</label>
                                                   @if(auth()->user()->type == 2 || auth()->user()->type == 3)
                                                      <input type="number" class="form-control" id="sweeper" name="sweeper" placeholder="Sweeper" value="{{$station->sweeper ?? '' }}" required readonly>
                                                   @else
                                                      <input type="number" class="form-control" id="sweeper" name="sweeper" placeholder="Sweeper" value="{{$station->sweeper ?? '' }}" required>
                                                   @endif
                                                   @if($errors->has('sweeper'))
                                                   <div class="validation-error">{{ $errors->first('sweeper') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                          </div>

                                          <div class="row">
                                             <p class="alert alert-default text-primary" style="background-color:#F3EFFF">Available Strength</p>
                                              
                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Station Officer Available</label>
                                                   <input type="number" class="form-control" id="fire_station_officer_avail" name="fire_station_officer_avail" placeholder="Fire Station Officer Available" value="{{$station->fire_station_officer_avail ?? '' }}" required>
                                                   @if($errors->has('fire_station_officer_avail'))
                                                   <div class="validation-error">{{ $errors->first('fire_station_officer_avail') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Station Second Officer Available</label>
                                                   <input type="number" class="form-control" id="fire_station_second_officer_avail" name="fire_station_second_officer_avail" placeholder="Fire Station Second Officer Available" value="{{$station->fire_station_second_officer_avail ?? '' }}" required>
                                                   @if($errors->has('fire_station_second_officer_avail'))
                                                   <div class="validation-error">{{ $errors->first('fire_station_second_officer_avail') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Leading Fireman Available</label>
                                                   <input type="number" class="form-control" id="leading_fireman_avail" name="leading_fireman_avail" placeholder="Leading Fireman Available" value="{{$station->leading_fireman_avail ?? '' }}" required>
                                                   @if($errors->has('leading_fireman_avail'))
                                                   <div class="validation-error">{{ $errors->first('leading_fireman_avail') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Service Driver Available</label>
                                                   <input type="number" class="form-control" id="fire_service_driver_avail" name="fire_service_driver_avail" placeholder="Fire Service Driver Available" value="{{$station->fire_service_driver_avail ?? '' }}" required>
                                                   @if($errors->has('fire_service_driver_avail'))
                                                   <div class="validation-error">{{ $errors->first('fire_service_driver_avail') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fireman Available</label>
                                                   <input type="number" class="form-control" id="fireman_avail" name="fireman_avail" placeholder="Fireman Available" value="{{$station->fireman_avail ?? '' }}" required>
                                                   @if($errors->has('fireman_avail'))
                                                   <div class="validation-error">{{ $errors->first('fireman_avail') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Cook/Peon/Followers Available</label>
                                                   <input type="number" class="form-control" id="cook_peon_followers_avail" name="cook_peon_followers_avail" placeholder="Cook/Peon/Followers Available" value="{{$station->cook_peon_followers_avail ?? '' }}" required>
                                                   @if($errors->has('cook_peon_followers_avail'))
                                                   <div class="validation-error">{{ $errors->first('cook_peon_followers_avail') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Sweeper Available</label>
                                                   <input type="number" class="form-control" id="sweeper_avail" name="sweeper_avail" placeholder="Sweeper Available" value="{{$station->sweeper_avail ?? '' }}" required>
                                                   @if($errors->has('sweeper_avail'))
                                                   <div class="validation-error">{{ $errors->first('sweeper_avail') }}</div>
                                                   @endif
                                                </div>
                                             </div>  

                                          </div>

                                          <div class="row">
                                             <p class="alert alert-default text-primary" style="background-color:#F3EFFF">UPNL Strength</p>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Station Officer</label>
                                                   <input type="number" class="form-control" id="upnl_fire_station_officer" name="upnl_fire_station_officer" placeholder="Fire Station Officer" value="{{$station->upnl_fire_station_officer ?? '' }}" required>
                                                   @if($errors->has('fire_station_officer'))
                                                   <div class="validation-error">{{ $errors->first('fire_station_officer') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Station Second Officer</label>
                                                   <input type="number" class="form-control" id="upnl_fire_station_second_officer" name="upnl_fire_station_second_officer" placeholder="Fire Station Second Officer" value="{{$station->upnl_fire_station_second_officer ?? '' }}" required>
                                                   @if($errors->has('fire_station_second_officer'))
                                                   <div class="validation-error">{{ $errors->first('fire_station_second_officer') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Leading Fireman</label>
                                                   <input type="number" class="form-control" id="upnl_leading_fireman" name="upnl_leading_fireman" placeholder="Leading Fireman" value="{{$station->upnl_leading_fireman ?? '' }}" required>
                                                   @if($errors->has('leading_fireman'))
                                                   <div class="validation-error">{{ $errors->first('leading_fireman') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fire Service Driver</label>
                                                   <input type="number" class="form-control" id="upnl_fire_service_driver" name="upnl_fire_service_driver" placeholder="Fire Service Driver" value="{{$station->upnl_fire_service_driver ?? '' }}" required>
                                                   @if($errors->has('fire_service_driver'))
                                                   <div class="validation-error">{{ $errors->first('fire_service_driver') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Fireman</label>
                                                   <input type="number" class="form-control" id="upnl_fireman" name="upnl_fireman" placeholder="Fireman" value="{{$station->upnl_fireman ?? '' }}" required>
                                                   @if($errors->has('fireman'))
                                                   <div class="validation-error">{{ $errors->first('fireman') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Cook/Peon/Followers</label>
                                                   <input type="number" class="form-control" id="upnl_cook_peon_followers" name="upnl_cook_peon_followers" placeholder="Cook/Peon/Followers" value="{{$station->upnl_cook_peon_followers ?? '' }}" required>
                                                   @if($errors->has('cook_peon_followers'))
                                                   <div class="validation-error">{{ $errors->first('cook_peon_followers') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                             <div class="col-md-4">
                                                <div class="form-group">
                                                   <label class="form-control-label" for="input-username">Sweeper</label>
                                                   <input type="number" class="form-control" id="upnl_sweeper" name="upnl_sweeper" placeholder="Sweeper" value="{{$station->upnl_sweeper ?? '' }}" required>
                                                   @if($errors->has('sweeper'))
                                                   <div class="validation-error">{{ $errors->first('sweeper') }}</div>
                                                   @endif
                                                </div>
                                             </div>

                                          </div>

                                          <div class="row">
                                             <p class="alert alert-default text-primary" style="background-color:#F3EFFF">Communication</p>
                                             <div class="col-md-3 col">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Wireless</label>
                                                      <select class="form-control js-example-basic-single" name="wireless" id="wireless" onchange="is_wireless(this);" required>
                                                         <option value="">Select Wireless</option>
                                                         <option value="Available" @if ($station->wireless =='Available') selected @endif>Available</option>
                                                         <option value="Not Available" @if ($station->wireless =='Not Available') selected @endif>Not Available</option>
                                                      </select>
                                                      @if($errors->has('category'))
                                                      <div class="validation-error">{{ $errors->first('category') }}</div>
                                                      @endif
                                                   </div>
                                             </div>

                                                

                                                <div class="col-md-3 col is_wireless">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Mobile Set Number</label>
                                                      <input type="number" class="form-control" id="mobile_set_no" name="mobile_set_no" placeholder="Mobile Set Number" value="{{$station->mobile_set_no ?? '' }}">
                                                      @if($errors->has('mobile_set_no'))
                                                      <div class="validation-error">{{ $errors->first('mobile_set_no') }}</div>
                                                      @endif
                                                   </div>
                                                </div>


                                                <div class="col-md-3 col is_wireless">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Static Set Number</label>
                                                      <input type="number" class="form-control" id="static_set_no" name="static_set_no" placeholder="Static Set Number" value="{{$station->static_set_no ?? '' }}">
                                                      @if($errors->has('static_set_no'))
                                                      <div class="validation-error">{{ $errors->first('static_set_no') }}</div>
                                                      @endif
                                                   </div>
                                                </div>

                                                <div class="col-md-3 col is_wireless">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Handheld Set Number</label>
                                                      <input type="number" class="form-control" id="handheld_set_no" name="handheld_set_no" placeholder="Handheld Set Number" value="{{$station->handheld_set_no ?? '' }}">
                                                      @if($errors->has('handheld_set_no'))
                                                      <div class="validation-error">{{ $errors->first('handheld_set_no') }}</div>
                                                      @endif
                                                   </div>
                                                </div>

                                                <div class="col-md-3 col is_wireless">
                                                   <div class="form-group" style="margin-top:34px;">
                                                      <div class="form-check"> 
                                                         <input class="form-check-input" type="checkbox" id="handheld_set" name="handheld_set" placeholder="Handheld Set" value="Handheld Set" @if ($station->handheld_set =='Handheld Set') checked @endif> 
                                                         <label class="form-check-label" for="checkebox-sm"> Handheld Set </label> 
                                                      </div>
                                                   </div>
                                                </div>


                                                <div class="col-md-3 col is_wireless">
                                                   <div class="form-group" style="margin-top:34px;">
                                                      <div class="form-check"> 
                                                         <input class="form-check-input" type="checkbox" id="mobile_set" name="mobile_set" value="Mobile Set" @if ($station->mobile_set =='Mobile Set') checked @endif> 
                                                         <label class="form-check-label" for="checkebox-sm"> Mobile Set </label> 
                                                      </div>
                                                   </div>
                                                </div>


                                                <div class="col-md-3 col is_wireless">
                                                   <div class="form-group" style="margin-top:34px;">

                                                      <div class="form-check"> 
                                                         <input class="form-check-input" type="checkbox" id="static_set" name="static_set" value="Static Set" @if ($station->static_set =='Static Set') checked @endif> 
                                                         <label class="form-check-label" for="checkebox-sm"> Static Set </label> 
                                                      </div>

                                                   </div>
                                                </div>

                                          </div>


                                          <div class="row">
                                             <p class="alert alert-default text-primary" style="background-color:#F3EFFF">Misc</p>
                                             <div class="col-md-3">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Telephone</label>
                                                      <select class="form-control js-example-basic-single" name="telephone" id="telephone" required>
                                                         <option value="">Select Telephone</option>
                                                         <option value="Available" @if ($station->telephone =='Available') selected @endif>Available</option>
                                                         <option value="Not Available" @if ($station->telephone =='Not Available') selected @endif>Not Available</option>
                                                      </select>
                                                      @if($errors->has('category'))
                                                      <div class="validation-error">{{ $errors->first('category') }}</div>
                                                      @endif
                                                   </div>
                                             </div>
                                          
                                             <div class="col-md-3">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">MDT</label>
                                                      <select class="form-control js-example-basic-single" name="mdt" id="mdt" onchange="is_MDT(this);" required>
                                                         <option value="">Select MDT</option>
                                                         <option value="Available" @if ($station->mdt =='Available') selected @endif>Available</option>
                                                         <option value="Not Available" @if ($station->mdt =='Not Available') selected @endif>Not Available</option>
                                                      </select>
                                                      @if($errors->has('category'))
                                                      <div class="validation-error">{{ $errors->first('category') }}</div>
                                                      @endif
                                                   </div>
                                             </div>

                                             <div class="col-md-3 is_mdt">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">Number Of MDT</label>
                                                      <input type="number" class="form-control" id="number_of_static" name="number_of_static" placeholder="Number Of MDT" value="{{$station->number_of_static ?? '' }}">
                                                      @if($errors->has('number_of_static'))
                                                      <div class="validation-error">{{ $errors->first('number_of_static') }}</div>
                                                      @endif
                                                   </div>
                                             </div>


                                             <div class="col-md-3">
                                                <div class="form-group">
                                                   <label class="form-label">Status</label>
                                                   <select class="form-control js-example-basic-single" name="status" id="status">
                                                     <option value="1" @if ($station->status ==1) selected @endif>Active</option>
                                                     <option value="0"  @if ($station->status ==0) selected @endif>In-Active</option>
                                                   </select>
                                                </div>
                                             </div>

                                          </div>


                                          <div class="row">
                                             <p class="alert alert-default text-primary" style="background-color:#F3EFFF">Contact Information</p>
                                             <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">FIre Station Contact Number</label>
                                                      <input type="text" name="fs_contact_no" id="fs_contact_no" class="form-control" placeholder="Enter Fire Station Contact Number" value="{{ $station->fs_contact_no }}">
                                                      @if($errors->has('fs_contact_no'))
                                                      <div class="validation-error">{{ $errors->first('fs_contact_no') }}</div>
                                                      @endif
                                                   </div>
                                             </div>

                                             <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">FIre Station Mobile Number</label>
                                                      <input type="text" name="fs_mobile_no" id="fs_mobile_no" class="form-control" placeholder="Enter Fire Station Mobile Number" value="{{ $station->fs_mobile_no }}">
                                                      @if($errors->has('fs_mobile_no'))
                                                      <div class="validation-error">{{ $errors->first('fs_mobile_no') }}</div>
                                                      @endif
                                                   </div>
                                             </div>

                                             <div class="col-md-4">
                                                   <div class="form-group">
                                                      <label class="form-control-label" for="input-username">FIre Station Email Address</label>
                                                      <input type="text" name="fs_email_address" id="fs_email_address" class="form-control" placeholder="Enter Fire Station Email Address" value="{{ $station->fs_email_address }}">
                                                      @if($errors->has('fs_email_address'))
                                                      <div class="validation-error">{{ $errors->first('fs_email_address') }}</div>
                                                      @endif
                                                   </div>
                                             </div>

                                          </div>

                                          <div class="row">
                                             <div class="form-group">
                                                <a href="{{route('admin.stations')}}" class="btn btn-sm btn-danger">Back</a>
                                                <button class="btn btn-primary btn-sm" type="submit">Update</button>
                                             </div>
                                          </div>      




                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfkkKGSZZ4Y7wiFpo09j77-hLjq3AzPVY&libraries=places,drawing&callback=initMap" async defer></script>

<script>
      let map;
      let drawingManager;
      let selectedPolygon = null;

      function initMap() {
        const defaultLocation = { lat: 28.6139, lng: 77.2090 };

        map = new google.maps.Map(document.getElementById("map"), {
          center: defaultLocation,
          zoom: 7,
        });

        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

        map.addListener("bounds_changed", () => {
          searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener("places_changed", () => {
          const places = searchBox.getPlaces();
          if (places.length === 0) return;

          const bounds = new google.maps.LatLngBounds();
          places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) return;
            bounds.extend(place.geometry.location);
          });
          map.fitBounds(bounds);
        });

        drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.POLYGON,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT,
            drawingModes: ["polygon"],
          },
          polygonOptions: {
            fillColor: "#FF0000",
            fillOpacity: 0.3,
            strokeWeight: 2,
            clickable: true,
            editable: true,
            draggable: false,
          },
        });

        drawingManager.setMap(map);

        google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
          if (event.type === "polygon") {
            if (selectedPolygon) {
              selectedPolygon.setMap(null);
            }

            selectedPolygon = event.overlay;

            const coords = selectedPolygon.getPath().getArray().map((latLng) => ({
              lat: latLng.lat(),
              lng: latLng.lng(),
            }));

            document.getElementById("polygon-coordinates").value = JSON.stringify(coords, null, 2);
          }
        });

        // Load polygon from predefined coordinates (optional)
        const savedCoordinates = <?= $station->polygon_coordinates ?? ''?>
      //   [
      //    {
      //       "lat": 28.619674217322043,
      //       "lng": 77.21059271376737
      //    },
      //    {
      //       "lat": 28.619504693701465,
      //       "lng": 77.21301743071683
      //    },
      //    {
      //       "lat": 28.617960132551858,
      //       "lng": 77.21310326140531
      //    },
      //    {
      //       "lat": 28.617771769881802,
      //       "lng": 77.20977732222684
      //    }
		// ];
        drawPolygonFromCoordinates(savedCoordinates);
        document.getElementById("polygon-coordinates").value = JSON.stringify(savedCoordinates, null, 2);
      }

      function drawPolygonFromCoordinates(coords) {
        if (!Array.isArray(coords) || coords.length < 3) return;

        if (selectedPolygon) {
          selectedPolygon.setMap(null);
        }

        const path = coords.map((point) => new google.maps.LatLng(point.lat, point.lng));

        selectedPolygon = new google.maps.Polygon({
          paths: path,
          fillColor: "#FF0000",
          fillOpacity: 0.3,
          strokeWeight: 2,
          editable: true,
          map: map,
        });

        const bounds = new google.maps.LatLngBounds();
        path.forEach((latLng) => bounds.extend(latLng));
        map.fitBounds(bounds);
      }

      // Redraw polygon if user pastes coordinates
      document.addEventListener("DOMContentLoaded", () => {
        document.getElementById("polygon-coordinates").addEventListener("change", function () {
          try {
            const coords = JSON.parse(this.value);
            drawPolygonFromCoordinates(coords);
          } catch (e) {
            alert("Invalid coordinate JSON.");
          }
        });
      });

      window.initMap = initMap;
    </script>

@stop
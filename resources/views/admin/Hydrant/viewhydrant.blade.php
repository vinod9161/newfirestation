@extends('layouts.admin.template')
@section('title')
<title>Hydrants | Admin Dashboard</title>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Hydrants</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.hydrant');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Hydrant Details
            </a>
        </div>
    </div>
</div>




<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    General Details सामान्य विवरण
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                      <table class="table table-bordered table-striped table-hover">
                                           <tbody>
                                              
                                              <tr>
                                                 <td>District जनपद</td>
                                                 <td>{{ $getData->district_name }}</td>
                                              </tr>
                                              <tr>
                                                 <td>Fire Station फायर स्टेशन</td>
                                                 <td>{{ $getData->fire_station_name }}</td>
                                              </tr>
                                              <tr>
                                                 <td>Address Of Water Sources जल स्रोत का पता</td>
                                                 <td>{{ $getData->address_of_water_sources }}</td>
                                              </tr>
                                              <tr>
                                                 <td>Latitude अक्षांश</td>
                                                 <td>{{ $getData->latitude }}</td>
                                              </tr>
                                              <tr>
                                                 <td>Longitude देशान्तर</td>
                                                 <td>{{ $getData->longitude }}</td>
                                              </tr>
                                              <tr>
                                                 <td>Type प्रकार</td>
                                                 <td>{{ $getData->hydrant_type }}</td>
                                              </tr>
                                              <tr>
                                                 <td>Condition स्थिति</td>
                                                 <td>{{ $getData->condition }}</td>
                                              </tr>
                                           </tbody>
                                        </table> 
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
@stop
@extends('layouts.admin.template')
@section('title')
<title>Vehicle &amp; Machine</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Vehicle </h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.vehicle');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Vehicle List
            </a>
        </div>


        <div>
            <a href="{{ route('admin.editdata', $fs_vehicles->id) }}" class="btn ripple btn-wave  btn-primary mb-0" style="margin-left: 20px;">
                <i class="fe fe-edit me-1"></i> Edit Vehicle Data
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
                    View Vehicle Details
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
                                        @if(empty($fs_vehicles))
                                        <tr>
                                            <th colspan="2" class="text-danger">No Data Found</th>
                                        </tr>
                                        @else
                                          <tr>
                                             <td>District जनपद</td>
                                             <td>{{ $fs_vehicles->district_name ?? 'NA' }}</td>
                                          </tr>
                                          <tr>
                                             <td>Registration Number रजिस्ट्रेशन नं0</td>
                                             <td>{{ $fs_vehicles->reg_number ?? 'NA' }}</td>
                                          </tr>
                                          <tr>
                                             <td>Chassis Number चैसिस नम्बर</td>
                                             <td>{{ $fs_vehicles->chassis_number ?? 'NA' }}</td>
                                          </tr>
                                          <tr>
                                             <td>Engine Number इंजन नम्बर</td>
                                             <td>{{ $fs_vehicles->engine_number ?? 'NA' }}</td>
                                          </tr>
                                          <tr>
                                             <td>Station फायर स्टेशन</td>
                                             <td>{{ $fs_vehicles->fire_station_name ?? 'NA' }}</td>
                                          </tr>
                                          <tr>
                                             <td>Vehicle Type</td>
                                             <td>{{ $fs_vehicles->type ?? 'NA' }}</td>
                                          </tr>
                                          <tr>
                                             <td>Make Year</td>
                                             <td>{{ $fs_vehicles->make_year ?? 'NA' }}</td>
                                          </tr>
                                          <tr>
                                             <td>मेक माडल कम्पनी सहित</td>
                                             <td>{{ $fs_vehicles->year ?? 'NA' }}</td>
                                          </tr>

                                          <tr>
                                             <td>Water Capacity in Ltr वाहन की क्षमता ली0 में</td>
                                             <td>{{ $fs_vehicles->capacity ?? 'NA' }}</td>
                                          </tr>

                                          <tr>
                                             <td>Used Date प्रयोग तिथि</td>
                                             <td>{{ $fs_vehicles->use_date ?? 'NA' }}</td>
                                          </tr>

                                          <tr>
                                             <td>29 फरवरी 2020 तक चले किमी0</td>
                                             <td>{{ $fs_vehicles->km_drive ?? 'NA' }}</td>
                                          </tr>

                                          <tr>
                                             <td>प्रयोग तिथि से अब तक वाहन पर मरम्मत पर व्यय</td>
                                             <td>{{ $fs_vehicles->total_invest ?? 'NA' }}</td>
                                          </tr>

                                          <tr>
                                             <td>वाहन द्वारा कितनी आग बुझायी गई</td>
                                             <td>{{ $fs_vehicles->total_fire ?? 'NA' }}</td>
                                          </tr>

                                          <tr>
                                             <td>वाहन Remarks</td>
                                             <td>{{ $fs_vehicles->vehicle_remark ?? 'NA' }}</td>
                                          </tr>
                                        @endif  
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

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    View Vehicle Details
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">
                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                <table class="table table-bordered table-striped table-hover">
                                   
                                    <thead>
                                        <tr>
                                            <th style="width:10%;">Month</th>
                                            <th>Year</th>
                                            <th>Total Run (Fire)</th>
                                            <th>Total Run (Other)</th>
                                            <th>Total Pumping (Fire)</th>
                                            <th>Total Pumping (Other)</th>
                                            <th>Total Fuel Expense</th>
                                            <th>Total Maintenance Expense</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @foreach ($vehicleStatement as $statement)
                                        <tr class="my-job-item">
                                            <td style="width:10%;">{{$statement->month}}</td>
                                            <td>{{$statement->year}}</td>
                                            <td>{{$statement->total_run_fire}}</td>
                                            <td>{{$statement->total_run_other}}</td>
                                            <td>{{$statement->total_pumping_fire}}</td>
                                            <td>{{$statement->total_pumping_other}}</td>
                                            <td>{{$statement->total_fuel_expense}}</td>
                                            <td>{{$statement->total_maintenance_expense}}</td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp 
                                        @endforeach 
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
@stop
@extends('layouts.admin.template')
@section('title')
<title>Categories | Admin Dashboard</title>
@endsection
@section('style')
@endsection
@section('content')


<div class="row">
        <!-- <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.Noc',['type'=>'all']) }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">NOC</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/noc.webp') }}" alt="NOC" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div> -->


        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.Noc.list',['status'=>'all']) }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">NOC</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/noc.webp') }}" alt="NOC" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>


        

        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.fire_report') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Fire Report</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/report.webp') }}" alt="Fire Report" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>


        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.rescueReport') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Rescue Report</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/rescue.webp') }}" alt="Rescue Report" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>


        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.reliefReport') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Relief Report</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/relief.webp') }}" alt="Relief Report" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.activities') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Activities</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/activity.webp') }}" alt="Activities" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{  route('admin.stations') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Fire Stations</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/fire_station.webp') }}" alt="Fire Stations" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.vehicle') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Vehicle and Machine</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/fire-truck.webp') }}" alt="Vehicle and Machine" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.employees') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Employee Corner</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/employee.webp') }}" alt="Employee Corner" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.hydrant') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Fire Hydrant & Water Bodies</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/hydrant.webp') }}" alt="Fire Hydrant & Water Bodies" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.sop') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">SOP</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/sop.webp') }}" alt="SOP" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.go.circular') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Act & Rules Notifications / Order</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/go.webp') }}" alt="Act & Rules Notifications / Order" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>


        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.periodic-employee') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Periodic Reports</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/periodic.webp') }}" alt="Periodic Reports" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>


        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.agency.licence') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Fire Licenced Agency</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/agency_licence.webp') }}" alt="Fire Licenced Agency" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>


        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.auditor.riskAuditor') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Fire Risk Auditor</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/risk_auditor.webp') }}" alt="Fire Risk Auditor" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>



        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.indexTemporaryNoc') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Temporary NOC</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/noc-1.webp') }}" alt="Temporary NOC" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="{{ route('admin.equipmentlist') }}">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Equipments</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/fire/img/equipment.png') }}" alt="Other" style="width:100px; height:60px; object-fit:contain">
                        </div> 
                    </div>
                </a>
            </div>
        </div>

        <div class="col-sm-6 col-md-6 col-xl-3"> 
            <div class="card custom-card"> 
                <a href="#">
                    <div class="card-body d-flex justify-content-between align-items-center"> 
                        <div class="service-info"> 
                            <h6 class="dash-12 mb-2">Other</h6> 
                        </div> 
                        <div class="service-image"> 
                            <img src="{{ asset('public/admin/fire-img/other.webp') }}" alt="Other" style="width:100px; height:60px; object-fit:contain">
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
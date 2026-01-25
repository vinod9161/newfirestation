@extends('layouts.admin.template')
@section('title')
<title>Admin Dashboard</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')

<style>
h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 10px;
}

a {
    text-decoration: none;
}

.card1 {
    background: linear-gradient(to right, #ffffff, #f8f9fc);
    border-left: 6px solid;
    border-radius: 16px;
    padding: 10px 20px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
    transition: all 0.3s ease-in-out;
    color: inherit;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card1:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
}

.card-header1 {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 14px;
}

.card1 .icon {
    font-size: 34px;
    color: #4e73df;
}

.card1 .number {
    color: #fff;
    font-size: 24px;
    font-weight: bold;
    padding: 0px 10px;
    border-radius: 5px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.card1 h4 {
    font-size: 14px;
    color: #777;
    margin: 0;
}

.card1 .value {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
}

.card-container {
    display: flex;
    flex-wrap: nowrap;
    gap: 5px;
	
}

.kpi-card {
    background-color: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 5px;
    width: 150px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	text-align: center;
}

.kpi-card h4 {
    color: #4433cc;
    font-size: 16px;
	fomt-weight: 600;
    margin-bottom: 8px;
	white-space: nowrap;
}

.kpi-card .value {
    font-size: 20px;
    font-weight: bold;
    color: #000;
}

.kpi-card .value span {
    color: green;
    font-size: 16px;
    vertical-align: middle;
}

.kpi-card .sub {
    font-size: 12px;
    color: #666;
    margin-top: 4px;
}

.kpi-card .change {
    font-size: 12px;
    color: green;
    margin-top: 2px;
}
.card-body{
	background-color: #fff !important;
	box-shadow: 0px 0px 0px #9db5ff !important;
	padding: 20px !important;
}
</style>

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Welcome To Dashboard!</h5>
        <ol class="breadcrumb mb-sm-0 mb-4">
            <li class="breadcrumb-item"><a href="javascript:void(0);" class="fs-14">Home</a></li>
            <li class="breadcrumb-item active fs-14" aria-current="page">Fire Service</li>
        </ol>
    </div>
</div>

<!-- Row -->
<div class="row row-sm">

    <!-- All Noc Count -->
     <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-header">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" style="float: right">Dashboard</a>
            </div>
            <div class="card-body dash1">
                <div class="tabel-responsive">
                    <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>District Name</th>
                                <th>Not Assigned</th>
                                <th>Assigned But Not Verified</th>
                                <th>Verified</th>
                                <th>Approved</th>
                                <th>Rejected</th>
                                <th>Pending</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allNocCountData as $row)
                                <tr>
                                    <td>{{ $row['District Name'] ?? '0' }}</td>
                                    <td>{{ $row['Not Assigned'] ?? '0' }}</td>
                                    <td>{{ $row['Assigned But Not Verified'] ?? '0' }}</td>
                                    <td>{{ $row['Verified'] ?? '0' }}</td>
                                    <td>{{ $row['Approved'] ?? '0' }}</td>
                                    <td>{{ $row['Rejected'] ?? '0' }}</td>
                                    <td>{{ $row['Pending'] ?? '0' }}</td>
                                    <th>{{ $row['Total'] ?? '0' }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
     </div>
    <!-- End All Noc Count --> 

   
    <!-- End Row -->
    @endsection
    @section('scripts')
   
    @stop
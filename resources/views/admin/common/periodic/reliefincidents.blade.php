@extends('layouts.admin.template')
@section('title')
<title>Periodic Relief Incidents</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Periodic Report</h5>
    </div>
</div>

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Periodic Report
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="text-wrap">
                        <div class="example">
                           <div class="btn-list"> 
                            <a href="{{ route('admin.periodic-employee') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Employees</a>
                            <a href="{{ route('admin.periodic-report-inspection-officers') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Inspection of Officers</a>
                            <a href="{{ route('admin.periodic-report-rewards') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Rewards</a>
                            <a href="{{ route('admin.periodic-report-punishment') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Punishment</a>
                            <a href="{{ route('admin.periodic-report-communication') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Communication System</a>
                            <a href="{{ route('admin.periodic-report-fire-stations') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire Stations</a>
                            <a href="{{ route('admin.periodic-report-fire-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire Incident</a>
                            <a href="{{ route('admin.periodic-report-rescue-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Rescue Incident</a>
                            <a href="{{ route('admin.periodic-report-relief-incidents') }}" type="button" class="btn btn-primary btn-wave waves-effect waves-light">Relief Incident</a>
                            <a href="{{ route('admin.periodic-report-service-duties') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Service Duties</a>
                            <a href="{{ route('admin.periodic-report-awareness-programs') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Awareness Programe</a>
                            <a href="{{ route('admin.periodic-report-hydrants') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Hydrants/Water Outlets & Bodies</a>
                            <a href="{{ route('admin.periodic-report-noc') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire NOC</a>
                            <a href="{{ route('admin.periodic-report-fire-inspections') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Inspection/Audit</a>
                            <a href="{{ route('admin.periodic-report-fire-vehicles') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Vehicle/Machine</a>
                            </div>
                        </div>
                     </div>
                </div>

                <div class="col-md-12" style="margin-top:2em;">
                    <h4 class="text-center alert alert-primary">Details of Relief Incidents</h4>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Month<sup class="text-danger">*</sup></label>
                                <select class="form-control js-example-basic-single" name="month" id="month" required="">
                                    <option value="">--Select Month--</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Year<sup class="text-danger">*</sup></label>
                                <select class="form-control js-example-basic-single" name="year" id="year" required="">
                                    <option value="">--Select Year--</option>
                                    <option value="2024">2024</option>
                                    <option value="2025" selected="">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>District<sup class="text-danger">*</sup></label>
                                <select class="form-control js-example-basic-single" name="district_id" id="district_id">
                                    <option value="">Select District</option>
                                    <option value="1">Dehradun देहरादून </option>
                                    <option value="2">Chamoli चमोली </option>
                                    <option value="3">Haridwar हरिद्वार </option>
                                    <option value="4">Rudraprayag रूद्रप्रयाग </option>
                                    <option value="5">Uttarkashi उत्तरकाशी </option>
                                    <option value="6">Pauri Garhwal पौड़ी गढ़वाल </option>
                                    <option value="7">Tehri Garhwal टिहरी गढ़वाल </option>
                                    <option value="8">Almora अल्मोड़ा </option>
                                    <option value="9">Bageshwar बागेश्वर </option>
                                    <option value="10">Champawat चम्पावत </option>
                                    <option value="11">Pithoragarh पिथौरागढ़ </option>
                                    <option value="12">Nainital नैनीताल </option>
                                    <option value="13">Udham Singh Nagar ऊधमसिंहनगर </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="find" class="btn btn-dark" style="margin-top:30px">Find</button>
                                <a href="#" class="btn btn-dark" style="margin-top:30px"><i class="fa fa-cloud-download"></i> Download</a>
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="table-responsive">
                        <table class="table ucp-table table-hover table-bordered display" id="relief-table" cellspacing="0" width="100%">
                            <tbody><tr style="height:37pt">
                               <th style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                  <p class="s5" style="padding-left: 4pt;text-indent: 0pt;">SL. No</p>
                               </th>
                               <th style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                  <p class="s5" style="padding-left: 5pt;padding-right: 32pt;text-indent: 0pt;">Name of District</p>
                               </th>
                               <th style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                  <p class="s5" style="padding-left: 4pt;text-indent: 0pt;">Name of fire station</p>
                               </th>
                               <th style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                  <p class="s5" style="padding-left: 4pt;padding-right: 7pt;text-indent: 0pt;line-height: 14pt;">Type Of relief work</p>
                               </th>
                               <th style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                  <p class="s5" style="padding-left: 4pt;padding-right: 17pt;text-indent: 0pt;text-align: justify;">Total Relief calls</p>
                               </th>
                               <th style="width:88pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" colspan="2">
                                  <p class="s5" style="padding-left: 14pt;text-indent: 0pt;">Lives saved</p>
                               </th>
                               <th style="width:89pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" colspan="2">
                                  <p class="s5" style="padding-left: 4pt;text-indent: 0pt;">Lives lost</p>
                               </th>
                               <th style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                  <p class="s5" style="padding-left: 4pt;padding-right: 4pt;text-indent: 0pt;">Other details</p>
                               </th>
                            </tr>
                            <tr style="height:19pt">
                               <th style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s9" style="padding-left: 4pt;text-indent: 0pt;">Human</p>
                               </th>
                               <th style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s9" style="padding-left: 4pt;text-indent: 0pt;">animal</p>
                               </th>
                               <th style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s9" style="padding-left: 4pt;text-indent: 0pt;">Human</p>
                               </th>
                               <th style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s9" style="padding-left: 4pt;text-indent: 0pt;">Animal</p>
                               </th>
                            </tr>
                                                          <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">2<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">3<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">4<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">5<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">6<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">7<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">8<br></p>
                               </td>
                               <td style="width:82pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून<br></p>
                               </td>
                               <td style="width:73pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:85pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun<br></p>
                               </td>
                               <td style="width:53pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">1 <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:43pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                               </td>
                               <td style="width:45pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;"><br></p>
                               </td>
                            </tr>
                          </tbody>
                        </table>
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

<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script>
$(function(e) {

    // file export datatable
    $('#datatable-basic').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
    });
});
</script>
@stop
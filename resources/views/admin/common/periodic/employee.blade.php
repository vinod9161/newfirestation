@extends('layouts.admin.template')
@section('title')
<title>Periodic Employee Report</title>
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
                                <a href="{{ route('admin.periodic-employee') }}" type="button" class="btn btn-primary btn-wave waves-effect waves-light">Employees</a>
                                <a href="{{ route('admin.periodic-report-inspection-officers') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Inspection of Officers</a>
                                <a href="{{ route('admin.periodic-report-rewards') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Rewards</a>
                                <a href="{{ route('admin.periodic-report-punishment') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Punishment</a>
                                <a href="{{ route('admin.periodic-report-communication') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Communication System</a>
                                <a href="{{ route('admin.periodic-report-fire-stations') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire Stations</a>
                                <a href="{{ route('admin.periodic-report-fire-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire Incident</a>
                                <a href="{{ route('admin.periodic-report-rescue-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Rescue Incident</a>
                                <a href="{{ route('admin.periodic-report-relief-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Relief Incident</a>
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
                    <h4 class="text-center alert alert-primary">Details of Employees</h4>
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
                        <table class="table ucp-table table-hover table-bordered display" id="employee-table" cellspacing="0" width="100%">
                           <tbody><tr style="height:15pt">
                              <th style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 15pt;">SL. No</p>
                              </th>
                              <th style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 15pt;">Designation</p>
                              </th>
                              <th style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                 <p class="s3" style="padding-left: 5pt;text-indent: 0pt;line-height: 15pt;">Sanctioned Strength</p>
                              </th>
                              <th style="width:160pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" colspan="3">
                                 <p class="s3" style="padding-left: 53pt;padding-right: 52pt;text-indent: 0pt;line-height: 14pt;text-align: center;">Available</p>
                              </th>
                              <th style="width:133pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" colspan="4">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">Category</p>
                              </th>
                              <th style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt" rowspan="2">
                                 <p class="s3" style="padding-left: 5pt;text-indent: 0pt;line-height: 15pt;">UPNL</p>
                              </th>
                           </tr>
                           <tr style="height:16pt">
                              <th style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">Male</p>
                              </th>
                              <th style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">Female</p>
                              </th>
                              <th style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">Total</p>
                              </th>
                              <th style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">Gen</p>
                              </th>
                              <th style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 5pt;text-indent: 0pt;line-height: 14pt;">SC</p>
                              </th>
                              <th style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">ST</p>
                              </th>
                              <th style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">OBC</p>
                              </th>
                           </tr>
                           <tr style="height:15pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">1</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">CFO</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">1<br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">7<br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">7<br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">14<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">7<br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">7<br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">7<br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">7<br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:16pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">2</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">FSO</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">12<br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">18<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:15pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">3</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">FSSO</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">16<br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">19<br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">19<br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">38<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">19 <br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">19<br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">19<br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">19<br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:16pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">4</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">LFM</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">61<br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">135 <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">135<br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">270<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">135 <br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">135 <br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">135 <br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">135<br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:15pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">5</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">DVR</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">72<br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">185 <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">185<br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">370<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">185<br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">185<br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">185<br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">185 <br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:16pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">6</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">ASI<span class="s4">¼</span>M<span class="s4">½</span></p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:15pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">7</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">FM</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">357 <br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:31pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;text-align: left;">8</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;padding-right: 34pt;text-indent: 0pt;line-height: 16pt;text-align: left;">COOK/ KAHAR</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">25<br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">24 <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">24 <br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">48<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">24<br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">24 <br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">24 <br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">24 <br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:15pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 13pt;text-align: left;">9</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 13pt;text-align: left;">OP</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">25 <br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">--<br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">-- <br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:15pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 13pt;text-align: left;">10</p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 13pt;text-align: left;">SWR</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">10 <br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">6 <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">6 <br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">12<br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">6 <br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">6 <br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">6 <br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">6 <br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">9<br></p>
                              </td>
                           </tr>
                           <tr style="height:16pt">
                              <td style="width:35pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;"><br></p>
                              </td>
                              <td style="width:83pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p class="s3" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: left;">TOTAL</p>
                              </td>
                              <td style="width:79pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">566 <br></p>
                              </td>
                              <td style="width:44pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">385 <br></p>
                              </td>
                              <td style="width:57pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">385 <br></p>
                              </td>
                              <td style="width:39pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">770 <br></p>
                              </td>
                              <td style="width:59pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">385 <br></p>
                              </td>
                              <td style="width:37pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">385 <br></p>
                              </td>
                              <td style="width:28pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">385 <br></p>
                              </td>
                              <td style="width:29pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                 <p style="text-indent: 0pt;text-align: left;">385 <br></p>
                              </td>
                              <td style="width:63pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
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
@extends('layouts.admin.template')
@section('title')
<title>Admin Dashboard</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
<link href="{{ asset('/public/admin/css/dashboard.css') }}" rel="stylesheet">


<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Welcome To Dashboard!</h5>
        <ol class="breadcrumb mb-sm-0 mb-4">
            <li class="breadcrumb-item"><a href="javascript:void(0);" class="fs-14">Home</a></li>
            <li class="breadcrumb-item active fs-14" aria-current="page">Fire Service</li>
        </ol>
    </div>
</div>


<div class="row row-sm">
    <div class="col-md-12">
        <div class="tab-container">

            <input type="radio" name="tab" id="noc" checked>
            <input type="radio" name="tab" id="vehicle">
            <input type="radio" name="tab" id="equip">
            <input type="radio" name="tab" id="fireReport">
            <input type="radio" name="tab" id="rescue">
            <input type="radio" name="tab" id="relief">
            <input type="radio" name="tab" id="hydrent">
            <input type="radio" name="tab" id="employee">

            <div class="tabs">
                <label for="noc" style="padding-top: 24px;">NOC</label>
                <label for="vehicle">Vehicle &amp;<br />Machinery</label>
                <label for="equip" style="padding-top: 24px;">Equipment</label>
                <label for="fireReport">Fire<br />Report</label>
                <label for="rescue">Rescue<br />Report</label>
                <label for="relief">Relief<br />Report</label>
                <label for="hydrent" style="padding-top: 24px;">Hydrent</label>
                <label for="employee" style="padding-top: 24px;">Employees</label>
            </div>

            <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card custom-card" style="margin-bottom: 0px; margin-top: 15px;">
                        <div class="dash1">
                            <div class="row" id="dashboardFilterForm">
                                <div class="col-md-2">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" id="start_date" value="<?= date("Y") ?>-01-01">
                                </div>
                                <div class="col-md-2">
                                    <label>End Date</label>
                                    <input type="date" class="form-control" id="end_date" value="<?= date("Y-m-d") ?>">
                                </div>
                                <div class="col-md-3">
                                    <label>District</label>
                                    <select class="form-control" id="dashboard_dis">
                                        <option value="">--- Select District ---</option>
                                        <?php foreach ($districtList ?? [] as $disData): ?>
                                            <option value="<?= $disData->id ?>"><?= $disData->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Fire Station</label>
                                    <select class="form-control" id="dashboard_fire">
                                        <option value="">--- Select Fire Station ---</option>
                                        <?php foreach ($fireStactionList ?? [] as $fs): ?>
                                            <option value="<?= $fs->id ?>"><?= $fs->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary" id="dashboardfilterBtn"
                                        style="margin-top: 29px;">Filter</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- 3) Contents -->
            <div class="contents">
                <div class="content noc">

                    <div class="tab-container2">
                        <input type="radio" name="tab2" id="AllNOC" checked>
                        <input type="radio" name="tab2" id="PreEstablishment">
                        <input type="radio" name="tab2" id="PreOperational">
                        <input type="radio" name="tab2" id="Renewal">

                        <!-- 2) Labels (tabs) -->
                        <div class="tabs2">
                            <label for="AllNOC">All</label>
                            <label for="PreEstablishment">Pre-Establishment</label>
                            <label for="PreOperational">Pre-Operational</label>
                            <label for="Renewal">Renewal</label>
                        </div>

                        <!-- 3) Contents -->
                        <div class="contents2">
                            <div class="content2 AllNOC">
                                <div class="card-body dash1" style="padding: 0px !important;">
                                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">NOC - Dashboard</h1>
                                    <div class="row">
                                        <div class="col-md-12 form-group" style="margin-top: 20px">
                                            <div class="dashboard">
                                                <a href="#" class="card1" style="border-left-color:#28a745;">
                                                    <div class="card-header1">
                                                        <div class="icon">📥</div>
                                                        <div class="number" style="background-color: #28a745;" id="all_total_received">78</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">RECEIVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#59abf9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🆗</div>
                                                        <div class="number" style="background-color: #59abf9;" id="all_total_approved">8</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">APPROVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#7969b9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🔙</div>
                                                        <div class="number" style="background-color: #7969b9;" id="all_total_reverted">4</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">REVERTED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#dea364;">
                                                    <div class="card-header1">
                                                        <div class="icon">⏳</div>
                                                        <div class="number" style="background-color: #dea364;" id="all_total_in_process">35</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">IN-PROCESS</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#d80303;">
                                                    <div class="card-header1">
                                                        <div class="icon">🕒</div>
                                                        <div class="number" style="background-color: #d80303;" id="all_total_pending">19</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">PENDING</div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-5">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="font-size:18px">No. of Application (by status)</h3>
                                                    <canvas id="AllNOCApplicationByStatusPieChart" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by district)</h3>
                                                    <canvas id="AllNOCApplicationByStatusBarChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by type)</h3>
                                                    <canvas id="AllNOCApplicationByTypeBarChart" style="max-height:250px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="text-align:left">Reason of Rejection</h3>
                                                    <div style="display:flex;gap:12px;align-items:center">
                                                        <div style="flex:1">
                                                            <canvas id="AllNOCRejectPie" style="max-width:420px;margin:0 auto;display:block;"></canvas>
                                                        </div>
                                                        <div style="width:220px">
                                                            <h4 style="margin-bottom:8px;color:#c0392b">Pre-Establishment</h4>
                                                            <p style="font-weight:700;color:#d35400">Reason of Rejection</p>
                                                            <ul style="font-size:13px;color:var(--muted)">
                                                                <li>Letter from Development Authority Missing — 43%</li>
                                                                <li>Proposed Map Missing — 19%</li>
                                                                <li>Incomplete Map — 9%</li>
                                                                <li>Other — 29%</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="all_approved_title">All (Approved) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="all_approved_table">
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td></tr>
                                                            <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="all_reverted_title">All (Reverted) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="all_reverted_table" >
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td></tr>
                                                            <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-12">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <table>
                                                            <thead class="thead-primary">
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
                                    </div>

                                </div>

                            </div>
                            <div class="content2 PreEstablishment">
                                <div class="card-body dash1" style="padding: 0px !important;">
                                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Pre-Establishment - Dashboard</h1>
                                    <div class="row">
                                        <div class="col-md-12 form-group" style="margin-top: 20px">
                                            <div class="dashboard">
                                                <a href="#" class="card1" style="border-left-color:#28a745;">
                                                    <div class="card-header1">
                                                        <div class="icon">📥</div>
                                                        <div class="number" style="background-color: #28a745;" id="pre_total_received">78</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">RECEIVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#59abf9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🆗</div>
                                                        <div class="number" style="background-color: #59abf9;" id="pre_total_approved">8</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">APPROVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#7969b9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🔙</div>
                                                        <div class="number" style="background-color: #7969b9;" id="pre_total_reverted">4</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">REVERTED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#dea364;">
                                                    <div class="card-header1">
                                                        <div class="icon">⏳</div>
                                                        <div class="number" style="background-color: #dea364;" id="pre_total_in_process">35</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">IN-PROCESS</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#d80303;">
                                                    <div class="card-header1">
                                                        <div class="icon">🕒</div>
                                                        <div class="number" style="background-color: #d80303;" id="pre_total_pending">19</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">PENDING</div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-5">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="font-size:18px">No. of Application (by status)</h3>
                                                    <canvas id="PreEstablishmentApplicationByStatusPieChart" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by district)</h3>
                                                    <canvas id="PreEstablishmentApplicationByStatusBarChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by type)</h3>
                                                    <canvas id="PreEstablishmentApplicationByTypeBarChart" style="max-height:250px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="text-align:left">Reason of Rejection</h3>
                                                    <div style="display:flex;gap:12px;align-items:center">
                                                        <div style="flex:1">
                                                            <canvas id="PreEstablishmentRejectPie" style="max-width:420px;margin:0 auto;display:block;"></canvas>
                                                        </div>
                                                        <div style="width:220px">
                                                            <h4 style="margin-bottom:8px;color:#c0392b">Pre-Establishment</h4>
                                                            <p style="font-weight:700;color:#d35400">Reason of Rejection</p>
                                                            <ul style="font-size:13px;color:var(--muted)">
                                                                <li>Letter from Development Authority Missing — 43%</li>
                                                                <li>Proposed Map Missing — 19%</li>
                                                                <li>Incomplete Map — 9%</li>
                                                                <li>Other — 29%</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="pre_est_approved_title">Pre-Establishment (Approved) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="pre_est_approved_table">
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td></tr>
                                                            <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="pre_est_reverted_title">Pre-Establishment (Reverted) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="pre_est_reverted_table">
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td></tr>
                                                            <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-12">
                                            <div class="card custom-card">
                                                <!--<div class="card-header">-->
                                                <!--    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" style="float: right">Dashboard</a>-->
                                                <!--</div>-->
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <table>
                                                            <thead class="thead-primary">
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
                                    </div>

                                </div>

                            </div>




                            <div class="content2 PreOperational">
                                <div class="card-body dash1" style="padding: 0px !important;">
                                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Pre-Operational - Dashboard</h1>
                                    <div class="row">
                                        <div class="col-md-12 form-group" style="margin-top: 20px">
                                            <div class="dashboard">
                                                <a href="#" class="card1" style="border-left-color:#28a745;">
                                                    <div class="card-header1">
                                                        <div class="icon">📥</div>
                                                        <div class="number" style="background-color: #28a745;" id="op_total_received">78</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">RECEIVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#59abf9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🆗</div>
                                                        <div class="number" style="background-color: #59abf9;" id="op_total_approved">8</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">APPROVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#7969b9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🔙</div>
                                                        <div class="number" style="background-color: #7969b9;" id="op_total_reverted">4</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">REVERTED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#dea364;">
                                                    <div class="card-header1">
                                                        <div class="icon">⏳</div>
                                                        <div class="number" style="background-color: #dea364;" id="op_total_in_process">35</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">IN-PROCESS</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#d80303;">
                                                    <div class="card-header1">
                                                        <div class="icon">🕒</div>
                                                        <div class="number" style="background-color: #d80303;" id="op_total_pending">19</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">PENDING</div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-5">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="font-size:18px">No. of Application (by status)</h3>
                                                    <canvas id="PreOperationalApplicationByStatusPieChart" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by district)</h3>
                                                    <canvas id="PreOperationalApplicationByStatusBarChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by type)</h3>
                                                    <canvas id="PreOperationalApplicationByTypeBarChart" style="max-height:250px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="text-align:left">Reason of Rejection</h3>
                                                    <div style="display:flex;gap:12px;align-items:center">
                                                        <div style="flex:1">
                                                            <canvas id="PreOperationalRejectPie" style="max-width:420px;margin:0 auto;display:block;"></canvas>
                                                        </div>
                                                        <div style="width:220px">
                                                            <h4 style="margin-bottom:8px;color:#c0392b">Pre-Operational</h4>
                                                            <p style="font-weight:700;color:#d35400">Reason of Rejection</p>
                                                            <ul style="font-size:13px;color:var(--muted)">
                                                                <li>Letter from Development Authority Missing — 43%</li>
                                                                <li>Proposed Map Missing — 19%</li>
                                                                <li>Incomplete Map — 9%</li>
                                                                <li>Other — 29%</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="pre_op_approved_title">Pre-Operational (Approved) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="pre_op_approved_table">
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td></tr>
                                                            <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="pre_op_reverted_title">Pre-Operational (Reverted) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="pre_op_reverted_table">
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td>< td>7</ td >< td > 7.12 </ td >< td > 32 </ td >
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-12">
                                            <div class="card custom-card">
                                                <!--<div class="card-header">-->
                                                <!--    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" style="float: right">Dashboard</a>-->
                                                <!--</div>-->
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <table>
                                                            <thead class="thead-primary">
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
                                    </div>

                                </div>
                            </div>

                            <div class="content2 Renewal">
                                <div class="card-body dash1" style="padding: 0px !important;">
                                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Renewal - Dashboard</h1>
                                    <div class="row">
                                        <div class="col-md-12 form-group" style="margin-top: 20px">
                                            <div class="dashboard">
                                                <a href="#" class="card1" style="border-left-color:#28a745;">
                                                    <div class="card-header1">
                                                        <div class="icon">📥</div>
                                                        <div class="number" style="background-color: #28a745;" id="ren_total_received">78</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">RECEIVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#59abf9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🆗</div>
                                                        <div class="number" style="background-color: #59abf9;" id="ren_total_approved">8</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">APPROVED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#7969b9;">
                                                    <div class="card-header1">
                                                        <div class="icon">🔙</div>
                                                        <div class="number" style="background-color: #7969b9;" id="ren_total_reverted">4</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">REVERTED</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#dea364;">
                                                    <div class="card-header1">
                                                        <div class="icon">⏳</div>
                                                        <div class="number" style="background-color: #dea364;" id="ren_total_in_process">35</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">IN-PROCESS</div>
                                                </a>
                                                <a href="#" class="card1" style="border-left-color:#d80303;">
                                                    <div class="card-header1">
                                                        <div class="icon">🕒</div>
                                                        <div class="number" style="background-color: #d80303;" id="ren_total_pending">19</div>
                                                    </div>
                                                    <h4>Number of Application</h4>
                                                    <div class="value">PENDING</div>
                                                </a>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-5">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="font-size:18px">No. of Application (by status)</h3>
                                                    <canvas id="RenewalApplicationByStatusPieChart" height="300"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by district)</h3>
                                                    <canvas id="RenewalApplicationByStatusBarChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3>No. of Application (by type)</h3>
                                                    <canvas id="RenewalApplicationByTypeBarChart" style="max-height:250px"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <h3 style="text-align:left">Reason of Rejection</h3>
                                                    <div style="display:flex;gap:12px;align-items:center">
                                                        <div style="flex:1">
                                                            <canvas id="RenewalRejectPie" style="max-width:420px;margin:0 auto;display:block;"></canvas>
                                                        </div>
                                                        <div style="width:220px">
                                                            <h4 style="margin-bottom:8px;color:#c0392b">Renewal</h4>
                                                            <p style="font-weight:700;color:#d35400">Reason of Rejection</p>
                                                            <ul style="font-size:13px;color:var(--muted)">
                                                                <li>Letter from Development Authority Missing — 43%</li>
                                                                <li>Proposed Map Missing — 19%</li>
                                                                <li>Incomplete Map — 9%</li>
                                                                <li>Other — 29%</li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="renewal_approved_title">Renewal (Approved) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                                <tr>
                                                                    <th>Sr</th>
                                                                    <th>District</th>
                                                                    <th>0-5 Days</th>
                                                                    <th>6-10</th>
                                                                    <th>11-15</th>
                                                                    <th>Avg Days</th>
                                                                    <th>Total Application</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="renewal_approved_table">
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Almora</td>
                                                                    <td>1</td>
                                                                    <td>0</td>
                                                                    <td>1</td>
                                                                    <td>4.50</td>
                                                                    <td>2</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Bageshwar</td>
                                                                    <td>2</td>
                                                                    <td>1</td>
                                                                    <td>0</td>
                                                                    <td>6.33</td>
                                                                    <td>3</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Chamoli</td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td>1</td>
                                                                    <td>5.00</td>
                                                                    <td>1</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Dehradun</td>
                                                                    <td>10</td>
                                                                    <td>15</td>
                                                                    <td>7</td>
                                                                    <td>7.12</td>
                                                                    <td>32</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>Haridwar</td>
                                                                    <td>8</td>
                                                                    <td>9</td>
                                                                    <td>6</td>
                                                                    <td>8.45</td>
                                                                    <td>23</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card custom-card">
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <h3 style="text-align:left" id="renewal_reverted_title">Renewal (Reverted) — Jun to July 2025</h3>
                                                        <table>
                                                            <thead class="thead-primary">
                                                                <tr>
                                                                    <th>Sr</th>
                                                                    <th>District</th>
                                                                    <th>0-5 Days</th>
                                                                    <th>6-10</th>
                                                                    <th>11-15</th>
                                                                    <th>Avg Days</th>
                                                                    <th>Total Application</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="renewal_reverted_table">
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Almora</td>
                                                                    <td>1</td>
                                                                    <td>0</td>
                                                                    <td>1</td>
                                                                    <td>4.50</td>
                                                                    <td>2</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>2</td>
                                                                    <td>Bageshwar</td>
                                                                    <td>2</td>
                                                                    <td>1</td>
                                                                    <td>0</td>
                                                                    <td>6.33</td>
                                                                    <td>3</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>3</td>
                                                                    <td>Chamoli</td>
                                                                    <td>0</td>
                                                                    <td>0</td>
                                                                    <td>1</td>
                                                                    <td>5.00</td>
                                                                    <td>1</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>4</td>
                                                                    <td>Dehradun</td>
                                                                    <td>10</td>
                                                                    <td>15</td>
                                                                    <td>7</td>
                                                                    <td>7.12</td>
                                                                    <td>32</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>5</td>
                                                                    <td>Haridwar</td>
                                                                    <td>8</td>
                                                                    <td>9</td>
                                                                    <td>6</td>
                                                                    <td>8.45</td>
                                                                    <td>23</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row row-sm">
                                        <div class="col-md-12">
                                            <div class="card custom-card">
                                                <!--<div class="card-header">-->
                                                <!--    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary btn-sm" style="float: right">Dashboard</a>-->
                                                <!--</div>-->
                                                <div class="card-body dash1">
                                                    <div class="tabel-responsive">
                                                        <table>
                                                            <thead class="thead-primary">
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
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ asset('/public/admin/js/dashboard-two.js') }}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).on('change', '#dashboard_dis', function () {

    let district_id = $(this).val();

    // reset fire station dropdown
    $('#dashboard_fire').html('<option value="">Loading...</option>');

    if (district_id == '') {
        $('#dashboard_fire').html('<option value="">--- Select Fire Station ---</option>');
        return;
    }

    $.ajax({
        url: "{{ url('get-fire-stations') }}/" + district_id,
        type: "GET",
        success: function (res) {

            let options = '<option value="">--- Select Fire Station ---</option>';

            res.forEach(function (fs) {
                options += `<option value="${fs.id}">${fs.name}</option>`;
            });

            $('#dashboard_fire').html(options);
        }
    });

});
</script>
<script>
    $(document).on('click', '#dashboardfilterBtn', function () {

        let start_date  = $('#start_date').val();
        let end_date    = $('#end_date').val();
        let district_id = $('#dashboard_dis').val();
        let station_id  = $('#dashboard_fire').val();

        $.ajax({
            url: "{{ route('admin.getNocDashboardData') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                start_date,
                end_date,
                district_id,
                station_id
            },
            success: function(res) {

                // 🔥 All NOC
                $('#all_total_received').text(res.all.total_received);
                $('#all_total_approved').text(res.all.approved);
                $('#all_total_reverted').text(res.all.reverted);
                $('#all_total_in_process').text(res.all.in_process);
                $('#all_total_pending').text(res.all.pending);

                // 🔥 Pre-Establishment
                $('#pre_total_received').text(res.pre_est.total_received);
                $('#pre_total_approved').text(res.pre_est.approved);
                $('#pre_total_reverted').text(res.pre_est.reverted);
                $('#pre_total_in_process').text(res.pre_est.in_process);
                $('#pre_total_pending').text(res.pre_est.pending);

                // 🔥 Pre-Operational
                $('#op_total_received').text(res.pre_op.total_received);
                $('#op_total_approved').text(res.pre_op.approved);
                $('#op_total_reverted').text(res.pre_op.reverted);
                $('#op_total_in_process').text(res.pre_op.in_process);
                $('#op_total_pending').text(res.pre_op.pending);

                // 🔥 Renewal
                $('#ren_total_received').text(res.renewal.total_received);
                $('#ren_total_approved').text(res.renewal.approved);
                $('#ren_total_reverted').text(res.renewal.reverted);
                $('#ren_total_in_process').text(res.renewal.in_process);
                $('#ren_total_pending').text(res.renewal.pending);

                // 🔥 ALL NOC
                renderTable(res.tables.all.approved, '#all_approved_table');
                renderTable(res.tables.all.reverted, '#all_reverted_table');

                // Pre-Establishment
                renderTable(res.tables.pre_est.approved, '#pre_est_approved_table');
                renderTable(res.tables.pre_est.reverted, '#pre_est_reverted_table');

                // Pre-Operational
                renderTable(res.tables.pre_op.approved, '#pre_op_approved_table');
                renderTable(res.tables.pre_op.reverted, '#pre_op_reverted_table');

                // Renewal
                renderTable(res.tables.renewal.approved, '#renewal_approved_table');
                renderTable(res.tables.renewal.reverted, '#renewal_reverted_table');

            },
            complete: function() {
                let start = formatDate(start_date);
                let end   = formatDate(end_date);

                // ALL
                $('#all_approved_title').text(`All (Approved) — ${start} to ${end}`);
                $('#all_reverted_title').text(`All (Reverted) — ${start} to ${end}`);


                // Pre-Establishment
                $('#pre_est_approved_title').text(`Pre-Establishment (Approved) — ${start} to ${end}`);
                $('#pre_est_reverted_title').text(`Pre-Establishment (Reverted) — ${start} to ${end}`);

                // Pre-Operational
                $('#pre_op_approved_title').text(`Pre-Operational (Approved) — ${start} to ${end}`);
                $('#pre_op_reverted_title').text(`Pre-Operational (Reverted) — ${start} to ${end}`);

                // Renewal
                $('#renewal_approved_title').text(`Renewal (Approved) — ${start} to ${end}`);
                $('#renewal_reverted_title').text(`Renewal (Reverted) — ${start} to ${end}`);

            }

        });

    });

    $(document).ready(function() {
        $('#dashboardfilterBtn').click();
    });

    function renderTable(data, tableId) {

        let html = '';

        if (!data || data.length === 0) {
            html = `<tr><td colspan="7" style="text-align:center">No Data</td></tr>`;
        } else {
            data.forEach((row, index) => {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.district}</td>
                        <td>${row.days_0_5}</td>
                        <td>${row.days_6_10}</td>
                        <td>${row.days_11_15}</td>
                        <td>${row.avg_days}</td>
                        <td>${row.total}</td>
                    </tr>
                `;
            });
        }

        $(tableId).html(html);
    }

    function formatDate(dateStr) {
        if (!dateStr) return '';

        const date = new Date(dateStr);

        return date.toLocaleDateString('en-IN', {
            day: '2-digit',
            month: 'short',
            year: 'numeric'
        });
    }
</script>


<!-- End Row -->
@endsection
@section('scripts')

@stop
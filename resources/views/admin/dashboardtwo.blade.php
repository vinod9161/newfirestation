@extends('layouts.admin.template')
@section('title')
<title>Admin Dashboard</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')

<link href="{{ asset('/public/admin/css/dashboard.css') }}" rel="stylesheet">
<style>
    /* ===== RESET ===== */
    html, body {
        height: 100%;
        margin: 0;
    }

    /* ===== HEADER (FIXED) ===== */
    /* .app-header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        height: 70px;
        z-index: 1000;
        background: #fff;
    } */

    /* ===== SIDEBAR (FIXED) ===== */
    /* .app-sidebar {
        position: fixed;
        top: 70px; 
        left: 0;
        width: 240px; 
        height: calc(100vh - 70px);
        overflow-y: auto;
        background: #fff;
    } */

    /* ===== MAIN CONTENT (SCROLL AREA) ===== */
    .main-content {
        margin-top: 70px;   /* header space */
        margin-left: 240px; /* sidebar width */
        height: calc(100vh - 70px);
        overflow-y: auto;
        overflow-x: hidden;
        padding: 15px;
        background: #f5f6fa;
    }

    /* ===== CONTAINER FIX ===== */
    .container-fluid {
        height: auto;
    }

    /* ===== SMOOTH SCROLL ===== */
    .main-content {
        scroll-behavior: smooth;
    }

    /* ===== OPTIONAL: SCROLLBAR STYLE ===== */
    .main-content::-webkit-scrollbar {
        width: 6px;
    }

    .main-content::-webkit-scrollbar-thumb {
        background: #999;
        border-radius: 10px;
    }

    /* ===== OPTIONAL: STICKY FILTER BAR ===== */
    #dashboardFilterForm {
        position: sticky;
        top: 0;
        z-index: 10;
        background: #fff;
        padding: 10px;
    }

    /* ===== OPTIONAL: CARD FIX ===== */
    .card {
        overflow: visible;
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
            <style>
                #dateFilters > div {
                    padding-right: 10px;
                }
            </style>
            
            <div class="row row-sm">
                <div class="col-md-12">
                    <div class="card custom-card" style="margin-bottom: 0px; margin-top: 15px;">
                        <div class="dash1">
                            <div class="row align-items-end" id="dashboardFilterForm">

                                <!-- DATE FILTER -->
                                <div id="dateFilters" class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Start Date</label>
                                            <input type="date" class="form-control" id="start_date" value="<?= date("Y") ?>-01-01">
                                        </div>
                                        <div class="col-md-6">
                                            <label>End Date</label>
                                            <input type="date" class="form-control" id="end_date" value="<?= date("Y-m-d") ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- DISTRICT -->
                                <div class="col-md-3">
                                    <label>District</label>
                                    <select class="form-control" id="dashboard_dis">
                                        <option value="">--- Select District ---</option>
                                        <?php foreach ($districtList ?? [] as $disData): ?>
                                            <option value="<?= $disData->id ?>"><?= $disData->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- FIRE STATION -->
                                <div class="col-md-3">
                                    <label>Fire Station</label>
                                    <select class="form-control" id="dashboard_fire">
                                        <option value="">--- Select Fire Station ---</option>
                                        <?php foreach ($fireStactionList ?? [] as $fs): ?>
                                            <option value="<?= $fs->id ?>"><?= $fs->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- BUTTON -->
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-primary w-100" id="dashboardfilterBtn">
                                        Filter
                                    </button>
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
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>>15 Days</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="all_approved_table">
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td></td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td></td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td></td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td></td><td>7.12</td><td>32</td></tr>
                                                            <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td></td><td>8.45</td><td>23</td></tr>
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
                                                            <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>>15 Days</th><th>Avg Days</th><th>Total Application</th></tr>
                                                            </thead>
                                                            <tbody id="all_reverted_table" >
                                                            <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td></td><td>4.50</td><td>2</td></tr>
                                                            <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td></td><td>6.33</td><td>3</td></tr>
                                                            <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td></td><td>5.00</td><td>1</td></tr>
                                                            <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td></td><td>7.12</td><td>32</td></tr>
                                                            <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td></td><td>8.45</td><td>23</td></tr>
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
                                                            <tbody id="all_status_table">
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
                                                            <tbody id="pre_est_status_table">
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
                                                            <tbody id="pre_op_status_table">
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
                                                            <tbody id="renewal_status_table">
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

                <div class="content vehicle">
                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Vehical</h1>
                    <div class="row">
                        <div class="col-md-12" style="overflow-x: scroll;">
                            <div class="card-container">
                                <div class="kpi-card">
                                    <h4>Multipurpose<br />Fire Tender</h4>
                                    <div  class="value" id="kpi_Multipurpose_Fire_Tender">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Hydraulic<br />Platform</h4>
                                    <div class="value" id="kpi_Hydraulic_Platform">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Water<br />Browser</h4>
                                    <div class="value" id="kpi_Water_Browser">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>DCP<br />Tender</h4>
                                    <div class="value" id="kpi_DCP_Tender">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Foam<br />Tender</h4>
                                    <div class="value" id="kpi_Foam_Tender">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Water<br />Tender</h4>
                                    <div class="value" id="kpi_Water_Tender">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Crash Fire<br />Tender</h4>
                                    <div class="value" id="kpi_Crash_Fire_Tender">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Mini High<br />Pressure</h4>
                                    <div class="value" id="kpi_Mini_High_Pressure">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Water<br />Mist</h4>
                                    <div class="value" id="kpi_Water_Mist">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4><br />Ambulance</h4>
                                    <div class="value" id="kpi_Ambulance">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Rescue<br />Tender</h4>
                                    <div class="value" id="kpi_Rescue_Tender">0</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4><br />PPCV</h4>
                                    <div class="value" id="kpi_PPCV">0</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4><br />Bulero</h4>
                                    <div class="value" id="kpi_Bulero">0</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4>Tools<br />Pump</h4>
                                    <div class="value" id="kpi_Tools_Pump">0</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4>Backpack<br />Set</h4>
                                    <div class="value" id="kpi_Backpack_Set">0</div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="row row-sm">
                        <div class="col-md-7" style="margin-top: 20px">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <canvas id="VehicleChart"></canvas>
                                </div>
                            </div>
                        </div>
                    
                        <div class="col-md-5" style="margin-top: 20px">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <canvas id="VehiclePieChart" width="500" height="500"></canvas>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <div class="row row-sm">
                         <div class="col-md-12">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <div class="tabel-responsive">
                                        <!--<h3 style="text-align:left">Pre-Establishment (Approved) — Jun to July 2025</h3>-->
                                        <table>
                                            <thead class="thead-primary">
                                                <tr>
                                                    <th>Sr</th>
                                                    <th>District</th>
                                                    <th>Foam Tender</th>
                                                    <th>Water Tender</th>
                                                    <th>Crash Fire Tender</th>
                                                    <th>Mini High Fire</th>
                                                    <th>Water Mist</th>
                                                    <th>Rescue Tender</th>
                                                    <th>PCBC</th>
                                                    <th>Bulero</th>
                                                    <th>Tools Pump</th>
                                                    <th>Multipurpose Fire Tender</th>
                                                    <th>Hydrolic Platform</th>
                                                    <th>DRFT Tender</th>
                                                    <th>Backfire Set</th>
                                                    <th>Ambulance</th>
                                                </tr>
                                            </thead>
                                            <tbody id="vehicle_table_body">
                                              <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Champawat</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>6</td><td>Nainital</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>7</td><td>Pauri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>8</td><td>Pithoragarh</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>9</td><td>Rudraprayag</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>10</td><td>Tehri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>11</td><td>Udhamsingh Nagar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>12</td><td>Uttarkashi</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>13</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>    
                            </div>
                         </div>
                    </div>
                    
                </div>

                <div class="content equip">
                  <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Equipment</h1>
                  <div class="row row-sm">
                     <div class="col-md-6">
                        <div class="card custom-card">
                            <div class="card-body dash1">
                                <h3 style="font-size:18px">Disaster Equipment</h3>
                                <canvas id="DisasterEquipmentPieChart" height="400"></canvas>
                            </div>    
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card custom-card">
                            <div class="card-body dash1">
                                <h3 style="font-size:18px">Personal Protective Equipment</h3>
                                <canvas id="PersonalProtectiveEquipmentPieChart" height="400"></canvas>
                            </div>    
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card custom-card">
                            <div class="card-body dash1">
                                <h3 style="font-size:18px">Mountaineering Serach & Rescue Equipment</h3>
                                <canvas id="MountaineeringSerachRescueEquipmentPieChart" height="400"></canvas>
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
                                                <th colspan="16" style="text-align: center;font-size: 20px">Disaster Equipment</th>
                                            </tr>
                                        </thead>
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>District</th>
                                                <th>Comby Tool</th>
                                                <th>Spreader</th>
                                                <th>Wooden cutter</th>
                                                <th>Diamond Chain Saw</th>
                                                <th>Iron Cutter</th>
                                                <th>Pelican Light</th>
                                                <th>Inflatable Lighting Tower</th>
                                                <th>Dragon Light</th>
                                                <th>Portable Generator</th>
                                                <th>smoke blower and exhauster</th>
                                                <th>leaf blower</th>
                                                <th>Stretcher</th>
                                                <th>Victim location Camera</th>
                                                <th>Rope Launcher</th>
                                                <th>Thermal Imaging camera</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr><td>Almora</td><td>1</td><td>-</td><td>2</td><td>2</td><td>-</td><td>-</td><td>3</td><td>21</td><td>4</td><td>-</td><td>-</td><td>16</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>Bageswar</td><td>2</td><td>1</td><td>1</td><td>1</td><td>1</td><td>-</td><td>6</td><td>24</td><td>2</td><td>-</td><td>-</td><td>17</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>Chamoli</td><td>2</td><td>-</td><td>1</td><td>-</td><td>1</td><td>-</td><td>4</td><td>27</td><td>2</td><td>-</td><td>-</td><td>20</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>Champawat</td><td>1</td><td>-</td><td>4</td><td>1</td><td>1</td><td>1</td><td>8</td><td>21</td><td>2</td><td>-</td><td>-</td><td>14</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>Dehradun</td><td>4</td><td>4</td><td>18</td><td>1</td><td>7</td><td>4</td><td>10</td><td>66</td><td>8</td><td>2</td><td>2</td><td>38</td><td>1</td><td>1</td><td>1</td></tr>
                                        <tr><td>Haridwar</td><td>3</td><td>3</td><td>8</td><td>1</td><td>2</td><td>-</td><td>10</td><td>68</td><td>4</td><td>1</td><td>-</td><td>25</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>Nainital</td><td>2</td><td>1</td><td>12</td><td>4</td><td>6</td><td>1</td><td>6</td><td>34</td><td>5</td><td>-</td><td>-</td><td>24</td><td>1</td><td>1</td><td>1</td></tr>
                                        <tr><td>Pauri</td><td>3</td><td>-</td><td>3</td><td>-</td><td>-</td><td>-</td><td>4</td><td>28</td><td>4</td><td>-</td><td>-</td><td>19</td><td>1</td><td>1</td><td>1</td></tr>
                                        <tr><td>Pithoragarh</td><td>1</td><td>1</td><td>1</td><td>1</td><td>1</td><td>-</td><td>5</td><td>15</td><td>2</td><td>-</td><td>-</td><td>12</td><td>1</td><td>1</td><td>1</td></tr>
                                        <tr><td>Rudraprayag</td><td>2</td><td>-</td><td>1</td><td>1</td><td>1</td><td>-</td><td>3</td><td>15</td><td>2</td><td>-</td><td>-</td><td>14</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>Tehri</td><td>2</td><td>1</td><td>3</td><td>1</td><td>1</td><td>1</td><td>3</td><td>27</td><td>3</td><td>-</td><td>-</td><td>19</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>US Nagar</td><td>5</td><td>4</td><td>6</td><td>1</td><td>8</td><td>-</td><td>8</td><td>49</td><td>6</td><td>1</td><td>-</td><td>20</td><td>-</td><td>1</td><td>-</td></tr>
                                        <tr><td>Uttarkashi</td><td>2</td><td>-</td><td>3</td><td>-</td><td>2</td><td>1</td><td>8</td><td>22</td><td>2</td><td>-</td><td>1</td><td>19</td><td>-</td><td>1</td><td>-</td></tr>

                                        </tbody>
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>Total</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                
                                            </tr>
                                        </thead>
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
                                                <th colspan="16" style="text-align: center;font-size: 20px">Personal Protective Equipment</th>
                                            </tr>
                                        </thead>
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>District</th>
                                                <th>Proximity Suits</th>
                                                <th>Breathing apparatus</th>
                                                <th>safety Knife</th>
                                                <th>Safety Goggles</th>
                                                <th>Fire Entry Suits</th>
                                                <th>Chemical Suits</th>
                                                <th>CBRN suits</th>
                                                <th>Fire axe</th>
                                                <th>Distress Signal Units</th>
                                                <th>Fire blanket</th>
                                                <th>Dangri</th>
                                                <th>diving suit</th>
                                                <th>Fire Boot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Almora</td><td>4</td><td>5</td><td>10</td><td>61</td><td>-</td><td>-</td><td>-</td><td>52</td><td>-</td><td>5</td><td>55</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Bageshwar</td><td>4</td><td>8</td><td>8</td><td>63</td><td>-</td><td>-</td><td>-</td><td>46</td><td>-</td><td>5</td><td>66</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Chamoli</td><td>4</td><td>7</td><td>9</td><td>63</td><td>-</td><td>-</td><td>-</td><td>58</td><td>-</td><td>5</td><td>60</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Champawat</td><td>4</td><td>4</td><td>8</td><td>82</td><td>-</td><td>-</td><td>-</td><td>50</td><td>-</td><td>5</td><td>65</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Dehradun</td><td>14</td><td>28</td><td>26</td><td>180</td><td>-</td><td>-</td><td>-</td><td>181</td><td>-</td><td>12</td><td>181</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Haridwar</td><td>13</td><td>16</td><td>41</td><td>150</td><td>-</td><td>-</td><td>-</td><td>124</td><td>-</td><td>12</td><td>140</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Nainital</td><td>7</td><td>14</td><td>13</td><td>142</td><td>-</td><td>-</td><td>-</td><td>85</td><td>-</td><td>10</td><td>110</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Pauri</td><td>5</td><td>8</td><td>11</td><td>73</td><td>-</td><td>-</td><td>-</td><td>57</td><td>-</td><td>5</td><td>65</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Pithoragarh</td><td>4</td><td>4</td><td>8</td><td>54</td><td>-</td><td>-</td><td>-</td><td>32</td><td>-</td><td>5</td><td>50</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Rudraprayag</td><td>4</td><td>3</td><td>9</td><td>35</td><td>-</td><td>-</td><td>-</td><td>27</td><td>-</td><td>5</td><td>53</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Tehri</td><td>5</td><td>8</td><td>8</td><td>77</td><td>1</td><td>-</td><td>-</td><td>57</td><td>-</td><td>5</td><td>60</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>US Nagar</td><td>11</td><td>24</td><td>26</td><td>187</td><td>-</td><td>-</td><td>-</td><td>138</td><td>-</td><td>10</td><td>170</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Uttarkashi</td><td>4</td><td>6</td><td>14</td><td>76</td><td>-</td><td>-</td><td>-</td><td>58</td><td>-</td><td>5</td><td>65</td><td>-</td><td>-</td>
                                          </tr>
                                        </tbody>
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>Total</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
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
                                                <th colspan="16" style="text-align: center;font-size: 20px">Mountaineering Serach & Rescue Equipment</th>
                                            </tr>
                                        </thead>
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>District</th>
                                                <th>District</th>
                                                <th>Cara bineer</th>
                                                <th>ascender (Jumar)</th>
                                                <th>descender</th>
                                                <th>short sling</th>
                                                <th>Tape Sling</th>
                                                <th>Rescue helmet</th>
                                                <th>Head torch/ Lamp</th>
                                                <th>Full Body harness</th>
                                                <th>Seat Harness</th>
                                                <th>single pulley</th>
                                                <th>Double Pulley</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <tr>
                                            <td>Almora</td><td>4</td><td>5</td><td>10</td><td>61</td><td>-</td><td>-</td><td>-</td><td>52</td><td>-</td><td>5</td><td>55</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Bageshwar</td><td>4</td><td>8</td><td>8</td><td>63</td><td>-</td><td>-</td><td>-</td><td>46</td><td>-</td><td>5</td><td>66</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Chamoli</td><td>4</td><td>7</td><td>9</td><td>63</td><td>-</td><td>-</td><td>-</td><td>58</td><td>-</td><td>5</td><td>60</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Champawat</td><td>4</td><td>4</td><td>8</td><td>82</td><td>-</td><td>-</td><td>-</td><td>50</td><td>-</td><td>5</td><td>65</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Dehradun</td><td>14</td><td>28</td><td>26</td><td>180</td><td>-</td><td>-</td><td>-</td><td>181</td><td>-</td><td>12</td><td>181</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Haridwar</td><td>13</td><td>16</td><td>41</td><td>150</td><td>-</td><td>-</td><td>-</td><td>124</td><td>-</td><td>12</td><td>140</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Nainital</td><td>7</td><td>14</td><td>13</td><td>142</td><td>-</td><td>-</td><td>-</td><td>85</td><td>-</td><td>10</td><td>110</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Pauri</td><td>5</td><td>8</td><td>11</td><td>73</td><td>-</td><td>-</td><td>-</td><td>57</td><td>-</td><td>5</td><td>65</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Pithoragarh</td><td>4</td><td>4</td><td>8</td><td>54</td><td>-</td><td>-</td><td>-</td><td>32</td><td>-</td><td>5</td><td>50</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Rudraprayag</td><td>4</td><td>3</td><td>9</td><td>35</td><td>-</td><td>-</td><td>-</td><td>27</td><td>-</td><td>5</td><td>53</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Tehri</td><td>5</td><td>8</td><td>8</td><td>77</td><td>1</td><td>-</td><td>-</td><td>57</td><td>-</td><td>5</td><td>60</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>US Nagar</td><td>11</td><td>24</td><td>26</td><td>187</td><td>-</td><td>-</td><td>-</td><td>138</td><td>-</td><td>10</td><td>170</td><td>-</td><td>-</td>
                                          </tr>
                                          <tr>
                                            <td>Uttarkashi</td><td>4</td><td>6</td><td>14</td><td>76</td><td>-</td><td>-</td><td>-</td><td>58</td><td>-</td><td>5</td><td>65</td><td>-</td><td>-</td>
                                          </tr>
                                        </tbody>
                                        <thead class="thead-primary">
                                            <tr>
                                                <th>Total</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>    
                        </div>
                     </div>
                     
                  </div>
                  
                </div>
        
                <div class="content fireReport">
                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Fire Report</h1>
                    <div class="row">
                        <div class="col-md-12" style="overflow-x: scroll;">
                            <div class="card-container">
                                <div class="kpi-card" style="width: 150px">
                                    <h4>Total Call</h4>
                                    <div class="value">16479</div>
                                </div>
    
                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Completed</h4>
                                    <div class="value">7668</div>
                                </div>
    
                                <div class="kpi-card" style="width: 200px">
                                    <h4>Report In-Completed</h4>
                                    <div class="value">7</div>
                                </div>
    
                                <div class="kpi-card" style="width: 250px">
                                    <h4>Report Pending for Approval</h4>
                                    <div class="value">1</div>
                                </div>
    
                                <div class="kpi-card" style="width: 220px">
                                    <h4>Report Under Investigation</h4>
                                    <div class="value">8</div>
                                </div>
    
                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Issued</h4>
                                    <div class="value">84</div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-7">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3>No. of Incident</h3>
                                    <canvas id="FireReportNoOfIncidentChart" style="max-height:324px"></canvas>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3 style="font-size:18px">Category of Incident</h3>
                                    <canvas id="FireReportCategoryIncidentPieChart"></canvas>
                                </div>    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <!-- <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <canvas id="FireReportMonthReportPieChart"></canvas>
                                </div>    
                            </div>
                        </div> -->
                        <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3 style="font-size:18px">No. of Fire Call</h3>
                                    <canvas id="FireReportNoOfFireCallPieChart"></canvas>
                                </div>    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <div class="tabel-responsive">
                                        <!--<h3 style="text-align:left">Pre-Establishment (Approved) — Jun to July 2025</h3>-->
                                        <table>
                                            <thead class="thead-primary">
                                                <tr>
                                                    <th>Sr</th>
                                                    <th>District</th>
                                                    <th>January</th>
                                                    <th>February</th>
                                                    <th>March</th>
                                                    <th>April</th>
                                                    <th>May</th>
                                                    <th>June</th>
                                                    <th>July</th>
                                                    <th>August</th>
                                                    <th>September</th>
                                                    <th>October</th>
                                                    <th>November</th>
                                                    <th>December</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Champawat</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>6</td><td>Nainital</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>7</td><td>Pauri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>8</td><td>Pithoragarh</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>9</td><td>Rudraprayag</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>10</td><td>Tehri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>11</td><td>Udhamsingh Nagar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>12</td><td>Uttarkashi</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>13</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>    
                            </div>
                         </div>
                    </div>
                </div>
              
                <div class="content rescue">
                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Rescue Report</h1>
                    <div class="row">
                        <div class="col-md-12" style="overflow-x: scroll;">
                            <div class="card-container">
                                <div class="kpi-card" style="width: 150px">
                                    <h4>Total Call</h4>
                                    <div class="value" id="rescue_total_call">0</div>
                                </div>

                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Completed</h4>
                                    <div class="value" id="rescue_report_completed">0</div>
                                </div>

                                <div class="kpi-card" style="width: 200px">
                                    <h4>Report In-Completed</h4>
                                    <div class="value" id="rescue_report_incompleted">0</div>
                                </div>

                                <div class="kpi-card" style="width: 250px">
                                    <h4>Report Pending for Approval</h4>
                                    <div class="value" id="rescue_pending_approval">0</div>
                                </div>

                                <div class="kpi-card" style="width: 220px">
                                    <h4>Report Under Investigation</h4>
                                    <div class="value" id="rescue_under_investigation">0</div>
                                </div>

                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Issued</h4>
                                    <div class="value" id="rescue_report_issued">0</div>
                                </div>
                                <!-- <div class="kpi-card" style="width: 150px">
                                    <h4>Total Call</h4>
                                    <div class="value">16479</div>
                                </div>
    
                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Completed</h4>
                                    <div class="value">7668</div>
                                </div>
    
                                <div class="kpi-card" style="width: 200px">
                                    <h4>Report In-Completed</h4>
                                    <div class="value">7</div>
                                </div>
    
                                <div class="kpi-card" style="width: 250px">
                                    <h4>Report Pending for Approval</h4>
                                    <div class="value">1</div>
                                </div>
    
                                <div class="kpi-card" style="width: 220px">
                                    <h4>Report Under Investigation</h4>
                                    <div class="value">8</div>
                                </div>
    
                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Issued</h4>
                                    <div class="value">84</div>
                                </div> -->
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-7">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3>No. of Incident</h3>
                                    <canvas id="RescueReportNoOfIncidentChart" style="max-height:324px"></canvas>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3 style="font-size:18px">Category of Incident</h3>
                                    <canvas id="RescueReportCategoryIncidentPieChart"></canvas>
                                </div>    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <div class="tabel-responsive">
                                        <!--<h3 style="text-align:left">Pre-Establishment (Approved) — Jun to July 2025</h3>-->
                                        <table>
                                            <thead class="thead-primary">
                                                <tr>
                                                    <th>Sr</th>
                                                    <th>District</th>
                                                    <th>January</th>
                                                    <th>February</th>
                                                    <th>March</th>
                                                    <th>April</th>
                                                    <th>May</th>
                                                    <th>June</th>
                                                    <th>July</th>
                                                    <th>August</th>
                                                    <th>September</th>
                                                    <th>October</th>
                                                    <th>November</th>
                                                    <th>December</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="rescue_table_body">
                                              <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Champawat</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>6</td><td>Nainital</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>7</td><td>Pauri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>8</td><td>Pithoragarh</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>9</td><td>Rudraprayag</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>10</td><td>Tehri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>11</td><td>Udhamsingh Nagar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>12</td><td>Uttarkashi</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>13</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>    
                            </div>
                         </div>
                    </div>
                </div>
              
                <div class="content relief">
                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Relief Report</h1>
                    <div class="row">
                        <div class="col-md-12" style="overflow-x: scroll;">
                            <div class="card-container">
                                <div class="kpi-card" style="width: 150px">
                                    <h4>Total Call</h4>
                                    <div class="value" id="relief_total_call">0</div>
                                </div>
    
                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Completed</h4>
                                    <div class="value" id="relief_report_completed">0</div>
                                </div>
    
                                <div class="kpi-card" style="width: 200px">
                                    <h4>Report In-Completed</h4>
                                    <div class="value" id="relief_report_incompleted">0</div>
                                </div>
    
                                <div class="kpi-card" style="width: 250px">
                                    <h4>Report Pending for Approval</h4>
                                    <div class="value" id="relief_report_pending">0</div>
                                </div>
    
                                <div class="kpi-card" style="width: 220px">
                                    <h4>Report Under Investigation</h4>
                                    <div class="value" id="relief_report_investigation">0</div>
                                </div>
    
                                <div class="kpi-card" style="width: 180px">
                                    <h4>Report Issued</h4>
                                    <div class="value" id="relief_report_issued">0</div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-7">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3>No. of Incident</h3>
                                    <canvas id="ReliefReportNoOfIncidentChart" style="max-height:324px"></canvas>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3 style="font-size:18px">Category of Incident</h3>
                                    <canvas id="ReliefReportCategoryIncidentPieChart"></canvas>
                                </div>    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <div class="tabel-responsive">
                                        <!--<h3 style="text-align:left">Pre-Establishment (Approved) — Jun to July 2025</h3>-->
                                        <table>
                                            <thead class="thead-primary">
                                                <tr>
                                                    <th>Sr</th>
                                                    <th>District</th>
                                                    <th>January</th>
                                                    <th>February</th>
                                                    <th>March</th>
                                                    <th>April</th>
                                                    <th>May</th>
                                                    <th>June</th>
                                                    <th>July</th>
                                                    <th>August</th>
                                                    <th>September</th>
                                                    <th>October</th>
                                                    <th>November</th>
                                                    <th>December</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="relief_table_body">
                                              <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>3</td><td>Champawat</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>6</td><td>Nainital</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>7</td><td>Pauri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>8</td><td>Pithoragarh</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>9</td><td>Rudraprayag</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>10</td><td>Tehri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>11</td><td>Udhamsingh Nagar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>12</td><td>Uttarkashi</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                              <tr><td>13</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td><td>2</td></tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>    
                            </div>
                         </div>
                    </div>
                </div>
              
                <div class="content hydrent">
                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Hydrent</h1>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-7">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3>Fire Hydrent Status</h3>
                                    <canvas id="FireHydrentChart"></canvas>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3 style="font-size:18px">Fire Hydrent</h3>
                                    <canvas id="FireHydrentPieChart"></canvas>
                                </div>    
                            </div>
                        </div>
                    </div>
                </div>
        
                <div class="content employee">
                    <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Employee's</h1>
                  
                    <div class="row">
                        <div class="col-md-12" style="overflow-x: scroll;">
                            <div class="card-container">
                                <div class="kpi-card">
                                    <h4>DDT</h4>
                                    <div class="value">20/28</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>CFO</h4>
                                    <div class="value">12/16</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>FSO</h4>
                                    <div class="value">7/11</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>FSSO</h4>
                                    <div class="value">1/1</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>LFM</h4>
                                    <div class="value">8/22</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>DVR</h4>
                                    <div class="value">84/100</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4>FM</h4>
                                    <div class="value">24/46</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4>4th Class</h4>
                                    <div class="value">19/22</div>
                                </div>
    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-8">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3>Employee - Sanctioned/Available</h3>
                                    <canvas id="EmployeeSanctionedAvailableChart" style="max-height:350px"></canvas>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3>Employee - Gender Ratio</h3>
                                    <canvas id="comboChart" style="max-height:325px"></canvas>
                                </div>    
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <h3 style="font-size:18px">Vacancy</h3>
                                    <canvas id="EmployeeVacancyPieChart"></canvas>
                                </div>    
                            </div>
                        </div>
                    </div>
                    
                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-12">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <div class="tabel-responsive">
                                        <!--<h3 style="text-align:left">Pre-Establishment (Approved) — Jun to July 2025</h3>-->
                                        <table>
                                            <thead class="thead-primary">
                                                <tr>
                                                    <th rowspan="2" class="text-center">Sr</th>
                                                    <th rowspan="2" class="text-center">District</th>
                                                    <th colspan="2" class="text-center">Chief Fire Officer</th>
                                                    <th colspan="2" class="text-center">Fire Officer</th>
                                                    <th colspan="2" class="text-center">Second Fire Officer</th>
                                                    <th colspan="2" class="text-center">Leading Fireman</th>
                                                    <th colspan="2" class="text-center">Fire Officer Driver</th>
                                                    <th colspan="2" class="text-center">Fireman</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Approved</th>
                                                    <th class="text-center">Available</th>
                                                    <th class="text-center">Approved</th>
                                                    <th class="text-center">Available</th>
                                                    <th class="text-center">Approved</th>
                                                    <th class="text-center">Available</th>
                                                    <th class="text-center">Approved</th>
                                                    <th class="text-center">Available</th>
                                                    <th class="text-center">Approved</th>
                                                    <th class="text-center">Available</th>
                                                    <th class="text-center">Approved</th>
                                                    <th class="text-center">Available</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <tr><td>1</td><td>Almora</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>2</td><td>Bageshwar</td><td>2</td><td>1</td><td>0</td><td>6.33</td><td>3</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>3</td><td>Chamoli</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>3</td><td>Champawat</td><td>0</td><td>0</td><td>1</td><td>5.00</td><td>1</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>4</td><td>Dehradun</td><td>10</td><td>15</td><td>7</td><td>7.12</td><td>32</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>5</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>6</td><td>Nainital</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>7</td><td>Pauri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>8</td><td>Pithoragarh</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>9</td><td>Rudraprayag</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>10</td><td>Tehri Garhwal</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>11</td><td>Udhamsingh Nagar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4</td></tr>
                                              <tr><td>12</td><td>Uttarkashi</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
                                              <tr><td>13</td><td>Haridwar</td><td>8</td><td>9</td><td>6</td><td>8.45</td><td>23</td><td>1</td><td>0</td><td>1</td><td>4.50</td><td>2</td><td>1</td><td>4.50</td></tr>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- <script src="{{ asset('/public/admin/js/dashboard-two.js') }}"></script> -->

<script>
    // new Chart(document.getElementById('AllNOCRejectPie'), {
    //     type: 'doughnut',
    //     data: {
    //         labels: ['Letter Missing', 'Proposed Map', 'Incomplete Map', 'Other'],
    //         datasets: [{
    //             data: [43, 19, 9, 29],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#b9b9b9', '#ffd166']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'right'
    //             }
    //         },
    //         aspectRatio: 1.2
    //     }
    // });

    function updateRejectPieChart(data, canvasId) {

        let labels = data.map(item => item.reason);
        let values = data.map(item => item.total);

        if (window[canvasId] && typeof window[canvasId].destroy === 'function') {
            window[canvasId].destroy();
        }

        window[canvasId] = new Chart(document.getElementById(canvasId), {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#2f80ed', '#ff7f50', '#b9b9b9', '#ffd166']
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'right' }
                },
                aspectRatio: 1.2
            }
        });
    }
    new Chart(document.getElementById('PreEstablishmentRejectPie'), {
        type: 'doughnut',
        data: {
            labels: ['Letter Missing', 'Proposed Map', 'Incomplete Map', 'Other'],
            datasets: [{
                data: [43, 19, 9, 29],
                backgroundColor: ['#2f80ed', '#ff7f50', '#b9b9b9', '#ffd166']
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right'
                }
            },
            aspectRatio: 1.2
        }
    });

    new Chart(document.getElementById('PreOperationalRejectPie'), {
        type: 'doughnut',
        data: {
            labels: ['Letter Missing', 'Proposed Map', 'Incomplete Map', 'Other'],
            datasets: [{
                data: [43, 19, 9, 29],
                backgroundColor: ['#2f80ed', '#ff7f50', '#b9b9b9', '#ffd166']
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right'
                }
            },
            aspectRatio: 1.2
        }
    });

    new Chart(document.getElementById('RenewalRejectPie'), {
        type: 'doughnut',
        data: {
            labels: ['Letter Missing', 'Proposed Map', 'Incomplete Map', 'Other'],
            datasets: [{
                data: [43, 19, 9, 29],
                backgroundColor: ['#2f80ed', '#ff7f50', '#b9b9b9', '#ffd166']
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'right'
                }
            },
            aspectRatio: 1.2
        }
    });


    // new Chart(document.getElementById('VehiclePieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Foam Tender', 'Water Tender', 'Crash Fire Tender', 'Mini High Fire', 'Water Mist', 'Rescue Tender', 'PCBC', 'Bulero', 'Tools Pump', 'Multipurpose Fire Tender', 'Hydrolic Platform', 'DRFT Tender', 'Backfire Set', 'Ambulance'],
    //         datasets: [{
    //             data: [15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
    //             backgroundColor: ["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    let pieChart = null;
    let charts = {};
    let barChart = null;

    // new Chart(document.getElementById('AllNOCApplicationByStatusPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
    //         datasets: [{
    //             data: [46, 18, 27, 9],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    function updatePieChart(data, chartId) {

        let ctx = document.getElementById(chartId);

        if (!ctx) return;

        // if (pieChart) {
        //     pieChart.destroy();
        // }
        if (charts[chartId]) {
            charts[chartId].destroy();
        }

        charts[chartId] = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Approved', 'Reverted', 'In Process', 'Pending'],
                datasets: [{
                    data: [
                        data.approved,
                        data.reverted,
                        data.in_process,
                        data.pending
                    ],
                    backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
                }]
            },
            options: {
                plugins: {
                    legend: { position: 'bottom' }
                },
                aspectRatio: 1.4
            }
        });
    }

    function updateBarChart(data, chartId) {

        let ctx = document.getElementById(chartId);

        if (!ctx) return;

        if (barChart) {
            barChart.destroy();
        }

        let labels = data.map(item => item.district);
        let values = data.map(item => item.total);

        barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'No. of Application',
                    data: values
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    }

    // new Chart(document.getElementById('AllNOCApplicationByStatusBarChart'), {
    //     type: 'bar',
    //     data: {
    //         labels: ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'],
    //         datasets: [{
    //             label: 'No. of Application',
    //             data: [5, 12, 30, 18, 80, 65, 55, 44, 16, 8, 33, 70, 10]
    //         }]
    //     },
    //     options: {
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         },
    //         plugins: {
    //             legend: {
    //                 display: false
    //             }
    //         }
    //     }
    // });

    // new Chart(document.getElementById('PreEstablishmentApplicationByStatusPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
    //         datasets: [{
    //             data: [46, 18, 27, 9],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    // new Chart(document.getElementById('PreOperationalApplicationByStatusPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
    //         datasets: [{
    //             data: [46, 18, 27, 9],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    // new Chart(document.getElementById('RenewalApplicationByStatusPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
    //         datasets: [{
    //             data: [46, 18, 27, 9],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    // new Chart(document.getElementById('FireReportCategoryIncidentPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Small Fire', 'Major Fire', 'Serious Fire ', 'Special Fire'],
    //         datasets: [{
    //             data: [46, 18, 27, 9],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });
    // new Chart(document.getElementById('RescueReportCategoryIncidentPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Small Fire', 'Major Fire', 'Serious Fire ', 'Special Fire'],
    //         datasets: [{
    //             data: [46, 18, 27, 9],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    // new Chart(document.getElementById('ReliefReportCategoryIncidentPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Small Fire', 'Major Fire', 'Serious Fire ', 'Special Fire'],
    //         datasets: [{
    //             data: [46, 18, 27, 9],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    // new Chart(document.getElementById('FireHydrentPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Working', 'Not Working', 'Proposed'],
    //         datasets: [{
    //             data: [46, 18, 27],
    //             backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });


    new Chart(document.getElementById('FireReportMonthReportPieChart'), {
        type: 'pie',
        data: {
            labels: ['Small Fire', 'Major Fire', 'Serious Fire ', 'Special Fire'],
            datasets: [{
                data: [46, 18, 27, 9],
                backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8', '#f5b041']
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            aspectRatio: 1.4
        }
    });
    // new Chart(document.getElementById('FireReportNoOfFireCallPieChart'), {
    //     type: 'pie',
    //     data: {
    //         labels: ['Commercial', 'Residential', 'High Rise', 'Forest', 'Farm', 'Industry', 'Vehicle', 'Landscape', 'Other'],
    //         datasets: [{
    //             data: [46, 18, 27, 9, 51, 29, 33, 19, 40],
    //             backgroundColor: ['#f67fa7', '#5f7670', '#98a0a8', '#f5b041', '#2f80ed', '#ff7f50', '#00a0a8', '#f5ff41', '#f5b0ff']
    //         }]
    //     },
    //     options: {
    //         plugins: {
    //             legend: {
    //                 position: 'bottom'
    //             }
    //         },
    //         aspectRatio: 1.4
    //     }
    // });

    new Chart(document.getElementById('EmployeeVacancyPieChart'), {
        type: 'pie',
        data: {
            labels: ['DDT', 'CFO', 'FSO', 'FSSO', 'LFM', 'DVR', 'FM', '4th Class'],
            datasets: [{
                data: [46, 18, 27, 9, 51, 29, 33, 19],
                backgroundColor: ['#f67fa7', '#5f7670', '#98a0a8', '#f5b041', '#2f80ed', '#ff7f50', '#00a0a8', '#f5ff41']
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            aspectRatio: 1.4
        }
    });


    new Chart(document.getElementById('DisasterEquipmentPieChart'), {
        type: 'pie',
        data: {
            labels: ['Foam Tender', 'Water Tender', 'Crash Fire Tender', 'Mini High Fire', 'Water Mist', 'Rescue Tender', 'PCBC', 'Bulero', 'Tools Pump', 'Multipurpose Fire Tender', 'Hydrolic Platform', 'DRFT Tender', 'Backfire Set', 'Ambulance'],
            datasets: [{
                data: [15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
                backgroundColor: ["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            aspectRatio: 1.4
        }
    });


    new Chart(document.getElementById('PersonalProtectiveEquipmentPieChart'), {
        type: 'pie',
        data: {
            labels: ['Foam Tender', 'Water Tender', 'Crash Fire Tender', 'Mini High Fire', 'Water Mist', 'Rescue Tender', 'PCBC', 'Bulero', 'Tools Pump', 'Multipurpose Fire Tender', 'Hydrolic Platform', 'DRFT Tender', 'Backfire Set', 'Ambulance'],
            datasets: [{
                data: [15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
                backgroundColor: ["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            aspectRatio: 1.4
        }
    });


    new Chart(document.getElementById('MountaineeringSerachRescueEquipmentPieChart'), {
        type: 'pie',
        data: {
            labels: ['Foam Tender', 'Water Tender', 'Crash Fire Tender', 'Mini High Fire', 'Water Mist', 'Rescue Tender', 'PCBC', 'Bulero', 'Tools Pump', 'Multipurpose Fire Tender', 'Hydrolic Platform', 'DRFT Tender', 'Backfire Set', 'Ambulance'],
            datasets: [{
                data: [15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
                backgroundColor: ["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            },
            aspectRatio: 1.4
        }
    });



    new Chart(document.getElementById('PreEstablishmentApplicationByStatusBarChart'), {
        type: 'bar',
        data: {
            labels: ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'],
            datasets: [{
                label: 'No. of Application',
                data: [5, 12, 30, 18, 80, 65, 55, 44, 16, 8, 33, 70, 10]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    new Chart(document.getElementById('PreOperationalApplicationByStatusBarChart'), {
        type: 'bar',
        data: {
            labels: ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'],
            datasets: [{
                label: 'No. of Application',
                data: [5, 12, 30, 18, 80, 65, 55, 44, 16, 8, 33, 70, 10]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    new Chart(document.getElementById('RenewalApplicationByStatusBarChart'), {
        type: 'bar',
        data: {
            labels: ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'],
            datasets: [{
                label: 'No. of Application',
                data: [5, 12, 30, 18, 80, 65, 55, 44, 16, 8, 33, 70, 10]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });


    // new Chart(document.getElementById('FireReportNoOfIncidentChart'), {
    //   type:'bar',
    //   data:{labels:['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'],
    //     datasets:[{label:'No. of Application',data:[5,12,30,18,80,65,55,44,16,8,33,70,10]}]
    //   },
    //   options:{scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}}}
    // });

    // new Chart(document.getElementById('RescueReportNoOfIncidentChart'), {
    //   type:'bar',
    //   data:{labels:['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'],
    //     datasets:[{label:'No. of Application',data:[5,12,30,18,80,65,55,44,16,8,33,70,10]}]
    //   },
    //   options:{scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}}}
    // });
    // new Chart(document.getElementById('ReliefReportNoOfIncidentChart'), {
    //   type:'bar',
    //   data:{labels:['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'],
    //     datasets:[{label:'No. of Application',data:[5,12,30,18,80,65,55,44,16,8,33,70,10]}]
    //   },
    //   options:{scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}}}
    // });



    // new Chart(document.getElementById('AllNOCApplicationByTypeBarChart'), {
    //     type: 'bar',
    //     data: {
    //         labels: ['Residential', 'Educational', 'Institutional', 'Business', 'Mercantile', 'Industrial', 'Hazardous', 'Storage', 'Arm Lines', 'Petrol Pump', 'Cinema Hall', 'Fire Cracker', 'Other'],
    //         datasets: [{
    //             label: 'No. of Application',
    //             data: [8, 18, 22, 12, 80, 65, 55, 45, 22, 10, 12, 34, 10]
    //         }]
    //     },
    //     options: {
    //         indexAxis: 'x',
    //         scales: {
    //             y: {
    //                 beginAtZero: true
    //             }
    //         },
    //         plugins: {
    //             legend: {
    //                 display: false
    //             }
    //         },
    //         aspectRatio: 1.6
    //     }
    // });

    function updateTypeBarChart(data, canvasId) {

        let labels = data.map(item => item.type);
        let values = data.map(item => item.total);

        if (window[canvasId] && typeof window[canvasId].destroy === 'function') {
            window[canvasId].destroy();
        }

        window[canvasId] = new Chart(document.getElementById(canvasId), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'No. of Application',
                    data: values
                }]
            },
            options: {
                scales: {
                    y: { beginAtZero: true }
                },
                plugins: {
                    legend: { display: false }
                },
                aspectRatio: 1.6
            }
        });
    }

    new Chart(document.getElementById('PreEstablishmentApplicationByTypeBarChart'), {
        type: 'bar',
        data: {
            labels: ['Residential', 'Educational', 'Institutional', 'Business', 'Mercantile', 'Industrial', 'Hazardous', 'Storage', 'Arm Lines', 'Petrol Pump', 'Cinema Hall', 'Fire Cracker', 'Other'],
            datasets: [{
                label: 'No. of Application',
                data: [8, 18, 22, 12, 80, 65, 55, 45, 22, 10, 12, 34, 10]
            }]
        },
        options: {
            indexAxis: 'x',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            aspectRatio: 1.6
        }
    });

    new Chart(document.getElementById('PreOperationalApplicationByTypeBarChart'), {
        type: 'bar',
        data: {
            labels: ['Residential', 'Educational', 'Institutional', 'Business', 'Mercantile', 'Industrial', 'Hazardous', 'Storage', 'Arm Lines', 'Petrol Pump', 'Cinema Hall', 'Fire Cracker', 'Other'],
            datasets: [{
                label: 'No. of Application',
                data: [8, 18, 22, 12, 80, 65, 55, 45, 22, 10, 12, 34, 10]
            }]
        },
        options: {
            indexAxis: 'x',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            aspectRatio: 1.6
        }
    });

    new Chart(document.getElementById('RenewalApplicationByTypeBarChart'), {
        type: 'bar',
        data: {
            labels: ['Residential', 'Educational', 'Institutional', 'Business', 'Mercantile', 'Industrial', 'Hazardous', 'Storage', 'Arm Lines', 'Petrol Pump', 'Cinema Hall', 'Fire Cracker', 'Other'],
            datasets: [{
                label: 'No. of Application',
                data: [8, 18, 22, 12, 80, 65, 55, 45, 22, 10, 12, 34, 10]
            }]
        },
        options: {
            indexAxis: 'x',
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            },
            aspectRatio: 1.6
        }
    });


    // Get the canvas element
    // const ctx = document.getElementById('VehicleChart').getContext('2d');

    // // Data for the bar chart
    // const data = {
    //     labels: ['Almora', 'Bageshwer', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udhamsingh Nagar', 'Uttarkashi'],
    //     datasets: [{
    //             label: 'Working',
    //             data: [50, 60, 100, 270, 108, 167, 188, 98, 67, 46, 92, 28, 56],
    //             backgroundColor: 'rgba(6, 154, 235, 0.7)',
    //             borderColor: 'rgba(6, 154, 235, 1)',
    //             borderWidth: 1,
    //         },
    //         {
    //             label: 'Not-Working',
    //             data: [20, 10, 19, 90, 40, 10, 46, 21, 17, 10, 13, 5, 11],
    //             backgroundColor: 'rgba(255, 159, 67, 0.7)',
    //             borderColor: 'rgba(255, 159, 67, 1)',
    //             borderWidth: 1,
    //         }
    //     ]
    // };

    // // Chart configuration
    // const config = {
    //     type: 'bar', // Bar chart type
    //     data: data,
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: {
    //                 position: 'top',
    //             },
    //             title: {
    //                 display: true,
    //                 text: 'No. of Vehicle'
    //             }
    //         },
    //         scales: {
    //             x: {
    //                 stacked: false // Set to true if you want stacked bars
    //             },
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // };

    // // Render the chart
    // new Chart(ctx, config);
    
    // Get the canvas element
    // const ctx1 = document.getElementById('FireHydrentChart').getContext('2d');

    // // Data for the bar chart
    // const data1 = {
    //     labels: ['Almora', 'Bageshwer', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udhamsingh Nagar', 'Uttarkashi'],
    //     datasets: [{
    //             label: 'Working',
    //             data: [50, 60, 100, 270, 108, 167, 188, 98, 67, 46, 92, 28, 56],
    //             backgroundColor: 'rgba(6, 154, 235, 0.7)',
    //             borderColor: 'rgba(6, 154, 235, 1)',
    //             borderWidth: 1,
    //         },
    //         {
    //             label: 'Not-Working',
    //             data: [20, 10, 19, 90, 40, 10, 46, 21, 17, 10, 13, 5, 11],
    //             backgroundColor: 'rgba(255, 159, 67, 0.7)',
    //             borderColor: 'rgba(255, 159, 67, 1)',
    //             borderWidth: 1,
    //         },
    //         {
    //             label: 'Approved',
    //             data: [60, 30, 36, 50, 77, 11, 25, 45, 37, 8, 20, 15, 31],
    //             backgroundColor: 'rgba(152, 160, 168, 0.7)',
    //             borderColor: 'rgba(152, 160, 168, 1)',
    //             borderWidth: 1,
    //         }
    //     ]
    // };

    // // Chart configuration
    // const config1 = {
    //     type: 'bar', // Bar chart type
    //     data: data1,
    //     options: {
    //         responsive: true,
    //         plugins: {
    //             legend: {
    //                 position: 'top',
    //             },
    //             title: {
    //                 display: true,
    //                 text: 'No. of Vehicle'
    //             }
    //         },
    //         scales: {
    //             x: {
    //                 stacked: false // Set to true if you want stacked bars
    //             },
    //             y: {
    //                 beginAtZero: true
    //             }
    //         }
    //     }
    // };

    // // Render the chart
    // new Chart(ctx1, config1);


    // Get the canvas element
    const ctx2 = document.getElementById('EmployeeSanctionedAvailableChart').getContext('2d');

    // Data for the bar chart
    const data2 = {
        labels: ['DDT', 'CFO', 'FSO', 'FSSO', 'LFM', 'DVR', 'FM', '4th Class'],
        datasets: [{
                label: 'Working',
                data: [50, 60, 100, 270, 108, 167, 188, 98],
                backgroundColor: 'rgba(6, 154, 235, 0.7)',
                borderColor: 'rgba(6, 154, 235, 1)',
                borderWidth: 1,
            },
            {
                label: 'Not-Working',
                data: [20, 10, 19, 90, 40, 10, 46, 21],
                backgroundColor: 'rgba(255, 159, 67, 0.7)',
                borderColor: 'rgba(255, 159, 67, 1)',
                borderWidth: 1,
            }
        ]
    };

    // Chart configuration
    const config2 = {
        type: 'bar', // Bar chart type
        data: data2,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                x: {
                    stacked: false // Set to true if you want stacked bars
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Render the chart
    new Chart(ctx2, config2);

    

    const labels = ['DDT', 'CFO', 'FSO', 'FSSO', 'LFM', 'DVR', 'FM', '4th Class'];

    // BAR DATA
    const productA = [30, 40, 50, 60, 50, 45, 30, 40, 20];
    const productB = [20, 30, 40, 20, 35, 30, 40, 50, 60];

    // LINE DATA (same values as bar stack)
    const lineA = [...productA];
    const lineB = [...productB];

    const ctx3 = document.getElementById('comboChart').getContext('2d');

    new Chart(ctx3, {
        data: {
            labels: labels,
            datasets: [
                /* STACKED BARS */
                {
                    type: 'bar',
                    label: 'Male',
                    data: productA,
                    backgroundColor: 'rgba(54, 162, 235, 0.85)',
                    stack: 'stack1'
                },
                {
                    type: 'bar',
                    label: 'Female',
                    data: productB,
                    backgroundColor: 'rgba(255, 159, 64, 0.85)',
                    stack: 'stack1'
                },

                /* LINES FOR EACH STACK */
                {
                    type: 'line',
                    label: 'Male',
                    data: lineA,
                    borderColor: 'blue',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: 'blue'
                },
                {
                    type: 'line',
                    label: 'Female',
                    data: lineB,
                    borderColor: 'orange',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: 'orange'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                }
            }
        }
    });

    

    // const labelsFireReport = ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'];

    // // BAR DATA
    // const productAFireReport = [30, 40, 50, 60, 50, 45, 30, 40, 20, 30, 40, 50, 60];

    // // LINE DATA (same values as bar stack)
    // const lineAFireReport = [...productAFireReport];

    // const ctx4 = document.getElementById('FireReportNoOfIncidentChart').getContext('2d');

    // new Chart(ctx4, {
    //     data: {
    //         labels: labelsFireReport,
    //         datasets: [
    //             /* STACKED BARS */
    //             {
    //                 type: 'bar',
    //                 label: '',
    //                 data: productAFireReport,
    //                 backgroundColor: 'rgba(54, 162, 235, 0.85)',
    //                 stack: 'stack1'
    //             },

    //             /* LINES FOR EACH STACK */
    //             {
    //                 type: 'line',
    //                 label: '',
    //                 data: lineAFireReport,
    //                 borderColor: 'blue',
    //                 borderWidth: 2,
    //                 tension: 0.3,
    //                 fill: false,
    //                 pointRadius: 4,
    //                 pointBackgroundColor: 'blue'
    //             }
    //         ]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         scales: {
    //             x: {
    //                 stacked: true
    //             },
    //             y: {
    //                 stacked: true,
    //                 beginAtZero: true
    //             }
    //         },
    //         plugins: {
    //             legend: {
    //                 position: 'top'
    //             }
    //         }
    //     }
    // });

    

    // const labelsRescueReport = ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'];

    // // BAR DATA
    // const productARescueReport = [30, 40, 50, 60, 50, 45, 30, 40, 20, 30, 40, 50, 60];

    // // LINE DATA (same values as bar stack)
    // const lineARescueReport = [...productARescueReport];

    // const ctx5 = document.getElementById('RescueReportNoOfIncidentChart').getContext('2d');

    // new Chart(ctx5, {
    //     data: {
    //         labels: labelsRescueReport,
    //         datasets: [
    //             /* STACKED BARS */
    //             {
    //                 type: 'bar',
    //                 label: '',
    //                 data: productARescueReport,
    //                 backgroundColor: 'rgba(54, 162, 235, 0.85)',
    //                 stack: 'stack1'
    //             },

    //             /* LINES FOR EACH STACK */
    //             {
    //                 type: 'line',
    //                 label: '',
    //                 data: lineARescueReport,
    //                 borderColor: 'blue',
    //                 borderWidth: 2,
    //                 tension: 0.3,
    //                 fill: false,
    //                 pointRadius: 4,
    //                 pointBackgroundColor: 'blue'
    //             }
    //         ]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         scales: {
    //             x: {
    //                 stacked: true
    //             },
    //             y: {
    //                 stacked: true,
    //                 beginAtZero: true
    //             }
    //         },
    //         plugins: {
    //             legend: {
    //                 position: 'top'
    //             }
    //         }
    //     }
    // });

    
    
    // const labelsReliefReport = ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'];

    // // BAR DATA
    // const productAReliefReport = [30, 40, 50, 60, 50, 45, 30, 40, 20, 30, 40, 50, 60];

    // // LINE DATA (same values as bar stack)
    // const lineAReliefReport = [...productAReliefReport];

    // const ctx6 = document.getElementById('ReliefReportNoOfIncidentChart').getContext('2d');

    // new Chart(ctx6, {
    //     data: {
    //         labels: labelsReliefReport,
    //         datasets: [
    //             /* STACKED BARS */
    //             {
    //                 type: 'bar',
    //                 label: '',
    //                 data: productAReliefReport,
    //                 backgroundColor: 'rgba(54, 162, 235, 0.85)',
    //                 stack: 'stack1'
    //             },

    //             /* LINES FOR EACH STACK */
    //             {
    //                 type: 'line',
    //                 label: '',
    //                 data: lineAReliefReport,
    //                 borderColor: 'blue',
    //                 borderWidth: 2,
    //                 tension: 0.3,
    //                 fill: false,
    //                 pointRadius: 4,
    //                 pointBackgroundColor: 'blue'
    //             }
    //         ]
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         scales: {
    //             x: {
    //                 stacked: true
    //             },
    //             y: {
    //                 stacked: true,
    //                 beginAtZero: true
    //             }
    //         },
    //         plugins: {
    //             legend: {
    //                 position: 'top'
    //             }
    //         }
    //     }
    // });

</script>

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
    let dashboardData = null;
    // $(document).on('click', '#dashboardfilterBtn', function () {

    //     let start_date  = $('#start_date').val();
    //     let end_date    = $('#end_date').val();
    //     let district_id = $('#dashboard_dis').val();
    //     let station_id  = $('#dashboard_fire').val();

    //     $.ajax({
    //         url: "{{ route('admin.getNocDashboardData') }}",
    //         type: "POST",
    //         data: {
    //             _token: "{{ csrf_token() }}",
    //             start_date,
    //             end_date,
    //             district_id,
    //             station_id
    //         },
    //         success: function(res) {

    //             dashboardData = res;

    //             $('#all_total_received').text(res.all.total_received);
    //             $('#all_total_approved').text(res.all.approved);
    //             $('#all_total_reverted').text(res.all.reverted);
    //             $('#all_total_in_process').text(res.all.in_process);
    //             $('#all_total_pending').text(res.all.pending);

    //             $('#pre_total_received').text(res.pre_est.total_received);
    //             $('#pre_total_approved').text(res.pre_est.approved);
    //             $('#pre_total_reverted').text(res.pre_est.reverted);
    //             $('#pre_total_in_process').text(res.pre_est.in_process);
    //             $('#pre_total_pending').text(res.pre_est.pending);

    //             // 🔥 Pre-Operational
    //             $('#op_total_received').text(res.pre_op.total_received);
    //             $('#op_total_approved').text(res.pre_op.approved);
    //             $('#op_total_reverted').text(res.pre_op.reverted);
    //             $('#op_total_in_process').text(res.pre_op.in_process);
    //             $('#op_total_pending').text(res.pre_op.pending);

    //             // 🔥 Renewal
    //             $('#ren_total_received').text(res.renewal.total_received);
    //             $('#ren_total_approved').text(res.renewal.approved);
    //             $('#ren_total_reverted').text(res.renewal.reverted);
    //             $('#ren_total_in_process').text(res.renewal.in_process);
    //             $('#ren_total_pending').text(res.renewal.pending);

    //             renderTable(res.tables.all.approved, '#all_approved_table');
    //             renderTable(res.tables.all.reverted, '#all_reverted_table');

    //             renderTable(res.tables.pre_est.approved, '#pre_est_approved_table');
    //             renderTable(res.tables.pre_est.reverted, '#pre_est_reverted_table');

    //             renderTable(res.tables.pre_op.approved, '#pre_op_approved_table');
    //             renderTable(res.tables.pre_op.reverted, '#pre_op_reverted_table');

    //             renderTable(res.tables.renewal.approved, '#renewal_approved_table');
    //             renderTable(res.tables.renewal.reverted, '#renewal_reverted_table');

    //             updatePieChart(res.all, 'AllNOCApplicationByStatusPieChart');
    //             updateBarChart(res.district_chart.all, 'AllNOCApplicationByStatusBarChart');

    //             updateTypeBarChart(res.type_chart.all, 'AllNOCApplicationByTypeBarChart');
    //             updateRejectPieChart(res.reject_chart.all, 'AllNOCRejectPie');

    //             renderStatusTable(res.status_table.all, '#all_status_table');
    //         },
    //         complete: function() {
    //             let start = formatDate(start_date);
    //             let end   = formatDate(end_date);

    //             // ALL
    //             $('#all_approved_title').text(`All (Approved) — ${start} to ${end}`);
    //             $('#all_reverted_title').text(`All (Reverted) — ${start} to ${end}`);


    //             // Pre-Establishment
    //             $('#pre_est_approved_title').text(`Pre-Establishment (Approved) — ${start} to ${end}`);
    //             $('#pre_est_reverted_title').text(`Pre-Establishment (Reverted) — ${start} to ${end}`);

    //             // Pre-Operational
    //             $('#pre_op_approved_title').text(`Pre-Operational (Approved) — ${start} to ${end}`);
    //             $('#pre_op_reverted_title').text(`Pre-Operational (Reverted) — ${start} to ${end}`);

    //             // Renewal
    //             $('#renewal_approved_title').text(`Renewal (Approved) — ${start} to ${end}`);
    //             $('#renewal_reverted_title').text(`Renewal (Reverted) — ${start} to ${end}`);

    //         }

    //     });

    // });

    function loadNOCDashboardData() {

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

                dashboardData = res;

                $('#all_total_received').text(res.all.total_received);
                $('#all_total_approved').text(res.all.approved);
                $('#all_total_reverted').text(res.all.reverted);
                $('#all_total_in_process').text(res.all.in_process);
                $('#all_total_pending').text(res.all.pending);

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

                renderTable(res.tables.all.approved, '#all_approved_table');
                renderTable(res.tables.all.reverted, '#all_reverted_table');

                renderTable(res.tables.pre_est.approved, '#pre_est_approved_table');
                renderTable(res.tables.pre_est.reverted, '#pre_est_reverted_table');

                renderTable(res.tables.pre_op.approved, '#pre_op_approved_table');
                renderTable(res.tables.pre_op.reverted, '#pre_op_reverted_table');

                renderTable(res.tables.renewal.approved, '#renewal_approved_table');
                renderTable(res.tables.renewal.reverted, '#renewal_reverted_table');

                updatePieChart(res.all, 'AllNOCApplicationByStatusPieChart');
                updateBarChart(res.district_chart.all, 'AllNOCApplicationByStatusBarChart');

                updateTypeBarChart(res.type_chart.all, 'AllNOCApplicationByTypeBarChart');
                updateRejectPieChart(res.reject_chart.all, 'AllNOCRejectPie');

                renderStatusTable(res.status_table.all, '#all_status_table');
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

    }
    
    $(document).on('click', '.tabs2 label', function () {

        if (!dashboardData) return;

        let selected = $(this).attr('for');

        if (selected === 'AllNOC') {
            updatePieChart(dashboardData.all, 'AllNOCApplicationByStatusPieChart');
            updateBarChart(dashboardData.district_chart.all, 'AllNOCApplicationByStatusBarChart');
            updateTypeBarChart(dashboardData.type_chart.all, 'AllNOCApplicationByTypeBarChart');
            updateRejectPieChart(dashboardData.reject_chart.all, 'AllNOCRejectPie');
            renderStatusTable(dashboardData.status_table.all, '#all_status_table');
        } 
        else if (selected === 'PreEstablishment') {
            updatePieChart(dashboardData.pre_est, 'PreEstablishmentApplicationByStatusPieChart');
            updateBarChart(dashboardData.district_chart.pre_est, 'PreEstablishmentApplicationByStatusBarChart');
            updateTypeBarChart(dashboardData.type_chart.pre_est, 'PreEstablishmentApplicationByTypeBarChart');
            updateRejectPieChart(dashboardData.reject_chart.pre_est, 'PreEstablishmentRejectPie');
            renderStatusTable(dashboardData.status_table.pre_est, '#pre_est_status_table');
        } 
        else if (selected === 'PreOperational') {
            updatePieChart(dashboardData.pre_op, 'PreOperationalApplicationByStatusPieChart');
            updateBarChart(dashboardData.district_chart.pre_op, 'PreOperationalApplicationByStatusBarChart');
            updateTypeBarChart(dashboardData.type_chart.pre_op, 'PreOperationalApplicationByTypeBarChart');
            updateRejectPieChart(dashboardData.reject_chart.pre_op, 'PreOperationalRejectPie');
            renderStatusTable(dashboardData.status_table.pre_op, '#pre_op_status_table');
        } 
        else if (selected === 'Renewal') {
            updatePieChart(dashboardData.renewal, 'RenewalApplicationByStatusPieChart');
            updateBarChart(dashboardData.district_chart.renewal, 'RenewalApplicationByStatusBarChart');
            updateTypeBarChart(dashboardData.type_chart.renewal, 'RenewalApplicationByTypeBarChart');
            updateRejectPieChart(dashboardData.reject_chart.renewal, 'RenewalRejectPie');
            renderStatusTable(dashboardData.status_table.renewal, '#renewal_status_table');
        }

    });

    $(document).ready(function() {
        $('#dashboardfilterBtn').click();
        // loadNOCDashboardData();
        toggleFilters();
    });

    $(document).on('click', '#dashboardfilterBtn', function () {
        
        let selectedTab = $('input[name="tab"]:checked').attr('id');

        if (selectedTab === 'noc') {
            loadNOCDashboardData();
        }
        else if (selectedTab === 'vehicle') {
            loadVehicleDashboardData();
        }
        else if (selectedTab === 'fireReport') {
            loadFireReportData();
        } else if (selectedTab === 'rescue') {
            loadRescueDashboardData();
        } 
        else if (selectedTab === 'relief') {
            loadReliefDashboardData();
        } 
        else if (selectedTab === 'hydrent') {
            loadHydrantDashboardData();
        }
    
    });

    $(document).on('click', 'label[for="noc"]', function () {
        loadNOCDashboardData();
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
                        <td>${row.days_15_plus}</td>
                        <td>${row.avg_days}</td>
                        <td>${row.total}</td>
                    </tr>
                `;
            });
        }

        $(tableId).html(html);
    }

    function renderStatusTable(data, tableId) {

        let html = '';

        let totals = {
            not_assigned: 0,
            assigned_not_verified: 0,
            verified: 0,
            approved: 0,
            rejected: 0,
            pending: 0,
            total: 0
        };

        if (!data || data.length === 0) {
            html = `<tr><td colspan="8" style="text-align:center">No Data</td></tr>`;
        } else {

            data.forEach((row, index) => {

                // ✅ accumulate totals
                totals.not_assigned += Number(row.not_assigned || 0);
                totals.assigned_not_verified += Number(row.assigned_not_verified || 0);
                totals.verified += Number(row.verified || 0);
                totals.approved += Number(row.approved || 0);
                totals.rejected += Number(row.rejected || 0);
                totals.pending += Number(row.pending || 0);
                totals.total += Number(row.total || 0);

                html += `
                    <tr>
                        <td>${row.district}</td>
                        <td>${row.not_assigned}</td>
                        <td>${row.assigned_not_verified}</td>
                        <td>${row.verified}</td>
                        <td>${row.approved}</td>
                        <td>${row.rejected}</td>
                        <td>${row.pending}</td>
                        <td>${row.total}</td>
                    </tr>
                `;
            });

            // ✅ add TOTAL row
            html += `
                <tr style="font-weight:bold; background:#f2f2f2;">
                    <td>Total</td>
                    <td>${totals.not_assigned}</td>
                    <td>${totals.assigned_not_verified}</td>
                    <td>${totals.verified}</td>
                    <td>${totals.approved}</td>
                    <td>${totals.rejected}</td>
                    <td>${totals.pending}</td>
                    <td>${totals.total}</td>
                </tr>
            `;
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

    $(document).on('click', 'label[for="vehicle"]', function () {
        loadVehicleDashboardData();
    });

    function loadVehicleDashboardData(){
        $.ajax({
            url: "{{ route('dashboard.vehicle.data') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                district_id: $('#dashboard_dis').val(),
                station_id: $('#dashboard_fire').val()
            },
            success: function(res) {

                updateVehiclePie(res.pie);
                updateVehicleBar(res.bar);
                updateVehicleKPI(res.kpi);
                renderVehicleTable(res.table);

            }
        });
    }

    let vehiclePieChart;

    function updateVehiclePie(data) {

        let ctx = document.getElementById('VehiclePieChart');

        if (vehiclePieChart) vehiclePieChart.destroy();

        // ✅ FILTER ZERO VALUES
        let filteredLabels = [];
        let filteredData = [];

        data.data.forEach((value, index) => {
            if (parseInt(value) > 0) {
                filteredLabels.push(data.labels[index]);
                filteredData.push(value);
            }
        });

        // ❗ Optional: handle no data case
        if (filteredData.length === 0) {
            console.warn("No data available for pie chart");
        }

        vehiclePieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: filteredLabels, // ✅ filtered
                datasets: [{
                    data: filteredData, // ✅ filtered
                    backgroundColor: [
                        '#36A2EB', '#FF6384', '#FFCE56',
                        '#4BC0C0', '#9966FF', '#FF9F40'
                    ]
                }]
            }
        });
    }

    let vehicleBarChart;

    function updateVehicleBar(data) {

        let ctx = document.getElementById('VehicleChart');

        if (vehicleBarChart) vehicleBarChart.destroy();

        vehicleBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(d => d.district_name),
                datasets: [
                    {
                        label: 'Working',
                        data: data.map(d => d.working)
                    },
                    {
                        label: 'Maintenance',
                        data: data.map(d => d.maintenance)
                    },
                    {
                        label: 'Out of Road',
                        data: data.map(d => d.out_of_road)
                    }
                ]
            }
        });
    }

    const vehicleTypeMap = {
        "मल्टीपरपज फायर टेंडर": "Multipurpose_Fire_Tender",
        "हाइड्रोलिक प्लेटफार्म": "Hydraulic_Platform",
        "वाटर ब्राउजर": "Water_Browser",
        "डीसीपी टेंडर": "DCP_Tender",
        "फोम टेंडर": "Foam_Tender",
        "वाटर टेण्डर": "Water_Tender",
        "क्रैश फायर टेंडर": "Crash_Fire_Tender",
        "मिनी हाईप्रेशर": "Mini_High_Pressure",
        "वाटर मिस्ट": "Water_Mist",
        "एंबुलेंस": "Ambulance",
        "रेस्क्यू टेंडर": "Rescue_Tender",
        "पीपीसीवी": "PPCV",
        "बुलेरो": "Bulero",
        "टूल्स पंप": "Tools_Pump",
        "बैकपैक सेट": "Backpack_Set"
    };
    function updateVehicleKPI(data) {

        // reset all to 0 first
        $('.kpi-card .value').text(0);

        for (let key in data) {

            let mapped = vehicleTypeMap[key];

            if (!mapped) continue;

            let id = 'kpi_' + mapped;

            $('#' + id).text(data[key]);
        }
    }

    const vehicleMap = {
        "फोम टेंडर": "Foam Tender",
        "वाटर टेण्डर": "Water Tender",
        "क्रैश फायर टेंडर": "Crash Fire Tender",
        "मिनी हाईप्रेशर": "Mini High Fire",
        "वाटर मिस्ट": "Water Mist",
        "रेस्क्यू टेंडर": "Rescue Tender",
        "पीसीबीसी": "PCBC",
        "बुलेरो": "Bulero",
        "टूल्स पंप": "Tools Pump",
        "मल्टीपरपज फायर टेंडर": "Multipurpose Fire Tender",
        "हाइड्रोलिक प्लेटफार्म": "Hydrolic Platform",
        "डीआरएफटी टेंडर": "DRFT Tender",
        "बैकपैक सेट": "Backfire Set",
        "एंबुलेंस": "Ambulance"
    };

    const columns = [
        "Foam Tender",
        "Water Tender",
        "Crash Fire Tender",
        "Mini High Fire",
        "Water Mist",
        "Rescue Tender",
        "PCBC",
        "Bulero",
        "Tools Pump",
        "Multipurpose Fire Tender",
        "Hydrolic Platform",
        "DRFT Tender",
        "Backfire Set",
        "Ambulance"
    ];

    function renderVehicleTable(data) {

        if (!data || !Array.isArray(data)) return;

        let grouped = {};

        data.forEach(row => {

            let districtId = row.district_id;
            let districtName = row.district_name; // ✅ NEW
            let typeHindi = row.vehicle_type;
            let typeEnglish = vehicleMap[typeHindi];

            if (!typeEnglish) {
                console.warn('No mapping for:', typeHindi);
                return;
            }

            if (!grouped[districtId]) {
                grouped[districtId] = {
                    name: districtName, // ✅ store name
                    data: {}
                };
            }

            grouped[districtId].data[typeEnglish] = row.total;
        });

        let html = '';
        let sr = 1;

        for (let district in grouped) {

            html += `<tr>`;
            html += `<td>${sr++}</td>`;

            html += `<td>${grouped[district].name}</td>`;

            columns.forEach(col => {
                html += `<td>${grouped[district].data[col] || 0}</td>`;
            });

            html += `</tr>`;
        }

        $('#vehicle_table_body').html(html);
    }

    let fireChart = null;

    $(document).on('click', 'label[for="fireReport"]', function () {
        loadFireReportData();
    });

    function loadFireReportData(){
        fetch("{{ route('dashboard.fireReportData') }}")
            .then(res => res.json())
            .then(response => {
                updateFireChart(response.labels, response.data);
                updateFireCategoryPie(response.categoryLabels, response.categoryData);
                updateFireTypePie(response.typeLabels, response.typeData);
                updateFireTable(response.raw);
            })
            .catch(err => console.error(err));
    }

    let fireTypePieChart = null;

    function updateFireTypePie(labels, data) {

        const ctx = document.getElementById('FireReportNoOfFireCallPieChart');

        if (fireTypePieChart) {
            fireTypePieChart.destroy();
        }

        fireTypePieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#f67fa7',
                        '#5f7670',
                        '#98a0a8',
                        '#f5b041',
                        '#2f80ed',
                        '#ff7f50',
                        '#00a0a8',
                        '#f5ff41',
                        '#f5b0ff'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                aspectRatio: 1.4
            }
        });
    }

    function updateFireChart(labels, data) {

        const ctx = document.getElementById('FireReportNoOfIncidentChart').getContext('2d');

        // destroy old chart
        if (fireChart) {
            fireChart.destroy();
        }

        fireChart = new Chart(ctx, {
            data: {
                labels: labels,
                datasets: [
                    {
                        type: 'bar',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.85)',
                    },
                    {
                        type: 'line',
                        data: data,
                        borderColor: 'blue',
                        tension: 0.3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    }

    let fireCategoryPieChart = null;

    function updateFireCategoryPie(labels, data) {

        const ctx = document.getElementById('FireReportCategoryIncidentPieChart');

        // destroy old chart
        if (fireCategoryPieChart) {
            fireCategoryPieChart.destroy();
        }

        fireCategoryPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#2f80ed',
                        '#ff7f50',
                        '#98a0a8',
                        '#f5b041',
                        '#00a0a8',
                        '#f67fa7',
                        '#5f7670'
                    ]
                }]
            },
            options: {
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                },
                aspectRatio: 1.4
            }
        });
    }

    function updateFireTable(data) {

        let tbody = document.querySelector('.fireReport table tbody');
        tbody.innerHTML = '';

        let i = 1;

        data.forEach(item => {

            let row = `
                <tr>
                    <td>${i++}</td>
                    <td>${item.districts_name}</td>
                    <td>${new Date(item.created_at).getMonth() + 1}</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                    <td>1</td>
                </tr>
            `;

            tbody.innerHTML += row;
        });
    }

    function toggleFilters() {
        let selectedTab = $('input[name="tab"]:checked').attr('id');

        let tabsWithDate = ['noc', 'rescue', 'fireReport', 'relief','hydrent'];

        if (tabsWithDate.includes(selectedTab)) {
            $('#dateFilters').show();
        } else {
            $('#dateFilters').hide();
        }
    }

    // Run on tab change
    $(document).on('change', 'input[name="tab"]', function () {
        toggleFilters();
    });

    $(document).on('click', 'label[for="rescue"]', function () {
        loadRescueDashboardData();
    });

    function loadRescueDashboardData() {
        $.ajax({
            url: "{{ route('admin.getRescueDashboardData') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                district_id: $('#dashboard_dis').val(),
                station_id: $('#dashboard_fire').val()
            },
            success: function(res) {
                updateRescueKPI(res.kpi);
                updateRescueBar(res.bar);
                updateRescuePie(res.pie);
                renderRescueTable(res.table);
            }
        });
    }

    // $(document).on('click', '#dashboardfilterBtn', function () {
    //     let activeTab = $('input[name="tab"]:checked').attr('id');

    //     if (activeTab === 'rescue') {
    //         loadRescueDashboardData();
    //     }
    // });

    let rescueBarChart;

    function updateRescueBar(data) {
        let ctx = document.getElementById('RescueReportNoOfIncidentChart').getContext('2d');

        if (rescueBarChart) {
            rescueBarChart.destroy();
        }

        let labels = data.map(item => item.district_name);
        let values = data.map(item => parseInt(item.total));

        rescueBarChart = new Chart(ctx, {
            data: {
                labels: labels,
                datasets: [
                    {
                        type: 'bar',
                        label: 'No. of Incident',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.85)',
                        stack: 'stack1'
                    },
                    {
                        type: 'line',
                        label: 'No. of Incident Trend',
                        data: values,
                        borderColor: 'blue',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: false,
                        pointRadius: 4,
                        pointBackgroundColor: 'blue'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        stacked: true
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    }

    let rescuePieChart;

    function updateRescuePie(data) {
        let ctx = document.getElementById('RescueReportCategoryIncidentPieChart').getContext('2d');

        if (rescuePieChart) {
            rescuePieChart.destroy();
        }

        let filteredLabels = [];
        let filteredData = [];

        data.data.forEach((value, index) => {
            if (parseInt(value) > 0) {
                filteredLabels.push(data.labels[index]);
                filteredData.push(parseInt(value));
            }
        });

        rescuePieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: filteredLabels,
                datasets: [{
                    data: filteredData
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    }

    function updateRescueKPI(data) {
        $('#rescue_total_call').text(data.total_call || 0);
        $('#rescue_report_completed').text(data.report_completed || 0);
        $('#rescue_report_incompleted').text(data.report_incompleted || 0);
        $('#rescue_pending_approval').text(data.pending_approval || 0);
        $('#rescue_under_investigation').text(data.under_investigation || 0);
        $('#rescue_report_issued').text(data.report_issued || 0);
    }

    function renderRescueTable(data) {
        if (!data || !Array.isArray(data)) return;

        let grouped = {};

        data.forEach(row => {
            let districtId = row.district_id;
            let districtName = row.district_name;
            let monthNo = parseInt(row.month_no);
            let total = parseInt(row.total);

            if (!grouped[districtId]) {
                grouped[districtId] = {
                    district_name: districtName,
                    months: {
                        1: 0, 2: 0, 3: 0, 4: 0, 5: 0, 6: 0,
                        7: 0, 8: 0, 9: 0, 10: 0, 11: 0, 12: 0
                    }
                };
            }

            grouped[districtId].months[monthNo] = total;
        });

        let html = '';
        let sr = 1;

        for (let districtId in grouped) {
            let row = grouped[districtId];
            let total = 0;

            html += `<tr>`;
            html += `<td>${sr++}</td>`;
            html += `<td>${row.district_name}</td>`;

            for (let m = 1; m <= 12; m++) {
                let val = row.months[m] || 0;
                total += val;
                html += `<td>${val}</td>`;
            }

            html += `<td>${total}</td>`;
            html += `</tr>`;
        }

        $('#rescue_table_body').html(html);
    }

    $(document).on('click', 'label[for="relief"]', function () {
        loadReliefDashboardData();
    });

    function loadReliefDashboardData() {
        $.ajax({
            url: "{{ route('admin.getReliefDashboardData') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                district_id: $('#dashboard_dis').val(),
                station_id: $('#dashboard_fire').val()
            },
            success: function(res) {
                updateReliefBar(res.bar);
                updateReliefPie(res.pie);
                renderReliefTable(res.table);
                updateReliefKPI(res.kpi);
            }
        });
    }

    let reliefBarChart;
    
    function updateReliefBar(data) {

        let ctx = document.getElementById('ReliefReportNoOfIncidentChart');

        if (reliefBarChart) reliefBarChart.destroy();

        let labels = data.map(d => d.district_name);
        let values = data.map(d => parseInt(d.total));

        reliefBarChart = new Chart(ctx, {
            data: {
                labels: labels,
                datasets: [
                    {
                        type: 'bar',
                        label: 'Incidents',
                        data: values,
                        backgroundColor: 'rgba(54, 162, 235, 0.85)'
                    },
                    {
                        type: 'line',
                        label: 'Trend',
                        data: values,
                        borderColor: 'blue',
                        tension: 0.3
                    }
                ]
            }
        });
    }

    let reliefPieChart;

    function updateReliefPie(data) {

        let ctx = document.getElementById('ReliefReportCategoryIncidentPieChart');

        if (reliefPieChart) reliefPieChart.destroy();

        let labels = [];
        let values = [];

        data.data.forEach((v, i) => {
            if (parseInt(v) > 0) {
                labels.push(data.labels[i]);
                values.push(v);
            }
        });

        reliefPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values
                }]
            }
        });
    }

    function renderReliefTable(data) {

        if (!data) return;

        let grouped = {};

        data.forEach(row => {

            let id = row.district_id;

            if (!grouped[id]) {
                grouped[id] = {
                    name: row.district_name,
                    months: {}
                };
            }

            grouped[id].months[row.month_no] = row.total;
        });

        let html = '';
        let sr = 1;

        for (let id in grouped) {

            let total = 0;

            html += `<tr>`;
            html += `<td>${sr++}</td>`;
            html += `<td>${grouped[id].name}</td>`;

            for (let m = 1; m <= 12; m++) {
                let val = grouped[id].months[m] || 0;
                total += val;
                html += `<td>${val}</td>`;
            }

            html += `<td>${total}</td>`;
            html += `</tr>`;
        }

        $('#relief_table_body').html(html);
    }

    function updateReliefKPI(data) {
        $('#relief_total_call').text(data.total_call || 0);
        $('#relief_report_completed').text(data.report_completed || 0);
        $('#relief_report_incompleted').text(data.report_incompleted || 0);
        $('#relief_report_pending').text(data.report_pending || 0);
        $('#relief_report_investigation').text(data.report_investigation || 0);
        $('#relief_report_issued').text(data.report_issued || 0);
    }

    $(document).on('click', 'label[for="hydrent"]', function () {
        loadHydrantDashboardData();
    });

    function loadHydrantDashboardData() {
        $.ajax({
            url: "{{ route('admin.getHydrantDashboardData') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                district_id: $('#dashboard_dis').val(),
                station_id: $('#dashboard_fire').val()
            },
            success: function(res) {
                updateHydrantBar(res.bar);
                updateHydrantPie(res.pie);
            }
        });
    }

    let hydrantBarChart;

    function updateHydrantBar(data) {

        let ctx = document.getElementById('FireHydrentChart');

        if (hydrantBarChart) hydrantBarChart.destroy();

        hydrantBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.map(d => d.district_name),

                datasets: [
                    {
                        label: 'Working',
                        data: data.map(d => d.working),
                        backgroundColor: 'rgba(6, 154, 235, 0.7)'
                    },
                    {
                        label: 'Not Working',
                        data: data.map(d => d.not_working),
                        backgroundColor: 'rgba(255, 159, 67, 0.7)'
                    },
                    {
                        label: 'Proposed',
                        data: data.map(d => d.proposed),
                        backgroundColor: 'rgba(152, 160, 168, 0.7)'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }
    
    let hydrantPieChart;

    function updateHydrantPie(data) {

        let ctx = document.getElementById('FireHydrentPieChart');

        if (hydrantPieChart) hydrantPieChart.destroy();

        // 🔥 filter zero
        let labels = [];
        let values = [];

        data.data.forEach((v, i) => {
            if (parseInt(v) > 0) {
                labels.push(data.labels[i]);
                values.push(v);
            }
        });

        hydrantPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: values,
                    backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8']
                }]
            }
        });
    }


</script>



    <!-- End Row -->
    @endsection
    @section('scripts')
   
    @stop
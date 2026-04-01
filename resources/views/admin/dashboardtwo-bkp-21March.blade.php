@extends('layouts.admin.template')
@section('title')
<title>Admin Dashboard</title>
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')

<style>
.thead-primary{
    background: #1d4ed8;
    color: #fff;
}
h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.dashboard {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
}

a {
    text-decoration: none;
}

.card1 {
    background: linear-gradient(to right, #b9c8f240, #1d4ed830);
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
	font-weight: 600;
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
	padding: 5px !important;
}
</style>

<style>
  /* Put radios hidden but as siblings of .tabs and .contents */
  .tab-container > input[type="radio"] { display:none; }

  /* Tabs wrapper */
  .tabs {
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    justify-content:center;
  }

  /* Basic label style */
  .tabs label {
    padding:12px 5px;
    border-radius:14px;
    background:#fff;
    font-weight:700;
    cursor:pointer;
    border:3px solid transparent;
    transition: all .25s ease;
    color:#0b4ea2;
    user-select:none;
    display:inline-block;
    white-space:nowrap;
    text-align: center;
    width: 118px;
  }

  /* colored borders (visual) */
  .tabs label[for="noc"] { border-color:#7D4; }
  .tabs label[for="fire"] { border-color:#f90; }
  .tabs label[for="status"] { border-color:#290; }
  .tabs label[for="vehicle"] { border-color:#d22; }
  .tabs label[for="equip"] { border-color:#0a5; }
  .tabs label[for="fireReport"] { border-color:#04c; }
  .tabs label[for="rescue"] { border-color:#0a5; }
  .tabs label[for="relief"] { border-color:#fc0; }
  .tabs label[for="hydrent"] { border-color:#d22; }
  .tabs label[for="employee"] { border-color:#a4a; }

  /* style the active label when its radio is checked */
  /* note: label is inside .tabs, so we first select the .tabs sibling */
  #noc:checked     ~ .tabs label[for="noc"],
  #fire:checked    ~ .tabs label[for="fire"],
  #status:checked    ~ .tabs label[for="status"],
  #vehicle:checked ~ .tabs label[for="vehicle"],
  #equip:checked   ~ .tabs label[for="equip"],
  #fireReport:checked ~ .tabs label[for="fireReport"],
  #rescue:checked  ~ .tabs label[for="rescue"],
  #relief:checked  ~ .tabs label[for="relief"],
  #hydrent:checked ~ .tabs label[for="hydrent"],
  #employee:checked ~ .tabs label[for="employee"] {
    background:#4CAF50;
    color:#fff !important;
    border-color:#4CAF50;
    box-shadow:0 4px 10px rgba(0,0,0,0.12);
    transform:translateY(-2px);
  }

  .tabs label:hover { transform:scale(1.1); }

  /* content styles */
  .contents {
    margin-top:22px;
    margin-bottom: 20px;
  }
  .content {
    display:none;
    background:#fff;
    padding:20px;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
    text-align:left;
  }

  /* show the relevant content when radio is checked */
  #noc:checked     ~ .contents .noc,
  #fire:checked    ~ .contents .fire,
  #status:checked    ~ .contents .status,
  #vehicle:checked ~ .contents .vehicle,
  #equip:checked   ~ .contents .equip,
  #fireReport:checked ~ .contents .fireReport,
  #rescue:checked  ~ .contents .rescue,
  #relief:checked  ~ .contents .relief,
  #hydrent:checked ~ .contents .hydrent,
  #employee:checked ~ .contents .employee {
    display:block;
    animation: fadeIn .28s ease;
  }

  @keyframes fadeIn {
    from { opacity:0; transform:translateY(8px); }
    to { opacity:1; transform:translateY(0); }
  }
  
  /*-----------Tab2 Start--------------*/
  /* Put radios hidden but as siblings of .tabs and .contents */
  .tab-container2 > input[type="radio"] { display:none; }

  /* Tabs wrapper */
  .tabs2 {
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    justify-content:center;
  }

  /* Basic label style */
  .tabs2 label {
    padding:12px 20px;
    border-radius:14px;
    background:#fff;
    font-weight:700;
    cursor:pointer;
    border:3px solid transparent;
    transition: all .25s ease;
    color:#0b4ea2;
    user-select:none;
    display:inline-block;
    white-space:nowrap;
  }

  .tabs2 label[for="AllNOC"] { border-color:#4CAF50; }
  .tabs2 label[for="PreEstablishment"] { border-color:#D22; }
  .tabs2 label[for="PreOperational"] { border-color:#fc0; }
  .tabs2 label[for="Renewal"] { border-color:#04c; }

  #AllNOC:checked     ~ .tabs2 label[for="AllNOC"]{
    background:#4CAF50;
    color:#fff !important;
    border-color:#4CAF50;
    box-shadow:0 4px 10px rgba(0,0,0,0.12);
    transform:translateY(-2px);
  }
  
  #PreEstablishment:checked     ~ .tabs2 label[for="PreEstablishment"]{
    background:#D22;
    color:#fff !important;
    border-color:#D22;
    box-shadow:0 4px 10px rgba(0,0,0,0.12);
    transform:translateY(-2px);
  }
  
  #PreOperational:checked    ~ .tabs2 label[for="PreOperational"]{
    background:#fc0;
    color:#fff !important;
    border-color:#fc0;
    box-shadow:0 4px 10px rgba(0,0,0,0.12);
    transform:translateY(-2px);
  }
  
  #Renewal:checked    ~ .tabs2 label[for="Renewal"] {
    background:#04c;
    color:#fff !important;
    border-color:#04c;
    box-shadow:0 4px 10px rgba(0,0,0,0.12);
    transform:translateY(-2px);
  }

  .tabs2 label:hover { transform:scale(1.1); }

  /* content styles */
  .contents2 {
    margin-top:22px;
  }
  .content2 {
    display:none;
    background:#fff;
    border-radius:12px;
    box-shadow:0 6px 18px rgba(0,0,0,0.06);
    text-align:left;
  }

  /* show the relevant content when radio is checked */
  #AllNOC:checked     ~ .contents2 .AllNOC,
  #PreEstablishment:checked     ~ .contents2 .PreEstablishment,
  #PreOperational:checked    ~ .contents2 .PreOperational,
  #Renewal:checked    ~ .contents2 .Renewal {
    display:block;
    animation: fadeIn .28s ease;
  }
  
</style>

<style>
    :root{
      --bg:#f6f7fb; --card:#f4f4f4; --muted:#8a8f9a; --accent:#2f80ed; --green:#2fbf7f; --orange:#ff9f43; --danger:#ff4d4f;
      --radius:10px; --pad:18px;
    }
    
    
    .container2{margin:0 auto}

    .stats{display:flex;gap:12px;flex-wrap:wrap}
    .stat{background:var(--card);flex:1;min-width:120px;padding:12px;border-radius:8px;box-shadow:0 1px 5px rgba(15,15,15,0.4);display:flex;align-items:center;justify-content:space-between}
    .stat .meta{font-size:12px;color:var(--muted)}
    .stat .value{font-weight:700;font-size:18px}

    .ribbons{display:flex;gap:12px;margin-top:16px}
    .ribbon{background:var(--card);flex:1;padding:12px;border-radius:8px;display:flex;align-items:center;justify-content:space-between}
    .ribbon .label{font-size:12px;color:var(--muted)}
    .ribbon .bubble{background:#f1f6ff;color:var(--accent);padding:6px 12px;border-radius:20px;font-weight:600}

    .charts{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-top:18px}
    .card{background:var(--card);padding:16px;border-radius:var(--radius);box-shadow:0 6px 18px rgba(16,24,40,0.2)}
    .card h3{text-align:center;margin-bottom:8px;font-size:16px}
    .chart-row{display:flex;gap:12px}

    /*#pieChart{max-width:300px;margin:0 auto;display:block;}*/
    /*#barChart{height:180px !important;}*/
    /*#barChart2{height:160px !important;width:100%;max-width:500px;margin:0 auto;display:block;}*/

    .bottom-row{display:flex;gap:16px;margin-top:18px;align-items:flex-start}
    .bottom-row .card{flex:1}

    .tables-row{display:flex;gap:16px;margin-top:18px;align-items:flex-start}
    .tables-row .card{flex:1;min-width:0}

    table{width:100%;border-collapse:collapse;font-size:13px}
    th,td{padding:8px;border:1px solid #eef1f6;text-align:left}
    /*th{background:#f8fafc}*/

    @media (max-width:900px){
      .charts{grid-template-columns:1fr}
      .bottom-row{flex-direction:column}
      .tables-row{flex-direction:column}
      .stats{flex-direction:column}
      .ribbons{flex-direction:column}
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

            <!-- 1) Radios must be direct children here (so ~ selector works) -->
            <input type="radio" name="tab" id="noc" checked>
            <!--<input type="radio" name="tab" id="fire">-->
            <!--<input type="radio" name="tab" id="status">-->
            <input type="radio" name="tab" id="vehicle">
            <input type="radio" name="tab" id="equip">
            <input type="radio" name="tab" id="fireReport">
            <input type="radio" name="tab" id="rescue">
            <input type="radio" name="tab" id="relief">
            <input type="radio" name="tab" id="hydrent">
            <input type="radio" name="tab" id="employee">
        
            <!-- 2) Labels (tabs) -->
            <div class="tabs">
              <label for="noc" style="padding-top: 24px;">NOC</label>
              <!--<label for="fire">Fire<br />Activity</label>-->
              <!--<label for="status">Application<br />Status</label>-->
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
                                        <?php foreach($districtList ?? [] as $disData): ?>
                                        <option value="<?= $disData->id ?>"><?= $disData->name ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Fire Station</label>
                                    <select class="form-control" id="dashboard_fire">
                                        <option value="">--- Select Fire Station ---</option>
                                        <?php foreach($fireStactionList ?? [] as $fs): ?>
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
                                                <div class="number" style="background-color: #28a745;" id="total_received">78</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">RECEIVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#59abf9;">
                                            <div class="card-header1">
                                                <div class="icon">🆗</div>
                                                <div class="number" style="background-color: #59abf9;" id="approved">8</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">APPROVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#7969b9;">
                                            <div class="card-header1">
                                                <div class="icon">🔙</div>
                                                <div class="number" style="background-color: #7969b9;" id="reverted">4</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">REVERTED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#dea364;">
                                            <div class="card-header1">
                                                <div class="icon">⏳</div>
                                                <div class="number" style="background-color: #dea364;" id="in_process">35</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">IN-PROCESS</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#d80303;">
                                            <div class="card-header1">
                                                <div class="icon">🕒</div>
                                                <div class="number" style="background-color: #d80303;" id="pending">19</div>
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
                                                <h3 style="text-align:left">Pre-Establishment (Approved) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                                                <h3 style="text-align:left">Pre-Establishment (Reverted) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                      <div class="content2 PreEstablishment">
                          <div class="card-body dash1" style="padding: 0px !important;">
                            <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Pre-Establishment - Dashboard</h1>
                            <div class="row">
                                <div class="col-md-12 form-group" style="margin-top: 20px">
                            		<div class="dashboard">
                                        <a href="#" class="card1" style="border-left-color:#28a745;">
                                            <div class="card-header1">
                                                <div class="icon">📥</div>
                                                <div class="number" style="background-color: #28a745;" id="total_received">78</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">RECEIVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#59abf9;">
                                            <div class="card-header1">
                                                <div class="icon">🆗</div>
                                                <div class="number" style="background-color: #59abf9;" id="approved">8</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">APPROVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#7969b9;">
                                            <div class="card-header1">
                                                <div class="icon">🔙</div>
                                                <div class="number" style="background-color: #7969b9;" id="reverted">4</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">REVERTED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#dea364;">
                                            <div class="card-header1">
                                                <div class="icon">⏳</div>
                                                <div class="number" style="background-color: #dea364;" id="in_process">35</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">IN-PROCESS</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#d80303;">
                                            <div class="card-header1">
                                                <div class="icon">🕒</div>
                                                <div class="number" style="background-color: #d80303;" id="pending">19</div>
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
                                                <h3 style="text-align:left">Pre-Establishment (Approved) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                                                <h3 style="text-align:left">Pre-Establishment (Reverted) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                                                <div class="number" style="background-color: #28a745;" id="total_received">78</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">RECEIVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#59abf9;">
                                            <div class="card-header1">
                                                <div class="icon">🆗</div>
                                                <div class="number" style="background-color: #59abf9;" id="approved">8</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">APPROVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#7969b9;">
                                            <div class="card-header1">
                                                <div class="icon">🔙</div>
                                                <div class="number" style="background-color: #7969b9;" id="reverted">4</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">REVERTED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#dea364;">
                                            <div class="card-header1">
                                                <div class="icon">⏳</div>
                                                <div class="number" style="background-color: #dea364;" id="in_process">35</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">IN-PROCESS</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#d80303;">
                                            <div class="card-header1">
                                                <div class="icon">🕒</div>
                                                <div class="number" style="background-color: #d80303;" id="pending">19</div>
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
                                                <h3 style="text-align:left">Pre-Operational (Approved) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                                                <h3 style="text-align:left">Pre-Operational (Reverted) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                	  
                	  <div class="content2 Renewal">
                        <div class="card-body dash1" style="padding: 0px !important;">
                            <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Renewal - Dashboard</h1>
                            <div class="row">
                                <div class="col-md-12 form-group" style="margin-top: 20px">
                            		<div class="dashboard">
                                        <a href="#" class="card1" style="border-left-color:#28a745;">
                                            <div class="card-header1">
                                                <div class="icon">📥</div>
                                                <div class="number" style="background-color: #28a745;" id="total_received">78</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">RECEIVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#59abf9;">
                                            <div class="card-header1">
                                                <div class="icon">🆗</div>
                                                <div class="number" style="background-color: #59abf9;" id="approved">8</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">APPROVED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#7969b9;">
                                            <div class="card-header1">
                                                <div class="icon">🔙</div>
                                                <div class="number" style="background-color: #7969b9;" id="reverted">4</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">REVERTED</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#dea364;">
                                            <div class="card-header1">
                                                <div class="icon">⏳</div>
                                                <div class="number" style="background-color: #dea364;" id="in_process">35</div>
                                            </div>
                                            <h4>Number of Application</h4>
                                            <div class="value">IN-PROCESS</div>
                                        </a>
                                        <a href="#" class="card1" style="border-left-color:#d80303;">
                                            <div class="card-header1">
                                                <div class="icon">🕒</div>
                                                <div class="number" style="background-color: #d80303;" id="pending">19</div>
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
                                                <h3 style="text-align:left">Renewal (Approved) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                                                <h3 style="text-align:left">Renewal (Reverted) — Jun to July 2025</h3>
                                                <table>
                                                    <thead class="thead-primary">
                                                      <tr><th>Sr</th><th>District</th><th>0-5 Days</th><th>6-10</th><th>11-15</th><th>Avg Days</th><th>Total Application</th></tr>
                                                    </thead>
                                                    <tbody>
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
                                    <div class="value">3</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Hydraulic<br />Platform</h4>
                                    <div class="value">1</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Water<br />Browser</h4>
                                    <div class="value">7</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>DCP<br />Tender</h4>
                                    <div class="value">1</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Foam<br />Tender</h4>
                                    <div class="value">8</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Water<br />Tender</h4>
                                    <div class="value">84</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Crash Fire<br />Tender</h4>
                                    <div class="value">6</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Mini High<br />Pressure</h4>
                                    <div class="value">45</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Water<br />Mist</h4>
                                    <div class="value">36</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4><br />Ambulance</h4>
                                    <div class="value">8</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4>Rescue<br />Tender</h4>
                                    <div class="value">3</div>
                                </div>
    
                                <div class="kpi-card">
                                    <h4><br />PPCV</h4>
                                    <div class="value">0</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4><br />Bulero</h4>
                                    <div class="value">0</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4>Tools<br />Pump</h4>
                                    <div class="value">0</div>
                                </div>
                                
                                <div class="kpi-card">
                                    <h4>Backpack<br />Set</h4>
                                    <div class="value">0</div>
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
                        <div class="col-md-5">
                            <div class="card custom-card">
                                <div class="card-body dash1">
                                    <canvas id="FireReportMonthReportPieChart"></canvas>
                                </div>    
                            </div>
                        </div>
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
              
              <div class="content relief">
                <h1 style="margin-bottom:12px;font-size:20px;margin-top: 10px">Relief Report</h1>
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
<script>
new Chart(document.getElementById('AllNOCRejectPie'),{
  type:'doughnut',
  data:{labels:['Letter Missing','Proposed Map','Incomplete Map','Other'],datasets:[{data:[43,19,9,29],backgroundColor:['#2f80ed','#ff7f50','#b9b9b9','#ffd166']} ]},
  options:{plugins:{legend:{position:'right'}},aspectRatio:1.2}
});
new Chart(document.getElementById('PreEstablishmentRejectPie'),{
  type:'doughnut',
  data:{labels:['Letter Missing','Proposed Map','Incomplete Map','Other'],datasets:[{data:[43,19,9,29],backgroundColor:['#2f80ed','#ff7f50','#b9b9b9','#ffd166']} ]},
  options:{plugins:{legend:{position:'right'}},aspectRatio:1.2}
});

new Chart(document.getElementById('PreOperationalRejectPie'),{
  type:'doughnut',
  data:{labels:['Letter Missing','Proposed Map','Incomplete Map','Other'],datasets:[{data:[43,19,9,29],backgroundColor:['#2f80ed','#ff7f50','#b9b9b9','#ffd166']} ]},
  options:{plugins:{legend:{position:'right'}},aspectRatio:1.2}
});

new Chart(document.getElementById('RenewalRejectPie'),{
  type:'doughnut',
  data:{labels:['Letter Missing','Proposed Map','Incomplete Map','Other'],datasets:[{data:[43,19,9,29],backgroundColor:['#2f80ed','#ff7f50','#b9b9b9','#ffd166']} ]},
  options:{plugins:{legend:{position:'right'}},aspectRatio:1.2}
});

    
new Chart(document.getElementById('VehiclePieChart'), {
  type: 'pie',
  data: {
    labels:['Foam Tender','Water Tender','Crash Fire Tender','Mini High Fire','Water Mist','Rescue Tender','PCBC','Bulero','Tools Pump','Multipurpose Fire Tender','Hydrolic Platform','DRFT Tender','Backfire Set','Ambulance'],
    datasets:[{data:[15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
    backgroundColor:["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('AllNOCApplicationByStatusPieChart'), {
  type: 'pie',
  data: {
    labels:['Approved','Reverted','Under Process','Pending'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('PreEstablishmentApplicationByStatusPieChart'), {
  type: 'pie',
  data: {
    labels:['Approved','Reverted','Under Process','Pending'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('PreOperationalApplicationByStatusPieChart'), {
  type: 'pie',
  data: {
    labels:['Approved','Reverted','Under Process','Pending'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('RenewalApplicationByStatusPieChart'), {
  type: 'pie',
  data: {
    labels:['Approved','Reverted','Under Process','Pending'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('FireReportCategoryIncidentPieChart'), {
  type: 'pie',
  data: {
    labels:['Small Fire','Major Fire','Serious Fire ','Special Fire'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});
new Chart(document.getElementById('RescueReportCategoryIncidentPieChart'), {
  type: 'pie',
  data: {
    labels:['Small Fire','Major Fire','Serious Fire ','Special Fire'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('ReliefReportCategoryIncidentPieChart'), {
  type: 'pie',
  data: {
    labels:['Small Fire','Major Fire','Serious Fire ','Special Fire'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('FireHydrentPieChart'), {
  type: 'pie',
  data: {
    labels:['Working','Not Working','Proposed'],
    datasets:[{data:[46,18,27],backgroundColor:['#2f80ed','#ff7f50','#98a0a8']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});


new Chart(document.getElementById('FireReportMonthReportPieChart'), {
  type: 'pie',
  data: {
    labels:['Small Fire','Major Fire','Serious Fire ','Special Fire'],
    datasets:[{data:[46,18,27,9],backgroundColor:['#2f80ed','#ff7f50','#98a0a8','#f5b041']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});
new Chart(document.getElementById('FireReportNoOfFireCallPieChart'), {
  type: 'pie',
  data: {
    labels:['Commercial','Residential','High Rise','Forest','Farm','Industry','Vehicle','Landscape','Other'],
    datasets:[{data:[46,18,27,9,51,29,33,19,40],backgroundColor:['#f67fa7','#5f7670','#98a0a8','#f5b041','#2f80ed','#ff7f50','#00a0a8','#f5ff41','#f5b0ff']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});

new Chart(document.getElementById('EmployeeVacancyPieChart'), {
  type: 'pie',
  data: {
    labels:['DDT', 'CFO', 'FSO', 'FSSO', 'LFM', 'DVR', 'FM', '4th Class'],
    datasets:[{data:[46,18,27,9,51,29,33,19],backgroundColor:['#f67fa7','#5f7670','#98a0a8','#f5b041','#2f80ed','#ff7f50','#00a0a8','#f5ff41']}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});


new Chart(document.getElementById('DisasterEquipmentPieChart'), {
  type: 'pie',
  data: {
    labels:['Foam Tender','Water Tender','Crash Fire Tender','Mini High Fire','Water Mist','Rescue Tender','PCBC','Bulero','Tools Pump','Multipurpose Fire Tender','Hydrolic Platform','DRFT Tender','Backfire Set','Ambulance'],
    datasets:[{data:[15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
    backgroundColor:["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});


new Chart(document.getElementById('PersonalProtectiveEquipmentPieChart'), {
  type: 'pie',
  data: {
    labels:['Foam Tender','Water Tender','Crash Fire Tender','Mini High Fire','Water Mist','Rescue Tender','PCBC','Bulero','Tools Pump','Multipurpose Fire Tender','Hydrolic Platform','DRFT Tender','Backfire Set','Ambulance'],
    datasets:[{data:[15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
    backgroundColor:["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});


new Chart(document.getElementById('MountaineeringSerachRescueEquipmentPieChart'), {
  type: 'pie',
  data: {
    labels:['Foam Tender','Water Tender','Crash Fire Tender','Mini High Fire','Water Mist','Rescue Tender','PCBC','Bulero','Tools Pump','Multipurpose Fire Tender','Hydrolic Platform','DRFT Tender','Backfire Set','Ambulance'],
    datasets:[{data:[15, 19, 5, 18, 7, 2, 5, 5, 5, 1, 0, 3, 15, 1],
    backgroundColor:["#4e79a7", "#59a14f", "#9c755f", "#f28e2b", "#76b7b2", "#edc948", "#af7aa1", "#ff9da7", "#8cd17d", "#b6992d", "#bab0ab", "#e15759", "#79706e", "#6b4f82"]}]
  },
  options:{plugins:{legend:{position:'bottom'}},aspectRatio:1.4}
});






new Chart(document.getElementById('AllNOCApplicationByStatusBarChart'), {
  type:'bar',
  data:{labels:['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'],
    datasets:[{label:'No. of Application',data:[5,12,30,18,80,65,55,44,16,8,33,70,10]}]
  },
  options:{scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}}}
});

new Chart(document.getElementById('PreEstablishmentApplicationByStatusBarChart'), {
  type:'bar',
  data:{labels:['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'],
    datasets:[{label:'No. of Application',data:[5,12,30,18,80,65,55,44,16,8,33,70,10]}]
  },
  options:{scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}}}
});

new Chart(document.getElementById('PreOperationalApplicationByStatusBarChart'), {
  type:'bar',
  data:{labels:['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'],
    datasets:[{label:'No. of Application',data:[5,12,30,18,80,65,55,44,16,8,33,70,10]}]
  },
  options:{scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}}}
});

new Chart(document.getElementById('RenewalApplicationByStatusBarChart'), {
  type:'bar',
  data:{labels:['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'],
    datasets:[{label:'No. of Application',data:[5,12,30,18,80,65,55,44,16,8,33,70,10]}]
  },
  options:{scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}}}
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



new Chart(document.getElementById('AllNOCApplicationByTypeBarChart'), {
  type:'bar',
  data:{labels:['Residential','Educational','Institutional','Business','Mercantile','Industrial','Hazardous','Storage','Arm Lines','Petrol Pump','Cinema Hall','Fire Cracker','Other'],
    datasets:[{label:'No. of Application',data:[8,18,22,12,80,65,55,45,22,10,12,34,10]}]
  },
  options:{indexAxis:'x',scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}},aspectRatio:1.6}
});

new Chart(document.getElementById('PreEstablishmentApplicationByTypeBarChart'), {
  type:'bar',
  data:{labels:['Residential','Educational','Institutional','Business','Mercantile','Industrial','Hazardous','Storage','Arm Lines','Petrol Pump','Cinema Hall','Fire Cracker','Other'],
    datasets:[{label:'No. of Application',data:[8,18,22,12,80,65,55,45,22,10,12,34,10]}]
  },
  options:{indexAxis:'x',scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}},aspectRatio:1.6}
});

new Chart(document.getElementById('PreOperationalApplicationByTypeBarChart'), {
  type:'bar',
  data:{labels:['Residential','Educational','Institutional','Business','Mercantile','Industrial','Hazardous','Storage','Arm Lines','Petrol Pump','Cinema Hall','Fire Cracker','Other'],
    datasets:[{label:'No. of Application',data:[8,18,22,12,80,65,55,45,22,10,12,34,10]}]
  },
  options:{indexAxis:'x',scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}},aspectRatio:1.6}
});

new Chart(document.getElementById('RenewalApplicationByTypeBarChart'), {
  type:'bar',
  data:{labels:['Residential','Educational','Institutional','Business','Mercantile','Industrial','Hazardous','Storage','Arm Lines','Petrol Pump','Cinema Hall','Fire Cracker','Other'],
    datasets:[{label:'No. of Application',data:[8,18,22,12,80,65,55,45,22,10,12,34,10]}]
  },
  options:{indexAxis:'x',scales:{y:{beginAtZero:true}},plugins:{legend:{display:false}},aspectRatio:1.6}
});


</script>

<script>
        // Get the canvas element
        const ctx = document.getElementById('VehicleChart').getContext('2d');

        // Data for the bar chart
        const data = {
            labels: ['Almora', 'Bageshwer', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udhamsingh Nagar', 'Uttarkashi'],
            datasets: [
                {
                    label: 'Working',
                    data: [50, 60, 100, 270, 108, 167, 188, 98, 67, 46, 92, 28, 56],
                    backgroundColor: 'rgba(6, 154, 235, 0.7)',
                    borderColor: 'rgba(6, 154, 235, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Not-Working',
                    data: [20, 10, 19, 90, 40, 10, 46, 21, 17, 10, 13, 5, 11],
                    backgroundColor: 'rgba(255, 159, 67, 0.7)',
                    borderColor: 'rgba(255, 159, 67, 1)',
                    borderWidth: 1,
                }
            ]
        };

        // Chart configuration
        const config = {
            type: 'bar', // Bar chart type
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'No. of Vehicle'
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
        new Chart(ctx, config);
    </script>
    
<script>
        // Get the canvas element
        const ctx1 = document.getElementById('FireHydrentChart').getContext('2d');

        // Data for the bar chart
        const data1 = {
            labels: ['Almora', 'Bageshwer', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udhamsingh Nagar', 'Uttarkashi'],
            datasets: [
                {
                    label: 'Working',
                    data: [50, 60, 100, 270, 108, 167, 188, 98, 67, 46, 92, 28, 56],
                    backgroundColor: 'rgba(6, 154, 235, 0.7)',
                    borderColor: 'rgba(6, 154, 235, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Not-Working',
                    data: [20, 10, 19, 90, 40, 10, 46, 21, 17, 10, 13, 5, 11],
                    backgroundColor: 'rgba(255, 159, 67, 0.7)',
                    borderColor: 'rgba(255, 159, 67, 1)',
                    borderWidth: 1,
                },
                {
                    label: 'Approved',
                    data: [60, 30, 36, 50, 77, 11, 25, 45, 37, 8, 20, 15, 31],
                    backgroundColor: 'rgba(152, 160, 168, 0.7)',
                    borderColor: 'rgba(152, 160, 168, 1)',
                    borderWidth: 1,
                }
            ]
        };

        // Chart configuration
        const config1 = {
            type: 'bar', // Bar chart type
            data: data1,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'No. of Vehicle'
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
        new Chart(ctx1, config1);
    </script>
    
<script>
        // Get the canvas element
        const ctx2 = document.getElementById('EmployeeSanctionedAvailableChart').getContext('2d');

        // Data for the bar chart
        const data2 = {
            labels: ['DDT', 'CFO', 'FSO', 'FSSO', 'LFM', 'DVR', 'FM', '4th Class'],
            datasets: [
                {
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
    </script>
    
<script>
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
      x: { stacked: true },
      y: { stacked: true, beginAtZero: true }
    },
    plugins: {
      legend: { position: 'top' }
    }
  }
});
</script>
    
<script>
const labelsFireReport = ['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'];

// BAR DATA
const productAFireReport = [30, 40, 50, 60, 50, 45, 30, 40, 20, 30, 40, 50, 60];

// LINE DATA (same values as bar stack)
const lineAFireReport = [...productAFireReport];

const ctx4 = document.getElementById('FireReportNoOfIncidentChart').getContext('2d');

new Chart(ctx4, {
  data: {
    labels: labelsFireReport,
    datasets: [
      /* STACKED BARS */
      {
        type: 'bar',
        label: '',
        data: productAFireReport,
        backgroundColor: 'rgba(54, 162, 235, 0.85)',
        stack: 'stack1'
      },

      /* LINES FOR EACH STACK */
      {
        type: 'line',
        label: '',
        data: lineAFireReport,
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
      x: { stacked: true },
      y: { stacked: true, beginAtZero: true }
    },
    plugins: {
      legend: { position: 'top' }
    }
  }
});
</script>
    
<script>
const labelsRescueReport = ['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'];

// BAR DATA
const productARescueReport = [30, 40, 50, 60, 50, 45, 30, 40, 20, 30, 40, 50, 60];

// LINE DATA (same values as bar stack)
const lineARescueReport = [...productARescueReport];

const ctx5 = document.getElementById('RescueReportNoOfIncidentChart').getContext('2d');

new Chart(ctx5, {
  data: {
    labels: labelsRescueReport,
    datasets: [
      /* STACKED BARS */
      {
        type: 'bar',
        label: '',
        data: productARescueReport,
        backgroundColor: 'rgba(54, 162, 235, 0.85)',
        stack: 'stack1'
      },

      /* LINES FOR EACH STACK */
      {
        type: 'line',
        label: '',
        data: lineARescueReport,
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
      x: { stacked: true },
      y: { stacked: true, beginAtZero: true }
    },
    plugins: {
      legend: { position: 'top' }
    }
  }
});
</script>

<script>
const labelsReliefReport = ['Almora','Bageshwar','Chamoli','Champawat','Dehradun','Haridwar','Nainital','Pauri Garhwal','Pithoragarh','Rudraprayag','Tehri Garhwal','Udham Singh Nagar','Uttarkashi'];

// BAR DATA
const productAReliefReport = [30, 40, 50, 60, 50, 45, 30, 40, 20, 30, 40, 50, 60];

// LINE DATA (same values as bar stack)
const lineAReliefReport = [...productAReliefReport];

const ctx6 = document.getElementById('ReliefReportNoOfIncidentChart').getContext('2d');

new Chart(ctx6, {
  data: {
    labels: labelsReliefReport,
    datasets: [
      /* STACKED BARS */
      {
        type: 'bar',
        label: '',
        data: productAReliefReport,
        backgroundColor: 'rgba(54, 162, 235, 0.85)',
        stack: 'stack1'
      },

      /* LINES FOR EACH STACK */
      {
        type: 'line',
        label: '',
        data: lineAReliefReport,
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
      x: { stacked: true },
      y: { stacked: true, beginAtZero: true }
    },
    plugins: {
      legend: { position: 'top' }
    }
  }
});
</script>
    

    <!-- End Row -->
    @endsection
    @section('scripts')
   
    @stop
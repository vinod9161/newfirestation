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
    flex-wrap: wrap;
    gap: 0px;
}

.kpi-card {
    background-color: white;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 5px;
    width: 103px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.kpi-card h4 {
    color: #4433cc;
    font-size: 13px;
    margin-bottom: 8px;
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
    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="row" id="dashboardFilterForm">
                    <div class="col-md-2">
                        <label>Start Date</label>
                        <input type="date" class="form-control" id="start_date" value="<?= date("Y") ?>-01-01">
                    </div>
                    <div class="col-md-2">
                        <label>End Date</label>
                        <input type="date" class="form-control" id="end_date" value="<?= date("Y-m-d") ?>">
                    </div>



                    <?php
                        $user = Auth::user();
                    ?>
                    <div class="col-md-3">
                        <label>District</label>
                        <select class="form-control" id="district" name="district"
                            <?= in_array($user->type, [2, 3]) ? 'disabled' : '' ?>>
                            <option value="">--- Select District ---</option>
                            <?php foreach ($districtList ?? [] as $disData): ?>
                            <option value="<?= $disData->id ?>"
                                <?= ($user->district_id == $disData->id) ? 'selected' : '' ?>>
                                <?= $disData->name ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label>Fire Station</label>
                        <select class="form-control" id="fire_station" name="fire_station"
                            <?= ($user->type == 3) ? 'disabled' : '' ?>>
                            <option value="">--- Select Fire Station ---</option>
                            <?php foreach ($fireStactionList ?? [] as $fs): ?>
                            <?php
                                    // If user type is 3, show only their assigned fire station
                                    if ($user->type == 3 && $user->station_id != $fs->id) continue;
                                ?>
                            <option value="<?= $fs->id ?>" <?= ($user->station_id == $fs->id) ? 'selected' : '' ?>>
                                <?= $fs->name ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>


                    <div class="col-md-2">
                        @csrf
                        <button type="button" class="btn btn-primary" id="filterBtn"
                            style="margin-top: 29px;">Filter</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body dash1" style="padding: 10px;">
                <div class="row">


                    <div class="col-md-12">
                        <div class="card-container">
                            <div class="kpi-card">
                                <h4>Fire Stations<br>(count)</h4>
                                <div class="value" id="total_fire">0 <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total<br>Manpower</h4>
                                <div class="value">0<span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total<br>Vehicles</h4>
                                <div class="value"><?php  //number_format($vehicles) ?> <span>▲</span></div>
                                <div class="value" id="total_vehicles">0 <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total<br>Equipment</h4>
                                <div class="value">1,256 <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total Fire<br>Calls</h4>
                                <div class="value"><?= number_format($fireCount) ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Rescue & Relief<br>Calls</h4>
                                <div class="value" total_rescue><?= number_format($rescueCount + $reliefCount) ?>
                                    <span>▲</span>
                                </div>
                            </div>

                            <div class="kpi-card">
                                <h4>Saved Lives<br>(persons)</h4>
                                <div class="value">3,456 <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Saved<br>Property</h4>
                                <div class="value">245.6 <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>NOCs Issued<br>(count)</h4>
                                <div class="value"><?= number_format($nocCount) ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Awareness<br>Programs</h4>
                                <div class="value"><?= number_format($awareness) ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Operational<br>Duties</h4>
                                <div class="value">4,567 <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Safety<br>Audits</h4>
                                <div class="value"><?= number_format($inspection) ?> <span>▲</span></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 form-group">
        <div class="dashboard">
            <?php
        $statusColors = [
            'RECEIVED'   => '#28a745',
            'APPROVED'   => '#59abf9',
            'REVERTED'   => '#7969b9',
            'IN_PROCESS' => '#dea364',
            'PENDING'    => '#d80303',
        ];

        $statusIcons = [
            'RECEIVED'   => '📥',
            'APPROVED'   => '🆗',
            'REVERTED'   => '🔙',
            'IN_PROCESS' => '⏳',
            'PENDING'    => '🕒',
        ];
    ?>

            <?php foreach ($applicationStatusCounts as $status => $count): ?>
            <a href="#" class="card1" style="border-left-color:<?= $statusColors[$status]; ?>;">
                <div class="card-header1">
                    <div class="icon"><?= $statusIcons[$status]; ?></div>
                    <div class="number" style="background-color: <?= $statusColors[$status]; ?>;"><?= $count; ?></div>
                </div>
                <h4>Number of Application</h4>
                <div class="value"><?= str_replace('_', '-', $status); ?></div>
            </a>
            <?php endforeach; ?>
        </div>

    </div>

    <div class="col-md-6 form-group">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="VehicleCompositionBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 form-group">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="emergencyChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3 form-group">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="row">
                    <div class="col-md-12">
                        <label>NOC Status Distribution</label>
                        <canvas id="NOCStatusDistributionPieChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5 form-group">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="row">
                    <div class="col-md-12">

                        <canvas id="PendingApplicationBarChart" height="182"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 form-group">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="row">
                    <div class="col-md-12">

                        <canvas id="AwarenesProgramBarChart" height="234"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>







    <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="d-flex">
                    <p class="mb-1 tx-inverse">Number Of NOC</p>
                    <div class="ms-auto">
                        <i class="fa fa-chart-line fs-20 text-primary"></i>
                    </div>
                </div>
                <div>
                    <h3 class="dash-25">{{ $nocCount }}</h3>
                </div>
                <div class="progress progress-xs mb-1" role="progressbar" aria-label="Basic example"
                    aria-valuenow="{{ $nocCount }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar" style="width: {{ $nocCount }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="d-flex">
                    <p class="mb-1 tx-inverse">New Inspection</p>
                    <div class="ms-auto">
                        <i class="fa-regular fa-money-bill-1 fs-20 text-secondary"></i>
                    </div>
                </div>
                <div>
                    <h3 class="dash-25">{{ $inspection }}</h3>
                </div>
                <div class="progress progress-xs mb-1" role="progressbar" aria-label="Basic example"
                    aria-valuenow="{{ $inspection }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-secondary" style="width: {{ $inspection }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="d-flex">
                    <p class="mb-1 tx-inverse">Total Awareness Program</p>
                    <div class="ms-auto">
                        <i class="fa fa-usd fs-20 text-success"></i>
                    </div>
                </div>
                <div>
                    <h3 class="dash-25">{{ $awareness }}</h3>
                </div>
                <div class="progress progress-xs mb-1" role="progressbar" aria-label="Basic example"
                    aria-valuenow="{{ $awareness }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-success" style="width: {{ $awareness }}%"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3 col-lg-6">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="d-flex">
                    <p class="mb-1 tx-inverse">Total Vehicles</p>
                    <div class="ms-auto">
                        <i class="fa fa-signal fs-20 text-info"></i>
                    </div>
                </div>
                <div>
                    <h3 class="dash-25">{{ $vehicles }}</h3>
                </div>
                <div class="progress progress-xs mb-1" role="progressbar" aria-label="Basic example"
                    aria-valuenow="{{ $vehicles }}" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar bg-info" style="width: {{ $vehicles }}%"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End  Row -->

<!-- Row-->
<div class="row">
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Report Data</div>
            </div>
            <div class="card-body">
                <div id="column-basic"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">NOC Report</div>
            </div>
            <div class="card-body">
                <div id="donut-simple"></div>
            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
const emergencyChart = new Chart(document.getElementById('emergencyChart'), {
    type: 'bar',
    data: {
        labels: [],
        datasets: [{
                label: 'Fire Calls',
                backgroundColor: 'red',
                data: []
            },
            {
                label: 'Rescue Calls',
                backgroundColor: 'orange',
                data: []
            },
            {
                label: 'Relief Calls',
                backgroundColor: 'green',
                data: []
            }
        ]
    },
});

const awarenessChart = new Chart(document.getElementById('awarenessChart'), {
    type: 'line',
    data: {
        labels: [],
        datasets: [{
            label: 'Awareness Programs',
            borderColor: 'blue',
            data: [],
            fill: false
        }]
    },
});

$('#filterBtn').on('click', function() {
    const data = {
        start_date: $('#start_date').val(),
        end_date: $('#end_date').val(),
        district: $('#district').val(),
        fire_station: $('#fire_station').val()
    };

    $.ajax({
        url: '{{ route("admin.dashboardfilterData") }}',
        data,
        success: function(res) {
            $('#total_fire').text(res.fireCount);
            $('#total_rescue').text(res.rescueCount);
            $('#total_relief').text(res.reliefCount);
            $('#total_noc').text(res.nocCount);
            $('#total_inspection').text(res.inspection);
            $('#total_awareness').text(res.awareness);
            $('#total_vehicles').text(res.vehicles);

            emergencyChart.data.labels = res.monthNames;
            emergencyChart.data.datasets[0].data = res.fireCounts;
            emergencyChart.data.datasets[1].data = res.rescueCounts;
            emergencyChart.data.datasets[2].data = res.reliefCounts;
            emergencyChart.update();

            awarenessChart.data.labels = res.monthNames;
            awarenessChart.data.datasets[0].data = res.awarenessCounts;
            awarenessChart.update();
        }
    });
});
</script>




<!-- New  -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>
const ctxVehicle = document.getElementById('VehicleCompositionBarChart').getContext('2d');

const districtLabels = <?= json_encode($districts) ?>;
const vehicleData = <?= json_encode($vehicleCounts) ?>;

new Chart(ctxVehicle, {
    type: 'bar',
    data: {
        labels: districtLabels,
        datasets: [{
            label: 'Vehicle Composition',
            data: vehicleData,
            backgroundColor: 'rgba(135, 96, 251, 0.9)',
            borderWidth: 1
        }]
    },
    options: {
        indexAxis: 'y',
        responsive: true,
        scales: {
            x: {
                beginAtZero: true
            }
        }
    }
});




const fireData = <?= json_encode($fireCounts) ?>;
const rescueData = <?= json_encode($rescueCounts) ?>;
const reliefData = <?= json_encode($reliefCounts) ?>;

const ctxEmergency = document.getElementById('emergencyChart').getContext('2d');

const emergencyChart = new Chart(ctxEmergency, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
                type: 'line',
                label: 'Fire Calls',
                data: fireData,
                borderColor: 'orange',
                backgroundColor: 'orange',
                yAxisID: 'y1',
                tension: 0.4,
                pointRadius: 4,
                fill: false
            },
            {
                type: 'bar',
                label: 'Rescue Calls',
                data: rescueData,
                backgroundColor: 'rgba(63, 81, 181, 0.7)',
                yAxisID: 'y'
            },
            {
                type: 'bar',
                label: 'Total Emergency Response Time',
                data: reliefData,
                backgroundColor: 'rgba(63, 81, 181, 0.4)',
                yAxisID: 'y'
            }
        ]
    },
    options: {
        responsive: true,
        interaction: {
            mode: 'index',
            intersect: false
        },
        plugins: {
            legend: {
                position: 'top'
            },
            title: {
                display: false
            }
        },
        scales: {
            y: {
                type: 'linear',
                position: 'left',
                title: {
                    display: true,
                    text: 'Rescue Calls'
                },
                beginAtZero: true
            },
            y1: {
                type: 'linear',
                position: 'right',
                grid: {
                    drawOnChartArea: false
                },
                title: {
                    display: true,
                    text: 'Fire Calls'
                },
                beginAtZero: true
            }
        }
    }
});



const ctxAwarenes = document.getElementById('AwarenesProgramBarChart').getContext('2d');

const chart = new Chart(ctxAwarenes, {
    type: 'bar',
    data: {
        labels: ['Mock Drill', 'Workshop', 'Safty', 'Communication', 'Industrial'],
        datasets: [{
            label: 'Awareness Program Distribution',
            data: [12, 19, 15, 9, 11],
            backgroundColor: 'rgba(54, 162, 235, 0.7)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Count'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Program Type'
                }
            }
        }
    }
});





const ctxPendingApplication = document.getElementById('PendingApplicationBarChart').getContext('2d');

const pendingLabels = <?= json_encode($pendingLabels) ?>;
const pendingCounts = <?= json_encode($pendingCounts) ?>;

const PendingApplicationchart = new Chart(ctxPendingApplication, {
    type: 'bar',
    data: {
        labels: pendingLabels,
        datasets: [{
            label: 'Pending Application',
            data: pendingCounts,
            backgroundColor: 'rgba(255, 99, 132, 0.9)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        }
    }
});




document.addEventListener('DOMContentLoaded', function() {
    const ctxNOC = document.getElementById('NOCStatusDistributionPieChart').getContext('2d');

    const nocLabels = <?= json_encode($nocLabels) ?>;
    const nocCounts = <?= json_encode($nocCounts) ?>;
    console.log('NOC Labels:', nocLabels);
    console.log('NOC Counts:', nocCounts);
    const pieChartWithLabels = new Chart(ctxNOC, {
        type: 'pie',
        data: {
            labels: nocLabels,
            datasets: [{
                data: nocCounts,
                backgroundColor: [
                    '#ff6384',
                    '#36a2eb',
                    '#ffce56',
                    '#4bc0c0',
                    '#9966ff'
                ],
                borderColor: '#eeeeee',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 12
                    },
                    formatter: (value, ctx) => {
                        return ctx.chart.data.labels[ctx.dataIndex];
                    }
                },
                tooltip: {
                    callbacks: {
                        label: (context) => {
                            const label = context.label || '';
                            const value = context.parsed;
                            return `${label}: ${value}`;
                        }
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });
});
</script>


<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).on('change', '#district', function() {
    let districtId = $(this).val().trim();
    let _token = $('input[name="_token"]').val();
    if (districtId == '') {
        alert("Required District");
    } else {
        $.ajax({
            url: "{{ route('actionFireStationByDistrict') }}",
            type: "POST",
            data: {
                district_id: districtId,
                _token: _token
            },
            success: function(response) {
                let dataObj = JSON.parse(response);
                if (dataObj.code === 1) {
                    let fireStation = '<option value="">---- Select Fire Station ----</option>';
                    $.each(dataObj.data, function(key, value) {
                        fireStation += '<option value="' + value.id + '">' + value.name +
                            '</option>';
                    });

                    $('#fire_station').html(fireStation);
                } else {
                    let fireStation = '<option value="">' + dataObj.message + '</option>';
                    $('#fire_station').html(fireStation);
                }
            }
        })
    }
});
</script>


<script>
$(document).ready(function() {

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).on('click', '#filterBtn', function(e){
        e.preventDefault;
        let userTyp = '<?= Auth::user()->type; ?>';

        let filterDistrict = '';
        let filterFire = '';

        if (userTyp == 0 || userTyp == 1) {
            filterDistrict = $('#distrcit').val().trim();
            filterFire = $('#fire_station').val().trim();
        } else if (userTyp == 2) {
            filterDistrict = '<?= Auth::user()->district_id; ?>';
            filterFire = $('#fire_station').val().trim();
        } else if (userTyp == 3) {
            filterDistrict = '<?= Auth::user()->district_id; ?>';
            filterFire = '<?= Auth::user()->station_id; ?>';
        }


        let data = {
            start_date: $('#start_date').val(),
            end_date: $('#end_date').val(),
            district_id: filterDistrict,
            fire_station_id: filterFire
        };

        // alert(JSON.stringify(data, null, 2));
        // return false;

        $.ajax({
            url: '{{ route("admin.dashboardfilterData") }}',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                $('#total_fire').text(response.fireCount);
                $('#total_rescue').text(response.rescueCount);
                $('#total_relief').text(response.reliefCount);
            },
            error: function() {
                alert('Something went wrong!');
            }
        });
    });


   
});
</script>




@stop
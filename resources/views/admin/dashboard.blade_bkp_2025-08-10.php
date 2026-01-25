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

    <div class="col-md-12">
        <div class="card custom-card">
            <div class="card-body dash1" style="padding: 10px;">
                <div class="row">
                    <div class="col-md-12" style="overflow-x: scroll;">
                        <div class="card-container">
                            <div class="kpi-card">
                                <h4>Fire Stations<br>(count)</h4>
                                <div class="value" id="total_fire_station"><?= number_format($fire_station_count)??0 ?>
                                    <span>▲</span>
                                </div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total<br>Manpower</h4>
                                <div class="value" id="total_man_power"><?=  number_format($man_power_count)??0 ?><span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total<br>Vehicles</h4>
                                <div class="value" id="total_vehicles"><?=  number_format($vehicles_count)??0 ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total<br>Equipment</h4>
                                <div class="value" id="total_equipment"><?=  number_format($equipment_count)??0 ?><span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Total Fire<br>Calls</h4>
                                <div class="value"><?php  echo number_format($fire_Calls_Count) ?? 0 ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Rescue & Relief<br>Calls</h4>
                                <div class="value" total_rescue><?= number_format($totalReliefRescueCount)??0 ?>
                                    <span>▲</span>
                                </div>
                            </div>

                            <div class="kpi-card">
                                <h4>Saved Lives<br>(persons)</h4>
                                <div class="value" id="save_life"><?= number_format($save_life_count) ?? 0 ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Saved<br>Property</h4>
                                <div class="value" id="save_property"><?= number_format($save_property_count) ?? 0 ?> <span>▲</span>
                                </div>
                            </div>

                            <div class="kpi-card">
                                <h4>NOCs Issued<br>(count)</h4>
                                <div class="value" id="total_noc"><?= number_format($noc_count) ?? 0 ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Awareness<br>Programs</h4>
                                <div class="value" id="total_w_p"><?= number_format($awareness_program_count) ?? 0 ?> <span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Operational<br>Duties</h4>
                                <div class="value"><?= number_format($op_duty_count) ?? 0 ?><span>▲</span></div>
                            </div>

                            <div class="kpi-card">
                                <h4>Safety<br>Audits</h4>
                                <div class="value"> 0 <span>▲</span></div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 form-group">
		<div class="dashboard">
            <a href="#" class="card1" style="border-left-color:#28a745;">
                <div class="card-header1">
                    <div class="icon">📥</div>
                    <div class="number" style="background-color: #28a745;" id="total_received"><?= $noc_total_received??0?></div>
                </div>
                <h4>Number of Application</h4>
                <div class="value">RECEIVED</div>
            </a>
            <a href="#" class="card1" style="border-left-color:#59abf9;">
                <div class="card-header1">
                    <div class="icon">🆗</div>
                    <div class="number" style="background-color: #59abf9;" id="approved"><?= $noc_total_approved??0?></div>
                </div>
                <h4>Number of Application</h4>
                <div class="value">APPROVED</div>
            </a>
            <a href="#" class="card1" style="border-left-color:#7969b9;">
                <div class="card-header1">
                    <div class="icon">🔙</div>
                    <div class="number" style="background-color: #7969b9;" id="reverted"><?= $noc_total_reverted??0?></div>
                </div>
                <h4>Number of Application</h4>
                <div class="value">REVERTED</div>
            </a>
            <a href="#" class="card1" style="border-left-color:#dea364;">
                <div class="card-header1">
                    <div class="icon">⏳</div>
                    <div class="number" style="background-color: #dea364;" id="in_process"><?= $noc_total_in_process??0?></div>
                </div>
                <h4>Number of Application</h4>
                <div class="value">IN-PROCESS</div>
            </a>
            <a href="#" class="card1" style="border-left-color:#d80303;">
                <div class="card-header1">
                    <div class="icon">🕒</div>
                    <div class="number" style="background-color: #d80303;" id="pending"><?= $noc_total_pending??0?></div>
                </div>
                <h4>Number of Application</h4>
                <div class="value">PENDING</div>
            </a>
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

    <div class="col-md-6 form-group">
        <div class="card custom-card">
            <div class="card-body dash1">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-6 text-right">
						<select class="form-control" name="nocChart" id="nocChart">
							<option>---Type of NOC---</option>
                            <option value="pre establishment noc">Pre Establishment NOC</option>
                            <option value="pre operational noc">Pre Operational NOC</option>
                            <option value="pre renewable noc">Pre Renewable NOC</option>
						</select>
					</div>
					<div class="col-md-4"></div>
                    <div class="col-md-12">
                        <canvas id="PendingApplicationMyStackedBarChart" height="160"></canvas>
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

                        <canvas id="AwarenesProgramBarChart" height="372"></canvas>
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
                        <canvas id="emergencyChart" style="height:383px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

   
    <!-- End Row -->
    @endsection
    @section('scripts')
    <!-- New  -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

    <script>
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
                                const data = ctx.chart.data.datasets[0].data;
                                const total = data.reduce((acc, val) => acc + val, 0);
                                const percentage = ((value / total) * 100).toFixed(1);
                                const label = ctx.chart.data.labels[ctx.dataIndex];
                                return `${label}\n${percentage}%`;
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: (context) => {
                                    const label = context.label || '';
                                    const value = context.parsed;
                                    const data = context.dataset.data;
                                    const total = data.reduce((acc, val) => acc + val, 0);
                                    const percentage = ((value / total) * 100).toFixed(1);
                                    return `${label}: ${value} (${percentage}%)`;
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
        const rawData = <?= json_encode($getNocData) ?>;

        // Extract district names
        const districtNocLabels = rawData.map(d => d.district_name);

        // Define the fixed Hindi ranges in order
        const ranges = ['0-5 दिन', '6-10 दिन', '11-15 दिन', '16-20 दिन', '21-25 दिन', '26-30 दिन', '31 दिन से अधिक'];

        // Assign colors for each range
        const colors = [
            'rgba(0, 200, 0, 0.9)',
            'rgba(102, 204, 0, 0.9)',
            'rgba(52, 152, 219, 0.9)',
            'rgba(155, 89, 182, 0.9)',
            'rgba(255, 140, 0, 0.9)',
            'rgba(255, 80, 0, 0.9)',
            'rgba(200, 0, 0, 0.9)'
        ];

        // Build datasets dynamically
        const datasets = ranges.map((rangeLabel, idx) => {
            return {
                label: rangeLabel,
                data: rawData.map(district => {
                    const found = district.noc_data.find(n => n.label === rangeLabel);
                    return found ? found.record_count : 0;
                }),
                backgroundColor: colors[idx]
            };
        });

        // Create Chart
        const PendingStackctx = document.getElementById('PendingApplicationMyStackedBarChart').getContext('2d');
        new Chart(PendingStackctx, {
            type: 'bar',
            data: {
                labels: districtNocLabels,
                datasets: datasets
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Pending Application'
                    },
                    legend: {
                        position: 'bottom'
                    }
                },
                scales: {
                    x: { stacked: true, beginAtZero: true },
                    y: { stacked: true }
                }
            }
        });
    </script>


    <script>
        const ctxVehicle = document.getElementById('VehicleCompositionBarChart').getContext('2d');

        const districtLabels = <?= json_encode($districts) ?>;
        const sanctionedData = [12, 19, 15, 9, 11, 33, 23, 55, 33, 28, 45, 31, 40];
        const availabilityData = <?= json_encode($vehicleCounts) ?>;
        
        new Chart(ctxVehicle, {
            type: 'bar',
            data: {
                labels: districtLabels,
                datasets: [
                    {
                        label: 'Sanctioned',
                        data: sanctionedData,
                        backgroundColor: 'rgba(54, 162, 235, 0.8)'
                    },
                    {
                        label: 'Availability',
                        data: availabilityData,
                        backgroundColor: 'rgba(75, 192, 192, 0.8)'
                    }
                ]
            },
            options: {
                indexAxis: 'y', // horizontal bar
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        beginAtZero: true
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        });
    </script>

    <script>

        function fetchAwarenessChartData() {
                return new Promise((resolve) => {
                $.ajax({
                    url: "{{ route('admin.postawarnessChart') }}",
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        resolve({
                            labels: data.labels,
                            values: data.values
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching chart data:', error);
                        // Fallback data in case of error
                        resolve({
                            labels: ['Mock Drill', 'Workshop', 'Safety', 'Communication', 'Industrial'],
                            values: [12, 19, 15, 9, 11]
                        });
                    }
                });
            });
        }

        async function initializeAwarenessChart() {
        const ctxAwarenes = document.getElementById('AwarenesProgramBarChart').getContext('2d');
        const chartData = await fetchAwarenessChartData();
        const chart = new Chart(ctxAwarenes, {
            type: 'bar',
            data: {
                labels: chartData.labels,
                datasets: [{
                    label: 'Awareness Program Distribution',
                    data: chartData.values,
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
    }


    $(document).ready(function() {
        initializeAwarenessChart();
    });
    </script>


    <script>
        // Emergency Chart
        const ctxEmergency = document.getElementById('emergencyChart').getContext('2d');
        const monthLabels = <?= json_encode($monthNames) ?>;
        const fireData = <?= json_encode($fireChartData) ?>;
        const rescueData = <?= json_encode($rescueChartData) ?>;

        // Debug: Log data to console to verify
        console.log('Month Labels:', monthLabels);
        console.log('Fire Data:', fireData);
        console.log('Rescue Data:', rescueData);

        emergencyChart = new Chart(ctxEmergency, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [
                    {
                        label: 'Fire Calls',
                        data: fireData,
                        backgroundColor: 'orange',
                        yAxisID: 'y1'
                    },
                    {
                        label: 'Rescue Calls',
                        data: rescueData,
                        backgroundColor: 'rgba(63, 81, 181, 0.7)',
                        yAxisID: 'y'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            font: { size: 14 },
                            color: '#333'
                        }
                    },
                    title: {
                        display: true,
                        text: 'Emergency Calls by Month',
                        font: { size: 16 }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return `${context.dataset.label}: ${Math.round(context.raw)}`; // Show whole numbers in tooltips
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        type: 'category',
                        title: {
                            display: true,
                            text: 'Month',
                            font: { size: 14 }
                        }
                    },
                    y: {
                        position: 'left',
                        min: 1, // Start at 1
                        max: 10, // End at 10
                        ticks: {
                            stepSize: 1, // Increment by 1
                            callback: function(value) {
                                if (Number.isInteger(value) && value >= 1 && value <= 10) {
                                    return value; // Show only whole numbers 1-10
                                }
                                return null;
                            },
                            precision: 0 // Prevent decimal formatting
                        },
                        title: {
                            display: true,
                            text: 'Rescue Calls',
                            font: { size: 14 }
                        }
                    },
                    y1: {
                        position: 'right',
                        min: 1, // Start at 1
                        max: 10, // End at 10
                        ticks: {
                            stepSize: 1, // Increment by 1
                            callback: function(value) {
                                if (Number.isInteger(value) && value >= 1 && value <= 10) {
                                    return value; // Show only whole numbers 1-10
                                }
                                return null;
                            },
                            precision: 0 // Prevent decimal formatting
                        },
                        grid: {
                            drawOnChartArea: false // Avoid overlapping grid lines
                        },
                        title: {
                            display: true,
                            text: 'Fire Calls',
                            font: { size: 14 }
                        }
                    }
                }
            }
        });
    </script>
    




    <script>
        $(document).on('click', '#dashboardfilterBtn', function() {
            let data = {
                start_date: $('#start_date').val(),
                end_date: $('#end_date').val(),
                district_id: $('#dashboard_dis').val(),
                fire_station_id: $('#dashboard_fire').val()
            };

            $.ajax({
                url: '{{ route("admin.dashboardfilterData") }}',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    // console.log(response);
                    // return false;
                    $('#total_fire_station').html(response.fire_station_count + ' <span>▲</span>');
                    $('#total_man_power').html(response.man_power_count + ' <span>▲</span>');
                    $('#total_vehicles').html(response.vehicles_count + ' <span>▲</span>');
                    $('#total_equipment').html(response.equipments_count + ' <span>▲</span>');
                    $('#save_life').html(response.save_life_count + ' <span>▲</span>');
                    $('#save_property').html(response.save_property_count + ' <span>▲</span>');
                    $('#total_noc').html(response.noc_count + ' <span>▲</span>');
                    $('#total_w_p').html(response.awareness_program_count + ' <span>▲</span>');

                    // noc
                    $('#total_received').html(response.total_received);
                    $('#approved').html(response.approved);
                    $('#reverted').html(response.reverted);
                    $('#pending').html(response.pending);
                    $('#in_process').html(response.in_process);

                    
                }
            });
        });
    </script>


    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('change', '#dashboard_dis', function() {
            let districtId = $(this).val().trim();
            let _token = $('input[name="_token"]').val();
            if (districtId == '') {
                alert("Required District");
                return false;
            }
            else {
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
                                fireStation += '<option value="' + value.id + '">' + value
                                    .name +
                                    '</option>';
                            });

                            $('#dashboard_fire').html(fireStation);
                        } else {
                            let fireStation = '<option value="">' + dataObj.message + '</option>';
                            $('#dashboard_fire').html(fireStation);
                        }
                    }
                })
            }
        });    
    </script>    

  


    @stop
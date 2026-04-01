    new Chart(document.getElementById('AllNOCRejectPie'), {
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


    new Chart(document.getElementById('VehiclePieChart'), {
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

    new Chart(document.getElementById('AllNOCApplicationByStatusPieChart'), {
        type: 'pie',
        data: {
            labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
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

    new Chart(document.getElementById('PreEstablishmentApplicationByStatusPieChart'), {
        type: 'pie',
        data: {
            labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
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

    new Chart(document.getElementById('PreOperationalApplicationByStatusPieChart'), {
        type: 'pie',
        data: {
            labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
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

    new Chart(document.getElementById('RenewalApplicationByStatusPieChart'), {
        type: 'pie',
        data: {
            labels: ['Approved', 'Reverted', 'Under Process', 'Pending'],
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

    new Chart(document.getElementById('FireReportCategoryIncidentPieChart'), {
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
    new Chart(document.getElementById('RescueReportCategoryIncidentPieChart'), {
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

    new Chart(document.getElementById('ReliefReportCategoryIncidentPieChart'), {
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

    new Chart(document.getElementById('FireHydrentPieChart'), {
        type: 'pie',
        data: {
            labels: ['Working', 'Not Working', 'Proposed'],
            datasets: [{
                data: [46, 18, 27],
                backgroundColor: ['#2f80ed', '#ff7f50', '#98a0a8']
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
    new Chart(document.getElementById('FireReportNoOfFireCallPieChart'), {
        type: 'pie',
        data: {
            labels: ['Commercial', 'Residential', 'High Rise', 'Forest', 'Farm', 'Industry', 'Vehicle', 'Landscape', 'Other'],
            datasets: [{
                data: [46, 18, 27, 9, 51, 29, 33, 19, 40],
                backgroundColor: ['#f67fa7', '#5f7670', '#98a0a8', '#f5b041', '#2f80ed', '#ff7f50', '#00a0a8', '#f5ff41', '#f5b0ff']
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






    new Chart(document.getElementById('AllNOCApplicationByStatusBarChart'), {
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



    new Chart(document.getElementById('AllNOCApplicationByTypeBarChart'), {
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
    const ctx = document.getElementById('VehicleChart').getContext('2d');

    // Data for the bar chart
    const data = {
        labels: ['Almora', 'Bageshwer', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udhamsingh Nagar', 'Uttarkashi'],
        datasets: [{
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
    
    // Get the canvas element
    const ctx1 = document.getElementById('FireHydrentChart').getContext('2d');

    // Data for the bar chart
    const data1 = {
        labels: ['Almora', 'Bageshwer', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udhamsingh Nagar', 'Uttarkashi'],
        datasets: [{
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

    

    const labelsFireReport = ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'];

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

    

    const labelsRescueReport = ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'];

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

    
    
    const labelsReliefReport = ['Almora', 'Bageshwar', 'Chamoli', 'Champawat', 'Dehradun', 'Haridwar', 'Nainital', 'Pauri Garhwal', 'Pithoragarh', 'Rudraprayag', 'Tehri Garhwal', 'Udham Singh Nagar', 'Uttarkashi'];

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

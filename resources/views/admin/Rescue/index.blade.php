@extends('layouts.admin.template')
@section('title') 
<title>Rescue Report List | Admin Dashboard</title> 
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Rescue Reports</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div class="me-2">
            <a href="javascript:void(0);" class="btn ripple btn-wave  btn-secondary navresponsive-toggler mb-0"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1 fs-10"></i>
            </a>
        </div>
        @if(Auth::user()->type == 3)
        <div>
            <a href="<?php echo route('admin.addRescueReport'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Rescue Report
            </a>
        </div>
        @endif
    </div>
</div>
<!-- End Row -->


<!--Navbar-->
<div class="responsive-background">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="advanced-search br-3">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <form method="GET"
                        action="{{ route('admin.rescueReport') }}"
                        id="filterForm">

                        <div class="row">

                            <!-- Rescue Report Number -->
                            <div class="col-md-3 mb-3">
                                <label>Rescue Report No</label>

                                <input type="text"
                                    class="form-control"
                                    name="rescue_report_no"
                                    value="{{ request('rescue_report_no') }}">
                            </div>

                            <!-- District -->
                            <div class="col-md-3 mb-3">
                                <label>District</label>

                                <select class="form-control" name="district_id" id="filter_district">

                                    <option value="">Select District</option>

                                    @foreach($district as $dist)

                                        <option value="{{ $dist->id }}"
                                            {{ request('district_id') == $dist->id ? 'selected' : '' }}>

                                            {{ $dist->name }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                            <!-- Station -->
                            <div class="col-md-3 mb-3">
                                <label>Fire Station</label>

                                <select class="form-control" name="station_id" id="filter_station">

                                    <option value="">Select Fire Station</option>

                                    @foreach($station as $st)

                                        <option value="{{ $st->id }}"
                                            {{ request('station_id') == $st->id ? 'selected' : '' }}>

                                            {{ $st->name }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                            <!-- Status -->
                            <div class="col-md-3 mb-3">
                                <label>Status</label>

                                <select class="form-control" name="status">

                                    <option value="">Select Status</option>

                                    <option value="0"
                                        {{ request('status') == '0' ? 'selected' : '' }}>
                                        Fresh Entry
                                    </option>

                                    <option value="1"
                                        {{ request('status') == '1' ? 'selected' : '' }}>
                                        Sent for Approval
                                    </option>

                                    <option value="2"
                                        {{ request('status') == '2' ? 'selected' : '' }}>
                                        Sent for Review
                                    </option>

                                    <option value="3"
                                        {{ request('status') == '3' ? 'selected' : '' }}>
                                        Approved
                                    </option>

                                    <option value="4"
                                        {{ request('status') == '4' ? 'selected' : '' }}>
                                        Rejected
                                    </option>

                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Rescue Area -->
                            <div class="col-md-3 mb-3">
                                <label>Area of Rescue</label>

                                <select class="form-control" name="rescue_area">

                                    <option value="">Select Area</option>

                                    <option value="1"
                                        {{ request('rescue_area') == '1' ? 'selected' : '' }}>
                                        Rural
                                    </option>

                                    <option value="2"
                                        {{ request('rescue_area') == '2' ? 'selected' : '' }}>
                                        City
                                    </option>

                                </select>
                            </div>

                            <!-- Rescue Type -->
                            <div class="col-md-3 mb-3">
                                <label>Type of Rescue</label>

                                <select class="form-control" name="rescue_area_type">

                                    <option value="">Select Rescue Type</option>

                                    <option value="1"
                                        {{ request('rescue_area_type') == '1' ? 'selected' : '' }}>
                                        Disaster
                                    </option>

                                    <option value="2"
                                        {{ request('rescue_area_type') == '2' ? 'selected' : '' }}>
                                        Earth Quick
                                    </option>

                                    <option value="3"
                                        {{ request('rescue_area_type') == '3' ? 'selected' : '' }}>
                                        Land Slide
                                    </option>

                                    <option value="4"
                                        {{ request('rescue_area_type') == '4' ? 'selected' : '' }}>
                                        Flood
                                    </option>

                                    <option value="5"
                                        {{ request('rescue_area_type') == '5' ? 'selected' : '' }}>
                                        Road Accident
                                    </option>

                                    <option value="6"
                                        {{ request('rescue_area_type') == '6' ? 'selected' : '' }}>
                                        Building Collapse
                                    </option>

                                    <option value="7"
                                        {{ request('rescue_area_type') == '7' ? 'selected' : '' }}>
                                        Gas Leak
                                    </option>

                                    <option value="8"
                                        {{ request('rescue_area_type') == '8' ? 'selected' : '' }}>
                                        Patient
                                    </option>

                                    <option value="9"
                                        {{ request('rescue_area_type') == '9' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>
                            </div>

                            <!-- From Date -->
                            <div class="col-md-3 mb-3">
                                <label>From Date</label>

                                <input type="date"
                                    class="form-control"
                                    name="from_date"
                                    value="{{ request('from_date') }}">
                            </div>

                            <!-- To Date -->
                            <div class="col-md-3 mb-3">
                                <label>To Date</label>

                                <input type="date"
                                    class="form-control"
                                    name="to_date"
                                    value="{{ request('to_date') }}">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-12 text-end">

                                <button type="submit"
                                        class="btn btn-primary">
                                    Filter
                                </button>

                                <a href="{{ route('admin.rescueReport') }}"
                                class="btn btn-secondary">
                                Reset
                                </a>

                            </div>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<!--End Navbar -->

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Rescue Report List
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <th>S No.</th>
                                <th>Rescue Report No.</th>
                                <th>District</th>
                                <th>Fire Station</th>
                                <th>Area of Rescue</th>
                                <th>Type of Rescue Area</th>
                                <th>Date of Rescue</th>
                                <th>Current Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rescue as $key => $report)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $report->rescue_report_no }}</td>
                                <td>
                                    @foreach ($district as $key => $dist)
                                        @if($dist->id == $report->district_id)
                                        {{ $dist->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($station as $key => $st)
                                        @if($st->id == $report->station_id)
                                        {{ $st->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @if($report->rescue_area == '1')
                                        @php echo "Rural ग्रामीण" @endphp
                                    @elseif($report->rescue_area == '2')
                                        @php echo "City शहरी" @endphp
                                    @endif
                                </td>
                                <td>
                                    @if($report->rescue_area_type ==1)
                                        @php echo "Disaster आपदा" @endphp
                                    @elseif($report->rescue_area_type ==2)
                                        @php echo "Earth Quick भूकम्प" @endphp
                                    @elseif($report->rescue_area_type ==3)
                                        @php echo "Land Slide भूस्खलन" @endphp
                                    @elseif($report->rescue_area_type ==4)
                                        @php echo "Flood बाढ़" @endphp
                                    @elseif($report->rescue_area_type ==5)
                                        @php echo "Road Accidentसड़क दुर्घटना" @endphp
                                    @elseif($report->rescue_area_type ==6)
                                        @php echo "Building Colipase भवन धंसना" @endphp
                                    @elseif($report->rescue_area_type ==7)
                                        @php echo "Gas Leak गैस लीकेज" @endphp
                                    @elseif($report->rescue_area_type ==8)
                                        @php echo "Patient मरीज" @endphp
                                    @else
                                        @php echo "Other अन्य" @endphp
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($report->rescue_incident_datetime)->format('d-m-Y H:i:s') }}</td>
                                <td>
                                    @if($report->status ==0)
                                        @php echo "Fresh Entry" @endphp
                                    @elseif($report->status ==1) 
                                        @php echo "Sent for Approval" @endphp
                                    @elseif($report->status ==2) 
                                        @php echo "Sent for Review" @endphp
                                    @elseif($report->status ==3) 
                                        @php echo "Approved" @endphp
                                    @elseif($report->status ==4) 
                                        @php echo "Rejected" @endphp
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('admin.viewRescueReport', $report->id)}}" class="btn btn-light btn-view" title="View"><i class="fa fa-eye"></i></a>

                                    @if($report->status !='3')
                                        @if(Auth::user()->type == 3)
                                            <!-- <a href="{{route('admin.editRescueReport', $report->id)}}" class="btn btn-light btn-edit" title="Edit"><i class="fas fa-pencil-alt"></i> &nbsp;</a> -->
                                            <!-- <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('admin.deleteRescueReport', $report->id)}}" class="btn btn-light btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a> -->
                                        @endif
                                    @endif
                                    @if($report->status =='3')
                                        <a style="cursor:pointer" id="{{route('admin.downloadRescueReport', $report->id)}}" data-id="{{ $report->rescue_report_no }}" class="btn btn-light btn-view generatePdfBtn" title="Download" target="_blank"><i class="fa fa-download"></i> &nbsp;</a>
                                    @endif

                                    @if(Auth::user()->type==3)
                                        @if($report->bill_generated==0)
                                            <a href="{{ route('service-bills.report.create',['service_type'=>'rescue_report','request_id'=>$report->id]) }}" class="btn btn-warning btn-sm">Generate Bill </a>
                                        @elseif($report->payment_status=='pending')
                                            <a href="{{ route('service-bills.show',$report->service_bill_id) }}" class="btn btn-info btn-sm" target="_blank"> View Bill & Pay </a>
                                        @elseif($report->payment_status=='paid')
                                            <a href="{{ route('service-bills.show',$report->service_bill_id) }}" class="btn btn-primary btn-sm" target="_blank"> View Invoice </a>
                                            <a href="{{ route('service-bills.print',$report->service_bill_id) }}"
                                            class="btn btn-success btn-sm" target="_blank"> Download Invoice </a>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')

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


<!-- Load html2canvas (Compatible version) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<!-- Load html2pdf (Compatible version) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
    $(document).on('click', '.generatePdfBtn', function () {
        const url = $(this).attr('id');
        const application_no = $(this).attr('data-id');
        fetch(url) // Fetch the Fire Report Page
            .then(response => response.text()) // Convert to text (HTML)
            .then(html => {
                let parser = new DOMParser();
                let doc = parser.parseFromString(html, 'text/html'); // Parse HTML
                let content = doc.getElementById('content'); // Get the #content div

                if (!content) {
                    alert("Error: Content not found on the Fire Report page!");
                    return;
                }

                const options = {
                    filename: 'rescue_report_'+ application_no +'.pdf',
                    image: { type: 'jpeg', quality: 1 },
                    html2canvas: { scale: 2, useCORS: true },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                html2pdf().from(content).set(options).toPdf().get('pdf').then(function(pdf) {
                    let pdfFile = pdf.output('blob'); // Create a PDF blob
                    let pdfURL = URL.createObjectURL(pdfFile); // Convert to a URL
                    let a = document.createElement('a');
                    a.href = pdfURL;
                    a.download = 'rescue_report_'+ application_no +'.pdf'; // Force download
                    document.body.appendChild(a);
                    a.click(); // Auto-download PDF
                    document.body.removeChild(a); // Clean up
                });
            })
            .catch(error => console.error('Error fetching Fire Report:', error));
    });
</script>
<script>

   $(document).ready(function () {

        function loadStations(districtId, selectedStation = '') {
            if (!districtId) return;

            $.ajax({
                url: '{{ route("admin.getfirestation") }}',
                type: 'POST',
                data: {
                    districts: districtId,
                    _token: '{{ csrf_token() }}'
                },
                success: function (resp) {
                    let station = '<option value="">All Station</option>';

                    if (resp.status === 0) {
                        station += '<option value="">No station found</option>';
                    } else {
                        $.each(resp.data, function (key, value) {
                            let selected = (value.id == selectedStation) ? 'selected' : '';
                            station += `<option value="${value.id}" ${selected}>${value.name}</option>`;
                        });
                    }

                    $('#filter_station').html(station);
                }
            });
        }

        // 🔥 AUTO LOAD for CFO / page reload
        let districtId = $('#filter_district').val();
        let selectedStation = "{{ request('station') }}";

        if (districtId) {
            loadStations(districtId, selectedStation);
        }

        // 🔁 On change
        $(document).on('change', '#filter_district', function () {
            loadStations($(this).val());
        });

    });

    $('#filterForm').on('submit', function () {

        $(this).find(':input').each(function () {

            if (
                !$(this).val()
                && $(this).attr('type') != 'submit'
            ) {
                $(this).prop('disabled', true);
            }

        });

    });

</script>
@stop
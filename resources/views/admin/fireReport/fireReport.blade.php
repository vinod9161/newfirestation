@extends('layouts.admin.template')
@section('title')
<title>Fire Report</title>
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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Fire Reports</h5>
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
            <a href="<?php echo route('admin.addFireReport'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Fire Report
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
                        action="{{ route('admin.fire_report') }}"
                        id="filterForm">

                        <div class="row">

                            <!-- Fire Report No -->
                            <div class="col-md-3 mb-3">
                                <label>Fire Report No</label>

                                <input type="text"
                                    class="form-control"
                                    name="fire_report_no"
                                    value="{{ request('fire_report_no') }}">
                            </div>

                            <!-- District -->
                            <div class="col-md-3 mb-3">
                                <label>District</label>

                                <select class="form-control" name="district_id" id="filter_district">

                                    <option value="">Select District</option>

                                    @foreach($districts as $district)

                                        <option value="{{ $district->id }}"
                                            {{ request('district_id') == $district->id ? 'selected' : '' }}>

                                            {{ $district->name }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                            <!-- Fire Station -->
                            <div class="col-md-3 mb-3">
                                <label>Fire Station</label>

                                <select class="form-control" name="station_id" id="filter_station">

                                    <option value="">Select Fire Station</option>

                                    @foreach($stations as $station)

                                        <option value="{{ $station->id }}"
                                            {{ request('station_id') == $station->id ? 'selected' : '' }}>

                                            {{ $station->name }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                            <!-- Category -->
                            <div class="col-md-3 mb-3">
                                <label>Category</label>

                                <select class="form-control" name="category" id="filter_category">

                                    <option value="">Select Category</option>

                                    @foreach($categories as $category)

                                        <option value="{{ $category->id }}"
                                            {{ request('category') == $category->id ? 'selected' : '' }}>

                                            {{ $category->name }}

                                        </option>

                                    @endforeach

                                </select>
                            </div>

                        </div>

                        <div class="row">

                            <!-- Fire Type -->
                            <div class="col-md-3 mb-3">
                                <label>Type of Fire</label>

                                <select class="form-control" name="fire_area_type" id="filter_fire_area_type">

                                    <option value="">Select Fire Type</option>

                                    <option value="1"
                                        {{ request('fire_area_type') == '1' ? 'selected' : '' }}>
                                        Commercial
                                    </option>

                                    <option value="2"
                                        {{ request('fire_area_type') == '2' ? 'selected' : '' }}>
                                        Residential
                                    </option>

                                    <option value="3"
                                        {{ request('fire_area_type') == '3' ? 'selected' : '' }}>
                                        High Rise
                                    </option>

                                    <option value="4"
                                        {{ request('fire_area_type') == '4' ? 'selected' : '' }}>
                                        Forest
                                    </option>

                                    <option value="5"
                                        {{ request('fire_area_type') == '5' ? 'selected' : '' }}>
                                        Farm
                                    </option>

                                    <option value="6"
                                        {{ request('fire_area_type') == '6' ? 'selected' : '' }}>
                                        Industry
                                    </option>

                                    <option value="7"
                                        {{ request('fire_area_type') == '7' ? 'selected' : '' }}>
                                        Vehicle
                                    </option>

                                    <option value="8"
                                        {{ request('fire_area_type') == '8' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>
                            </div>


                            <!-- Status -->
                            <div class="col-md-3 mb-3">
                                <label>Status</label>

                                <select class="form-control" name="status" id="filter_status">

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

                            

                            <!-- Buttons -->
                            <div class="col-md-12 mb-3 d-flex align-items-end justify-content-end">

                                <button type="submit"
                                        class="btn btn-primary me-2">
                                    Filter
                                </button>

                                <a href="{{ route('admin.fire_report') }}"
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
                    Fire Report List
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
                            <tr role="row">
                                <th>S No.</th>
                                <th>Fire Report Number</th>
                                <th>District</th>
                                <th>Fire Station</th>
                                <th>Category</th>
                                <th>Type of Fire</th>
                                <th>Class of Fire</th>
                                <th>Area of Fire</th>
                                <th>Current Status</th>
                                <th>Date of Incident</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fs_fire_report as $key => $report)
                            
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $report->fire_report_no }}</td>
                                <td>{{ $report->districts_name }}</td>
                                <td>{{ $report->fire_station_name }}</td>
                                <td>
                                    
                                    <?php 
                                        if($report->category == '1')
                                        {
                                            echo "Small Fire लघु अग्निकाण्ड";   
                                        }
                                        else if($report->category == '2')
                                        {
                                            echo "Medium Fire मध्यम अग्निकाण्ड";
                                        }
                                        else if($report->category == '3')
                                        {
                                            echo "Major/special Fire भीषण अग्निकाण्ड";
                                        }
                                        else if($report->category == '4')
                                        {
                                            echo "Serious Fire गम्भीर अग्निकाण्ड";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        if($report->fire_area_type == '1')
                                        {
                                            echo "Commercial";   
                                        }
                                        else if($report->fire_area_type == '2')
                                        {
                                            echo "Residential";
                                        }
                                        else if($report->fire_area_type == '3')
                                        {
                                            echo "High Rise";
                                        }
                                        if($report->fire_area_type == '4')
                                        {
                                            echo "Forest";   
                                        }
                                        else if($report->fire_area_type == '5')
                                        {
                                            echo "Farm";
                                        }
                                        else if($report->fire_area_type == '6')
                                        {
                                            echo "Industry";
                                        }
                                        else if($report->fire_area_type == '7')
                                        {
                                            echo "Vehicle";
                                        }
                                        else if($report->fire_area_type == '8')
                                        {
                                            echo "Other";
                                        }
                                    ?>
                                </td>
                                <td>{{ $report->fire_class }}</td>
                                <td>
                                    @if($report->fire_area ==1)
                                        @php echo "Rural" @endphp
                                    @else
                                        @php echo "City" @endphp
                                    @endif
                                </td>
                                <td>
                                    {{ $report->status == 0 ? 'Fresh Entry' :
                                           ($report->status == 1 ? 'Sent for Approval' :
                                           ($report->status == 2 ? 'Sent for Review' :
                                           ($report->status == 3 ? 'Approved' :
                                           ($report->status == 4 ? 'Rejected' : 'Unknown Status')))) }}
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($report->fire_incident_datetime)->format('d:m:Y H:i:s') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.viewFireReport', $report->id) }}" class="btn btn-sm btn-primary"><i class="fe fe-eye"></i></a>
                                    @if(Auth::user()->type == 0)
                                    <form action="{{ route('admin.deleteFireReport', $report->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endif
                                    @if($report->status =='3')
                                    <a style="cursor:pointer" id="{{route('admin.downloadFireReport', $report->id)}}" data-id="{{ $report->fire_report_no }}" class="btn btn-sm btn-light btn-view generatePdfBtn" title="Download" target="_blank"><i class="fa fa-download"></i> &nbsp;</a>
                                    @endif

                                    @if(Auth::user()->type==3)
                                        @if($report->bill_generated==0)
                                            <a href="{{ route('pumping-bills.create', ['report_id' => $report->id]) }}" class="btn btn-warning btn-sm">Generate Bill </a>
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
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">No fire reports found.</td>
                            </tr>
                            @endforelse
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
                    filename: 'fire_report_'+ application_no +'.pdf',
                    image: { type: 'jpeg', quality: 1 },
                    html2canvas: { scale: 2, useCORS: true },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                html2pdf().from(content).set(options).toPdf().get('pdf').then(function(pdf) {
                    let pdfFile = pdf.output('blob'); // Create a PDF blob
                    let pdfURL = URL.createObjectURL(pdfFile); // Convert to a URL
                    let a = document.createElement('a');
                    a.href = pdfURL;
                    a.download = 'fire_report_'+ application_no +'.pdf'; // Force download
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
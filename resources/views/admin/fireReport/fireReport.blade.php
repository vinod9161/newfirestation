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
                    <!-- <div class="row">
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Page :</label>
                                <input type="text" class="form-control" id="filter_page" placeholder=" Enter Page">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Title :</label>
                                <input type="text" class="form-control" id="filter_title" placeholder=" Enter Title">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Type :</label>
                                <select class="form-control" data-trigger name="choices-single-default" id="filter_type">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="1">Image</option>
                                    <option value="2">Video</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group mb-lg-0">
                                <label>Status :</label>
                                <select class="form-control" data-trigger name="choices-single-default" id="filter_status">
                                    <option value="" style="display:none;"> -- Select An Option -- </option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div> -->

                    <form method="GET" action="{{ route('admin.fire_report') }}">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group mb-lg-0">
                                    <label>From Date</label>
                                    <input type="date"
                                        class="form-control"
                                        name="from_date"
                                        value="{{ request('from_date') }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group mb-lg-0">
                                    <label>To Date</label>
                                    <input type="date"
                                        class="form-control"
                                        name="to_date"
                                        value="{{ request('to_date') }}">
                                </div>
                            </div>

                            <div class="col-md-3 align-self-end">
                                <button type="submit" class="btn btn-primary">
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
@stop
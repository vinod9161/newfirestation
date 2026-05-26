@extends('layouts.admin.template')
@section('title')
<title>All Noc</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<style>
    .bg_red_color
    {
        background-color:#ffb8c5 !important;
    }


    .tableDefault {
        color: #334151;
        border-color: #e9edf4;
        margin-block-end: 0;
    }

    .tableDefault th,
    .tableDefault td {
      padding: 0.65rem;  /* 12px padding like Bootstrap tables */
    }
    .font-bold
    {
        font-weight: bold;
    }
	
	
</style>
@endsection
@section('content')

@php
    use Illuminate\Support\Facades\DB;
@endphp
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage NOC </h5>
    </div>
    <div class="d-flex app-header-btn">
        <div class="me-2">
            <a href="javascript:void(0);" class="btn ripple btn-wave  btn-secondary navresponsive-toggler mb-0"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1 fs-10"></i>
            </a>
        </div>
        <div>
            <!-- <a href="<//?php echo route('admin.addFireReport');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Fire Report
            </a> -->
            <!-- <a href="<?php //echo route('admin.adddistrict'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Noc
            </a> -->
        </div>
    </div>
</div>


<!--Navbar-->
<div class="responsive-background">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="advanced-search br-3">
            <form method="POST" class="advanced-search br-3">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <label class="form-label">From date<span
                                    class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="filter_from_date" placeholder="Subject">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label">To date<span
                                    class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="filter_to_date" placeholder="Subject">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-lg-0">
                                    <label>Application for :</label>
                                    <select class="form-control" name="filter_projects" id="filter_projects" readonly>
                                        <option value="" disabled selected>-- Select An Option --</option>
                                        @foreach($projects as $key => $proj)
                                        <option value="{{ $proj->id }}" @if($noc_type == $proj->entity) selected @endif>{{ $proj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-lg-0">
                                    <label>Building Category :</label>
                                    <select class="form-control" name="filter_category" id="filter_category">
                                        <option value="" disabled selected>-- Select An Option --</option>
                                        @foreach($categories as $key => $cate)
                                        <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group mb-lg-0">
                                    <label>Noc Type :</label>
                                    <select class="form-control" name="filter_noc_type" id="filter_noc_type">
                                        <option value="" disabled selected>-- Select An Option --</option>
                                        <option value="pre establishment noc">Pre Establishment NOC</option>
                                        <option value="pre operational noc">Pre Operational NOC</option>
                                        <option value="renewal noc">Renewal NOC</option>
                                    </select>
                                </div>
                            </div>
							
							<div class="col-md-2">
								<button type="button" class="btn btn-primary" onclick="filter_noc_data();">Apply</button>
								<a href="{{ route('admin.district') }}" class="btn btn-secondary">Reset</a>
							</div>
							
                        </div>
                    </div>
                </div>
                <span id="filtererror" class="error mt-3"></span>
                <input type="hidden" id="current_status" value="{{ request()->status }}">
                <input type="hidden" id="current_type" value="{{ request()->type }}">
                
            </form>

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
                    All Noc
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table id="datatable-basic" class="tableDefault table-bordered text-nowrap w-100">
                        <thead>
                            <tr role="row">
                                <th style="width: 76px;" class="sorting_asc" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-sort="ascending" aria-label="S No.: activate to sort column descending">S No.<div style="height: 25px;"></div></th>
                                
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application Number: activate to sort column ascending" style="width: 134px;">Application Number<div style="height: 25px;"></div></th>
                                
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application Number: activate to sort column ascending" style="width: 134px;">Old Application Number<div style="height: 25px;"></div></th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application Number: activate to sort column ascending" style="width: 134px;">Application Flag<div style="height: 25px;"></div></th>
                               
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application Number: activate to sort column ascending" style="width: 134px;">Application Date<div style="height: 25px;"></div></th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application Number: activate to sort column ascending" style="width: 134px;">Days Since Applied<div style="height: 25px;"></div></th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application For: activate to sort column ascending" style="width: 153px;">Application For<div style="height: 25px;"></div></th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 67px;">Type</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Building Name: activate to sort column ascending" style="width: 67px;">Building Name</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Building Name: activate to sort column ascending" style="width: 67px;">Building Category</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Building Name: activate to sort column ascending" style="width: 67px;">Building Height</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="District: activate to sort column ascending" style="width: 67px;">District</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Fire Station: activate to sort column ascending" style="width: 67px;">Fire Station</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Fire Station: activate to sort column ascending" style="width: 67px;">Expiry Date</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Status: activate to sort column ascending" style="width: 67px;">Status</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Declaration Status: activate to sort column ascending" style="width: 127px;">Declaration Status</th>
                                <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Actions: activate to sort column ascending">Actions<div style="height: 25px;"></div></th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($applications as $application)
                            @php
                                // Determine read status
                                $read = '';
                                if (Auth::user()->type == 0) {
                                    $read = $application->admin_read;
                                } elseif (Auth::user()->type == 1) {
                                    $read = $application->dd_read;
                                } elseif (Auth::user()->type == 2) {
                                    $read = $application->cfo_read;
                                } elseif (Auth::user()->type == 3) {
                                    $read = $application->fso_read;
                                } elseif (Auth::user()->type == 5) {
                                    $read = $application->dm_read;
                                }

                                // Date logic
                                $color = '';
                                $createdDate = new DateTime($application->created_at);
                                $today = new DateTime();
                                $interval = $today->diff($createdDate);
                                $daysOld = $interval->days;

                                // Fix condition logic with AND instead of OR
                                if ($application->status != 'approved' && $application->status != 'processed' && $application->status != 'reverted' && $application->status != 'pre approved') 
                                {
                                    if ($application->application_type == 'pre establishment noc' || $application->application_type == 'renewal') {
                                        if ($interval->invert === 1) {
                                            if ($daysOld >= 13 && $daysOld <= 15) {
                                                $color = 'bg-orange';
                                            } elseif ($daysOld > 15) {
                                                $color = 'bg_red_color';
                                            }
                                        }
                                    } elseif ($application->application_type == 'operational') {
                                        if ($daysOld >= 25 && $daysOld <= 30) {
                                            $color = 'bg_red_color';
                                        }
                                    }
                                }

                                $colorBold = '';
                                if ($application->status == 'pending') {
                                    $colorBold = "font-bold";
                                }

                                // Optimized DB access (optional if $districts is preloaded)
                                $districtName = DB::table('districts')->where('id', $application->district_id)->value('name');

                                // Optimized DB access (optional if $stations is preloaded)
                                $stationName = DB::table('fire_stations')->where('id', $application->station_id)->value('name');

                                // Optimized and safe JSON decode
                                $building_height = json_decode($application->max_height_building, true);
                                $maxHeight = is_array($building_height) ? $building_height['max_height_building'] ?? 'NA' : 'NA';

                                // Optional: preload category too
                                $building_category = DB::table('categories')->where('id', $application->category_id)->value('name');

                                

                               


                                if ($application->status != 'approved') {

                                    if (!empty($application->submitted_at)) {

                                        // submitted_at is a string like: 2025-12-26 20:56:33
                                        $submittedAt = new DateTime($application->submitted_at);
                                        $today = new DateTime();

                                        $interval = $submittedAt->diff($today);

                                        $parts = [];

                                        if ($interval->y > 0) {
                                            $parts[] = $interval->y . ' ' . ($interval->y == 1 ? 'year' : 'years');
                                        }
                                        if ($interval->m > 0) {
                                            $parts[] = $interval->m . ' ' . ($interval->m == 1 ? 'month' : 'months');
                                        }
                                        if ($interval->d > 0 || empty($parts)) {
                                            $parts[] = $interval->d . ' ' . ($interval->d == 1 ? 'day' : 'days');
                                        }

                                        $daysDiff = implode(', ', $parts);

                                    } else {
                                        // Not finally submitted yet
                                        $daysDiff = 'NA';
                                    }
                                }




                            @endphp

                            <tr class="my-job-item text-center {{ $color }} @if ($read != '1') application-read @endif">
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}" style="width: 9%;">{{ $i }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ $application->application_no ?? 'NA' }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">

                                    @if($application->old_application_no != null)
                                        @php
                                        $old_application_id = DB::table('applications')->where('application_no', $application->old_application_no)->value('id');
                                        @endphp 
                                        <a href="{{ route('admin.adminviewNocDetail', $old_application_id) }}" class="btn btn-primary btn-sm btn-edit" title="View">{{ $application->old_application_no ?? 'NA' }}</a>
                                    @else
                                        -----    
                                    @endif
                                    
                                    
                                </td>

                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">

                                    @php
                                        $title = '1 = New Pre Establishment, 2 = New Manual Pre Operational, 3 = Pre Operational for Existing Establishment, 4 = Renewal for Operational';
                                    @endphp

                                    @if($application->application_flag!= null)
                                        <!-- <a href="#" title="View">
                                            <i class="fa fa-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $title ?? '-----' }}"></i>
                                        </a> -->
                                        @if ($application->application_flag == '1')
                                            New Pre Establishment
                                        @elseif ($application->application_flag == '2')
                                            New Manual Pre Operational
                                        @elseif ($application->application_flag == '3')
                                            Pre Operational for Existing Establishment
                                        @elseif ($application->application_flag == '4')
                                            Renewal for Operational
                                        @else
                                            -----
                                        @endif
                                    @else
                                        -----
                                    @endif

                                    
                                   
                                    
                                </td>

                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ $application->created_at ? $application->created_at->format('d-m-Y H:i:s') : 'NA' }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ $daysDiff ??'NA'  }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">
                                    @if ($application->noc_type == 'building')
                                        Noc For Building
                                    @elseif ($application->noc_type == 'cinema_hall_multiplex')
                                        Noc For Cinema Hall- Multiplex
                                    @elseif ($application->noc_type == 'fire_arms_repair')
                                        Noc For Fire Arms Repair
                                    @elseif ($application->noc_type == 'fire_arms_selling')
                                        Noc For Fire Arms Selling
                                    @elseif ($application->noc_type == 'fire_arms_storage')
                                        Noc For Fire Arms Storage
                                    @elseif ($application->noc_type == 'gas_warehouse')
                                        Noc For Gas Warehouse and Agency
                                    @elseif ($application->noc_type == 'gas_oil_depot')
                                        Noc For Gas-Oil-Depot
                                    @elseif ($application->noc_type == 'sale_of_sulphur')
                                        Noc For Sale Of Sulphur
                                    @elseif ($application->noc_type == 'storage_magazine')
                                        Noc For Storage - Magazine
                                    @elseif ($application->noc_type == 'petrol_pump_cng_station')
                                        Noc For Petrol Pump-CNG Station
                                    @elseif ($application->noc_type == 'fire_works')
                                        Noc For Fire Works
                                    @else
                                        NA
                                    @endif
                                </td>

                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ ucwords($application->application_type ?? 'NA') }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ ucwords($application->building_name ?? 'NA') }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ ucwords($building_category ?? 'NA') }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ $maxHeight }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ ucwords($districtName ?? 'NA') }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">{{ ucwords($stationName ?? 'NA') }}</td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">
                                    @php
                                        $validityDate = $application->updated_at;
                                        $valid_date = strtotime($validityDate);
                                        $noc_validity = $application->validity;
                                        $current_date = time();
                                        $exp_date = 'NA';
                                        $days_until_expiry = null;
                                        
                                        if ($noc_validity == 3) {
                                            $exp_date = strtotime('+3 years', $valid_date);
                                        } elseif ($noc_validity == 5) {
                                            $exp_date = strtotime('+5 years', $valid_date);
                                        }
                                        
                                        // Calculate days until expiration
                                        if ($exp_date !== 'NA') {
                                            $days_until_expiry = floor(($exp_date - $current_date) / (60 * 60 * 24));
                                        }
                                        
                                        // Check if days until expiry is within 90 days and not expired
                                        $display_expiry = ($days_until_expiry !== null && $days_until_expiry <= 90 && $days_until_expiry > 0);
                                    @endphp

                                    @if($exp_date !== 'NA' && $display_expiry)
                                        {{ date('d-M-Y', $exp_date) }} ({{ $days_until_expiry }} days left)
                                    @else
                                        {{ 'NA' }}
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">
                                    @if ($application->status == 'pending')
                                        New
                                    @elseif ($application->status == 'processed')
                                        Verifier Assign
                                    @elseif ($application->status == 'for approval')
                                        Verified
                                    @elseif ($application->status == 'pre approval')
                                        For Pre Approval
                                    @elseif ($application->status == 'pre approved')
                                        Pre Approved
                                    @elseif ($application->status == 'reverted')
                                        Reverted
                                    @elseif ($application->status == 'approved')
                                        Approved
                                    @else
                                        NA
                                    @endif
                                </td>
                                <td class="d-none d-xl-table-cell text-center number-application {{ $colorBold }}">
                                    {{ $application->declaration_status ?? 'Valid' }}
                                </td>
                                <td class="d-none d-md-table-cell text-right">
                                    <a href="{{ route('admin.adminviewNocDetail', $application->id) }}" class="btn btn-primary btn-sm btn-edit" title="View"><i class="fa fa-eye"></i></a>
                                    @if ($application->status == 'approved')
                                    <a href="{{ route('noc.download', $application->id) }}" class="btn btn-dark btn-sm btn-delete" title="Download NOC" target="_blank"><i class="fa fa-print"></i></a>
                                    {{-- <a onclick="return confirm('Are you sure you want to download NOC?')" id="{{ route('noc.download', $application->id) }}" class="btn btn-dark btn-sm btn-delete generatePdfBtn" title="Download NOC" target="_blank" data-id="{{ $application->application_no ?? 'NA' }}"><i class="fa fa-download"></i></a> --}}
                                    @endif
                                </td>
                            </tr>
                            @php $i++; @endphp
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
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
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
                        filename: 'noc_report_'+ application_no +'.pdf',
                        image: { type: 'jpeg', quality: 1 },
                        html2canvas: { scale: 2, useCORS: true },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                    };

                    html2pdf().from(content).set(options).toPdf().get('pdf').then(function(pdf) {
                        let pdfFile = pdf.output('blob'); // Create a PDF blob
                        let pdfURL = URL.createObjectURL(pdfFile); // Convert to a URL
                        let a = document.createElement('a');
                        a.href = pdfURL;
                        a.download = 'noc_report_'+ application_no +'.pdf'; // Force download
                        document.body.appendChild(a);
                        a.click(); // Auto-download PDF
                        document.body.removeChild(a); // Clean up
                    });
                })
                .catch(error => console.error('Error fetching Fire Report:', error));
        });
    });

    function filter_noc_data() {
        $('#filtererror').empty();
        var _token = $('input[name="_token"]').val();
        var filter_from_date = document.getElementById('filter_from_date').value;
        var filter_to_date = document.getElementById('filter_to_date').value;
        var filter_projects = document.getElementById('filter_projects').value;
        var filter_category = document.getElementById('filter_category').value;
        var filter_noc_type = document.getElementById('filter_noc_type').value;

        if (filter_from_date == '' && filter_to_date == '' && filter_projects == '' && filter_category == '' && filter_noc_type == '') {
            $('#filtererror').append("Please Select at least one field from Filters");
            return false;
        } else {
            $('#datatable-2_paginate').empty();
            var employeeData = $('#datatable-basic').DataTable({
                processing: true,
                serverSide: true,
                destroy: true, // better than bDestroy
                searching: false,
                order: [],
                pageLength: 10,

                ajax: {
                    url: "{{ route('admin.filter_noc_data') }}",
                    type: "POST",
                    data: function(d) {
                        d._token = $('input[name="_token"]').val();
                        d.filter_from_date = $('#filter_from_date').val();
                        d.filter_to_date = $('#filter_to_date').val();
                        d.filter_projects = $('#filter_projects').val();
                        d.filter_category = $('#filter_category').val();
                        d.filter_noc_type = $('#filter_noc_type').val();

                        d.current_status = $('#current_status').val();
                        d.current_type = $('#current_type').val();
                    }
                },

                columnDefs: [
                    {
                        targets: "_all",
                        orderable: false
                    }
                ],

                createdRow: function(row, data) {
                    if (data[data.length - 1] === 'highlight-red') {
                        $(row).addClass('bg_red_color');
                    } else if (data[data.length - 1] === 'highlight-orange') {
                        $(row).addClass('bg-orange');
                    }
                }
            });
        }
    }
</script>
@stop
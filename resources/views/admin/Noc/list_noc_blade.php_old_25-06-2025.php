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
        background-color:#ff0000 !important;
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
                            <div class="mb-3 col-md-3">
                                <label class="form-label">From date<span
                                    class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="filter_from_date" placeholder="Subject">
                            </div>
                            <div class="mb-3 col-md-3">
                                <label class="form-label">To date<span
                                    class="text-danger">*</span></label>
                                <input type="date" class="form-control" id="filter_to_date" placeholder="Subject">
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-lg-0">
                                    <label>Application for :</label>
                                    <select class="form-control" name="filter_projects" id="filter_projects">
                                        <option value="" disabled selected>-- Select An Option --</option>
                                        @foreach($projects as $key => $proj)
                                        <option value="{{ $proj->id }}">{{ $proj->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                        </div>
                    </div>
                </div>
                <span id="filtererror" class="error mt-3"></span>
                <hr>
                <div class="text-end">
                    <button type="button" class="btn btn-primary" onclick="filter_noc_data();">Apply</button>
                    <a href="{{ route('admin.district') }}" class="btn btn-secondary">Reset</a>
                </div>
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
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application Number: activate to sort column ascending" style="width: 134px;">Application Date<div style="height: 25px;"></div></th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Application For: activate to sort column ascending" style="width: 153px;">Application For<div style="height: 25px;"></div></th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Type: activate to sort column ascending" style="width: 67px;">Type</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Building Name: activate to sort column ascending" style="width: 67px;">Building Name</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Building Name: activate to sort column ascending" style="width: 67px;">Building Category</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Building Name: activate to sort column ascending" style="width: 67px;">Building Height</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="District: activate to sort column ascending" style="width: 67px;">District</th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1" aria-label="Fire Station: activate to sort column ascending" style="width: 67px;">Fire Station</th>
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

                                    $color = '';
                                    if ($application->status == '') 
                                    {
                                        $createdDate = new DateTime($application->created_at);
                                        $today = new DateTime();
                                        $interval = $today->diff($createdDate);
                                        $daysOld = $interval->days;

                                        

                                        if ($interval->invert === 1)
                                        {
                                            if ($daysOld >= 25 && $daysOld <= 30)
                                            {
                                                $color = 'bg_red_color';
                                            } 
                                            else if ($daysOld >= 13 && $daysOld <= 15)
                                            {
                                                $color = 'bg-orange';
                                            }
                                        }
                                    }

                                    $colorBold = '';
                                    if ($application->status == 'pending') {
                                        
                                        $colorBold = "font-bold";
                                    }


                                    $districtName = DB::table('districts')->where('id', $application->district_id)->value('name');
                                @endphp
                                <tr class="my-job-item text-center <?= $color; ?> @if ($read != '1') application-read @endif">
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>" style="width: 9%;">{{ $i }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">{{ $application->application_no ?? 'NA' }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>"> {{ $application->created_at ? $application->created_at->format('d-m-Y H:i:s') : 'NA' }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">
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

                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">{{ ucwords($application->application_type ?? 'NA') }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">{{ ucwords($application->building_name ?? 'NA') }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">
                                       @php
                                            $building_category = DB::table('categories')->where('id', $application->category_id)->value('name');
                                        @endphp

                                        {{ ucwords($building_category ?? 'NA') }}
                                    </td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">

                                        @php
                                            $building_height = json_decode($application->max_height_building, true);
                                        @endphp

                                        {{ $building_height['max_height_building'] ?? 'NA' }}


                                    </td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">{{ ucwords($districtName ?? 'NA') }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">{{ ucwords($application->fire_station ?? 'NA') }}</td>
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">
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
                                    <td class="d-none d-xl-table-cell text-center number-application <?= $colorBold; ?>">
                                        {{ $application->declaration_status ?? 'Valid' }}
                                    </td>
                                    <td class="d-none d-md-table-cell text-right">
                                        <a href="{{ route('admin.adminviewNocDetail', $application->id) }}" class="btn btn-primary btn-sm btn-edit" title="View"><i class="fa fa-eye"></i></a>
                                        @if ($application->status == 'approved')
                                            <a onclick="return confirm('Are you sure you want to download NOC?')" id="{{ route('noc.download', $application->id) }}" class="btn btn-dark btn-sm btn-delete generatePdfBtn" title="Download NOC" target="_blank" data-id="{{ $application->application_no ?? 'NA' }}"><i class="fa fa-download"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
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

        if (filter_from_date == '' && filter_to_date == '' && filter_projects == '' && filter_category == '') {
            $('#filtererror').append("Please Select at least one field from Filters");
            return false;
        } else {
            $('#datatable-2_paginate').empty();
            var employeeData = $('#datatable-basic').DataTable({
                "lengthChange": false,
                "processing": true,
                "serverSide": true,
                "order": [],
                "lengthMenu": [10, 20, 50, 100, 500],
                "bDestroy": true,
                "searching": false,
                "ajax": {
                    url: "{{ route('admin.filter_noc_data') }}",
                    type: "POST",
                    data: {
                        _token: _token,
                        filter_from_date: filter_from_date,
                        filter_to_date: filter_to_date,
                        filter_projects: filter_projects,
                        filter_category: filter_category
                    },
                    dataType: "json",
                },
                "columnDefs": [
                    {
                        "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                        "visible": true,
                        "orderable": false,
                    },
                ],
                "dom": 'lBfrtip',
                "buttons": [
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5',
                    'copyHtml5',
                    'print'
                ],
                "pageLength": 10,
                "createdRow": function(row, data, dataIndex) {
                    if (data[data.length - 1] === 'highlight-red')
                    {
                        $(row).addClass('bg_red_color');
                    }
                    else if(data[data.length - 1] === 'highlight-orange')
                    {
                        $(row).addClass('bg-orange');
                    }
                }
            });
        }
    }
</script>
@stop
@extends('layouts.admin.template')
@section('title')
<title>Relief Report | Uttrakhand Fireservice</title>
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
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1 fs-10"></i>
            </a>
        </div>

         @if(Auth::user()->type == 3)
        <div>
            <a href="{{route('admin.addReliefReport')}}" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Relief Report
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
                            action="{{ route('admin.reliefReport') }}"
                            id="filterForm">

                        <div class="row">

                            <!-- Relief Report Number -->
                            <div class="col-md-3 mb-3">
                                <label>Relief Report No</label>

                                <input type="text"
                                        class="form-control"
                                        name="relief_report_no"
                                        value="{{ request('relief_report_no') }}">
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

                            <!-- Relief Work Type -->
                            <div class="col-md-3 mb-3">
                                <label>Relief Work Type</label>

                                <select class="form-control" name="relief_work_type">

                                    <option value="">Select Relief Work Type</option>

                                    <option value="1"
                                        {{ request('relief_work_type') == '1' ? 'selected' : '' }}>
                                        Disaster Dewatering
                                    </option>

                                    <option value="2"
                                        {{ request('relief_work_type') == '2' ? 'selected' : '' }}>
                                        Removing Fallen Tree
                                    </option>

                                    <option value="3"
                                        {{ request('relief_work_type') == '3' ? 'selected' : '' }}>
                                        Clear the Passage
                                    </option>

                                    <option value="4"
                                        {{ request('relief_work_type') == '4' ? 'selected' : '' }}>
                                        Distribution of Relief Goods
                                    </option>

                                    <option value="5"
                                        {{ request('relief_work_type') == '5' ? 'selected' : '' }}>
                                        Organising Public Kitchen
                                    </option>

                                    <option value="6"
                                        {{ request('relief_work_type') == '6' ? 'selected' : '' }}>
                                        Distribution of Medicine
                                    </option>

                                    <option value="7"
                                        {{ request('relief_work_type') == '7' ? 'selected' : '' }}>
                                        Counseling of Victims
                                    </option>

                                    <option value="8"
                                        {{ request('relief_work_type') == '8' ? 'selected' : '' }}>
                                        Safely Evacuation
                                    </option>

                                    <option value="9"
                                        {{ request('relief_work_type') == '9' ? 'selected' : '' }}>
                                        Other
                                    </option>

                                </select>
                            </div>

                        </div>

                        <div class="row">

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

                            <!-- Buttons -->
                            <div class="col-md-3 mb-3 d-flex align-items-end">

                                <button type="submit"
                                        class="btn btn-primary me-2">
                                    Filter
                                </button>

                                <a href="{{ route('admin.reliefReport') }}"
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
                    Relief Report List
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
                            <th style="width: 76px;" class="sorting_asc" tabindex="0" aria-controls="relief-table"
                                rowspan="1" colspan="1" aria-sort="ascending"
                                aria-label="S No.: activate to sort column descending">S No.<div style="height: 25px;">
                                </div>
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Relief Report No.: activate to sort column ascending" style="width: 71px;">
                                Relief Report No.</th>
                            <th class="sorting" tabindex="0" aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Relief Report No.: activate to sort column ascending" style="width: 71px;">
                                District</th>
                            <th class="sorting" tabindex="0" aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Date and Time Of Relief Work: activate to sort column ascending"
                                style="width: 104px;">Date and Time Of Relief Work</th>
                            <th class="sorting" tabindex="0" aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Relief Wrok Station: activate to sort column ascending"
                                style="width: 90px;">Relief Wrok Station</th>
                            <th class="sorting" tabindex="0" aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Address Of Incident Place: activate to sort column ascending"
                                style="width: 129px;">Address Of Incident Place</th>
                            <th class="sorting" tabindex="0" aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Type Of Relief Work: activate to sort column ascending"
                                style="width: 135px;">Type Of Relief Work</th>
                            <th class="sorting" tabindex="0" aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Current Status: activate to sort column ascending" style="width: 74px;">
                                Current Status</th>
                            <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;" tabindex="0"
                                aria-controls="relief-table" rowspan="1" colspan="1"
                                aria-label="Actions: activate to sort column ascending">Actions<div
                                    style="height: 25px;"></div>
                            </th>
                        </tr>
                        </thead>
                        <tbody>

                            @forelse ($fs_relief_report as $index => $relief)
                                <tr>
                                    <td>{{ $index + 1 }}</td> 
                                    <td>{{ $relief->relief_report_no }}</td>
                                    <td>{{ $relief->district_name ?? 'NA' }}</td> 
                                    <td>{{ $relief->created_at }}</td> 
                                    <td>{{ $relief->fire_station_name }}</td> 
                                    <td>{{ $relief->incident_address }}</td> 
                                    <td>
                                         @if($relief->relief_work_type ==1)
                                         @php echo "Disaster Dewatering आपदा में पानी निकलना" @endphp
                                         @elseif($relief->relief_work_type ==2) 
                                         @php echo "Removing Fallen tree गिरे पेड़ो को हटाना" @endphp
                                         @elseif($relief->relief_work_type ==3) 
                                         @php echo "Clear the passage पेड़ो को हटाकर रास्ता सुचारू करना" @endphp
                                         @elseif($relief->relief_work_type ==4) 
                                         @php echo "Distribution of relief goods राहत सामग्री का वितरण" @endphp
                                         @elseif($relief->relief_work_type ==5) 
                                         @php echo "Organising a public kitchen आम जनता हेतु भोजन प्रबन्धन" @endphp
                                         @elseif($relief->relief_work_type ==6) 
                                         @php echo "Distribution of medicine आवश्यक दवाइयों का वितरण" @endphp
                                         @elseif($relief->relief_work_type ==7) 
                                         @php echo "Counseling of victims घायलों की काउंसलिंग" @endphp
                                         @elseif($relief->relief_work_type ==8) 
                                         @php echo "Safely evacuation of people from  denger zone जोन में लोगों को सुरक्षित पार कराना" @endphp
                                         @else
                                         @php echo "Other अन्य" @endphp
                                         @endif
                                      </td>
                                      <td>
                                         @if($relief->status ==0)
                                         @php echo "Fresh Entry" @endphp
                                         @elseif($relief->status ==1) 
                                         @php echo "Sent for Approval" @endphp
                                         @elseif($relief->status ==2) 
                                         @php echo "Sent for Review" @endphp
                                         @elseif($relief->status ==3) 
                                         @php echo "Approved" @endphp
                                         @elseif($relief->status ==4) 
                                         @php echo "Rejected" @endphp
                                         @endif
                                      </td>
                                    <td class="text-right">
                                        <a href="{{ route('admin.viewReliefReport', $relief->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>

                                        <!-- 
                                        <form action="{{ route('admin.deleteReliefReport', $relief->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                        </form> -->

                                        @if($relief->status =='3')
                                         <a style="cursor:pointer" id="{{route('admin.reliefReport.download', $relief->id)}}" data-id="{{ $relief->relief_report_no }}" class="btn btn-sm btn-light btn-view generatePdfBtn" title="Download" target="_blank"><i class="fa fa-download"></i> &nbsp;</a>
                                        @endif

                                        @if(Auth::user()->type == 3)

                                            <a href="{{ route('service-bills.report.create',['service_type'=>'relief_report','request_id'=>$relief->relief_report_no]) }}"
                                            class="btn btn-warning btn-sm">

                                            Generate Bill

                                            </a>

                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9">No relief reports found.</td>
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
                    filename: 'relief_report_'+ application_no +'.pdf',
                    image: { type: 'jpeg', quality: 1 },
                    html2canvas: { scale: 2, useCORS: true },
                    jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                };

                html2pdf().from(content).set(options).toPdf().get('pdf').then(function(pdf) {
                    let pdfFile = pdf.output('blob'); // Create a PDF blob
                    let pdfURL = URL.createObjectURL(pdfFile); // Convert to a URL
                    let a = document.createElement('a');
                    a.href = pdfURL;
                    a.download = 'relief_report_'+ application_no +'.pdf'; // Force download
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
@extends('layouts.admin.template')
@section('title')
<title>Categories | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
   <div>
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Fire / Rescue / Other Incident Report Requests</h5>
   </div>
   <div class="d-flex app-header-btn">
      <div class="me-2">
         <a href="javascript:void(0);"
            class="btn ripple btn-wave btn-secondary navresponsive-toggler mb-0"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">

            <i class="fe fe-filter me-1"></i>
            Filter
            <i class="fa fa-caret-down ms-1 fs-10"></i>

         </a>
      </div>
      <div>
         <a href="<?php echo route('admin.addIncident'); ?>" class="btn ripple btn-wave  btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Incident Report
         </a>
      </div>
   </div>
</div>


<div class="responsive-background mb-3">

    <div class="collapse navbar-collapse"
         id="navbarSupportedContent">

        <div class="advanced-search br-3 p-3">

            <form method="GET"
                  action="{{ url()->current() }}"
                  id="filterForm">

                <div class="row">

                    <!-- Report Type -->
                    <div class="col-md-2 mb-3">

                        <input type="text"
                               name="report_type"
                               class="form-control"
                               placeholder="Report Type"
                               value="{{ request('report_type') }}">

                    </div>

                    <!-- Name -->
                    <div class="col-md-2 mb-3">

                        <input type="text"
                               name="name"
                               class="form-control"
                               placeholder="Person/Institution"
                               value="{{ request('name') }}">

                    </div>

                    <!-- Mobile -->
                    <div class="col-md-2 mb-3">

                        <input type="text"
                               name="mobile_no"
                               class="form-control"
                               placeholder="Mobile No"
                               value="{{ request('mobile_no') }}">

                    </div>

                    <!-- District -->
                    <div class="col-md-2 mb-3">

                        <select name="district"
                                class="form-control">

                            <option value="">All District</option>

                            @foreach($district as $dist)

                                <option value="{{ $dist->id }}"
                                    {{ request('district') == $dist->id ? 'selected' : '' }}>

                                    {{ $dist->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- Status -->
                    <div class="col-md-2 mb-3">

                        <select name="status"
                                class="form-control">

                            <option value="">Status</option>

                            <option value="0"
                                {{ request('status') == '0' ? 'selected' : '' }}>
                                Not Assigned
                            </option>

                            <option value="1"
                                {{ request('status') == '1' ? 'selected' : '' }}>
                                Assigned And Approved
                            </option>

                            <option value="2"
                                {{ request('status') == '2' ? 'selected' : '' }}>
                                Rejected
                            </option>

                            <option value="3"
                                {{ request('status') == '3' ? 'selected' : '' }}>
                                Need Reassignment
                            </option>

                            <option value="4"
                                {{ request('status') == '4' ? 'selected' : '' }}>
                                Complete
                            </option>

                        </select>

                    </div>

                    <!-- Assignee Response -->
                    <div class="col-md-2 mb-3">

                        <select name="assignee_response"
                                class="form-control">

                            <option value="">Assignee Response</option>

                            <option value="0"
                                {{ request('assignee_response') == '0' ? 'selected' : '' }}>
                                No Response
                            </option>

                            <option value="1"
                                {{ request('assignee_response') == '1' ? 'selected' : '' }}>
                                Reschedule
                            </option>

                            <option value="2"
                                {{ request('assignee_response') == '2' ? 'selected' : '' }}>
                                Not Available
                            </option>

                            <option value="3"
                                {{ request('assignee_response') == '3' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>

                </div>

                <div class="row">

                    <!-- From Date -->
                    <div class="col-md-3 mb-3">

                        <input type="date"
                               name="from_date"
                               class="form-control"
                               value="{{ request('from_date') }}">

                    </div>

                    <!-- To Date -->
                    <div class="col-md-3 mb-3">

                        <input type="date"
                               name="to_date"
                               class="form-control"
                               value="{{ request('to_date') }}">

                    </div>

                    <!-- Buttons -->
                    <div class="col-md-6 text-end">

                        <button type="submit"
                                class="btn btn-primary">
                            Apply
                        </button>

                        <a href="{{ url()->current() }}"
                           class="btn btn-secondary">
                           Reset
                        </a>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>
<!-- Start::row-2 -->

<div class="row">
   <div class="col-xl-12">
      <div class="card custom-card">
         <div class="card-header">
            <div class="card-title">
                Fire / Rescue / Other Incident Report Requests
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               @if (session('success'))
               <div class="alert alert-success">
                  {{ session('success') }}
               </div>
               @endif

               @if (session('failed'))
               <div class="alert alert-danger">
                  {{ session('failed') }}
               </div>
               @endif
               <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                  <thead>
                     <tr role="row">
                        <th style="width: 9%;">S No.<div style="height: 25px;"></div></th>
                        <th>Type Of Report</th>
                        <th>Date</th>
                        <th>Name of Person/Institution</th>
                        <th>Contact Person</th>
                        <th>Mobile No.</th>
                        <th>District</th>
                        <th>Current Status</th>
                        <th>Assignee's Response</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($incident as $index => $inc)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{$inc->report_type}}</td>
                        <td>{{$inc->date}}</td>
                        <td>{{$inc->name}}</td>
                        <td>{{$inc->contact_person}}</td>
                        <td>{{$inc->mobile_no}}</td>
                        <td>
                           @foreach($district as $key => $dist)
                              @if($dist->id == $inc->district_id)
                                 {{ $dist->name }}
                              @endif
                           @endforeach
                        </td>
                        <td>
                            @if($inc->status ==0)
                                @php echo "Not Assigned" @endphp
                            @elseif($inc->status ==1)
                                @php echo "Assigned And Approved" @endphp
                            @elseif($inc->status ==2)
                                @php echo "Rejected" @endphp
                            @elseif($inc->status ==3)
                                @php echo "Need Reassignment" @endphp
                            @elseif($inc->status ==4)
                                @php echo "complete" @endphp
                            @endif
                        </td>

                        <td>
                            @if($inc->assignee_response ==0)
                                @php echo "No Response" @endphp
                            @elseif($inc->assignee_response ==1)
                                @php echo "Reschedule" @endphp
                            @elseif($inc->assignee_response ==2)
                                @php echo "Not Available" @endphp
                            @elseif($inc->assignee_response ==3)
                                @php echo "Other" @endphp
                            @endif
                        </td>
                        <td class="text-center">
                           <a href="{{route('admin.viewIncident', $inc->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> &nbsp;</a>
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
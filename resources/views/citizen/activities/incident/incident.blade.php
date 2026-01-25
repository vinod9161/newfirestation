@extends('layouts.citizen.template')
@section('title')
<title>Incident | Citizen Dashboard</title>
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

      <div>
         <a href="<?php echo route('citizen.addIncident'); ?>" class="btn ripple btn-wave  btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Incident Report
         </a>
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
                           <a href="{{route('citizen.viewIncident', $inc->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> &nbsp;</a>
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
@stop
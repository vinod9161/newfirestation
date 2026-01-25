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
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Standby Duty Request</h5>
   </div>
   <div class="d-flex app-header-btn">

      <div>
         <a href="<?php echo route('admin.addStandby'); ?>" class="btn ripple btn-wave  btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Standby Duty
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
               Standby Duty Request
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
                        <th>Application Id</th>
                        <th>District</th>
                        <th>Type Of Program</th>
                        <th>Program Datetime</th>
                        <th>Name of Person/Institution</th>
                        <th>Address</th>
                        <th>Contact Person</th>
                        <th>Current Status</th>
                        <th>Assignee's Response</th>
                        <th>Reschedule Date</th>
                        <th>Final Remark</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($standby as $index => $row)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="text-primary">{{ $row->application_id ?? 'NA' }}</td>
                        <td>
                           @foreach($district as $key => $dist)
                              @if($dist->id == $row->district_id)
                                 {{ $dist->name }}
                              @endif
                           @endforeach
                        </td>
                        <td>{{ $row->program_type }}</td>
                        <td>{{ \Carbon\Carbon::parse($row->program_datetime)->format('d-m-Y H:i:s')}}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->address }}</td>
                        <td>{{ $row->contact_person }}</td>
                        <td>
                           @if($row->status ==0)
                              @php echo "Not Assigned" @endphp
                           @elseif($row->status ==1)
                              @php echo "Assigned And Approved" @endphp
                           @elseif($row->status ==2)
                              @php echo "Rejected" @endphp
                           @elseif($row->status ==3)
                              @php echo "Need Reassignment" @endphp
                           @elseif($row->status ==4)
                              @php echo "complete" @endphp
                           @endif
                        </td>
                        <td>
                           @php
                              $responses = [
                                 0 => 'No Response',
                                 1 => 'Reschedule',
                                 2 => 'Not Available',
                                 3 => 'Accepted on Bill',
                                 4 => 'Accepted',
                                 5 => 'Other',
                              ];
                           @endphp

                           {{ $responses[$row->assignee_response] ?? 'Unknown' }}
                        </td>
                        <td>
                           @if(!empty($row->reschedule_date))
                              {{ \Carbon\Carbon::parse($row->reschedule_date)->format('d-m-Y') }}
                           @else
                              {{ 'NA' }}
                           @endif
                        </td>
                        <td>{{ $row->final_remark ?? 'Pending'}}</td>
                        <td class="text-center">
                           <a href="{{route('admin.viewStandby', $row->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> &nbsp;</a>
                           @if(Auth::user()->type == 3 && ($row->event_program_status == 0 || $row->event_program_status == 2) && $row->assignee_response != 0)
                           <a href="{{ route('admin.standByEventProgram', $row->id) }}" class="btn btn-primary btn-sm" title="Stand By Event Program"><i class="fa fa-american-sign-language-interpreting"></i> &nbsp;</a>
                           @endif
                           @if($row->event_program_status == 1 && $row->assignee_response != 0)
                              <a onclick="return confirm('Are you sure you want to download Standby Program Report?')" id="{{ route('standby.download', $row->id) }}" class="btn btn-dark btn-sm btn-delete generatePdfBtn" title="Download Standby Program Report" target="_blank" data-id="{{ $row->id ?? 'NA' }}"><i class="fa fa-download"></i></a>
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
   $(document).ready(function() {
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', '.generatePdfBtn', function () {
            const url = $(this).attr('id');
            const application_no = $(this).attr('data-id');
           // alert(application_no);
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
                        filename: 'standby_report_'+ application_no +'.pdf',
                        image: { type: 'jpeg', quality: 1 },
                        html2canvas: { scale: 2, useCORS: true },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                    };

                    html2pdf().from(content).set(options).toPdf().get('pdf').then(function(pdf) {
                        let pdfFile = pdf.output('blob'); // Create a PDF blob
                        let pdfURL = URL.createObjectURL(pdfFile); // Convert to a URL
                        let a = document.createElement('a');
                        a.href = pdfURL;
                        a.download = 'standby_report_'+ application_no +'.pdf'; // Force download
                        document.body.appendChild(a);
                        a.click(); // Auto-download PDF
                        document.body.removeChild(a); // Clean up
                    });
                })
                .catch(error => console.error('Error fetching Fire Report:', error));
        });
   });
</script>

@stop
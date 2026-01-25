@extends('layouts.admin.template')
@section('title')
<title>Awareness Program | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">



@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
   <div>
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Public Awareness Program Requests</h5>
   </div>
   <div class="d-flex app-header-btn">

      <div>
         <a href="<?php echo route('admin.addAwareness'); ?>" class="btn ripple btn-wave  btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Public Awareness Program
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
               Public Awareness Program Requests
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


               @if ($errors->any())
                  <div class="alert alert-danger">
                     <ul class="mb-0">
                           @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                           @endforeach
                     </ul>
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
                     @foreach ($awareness as $index => $row)
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
                           <a href="{{route('admin.viewAwareness', $row->id)}}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> &nbsp;</a>
                           @if(Auth::user()->type == 3 && ($row->event_program_status == 0 || $row->event_program_status == 2) && $row->assignee_response != 0)
                              <a href="{{ route('admin.awarenessEventProgram', $row->id) }}" class="btn btn-primary btn-sm" title="Awareness Event Program"><i class="fa fa-american-sign-language-interpreting"></i> &nbsp;</a>
                           @endif
                           
                           @if($row->event_program_status == 1 && $row->assignee_response != 0)
                              <a onclick="return confirm('Are you sure you want to download Awareness Program Report?')" id="{{ route('awareness.download', $row->id) }}" class="btn btn-dark btn-sm btn-delete generatePdfBtn" title="Download Awareness Program Report" target="_blank" data-id="{{ $row->id ?? 'NA' }}"><i class="fa fa-download"></i></a>
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


<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Event Close Program</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
   
      <form method="POST" action="#" enctype="multipart/form-data">
         <!-- Modal body -->
         <div class="modal-body">
            @csrf
            <div class="row">

               <div class="col-md-12">
                  <div class="form-group">
                     <label for="remark">Event Title <sup class="text-danger">*</sup></label>
                     <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title" required>
                     <span class="text-danger" id="title_error"></span>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="remark">Description <sup class="text-danger">*</sup></label>
                     <textarea name="description" id="description" class="form-control" required></textarea>
                     <span class="text-danger" id="remark_error"></span>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="remark">Image 1 <sup class="text-danger">*</sup></label>
                     <input type="file" name="attachment" id="attachment" class="form-control" required>
                     <span class="text-danger" id="attError"></span>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="form-group">
                     <label for="remark">Image 2 <sup class="text-danger">*</sup></label>
                     <input type="file" name="attachment2" id="attachment2" class="form-control" required>
                     <span class="text-danger" id="attError2"></span>
                  </div>
               </div>

               <div class="col-md-12">
                  <div class="form-group">
                     <label for="remark">Attachment<sup>(optional)</sup></label>
                     <input type="file" name="attachment3" id="attachment3" class="form-control">
                     <span class="text-danger" id="attError3"></span>
                  </div>
               </div>

            </div>
         </div>

         <!-- Modal footer -->
         <div class="modal-footer">
            <input type="text" name="apid" id="apid" hidden>
            <input type="text" name="userType" id="userType" hidden>
            <button type="submit" id="dataSubmit" class="btn btn-primary btn-sm">Submit</button>
            <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
         </div>
      </form>



    </div>
  </div>
</div>
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
   $(document).ready(function() {

      $(document).on('click', '.closerRequest', function(e){
         e.preventDefault();
         let id = $(this).data('id');
         let userType = '<?= Auth::user()->type == 3 ? 3 : 4 ?>';
         if(userType == 3)
         {
            if(id!='')
            {
               $('#myModal').modal('show');
               $('#apid').val(id);
               $('#userType').val(userType);

            }
         }
      });

       // Validation
        $(document).on('click', '#dataSubmit', function(){
            let remark = $('#remark').val();
            let attachment = $('#attachment')[0].files[0];
            let attachment2 = $('#attachment2')[0].files[0];
            let attachment3 = $('#attachment3')[0]?.files[0];
            
            let allowedExtensions = ['pdf', 'jpg', 'jpeg', 'png', 'webp'];

            function getExtension(file) {
               return file.name.split('.').pop().toLowerCase();
            }

            if(remark=='')
            {
                $('#remark_error').html('Please Enter Final Remark').delay(3000).fadeOut().css('display', 'block');
                return false;
            }
            else if(attachment=='')
            {
                $('#attError').html('Please Select Image 1').delay(3000).fadeOut().css('display', 'block');
                return false;
            }
            else if (!allowedExtensions.includes(getExtension(attachment))) {
               $('#attError').html('Invalid file type for Image 1').css('display', 'block').delay(3000).fadeOut();
               return false;
            } 
            else if(attachment2=='')
            {
                $('#attError2').html('Please Select Image 2').delay(3000).fadeOut().css('display', 'block');
                return false;
            }
            else if (!allowedExtensions.includes(getExtension(attachment2))) {
               $('#attError2').html('Invalid file type for Image 2').css('display', 'block').delay(3000).fadeOut();
               return false;
            }
            else if (attachment3 && !allowedExtensions.includes(getExtension(attachment3))) {
               $('#attError3').html('Invalid file type for Image 3').css('display', 'block').delay(3000).fadeOut();
               return false;
            }
            else
            {
               return true;
            }
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
                        filename: 'awareness_report_'+ application_no +'.pdf',
                        image: { type: 'jpeg', quality: 1 },
                        html2canvas: { scale: 2, useCORS: true },
                        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
                    };

                    html2pdf().from(content).set(options).toPdf().get('pdf').then(function(pdf) {
                        let pdfFile = pdf.output('blob'); // Create a PDF blob
                        let pdfURL = URL.createObjectURL(pdfFile); // Convert to a URL
                        let a = document.createElement('a');
                        a.href = pdfURL;
                        a.download = 'awareness_report_'+ application_no +'.pdf'; // Force download
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
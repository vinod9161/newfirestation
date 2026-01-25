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
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Organisational Structure</h5>
   </div>
   <div class="d-flex app-header-btn">

      <div>
         <a href="<?php echo route('admin.addOrganisationalForm'); ?>" class="btn ripple btn-wave  btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Organisational Structure
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
               Organisational Structure
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
                        <th>S No.</th>
                        <th>Organisational Type</th>
                        <th>Name of Officer</th>
                        <th>District</th>
                        <th>Mobile No.</th>
                        <th>Phone No.</th>
                        <th>Email Address</th>
                        <th>Rank</th>
                        <th>Status</th>
                        <th>Profile</th>
                        <th>Action</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach ($organisational as $index => $row)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                           @if($row->type ==1)
                              @php echo "Headquater" @endphp
                           @elseif($row->type ==2)
                              @php echo "District" @endphp
                           @elseif($row->type ==3)
                              @php echo "firetsation" @endphp
                           @endif
                        </td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->designation }}</td>
                        <td>{{ $row->mobile }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->rank ? $row->rank : 'NA' }}</td>
                        <td>{{ $row->status == 1 ? 'Active' : 'Inactive' }}</td>
                        <td>
                           @if($row->profile_pic)
                              <img src="{{ asset('public/'.$row->profile_pic) }}" width="80">
                           @else
                              NA
                           @endif
                        </td>
                        <td>
                           <!-- Edit Button -->
                           <a href="{{ route('admin.editOrganisationalForm', $row->id) }}" class="btn btn-primary btn-sm"><i class="fe fe-edit"></i></a> 
                           <!-- Delete Button -->
                           <a href="{{ route('admin.deleteOrganisational', $row->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this organisational structure?');"><i class="fe fe-trash"></i></a>
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
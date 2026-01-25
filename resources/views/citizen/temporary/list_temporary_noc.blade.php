@extends('layouts.citizen.template')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Temporary NOC - Application Listings</h5>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100" style="margin-top:20px;">
                        <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Aplication No.</th>
                                <th>Aplication Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($application as $key => $app)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $app->application_no }}</td>
                                <td>{{ $app->noc_type }}</td>
                                <td>{{ $app->status }}</td>
                                <td>
                                    <a href="{{route('citizen.viewTemporaryNocDetail', ['id' => $app->id, 'type' => $type])}}" class="btn btn-light btn-edit" title="View" style="display:none;"><i class="fa fa-eye"></i> &nbsp;</a>
                                    
                                    @if($app->status =='approved')
                                    <a onclick="return confirm('Are you sure you Want to Download Noc ?')" href="{{route('admin.downloadTemporaryNoc', ['id' => $app->id, 'type' => $type])}}" class="btn btn-light btn-view" title="Download" target="_blank"><i class="fa fa-download"></i> &nbsp;</a>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
 <script>  
     $(document).ready(function(){ 
        $('.js-example-basic-multiple').select2();
    });
  
 </script>
@stop
@extends('layouts.admin.template')
@section('title')
<title>Activites</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
   <div>
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Activities</h5>
   </div>
</div>
<!-- Start::row-2 -->
<div class="row">


   <div class="col-sm-6 col-md-6 col-xl-3">
        <a href="{{ route('admin.standby') }}">
            <div class="card custom-card">
                <div class="card-body text-center" style="height:150px;">
                    <div class="col-md-6" style="margin:0 auto;">
                        <img src="{{ asset('/public/fire/img/act/stand_by.jpg') }}" alt="" style="width:40%; height:40px; object-fit:contain;">
                    </div>
                    <hr>
                    <h5 class="mb-0 text-primary" style="font-size:16px;">Stand By Duty Report</h5>
                </div>
            </div>
        </a>
   </div>


   <div class="col-sm-6 col-md-6 col-xl-3">
        <a href="{{ route('admin.awareness') }}">
            <div class="card custom-card">
                <div class="card-body text-center" style="height:150px;">
                    <div class="col-md-6" style="margin:0 auto;">
                        <img src="{{ asset('/public/fire/img/act/classes.png') }}" alt="" style="width:40%; height:40px; object-fit:contain;">
                    </div>
                    <hr>
                    <h5 class="mb-0 text-primary" style="font-size:16px;">Public Awareness Program Report</h5>
                </div>
            </div>
        </a>
   </div>

   <div class="col-sm-6 col-md-6 col-xl-3">
        <a href="{{ route('admin.incident') }}">
            <div class="card custom-card">
                <div class="card-body text-center" style="height:150px;">
                    <div class="col-md-6" style="margin:0 auto;">
                        <img src="{{ asset('/public/fire/img/act/fire-truck.jpg') }}" alt="" style="width:40%; height:40px; object-fit:contain;">
                    </div>
                    <hr>
                    <h5 class="mb-0 text-primary" style="font-size:16px;">Fire / Rescue / Other Incident Report</h5>
                </div>
            </div>
        </a>
   </div>

   <div class="col-sm-6 col-md-6 col-xl-3">
        <a href="{{route('admin.inspectionByOfficer')}}">
            <div class="card custom-card">
                <div class="card-body text-center" style="height:150px;">
                    <div class="col-md-6" style="margin:0 auto;">
                        <img src="{{ asset('/public/fire/img/act/fire_inspection.jpg') }}" alt="" style="width:40%; height:40px; object-fit:contain;">
                    </div>
                    <hr>
                    <h5 class="mb-0 text-primary" style="font-size:16px;">Inspection by Officers</h5>
                </div>
            </div>
        </a>
   </div>

   <div class="col-sm-6 col-md-6 col-xl-3">
        <a href="{{route('admin.rewardPanishment')}}">
            <div class="card custom-card">
                <div class="card-body text-center" style="height:150px;">
                    <div class="col-md-6" style="margin:0 auto;">
                        <img src="{{ asset('/public/fire/img/act/Rewared_punishment.png') }}" alt="" style="width:40%; height:40px; object-fit:contain;">
                    </div>
                    <hr>
                    <h5 class="mb-0 text-primary" style="font-size:16px;">Reward/ Punishment</h5>
                </div>
            </div>
        </a>
   </div>

   <div class="col-sm-6 col-md-6 col-xl-3">
        <a href="{{route('admin.fireInspection')}}">
            <div class="card custom-card">
                <div class="card-body text-center" style="height:150px;">
                    <div class="col-md-6" style="margin:0 auto;">
                        <img src="{{ asset('/public/fire/img/act/inspection_by_gudeget_officer.png') }}" alt="" style="width:40%; height:40px; object-fit:contain;">
                    </div>
                    <hr>
                    <h5 class="mb-0 text-primary" style="font-size:16px;">Fire inspection</h5>
                </div>
            </div>
        </a>
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

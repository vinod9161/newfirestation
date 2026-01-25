@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">SOP</h5>
    </div>
   <div class="d-flex app-header-btn">
      <div>
         <a href="<?php echo route('citizen.sop'); ?>" class="btn ripple btn-wave  btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add New SOP
         </a>
      </div>
   </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive---">
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
                                <th>Subject</th>
                                <th>Date</th>
                                <th>SOP</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sop as $key => $sp)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sp->subject }}</td>
                                <td>{{ \Carbon\Carbon::parse($sp->created_at)->format('d-m-Y') }}</td>
                                <td><a href="{{'/'.$sp->upload_sop}}" class="btn btn-light btn-delete" title="Download NOC" target="_blank"><i class="fa fa-download"></i> </a></td>
                                <td>
                                    <a href="{{route('citizen.upload.sop.delete', $sp->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this organisational structure?');"><i class="fe fe-trash"></i></a>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
 <script>  
     $(document).ready(function(){ 
        $('.js-example-basic-multiple').select2();
    });
  
 </script>
@stop
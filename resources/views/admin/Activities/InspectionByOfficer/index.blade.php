@extends('layouts.admin.template')
@section('title')
<title>Hydrants | Admin Dashboard</title>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Inspection by Officers</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('admin.addInspectionByOfficer'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Add Inspection by Officers
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
                    <div class="col-md-12">



                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th style="width: 9%;">S No.<div style="height: 25px;"></div></th>
                                <th>District</th>
                                <th>Station</th>
                                <th>Designation</th>
                                <th>Name of Officer</th>
                                <th>Date of Inspection</th>
                                <th>Type Of inspection</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                            $i = 1;
                            @endphp
                            @foreach ($inspection as $ins)
                            <tr class="my-job-item">
                                <td class="d-none d-xl-table-cell text-center number-application" style="width: 9%;">{{$i }}</td>
                                <td>{{ucfirst($ins->district->name)}}</td>
                                <td>{{ucfirst($ins->station->name)}}</td>
                                <td>{{$ins->designation}}</td>
                                <td>{{$ins->officer_name}}</td>
                                <td>{{date('d-M-Y', strtotime($ins->date))}}</td>
                                <td>{{$ins->type}}</td>
                                <td class="d-none d-md-table-cell text-right">
                                    <a href="{{route('admin.viewInspectionByOfficer', $ins->id)}}" class="btn btn-light btn-edit" title="Edit"><i class="fa fa-eye"></i> &nbsp;</a>

                                    <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('admin.deleteInspectionByOfficer', $ins->id)}}" class="btn btn-light btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a>

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
</div>

<!--End::row-1 -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
    $(document).ready(function(){
        $(document).on('change','#assignee_response', function(){
            var assignee_value = $(this).val();
            if(assignee_value == '3' || assignee_value == '5')
            {
                document.getElementById('remark_div').style.display = "inline-flex";
                $("#assignee_remark").attr('required', '');
            }
            else
            {
                document.getElementById('remark_div').style.display = "none";
                $("#assignee_remark").removeAttr('required');
            }
        });
    });
</script>
@stop

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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">View Inspection by Officers Report</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('admin.inspectionByOfficer'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Inspection by Officers List
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
                    Inspection by Officers
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
                            <tbody>

                                <tr>
                                    <td>District</td>
                                    <td>
                                        @foreach($district as $dist)
                                            @if($dist->id == $inspection->district_id)
                                                {{ $dist->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>

                                <tr>
                                    <td>Fire Station</td>
                                    <td>
                                        @foreach($station as $stn)
                                            @if($stn->id == $inspection->station_id)
                                                {{ $stn->name }}
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>

                                <tr>
                                    <td>Designation</td>
                                    <td>{{ $inspection->designation }}</td>
                                </tr>

                                <tr>
                                    <td>Officer Name</td>
                                    <td>{{ $inspection->officer_name }}</td>
                                </tr>

                                <tr>
                                    <td>Date</td>
                                    <td>{{ \Carbon\Carbon::parse($inspection->date)->format('d-m-Y') }}</td>
                                </tr>

                                <tr>
                                    <td>Inspection Type</td>
                                    <td>{{ $inspection->type }}</td>
                                </tr>

                                <tr>
                                    <td>Comment</td>
                                    <td>{{ $inspection->comment }}</td>
                                </tr>

                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if($inspection->status == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </td>
                                </tr>

                                </tbody>
                        </table>
                    </div>
                </div>
                <div style="padding:20px 0px;">
                    @if(Auth::user()->type == '2' && ($inspection->status == 0 || $inspection->status == 3))
                    <form action="{{route('admin.assignedToIncident')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$inspection->id}}">
                        <div class="row">
                            <div class="col-md-4">
                                <label class="control-label required" style="float: right;" for="FireReport_category"><strong>Assign Request To: </strong></label>
                            </div>
                            <div class="col-md-4">
                                <select class="col-md-4 form-control js-example-basic-single" name="assigned_id" id="assigned_id" required>
                                    <option value="">--Select FSO--</option>
                                    @foreach ($users as $usr)
                                    <option value="{{ $usr->id }}">
                                        @foreach($station as $stn)
                                        @if($stn->id == $usr->station_id)
                                        {{ $stn->name }}
                                        @endif
                                        @endforeach
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input class="btn btn-success" type="submit" value="Assign">
                                @if($inspection[0]->status == 0)
                                <a href="{{route('admin.rejectIncidentApplication', $inspection[0]->id)}}" class="btn btn-danger">Reject</a>
                                @endif
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                <div style="padding:20px 0px;">
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
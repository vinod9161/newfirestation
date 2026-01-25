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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">View Incident Report Request</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('admin.incident'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Incident Report List
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
                    Incident Report Request
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
                                    <td style="width: 30%">Type Of Report रिपोर्ट का प्रकार</td>
                                    <td>{{ $incident[0]->report_type }}</td>
                                </tr>
                                <tr>
                                    <td>Date घटना का दिनांक </td>
                                    <td>{{ \Carbon\Carbon::parse($incident[0]->date)->format('d-m-Y H:i:s')}}</td>
                                </tr>
                                <tr>
                                    <td>Name of Person/Institution व्यक्ति अथवा संस्था का नाम</td>
                                    <td>{{ $incident[0]->name }}</td>
                                </tr>
                                <tr>
                                    <td>Address पता</td>
                                    <td>{{ $incident[0]->address }}</td>
                                </tr>
                                <tr>
                                    <td>District जनपद</td>
                                    <td>
                                        @foreach($district as $key => $dist)
                                        @if($dist->id == $incident[0]->district_id)
                                        {{ $dist->name }}
                                        @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Aadhaar Number आधार संख्या</td>
                                    <td>{{ $incident[0]->aadhar_no }}</td>
                                </tr>
                                <tr>
                                    <td>Email Address ई-मेल</td>
                                    <td>{{ $incident[0]->email }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number मोबाइल नं0</td>
                                    <td>{{ $incident[0]->mobile_no }}</td>
                                </tr>
                                <tr>
                                    <td>Contact Person सम्पर्क हेतु व्यक्ति</td>
                                    <td>{{ $incident[0]->contact_person }}</td>
                                </tr>
                                <tr>
                                    <td>Assigned To</td>
                                    <td>
                                        @if(!empty($assignedTo))
                                        {{ ucwords($assignedTo[0]->name) }}
                                        @else
                                        Not Assign
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status</td>
                                    <td>
                                        @if($incident[0]->status ==0)
                                        @php echo "Not Assigned" @endphp
                                        @elseif($incident[0]->status ==1)
                                        @php echo "Assigned And Approved" @endphp
                                        @elseif($incident[0]->status ==2)
                                        @php echo "Rejected" @endphp
                                        @elseif($incident[0]->status ==3)
                                        @php echo "Need Reassignment" @endphp
                                        @elseif($incident[0]->status ==4)
                                        @php echo "complete" @endphp
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assignee's Response...</td>
                                    <td>
                                        @if($incident[0]->assignee_response ==0)
                                        @php echo "No Response" @endphp
                                        @elseif($incident[0]->assignee_response ==1)
                                        @php echo "Reschedule" @endphp
                                        @elseif($incident[0]->assignee_response ==2)
                                        @php echo "Not Available" @endphp
                                        @elseif($incident[0]->assignee_response ==4)
                                        @php echo "Accepted" @endphp
                                        @elseif($incident[0]->assignee_response ==3 )
                                        @php echo "Accepted on Bill " @endphp

                                        @if($incident[0]->assignee_remark !='')
                                        @php echo '('.$incident[0]->assignee_remark.')' @endphp
                                        @endif

                                        @elseif($incident[0]->assignee_response ==5 )
                                        @php echo "Other " @endphp

                                        @if($incident[0]->assignee_remark !='')
                                        @php echo '('.$incident[0]->assignee_remark.')' @endphp
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div style="padding:20px 0px;">
                    @if(Auth::user()->type == '2' && ($incident[0]->status == 0 || $incident[0]->status == 3))
                    <form action="{{route('admin.assignedToIncident')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$incident[0]->id}}">
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
                                @if($incident[0]->status == 0)
                                <a href="{{route('admin.rejectIncidentApplication', $incident[0]->id)}}" class="btn btn-danger">Reject</a>
                                @endif
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
                <div style="padding:20px 0px;">
                    @if(Auth::user()->id == $incident[0]->assigned_id && ($incident[0]->assignee_response == 1 || $incident[0]->assignee_response == 0))
                    <form action="{{route('admin.assigneeResponseIncident')}}" method="post">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{$incident[0]->id}}">

                            <div class="col-md-4">
                                <label class="control-label required" style="float: right;" for="FireReport_category"><strong>Assignee's Response: </strong></label>
                            </div>
                            <div class="col-md-4">
                                <select class="col-md-4 form-control js-example-basic-single" name="assignee_response" id="assignee_response" required>
                                    <option value="">--Select Responses--</option>
                                    <option value="1">Reschedule</option>
                                    <option value="2">Not Available</option>
                                    <option value="3">Accepted on Bill</option>
                                    <option value="4">Accepted</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                            <div class="col-md-12" id="remark_div" style="display:none;padding: 10px;">
                                <div class="col-md-4">
                                    <label class="control-label required" style="Float: right;padding-right:15px;" for="FireReport_category"><strong>Assignee's Remark: </strong></label>
                                </div>
                                <div class="col-md-4" style="padding: 0px 8px;">
                                    <input class="form-control" name="assignee_remark" id="assignee_remark" type="text" placeholder="Assignee's Response" required/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4" style="padding: 10px;">
                                <input class="btn btn-success" type="submit" value="Reply">
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </form>
                    @endif
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
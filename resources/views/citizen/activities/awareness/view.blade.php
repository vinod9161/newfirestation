@extends('layouts.citizen.template')
@section('title')
<title>Awareness | Citizen Dashboard</title>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">View Public Awareness Program</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('citizen.awareness'); ?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Public Awareness Program Request List
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
                    awareness Duty Request No. : {{ $awareness[0]->application_id }}
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
                                    <td style="width: 30%">Type Of Program कार्यक्रम का प्रकार</td>
                                    <td>{{ $awareness[0]->program_type }}</td>
                                </tr>
                                <tr>
                                    <td>Date &amp; time Of Program कार्यक्रम का दिनांक एवं समय </td>
                                    <td>{{ \Carbon\Carbon::parse($awareness[0]->program_datetime)->format('d-m-Y H:i:s')}}</td>
                                </tr>
                                <tr>
                                    <td>Name of Person/Institution व्यक्ति अथवा संस्था का नाम</td>
                                    <td>{{ $awareness[0]->name }}</td>
                                </tr>
                                <tr>
                                    <td>Address पता</td>
                                    <td>{{ $awareness[0]->address }}</td>
                                </tr>
                                <tr>
                                    <td>District जनपद</td>
                                    <td>
                                        @foreach($district as $key => $dist)
                                        @if($dist->id == $awareness[0]->district_id)
                                        {{ $dist->name }}
                                        @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Contact Person सम्पर्क हेतु व्यक्ति</td>
                                    <td>{{ $awareness[0]->contact_person }}</td>
                                </tr>
                                <tr>
                                    <td>Mobile Number मोबाइल नं0</td>
                                    <td>{{ $awareness[0]->mobile_no }}</td>
                                </tr>
                                <tr>
                                    <td>Email Address ई-मेल</td>
                                    <td>{{ $awareness[0]->email }}</td>
                                </tr>
                                <tr>
                                    <td>Number of People Attending the Program कार्यक्रम में आने वालों लोगों की संख्या</td>
                                    <td>{{ $awareness[0]->crowd_size }}</td>
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
                                        @if($awareness[0]->status ==0)
                                        @php echo "Not Assigned" @endphp
                                        @elseif($awareness[0]->status ==1)
                                        @php echo "Assigned And Approved" @endphp
                                        @elseif($awareness[0]->status ==2)
                                        @php echo "Rejected" @endphp
                                        @elseif($awareness[0]->status ==3)
                                        @php echo "Need Reassignment" @endphp
                                        @elseif($awareness[0]->status ==4)
                                        @php echo "complete" @endphp
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Assignee's Response</td>
                                    <td>
                                        @if($awareness[0]->assignee_response ==0)
                                        @php echo "No Response" @endphp
                                        @elseif($awareness[0]->assignee_response ==1)
                                        @php echo "Reschedule" @endphp
                                        @elseif($awareness[0]->assignee_response ==2)
                                        @php echo "Not Available" @endphp
                                        @elseif($awareness[0]->assignee_response ==4)
                                        @php echo "Accepted" @endphp
                                        @elseif($awareness[0]->assignee_response ==3 )
                                        @php echo "Accepted on Bill " @endphp

                                        @if($awareness[0]->assignee_remark !='')
                                        @php echo '('.$awareness[0]->assignee_remark.')' @endphp
                                        @endif

                                        @elseif($awareness[0]->assignee_response ==5 )
                                        @php echo "Other " @endphp

                                        @if($awareness[0]->assignee_remark !='')
                                        @php echo '('.$awareness[0]->assignee_remark.')' @endphp
                                        @endif
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td>Final Remark</td>
                                    <td>{{ $awareness[0]->final_remark }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="reject_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="remark-form" action="{{route('admin.rejectAwarenessApplication')}}" method="post">
                @csrf
                <div class="modal-body">
                    <textarea class="form-control" maxlength="512" name="final_remark" placeholder="Enter Final Rmark" style="height:100px;width: 300px;margin:auto;" required></textarea>
                    <input type="hidden" name="id" value="{{$awareness[0]->id}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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
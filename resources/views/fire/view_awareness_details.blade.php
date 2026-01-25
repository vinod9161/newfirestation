@extends('layouts.fire_new')
@section('content')
<!-- ======= About Us Section ======= -->
<div class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Verification & Status Details</h2>
            <ol style="padding-top: 45px;">
                <li><a href="{{ route('actionIndex')}}">Home</a></li>
                <li>Verification & Status Details</li>
            </ol>
        </div>
    </div>
</div>
<!-- End About Us Section -->
<!-- ======= About Section ======= -->
<div class="container-fluid" style="margin-bottom:90px;">
    <div class="row">
        <div class="col-md-10" style="margin:auto; margin-top: 70px;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                       <div class="col-md-12">
                        <h4 class="text-center">Verification Status Details</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover">
                                    <tbody>
                                        <tr>
                                            <td style="width: 30%">Type Of Program कार्यक्रम का प्रकार</td>
                                            <td>{{ strtoupper($getData->program_type) }}</td>
                                        </tr>
                                        <tr>
                                            <td style="width: 30%">Appilcation No आवेदन संख्या</td>
                                            <td>{{ strtoupper($getData->application_id) }}</td>
                                        </tr>
                                        <tr>
                                            <td>Date &amp; time Of Program कार्यक्रम का दिनांक एवं समय </td>
                                            <td>{{ \Carbon\Carbon::parse($getData->program_datetime)->format('d-m-Y H:i:s')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Name of Person/Institution व्यक्ति अथवा संस्था का नाम</td>
                                            <td>{{ $getData->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Address पता</td>
                                            <td>{{ $getData->address }}</td>
                                        </tr>
                                        <tr>
                                            <td>District जनपद</td>
                                            <td>{{ $getData->d_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Fire Station अग्निशमन केंद्र</td>
                                            <td>{{ $getData->f_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Contact Person सम्पर्क हेतु व्यक्ति</td>
                                            <td>{{ $getData->contact_person }}</td>
                                        </tr>
                                        <tr>
                                            <td>Mobile Number मोबाइल नं0</td>
                                            <td>{{ $getData->mobile_no }}</td>
                                        </tr>
                                        <tr>
                                            <td>Email Address ई-मेल</td>
                                            <td>{{ $getData->email }}</td>
                                        </tr>
                                        <tr>
                                            <td>Number of People Attending the Program कार्यक्रम में आने वालों लोगों की संख्या</td>
                                            <td>{{ $getData->crowd_size }}</td>
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
                                                @if($getData->status ==0)
                                                @php echo "Not Assigned" @endphp
                                                @elseif($getData->status ==1)
                                                @php echo "Assigned And Approved" @endphp
                                                @elseif($getData->status ==2)
                                                @php echo "Rejected" @endphp
                                                @elseif($getData->status ==3)
                                                @php echo "Need Reassignment" @endphp
                                                @elseif($getData->status ==4)
                                                @php echo "complete" @endphp
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Assignee's Response</td>
                                            <td>
                                                @if($getData->assignee_response ==0)
                                                @php echo "No Response" @endphp
                                                @elseif($getData->assignee_response ==1)
                                                @php echo "Reschedule" @endphp
                                                @elseif($getData->assignee_response ==2)
                                                @php echo "Not Available" @endphp
                                                @elseif($getData->assignee_response ==4)
                                                @php echo "Accepted" @endphp
                                                @elseif($getData->assignee_response ==3 )
                                                @php echo "Accepted on Bill " @endphp

                                                @if($getData->assignee_remark !='')
                                                @php echo '('.$getData->assignee_remark.')' @endphp
                                                @endif

                                                @elseif($getData->assignee_response ==5 )
                                                @php echo "Other " @endphp

                                                @if($getData->assignee_remark !='')
                                                @php echo '('.$getData->assignee_remark.')' @endphp
                                                @endif
                                                @endif
                                            </td>
                                        </tr>

                                        @if(!empty($getData->reschedule_date))
                                        <tr>
                                            <td>Reschedule Date </td>
                                            <td> {{ \Carbon\Carbon::parse($getData->reschedule_date)->format('d-m-Y')}}</td>
                                        </tr>
                                        @endif

                                        @if (!empty($getData->assignee_attachments))
                                            @php
                                                $attachments = json_decode($getData->assignee_attachments);
                                            @endphp

                                            @if (!empty($attachments->attachment) || !empty($attachments->attachment2) || !empty($attachments->attachment3) )
                                                <tr>
                                                    <td>Event Program Attachments</td>
                                                    <td>
                                                        @if (!empty($attachments->attachment))
                                                            <a href="{{ asset($attachments->attachment) }}" class="btn btn-sm btn-primary" download>
                                                                Download Attachment <i class="fa fa-cloud-download"></i>
                                                            </a>
                                                        @endif

                                                        @if (!empty($attachments->attachment2))
                                                            <a href="{{ asset($attachments->attachment2) }}" class="btn btn-sm btn-primary" download>
                                                                Download Attachment <i class="fa fa-cloud-download"></i>
                                                            </a>
                                                        @endif

                                                        @if (!empty($attachments->attachment3))
                                                            <a href="{{ asset($attachments->attachment3) }}" class="btn btn-sm btn-primary" download>
                                                                Download Attachment <i class="fa fa-cloud-download"></i>
                                                            </a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
        
                                        <tr>
                                            <td>Program Details</td>
                                            <td>{{ $getData->program_details??'NA' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Participating Person</td>
                                            <td>{{ $getData->participating_person??'NA' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Vehicles</td>
                                            <td>{{ $getData->vehicles??'NA' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Program Feedback Report</td>
                                            <td>{{ $getData->program_feedback_report??'NA' }}</td>
                                        </tr>

                                        <tr>
                                            <td>Event Program Status</td>
                                            <td>
                                                @if($getData->event_program_status == 0)
                                                <span class="text-warning">Pending</span>
                                                @elseif($getData->event_program_status == 1)
                                                <span class="text-success">Accepted</span>
                                                @elseif($getData->event_program_status == 2)
                                                <span class="text-danger">Rejected</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Final Remark</td>
                                            <td>{{ $getData->final_remark ?? 'NA' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                       </div>
                    </div>
                </div>
            </div>        
        </div>
    </div>

   

    
   
</div>


@endsection
@section('scripts')

@stop
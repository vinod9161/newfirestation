@if($type == "awareness")
    <div class="track-wrapper">
        <div class="track-card {{ $messageClass }}">
            {!! $statusMessage !!}
        </div>
    </div>
    <div class="row AwarenessProgram" style="margin-left:90px; margin-right:90px;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sn.</th>
                    <th>Application No</th>
                    <th>Program Date Time</th>
                    <th>Program Type</th>
                    <th>Name of Person / Institute</th>
                    <th>Address</th>
                    <th>Contact Person</th>
                    <th>Current Status</th>
                    <th>Assignee Response</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>1</td>
                   <td>{{ $data->application_id }}</td>
                   <td>{{ $data->program_datetime }}</td>
                   <td>{{ $data->program_type }}</td>
                   <td>{{ $data->name }}</td>
                   <td>{{ $data->address }}</td>
                   <td>{{ $data->contact_person }}</td>
                   <td>
                        @php
                            $statusList = [
                                0 => 'Not Assigned',
                                1 => 'Assigned and Approved',
                                2 => 'Rejected',
                                3 => 'Need Reassignment',
                                4 => 'Complete'
                            ];
                        @endphp
                        {{ $statusList[$data->status] ?? 'NA' }}
                   </td>
                   <td>
                        @php
                            $responseList = [
                                0 => 'Not responded',
                                1 => 'Reschedule',
                                2 => 'Not Available',
                                3 => 'Accepted on Bill',
                                4 => 'Accepted',
                                5 => 'Other'
                            ];
                        @endphp
                        {{ $responseList[$data->assignee_response] ?? 'NA' }}
                   </td>
                   <td>
                        <a href="{{ url('/view_awareness_details/'.$data->id) }}" target="_blank">
                            <i class="fa fa-eye"></i>
                        </a>
                   </td>
                </tr>
            </tbody>
        </table>
    </div>
@endif

@if($type == "standby")
    <div class="track-wrapper">
        <div class="track-card {{ $messageClass }}">
            {!! $statusMessage !!}
        </div>
    </div>
@endif

@if($type == "firenoc")
    {{-- Fire NOC --}}
    <div class="track-wrapper">
        <div class="track-card {{ $messageClass }}">
            {!! $statusMessage !!}
            @if($data->status == 'reverted')
                @php
                $reasonMap = [

                    'reason1' => [
                        'hi' => 'आवेदक को भवन के उपभोग(परिचालन) से पूर्व अन्तिम अनापत्ति प्रमाण पत्र प्राप्त करना होगा।'
                    ],

                    'reason2' => [
                        'hi' => 'मानचित्र में परिवर्तन के दशा में आवेदक को अग्निशमन विभाग को सूचित करना होगा।'
                    ],

                    'reason3' => [
                        'hi' => 'निर्माण कार्य में एनबीसी भाग -4 के नियमों और राज्य भवन निर्माण तथा विकास उपविधि का उल्लंघन नहीं करेगा।'
                    ],

                    'reason4' => [
                        'hi' => 'यह प्रमाण पत्र अवैध निर्माण के लिए वैध नहीं होगा।'
                    ],

                    'reason5' => [
                        'hi' => 'आवेदक को प्रत्येक छमाही में अग्निशमन सुरक्षा व्यवस्था सन्तोषजनक एवं कार्यशील होने का स्व घोषणा पत्र देना होगा।'
                    ],
                ];
                @endphp
                @php
                $mergedReasons = [];   // final combined list


                function addReasonFinal(&$mergedReasons, $dbEnglishText, $reasonKey, $reasonMap){
                    if(!empty($dbEnglishText) && isset($reasonMap[$reasonKey])){
                        $mergedReasons[] =
                            trim($dbEnglishText) . ' ' .
                            $reasonMap[$reasonKey]['hi'];   // only Hindi from map
                    }
                }

                function addCustomRemark(&$mergedReasons, $text){
                    if(!empty(trim($text))){
                        $mergedReasons[] = trim($text);   // REMARK only, no Hindi mapping
                    }
                }

                if(!empty($data->remark_by_cfo)){
                    foreach(json_decode($data->remark_by_cfo) as $item){

                        $r = json_decode($item->reason);

                        if(!empty($r->reason1)) addReasonFinal($mergedReasons, $r->reason1, 'reason1', $reasonMap);
                        if(!empty($r->reason2)) addReasonFinal($mergedReasons, $r->reason2, 'reason2', $reasonMap);
                        if(!empty($r->reason3)) addReasonFinal($mergedReasons, $r->reason3, 'reason3', $reasonMap);
                        if(!empty($r->reason4)) addReasonFinal($mergedReasons, $r->reason4, 'reason4', $reasonMap);
                        if(!empty($r->reason5)) addReasonFinal($mergedReasons, $r->reason5, 'reason5', $reasonMap);

                        addCustomRemark($mergedReasons, $item->remark ?? '');
                    }
                }

                if(!empty($data->remark_by_fso)){
                    foreach(json_decode($data->remark_by_fso) as $item){

                        $r = json_decode($item->reason);

                        if(!empty($r->reason1)) addReasonFinal($mergedReasons, $r->reason1, 'reason1', $reasonMap);
                        if(!empty($r->reason2)) addReasonFinal($mergedReasons, $r->reason2, 'reason2', $reasonMap);
                        if(!empty($r->reason3)) addReasonFinal($mergedReasons, $r->reason3, 'reason3', $reasonMap);
                        if(!empty($r->reason4)) addReasonFinal($mergedReasons, $r->reason4, 'reason4', $reasonMap);
                        if(!empty($r->reason5)) addReasonFinal($mergedReasons, $r->reason5, 'reason5', $reasonMap);

                        addCustomRemark($mergedReasons, $item->remark ?? '');
                    }
                }


                $mergedReasons = array_unique($mergedReasons);
                @endphp
                @if(count($mergedReasons) > 0)
                <div style="justify-content: space-between; margin-top: 10px;">
                    <h6>Feedback</h6>
                    <ol style="margin-left:-20px;">
                        @foreach($mergedReasons as $line)
                            <li style="font-size:10px; line-height:15px;">{{ $line }}</li>
                        @endforeach
                    </ol>
                </div>
                @endif
            @endif
        </div>
    </div>
    <div class="row fireNoc" style="margin-left:50px; margin-right:50px;">
         <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sn.</th>
                    <th>Application No</th>
                    <th>Application Date</th>
                    <th>Application For</th>
                    <th>Application Type</th>
                    <th>Building Name</th>
                    <!-- <th>Building Category</th> -->
                    <th>Building Height</th>
                    <!-- <th>District</th> -->
                    <th>Fire Station</th>
                    <th>Status</th>
                    <th>Declaration Status</th>
                    <th>View NOC</th>
                    <th>Revert Reason</th>
                    <th>Application History</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <td>1</td>
                   <td>{{ $data->application_no }}</td>
                   <td>{{ $data->created_at }}</td>
                   <td>{{ $data->noc_type }}</td>
                   <td>{{ $data->application_type }}</td>
                   <td>{{ $data->building_name }}</td>
                   <td>{{ json_decode($data->max_height_building)->max_height_building ?? 'NA' }}</td>
                   <td>{{ $data->f_name ?? 'NA' }}</td>

                   {{-- NOC Status --}}
                   <td>
                        @php
                            $statusMap = [
                                'pending' => 'New',
                                'processed' => 'Verifier Assign',
                                'for approval' => 'Verified',
                                'pre approval' => 'For Pre Approval',
                                'pre approved' => 'Pre Approved',
                                'approved' => 'Approved',
                                'reverted' => 'Reverted'
                            ];
                        @endphp
                        {{ $statusMap[$data->status] ?? 'NA' }}
                   </td>

                   <td>{{ $data->declaration_status ?? 'Valid' }}</td>

                   <td>
                        @if($data->status == 'approved')
                            <a href="{{ url('/download-noc/'.$data->id) }}" target="_blank">
                                <i class="fa fa-eye"></i>
                            </a>
                        @endif
                   </td>

                   <td>
                        @if($data->status == 'reverted')
                            {{ json_decode($data->revert)[0]->revert_from ?? '' }}
                        @endif
                   </td>
                   <td>
                        <a href="javascript:void(0)"
                            class="viewApplicationHistory"
                            data-id="{{ $data->id }}"
                            data-bs-toggle="modal"
                            data-bs-target="#appHistoryModal">
                            <i class="fa fa-history text-primary"></i>
                        </a>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
@endif


@php
    $reportNames = [
        "standby" => "Standby Duty Report",
        "fire"    => "Fire Report",
        "rescue"  => "Rescue Report",
        "relief"  => "Relief Report",
    ];

    $reportTitle = $reportNames[$type] ?? "Report";
@endphp

@if(in_array($type, ['fire', 'rescue', 'relief']))

    @if(in_array($data->status, [0,1,2,3]))
        {{-- IN PROCESS (Orange) --}}
        <div class="track-wrapper">
            <div class="track-card track-warning">
                <strong>{{ $reportTitle }} {{ $number }} is under process / investigation.</strong>
                <br><br>
                Our team is reviewing your application. Please check back later.
            </div>
        </div>

    @elseif($data->status == 4)
        {{-- COMPLETED (Green) --}}
        <div class="track-wrapper">
            <div class="track-card track-success">
                <strong>{{ $reportTitle }} {{ $number }} has been successfully completed.</strong>
                <br><br>
                You may request a copy of the report from the following link:
                <a href="{{ url('/request-report') }}" class="request-link">Request Report</a>
            </div>
        </div>

    @else
        {{-- ERROR / NOT FOUND (Red) --}}
        <div class="track-wrapper">
            <div class="track-card track-error">
                <strong>No report found.</strong><br>
                Please verify your application number and try again.
            </div>
        </div>

    @endif

@endif

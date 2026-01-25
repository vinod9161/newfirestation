@extends('layouts.admin.template')
@section('title') 
<title>View Rescue Report | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<style>
   .custom-flex {
      display: flex;
      justify-content: space-between;
      width: 100%;
   }

   .report-details {
      margin-left: auto;
      /* Ensures it stays pushed to the right */
   }

   .heading_info {
      background: #42425d;
      color: white;
      padding: 4px;
      font-size: 1.2rem;
      width: 98%;
      margin: 10px 10px;
   }
</style>
@endsection
@section('content')
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
   <div>
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Rescue Reports</h5>
   </div>
   <div class="d-flex app-header-btn">
      @if(Auth::user()->type == 3)
      <div>
         <a href="<?php echo route('admin.addRescueReport'); ?>" class="btn ripple btn-wave  btn-success mb-0">
         <i class="fe fe-plus me-1"></i> View Rescue Report
         </a>
      </div>
      @endif
   </div>
</div>
<!-- End Row -->
<!-- Start::row-2 -->
<div class="row">
   <div class="col-xl-12">
      <div class="card custom-card">
         <div class="card-header">
            <div class="card-title">
               View Rescue Report
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
               <div class="row">
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
                  <h5 class="text-center heading_info">General Details सामान्य विवरण</h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td style="width: 30%">Annual Number वार्षिक संख्या</td>
                              <td>{{$rescueReport[0]->rescue_report_no}}</td>
                           </tr>
                           <tr>
                              <td>Monthly No. मासिक संख्या</td>
                              <td>{{$rescueReport[0]->monthly_no}}</td>
                           </tr>
                           <tr>
                              <td>District जनपद</td>
                              <td>{{ ucfirst($district[0]->name) ?? 'NA' }}</td>
                           </tr>
                           <tr>
                              <td>Fire Station फायर स्टेशन</td>
                              <td>{{ ucfirst($station[0]->name)}} ({{ empty($station[0]->firestation_code) ? 'N/A' : ucfirst($station[0]->firestation_code) }})</td>
                           </tr>
                           <tr>
                              <td>Rescue Incident Date and Time घटना का दिनांक एवं समय</td>
                              <td>{{ \Carbon\Carbon::parse($rescueReport[0]->rescue_incident_datetime)->format('d-m-Y H:i:s')}}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
               <h5 class="text-center table-dark heading_info">Information Details सूचना का विवरण</h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td style="width: 30%">Informer सूचना देने वाले का नाम</td>
                              <td>{{$rescueReport[0]->informer_name}}</td>
                           </tr>
                           <tr>
                              <td>Informer's Contact No. सूचना देने वाले का सम्पर्क नं0</td>
                              <td>{{$rescueReport[0]->informer_contact_no}}</td>
                           </tr>
                           <tr>
                              <td>Medium of Informate सूचना प्राप्ति का माधयम</td>
                              <td>{{$rescueReport[0]->info_medium}}</td>
                           </tr>
                           <tr>
                              <td>Date and Time when information is received सूचना प्राप्ति का दिनांक एवं समय</td>
                              <td>{{ \Carbon\Carbon::parse($rescueReport[0]->info_datetime)->format('d-m-Y H:i:s')}}</td>
                           </tr>
                           <tr>
                              <td>Address of incident place घटनास्थल का पता</td>
                              <td>{{$rescueReport[0]->incident_address}}
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
               <h5 class="text-center heading_info">Action Details कार्यवाही का विवरण<h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td style="width: 30%">Departure time from Fire Station फायर स्टेशन से प्रस्थान का समय</td>
                              <td>{{ \Carbon\Carbon::parse($rescueReport[0]->station_depart_datetime)->format('d-m-Y H:i:s')}}</td>
                           </tr>
                           <tr>
                              <td>Arrival time at Rescue site घटनास्थल पर पहुँचने का समय</td>
                              <td>{{ \Carbon\Carbon::parse($rescueReport[0]->rescue_site_arrive_datetime)->format('d-m-Y H:i:s')}}</td>
                           </tr>
                           <tr>
                              <td>Return time to Fire station फायर स्टेशन पर वापसी का समय </td>
                              <td>{{ \Carbon\Carbon::parse($rescueReport[0]->station_return_datetime)->format('d-m-Y H:i:s')}}</td>
                           </tr>
                           <!-- <tr>
                              <td>Details of Rescue service personals</td>
                              <td>{{$rescueReport[0]->personals_detail}}</td>
                              </tr> -->
                           <tr>
                              <td>Distance between station and Rescue site फायर स्टेशन से घटनास्थल की दूरी</td>
                              <td>{{$rescueReport[0]->distance}}</td>
                           </tr>
                           @php
                           $datetime1 = new DateTime($rescueReport[0]->station_depart_datetime);//start time
                           $datetime2 = new DateTime($rescueReport[0]->rescue_site_arrive_datetime);//end time
                           $interval = $datetime1->diff($datetime2);
                           $response_time = $interval->format('%H hours %i minutes %s seconds');//00 years 0 months 0 days 08 hours 0 minutes 0 seconds
                           $response_time_in_min = $interval->format('%i') != 0 ? $interval->format('%i') : 1;//00 years 0 months 0 days 08 hours 0 minutes 0 seconds
                           @endphp
                           <tr>
                              <td>Total Response Time</td>
                              <td>{{$response_time}}</td>
                           </tr>
                           <tr>
                              <td>Average Time</td>
                              <td>
                                 @if($response_time >0)
                                 {{(int) $rescueReport[0]->distance / $response_time_in_min}} [KM/min]
                                 @endif
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
               <h5 class="text-center heading_info">Details of fire fighting Equipments used अग्निशमन कार्य में प्रयुक्त मशीनों का विवरण </h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           @php $i=0; @endphp
                           @foreach($vehicle as $veh)
                           <tr>
                              <td>{{ $veh['vehicle_type'] }}</td>
                              <td>{{ $veh['vehicle'] }}</td>
                           </tr>
                           <tr>
                              <td>Pumping in KM </td>
                              <td>{{ $veh['pumping_km'] }}</td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
               <h5 class="text-center heading_info">Details of Fire Service Personals &amp; Used Machine on Incident Place <br> घटनास्थल पर गये फायर सर्विस कार्मिकों एवं प्रयुक्त मशीनों का विवरण </h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td style="width: 30%">CFO</td>
                              <td>{{empty($rescueReport[0]->cfo) ? 'N/A' : ucwords($rescueReport[0]->cfo, ",")}}</td>
                           </tr>
                           <tr>
                              <td style="width: 30%">FSO</td>
                              <td>{{ empty($rescueReport[0]->fso) ? 'N/A' : ucwords($rescueReport[0]->fso, ",")}}</td>
                           </tr>
                           <tr>
                              <td style="width: 30%">FSSO</td>
                              <td>{{ empty($rescueReport[0]->fsso) ? 'N/A' : ucwords($rescueReport[0]->fsso, ",")}}</td>
                           </tr>
                           <tr>
                              <td style="width: 30%">LFM</td>
                              <td>{{ empty($rescueReport[0]->lfm) ? 'N/A' : ucwords($rescueReport[0]->lfm, ",")}}</td>
                           </tr>
                           <tr>
                              <td style="width: 30%">DVR</td>
                              <td>{{ empty($rescueReport[0]->dvr) ? 'N/A' : ucwords($rescueReport[0]->dvr, ",")}}</td>
                           </tr>
                           <tr>
                              <td style="width: 30%">FM</td>
                              <td>{{ empty($rescueReport[0]->fm) ? 'N/A' : ucwords($rescueReport[0]->fm, ",")}}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Details of Rescue Operation रेस्क्यू ऑपरेशन का विवरण</h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td>Area of Rescue रेस्क्यू का क्षेत्र</td>
                              <td>@if($rescueReport[0]->rescue_area ==1)
                                 @php echo "Rural" @endphp
                                 @else
                                 @php echo "City" @endphp
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <td>Type of Rescue रेस्क्यू का प्रकार</td>
                              <td>
                                 @if($rescueReport[0]->rescue_area_type ==1)
                                 @php echo "Disaster आपदा" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==2)
                                 @php echo "Earth Quick भूकम्प" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==3)
                                 @php echo "Land Slide भूस्खलन" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==4)
                                 @php echo "Flood बाढ़" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==5)
                                 @php echo "Road Accidentसड़क दुर्घटना" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==6)
                                 @php echo "Building Colipase भवन धंसना" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==7)
                                 @php echo "Gas Leak गैस लीकेज" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==8)
                                 @php echo "Patient मरीज" @endphp
                                 @elseif($rescueReport[0]->rescue_area_type ==9)
                                 @php echo "Rescue of Animal/Bird पशु पक्षियों का रेस्क्यू" @endphp
                                 @else
                                 @php echo "Other अन्य" @endphp
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <td>Insured बीमित</td>
                              <td>
                                 @if($rescueReport[0]->insured == 0)
                                 @php echo "Not Known" @endphp
                                 @elseif($rescueReport[0]->insured == 1)
                                 @php echo "No" @endphp
                                 @elseif($rescueReport[0]->insured == 2)
                                 @php echo "Yes" @endphp
                                 @endif
                              </td>
                           </tr>
                           <tr>
                              <td>Reason of Rescue</td>
                              <td>{{$rescueReport[0]->rescue_reason}}</td>
                           </tr>
                           <!-- <tr>
                              <td>Was it arson based?</td>
                              <td>
                                 @if($rescueReport[0]->arson_based ==0)
                                    @php echo "Not known" @endphp
                                 @elseif($rescueReport[0]->arson_based ==1)
                                    @php echo "No" @endphp
                                 @else
                                    @php echo "Yes" @endphp
                                 @endif
                              </td>
                              </tr> -->
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Loss Details क्षति का विवरण</h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td>Human lives lost मनुष्य मरे</td>
                              <td>{{$rescueReport[0]->life_lost_human}}</td>
                           </tr>
                           <tr>
                              <td>Human lives saved मनुष्य बचाये</td>
                              <td>{{$rescueReport[0]->life_saved_human}}</td>
                           </tr>
                           <tr>
                              <td>Animal lives lost जीव मरे</td>
                              <td>{{$rescueReport[0]->life_lost_animal}}</td>
                           </tr>
                           <tr>
                              <td>Animal lives saved जीव बचाये</td>
                              <td>{{$rescueReport[0]->life_saved_animal}}</td>
                           </tr>
                           <tr>
                              <td>Description विवरण</td>
                              <td>{{$rescueReport[0]->short_description}}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Uploaded Report</h5>
                  <div class= 'table-responsive'>
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           @if($rescueReport[0]->upload =='')
                           <tr>
                              <td style="width: 30%">Uploaded Report</td>
                              <td>
                                 Report not uploaded
                              </td>
                           </tr>
                           @else
                           <tr>
                              <td style="width: 30%">Uploaded Report</td>
                              <td>
                                 <div id="uploaded-file-div" class="btn-group" role="group">
                                    <a class="btn btn-warning" id="uploaded-file-link" target="_blank" href="{{asset($rescueReport[0]->upload)}}">
                                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>{{$rescueReport[0]->upload}}</a>
                                 </div>
                                 @if($rescueReport[0]->assigned_to == Auth::user()->id)
                                 <a id='del-file-ajax-btn' class='btn btn-danger' href="{{route('admin.deleteRescueFile', $rescueReport[0]->id)}}">
                                 <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                 </a>
                                 @endif
                              </td>
                              <td>
                                 @if($rescueReport[0]->assigned_to == Auth::user()->id)
                                 <button id="copy-url-btn" class="btn btn-success col-md-offset-1">Copy Link</button>
                                 @endif
                              </td>
                           </tr>
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>
               <div class="row">
                  <table class="table table-bordered table-striped table-hover">
                     <tbody>
                        <tr>
                           <td style="width: 30%">Current Status of Report</td>
                           <td>
                              @if($rescueReport[0]->status == 0)
                              @php echo "Under Investigation" @endphp
                              @elseif($rescueReport[0]->status == 1)
                              @php echo "Sent for Approval" @endphp
                              @elseif($rescueReport[0]->status == 2)
                              @php echo "Sent for Review" @endphp
                              @elseif($rescueReport[0]->status == 3)
                              @php echo "Approved" @endphp
                              @elseif($rescueReport[0]->status == 3)
                              @php echo "Rejected" @endphp
                              @endif
                           </td>
                        </tr>
                        @if($rescueReport[0]->remark !='')
                        <tr>
                           <td style="width: 30%">Remark</td>
                           <td>
                              @php $remarkArr = explode(",",$rescueReport[0]->remark) @endphp
                              @foreach ($remarkArr as $key=>$rmk)
                              <p>{{$key +1}}. {{$rmk}}</p>
                              @endforeach
                           </td>
                        </tr>
                        @endif
                     </tbody>
                  </table>
               </div>
               @if($rescueReport[0]->status != 3)
               @if($rescueReport[0]->assigned_to == Auth::user()->id)
               @if($rescueReport[0]->status == 0 || $rescueReport[0]->status == 2)
               <div class="row">
                  <table class="table table-bordered table-striped table-hover">
                     <tbody>
                        <tr>
                           <td>
                              <a href="{{route('admin.editRescueReport', $rescueReport[0]->id)}}" class="btn btn-primary" >Update Report</a>
                           </td>
                           <td>
                              <a href="{{route('admin.sentRescueApproval', $rescueReport[0]->id)}}" title="Send For Approval" class="btn btn-primary" >Send For Approval</a>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               @endif
               @endif
               @endif
               @if(Auth::user()->type == 2)
               <div class="row">
                  <table class="table table-bordered table-striped table-hover">
                     <tbody>
                        <tr>
                           @if($rescueReport[0]->status == 1)
                           <td>
                              <button type="button" id="send-for-review-btn" class="btn btn-primary" onclick="openReviewModal()">Send For Review</button>
                           </td>
                           @endif
                           @if($rescueReport[0]->status == 1)
                           <td>
                              <a href="{{route('admin.rescueApproved', $rescueReport[0]->id)}}" class="btn btn-primary">Approve</a>
                           </td>
                           @endif
                        </tr>
                     </tbody>
                  </table>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Modal -->
<div class="modal fade" id="review_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Remark</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form enctype="multipart/form-data" id="remark-form" action="{{route('admin.addRescueRemark')}}" method="post">
            @csrf
            <div class="modal-body">
               <textarea class="form-control" maxlength="512" name="remark" placeholder="Enter Remark" style="height:100px;width: 300px;margin:auto;" required></textarea>
               <input type="hidden" name="id" value="{{$rescueReport[0]->id}}">
               <input type="hidden" name="old_exist" value="{{$rescueReport[0]->remark}}">
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
<script>
   jQuery('#copy-url-btn').on('click', function(e) {
      var url = jQuery("#uploaded-file-link").attr("href");
   });

   jQuery(document).ready(function() {
      var temp = jQuery("<input>");
      var url = jQuery("#uploaded-file-link").attr("href");

      jQuery('#copy-url-btn').on('click', function(e) {
         jQuery("body").append(temp);
         temp.val(url).select();
         document.execCommand("copy");
         temp.remove();
      });
   });

   function openReviewModal()
   {
      $('#review_modal').modal('show');
   }
</script>
@stop
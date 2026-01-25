@extends('layouts.admin.template')
@section('title')
<title>View Fire Report Details | Uttrakhand Fireservice</title>
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
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Fire Reports</h5>
   </div>
</div>
<!-- End Row -->
<!-- Start::row-2 -->
<div class="row">
   <div class="col-xl-12">
      <div class="card custom-card">
         <div class="card-header">
            <div class="card-title custom-flex">
               @php
               $reportYear = \Carbon\Carbon::parse($fireReport[0]->created_at)->format('Y');
               @endphp
               Fire Report Details
               <span class="btn btn-primary report-details">{{ empty($fireReport[0]->application_no) ? 'N/A' : $fireReport[0]->application_no}}</span>

               @php
               $canEdit = !($fireReport[0]->status == '3' || ($fireReport[0]->status == '1' && Auth::user()->type == '3'));
               @endphp

               <span class="btn btn-dark report-details" @if(!$canEdit) hidden @endif>
                  <a href="{{route('admin.editFireReport', $fireReport[0]->id)}}" class="text-white"><i class="fa fa-edit"></i> Edit</a>
               </span>


            </div>
         </div>

         <div class="card-body">
            <div class="container-fluid">
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
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                           <tbody>
                              <tr>
                                 <td style="width: 30%">Annual No. वार्षिक संख्या</td>
                                 <td>{{ $fireReport[0]->fire_report_no ?? 'NA' }}</td>
                              </tr>
                              <tr>
                                 <td>Monthly No. मासिक संख्या</td>
                                 <td>{{ $fireReport[0]->monthly_no ?? 'NA' }}</td>
                              </tr>
                              <tr>
                                 <td>Category वर्गीकरण</td>
                                 <td>@if($fireReport[0]->category ==1)
                                    @php echo "Small Fire लघु अग्निकाण्ड" @endphp
                                    @elseif($fireReport[0]->category ==2)
                                    @php echo "Medium Fire मध्यम अग्निकाण्ड" @endphp
                                    @elseif($fireReport[0]->category ==3)
                                    @php echo "Major/special Fire भीषण अग्निकाण्ड" @endphp
                                    @else
                                    @php echo "Serious Fire गम्भीर अग्निकाण्ड" @endphp
                                    @endif
                                 </td>
                              </tr>
                              <tr>
                                 <td>District जपपद</td>
                                 <td>{{ ucfirst($district[0]->name) ?? 'NA' }}</td>
                              </tr>
                              <tr>
                                 <td>Fire Station फायर स्टेशन</td>
                                 <td>{{ ucfirst($station[0]->name)}} ({{ empty($station[0]->firestation_code) ? 'N/A' : ucfirst($station[0]->firestation_code) }})</td>
                              </tr>
                              <tr>
                                 <td>Fire Incident Date and Time अग्निकाण्ड का दिनांक एवं समय</td>
                                 <td>{{ \Carbon\Carbon::parse($fireReport[0]->fire_incident_datetime)->format('d-m-Y H:i:s') }}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
               </div>
               <div class="row">
                  <h5 class="text-center table-dark heading_info">Information Details सूचना का विवरण</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                           <tbody>
                              <tr>
                                 <td style="width: 30%">Informer सूचना देने वाला</td>
                                 <td>{{$fireReport[0]->informer_name}}</td>
                              </tr>
                              <tr>
                                 <td>Informer's Contact No. सूचना देने वाले का सम्पर्क नं0</td>
                                 <td>{{$fireReport[0]->informer_contact_no}}</td>
                              </tr>
                              <tr>
                                 <td>Medium of Informate सूचना प्राप्ति का माध्यम</td>
                                 <td>{{$fireReport[0]->info_medium}}</td>
                              </tr>
                              <tr>
                                 <td>Date and Time when information is received सूचना प्राप्ति का समय</td>
                                 <td>{{ \Carbon\Carbon::parse($fireReport[0]->info_datetime)->format('d-m-Y H:i:s')}}</td>
                              </tr>
                              <tr>
                                 <td>Address of incident place घटनास्थल का पता</td>
                                 <td>{{$fireReport[0]->incident_address}}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Action Details कार्यवाही का विवरण<h5>
                        <div class="table-responsive">
                           <table class="table table-bordered table-striped table-hover">
                              <tbody>
                                 <tr>
                                    <td style="width: 30%">Departure time from Station फायर स्टेशन से प्रस्थान का समय</td>
                                    <td>{{ \Carbon\Carbon::parse($fireReport[0]->station_depart_datetime)->format('d-m-Y H:i:s') }}</td>
                                 </tr>
                                 <tr>
                                    <td>Arrival time at fire site घटनास्थल पर पहुँचने का समय</td>
                                    <td>{{ \Carbon\Carbon::parse($fireReport[0]->fire_site_arrive_datetime)->format('d-m-Y H:i:s') }}</td>
                                 </tr>
                                 <tr>
                                    <td>Return to station time फायर स्टेशन पर वापसी का समय</td>
                                    <td>{{ \Carbon\Carbon::parse($fireReport[0]->station_return_datetime)->format('d-m-Y H:i:s') }}</td>
                                 </tr>
                                 <tr>
                                    <td>Distance between station and fire site फायर स्टेशन से घटनास्थल की दूरी</td>
                                    <td>{{$fireReport[0]->distance}}</td>
                                 </tr>
                                 @php
                                 $datetime1 = new DateTime($fireReport[0]->fire_site_arrive_datetime);//start time
                                 $datetime2 = new DateTime($fireReport[0]->station_return_datetime);//end time
                                 $interval = $datetime1->diff($datetime2);
                                 $response_time = $interval->format('%H hours %i minutes %s seconds');//00 years 0 months 0 days 08 hours 0 minutes 0 seconds

                                 $response_time_in_min = $interval->format('%i');//00 years 0 months 0 days 08 hours 0 minutes 0 seconds

                                 @endphp

                                 <tr>
                                    <td>Total Response Time</td>
                                    <td>{{$response_time}}</td>
                                 </tr>

                                 <tr>
                                    <td>Average Time</td>
                                    <td>
                                       @if($response_time_in_min > 0)
                                       {{round((int) $fireReport[0]->distance / $response_time_in_min, 2)}} [KM/min]
                                       @else
                                       {{$response_time_in_min}}
                                       @endif
                                    </td>
                                 </tr>
                                 <!-- <tr>
                              <td>Details of fire service personals</td>
                              <td></td>
                              </tr> -->
                              </tbody>
                           </table>
                        </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Details of fire fighting Equipments used अग्निशमन कार्य में प्रयुक्त मशीनों का विवरण </h5>
                     <div class="table-responsive">
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
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                           <tbody>
                              <tr>
                                 <td style="width: 30%">CFO</td>
                                 <td>{{ empty($fireReport[0]->cfo) ? 'N/A' : ucwords($fireReport[0]->cfo, ",")}}</td>
                              </tr>
                              <tr>
                                 <td style="width: 30%">FSO</td>
                                 <td>{{ empty($fireReport[0]->fso) ? 'N/A' : ucwords($fireReport[0]->fso, ",")}}</td>
                              </tr>
                              <tr>
                                 <td style="width: 30%">FSSO</td>
                                 <td>{{ empty($fireReport[0]->fsso) ? 'N/A' : ucwords($fireReport[0]->fsso, ",")}}</td>
                              </tr>
                              <tr>
                                 <td style="width: 30%">LFM</td>
                                 <td>{{ empty($fireReport[0]->lfm) ? 'N/A' : ucwords($fireReport[0]->lfm, ",")}}</td>
                              </tr>
                              <tr>
                                 <td style="width: 30%">DVR</td>
                                 <td>{{ empty($fireReport[0]->dvr) ? 'N/A' : ucwords($fireReport[0]->dvr, ",")}}</td>
                              </tr>
                              <tr>
                                 <td style="width: 30%">FM</td>
                                 <td>{{ empty($fireReport[0]->fm) ? 'N/A' : ucwords($fireReport[0]->fm, ",")}}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Details of Fire अग्निकाण्ड का विवरण</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                           <tbody>
                              <tr>
                                 <td style="width: 30%">Class of Fire अग्निकाण्ड का वर्ग</td>
                                 <td>{{$fireReport[0]->fire_class}}</td>
                              </tr>
                              <tr>
                                 <td>Area of Fire अ्ग्निकाण्ड का क्षेत्र</td>
                                 <td>@if($fireReport[0]->fire_area ==1)
                                    @php echo "Rural" @endphp
                                    @else
                                    @php echo "City" @endphp
                                    @endif
                                 </td>
                              </tr>
                              <tr>
                                 <td>Type of Fire Area अग्निकाण्ड क्षेत्र का प्रकार</td>
                                 <td>
                                    @if($fireReport[0]->fire_area_type ==1)
                                    @php echo "Commercial" @endphp
                                    @elseif($fireReport[0]->fire_area_type ==2)
                                    @php echo "Residential" @endphp
                                    @elseif($fireReport[0]->fire_area_type ==3)
                                    @php echo "High Rise" @endphp
                                    @elseif($fireReport[0]->fire_area_type ==4)
                                    @php echo "Forest" @endphp
                                    @elseif($fireReport[0]->fire_area_type ==5)
                                    @php echo "Farm" @endphp
                                    @elseif($fireReport[0]->fire_area_type ==6)
                                    @php echo "Industry" @endphp
                                    @elseif($fireReport[0]->fire_area_type ==7)
                                    @php echo "Vehicle" @endphp
                                    @else
                                    @php echo "Other" @endphp
                                    @endif
                                 </td>
                              </tr>
                              <tr>
                                 <td>Insured बीमा का विवरण</td>
                                 <td>{{$fireReport[0]->insured}}</td>
                              </tr>
                              <tr>
                                 <td>Fire Category मुख्य श्रेणी</td>
                                 <td>{{ $category[0]->name ?? 'NA' }}</td>
                              </tr>

                              <tr>
                                 <td>Subcategory उप-श्रेणी</td>
                                 <td>{{ $subcategory[0]->name ?? 'NA' }}</td>
                              </tr>

                              <tr>
                                 <td>Details विवरण</td>
                                 <td>{{$fireReport[0]->fire_reason}}</td>
                              </tr>
                              <tr>
                                 <td>Was it arson based? क्या जान बूझकर लगायी गई </td>
                                 <td>
                                    @if($fireReport[0]->arson_based ==0)
                                    @php echo "Not known" @endphp
                                    @elseif($fireReport[0]->arson_based ==1)
                                    @php echo "No" @endphp
                                    @else
                                    @php echo "Yes" @endphp
                                    @endif
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Loss Details क्षति का विवरण</h5>
                     <div class="table-responsive">

                        <?php //echo "<pre>"; print_r($fireReport[0]);?>
                        <table class="table table-bordered table-striped table-hover">
                           <tbody>
                              <tr>
                                 <td style="width: 30%">Property Lost क्षति सम्पत्ति (in INR)</td>
                                 <td>{{$fireReport[0]->property_lost??'NA'}}</td>
                              </tr>
                              <tr>
                                 <td>Property Saved बचायी गई सम्पत्ति (in INR)</td>
                                 <td>{{$fireReport[0]->property_saved??'NA'}}</td>
                              </tr>
                              <tr>
                                 <td>Human lives lost मनुष्य मरे</td>
                                 <td>{{$fireReport[0]->life_lost_human??'NA'}}</td>
                              </tr>
                              <tr>
                                 <td>Human lives saved मनुष्य बचाये</td>
                                 <td>{{$fireReport[0]->life_saved_human??'NA'}}</td>
                              </tr>
                              <tr>
                                 <td>Animal lives lost पशु मरे</td>
                                 <td>{{$fireReport[0]->life_lost_animal??'NA'}}</td>
                              </tr>
                              <tr>
                                 <td>Animal lives saved पशु बचाये</td>
                                 <td>{{$fireReport[0]->life_saved_animal??'NA'}}</td>
                              </tr>
                              <tr>
                                 <td>Description विवरण</td>
                                 <td>{{$fireReport[0]->short_description??'NA'}}</td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
               </div>
               <div class="row">
                  <h5 class="text-center heading_info">Uploaded Report</h5>
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                           <tbody>
                              @if($fireReport[0]->upload =='')
                              <tr>
                                 <td style="width: 30%">Uploaded Report</td>
                                 <td>
                                    Report not uploaded
                                 </td>
                              </tr>
                              @else
                              <tr>
                                 <td style="width: 30%">Uploaded Report {{Auth::user()->id}}</td>
                                 <td>
                                    <div id="uploaded-file-div" class="btn-group" role="group">
                                       <a class="btn btn-warning" id="uploaded-file-link" target="_blank" href="{{asset($fireReport[0]->upload)}}">
                                          <span class="glyphicon glyphicon-file" aria-hidden="true"></span>Download</a>
                                    </div>

                                    @if($fireReport[0]->assigned_to == Auth::user()->id)

                                    <a id='del-file-ajax-btn' class='btn btn-danger' href="{{route('admin.deleteFireFile', $fireReport[0]->id)}}">
                                       <span class="fa fa-trash" aria-hidden="true"></span>
                                    </a>
                                    @endif
                                 </td>
                                 <td style="text-align: right;">
                                    @if($fireReport[0]->assigned_to == Auth::user()->id)
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
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td style="width: 30%">Current Status of Report</td>

                              <td>
                                 @if($fireReport[0]->status == 0)
                                 @php echo "Under Investigation" @endphp
                                 @elseif($fireReport[0]->status == 1)
                                 @php echo "Sent for Approval" @endphp
                                 @elseif($fireReport[0]->status == 2)
                                 @php echo "Sent for Review" @endphp
                                 @elseif($fireReport[0]->status == 3)
                                 @php echo "Approved" @endphp
                                 @elseif($fireReport[0]->status == 4)
                                 @php echo "Rejected" @endphp
                                 @endif
                              </td>
                           </tr>
                           @if($fireReport[0]->remark !='')
                           <tr>
                              <td style="width: 30%">Remark</td>

                              <td>
                                 @php $remarkArr = explode(",",$fireReport[0]->remark) @endphp
                                 @foreach ($remarkArr as $key=>$rmk)
                                 <p>{{$key +1}}. {{$rmk}}</p>
                                 @endforeach
                              </td>
                           </tr>
                           @endif
                        </tbody>
                     </table>
                  </div>
               </div>

               
               @if($fireReport[0]->assigned_to == Auth::user()->id)
               @if($fireReport[0]->status == 0 || $fireReport[0]->status == 2)
               <div class="row">
                  <div class="table-responsive">
                     <table class="table table-bordered table-striped table-hover">
                        <tbody>
                           <tr>
                              <td>
                                 <a href="{{route('admin.editFireReport', $fireReport[0]->id)}}" class="btn btn-primary">Update Report</a>
                              </td>

                              <td style="text-align:right;">
                                 <a href="{{route('admin.sentFireApproval', $fireReport[0]->id)}}" title="Send For Approval" class="btn btn-primary">Send For Approval</a>
                              </td>
                           </tr>
                        </tbody>
                     </table>
                  </div>
               </div>
               @endif
               @endif
               @if(Auth::user()->type == 2)

               <div class="row">
                  <table class="table table-bordered table-striped table-hover">
                     <tbody>
                        <tr>
                           @if($fireReport[0]->status == 1)
                           <td>
                              <button type="button" id="send-for-review-btn" class="btn btn-primary" onclick="openReviewModal()">Send For Review</button>
                           </td>
                           @endif

                           @if($fireReport[0]->status == 1)

                           <td>
                              <a href="{{route('admin.fireApproved', $fireReport[0]->id)}}" class="btn btn-primary">Approve</a>
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
         <form enctype="multipart/form-data" id="remark-form" action="{{route('admin.addFireRemark')}}" method="post">
            @csrf
            <div class="modal-body">
               <textarea class="form-control" maxlength="512" name="remark" placeholder="Enter Remark" style="height:100px;width: 300px;margin:auto;" required></textarea>
               <input type="hidden" name="id" value="{{$fireReport[0]->id}}">

               <input type="hidden" name="old_exist" value="{{$fireReport[0]->remark}}">
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
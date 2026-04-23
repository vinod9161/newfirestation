@extends('layouts.admin.template')
@section('title')
<title>Vehicle &amp; Machine</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Vehicle </h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('admin.vehicle');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Vehicle List
            </a>
        </div>
    </div>
</div>



<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title">
                        Edit Vehicle
                    </h5>
                    <div>
                        <a href="{{ route('admin.editvehiclestatement', $fs_vehicles->id) }}" class="btn btn-sm btn-primary">Update Vehicle Statement</a>
                        <a href="{{ route('admin.vehiclestatementreport', $fs_vehicles->id) }}" class="btn btn-sm btn-primary">Vehicle Statement Report</a>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive---">

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

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        $isRestricted = in_array(Auth::user()->type, [2,3]);
                                    @endphp
                                    <form action="{{ route('admin.updatevehicle') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>District जनपद <sup class="text-danger">*</sup></label>
                                                    <select name="districts" id="districts" class="form-control js-example-basic-single" {{ $isRestricted ? 'disabled' : '' }}>
                                                        <option value="">Select District जनपद</option>
                                                        @if ($getDistricts)
                                                            @foreach ($getDistricts as $key => $row)
                                                                @if ($row->name != 'Other')
                                                                    @if($row->id == $fs_vehicles->district_id)
                                                                        <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                                                    @else
                                                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                                    @endif
                                                                @endif
                                                            @endforeach
                                                        @else
                                                           <option value="" class="text-danger"> No Districts Available</option>
                                                        @endif
                                                    </select>
                                                    @if($isRestricted)
                                                        <input type="hidden" name="districts" value="{{ $fs_vehicles->district_id }}">
                                                    @endif
                                                    <span class="text-danger" id="districtsError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fire Station फायर स्टेशन <sup class="text-danger">*</sup></label>
                                                    <select name="firestation" id="firestation" class="form-control js-example-basic-single" {{ $isRestricted ? 'disabled' : '' }}>
                                                        <option value="">--- Select Station फायर स्टेशन ---</option>
                                                        @if ($getfirestation)
                                                            @foreach ($getfirestation as $key => $row)
                                                                @if($row->id == $fs_vehicles->station_id)
                                                                    <option value="{{ $row->id }}" selected>{{ $row->name }}</option>
                                                                @else
                                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        @else
                                                           <option value="" class="text-danger"> No Fire Stations Available</option>
                                                        @endif

                                                    </select>
                                                    @if($isRestricted)
                                                    <input type="hidden" name="firestation" value="{{ $fs_vehicles->station_id }}">
                                                    @endif
                                                    <span class="text-danger" id="stationError"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Registration Number<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="reg_number" id="reg_number" type="text" placeholder="Registration Number" value="{{ $fs_vehicles->reg_number ?? 'NA' }}" {{ $isRestricted ? 'readonly' : '' }} required />
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Chassis Number<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="chassis_number" id="chassis_number" type="text" placeholder="Chassis Number" value="{{ $fs_vehicles->chassis_number ?? 'NA' }}" {{ $isRestricted ? 'readonly' : '' }} required />
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Engine Number<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="engine_number" id="engine_number" type="text" placeholder="Engine Number" value="{{ $fs_vehicles->engine_number ?? 'NA' }}" {{ $isRestricted ? 'readonly' : '' }} required />
                                              </div>
                                           </div>


                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Vehicle Type<sup class="text-danger">*</sup></label>
                                                 <select class="form-control js-example-basic-single" name="vehicle_type" id="vehicle_type" {{ $isRestricted ? 'disabled' : '' }} required>
                                                    <option value="">--- Select Type ---</option>
                                                    @if ($getvehicleTypes)
                                                        @foreach ($getvehicleTypes as $key => $row)
                                                            <option {{ $fs_vehicles->vehicle_type == $row->id ? 'selected' : '' }} value="{{ $row->id }}">{{ $row->type }}</option>
                                                        @endforeach
                                                    @else
                                                       <option value="" class="text-danger"> No Vehicle Type Available</option>
                                                    @endif
                                                 </select>
                                                 @if($isRestricted)
                                                    <input type="hidden" name="vehicle_type" value="{{ $fs_vehicles->vehicle_type }}">
                                                 @endif
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Make Year मेक वर्ष<sup class="text-danger">*</sup></label>
                                                 <select class="form-control js-example-basic-single" name="make_year" id="make_year" {{ $isRestricted ? 'disabled' : '' }} required>
                                                    <option value="">Select Make Year मेक वर्ष</option>

                                                    <?php
                                                       $options = "";
                                                       $nowY = date('Y');

                                                       for ($Y = $nowY; $Y >= 1980; $Y--) {

                                                           if($Y==$fs_vehicles->make_year)
                                                           {
                                                                $options .= "<option selected>" . $Y . "</option>";
                                                           }
                                                           else{
                                                                $options .= "<option>" . $Y . "</option>";
                                                           }

                                                       }

                                                       echo $options;
                                                    ?>

                                                 </select>
                                                 @if($isRestricted)
                                                    <input type="hidden" name="make_year" value="{{ $fs_vehicles->make_year }}">
                                                 @endif
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Make and Model मेक माडल कम्पनी सहित <sup class="text-danger">*</sup></label>
                                                 <input class="form-control" name="year" id="year" type="text" placeholder="मेक माडल कम्पनी सहित" value="{{ $fs_vehicles->year ?? 'NA' }}" {{ $isRestricted ? 'readonly' : '' }} required />
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>वाहन की क्षमता ली0 में Water capacity in Ltr<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="capacity" id="capacity" type="number" placeholder="वाहन की क्षमता ली0 में" value="{{ $fs_vehicles->capacity ?? 'NA' }}" required />
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Used Date प्रयोग तिथि<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="use_date" id="use_date" type="date" placeholder="प्रयोग तिथि" value="{{ $fs_vehicles->use_date ?? 'NA' }}" {{ $isRestricted ? 'readonly' : '' }} required />
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Run till Date आज तक चले किमी0<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="km_drive" id="km_drive" type="number" placeholder="29 फरवरी 2020 तक चले किमी0" value="{{ $fs_vehicles->km_drive ?? 'NA' }}" required />
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>प्रयोग तिथि से अब तक वाहन पर मरम्मत पर व्यय<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="total_invest" id="total_invest" type="text" placeholder="प्रयोग तिथि से अब तक वाहन पर मरम्मत पर व्यय" value="{{ $fs_vehicles->total_invest ?? 'NA' }}" required />
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>वाहन द्वारा कितनी आग बुझायी गई<sup class="text-danger">*</sup></label>
                                                 <input class="form-control"  name="total_fire" id="total_fire" type="text" placeholder="वाहन द्वारा कितनी आग बुझायी गई" value="{{ $fs_vehicles->total_fire ?? 'NA' }}" required />
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Vehicle Remark<sup class="text-danger">*</sup></label>
                                                 <select class="form-control js-example-basic-single" name="vehicle_remark" id="vehicle_remark" required>
                                                    <option value="">--- Select Remark Type ---</option>
                                                    <option value="working" <?php if($fs_vehicles->vehicle_remark == 'working'){echo 'selected';} ?>>Working</option>
                                                    <option value="under maintenence" <?php if($fs_vehicles->vehicle_remark == 'under maintenence'){echo 'selected';} ?>>Under Maintenaince </option>
                                                    <option value="out of road" <?php if($fs_vehicles->vehicle_remark == 'out of road'){echo 'selected';} ?>>Out of Road</option>
                                                    <option value="service" <?php if($fs_vehicles->vehicle_remark == 'service'){echo 'selected';} ?>>Service</option>
                                                    <option value="other" <?php if($fs_vehicles->vehicle_remark == 'other'){echo 'selected';} ?>>Other </option>
                                                 </select>
                                              </div>
                                           </div>
                                            <div class="col-md-12">
                                                <input type="hidden" name="vid" id="vid" value="{{ $fs_vehicles->id }}">
                                                <button type="submit" id="addVehicle" class="btn btn-primary btn-sm" style="width:20%">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

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

var station = '';
  $("#district_id").change(function () {
   station =  district[$("#district_id").prop('selectedIndex')-1]['station'];
  $('#station_id').find('option:not(:first)').remove();

  $.each(station, function (index, value) {
        $('#station_id').append($("<option></option>").attr("value", value["id"]).text(value["name"]));
  });
});

jQuery(document).ready(defaultStation());

function defaultStation(){

   station =  district[$("#district_id").prop('selectedIndex')-1]['station'];
   $('#station_id').find('option:not(:first)').remove();

     $.each(station, function (index, value) {

      if(value["id"] == $("#district_id").val()) {
         $('#station_id').append($("<option selected></option>").attr("value", value["id"]).text(value["name"]));
      } else {
         $('#station_id').append($("<option></option>").attr("value", value["id"]).text(value["name"]));
      }

     });
}

var nowY = new Date().getFullYear(),
    options = "";
    options_my = "";
    options_st = "";

var year =  @json($vehicle->year);

for(var Y=nowY; Y>=1980; Y--) {

   if(Y == year) {
      options += "<option selected>"+ Y +"</option>";
   } else {
      options += "<option>"+ Y +"</option>";
   }

}

$("#year").append( options );

var make_year =  @json($vehicle->make_year);

for(var my=nowY; my>=1980; my--) {

   if(my == make_year) {
      options_my += "<option selected>"+ my +"</option>";
   } else {
      options_my += "<option>"+ my +"</option>";
   }
}

$("#make_year").append( options_my );

for(var st=nowY; st<=2050; st++) {
   options_st += "<option>"+ st +"</option>";
}

$("#statement_year").append( options_st );
$(document).ready(function () {
   $("#date-popover").popover({html: true, trigger: "manual"});
   $("#date-popover").hide();
   $("#date-popover").click(function (e) {
       $(this).hide();
   });

   $("#my-calendar").zabuto_calendar({
       action: function () {
           return myDateFunction(this.id, false);
       },
       action_nav: function () {
           return myNavFunction(this.id);
       },
       ajax: {
           url: "show_data.php?action=1",
           modal: true
       },
       legend: [
           {type: "text", label: "Special event", badge: "00"},
           {type: "block", label: "Regular event", }
       ]
   });

   $( "#date-datepicker" ).datepicker({
       changeMonth: true,
       changeYear: true,
       minDate: 0,
       dateFormat: 'yy-mm-dd'
   });

   $( "#from-datepicker" ).datepicker({
       defaultDate: "+1w",
       changeMonth: true,
       numberOfMonths: 1,
       dateFormat: 'yy-mm-dd',
       changeMonth: true,
       changeYear: true,
       onClose: function( selectedDate ) {
           $( "#to-datepicker" ).datepicker( "option", "minDate", selectedDate );
       }
   });

   $( "#to-datepicker" ).datepicker({
       defaultDate: "+1w",
       changeMonth: true,
       numberOfMonths: 1,
       dateFormat: 'yy-mm-dd',
       changeMonth: true,
       changeYear: true,
       onClose: function( selectedDate ) {
           $( "#from-datepicker" ).datepicker( "option", "maxDate", selectedDate );
       }
   });
});

function myNavFunction(id) {
   $("#date-popover").hide();
   var nav = $("#" + id).data("navigation");
   var to = $("#" + id).data("to");
   console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
}

$(document).ready(function() {

   $('#statement-table').DataTable( {
        initComplete: function () {
          //  this.api().columns().every( function () {
             this.api().columns([1]).every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value="" selected>Select</option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(

                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );














$("#statement_year").append( options_st );
$(document).ready(function () {
   $("#date-popover").popover({html: true, trigger: "manual"});
   $("#date-popover").hide();
   $("#date-popover").click(function (e) {
       $(this).hide();
   });

   $("#my-calendar").zabuto_calendar({
       action: function () {
           return myDateFunction(this.id, false);
       },
       action_nav: function () {
           return myNavFunction(this.id);
       },
       ajax: {
           url: "show_data.php?action=1",
           modal: true
       },
       legend: [
           {type: "text", label: "Special event", badge: "00"},
           {type: "block", label: "Regular event", }
       ]
   });

   $( "#date-datepicker" ).datepicker({
       changeMonth: true,
       changeYear: true,
       minDate: 0,
       dateFormat: 'yy-mm-dd'
   });

   $( "#from-datepicker" ).datepicker({
       defaultDate: "+1w",
       changeMonth: true,
       numberOfMonths: 1,
       dateFormat: 'yy-mm-dd',
       changeMonth: true,
       changeYear: true,
       onClose: function( selectedDate ) {
           $( "#to-datepicker" ).datepicker( "option", "minDate", selectedDate );
       }
   });

   $( "#to-datepicker" ).datepicker({
       defaultDate: "+1w",
       changeMonth: true,
       numberOfMonths: 1,
       dateFormat: 'yy-mm-dd',
       changeMonth: true,
       changeYear: true,
       onClose: function( selectedDate ) {
           $( "#from-datepicker" ).datepicker( "option", "maxDate", selectedDate );
       }
   });
});



    $(document).ready(function(){
        $(document).on('change', '#districts', function() {
        let districts = $(this).val();
        let firestation = '';

        if (districts === '') {
            $('#districtsError').html('Missing Districts Data').delay(3000).fadeOut().css('display', 'block');
            return false;
        }

        $.ajax({
            url: '{{ route("admin.getfirestation") }}',
            type: 'POST',
            data: {
                districts: districts,
                _token: '{{ csrf_token() }}'
            },
            success: function(resp)
            {
                station = '<option value="">Select Station फायर स्टेशन</option>';

                console.log(resp);

                if (resp.status === 0)
                {
                    station += '<option value="" class="text-danger">No fire station found against this districts</option>';
                }
                else
                {
                    $.each(resp.data, function(key, value)
                    {
                        station += '<option value="' + value.id + '">' + value.name + '</option>';
                    });
                }
                $('#firestation').html(station);

                if ($('#firestation').data('select2')) {
                    $('#firestation').select2().val(null).trigger('change'); // Reset and refresh
                }
                else {
                    $('#firestation').val(null); // If not using a plugin, just reset the value
                }
            }
        });
    });
    });
</script>
@stop

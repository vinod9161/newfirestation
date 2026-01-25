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
                        Vehicle Statement Report
                    </h5>
                    <div>
                        <a href="{{ route('admin.editdata', $fs_vehicles->id) }}" class="btn btn-sm btn-primary">Edit Vehicle</a>
                        <a href="{{ route('admin.editvehiclestatement', $fs_vehicles->id) }}" class="btn btn-sm btn-primary">Edit Vehicle Statement</a>
                    </div>
                </div>
            </div>


            <div class="card-body">
                <div class="table-responsive">
                    <table class="table ucp-table table-hover table-bordered display" id="statement-table" cellspacing="0" width="100%">
                        <thead>
                           <tr>
                              <th style="width:10%;">Month</th>
                              <th>Year</th>
                              <th>Total Run (Fire)</th>
                              <th>Total Run (Other)</th>
                              <th>Total Pumping (Fire)</th>
                              <th>Total Pumping (Other)</th>
                              <th>Total Fuel Expense</th>
                              <th>Total Maintenance Expense</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php
                           $i = 1;
                           @endphp 
                           @foreach ($vehicleStatement as $statement)
                           <tr class="my-job-item">
                              <td style="width:10%;">{{$statement->month}}</td>
                              <td>{{$statement->year}}</td>
                              <td>{{$statement->total_run_fire}}</td>
                              <td>{{$statement->total_run_other}}</td>
                              <td>{{$statement->total_pumping_fire}}</td>
                              <td>{{$statement->total_pumping_other}}</td>
                              <td>{{$statement->total_fuel_expense}}</td>
                              <td>{{$statement->total_maintenance_expense}}</td>
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
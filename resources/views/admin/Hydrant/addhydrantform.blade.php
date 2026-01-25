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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Hydrants</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.hydrant');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Hydrant List
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
                    Add Hydrant
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
                                    <form action="{{ route('admin.savehydrant') }}" method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>District जनपद <sup class="text-danger">*</sup></label>
                                                    <select name="districts" id="districts" class="form-control js-example-basic-single">
                                                        <option value="">Select District जनपद</option>
                                                        @if ($getDistricts)
                                                            @foreach ($getDistricts as $key => $row)
                                                                @if ($row->name != 'Other')
                                                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                                                @endif 
                                                            @endforeach
                                                        @else
                                                           <option value="" class="text-danger"> No Districts Available</option> 
                                                        @endif
                                                    </select>
                                                    <span class="text-danger" id="districtsError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Fire Station फायर स्टेशन <sup class="text-danger">*</sup></label>
                                                    <select name="firestation" id="firestation" class="form-control js-example-basic-single">
                                                        <option value="">--- Select Station फायर स्टेशन ---</option>
                                                    </select>
                                                    <span class="text-danger" id="stationError"></span>
                                                </div>
                                            </div>


                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Address Of Water Sources जल स्रोत का पता <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="water_source" id="water_source" class="form-control" placeholder="Enter Address of Water Sources">
                                                    <span class="text-danger" id="waterError"></span>
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Type प्रकार<sup class="text-danger">*</sup></label>
                                                    <select class="form-control js-example-basic-single" name="hydrant_type" id="hydrant_type">
                                                        <option value="">--Select Type--</option>
                                                            @if ($getType)
                                                                @foreach ($getType as $key => $row)
                                                                    <option value="{{ $row->id }}">{{ $row->hydrant_type }}</option> 
                                                                @endforeach
                                                            @else
                                                               <option value="" class="text-danger"> No Type Available</option> 
                                                            @endif
                                                     </select>
                                                    <span class="text-danger" id="typeError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Latitude अक्षांश <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="lat" id="lat" class="form-control" placeholder="Enter Latitude">
                                                    <span class="text-danger" id="latError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Longitude देशान्तर <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="long" id="long" class="form-control" placeholder="Enter Longitude">
                                                    <span class="text-danger" id="longError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label>Hydrant Condition हाइड्रेन्ट की स्थिति <sup class="text-danger">*</sup></label>
                                                    <select class="custom-select form-control js-example-basic-single" name="hydrant_condtion" id="hydrant_condtion">
                                                        <option value="">--Select Condition--</option>
                                                            @if ($getCondition)
                                                                @foreach ($getCondition as $key => $row)
                                                                    <option value="{{ $row->id }}">{{ $row->hydrant_condition }}</option> 
                                                                @endforeach
                                                            @else
                                                               <option value="" class="text-danger"> No Condition Available</option> 
                                                            @endif
                                                     </select>
                                                    <span class="text-danger" id="condError"></span>
                                                </div>
                                            </div>



                                            <div class="col-md-12">
                                                <button type="submit" id="addHydrant" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
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

<script src="{{ asset('')}}"></script>
<script>
$(function(e) {

    // file export datatable
    $('#datatable-basic').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
    });
});


// form validation

$(document).ready(function(){
    $('#addHydrant').on('click', function(){
        let districts           = $('#districts').val();
        let firestation         = $('#firestation').val();
        let water_source        = $('#water_source').val();
        let hydrant_type        = $('#hydrant_type').val();
        let lat                 = $('#lat').val();
        let long                = $('#long').val();
        let hydrant_condtion    = $('#hydrant_condtion').val();
        
        if(districts=='')
        {
            $('#districtsError').html('Required Districts').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(firestation=='')
        {
            $('#stationError').html('Required Fire Stations').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(water_source=='')
        {
            $('#waterError').html('Required Addores of Water Sources').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(hydrant_type=='')
        {
            $('#typeError').html('Required Type').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(lat=='')
        {
            $('#latError').html('Required Latitude').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(long=='')
        {
            $('#longError').html('Required Longitude').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else if(hydrant_condtion=='')
        {
            $('#condError').html('Required Hydrant Condition').delay(3000).fadeOut().css('display','block');
            return false;
        }
        else{
            return true;
        }
    });
});

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



</script>
@stop
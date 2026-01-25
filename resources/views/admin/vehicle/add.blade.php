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
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add New Vehicle
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
                                    <form action="{{ route('admin.savevehicle') }}" method="post">
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
                                                 <label>Registration Number<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="reg_number" id="reg_number" type="text" placeholder="Registration Number" required />               
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Chassis Number<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="chassis_number" id="chassis_number" type="text" placeholder="Chassis Number" required />               
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Engine Number<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="engine_number" id="engine_number" type="text" placeholder="Engine Number" required />               
                                              </div>
                                           </div>


                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Vehicle Type<sup class="text-danger">*</sup></label>      
                                                 <select class="form-control js-example-basic-single" name="vehicle_type" id="vehicle_type" required>
                                                    <option value="">--- Select Type ---</option>
                                                    @if ($getvehicleTypes)
                                                        @foreach ($getvehicleTypes as $key => $row)
                                                            <option value="{{ $row->type }}">{{ $row->type }}</option>
                                                        @endforeach
                                                    @else
                                                       <option value="" class="text-danger"> No Vehicle Type Available</option> 
                                                    @endif
                                                 </select>
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Make Year मेक वर्ष<sup class="text-danger">*</sup></label>      
                                                 <select class="form-control js-example-basic-single" name="make_year" id="make_year" required>
                                                    <option value="">Select Make Year मेक वर्ष</option>
                                                    
                                                    <?php
                                                       $options = "";
                                                       $nowY = date('Y');

                                                       for ($Y = $nowY; $Y >= 1980; $Y--) {
                                                           $options .= "<option>" . $Y . "</option>";
                                                       }

                                                       echo $options;
                                                    ?>

                                                 </select>
                                              </div>
                                           </div>

                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Make and Model मेक माडल कम्पनी सहित <sup class="text-danger">*</sup></label>
                                                 <input class="form-control" name="year" id="year" type="text" placeholder="मेक माडल कम्पनी सहित" required />       
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>वाहन की क्षमता ली0 में Water capacity in Ltr<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="capacity" id="capacity" type="number" placeholder="वाहन की क्षमता ली0 में" required />               
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Used Date प्रयोग तिथि<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="use_date" id="use_date" type="date" placeholder="प्रयोग तिथि" required />               
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Run till Date आज तक चले किमी0<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="km_drive" id="km_drive" type="number" placeholder="29 फरवरी 2020 तक चले किमी0" required />               
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>प्रयोग तिथि से अब तक वाहन पर मरम्मत पर व्यय<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="total_invest" id="total_invest" type="text" placeholder="प्रयोग तिथि से अब तक वाहन पर मरम्मत पर व्यय" required />               
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>वाहन द्वारा कितनी आग बुझायी गई<sup class="text-danger">*</sup></label>      
                                                 <input class="form-control"  name="total_fire" id="total_fire" type="text" placeholder="वाहन द्वारा कितनी आग बुझायी गई " required />               
                                              </div>
                                           </div>
                                           <div class="col-md-4">
                                              <div class="form-group">
                                                 <label>Vehicle Remark<sup class="text-danger">*</sup></label>      
                                                 <select class="form-control js-example-basic-single" name="vehicle_remark" id="vehicle_remark" required>
                                                    <option value="">--- Select Remark Type ---</option>
                                                    <option value="working">Working</option>
                                                    <option value="under maintenence">Under Maintenaince </option>
                                                    <option value="out of road">Out of Road</option>
                                                    <option value="service">Service</option>
                                                    <option value="other">Other </option>
                                                 </select>
                                              </div>
                                           </div>
                                            <div class="col-md-12">
                                                <button type="submit" id="addVehicle" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
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
@extends('layouts.admin.template')
@section('title')
<title>Types | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
label {
    font-size: 12px;
}
</style>
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Stand By Duty Requests</h5>
    </div>
    <div class="d-flex app-header-btn">

        <div>
            <a href="<?php echo route('admin.standby');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Stand By Duty List
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
                    Add Stand By Duty Details
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
                        <form action="{{route('admin.addInspectionByOfficerPost')}}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="body-box-admin">
                                <div class="body-box-admin tab-content card" style="padding:0px">
                                    <h2 class="text-center heading_info">Add Inspection by Officers</h2>
                                    <p class="note" style="margin-left:10px">Fields with <span class="text-danger">*</span>
                                        are required.</p>
                                    <div class="row mt-3" style="padding: 0 30px 25px;">

                                        <div class="col-md-4 col-sm-12" style="float: left">
                                            <div class="form-group">
                                                <label class="control-label required" style="text-align: right;"
                                                    for="districts">District जपपद <span class="text-danger">*</span></label>
                                                <select class="form-control" name="district_id"
                                                    id="districts"  required>
                                                    <option value="">Select District जनपद</option>
                                                    @foreach ($districts as $dist)

                                                    <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>

                                                    @endforeach
                                                </select>
                                                <span class="text-danger" id="districtsError"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12" style="float: right">
                                            <div class="form-group">
                                                <label class="control-label required" style="text-align: right;"
                                                    for="FireReport_fire_station_id">Fire Station फायर स्टेशन <span class="text-danger">*</span></label>
                                                <select class="form-control" name="station_id" id="firestation" 
                                                    required>
                                                    <option value="{{$fso_station->id ?? ''}}">
                                                        {{$fso_station->name ?? ''}} </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Designation of Officer <span class="text-danger">*</span></label>
                                                <input type="text" name="designation" class="form-control"
                                                    id="designation" placeholder="Designation of Officer" required />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Name of Officer <span class="text-danger">*</span></label>
                                                <input type="text" name="officer_name" class="form-control"
                                                    id="officer_name" placeholder="Name of Officer  " required />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-10 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">Date of
                                                    Inspection <span class="text-danger">*</span></label>
                                                <input type="date" name="date" class="form-control" id="date"
                                                    placeholder="Date of Inspection" required />
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-sm-12" style="float: right">
                                            <div class="form-group">
                                                <label class="control-label required" style="text-align: right;"
                                                    for="FireReport_fire_station_id">Type Of inspection <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control" name="type" id="type" required>
                                                    <option value="">Select Type Of inspection</option>
                                                    <option value="Yearly">Yearly</option>
                                                    <option value="Half Yearly">Half Yearly</option>
                                                    <option value="Quarterly">Quarterly</option>
                                                    <option value="Monthly">Monthly</option>
                                                    <option value="Surprise">Surprise</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Other Comments <span class="text-danger">*</span></label>
                                                <textarea name="comment" class="form-control" id="comment"
                                                    placeholder="Other Comments" style="height:40px;"
                                                    required></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pl-lg-4 text-center mb-3">
                                        <a href="{{route('admin.district')}}" class="btn btn-sm btn-secondary">Back</a>
                                        <button class="save-btn hover-btn btn btn-primary" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')

<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>

<script src="{{ asset('')}}"></script>
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

$(document).ready(function() {
    $('#addStandby').on('click', function() {
        let program_type = $('#type').val();
        let name = $('#type').val();
        let address = $('#type').val();
        let district_id = $('#type').val();
        let email = $('#type').val();
        let mobile_no = $('#type').val();
        let contact_person = $('#type').val();
        let program_datetime = $('#type').val();
        let crowd_size = $('#type').val();

        if (program_type == '') {
            var msg = 'Program type field is required';
            $('#error_1').val(msg);
        }
        elseif(name == '') {
            var msg = 'Name field is required';
            $('#error_2').val(msg);
        }
        elseif(address == '') {
            var msg = 'Address field is required';
            $('#error_3').val(msg);
        }
        elseif(district_id == '') {
            var msg = 'District field is required';
            $('#error_4').val(msg);
        }
        elseif(email == '') {
            var msg = 'Email address field is required';
            $('#error_5').val(msg);
        }
        elseif(mobile_no == '') {
            var msg = 'Mobile number field is required';
            $('#error_6').val(msg);
        }
        elseif(contact_person == '') {
            var msg = 'Contact person field is required';
            $('#error_7').val(msg);
        }
        elseif(program_datetime == '') {
            var msg = 'Program datte time field is required';
            $('#error_8').val(msg);
        }
        elseif(crowd_size == '') {
            var msg = 'Crowd size field is required';
            $('#error_9').val(msg);
        }
        else {
            return true;
        }
    });
});
</script>
@stop

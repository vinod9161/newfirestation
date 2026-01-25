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
    label
    {
        font-size: 12px;
    }
</style>
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Fire / Rescue / Other Incident Report Requests</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="<?php echo route('admin.incident');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Incident Report List
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
                    Add Manage Fire / Rescue / Other Incident Report Requests
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
                        <form action="{{ route('admin.saveIncident') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Type of Report रिपोर्ट का प्रकार <sup class="text-danger">*</sup></label>
                                        <select name="report_type" id="report_type" class="form-control js-example-basic-single">
                                            <option value="">--- Select Type of Report ---</option>
                                            <option value=" fire"> Fire अग्निकाण्ड</option>
                                            <option value="rescue">Rescue जीव रक्षा</option>
                                            <option value="other">Other अन्य </option>
                                        </select>
                                        <span class="text-danger" id="error_1"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date of Incident घटना का दिनांक <sup class="text-danger">*</sup></label>
                                        <input type="date" name="date" id="date" class="form-control" placeholder="Enter Date">
                                        <span class="text-danger" id="error_2"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label> Aadhar Number आधार संख्या <sup class="text-danger">*</sup></label>
                                        <input type="text" name="aadhar_no" id="aadhar_no" class="form-control" placeholder="Enter Aadhar Number">
                                        <span class="text-danger" id="error_3"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Name of the person/institution व्यक्ति अथवा संस्था का नाम <sup class="text-danger">*</sup></label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name of the person/institution">
                                        <span class="text-danger" id="error_4"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address पता <sup class="text-danger">*</sup></label>
                                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address">
                                        <span class="text-danger" id="error_5"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>District जनपद <sup class="text-danger">*</sup></label>
                                        <select name="district_id" id="district_id" class="form-control js-example-basic-single">
                                            <option value="">--- Select District ---</option>
                                            @foreach($district as $index => $dist)
                                            <option value="{{ $dist->id }}">{{ $dist->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger" id="error_6"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Your Email Address ई-मेल <sup class="text-danger">*</sup></label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter Email Address">
                                        <span class="text-danger" id="error_7"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Your Mobile Number मोबाइल नं0 <sup class="text-danger">*</sup></label>
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Enter Mobile Number">
                                        <span class="text-danger" id="error_8"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contact person सम्पर्क हेतु व्यक्ति <sup class="text-danger">*</sup></label>
                                        <input type="text" name="contact_person" id="contact_person" class="form-control" placeholder="Enter Contact person">
                                        <span class="text-danger" id="error_9"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" id="addIncident" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
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
    $(document).on('click', '#addIncident', function(){
        let report_type = $('#report_type').val();
        let date = $('#date').val();
        let aadhar_no = $('#aadhar_no').val(); 
        let name = $('#name').val();
        let address = $('#address').val();
        let district_id = $('#district_id').val();
        let email = $('#email').val();
        let mobile_no = $('#mobile_no').val();
        let contact_person = $('#contact_person').val();   
        if(report_type == '')
        {
            var msg = 'Type of Report field is required';
            $('#error_1').val(msg);
        }
        else if(date == '')
        {
            var msg = 'Date field is required';
            $('#error_2').val(msg);
        }
        else if(aadhar_no == '')
        {
            var msg = 'Aadhar No field is required';
            $('#error_3').val(msg);
        }
        else if(name == '')
        {
            var msg = 'Name field is required';
            $('#error_4').val(msg);
        }
        else if(address == '')
        { 
            var msg = 'Address field is required';
            $('#error_5').val(msg);
        }
        else if(district_id == '')
        {
            var msg = 'District field is required';
            $('#error_6').val(msg);
        }
        else if(email == '')
        {
            var msg = 'Email address field is required';
            $('#error_7').val(msg);
        }
        else if(mobile_no == '')
        {
            var msg = 'Mobile number field is required';
            $('#error_8').val(msg);
        }
        else if(contact_person == '')
        {
            var msg = 'Contact person field is required';
            $('#error_9').val(msg);
        }
        else{
            return true;
        }
    });
});
</script>
@stop
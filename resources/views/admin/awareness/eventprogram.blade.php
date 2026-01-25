@extends('layouts.admin.template')
@section('title')
<title>Awareness Program | Admin Dashboard</title>
@endsection
@section('style')
<style>
    input:read-only {
        background-color: #eee;
    }

    select:read-only {
        background-color: #eee;
    }
</style>
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
   <div>
      <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Manage Public Awareness Program Requests</h5>
   </div>
   <div class="d-flex app-header-btn">
      <div>
         <a href="<?php echo route('admin.addAwareness'); ?>" class="btn ripple btn-wave btn-success mb-0">
            <i class="fe fe-plus me-1"></i> Add Public Awareness Program
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
               Awareness Event Program Requests
            </div>
         </div>
         <div class="card-body">
            <div class="table-responsive">
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

               @if ($errors->any())
                  <div class="alert alert-danger">
                     <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                        @endforeach
                     </ul>
                  </div>
               @endif

               <form method="post" action="{{ route('admin.awarenessEventProgramData') }}" id="eventPrograme" enctype="multipart/form-data">
                @csrf
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Application No<sup class="text-danger">*</sup></label>
                            <input type="text" name="application_no" id="application_no" class="form-control" placeholder="Enter Application No" value="{{ $getData->application_id ?? '' }}" readonly>
                            <span class="text-danger" id="application_no_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Program Type<sup class="text-danger">*</sup></label>
                            <input type="text" name="program_type" id="program_type" class="form-control" placeholder="Enter Program Type" value="{{ $getData->program_type ?? '' }}" readonly>
                            <span class="text-danger" id="program_type_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Program Date<sup class="text-danger">*</sup></label>
                            <input type="text" name="program_date" id="program_date" class="form-control" placeholder="Enter Program Date" value="{{ $getData->program_datetime ? \Carbon\Carbon::parse($getData->program_datetime)->format('d-m-Y H:i:s') : '' }}" readonly>
                            <span class="text-danger" id="program_date_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Applicant Name<sup class="text-danger">*</sup></label>
                            <input type="text" name="applicant_name" id="applicant_name" class="form-control" placeholder="Enter Applicant Name" value="{{ $getData->name ?? '' }}" readonly>
                            <span class="text-danger" id="applicant_name_error"></span>
                        </div>

                        <div class="col-md-6 form-group">
                            <label>Event Venue Address<sup class="text-danger">*</sup></label>
                            <input type="text" name="program_venue_address" id="program_venue_address" class="form-control" placeholder="Enter Event Venue Address" value="{{ $getData->address ?? '' }}" readonly>
                            <span class="text-danger" id="program_venue_address_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>District<sup class="text-danger">*</sup></label>
                            <select name="district" id="district" class="form-control" readonly>
                                <option value="">Select District</option>
                                <option value="{{ $getData->did ?? '' }}" selected>{{ $getData->d_name ?? '' }}</option>
                            </select>
                            <span class="text-danger" id="district_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Fire Station<sup class="text-danger">*</sup></label>
                            <select name="fire_station" id="fire_station" class="form-control" readonly>
                                <option value="">Select Fire Station</option>
                                <option value="{{ $getData->fs_id ?? '' }}" selected>{{ $getData->f_name ?? '' }}</option>
                            </select>
                            <span class="text-danger" id="fire_station_error"></span>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Details of fire service personnel participating in the program<sup class="text-danger">*</sup></label>
                            <input type="text" name="participating_person" id="participating_person" class="form-control" placeholder="Enter fire service personnel participating in the program">
                            <span class="text-danger" id="participating_person_error"></span>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Details of institutions/public participating in the program<sup class="text-danger">*</sup></label>
                            <input type="text" name="participating_public" id="participating_public" class="form-control" placeholder="Enter institutions/public participating in the program" value="{{ $getData->crowd_size ?? '' }}" readonly>
                            <span class="text-danger" id="participating_public_error"></span>
                        </div>

                        <div class="col-md-4 form-group">
                            <label>Details of deployed vehicles/machines/equipment in the program<sup class="text-danger">*</sup></label>
                            <input type="text" name="vehicles" id="vehicles" class="form-control" placeholder="Enter deployed vehicles/machines/equipment in the program">
                            <span class="text-danger" id="vehicles_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Details of the program<sup class="text-danger">*</sup></label>
                            <input type="text" name="program_details" id="program_details" class="form-control" placeholder="Enter Program Details">
                            <span class="text-danger" id="program_details_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Image of the Program 1<sup class="text-danger">*</sup></label>
                            <input type="file" name="program_photo_1" id="program_photo_1" class="form-control" placeholder="Enter Image Program 1">
                            <span class="text-danger" id="program_photo_1_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Image of the Program 2<sup class="text-danger">*</sup></label>
                            <input type="file" name="program_photo_2" id="program_photo_2" class="form-control" placeholder="Enter Image Program 2">
                            <span class="text-danger" id="program_photo_2_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Attachment (Only PDF)</label>
                            <input type="file" name="program_photo_3" id="program_photo_3" class="form-control" placeholder="Enter Attachment File">
                            <span class="text-danger" id="program_photo_3_error"></span>
                        </div>

                        <div class="col-md-12 form-group">
                            <label>Program Feedback Report<sup class="text-danger">*</sup></label>
                            <textarea name="program_feedback_report" id="program_feedback_report" class="form-control" placeholder="Enter Program Feedback Report"></textarea>
                            <span class="text-danger" id="program_feedback_report_error"></span>
                        </div>

                        <div class="col-md-3 form-group">
                            <input type="hidden" name="apid" id="apid" value="{{ $getData->id ?? '' }}">
                            <button type="submit" name="addEventData" class="btn btn-primary w-50">Submit</button>
                            <a href="javascript:void(0);" onClick="history.back()" class="btn btn-danger w-30">Back</a>
                        </div>
                    </div>  
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<!--End::row-1 -->

@endsection
@section('scripts')
<script>
   $(document).ready(function() {
        // Form submission validation
        $('#eventPrograme').on('submit', function(e) {
            let isValid = true;

            // Reset error messages
            $('.text-danger').text('');

            // Application No
            let application_no = $('#application_no').val().trim();
            if (application_no === '') {
                $('#application_no_error').text('Please enter Application No');
                isValid = false;
            }

            // Program Type
            let program_type = $('#program_type').val().trim();
            if (program_type === '') {
                $('#program_type_error').text('Please enter Program Type');
                isValid = false;
            }

            // Program Date
            let program_date = $('#program_date').val().trim();
            if (program_date === '') {
                $('#program_date_error').text('Please enter Program Date');
                isValid = false;
            } else {
                // Validate date format (DD-MM-YYYY HH:mm:ss)
                let datePattern = /^\d{2}-\d{2}-\d{4} \d{2}:\d{2}:\d{2}$/;
                if (!datePattern.test(program_date)) {
                    $('#program_date_error').text('Please enter a valid date format (DD-MM-YYYY HH:mm:ss)');
                    isValid = false;
                }
            }

            // Applicant Name
            let applicant_name = $('#applicant_name').val().trim();
            if (applicant_name === '') {
                $('#applicant_name_error').text('Please enter Applicant Name');
                isValid = false;
            }

            // Program Venue Address
            let program_venue_address = $('#program_venue_address').val().trim();
            if (program_venue_address === '') {
                $('#program_venue_address_error').text('Please enter Program Venue Address');
                isValid = false;
            }

            // District
            let district = $('#district').val().trim();
            if (district === '') {
                $('#district_error').text('Please select a District');
                isValid = false;
            }

            // Fire Station
            let fire_station = $('#fire_station').val().trim();
            if (fire_station === '') {
                $('#fire_station_error').text('Please select a Fire Station');
                isValid = false;
            }

            // Participating Person
            let participating_person = $('#participating_person').val().trim();
            if (participating_person === '') {
                $('#participating_person_error').text('Please enter details of fire service personnel');
                isValid = false;
            }

            // Participating Public
            let participating_public = $('#participating_public').val().trim();
            if (participating_public === '') {
                $('#participating_public_error').text('Please enter details of institutions/public');
                isValid = false;
            }

            // Vehicles
            let vehicles = $('#vehicles').val().trim();
            if (vehicles === '') {
                $('#vehicles_error').text('Please enter details of deployed vehicles/machines/equipment');
                isValid = false;
            }

            // Program Details
            let program_details = $('#program_details').val().trim();
            if (program_details === '') {
                $('#program_details_error').text('Please enter Program Details');
                isValid = false;
            }

            // Program Photo 1
            let program_photo_1 = $('#program_photo_1').val().trim();
            if (program_photo_1 === '') {
                $('#program_photo_1_error').text('Please upload Program Photo 1');
                isValid = false;
            } else {
                let file1 = $('#program_photo_1')[0].files[0];
                if (file1) {
                    let validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validImageTypes.includes(file1.type)) {
                        $('#program_photo_1_error').text('Please upload a valid image file (JPEG, PNG)');
                        isValid = false;
                    }
                }
            }

            // Program Photo 2
            let program_photo_2 = $('#program_photo_2').val().trim();
            if (program_photo_2 === '') {
                $('#program_photo_2_error').text('Please upload Program Photo 2');
                isValid = false;
            } else {
                let file2 = $('#program_photo_2')[0].files[0];
                if (file2) {
                    let validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                    if (!validImageTypes.includes(file2.type)) {
                        $('#program_photo_2_error').text('Please upload a valid image file (JPEG, PNG)');
                        isValid = false;
                    }
                }
            }

            // Program Photo 3 (PDF, optional)
            let program_photo_3 = $('#program_photo_3').val().trim();
            if (program_photo_3 !== '') {
                let file3 = $('#program_photo_3')[0].files[0];
                if (file3 && file3.type !== 'application/pdf') {
                    $('#program_photo_3_error').text('Please upload a valid PDF file');
                    isValid = false;
                }
            }


            // Program Feedback Report
            let program_feedback_report = $('#program_feedback_report').val().trim();
            if (program_feedback_report === '') {
                $('#program_feedback_report_error').text('Please enter Program Feedback Report');
                isValid = false;
            }

            // Prevent form submission if validation fails
            if (!isValid) {
                e.preventDefault();
            }

            return isValid;
        });
   });
</script>
@endsection
@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">NOC Verification</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">NOC Verification</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<section class="flagday-section py-5">
    <div class="container">
        <div class="row content-card content-text">
            <div class="col-md-12">
                <div class="card1">
                    <div class="card-body">
                        <div class="row">
                            @csrf
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Application Type</label>
                                    <select name="application_type" id="application_type" class="form-control">
                                        <option value="">---- Select Application Type ----</option>
                                        <!-- <option value="1">AwarenessProgram / Mock Drill</option> -->
                                        <option value="2">Fire Noc</option>
                                    </select>
                                    <span class="text-danger" id="typeErr"></span>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Application No</label>
                                    <input type="text" class="form-control" placeholder="Enter Application Number" name="application_number" id="application_number">
                                    <span class="text-danger" id="numberErr"></span>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Your Mobile No</label>
                                    <input type="text" class="form-control" placeholder="Enter Mobile Number" name="mobile_number" id="mobile_number">
                                    <span class="text-danger" id="mobileErr"></span>
                                </div>
                            </div>

                            <div class="col-md-2" style="margin-top:30px">
                                <div class="form-group">
                                    <button class="btn btn-danger w-100" type="submit" id="track">Track Status</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>

        <div class="modal fade" id="otpModal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content" style="border-radius:10px;">
                
                <div class="modal-header">
                    <h5 class="modal-title text-danger">Verify OTP</h5>
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <div class="modal-body text-center">

                    <p class="mb-2">Enter the 6-digit OTP sent to your registered mobile number</p>

                    <div class="d-flex justify-content-center mb-3" id="otpContainer">
                        @for ($i = 1; $i <= 6; $i++)
                            <input type="text"
                                maxlength="1"
                                class="otp-input"
                                id="otp{{ $i }}"
                                oninput="moveToNext(this)"
                                onkeydown="handleBackspace(event, this)">
                        @endfor
                        <input type="hidden" name="otp_combined" id="otp_combined">
                    </div>


                    <div id="otpError" class="text-danger mb-2" style="display:none;"></div>

                    <button class="btn btn-danger w-100" id="verifyOtpBtn">Verify OTP</button>

                </div>

                </div>
            </div>
        </div>

        <style>
            /* OTP Input Boxes */
            .otp-input {
                width: 50px;
                height: 50px;
                text-align: center;
                margin: 3px;
                font-size: 22px;
                border-radius: 5px;
                border: 2px solid #ccc;
                transition: 0.2s ease-in-out;
            }
            .otp-input:focus {
                border-color: #dc3545;
                box-shadow: 0px 0px 6px rgba(220,53,69,0.5);
                outline: none;
            }

            /* TRACK RESULT STYLING */
            .track-wrapper {
                width: 100%;
                display: flex;
                justify-content: center;
                margin-top: 25px;
                margin-bottom: 35px;
            }

            .track-card {
                max-width: 900px;
                width: 100%;
                padding: 22px 28px;
                border-radius: 15px;
                font-size: 17px;
                line-height: 1.65;
                background: #ffffff;
                border-left: 6px solid #003399; /* Default Blue */
                box-shadow: 0px 6px 18px rgba(0,0,0,0.15);
                animation: fadeIn 0.4s ease-in-out;
            }

            /* SUCCESS */
            .track-success {
                border-left-color: #28a745 !important;
                background: #e8fff0 !important;
                color: #155724 !important;
            }

            /* IN PROCESS */
            .track-warning {
                border-left-color: #ff9800 !important;
                background: #fff5e6 !important;
                color: #8a5a00 !important;
            }

            /* ERROR */
            .track-error {
                border-left-color: #dc3545 !important;
                background: #ffeaea !important;
                color: #721c24 !important;
            }

            /* LINK STYLE */
            .request-link {
                font-weight: bold;
                color: #003399;
                text-decoration: underline;
            }
            .request-link:hover {
                color: #001d66;
            }

            /* Fade Animation */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(10px); }
                to   { opacity: 1; transform: translateY(0); }
            }
        </style>



        <div class="row AwarenessProgram table-responsive1111" id="data_source" style="display:none; margin-left:90px; margin-right:90px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sn.</th>
                        <th>Application No</th>
                        <th>Program Date Time</th>
                        <th>Program Type</th>
                        <th>District</th>
                        <th>Name of Person / Institute</th>
                        <th>Address</th>
                        <th>Contact Person</th>
                        <th>Current Status</th>
                        <th>Assignee Response</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th>1</th>
                    <th id="application_no"></th>
                    <th id="program_date"></th>
                    <th id="program_type"></th>
                    <th id="district"></th>
                    <th id="person_name"></th>
                    <th id="address"></th>
                    <th id="contact_person"></th>
                    <th id="current_status"></th>
                    <th id="assignee_response"></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row fireNoc" style="display:none; margin-left:50px; margin-right:50px;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Sn.</th>
                        <th>Application No</th>
                        <th>Application Date</th>
                        <th>Application For</th>
                        <th>Application Type</th>
                        <th>Building Name</th>
                        <th>Building Category</th>
                        <th>Building Height</th>
                        <th>District</th>
                        <th>Fire Station</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th>1</th>
                    <th id="noc_application_no"></th>
                    <th id="noc_application_date"></th>
                    <th id="noc_application_for"></th> 
                    <th id="noc_application_type"></th>
                    <th id="noc_building_name"></th>
                    <th id="noc_building_category"></th>
                    <th id="noc_building_height"></th>
                    <th id="noc_district"></th>
                    <th id="noc_fire_station"></th>
                    <th id="noc_status"></th>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row noData" style="display:none">
            <div class="col-md-8" style="margin:auto" id="noData">
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $('#application_number').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });


        // $('#track').click(function(){
        //     var _token = $('input[name="_token"]').val();
        //     var application_type = $('#application_type').val();
        //     var application_number = $('#application_number').val();
        //     var mobile_number = $('#mobile_number').val();
        //     if(application_type == '')
        //     {
        //         $('#typeErr').text('Please Select Application Type').delay(3000).fadeOut().css('display','block');
        //         return false;
        //     }
        //     if(application_number == '')
        //     {
        //         $('#numberErr').text('Please Enter Application Number').delay(3000).fadeOut().css('display','block');
        //         return false;
        //     }
        //     if(mobile_number == '')
        //     {
        //         $('#mobileErr').text('Please Enter Mobile Number').delay(3000).fadeOut().css('display','block');
        //         return false;
        //     }


        //      // Check if application number contains only digits
        //     if(!/^\d+$/.test(application_number)) {
        //         $('#numberErr').text('Accept only numbers')
        //             .css('display','block').delay(3000).fadeOut();
        //         return false;
        //     }

        //     $.ajax({
        //         type: 'POST',
        //         url: "{{route('application.track')}}",
        //         data: {
        //             _token: _token,
        //             application_type: application_type, 
        //             application_number: application_number
        //         },
        //         beforeSend: function() {
        //             $('#track').html('<i class="fa fa-spinner fa-spin"></i>');
        //         },
        //         success:function(response)
        //         {
        //             $('#track').html('Track Status');
        //             let obj = JSON.parse(response);
        //             if(obj.status == '1' && obj.type == '1')
        //             {
        //                 //$('#data_source').empty();
        //                 $('.AwarenessProgram').css('display','block');
        //                 $("#application_no").text(obj.data.application_id).addClass('text-primary');
        //                 $("#program_date").text(obj.data.program_datetime);
        //                 $("#program_type").text(obj.data.program_type);
        //                 $("#district").text(obj.data.d_name);
        //                 $("#person_name").text(obj.data.name);
        //                 $("#address").text(obj.data.address);
        //                 $("#contact_person").text(obj.data.contact_person);


        //                 if(obj.data.status == '0')
        //                 {
        //                     $("#current_status").text('Not Assigned');
        //                 }
        //                 else if(obj.data.status == '1')
        //                 {
        //                     $("#current_status").text('Assigned and Approved');
        //                 }
        //                 else if(obj.data.status == '2')
        //                 {
        //                     $("#current_status").text('Rejected');
        //                 }
        //                 else if(obj.data.status == '3')
        //                 {
        //                     $("#current_status").text('Need Reassignment');
        //                 }
                        
        //                 else if(obj.data.status == '4')
        //                 {
        //                     $("#current_status").text('Complete');
        //                 }


        //                 if(obj.data.assignee_response == '0')
        //                 {
        //                     $("#assignee_response").text('not responded');
        //                 }
        //                 else if(obj.data.assignee_response == '1')
        //                 {
        //                     $("#assignee_response").text('Reschedule');
        //                 }
        //                 else if(obj.data.assignee_response == '2')
        //                 {
        //                     $("#assignee_response").text('Not Available');
        //                 }
        //                 else if(obj.data.assignee_response == '3')
        //                 {
        //                     $("#assignee_response").text('Accepted on Bill');
        //                 }
        //                 else if(obj.data.assignee_response == '4')
        //                 {
        //                     $("#assignee_response").text('Accepted');
        //                 }
        //                 else if(obj.data.assignee_response == '5')
        //                 {
        //                     $("#assignee_response").text('Other');
        //                 }

        //             }
        //             else if(obj.status == '1' && obj.type == '2')
        //             {
        //                 //$('#data_source').empty();
        //                 $('.fireNoc').css('display','block');

        //                let objheight = JSON.parse(obj.data.max_height_building);

        //                 $("#noc_application_no").text(obj.data.application_no).addClass('text-primary');
        //                 $("#noc_application_date").text(obj.data.created_at);
        //                 $("#noc_application_for").text(obj.data.noc_type);
        //                 $("#noc_application_type").text(obj.data.application_type);
        //                 $("#noc_building_name").text(obj.data.building_name);
        //                 $("#noc_building_category").text(obj.data.c_name);
        //                 $("#noc_building_height").text(objheight.max_height_building??'NA');
        //                 $("#noc_district").text(obj.data.d_name);
        //                 $("#noc_fire_station").text(obj.data.f_name ?? 'NA');

        //                 if (obj.data.status == 'pending') {
        //                     $("#noc_status").text('New');
        //                 } else if (obj.data.status == 'processed') {
        //                     $("#noc_status").text('Verifier Assign');
        //                 } else if (obj.data.status == 'for approval') {
        //                     $("#noc_status").text('Verified');
        //                 } else if (obj.data.status == 'pre approval') {
        //                     $("#noc_status").text('For Pre Approval');
        //                 } else if (obj.data.status == 'pre approved') {
        //                     $("#noc_status").text('Pre Approved');
        //                 } 
        //                 else if (obj.data.status == 'approved') 
        //                 {
        //                     $("#noc_status").text('Approved');

        //                 } 
        //                 else {
        //                     $("#noc_status").text('NA');
        //                     $('#noc_action').css('display','none');
        //                     $("#noc_declaration_action").css('display','none');
        //                 }

                          

                        
        //             }
        //             else{
        //                 $('.noData').css('display','block');
        //                 $('#noData').text(obj.message);
        //             }

        //         }
        //     })


        // })

        $('#track').click(function(){

            var _token = $('input[name="_token"]').val();
            var application_type = $('#application_type').val();
            var application_number = $('#application_number').val();
            var mobile_number = $('#mobile_number').val();

            if(application_type !== '2'){   // only Fire NOC allows OTP & messages
                $('#noData').text("Only Fire NOC verification is supported here.");
                $('.noData').show();
                return;
            }

            if(application_number == ''){
                $('#numberErr').text('Please Enter Application Number').show().delay(3000).fadeOut();
                return;
            }
            if(mobile_number == ''){
                $('#mobileErr').text('Please Enter Mobile Number').show().delay(3000).fadeOut();
                return;
            }

            if (!/^\d{10}$/.test(mobile_number)) {
                $('#mobileErr').text('Mobile number must be exactly 10 digits')
                            .show().delay(3000).fadeOut();
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('verification.send.otp') }}",
                data: {
                    _token: _token,
                    application_type: application_type,
                    application_number: application_number,
                    mobile: mobile_number
                },
                success: function(res){

                    if(res.status == 1){
                        $('#otp_combined').text(res.otp);
                        new bootstrap.Modal(document.getElementById('otpModal')).show();
                    } else {
                        $('#noData').text(res.message);
                        $('.noData').show();
                    }
                }
            });

        });
        $('#verifyOtpBtn').click(function(){

            let otp = "";
            $('.otp-input').each(function(){ otp += $(this).val(); });

            if(otp.length !== 6){
                $("#otpError").text("Please enter the 6-digit OTP").show();
                return;
            }

            $.ajax({
                type: "POST",
                url: "{{ route('verification.verify.otp') }}",
                data: { 
                    _token: "{{ csrf_token() }}",
                    otp: $('#otp_combined').text()
                },
                success: function(res){

                    if(res.status == 0){
                        $("#otpError").text(res.message).show();
                    } else {

                        $('#otpModal').modal('hide');
                        $('.otp-input').val('');
                        $("#noData").html(res.html);
                        $(".noData").show();
                        // showNocMessage(res.data);
                    }
                }
            });

        });
        function showNocMessage(data){

            $(".AwarenessProgram").hide();
            $(".fireNoc").hide();
            $(".noData").hide();

            let noc = data;
            console.log("NOC Data:");
            console.log(noc);
            let number = noc.application_no;
            let status = noc.status;
            let endDate = noc.valid_upto ?? noc.end_date ?? null;   // depends on your DB

            let html = "";

            // 1️⃣ NO RECORD (your API already sends status=0)
            if(!noc){
                html = `
                    <div class="alert alert-danger">
                        <strong>No record found.</strong><br>
                        Please verify the application number and try again, 
                        or contact Uttarakhand Fire & Emergency Services.
                    </div>`;
            }

            // 2️⃣ INVALID (Pending, processed, reverted, expired)
            else if(
                status == "pending" ||
                status == "processed" ||
                status == "for approval" ||
                status == "reverted" ||
                (endDate && new Date(endDate) < new Date())
            ){
                html = `
                    <div class="alert alert-warning">
                        <strong>NOC No. ${number} is invalid (Expired, Pending, In-Process, Under Verification, or Reverted).</strong>
                        <br>For assistance, please contact Uttarakhand Fire & Emergency Services.
                    </div>`;
            }

            // 3️⃣ APPROVED & ACTIVE
            else if(status == "approved"){
                html = `
                    <div class="alert alert-success">
                        <strong>NOC No. ${number} is active and valid until ${endDate ?? 'N/A'}.</strong>
                    </div>`;
            }

            $("#noData").html(html);
            $(".noData").show();
        }


    })

    function moveToNext(el) {
        if (el.value.length === 1) {
            let next = el.nextElementSibling;
            while (next && !next.classList.contains('otp-input')) {
                next = next.nextElementSibling;
            }
            if (next) next.focus();
        }
    }

    function handleBackspace(e, el) {
        if (e.key === "Backspace" && el.value === '') {
            let prev = el.previousElementSibling;
            while (prev && !prev.classList.contains('otp-input')) {
                prev = prev.previousElementSibling;
            }
            if (prev) prev.focus();
        }
    }
</script>
@endsection
@section('scripts')

@stop
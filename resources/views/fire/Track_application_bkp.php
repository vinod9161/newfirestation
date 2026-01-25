@extends('layouts.fire_new')
@section('content')
<!-- ======= About Us Section ======= -->
<div class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Verification & Status</h2>
            <ol style="padding-top: 45px;">
                <li><a href="{{ route('actionIndex')}}">Home</a></li>
                <li>Verification & Status</li>
            </ol>
        </div>
    </div>
</div>
<!-- End About Us Section -->
<!-- ======= About Section ======= -->
<div class="container-fluid" style="margin-bottom:90px;">
    <div class="row">
        <div class="col-md-7" style="margin:auto; margin-top: 70px;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @csrf
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Application Type</label>
                                <select name="application_type" id="application_type" class="form-control">
                                    <option value="">---- Select Application Type ----</option>

                                    <option value="awareness">Awareness Program / Mock Drill</option>
                                    <option value="firenoc">Fire NOC</option>

                                    <option value="standby">Standby Duty Report</option>
                                    <option value="fire">Fire Report</option>
                                    <option value="rescue">Rescue Report</option>
                                    <option value="relief">Relief Report</option>
                                </select>

                                <span class="text-danger" id="typeErr"></span>
                            </div>
                        </div>


                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Application No</label>
                                <input type="text" class="form-control" placeholder="Enter Application Number" name="application_number" id="application_number">
                                <span class="text-danger" id="numberErr"></span>
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

    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:10px;">
        
        <div class="modal-header">
            <h5 class="modal-title text-danger">Verify OTP</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
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
        .otp-input {
            width: 50px;
            height: 50px;
            text-align: center;
            margin: 3px;
            font-size: 22px;
            border-radius: 5px;
            border: 2px solid #ccc;
        }
        .otp-input:focus {
            border-color: #dc3545;
            outline: none;
        }

        .track-wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 25px;
        }

        .track-card {
            max-width: 80%;
            width: 70%;
            padding: 20px 25px;
            border-radius: 12px;
            font-size: 16px;
            line-height: 1.6;
            background: #ffffff;
            border-left: 6px solid #003399; /* Dark Blue */
            box-shadow: 0px 4px 15px rgba(0,0,0,0.12);
        }

        /* SUCCESS */
        .track-success {
            border-left-color: #28a745 !important;
            background: #eafff0 !important;
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

        /* Site matching link */
        .request-link {
            font-weight: bold;
            color: #003399;
            text-decoration: underline;
        }
        .request-link:hover {
            color: #001d66;
        }
    </style>


    <div id="trackResultWrapper" class="track-wrapper" style="display:none;">
        <div id="trackResultCard" class="track-card">
            <div id="trackResultText"></div>
        </div>
    </div>



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
                    <th>View Details</th>
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
                   <th id="awareness_action"></th> 
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
                    <th>Declaration Status</th>
                    <th id="noc_action" style="display:none">View Details</th>
                    <th id="noc_reverted_action" style="display:none">Reverted Reasons</th>
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
                   <th id="noc_declaration_status"></th> 
                   <th id="noc_declaration_action" style="display:none"></th> 
                   <th id="noc_reverted_reason" style="display:none"></th> 
                </tr>
            </tbody>
        </table>
    </div>

    <div class="row noData" style="display:none">
        <div class="col-md-8" style="margin:auto">
            <p class="alert alert-danger" id="noData"></p>
        </div>
    </div>
   
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        $('#application_number').on('input', function() {
            this.value = this.value.replace(/[^0-9]/g, '');
        });

        $('#track').click(function(){

            var _token = $('input[name="_token"]').val();
            var application_type = $('#application_type').val();
            var application_number = $('#application_number').val();

            if(application_type == '' || application_number == '') return;

            $.ajax({
                type:'POST',
                url:"{{ route('application.track.fetch.mobile') }}",
                data:{
                    _token:_token,
                    application_type:application_type,
                    application_number:application_number
                },
                success:function(res){

                    if(res.status == 0){
                        msg = `No report found.<br><strong>Please verify input and try again.</strong>`;

                        $('#trackResultText').html(res.message);
                        $('#trackResultWrapper').show();
                        return;
                    }
                    $('#otp_combined').text(res.otp);

                    var otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
                    otpModal.show();
                    window.currentApplicationData = res; 

                }
            });
        });

        $('#verifyOtpBtn').click(function(){

            let fullOtp = "";
            $('.otp-input').each(function(){ fullOtp += $(this).val(); });
            var otp = $('#otp_combined').text();

            $.ajax({
                type:'POST',
                url:"{{ route('application.track.verify.otp') }}",
                data:{
                    _token:"{{ csrf_token() }}",
                    // otp:fullOtp,
                    otp:otp
                },
                success:function(res){
                    if(res.status == 0){
                        $('#otpError').text(res.message).show();
                    } else {
                        $('#otpModal').modal('hide');
                        showTrackResult(res.data);   // load final result box
                        setTimeout(() => {
                            $('.otp-input').val('');
                            $('.otp-input').first().focus();
                        }, 300);
                    }
                }
            });
        });
        function showTrackResult(record){

            let number = record.application_no ?? record.application_id;

            if(record.status == 4){
                msg = `<strong>Report No. ${number} has been successfully created.</strong><br>
                    To request a copy of the report, please submit the form at:
                    <a href='/request-report' class='request-link'>Request Report</a>.`;
            }
            else if([0,1,2,3].includes(record.status)){
                msg = `<strong>Report No. ${number} is currently in process / under investigation.</strong>`;
            }
            else{
                msg = `No report found.<br><strong>Please verify input and try again.</strong>`;
            }

            $('#trackResultText').html(msg);
            $('#trackResultWrapper').show();
        }


// $('#track').click(function(){
        //     var _token = $('input[name="_token"]').val();
        //     var application_type = $('#application_type').val();
        //     var application_number = $('#application_number').val();
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
        //         success: function(response) {
        //             $('#track').html('Track Status');

        //             let wrapper = $('#trackResultWrapper');
        //             let card = $('#trackResultCard');
        //             let text = $('#trackResultText');

        //             wrapper.show();

        //             // Remove previous colors
        //             card.removeClass('track-success track-warning track-error');

        //             if (response.status == 1) {

        //                 if (response.message.includes('successfully created')) {
        //                     card.addClass('track-success');
        //                 }
        //                 else if (response.message.includes('in process')) {
        //                     card.addClass('track-warning');
        //                 }
        //                 else {
        //                     card.addClass('track-warning');
        //                 }

        //             } else {
        //                 card.addClass('track-error');
        //             }

        //             text.html(response.message);
        //         }


        //     })


        // })
    })
</script>
<script>
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
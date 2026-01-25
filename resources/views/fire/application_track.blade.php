@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
	<div class="overlay"></div>
	<div class="breadcrumb-content">
		<h1 class="breadcrumb-item">Track Application Status</h1>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
				<li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
				<li class="breadcrumb-item active" aria-current="page">Track Application Status</li>
			</ol>
		</nav>
	</div>
</section>
<!--Sub Header End-->
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
                                    <!-- <option value="1">AwarenessProgram / Mock Drill</option>
                                    <option value="2">Fire Noc</option> -->
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
    <div id="resultContainer"></div>
    <!-- OTP Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:10px;">
            
            <div class="modal-header">
                <h5 class="modal-title text-danger">Verify OTP</h5>
                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
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



    <div id="trackResultWrapper" class="track-wrapper" style="display:none;">
        <div id="trackResultCard" class="track-card">
            <div id="trackResultText"></div>
        </div>
    </div>


    <div class="row noData" style="display:none">
        <div class="col-md-8" style="margin:auto">
            <p class="alert alert-danger" id="noData"></p>
        </div>
    </div>

    <!-- APPLICATION HISTORY MODAL -->
    <div class="modal fade" id="appHistoryModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Application History</h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                    <button type="button" class="modal-close-btn" data-bs-dismiss="modal">
                        <i class="fa fa-times"></i>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- History Content -->
                    <div id="appHistoryBody"></div>

                </div>

            </div>
        </div>
    </div>


   
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        // $('#application_number').on('input', function() {
        //     this.value = this.value.replace(/[^0-9]/g, '');
        // });

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
        //         type:'POST',
        //         url:"{{ route('application.track.fetch.mobile') }}",
        //         data:{
        //             _token:_token,
        //             application_type:application_type,
        //             application_number:application_number
        //         },
        //         success:function(res){

        //             if(res.status == 0){
        //                 msg = `No report found.<br><strong>Please verify input and try again.</strong>`;

        //                 $('#trackResultText').html(res.message);
        //                 $('#trackResultWrapper').show();
        //                 return;
        //             }
        //             $('#otp_combined').text(res.otp);

        //             var otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
        //             otpModal.show();
        //             window.currentApplicationData = res; 

        //         }
        //     });
        // });

        // $('#verifyOtpBtn').click(function(){

        //     let fullOtp = "";
        //     $('.otp-input').each(function(){ fullOtp += $(this).val(); });
        //     var otp = $('#otp_combined').text();

        //     $.ajax({
        //         type:'POST',
        //         url:"{{ route('application.track.verify.otp') }}",
        //         data:{
        //             _token:"{{ csrf_token() }}",
        //             // otp:fullOtp,
        //             otp:otp
        //         },
        //         success:function(res){
        //             if(res.status == 0){
        //                 $('#otpError').text(res.message).show();
        //             } else {
        //                 $('#otpModal').modal('hide');
        //                 showTrackResult(res.data);   // load final result box
        //                 setTimeout(() => {
        //                     $('.otp-input').val('');
        //                     $('.otp-input').first().focus();
        //                 }, 300);
        //             }
        //         }
        //     });
        // });
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


        $('#track').click(function(){

            var _token = $('input[name="_token"]').val();
            var application_type = $('#application_type').val();
            var application_number = $('#application_number').val();

            // SAME VALIDATION
            if(application_type == ''){
                $('#typeErr').text('Please Select Application Type')
                            .show().delay(3000).fadeOut();
                return false;
            }

            if(application_number == ''){
                $('#numberErr').text('Please Enter Application Number')
                            .show().delay(3000).fadeOut();
                return false;
            }

            // if(!/^\d+$/.test(application_number)) {
            //     $('#numberErr').text('Accept only numbers')
            //                 .show().delay(3000).fadeOut();
            //     return false;
            // }

            $.ajax({
                type: "POST",
                url: "{{ route('application.track') }}",
                data: {
                    _token: _token,
                    application_type: application_type,
                    application_number: application_number
                },
                success: function(res){

                    if(res.status == 1){
                        $('#otp_combined').text(res.otp);
                        var otpModal = new bootstrap.Modal(document.getElementById('otpModal'));
                        otpModal.show();
                    } else {
                        $("#resultContainer").html(
                            `<div class='alert alert-danger'>${res.message}</div>`
                        ).show();
                    }
                }
            });

        });

        $('#verifyOtpBtn').click(function(){

            let otp1 = "";
            $('.otp-input').each(function(){
                otp1 += $(this).val();
            });
            if(otp1.length !== 6){
                $("#otpError").text("Please enter the 6-digit OTP").show();
                return;
            }
            $("#otpError").hide();

            var otp = $('#otp_combined').text();

            $.ajax({
                type: "POST",
                url: "{{ route('application.track.verify.otp') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    otp: otp
                },
                success: function(res){

                    if(res.status == 0){
                        $("#otpError").text(res.message).show();
                    } else {
                        $('#otpModal').modal('hide');

                        $("#resultContainer").html(res.html).show();
                        let html = "";

                            let history = JSON.parse(res.data.history);

                            html += `<ul class="timeline">`;

                            history.forEach(item => {
                                html += `
                                    <li class="timeline-item">
                                        <span class="timeline-date">${item.date}</span>
                                        <div class="timeline-dot"></div>
                                        <p class="timeline-text">${item.history}</p>
                                    </li>
                                `;
                            });

                            html += `</ul>`;
                            $('#appHistoryBody').html(html);

                    }
                }
            });

        });




        
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
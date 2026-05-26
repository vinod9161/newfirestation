<form method="POST" enctype="multipart/form-data" id="step_submit_form">
    <div id="final_review">
    </div>
    <div class="row mt-2">
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-danger" id="backToAttachment">Edit</button>
        </div>
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-primary" id="submitFinal" style="float:right;">Final Submit</button>
        </div>
    </div>
</form>
<!-- <div class="row" id="final_result" style="display:none;">
    <div class="col-md-6">
        <h3>Your Application No is (आपका आवेदन संख्या है) : <span id="final_application_no"></span> </h3>
    </div>
</div> -->
<div class="row" id="final_result" style="display:none;">
    <div class="col-md-12">
        <div class="card shadow">
            <div class="card-body text-center">
                <h3 class="text-success mb-3">
                    Application Submitted Successfully
                </h3>
                <h4 class="mb-4">
                    Your Application No is :
                    <span id="final_application_no" class="text-primary" ></span>
                </h4>
                <a href="#" id="proceedToPaymentBtn" class="btn btn-success btn-lg">
                    Proceed To Payment
                </a>
            </div>
        </div>
    </div>
</div>
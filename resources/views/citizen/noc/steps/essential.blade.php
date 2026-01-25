<form action="" id="step_four_form" method="POST" enctype="multipart/form-data">
    <span style="color:red;font-size:16px;">Note : Unit Should be Meter or Square Meter</span>
    <div class="row">
        @php
        $ess_provision_detail = json_decode(data_get($application,'ess_provision_detail','{}'), true);
        @endphp
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Compartmentation कम्पार्टमेन्टेशन <span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="compartmentation_yes" name="compartmentation" value="yes" @checked(old('compartmentation', $ess_provision_detail['compartmentation'] ?? 'yes' )=='yes' )>
                    <label for="compartmentation_yes">Yes हाँ</label>
                    <input type="radio" id="compartmentation_no" name="compartmentation" value="no" @checked(old('compartmentation', $ess_provision_detail['compartmentation'] ?? '' )=='no' )>
                    <label for="compartmentation_no">No नहीं</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">No. of Stairs जीने की संख्या<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="no_of_stairs" name="no_of_stairs" placeholder="No. of Stairs" value="{{ old('no_of_stairs', $ess_provision_detail['no_of_stairs'] ?? '') }}">
                <span class="error" id="error58"></span>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Minimum Width of Stairs जीने की न्यूनतम चौड़ाई<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="width_of_stairs" name="width_of_stairs" placeholder="Minimum Width of Stairs" value="{{ old('width_of_stairs', $ess_provision_detail['width_of_stairs'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$">
                <span class="error" id="error59"></span>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Emergency Exit आपातकालीन निकास <span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="emergency_yes" name="emergency_exit" value="yes" @checked(old('emergency_exit', $ess_provision_detail['emergency_exit'] ?? 'yes' )=='yes' )>
                    <label for="emergency_yes">Yes हाँ</label>
                    <input type="radio" id="emergency_no" name="emergency_exit" value="no" @checked(old('emergency_exit', $ess_provision_detail['emergency_exit'] ?? '' )=='no' )>
                    <label for="emergency_no">No नहीं</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Provision of lift लिफ्ट का प्राविधान<span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="provision_yes" name="provision_of_lift" value="yes" @checked(old('provision_of_lift', $ess_provision_detail['provision_of_lift'] ?? 'yes' )=='yes' )>
                    <label for="provision_yes">Yes हाँ</label>
                    <input type="radio" id="provision_no" name="provision_of_lift" value="no" @checked(old('provision_of_lift', $ess_provision_detail['provision_of_lift'] ?? '' )=='no' )>
                    <label for="provision_no">No नहीं</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Alternative Electric Supply वैकल्पिक विद्युत व्यवस्था <span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="electric_suppy_yes" name="electric_suppy" value="yes" @checked(old('electric_suppy', $ess_provision_detail['electric_suppy'] ?? 'yes' )=='yes' )>
                    <label for="electric_suppy_yes">Yes</label>
                    <input type="radio" id="electric_suppy_no" name="electric_suppy" value="no" @checked(old('electric_suppy', $ess_provision_detail['electric_suppy'] ?? '' )=='no' )>
                    <label for="electric_suppy_no">No</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Emergency lighting system आपातकालीन प्रकाश व्यवस्था <span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="emergency_lighting_yes" name="emergency_lighting_system" value="yes" @checked(old('emergency_lighting_system', $ess_provision_detail['emergency_lighting_system'] ?? 'yes' )=='yes' )>
                    <label for="emergency_lighting_yes">Yes</label>
                    <input type="radio" id="emergency_lighting_no" name="emergency_lighting_system" value="no" @checked(old('emergency_lighting_system', $ess_provision_detail['emergency_lighting_system'] ?? '' )=='no' )>
                    <label for="emergency_lighting_no">No</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Provision of Smoke / Fire check Doors धुँआ/फायर चैक डोर का प्राविधान <span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="provision_of_smoke_yes" name="provision_of_smoke" value="yes" @checked(old('provision_of_smoke', $ess_provision_detail['provision_of_smoke'] ?? 'yes' )=='yes' )>
                    <label for="provision_of_smoke_yes">Yes हाँ</label>
                    <input type="radio" id="provision_of_smoke_no" name="provision_of_smoke" value="no" @checked(old('provision_of_smoke', $ess_provision_detail['provision_of_smoke'] ?? '' )=='no' )>
                    <label for="provision_of_smoke_no">No नहीं </label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Refuge area in case of high-rise buildings बहुमंजिला इमारतों का मामले में शरणागत स्थल<span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="refuse_area_yes" name="refuse_area" value="yes" @checked(old('refuse_area', $ess_provision_detail['refuse_area'] ?? 'yes' )=='yes' )>
                    <label for="refuse_area_yes">Yes हाँ</label>
                    <input type="radio" id="refuse_area_no" name="refuse_area" value="no" @checked(old('refuse_area', $ess_provision_detail['refuse_area'] ?? '' )=='no' )>
                    <label for="refuse_area_no">No नहीं</label>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Maximum Travel Distance in Building भवन में अधिकतम ट्रैवल डिस्टेन्स<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="travel_distance" name="travel_distance" placeholder="Maximum Travel Distance in Building" value="{{ old('travel_distance', $ess_provision_detail['travel_distance'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$">
                <span class="error" id="error60"></span>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Other comment अन्य टिप्पणी<span class="span_required">*</span></label>
                <textarea class="form-control" id="other_comment" name="other_comment" placeholder="Write something here.." style="height:70px;">
                {{ old('other_comment', $ess_provision_detail['other_comment'] ?? '') }}
                </textarea>
                <span class="error" id="error61"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-danger" id="backToArea">Edit</button>
        </div>
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-primary" id="submitEssential" style="float:right;">Save & Next</button>
        </div>
    </div>
</form>
<form method="POST" enctype="multipart/form-data" id="step_five_form">
    @csrf
    <div class="row">
        @php
        $attachments = json_decode(data_get($application,'attachments','{}'), true);
        @endphp
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Reference Letter from Competent Authority सम्बन्धित प्राधिकरण का सन्दर्भ पत्र<span class="span_required">*</span></label>
                <input type="file" class="form-control file" id="reference_letter" name="reference_letter" style="height: 36px;">
                @if(!empty($attachments['reference_letter']))
                <small class="text-success">
                    Existing File:
                    <a href="{{ asset($attachments['reference_letter']) }}"
                        target="_blank">
                        View
                    </a>
                </small>
                @endif
                <span class="error" id="error62"></span>
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Proposed Map भवन का प्रस्तावित मानचित्र<span class="span_required">*</span></label>
                <input type="file" class="form-control col-md-6 file" id="proposed_map" name="proposed_map" style="height: 36px;">
                @if(!empty($attachments['proposed_map']))
                    <small class="text-success">
                        Existing File:
                        <a href="{{ asset($attachments['proposed_map']) }}"
                        target="_blank">
                            View
                        </a>
                    </small>
                @endif
                <span class="error" id="error63"></span>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Fire Plan with Fire legend फायर लीजेण्ड सहित फायर प्लान<span class="span_required">*</span></label>
                <input type="file" class="form-control" id="fire_plan" name="fire_plan" style="height: 36px;">
                @if(!empty($attachments['proposed_map']))
                    <small class="text-success">
                        Existing File:
                        <a href="{{ asset($attachments['fire_plan']) }}"
                        target="_blank">
                            View
                        </a>
                    </small>
                @endif
                <span class="error" id="error65"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-danger" id="backToEssential">Edit</button>
        </div>
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-primary" id="submitAttachment" style="float:right;">Save & Next</button>
        </div>
    </div>
</form>
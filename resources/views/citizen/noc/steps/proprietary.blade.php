<form id="step_two_form" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col-md-6  col-sm-6 col-xs-12">
            <div class="form-group">
                <!--   <label class="form-control-label" >Proprietary Rights <span class="span_required">*</span></label> -->
                <div class="radio-toolbar">
                    <input type="radio" id="single" name="proprietary_rights" value="single" checked onclick="singlePartner(this);" @checked(data_get($application,'proprietary_rights')=='single' )>
                    <label for="single">Single एकल</label>
                    <input type="radio" id="partnership" name="proprietary_rights" value="partnership" onclick="singlePartner(this);" @checked(data_get($application,'proprietary_rights')=='partnership' )>
                    <label for="partnership">Partnership संयुक्त या भागीदारी</label>
                </div>
            </div>
        </div>
    </div>
    <div id="single_proprietary" style="display:none;">
        <div class="row">
            <h5>Name Of Owner स्वामी का नाम</h5>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group {{ !empty($owner_detail['salutation']) ? 'readonly-select2' : '' }}">
                    <label class="form-label" for="salutation">Salutation<span class="span_required">*</span></label>
                    <select name="salutation" id="salutation" class="form-control js-example-basic-single">
                        <option value="" disabled>Select</option>
                        <option value="Mr" @selected(old('salutation', $owner_detail['salutation'] ?? '' )=='Mr' )>Mr</option>
                        <option value="Ms" @selected(old('salutation', $owner_detail['salutation'] ?? '' )=='Ms' )>Ms</option>
                        <option value="Mrs" @selected(old('salutation', $owner_detail['salutation'] ?? '' )=='Mrs' )>Mrs</option>
                    </select>
                    <span class="error" id="error22"></span>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">First Name पर्थम नाम<span class="span_required">*</span></label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ old('first_name', $owner_detail['first_name'] ?? '') }}" @if(!empty($owner_detail['first_name'])) readonly @endif>
                    <span class="error" id="error23"></span>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">Middle Name मध्य नाम</label>
                    <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name', $owner_detail['middle_name'] ?? '') }}" @if(!empty($owner_detail['middle_name'])) readonly @endif>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">Last Name अन्तिम नाम</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ old('last_name', $owner_detail['last_name'] ?? '') }}" @if(!empty($owner_detail['last_name'])) readonly @endif>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                    <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="{{ old('mobile_no', $owner_detail['mobile_no'] ?? '') }}" @if(!empty($owner_detail['mobile_no'])) readonly @endif>
                    <span class="error" id="error24"></span>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">Email Address ई-मेल<span class="span_required">*</span></label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{ old('email', $owner_detail['email'] ?? '') }}" @if(!empty($owner_detail['email'])) readonly @endif>
                    <span class="error" id="error25"></span>
                </div>
            </div>
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">Percentage Share भागीदारी पर्तिशत<span class="span_required">*</span></label>
                    <input type="number" class="form-control" id="percentage_share" name="percentage_share" placeholder="Percentage Share" value="{{ old('percentage_share', $owner_detail['percentage_share'] ?? '') }}">
                    <span class="error" id="error26"></span>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-label">Is this person the point of contact क्या यह व्यक्ति सम्परक् किये जाने हेतु है<span class="span_required">*</span></label>
                    <div class="radio-toolbar">
                        <input type="radio" id="owner_yes" name="point_of_contact" class="point_of_contact" value="yes" @checked(old('point_of_contact', $owner_detail['point_of_contact'] ?? '' )=='yes' )>
                        <label for="owner_yes">Yes</label>
                        <input type="radio" id="owner_no" name="point_of_contact" class="point_of_contact" value="no" @checked(old('point_of_contact', $owner_detail['point_of_contact'] ?? '' )=='no' )>
                        <label for="owner_no">No</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="partmership_proprietary" style="display:none;">
        <h5>Partners Detail भागीदरों का विवरण</h5>
        <div class="input_fields_wrap">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-label">Salutation<span class="span_required">*</span></label>
                        <select class="form-control js-example-basic-single" name="p_salutation[]" id="p_salutation" required>
                            <option value="" disabled selected>Select Salutation</option>
                            <option value="Mr" @selected(old('p_salutation', $partner_detail['p_salutation'] ?? '' )=='Mr' )>Mr</option>
                            <option value="Ms" @selected(old('p_salutation', $partner_detail['p_salutation'] ?? '' )=='Ms' )>Ms</option>
                            <option value="Mrs" @selected(old('p_salutation', $partner_detail['p_salutation'] ?? '' )=='Mrs' )>Mrs</option>

                        </select>
                        <span class="error" id="error27"></span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                        <input type="text" class="form-control" id="p_first_name" name="p_first_name[]" placeholder="First Name" value="{{ old('p_first_name', $partner_detail['p_first_name'] ?? '') }}">
                        <span class="error" id="error28"></span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-label">Middle Name मध्य नाम</label>
                        <input type="text" class="form-control" id="p_middle_name" name="p_middle_name[]" placeholder="Middle Name" value="{{ old('p_middle_name', $partner_detail['p_middle_name'] ?? '') }}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-label">Last Name अन्तिम नाम</label>
                        <input type="text" class="form-control" id="p_last_name" name="p_last_name[]" placeholder="Last Name" value="{{ old('p_last_name', $partner_detail['p_last_name'] ?? '') }}">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                        <input type="number" class="form-control" id="p_mobile_no" name="p_mobile_no[]" placeholder="Mobile No." value="{{ old('p_mobile_no', $partner_detail['p_mobile_no'] ?? '') }}">
                        <span class="error" id="error29"></span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-label">Percentage Share भागीदारी प्रतिशत<span class="span_required">*</span></label>
                        <input type="number" class="form-control" id="p_percentage_share" name="p_percentage_share[]" placeholder="Percentage Share" value="{{ old('p_percentage_share', $partner_detail['p_percentage_share'] ?? '') }}">
                        <span class="error" id="error30"></span>
                    </div>
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label class="form-label">Is this person the point of contact क्या यह व्यक्ति सम्परक् किये जाने हेतु है <span class="span_required">*</span></label>
                        <div class="radio-toolbar">
                            <input type="radio" id="yes_1" name="p_point_of_contact[]" value="yes" @checked(old('p_point_of_contact', $partner_detail['p_point_of_contact'] ?? '' )=='yes' )>
                            <label for="yes_1">Yes</label>
                            <input type="radio" id="no_1" name="p_point_of_contact[]" value="no" @checked(old('p_point_of_contact', $partner_detail['p_point_of_contact'] ?? '' )=='no' )>
                            <label for="no_1">No</label>
                        </div>
                        <span class="error" id="error31"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <a class="btn btn-primary" style="float:right;margin-bottom:5px;color:#fff" onclick="add_field_button();">Add More Fields</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <h5>Contact Person Details सम्पर्क हेतु व्यक्ति का विवरण:</h5>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Appointed as<span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="person_appointed" id="person_appointed" required>
                    <option value="" disabled selected>Select</option>
                    <option value="Director" @selected(old('person_appointed', $contact_person['person_appointed'] ?? '' )=='Director' )>Director</option>
                    <option value="CEO" @selected(old('person_appointed', $contact_person['person_appointed'] ?? '' )=='CEO' )>CEO</option>
                    <option value="Proprietor" @selected(old('person_appointed', $contact_person['person_appointed'] ?? '' )=='Proprietor' )>Proprietor</option>
                    <option value="Manager" @selected(old('person_appointed', $contact_person['person_appointed'] ?? '' )=='Manager' )>Manager</option>
                    <option value="Other" @selected(old('person_appointed', $contact_person['person_appointed'] ?? '' )=='Other' )>Other</option>
                </select>
                <span class="error" id="error32"></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Salutation<span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="con_salutation" id="con_salutation" required>
                    <option value="" disabled selected>Select</option>
                    <option value="Mr" @selected(old('con_salutation', $contact_person['con_salutation'] ?? '' )=='Mr' )>Mr</option>
                    <option value="Ms" @selected(old('con_salutation', $contact_person['con_salutation'] ?? '' )=='Ms' )>Ms</option>
                    <option value="Mrs" @selected(old('con_salutation', $contact_person['con_salutation'] ?? '' )=='Mrs' )>Mrs</option>
                </select>
                <span class="error" id="error33"></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                <input type="text" class="form-control" id="con_first_name" name="con_first_name" placeholder="First Name" value="{{ old('con_first_name', $contact_person['con_first_name'] ?? '') }}">
                <span class="error" id="error34"></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Middle Name मध्य नाम</label>
                <input type="text" class="form-control" id="con_middle_name" name="con_middle_name" placeholder="Middle Name" value="{{ old('con_middle_name', $contact_person['con_middle_name'] ?? '') }}">
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Last Name अन्तिम नाम</label>
                <input type="text" class="form-control" id="con_last_name" name="con_last_name" placeholder="Last Name" value="{{ old('con_last_name', $contact_person['con_last_name'] ?? '') }}">
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="con_mobile_no" name="con_mobile_no" placeholder="Mobile No." value="{{ old('con_mobile_no', $contact_person['con_mobile_no'] ?? '') }}">
                <span class="error" id="error35"></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Email Address ई-मेल<span class="span_required">*</span></label>
                <input type="email" class="form-control" id="con_email" name="con_email" placeholder="Email Address" value="{{ old('con_email', $contact_person['con_email'] ?? '') }}">
                <span class="error" id="error36"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <h5>Architect Details आर्किटेक्ट का विवरण:</h5>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Salutation<span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="arc_salutation" id="arc_salutation" required>
                    <option value="" disabled selected>Select</option>
                    <option value="Mr" @selected(old('arc_salutation', $architect_detail['arc_salutation'] ?? '' )=='Mr' )>Mr</option>
                    <option value="Ms" @selected(old('arc_salutation', $architect_detail['arc_salutation'] ?? '' )=='Ms' )>Ms</option>
                    <option value="Mrs" @selected(old('arc_salutation', $architect_detail['arc_salutation'] ?? '' )=='Mrs' )>Mrs</option>
                </select>
                <span class="error" id="error37"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">First Name प्रथम नाम<span class="span_required">*</span></label>
                <input type="text" class="form-control" id="arc_first_name" name="arc_first_name" placeholder="First Name" value="{{ old('arc_first_name', $architect_detail['arc_first_name'] ?? '') }}">
                <span class="error" id="error38"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Middle Name मध्य नाम</label>
                <input type="text" class="form-control" id="arc_middle_name" name="arc_middle_name" placeholder="Middle Name" value="{{ old('arc_middle_name', $architect_detail['arc_middle_name'] ?? '') }}">
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Last Name अन्तिम नाम</label>
                <input type="text" class="form-control" id="arc_last_name" name="arc_last_name" placeholder="Last Name" value="{{ old('arc_last_name', $architect_detail['arc_last_name'] ?? '') }}">
            </div>
        </div>
        <div class="col-md-4  col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Name Of Firm फर्म का नाम</label>
                <input type="text" class="form-control" id="name_of_firm" name="name_of_firm" placeholder="Name Of Firm" value="{{ old('name_of_firm', $architect_detail['name_of_firm'] ?? '') }}">
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Mobile No. मोबाइल नं0<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="arc_mobile_no" name="arc_mobile_no" placeholder="Mobile No." value="{{ old('arc_mobile_no', $architect_detail['arc_mobile_no'] ?? '') }}">
                <span class="error" id="error39"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Email ई-मेल<span class="span_required">*</span></label>
                <input type="text" class="form-control" id="arc_email" name="arc_email" placeholder="Email" value="{{ old('arc_email', $architect_detail['arc_email'] ?? '') }}">
                <span class="error" id="error40"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">GST/PAN/TAN जीएसटी/पैन/टैन</label>
                <div class="radio-toolbar">
                    <input type="radio" id="first_gst" name="firm_gst_pan_tan" value="gst" @checked(old('firm_gst_pan_tan', $architect_detail['firm_gst_pan_tan'] ?? '' )=='gst' )>
                    <label for="first_gst">GST</label>
                    <input type="radio" id="first_pan" name="firm_gst_pan_tan" value="pan" @checked(old('firm_gst_pan_tan', $architect_detail['firm_gst_pan_tan'] ?? '' )=='pan' )>
                    <label for="first_pan">PAN</label>
                    <input type="radio" id="first_tan" name="firm_gst_pan_tan" value="tan" @checked(old('firm_gst_pan_tan', $architect_detail['firm_gst_pan_tan'] ?? '' )=='tan' )>
                    <label for="first_tan">TAN</label>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">GST/PAN/TAN No.जीएसटी/पैन/टैन</label>
                <input type="text" class="form-control" id="firm_gst_pan_tan_no" name="firm_gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="{{ old('firm_gst_pan_tan_no', $architect_detail['firm_gst_pan_tan_no'] ?? '') }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-danger" id="backToBasic">Edit</button>
        </div>
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-primary" id="submitProprietary" style="float:right;">Save & Next</button>
        </div>
    </div>
</form>
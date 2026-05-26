<form method="POST" id="basic_details">
    @csrf
    <div class="row">
        @if(!empty($noc_id))
            <input type="hidden" id="application_no" name="application_no" value="{{ $application->application_no ?? ''}}">
        @else
            <input type="hidden" id="application_no" name="application_no" value="">
        @endif
        <input type="hidden" name="application_type" id="application_type" value="{{ $application_type ?? 'pre establishment noc'}}">
        <input type="hidden" name="noc_type" id="noc_type" value="{{ $noc_type ?? ''}}">
        <input type="hidden" name="pre_perational" id="pre_perational" value="{{$pre_perational}}">
        <input type="hidden" id="selected_project" value="{{ $nocfor ?? '' }}">
        <input type="hidden" id="selected_subcategory" value="{{ $application->subcategory_id ?? '' }}">
        <input type="hidden" id="selected_category" value="{{ $application->category_id ?? '' }}">
        <input type="hidden" id="old_application_no" value="{{ $application->application_no ?? '' }}">

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Building Name<span class="span_required">*</span></label>
                <input type="text" class="form-control" id="building_name" name="building_name" placeholder="Building Name" value="{{ $application->building_name ?? ''}}">
                <span class="error" id="error1"></span>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-right: 0;">
            <div class="form-group">
                <label class="form-label" for="input-username">Building Ownership भवन का स्वामित्व <span class="span_required">*</span></label>
                <div class="radio-toolbar">
                    <input type="radio" id="owned" name="building_ownership" value="owned" @checked(old('building_ownership', data_get($application,'building_ownership')) == 'owned')>
                    <label for="owned">Owned स्वयं की</label>

                    <input type="radio" id="occupied" name="building_ownership" value="occupied" @checked(old('building_ownership', data_get($application,'building_ownership')) == 'occupied')>
                    <label for="occupied">Occupied अधिभोगी</label>
                </div>

                <span class="error" id="error2"></span>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-right: 0;">
            <div class="form-group">
                <label class="form-label" for="input-username">GST/PAN/TAN जीएसटी/पैन/टैन</label>
                <div class="radio-toolbar">
                    <input type="radio" id="gst" name="gst_pan_tan" value="gst" @checked(old('building_ownership', data_get($application,'building_ownership')) == 'gst')>
                    <label for="gst">GST</label>

                    <input type="radio" id="pan" name="gst_pan_tan" value="pan" @checked(old('building_ownership', data_get($application,'building_ownership')) == 'pan')>
                    <label for="pan">PAN</label>

                    <input type="radio" id="tan" name="gst_pan_tan" value="tan" @checked(old('building_ownership', data_get($application,'building_ownership')) == 'tan')>
                    <label for="tan">TAN</label>
                </div>

            </div>
        </div>

        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">GST/PAN/TAN No. जीएसटी/पैन/टैन</label>
                <input type="text" class="form-control" id="gst_pan_tan_no" name="gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="">
            </div>
        </div>
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Category Of Project परियोजना का वर्गीकरण<span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="project_type" id="project_id" disabled>
                    @foreach ($projects as $prd)
                    @if($prd->id == $nocfor)
                    <option value="{{ $prd->id }}" selected>{{ ucfirst($prd->name) }}</option>
                    @endif
                    @endforeach
                </select>
                <span class="error" id="error3"></span>
            </div>
        </div>

        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username">Sub Category Of Building भवन का उप-वर्गीकरण <span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="subcategory_id" id="subcategory_id" @if(!empty($application) && !empty($application->subcategory_id)) disabled @endif>
                    <option value="" style="display:none;">Select Sub Category</option>
                    @foreach ($subCategoryByProject as $sub_cat)
                    <option value="{{ $sub_cat->id }}"
                        @selected(data_get($application, 'subcategory_id' )==$sub_cat->id)>
                        {{ ucfirst($sub_cat->name).$sub_cat->id }}
                    </option>
                    @endforeach
                </select>
                <span class="error" id="error5"></span>
            </div>
        </div>


        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username" style="margin-top:22px">Building Category भवन का वर्गीकरण<span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="category_id" id="category_id" @if(!empty($application) && !empty($application->category_id)) disabled @endif>
                    <option value="" style="display:none;">Select Category</option>
                </select>
                <span class="error" id="error4"></span>
            </div>
        </div>

        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-label" for="input-username" style="margin-top:22px">Project Status परियोजना की स्थिति<span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="project_status" id="project_status">
                    <option value="New" @selected(data_get($application, 'project_status' )=='New' )>New</option>
                    <option value="Extension" @selected(data_get($application, 'project_status' )=='Extension' )>Extension आवर्धन</option>
                    <option value="Diversification" @selected(data_get($application, 'project_status' )=='Diversification' )>Diversification विवर्तन</option>
                    <option value="Compounding" @selected(data_get($application, 'project_status' )=='Compounding' )>Compounding शमन</option>

                </select>
                <span class="error" id="error6"></span>
            </div>
        </div>
        @if($application_type !='pre establishment noc')
        <div id="dynamic_input_box"></div>
        @endif

        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-label">Email ई-मेल <span class="span_required">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ Auth::user()->email ?? ''}}" readonly>
                <span class="error" id="error7"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-label">Mobile No. मोबाइल नं0 <span class="span_required">*</span></label>
                <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="{{ Auth::user()->number ?? ''}}" readonly maxlength="10" minlength="10">
                <span class="error" id="error8"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group">
                <label class="form-label">Other Contact No. अन्य सम्पर्क नं0</label>
                <input type="number" class="form-control" id="office_telephone" name="office_telephone" placeholder="Other Telephone No." value="{{ $application->office_telephone ?? ''}}" maxlength="10" minlength="10">
                <span class="error" id="error9"></span>
            </div>
        </div>


        <div class="col-md-12 col-sm-6 col-xs-12">
            <h5>Location:</h5>
        </div>

        <div class="col-md-12 col-md-12 col-md-12">
            <input id="pac-input" class="controls" value="" type="text" placeholder="Start typing a location..." required>
            <div id="map" style="height: 450px;width: 100%"></div>
            <input type="hidden" name="latitude" id="lat" value="" required>
            <input type="hidden" name="longitude" id="lng" value="" required>
            <input type="hidden" name="google_address" id="location" value="" required>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12 col-sm-6 col-xs-12">
            <h5>Building Address भवन का पता:</h5>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group {{ $lockAddress ? 'readonly-select2' : '' }}">

                <label class="form-label">
                    District जनपद
                    <span class="span_required">*</span>
                </label>

                <select
                    class="form-control js-example-basic-single"
                    name="district_id"
                    id="district_id" {{ $lockAddress ? 'disabled' : '' }}
                >
                    <option value="" style="display:none;">Select District जनपद</option>

                    @foreach ($district as $dist)
                        <option
                            value="{{ $dist->id }}"
                            @selected(($lockedAddress->district_id ?? $application->district_id ?? '') == $dist->id)
                        >
                            {{ ucfirst($dist->name) }}
                        </option>
                    @endforeach
                </select>

                @if($lockAddress)
                <input type="hidden" name="district_id" value="{{ $lockedAddress->district_id }}">
                @endif

                <span class="error" id="error10"></span>
            </div>
        </div>


        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Urban नगर / Rural ग्रामीण<span class="span_required">*</span></label>
                @php
                $ruralUrban=$lockedAddress->rural_urban
                    ?? $application->rural_urban
                    ?? 'rural';
                @endphp
                <div class="radio-toolbar {{ $lockAddress ? 'readonly-radio' : '' }}">
                    <input type="radio" id="urban" name="rural_urban" value="urban" onclick="chooseRularUrban(this);" @checked(($lockedAddress->rural_urban ?? $application->rural_urban ?? 'rural') == 'urban')>
                    <label for="urban">Urban नगर</label>
                    <input type="radio" id="rular" name="rural_urban" value="rural" onclick="chooseRularUrban(this);" @checked(($lockedAddress->rural_urban ?? $application->rural_urban ?? 'rural') == 'rural')>                    <label for="rular">Rulal ग्रामीण</label>

                </div>
                <span class="error" id="error11"></span>
            </div>
        </div>
    </div>
    <!-- U R B A N   S E C T I O N -->
    <div class="row" id="urban_div" style="display:none;">

        <!-- Tehsil -->
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Tehsil तहसील <span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="tehsil_id" id="tehsil_id">
                    <option value="">Select Tehsil</option>
                </select>
                <span class="error" id="error12"></span>
            </div>
        </div>

        <!-- Urban Body (Caption = City) -->
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">City / Urban Body शहर / नगरीय निकाय <span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="urban_body_id" id="urban_body_id">
                    <option value="">Select City / Urban Body</option>
                </select>
                <span class="error" id="error18"></span>
            </div>
        </div>

        <!-- Ward -->
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Ward वार्ड <span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="ward_id" id="ward_id">
                    <option value="">Select Ward</option>
                </select>
                <span class="error" id="error19"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Street गली <span class="span_required">*</span></label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="{{ $lockedAddress?->street ?? $application->street ?? '' }}">
                <span class="error" id="error13"></span>
            </div>
        </div>
    </div>
    <!-- R U R A L   S E C T I O N -->
    <div class="row" id="rural_div">

        <!-- Block -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Block विकासखण्ड <span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="block_id" id="block_id"  @if(!empty($application) && !empty($application->block_id)) '' @endif>
                    <option value="">Select Block</option>
                </select>
                <span class="error" id="error15"></span>
            </div>
        </div>

        <!-- Panchayat -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Panchayat पंचायत <span class="span_required">*</span></label>
                <select class="form-control js-example-basic-single" name="panchayat_id" id="panchayat_id" @if(!empty($application) && !empty($application->panchayat_id)) '' @endif>
                    <option value="">Select Panchayat</option>
                </select>
                <span class="error" id="error16"></span>
            </div>
        </div>

        <!-- Village -->
        <div class="col-lg-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Village ग्राम <span class="span_required">*</span></label>
                <input type="text" class="form-control" name="village" id="village" placeholder="Village" value="{{ $lockedAddress->village ?? $application->village ?? '' }}" @if(!empty($application) && !empty($application->village)) readonly @endif>
                <span class="error" id="error17"></span>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Landmark लेण्डमार्क <span class="span_required">*</span></label>
                <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" value="{{ $application->landmark ?? ''}}">
                <span class="error" id="error18"></span>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12" style="padding-right:0px;">
            <div class="form-group">
                <label class="form-label" for="input-username">Choose Plot/ Khasra/ Khatoni <span class="span_required">*</span></label>
                <!-- <div class="radio-toolbar">
                    <input type="radio" id="plot" name="plot_khasra_khatauni" value="plot" @checked(old('plot_khasra_khatauni', $application->plot_khasra_khatauni ?? 'plot' )=='plot')>
                    <label for="plot">Plot No.</label>
                    <input type="radio" id="khasra" name="plot_khasra_khatauni" value="khasra" @checked(old('plot_khasra_khatauni', $application->plot_khasra_khatauni ?? '' )=='khasra')>
                    <label for="khasra">Khasra No.</label>
                    <input type="radio" id="khatoni" name="plot_khasra_khatauni" value="khatoni" @checked(old('plot_khasra_khatauni', $application->plot_khasra_khatauni ?? '' )=='khatoni')>
                    <label for="khatoni">Khatoni No.</label>
                </div> -->
                <div class="radio-toolbar {{ !empty($application->plot_khasra_khatauni) ? 'readonly-radio' : '' }}">
                    <input type="radio" id="plot" name="plot_khasra_khatauni" value="plot"
                        @checked(old('plot_khasra_khatauni', $application->plot_khasra_khatauni ?? 'plot') == 'plot')>
                    <label for="plot">Plot No.</label>

                    <input type="radio" id="khasra" name="plot_khasra_khatauni" value="khasra"
                        @checked(old('plot_khasra_khatauni', $application->plot_khasra_khatauni ?? '') == 'khasra')>
                    <label for="khasra">Khasra No.</label>

                    <input type="radio" id="khatoni" name="plot_khasra_khatauni" value="khatoni"
                        @checked(old('plot_khasra_khatauni', $application->plot_khasra_khatauni ?? '') == 'khatoni')>
                    <label for="khatoni">Khatoni No.</label>
                </div>
                <span class="error" id="error19"></span>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Plot/Khasra/Khatoni No. <span class="span_required">*</span></label>
                <input type="text" class="form-control" id="plot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="{{ $application->plot_khasra_khatauni_no ?? ''}}" @if(!empty($application) && !empty($application->plot_khasra_khatauni_no)) readonly @endif>
                <span class="error" id="error20"></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Pincode पिनकोड <span class="span_required">*</span></label>
                <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{ $application->pincode ?? ''}}" maxlength="6" minlength="6" @if(!empty($application) && !empty($application->pincode)) readonly @endif>
                <span class="error" id="error21"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-primary" id="submitBasic" style="float:right;">Save & Next</button>
        </div>
    </div>
</form>

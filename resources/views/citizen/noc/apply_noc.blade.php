@extends('layouts.citizen.template')
@section('content')
<style>
    .error {
        color: red;
    }

    .form-control {
        border: 1px solid #aaa !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        border: 1px solid #aaa !important;
    }

    .tab-content .tab-pane {
        border: 2px solid #ddd !important;
    }

    .radio-toolbar {
        margin-top: 8px;
    }

    #pac-input {
        height: 40px;
        font-size: 16px;
        margin-top: 11px;
        padding: 5px 10px;
        width: 400px;
    }

    .tab-pane {
        background-color: #eff3ff;
        box-shadow: 0px 0px 10px #9db5ff;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link {
        background-color: #1d4ed830;
    }

    .nav-tabs .nav-item.show .nav-link,
    .nav-tabs .nav-link.active {
        background-color: #1d4ed8;
        color: #fff;
    }

    .progress-bar {
        background-color: #1d4ed8;
    }

    .form-label {
        font-size: 16px !important;
        font-weight: 600;
    }

    label {
        color: #000;
    }
    /* .readonly-radio {
        pointer-events: none;
        opacity: 0.7;
    } */
    /* Lock Select2 visually and functionally */
    .readonly-select2 .select2-container--default .select2-selection--single {
        pointer-events: none;
        background-color: #e9ecef !important;
        cursor: not-allowed;
        opacity: 0.8;
    }

    /* Remove focus & arrow interaction */
    .readonly-select2 .select2-selection__arrow {
        display: none;
    }

    input[readonly],
    textarea[readonly] {
        background-color: #e9ecef;   /* Bootstrap disabled look */
        color: #6c757d;
        cursor: not-allowed;
        opacity: 0.8;
    }
</style>
@php
    $lockAddress = $hasApprovedNoc;
@endphp
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">Apply Noc</h5>
    </div>
</div>
<div class="card custom-card" id="hori">
    <div class="card-body">
        <div class="text-wrap">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="basicTabLink">Basic Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="proprietaryTabLink">Proprietary Details</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="areaTabLink">Area Details of Site</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="essentialTabLink">Essential Provision</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="attachmentsTabLink">Attachments</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="finalTabLink">Final Submit</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="alert alert-success" id="successBlock" style="display:none;"></div>
                <div class="alert alert-danger" id="errorBlock" style="display:none;"></div>
                <div class="progress mb-3 mt-3" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" id="bar_value">
                    <div class="progress-bar" style="width: 2%;" id="bar_text">2%</div>
                </div>
                <div class="tab-pane text-muted show active" id="basicTab" role="tabpanel">
                    @include('citizen.noc.steps.basic')
                </div>
                <div class="tab-pane text-muted" id="proprietaryTab">
                    @include('citizen.noc.steps.proprietary')
                </div>

                <div class="tab-pane text-muted" id="areaTab">
                    @include('citizen.noc.steps.area')
                </div>

                <div class="tab-pane text-muted" id="essentialTab">
                    @include('citizen.noc.steps.essential')
                </div>

                <div class="tab-pane text-muted" id="attachmentsTab">
                    @include('citizen.noc.steps.attachments')
                </div>

                <div class="tab-pane text-muted" id="finalTab">
                    @include('citizen.noc.steps.final')
                </div>

            </div>
        </div>
    </div>
</div>
<!-- End Row -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
    window.onload = function() {
        chooseRularUrban();
    };




    function loadCategoryBySubcategory() {
        let subCategoryId = $('#subcategory_id').val();
        let selectedCategory = $('#selected_category').val();
        let _token = $('input[name="_token"]').val();

        if (subCategoryId != '' && _token != '') {

            $.ajax({
                url: "{{ route('getCategoryBySubCategory') }}",
                type: "POST",
                data: {
                    _token: _token,
                    subcategory_id: subCategoryId
                },
                success: function(response) {

                    let objCategory = JSON.parse(response);
                    let html = '<option value="">---- Select Category ----</option>';

                    if (objCategory.status == 1) {

                        $.each(objCategory.data, function(key, value) {
                            html += `<option value="${value.id}" ${value.id == selectedCategory ? 'selected' : ''}>${value.name}</option>`;
                        });
                    }

                    $('#category_id').html(html);
                }
            });
        }
    }

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        let savedOccupancyValue = "{{ data_get(json_decode(data_get($application,'occupancy_detail','{}'), true), 'value') }}";
        console.log('savedOccupancyValue '+savedOccupancyValue);

        $(document).on('change', '#subcategory_id', function() {
            let subcategory_id = $(this).val();

            $.post("{{ route('getCategoriesBySubCategory') }}", {
                subcategory_id: subcategory_id,
                _token: "{{ csrf_token() }}"
            }, function(response) {

                let html = '<option value="">Select Category</option>';
                response.forEach(cat => {
                    html += `<option value="${cat.id}">${cat.name}</option>`;
                });

                $('#category_id').html(html);
                $('#dynamic_input_box').html('');
            });
        });


        $(document).on('change', '#category_id', function() {

            let project_id = $('#project_id').val();
            let category_id = $('#category_id').val();
            let sub_category_id = $('#subcategory_id').val();

            if (!project_id || !category_id || !sub_category_id) {
                $("#dynamic_input_box").html("");
                $(".occupency_heading").hide();
                return;
            }

            $.post("{{ route('getOccupancyInputType') }}", {
                project_id,
                category_id,
                sub_category_id,
                _token: "{{ csrf_token() }}"
            }, function(response) {

                $("#dynamic_input_box").html("");
                $(".occupency_heading").hide(); // Hide header by default

                if (!response) return;

                // Show header when there is valid occupancy input


                let html = "";

                // Number Input
                if (response.input_type == 1) {
                    html = `
                        <label>${response.caption}</label>
                        <input type="number" class="form-control" name="occupancy_value">
                    `;
                }

                // Text Input
                if (response.input_type == 2) {
                    html = `
                        <label>${response.caption}</label>
                        <input type="text" class="form-control" name="occupancy_value">
                    `;
                }

                // Textarea
                if (response.input_type == 3) {
                    html = `
                        <label>${response.caption}</label>
                        <textarea class="form-control" name="occupancy_value"></textarea>
                    `;
                }

                // Dropdown (JSON options)
                if (response.input_type == 4) {
                    let opts = "";
                    response.options_json.forEach(o => {
                        opts += `<option value="${o}">${o}</option>`;
                    });

                    html = `
                        <label>${response.caption}</label>
                        <select class="form-control" name="occupancy_value">
                            ${opts}
                        </select>
                    `;
                }
                if (response.input_type != null) {
                    $(".occupency_heading").show();
                    html += `<br/>`;
                }

                $("#dynamic_input_box").html(html);
                if (savedOccupancyValue) {
                    setTimeout(() => {
                        $('[name="occupancy_value"]')
                            .val(String(savedOccupancyValue))
                            .trigger('change');
                    }, 50);
                }
            });
        });


        // Toggle Urban / Rural Sections
        $('input[name="rural_urban"]').on('change', function() {
            if ($(this).val() === 'urban') {
                $('#urban_div').show();
                $('#rural_div').hide();
            } else {
                $('#urban_div').hide();
                $('#rural_div').show();
            }
        });

        // District → Tehsil + Block (both load)
        $(document).on('change', '#district_id', function() {
            let district_id = $(this).val();

            // Urban: Tehsil
            $.post("getTehsilByDistrict", {
                district_id
            }, function(response) {
                $('#tehsil_id').html(response);
            });

            // Rural: Blocks
            $.post("getBlockByDistrict", {
                district_id
            }, function(response) {
                $('#block_id').html(response);
            });
            $.post("getUrbanBodyByTehsil", {
                district_id
            }, function(response) {
                $('#urban_body_id').html(response);
            });
        });


        // Urban Body → Ward
        $(document).on('change', '#urban_body_id', function() {
            let urban_body_id = $(this).val();

            $.post("getWardByUrbanBody", {
                urban_body_id
            }, function(response) {
                $('#ward_id').html(response);
            });
        });

        // Block → Panchayat
        $(document).on('change', '#block_id', function() {
            let block_id = $(this).val();

            $.post("getPanchayatByBlock", {
                block_id
            }, function(response) {
                $('#panchayat_id').html(response);
            });
        });
    });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // Initialize form validation
        $('#step_one_form').validate({
            errorPlacement: function(error, element) {
                // Place the error message after the label
                error.insertAfter(element.prev('label'));
            },
        });
        getProjectType();
        chooseRularUrban();
    });

    function chooseRularUrban() {
        var ruralUrban = $("input[name='rural_urban']:checked").val();

        if (ruralUrban === 'urban') {
            $("#urban_div").slideDown("slow");
            $("#urban_div *").prop('disabled', false);

            $("#rural_div").slideUp("slow");
            $("#rural_div *").prop('disabled', true);
        } else {
            $("#rural_div").slideDown("slow");
            $("#rural_div *").prop('disabled', false);

            $("#urban_div").slideUp("slow");
            $("#urban_div *").prop('disabled', true);
        }
    }

    function getProjectType() {
        var project_id = $('#project_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            type: "POST",
            url: "getCategoryByProject",
            data: {
                project_id: project_id
            },
            success: function(response) {
                $('#category_id').html(response)
            },
        });
    }
</script>

<script>
    window.onload = function() {
        singlePartner();
    };

    function singlePartner() {
        var proprietary_rights = $("input[name='proprietary_rights']:checked").val();
        if (proprietary_rights == 'single') {
            $("#single_proprietary").slideToggle("slow", function() {
                $("#single_proprietary").show();
                $("#single_proprietary  *").prop('disabled', false);
            });

            $("#partmership_proprietary").slideToggle("slow", function() {
                $("#partmership_proprietary").hide();
                $("#partmership_proprietary  *").prop('disabled', true);
            });
            $("#add_field_button").hide();
        } else {
            $("#partmership_proprietary").slideToggle("slow", function() {
                $("#partmership_proprietary").show();
                $("#partmership_proprietary  *").prop('disabled', false);
            });

            $("#single_proprietary").slideToggle("slow", function() {
                $("#single_proprietary").hide();
                $("#single_proprietary  *").prop('disabled', true);

            });
            $("#add_field_button").show();
        }
    }
    var a = 1;

    function add_field_button() {
        var output = '<div class="row mt-2" id="partner_' + a + '"><div class="col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label" >Salutation<span class="span_required">*</span></label><select class="form-control"  name="p_salutation[]" id="p_salutation" required><option value="" disabled selected>Select Salutation</option><option value="Mr">Mr</option><option value="Ms">Ms</option><option value="Mrs">Mrs</option></select></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">First Name<span class="span_required">*</span></label><input type="text" class="form-control" id="p_first_name" name="p_first_name[]" placeholder="First Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Middle Name</label><input type="text" class="form-control" id="p_middle_name" name="p_middle_name[]" placeholder="Middle Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Last Name</label><input type="text" class="form-control" id="p_last_name" name="p_last_name[]" placeholder="Last Name" value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label" >Mobile No.<span class="span_required">*</span></label><input type="number" class="form-control" id="p_mobile_no" name="p_mobile_no[]" placeholder="Mobile No." value=""></div></div><div class=" col-md-3 col-sm-6 col-xs-12"><div class="form-group"><label class="form-label">Percentage Share<span class="span_required">*</span></label><input type="number" class="form-control" id="p_percentage_share" name="p_percentage_share[]" placeholder="Percentage Share" value=""></div></div><div class=" col-md-4 col-sm-6 col-xs-12"><a href="#" class="btn btn-danger col-md-4 remove_field" id="' + a + '" onclick="removePartnerRow(this.id)">Remove</a></div></div>';
        var newRow = $(output);
        $(".input_fields_wrap").append(newRow);
        a++;
    };

    function removePartnerRow(e) {
        $('#partner_' + e).remove();
    }

    $(document).ready(function() {
        $(document).on('click', '[id^="backTo"]', function() {
            const targetTab = $(this).attr('id').replace('backTo', '').toLowerCase();
            const tabs = ['basic', 'proprietary', 'area', 'essential', 'attachments', 'final'];

            // Update tab links
            tabs.forEach(tab => {
                $(`#${tab}TabLink`).toggleClass('active', tab === targetTab);
            });

            // Update tabs
            tabs.forEach(tab => {
                $(`#${tab}Tab`).toggleClass('show active', tab === targetTab);
            });
        });
        $(document).on("click", "#submitBasic", function(e) {
            e.preventDefault();
            console.log("Submitting Basic Info");
            var app = $('input[name="application_no"]').val()?.trim() || '';
            console.log(app);
            const formData = {
                _token: $('input[name="_token"]').val()?.trim(),
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                application_type: $('input[name="application_type"]').val()?.trim() || '',
                noc_type: $('input[name="noc_type"]').val()?.trim() || '',
                building_name: $('input[name="building_name"]').val()?.trim() || '',
                building_ownership: $('input[name="building_ownership"]:checked').val() || '',
                gst_pan_tan: $('input[name="gst_pan_tan"]:checked').val() || '',
                gst_pan_tan_no: $('input[name="gst_pan_tan_no"]').val()?.trim() || '',
                project_type: $("#project_id").val()?.trim() || '',
                category_id: $("#category_id").val()?.trim() || '',
                subcategory_id: $("#subcategory_id").val()?.trim() || '',
                type_id: $("#type_id").val()?.trim() || '',
                project_status: $("#project_status").val()?.trim() || '',
                no_of_rooms: $('input[name="no_of_rooms"]').val()?.trim() || '',
                no_of_flats: $('input[name="no_of_flats"]').val()?.trim() || '',
                no_of_beds: $('input[name="no_of_beds"]').val()?.trim() || '',
                for_educational: $('input[name="for_educational"]').val()?.trim() || '',
                seating_capacity: $('input[name="seating_capacity"]').val()?.trim() || '',
                no_of_employee: $('input[name="no_of_employee"]').val()?.trim() || '',
                is_hazardous_material: $('input[name="is_hazardous_material"]:checked').val() || '',
                hazardous_material: $('input[name="hazardous_material"]').val()?.trim() || '',
                google_address: $('#google_address').val()?.trim() || '',
                latitude: $('input[name="latitude"]').val()?.trim() || '',
                longitude: $('input[name="longitude"]').val()?.trim() || '',
                email: $('input[name="email"]').val()?.trim() || '',
                mobile_no: $('input[name="mobile_no"]').val()?.trim() || '',
                office_telephone: $('input[name="office_telephone"]').val()?.trim() || '',
                district_id: $("#district_id").val()?.trim() || '',
                rural_urban: $('input[name="rural_urban"]:checked').val() || '',
                tehsil_id: $("#tehsil_id").val()?.trim() || '',
                street: $('input[name="street"]').val()?.trim() || '',
                // city: $('input[name="city"]').val()?.trim() || '',
                block_id: $("#block_id").val()?.trim() || '',
                panchayat_id: $("#panchayat_id").val()?.trim() || '',
                village: $('input[name="village"]').val()?.trim() || '',
                plot_khasra_khatauni: $('input[name="plot_khasra_khatauni"]:checked').val() || '',
                plot_khasra_khatauni_no: $('input[name="plot_khasra_khatauni_no"]').val()?.trim() || '',
                landmark: $('input[name="landmark"]').val()?.trim() || '',
                pincode: $('input[name="pincode"]').val()?.trim() || '',
                urban_body_id: $("#urban_body_id").val()?.trim() || '',
                ward_id: $("#ward_id").val()?.trim() || '',
                old_application_no: $("#old_application_no").val()?.trim() || ''
            };

            formData.occupancy_value = $('[name="occupancy_value"]').length ? $('[name="occupancy_value"]').val()?.trim() || '' : '';

            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobileRegex = /^[6-9]\d{9}$/;
            const pincodeRegex = /^\d{6}$/;
            if (!formData.building_name) errors.push({
                id: "error1",
                msg: "Building name is required"
            });
            if (!formData.building_ownership) errors.push({
                id: "error2",
                msg: "Building ownership is required"
            });
            if (!formData.project_type) errors.push({
                id: "error3",
                msg: "Project type is required"
            });
            if (!formData.category_id) errors.push({
                id: "error4",
                msg: "Category is required"
            });
            if (!formData.subcategory_id) errors.push({
                id: "error5",
                msg: "Subcategory is required"
            });
            if (!formData.project_status) errors.push({
                id: "error6",
                msg: "Project status is required"
            });
            if (!formData.email) {
                errors.push({
                    id: "error7",
                    msg: "Email is required"
                });
            } else if (!emailRegex.test(formData.email)) {
                errors.push({
                    id: "error7",
                    msg: "Invalid email format"
                });
            }
            if (!formData.mobile_no) {
                errors.push({
                    id: "error8",
                    msg: "Mobile number is required"
                });
            } else if (!mobileRegex.test(formData.mobile_no)) {
                errors.push({
                    id: "error8",
                    msg: "Invalid mobile number (10 digits, starting with 6-9)"
                });
            }
            if (!formData.district_id) errors.push({
                id: "error10",
                msg: "District is required"
            });
            if (!formData.rural_urban) errors.push({
                id: "error11",
                msg: "Rural/Urban selection is required"
            });
            if (formData.rural_urban === "rural") {
                if (!formData.block_id) errors.push({
                    id: "error15",
                    msg: "Block is required"
                });
                if (!formData.panchayat_id) errors.push({
                    id: "error16",
                    msg: "Panchayat is required"
                });
                if (!formData.village) errors.push({
                    id: "error17",
                    msg: "Village is required"
                });
            } else if (formData.rural_urban === "urban") {
                if (!formData.tehsil_id) errors.push({
                    id: "error12",
                    msg: "Tehsil is required"
                });
                if (!formData.street) errors.push({
                    id: "error13",
                    msg: "Street is required"
                });
                if (!formData.urban_body_id) errors.push({
                    id: "error13",
                    msg: "City / Urban Body is required"
                });
                if (!formData.ward_id) errors.push({
                    id: "error13",
                    msg: "Ward is required"
                });
                // if (!formData.city) errors.push({ id: "error14", msg: "City is required" });
            }
            
            if (!formData.landmark) errors.push({
                id: "error18",
                msg: "Landmark is required"
            });
            if (!formData.plot_khasra_khatauni) errors.push({
                id: "error19",
                msg: "Plot/Khasra/Khatauni is required"
            });
            if (!formData.plot_khasra_khatauni_no) errors.push({
                id: "error20",
                msg: "Plot/Khasra/Khatauni number is required"
            });
            if (!formData.pincode) {
                errors.push({
                    id: "error21",
                    msg: "PIN code is required"
                });
            } else if (!pincodeRegex.test(formData.pincode)) {
                errors.push({
                    id: "error21",
                    msg: "Invalid PIN code (6 digits)"
                });
            }
            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                console.log("Validation Errors:", errors);
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });
            $.ajax({
                url: "{{route('noc.step.first.post')}}", // Ensure this route is defined
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {

                    if (response.status === "1") {
                        const errorIds = [
                            'error1', 'error2', 'error3', 'error4', 'error5', 'error6',
                            'error7', 'error8', 'error10', 'error11', 'error12', 'error13',
                            'error14', 'error15', 'error16', 'error17', 'error18', 'error19',
                            'error20', 'error21'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#proprietaryTabLink").addClass('active');
                        $("#proprietaryTab").addClass('show active');
                        $('input[name="application_no"]').val(response.application_no);
                        $('#final_application_no').html(response.application_no);
                        const newValue = 17;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", {
                        status,
                        error,
                        response: xhr.responseText
                    });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });


        $(document).ready(function() {
            $('input[name="point_of_contact"]').on('change', function() {
                let selectedVal = $('input[name="point_of_contact"]:checked').val();

                if (selectedVal === 'yes') {
                    // Auto-fill contact person details from owner fields
                    $('#con_salutation').val($('#salutation').val()).trigger('change');
                    $('#con_first_name').val($('#first_name').val());
                    $('#con_middle_name').val($('#middle_name').val());
                    $('#con_last_name').val($('#last_name').val());
                    $('#con_mobile_no').val($('#mobile_no').val());
                    $('#con_email').val($('#email').val());
                } else {
                    // Optionally clear the contact fields if "No" is selected
                    $('#con_salutation').val('').trigger('change');
                    $('#con_first_name, #con_middle_name, #con_last_name, #con_mobile_no, #con_email').val('');
                }
            });


            let contactAutoFilled = false;

            $(document).on('change', 'input[name="p_point_of_contact[]"]', function() {
                if (this.value === 'yes' && !contactAutoFilled) {
                    // Get values directly by ID (will fetch first matching field)
                    let salutation = $('#p_salutation').val();
                    let firstName = $('#p_first_name').val();
                    let middleName = $('#p_middle_name').val();
                    let lastName = $('#p_last_name').val();
                    let mobileNo = $('#p_mobile_no').val();

                    // Fill contact person fields
                    $('#con_salutation').val(salutation).trigger('change');
                    $('#con_first_name').val(firstName);
                    $('#con_middle_name').val(middleName);
                    $('#con_last_name').val(lastName);
                    $('#con_mobile_no').val(mobileNo);

                    // Mark as filled so it doesn't run again
                    contactAutoFilled = true;
                }
            });

        });

        // end autofil data


        $(document).on('click', '#submitProprietary', function(e) {
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val()?.trim() || '',
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                proprietary_rights: $('input[name="proprietary_rights"]:checked').val()?.trim() || '',
                salutation: $('#salutation').val()?.trim() || '',
                first_name: $('input[name="first_name"]').val()?.trim() || '',
                middle_name: $('input[name="middle_name"]').val()?.trim() || '',
                last_name: $('input[name="last_name"]').val()?.trim() || '',
                mobile_no: $('input[name="mobile_no"]').val()?.trim() || '',
                email: $('input[name="email"]').val()?.trim() || '',
                percentage_share: $('input[name="percentage_share"]').val()?.trim() || '',
                point_of_contact: $('input[name="point_of_contact"]:checked').val()?.trim() || '',
                // Array inputs for partnership
                p_salutation: $('select[name="p_salutation[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_first_name: $('input[name="p_first_name[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_middle_name: $('input[name="p_middle_name[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_last_name: $('input[name="p_last_name[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_mobile_no: $('input[name="p_mobile_no[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_percentage_share: $('input[name="p_percentage_share[]"]').map((_, el) => $(el).val()?.trim() || '').get(),
                p_point_of_contact: $('input[name="p_point_of_contact[]"]:checked').map((_, el) => $(el).val()?.trim() || '').get(),
                person_appointed: $('#person_appointed').val()?.trim() || '',
                con_salutation: $('#con_salutation').val()?.trim() || '',
                con_first_name: $('input[name="con_first_name"]').val()?.trim() || '',
                con_middle_name: $('input[name="con_middle_name"]').val()?.trim() || '',
                con_last_name: $('input[name="con_last_name"]').val()?.trim() || '',
                con_mobile_no: $('input[name="con_mobile_no"]').val()?.trim() || '',
                con_email: $('input[name="con_email"]').val()?.trim() || '',
                arc_salutation: $('#arc_salutation').val()?.trim() || '',
                arc_first_name: $('input[name="arc_first_name"]').val()?.trim() || '',
                arc_middle_name: $('input[name="arc_middle_name"]').val()?.trim() || '',
                arc_last_name: $('input[name="arc_last_name"]').val()?.trim() || '',
                name_of_firm: $('input[name="name_of_firm"]').val()?.trim() || '',
                arc_mobile_no: $('input[name="arc_mobile_no"]').val()?.trim() || '',
                arc_email: $('input[name="arc_email"]').val()?.trim() || '',
                firm_gst_pan_tan: $('input[name="firm_gst_pan_tan"]').val()?.trim() || '',
                firm_gst_pan_tan_no: $('input[name="firm_gst_pan_tan_no"]').val()?.trim() || ''
            };
            console.log(formData);
            // Clear previous errors
            $('[id^=error]').html('');
            $('#errorBlock').hide();

            // Validation
            const errors = [];
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const mobileRegex = /^[6-9]\d{10}$/;
            const percentageRegex = /^\d+(\.\d{1,2})?$/; // Allow integers or decimals up to 2 places

            // Validate single proprietary rights
            if (formData.proprietary_rights === 'single') {
                if (!formData.salutation) errors.push({
                    id: 'error22',
                    msg: 'Salutation is required'
                });
                if (!formData.first_name) errors.push({
                    id: 'error23',
                    msg: 'First name is required'
                });
                if (!formData.mobile_no) errors.push({
                    id: 'error24',
                    msg: 'Valid mobile number is required'
                });
                if (!formData.email || !emailRegex.test(formData.email)) errors.push({
                    id: 'error25',
                    msg: 'Valid email is required'
                });
                if (!formData.percentage_share || !percentageRegex.test(formData.percentage_share)) {
                    errors.push({
                        id: 'error26',
                        msg: 'Valid percentage share (e.g., 100 or 100.00) is required'
                    });
                } else if (parseFloat(formData.percentage_share) !== 100) {
                    errors.push({
                        id: 'error26',
                        msg: 'Percentage share must be 100 for single proprietary'
                    });
                }
            }
            // Validate partnership (multiple entries)
            else if (formData.proprietary_rights === 'partnership') {
                const partnerCount = formData.p_first_name.length;
                if (partnerCount === 0) {
                    errors.push({
                        id: 'error27',
                        msg: 'At least one partner is required'
                    });
                } else {
                    let totalPercentage = 0;
                    formData.p_first_name.forEach((_, index) => {
                        if (!formData.p_salutation[index]) errors.push({
                            id: `error27_${index}`,
                            msg: `Partner ${index + 1}: Salutation is required`
                        });
                        if (!formData.p_first_name[index]) errors.push({
                            id: `error28_${index}`,
                            msg: `Partner ${index + 1}: First name is required`
                        });
                        if (!formData.p_mobile_no[index]) {
                            errors.push({
                                id: `error29_${index}`,
                                msg: `Partner ${index + 1}: Valid mobile number is required`
                            });
                        }
                        if (!formData.p_percentage_share[index] || !percentageRegex.test(formData.p_percentage_share[index])) {
                            errors.push({
                                id: `error30_${index}`,
                                msg: `Partner ${index + 1}: Valid percentage share is required`
                            });
                        } else {
                            totalPercentage += parseFloat(formData.p_percentage_share[index] || 0);
                        }
                        if (!formData.p_point_of_contact[0]) errors.push({
                            id: `error31_${0}`,
                            msg: `Partner ${0 + 1}: Point of contact is required`
                        });
                    });
                    if (totalPercentage !== 100) {
                        errors.push({
                            id: 'error30',
                            msg: 'Total percentage share for all partners must equal 100'
                        });
                    }
                }
            } else {
                errors.push({
                    id: 'error21',
                    msg: 'Proprietary rights selection is required'
                });
            }

            // Validate other fields
            if (!formData.person_appointed) errors.push({
                id: 'error32',
                msg: 'Person appointed is required'
            });
            if (!formData.con_salutation) errors.push({
                id: 'error33',
                msg: 'Contact salutation is required'
            });
            if (!formData.con_first_name) errors.push({
                id: 'error34',
                msg: 'Contact first name is required'
            });
            if (!formData.con_mobile_no) errors.push({
                id: 'error35',
                msg: 'Valid contact mobile number is required'
            });
            if (!formData.con_email || !emailRegex.test(formData.con_email)) errors.push({
                id: 'error36',
                msg: 'Valid contact email is required'
            });
            if (!formData.arc_salutation) errors.push({
                id: 'error37',
                msg: 'ARC salutation is required'
            });
            if (!formData.arc_first_name) errors.push({
                id: 'error38',
                msg: 'ARC first name is required'
            });
            if (!formData.arc_mobile_no) errors.push({
                id: 'error39',
                msg: 'Valid ARC mobile number is required'
            });
            if (!formData.arc_email || !emailRegex.test(formData.arc_email)) errors.push({
                id: 'error40',
                msg: 'Valid ARC email is required'
            });

            // Display errors if any
            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                console.log('Validation Errors:', errors);
                $('#errorBlock').show();
                return false;
            }

            // Prepare FormData for AJAX
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                if (Array.isArray(formData[key])) {
                    formData[key].forEach((value, index) => {
                        ajaxFormData.append(`${key}[${index}]`, value);
                    });
                } else {
                    ajaxFormData.append(key, formData[key]);
                }
            });

            // AJAX submission
            $.ajax({
                url: "{{route('noc.step.second.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response) {

                    if (response.status === '1') {
                        // Clear all error messages
                        $('[id^=error]').html('');
                        // Switch to areaTab
                        const tabs = ['basic', 'proprietary', 'area', 'essential', 'attachments', 'final'];
                        tabs.forEach(tab => {
                            $(`#${tab}TabLink`).toggleClass('active', tab === 'area');
                            $(`#${tab}Tab`).toggleClass('show active', tab === 'area');
                        });
                        // Update progress bar
                        const newValue = 34;
                        $('#bar_value').attr('aria-valuenow', newValue);
                        $('#bar_text').css('width', `${newValue}%`).text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || 'An error occurred').show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', {
                        status,
                        error,
                        response: xhr.responseText
                    });
                    const errorMsg = xhr.responseJSON?.msg || xhr.responseJSON?.message || 'An error occurred';
                    $('#errorBlock').html(errorMsg).show();
                }
            });
        });
        $(document).on('click', '#submitArea', function(e) {
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val()?.trim() || '',
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                total_plot_area: $('input[name="total_plot_area"]').val()?.trim() || '',
                total_covered_area: $('input[name="total_covered_area"]').val()?.trim() || '',
                ground_floor_covered: $('input[name="ground_floor_covered"]').val()?.trim() || '',
                max_height_building: $('input[name="max_height_building"]').val()?.trim() || '',
                basement_covered_area: $('input[name="basement_covered_area"]').val()?.trim() || '',
                no_of_floor: $('input[name="no_of_floor"]').val()?.trim() || '',
                no_of_basement: $('input[name="no_of_basement"]').val()?.trim() || '',
                no_of_blocks: $('input[name="no_of_blocks"]').val()?.trim() || '',
                height_of_tallest_block: $('input[name="height_of_tallest_block"]').val()?.trim() || '',
                min_distance_block: $('input[name="min_distance_block"]').val()?.trim() || '',
                approach_road_width: $('input[name="approach_road_width"]').val()?.trim() || '',
                provision_no_enterance: $('input[name="provision_no_enterance"]').val()?.trim() || '',
                provision_no_exit: $('input[name="provision_no_exit"]').val()?.trim() || '',
                front: $('input[name="front"]').val()?.trim() || '',
                rear: $('input[name="rear"]').val()?.trim() || '',
                side1: $('input[name="side1"]').val()?.trim() || '',
                side2: $('input[name="side2"]').val()?.trim() || '',
            };
            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            if (!formData.total_plot_area) errors.push({
                id: "error41",
                msg: "Total plot area is required"
            });
            if (!formData.total_covered_area) errors.push({
                id: "error42",
                msg: "Total covered area is required"
            });
            if (!formData.ground_floor_covered) errors.push({
                id: "error43",
                msg: "Ground floor overed is required"
            });
            if (!formData.max_height_building) errors.push({
                id: "error44",
                msg: "Max height building is required"
            });
            if (!formData.basement_covered_area) errors.push({
                id: "error45",
                msg: "Basement covered area is required"
            });
            if (!formData.no_of_floor) errors.push({
                id: "error46",
                msg: "No of floor is required"
            });
            if (!formData.no_of_basement) errors.push({
                id: "error47",
                msg: "No of _basement is required"
            });
            if (!formData.no_of_blocks) errors.push({
                id: "error48",
                msg: "No of blocks is required"
            });
            if (!formData.height_of_tallest_block) errors.push({
                id: "error49",
                msg: "Height of tallest block is required"
            });
            if (!formData.min_distance_block) errors.push({
                id: "error50",
                msg: "Min distance block is required"
            });
            if (!formData.approach_road_width) errors.push({
                id: "error51",
                msg: "Approach road width is required"
            });
            if (!formData.provision_no_enterance) errors.push({
                id: "error52",
                msg: "Provision no enterance is required"
            });
            if (!formData.provision_no_exit) errors.push({
                id: "error53",
                msg: "Provision no exit is required"
            });
            if (!formData.front) errors.push({
                id: "error54",
                msg: "Front is required"
            });
            if (!formData.rear) errors.push({
                id: "error55",
                msg: "Rear is required"
            });
            if (!formData.side1) errors.push({
                id: "error56",
                msg: "Side 1 is required"
            });
            if (!formData.side2) errors.push({
                id: "error57",
                msg: "Side 2 is required"
            });

            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                console.log("Validation Errors:", errors);
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.third.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {

                    if (response.status === "1") {
                        const errorIds = [
                            'error22', 'error23', 'error24', 'error25', 'error26',
                            'error27', 'error28', 'error29', 'error30', 'error31', 'error32',
                            'error33', 'error34', 'error35', 'error36', 'error37', 'error38',
                            'error39', 'error40'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#essentialTabLink").addClass('active');
                        $("#essentialTab").addClass('show active');
                        const newValue = 51;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", {
                        status,
                        error,
                        response: xhr.responseText
                    });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
        $(document).on('click', '#submitEssential', function(e) {
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val()?.trim() || '',
                application_no: $('input[name="application_no"]').val()?.trim() || '',
                compartmentation: $('input[name="compartmentation"]:checked').val()?.trim() || '',
                no_of_stairs: $('input[name="no_of_stairs"]').val()?.trim() || '',
                width_of_stairs: $('input[name="width_of_stairs"]').val()?.trim() || '',
                emergency_exit: $('input[name="emergency_exit"]:checked').val()?.trim() || '',
                provision_of_lift: $('input[name="provision_of_lift"]:checked').val()?.trim() || '',
                electric_suppy: $('input[name="electric_suppy"]:checked').val()?.trim() || '',
                emergency_lighting_system: $('input[name="emergency_lighting_system"]:checked').val()?.trim() || '',
                provision_of_smoke: $('input[name="provision_of_smoke"]:checked').val()?.trim() || '',
                refuse_area: $('input[name="refuse_area"]:checked').val()?.trim() || '',
                travel_distance: $('input[name="travel_distance"]').val()?.trim() || '',
                other_comment: $('#other_comment').val()?.trim() || '',
            };
            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            if (!formData.no_of_stairs) errors.push({
                id: "error58",
                msg: "No of stairs is required"
            });
            if (!formData.width_of_stairs) errors.push({
                id: "error59",
                msg: "Width of stairs is required"
            });
            if (!formData.travel_distance) errors.push({
                id: "error60",
                msg: "Travel distance is required"
            });
            if (!formData.other_comment) errors.push({
                id: "error61",
                msg: "Other comment is required"
            });

            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                console.log("Validation Errors:", errors);
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.forth.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {

                    if (response.status === "1") {
                        const errorIds = [
                            'error58', 'error59', 'error60', 'error61'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#attachmentsTabLink").addClass('active');
                        $("#attachmentsTab").addClass('show active');
                        const newValue = 68;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", {
                        status,
                        error,
                        response: xhr.responseText
                    });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
        $(document).on('click', '#submitAttachment', function(e) {
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val(),
                application_no: $('#application_no').val(),
                reference_letter: $('#reference_letter')[0].files[0],
                proposed_map: $('#proposed_map')[0].files[0],
                fire_plan: $('#fire_plan')[0].files[0]
            };
            $("[id^=error]").html("");
            $("#errorBlock").hide();
            let errors = [];
            if (!formData.reference_letter) errors.push({
                id: "error62",
                msg: "Reference letter is required"
            });
            if (!formData.proposed_map) errors.push({
                id: "error63",
                msg: "Proposed map is required"
            });
            if (!formData.fire_plan) errors.push({
                id: "error64",
                msg: "Fire plan is required"
            });

            if (errors.length > 0) {
                errors.forEach(error => $(`#${error.id}`).html(error.msg));
                console.log("Validation Errors:", errors);
                return false;
            }
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.five.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {

                    if (response.status === "1") {
                        const errorIds = [
                            'error62', 'error63', 'error64'
                        ];
                        errorIds.forEach(id => $(`#${id}`).html(""));
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#finalTabLink").addClass('active');
                        $("#finalTab").addClass('show active');
                        const origin = window.location.origin;
                        const application_no = $('#application_no').val();
                        const url = origin + '/preview-noc/' + application_no;
                        fetch(url)
                            .then(response => {
                                if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                                return response.text();
                            })
                            .then(html => {
                                let parser = new DOMParser();
                                let doc = parser.parseFromString(html, 'text/html');
                                let content = doc.getElementById('content');
                                if (!content) throw new Error('No element with ID "content" found');
                                $('#final_review').html(content);
                            })
                            .catch(error => console.error('Error fetching Fire Report:', error));
                        const newValue = 85;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", {
                        status,
                        error,
                        response: xhr.responseText
                    });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
        $(document).on('click', '#submitFinal', function(e) {
            e.preventDefault();
            const formData = {
                _token: $('input[name="_token"]').val(),
                application_no: $('input[name="application_no"]').val()
            };
            const ajaxFormData = new FormData();
            Object.keys(formData).forEach(key => {
                ajaxFormData.append(key, formData[key]);
            });

            // AJAX request
            $.ajax({
                url: "{{route('noc.step.seven.post')}}",
                type: 'POST',
                data: ajaxFormData,
                contentType: false,
                processData: false,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': formData._token
                },
                success: function(response) {
                    if (response.status === "1") {
                        const tabLinks = [
                            'basicTabLink', 'proprietaryTabLink', 'areaTabLink',
                            'essentialTabLink', 'attachmentsTabLink', 'finalTabLink'
                        ];
                        const tabs = [
                            'basicTab', 'proprietaryTab', 'areaTab',
                            'essentialTab', 'attachmentsTab', 'finalTab'
                        ];
                        tabLinks.forEach(link => $(`#${link}`).removeClass('active'));
                        tabs.forEach(tab => $(`#${tab}`).removeClass('show active'));
                        $("#finalTabLink").addClass('active');
                        $("#finalTab").addClass('show active');
                        const newValue = 100;
                        const bar = $('#bar_value');
                        const bar_text = $('#bar_text');
                        bar.attr('aria-valuenow', newValue);
                        bar_text.css('width', `${newValue}%`);
                        bar_text.text(`${newValue}%`);
                        $('#successBlock').html(response.msg).show();
                        $('#final_result').css("display", "block");
                        $('#step_submit_form').css("display", "none");
                    } else {
                        $('#errorBlock').html(response.msg || "An error occurred").show();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", {
                        status,
                        error,
                        response: xhr.responseText
                    });
                    $('#errorBlock').html(`An error occurred: ${xhr.responseJSON?.message || error}`).show();
                }
            });
        });
    });
</script>

<?php
$lat = '30.290817';
$lng = '78.053192';
?>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_eIyP2oTRYMfeG3PdSDYFv8o5cYVI7ZA&libraries=places"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtMi4Z8duiA0kw6VwdxDnLIVqemirjHZs&libraries=places&callback=initMap" async defer></script>

<script>
    let map;
    let marker;

    function initMap() {
        const defaultLocation = {
            lat: 30.3165,
            lng: 78.0322
        }; // Dehradun

        map = new google.maps.Map(document.getElementById("map"), {
            center: defaultLocation,
            zoom: 13,
        });

        // Marker initialization
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        const input = document.getElementById("pac-input");
        const latInput = document.getElementById("lat");
        const lngInput = document.getElementById("lng");

        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        map.addListener("bounds_changed", () => {
            searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener("places_changed", () => {
            const places = searchBox.getPlaces();
            if (places.length === 0) return;

            const place = places[0];
            if (!place.geometry) return;

            const location = place.geometry.location;
            map.setCenter(location);
            map.setZoom(16);
            marker.setPosition(location);
            marker.setVisible(true);

            // Set lat/lng in input boxes
            latInput.value = location.lat();
            lngInput.value = location.lng();
        });

        // On map click
        map.addListener("click", function(e) {
            const clickedLocation = e.latLng;
            marker.setPosition(clickedLocation);
            marker.setVisible(true);
            latInput.value = clickedLocation.lat();
            lngInput.value = clickedLocation.lng();
        });

        // On marker drag
        marker.addListener("dragend", function() {
            const pos = marker.getPosition();
            latInput.value = pos.lat();
            lngInput.value = pos.lng();
        });
    }
</script>
@php
    $occupancyDetail = json_decode(data_get($application,'occupancy_detail','{}'), true);
@endphp

<script>
    const SAVED_SUBCATEGORY_ID = "{{ data_get($application,'subcategory_id') }}";
    const SAVED_CATEGORY_ID = "{{ data_get($application,'category_id') }}";
    const SAVED_OCCUPANCY_VALUE = "{{ $occupancyDetail['value'] ?? '' }}";
       
    $(document).ready(function() {

        let applicationCategoryId = "{{ data_get($application, 'category_id') }}";
        let applicationSubCategoryId = "{{ data_get($application, 'subcategory_id') }}";
        
        if (applicationSubCategoryId) {

            $.post("{{ route('getCategoriesBySubCategory') }}", {
                subcategory_id: applicationSubCategoryId,
                _token: "{{ csrf_token() }}"
            }, function(response) {

                let html = '<option value="">Select Category</option>';

                response.forEach(cat => {
                    let selected = (cat.id == applicationCategoryId) ? 'selected' : '';
                    html += `<option value="${cat.id}" ${selected}>${cat.name}</option>`;
                });

                $('#category_id').html(html);

                // 🔥 Trigger occupancy load automatically
                if (applicationCategoryId) {
                    $('#category_id').trigger('change');
                }
            });
        }

    });

    $(document).on('change', 'input[name="rural_urban"]', function () {
        chooseRularUrban();
    });

    $(document).ready(function () {

        let hasApprovedNoc = @json($hasApprovedNoc);

        if (hasApprovedNoc) {

            let districtId  = "{{ data_get($lockedAddress,'district_id') }}";
            let ruralUrban  = "{{ data_get($lockedAddress,'rural_urban') }}";
            let tehsilId    = "{{ data_get($lockedAddress,'tehsil_id') }}";
            let urbanBodyId = "{{ data_get($lockedAddress,'urban_body_id') }}";
            let wardId      = "{{ data_get($lockedAddress,'ward_id') }}";
            let blockId     = "{{ data_get($lockedAddress,'block_id') }}";
            let panchayatId = "{{ data_get($lockedAddress,'panchayat_id') }}";

            $('#district_id').val(districtId);

            $('#' + ruralUrban).prop('checked', true);
            chooseRularUrban();

            // Urban flow
            if (ruralUrban === 'urban') {
                $.post("getTehsilByDistrict", { district_id: districtId }, function (res) {
                    $('#tehsil_id').html(res).val(tehsilId);

                    $.post("getUrbanBodyByTehsil", { district_id: districtId }, function (res) {
                        console.log('res ' + res);
                        console.log('urbanBodyId ' + urbanBodyId);
                        $('#urban_body_id').html(res).val(urbanBodyId);

                        $.post("getWardByUrbanBody", { urban_body_id: urbanBodyId }, function (res) {
                            $('#ward_id').html(res).val(wardId);
                        });
                    });
                });
            }

            // Rural flow
            if (ruralUrban === 'rural') {
                $.post("getBlockByDistrict", { district_id: districtId }, function (res) {
                    $('#block_id').html(res).val(blockId);

                    $.post("getPanchayatByBlock", { block_id: blockId }, function (res) {
                        $('#panchayat_id').html(res).val(panchayatId);
                    });
                });
            }

            // 🔒 LOCK FULL ADDRESS (except landmark)
            $('#district_id').prop('disabled', true);
            $('input[name="rural_urban"]').prop('disabled', true);
            $('#tehsil_id,#urban_body_id,#ward_id,#block_id,#panchayat_id').prop('disabled', true);
            $('#village,#street,#pincode').prop('readonly', true);
        }
    });

</script>
<script>
    $(document).ready(function() {

        const tabMap = {
            basicTabLink: 'basicTab',
            proprietaryTabLink: 'proprietaryTab',
            areaTabLink: 'areaTab',
            essentialTabLink: 'essentialTab',
            attachmentsTabLink: 'attachmentsTab',
            finalTabLink: 'finalTab'
        };

        $('.nav-link').on('click', function(e) {
            e.preventDefault();

            let clickedLinkId = $(this).attr('id');
            let targetTab = tabMap[clickedLinkId];

            if (!targetTab) return;

            // Remove active from all
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('show active');

            // Activate clicked tab
            $('#' + clickedLinkId).addClass('active');
            $('#' + targetTab).addClass('show active');
        });

    });


</script>


@stop
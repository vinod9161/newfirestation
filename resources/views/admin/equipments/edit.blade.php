@extends('layouts.admin.template')

@section('title')
<title>Edit Equipment</title>
@endsection

@section('style')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">

<!-- Select2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
@endsection

@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Manage Equipment</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="{{ route('admin.equipmentlist') }}" class="btn ripple btn-wave btn-success mb-0">
                <i class="fe fe-plus me-1"></i> View Equipment List
            </a>
        </div>
    </div>
</div>

<!-- Start::row-2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Edit Equipment</div>
            </div>
            <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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

                <div class="table-responsive">
                    <form id="equipmentForm" action="{{ route('admin.updateequipment') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>District <sup class="text-danger">*</sup></label>
                                <select name="district" id="district" class="form-control js-example-basic-single">
                                    <option value="">--- Select District ---</option>
                                    <?php if(!empty($getDistrict)):?>
                                    <?php foreach($getDistrict as $key => $val):?>
                                        <?php if($getData->district_id == $val->id):?>
                                            <option value="<?= $val->id; ?>" selected><?= $val->name; ?></option>
                                        <?php else:?>
                                            <option value="<?= $val->id; ?>"><?= $val->name; ?></option>
                                        <?php endif;?>        
                                    <?php endforeach;?>        
                                    <?php else:?>
                                    <option value="" class="text-danger">No District Found</option>        
                                    <?php endif;?>    
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Station <sup class="text-danger">*</sup></label>
                                <select name="station" id="station" class="form-control js-example-basic-single">
                                    <option value="">--- Select Station ---</option>
                                    <?php if(!empty($getFireStation)):?>
                                    <?php foreach($getFireStation as $key => $val):?>
                                        <?php if($getData->station_id == $val->id):?>
                                            <option value="<?= $val->id; ?>" selected><?= $val->name; ?></option>
                                        <?php else:?>
                                            <option value="<?= $val->id; ?>"><?= $val->name; ?></option>
                                        <?php endif;?>        
                                    <?php endforeach;?>        
                                    <?php else:?>
                                    <option value="" class="text-danger">No Fire Station Found</option>        
                                    <?php endif;?> 
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Category <sup class="text-danger">*</sup></label>
                                <select name="category" id="category" class="form-control js-example-basic-single">
                                    <option value="">--- Select Category ---</option>
                                    <?php if(!empty($getCategory)):?>
                                    <?php foreach($getCategory as $key => $val):?>
                                        <?php if($getData->category_id == $val->id):?>
                                            <option value="<?= $val->id; ?>" selected><?= $val->name; ?></option>
                                        <?php else:?>
                                            <option value="<?= $val->id; ?>"><?= $val->name; ?></option>    
                                        <?php endif;?>
                                    <?php endforeach;?>        
                                    <?php else:?>
                                    <option value="" class="text-danger">No Category Found</option>        
                                    <?php endif;?> 
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Equipment Name <sup class="text-danger">*</sup></label>
                                <select name="name" id="name" class="form-control js-example-basic-single">
                                    <option value="">--- Select Equipment Name ---</option>
                                    <?php if(!empty($getEquipmentName)):?>
                                    <?php foreach($getEquipmentName as $key => $val):?>
                                        <?php if($getData->equipment_name == $val->id):?>
                                            <option value="<?= $val->id; ?>" selected><?= $val->name; ?></option>
                                        <?php else:?>
                                            <option value="<?= $val->id; ?>"><?= $val->name; ?></option>    
                                        <?php endif;?>
                                    <?php endforeach;?>        
                                    <?php else:?>
                                    <option value="" class="text-danger">No Equipment Name Found</option>        
                                    <?php endif;?> 
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Total Equipments <sup class="text-danger">*</sup></label>
                                <input type="text" name="total_equipemnt" id="total_equipemnt" class="form-control numeric-only" placeholder="Enter Total Equipments" value="<?= $getData->total_equipemnt; ?>">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Total Working Equipments <sup class="text-danger">*</sup></label>
                                <input type="text" name="total_working_equipemnt" id="total_working_equipemnt" class="form-control numeric-only" placeholder="Enter Total Working Equipments" value="<?= $getData->total_working_equipment; ?>">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Total Non-Working Equipment <sup class="text-danger">*</sup></label>
                                <input type="text" name="total_non_working_equipemnt" id="total_non_working_equipemnt" class="form-control numeric-only" placeholder="Enter Total Non-Working Equipments" value="<?= $getData->total_non_working_equipment; ?>">
                            </div>

                            <div class="col-md-3 form-group">
                                <label>Status <sup class="text-danger">*</sup></label>
                                <select name="status" id="status" class="form-control js-example-basic-single">
                                    <option value="">--- Select Status ---</option>
                                    <option value="1" <?= $getData->status == 1 ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?= $getData->status == 0 ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>

                            <div class="col-md-3 form-group" style="margin-top:29px">
                                <input type="text" name="eid" id="eid" value="<?= $getData->id; ?>" hidden>
                                <button type="submit" class="btn btn-primary w-100" name="add_equipment" id="add_equipment">Submit</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>

<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2(); // Initialize Select2

        // Custom form validation
        $("#equipmentForm").on("submit", function (e) {
            let isValid = true;

            // Required field validation
            const requiredFields = ["district", "station", "category", "name", "total_equipemnt", "total_working_equipemnt", "total_non_working_equipemnt"];

            requiredFields.forEach(function (field) {
                let input = $("#" + field);
                if (input.val().trim() === "") {
                    isValid = false;
                    input.addClass("is-invalid");
                    input.next(".error-message").remove();
                    input.after(`<span class="error-message text-danger">This field is required</span>`);
                } else {
                    input.removeClass("is-invalid");
                    input.next(".error-message").remove();
                }
            });

            // Numeric validation for total equipment fields
            $(".numeric-only").each(function () {
                let input = $(this);
                if (!/^\d+$/.test(input.val().trim())) {
                    isValid = false;
                    input.addClass("is-invalid");
                    input.next(".error-message").remove();
                    input.after(`<span class="error-message text-danger">Only numbers are allowed</span>`);
                } else {
                    input.removeClass("is-invalid");
                    input.next(".error-message").remove();
                }
            });

            if (!isValid) {
                e.preventDefault(); // Prevent form submission if validation fails
            }
        });

        // Remove error messages on input change
        $("input, select").on("input change", function () {
            $(this).removeClass("is-invalid");
            $(this).next(".error-message").remove();
        });

        // Restrict input to numbers only
        $(".numeric-only").on("input", function () {
            this.value = this.value.replace(/\D/g, '');
        });

        // get station by id
        $(document).on('change', '#district', function()
        {
            let district = $(this).val();

            if (district == '') 
            {
                alert("Required District");
                return false;
            } 
            else 
            {
                $.ajax({
                    url: "{{ route('admin.getstationbydistrict') }}",
                    type: "POST",
                    data: {
                        district_id: district,
                        _token: "{{ csrf_token() }}" // Include CSRF token
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (typeof resp !== "object") {
                            resp = JSON.parse(resp);
                        }

                        if (resp.status == 1) {
                            let innerOption = '<option value="">--- Select Station ---</option>';
                            $.each(resp.data, function(index, value) 
                            { 
                                innerOption += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $('#station').html(innerOption);
                        } 
                        else {
                            alert(resp.message);
                        }
                    }
                });
            }
        });

        // get equipment name by id
        $(document).on('change', '#category', function(){
            let category = $(this).val();
            if (category == '') 
            {
                alert("Required Category");
                return false;
            } 
            else{
                $.ajax({
                    url: "{{ route('admin.getnamebycategory') }}",
                    type: "POST",
                    data: {
                        category_id: category,
                        _token: "{{ csrf_token() }}" // Include CSRF token
                    },
                    success: function(resp) {
                        console.log(resp);
                        if (typeof resp !== "object") {
                            resp = JSON.parse(resp);
                        }

                        if (resp.status == 1) {
                            let innerOption = '<option value="">--- Select Equipment Name ---</option>';
                            $.each(resp.data, function(index, value) 
                            { 
                                innerOption += '<option value="' + value.id + '">' + value.name + '</option>';
                            });
                            $('#name').html(innerOption);
                        } 
                        else {
                            alert(resp.message);
                        }
                    }
                });
            }

        });




    });
</script>
@endsection

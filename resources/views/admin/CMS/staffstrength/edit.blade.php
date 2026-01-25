@extends('layouts.admin.template')
@section('title')
<title>Add Staff Strength</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Staff Strength</h5>
    </div>
    <div class="d-flex app-header-btn">
       
        <div>
            <a href="<?php echo route('admin.staffstrength');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> View Staff Strength
            </a>
        </div>
    </div>
</div>

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add Staff Strength
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-12" style="margin:0 auto">
                        <div class="card">
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

                                <form action="{{ route('admin.savestaffstrength.update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        
                                        <div class="col-md-4 form-group">
                                            <label>District जनपद <sup class="text-danger">*</sup></label>
                                            <select name="district" id="district" class="form-control js-example-basic-single">
                                                <option value="">--- Select District जनपद</option>
                                                <?php if(!empty($getData)):?>
                                                    <?php foreach($getData as $row):?>
                                                        <?php if($getval->district_id == $row->id):?>
                                                            <option value="{{ $row->id }}" selected>{{ $row-> name }}</option>
                                                        <?php else:?>
                                                            <option value="{{ $row->id }}">{{ $row-> name }}</option>    
                                                        <?php endif;?>    
                                                    <?php endforeach;?>    
                                                <?php else:?>
                                                    <option value="" class="text-danger">No District Found</option>
                                                <?php endif;?>        
                                            </select>
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>CFO Accepted मुख्य अग्निशमन अधिकारी स्वीकृत<sup class="text-danger">*</sup></label>
                                            <input type="text" name="cfo_accepted" id="cfo_accepted" class="form-control" placeholder="Enter CFO Accepted Value" value="{{ $getval->cfo_approve }}">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>CFO Available मुख्य अग्निशमन अधिकारी उपलब्ध<sup class="text-danger">*</sup></label>
                                            <input type="text" name="cfo_available" id="cfo_available" class="form-control" placeholder="Enter CFO Available Value "value="{{ $getval->cfo_available }}">
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label>FSO Accepted अग्निशमन अधिकारी स्वीकृत<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fso_accepted" id="fso_accepted" class="form-control" placeholder="Enter FSO Accepted Value" value="{{ $getval->fso_approve }}">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>FSO Available अग्निशमन अधिकारी उपलब्ध<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fso_available" id="fso_available" class="form-control" placeholder="Enter FSO Available Value" value="{{ $getval->fso_available }}">
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label>FSSO Accepted अग्निशमन द्वितीय अधिकारी स्वीकृत<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fsso_accepted" id="fsso_accepted" class="form-control" placeholder="Enter FSSO Accepted Value" value="{{ $getval->fsso_approve }}">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>FSSO Available अग्निशमन द्वितीय अधिकारी उपलब्ध<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fsso_available" id="fsso_available" class="form-control" placeholder="Enter FSSO Available Value" value="{{ $getval->fsso_available }}">
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label>Leading Fireman Accepted लीडिंग फायरमैन स्वीकृत<sup class="text-danger">*</sup></label>
                                            <input type="text" name="lf_accepted" id="lf_accepted" class="form-control" placeholder="Enter Leading Fireman Accepted Value" value="{{ $getval->leading_fireman_aprove }}">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>Leading Fireman Available लीडिंग फायरमैन उपलब्ध<sup class="text-danger">*</sup></label>
                                            <input type="text" name="lf_available" id="lf_available" class="form-control" placeholder="Enter Leading Fireman Available Value" value="{{ $getval->leading_fireman_available }}">
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label>Fireman Accepted फायरमैन स्वीकृत<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fm_accepted" id="fm_accepted" class="form-control" placeholder="Enter Fireman Accepted Value" value="{{ $getval->fireman_approve }}">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>Fireman Available फायरमैन उपलब्ध<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fm_available" id="fm_available" class="form-control" placeholder="Enter Fireman Available Value" value="{{ $getval->fireman_available }}">
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label>Fire Service Driver Accepted फायर सर्विस चालक स्वीकृत<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fsd_accepted" id="fsd_accepted" class="form-control" placeholder="Enter Fire Service Driver Accepted Value" value="{{ $getval->fs_driver_approve }}">
                                        </div>

                                        <div class="col-md-4 form-group">
                                            <label>Fire Service Driver Available फायर सर्विस चालक उपलब्ध<sup class="text-danger">*</sup></label>
                                            <input type="text" name="fsd_available" id="fsd_available" class="form-control" placeholder="Enter Fire Service Driver Available Value" value="{{ $getval->fs_driver_available }}">
                                        </div>

                                        <div class="col-md-4 form-group" style="margin-top:30px">
                                            <input type="hidden" name="ssid" id="ssid" value="{{ $getval->id }}">
                                            <button type="submit" name="staff" id="staff" class="btn btn-primary btn-sm w-100">Update</button>
                                        </div>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#staff').on('click', function(e){
            // alert("ok");
            // return false;
            e.preventDefault(); // Prevent form submission until validation passes
            
            // Get all field values
            let district = $('#district').val();
            let cfoAccepted = $('#cfo_accepted').val().trim();
            let cfoAvailable = $('#cfo_available').val().trim();
            let fsoAccepted = $('#fso_accepted').val().trim();
            let fsoAvailable = $('#fso_available').val().trim();
            let fssoAccepted = $('#fsso_accepted').val().trim();
            let fssoAvailable = $('#fsso_available').val().trim();
            let lfAccepted = $('#lf_accepted').val().trim();
            let lfAvailable = $('#lf_available').val().trim();
            let fmAccepted = $('#fm_accepted').val().trim();
            let fmAvailable = $('#fm_available').val().trim();
            let fsdAccepted = $('#fsd_accepted').val().trim();
            let fsdAvailable = $('#fsd_available').val().trim();

            // Clear previous error messages
            $('.error-message').remove();

            // Validation flags
            let isValid = true;

            // District validation
            if (!district) {
                $('#district').after('<span class="error-message text-danger">Please select a district</span>');
                isValid = false;
            }

            // Numeric field validations
            const fields = [
                { id: 'cfo_accepted', value: cfoAccepted, label: 'CFO Accepted' },
                { id: 'cfo_available', value: cfoAvailable, label: 'CFO Available' },
                { id: 'fso_accepted', value: fsoAccepted, label: 'FSO Accepted' },
                { id: 'fso_available', value: fsoAvailable, label: 'FSO Available' },
                { id: 'fsso_accepted', value: fssoAccepted, label: 'FSSO Accepted' },
                { id: 'fsso_available', value: fssoAvailable, label: 'FSSO Available' },
                { id: 'lf_accepted', value: lfAccepted, label: 'Leading Fireman Accepted' },
                { id: 'lf_available', value: lfAvailable, label: 'Leading Fireman Available' },
                { id: 'fm_accepted', value: fmAccepted, label: 'Fireman Accepted' },
                { id: 'fm_available', value: fmAvailable, label: 'Fireman Available' },
                { id: 'fsd_accepted', value: fsdAccepted, label: 'Fire Service Driver Accepted' },
                { id: 'fsd_available', value: fsdAvailable, label: 'Fire Service Driver Available' }
            ];

            fields.forEach(field => {
                if (!field.value) 
                {
                    $(`#${field.id}`).after(`<span class="error-message text-danger">${field.label} is required</span>`);
                    isValid = false;
                } 
                else if (!/^\d+$/.test(field.value)) 
                {
                    $(`#${field.id}`).after(`<span class="error-message text-danger">${field.label} must be a valid number</span>`);
                    isValid = false;
                } 
                else if (parseInt(field.value) < 0) {
                    $(`#${field.id}`).after(`<span class="error-message text-danger">${field.label} cannot be negative</span>`);
                    isValid = false;
                }
            });


            // Remove error messages after 3 seconds if any exist
            if ($('.error-message').length > 0) {
                setTimeout(function() {
                    $('.error-message').fadeOut(500, function() {
                        $(this).remove();
                    });
                }, 3000); // 3000 milliseconds = 3 seconds
            }

            // If all validations pass, submit the form
            if (isValid) 
            {
                $(this).closest('form').submit();
            }
             else 
             {
                // Scroll to first error
                $('html, body').animate({
                    scrollTop: $('.error-message').first().offset().top - 100
                }, 500);
                return false;
            }
        });
    });
</script>
@stop
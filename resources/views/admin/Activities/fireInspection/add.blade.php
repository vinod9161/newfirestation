@extends('layouts.admin.template')
@section('title')
<title>Fire Reports</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<style>
    .span_required {
        color: #ff0000;
    }
    .error {
        color: red;
    }
   .divborder {
        border-left: 1px solid #ccc;
        border-right: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
        border-top: none;
    }

    input:required{ display: block; }

    input, select, .form-control {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 0.875rem;
        font-weight: 400;
        line-height: 1.5;
        background-clip: padding-box;
        border: 1px solid #acafb4;
        border-radius: 3px;
/*        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;*/
    }

    input:focus, select:focus, .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        outline: none;
    }
    label 
    {
        font-size: 12px;
    }
</style>
@endsection
@section('content')

<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Add Fire Inspection</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="<?php echo route('admin.fireInspection');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> Fire Inspection List
            </a>
        </div>
    </div>
</div>
<!-- End Row -->

<!-- Start::row-2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
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
                <form method="post" enctype="multipart/form-data" action="{{route('admin.addFireInspectionPost')}}">
                    @csrf
                    <div class="row" style="padding-left: 10px;padding-right: 10px;">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>District जपपद <sup class="text-danger">*</sup></label>          
                                <select class="form-control js-example-basic-single" name="district_id" id="district_id" readonly>
                                    @foreach ($districts as $dist)
                                        <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                    @endforeach
                                </select>
                                <span class="error" id="error1"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Fire Station फायर स्टेशन <sup class="text-danger">*</sup></label>          
                                <select class="form-control js-example-basic-single" name="station_id" id="station_id" readonly>
                                    @foreach ($station as $st)
                                        <option value="{{ $st->id }}">{{ ucfirst($st->name) }} </option>
                                    @endforeach
                                </select>
                                <span class="error" id="error2"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Date of Fire Inspection <sup class="text-danger">*</sup></label>           
                                <input class="form-control" name="date" id="date" type="datetime-local" placeholder="">   
                                <span class="error" id="error3"></span>    
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Category <sup class="text-danger">*</sup></label>           
                                <input class="form-control" name="category" id="category" type="text" placeholder="">   
                                <span class="error" id="error4"></span>  
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="form-group">
                            <label class="form-label">Name of Firm/institution/Building <sup class="text-danger">*</sup></label>
                            <input type="text" name="firm_name" class="form-control" id="firm_name" placeholder="" />
                            <span class="error" id="error5"></span>  
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Condition of Firefighting Facilities <sup class="text-danger">*</sup></label>          
                                <select class="form-control js-example-basic-single" name="condition" id="condition">
                                    <option value="">-- Select An Option --</option>
                                    <option value="Working">Working</option>
                                    <option value="Non Working">Non Working</option>
                                    <option value="Partially Working">Partially Working</option>
                                    <option value="Not Installed">Not Installed</option>
                                    <option value="Not According to Norms">Not According to Norms</option>
                                </select>
                                <span class="error" id="error6"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Action taken <sup class="text-danger">*</sup></label>           
                                <input class="form-control" name="action" id="action" type="text" placeholder="">   
                                <span class="error" id="error7"></span>  
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Other Comments <sup class="text-danger">*</sup></label>           
                                <input class="form-control" name="comment" id="comment" type="text" placeholder="">   
                                <span class="error" id="error8"></span>    
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <button type="submit" id="submitButton" class="btn btn-primary w-30" style="width:10%">Save</button>
                        </div>
                    </div>

                </form>   
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
        $('.js-example-basic-multiple').select2();
        
        $(document).on('click', '#submitButton', function(event) {
            const _token = $('input[name="_token"]').val();
            const district_id = $('#district_id').val();
            const station_id = $('#station_id').val();
            const date = $('#date').val();
            const category = $('#category').val();
            const firm_name = $('#firm_name').val();
            const condition = $('#condition').val();
            const action = $('#action').val();
            const comment = $('#comment').val();

            function validateField(field, errorId)
            {
                if (!field) {
                    $('#' + errorId).html("This field is required.");
                    const errorElement = document.getElementById(errorId);
                    if (errorElement) {
                        errorElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        errorElement.focus();
                    }
                    return false;
                }
                else
                {
                    return true;
                }
            }
            const fieldsToValidate = [
                { field: district_id, errorId: 'error1' },
                { field: station_id, errorId: 'error2' },
                { field: date, errorId: 'error3' },
                { field: category, errorId: 'error4' },
                { field: firm_name, errorId: 'error5' },
                { field: condition, errorId: 'error6' },
                { field: action, errorId: 'error7' },
                { field: comment, errorId: 'error8' },
            ];
            fieldsToValidate.forEach(({ errorId }) => $('#' + errorId).html(""));
            const isValid = fieldsToValidate.every(({ field, errorId }) => validateField(field, errorId));
            if (!isValid)
            {
                return false;
            }
        });
    });
  
 </script>
@stop
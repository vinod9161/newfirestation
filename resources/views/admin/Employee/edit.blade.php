@extends('layouts.admin.template')
@section('title')
<title>Categories | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Employee / Employee</h5>
    </div>
    <div class="d-flex app-header-btn">
        <div>
            <a href="<?php echo route('admin.employees');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Employee  List
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Edit Employee
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

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

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.updateemployee', $employee->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Employee Code ईम्प्लॉई कोड <sup
                                                            class="text-danger">*</sup></label>
                                                    <input type="text" name="employee_code" id="employee_code"
                                                        class="form-control" placeholder="Enter Employee Code"
                                                        value="{{ old('employee_code', $employee->employee_code) }}"
                                                        required>
                                                    <span class="text-danger" id="employee_codeError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Employee Gender लिंग <sup class="text-danger">*</sup></label>
                                                    <select class="form-control js-searchBox" name="gender" id="gender" required>
                                                        <option value="" disabled {{ old('gender', $employee->gender) == '' ? 'selected' : '' }}>Select Gender</option>
                                                        <option value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                                        <option value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                                    </select>
                                                    <span class="text-danger" id="genderError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Employee Category वर्ग <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="form-control" name="category" id="category" required>
                                                        <option value="">Select Category</option>
                                                        <option value="GEN"
                                                            {{ (old('category', $employee->category) == 'GEN') ? 'selected' : '' }}>
                                                            General</option>
                                                        <option value="SC"
                                                            {{ (old('category', $employee->category) == 'SC') ? 'selected' : '' }}>
                                                            SC</option>
                                                        <option value="ST"
                                                            {{ (old('category', $employee->category) == 'ST') ? 'selected' : '' }}>
                                                            ST</option>
                                                        <option value="OBC"
                                                            {{ (old('category', $employee->category) == 'OBC') ? 'selected' : '' }}>
                                                            OBC</option>
                                                    </select>
                                                    <span class="text-danger" id="categoryError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name नाम <sup class="text-danger">*</sup></label>
                                                    <input class="form-control" size="60" maxlength="100" name="name"
                                                        id="name" type="text" placeholder="Name"
                                                        value="{{ old('name', $employee->name) }}" required />
                                                    <span class="text-danger" id="nameError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name In Hindi नाम हिंदी में * <sup
                                                            class="text-danger">*</sup></label>
                                                    <input class="form-control" size="60" maxlength="100"
                                                        name="name_in_hindi" id="name_in_hindi" type="text"
                                                        placeholder="Name In Hindi नाम हिंदी में"
                                                        value="{{ old('name_in_hindi', $employee->name_in_hindi) }}"
                                                        required />
                                                    <span class="text-danger" id="name_in_hindiError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Father Name पिता का नाम * <sup
                                                            class="text-danger">*</sup></label>
                                                    <input class="form-control" size="60" maxlength="100"
                                                        name="father_name" id="father_name" type="text"
                                                        placeholder="Father Name"
                                                        value="{{ old('father_name', $employee->father_name) }}"
                                                        required />
                                                    <span class="text-danger" id="father_nameError"></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Current District वर्तमान जनपद* <sup
                                                            class="text-danger">*</sup></label>
                                                    <select name="district_id" id="districts"
                                                        class="form-control js-example-basic-single" required>
                                                        <option value="">--- Select District जनपद ---</option>
                                                        @foreach($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ old('district_id', $employee->district_id) == $district->id ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="nameError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Home District गृह जनपद * <sup
                                                            class="text-danger">*</sup></label>
                                                    <select name="home_district" id="home_district"
                                                        class="form-control js-example-basic-single" required>
                                                        <option value="">--- Select District जनपद ---</option>
                                                        @foreach($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ old('home_district', $employee->home_district) == $district->id ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger" id="home_districtError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Recruitment District भर्ती जनपद <sup
                                                            class="text-danger">*</sup></label>
                                                    <select name="recruitment_district" id="recruitment_district"
                                                        class="form-control js-example-basic-single" required>
                                                        <option value="">--- Select District जनपद ---</option>
                                                        @foreach($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ old('recruitment_district', $employee->recruitment_district) == $district->id ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger" id="recruitment_districtError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Current Fire Station वर्तमान फायर स्टेशन <sup
                                                            class="text-danger">*</sup></label>
                                                    <select name="station_id" id="station_id"
                                                        class="form-control js-example-basic-single" required>
                                                        <option value="">--- Select Fire Station ---</option>
                                                        @foreach($stations as $station)
                                                        <option value="{{ $station->id }}"
                                                            {{ old('station_id', $employee->station_id) == $station->id ? 'selected' : '' }}>
                                                            {{ $station->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger" id="station_idError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Previous Posting पिछली नियुक्ति जनपद <sup
                                                            class="text-danger">*</sup></label>
                                                    <select name="previous_posting" id="previous_posting"
                                                        class="form-control js-example-basic-single" required>
                                                        <option value="">--- Select District जनपद ---</option>
                                                        @foreach($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ old('previous_posting', $employee->previous_posting) == $district->id ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger" id="previous_postingError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Designation at the time of recruitment जिस पद पर भर्ती हुआ
                                                        <sup class="text-danger">*</sup></label>
                                                    <select class="form-control" name="entry_level" id="entry_level"
                                                        required>
                                                        <option value="">Select Designation</option>
                                                        <option value="Chief fire officer"
                                                            {{ (old('entry_level') == 'Chief fire officer' || (isset($employee) && $employee->entry_level == 'Chief fire officer')) ? 'selected' : '' }}>
                                                            Chief fire officer</option>
                                                        <option value="Fire station second officer"
                                                            {{ (old('entry_level') == 'Fire station second officer' || (isset($employee) && $employee->entry_level == 'Fire station second officer')) ? 'selected' : '' }}>
                                                            Fire station second officer</option>
                                                        <option value="Fireman"
                                                            {{ (old('entry_level') == 'Fireman' || (isset($employee) && $employee->entry_level == 'Fireman')) ? 'selected' : '' }}>
                                                            Fireman</option>
                                                        <option value="Ministerial"
                                                            {{ (old('entry_level') == 'Ministerial' || (isset($employee) && $employee->entry_level == 'Ministerial')) ? 'selected' : '' }}>
                                                            Ministerial</option>
                                                        <option value="Cook/kahar"
                                                            {{ (old('entry_level') == 'Cook/kahar' || (isset($employee) && $employee->entry_level == 'Cook/kahar')) ? 'selected' : '' }}>
                                                            Cook/kahar</option>
                                                        <option value="Peon"
                                                            {{ (old('entry_level') == 'Peon' || (isset($employee) && $employee->entry_level == 'Peon')) ? 'selected' : '' }}>
                                                            Peon</option>
                                                        <option value="Sweper"
                                                            {{ (old('entry_level') == 'Sweper' || (isset($employee) && $employee->entry_level == 'Sweper')) ? 'selected' : '' }}>
                                                            Sweper</option>
                                                    </select>

                                                    <span class="text-danger" id="statusError"></span>
                                                </div>
                                            </div>



                                        </div>



                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Designation पद<sup class="text-danger">*</sup></label>
                                                    <select class="form-control" name="designation" id="designation"
                                                        required>
                                                        <option value="">Select Designation</option>
                                                        <option value="Deputy director"
                                                            {{ (old('designation') == 'Deputy director' || (isset($employee) && $employee->designation == 'Deputy director')) ? 'selected' : '' }}>
                                                            Deputy director</option>
                                                        <option value="Chief fire officer"
                                                            {{ (old('designation') == 'Chief fire officer' || (isset($employee) && $employee->designation == 'Chief fire officer')) ? 'selected' : '' }}>
                                                            Chief fire officer</option>
                                                        <option value="Fire station officer"
                                                            {{ (old('designation') == 'Fire station officer' || (isset($employee) && $employee->designation == 'Fire station officer')) ? 'selected' : '' }}>
                                                            Fire Station Officer</option>
                                                        <option value="Fire station second officer"
                                                            {{ (old('designation') == 'Fire station second officer' || (isset($employee) && $employee->designation == 'Fire station second officer')) ? 'selected' : '' }}>
                                                            Fire station second officer</option>
                                                        <option value="Leading fireman"
                                                            {{ (old('designation') == 'Leading fireman' || (isset($employee) && $employee->designation == 'Leading fireman')) ? 'selected' : '' }}>
                                                            Leading Fireman</option>
                                                        <option value="Fire service driver"
                                                            {{ (old('designation') == 'Fire service driver' || (isset($employee) && $employee->designation == 'Fire service driver')) ? 'selected' : '' }}>
                                                            Fire Service Driver</option>
                                                        <option value="Fireman"
                                                            {{ (old('designation') == 'Fireman' || (isset($employee) && $employee->designation == 'Fireman')) ? 'selected' : '' }}>
                                                            Fireman</option>
                                                        <option value="Assistant sub inspector(M)"
                                                            {{ (old('designation') == 'Assistant sub inspector(M)' || (isset($employee) && $employee->designation == 'Assistant sub inspector(M)')) ? 'selected' : '' }}>
                                                            Assistant sub inspector(M)</option>
                                                        <option value="Cook/kahar"
                                                            {{ (old('designation') == 'Cook/kahar' || (isset($employee) && $employee->designation == 'Cook/kahar')) ? 'selected' : '' }}>
                                                            Cook/kahar</option>
                                                        <option value="Peon"
                                                            {{ (old('designation') == 'Peon' || (isset($employee) && $employee->designation == 'Peon')) ? 'selected' : '' }}>
                                                            Peon</option>
                                                        <option value="Sweper"
                                                            {{ (old('designation') == 'Sweper' || (isset($employee) && $employee->designation == 'Sweper')) ? 'selected' : '' }}>
                                                            Sweper</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Birth जन्मतिथि <sup
                                                            class="text-danger">*</sup></label>
                                                    <input class="form-control" size="50" maxlength="50"
                                                        name="date_of_birth" id="date_of_birth" type="date"
                                                        placeholder="Date Of Birth" onchange="handler(event);"
                                                        value="{{ old('date_of_birth', $employee->date_of_birth) }}"
                                                        required />

                                                    <span class="text-danger" id="emailError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Recuirtment भर्ती तिथि <sup
                                                            class="text-danger">*</sup></label>
                                                    <input class="form-control" size="50" maxlength="50"
                                                        name="date_of_recuirtment" id="date_of_recuirtment" type="date"
                                                        placeholder="Date Of Recruitment"
                                                        value="{{ old('date_of_recuirtment', isset($employee) ? $employee->date_of_recuirtment : '') }}"
                                                        required />

                                                    <span class="text-danger" id="phoneError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Retirement सेवानिवृत्ति तिथि <sup
                                                            class="text-danger">*</sup></label>
                                                    <input class="form-control" size="50" maxlength="50"
                                                        name="date_of_retirement" id="date_of_retirement" type="date"
                                                        placeholder="Date Of Retirement"
                                                        value="{{ old('date_of_retirement', isset($employee) ? $employee->date_of_retirement : '') }}"
                                                        readonly />

                                                    <span class="text-danger" id="districtsError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Education शिक्षा <sup class="text-danger">*</sup></label>
                                                    <input class="form-control" size="50" maxlength="50"
                                                        name="education" id="education" type="text"
                                                        placeholder="Education"
                                                        value="{{ old('education', isset($employee) ? $employee->education : '') }}" />

                                                    <span class="text-danger" id="stationError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                @php
                                                $selectedCourses = old(
                                                    'states',
                                                    array_map('trim', explode(',', $employee->departmental_course ?? ''))
                                                );
                                                @endphp
                                                <div class="form-group">
                                                    <label>Departmental Course विभागीय पर्शिक्षण <sup
                                                            class="text-danger">*</sup></label>
                                                    <select class="js-example-basic-multiple" name="states[]" multiple>

                                                        <option value="Basic Disaster Response Course"
                                                            {{ in_array('Basic Disaster Response Course', $selectedCourses) ? 'selected' : '' }}>
                                                            Basic Disaster Response Course
                                                        </option>

                                                        <option value="Fire Fighting First Responder Course"
                                                            {{ in_array('Fire Fighting First Responder Course', $selectedCourses) ? 'selected' : '' }}>
                                                            Fire Fighting First Responder Course
                                                        </option>

                                                        <!-- repeat for all -->
                                                    </select>
                                                    <span
                                                        class="select2 select2-container select2-container--default select2-container--below"
                                                        dir="ltr" data-select2-id="select2-data-5-5wou"
                                                        style="width: 67.7031px;">
                                                        <span class="selection">
                                                        </span></span><span class="dropdown-wrapper"
                                                        aria-hidden="true"></span></span>
                                                    <span class="text-danger" id="statusError"></span>
                                                </div>
                                            </div>



                                        </div>


                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Remark टिप्पणी <sup class="text-danger">*</sup></label>
                                                    <input class="form-control" size="60" maxlength="100" name="remark"
                                                        id="remark" type="text" placeholder="Remark" value="{{ $employee->remark }}" />
                                                    <span class="text-danger" id="nameError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Employee Status <sup class="text-danger">*</sup></label>
                                                    <select class="form-control" name="status" id="status" required>
                                                        <option value="">Select Status</option>
                                                        <option value="Active" {{ old('status', $employee->status) == 'Active' ? 'selected' : '' }}>Active</option>
                                                        <option value="Retirement" {{ old('status', $employee->status) == 'Retirement' ? 'selected' : '' }}>Retirement</option>
                                                        <option value="VRS" {{ old('status', $employee->status) == 'VRS' ? 'selected' : '' }}>VRS</option>
                                                        <option value="Death" {{ old('status', $employee->status) == 'Death' ? 'selected' : '' }}>Death</option>
                                                        <option value="Resigned" {{ old('status', $employee->status) == 'Resigned' ? 'selected' : '' }}>Resigned</option>
                                                        <option value="Terminated" {{ old('status', $employee->status) == 'Terminated' ? 'selected' : '' }}>Terminated</option>
                                                    </select>
                                                    <span class="text-danger" id="emailError"></span>
                                                </div>
                                            </div>


                                        </div>
                                        <div class="row">


                                            <div class="col-md-12">
                                                <button type="submit" id="addCfo" class="btn btn-primary btn-sm"
                                                    style="width:20%">Submit</button>
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
</div>

@endsection
@section('scripts')


<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
$(function(e) {

    $('#datatable-basic').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
    });
});



$(document).ready(function() {
    $('#addCategory').on('click', function() {
        let category = $('#category').val();
        let projects = $('#projects').val();

        if (category == '') {
            $('#categoryError').html('Required Category').delay(3000).fadeOut().css('display', 'block');
            return false;
        } else if (projects == '') {
            $('#projectsError').html('Required Projects').delay(3000).fadeOut().css('display', 'block');
            return false;
        } else {
            return true;
        }
    });
});

function handler(e)
{
    var getLastDayOfMonth = function(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }
    var dob = new Date($("#date_of_birth").val());
    // alert(dob);
    if (isNaN(dob.getTime())) {
        alert('Please select a valid date of birth.');
        $("#outptLbl").html("Please select date!");
        return;
    }
    var year = dob.getFullYear();
    var month = dob.getMonth();
    var day = dob.getDate();
    if (day == 1)
    {
        if (month == 0)
        {
            year = year - 1;
            month = 11;
        }
        else
        {
            month = month - 1;
        }
        day = getLastDayOfMonth(year, month);
    }
    else
    {
        day = getLastDayOfMonth(year, month);
    }
    var retirement_date = new Date(year + 60, month, day);
    var formattedDate =
        retirement_date.getFullYear() + "-" +
        ("0" + (retirement_date.getMonth() + 1)).slice(-2) + "-" +
        ("0" + retirement_date.getDate()).slice(-2);

    console.log(formattedDate);
    $("#date_of_retirement").val(formattedDate);

}
</script>
@stop
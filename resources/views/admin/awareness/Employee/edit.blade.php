@extends('layouts.admin.template')
@section('title')
<title>Employee | Admin Dashboard</title>
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

                    
                    <?php //echo "<pre>"; print_r($employee, true);die;?>

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.saveemployees') }}" method="post">
                                        @csrf
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
                                                    <select class="form-control js-example-basic-single" name="gender" id="gender" required>
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
                                                    <label>Current District वर्तमान जनपद* <sup class="text-danger">*</sup></label>
                                                    {{-- <select name="district_id" id="districts"
                                                        class="form-control js-example-basic-single" required>
                                                        <option value="">--- Select District जनपद ---</option>
                                                        @foreach($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ (old('district_id', $district->id) == 'GEN') ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach
                                                    </select> --}}

                                                    @php
                                                            $isRestrictedUser = Auth::user()->type == 3;
                                                            $userDistrictId = Auth::user()->district_id;
                                                    @endphp
                                                    
                                                    <select class="form-control js-example-basic-single" name="district_id" id="district_id" {{ $isRestrictedUser ? 'required' : '' }}>
                                                            @if ($isRestrictedUser)
                                                            @foreach ($districts as $dist)
                                                                @if ($userDistrictId == $dist->id)
                                                                        <option value="{{ $dist->id }}" selected>{{ ucfirst($dist->name) }}</option>
                                                                @endif
                                                            @endforeach
                                                            @else
                                                            <option value="">Select District जनपद</option>
                                                            @foreach ($districts as $dist)
                                                                <option value="{{ $dist->id }}" @selected($dist->id == $employee->district_id)>{{ ucfirst($dist->name) }}</option>
                                                            @endforeach
                                                            @endif
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
                                                        {{-- @foreach($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ (old('home_district') == $district->id || (isset($record) && $record->home_district == $district->id)) ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach --}}

                                                        @foreach ($districts as $dist)
                                                            <option value="{{ $dist->id }}" @if ($employee->home_district == $dist->id) selected @endif>{{ ucfirst($dist->name) }} </option>
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
                                                        {{-- @foreach($districts as $district)
                                                        <option value="{{ $district->id }}"
                                                            {{ (old('recruitment_district') == $district->id || (isset($record) && $record->recruitment_district == $district->id)) ? 'selected' : '' }}>
                                                            {{ $district->name }}
                                                        </option>
                                                        @endforeach --}}

                                                        @foreach ($districts as $dist)
                                                            <option value="{{ $dist->id }}" @if ($employee->recruitment_district == $dist->id) selected @endif>{{ ucfirst($dist->name) }} </option>
                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger" id="recruitment_districtError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Current Fire Station वर्तमान फायर स्टेशन <sup class="text-danger">*</sup></label>

                                                    @if(Auth::user()->type == 3)
                                                      <?php $readonly = 'readonly'; ?>
                                                    @endif

                                                    

                                                    {{-- <select name="station_id" id="station_id" class="form-control js-example-basic-single" <?= $readonly ?? ''?> required>
                                                        <option value="">--- Select Fire Station ---</option>
                                                            @foreach($stations as $station)
                                                            <option value="{{ $station->id }}"
                                                                {{ (old('station_id') == $station->id || (isset($record) && $record->station_id == $station->id)) ? 'selected' : '' }}>
                                                                {{ $station->name }}
                                                            </option>
                                                            @endforeach
                                                    </select> --}}

                                                    @php
                                                        $isRestrictedUser = Auth::user()->type == 3;
                                                    @endphp

                                                    <select class="form-control js-example-basic-single" name="station_id" id="station_id" 
                                                            {{ $isRestrictedUser ? 'readonly required' : '' }}>
                                                        @if ($isRestrictedUser)
                                                            <option value="{{ $station->id ?? '' }}">{{ $station->name ?? 'No Station Assigned' }}</option>
                                                        @else
                                                            <option value="">Select Station फायर स्टेशन</option>
                                                            @foreach($stations as $station)
                                                                <option value="{{$station->id ?? ''}}" @if($employee->station_id == $station->id) selected @endif>{{$station->name ?? ''}} </option>
                                                            @endforeach    

                                                        @endif
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
                                                       
                                                        @foreach ($districts as $dist)
                                                        <option value="{{ $dist->id }}" @if ($employee->previous_posting == $dist->id) selected @endif>{{ ucfirst($dist->name) }} </option>
                                                        @endforeach
                                                    </select>

                                                    <span class="text-danger" id="previous_postingError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Designation at the time of recruitment जिस पद पर भर्ती हुआ
                                                        <sup class="text-danger">*</sup></label>
                                                    <select class="form-control js-example-basic-single" name="entry_level" id="entry_level"
                                                        required>
                                                        <option value="">Select Designation</option>
                                                        <option value="Chief fire officer" @if ($employee->entry_level == "Chief fire officer") selected @endif>Chief fire officer</option>
                                                        <option value="Fire station second officer" @if ($employee->entry_level == "Fire station second officer") selected @endif>Fire station second officer</option>
                                                        <option value="Fireman" @if ($employee->entry_level == "Fireman") selected @endif>Fireman</option>
                                                        <option value="Cook/kahar" @if ($employee->entry_level == "Cook/kahar") selected @endif>Cook/kahar</option>
                                                        <option value="Peon" @if ($employee->entry_level == "Peon") selected @endif>Peon</option>
                                                        <option value="Sweper" @if ($employee->entry_level == "Sweper") selected @endif>Sweper</option>
                                                    </select>

                                                    <span class="text-danger" id="statusError"></span>
                                                </div>
                                            </div>



                                        </div>



                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Designation पद<sup class="text-danger">*</sup></label>
                                                    <select class="form-control js-example-basic-single" name="designation" id="designation"
                                                        required>
                                                        <option value="">Select Designation</option>
                                                        <option value="Deputy director" @if ($employee->entry_level == "Deputy director") selected @endif>Deputy director</option>
                                                        <option value="Chief fire officer" @if ($employee->entry_level == "Chief fire officer") selected @endif>Chief fire officer</option>
                                                        <option value="Fire station officer" @if ($employee->entry_level == "Fire station officer") selected @endif>Fire station officer</option>
                                                        <option value="Fire station second officer" @if ($employee->entry_level == "Fire station second officer") selected @endif>Fire station second officer</option>
                                                        <option value="Leading fireman" @if ($employee->entry_level == "Leading fireman") selected @endif>Leading fireman</option>
                                                        <option value="Fire service driver" @if ($employee->entry_level == "Fire service driver") selected @endif>Fire service driver</option>
                                                        <option value="Fireman" @if ($employee->entry_level == "Fireman") selected @endif>Fireman</option>
                                                        <option value="Cook/kahar" @if ($employee->entry_level == "Cook/kahar") selected @endif>Cook/kahar</option>
                                                        <option value="Peon" @if ($employee->entry_level == "Peon") selected @endif>Peon</option>
                                                        <option value="Sweper" @if ($employee->entry_level == "Sweper") selected @endif>Sweper</option>
                                                    </select>

                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Birth जन्मतिथि <sup
                                                            class="text-danger">*</sup></label>
                                                    
                                                        @php
                                                            $date_of_birth = $employee->date_of_birth ? \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') : '';
                                                        @endphp          
                                                    <input class="form-control" size="50" maxlength="50"
                                                        name="date_of_birth" id="date_of_birth" type="date"
                                                        placeholder="Date Of Birth"
                                                        value="{{ $date_of_birth }}"
                                                        required />

                                                    <span class="text-danger" id="emailError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Recuirtment भर्ती तिथि <sup
                                                            class="text-danger">*</sup></label>

                                                        @php
                                                            $date_of_recuirtment = $employee->date_of_retirement ? \Carbon\Carbon::parse($employee->date_of_recuirtment)->format('Y-m-d') : '';
                                                        @endphp        
                                                    <input class="form-control" size="50" maxlength="50"
                                                        name="date_of_recuirtment" id="date_of_recuirtment" type="date"
                                                        placeholder="Date Of Recruitment"
                                                        value="{{ $date_of_recuirtment }}"
                                                        required />

                                                    <span class="text-danger" id="phoneError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Date Of Retirement सेवानिवृत्ति तिथि <sup
                                                            class="text-danger">*</sup></label>
                                                    


                                                    @php
                                                        $dateOfRetirement = $employee->date_of_retirement ? \Carbon\Carbon::parse($employee->date_of_retirement)->format('Y-m-d') : '';
                                                    @endphp
                                                    
                                                    <input class="form-control" size="50" maxlength="50"
                                                           name="date_of_retirement" id="date_of_retirement" type="date"
                                                           placeholder="Date Of Retirement" value="{{ $dateOfRetirement }}"
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
                                                <div class="form-group">
                                                    <label>Departmental Course विभागीय पर्शिक्षण <sup class="text-danger">*</sup></label>
                                                    @php
                                                    $course_str = $employee->departmental_course;
                                                    $course_arr = explode(", ",$course_str);
                                                    @endphp 
                                                    <select class="js-example-basic-multiple select2-hidden-accessible"
                                                        name="states[]" multiple=""
                                                        data-select2-id="select2-data-4-asye" tabindex="-1"
                                                        aria-hidden="true">
                                                        <option value="Sub-Officer" @if(in_array("Sub-Officer", $course_arr)) selected  @endif>&nbsp;Sub-Officer</option>
                                                        <option value="Station Officer" @if(in_array("Station Officer", $course_arr)) selected  @endif>&nbsp;Station Officer</option>
                                                        <option value="Divisonal Officer" @if(in_array("Divisonal Officer", $course_arr)) selected  @endif>&nbsp;Divisonal Officer</option>
                                                        <option value="Medical First Responder Course" @if(in_array("Medical First Responder Course", $course_arr)) selected  @endif>&nbsp;Medical First Responder Course</option>
                                                        <option value="Basic Disaster Response Course" @if(in_array("Basic Disaster Response Course", $course_arr)) selected  @endif>&nbsp;Basic Disaster Response Course</option>
                                                        <option value="General Search & Rescue Course" @if(in_array("General Search & Rescue Course", $course_arr)) selected  @endif>&nbsp;General Search & Rescue Course</option>
                                                        <option value="Advance Search & Rescue Course" @if(in_array("Advance Search & Rescue Course", $course_arr)) selected  @endif>&nbsp;Advance Search & Rescue Course</option>
                                                        <option value="Fire Fighting First Responder Course" @if(in_array("Fire Fighting First Responder Course", $course_arr)) selected  @endif>&nbsp;Fire Fighting First Responder Course</option>
                                                        <option value="Hazardous Material Emergency First Responder course" @if(in_array("Hazardous Material Emergency First Responder course", $course_arr)) selected  @endif>&nbsp;Hazardous Material Emergency First Responder course</option>
                                                        <option value="Weapon of Mass Destruction Course" @if(in_array("Weapon of Mass Destruction Course", $course_arr)) selected  @endif>&nbsp;Weapon of Mass Destruction Course</option>
                                                        <option value="Flood Rescue for First Responder Course" @if(in_array("Flood Rescue for First Responder Course", $course_arr)) selected  @endif>&nbsp;Flood Rescue for First Responder Course</option>
                                                        <option value="Collapsed structure — Search & Rescue Course" @if(in_array("Collapsed structure — Search & Rescue Course", $course_arr)) selected  @endif>&nbsp;Collapsed structure — Search & Rescue Course</option>
                                                        <option value="Chemical Disaster First Responder Course" @if(in_array("Chemical Disaster First Responder Course", $course_arr)) selected  @endif>&nbsp;Chemical Disaster First Responder Course</option>
                                                        <option value="Biological Incident First Responder Course" @if(in_array("Biological Incident First Responder Course", $course_arr)) selected  @endif>&nbsp;Biological Incident First Responder Course</option>
                                                        <option value="Flood / Cyclone Disaster Response Course" @if(in_array("Flood / Cyclone Disaster Response Course", $course_arr)) selected  @endif>&nbsp;Flood / Cyclone Disaster Response Course</option>
                                                        <option value="Earthquake Disaster Response Course" @if(in_array("Earthquake Disaster Response Course", $course_arr)) selected  @endif>&nbsp;Earthquake Disaster Response Course</option>
                                                        <option value="Emergency Response to Rail Transport Accident" @if(in_array("Emergency Response to Rail Transport Accident", $course_arr)) selected  @endif>&nbsp;Emergency Response to Rail Transport Accident</option>
                                                        <option value="TOT in Radiological & Nuclear Emergencies" @if(in_array("TOT in Radiological & Nuclear Emergencies", $course_arr)) selected  @endif>&nbsp;TOT in Radiological & Nuclear Emergencies</option>
                                                        <option value="Breathing Apparatus Course" @if(in_array("Breathing Apparatus Course", $course_arr)) selected  @endif>&nbsp;Breathing Apparatus Course</option>
                                                        <option value="Fire Prevention Course" @if(in_array("Fire Prevention Course", $course_arr)) selected  @endif>&nbsp;Fire Prevention Course</option>
                                   
                                                        <option value="Mountain Search and Rescue Course" @if(in_array("Mountain Search and Rescue Course", $course_arr)) selected  @endif>&nbsp;Mountain Search and Rescue Course</option>
                                                        <option value="High Altitude Search and Rescue" @if(in_array("High Altitude Search and Rescue", $course_arr)) selected  @endif>&nbsp;High Altitude Search and Rescue</option>
                                                    </select><span
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
                                                    <input class="form-control" size="60" maxlength="100" name="remark" id="remark" type="text" placeholder="Remark" value="{{$employee->remark}}"  />
                                                    <span class="text-danger" id="nameError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Employee Status <sup class="text-danger">*</sup></label>
                                                    <select class="form-control js-example-basic-single " name="status" id="status" required>
                                                        <option value="">Select Status</option>
                                                        <option value="Active" @if ($employee->status == "Active") selected @endif>Active</option>
                                                        <option value="Retirement" @if ($employee->status == "Retirement") selected @endif>Retirement</option>
                                                        <option value="VRS" @if ($employee->status == "VRS") selected @endif>VRS</option>
                                                        <option value="Death" @if ($employee->status == "Death") selected @endif>Death</option>
                                                        <option value="Resigned" @if ($employee->status == "Resigned") selected @endif>Resigned</option>
                                                        <option value="Terminated" @if ($employee->status == "Terminated") selected @endif>Terminated</option>
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
</script>
@stop
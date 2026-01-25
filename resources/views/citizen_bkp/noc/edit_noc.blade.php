@extends('layouts.citizen.template_noc')
@section('content')
<div class="row">
    <div class="card custom-card" id="navigation" style="margin-top: 25px;">
        <div class="card-body">
            <div class="row">
                <div class="col-xl-3">
                    <nav class="nav nav-tabs flex-column nav-style-5" role="tablist">
                        <a class="nav-link" href="{{route('citizen.account')}}">
                            Dashboard
                        </a>
                        <a class="nav-link" href="{{route('noc')}}">
                            All NOC
                        </a>
                        <a class="nav-link show active" data-bs-toggle="tab" role="tab" aria-current="page" href="#building" aria-selected="true">Building Address</a>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#proprietary" aria-selected="false" tabindex="-1">Proprietary Details</a>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#area" aria-selected="true">Area and Set Back Details</a>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#essential" aria-selected="false" tabindex="-1">Essential Provision Detail</a>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#attachments" aria-selected="true">Attachments </a>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#final" aria-selected="false" tabindex="-1">Final Update Submit</a>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-current="page" href="#apply" aria-selected="false" tabindex="-1">Apply for Pre Operational NOC</a>
                    </nav>
                </div>
                <div class="col-xl-9">
                    <div class="tab-content">
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
                        <div class="tab-pane show active text-muted" id="building" role="tabpanel">
                            <h5>Building Address</h5>
                            <br>
                            <form action="" method="POST">
                                <h6><b>Basic Detail:</b></h6>

                                <div class="row">
                                    <div class="col-md-4 me2">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Building Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="building_name" name="building_name" value="{{ $applicationDetail[0]->building_name ?? ''}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-right: 0;">
                                        <div class="form-group">
                                            <label class="form-control-label">Building Ownership <span class="text-danger">*</label>
                                            <br>
                                            <input type="radio" @if($applicationDetail[0]->building_ownership == 'owned') checked @endif id="owned" name="building_ownership" value="owned" > Owned
                                            <input type="radio" @if($applicationDetail[0]->building_ownership == 'occupied') checked @endif id="occupied" name="building_ownership" value="occupied"> Occupied
                                        </div>
                                    </div>
                                    <div class="col-md-4" style="padding-right: 0;">
                                        <div class="form-group">
                                            <label class="form-control-label">GST/PAN/TAN</label>
                                            <br>
                                            <input type="radio" @if($applicationDetail[0]->gst_pan_tan == 'gst') checked @endif id="gst" name="gst_pan_tan" value="gst" >GST
                                            <input type="radio" @if($applicationDetail[0]->gst_pan_tan == 'pan') checked @endif id="pan" name="gst_pan_tan" value="pan">PAN
                                            <input type="radio" @if($applicationDetail[0]->gst_pan_tan == 'tan') checked @endif id="tan" name="gst_pan_tan" value="tan"> TAN
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">GST/PAN/TAN No.</label>
                                            <input type="text" class="form-control" id="gst_pan_tan_no" name="gst_pan_tan_no" placeholder="GST/PAN/TAN No." value="{{ $applicationDetail[0]->gst_pan_tan_no ?? ''}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Category Of Project परियोजना का वर्गीकरण<span class="span_required">*</span></label>
                                            <select class="form-control" name="project_id" id="project_id" required>
                                                <option value="" disabled selected>Select Project</option>
                                                @foreach($projects as $key => $pt)
                                                    <option value="{{ $pt->name }}" @if ($pt->name == $applicationDetail[0]->project) selected @endif>{{ ucfirst($pt->name) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Category Building<span class="text-danger">*</label>
                                            <select class="form-control" name="category_id" id="category_id" required>
                                                <option value="" disabled selected>Select Category</option>
                                                @foreach($categories as $key => $ct)
                                                    <option value="{{ $ct->id }}" @if ($ct->id == $applicationDetail[0]->category_id) selected @endif>{{ ucfirst($ct->name) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Sub Category Building<span class="text-danger">*</label>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id" required onclick="chooseSubCategory();">
                                                <option value="" disabled selected>Select Sub Category</option>
                                                @foreach($sub_categories as $key => $sct)
                                                    <option value="{{ $sct->id }}" @if ($sct->id == $applicationDetail[0]->subcategory_id) selected @endif>{{ ucfirst($sct->name) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Type Of Industry <span class="text-danger">*</label>
                                            <select class="form-control" name="type_id" id="type_id" onclick="chooseType();">
                                                <option value="" disabled selected>Select Type</option>
                                                @foreach($types as $key => $typ)
                                                    <option value="{{ $typ->id }}" @if ($typ->id == $applicationDetail[0]->type_id) selected @endif>{{ ucfirst($typ->name) }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Project Status<span class="text-danger">*</label>
                                            <select class="form-control" name="project_status" id="project_status" required>
                                                <option  value="" disabled selected>Select Project Status</option>
                                                <option @if($applicationDetail[0]->project_status == 'New') selected @endif value="New">New</option>
                                                <option @if($applicationDetail[0]->project_status == 'Extension') selected @endif value="Extension">Extension</option>
                                                <option @if($applicationDetail[0]->project_status == 'Diversification') selected @endif value="Diversification">Diversification</option>
                                                <option @if($applicationDetail[0]->project_status == 'Compounding') selected @endif value="Compounding">Compounding</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_heading" style="display:block;">
                                        <h3 style="padding:5px">Occupency Detail</h3>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div1" style="display:block;">
                                        <div class="form-group">
                                            <label class="form-label">Number of Rooms </label>
                                            <input type="number" class="form-control" id="no_of_rooms" name="no_of_rooms" placeholder="Number of Rooms" value="{{ $applicationDetail[0]->no_of_rooms ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div2" style="display:block;">
                                        <div class="form-group">
                                            <label class="form-label">Number of Flats </label>
                                            <input type="number" class="form-control" id="no_of_flats" name="no_of_flats" placeholder="Number of Flats" value="{{ $applicationDetail[0]->no_of_flats ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div3" style="display:block;">
                                        <div class="form-group">
                                            <label class="form-label">Number of Beds </label>
                                            <input type="number" class="form-control" id="no_of_beds" name="no_of_beds" placeholder="Number of Beds" value="{{ $applicationDetail[0]->no_of_beds ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div4" style="display:block;">
                                        <div class="form-group">
                                            <label class="form-control-label">For Educationals<span class="text-danger">*</label>
                                            <select class="form-control" name="for_educational" id="for_educational">
                                                <option value="" disabled selected>Select For Educational</option>
                                                <option value="kindergarten">Kindergarten</option>
                                                <option value="senior">Senior</option>
                                                <option value="secondary">Secondary</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div5" style="display:block;">
                                        <div class="form-group">
                                            <label class="form-label">Seating Capacity</label>
                                            <input type="number" class="form-control" id="seating_capacity" name="seating_capacity" placeholder="Seating Capacity" value="{{ $applicationDetail[0]->seating_capacity ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div6" style="display:block;">
                                        <div class="form-group">
                                            <label class="form-label">Number of Employee</label>
                                            <input type="number" class="form-control" id="no_of_employee" name="no_of_employee" placeholder="Number of Employee" value="{{ $applicationDetail[0]->no_of_employee ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div7" style="padding-right:0;display:block;">
                                        <div class="form-group">
                                            <label class="form-control-label">Is any hazardous material used<span class="text-danger">*</label>
                                            <br>
                                            <input type="radio" id="yes" name="is_hazardous_material" value="yes"> Yes
                                            <input type="radio" id="no" name="is_hazardous_material" value="no"> No
                                        </div>
                                    </div>
                                    <div class="col-md-4 occupency_div" id="occupency_div8" style="display:block;">
                                        <div class="form-group">
                                            <label class="form-label">Details of Hazardous Materials</label>
                                            <input type="text" class="form-control" id="hazardous_material" name="hazardous_material" placeholder="Details of Hazardous Materials" value="{{ $applicationDetail[0]->hazardous_material ?? ''}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-group">
                                            <label class="form-label">Latitude</label>
                                            <input type="number" class="form-control" id="latitude" name="latitude" placeholder="Latitude" value="{{ $applicationDetail[0]->latitude ?? ''}}" step="any" pattern="^\d*(\.\d{0,4})?$">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Longitude</label>
                                            <input type="number" class="form-control" id="longitude" name="longitude" placeholder="Longitude" value="{{ $applicationDetail[0]->longitude ?? ''}}" step="any" pattern="^\d*(\.\d{0,4})?$">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Email <span class="text-danger">*</label>
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $applicationDetail[0]->email ?? ''}}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Mobile No. <span class="text-danger">*</label>
                                            <input type="number" class="form-control" id="mobile_no" name="mobile_no" placeholder="Mobile No." value="{{ $applicationDetail[0]->mobile_no ?? ''}}" required maxlength="10" minlength="10">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Other Telephone</label>
                                            <input type="number" class="form-control" id="office_telephone" name="office_telephone" placeholder="Other Telephone No." value="{{ $applicationDetail[0]->office_telephone ?? ''}}" maxlength="10" minlength="10">
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <h6>Building Address</h6>
                                <br>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">District<span class="text-danger">*</span></label>
                                            <select class="form-control" name="district_id" id="district_id" required>
                                                @foreach ($district as $dist)
                                                    @if(Auth::user()->district_id ==$dist->id)
                                                        <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-control-label" for="input-username">Urban / Rural <span class="text-danger">*</span></label>
                                            <div class="radio-toolbar">
                                                <input type="radio" id="urban" name="rural_urban" value="urban" onclick="chooseRularUrban(this);" @if($applicationDetail[0]->rural_urban == 'urban') checked @endif>
                                                <label for="urban">Urban</label>
                                                <input type="radio" id="rular" name="rural_urban" value="rural" onclick="chooseRularUrban(this);" @if($applicationDetail[0]->rural_urban == 'rural') checked @endif>
                                                <label for="rular">Rular</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="urban_div" style="display:block;">
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Tehsil <span class="text-danger">*</span></label>
                                                <select class="form-control" name="tehsil_id" id="tehsil_id" required>
                                                <option value="" selected>Select Tehsil</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-sm-10 col-xs-12" style="padding-right:0px;">
                                            <div class="form-group">
                                                <label class="form-control-label">Choose Plot/ Khasra/ Khatoni <span class="text-danger">*</span></label>
                                                <div class="radio-toolbar">
                                                <input type="radio" id="plot" name="plot_khasra_khatauni" value="plot">
                                                <label for="plot">Plot No.</label>
                                                <input type="radio" id="khasra" name="plot_khasra_khatauni" value="khasra">
                                                <label for="khasra">Khasra No.</label>
                                                <input type="radio" id="khatoni" name="plot_khasra_khatauni" value="khatoni">
                                                <label for="khatoni">Khatoni No.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Plot/Khasra/Khatoni No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="plot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="{{ $applicationDetail[0]->plot_khasra_khatauni_no ?? ''}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Street <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="street" name="street" placeholder="Street" value="{{ $applicationDetail[0]->street ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Landmark <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" value="{{ $applicationDetail[0]->landmark ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">City <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ $applicationDetail[0]->city ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{ $applicationDetail[0]->pincode ?? ''}}" maxlength="6" minlength="6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="rular_div" style="display:block;">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Block <span class="text-danger">*</span></label>
                                                <select class="form-control" name="block_id" id="block_id" required>
                                                <option value="" disabled selected>Select Block</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-control-label">Panchayat<span class="text-danger">*</span></label>
                                                <select class="form-control" name="panchayat_id" id="panchayat_id" required>
                                                <option value="" disabled selected>Select Panchayat</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Village<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="village" name="village" placeholder="Village" value="{{ $applicationDetail[0]->village ?? ''}}" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-sm-10 col-xs-12" style="padding-right:0px">
                                            <div class="form-group">
                                                <label class="form-control-label">Choose Plot/Khasra/Khatoni <span class="text-danger">*</span></label>
                                                <div class="radio-toolbar">
                                                <input type="radio" id="plot1" name="plot_khasra_khatauni" value="plot">
                                                <label for="plot1">Plot No.</label>
                                                <input type="radio" id="khasra1" name="plot_khasra_khatauni" value="khasra">
                                                <label for="khasra1">Khasra No.</label>
                                                <input type="radio" id="khatoni1" name="plot_khasra_khatauni" value="khatoni">
                                                <label for="khatoni1">Khatoni No.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-sm-6 col-xs-12" style="padding-left:0px">
                                            <div class="form-group">
                                                <label class="form-label">Plot/Khasra/Khatoni No. <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="plot_khasra_khatauni_no" name="plot_khasra_khatauni_no" placeholder="Plot/Khasra/Khatoni No." value="{{ $applicationDetail[0]->plot_khasra_khatauni_no ?? ''}}" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Landmark <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="landmark" name="landmark" placeholder="Landmark" value="{{ $applicationDetail[0]->landmark ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <div class="form-group">
                                                <label class="form-label">Pincode <span class="text-danger">*</span></label>
                                                <input type="number" class="form-control" id="pincode" name="pincode" placeholder="Pincode" value="{{ $applicationDetail[0]->pincode ?? ''}}" maxlength="6" minlength="6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 me2">
                                    <button type="submit" id="addOrganisational" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
                                </div>
                        </div>
                        </form>
                    </div>

                    <div class="tab-pane text-muted" id="proprietary" role="tabpanel"></div>

                    <div class="tab-pane text-muted" id="area" role="tabpanel"></div>

                    <div class="tab-pane text-muted" id="essential" role="tabpanel"></div>

                    <div class="tab-pane text-muted" id="attachments" role="tabpanel"></div>

                    <div class="tab-pane text-muted" id="final" role="tabpanel"></div>

                    <div class="tab-pane text-muted" id="apply" role="tabpanel"></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    window.onload = function() {
        const checkedRadio = document.querySelector('input[name="rural_urban"]:checked');
        if (checkedRadio.value == 'urban') 
        {
            document.getElementById('urban_div').style.display = "block";
            document.getElementById('rular_div').style.display = "none";
        }
        else if(checkedRadio.value == 'rural')
        {
            document.getElementById('urban_div').style.display = "none";
            document.getElementById('rular_div').style.display = "block";
        }
    };
</script>

@stop
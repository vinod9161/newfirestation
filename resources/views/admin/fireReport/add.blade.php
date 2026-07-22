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
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Fire Reports</h5>
    </div>
</div>
<!-- End Row -->

<!-- Start::row-2 -->
<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add New Fire Report
                </div>
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
                <form method="post" enctype="multipart/form-data" action="{{route('admin.saveFireReport')}}">
                    @csrf
                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Fire Report - General Details</div>
                        <p class="text-danger" style="margin-left: 10px;">Fields with * are required.</p>
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Annual Number वार्षिक संख्या<sup class="text-danger">*</sup></label>
                                    <input class="form-control" size="60" maxlength="255" name="fire_report_no" id="fire_report_no" type="number" placeholder="Report Number">
                                    <span class="error" id="error1"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Monthly Number मासिक संख्या <sup class="text-danger">*</sup></label>           
                                    <input class="form-control" size="60" maxlength="255" name="monthly_no" id="monthly_no" type="number" placeholder="Monthly Number">   
                                    <span class="error" id="error2"></span>    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Type Of Fire <sup class="text-danger">*</sup></label>          
                                    <select class="form-control js-example-basic-single" name="category" id="category">
                                        <option value="">--Select Type Of Fire--</option>
                                        <option value="1">Small Fire लघु अग्निकाण्ड </option>
                                        <option value="2">Medium Fire मध्यम अग्निकाण्ड</option>
                                        <option value="3">Major/special Fire भीषण अग्निकाण्ड</option>
                                        <option value="4">Serious Fire गम्भीर अग्निकाण्ड</option>
                                    </select>
                                    <span class="error" id="error3"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    
                                    <label>District जपपद <sup class="text-danger">*</sup></label>           
                                    <select class="form-control js-example-basic-single" name="district_id" id="district_id">

                                        @foreach($districts as $index => $dist)
                                            <option 
                                                value="{{ $dist->id }}" 
                                                {{ Auth::user()->district_id == $dist->id ? 'selected' : 'disabled' }}>
                                                {{ ucfirst($dist->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    
                                    
                                    <span class="error" id="error4"></span>  
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fire Station फायर स्टेशन <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="station_id" id="station_id">
                                        @foreach($stations as $index => $stn)
                                        <option {{ Auth::user()->station_id == $stn->id ? 'selected' : 'disabled' }} value="{{ $stn->id }}">{{ ucfirst($stn->name) }}</option>
                                        @endforeach
                                    </select>       
                                    <span class="error" id="error5"></span>    
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date and Time of Fire Incident अग्निकाण्ड का दिनांक एवं समय <sip class="text-danger">*</sup></label>          
                                    <input class="form-control" type="datetime-local" id="fire_incident_datetime" name="fire_incident_datetime" value="" max="">
                                    <span class="error" id="error6"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Information Details सूचना का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name of Informer सूचना देने वाले का नाम<sup class="text-danger">*</sup></label>            
                                    <input class="form-control" size="60" maxlength="225" name="informer_name" id="informer_name" type="text" placeholder="Name of Informer">    
                                    <span class="error" id="error7"></span>                     
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Contact Number of Informer सूचना देने वाले का सम्पर्क नम्बर <sup class="text-danger">*</sup></label> 
                                    <input class="form-control" size="60" maxlength="255" name="informer_contact_no" id="informer_contact_no" type="number" placeholder="Contact Number of Informer"> 
                                    <span class="error" id="error8"></span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Medium of Information सूचना प्राप्ति का माधयम <sup class="text-danger">*</sup></label>            
                                    <input class="form-control" size="60" maxlength="255" name="info_medium" id="info_medium" type="text" placeholder="Medium of Information">
                                    <span class="error" id="error9"></span>                          
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Address of Incident Place घटनास्थल का पता <sup class="text-danger">*</sup></label>            
                                    <input class="form-control" maxlength="512" name="incident_address" id="incident_address"> 
                                    <span class="error" id="error10"></span>                         
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Date and Time of Information सूचना प्राप्ति का दिनांक एवं समय <sup class="text-danger">*</sup></label>
                                    <input class="form-control" type="datetime-local" id="info_datetime" name="info_datetime" value="" max="">
                                    <span class="error" id="error11"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Longitude <sup class="text-danger">*</sup></label>            
                                    <input type="text" class="form-control" name="incident_longitude" id="incident_longitude">           
                                    <span class="error" id="error12"></span>               
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Latitude <sup class="text-danger">*</sup></label>            
                                    <input type="text" class="form-control" name="incident_latitude" id="incident_latitude">     
                                    <span class="error" id="error13"></span>                     
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Action Details कार्यवाही का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Departure Time from Fire Station फायर स्टेशन से प्रस्थान का समय <sup class="text-dnager">*</sup></label>          
                                    <input class="form-control" type="datetime-local" id="station_depart_datetime" name="station_depart_datetime" value="" max="">
                                    <span class="error" id="error14"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Arrival Time on Incident Place घटनास्थल पर पहुँचने का समय <sup class="text-dnager">*</sup></label>          
                                    <input class="form-control" type="datetime-local" id="fire_site_arrive_datetime" name="fire_site_arrive_datetime" value="" max="">
                                    <span class="error" id="error15"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Return Time to Fire Station फायर स्टेशन पर वापसी का समय <sup class="text-dnager">*</sup></label>            
                                    <input class="form-control" type="datetime-local" id="station_return_datetime" name="station_return_datetime" value="" max="">
                                    <span class="error" id="error16"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Distance of Incident Place from Fire Station फायर स्टेशन से घटनास्थल की दूरी (in KM eg. 10.255) <sup class="text-danger">*</sup></label>
                                    <input class="form-control" name="distance" id="distance" type="number" step="any" pattern="^\d*(\.\d{0,3})?$">
                                    <span class="error" id="error17"></span> 
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Fire Fighting Machine used अग्निशमन कार्य हेतु प्रयुक्त मशीनों का विवरण</div>

                        <div class="row" id="dynamicFields" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-5">
                                <div class="form-group">
                                <label>Details of Fire Fighting Machine used अग्निशमन कार्य हेतु प्रयुक्त मशीनों का विवरण <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single" name="vehicle_id[]" id="vehicle_id" >
                                        
                                    @foreach($vehicles as $index => $veh)
                                    <option value="{{ $veh['id'] }}">{{ ucfirst($veh['reg_number']) }}, {{ ucfirst($veh['vehicle_type']) }}</option>
                                    @endforeach
                                    </select>
                                    <span class="error" id="error18"></span>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Pumping in KM <sup class="text-danger">*</sup></label>            
                                    <input class="form-control" size="60" maxlength="255" name="pumping_km[]" id="pumping_km" type="number" placeholder="Pumping in KM"> 
                                    <span class="error" id="error19"></span>                         
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a class="btn btn-primary add_field_button" id="add_field_button" style="margin-top:27px;"> + Add More Fields</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details of Equipment used -->
                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Equipment Used</div>
                        <div class="row" id="equipmentDynamicFields" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Equipment <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single equipment_select" name="equipment_id[]">
                                        <option value="">-- Select Equipment --</option>
                                        @foreach($equipments as $equip)
                                            <option value="{{ $equip->category_id }}">{{ $equip->equipment_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Usage (Hours) <sup class="text-danger">*</sup></label>
                                    <input class="form-control" name="equipment_usage[]" type="number" step="0.01" placeholder="Hours used">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <a class="btn btn-primary add_equipment_field" id="add_equipment_field" style="margin-top:27px;"> + Add More</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Details of Foam Used -->
                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Foam Used</div>
                        <div class="row" id="foamDynamicFields" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Foam Type <sup class="text-danger">*</sup></label>
                                    <select class="form-control js-example-basic-single foam_select" name="foam_id[]">
                                        <option value="">-- Select Foam --</option>
                                        <option value="1">Foam</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label>Quantity (in Rate per KG/Ltr) <sup class="text-danger">*</sup></label>
                                    <input class="form-control" name="foam_quantity[]" type="number" step="0.01" placeholder="Quantity used">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Details of Fire Service Personals on Incident Place घटनास्थल पर फायर सर्विस कार्मिकों का विवरण</div>
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>CFO</label> 
                                    <select class="form-control js-example-basic-multiple" name="cfo[]" id="cfo" multiple="multiple">
                                        @foreach($cfo as $index => $cf)
                                        <option value="{{ $cf->name }}">{{ ucfirst($cf->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>FSO</label> 
                                    <select class="form-control js-example-basic-multiple" name="fso[]" id="fso" multiple="multiple">
                                        @foreach($fso as $index => $fs)
                                        <option value="{{ $fs->name }}">{{ ucfirst($fs->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>FSSO</label> 
                                <select class="form-control js-example-basic-multiple" name="fsso[]" id="fsso" multiple="multiple">
                                    @foreach($fsso as $index => $fss)
                                    <option value="{{ $fss->name }}">{{ ucfirst($fss->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>LFM</label> 
                                <select class="form-control js-example-basic-multiple" name="lfm[]" id="lfm" multiple="multiple">
                                    @foreach($lfm as $index => $lm)
                                    <option value="{{ $lm->name }}">{{ ucfirst($lm->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>DVR</label> 
                                <select class="form-control js-example-basic-multiple" name="dvr[]" id="dvr" multiple="multiple">
                                    @foreach($dvr as $index => $dv)
                                    <option value="{{ $dv->name }}">{{ ucfirst($dv->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>FM</label> 
                                <select class="form-control js-example-basic-multiple" name="fm[]" id="fm" multiple="multiple">
                                    @foreach($fm as $index => $f)
                                    <option value="{{ $f->name }}">{{ ucfirst($f->name) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        </div>
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Fire Details अग्निकाण्ड का विवरण</div>

                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                            <div class="form-group">
                                <label>Class of Fire अग्निकाण्ड का वर्ग <sup class="text-danger">*</sup></label>            
                                <select class="form-control js-example-basic-single" name="fire_class" id="fire_class">
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                    <option value="D">D</option>
                                </select>
                                <span class="error" id="error20"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Area of Fire अग्निकाण्ड का क्षेत्र <sup class="text-danger">*</sup></label>           
                                <select class="form-control js-example-basic-single" name="fire_area" id="fire_area">
                                    <option value="1">Rural ग्रामीण</option>
                                    <option value="2">City शहरी</option>
                                </select>
                                <span class="error" id="error21"></span>
                            </div>
                        </div>
                    
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Type of Fire Area अग्निकाण्ड क्षेत्र का प्रकार <sup class="text-danger">*</sup></label>          
                                <select class="form-control js-example-basic-single" name="fire_area_type" id="fire_area_type">
                                    <option value="1">Commercial</option>
                                    <option value="2">Residential</option>
                                    <option value="3">High Rise</option>
                                    <option value="4">Forest</option>
                                    <option value="5">Farm</option>
                                    <option value="6">Industry</option>
                                    <option value="7">Vehicle</option>
                                    <option value="8">Other</option>
                                </select>
                                <span class="error" id="error22"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Insured बीमित: Yes हाँ or No नहीं <sup class="text-danger">*</sup></label>          
                                <select class="form-control js-example-basic-single" name="insured" id="insured">
                                    <option value="0">Not known</option>
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>
                                <span class="error" id="error23"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Was it Arson Based? क्या आग जान-बूझकर लगायी गई? <sup class="text-danger">*</sup></label>           
                                <select class="form-control js-example-basic-single" name="arson_based" id="arson_based">
                                    <option value="0">Not known</option>
                                    <option value="1">No</option>
                                    <option value="2">Yes</option>
                                </select>
                                <span class="error" id="error24"></span>
                            </div>
                        </div>
                        </div>
                        
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>मुख्य कैटेगरी (Category) <sup class="text-danger">*</sup></label>
                                    <select id="fire_cause_category" name="fire_category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="error" id="error_fire_category"></span>

                                </div>
                                
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>सब-कैटेगरी (Subcategory) <sup class="text-danger">*</sup></label>
                                    <select id="fire_cause_subcategory" name="fire_subcategory_id" class="form-control" required>
                                        <option value="">-- Select Subcategory --</option>
                                    </select>
                                    <span class="error" id="error_fire_subcategory"></span>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Details विवरण <sup class="text-danger">*</sup></label>          
                                    <input class="form-control" maxlength="1000" name="fire_reason" id="fire_reason">
                                    <span class="error" id="error25"></span>
                                </div>
                            </div>
                        </div>
                        <script>
                            let subcategories = @json($subcategories);

                            document.getElementById('fire_cause_category').addEventListener('change', function() {
                                let categoryId = this.value;
                                let subSelect = document.getElementById('fire_cause_subcategory');

                                subSelect.innerHTML = '<option value="">-- Select Subcategory --</option>';

                                if (!categoryId) return;

                                let filtered = subcategories.filter(sc => sc.category_id == categoryId);

                                filtered.forEach(sc => {
                                    subSelect.innerHTML += `<option value="${sc.id}">${sc.name}</option>`;
                                });
                            });
                        </script>


                        
                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Loss Details / क्षति विवरण</div>
                        
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Property Lost क्षति सम्पत्ति (in INR)</label>           
                                    <input class="form-control" type="number" size="60" maxlength="255" name="property_lost" id="property_lost"></input>                         
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Property Saved बचायी गई सम्पत्ति (in INR)</label>        
                                    <input class="form-control" type="number" size="60" maxlength="255" name="property_saved" id="property_saved"></input> 
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Life Lost Human मनुष्य मरे</label>          
                                    <input class="form-control" size="60" maxlength="255" name="life_lost_human" id="life_lost_human" type="number" placeholder="Life Lost Human" />                           
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Life Saved Human मनुष्य बचाये</label>           
                                    <input class="form-control" size="60" maxlength="255" name="life_saved_human" id="life_saved_human" type="number" placeholder="Life Saved Human" />                         
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Life Lost Animal पशु मरे</label>           
                                    <input class="form-control" size="60" maxlength="255" name="life_lost_animal" id="life_lost_animal" type="number" placeholder="Life Lost Animal" />                         
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Life Saved Animal पशु बचाये</label>            
                                    <input class="form-control" size="60" maxlength="255" name="life_saved_animal" id="life_saved_animal" type="number" placeholder="Life Saved Animal" />                          
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Description विवरण</div>
                        
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Description विवरण <sup class="text-danger">*</sup></label>
                                <textarea class="form-control" maxlength="1000" name="short_description" id="short_description" style="height:50px;"></textarea>              
                                <span class="error" id="error26"></span>            
                            </div>
                        </div>
                        </div>

                    </div>


                    <div class="divborder">
                        <div class="col-md-12 alert alert-dark text-center card-title">Upload Report</div>
                        
                        <div class="row" style="padding-left: 10px;padding-right: 10px;">
                            <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <label>Upload New File </label>
                                <input id="ytupload" type="hidden" value="" name="upload" />
                                <input class="form-control" name="upload_file" id="upload_file" type="file">     
                            </div>
                        </div>
                        </div>

                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12" align="center">
                            <button type="submit" id="submitButton" class="btn btn-primary w-30" style="width:30%">Create Report</button>
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
    // Equipment dynamic rows
    $(document).ready(function(){
        var eqIndex = 1;
        $('#add_equipment_field').click(function(e){
            e.preventDefault();
            eqIndex++;
            $('#equipmentDynamicFields').append(`
                <div class="row" id="eqrow${eqIndex}" style="padding-left: 10px; padding-right: 10px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Equipment <sup class="text-danger">*</sup></label>
                            <select class="form-control js-example-basic-single equipment_select" name="equipment_id[]">
                                <option value="">-- Select Equipment --</option>
                                @foreach($equipments as $equip)
                                    <option value="{{ $equip->category_id }}">{{ $equip->equipment_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Usage (Hours) <sup class="text-danger">*</sup></label>
                            <input class="form-control" name="equipment_usage[]" type="number" step="0.01" placeholder="Hours used">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <a class="btn btn-danger remove_equipment_row" data-row="eqrow${eqIndex}" style="margin-top:27px;"> - Remove</a>
                        </div>
                    </div>
                </div>
            `);
            $('.js-example-basic-single').select2();
        });

        $(document).on('click', '.remove_equipment_row', function(e){
            e.preventDefault();
            var rowId = $(this).data('row');
            $('#' + rowId).remove();
        });
    });


    $(document).ready(function(){  
        
        var i = 1; 

        $('#add_field_button').click(function(e){  
            e.preventDefault();
            i++;
            $('#dynamicFields').append(`
                <div class="row" id="row${i}" style="padding-left: 10px; padding-right: 10px;">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Details of Fire Fighting Machine used अग्निशमन कार्य हेतु प्रयुक्त मशीनों का विवरण
                                <sup class="text-danger">*</sup>
                            </label>
                            <select class="form-control js-example-basic-single" name="vehicle_id[]">
                                @foreach($vehicles as $index => $veh)
                                <option value="{{ $veh['id'] }}">{{ ucfirst($veh['reg_number']) }}, {{ ucfirst($veh['vehicle_type']) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Pumping in KM<sup class="text-danger">*</sup></label>
                            <input class="form-control" size="60" maxlength="255" name="pumping_km[]" type="number" placeholder="Pumping in KM">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <a class="btn btn-danger btn_remove" id="${i}" style="margin-top:27px;"> - Remove Fields</a>
                        </div>
                    </div>
                </div>
            `);
            $('.js-example-basic-single').select2();
        });

        
        $(document).on('click', '.btn_remove', function(e){  
            e.preventDefault();
            var button_id = $(this).attr("id"); 
            $('#row' + button_id).remove();
        });   

        $('.js-example-basic-multiple').select2();
    });
  
 </script>
<script>
    $(document).ready(function() {
        $(document).on('click', '#submitButton', function(event) {
            const _token = $('input[name="_token"]').val();
            const fire_report_no = $('#fire_report_no').val();
            const monthly_no = $('#monthly_no').val();
            const category = $('#category').val();
            const district_id = $('#district_id').val();
            const station_id = $('#station_id').val();
            const fire_incident_datetime = $('#fire_incident_datetime').val();
            const informer_name = $('#informer_name').val();
            const informer_contact_no = $('#informer_contact_no').val();
            const info_medium = $('#info_medium').val();
            const incident_address = $('#incident_address').val();
            const info_datetime = $('#info_datetime').val();
            const station_depart_datetime = $('#station_depart_datetime').val();
            const fire_site_arrive_datetime = $('#fire_site_arrive_datetime').val();
            const station_return_datetime = $('#station_return_datetime').val();
            const distance = $('#distance').val();
            const vehicle_id = $('#vehicle_id').val();
            const pumping_km = $('#pumping_km').val();
            const cfo = $('#cfo').val();
            const fso = $('#fso').val();
            const fsso = $('#fsso').val();
            const lfm = $('#lfm').val();
            const dvr = $('#dvr').val();
            const fm = $('#fm').val();
            const fire_class = $('#fire_class').val();
            const fire_area = $('#fire_area').val();
            const fire_area_type = $('#fire_area_type').val();
            const insured = $('#insured').val();
            const arson_based = $('#arson_based').val();
            const fire_reason = $('#fire_reason').val();
            const property_lost = $('#property_lost').val();
            const property_saved = $('#property_saved').val();
            const life_lost_human = $('#life_lost_human').val();
            const life_saved_human = $('#life_saved_human').val();
            const life_lost_animal = $('#life_lost_animal').val();
            const life_saved_animal = $('#life_saved_animal').val();
            const short_description = $('#short_description').val();
            const incident_longitude = $('#incident_longitude').val();
            const incident_latitude = $('#incident_latitude').val();
            const upload_file = $('#upload_file')[0].files[0];
            const fire_category_id = $('#fire_cause_category').val();
            const fire_subcategory_id = $('#fire_cause_subcategory').val();


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
                { field: fire_report_no, errorId: 'error1' },
                { field: monthly_no, errorId: 'error2' },
                { field: category, errorId: 'error3' },
                { field: district_id, errorId: 'error4' },
                { field: station_id, errorId: 'error5' },
                { field: fire_incident_datetime, errorId: 'error6' },
                { field: informer_name, errorId: 'error7' },
                { field: informer_contact_no, errorId: 'error8' },
                { field: info_medium, errorId: 'error9' },
                { field: incident_address, errorId: 'error10' },
                { field: info_datetime, errorId: 'error11' },
                { field: incident_longitude, errorId: 'error12' },
                { field: incident_latitude, errorId: 'error13' },
                { field: station_depart_datetime, errorId: 'error14' },
                { field: fire_site_arrive_datetime, errorId: 'error15' },
                { field: station_return_datetime, errorId: 'error16' },
                { field: distance, errorId: 'error17' },
                { field: vehicle_id, errorId: 'error18' },
                { field: pumping_km, errorId: 'error19' },
                { field: fire_class, errorId: 'error20' },
                { field: fire_area, errorId: 'error21' },
                { field: fire_area_type, errorId: 'error22' },
                { field: insured, errorId: 'error23' },
                { field: arson_based, errorId: 'error24' },
                { field: fire_reason, errorId: 'error25' },
                { field: short_description, errorId: 'error26' },
                { field: fire_category_id, errorId: 'error_fire_category' },
                { field: fire_subcategory_id, errorId: 'error_fire_subcategory' },

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
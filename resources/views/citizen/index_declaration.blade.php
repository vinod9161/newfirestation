@extends('layouts.citizen.template')
@section('title')
<title>Declaration | Citizen Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
<style>
   .span_required {
      color: #ff0000;
   }

   .error {
      color: red;
   }
</style>
@endsection
@section('content')
<!-- Start::row-1 -->
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
   <div>
      <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0 mt-10">NOC Declaration</h5>
   </div>
</div>
<!-- End Row -->
<div class="row">
   <div class="card custom-card">
      <div class="card-header">
         <h4 class="card-title">Declaration</h4>
      </div>
      <div class="card-body">
         <div class="row">
            <div class="col-md-12">
               <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item" role="presentation">
                     <a class="nav-link active buildingstatus" data-bs-toggle="tab" href="#Building_Status" aria-selected="true" role="tab">Building Status</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link Fire_Fighting_Provision" data-bs-toggle="tab" href="#Fire_Fighting_Provision" aria-selected="false" role="tab" tabindex="-1">Fire Fighting Provision</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link Special_Provision" data-bs-toggle="tab" href="#Special_Provision" aria-selected="false" role="tab" tabindex="-1">Special Provision</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link Declaration_Submit" data-bs-toggle="tab" href="#Declaration_Submit" aria-selected="false" role="tab" tabindex="-1">Declaration Submit</a>
                  </li>
                  <li class="nav-item" role="presentation">
                     <a class="nav-link" href="{{route('citizen.declarationList')}}" aria-selected="false">Declaration List</a>
                  </li>
               </ul>
               <div id="myTabContent" class="tab-content">
                  <div class="alert alert-success" id="successBlock" style="display:none;"></div>
                  <div class="alert alert-danger" id="errorBlock" style="display:none;"></div>
                  <div class="tab-pane fade active show" id="Building_Status" role="tabpanel">
                     <input type="hidden" id="declaration_id" value="{{ isset($declaration[0]) ? $declaration[0]->id : '' }}">
                     <form method="POST" enctype="multipart/form-data" id="form_building">
                        @csrf
                        <input type="hidden" name="inspection_step" value="3">
                        <div class="row">
                           <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Set Back <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status))
                                 <input type="text" class="form-control" id="set_back" name="set_back" placeholder="Set Back" value="{{ json_decode($declaration[0]->building_status)->set_back ?? ''}}" required rows="3">
                                 @else
                                 <input type="text" class="form-control" id="set_back" name="set_back" placeholder="Set Back" value="" required rows="3">
                                 @endif
                                 <span class="error" id="error1"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Compartmentation <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->compartmentation))
                                 @php
                                 $compartmentation = json_decode($declaration[0]->building_status)->compartmentation;
                                 @endphp
                                 @else
                                 @php $compartmentation = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="compartmentation" id="compartmentation" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($compartmentation == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($compartmentation == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error2"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Minimum Width of Stairs <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status))
                                 <input type="number" class="form-control" id="stair_width" name="stair_width" placeholder="Minimum Width of Stairs" value="{{ json_decode($declaration[0]->building_status)->stair_width ?? ''}}" required step="any" pattern="^\d*(\.\d{0,2})?$">
                                 @else
                                 <input type="number" class="form-control" id="stair_width" name="stair_width" placeholder="Minimum Width of Stairs" value="" required step="any" pattern="^\d*(\.\d{0,2})?$">
                                 @endif
                                 <span class="error" id="error3"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Fire Hose Cabin <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->fire_cabin))
                                 @php
                                 $fire_cabin = json_decode($declaration[0]->building_status)->fire_cabin;
                                 @endphp
                                 @else
                                 @php $fire_cabin = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fire_cabin" id="fire_cabin" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fire_cabin == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($fire_cabin == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error4"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">No. of Stairs in Each Block <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status))
                                 <input type="number" class="form-control" id="stair_in_block" name="stair_in_block" placeholder="No. of Stairs in Each Block" value="{{ json_decode($declaration[0]->building_status)->stair_in_block ?? ''}}" required rows="3">
                                 @else
                                 <input type="number" class="form-control" id="stair_in_block" name="stair_in_block" placeholder="No. of Stairs in Each Block" value="" required rows="3">
                                 @endif
                                 <span class="error" id="error5"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Emergency Exit <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status))
                                 <input type="number" class="form-control" id="emergency_exit" name="emergency_exit" placeholder="Emergency Exit" value="{{ json_decode($declaration[0]->building_status)->emergency_exit ?? ''}}" required rows="3">
                                 @else
                                 <input type="number" class="form-control" id="emergency_exit" name="emergency_exit" placeholder="Emergency Exit" value="" required rows="3">
                                 @endif
                                 <span class="error" id="error6"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Fireman switch in lift <span class="span_required">*</span></label>
                                 
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->fire_switch))
                                 @php
                                 $fire_switch = json_decode($declaration[0]->building_status)->fire_switch;
                                 @endphp
                                 @else
                                 @php $fire_switch = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fire_switch" id="fire_switch" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fire_switch == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($fire_switch == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error7"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Alternative Electric Supply <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->alt_electric))
                                 @php
                                 $alt_electric = json_decode($declaration[0]->building_status)->alt_electric;
                                 @endphp
                                 @else
                                 @php $alt_electric = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="alt_electric" id="alt_electric" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($alt_electric == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($alt_electric == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error8"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Emergency lighting system <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->emergency_light))
                                 @php
                                 $emergency_light = json_decode($declaration[0]->building_status)->emergency_light;
                                 @endphp
                                 @else
                                 @php $emergency_light = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="emergency_light" id="emergency_light" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($emergency_light == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($emergency_light == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error9"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Fluorescent exit sign <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->fluorescent_exit))
                                 @php
                                 $fluorescent_exit = json_decode($declaration[0]->building_status)->fluorescent_exit;
                                 @endphp
                                 @else
                                 @php $fluorescent_exit = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fluorescent_exit" id="fluorescent_exit" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fluorescent_exit == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($fluorescent_exit == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error10"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Provision of Smoke/Fire check Doors <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->pro_smoke))
                                 @php
                                 $pro_smoke = json_decode($declaration[0]->building_status)->pro_smoke;
                                 @endphp
                                 @else
                                 @php $pro_smoke = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="pro_smoke" id="pro_smoke" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($pro_smoke == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($pro_smoke == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error11"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Refuse area in case of high rise buildings <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->refuse_area))
                                 @php
                                 $refuse_area = json_decode($declaration[0]->building_status)->refuse_area;
                                 @endphp
                                 @else
                                 @php $refuse_area = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="refuse_area" id="refuse_area" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($refuse_area == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($refuse_area == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error12"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Maximum Travel Distance in Building <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->max_travel))
                                 <input type="text" class="form-control" id="max_travel" name="max_travel" placeholder="Maximum Travel Distance in Building " value="{{ json_decode($declaration[0]->building_status)->max_travel ?? ''}}" required step="any" pattern="^\d*(\.\d{0,2})?$">
                                 @else
                                 <input type="text" class="form-control" id="max_travel" name="max_travel" placeholder="Maximum Travel Distance in Building " value="" required step="any" pattern="^\d*(\.\d{0,2})?$">
                                 @endif
                                 <span class="error" id="error13"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Electric Installation(ELCB,MCB) <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->building_status) && isset(json_decode($declaration[0]->building_status)->elec_install))
                                 @php
                                 $elec_install = json_decode($declaration[0]->building_status)->elec_install;
                                 @endphp
                                 @else
                                 @php $elec_install = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="elec_install" id="elec_install" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($elec_install == 'Available') selected @endif>Available</option>
                                    <option value="Not Available" @if ($elec_install == 'Not Available') selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="error14"></span>
                              </div>
                           </div>
                        </div>
                        <div class="pl-lg-4 text-right ">
                           <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formBuilding()">Save And Next</button>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade" id="Fire_Fighting_Provision" role="tabpanel">
                     <form method="POST" enctype="multipart/form-data" id="form_provission">
                        @csrf
                        <input type="hidden" name="inspection_step" value="4">
                        <div class="row">
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Under-ground Static water Storage Tank<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->is_under_ground))
                                 @php
                                 $is_under_ground = json_decode($declaration[0]->fire_provission)->is_under_ground;
                                 @endphp
                                 @else
                                 @php $is_under_ground = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="is_under_ground" id="is_under_ground" onchange="isUnderGround(this);" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($is_under_ground=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($is_under_ground=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror1"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12 is_under_ground_storage" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Under-ground Static water Storage Tank Capacity (Ltr)<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission))
                                 <input type="text" class="form-control" id="under_ground_storage_capacity" name="under_ground_storage_capacity" placeholder="Under-ground Static water Storage Tank Capacity (Ltr)" value="{{ json_decode($declaration[0]->fire_provission)->under_ground_storage_capacity ?? ''}}">
                                 @else
                                 <input type="text" class="form-control" id="under_ground_storage_capacity" name="under_ground_storage_capacity" placeholder="Under-ground Static water Storage Tank Capacity (Ltr)" value="">
                                 @endif
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Pump near underground static water Storage Tank (fire pump with minimum Pressure of 3.5 kg/cm² at Remotest Location)<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->is_under_ground_tank))
                                 @php
                                 $is_under_ground_tank = json_decode($declaration[0]->fire_provission)->is_under_ground_tank;
                                 @endphp
                                 @else
                                 @php $is_under_ground_tank = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="is_under_ground_tank" id="is_under_ground_tank" onchange="isUnderGroundTank(this);" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($is_under_ground_tank=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($is_under_ground_tank=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror2"></span>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                              <div class="form-group">
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->type_under_ground_tank))
                                 @php
                                 $type_under_ground_tank = json_decode($declaration[0]->fire_provission)->type_under_ground_tank;
                                 @endphp
                                 @else
                                 @php $type_under_ground_tank = ''; @endphp
                                 @endif
                                 <div class="radio-toolbar">
                                    <input type="checkbox" id="type1" name="type_electric_under_ground_tank" value="Electric" @if ($type_under_ground_tank=='Electric' ) checked @endif>
                                    <label for="type1">Electric</label>
                                    <input type="checkbox" id="type2" name="type_diesel_under_ground_tank" value="Diesel" @if ($type_under_ground_tank=='Diesel' ) checked @endif>
                                    <label for="type2">Diesel</label>
                                    <input type="checkbox" id="type3" name="type_jockey_under_ground_tank" value="Jockey" @if ($type_under_ground_tank=='Jockey' ) checked @endif>
                                    <label for="type3">Jockey</label>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Electric Capacity (LPM)<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission))
                                 <input type="text" class="form-control" id="electric_ground_tank_capacity" name="electric_ground_tank_capacity" placeholder="Electric Capacity (LPM)" value="{{ json_decode($declaration[0]->fire_provission)->electric_ground_tank_capacity ?? ''}}">
                                 @else
                                 <input type="text" class="form-control" id="electric_ground_tank_capacity" name="electric_ground_tank_capacity" placeholder="Electric Capacity (LPM)" value="">
                                 @endif
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Diesel Capacity (LPM)<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission))
                                 <input type="text" class="form-control" id="diesel_ground_tank_capacity" name="diesel_ground_tank_capacity" placeholder="Diesel Capacity (LPM)" value="{{ json_decode($declaration[0]->fire_provission)->diesel_ground_tank_capacity ?? ''}}">
                                 @else
                                 <input type="text" class="form-control" id="diesel_ground_tank_capacity" name="diesel_ground_tank_capacity" placeholder="Diesel Capacity (LPM)" value="">
                                 @endif
                              </div>
                           </div>
                           <div class="col-lg-3 col-sm-3 col-xs-12 is_under_ground_tank" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Jockey Capacity (LPM)<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission))
                                 <input type="text" class="form-control" id="jockey_ground_tank_capacity" name="jockey_ground_tank_capacity" placeholder="Jockey Capacity (LPM)" value="{{ json_decode($declaration[0]->fire_provission)->jockey_ground_tank_capacity ?? ''}}">
                                 @else
                                 <input type="text" class="form-control" id="jockey_ground_tank_capacity" name="jockey_ground_tank_capacity" placeholder="Jockey Capacity (LPM)" value="">
                                 @endif
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Yard Hydrant<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->yard_hydrant))
                                 @php
                                 $yard_hydrant = json_decode($declaration[0]->fire_provission)->yard_hydrant;
                                 @endphp
                                 @else
                                 @php $yard_hydrant = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="yard_hydrant" id="yard_hydrant" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($yard_hydrant=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($yard_hydrant=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror3"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Fire Hose Cabin<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->fire_cabin))
                                 @php
                                 $fire_cabin = json_decode($declaration[0]->fire_provission)->fire_cabin;
                                 @endphp
                                 @else
                                 @php $fire_cabin = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fire_cabin" id="fire_cabin" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fire_cabin=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($fire_cabin=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror4"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Wet Riser<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->wet_riser))
                                 @php
                                 $wet_riser = json_decode($declaration[0]->fire_provission)->wet_riser;
                                 @endphp
                                 @else
                                 @php $wet_riser = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="wet_riser" id="wet_riser" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($wet_riser=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($wet_riser=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror5"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Is Terrace Tank Respective Tower Terrace<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->is_terrace_tank))
                                 @php
                                 $is_terrace_tank = json_decode($declaration[0]->fire_provission)->is_terrace_tank;
                                 @endphp
                                 @else
                                 @php $is_terrace_tank = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="is_terrace_tank" id="is_terrace_tank" onchange="isTerraceTank(this);" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($is_terrace_tank=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if($is_terrace_tank=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror6"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12 is_terrace_tank">
                              <div class="form-group">
                                 <label class="form-label">Terrace tank capacity of respective tower <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission))
                                 <input type="text" class="form-control" name="terrace_tank" placeholder="Terrace tank capacity of respective tower" value="{{ json_decode($declaration[0]->fire_provission)->terrace_tank ?? ''}}" rows="3">
                                 @else
                                 <input type="text" class="form-control" name="terrace_tank" placeholder="Terrace tank capacity of respective tower" value="" rows="3">
                                 @endif
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Is Terrace pump<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->is_terrace_pump))
                                 @php
                                 $is_terrace_pump = json_decode($declaration[0]->fire_provission)->is_terrace_pump;
                                 @endphp
                                 @else
                                 @php $is_terrace_pump = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="is_terrace_pump" id="is_terrace_pump" onchange="isTerracePump(this);" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($is_terrace_pump=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($is_terrace_pump=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror7"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12 is_terrace_pump">
                              <div class="form-group">
                                 <label class="form-label">Terrace pump Capacity (LPM) <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission))
                                 <input type="text" class="form-control" id="terrace_pump_capacity" name="terrace_pump_capacity" placeholder="Terrace pump capacity (LPM)" value="{{ json_decode($declaration[0]->fire_provission)->terrace_pump_capacity ?? ''}}">
                                 @else
                                 <input type="text" class="form-control" id="terrace_pump_capacity" name="terrace_pump_capacity" placeholder="Terrace pump capacity (LPM)" value="">
                                 @endif
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Down Comer<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->down_comer))
                                 @php
                                 $down_comer = json_decode($declaration[0]->fire_provission)->down_comer;
                                 @endphp
                                 @else
                                 @php $down_comer = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="down_comer" id="down_comer" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($down_comer=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($down_comer=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror8"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">First Aid Hose Real<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->first_aid))
                                 @php
                                 $first_aid = json_decode($declaration[0]->fire_provission)->first_aid;
                                 @endphp
                                 @else
                                 @php $first_aid = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="first_aid" id="first_aid" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($first_aid=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($first_aid=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror9"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Landing valve<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->landing_valve))
                                 @php
                                 $landing_valve = json_decode($declaration[0]->fire_provission)->landing_valve;
                                 @endphp
                                 @else
                                 @php $landing_valve = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="landing_valve" id="landing_valve" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($landing_valve=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($landing_valve=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror10"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Manually Operated Electronic Fire Alarm System<span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->manual_alarm))
                                 @php
                                 $manual_alarm = json_decode($declaration[0]->fire_provission)->manual_alarm;
                                 @endphp
                                 @else
                                 @php $manual_alarm = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="manual_alarm" id="manual_alarm" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($manual_alarm=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($manual_alarm=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror11"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-label">Automatic Detection and Alarm System <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->automatic_alarm))
                                 @php
                                 $automatic_alarm = json_decode($declaration[0]->fire_provission)->automatic_alarm;
                                 @endphp
                                 @else
                                 @php $automatic_alarm = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="automatic_alarm" id="automatic_alarm" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($automatic_alarm=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($automatic_alarm=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror12"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Automatic Sprinkler System <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->automatic_sprinkler))
                                 @php
                                 $automatic_sprinkler = json_decode($declaration[0]->fire_provission)->automatic_sprinkler;
                                 @endphp
                                 @else
                                 @php $automatic_sprinkler = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="automatic_sprinkler" id="automatic_sprinkler" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Not Available" @if ($automatic_sprinkler=='Not Available' ) selected @endif>Not Available</option>
                                    <option value="Available in Basement" @if ($automatic_sprinkler=='Available in Basement' ) selected @endif>Available in Basement</option>
                                    <option value="Available in Whole Building" @if ($automatic_sprinkler=='Available in Whole Building' ) selected @endif>Available in Whole Building</option>
                                 </select>
                                 <span class="error" id="ferror13"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right:0;">
                              <div class="form-group">
                                 <label class="form-label">Fire Extinguisher <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->fire_provission) && isset(json_decode($declaration[0]->fire_provission)->fire_extinguisher))
                                 @php
                                 $fire_extinguisher = json_decode($declaration[0]->fire_provission)->fire_extinguisher;
                                 @endphp
                                 @else
                                 @php $fire_extinguisher = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fire_extinguisher" id="fire_extinguisher" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fire_extinguisher=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($fire_extinguisher=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="ferror14"></span>
                              </div>
                           </div>
                        </div>
                        <div class="pl-lg-4 text-right ">
                           <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formFireProvision()">Save And Next</button>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade" id="Special_Provision" role="tabpanel">
                     <form method="POST" enctype="multipart/form-data" id="form_special">
                        @csrf
                        <input type="hidden" name="inspection_step" value="5">
                        <div class="row">
                           <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="input-username">Smoke Extraction System <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->smoke_extraction))
                                 @php
                                 $smoke_extraction = json_decode($declaration[0]->special_provission)->smoke_extraction;
                                 @endphp
                                 @else
                                 @php $smoke_extraction = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="smoke_extraction" id="smoke_extraction" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($smoke_extraction=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($smoke_extraction=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror1"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12" style="padding-right: 0;">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Fresh Air Induction System <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->fresh_air))
                                 @php
                                 $fresh_air = json_decode($declaration[0]->special_provission)->fresh_air;
                                 @endphp
                                 @else
                                 @php $fresh_air = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fresh_air" id="fresh_air" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fresh_air=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($fresh_air=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror2"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-6 col-xs-12">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Response Indicator <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->response_indicator))
                                 @php
                                 $response_indicator = json_decode($declaration[0]->special_provission)->response_indicator;
                                 @endphp
                                 @else
                                 @php $response_indicator = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="response_indicator" id="response_indicator" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($response_indicator=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($response_indicator=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror3"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-control-label" for="">Water Spray System <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->water_spray))
                                 @php
                                 $water_spray = json_decode($declaration[0]->special_provission)->water_spray;
                                 @endphp
                                 @else
                                 @php $water_spray = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="water_spray" id="water_spray" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($water_spray=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($water_spray=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror4"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Foam Spray System <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->foam_spray))
                                 @php
                                 $foam_spray = json_decode($declaration[0]->special_provission)->foam_spray;
                                 @endphp
                                 @else
                                 @php $foam_spray = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="foam_spray" id="foam_spray" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($foam_spray=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($foam_spray=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror5"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Gas type flooding system <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->flooding_system))
                                 @php
                                 $flooding_system = json_decode($declaration[0]->special_provission)->flooding_system;
                                 @endphp
                                 @else
                                 @php $flooding_system = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="flooding_system" id="flooding_system" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($flooding_system=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($flooding_system=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror6"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Fireman switch in lift <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->fire_switch_lift))
                                 @php
                                 $fire_switch_lift = json_decode($declaration[0]->special_provission)->fire_switch_lift;
                                 @endphp
                                 @else
                                 @php $fire_switch_lift = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fire_switch_lift" id="fire_switch_lift" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fire_switch_lift=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($fire_switch_lift=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror7"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Fire Cart Room <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->fire_cart))
                                 @php
                                 $fire_cart = json_decode($declaration[0]->special_provission)->fire_cart;
                                 @endphp
                                 @else
                                 @php $fire_cart = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fire_cart" id="fire_cart" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fire_cart=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($fire_cart=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror8"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Beam Detector <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->beam_detector))
                                 @php
                                 $beam_detector = json_decode($declaration[0]->special_provission)->beam_detector;
                                 @endphp
                                 @else
                                 @php $beam_detector = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="beam_detector" id="beam_detector" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($beam_detector=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($beam_detector=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror9"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Gas Detector <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->gas_detector))
                                 @php
                                 $gas_detector = json_decode($declaration[0]->special_provission)->gas_detector;
                                 @endphp
                                 @else
                                 @php $gas_detector = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="gas_detector" id="gas_detector" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($gas_detector=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($gas_detector=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror10"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Fire Bucket <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->fire_bucket))
                                 @php
                                 $fire_bucket = json_decode($declaration[0]->special_provission)->fire_bucket;
                                 @endphp
                                 @else
                                 @php $fire_bucket = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="fire_bucket" id="fire_bucket" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($fire_bucket=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($fire_bucket=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror11"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Emergency No <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->emergency_no))
                                 @php
                                 $emergency_no = json_decode($declaration[0]->special_provission)->emergency_no;
                                 @endphp
                                 @else
                                 @php $emergency_no = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="emergency_no" id="emergency_no" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($emergency_no=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($emergency_no=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror12"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Fire Safety Trained Staff <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission) && isset(json_decode($declaration[0]->special_provission)->trained_staff))
                                 @php
                                 $trained_staff = json_decode($declaration[0]->special_provission)->trained_staff;
                                 @endphp
                                 @else
                                 @php $trained_staff = ''; @endphp
                                 @endif
                                 <select class="form-control js-example-basic-multiple select2-hidden-accessible" name="trained_staff" id="trained_staff" required>
                                    <option value="" style="display:none;">Select</option>
                                    <option value="Available" @if ($trained_staff=='Available' ) selected @endif>Available</option>
                                    <option value="Not Available" @if ($trained_staff=='Not Available' ) selected @endif>Not Available</option>
                                 </select>
                                 <span class="error" id="serror13"></span>
                              </div>
                           </div>
                           <div class="col-lg-6 col-sm-10 col-xs-12">
                              <div class="form-group">
                                 <label class="form-label">Other Comment <span class="span_required">*</span></label>
                                 @if(isset($declaration[0]->special_provission))
                                 <input type="text" class="form-control" id="other_comment" name="other_comment" placeholder="Other Comment  " value="{{ json_decode($declaration[0]->special_provission)->other_comment ?? ''}}" required rows="3">
                                 @else
                                 <input type="text" class="form-control" id="other_comment" name="other_comment" placeholder="Other Comment  " value="" required rows="3">
                                 @endif
                                 <span class="error" id="serror14"></span>
                              </div>
                           </div>
                        </div>
                        <div class="pl-lg-4 text-right ">
                           <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formSpecial()">Save And Next</button>
                        </div>
                     </form>
                  </div>
                  <div class="tab-pane fade" id="Declaration_Submit" role="tabpanel">
                     <form method="POST" enctype="multipart/form-data" id="form_physical">
                        @csrf
                        <div class="row">
                           <input type="hidden" name="inspection_step" value="">
                           <div class="col-lg-12 col-sm-10 col-xs-12" style="padding-right: 0;">
                              <div class="form-group">
                                 @if(isset($declaration[0]->final_submit))
                                 @php
                                 $dec = $declaration[0]->final_submit;
                                 @endphp
                                 @else
                                 @php $dec = ''; @endphp
                                 @endif

                                 @if(isset($declaration[0]->final_submit1))
                                 @php
                                 $dec1 = $declaration[0]->final_submit1;
                                 @endphp
                                 @else
                                 @php $dec1 = ''; @endphp
                                 @endif
                                 <div class="radio-toolbar">
                                    <input type="checkbox" id="declaration" name="declaration" value="1" class="rb" @if ($dec=='1' ) checked @endif required> I hereby declare that the information furnished above is true, complete and correct to the best of my knowledge and belief
                                    
                                    <span class="error" id="fierror1"></span>
                                    <br>

                                    <input type="checkbox" id="declaration1" name="declaration1" value="1" class="rb" @if ($dec1=='1' ) checked @endif required> All the fire fighting installation/equipments in my premises/building/firm are in working condition
                                    <span class="error" id="fierror2"></span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="pl-lg-4 text-right ">
                           <button class="save-btn hover-btn btn btn-primary mb-3" type="button" onclick="formSubmit()">Save</button>
                        </div>
                     </form>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://newfirestation.test-uat.site/public/admin/js/select2.js"></script>
<script>
   $(document).ready(function() {
      $('.js-example-basic-multiple').select2();
      $(".is_under_ground_storage").hide();
      $(".is_under_ground_tank").hide();
      $(".is_terrace_tank").hide();
      $(".is_terrace_pump").hide();
   });

   function isUnderGround() {
      var yes_no = $("#is_under_ground").val();
      if (yes_no == 'Available') {
         $(".is_under_ground_storage").show();
      } else {
         $(".is_under_ground_storage").hide();
      }
   }

   function isUnderGroundTank() {
      var yes_no = $("#is_under_ground_tank").val();
      if (yes_no == 'Available') {
         $(".is_under_ground_tank").show();
      } else {
         $(".is_under_ground_tank").hide();
      }
   }

   function isTerraceTank() {
      var yes_no = $("#is_terrace_tank").val();
      if (yes_no == 'Available') {
         $(".is_terrace_tank").show();
      } else {
         $(".is_terrace_tank").hide();
      }
   }

   function isTerracePump() {
      var yes_no = $("#is_terrace_pump").val();
      if (yes_no == 'Available') {
         $(".is_terrace_pump").show();
      } else {
         $(".is_terrace_pump").hide();
      }
   }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js" integrity="sha512-KFHXdr2oObHKI9w4Hv1XPKc898mE4kgYx58oqsc/JqqdLMDI4YjOLzom+EMlW8HFUd0QfjfAvxSL6sEq/a42fQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
$(document).ready(function() {
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });
});
function formBuilding() {
   const _token = $('input[name="_token"]').val();
   const declaration_id = $('#declaration_id').val();
   const set_back = $('#set_back').val();
   const compartmentation = $('#compartmentation').val();
   const stair_width = $('#stair_width').val();
   const fire_cabin = $('#fire_cabin').val();
   const stair_in_block = $('#stair_in_block').val();
   const emergency_exit = $('#emergency_exit').val();
   const fire_switch = $('#fire_switch').val();
   const alt_electric = $('#alt_electric').val();
   const emergency_light = $('#emergency_light').val();
   const fluorescent_exit = $('#fluorescent_exit').val();
   const pro_smoke = $('#pro_smoke').val();
   const refuse_area = $('#refuse_area').val();
   const max_travel = $('#max_travel').val();
   const elec_install = $('#elec_install').val();

   // Validate required fields
   if (!set_back) {
      var msg = "This field is required";
      $('#error1').html(msg);
      return;
   }
   else if(!compartmentation) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html(msg);
      return;
   }
   else if(!stair_width) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html(msg);
      return;
   }
   else if(!fire_cabin) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html(msg);
      return;
   }
   else if(!stair_in_block) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html(msg);
      return;
   }
   else if(!emergency_exit) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html(msg);
      return;
   }
   else if(!fire_switch) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html(msg);
      return;
   }
   else if (!alt_electric) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html(msg);
      return;
   }
   else if(!emergency_light) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html("");
      $('#error9').html(msg);
      return;
   }
   else if(!fluorescent_exit) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html("");
      $('#error9').html("");
      $('#error10').html(msg);
      return;
   }
   else if(!pro_smoke) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html("");
      $('#error9').html("");
      $('#error10').html("");
      $('#error11').html(msg);
      return;
   }
   else if(!refuse_area) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html("");
      $('#error9').html("");
      $('#error10').html("");
      $('#error11').html("");
      $('#error12').html(msg);
      return;
   }
   else if(!max_travel) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html("");
      $('#error9').html("");
      $('#error10').html("");
      $('#error11').html("");
      $('#error12').html("");
      $('#error13').html(msg);
      return;
   }
   else if(!elec_install) {
      var msg = "This field is required";
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html("");
      $('#error9').html("");
      $('#error10').html("");
      $('#error11').html("");
      $('#error12').html("");
      $('#error13').html("");
      $('#error14').html(msg);
      return;
   }
   else
   {
      
      $('#error1').html("");
      $('#error2').html("");
      $('#error3').html("");
      $('#error4').html("");
      $('#error5').html("");
      $('#error6').html("");
      $('#error7').html("");
      $('#error8').html("");
      $('#error9').html("");
      $('#error10').html("");
      $('#error11').html("");
      $('#error12').html("");
      $('#error13').html("");
      $('#error14').html("");
      // Create FormData object
      const formData = new FormData();
      formData.append('_token', _token);
      formData.append('declaration_id', declaration_id);
      formData.append('set_back', set_back);
      formData.append('compartmentation', compartmentation);
      formData.append('stair_width', stair_width);
      formData.append('fire_cabin', fire_cabin);
      formData.append('stair_in_block', stair_in_block);
      formData.append('emergency_exit', emergency_exit);
      formData.append('fire_switch', fire_switch);
      formData.append('alt_electric', alt_electric);
      formData.append('emergency_light', emergency_light);
      formData.append('fluorescent_exit', fluorescent_exit);
      formData.append('pro_smoke', pro_smoke);
      formData.append('refuse_area', refuse_area);
      formData.append('max_travel', max_travel);
      formData.append('elec_install', elec_install);

      $.ajax({
         url: "{{route('citizen.addBuildingStatusPost')}}",
         type: 'POST',
         data: formData,
         contentType: false,
         processData: false,
         dataType: 'json', // Expecting a JSON response
         success: function(response) {
            console.log(response);
            if (response == 1)
            {
               $('.buildingstatus').removeClass('active');
               $('#Building_Status').removeClass('active show');
               $('.Fire_Fighting_Provision').addClass('active');
               $('#Fire_Fighting_Provision').addClass('active show');
            }
            else
            {
               var msg = "Something went wrong. Please try again.";
               document.getElementById('errorBlock').style.display = 'block';
               $('#errorBlock').html(msg);
            }
         },
         error: function(xhr, status, error) {
            const errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred: ' + error;
            $('#response').html(errorMessage);
         }
      });
   }
}
function formFireProvision() {
   const _token = $('input[name="_token"]').val();
   const declaration_id = $('#declaration_id').val();
   var is_under_ground = $('#is_under_ground').val();
   var under_ground_storage_capacity = $('#under_ground_storage_capacity').val();
   var is_under_ground_tank = $('#is_under_ground_tank').val();
   var type_electric_under_ground_tank = $('#type_electric_under_ground_tank').val();
   var electric_ground_tank_capacity = $('#electric_ground_tank_capacity').val();
   var diesel_ground_tank_capacity = $('#diesel_ground_tank_capacity').val();
   var jockey_ground_tank_capacity = $('#jockey_ground_tank_capacity').val();
   var yard_hydrant = $('#yard_hydrant').val();
   var fire_cabin = $('#fire_cabin').val();
   var wet_riser = $('#wet_riser').val();
   var is_terrace_tank = $('#is_terrace_tank').val();
   var terrace_tank = $('#terrace_tank').val();
   var is_terrace_pump = $('#is_terrace_pump').val();
   var terrace_pump_capacity = $('#terrace_pump_capacity').val();
   var down_comer = $('#down_comer').val();
   var first_aid = $('#first_aid').val();
   var landing_valve = $('#landing_valve').val();
   var manual_alarm = $('#manual_alarm').val();
   var automatic_alarm = $('#automatic_alarm').val();
   var automatic_sprinkler = $('#automatic_sprinkler').val();
   var fire_extinguisher = $('#fire_extinguisher').val();

   // Validate required fields
   if (!is_under_ground) {
      var msg = "This field is required";
      $('#ferror1').html(msg);
      return;
   }
   else if(!is_under_ground_tank) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html(msg);
      return;
   }
   else if(!yard_hydrant) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html(msg);
      return;
   }
   else if(!fire_cabin) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html(msg);
      return;
   }
   else if(!wet_riser) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html(msg);
      return;
   }
   else if(!is_terrace_tank) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html(msg);
      return;
   }
   else if(!is_terrace_pump) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html(msg);
      return;
   }
   else if (!down_comer) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html(msg);
      return;
   }
   else if(!first_aid) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html("");
      $('#ferror9').html(msg);
      return;
   }
   else if(!landing_valve) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html("");
      $('#ferror9').html("");
      $('#ferror10').html(msg);
      return;
   }
   else if(!manual_alarm) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html("");
      $('#ferror9').html("");
      $('#ferror10').html("");
      $('#ferror11').html(msg);
      return;
   }
   else if(!automatic_alarm) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html("");
      $('#ferror9').html("");
      $('#ferror10').html("");
      $('#ferror11').html("");
      $('#ferror12').html(msg);
      return;
   }
   else if(!automatic_sprinkler) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html("");
      $('#ferror9').html("");
      $('#ferror10').html("");
      $('#ferror11').html("");
      $('#ferror12').html("");
      $('#ferror13').html(msg);
      return;
   }
   else if(!fire_extinguisher) {
      var msg = "This field is required";
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html("");
      $('#ferror9').html("");
      $('#ferror10').html("");
      $('#ferror11').html("");
      $('#ferror12').html("");
      $('#ferror13').html("");
      $('#ferror14').html(msg);
      return;
   }
   else
   {
      
      $('#ferror1').html("");
      $('#ferror2').html("");
      $('#ferror3').html("");
      $('#ferror4').html("");
      $('#ferror5').html("");
      $('#ferror6').html("");
      $('#ferror7').html("");
      $('#ferror8').html("");
      $('#ferror9').html("");
      $('#ferror10').html("");
      $('#ferror11').html("");
      $('#ferror12').html("");
      $('#ferror13').html("");
      $('#ferror14').html("");
      // Create FormData object
      const formData = new FormData();
      formData.append('_token', _token);
      formData.append('declaration_id', declaration_id);
      formData.append('is_under_ground', is_under_ground);
      formData.append('under_ground_storage_capacity', under_ground_storage_capacity);
      formData.append('is_under_ground_tank', is_under_ground_tank);
      formData.append('type_electric_under_ground_tank', type_electric_under_ground_tank);
      formData.append('electric_ground_tank_capacity', electric_ground_tank_capacity);
      formData.append('diesel_ground_tank_capacity', diesel_ground_tank_capacity);
      formData.append('jockey_ground_tank_capacity', jockey_ground_tank_capacity);
      formData.append('yard_hydrant', yard_hydrant);
      formData.append('fire_cabin', fire_cabin);
      formData.append('wet_riser', wet_riser);
      formData.append('is_terrace_tank', is_terrace_tank);
      formData.append('terrace_tank', terrace_tank);
      formData.append('is_terrace_pump', is_terrace_pump);
      formData.append('terrace_pump_capacity', terrace_pump_capacity);
      formData.append('down_comer', down_comer);
      formData.append('first_aid', first_aid);
      formData.append('landing_valve', landing_valve);
      formData.append('manual_alarm', manual_alarm);
      formData.append('automatic_alarm', automatic_alarm);
      formData.append('automatic_sprinkler', automatic_sprinkler);
      formData.append('fire_extinguisher', fire_extinguisher);

      $.ajax({
         url: "{{route('citizen.addFireProvissionPost')}}",
         type: 'POST',
         data: formData,
         contentType: false,
         processData: false,
         dataType: 'json', // Expecting a JSON response
         success: function(response) {
            console.log(response);
            if (response == 1)
            {
               $('.Fire_Fighting_Provision').removeClass('active');
               $('#Fire_Fighting_Provision').removeClass('active show');
               $('.Special_Provision').addClass('active');
               $('#Special_Provision').addClass('active show');
            }
            else
            {
               var msg = "Something went wrong. Please try again.";
               document.getElementById('errorBlock').style.display = 'block';
               $('#errorBlock').html(msg);
            }
         },
         error: function(xhr, status, error) {
            const errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred: ' + error;
            $('#response').html(ferrorMessage);
         }
      });
   }
}
function formSpecial() {
   const _token = $('input[name="_token"]').val();var smoke_extraction = $('#smoke_extraction').val();
   const declaration_id = $('#declaration_id').val();
   var smoke_extraction = $('#smoke_extraction').val();
   var fresh_air = $('#fresh_air').val();
   var response_indicator = $('#response_indicator').val();
   var water_spray = $('#water_spray').val();
   var foam_spray = $('#foam_spray').val();
   var flooding_system = $('#flooding_system').val();
   var fire_switch_lift = $('#fire_switch_lift').val();
   var fire_cart = $('#fire_cart').val();
   var beam_detector = $('#beam_detector').val();
   var gas_detector = $('#gas_detector').val();
   var fire_bucket = $('#fire_bucket').val();
   var emergency_no = $('#emergency_no').val();
   var trained_staff = $('#trained_staff').val();
   var other_comment = $('#other_comment').val();

   // Validate required fields
   if (!smoke_extraction) {
      var msg = "This field is required";
      $('#serror1').html(msg);
      return;
   }
   else if(!fresh_air) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html(msg);
      return;
   }
   else if(!response_indicator) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html(msg);
      return;
   }
   else if(!water_spray) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html(msg);
      return;
   }
   else if(!foam_spray) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html(msg);
      return;
   }
   else if(!flooding_system) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html(msg);
      return;
   }
   else if(!fire_switch_lift) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html(msg);
      return;
   }
   else if (!fire_cart) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html(msg);
      return;
   }
   else if(!beam_detector) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html("");
      $('#serror9').html(msg);
      return;
   }
   else if(!gas_detector) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html("");
      $('#serror9').html("");
      $('#serror10').html(msg);
      return;
   }
   else if(!fire_bucket) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html("");
      $('#serror9').html("");
      $('#serror10').html("");
      $('#serror11').html(msg);
      return;
   }
   else if(!emergency_no) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html("");
      $('#serror9').html("");
      $('#serror10').html("");
      $('#serror11').html("");
      $('#serror12').html(msg);
      return;
   }
   else if(!trained_staff) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html("");
      $('#serror9').html("");
      $('#serror10').html("");
      $('#serror11').html("");
      $('#serror12').html("");
      $('#serror13').html(msg);
      return;
   }
   else if(!other_comment) {
      var msg = "This field is required";
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html("");
      $('#serror9').html("");
      $('#serror10').html("");
      $('#serror11').html("");
      $('#serror12').html("");
      $('#serror13').html("");
      $('#serror14').html(msg);
      return;
   }
   else
   {
      
      $('#serror1').html("");
      $('#serror2').html("");
      $('#serror3').html("");
      $('#serror4').html("");
      $('#serror5').html("");
      $('#serror6').html("");
      $('#serror7').html("");
      $('#serror8').html("");
      $('#serror9').html("");
      $('#serror10').html("");
      $('#serror11').html("");
      $('#serror12').html("");
      $('#serror13').html("");
      $('#serror14').html("");
      // Create FormData object
      const formData = new FormData();
      formData.append('_token', _token);
      formData.append('declaration_id', declaration_id);
      formData.append('smoke_extraction', smoke_extraction);
      formData.append('fresh_air', fresh_air);
      formData.append('response_indicator', response_indicator);
      formData.append('water_spray', water_spray);
      formData.append('foam_spray', foam_spray);
      formData.append('flooding_system', flooding_system);
      formData.append('fire_switch_lift', fire_switch_lift);
      formData.append('fire_cart', fire_cart);
      formData.append('beam_detector', beam_detector);
      formData.append('gas_detector', gas_detector);
      formData.append('fire_bucket', fire_bucket);
      formData.append('emergency_no', emergency_no);
      formData.append('trained_staff', trained_staff);
      formData.append('other_comment', other_comment);

      $.ajax({
         url: "{{route('citizen.addSpecialProvissionPost')}}",
         type: 'POST',
         data: formData,
         contentType: false,
         processData: false,
         dataType: 'json', // Expecting a JSON response
         success: function(response) {
            console.log(response);
            if (response == 1)
            {
               $('.Special_Provision').removeClass('active');
               $('#Special_Provision').removeClass('active show');
               $('.Declaration_Submit').addClass('active');
               $('#Declaration_Submit').addClass('active show');
            }
            else
            {
               var msg = "Something went wrong. Please try again.";
               document.getElementById('errorBlock').style.display = 'block';
               $('#errorBlock').html(msg);
            }
         },
         error: function(xhr, status, error) {
            const errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred: ' + error;
            $('#response').html(errorMessage);
         }
      });
   }
}
function formSubmit() {
   const _token = $('input[name="_token"]').val();
   const declaration_id = $('#declaration_id').val();
   var declaration = $('#declaration').val();
   var declaration1 = $('#declaration1').val();
   // Validate required fields
   if (!declaration) {
      var msg = "This field is required";
      $('#fierror1').html(msg);
      return;
   }
   else if(!declaration1) {
      var msg = "This field is required";
      $('#fierror1').html("");
      $('#fierror2').html(msg);
      return;
   }
   else
   {
      $('#fierror1').html("");
      $('#fierror2').html("");
      // Create FormData object
      const formData = new FormData();
      formData.append('_token', _token);
      formData.append('declaration_id', declaration_id);
      formData.append('declaration', declaration);
      formData.append('declaration1', declaration1);

      $.ajax({
         url: "{{route('citizen.addFinalSubmitPost')}}",
         type: 'POST',
         data: formData,
         contentType: false,
         processData: false,
         dataType: 'json', // Expecting a JSON response
         success: function(response) {
            console.log(response);
            if (response == 1)
            {
               var msg = "Data saved successfully.";
               document.getElementById('successBlock').style.display = 'block';
               $('#successBlock').html(msg);
            }
            else
            {
               var msg = "Something went wrong. Please try again.";
               document.getElementById('errorBlock').style.display = 'block';
               $('#errorBlock').html(msg);
            }
         },
         error: function(xhr, status, error) {
            const fierrorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred: ' + error;
            $('#response').html(errorMessage);
         }
      });
   }
}
</script>
@stop
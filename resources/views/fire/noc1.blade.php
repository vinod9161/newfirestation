@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Pre Establishment NOC</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Pre Establishment NOC</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

    <div class="container">
        <div class="row">

    <div class="col-sm-12 ">
        <h1 style="margin-top: 40px;">
            Performa of application for Pre-Establishment NOC  
        </h1>

        <div class="row">
            <div class="col-md-6">
                <p>
                    * Timeline 15 days<br>
                    * All fields are mandatory
                </p>
            </div>

            <div class="col-md-6">
                <div class="pull-right">
                    <button type="button" class="collapsible">Returning Applicants/Print NOC, Kindly Click Here</button>
                    <div class="content">
                        <form id="verifier-forms" action="/fireservice/application/applicationstatus" method="post">    
                            <div class="form-group" style="margin-top: 10px ;">
                              <label for="email">(1) Type Your Previous UID Here</label>
                          <input placeholder="Application UID" class="form-control" name="ApplicationStatus[uuid]" id="ApplicationStatus_uuid" type="text">                <div class="errorMessage" id="ApplicationStatus_uuid_em_" style="display:none"></div>                </div>
              
                           <input class="btn btn-success" style="margin-bottom: 10px;"type="submit" name="yt0" value="Submit"></form> 
                    </div>
                    </div>
                </div>
            </div>






            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <form enctype="multipart/form-data" id="application-forms" action="/fireservice/application/index/type/establishment?userType=normal" method="post" novalidate="novalidate">            <input value="" name="ApplicationForm[caf_id]" id="ApplicationForm_caf_id" type="hidden">            <input value="normal" name="ApplicationForm[user_type]" id="ApplicationForm_user_type" type="hidden">            <input value="" name="ApplicationForm[service_id]" id="ApplicationForm_service_id" type="hidden">            <input value="" name="ApplicationForm[user_id]" id="ApplicationForm_user_id" type="hidden">            <input value="" name="ApplicationForm[iuid]" id="ApplicationForm_iuid" type="hidden">            <input value="establishment" name="ApplicationForm[application_type]" id="ApplicationForm_application_type" type="hidden">            <input value="" name="ApplicationForm[id]" id="ApplicationForm_id" type="hidden">            <input value="" name="ApplicationForm[uuid]" id="ApplicationForm_uuid" type="hidden">            <input value="" name="ApplicationDirector[id]" id="ApplicationDirector_id" type="hidden">            <input value="" name="ApplicationArchitecture[id]" id="ApplicationArchitecture_id" type="hidden">            <input value="" name="ApplicationCoordinator[id]" id="ApplicationCoordinator_id" type="hidden">
                        <div class="form-group ">
                            <label>Proposed/Compounding/Building name:<span>*</span></label>
                              <div id="uniqueValidate"></div>
                            <input value="" placeholder="Building Name" class="form-control" name="ApplicationForm[building_name]" id="ApplicationForm_building_name" type="text"> 
                            </div>

                            <div class="form-group">
                                <label>Address: <span>*</span></label>
                                <textarea placeholder="Building Address" class="form-control" name="ApplicationForm[building_address]" id="ApplicationForm_building_address"></textarea>  
                            </div>

                </div>



            
                        <div class="form-group col-md-4">
                            <label>Mobile: <span>*</span></label>
                             <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationForm[mobile_no]" id="ApplicationForm_mobile_no" type="text"> 
                         </div>
        

     

                    <div class="form-group  col-md-4">
                        <label>Telephone No.</label>
                    <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationForm[telephone_no]" id="ApplicationForm_telephone_no" type="text">     
                     </div>
                    

                     <div class="form-group col-md-4">
                        <label>Fax No.</label>
                       <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationForm[fax_no]" id="ApplicationForm_fax_no" type="text">   
                      </div>

                      <div class="form-group  col-md-6">
                        <label>Email: <span>*</span></label>
                      <input value="" placeholder="Email" class="form-control" name="ApplicationForm[email]" id="ApplicationForm_email" type="text">     
                     </div>
           
                     <div class="form-group  col-md-6">
                        <label>Pincode: <span>*</span></label>
                       <input value="" placeholder="XXXXXX" class="form-control" name="ApplicationForm[pincode]" id="ApplicationForm_pincode" type="text">   
                      </div>     

                      <div class="form-group col-md-12">
                        <label>Name of Director/ Partner/ CEO/ Lead Promoter/ Proprietor: <span>*</span></label>
                          <input value="" placeholder="Director Name" class="form-control" name="ApplicationDirector[director_name]" id="ApplicationDirector_director_name" type="text">    
                      </div>
            
        

          
         
      
            </div>




            <!-- Name of director-->
       

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Telephone no.</label>
                 <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationDirector[director_telephone_no]" id="ApplicationDirector_director_telephone_no" type="text">   
                             </div>

                <div class="form-group  col-md-6">
                    <label>Fax No.</label>
                    <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationDirector[director_fax_no]" id="ApplicationDirector_director_fax_no" type="text"> 
                     </div>

            </div>

            <div class="row">
                <div class="form-group  col-md-6">
                    <label>Email: <span>*</span></label>
                   <input value="" placeholder="Email" class="form-control" name="ApplicationDirector[director_email]" id="ApplicationDirector_director_email" type="text">   
                </div>

                <div class="form-group  col-md-6">
                    <label>Mobile: <span>*</span></label>
                    <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationDirector[director_mobile_no]" id="ApplicationDirector_director_mobile_no" type="text"> 
                </div>                  
            </div>

            <!-- Name of Authorized Coordinator/ Person-->

            <div class="form-group">
                <label>Name of Authorized Coordinator/ Contact Person: <span>*</span></label>
                                    <input value="" placeholder="Coordinator Name" class="form-control" name="ApplicationCoordinator[coordinator_name]" id="ApplicationCoordinator_coordinator_name" type="text">            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Telephone no.</label>
                                        <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationCoordinator[coordinator_telephone_no]" id="ApplicationCoordinator_coordinator_telephone_no" type="text">                </div>

                <div class="form-group  col-md-6">
                    <label>Fax No.</label>
                                        <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationCoordinator[coordinator_fax_no]" id="ApplicationCoordinator_coordinator_fax_no" type="text">                </div>
            </div>

            <div class="row">
                <div class="form-group  col-md-6">
                    <label>Email: <span>*</span></label>
                                        <input value="" placeholder="Email" class="form-control" name="ApplicationCoordinator[coordinator_email]" id="ApplicationCoordinator_coordinator_email" type="text">                </div>
                <div class="form-group  col-md-6">
                    <label>Mobile: <span>*</span></label>
                    <input value="" placeholder="XXXXXXXXXX" class="form-control" name="ApplicationCoordinator[coordinator_mobile_no]" id="ApplicationCoordinator_coordinator_mobile_no" type="text">                </div>                  
            </div>


            <!-- Name of Architect-->
            <div class="form-group">
                <label>Name of Architect: <span>*</span></label>
<input placeholder="Architect Name" class="form-control" name="ApplicationArchitecture[architecture_name]" id="ApplicationArchitecture_architecture_name" type="text">            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Telephone no.</label>
<input placeholder="XXXXXXXXXX" class="form-control" name="ApplicationArchitecture[architecture_telephone_no]" id="ApplicationArchitecture_architecture_telephone_no" type="text">                </div>

                <div class="form-group  col-md-6">
                    <label>Fax No.</label>
<input placeholder="XXXXXXXXXX" class="form-control" name="ApplicationArchitecture[architecture_fax_no]" id="ApplicationArchitecture_architecture_fax_no" type="text">                </div>

            </div>

            <div class="row">
                <div class="form-group  col-md-6">
                    <label>Email: <span>*</span></label>
<input placeholder="Email" class="form-control" name="ApplicationArchitecture[architecture_email]" id="ApplicationArchitecture_architecture_email" type="text">                </div>
                <div class="form-group  col-md-6">
                    <label>Mobile: <span>*</span></label>
<input placeholder="XXXXXXXXXX" class="form-control" name="ApplicationArchitecture[architecture_mobile_no]" id="ApplicationArchitecture_architecture_mobile_no" type="text">                </div>                  
            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Select District:<span>*</span></label>
<select class="form-control" name="ApplicationForm[district_id]" id="ApplicationForm_district_id">
<option value="">Select District</option>
<option value="1">Almora</option>
<option value="2">Bageshwar</option>
<option value="3">Chamoli</option>
<option value="4">Champawat</option>
<option value="5">Dehradun</option>
<option value="6">Haridwar</option>
<option value="7">Nainital</option>
<option value="8">Pauri Garhwal</option>
<option value="9">Pithoragarh</option>
<option value="10">Rudraprayag</option>
<option value="11">Tehri Garhwal</option>
<option value="12">Udham Singh Nagar</option>
<option value="13">Uttarkashi</option>
</select>                </div>


                <div class="form-group col-md-6">
                    <label>Type of Building: <span>*</span></label>
<select class="form-control" name="ApplicationForm[building_type]" id="ApplicationForm_building_type">
<option value="" selected="selected">Select Building Type</option>
<option value="Educational">Educational</option>
<option value="Institutional">Institutional</option>
<option value="Assembly">Assembly</option>
<option value="Business">Business</option>
<option value="Merchantile">Merchantile</option>
<option value="Industrial">Industrial</option>
<option value="Storage">Storage</option>
<option value="Hazardous">Hazardous</option>
<option value="Mix Occupancy">Mix Occupancy</option>
<option value="Residential">Residential</option>
<option value="Any Other">Any Other</option>
</select>                </div>
            </div>

            <div class="form-group">
                <label>Type of Industry: <span>*</span></label>
<input placeholder="Industry Type" class="form-control" name="ApplicationForm[industry_type]" id="ApplicationForm_industry_type" type="text">            </div>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>Project Status: <span>*</span></label><br>
                    <input id="ytApplicationForm_project_status" type="hidden" value="" name="ApplicationForm[project_status]"><span id="ApplicationForm_project_status"><input id="ApplicationForm_project_status_0" value="new" type="radio" name="ApplicationForm[project_status]"> <label style="display:inline" for="ApplicationForm_project_status_0">New</label><br><input id="ApplicationForm_project_status_1" value="expansion" type="radio" name="ApplicationForm[project_status]"> <label style="display:inline" for="ApplicationForm_project_status_1">Expansion</label><br><input id="ApplicationForm_project_status_2" value="diversification" type="radio" name="ApplicationForm[project_status]"> <label style="display:inline" for="ApplicationForm_project_status_2">Diversification</label><br><input id="ApplicationForm_project_status_3" value="compounding" type="radio" name="ApplicationForm[project_status]"> <label style="display:inline" for="ApplicationForm_project_status_3">Compounding</label></span>                    <label for="ApplicationForm[project_status]" generated="true" class="error"></label>                         
                </div>

                <div class="form-group col-md-6">
                    <label>Project Cost: <span>*</span></label><br>
                        <input id="ytApplicationForm_project_investment" type="hidden" value="" name="ApplicationForm[project_investment]"><span id="ApplicationForm_project_investment"><input id="ApplicationForm_project_investment_0" value="micro" type="radio" name="ApplicationForm[project_investment]"> <label style="display:inline" for="ApplicationForm_project_investment_0">Micro (&lt; 25 Lakhs)</label><br><input id="ApplicationForm_project_investment_1" value="small" type="radio" name="ApplicationForm[project_investment]"> <label style="display:inline" for="ApplicationForm_project_investment_1">Small (More than 25 Lakhs &lt; 5 Crore)</label><br><input id="ApplicationForm_project_investment_2" value="medium" type="radio" name="ApplicationForm[project_investment]"> <label style="display:inline" for="ApplicationForm_project_investment_2">Medium (More than 5 Crore &lt; 10 Crore)</label><br><input id="ApplicationForm_project_investment_3" value="large" type="radio" name="ApplicationForm[project_investment]"> <label style="display:inline" for="ApplicationForm_project_investment_3">Large (More than 10 Crore)</label></span>                                        <label for="ApplicationForm[project_investment]" generated="true" class="error"></label>                                
                </div>
            </div>
            <div class="row">
                <label style="padding-left:15px;">Maximum height of proposed building (from Plinth level) : <span>*</span></label>
                <div class="col-md-6">
                    <div class="form-group">
<input placeholder="Format: 1.00 or 1" class="form-control width_50" name="ApplicationForm[building_height]" id="ApplicationForm_building_height" type="text">                    </div>
                </div>
                <div class="col-md-6">
                        <select class="form-control width_50" name="ApplicationForm[building_height_type]" id="ApplicationForm_building_height_type">
<option value=""> -- Select Type -- </option>
<option value="meter">Meter</option>
<option value="foot">Foot</option>
</select>                </div>
            </div>



            <div class="row">
                <label style="display:block;padding-left:15px;">Plot area: <span>*</span></label>
                <div class="col-md-6">
                    <div class="form-group">
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[plot_area]" id="ApplicationForm_plot_area" type="text">                    </div>
                </div>
                <div class="col-md-6">
<select class="form-control" name="ApplicationForm[plot_area_type]" id="ApplicationForm_plot_area_type">
<option value=""> -- Select Type -- </option>
<option value="sqmeter">Square Meter</option>
<option value="sqfoot">Square Foot</option>
<option value="acre">Acre</option>
</select>                </div>
            </div>





            <div class="row">

                <div class="form-group col-md-6">
                    <label style="display:block;">Total Covered Area: <span>*</span></label>
                    <div class="form-group col-md-6" style="padding-left:0;">
                        <input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[total_covered_area]" id="ApplicationForm_total_covered_area" type="text">                    </div>
                    <div class="form-group col-md-6" style="padding-right:0;">
                        <select class="form-control" name="ApplicationForm[total_covered_area_type]" id="ApplicationForm_total_covered_area_type">
<option value=""> -- Select Type -- </option>
<option value="sqmeter">Square Meter</option>
<option value="sqfoot">Square Foot</option>
<option value="acre">Acre</option>
</select>                                            </div>
                </div>

                <div class="form-group col-md-6 ground_floor_wrap">
                    <label style="display:block;">Ground floor Coverd Area: <span>*</span></label>
                    <div id="ground_floor_area_error"></div>
                    <div class="form-group col-md-6" style="padding-left:0;">
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[ground_floor_area]" id="ApplicationForm_ground_floor_area" type="text">                    </div>
                    
                    <div class="form-group col-md-6" style="padding-right:0;">
<select class="form-control" name="ApplicationForm[ground_floor_area_type]" id="ApplicationForm_ground_floor_area_type">
<option value=""> -- Select Type -- </option>
<option value="sqmeter">Square Meter</option>
<option value="sqfoot">Square Foot</option>
<option value="acre">Acre</option>
</select>                    </div>
                </div>
            </div>
            <style>
                .ground_floor_wrap input{width:48%;margin-right:10px;float:left;}
                .ground_floor_wrap select{width:48% !important;float:left;}

            </style>

            <div class="row">
                <div class="form-group col-md-6">
                    <label>No. of Blocks: <span>*</span></label>
<input placeholder="Format: 1" class="form-control" name="ApplicationForm[no_of_blocks]" id="ApplicationForm_no_of_blocks" type="text">                </div>

                <div class="form-group col-md-6 ground_floor_wrap">
                    <label style="display:block;">Height of each Block: <span>*</span></label>
                    <div class="form-group col-md-6" style="padding-left:0;">
                    <input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[height_of_block]" id="ApplicationForm_height_of_block" type="text">                    </div>
                    <div class="form-group col-md-6" style="padding-right:0;">
<select class="form-control" name="ApplicationForm[height_of_block_type]" id="ApplicationForm_height_of_block_type">
<option value=""> -- Select Type -- </option>
<option value="meter">Meter</option>
<option value="foot">Foot</option>
</select>                                        </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Distance between Blocks (mtr): <span>*</span></label>
                    <input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[block_distance]" id="ApplicationForm_block_distance" type="text">                </div>

                <div class="form-group col-md-6">
                    <label>No. of Floors: <span>*</span></label>
                    <input placeholder="Format: 1" class="form-control" name="ApplicationForm[no_of_floor]" id="ApplicationForm_no_of_floor" type="text">                </div>
            </div>

            <div class="row">
                <label>No. of Basement and Covered Area of Each Basement (in Sq mtr): <span>*</span></label>
                <div class="form-group col-md-6">
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[basement_covered_area]" id="ApplicationForm_basement_covered_area" type="text">                </div>
                <div class="form-group col-md-6">
<select class="form-control" name="ApplicationForm[basement_covered_area_type]" id="ApplicationForm_basement_covered_area_type">
<option value=""> -- Select Type -- </option>
<option value="sqmeter">Square Meter</option>
<option value="sqfoot">Square Foot</option>
<option value="acre">Acre</option>
</select>                </div>
            </div>

            <div class="form-group">
                <label>Approach Road (in mtr): <span>*</span></label>
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[approach_road]" id="ApplicationForm_approach_road" type="text">            </div>

            <div class="row">
                <div class="clearfix col-md-12">
                    <label>Set back:</label>
                </div>
                <div class="form-group col-md-6">
                    <label>Front: <span>*</span></label>
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[set_back_front]" id="ApplicationForm_set_back_front" type="text">                </div>
                <div class="form-group col-md-6">
                    <label>Rear: <span>*</span></label>
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[set_back_rear]" id="ApplicationForm_set_back_rear" type="text">                </div>

                <div class="form-group col-md-6">
                    <label>Side 1: <span>*</span></label>
                    <input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[set_back_side1]" id="ApplicationForm_set_back_side1" type="text">                </div>
                <div class="form-group col-md-6">
                    <label>Side 2: <span>*</span></label>
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[set_back_side2]" id="ApplicationForm_set_back_side2" type="text">                </div>
            </div>


            <div class="row">
                <div class="form-group col-md-6">
                    <label>Compartmentation: <span>*</span></label><br>
<input id="ytApplicationForm_compartmentation" type="hidden" value="" name="ApplicationForm[compartmentation]"><span id="ApplicationForm_compartmentation"><input id="ApplicationForm_compartmentation_0" value="yes" type="radio" name="ApplicationForm[compartmentation]"> <label style="display:inline" for="ApplicationForm_compartmentation_0">Yes</label> <input id="ApplicationForm_compartmentation_1" value="no" type="radio" name="ApplicationForm[compartmentation]"> <label style="display:inline" for="ApplicationForm_compartmentation_1">No</label></span>                    <label for="ApplicationForm[compartmentation]" generated="true" class="error"></label>
                </div>

                <div class="form-group col-md-6">
                    <label>Lift with Fire Switch: <span>*</span></label><br>
<input id="ytApplicationForm_fire_switch_lift" type="hidden" value="" name="ApplicationForm[fire_switch_lift]"><span id="ApplicationForm_fire_switch_lift"><input id="ApplicationForm_fire_switch_lift_0" value="yes" type="radio" name="ApplicationForm[fire_switch_lift]"> <label style="display:inline" for="ApplicationForm_fire_switch_lift_0">Yes</label> <input id="ApplicationForm_fire_switch_lift_1" value="no" type="radio" name="ApplicationForm[fire_switch_lift]"> <label style="display:inline" for="ApplicationForm_fire_switch_lift_1">No</label></span>
                    <label for="ApplicationForm[fire_switch_lift]" generated="true" class="error"></label>
                </div>
            </div>

            <div class="row">
                <div class="form-group  col-md-6">
                    <label>Emergency/Optional Source of Electric Supply: <span>*</span></label>
<input placeholder="Alternative Electric Supply" class="form-control" name="ApplicationForm[alternative_electric_supply]" id="ApplicationForm_alternative_electric_supply" type="text">                </div>
                <div class="form-group col-md-6">
                    <label>Exit: <span>*</span></label><br>
<input id="ytApplicationForm_exit_option" type="hidden" value="" name="ApplicationForm[exit_option]"><span id="ApplicationForm_exit_option"><input id="ApplicationForm_exit_option_0" value="yes" type="radio" name="ApplicationForm[exit_option]"> <label style="display:inline" for="ApplicationForm_exit_option_0">Yes</label> <input id="ApplicationForm_exit_option_1" value="no" type="radio" name="ApplicationForm[exit_option]"> <label style="display:inline" for="ApplicationForm_exit_option_1">No</label></span>                    <label for="ApplicationForm[exit_option]" generated="true" class="error"></label>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Provision of no. of Exit in Each Floor: <span>*</span></label>
                    <input placeholder="Format: 1" class="form-control" name="ApplicationForm[no_of_exit_in_floor]" id="ApplicationForm_no_of_exit_in_floor" type="text">                </div>
                <div class="form-group col-md-6">
                    <label>No. of Stairs in Each Block: <span>*</span></label>
<input placeholder="Format: 1" class="form-control" name="ApplicationForm[no_of_stair_in_block]" id="ApplicationForm_no_of_stair_in_block" type="text">                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label>Minimum Width of Stairs: <span>*</span></label>
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[width_of_stair]" id="ApplicationForm_width_of_stair" type="text">                </div>
                <div class="form-group col-md-6">
                    <label>Maximum Travel Distance in Building: <span>*</span></label>
<input placeholder="Format: 1.00 or 1" class="form-control" name="ApplicationForm[travel_distance]" id="ApplicationForm_travel_distance" type="text">                </div>
            </div>

            <div class="form-group">
                <label>Provision of Smoke / Fire check Doors: <span>*</span></label><br>
                    <input id="ytApplicationForm_provision_of_smoke" type="hidden" value="" name="ApplicationForm[provision_of_smoke]"><span id="ApplicationForm_provision_of_smoke"><input id="ApplicationForm_provision_of_smoke_0" value="yes" type="radio" name="ApplicationForm[provision_of_smoke]"> <label style="display:inline" for="ApplicationForm_provision_of_smoke_0">Yes</label> <input id="ApplicationForm_provision_of_smoke_1" value="no" type="radio" name="ApplicationForm[provision_of_smoke]"> <label style="display:inline" for="ApplicationForm_provision_of_smoke_1">No</label></span>                <label for="ApplicationForm[provision_of_smoke]" generated="true" class="error"></label>
            </div>

            <div class="form-group">
                                </div>
            
                <div class="row" id="p_scents">
                    <div id="rmdiv1" class="rmdiv">
                        <div class="form-group col-md-5">
                            <label>Attachment Type: <small style="font-size:78%">(pdf | png | jpg | jpeg | docx)</small><span></span></label>
                            <input placeholder="Attachment type" class="form-control" required="required" name="Attachment[file_text][]" id="Attachment_file_text" type="text">                            <label for="Attachment[file_text][]" generated="true" class="error"></label>
                        </div>
                        <div class="form-group col-md-5">
                            <label>Attachment: <span></span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" readonly="readonly">
                                <br>                                <span class="input-group-btn">
                                    <span class="btn btn-primary btn-file">
                                        Browse… 
                                        <input id="ytAttachment_file_name_0" type="hidden" value="" name="Attachment[file_name][0]"><input class="attachFile" required="required" name="Attachment[file_name][0]" id="Attachment_file_name_0" type="file">                                    </span>
                                </span>
                            </div>
                            <label class="error" for="Attachment_file_name" generated="true" style="display: none;">Field cannot be blank.</label>
                        </div>
                        <div class="col-md-2">
                            <p class="margin0">&nbsp;</p>
                            <input type="button" id="addScnt" value="Add More" name="yt0" class="btn btn-success btn-lg bth45">
                        </div>
                    </div>
                </div>
                        
            
            
            
            

            <div class="form-group form-group-chbox">
                <label>
                    <input type="checkbox" name="ApplicationForm[confirm]" id="ApplicationForm_confirm"> All above said information is correct with the best of my knowledge and belief. <span>*</span>
                </label>
                                <label for="ApplicationForm[confirm]" generated="true" class="error"></label>
            </div>
                            <input class="btn btn-success btn-lg" id="submitAppBtn" type="submit" name="yt1" value="Submit">                            
                
                
            </form>        </div>
    </div>

</div>
</div>
      

 



    </div>
</div>
</div>
@endsection
@section('scripts')
@stop

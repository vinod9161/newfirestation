<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="description" content="Uttrakhand Fire and Emergency Services">
      <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
      <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 

      <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="/assets/css/jquery-ui.css">
      <link href="{{ asset('assets/css/bootstrap-multiselect.min.css')}}" rel="stylesheet">
      <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

      <script src="/assets/js/jquery.min.js"></script>
      <script src="/assets/js/popper.min.js"></script>
      <script src="/assets/js/bootstrap.min.js"></script>
      <script src="/assets/js/slick.js"></script>
      <script src="/assets/js/jquery-ui.js"></script>

    <title>Uttrakhand Fire and Emergency Services</title>

   </head>
   <body>
      <div class="row">
            <div class="col-md-12 col-sm-6 col-xs-12">
               <span style="float:right;">
                  <button id="btnDownload" onclick="CreatePDFfromHTML()">Download</button>

                  <button id="btnprint" onclick="print()">print</button>
               </span>
            </div>
         </div>
      <div class="container">

            <div class="container print" id="print">

            <!-- <div class="row">
               <div class="col-md-4 col-sm-6 col-xs-12">
                  <img class="qdesk-logo-black" src="/assets/images/fire-logo.png" alt="Uttrakhand Fire and Emergency Services" style="max-width:10%;margin-left:10px;">
               </div>
               <div class="col-md-4 col-sm-6 col-xs-12">
                  <h2 style="text-align: center;">उत्तराखंड अग्निशमन एवं आपात सेवाएँ<br>Uttarakhand fire and Emergency Services</h2>
               </div>
            </div> -->

            <div style="width:100%;">
               <div style="width:20%;float:left;">
                  <img class="qdesk-logo-black" src="/assets/images/fire-logo.png" alt="Uttrakhand Fire and Emergency Services" style="max-width:25%;margin-left:10px;">
               </div>
               <div style="width:80%;">
                  <h2 style="text-align:center;">उत्तराखंड अग्निशमन एवं आपात सेवाएँ<br>Uttarakhand fire and Emergency Services</h2>
               </div>
            </div>

            <div style="width:100%;margin-top:30px;">
               <h2 style="text-align:center;">Pre-Establishment NOC पूर्व परिचालन अग्निसुरक्षा प्रमाण पत्र </h2>
            </div>

               <div class="table-responsive">
                  <table class="table" id="house-table" border="1" style="width:100%;border:1px solid black;border-collapse: collapse;">
                     <tbody>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;"  colspan="6">District जनपद</td>
                           <td style="text-align: center;
                              font-size: 14px;"  colspan="6">{{ucfirst($applicationDetail->district->name)}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Issue Reference Number जारी पत्रांक</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{$applicationDetail->application_no}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Issue Date जारी दिनांक</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">&nbsp;</td>
                        </tr>
                        <tr style="background-color:lightgray;">
                           <th colspan="12">Building Details भवन का विवरण</th>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Application Type आवेदन का प्रकार</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{ucwords($applicationDetail->application_type)}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Building Type भवन का प्रकार</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{ucwords($applicationDetail->category->name)}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Name of Owner/Manager स्वामी/प्रबन्धक का नाम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{json_decode($applicationDetail->owner_detail)->salutation}} {{ucfirst(json_decode($applicationDetail->owner_detail)->first_name)}} {{ucfirst(json_decode($applicationDetail->owner_detail)->middle_name)}} {{ucfirst(json_decode($applicationDetail->owner_detail)->last_name)}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Building Name भवन का नाम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ucwords($applicationDetail->building_name)}}</td>
                        </tr>
                        <tr style="line-height: 20px;">
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Building Address भवन का पता</td>
                           @if($applicationDetail->rural_urban=='rural')
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ucfirst($applicationDetail->plot_khasra_khatauni).' : '.$applicationDetail->plot_khasra_khatauni_no .', '.ucfirst($applicationDetail->village).', '.ucfirst($applicationDetail->landmark).', '.ucfirst($applicationDetail->panchayat->name).', '.ucfirst($applicationDetail->block->name).', '.ucfirst($applicationDetail->district->name).', '.ucfirst($applicationDetail->pincode)}}</td>
                           @else
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ucfirst($applicationDetail->plot_khasra_khatauni).' : '.$applicationDetail->plot_khasra_khatauni_no .', '.ucfirst($applicationDetail->street).', '.ucfirst($applicationDetail->village).', '.ucfirst($applicationDetail->landmark).', '.ucfirst($applicationDetail->tehsil->name).', '.ucfirst($applicationDetail->district->name).', '.ucfirst($applicationDetail->pincode)}}</td>
                           @endif
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Type of Construction (New, diversification, compounding,expansion) निर्माण का प्रकार(नया, परिवर्तन, शमन, विस्तार)</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ucfirst($applicationDetail->project_status)}}</td>
                        </tr>
                        <tr>
                           <th colspan="12"  class="text-center" style="background-color:lightgray;">Area Details of Site स्थल का क्षेत्र विवरण</th>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Total Plot Area कुल प्लाट क्षेत्रफल</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{json_decode($applicationDetail->total_plot_area)->total_plot_area." Sqmt"}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Total Covered Area कुल आच्छादित क्षेत्रफल</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3" >{{json_decode($applicationDetail->total_covered_area)->total_covered_area." Sqmt"}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Ground Floor Covered Area भूतल का आच्छादित क्षेत्रफल</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{json_decode($applicationDetail->ground_floor_covered)->ground_floor_covered." Sqmt"}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Basement Covered Area भूमिगत तल का आच्छादित क्षेत्रफल</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{json_decode($applicationDetail->basement_covered_area)->basement_covered_area." Sqmt"}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Maximum height of Building भवन की अधिकतम ऊचाँई</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{json_decode($applicationDetail->max_height_building)->max_height_building}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">No. of Floors तलों की संखया</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{$applicationDetail->no_of_floor}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Height of Each Block प्रत्येक ब्लॉक की ऊचाँई</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{json_decode($applicationDetail->height_of_tallest_block)->height_of_tallest_block}}</td>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">No. of Blocks ब्लॉकों की संख्या</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{$applicationDetail->no_of_blocks}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Approach Road Width पहुँच मार्ग की चौड़ाई</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{json_decode($applicationDetail->approach_road_width)->approach_road_width}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Distance Between Blocks ब्लॉकों के बीच की दूरी</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{json_decode($applicationDetail->min_distance_block)->min_distance_block}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="3">Provision of no. of Exit निकासों की संख्या का प्रावधान</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="3">{{$applicationDetail->provision_no_enterance}}</td>
                        </tr>
                        <tr>
                           <th colspan="12" class="text-center" style="background-color:lightgray;">Set Back Details सैट बैक का विवरण</th>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;"  >Front अग्र</td>
                           <td style="text-align: center;
                              font-size: 14px;" >{{json_decode($applicationDetail->set_back_detail)->front}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" >Rear पृष्ठ</td>
                           <td style="text-align: center;
                              font-size: 14px;" >{{json_decode($applicationDetail->set_back_detail)->rear}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" >Side-1 पार्श्व-1</td>
                           <td style="text-align: center;
                              font-size: 14px;" >{{json_decode($applicationDetail->set_back_detail)->side1}}</td>
                           <td style="padding-left:10px;
                              font-size: 14px;" >Side-2 पार्श्व-2</td>
                           <td style="text-align: center;
                              font-size: 14px;" >{{json_decode($applicationDetail->set_back_detail)->side2}}</td>
                        </tr>
                        <tr>
                           <th colspan="12"  class="text-center" style="background-color:lightgray;">Physical Inspection of Site स्थल का भौतिक निरीक्षण</th>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Does any high tension electric line passing over the site? कया कोई उच्च तनाव बिजली लाइन प्रश्नगत स्थल से गुजर रही है?</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->physical_ins)->line ?? ''}}</td>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">if yes. is it situated on proper safety distance? यदि हाँ, तो यह उचित सुरक्षित दूरी पर स्थत है?</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->physical_ins)->line_status ?? ''}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6" >Does fire fighting vehicle approach to the site? क्या अग्निशमन वाहन प्रश्नगत स्थल तक पहँच सकता है?</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->physical_ins)->vehicle_approach ?? ''}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Does any high inflammable installation situated nearby the building? क्या प्रश्नगत भवन के आस-पास अति ज्वलनशील पदार्थ सथापित है?</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->physical_ins)->inflammable ?? ''}}</td>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Other अन्य विवरण</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->physical_ins)->other ?? ''}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Specific Requirement विशिष्ट आवश्यकताएं</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->physical_ins)->specific ?? ''}}</td>
                        </tr>
                        <tr>
                           <th style="font-size: 14px;background-color:lightgray;" colspan="12"  class="text-center;" >Required fire fighting Provision in Building भवन मे आवशयक अग्निशमन व्यवस्था</th>
                        </tr>
                        <tr>
                           <th  colspan="6" style="background-color:lightgray;">Fire Equipment अग्निशमन उपकरण</th>
                           <th  colspan="6" style="background-color:lightgray;">Details विवरण</th>
                        </tr>

                        @if(isset(json_decode($applicationDetail->fire_provission)->is_under_ground) && json_decode($applicationDetail->fire_provission)->is_under_ground =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Under-ground Static Water Storage Tank भूमिगत स्थैतिक जल संग्रहण टैक</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->is_under_ground ?? ''}}</td>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Capacity (Ltr)*</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->under_ground_storage_capacity ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->is_under_ground_tank) && json_decode($applicationDetail->fire_provission)->is_under_ground_tank =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Pump near underground static water Storage Tank (fire</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">
                              {{ json_decode($applicationDetail->fire_provission)->is_under_ground_tank}}
                           </td>
                        </tr>

                        @if(isset(json_decode($applicationDetail->fire_provission)->type_electric_under_ground_tank))
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Type Electric</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">
                              {{ json_decode($applicationDetail->fire_provission)->type_electric_under_ground_tank}}
                           </td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->type_diesel_under_ground_tank))
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Type Diesel</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">
                              {{ json_decode($applicationDetail->fire_provission)->type_diesel_under_ground_tank}}
                           </td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->type_jockey_under_ground_tank))
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Type Jockey</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">
                              {{ json_decode($applicationDetail->fire_provission)->type_jockey_under_ground_tank}}
                           </td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->electric_ground_tank_capacity))
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Electric Capacity (LPM)*</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">
                              {{ json_decode($applicationDetail->fire_provission)->electric_ground_tank_capacity}}
                           </td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->diesel_ground_tank_capacity))
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Diesel Capacity (LPM)*</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">
                              {{ json_decode($applicationDetail->fire_provission)->diesel_ground_tank_capacity}}
                           </td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->jockey_ground_tank_capacity))
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Jockey Capacity (LPM)*</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">
                              {{ json_decode($applicationDetail->fire_provission)->jockey_ground_tank_capacity}}
                           </td>
                        </tr>
                        @endif

                        @endif

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Pump with minimum Pressure of 3.5 kg/cm² at Remotest Location) भूमिगत स्थैतिक जल भंडारण टैक के पास पम्प (न्यूनतम 3.5 किगा/भार सेमी का दबाब)</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->under_ground_tank ?? ''}}</td>
                        </tr>

                        @if(isset(json_decode($applicationDetail->fire_provission)->yard_hydrant) && json_decode($applicationDetail->fire_provission)->yard_hydrant =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Yard Hydrant फायर हाइड्रेन्ट</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->yard_hydrant ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->fire_cabin) && json_decode($applicationDetail->fire_provission)->fire_cabin =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fire Hose Cabin (delivery hose and branch pipe) फायर केविन</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->fire_cabin ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->wet_riser) && json_decode($applicationDetail->fire_provission)->wet_riser =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">json_decode($applicationDetail->fire_provission)->wet_riserWet Riser वेट राइजर</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->wet_riser ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->is_terrace_tank) && json_decode($applicationDetail->fire_provission)->is_terrace_tank =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Terrace Tank Respective Tower Terrace</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->is_terrace_tank ?? ''}}</td>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Terrace tank capacity of respective tower *</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->terrace_tank ?? ''}}</td>
                        </tr>

                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->is_terrace_pump) && json_decode($applicationDetail->fire_provission)->is_terrace_pump =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Terrace Pump टैरेस पम्प</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->is_terrace_pump ?? ''}}</td>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Terrace pump Capacity (LPM) *</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->terrace_pump_capacity ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->down_comer) && json_decode($applicationDetail->fire_provission)->down_comer =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Down Comer डाउन कमर</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->down_comer ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->first_aid) && json_decode($applicationDetail->fire_provission)->first_aid =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">First Aid Hose Real प्राथमिक होजरील</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->first_aid ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->landing_valve) && json_decode($applicationDetail->fire_provission)->landing_valve =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Landing Valve लैण्डिंग वाल्व</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->landing_valve ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->manual_alarm) && json_decode($applicationDetail->fire_provission)->manual_alarm =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Manually Operated Electronic Fire Alarm System मानव चालित इलैक्ट्रोनिक फायर अलार्म सिस्टम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->manual_alarm ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->automatic_alarm) && json_decode($applicationDetail->fire_provission)->automatic_alarm =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Automatic Detection and Alarm System स्वचालित फायर डिटेक्शन तथा अलार्म सिस्टम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->automatic_alarm ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->automatic_sprinkler) && json_decode($applicationDetail->fire_provission)->automatic_sprinkler !='Not Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Automatic Sprinkler System स्वचालित स्प्रिंकलर व्यवस्था</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->automatic_sprinkler ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->fire_extinguisher) && json_decode($applicationDetail->fire_provission)->fire_extinguisher =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fire Extinguisher फायर एक्सटिंग्यूशर</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->fire_provission)->fire_extinguisher ?? ''}}</td>
                        </tr>
                        @endif


                        <tr style="background-color:lightgray">
                           <th  colspan="6" style="font-weight: 600;">Building Status भवन की स्थ्ति</th>
                           <th  colspan="6" style="font-weight: 600;">Details विवरण</th>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Set Back सैट बैक</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->set_back ?? ''}}</td>
                        </tr>

                        @if(isset(json_decode($applicationDetail->fire_provission)->compartmentation) && json_decode($applicationDetail->fire_provission)->compartmentation =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6"  >Compartmentation कम्पार्टमेन्टेशन</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->compartmentation ?? ''}}</td>
                        </tr>
                        @endif

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6" >Minimum Width of Stairs जीने की चौड़ाई</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->stair_width ?? ''}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">No. of Stairs in Each Block प्रत्येक ब्लॉक में जीने की संख्या</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->stair_in_block ?? ''}}</td>
                        </tr>
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Emergency Exit  आपातकालीन निकास/द्वार</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->emergency_exit ?? ''}}</td>
                        </tr>

                        @if(isset(json_decode($applicationDetail->fire_provission)->fire_switch) && json_decode($applicationDetail->fire_provission)->fire_switch =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fireman switch in lift लिफ्ट में फायर स्विच का प्रावधान</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->fire_switch ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->alt_electric) && json_decode($applicationDetail->fire_provission)->alt_electric =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Alternative Electric Supply वैकल्पिक विधुत व्यवस्था</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->alt_electric ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->emergency_light) && json_decode($applicationDetail->fire_provission)->emergency_light =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Emergency lighting system आपातकालीन विधुत व्यवस्था
                           </td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->emergency_light ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->fluorescent_exit) && json_decode($applicationDetail->fire_provission)->fluorescent_exit =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fluorescent exit sign निकास चिन्ह</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->fluorescent_exit ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->pro_smoke) && json_decode($applicationDetail->fire_provission)->pro_smoke =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Provision of Smoke/Fire check Doors धुआँ/फायर चैक डोर का प्रावधान</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->pro_smoke ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->refuse_area) && json_decode($applicationDetail->fire_provission)->refuse_area =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Refuse area in case of high rise buildings.
                              ऊंची इमारतों के मामले में शरण स्थल का क्षेत्रफल
                           </td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->refuse_area ?? ''}}</td>
                        </tr>
                        @endif

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Maximum Travel Distance in Building </td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->max_travel ?? ''}}</td>
                        </tr>

                        @if(isset(json_decode($applicationDetail->fire_provission)->elec_install) && json_decode($applicationDetail->fire_provission)->elec_install =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Electric Installation(ELCB,MCB)विधुत स्थापन(ईएलसीबी, एमसीबी) </td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->building_status)->elec_install ?? ''}}</td>
                        </tr>
                        @endif

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="12"  style="font-weight:600; background-color: lightgray;" >Special Provision</td>
                        </tr>

                        @if(isset(json_decode($applicationDetail->fire_provission)->smoke_extraction) && json_decode($applicationDetail->fire_provission)->smoke_extraction =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Smoke extraction system धुआँ निकासी प्रणाली</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->smoke_extraction ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->fresh_air) && json_decode($applicationDetail->fire_provission)->fresh_air =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fresh air induction system ताजा हवा प्रेरण प्रणाली</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->fresh_air ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->response_indicator) && json_decode($applicationDetail->fire_provission)->response_indicator =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Response indicator अग्निसूचक</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->response_indicator ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->water_spray) && json_decode($applicationDetail->fire_provission)->water_spray =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Water spray system वाटर स्प्रे सिस्टम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->water_spray ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->foam_spray) && json_decode($applicationDetail->fire_provission)->foam_spray =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Foam spray system फोम स्प्रे सिस्टम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->foam_spray ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->flooding_system) && json_decode($applicationDetail->fire_provission)->flooding_system =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Gas type flooding system सीओटू फ्लोडिंग सिस्टम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->flooding_system ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->fire_cart) && json_decode($applicationDetail->fire_provission)->fire_cart =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fire cart room फायर कार्ट रूम</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->fire_cart ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->beam_detector) && json_decode($applicationDetail->fire_provission)->beam_detector =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Beam detector  बीम डिटेक्टर</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->beam_detector ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->gas_detector) && json_decode($applicationDetail->fire_provission)->gas_detector =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6" >Gas detector गैस डिटेक्टर</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->gas_detector ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->fire_bucket) && json_decode($applicationDetail->fire_provission)->fire_bucket =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fire bucket फायर बकेट</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->fire_bucket ?? ''}}</td>
                        </tr>
                        @endif

                        @if(isset(json_decode($applicationDetail->fire_provission)->trained_staff) && json_decode($applicationDetail->fire_provission)->trained_staff =='Required')
                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Fire safety trained staff अग्निसुक्षा प्रशिक्षित स्टाफ</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->trained_staff ?? ''}}</td>
                        </tr>
                        @endif

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">Other Comment अन्य टिप्पणी</td>
                           <td style="text-align: center;
                              font-size: 14px;" colspan="6">{{ json_decode($applicationDetail->special_provission)->other_comment ?? ''}}</td>
                        </tr>

                        <tr>
                           <td style="padding-left:10px;
                              font-size: 14px;" colspan="6">NOC Validity एनओसी वैधता</td>
                           <td style="text-align: center;font-size: 14px;" colspan="6">

                              @php
                              $validityDate = $applicationDetail->updated_at;
                              $valid_date = strtotime($validityDate);
                              $noc_validity = $applicationDetail->validity;
                              @endphp

                              @if($noc_validity ==3)
                                 @php $exp_date = strtotime('+ 3 year', $valid_date) @endphp
                              @else
                                 @php $exp_date = strtotime('+ 5 year', $valid_date) @endphp
                              @endif

                              From {{date('d-M-Y', strtotime($applicationDetail->updated_at))}} To {{ date('d-M-Y', $exp_date)}}</td>
                        </tr>
                     </tbody>
                  </table>
               </div>
                  <table class="table" id="hou-table" border="1" style="width: 100%; border: 1px solid black;
                     border-collapse: collapse; margin-top: 20px;margin-bottom: 20px;">
                     <tbody>

                        @if($applicationDetail->large_small_category =='1')
                        <tr style="line-height:40px">
                           <td style="padding-left:10px;font-size: 14px;  background-color:lightgray;width: 25%;">* Pre Approver/पूर्व अनुमोदन</td>
                           <td style="text-align: center;font-size: 14px;width: 25%;">{{$dd->name}} </td>
                           <td style="text-align: center;font-size: 14px;width: 25%;"><img src="{{ asset($dd->signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3"/></td>
                           <td style="padding-left:10px;font-size: 14px; background-color:lightgray;width: 25%;">* Date/दिनांक</td>
                           <td style="text-align: center; font-size: 14px;width: 25%;">{{$applicationDetail->updated_at }}</td>
                        </tr>
                        @endif

                        <tr style="line-height:40px">
                           <td style="padding-left:10px;font-size: 14px;  background-color:lightgray;width: 25%;">* Verifier/सत्यापनकर्ता</td>
                           <td style="text-align: center;font-size: 14px;width: 25%;">{{$fso->name}}</td>
                           <td style="text-align: center;font-size: 14px;width: 25%;"><img src="{{ asset($fso->signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3"/></td>
                           <td style="padding-left:10px;font-size: 14px; background-color:lightgray;width: 25%;">* Verified Date/सत्यापन दिनांक</td>
                           <td style="text-align: center; font-size: 14px;width: 25%;">{{$applicationDetail->updated_at }}</td>
                        </tr>

                        <tr style="line-height:40px">
                           <td style="padding-left:10px;font-size: 14px;background-color:lightgray;width: 25%;">* Approver (issuing authority)/अनुमोदनकर्ता (जारीकर्ता अधिकारी)</td>
                           <td style="text-align: center;font-size:14px;width: 25%;">{{$cfo->name}} </td>
                           <td style="text-align: center;font-size:14px;width: 25%;"><img src="{{ asset($cfo->signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3"/> </td>
                           <td style="padding-left:10px;font-size:14px;background-color:lightgray;width: 25%;">* Approved Date/स्वीकृति दिनांक</td>
                           <td style="text-align: center; font-size: 14px;width: 25%;">{{$applicationDetail->updated_at }}</td>
                        </tr>
                     </tbody>
                  </table>
               
               <div class="row" style="margin: 20px">
                  <ol>
                     <li> 
                        Applicant shall take pre operational NOC before occupy (operation) the building.
                        आवेदक को भवन के उपभोग(परिचालन) से पूर्व अन्तिम अनापत्ति प्रमाण पत्र प्राप्त करना होगा।
                     </li>
                     <li> Applicant shall inform fire department in case of change in the map.
                        मानचित्र में परिवर्तन के दशा में आवेदक को अग्निशमन विभाग को सूचित करना होगा।
                     </li>
                     <li> The construction shall not violate the NBC Part-IV norms and state building by-Laws. 
                        निर्माण कार्य में एनबीसी भाग -4 के नियमों और राज्य भवन निर्माण तथा विकास उपविधि का उल्लंघन नहीं करेगा।
                     </li>
                     <li> This certificate shall not valid for illegal construction. 
                        यह प्रमाण पत्र अवैध निर्माण के लिए वैध नहीं होगा।
                     </li>
                  </ol>
               </div>
            </div>
      </div>


<script src="{{ asset('admin/js/jquery-3.4.1.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.2/jQuery.print.min.js"></script>



<script type="text/javascript">
   //Create PDf from HTML...
function CreatePDFfromHTML() {
    var HTML_Width = $(".print").width()/2+50;
    var HTML_Height = $(".print").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".print")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("noc_report.pdf");
      //  $(".print").hide();
    });
}

function print(){
   $.print("#print");
}

</script>
</body>
</html>
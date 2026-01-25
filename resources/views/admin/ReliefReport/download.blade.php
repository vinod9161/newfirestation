<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reief Report Document</title>
    <style>
        @page {
            margin: 0;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            background: #fff !important;
        }

        #content {
            margin: 0 !important;
            padding-top: 0 !important;
            padding-bottom: 0 !important;
        }
    </style>
</head>
<body style="margin:0; padding:0; background:#fff;">

    <div id="content" style="width: 90%;max-width: 800px;background-color: #ffffff;margin: 0px auto;padding: 5px 10px;box-shadow: none;border-bottom:1px solid #000;height:auto;margin-bottom:100px; margin-top:25px !important">
    
        <!-- Header Section -->
        <div style="text-align: center;margin-bottom: 10px;display: flex;">
            <div style="width:20%">
                <img src="{{ asset('/public/admin/images/fire-logo.png') }}" style="width: 110px; height: auto; display: block; margin: 0 auto;">
            </div>
            <div style="width: 60%;">
                <p style="text-align:center; color:#000; margin:0; padding:0; font-family: 'DejaVu Sans', sans-serif; line-height:1.45;">

                    <span style="display:block; font-size:18px; font-weight:700;">
                        उत्तराखण्ड अग्निशमन एवं आपात सेवा
                    </span>

                    <span style="display:block; font-size:15px; font-weight:700; margin-bottom:10px;">
                        Uttarakhand Fire & Emergency Service
                    </span>

                    <span style="display:block; font-size:13px; font-weight:600;">
                        मुख्यालय - चतुर्थ तल, सरदार पटेल भवन
                    </span>
                    <span style="display:block; font-size:13px; font-weight:600; margin-bottom:6px;">
                        कोर्ट रोड, देहरादून, उत्तराखंड – 248001
                    </span>

                    <span style="display:block; font-size:13px; font-weight:600;">
                        Headquarter - IV Floor, Sardar Patel Bhavan
                    </span>
                    <span style="display:block; font-size:13px; font-weight:600;">
                        Court Road, Dehradun, Uttarakhand - 248001
                    </span>
                </p>
            </div>
            <div style="width: 20%;"></div>
        </div>
        <hr>
        <div style="margin-top:20px; display: flex; justify-content: space-between; font-weight: bold; font-size: 10px;">
            <span>(Name of Report) राहत कार्य रिपोर्ट (Relief Work Report)</span>
            <span style="text-align: right; font-weight: bold; font-size: 10px;">Relief Report No. {{ $reliefReport[0]->application_no}}</span>
        </div>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th colspan="4" style="color:#000;color:#000;border: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #cccccc; color: black; font-weight: bold;">Relief Report - General Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">District (जनपद)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">{{ ucfirst($district[0]->name) ?? 'NA' }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Fire Station (फायर स्टेशन)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ ucfirst($station[0]->name)}} ({{ empty($station[0]->firestation_code) ? 'N/A' : ucfirst($station[0]->firestation_code) }})</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Annual Number (वार्षिक संख्या)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{ $reliefReport[0]->relief_report_no }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Monthly Number (मासिक संख्या)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{ $reliefReport[0]->monthly_no }}</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Date and Time of Relief Incident (राहत कार्य का दिनांक एवं समय)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ \Carbon\Carbon::parse($reliefReport[0]->incident_datetime)->format('d-m-Y H:i:s') }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;"></th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;"></td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th colspan="4" style="color:#000;color:#000;border: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #cccccc; color: black; font-weight: bold;">Information Details (सूचना का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Name of Informer (सूचना देने वाले का नाम)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{$reliefReport[0]->informer_name}}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Medium of Information (सूचना का माध्यम)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{$reliefReport[0]->info_medium}}</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Contact Number of Informer (संपर्क नंबर)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{$reliefReport[0]->informer_contact_no}}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Date and Time of Information <br> (सूचना की तिथि एवं समय)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{ \Carbon\Carbon::parse($reliefReport[0]->info_datetime)->format('d-m-Y H:i:s')}}</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Address of Incident Place (घटनास्थल का पता)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{$reliefReport[0]->incident_address}}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;"></th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;"></td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th colspan="4" style="color:#000;color:#000;border: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #cccccc; color: black; font-weight: bold;">Action Details (कार्यवाही का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Departure Time from Fire Station (फायर स्टेशन से प्रस्थान का समय)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ \Carbon\Carbon::parse($reliefReport[0]->station_depart_datetime)->format('d-m-Y H:i:s') }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Return Time to Fire Station (फायर स्टेशन पर वापसी का समय)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ \Carbon\Carbon::parse($reliefReport[0]->station_return_datetime)->format('d-m-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Arrival Time on Incident Place (घटनास्थल पर पहुँचने का समय)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{ \Carbon\Carbon::parse($reliefReport[0]->site_arrive_datetime)->format('d-m-Y H:i:s') }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Distance of Incident Place from Fire Station (फायर स्टेशन से घटनास्थल की दूरी) (in KM)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{$reliefReport[0]->distance}}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th colspan="4" style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #cccccc; color: black; font-weight: bold;">Details of Fire Fighting/Relief Machine used (राहत कार्य हेतु प्रयुक्त अग्निशमन / राहत मशीनों का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 50%; background-color: #f2f2f2;font-size: 10px;">Fighting/Rescue Machine used (प्रयुक्त अग्निशमन / रेस्क्यू मशीन)</th>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 50%; background-color: #f2f2f2;font-size: 10px;">Pumping (पंपिंग विवरण)</th>
                </tr>
                @php $i=0; @endphp
                @foreach($vehicle as $veh)
                <tr>
                    <td style="color:#000;width:50%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $veh['vehicle'] }} {{ $veh['vehicle_type'] }}</td>
                    <td style="color:#000;width:50%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $veh['pumping_km'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <br>
        <br>
        <br>
        <table style="width: 100%; border-collapse: collapse; margin-top: 100px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th colspan="4" style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #cccccc; color: black; font-weight: bold;">Details of Fire & Emergency Service Personnel on Incident Place (घटनास्थल पर अग्निशमन एवं आपात सेवा कर्मियों का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">CFO</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ $cfo }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">FSO</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ $fso }}</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">FSSO</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{ $fsso }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">LFM</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">{{ $lfm }}</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">DVR</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ $dvr }}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">FM</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{ $fm }}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th colspan="4" style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #cccccc; color: black; font-weight: bold;">Relief Operation Details (राहत कार्य का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Name of the owner/Occupier of property (if any) (स्वामी/अधिभोगी का नाम, यदि हो)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{$reliefReport[0]->owner_name}}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Address of the owner/Occupier of property (if any) (स्वामी/अधिभोगी का पता, यदि हो)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{$reliefReport[0]->owner_address}}</td>
                </tr>
                <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Area of Relief work (राहत कार्य का क्षेत्र)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">
                        @if($reliefReport[0]->relief_work_area ==1)
                            @php echo "Rural ग्रामीण" @endphp
                        @else
                            @php echo "City शहरी" @endphp
                        @endif
                    </td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">Type of Relief Work (राहत कार्य का प्रकार)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;font-size: 10px;">
                        @if($reliefReport[0]->relief_work_type ==1)
                        @php echo "Disaster Dewatering आपदा में पानी निकलना" @endphp
                        @elseif($reliefReport[0]->relief_work_type ==2)
                        @php echo "Removing Fallen tree गिरे पेड़ो को हटाना" @endphp
                        @elseif($reliefReport[0]->relief_work_type ==3)
                        @php echo "Clear the passage पेड़ो को हटाकर रास्ता सुचारू करना" @endphp
                        @elseif($reliefReport[0]->relief_work_type ==4)
                        @php echo "Distribution of relief goods राहत सामग्री का वितरण" @endphp
                        @elseif($reliefReport[0]->relief_work_type ==5)
                        @php echo "Organising a public kitchen आम जनता हेतु भोजन प्रबन्धन" @endphp
                        @elseif($reliefReport[0]->relief_work_type ==6)
                        @php echo "Distribution of medicine आवश्यक दवाइयों का वितरण" @endphp
                        @elseif($reliefReport[0]->relief_work_type ==7)
                        @php echo "Counseling of victims घायलों की काउंसलिंग" @endphp
                        @elseif($reliefReport[0]->relief_work_type ==8)
                        @php echo "Safely evacuation of people from denger zone जोन में लोगों को सुरक्षित पार कराना" @endphp
                        @else
                        @php echo "Other अन्य" @endphp
                        @endif
                    </td>
                </tr>
 <tr>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;">Reason of incident (घटना का कारण)</th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;">{{$reliefReport[0]->relief_work_reason}}</td>
                    <th style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%; background-color: #f2f2f2;font-size: 10px;"></th>
                    <td style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 25%;background-color: #f2f2f2;font-size: 10px;"></td>
                </tr>
            </tbody>
        </table>
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th colspan="4" style="color:#000;border: 1px solid #dddddd; padding: 12px; text-align: center; background-color: #cccccc; color: black; font-weight: bold;font-size: 10px;">Description (विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" style="border: 1px solid #dddddd; padding: 12px; text-align: left; vertical-align: middle; width: 100%; background-color: #f2f2f2;font-size: 10px;">{{$reliefReport[0]->description}}</td>
                </tr>
            </tbody>
        </table><br><br>
        <div style="margin-top: 30px; padding: 5px 10px; border: 1px solid #000; text-align: center; font-size: 10px; display: flex; justify-content: space-between; text-align: left;">
            <div style="width: 45%; margin-left:8%;color:#000;">
                <strong>सत्यापनकर्ता अधिकारी (Verification Officer)</strong>
                <p style="color:#000;">
                    अग्निशमन अधिकारी<br>
                    {{ ucfirst($station[0]->name)}}<br>
                    {{ ucfirst($district[0]->name)}}<br>
                    Date and Time of Information (सूचना की तिथि एवं समय) <br> 
                    {{ $reliefReport[0]->info_datetime }}
                </p>
                
            </div>
            <div style="width: 45%; margin-left:22%;color:#000;">
                <strong>अनुमोदनकर्ता अधिकारी (Approval Officer)</strong><br>
                <p style="color:#000;">
                    मुख्य अग्निशमन अधिकारी<br>
                    {{ ucfirst($district[0]->name)}}<br>
                    Approved Date / स्वीकृति दिनांक <br>
                    {{ $reliefReport[0]->approved_date }}
                </p>
            </div>
        </div>
        <div style="margin-top:20px; font-size: 10px; text-align: center; font-style: italic;color:#000;">
            Issue Reference Number जारी पत्रांक : {{ $reliefReport[0]->application_no ?? 'NA' }} <br> Printed Date Time: {{date('Y-m-d H:i:s')}} <br>
            * This report is created and verified by Fire Station Officer {{ ucfirst($station[0]->name)}} {{ ucfirst($district[0]->name)}} and approved by Chief Fire Officer {{ ucfirst($district[0]->name)}}.
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rescue Report Document</title>
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
            <div style="width:60%">
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
            <div style="width:20%"></div>
        </div>
        <hr>

        <!-- Fire Report Header -->
        <div style="display: flex; justify-content: space-between; padding: 10px; font-weight: bold;color:#000;">
            <span>रेस्क्यू रिपोर्ट (Rescue Report)</span>
            <span>Rescue Report No. {{ $rescueReport[0]->application_no }}</span>
        </div>
        <!-- General Detaisl Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Rescue Report - General Details (रेस्क्यू रिपोर्ट सामान्य विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">District <br> (जनपद)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($district[0]->name) ?? 'NA' }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Fire Station <br> (फायर स्टेशन)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($station[0]->name)}} ({{ empty($station[0]->firestation_code) ? 'N/A' : ucfirst($station[0]->firestation_code) }})</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Annual Number <br> (वार्षिक संख्या)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $rescueReport[0]->rescue_report_no }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Monthly Number <br> (मासिक संख्या)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $rescueReport[0]->monthly_no }}</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Date and Time of Rescue Incident <br> (रेस्क्यू की तिथि एवं समय)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ \Carbon\Carbon::parse($rescueReport[0]->rescue_incident_datetime)->format('d-m-Y H:i:s') }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                </tr>
            </tbody>
        </table>

        <!-- Information Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Information Details (सूचना का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Name of Informer <br> (सूचना देने वाले का नाम)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->informer_name}}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Medium of Information <br> (सूचना का माध्यम)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->info_medium}}</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Contact Number of Informer <br> (संपर्क नंबर)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->informer_contact_no}}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Address of Incident Place <br> (घटनास्थल का पता)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->incident_address}}</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Date and Time of Information <br> (सूचना की तिथि एवं समय)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ \Carbon\Carbon::parse($rescueReport[0]->info_datetime)->format('d-m-Y H:i:s')}}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                </tr>
            </tbody>
        </table>
        
        <!-- Action Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Action Details (कार्यवाही का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Departure Time from Fire Station <br> (फायर स्टेशन से प्रस्थान का समय)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ \Carbon\Carbon::parse($rescueReport[0]->station_depart_datetime)->format('d-m-Y H:i:s') }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Arrival Time on Incident Place <br> (घटनास्थल पर पहुँचने का समय)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ \Carbon\Carbon::parse($rescueReport[0]->rescue_site_arrive_datetime)->format('d-m-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Return Time to Fire Station <br> (फायर स्टेशन पर वापसी का समय)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ \Carbon\Carbon::parse($rescueReport[0]->station_return_datetime)->format('d-m-Y H:i:s') }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Distance of Incident Place from Fire Station <br> (फायर स्टेशन से घटनास्थल की दूरी) (in KM)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->distance}}</td>
                </tr>
            </tbody>
        </table>

        <!-- Details of Fire Fighting/Rescue Machine used Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;page-break-after: always;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Details of Fire Fighting/Rescue Machine used <br> (फायर कार्य हेतु प्रयुक्त अग्निशमन /रेस्क्यू मशीन का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;width:50%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Fire/Rescue Machine used <br> (प्रयुक्त अग्निशमन /रेस्क्यू मशीन)</th>
                    <td style="color:#000;width:50%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Pumping <br> (पंपिंग विवरण)</th>
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

        
        <!-- Details of Fire & Emergency Service Personnel on Incident Place Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Details of Fire & Emergency Service Personnel on Incident Place <br> (घटनास्थल पर अग्निशमन एवं आपात सेवा कर्मियों का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">CFO</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $cfo }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">FSO</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $fso }}</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">FSSO</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $fsso }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">LFM</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $lfm }}</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">DVR</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $dvr }}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">FM</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ $fm }}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Fire Incident Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Rescue Operation Details (रेस्क्यू ऑपरेशन का विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Area of Rescue <br> (रेस्क्यू का क्षेत्र)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @if($rescueReport[0]->rescue_area ==1)
                            @php echo "Rural" @endphp
                        @else
                            @php echo "City" @endphp
                        @endif
                    </td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Type of Rescue Area <br> (रेस्क्यू क्षेत्र का प्रकार)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @if($rescueReport[0]->rescue_area_type ==1)
                        @php echo "Disaster आपदा" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==2)
                        @php echo "Earth Quick भूकम्प" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==3)
                        @php echo "Land Slide भूस्खलन" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==4)
                        @php echo "Flood बाढ़" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==5)
                        @php echo "Road Accident सड़क दुर्घटना" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==6)
                        @php echo "Building Collapase भवन धंसना" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==7)
                        @php echo "Gas Leakage गैस लीकेज" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==8)
                        @php echo "Patient मरीज" @endphp
                        @elseif($rescueReport[0]->rescue_area_type ==9)
                        @php echo "Rescue of Animal/Bird पशु पक्षियों का रेस्क्यू" @endphp
                        @else
                        @php echo "Other" @endphp
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Insured <br> (बीमित: Yes या No)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @if($rescueReport[0]->insured ==0)
                            @php echo "Not known" @endphp
                        @elseif($rescueReport[0]->insured ==1)
                            @php echo "No" @endphp
                        @else
                            @php echo "Yes" @endphp
                        @endif 
                    </td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Reason of Rescue <br> (रेस्क्यू संभावित कारण)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->rescue_reason}}</td>
                </tr>
            </tbody>
        </table>

        
        <!-- Loss Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Loss Details (क्षति विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Life Lost Human <br> (मनुष्य मरे)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->life_lost_human}}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Life Saved Human <br> (मनुष्य बचाए)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->life_saved_human}}</td>
                </tr>
                <tr>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Life Lost Animal <br> (पशु मरे)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->life_lost_animal}}</td>
                    <th style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Life Saved Animal <br> (पशु बचाए)</th>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->life_saved_animal}}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Loss Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Description (विवरण)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="4" style="color:#000;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{$rescueReport[0]->short_description}}</td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top: 30px; padding: 5px 10px; border: 1px solid #000; text-align: center; font-size: 10px; display: flex; justify-content: space-between; text-align: left;">
            <div style="width: 45%; margin-left:8%;color:#000;">
                <strong>सत्यापनकर्ता अधिकारी (Verification Officer)</strong>
                <p style="color:#000;">
                    अग्निशमन अधिकारी<br>
                    {{ ucfirst($station[0]->name)}}<br>
                    {{ ucfirst($district[0]->name)}}<br>
                    Date and Time of Information (सूचना की तिथि एवं समय) <br> 
                    {{ $rescueReport[0]->info_datetime }}
                </p>
                
            </div>
            <div style="width: 45%; margin-left:22%;color:#000;">
                <strong>अनुमोदनकर्ता अधिकारी (Approval Officer)</strong><br>
                <p style="color:#000;">
                    मुख्य अग्निशमन अधिकारी<br>
                    {{ ucfirst($district[0]->name)}}<br>
                    Approved Date / स्वीकृति दिनांक <br>
                    {{ $rescueReport[0]->approved_date }}
                </p>
            </div>
        </div>
        <div style="margin-top:20px; font-size: 10px; text-align: center; font-style: italic;color:#000;">
            Issue Reference Number जारी पत्रांक : {{ $rescueReport[0]->application_no ?? 'NA' }} <br> Printed Date Time: {{date('Y-m-d H:i:s')}} <br>
            * This report is created and verified by Fire Station Officer {{ ucfirst($station[0]->name)}} {{ ucfirst($district[0]->name)}} and approved by Chief Fire Officer {{ ucfirst($district[0]->name)}}.
        </div>
    </div>
</body>
</html>

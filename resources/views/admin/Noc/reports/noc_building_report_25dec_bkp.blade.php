<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOC Document</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #000;
        }

        .pdf-wrapper {
            position: relative; /* Needed for absolute watermark */
            background-color: #fff;
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .content {
            position: relative;
            z-index: 1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 5px 10px;
            text-align: left;
            font-size: 12px;
            color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;
        }

        th {
            text-align: center;
            color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;
        }

    </style>

</head>

<body>
    @php
        $nocType = $applicationDetail[0]->application_type ?? '';
        $eType = 'pre establishment noc';
        $ctoType = 'pre operational noc';
        $rType = 'renewal noc';
    @endphp
    <!-- Watermark -->
    <!-- <div class="watermark"></div> -->
    <div id="pdf-content" class="pdf-wrapper">


        <div id="content" style="width: 95%;border: 1px solid #000;;margin: 0px auto;padding: 5px 10px;box-shadow: none;border-bottom:1px solid #000;height:auto;margin-bottom:20px; margin-top:20px;">
           
           
            <!-- Header Section -->
            <div style="text-align: center;margin-bottom: 10px;display: flex;">
                <div style="width:20%">
                    <img src="{{ asset('/public/admin/images/fire-logo.png') }}" style="width: 130px; height: auto; display: block; margin: 0 auto;">
                </div>
                <div style="width:60%;text-align:center;">
                    <p style="line-height:20px; text-align:center;color:#000; font-weight: bold; margin-top:10px;">
                        उत्तराखण्ड अग्निशमन एवं आपात सेवा <br>
                        Uttarakhand Fire & Emergency Service <br>
                        मुख्यालय - चतुर्थ तल, सरदार पटेल भवन <br>
                        कोर्ट रोड, देहरादून, उत्तराखंड - 248001 <br>
                        Headquarter - IV Floor, Sardar Patel Bhavan <br>
                        Court Road, Dehradun, Uttarakhand - 248001 <br>
                    </p>
                    <h6 style="font-size:12px;color:#000;">
                        @if($nocType === 'pre establishment noc')
                            स्थापना पूर्व अनापत्ति प्रमाण पत्र (Pre-Establishment) जारी करने हेतु प्रपत्र
                        @elseif($nocType === 'pre operational noc')
                            पूर्व परिचालन अग्निसुरक्षा प्रमाण पत्र (Pre-Operational NOC)
                        @elseif($nocType === 'renewal noc')
                            नवीकरण प्रमाणपत्र / निर्वाधन प्रमाण पत्र (Renewal / Clearance Certificate)
                        @endif
                    </h6>
                </div>
                <div style="width:20%;text-align:right;margin-top:10px;">
                    <img src="{{ asset('public/qrcodes/' . $applicationDetail[0]->application_qr_code) }}" style="width: 130px; height: auto; display: block;margin: 0 auto;object-position:center;" alt="Application QR Code">
                </div>
            </div>

            <!-- General Detaisl Table -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
                <tbody>
                    <tr>
                        <th style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">District (जनपद) </th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $district[0]->name ?? 'NA' }}</td>
                        <th style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Station</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $station[0]->name ?? 'NA' }}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;white-space: nowrap">Issue Reference Number जारी पत्रांक</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;">{{ $applicationDetail[0]->application_no }}</td>
                        <th style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;">Issue Date जारी दिनांक</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 0.5px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;">{{ \Carbon\Carbon::parse($applicationDetail[0]->updated_at)->format('d:m:Y H:i:s') }}</td>
                    </tr>
                </tbody>
            </table>
            
            <!-- Building Detaisl Table -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 0px; background-color: #ffffff;">
                <thead>
                    <tr>
                        <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; vertical-align: middle;"colspan="4">Building Details भवन का विवरण</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Application Type आवेदन का प्रकार</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ ucwords($applicationDetail[0]->application_no) }}</td>
                        <th style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Building Type भवन का प्रकार</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ucwords($categories->name ?? '')}}</td>
                    </tr>
                    @if($nocType === $ctoType || $nocType === $rType)
                        @php
                            $occupancy = json_decode($applicationDetail[0]->occupancy_detail ?? '', true);
                        @endphp
                        <tr>
                            <th colspan="2" style="width:25%">Occupancy details अधिभोग विवरण </th>
                            <td colspan="2" style="width:25%">{{ $occupancy['value'] ?? '' }}</td>
                        </tr>
                     @endif
                    <tr>
                        <th colspan="2" style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Name of Owner/Manager स्वामी/प्रबन्धक का नाम</th>
                        <td colspan="2" style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->owner_detail)->salutation}} {{ucfirst(json_decode($applicationDetail[0]->owner_detail)->first_name)}} {{ucfirst(json_decode($applicationDetail[0]->owner_detail)->middle_name)}} {{ucfirst(json_decode($applicationDetail[0]->owner_detail)->last_name)}}</td>
                    </tr>
                    <tr>
                        <th colspan="2" style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Building Name भवन का नाम</th>
                        <td colspan="2" style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ucwords($applicationDetail[0]->building_name)}}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Building Address भवन का पता</th>
                        @if($applicationDetail[0]->rural_urban=='rural')
                        <td colspan="3" style="color:#000;width:75%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ucfirst($applicationDetail[0]->plot_khasra_khatauni).' : '.$applicationDetail[0]->plot_khasra_khatauni_no .', '.ucfirst($applicationDetail[0]->village).', '.ucfirst($applicationDetail[0]->landmark).', '.ucfirst($panchayat[0]->name).', '.ucfirst($block[0]->name).', '.ucfirst($district[0]->name).', '.ucfirst($applicationDetail[0]->pincode)}}</td>
                        @else
                        <td colspan="3" style="color:#000;width:75%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ucfirst($applicationDetail[0]->plot_khasra_khatauni).' : '.$applicationDetail[0]->plot_khasra_khatauni_no .', '.ucfirst($applicationDetail[0]->street).', '.ucfirst($applicationDetail[0]->village).', '.ucfirst($applicationDetail[0]->landmark).', '.ucfirst($district[0]->name).', '.ucfirst($applicationDetail[0]->pincode)}}</td>
                        @endif
                    </tr>
                    @if($nocType === $eType)
                        <tr>
                            <th colspan="3" style="color:#000;width:75%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Type of Construction (New, diversification, compounding,expansion) निर्माण का प्रकार(नया, परिवर्तन, शमन, विस्तार)</th>
                            <td style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ucfirst($applicationDetail[0]->project_status)}}</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Area Detaisl Table -->
            <table style="width: 100%; border-collapse: collapse; background-color: #ffffff;">
                <thead>
                    <tr>
                        <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Area Details of Site स्थल का क्षेत्र विवरण</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="color:#000;width:38%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Total Plot Area कुल प्लाट क्षेत्रफल</th>
                        <td style="color:#000;width:12%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->total_plot_area)->total_plot_area." Sqmt"}}</td>
                        <th style="color:#000;width:38%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Total Covered Area कुल आच्छादित क्षेत्रफल</th>
                        <td style="color:#000;width:12%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;"> <?php $TotalCoveredArea = json_decode($applicationDetail[0]->total_covered_area, true); echo $TotalCoveredArea['total_covered_area'] ?? 'NA'; ?> Sqmt</td>
                    </tr>
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Ground Floor Covered Area भूतल का आच्छादित क्षेत्रफल</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->ground_floor_covered)->ground_floor_covered." Sqmt"}}</td>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Basement Covered Area भूमिगत तल का आच्छादित क्षेत्रफल</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->basement_covered_area)->basement_covered_area." Sqmt"}}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Maximum height of Building भवन की अधिकतम ऊचाँई</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->max_height_building)->max_height_building}}</td>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">No. of Floors तलों की संख्या</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{$applicationDetail[0]->no_of_floor}}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Height of Each Block प्रत्येक ब्लॉक की ऊचाँई</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->height_of_tallest_block)->height_of_tallest_block}}</td>
                        <td colspan="2" style="border: 1px solid #dddddd"></td>
                    </tr>

                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">No. of Blocks ब्लॉकों की संख्या</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{$applicationDetail[0]->no_of_blocks}}</td>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Approach Road Width पहुँच मार्ग की चौड़ाई</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->approach_road_width)->approach_road_width}}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Distance Between Blocks ब्लॉकों के बीच की दूरी</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->min_distance_block)->min_distance_block}}</td>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Provision of no. of Exit निकासों की संख्या का प्रावधान</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{$applicationDetail[0]->provision_no_enterance}}</td>
                    </tr>
                </tbody>
            </table>

            <!-- Set Back Detaisl Table -->
            @if($nocType === $ctoType || $nocType === $eType)
            <table style="width: 100%; border-collapse: collapse; background-color: #ffffff;">
                <thead>
                    <tr>
                        <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="8">Set Back Details सैट बैक का विवरण</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Front अग्र</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->set_back_detail)->front}}</td>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Rear पृष्ठ</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->set_back_detail)->rear}}</td>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Side-1 पार्श्व-1</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->set_back_detail)->side1}}</td>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Side-2 पार्श्व-2</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{json_decode($applicationDetail[0]->set_back_detail)->side2}}</td>
                    </tr>
                </tbody>
            </table>
            @endif

            <!-- Physical Inspection Detaisl Table -->
            @if($nocType === $ctoType || $nocType === $eType)
            <table style="width: 100%; border-collapse: collapse; background-color: #ffffff;">
                <thead>
                    <tr>
                        <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="8">Physical Inspection of Site स्थल का भौतिक निरीक्षण</th>
                    </tr>
                </thead>
                <tbody>
                    @if($nocType === $ctoType || $nocType === $eType)
                    <tr>
                        <th colspan="3" style="color:#000;width:75%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Does any high tension electric line passing over the site? क्या कोई उच्च तनाव बिजली लाइन प्रश्नगत स्थल से गुजर रही है?</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->physical_ins)->line ?? ''}}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="color:#000;width:75%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">if yes. is it situated on proper safety distance? यदि हाँ, तो यह उचित सुरक्षित दूरी पर स्थत है?</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->physical_ins)->line_status ?? ''}}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="color:#000;width:75%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Does fire fighting vehicle approach to the site? क्या अग्निशमन वाहन प्रश्नगत स्थल तक पहँच सकता है?</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->physical_ins)->vehicle_approach ?? ''}}</td>
                    </tr>
                    <tr>
                        <th colspan="3" style="color:#000;width:75%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Does any high inflammable installation situated nearby the building? क्या प्रश्नगत भवन के आस-पास अति ज्वलनशील पदार्थ स्थापित है?</th>
                        <td style="color:#000;width:25%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->physical_ins)->inflammable ?? ''}}</td>
                    </tr>

                    <tr>
                        <th colspan="2" style="color:#000;width:50%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Other अन्य विवरण</th>
                        <td colspan="2" style="color:#000;width:50%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->physical_ins)->other ?? ''}}</td>
                    </tr>
                    @endif
                    @if($nocType === $eType)
                    <tr>
                        <th colspan="2" style="color:#000;width:50%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Specific Requirement विशिष्ट आवश्यकताएं</th>
                        <td colspan="2" style="color:#000;width:50%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->physical_ins)->specific ?? ''}}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            @endif
            
            <!-- Required fire fighting Provision Detaisl Table -->
            
            <table style="width: 100%; border-collapse: collapse; margin-top: 0px; background-color: #ffffff;">
                <thead>
                    <tr>
                        <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="8">
                        @if($nocType === $eType)    
                            Required fire fighting Provision in Building भवन मे आवश्यक अग्निशमन व्यवस्था
                        @else
                            Provided fire fighting Provision in Building भवन में प्राविधानित अग्नि सुरक्षा व्यवस्था
                        @endif
                        </th>
                    </tr>
                </thead>
            </table>
            

            
            <!-- Fire Equipment Detaisl Table -->
            <table style="width: 100%; border-collapse: collapse; margin-top: 0px; background-color: #ffffff;">
                <thead>
                    <tr>
                        <th style="width:70%;color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;" >Fire Equipment अग्निशमन उपकरण</th>
                        <th style="width:30%;color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;" >Details विवरण</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $fire = json_decode($applicationDetail[0]->fire_provission ?? '', true);
                    @endphp
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Under-ground Static Water Storage Tank भूमिगत स्थैतिक जल संग्रहण टैंक</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['is_under_ground'] }}</td>
                    </tr>
                    
                    @if(in_array($fire['is_under_ground'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Capacity (Ltr)</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['under_ground_storage_capacity'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['is_under_ground_tank'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Pump near underground static water Storage Tank (fire</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ $fire['is_under_ground_tank'] }}
                        </td>
                    </tr>

                    @if(in_array($fire['type_electric_under_ground_tank'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Type Electric</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ $fire['type_electric_under_ground_tank'] }}
                        </td>
                    </tr>
                    @endif

                    @if(in_array($fire['type_diesel_under_ground_tank'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Type Diesel</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ $fire['type_diesel_under_ground_tank'] }}
                        </td>
                    </tr>
                    @endif

                    @if(in_array($fire['type_jockey_under_ground_tank'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Type Jockey</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ $fire['type_jockey_under_ground_tank'] }}
                        </td>
                    </tr>
                    @endif

                    @if(in_array($fire['electric_ground_tank_capacity'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Electric Capacity (LPM)</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ $fire['electric_ground_tank_capacity'] }}
                        </td>
                    </tr>
                    @endif

                    @if(in_array($fire['diesel_ground_tank_capacity'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Diesel Capacity (LPM)</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ $fire['diesel_ground_tank_capacity'] }}
                        </td>
                    </tr>
                    @endif

                    @if(in_array($fire['jockey_ground_tank_capacity'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Jockey Capacity (LPM)</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ $fire['jockey_ground_tank_capacity'] }}
                        </td>
                    </tr>
                    @endif
                    @endif
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Pump with minimum Pressure of 3.5 kg/cm² at Remotest Location) भूमिगत स्थैतिक जल भंडारण टैंक के पास पम्प (न्यूनतम 3.5 किग्रा/भार सेमी का दबाब)</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['under_ground_tank'] ?? '' }}</td>
                    </tr>

                    @if(in_array($fire['yard_hydrant'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Yard Hydrant फायर हाइड्रेन्ट</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['yard_hydrant'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['fire_cabin'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fire Hose Cabin (delivery hose and branch pipe) फायर केविन</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['fire_cabin'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['wet_riser'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Wet Riser वेट राइजर</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['wet_riser']}}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['is_terrace_tank'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Terrace Tank Respective Tower Terrace</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['is_terrace_tank'] }}</td>
                    </tr>

                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Terrace tank capacity of respective tower</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['terrace_tank'] }}</td>
                    </tr>

                    @endif

                    @if(in_array($fire['is_terrace_pump'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Terrace Pump टैरेस पम्प</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['is_terrace_pump'] }}</td>
                    </tr>

                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Terrace pump Capacity (LPM)</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['terrace_pump_capacity'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['down_comer'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Down Comer डाउन कमर</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['down_comer'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['first_aid'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">First Aid Hose Real प्राथमिक होजरील</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['first_aid'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['landing_valve'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th  style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Landing Valve लैण्डिंग वाल्व</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['landing_valve'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['manual_alarm'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Manually Operated Electronic Fire Alarm System मानव चालित इलैक्ट्रोनिक फायर अलार्म सिस्टम</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['manual_alarm'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['automatic_alarm'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Automatic Detection and Alarm System स्वचालित फायर डिटेक्शन तथा अलार्म सिस्टम</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['automatic_alarm'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['automatic_sprinkler'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Automatic Sprinkler System स्वचालित स्प्रिंकलर व्यवस्था</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['automatic_sprinkler'] }}</td>
                    </tr>
                    @endif

                    @if(in_array($fire['fire_extinguisher'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fire Extinguisher फायर एक्सटिंग्यूशर</th>
                        <td style="color:#000;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $fire['fire_extinguisher'] }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>


            
            <!-- Physical Inspection Detaisl Table -->
            <table style="width: 100%; border-collapse: collapse; background-color: #ffffff;">
                <thead>
                    <tr>
                        <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;">Building Status भवन की स्थिति</th>
                        <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 5px 10px; text-align: left; vertical-align: middle;text-align:center;">Details विवरण</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $building = json_decode($applicationDetail[0]->building_status ?? '', true);
                    @endphp
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Does any high tension electric line passing over the site? क्या कोई उच्च तनाव बिजली लाइन प्रश्नगत स्थल से गुजर रही है?</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->physical_ins)->line ?? ''}}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Set Back सैट बैक</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ json_decode($applicationDetail[0]->building_status)->set_back ?? ''}}</td>
                    </tr>

                    @if(in_array($building['compartmentation'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Compartmentation कम्पार्टमेन्टेशन</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['compartmentation'] ?? '' }}</td>
                    </tr>
                    @endif

                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Minimum Width of Stairs जीने की चौड़ाई</th>
                        <td  style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['stair_width'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">No. of Stairs in Each Block प्रत्येक ब्लॉक में जीने की संख्या</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['stair_in_block'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Emergency Exit आपातकालीन निकास/द्वार</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['emergency_exit'] ?? '' }}</td>
                    </tr>

                    @if(in_array($building['fire_switch'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fireman switch in lift लिफ्ट में फायर स्विच का प्रावधान</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['fire_switch'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($building['alt_electric'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Alternative Electric Supply वैकल्पिक विद्युतव्यवस्था</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['alt_electric'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($building['emergency_light'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Emergency lighting system आपातकालीन विद्युतव्यवस्था
                        </th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['emergency_light'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($building['fluorescent_exit'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fluorescent exit sign निकास चिन्ह</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['fluorescent_exit'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($building['pro_smoke'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Provision of Smoke/Fire check Doors धुआँ/फायर चैक डोर का प्रावधान</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['pro_smoke'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($building['refuse_area'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Refuse area in case of high rise buildings.
                        ऊंची इमारतों के मामले में शरण स्थल का क्षेत्रफल
                        </th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['refuse_area'] ?? ''}}</td>
                    </tr>
                    @endif

                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Maximum Travel Distance in Building </th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['max_travel'] ?? ''}}</td>
                    </tr>

                    @if(in_array($building['elec_install'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Electric Installation(ELCB,MCB)विद्युतस्थापन(ईएलसीबी, एमसीबी) </th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $building['elec_install'] ?? ''}}</td>
                    </tr>
                    @endif
                    <tr>
                        <th colspan="2"  style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Special Provision</th>
                    </tr>
                    @php
                        $special_provission = json_decode($applicationDetail[0]->special_provission ?? '', true);
                    @endphp

                    @if(in_array($special_provission['smoke_extraction'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Smoke extraction system धुआँ निकासी प्रणाली</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['smoke_extraction'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['fresh_air'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fresh air induction system ताज़ा हवा प्रेरण प्रणाली</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['fresh_air'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['response_indicator'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Response indicator अग्निसूचक</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['response_indicator'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['water_spray'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Water spray system वाटर स्प्रे सिस्टम</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['water_spray'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['foam_spray'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Foam spray system फोम स्प्रे सिस्टम</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['foam_spray'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['flooding_system'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Gas type flooding system सीओटू फ्लोडिंग सिस्टम</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['flooding_system'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['fire_cart'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fire cart room फायर कार्ट रूम</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['fire_cart'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['beam_detector'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Beam detector बीम डिटेक्टर</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['beam_detector'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['gas_detector'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Gas detector गैस डिटेक्टर</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['gas_detector'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['fire_bucket'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fire bucket फायर बकेट</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['fire_bucket'] ?? ''}}</td>
                    </tr>
                    @endif

                    @if(in_array($special_provission['trained_staff'] ?? '', ['Required', 'Provided']))
                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Fire safety trained staff अग्निसुरक्षा प्रशिक्षित स्टाफ</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['trained_staff'] ?? ''}}</td>
                    </tr>
                    @endif

                    <tr>
                        <th style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">Other Comment अन्य टिप्पणी</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">{{ $special_provission['other_comment'] ?? ''}}</td>
                    </tr>

                    <tr>
                        <th  style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">NOC Validity एनओसी वैधता</th>
                        <td style="color:#000;width:12.5%;font-size: 12px;border: 1px solid #dddddd;padding: 5px 10px;text-align: left;vertical-align: middle;color: #000;">

                        @php
                        $validityDate = $applicationDetail[0]->updated_at;
                        $valid_date = strtotime($validityDate);
                        $noc_validity = $applicationDetail[0]->validity;
                        @endphp

                        @if($noc_validity ==3)
                        @php $exp_date = strtotime('+ 3 year', $valid_date) @endphp
                        @else
                        @php $exp_date = strtotime('+ 5 year', $valid_date) @endphp
                        @endif

                        From {{date('d-M-Y', strtotime($applicationDetail[0]->updated_at))}} To {{ date('d-M-Y', $exp_date)}}</td>
                    </tr>
                </tbody>
            </table>
            @php
                $nocType = $applicationDetail[0]->application_type ?? '';

                $isE   = $nocType === 'pre establishment noc';   // E
                $isCTO = $nocType === 'pre operational noc';     // CTO
                $isR   = $nocType === 'renewal noc';             // R
            @endphp
            <div style="justify-content: space-between; padding: 5px 10px; margin-top: 10px;">
                <h6>Required Provision / Conditions</h6>
                <style>
                    ol li{
                        font-size:12px; 
                        line-height:20px;
                        color:#000;
                    }
                </style>
                @if($isCTO || $isR)
                <ol style="margin-left:-20px;">
                    <li>
                        @if($isCTO)
                            The renewal/clearance certificate shall be obtained periodically as per rules defined for validity of NOC by Applicant.
                            नवीकरण / निर्वाधन प्रमाण पत्र आवेदक द्वारा NOC की वैधता हेतु निर्धारित नियमों के अनुसार समय-समय पर प्राप्त किया जाएगा।
                        @else
                            The certificate shall be obtained periodically as per rules defined for validity of NOC by Applicant. 
                            यह प्रमाणपत्र आवेदक द्वारा NOC की वैधता के लिए निर्धारित नियमों के निर्धारित समय पर प्राप्त किया जाएगा।
                        @endif
                    </li>

                    <li>
                        Applicant shall inform fire department in case of change in the building.
                        भवन में बदलाव के मामले में आवेदक अग्निशमन विभाग को सूचित करेगा।
                    </li>

                    <li>
                        In case of expansion/additional construction in the building, fire fighting arrangements shall be separately.
                        भवन में विस्तार / अतिरिक्त निर्माण के मामले में, अग्निशमन व्यवस्था अलग से होगी।
                    </li>

                    <li>
                        This certificate shall not used for illegal construction validation.
                        यह प्रमाण पत्र अवैध निर्माण सत्यापन के लिए उपयोग नहीं किया जाएगा।
                    </li>

                    <li>
                        The applicant shall adhere instruction given by Fire Departments.
                        आवेदक को अग्निशमन विभागों द्वारा दिए गए निर्देशों का पालन करना होगा।
                    </li>

                    <li>
                        The set back and emergency exit shall be unobstructed every time.
                        सेट बैक और आपातकालीन निकास हर समय अवरोधमुक्त रखा जाए।
                    </li>

                    <li>
                        In case of high rise building/multiplex/industrial building/hospital fire drill shall be conducted every year.
                        उच्च वृद्धि भवन / मल्टीप्लेक्स / औद्योगिक भवन / अस्पताल में हर साल अग्निशमन अभ्यास किया जाएगा।
                    </li>

                    <li>
                        The applicant shall not violate the National Building Code of India Part-IV and state building bye-laws.
                        आवेदक भारत के राष्ट्रीय भवन संहिता भाग-4 एवं राज्य भवन निर्माण एवं विकास उपविधियों का उल्लंघन नहीं करेगा।
                    </li>

                    <li>
                        Applicant shall maintain the working condition of fire equipment’s.
                        आवेदक अग्निशमन उपकरणों की कार्यशील स्थिति को बनाए रखेगा।
                    </li>

                    <li>
                        Applicant shall use the building as per the occupancy declared by him.
                        आवेदक द्वारा घोषित अधिभोग के अनुसार ही भवन का उपयोग किया जाएगा।
                    </li>

                    <li>
                        In case of violation of above conditions this certificate may be cancelled.
                        उल्लंघन के मामले में यह प्रमाण पत्र रद्द किया जा सकता है।
                    </li>
                </ol>
                @endif
            

                @if($isE)
                
                <ol style="margin-left:-20px;">
                    <li>
                        Applicant shall take Pre-Operational NOC before occupied (operation) the building.
                        आवेदक को भवन के उपभोग (परिचालन) से पूर्व अन्तिम अनापत्ति प्रमाण पत्र प्राप्त करना होगा।
                    </li>

                    <li>
                        Applicant shall inform fire department in case of change in the map.
                        मानचित्र में परिवर्तन के दशा में आवेदक को अग्निशमन विभाग को सूचित करना होगा।
                    </li>

                    <li>
                        The construction shall not violate the NBC Part-IV norms or state building bye-Laws.
                        निर्माण कार्य में एनबीसी भाग-4 अथवा राज्य भवन उपविधियों का उल्लंघन नहीं करेगा।
                    </li>

                    <li>
                        This certificate shall not valid for illegal construction.
                        यह प्रमाण पत्र अवैध निर्माण के लिए वैध नहीं होगा।
                    </li>

                    <li>
                        Applicant shall use the building as per the occupancy declared by him.
                        आवेदक द्वारा घोषित अधिभोग के अनुसार ही भवन का उपयोग किया जाएगा।
                    </li>

                    <li>
                        In case of violation of above conditions this certificate may be cancelled.
                        उल्लंघन के मामले में यह प्रमाण पत्र रद्द किया जा सकता है।
                    </li>

                    <li>
                        On furnishing any kind of false information by the applicant, this certificate shall be deemed to stand automatically cancelled.
                        आवेदक द्वारा किसी प्रकार की गलत सूचना देने पर यह प्रमाण पत्र स्वतः ही निरस्त माना जायेगा।
                    </li>
                </ol>
            
                @endif
            </div>


            @if($applicationDetail[0]->status=='approved')
                @php
                $reasonMap = [

                    'reason1' => [
                        'en' => 'Applicant shall take pre operational NOC before occupied (operation) the building.',
                        'hi' => 'आवेदक को भवन के उपभोग(परिचालन) से पूर्व अन्तिम अनापत्ति प्रमाण पत्र प्राप्त करना होगा।'
                    ],

                    'reason2' => [
                        'en' => 'Applicant shall inform the fire department in case of any map/building plan modification.',
                        'hi' => 'मानचित्र में परिवर्तन के दशा में आवेदक को अग्निशमन विभाग को सूचित करना होगा।'
                    ],

                    'reason3' => [
                        'en' => 'Construction work must not violate NBC Part-4 rules and State Building Construction & Development By-Laws.',
                        'hi' => 'निर्माण कार्य में एनबीसी भाग -4 के नियमों और राज्य भवन निर्माण तथा विकास उपविधि का उल्लंघन नहीं करेगा।'
                    ],

                    'reason4' => [
                        'en' => 'This certificate shall not be valid for any unauthorized construction.',
                        'hi' => 'यह प्रमाण पत्र अवैध निर्माण के लिए वैध नहीं होगा।'
                    ],

                    'reason5' => [
                        'en' => 'Applicant shall submit half-yearly self-declaration that fire safety arrangements are satisfactory & functional.',
                        'hi' => 'आवेदक को प्रत्येक छमाही में अग्निशमन सुरक्षा व्यवस्था सन्तोषजनक एवं कार्यशील होने का स्व घोषणा पत्र देना होगा।'
                    ],
                ];
                @endphp
                @php
                $mergedReasons = [];   // final combined list


                function addReasonFinal(&$mergedReasons, $dbEnglishText, $reasonKey, $reasonMap){
                    if(!empty($dbEnglishText) && isset($reasonMap[$reasonKey])){
                        $mergedReasons[] =
                            trim($dbEnglishText) . ' ' .
                            $reasonMap[$reasonKey]['hi'];   // only Hindi from map
                    }
                }

                function addCustomRemark(&$mergedReasons, $text){
                    if(!empty(trim($text))){
                        $mergedReasons[] = trim($text);   // REMARK only, no Hindi mapping
                    }
                }

                if(!empty($applicationDetail[0]->remark_by_cfo)){
                    foreach(json_decode($applicationDetail[0]->remark_by_cfo) as $item){

                        $r = json_decode($item->reason);

                        if(!empty($r->reason1)) addReasonFinal($mergedReasons, $r->reason1, 'reason1', $reasonMap);
                        if(!empty($r->reason2)) addReasonFinal($mergedReasons, $r->reason2, 'reason2', $reasonMap);
                        if(!empty($r->reason3)) addReasonFinal($mergedReasons, $r->reason3, 'reason3', $reasonMap);
                        if(!empty($r->reason4)) addReasonFinal($mergedReasons, $r->reason4, 'reason4', $reasonMap);
                        if(!empty($r->reason5)) addReasonFinal($mergedReasons, $r->reason5, 'reason5', $reasonMap);

                        addCustomRemark($mergedReasons, $item->remark ?? '');
                    }
                }

                if(!empty($applicationDetail[0]->remark_by_fso)){
                    foreach(json_decode($applicationDetail[0]->remark_by_fso) as $item){

                        $r = json_decode($item->reason);

                        if(!empty($r->reason1)) addReasonFinal($mergedReasons, $r->reason1, 'reason1', $reasonMap);
                        if(!empty($r->reason2)) addReasonFinal($mergedReasons, $r->reason2, 'reason2', $reasonMap);
                        if(!empty($r->reason3)) addReasonFinal($mergedReasons, $r->reason3, 'reason3', $reasonMap);
                        if(!empty($r->reason4)) addReasonFinal($mergedReasons, $r->reason4, 'reason4', $reasonMap);
                        if(!empty($r->reason5)) addReasonFinal($mergedReasons, $r->reason5, 'reason5', $reasonMap);

                        addCustomRemark($mergedReasons, $item->remark ?? '');
                    }
                }


                $mergedReasons = array_unique($mergedReasons);
                @endphp
                @if(count($mergedReasons) > 0)
                <div style="justify-content: space-between; padding: 5px 10px; margin-top: 10px;">
                    <h6>Required Provision</h6>
                    <ol style="margin-left:-20px;">
                        @foreach($mergedReasons as $line)
                            <li style="font-size:10px; line-height:15px;">{{ $line }}</li>
                        @endforeach
                    </ol>
                </div>
                @endif


            @endif
            <div style="margin-top: 20px; padding: 5px 10px; border: 1px solid #000; text-align: center; font-size: 12px; display: flex; justify-content: space-between; text-align: left;">
                @if(isset($applicationDetail) && $applicationDetail[0]->dd_name!='')
                <div style="width: 33.333%; margin-left:8%;color:#000;">
                    <strong>Pre Approver/पूर्व अनुमोदन</strong>
                    <p style="color:#000;">
                    <img src="{{ asset($applicationDetail[0]->dd_signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3" />
                            <br>
                            {{$applicationDetail[0]->dd_name}}
                            <br>
                            {{$applicationDetail[0]->dd_designation}}
                            <br>
                            {{ ucfirst($district[0]->name)}}
                            <br>
                            Approved Date / स्वीकृति दिनांक <br> {{$applicationDetail[0]->dd_approve_date }}
                    </p>
                </div>
                @endif
                @if(isset($applicationDetail) && $applicationDetail[0]->fso_name!='')
                <div style="width: 33.333%; margin-left:8%;color:#000;">
                    <strong>Verifier/सत्यापनकर्ता</strong>
                    <p style="color:#000;">
                        <img src="{{ asset($applicationDetail[0]->fso_signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3" />
                            <br>
                            {{$applicationDetail[0]->fso_name}}
                            <br>
                            {{$applicationDetail[0]->fso_designation}}
                            <br>
                            {{ ucfirst($district[0]->name)}}
                            <br>
                            Approved Date / स्वीकृति दिनांक <br> {{$applicationDetail[0]->fso_approve_date }}
                    </p>
                </div>
                @endif
                <div style="width: 33.333%; margin-left:22%;color:#000;">
                    <strong>Approver (issuing authority)/अनुमोदनकर्ता (जारीकर्ता अधिकारी)</strong><br>
                    <p style="color:#000;">
                        <img src="{{ asset($applicationDetail[0]->cfo_signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3" />
                        <br>
                        {{$applicationDetail[0]->cfo_name}}
                        <br>
                        {{$applicationDetail[0]->cfo_designation}}
                        <br>
                        {{ ucfirst($district[0]->name)}}
                        <br>
                        Approved Date / स्वीकृति दिनांक <br> {{$applicationDetail[0]->cfo_approve_date }}
                    </p>
                </div>
            </div>
            <div style="margin-top:20px; font-size: 12px; text-align: center; font-style: italic;color:#000;">
                Issue Reference Number जारी पत्रांक : {{ $applicationDetail[0]->application_no ?? 'NA' }} <br> Printed Date Time: {{date('Y-m-d H:i:s')}} <br>
				"यह अग्नि सुरक्षा  प्रमाण पत्र https://fireservice.uk.gov.in के 'NOC Validation' अनुभाग में ऑनलाइन प्रमाणिकता जाँची जा सकती है।" ("This Fire Safety NOC can be verified online through the 'NOC Validation' section on https://fireservice.uk.gov.in.")
            </div>
        </div>
		<div style="text-align: center;"><button onclick="printDiv('content')">Print</button></div>
		
    </div>
	
	
	

<!--script>
function printDiv(divId) {
  var printContents = document.getElementById(divId).innerHTML;
  var originalContents = document.body.innerHTML;

  document.body.innerHTML = printContents;
  window.print();
  document.body.innerHTML = originalContents;
}
</script-->	


<!--script>
function printDiv(divId) {
  const divContents = document.getElementById(divId).innerHTML;
  const myWindow = window.open('', '', '');

  myWindow.document.write('<html><head><title>Print</title>');
  myWindow.document.write('</head><body>');
  myWindow.document.write('<div id="printable">' + divContents + '</div>');
  myWindow.document.write('</body></html>');

  myWindow.document.close();
  myWindow.focus();
  myWindow.print();
  myWindow.close();
}
</script-->


<script>
function printDiv(divId) {
  var divContents = document.getElementById(divId).outerHTML;
  var myWindow = window.open('', '', 'height=600,width=800');

  myWindow.document.write('<html><head><title>Print</title></head><body>');
  myWindow.document.write(divContents);
  myWindow.document.write('</body></html>');

  myWindow.document.close();
  myWindow.focus();
  myWindow.print();
  myWindow.close();
}
</script>
	
	
</body>
</html>

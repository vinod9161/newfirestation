<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Report Document</title>
</head>

<body  style="margin: 0px auto;padding: 0;background-color: #000;">

    <div id="content" style="width: 90%;max-width: 800px;border: 1px solid #000;background-color: #ffffff;margin: 0px auto;padding: 10px;box-shadow: none;border-bottom:1px solid #000;height:auto;margin-bottom:100px; margin-top:10px;">
        <!-- Header Section -->
        <div style="text-align: center;margin-bottom: 10px;display: flex;">
            <div style="width:20%">
                <img src="{{ asset('/public/admin/images/fire-logo.png') }}" style="width: 70px; height: auto; display: block; margin: 0 auto;">
            </div>
            <div style="width:60%">
            <p style="line-height:22px; text-align:center;color:#000;font-size:22px;">
                    <b>उत्तराखण्ड अग्निशमन एवं आपात सेवा <br>
                    Uttarakhand Fire & Emergency Service <br></b>
                </p>
            </div>
            <div style="width:20%"></div>
        </div>
        <hr>

        <!-- Fire Report Header -->
        <div style="display: flex; justify-content: space-between; padding: 10px; font-weight: bold;">
            <span>Temporary Noc - {{ ucwords($applicationDetail[0]->noc_type) }} </span>
            <span>Application No. - {{ ucwords($applicationDetail[0]->application_no) }} </span>
        </div>
        <!-- General Detaisl Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Basic Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;color: #000;">Applicant Tpe</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;color: #000;">{{ ucfirst($applicationDetail[0]->applicant_type) ?? N/A }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;color: #000;">Applicant Detail</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;color: #000;">
                        {{ json_decode($applicationDetail[0]->applicant_detail)->salutation ?? '' }}
                        {{ json_decode($applicationDetail[0]->applicant_detail)->first_name ?? '' }} 
                        {{ json_decode($applicationDetail[0]->applicant_detail)->middle_name ?? '' }}
                        {{ json_decode($applicationDetail[0]->applicant_detail)->last_name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Email Address</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ json_decode($applicationDetail[0]->applicant_detail)->email ?? 'N/A' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Mobile No.</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ json_decode($applicationDetail[0]->applicant_detail)->mobile_no ?? 'N/A' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Information Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Address of Applicant</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $applicantAddress = json_decode($applicationDetail[0]->applicant_address);
                @endphp
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">District</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @foreach($districts as $key => $dist)
                        @if($dist->id == $applicantAddress->district_id)
                        {{ $dist->name }}
                        @endif
                        @endforeach
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Urban / Rural</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->rural_urban) ?? '' }}</td>
                </tr>
                <!-- urban address -->
                 @if(strtoupper($applicantAddress->rural_urban) == 'URBAN')
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Tehsil</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @foreach($tehsils as $key => $teh)
                        @if($teh->id == $applicantAddress->tehsil_id)
                        {{ $teh->name }}
                        @endif
                        @endforeach
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Street</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->street) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Landmark</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->landmark) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">City</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->city) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Choose Plot/ Khasra/ Khatoni</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->plot_khasra_khatauni) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Plot/Khasra/Khatoni No.</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->plot_khasra_khatauni_no) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Pincode</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->pincode) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                </tr>
                @endif
                <!-- rural address --> 
                 
                @if(strtoupper($applicantAddress->rural_urban) == 'RURAL')
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Block</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @foreach($block as $key => $blk)
                        @if($blk->id == $applicantAddress->block_idl_id)
                        {{ $blk->name }}
                        @endif
                        @endforeach
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Panchayat</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->panchayat) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Village</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->village) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Landmark</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->landmark) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Choose Plot/ Khasra/ Khatoni</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->plot_khasra_khatauni) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Plot/Khasra/Khatoni No.</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->plot_khasra_khatauni_no) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Pincode</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($applicantAddress->pincode) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                </tr>
                @endif
            </tbody>
        </table>
        
        <!-- Action Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Organizing Place and Address</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $organizingAddress = json_decode($applicationDetail[0]->organizing_address);
                @endphp
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">District</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @foreach($districts as $key => $dst)
                        @if($dst->id == $organizingAddress->org_district_id)
                        {{ $dst->name }}
                        @endif
                        @endforeach
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Urban / Rural</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_rural_urban) ?? '' }}</td>
                </tr>
                <!-- urban address -->
                 @if(strtoupper($organizingAddress->org_rural_urban) == 'URBAN')
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Tehsil</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @foreach($tehsils as $key => $teh)
                        @if($teh->id == $organizingAddress->org_tehsil_id)
                        {{ $teh->name }}
                        @endif
                        @endforeach
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Street</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_street) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Landmark</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_landmark) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">City</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_city) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Choose Plot/ Khasra/ Khatoni</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_plot_khasra_khatauni) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Plot/Khasra/Khatoni No.</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_plot_khasra_khatauni_no) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Pincode</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_pincode) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                </tr>
                @endif
                <!-- rural address --> 
                 
                @if(strtoupper($organizingAddress->org_rural_urban) == 'RURAL')
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Block</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @foreach($block as $key => $blk)
                        @if($blk->id == $organizingAddress->org_block_id)
                        {{ $blk->name }}
                        @endif
                        @endforeach
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Panchayat</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_panchayat) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Village</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_village) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Landmark</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_landmark) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Choose Plot/ Khasra/ Khatoni</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_plot_khasra_khatauni) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Plot/Khasra/Khatoni No.</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_plot_khasra_khatauni_no) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Pincode</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->org_pincode) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                </tr>
                @endif
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Latitude</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->latitude) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Longitude</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($organizingAddress->longitude) ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Details of Fire Fighting/Fire Machine used Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;page-break-after: always;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Orgnizer Contact Detail</th>
                </tr>
            </thead>
            <tbody>
                
                @php 
                    $orgnizer_contact_detail = json_decode($applicationDetail[0]->orgnizer_contact_detail);
                @endphp
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Name</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $orgnizer_contact_detail->org_salutation ?? '' }}
                        {{ $orgnizer_contact_detail->org_first_name ?? '' }}
                        {{ $orgnizer_contact_detail->org_middle_name ?? '' }}
                        {{ $orgnizer_contact_detail->org_last_name ?? '' }}
                    </td>
                    
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Name of Organizing Firm</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($orgnizer_contact_detail->org_name) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Email Address</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($orgnizer_contact_detail->org_email) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Mobile</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($orgnizer_contact_detail->org_mobile_no) ?? '' }}</td>
                </tr>
            </tbody>
        </table>

        
        <!-- Details of Fire & Emergency Service Personnel on Incident Place Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Erector Contact Detail</th>
                </tr>
            </thead>
            <tbody>
                
                @php 
                    $erector_contact_detail = json_decode($applicationDetail[0]->erector_contact_detail);
                @endphp
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Name</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $erector_contact_detail->ere_salutation ?? '' }}
                        {{ $erector_contact_detail->ere_first_name ?? '' }}
                        {{ $erector_contact_detail->ere_middle_name ?? '' }}
                        {{ $erector_contact_detail->ere_last_name ?? '' }}
                    </td>
                    
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Name of Organizing Firm</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($erector_contact_detail->org_name) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Email Address</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($erector_contact_detail->ere_email) ?? '' }}</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Mobile</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($erector_contact_detail->ere_mobile_no) ?? '' }}</td>
                </tr>
            </tbody>
        </table>
        
        <!-- Fire Incident Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Coordinator Contact Detail</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $coordinator_contact_detail = json_decode($applicationDetail[0]->coordinator_contact_detail);
                @endphp
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Name</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $coordinator_contact_detail->coor_salutation ?? '' }}
                        {{ $coordinator_contact_detail->coor_first_name ?? '' }}
                        {{ $coordinator_contact_detail->coor_middle_name ?? '' }}
                        {{ $coordinator_contact_detail->coor_last_name ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Email Address</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($coordinator_contact_detail->coor_email) ?? '' }}</td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Mobile</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">{{ ucfirst($coordinator_contact_detail->coor_mobile_no) ?? '' }}</td>
                    
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;"></td>
                </tr>
            </tbody>
        </table>

        
        <!-- Loss Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 20px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Project / Area Detail (Unit should be in mt.)</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $project_area_detail = json_decode($applicationDetail[0]->project_area_detail);
                @endphp
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Total Plot Area</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->total_plot_area ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Total Covered Area</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->total_covered_area ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Type of Activity</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->function_type ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Event Start Date</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ \Carbon\Carbon::parse($project_area_detail->start_date)->format('d-m-Y') ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Event End Date</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ \Carbon\Carbon::parse($project_area_detail->end_date)->format('d-m-Y') ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Number of Camps</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->no_camps ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Number of Stalls</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->no_stalls ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Provision of Kitchen/Food stall</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->pro_kitchen ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Boundary</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->boundary ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Use of Inflammable item</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->inflammable ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Type of Inflammable item</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->inflamable_type ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Whether the activity is Open or indoor</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->open_indoor ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Seating Capacity of Stage</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->seating_capacity ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Number of fire/Security Person</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->security_person ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Width of Approach Road (in Meter)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->road_width ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Separate Parking Area</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->parking ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">No. of Entrance</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->no_entrance ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Height of Entrance(in Meter)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->entrance_height ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Width of Entrance(in Meter)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->entrance_width ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">No. of Exit</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->no_exit ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Height of Exit(in Meter)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->exit_height ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Width of Exit(in Meter)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $project_area_detail->exit_width ?? '' }}
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Loss Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <thead>
                <tr>
                    <th style="color:#000;background-color: #cccccc; color: black; font-weight: bold; text-align: center; border: 1px solid #dddddd; padding: 10px; text-align: left; vertical-align: middle;text-align:center;"colspan="4">Physical Inspection of the Site</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $physical_inspection_detail = json_decode($applicationDetail[0]->physical_inspection_detail);
                @endphp
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Does any high-tension electric line pass over the site?</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @if(isset($physical_inspection_detail->high_tension_line_pass))
                        {{ ucfirst($physical_inspection_detail->high_tension_line_pass)}}
                        @endif
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">If yes, is it situated at a proper safety distance?</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @if(isset($physical_inspection_detail->safety_distance))
                        {{ ucfirst($physical_inspection_detail->safety_distance)}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Can a fire fighting vehicle approach the site?</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @if(isset($physical_inspection_detail->fire_fighting))
                        {{ ucfirst($physical_inspection_detail->fire_fighting)}}
                        @endif
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Is any high inflammable object situated near the building?</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        @if(isset($physical_inspection_detail->high_inflammable))
                        {{ ucfirst($physical_inspection_detail->high_inflammable)}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Distance</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $physical_inspection_detail->distance ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Detail</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $physical_inspection_detail->detail ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Other</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $physical_inspection_detail->other ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Specific Requirement 1 (If Any)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $physical_inspection_detail->specific_requirement_one ?? '' }}
                    </td>
                </tr>
                <tr>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Specific Requirement 2 (If Any)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $physical_inspection_detail->specific_requirement_two ?? '' }}
                    </td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">Specific Requirement 1 (If Any)</td>
                    <td style="color:#000;width:25%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: left;vertical-align: middle;">
                        {{ $physical_inspection_detail->specific_requirement_one ?? '' }}
                    </td>
                </tr>
            </tbody>
        </table>

        @if($applicationDetail[0]->status=='approved')
        <div style="justify-content: space-between; padding: 10px; margin-top: 100px;">
            <div class="row">
                <span style="width:100%; font-weight: bold;">Required Provision</span>
                @php 
                    $applicationRemark = json_decode($applicationDetail[0]->remark);
                    $remark_title = [];
                @endphp

                @if(!empty($applicationRemark) && is_array($applicationRemark))
                    @foreach($applicationRemark as $appRemark)
                        @php
                            $applicationReason = json_decode($appRemark->reason);
                            $reasonIds = explode(',', trim($applicationReason, '"')); // Remove quotes and split by comma
                        @endphp

                        @if(!empty($reasonIds) && is_array($reasonIds))
                            @foreach($reasonIds as $reasonId)
                                @foreach($remarks as $rmk)
                                    @if($rmk->id == (int)$reasonId)
                                        @php
                                            $remark_title[] = $rmk->title;
                                        @endphp
                                    @endif
                                @endforeach
                            @endforeach
                        @endif
                    @endforeach
                @endif
                @if(!empty($remark_title))
                    <ol>
                        @foreach($remark_title as $title)
                            <li>{{ $title }}</li>
                        @endforeach
                    </ol>
                @endif
            </div>   
        </div>
        <!-- Loss Details Table -->
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px; background-color: #ffffff;">
            <tbody>
                <tr>
                    <td style="color:#000;width:50%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: center;vertical-align: middle;">
                        <strong>Verifier/सत्यापनकर्ता</strong><br>
                        <img src="{{ asset($applicationDetail[0]->sfo_signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3"/><br>
                        {{$applicationDetail[0]->fso_name}}<br>
                        Approved Date / स्वीकृति दिनांक <br> {{ \Carbon\Carbon::parse($applicationDetail[0]->fso_approve_date)->format('d-m-Y H:i:s') }}
                    </td>
                    <td style="color:#000;width:50%;font-size: 10px;border: 1px solid #dddddd;padding: 10px;text-align: center;vertical-align: middle;">
                        <strong>Approver (issuing authority)/अनुमोदनकर्ता (जारीकर्ता अधिकारी)</strong><br>
                        <img src="{{ asset($applicationDetail[0]->cfo_signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3"/><br>
                        {{$applicationDetail[0]->cfo_name}}<br>
                        Approved Date / स्वीकृति दिनांक <br> {{ \Carbon\Carbon::parse($applicationDetail[0]->cfo_approve_date)->format('d-m-Y H:i:s') }}
                    </td>
                </tr>
            </tbody>
        </table>
        <div style="margin-top:20px; font-size: 10px; text-align: center; font-style: italic;color:#000;">
            Printed Date Time: {{date('d-m-Y H:i:s')}}
        </div>
        @endif
    </div>
</body>
</html>

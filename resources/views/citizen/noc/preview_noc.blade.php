<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fire Report Document</title>
</head>
<body>
    <div id="content">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="preview_basic_table">
                        <tbody>
                            <tr>
                                <td colspan="6" style="background:#1d4ed8;color:#fff;"><b>Basic Details</b></td>
                            </tr>
                            <tr>
                                <td><b>Building Name</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->building_name) ?? '' }}</td>
                                <td><b>Building Ownership</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->building_ownership) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>GST/PAN/TAN</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->gst_pan_tan) ?? '' }}</td>
                                <td><b>GST/PAN/TAN No.</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->gst_pan_tan_no) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Category Of Project</b></td>
                                <td colspan="2">{{ ucfirst($projects[0]->name) ?? '' }}</td>
                                <td><b>Building Category</b></td>
                                <td colspan="2">{{ ucfirst($categories[0]->name) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Sub Category Of Building</b></td>
                                <td colspan="2">{{ ucfirst($sub_categories[0]->name) ?? '' }}</td>
                                <td><b>Sub Type</b></td>
                                <td colspan="2">{{ !empty($types) ? ucfirst($types[0]->name) : '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Project Status</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->project_status) ?? '' }}</td>
                                <td><b>Latitude</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->latitude) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Longitude</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->longitude) ?? '' }}</td>
                                <td><b>Email</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->email) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Mobile No.</b></td>
                                <td colspan="2">{{ $applicationDetail[0]->mobile_no ?? '' }}</td>
                                <td><b>Other Contact No.</b></td>
                                <td colspan="2">{{ $applicationDetail[0]->office_telephone ?? '' }}</td>
                            </tr>
                            <tr>
                                <td colspan="6" style="background:#1d4ed8;color:#fff;"><b>Building Address</b></td>
                            </tr>
                            <tr>
                                <td><b>District</b></td>
                                <td colspan="2">{{ ucfirst($district[0]->name) ?? '' }}</td>
                                <td><b>Rural/Urban</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->rural_urban) ?? '' }}</td>
                            </tr>
                            @if($applicationDetail[0]->rural_urban == 'rural')
                            <tr>
                                <td><b>Block</b></td>
                                <td>{{ ucfirst($block[0]->name) ?? '' }}</td>
                                <td><b>Panchayat</b></td>
                                <td>{{ ucfirst($panchayat[0]->name) ?? '' }}</td>
                                <td><b>Village</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->village) ?? '' }}</td>
                            </tr>
                            @endif
                            @if($applicationDetail[0]->rural_urban == 'urban')
                            <tr>
                                <td><b>Tehsil</b></td>
                                <td>{{ ucfirst($tehsil[0]->name) ?? '' }}</td>
                                <td><b>Street</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->street) ?? '' }}</td>
                                <td><b>City</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->city) ?? '' }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td><b>Plot/ Khasra/ Khatoni</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->plot_khasra_khatauni) ?? '' }}</td>
                                <td><b>Plot/Khasra/Khatoni No.</b></td>
                                <td colspan="2">{{ $applicationDetail[0]->plot_khasra_khatauni_no ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Landmark</b></td>
                                <td colspan="2">{{ ucfirst($applicationDetail[0]->landmark) ?? '' }}</td>
                                <td><b>Pincode</b></td>
                                <td colspan="2">{{ $applicationDetail[0]->pincode ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="preview_basic_table">
                        <tbody>
                            <tr>
                                <td><b>Proprietary</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->proprietary_rights) ?? '' }}</td>
                                <td colspan="2"></td>
                            </tr>
                            @if($applicationDetail[0] && $applicationDetail[0]->proprietary_rights == 'single')
                                @php
                                    $owner_detail = json_decode($applicationDetail[0]->owner_detail, true) ?? [];
                                @endphp
                                <tr>
                                    <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Name Of Owner</b></td>
                                </tr>
                                <tr>
                                    <td><b>Salutation</b></td>
                                    <td>{{ ucfirst($owner_detail['salutation'] ?? '') }}</td>
                                    <td><b>First Name</b></td>
                                    <td>{{ ucfirst($owner_detail['first_name'] ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td><b>Middle Name</b></td>
                                    <td>{{ ucfirst($owner_detail['middle_name'] ?? '') }}</td>
                                    <td><b>Last Name</b></td>
                                    <td>{{ ucfirst($owner_detail['last_name'] ?? '') }}</td>
                                </tr>
                                <tr>
                                    <td><b>Mobile No.</b></td>
                                    <td>{{ $owner_detail['mobile_no'] ?? '' }}</td>
                                    <td><b>Email Address</b></td>
                                    <td>{{ $owner_detail['email'] ?? '' }}</td>
                                </tr>
                                <tr>
                                    <td><b>Percentage Share</b></td>
                                    <td>{{ $owner_detail['percentage_share'] ?? '' }}</td>
                                    <td><b>Is this person the point of contact</b></td>
                                    <td>{{ ucfirst($owner_detail['point_of_contact'] ?? '') }}</td>
                                </tr>
                            @elseif($applicationDetail[0] && $applicationDetail[0]->proprietary_rights == 'partnership')
                                @php
                                    $partner_details = json_decode($applicationDetail[0]->partner_detail, true) ?? [];
                                @endphp
                                @foreach($partner_details as $pd)
                                    <tr>
                                        <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Partners Detail</b></td>
                                    </tr>
                                    <tr>
                                        <td><b>Salutation</b></td>
                                        <td>{{ ucfirst($pd['p_salutation'] ?? '') }}</td>
                                        <td><b>First Name</b></td>
                                        <td>{{ ucfirst($pd['p_first_name'] ?? '') }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Middle Name</b></td>
                                        <td>{{ ucfirst($pd['p_middle_name'] ?? '') }}</td>
                                        <td><b>Last Name</b></td>
                                        <td>{{ ucfirst($pd['p_last_name'] ?? '') }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile No.</b></td>
                                        <td>{{ $pd['p_mobile_no'] ?? '' }}</td>
                                        <td><b>Email Address</b></td>
                                        <td>{{ $pd['p_email'] ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Percentage Share</b></td>
                                        <td>{{ $pd['p_percentage_share'] ?? '' }}</td>
                                        <td><b>Is this person the point of contact</b></td>
                                        <td>{{ ucfirst($pd['p_point_of_contact'] ?? '') }}</td>
                                    </tr>
                                @endforeach
                            @endif
                            <tr>
                                <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Contact Person Details</b></td>
                            </tr>
                            @php
                                $contact_person = json_decode($applicationDetail[0]->contact_person);
                            @endphp
                            <tr>
                                <td><b>Appointed as</b></td>
                                <td>{{ ucfirst($contact_person->person_appointed) ?? '' }}</td>
                                <td><b>Salutation</b></td>
                                <td>{{ ucfirst($contact_person->con_salutation) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>First Name</b></td>
                                <td>{{ ucfirst($contact_person->con_first_name) ?? '' }}</td>
                                <td><b>Middel Name</b></td>
                                <td>{{ ucfirst($contact_person->con_middle_name) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Last Name</b></td>
                                <td>{{ ucfirst($contact_person->con_last_name) ?? '' }}</td>
                                <td><b>Mobile No.</b></td>
                                <td>{{ ucfirst($contact_person->con_mobile_no) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Email Address</b></td>
                                <td>{{ ucfirst($contact_person->con_email) ?? '' }}</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Architect Details</b></td>
                            </tr>
                            @php
                                $architect_detail = json_decode($applicationDetail[0]->architect_detail);
                            @endphp
                            <tr>
                                <td><b>Salutation</b></td>
                                <td>{{ ucfirst($architect_detail->arc_salutation) ?? '' }}</td>
                                <td><b>First Name</b></td>
                                <td>{{ ucfirst($architect_detail->arc_first_name) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Middel Name</b></td>
                                <td>{{ ucfirst($architect_detail->arc_middle_name) ?? '' }}</td>
                                <td><b>Last Name</b></td>
                                <td>{{ ucfirst($architect_detail->arc_last_name) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Mobile No.</b></td>
                                <td>{{ ucfirst($architect_detail->arc_mobile_no) ?? '' }}</td>
                                <td><b>Email Address</b></td>
                                <td>{{ ucfirst($architect_detail->arc_email) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Name Of Firm</b></td>
                                <td>{{ ucfirst($architect_detail->name_of_firm) ?? '' }}</td>
                                <td><b>GST / PAN / TAN</b></td>
                                <td>{{ ucfirst($architect_detail->firm_gst_pan_tan) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>GST/PAN/TAN No.</b></td>
                                <td>{{ ucfirst($architect_detail->firm_gst_pan_tan_no) ?? '' }}</td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="preview_basic_table">
                        <tbody>
                            <tr>
                                <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Area Details of Site</b></td>
                            </tr>
                            <tr>
                                <td><b>Total Plot Area</b></td>
                                <td>{{ isset($applicationDetail[0]->total_plot_area) ? json_decode($applicationDetail[0]->total_plot_area)->total_plot_area : '' }}</td>
                                <td><b>Total Covered Area</b></td>
                                <td>{{ isset($applicationDetail[0]->total_covered_area) ? json_decode($applicationDetail[0]->total_covered_area)->total_covered_area : '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Ground Floor Covered Area</b></td>
                                <td>{{ isset($applicationDetail[0]->ground_floor_covered) ? json_decode($applicationDetail[0]->ground_floor_covered)->ground_floor_covered : '' }}</td>
                                <td><b>Maximum height of Building</b></td>
                                <td>{{ isset($applicationDetail[0]->max_height_building) ? json_decode($applicationDetail[0]->max_height_building)->max_height_building : '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Basement Covered Area</b></td>
                                <td>{{ isset($applicationDetail[0]->basement_covered_area) ? json_decode($applicationDetail[0]->basement_covered_area)->basement_covered_area : '' }}</td>
                                <td><b>No. of Floors</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->no_of_floor) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>No of Basement(s)</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->no_of_basement) ?? '' }}</td>
                                <td><b>No. of Blocks</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->no_of_blocks) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Height of Tallest Block</b></td>
                                <td>{{ isset($applicationDetail[0]->height_of_tallest_block) ? json_decode($applicationDetail[0]->height_of_tallest_block)->height_of_tallest_block : '' }}</td>
                                <td><b>Distance b/w Blocks</b></td>
                                <td>{{ isset($applicationDetail[0]->min_distance_block) ? json_decode($applicationDetail[0]->min_distance_block)->min_distance_block : '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Approach Road widtd</b></td>
                                <td>{{ isset($applicationDetail[0]->approach_road_width) ? json_decode($applicationDetail[0]->approach_road_width)->approach_road_width : '' }}</td>
                                <td><b>Provision of no. of entrance</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->provision_no_enterance) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Provision of no. of exit</b></td>
                                <td>{{ ucfirst($applicationDetail[0]->provision_no_exit) ?? '' }}</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Set Back Details</b></td>
                            </tr>
                            @php
                                $set_back_detail = json_decode($applicationDetail[0]->set_back_detail);
                            @endphp
                            <tr>
                                <td><b>Front</b></td>
                                <td>{{ ucfirst($set_back_detail->front) ?? '' }}</td>
                                <td><b>Rear</b></td>
                                <td>{{ ucfirst($set_back_detail->rear) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Side-1</b></td>
                                <td>{{ ucfirst($set_back_detail->side1) ?? '' }}</td>
                                <td><b>Side-2</b></td>
                                <td>{{ ucfirst($set_back_detail->side2) ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="preview_basic_table">
                        @php
                            $ess_provision_detail = json_decode($applicationDetail[0]->ess_provision_detail);
                        @endphp
                        <tbody>
                            <tr>
                                <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Essentials Details</b></td>
                            </tr>
                            <tr>
                                <td><b>Compartmentation</b></td>
                                <td>{{ ucfirst($ess_provision_detail->compartmentation) ?? '' }}</td>
                                <td><b>No. of Stairs</b></td>
                                <td>{{ $ess_provision_detail->no_of_stairs ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Minimum Widtd of Stairs</b></td>
                                <td>{{ $ess_provision_detail->width_of_stairs ?? '' }}</td>
                                <td><b>Emergency Exit</b></td>
                                <td>{{ ucfirst($ess_provision_detail->emergency_exit) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Provision of lift</b></td>
                                <td>{{ ucfirst($ess_provision_detail->provision_of_lift) ?? '' }}</td>
                                <td><b>Alternative Electric Supply</b></td>
                                <td>{{ ucfirst($ess_provision_detail->electric_suppy) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Emergency lighting system</b></td>
                                <td>{{ ucfirst($ess_provision_detail->emergency_lighting_system) ?? '' }}</td>
                                <td><b>Provision of Smoke / Fire check Doors</b></td>
                                <td>{{ ucfirst($ess_provision_detail->provision_of_smoke) ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Refuge area in case of high-rise buildings</b></td>
                                <td>{{ ucfirst($ess_provision_detail->refuse_area) ?? '' }}</td>
                                <td><b>Maximum Travel Distance in Building</b></td>
                                <td>{{ $ess_provision_detail->travel_distance ?? '' }}</td>
                            </tr>
                            <tr>
                                <td><b>Otder comment</b></td>
                                <td>{{ $ess_provision_detail->other_comment ?? '' }}</td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-bordered" id="preview_basic_table">
                        <tbody>
                            <tr>
                                <td colspan="4" style="background:#1d4ed8;color:#fff;"><b>Attachment Details</b></td>
                            </tr>
                            <tr>
                                <td><b>Reference Letter from Competent Authority</b></td>
                                <td><a href="{{ asset(json_decode($applicationDetail[0]->attachments)->reference_letter)}}" target="blank" title="View Reference Letter"><i class="fa fa-download" style="font-size:25px;margin-left: 20px;"></i></a></td>
                            </tr>
                            <tr>
                                <td><b>Proposed Map</b></td>
                                <td><a href="{{ asset(json_decode($applicationDetail[0]->attachments)->proposed_map)}}" target="blank" title="View Reference Letter"><i class="fa fa-download" style="font-size:25px;margin-left: 20px;"></i></a></td>
                            </tr>
                            <tr>
                                <td><b>Fire Plan with Fire legend</b></td>
                                <td><a href="{{ asset(json_decode($applicationDetail[0]->attachments)->fire_plan)}}" target="blank" title="View Reference Letter"><i class="fa fa-download" style="font-size:25px;margin-left: 20px;"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
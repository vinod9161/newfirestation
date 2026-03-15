<span style="color:red;font-size:16px;margin-bottom:10px;">Note : Unit Should be Meter or Square Meter</span><br>
<form method="POST" enctype="multipart/form-data" id="step_three_form">
    <div class="row" style="margin-top:10px;">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Total Plot Area प्लॉट का कुल क्षेत्रफल<span class="span_required">*</span></label>
                @php
                $plot_area = json_decode(data_get($application,'total_plot_area','{}'), true);
                @endphp
                <input type="number" class="form-control" id="total_plot_area" name="total_plot_area" placeholder="Total Area" value="{{ old('total_plot_area', $plot_area['total_plot_area'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$"  @if(!empty($plot_area['total_plot_area'])) readonly @endif>
                <span class="error" id="error41"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $total_covered_area = json_decode(data_get($application,'total_covered_area','{}'), true);
                @endphp
                <label class="form-label">Total Covered Area कुल आच्छादित क्षेत्रफल<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="total_covered_area" name="total_covered_area" placeholder="Covered Area" value="{{ old('total_covered_area', $total_covered_area['total_covered_area'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($total_covered_area['total_covered_area'])) readonly @endif>
                <span class="error" id="error42"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $ground_floor_covered = json_decode(data_get($application,'ground_floor_covered','{}'), true);
                @endphp
                <label class="form-label">Ground Floor Covered Area भू-तल का आच्छादित क्षेत्रफल<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="ground_floor_covered" name="ground_floor_covered" placeholder="Ground Floor Covered" value="{{ old('ground_floor_covered', $ground_floor_covered['ground_floor_covered'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($ground_floor_covered['ground_floor_covered'])) readonly @endif>
                <span class="error" id="error43"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $max_height_building = json_decode(data_get($application,'max_height_building','{}'), true);
                @endphp
                <label class="form-label">Maximum height of Building भवन की अधिकतम ऊँचाई<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="max_height_building" name="max_height_building" placeholder="Ground Floor Covered" value="{{ old('max_height_building', $max_height_building['max_height_building'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($max_height_building['max_height_building'])) readonly @endif>
                <span class="error" id="error44"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $basement_covered_area = json_decode(data_get($application,'basement_covered_area','{}'), true);
                @endphp
                <label class="form-label">Basement Covered Area भूमिगत तलों का आच्छादित क्षेत्रफल <span class="span_required">*</span></label>
                <input type="number" class="form-control" id="basement_covered_area" name="basement_covered_area" placeholder="Ground Floor Covered" value="{{ old('basement_covered_area', $basement_covered_area['basement_covered_area'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($basement_covered_area['basement_covered_area'])) readonly @endif>
                <span class="error" id="error45"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">No. of Floors तलों की संख्या<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="no_of_floor" name="no_of_floor" placeholder="No. of Floors" value="{{ old('no_of_floor', $application->no_of_floor ?? '') }}" @if(!empty($application->no_of_floor)) readonly @endif>
                <span class="error" id="error46"></span>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">No of Basement(s) भूमिगत तलों की संख्या<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="no_of_basement" name="no_of_basement" placeholder="No of Basement(s)" value="{{ old('no_of_basement', $application->no_of_basement ?? '') }}" @if(!empty($application->no_of_basement)) readonly @endif>
                <span class="error" id="error47"></span>
            </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">No. of Blocks ब्लॉकों की संख्या<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="no_of_blocks" name="no_of_blocks" placeholder="No. of Blocks" value="{{ old('no_of_blocks', $application->no_of_blocks ?? '') }}" @if(!empty($application->no_of_blocks)) readonly @endif>
                <span class="error" id="error48"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $height_of_tallest_block = json_decode(data_get($application,'height_of_tallest_block','{}'), true);
                @endphp
                <label class="form-label">Height of Tallest Block सबसे ऊँचे ब्लॉक की ऊँचाई<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="height_of_tallest_block" name="height_of_tallest_block" placeholder="Height of Tallest Block" value="{{ old('height_of_tallest_block', $height_of_tallest_block['height_of_tallest_block'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($height_of_tallest_block['height_of_tallest_block'])) readonly @endif>
                <span class="error" id="error49"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $min_distance_block = json_decode(data_get($application,'min_distance_block','{}'), true);
                @endphp
                <label class="form-label">Distance b/w Blocks ब्लॉकों के बीच की दूरी <span class="span_required">*</span></label>
                <input type="number" class="form-control" id="min_distance_block" name="min_distance_block" placeholder="Minimum Distance between Blocks" value="{{ old('min_distance_block', $min_distance_block['min_distance_block'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($min_distance_block['min_distance_block'])) readonly @endif>
                <span class="error" id="error50"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $approach_road_width = json_decode(data_get($application,'approach_road_width','{}'), true);
                @endphp
                <label class="form-label">Approach Road width पहुँच मार्ग की चौड़ाई<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="approach_road_width" name="approach_road_width" placeholder="Approach Road width" value="{{ old('approach_road_width', $approach_road_width['approach_road_width'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($approach_road_width['approach_road_width'])) readonly @endif>
                <span class="error" id="error51"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Provision of no. of entrance प्रवेश द्वारों की संख्या<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="provision_no_enterance" name="provision_no_enterance" placeholder="Provision of no. of entrance" value="{{ old('provision_no_enterance', $application->provision_no_enterance ?? '') }}" @if(!empty($application->provision_no_enterance)) readonly @endif>
                <span class="error" id="error52"></span>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Provision of no. of exit निकास द्वारों की संख्या<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="provision_no_exit" name="provision_no_exit" placeholder="Provision of no. of exit" value="{{ old('provision_no_exit', $application->provision_no_exit ?? '') }}" @if(!empty($application->provision_no_exit)) readonly @endif>
                <span class="error" id="error53"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <h5>Set Back Details सैट बैक एरिया विवरण:</h5>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                @php
                $set_back_detail = json_decode(data_get($application,'set_back_detail','{}'), true);
                @endphp
                <label class="form-label">Front अग्र भाग<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="front" name="front" placeholder="Front" value="{{ old('front', $set_back_detail['front'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($set_back_detail['front'])) readonly @endif>
                <span class="error" id="error54"></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Rear पृष्ठ भाग<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="rear" name="rear" placeholder="Rear" value="{{ old('rear', $set_back_detail['rear'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($set_back_detail['rear'])) readonly @endif>
                <span class="error" id="error55"></span>
            </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Side-1 पार्श्व-1<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="side1" name="side1" placeholder="Side-1" value="{{ old('side1', $set_back_detail['side1'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($set_back_detail['side1'])) readonly @endif>
                <span class="error" id="error56"></span>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="form-group">
                <label class="form-label">Side-2 पार्श्व-2<span class="span_required">*</span></label>
                <input type="number" class="form-control" id="side2" name="side2" placeholder="Side-2" value="{{ old('side2', $set_back_detail['side2'] ?? '') }}" step="any" pattern="^\d*(\.\d{0,2})?$" @if(!empty($set_back_detail['side2'])) readonly @endif>
                <span class="error" id="error57"></span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-danger" id="backToProprietary">Edit</button>
        </div>
        <div class="col-md-6">
            <button type="button" class="save-btn hover-btn btn btn-primary" id="submitArea" style="float:right;">Save & Next</button>
        </div>
    </div>
</form>
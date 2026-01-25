@extends('layouts.admin.template')
@section('title')
<title>Periodic Insepection Officers</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Periodic Report</h5>
    </div>
</div>

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Periodic Report
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-12">
                    <div class="text-wrap">
                        <div class="example">
                           <div class="btn-list"> 
                                <a href="{{ route('admin.periodic-employee') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Employees</a>
                                <a href="{{ route('admin.periodic-report-inspection-officers') }}" type="button" class="btn btn-primary btn-wave waves-effect waves-light">Inspection of Officers</a>
                                <a href="{{ route('admin.periodic-report-rewards') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Rewards</a>
                                <a href="{{ route('admin.periodic-report-punishment') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Punishment</a>
                                <a href="{{ route('admin.periodic-report-communication') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Communication System</a>
                                <a href="{{ route('admin.periodic-report-fire-stations') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire Stations</a>
                                <a href="{{ route('admin.periodic-report-fire-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire Incident</a>
                                <a href="{{ route('admin.periodic-report-rescue-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Rescue Incident</a>
                                <a href="{{ route('admin.periodic-report-relief-incidents') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Relief Incident</a>
                                <a href="{{ route('admin.periodic-report-service-duties') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Service Duties</a>
                                <a href="{{ route('admin.periodic-report-awareness-programs') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Awareness Programe</a>
                                <a href="{{ route('admin.periodic-report-hydrants') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Hydrants/Water Outlets & Bodies</a>
                                <a href="{{ route('admin.periodic-report-noc') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Fire NOC</a>
                                <a href="{{ route('admin.periodic-report-fire-inspections') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Inspection/Audit</a>
                                <a href="{{ route('admin.periodic-report-fire-vehicles') }}" type="button" class="btn btn-primary-light btn-wave waves-effect waves-light">Vehicle/Machine</a>
                            </div>
                        </div>
                     </div>
                </div>

                <div class="col-md-12" style="margin-top:2em;">
                    <h4 class="text-center alert alert-primary">Inspection of Officers</h4>
                    <hr>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <label>Month<sup class="text-danger">*</sup></label>
                                <select class="form-control js-example-basic-single" name="month" id="month" required="">
                                    <option value="">--Select Month--</option>
                                    <option value="01">January</option>
                                    <option value="02">February</option>
                                    <option value="03">March</option>
                                    <option value="04">April</option>
                                    <option value="05">May</option>
                                    <option value="06">June</option>
                                    <option value="07">July</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Year<sup class="text-danger">*</sup></label>
                                <select class="form-control js-example-basic-single" name="year" id="year" required="">
                                    <option value="">--Select Year--</option>
                                    <option value="2024">2024</option>
                                    <option value="2025" selected="">2025</option>
                                    <option value="2026">2026</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label>District<sup class="text-danger">*</sup></label>
                                <select class="form-control js-example-basic-single" name="district_id" id="district_id">
                                    <option value="">Select District</option>
                                    <option value="1">Dehradun देहरादून </option>
                                    <option value="2">Chamoli चमोली </option>
                                    <option value="3">Haridwar हरिद्वार </option>
                                    <option value="4">Rudraprayag रूद्रप्रयाग </option>
                                    <option value="5">Uttarkashi उत्तरकाशी </option>
                                    <option value="6">Pauri Garhwal पौड़ी गढ़वाल </option>
                                    <option value="7">Tehri Garhwal टिहरी गढ़वाल </option>
                                    <option value="8">Almora अल्मोड़ा </option>
                                    <option value="9">Bageshwar बागेश्वर </option>
                                    <option value="10">Champawat चम्पावत </option>
                                    <option value="11">Pithoragarh पिथौरागढ़ </option>
                                    <option value="12">Nainital नैनीताल </option>
                                    <option value="13">Udham Singh Nagar ऊधमसिंहनगर </option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="button" id="find" class="btn btn-dark" style="margin-top:30px">Find</button>
                                <a href="#" class="btn btn-dark" style="margin-top:30px"><i class="fa fa-cloud-download"></i> Download</a>
                            </div>
                            <div class="col-md-2">
                                
                            </div>
                        </div>
                    </div>

                    <hr>
                    <div class="table-responsive">
                        <table class="table ucp-table table-hover table-bordered display" id="ins_of_officer-table" cellspacing="0" width="100%">
                            <tbody><tr style="height:56pt">
                               <th style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;">SL. No</p>
                               </th>
                               <th style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 5pt;padding-right: 8pt;text-indent: 0pt;">Name of District</p>
                               </th>
                               <th style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 4pt;padding-right: 8pt;text-indent: 0pt;">Name of fire station</p>
                               </th>
                               <th style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 4pt;text-indent: 0pt;">Designation of Officer</p>
                               </th>
                               <th style="width:46pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 4pt;padding-right: 4pt;text-indent: 0pt;">Name of Officer</p>
                               </th>
                               <th style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 4pt;text-indent: 0pt;">Date of Inspection</p>
                               </th>
                               <th style="width:125pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 4pt;text-indent: 0pt;line-height: 14pt;text-align: justify;">Type Of inspection</p>
                               </th>
                               <th style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s5" style="padding-left: 5pt;text-indent: 0pt;line-height: 14pt;">Other comments</p>
                               </th>
                            </tr>
                             
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s6" style="padding-left: 4pt;text-indent: 0pt;line-height: 15pt;text-align: left;">1</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Uttarkashi उत्तरकाशी</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Uttarkashi उत्तरकाशी</p>
                               </td>
                               <td style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">CFO</p>
                               </td>
                               <td style="width:46pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">श्री संजीवा कुमार</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">17-Feb-2024</p>
                               </td>
                               <td style="width:125pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Surprise</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">श्रीमान मुख्य अग्निशमन अधिकारी उत्तरकाशी /टिहरी गढवाल द्वारा फायर स्टेशन उत्तरकाशी का आकस्मिक निरीक्षण किया गया। सभी नवनियुक्त महिला /पुरूष  एफ0 एम0 एवं अन्य कर्मचारियों का सम्मेलन लिया गया। तथा नवनियुक्त महिला/पुरूष  एफ0 एम0 से रेस्क्यू उपकरणों की जानकारी प्राप्त की गयी और इन से  आयरन कटर ,वुडन कटर इत्यादि चलवा कर देखा गया । सभी  आर0 एफ0 एम0 महिला /पुरूष को रेस्क्यू उपकरणों की अच्छी जानकारी  है।सभी नवनियुक्त  महिला / पुरूष एफ0 एम0 एवं अन्य कर्मचारियों का सम्मेलन लिया  गया । सभी आर0 एफ0 एम0 को निर्देशित किया कि स्टेशन पर उच्च  कोटि का  अनुशासन व शिष्टाचार बना कर रखें तथा कार्य को अनुशासन में रहकर समय बद्वता के साथ सम्पन्न करें। सभी आर0 आफ0 एम0  अपनी - अपनी डयूटी को विशेष सतर्कता से पूरे लगन, निष्ठा, ईमानदारी से करें तथा  अग्निदुर्घटना / रेस्क्यू में   पी0पी0ई0 किट धारण करें।  किसी भी  नवनियुक्त कर्मचारियों को किसी   भी प्रकार की  समस्या होने पर प्रभारी दिवसाधिकारी / या अपने वरिष्ठ को अवगत कराने हेतु निर्देशित किया गया। उक्त निर्देशों के अनुपालन में सभी कर्मचारियों द्वारा अग्निर्दुघटना / रेसक्यू में पी0 पी0 ई0 किट का प्रयोग किया जाता है। तथा सभी कर्मचारियों द्वारा  स्टेशन में अनुशासन व समय बद्वता के साथ कार्य को सम्पन्न किया जाता है।</p>
                               </td>
                            </tr>
                             
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s6" style="padding-left: 4pt;text-indent: 0pt;line-height: 15pt;text-align: left;">2</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Uttarkashi उत्तरकाशी</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Uttarkashi उत्तरकाशी</p>
                               </td>
                               <td style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">पुलिस उपाधीक्षक</p>
                               </td>
                               <td style="width:46pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">श्री प्रशांत कुमार</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">01-Feb-2024</p>
                               </td>
                               <td style="width:125pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Half Yearly</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">श्रीमान पुलिस उपाधीक्षक महोदय द्वारा फायर स्टेशन उत्तरकाशी  का अर्द्धवार्षिक  निरीक्षण किया गया । पुलिस उपाधीक्षक महोदय  द्वारा समस्त कर्मचारी गणों को निर्देशित किया कि समस्त कर्म0 को आपदा उपकरणों की कार्यप्रणाली व संचालन विधिकी जानकारी होना आवश्यक है। महोदय द्वारा स्टोर ,कार्यालय, तथा मैस का निरीक्षण किया साथ ही बैरिको को चैक किया। मैस में मैन्यू लगााने व उसी के अनुसार  खाना बनाने व मैस की दीवारों पर पोस्टर लगाये जाने के निर्देश दिये। तथा कार्यालय में पूर्ववर्ती वर्षों के पत्रावलियों का वर्षवार पुलिन्दा बनाये जाने व समस्त पत्रावलियों को अपडेट रखा जाने हेतु निर्देशित किया गया। साथ ही अग्निशमन अधिकारी को निर्देशित किया गया कि सप्ताह में  1 पुरूष व 1 महिला फायर मैन बडी पेयर बना कर पुलिस लाइन  बाउंडरी की गश्त कराई जाय। उक्त अनुपालन के क्रम में मैस  निरीक्षण पुस्तिका बना दी गयी है तथा भोजन का मैन्यू तैयार कर भोजनालस में चस्पा करा दिया गया है । तथा महोदय कार्यालय  के अभिलेखों को व्यवस्थित तरीके से लगा दिया गया है तथा  अभिलेखों का वर्षवार अलग -अलग  पुलिन्दा बनाकर चिटबन्दी  कर दी गयी है।व समस्त कर्मचारियों को संयुक्त रूप से  आपदा प्रबन्धन के संबंन्ध में नियमित अभ्यास कराया जा रहा है।तथा लदाडी स्थित  पुलिस की भूमि के सीमांकन व तारबार कराये जाने हेतु पुलिस अधीक्षक महोदय को पत्राचार किया गया है, तथा सप्ताह में दो बार  एक पुरूष व एक महिला कर्मचारी पुलिस की भूमि की चारों ओर गश्त लगाने हेतु भेजा जाता है। 
                     अनुपालन आख्या सादर सेवा में प्रेषित है।</p>
                               </td>
                            </tr>
                             
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s6" style="padding-left: 4pt;text-indent: 0pt;line-height: 15pt;text-align: left;">3</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Uttarkashi उत्तरकाशी</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Uttarkashi उत्तरकाशी</p>
                               </td>
                               <td style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">CFO</p>
                               </td>
                               <td style="width:46pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">श्री संजीवा कुमार</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">05-Jan-2024</p>
                               </td>
                               <td style="width:125pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Surprise</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">श्रीमान मुख्य अग्निशमन  अधिकारी उत्तरकाशी /टिहरी गढवाल द्वारा फायर  स्टेशन उत्तरकाशी  का  आकस्मिक निरीक्षण किया गया। जिसमें मुख्य अग्निशमन अधिकारी द्वारा  सभी कर्मचारियों को निर्देशित किया गया कि सभी कर्मचारियों को आपदा उपकरणों की कार्यप्रणाली व जानकारी होना जरूरी है जिनसको समय -समय पर / निर्धारित समय अवधि में चलाना आना चाहिए। उक्त निर्देशों  के अनुपालन में फायर स्टेशन में सभी कर्मचारियों  को आपदा उपकरणों की कार्यप्रणाली के संब्ंध में जानकारी दी जाती है व उपकरणों के संचालन संबंधी प्रशिक्षण दिया जाता है।</p>
                               </td>
                            </tr>
                             
                                           <tr style="height:16pt">
                               <td style="width:25pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p class="s6" style="padding-left: 4pt;text-indent: 0pt;line-height: 15pt;text-align: left;">4</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Dehradun देहरादून</p>
                               </td>
                               <td style="width:58pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Selaqui सेलाकुई</p>
                               </td>
                               <td style="width:72pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">CFO</p>
                               </td>
                               <td style="width:46pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Shree Vansh Bahadur Yadav</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">29-Nov-2023</p>
                               </td>
                               <td style="width:125pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">Surprise</p>
                               </td>
                               <td style="width:70pt;border-top-style:solid;border-top-width:2pt;border-left-style:solid;border-left-width:2pt;border-bottom-style:solid;border-bottom-width:2pt;border-right-style:solid;border-right-width:2pt">
                                  <p style="text-indent: 0pt;text-align: left;">श्रीमान मुख्य अग्निशमन अधिकारी महोदय द्वारा दिनांक 30/11/2023 को फायर स्टेशन सेलाकुई पर आकस्मिक निरीक्षण किया गया तो वाचरूम डियूटी पर फायरमैन 268 अनंगवीर सिंह बावर्दी दुरूस्त पाया गया निरीक्षण के दौरान स्टेशन प्रभारी सोबरन सिंह क्षेत्र से स्टेशन पर उपस्थित हुये। वाचरूम मे स्थापित सभी संचार के उपकरण कार्यशील पाये गये। स्टेशन परिसर की स्वच्छता संतोषजनक पायी। कार्यालय मे घुसने पर कुछ दुर्गन्ध आ रही है स्टेशन प्रभारी को निर्देशित किया गया कि शौचालय को स्वच्छ रखने हेतु आवश्यक कार्यवाही करें। यदि कोई भी कर्मी शौचालय जाये तो शौचोपरांत पानी अवश्य डालें। प्रभारी द्वारा अवगत कराया गया कि एक युनिट एफआरआई देहरादून डियूटी हेतू गई है। स्टेशन प्रभारी को निर्देशित किया गया कि वाचरूम डियूटी पर तैनात कर्मियों को डियूटी के दौरान अवश्य चैक करते रहें कि वे डियूटी के दौरान कोई लापरवाही न बरते सतर्कता बनाये रखे। यदि कोई भी कर्मचारी किसी भी प्रकार की अनुशासनहीनता करता है तो उसकी रिर्पोट अंकित करते हुये मे मुझे अवगत करायेगें। मैस पर भी ध्यान देते रहेगें।
             सभी कर्मचारियों को उक्त निर्देशो से अवगत करा दिया गया है।</p>
                               </td>
                            </tr>
                             
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>

<!-- Datatables Cdn -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script>
$(function(e) {

    // file export datatable
    $('#datatable-basic').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
    });
});
</script>
@stop
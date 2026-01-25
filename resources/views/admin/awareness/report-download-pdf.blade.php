<!DOCTYPE html>
<html lang="hi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Awareness Program Details</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; background: #000;">

  <div id="pdf-content" style="position: relative; background-color: #fff; width: 90%; max-width: 800px; margin: 50px auto; padding: 20px; box-sizing: border-box; overflow: hidden;">

    <!-- ✅ Overlay (replacing ::before) -->
    <div style="position: absolute; top: 0; left: 0; height: 100%; width: 100%; background-color: rgba(255, 255, 255, 0.6); z-index: 0;"></div>

    <!-- ✅ Watermark -->
    <div style="position: absolute; top: 40%; left: 50%; transform: translate(-50%, -50%); opacity: 0.08; text-align: center; width: 100%; z-index: 1; pointer-events: none;">
      <img src="{{ asset('/public/admin/images/fire-logo.png') }}" alt="Watermark" style="max-width: 300px; width: 80%;">
    </div>

    <!-- ✅ Main Content -->
    <div id="content" style="position: relative; z-index: 2; width: 90%; max-width: 800px; border: 1px solid #000; margin: 0 auto; padding: 5px 28px; margin-bottom: 120px; margin-top: 40px;">

      <!-- Header Section -->
      <div style="text-align: center; margin-bottom: 10px; display: flex;">
        <div style="width: 20%;">
          <img src="{{ asset('/public/admin/images/fire-logo.png') }}" style="width: 100px; height: auto; display: block; margin: 0 auto;">
        </div>
        <div style="width: 60%; text-align: center;">
          <p style="line-height: 20px; color: #000; font-size: 12px; font-weight: bold; margin-top: 10px;">
            उत्तराखण्ड अग्निशमन एवं आपात सेवा <br>
            Uttarakhand Fire & Emergency Service <br>
            मुख्यालय - चतुर्थ तल, सरदार पटेल भवन <br>
            कोर्ट रोड, देहरादून, उत्तराखंड - 248001 <br>
            Headquarter - IV Floor, Sardar Patel Bhavan <br>
            Court Road, Dehradun, Uttarakhand - 248001
          </p>
        </div>
      </div>

      <hr>

      <!-- Reference Number -->
      <div style="text-align: right; font-size: 12px; margin-bottom: 10px;">
        <strong>Reference No. {{ $getData->application_id ?? 'NA' }}</strong>
      </div>

      <!-- Info Table -->
      <table style="width: 100%; border-collapse: collapse; font-size: 12px; background-color: transparent;">
        <tr><th style="padding: 8px; background-color: transparent; text-align: left; width: 40%;">आवेदक का नाम</th><td style="padding: 8px; background-color: transparent; width: 5%;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->name ?? 'NA' }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left; width: 40%;">कार्यक्रम का प्रकार</th><td style="padding: 8px; background-color: transparent; width: 5%;">:</td><td style="padding: 8px; background-color: transparent;">{{ strtoupper($getData->program_type) . ' Report' ?? 'NA' }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम की दिनांक</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ \Carbon\Carbon::parse($getData->program_datetime)->format('d-m-Y H:i:s') }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम स्थल का पता</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->address }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">फायर स्टेशन का नाम <br>(जिसके द्वारा कार्यक्रम आयोजित किया गया)</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->f_name }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम में प्रतिभाग करने वाले फायर सर्विस कर्मियों का विवरण</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->participating_person??'NA' }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम में प्रतिभाग करने वाले संस्था/जनता का विवरण</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->crowd_size??'NA' }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम में प्रयुक्त वाहन/मशीन/उपकरणों का विवरण</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->vehicles??'NA' }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम का विवरण</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->program_details??'NA' }}</td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम की फोटो</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">
           @if (!empty($getData->assignee_attachments))
            @php
              $attachments = json_decode($getData->assignee_attachments);
            @endphp

            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
              @if (!empty($attachments->attachment))
                <img src="{{ asset($attachments->attachment) }}" alt="Attachment 1" style="width: 100px; height: auto; border: 1px solid #ccc;">
              @endif

              @if (!empty($attachments->attachment2))
                <img src="{{ asset($attachments->attachment2) }}" alt="Attachment 2" style="width: 100px; height: auto; border: 1px solid #ccc;">
              @endif

              @if (!empty($attachments->attachment3))
                <img src="{{ asset($attachments->attachment3) }}" alt="Attachment 3" style="width: 100px; height: auto; border: 1px solid #ccc;">
              @endif
            </div>
          @endif
        </td></tr>
        <tr><th style="padding: 8px; background-color: transparent; text-align: left;">कार्यक्रम की फीडबैक रिपोर्ट</th><td style="padding: 8px; background-color: transparent;">:</td><td style="padding: 8px; background-color: transparent;">{{ $getData->program_feedback_report??'NA' }}</td></tr>
      </table>

      <!-- Footer -->
      <div style="text-align: right; font-size: 12px; margin-bottom: 10px; margin-top:30px;">
        <strong>जारीकर्ता</strong><br>
        <strong>
          @php
              $signature = $getAssigneeName[0]->signature ?? "";
          @endphp

          @if($signature != "")
              <img src="{{ asset($signature) }}" alt="Signature" style="width:30%; height:45px; object-fit:fill; border: 1px solid #ccc;">
          @endif

          
        </strong><br>
        <strong style="margin-bottom:50px">अग्निशमन अधिकारी : {{ $getAssigneeName[0]->name ?? 'NA'}} </strong><br>
        <strong>फायर स्टेशन : {{ $getData->f_name??'NA' }}</strong><br>
        <strong>जनपद : {{ $getData->d_name??'NA' }}</strong>
      </div>

      <hr>

        <!-- Note -->
        <div style="margin-top: 10px; font-size: 10px; text-align: center; font-style: italic; color: #000;">
          “यह रिपोर्ट ऑनलाईन जािी की गई है, हस्ताक्षि की आवश्यकता नहीं है, https://fireservice.uk.gov.in के ‘Report Validation’ में ऑनलाइन प्रमाणिकता जााँची जा सकती है।”
        </div>
    </div>

    
  </div>

</body>
</html>

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

    <title>Uttrakhand Fire and Emergency Service</title>

   </head>
   <body>
   </body>
   <style type="text/css">
      .table td, .table th {
         border-top: none;
         border: 1px solid #d0c4c4;
      }
   </style>
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

            <div style="width:100%;">
               <div style="width:20%;float:left;">
                  <img class="qdesk-logo-black" src="/assets/images/fire-logo.png" alt="Uttrakhand Fire and Emergency Services" style="max-width:25%;margin-left:10px;">
               </div>
               <div style="width:80%;">
                  <h2 style="text-align:center;font-size:24px;font-weight: 600;">आग से बचाव और जीवन सुरक्षा के उपाय के प्रयोजनों के लिए एक अग्नि जोखिम लेखाकार (फायर रिस्क ऑडिटर) के रूप में कार्य करने के लिए लाइसेंस/नवीनीकरण</h2>
               </div>
            </div>

            <div style="width:100%;margin-top:30px;">
               <div class="row">
                  <div class="col-md-5 col-sm-6 col-xs-12">
                     <h3>लाइसेंस संख्या : {{$auditor->number}}</h3>
                  </div>
                  <div class="col-md-4 col-sm-6 col-xs-12">
                  </div>
                  <div class="col-md-3 col-sm-6 col-xs-12" style="text-align: right;">
                     <h4>दिनांक : {{date('d-M-Y', strtotime($auditor->updated_at))}}</h4>
                  </div>
               </div>
            </div>

            <div style="width:100%;margin-top:30px;">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <p style="font-size:16px;line-height:2;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; उत्तराखण्ड अग्निशमन एवं आपात सेवा अग्नि निवारण और अग्नि सुरक्षा अधिनियम एवं नियमावली के प्रयोजनों के लिए उत्तराखण्ड राज्य के अन्तर्गत किसी भवन या परिसर में आग से बचाव और जीवन सुरक्षा के क्रियान्वित उपायों के ऑडिट के लिए एक अग्नि जोखिम लेखाकार (फायर रिस्क ऑडिटर) के रूप में कार्य करने के लिए पंजीकृत होने पर मैसर्स/श्री  <b>{{ucfirst($user->name)}}</b> पता <b>{{ucfirst($user->address)}}, {{ucfirst($user->district->name)}}</b> को उत्तराखण्ड अग्निशमन एवं आपात सेवा नियमावली 2021 के नियम 59, 60, 61 एवं 62 के प्रावधानों के तहत आग से बचाव और जीवन सुरक्षा के क्रियान्वित उपाय के ऑडिट किये जाने हेतु लाइसेंस प्रदान या नवीनीकरण किया जाता है।</p>

                     <p style="font-size:16px;line-height:2;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; उक्त लाइसेंस या नवीनीकरण उत्तराखण्ड अग्निशमन एवं आपात सेवा नियमावली 2021 के नियम 59, 60, 61 एवं 62 के प्रावधानों के अधीन जारी करने की तिथि से 02 वर्ष की अवधि के लिए वैध होगा ।</p>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-8 col-sm-8 col-xs-12">
                     &nbsp;
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <p style="font-size:16px;line-height:1;font-weight:600;text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; निदेशक/नामित अधिकारी</p>
                     <p style="font-size:16px;line-height:1;font-weight:600;text-align: right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; उत्तराखण्ड अग्निशमन एवं आपात सेवा</p>
                  </div>
               </div>
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
        pdf.save("fire_report.pdf");
      //  $(".print").hide();
    });
}

function print(){
   $.print("#print");
}

</script>
</body>
</html>

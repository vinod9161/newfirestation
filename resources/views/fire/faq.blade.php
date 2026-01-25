@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">FAQ</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
<!-- ======= About Us Section ======= -->
<div class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>FAQ</h2>
            <ol style="padding-top: 45px;">
                <li><a href="{{ route('actionIndex')}}">Home</a></li>
                <li>FAQ</li>
            </ol>
        </div>

    </div>
</div>
<?php //echo "<pre>"; print_r($faq); die; ?>

<div class="container">

    <h3 style="margin-top: 30px;">Frequently Asked Question</h3>
    @if(!empty($faq))
    @foreach($faq as $faqloop)
    <button class="accordion">प्रश्न – {{ $faqloop->question }}</button>
            <div class="panel">
                <p>उत्तर – {!! $faqloop->answer !!}</p>
            </div>
    @endforeach
    @else
    <button class="accordion">प्रश्न – एन0ओ0सी0 कितने प्रकार की होती है। </button>
    <div class="panel">
        <p>उत्तर – एन0ओ0सी0 तीन प्रकार की होती है –<br>

            1- पूर्व स्थापना अनापत्ति प्रमाण पत्र (Pre-establishment NOC)<br>

            2- पूर्व अधिभोग अनापत्ति प्रमाण पत्र (Pre-Operational NOC)<br>

            3- वार्षिक नवीनीकरण प्रमाण पत्र (Annual clearance Certificate)</p>
    </div>

    <button class="accordion">प्रश्न – एन0ओ0सी0 लेनी क्यों आवश्यक है? </button>
    <div class="panel">
        <p>उत्तर – भवन निर्माण उपविधि के निमान्तर्गत किसी अनिर्मित/निर्मित स्थाई/अस्थाई संरचना हेतु अग्निशमन विभाग की
            अग्नि सुरक्षा एवं जीव रक्षा सम्बन्धी सहमति प्राप्त करना आवश्यक है। बिना अग्निशमन अनापत्ति प्रमाण पत्र केs
            किसी भी स्थाई/अस्थाई संरचना को अग्नि सुरक्षा एवं जीव रक्षा के दृष्टिकोण से सुरक्षित नहीं माना जा सकता है।
        </p>
    </div>

    <button class="accordion">प्रश्न – एन0ओ0सी0 के लिए आवश्यक प्रपत्र (Necessary documents) क्या है? </button>
    <div class="panel">
        <p>
            1- पूर्व स्थापना अनापत्ति प्रमाण पत्र –<br>
            (Pre-establishment NOC) <br>
            क) प्राधिकृत प्राधिकरण का पत्र<br>
            ख) राष्ट्रीय भवन संहिता/भवन निर्माण उपविधि के अनुसार मानचित्र<br><br>

            2- पूर्व अधिभोग अनापत्ति प्रमाण पत्र –<br>
            (Pre-Operational NOC)<br><br>
            क) किसी प्राधिकृत प्राधिकरणद्वारा स्वीकृत मानचित्र<br>
            ख) संरचना में स्थापित अग्निशमन उपकरणों की सूची<br><br>

            3- वार्षिक नवीनीकरण प्रमाण पत्र –<br>
            (Annual clearance Certificate)<br>
            क) पूर्व निर्गत अनापत्ति प्रमाण पत्र<br>
            ख) राजकीय शुल्क सम्बन्धी चालान<br>
            ग) हाइड्रोलिक प्रेशर टेस्ट सर्टिफिकेट</p>
    </div>

    <button class="accordion">प्रश्न – प्राधिकृत प्राधिकरण(Competent authority) क्या है ? </button>
    <div class="panel">
        <p>उत्तर – वह कोई भी प्राधिकरण/संस्था जिसे केन्द्र/राज्य सरकार द्वारा विहत नियमों के तहत मानचित्र स्वीकृत
            करने/लाईसेन्स प्रदान करने की शक्ति प्राप्त हो। </p>
    </div>

    <button class="accordion">प्रश्न – एन0ओ0सी0 की प्रक्रिया (Procedure) क्या है ? </button>
    <div class="panel">
        <p>उत्तर – अनापत्ति प्रमाण पत्र प्राप्त करने हेतु अग्निशमन विभाग/सिंगल विण्डों की वेबसाइट
            www.ukfireservices.com/ www.investuttarakhand.com पर आवेदन किया जाता है। प्रत्येक अनापत्ति प्रमाण पत्र हेतु
            समयावधि निर्धारित है। जिसका उल्लेख वेबसाइट मेंa किया गया है। आवेदन पत्र प्राप्त होने पर सत्यापन अधिकारी को
            भेजा जाता है। जिसको सत्यापित करने के बाद सम्बन्धित अधिकारी द्वारा स्पष्ट आख्या अनुमोदन अधिकारी को प्रेषित की
            जाती है। अनुमोदन अधिकारी अनापत्ति प्रमाण पत्र जारी कर वेबसाइट पर अपलोड कर देता है, जिसकी प्रति आवेदनकर्ता की
            ईमेल आई0डी0 पर प्राप्त हो जाती है, एवं आवेदनकर्ता के मोबाइल नम्बर पर भी सूचना आ जाती है।</p>
    </div>

    <button class="accordion">प्रश्न – अनापत्ति प्रमाण पत्र प्राप्त करने के लिए भवन में न्यूनतम क्या-क्या अग्नि सुरक्षा
        एवं जीव रक्षा व्यवस्था करनी आवश्यक है ? </button>
    <div class="panel">
        <p>उत्तर – अनापत्ति प्रमाण पत्र प्राप्त करने के लिए भवन में राष्ट्रीय भवन संहिता-2016 के पार्ट-4, की सूची-7 में
            निहित व्यवस्थाओं को करना आवश्यक है। जिसकी प्रति अग्निशमन विभाग की वेबसाइट पर उपलब्ध है। निःशुल्क सुझावों को
            प्राप्त करनेs हेतु आवेदक अग्निशमन विभाग के किसी भी फायर स्टेशन पर सम्पर्क कर सकते हैं। </p>
    </div>

    <button class="accordion">प्रश्न – एन0ओ0सी0 के लिए आवेदन (Apply) कैसे करें ? </button>
    <div class="panel">
        <p>उत्तर – अनापत्ति प्रमाण पत्र प्राप्त करने हेतु अग्निशमन विभाग की वेबसाइट www.ukfireservices.com पर आवेदन किया
            जाता है। जिसकी प्रक्रिया निम्नवत् है। www.ukfireservices.com>NOC>Apply for NOC निर्धारित प्रारूप भरने एवं
            उसके साथ आवश्यक प्रपत्रों को संलग्न करना आवश्यक है। आवेदन प्रक्रिया पूर्ण होने पर एक यूनिक आई0डी0 संख्या
            आवेदक को प्राप्त हो जाती है, जिससे वह समय-समय पर आवेदन पत्र का स्तर देख सकते हैं। इसके अतिरिक्त उत्तराखण्ड
            शासन की वेबसाइट www.investuttarakhand.com के सिंगल विण्डों क्लीयेरेन्स के माध्यम से भी अग्निशमन अनापत्ति
            प्रमाण पत्र हेतु आवेदन किया जा सकता है।</p>
    </div>

    <button class="accordion">प्रश्न – किसी पृच्छा/संदेह (Query) के लिए क्या करें, किन-किन फोन नम्बर पर सम्पर्क किया जा
        सकता है अथवा ईमेल किया जा सकता है ? </button>
    <div class="panel">
        <p>उत्तर – किसी पृच्छा/संदेह के सम्बन्ध में वेबसाइट पर दिये गये सम्बन्धित जनपद/फायर स्टेशन के फोन नम्बर/ईमेल
            आई0डी0 पर सम्पर्क किया जा सकता है।</p>
    </div>

    <button class="accordion">प्रश्न – एन0ओ0सी0 के लिए आवेदन (Apply) करते समय किन-किन बातों का ध्यान रखें ? </button>
    <div class="panel">
        <p>उत्तर – अनापत्ति प्रमाण पत्र हेतु आवेदन करते समय सभी निर्धारित कालम को मानचित्र के अनुसार सही भरें। मोबाइल
            नम्बर, ईमेल, आवेदित जनपद का नाम भरते समय सावधानी बरतें। इसके अलावा निर्धारित आवश्यक प्रपत्र संलग्न करें ।
        </p>
    </div>

    <button class="accordion">प्रश्न – आवेदन पत्र वापस (Application revert) करना क्या है ?</button>
    <div class="panel">
        <p>उत्तर – आवेदन पत्र वापस (Application revert) करना का अर्थ निरस्त (Rejection) करना नहीं है। यदि आवेदन भरते समय
            आवेदक द्वारा कुछ त्रुटि/प्रपत्रों की कमी रह जाती है तो उसको सही करने का एक अवसर देने हेतु आवेदन पत्र वापस
            किया जाता है, जिसको आवेदनकर्ता द्वारा पूर्व निर्गत यूनिक आई0डी0 पर केवल त्रुटिपूर्ण कालम में सुधार कर अथवा
            आवश्यक अभिलेख पूरे कर पुनः आवेदन किया जा सकता है। </p>
    </div>

    <button class="accordion">प्रश्न – आवेदन पत्र वापस (Application revert) होने पर क्या करें ? </button>
    <div class="panel">
        <p>उउत्तर – आवेदन पत्र वापस (Application revert) होने पर उसमें एक सन्देश आता है कि किस कारण आवेदन पत्र वापस किया
            गया है। ऐसी स्थिति में उस सन्देश में निहित निर्देशों/सुझावों का कर पूर्व निर्गत यूनिक आई0डी0 से ही पुनः
            आवेदन किया जा सकता है।</p>
    </div>

    <button class="accordion">प्रश्न – क्या हम एक बार वापस आवेदन पत्र (Application) भरने पर पुनः आवेदन कर सकते है ?
    </button>
    <div class="panel">
        <p>उत्तर – एक बार वापस आवेदन पत्र (Application) भरने पर तब तक पुनः आवेदन नहीं कर सकते हैं जब तक कि आवेदन पत्र
            प्रक्रिया के अधीन है। एक बार आवेदन पत्र वापस (Application revert) होने पर ही पुनः आवेदन किया जा सकता है।</p>
    </div>

    <button class="accordion">प्रश्न – अनापत्ति प्रमाण पत्र की वर्तमान स्थिति (Present Status) देखने के लिए क्या करें ?
    </button>
    <div class="panel">
        <p>उत्तर – आवेदन पत्र (Application) की वर्तमान स्थिति (Present Status) देखने के लिए वेबसाइट पर निम्नलिखित
            प्रक्रिया को करें& www.ukfireservices.com> NOC>check NOC status । इसके बाद डायलाँग बाक्स में अपना यूनिक
            आई0डी0 संख्या डालने पर आवेदन पत्र की वर्तमान स्थिति देख सकते है।</p>
    </div>

    <button class="accordion">प्रश्न – अनापत्ति प्रमाण पत्र के लिए अग्नि सुरक्षा एवं जीव रक्षा सम्बन्धी क्या-क्या
        प्राविधान लागू होते हैं? </button>
    <div class="panel">
        <p>उत्तर – अनापत्ति प्रमाण पत्र के लिए अग्नि सुरक्षा एवं जीव रक्षा सम्बन्धी राष्ट्रीय भवन संहिता-2016 के
            पार्ट-4, समय-समय पर संशोधित भारतीय मानक तथा समय-समय पर उत्तराखण्ड शासन/अग्निशमन विभाग द्वारा जारी किये गये
            शासनादेश/निर्देश लागू होते है।</p>
    </div>

    <button class="accordion">प्रश्न – क्या नई सेवा हेतु अथवा प्रत्येक वर्ष नवीनीकरण प्रमाण पत्र हेतु एक ही यूनिक आई0डी0
        से आवेदन किया जा सकता है ? </button>
    <div class="panel">
        <p>उत्तर – हाँ। आवेदक अपनी पंजीकृत ई-मेल आई0डी0 पर आये यूनिक आई0डी0 एवं पासवर्ड द्वारा नई सेवा हेतु अथवा
            प्रत्येक वर्ष नवीनीकरण प्रमाण पत्र हेतु आवेदन कर सकता है। परन्तु एक यूनिक आई0डी0 एक ही भवन/परिसर की होनी
            आवश्यक है। नवीनीकरण प्रमाण पत्र हेतु अध्यतन/नवीनतम प्रपत्रों का संलग्न किया जाना अनिवार्य है।

        </p>
    </div>
    @endif
</div>

@endsection
@section('scripts')
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
         this.classList.toggle("active");
         var panel=this.nextElementSibling;
          if (panel.style.display==="block" ) {
            panel.style.display="none" ;
         } else {
             panel.style.display="block" ;
        }
     });
}
@stop

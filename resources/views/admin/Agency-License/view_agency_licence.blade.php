@extends('layouts.admin.template')
@section('title')
<title>Fire Licenced Agency लाइसेंस प्राप्त एजेंसी</title>
@endsection
@section('style')

@endsection
@section('content')
<div class="header-page">
<div class="row">
<div class="col-md-12 mb-2" style="justify-content: center;">
      @if(session()->has('message'))
      <div class="alert alert-success fade in alert-dismissible show" style="margin-bottom: 0px;">   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true" style="font-size:20px">×</span>
         </button>
         {{ session()->get('message') }}
      </div>
      @elseif(session()->has('error'))
      <div class="alert alert-danger fade in alert-dismissible show" style="margin-bottom: 0px;">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true" style="font-size:20px">×</span>
         </button>
         {{ session()->get('error') }}
      </div>
      @endif
   </div>
</div>

</div>
<section class="box-admin edit-profile">

   <div class="container-fluid">
      <div class="row">
         <h2 class="text-center heading_info">Fire Licenced Agency लाइसेंस प्राप्त एजेंसी</h2>
         <div class= 'table-responsive'>
            <table class="table table-bordered table-striped table-hover">
               <tbody>
                  <tr>
                     <th style="width:75%">Fire Agency Licence Registration Number लाइसेंस प्राप्त संख्या</th>
                     <td>{{$licence[0]->number}}</td>
                  </tr>

                  <tr>
                     <th style="width:75%">कंपनी के नाम के साथ आवेदक का पूरा नाम</th>
                     <td>{{$licence[0]->a}}</td>
                  </tr>

                  <tr>
                     <th>क्या लाइसेंस प्राप्त एजेंसी एक मालिकाना संस्था होगी या व्यक्तियों का एक संघ जैसे फर्म या कंपनी, आदि।</th>
                     <td>{{$licence[0]->b}}</td>
                  </tr>

                  <tr>
                     <th>फर्म या कंपनी की पंजीकरण संख्या (पंजीकरण प्रमाणपत्र की प्रतियां, एसोसिएशन का लेख या अन्य प्रासंगिक दस्तावेज संलग्न)</th>
                     <td>{{$licence[0]->c}}</td>
                  </tr>

                  <tr>
                     <th>पता *</th>
                     <td>{{$licence[0]->d}}</td>
                  </tr>


                  <tr>
                     <th>यदि लाइसेंस प्राप्त एजेंसी होगी</th>
                     <td>{{$licence[0]->e}}</td>
                  </tr>

                  <tr>
                     <th>एक मालिकाना, उसका संचालन करने वाले व्यक्ति का नाम, योग्यता और पता</th>
                     <td>{{$licence[0]->f}}</td>
                  </tr>

                  <tr>
                     <th>एक फर्म या कंपनी, प्रत्येक भागीदार के नाम, योग्यता और पते, या निदेशक जैसा भी मामला हो</th>
                     <td>{{$licence[0]->g}}</td>
                  </tr>

                  <tr>
                     <th>कार्यालय का पता जहां से एजेंसी लाइसेंस प्राप्त एजेंसी के रूप में कार्य करेगी</th>
                     <td>{{$licence[0]->h}}</td>
                  </tr>

                  <tr>
                     <th>श्रेणी जिसके लिए लाइसेंस के लिए आवेदन किया गया है</th>
                     <td>{{$licence[0]->i}}</td>
                  </tr>

                  <tr>
                     <th>एजेंसी के साथ कार्मिक</th>
                     <td>{{$licence[0]->j}}</td>
                  </tr>

                  <tr>
                     <th>(ए) पर्यवेक्षी कार्मिक – प्रत्येक के नाम, योग्यता और पते</th>
                     <td>{{$licence[0]->k}}</td>
                  </tr>

                  <tr>
                     <th>(बी) अन्य कार्मिक – प्रत्येक के नाम, योग्यता और पते</th>
                     <td>{{$licence[0]->l}}</td>
                  </tr>

                  <tr>
                     <th>आग की रोकथाम और जीवन सुरक्षा उपायों के संबंध में कार्य का विवरण, यदि कोई हो, पहले किए गए और निष्पादित किए गए काम का नाम या प्रकृति</th>
                     <td>{{$licence[0]->m}}</td>
                  </tr>

                  <tr>
                     <th>(ए) काम का नाम या प्रकृति</th>
                     <td>{{$licence[0]->n}}</td>
                  </tr>

                  <tr>
                     <th>(बी) काम की अनुमानित लागत</th>
                     <td>{{$licence[0]->o}}</td>
                  </tr>

                  <tr>
                     <th>क्या कार्य निष्पादित किया गया है या अभी भी प्रगति पर है और निष्पादित(सी) किया जाना बाकी है। ,जिन अधिकारियों के अधीन कार्य किया जा रहा है, उन अधिकारियों द्वारा उपरोक्त विवरण के सत्यापन के प्रमाण पत्र की मूल या सत्यापित प्रतियां संलग्न हैं।</th>
                     <td>{{$licence[0]->p}}</td>
                  </tr>

                  <tr>
                     <th>आवेदक या भागीदारों या निदेशकों और तकनीकी अधिकारियों या कर्मचारियों की तकनीकी योग्यता और अनुभव।</th>
                     <td>{{$licence[0]->q}}</td>
                  </tr>

                  <tr>
                     <th>आवेदक के स्वामित्व वाली कार्यशाला मशीनरी, उपकरण और संयंत्र, (कार्यशाला का स्थान और स्थल और पूरा विवरण दिया जाना है)</th>
                     <td>{{$licence[0]->r}}</td>
                  </tr>

                  <tr>
                     <th>क्या किसी अन्य राज्य में किसी अन्य विभाग या संगठन के साथ सूचीबद्ध है। यदि हां, तो किस श्रेणी में।</th>
                     <td>{{$licence[0]->s}}</td>
                  </tr>

                  <tr>
                     <th>(ए) क्या आवेदक या उसके सहयोगियों या निदेशकों को पूर्व में किसी सरकारी विभाग/संगठन/अन्य राज्य द्वारा काली सूची में डाला गया है?</th>
                     <td>{{$licence[0]->t}}</td>
                  </tr>

                  <tr>
                     <th>(बी) क्या आवेदक ने पंजीकरण के लिए अपने नाम पर या भागीदार, निदेशक या फर्म या कंपनी के नाम पर कहीं और आवेदन किया है? यदि हां, तो क्या आवेदन निरस्त किया गया है ? विवरण दें।</th>
                     <td>{{$licence[0]->u}}</td>
                  </tr>

                  <tr>
                     <th>क्या आवेदक ने अद्यतन आयकर प्रमाणपत्र प्रस्तुत किया है।</th>
                     <td>{{$licence[0]->v}}</td>
                  </tr>

                  <tr>
                     <th>सॉल्वेंसी सर्टिफिकेट की राशि, जो आवेदक के पास है या पेश की गई है।</th>
                     <td>{{$licence[0]->w}}</td>
                  </tr>

                  <tr>
                     <th>आवेदन शुल्क रुपये __________ का भुगतान किया जाएगा।</th>
                     <td>{{$licence[0]->x}}</td>
                  </tr>

                  <tr>
                     <th>यदि आवेदन मौजूदा लाइसेंस के नवीनीकरण के लिए है, तो लाइसेंस के संबंध में विवरण और इसकी वैधता की अवधि (लाइसेंस की प्रति संलग्न)</th>
                     <td>{{$licence[0]->y}}</td>
                  </tr>

                  <tr>
                     <th>क्या, लाइसेंस प्राप्त एजेंसी के रूप में कार्य करने का लाइसेंस किसी भी समय पहले दिया गया था निलंबित या रद्द कर दिया गया है; और यदि हां, तो इसके क्या कारण हैं।</th>
                     <td>{{$licence[0]->z}}</td>
                  </tr>

                  <tr>
                     <th>Status</th>
                     <td>{{$licence[0]->status}}</td>
                  </tr>

                  @if($licence[0]->remark !='')
                  <tr>
                     <th>Reverted Remark</th>
                     <td>{{$licence[0]->remark}}</td>
                  </tr>
                  @endif
               </tbody>
            </table>
         </div>
      </div>

      @if(Auth::user()->type == 1 && ($licence[0]->status == 'Pending'))
      <div class="row">
      <div class="col-md-3 mb-2" style="justify-content: center; "></div>
      <div class="col-md-2 mb-2" style="justify-content: center; ">
         <form enctype="multipart/form-data" id="remark-form" action="{{route('approvedAgencyLicence')}}" method="post">

             @csrf

             <input type="hidden" name="id" value="{{$licence[0]->id}}">

            <button type="submit" id="btn-reject-app" class="btn btn-success text-center">Approved</button>

         </form>
      </div>
      <div class="col-md-2 mb-2" style="justify-content: center; ">
         <form enctype="multipart/form-data" id="remark-form" action="{{route('rejectedAgencyLicence')}}" method="post">

            @csrf

            <input type="hidden" name="id" value="{{$licence[0]->id}}">

            <button type="submit" id="btn-reject-app" class="btn btn-danger text-center">Reject</button>

         </form>
      </div>
      <div class="col-md-2 mb-2" style="justify-content: center; ">

         <button type="button" id="btn-reject-app" class="btn btn-warning text-center" data-toggle="modal" data-target="#reverted_modal" title="Reverted" style="color:#fff;">Reverted</button>

      </div>
      </div>

      </div>
      @endif
   </div>
</section>

<!-- Modal -->
<div class="modal fade" id="reverted_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reverted</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form enctype="multipart/form-data" id="remark-form" action="{{route('revertedAgencyLicence')}}" method="post">
      @csrf

      <input type="hidden" name="id" value="{{$licence[0]->id}}">
      <div class="modal-body">
        <textarea class="form-control" maxlength="512" name="remark" placeholder="Enter Reverted Rmark" style="height:100px;width: 300px;margin:auto;" required></textarea>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('scripts')

@stop

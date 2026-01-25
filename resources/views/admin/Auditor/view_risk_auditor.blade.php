@extends('layouts.admin.template')
@section('title')
<title>Fire Risk Auditor अग्नि जोखिम लेखाकार</title>
@endsection
@section('style')
@endsection
@section('content')
<div class="header-page">
    <div class="row">
        <div class="col-md-12 mb-2" style="justify-content: center; ">
            @if(session()->has('message'))
            <div class="alert alert-success fade in alert-dismissible show" style="margin-bottom: 0px;"> <button
                    type="button" class="close" data-dismiss="alert" aria-label="Close">
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
            <h2 class="text-center heading_info">Fire Risk Auditor अग्नि जोखिम लेखाकार</h2>
            <div class='table-responsive'>
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        <tr>
                            <th style="width:75%">Fire Risk Auditor Registration Number अग्नि जोखिम लेखाकार संख्या</th>
                            <td>{{$auditor[0]->number}}</td>
                        </tr>

                        <tr>
                            <th style="width:75%">कंपनी के नाम के साथ आवेदक का पूरा नाम</th>
                            <td>{{$auditor[0]->a}}</td>
                        </tr>

                        <tr>
                            <th>अग्नि जोखिम लेखाकार की योग्यता एवं प्रमाणित प्रतियां</th>
                            <td>{{$auditor[0]->b}}</td>
                        </tr>

                        <tr>
                            <th>कार्यालय का पता</th>
                            <td>{{$auditor[0]->c}}</td>
                        </tr>

                        <tr>
                            <th>श्रेणी जिसके लिए लाइसेंस के लिए आवेदन किया गया है</th>
                            <td>{{$auditor[0]->d}}</td>
                        </tr>


                        <tr>
                            <th>एजेंसी के साथ कार्मिक</th>
                            <td>{{$auditor[0]->e}}</td>
                        </tr>

                        <tr>
                            <th>आग की रोकथाम और जीवन सुरक्षा उपायों के संबंध में कार्य का विवरण, यदि कोई हो, पहले किए गए
                                निष्पादित किए गये कार्य तथा ऑडिट का अनुभव</th>
                            <td>{{$auditor[0]->f}}</td>
                        </tr>

                        <tr>
                            <th>कार्य का विवरण</th>
                            <td>{{$auditor[0]->g}}</td>
                        </tr>

                        <tr>
                            <th>ऑडिट का अनुभव</th>
                            <td>{{$auditor[0]->h}}</td>
                        </tr>

                        <tr>
                            <th>क्या किसी अन्य राज्य में किसी अन्य विभाग या संगठन के साथ सूचीबद्ध है। यदि हां, तो किस
                                श्रेणी में।</th>
                            <td>{{$auditor[0]->i}}</td>
                        </tr>

                        <tr>
                            <th>क्या अन्य राज्य/विभाग या संगठन द्वारा पूर्व में काली सूची में डाला गया, यदि हाँ तो विवरण
                                दें ।</th>
                            <td>{{$auditor[0]->j}}</td>
                        </tr>

                        <tr>
                            <th>क्या आवेदक ने पंजीकरण के लिए अपने नाम पर कहीं और आवेदन किया है? यदि हां, तो क्या आवेदन
                                निरस्त किया गया है ? विवरण दें।</th>
                            <td>{{$auditor[0]->k}}</td>
                        </tr>

                        <tr>
                            <th>क्या आवेदक ने अद्यतन आयकर प्रमाणपत्र प्रस्तुत किया है।</th>
                            <td>{{$auditor[0]->l}}</td>
                        </tr>

                        <tr>
                            <th>आवेदन शुल्क रुपये __________ का भुगतान किया जाएगा।</th>
                            <td>{{$auditor[0]->m}}</td>
                        </tr>

                        <tr>
                            <th>यदि आवेदन मौजूदा लाइसेंस के नवीनीकरण के लिए है, तो लाइसेंस के संबंध में विवरण और इसकी
                                वैधता की अवधि (लाइसेंस की प्रति संलग्न)</th>
                            <td>{{$auditor[0]->n}}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <td>{{$auditor[0]->status}}</td>
                        </tr>

                        @if($auditor[0]->remark !='')
                        <tr>
                            <th>Reverted Remark</th>
                            <td>{{$auditor[0]->remark}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        @if(Auth::user()->type == 1 && ($auditor[0]->status == 'Pending'))
        <div class="row">
            <div class="col-md-3 mb-2" style="justify-content: center; "></div>
            <div class="col-md-2 mb-2" style="justify-content: center; ">
                <form enctype="multipart/form-data" id="remark-form" action="{{route('approvedRiskAuditor')}}"
                    method="post">

                    @csrf

                    <input type="hidden" name="id" value="{{$auditor[0]->id}}">

                    <button type="submit" id="btn-reject-app" class="btn btn-success text-center">Approved</button>

                </form>
            </div>
            <div class="col-md-2 mb-2" style="justify-content: center; ">
                <form enctype="multipart/form-data" id="remark-form" action="{{route('rejectedRiskAuditor')}}"
                    method="post">

                    @csrf

                    <input type="hidden" name="id" value="{{$auditor[0]->id}}">

                    <button type="submit" id="btn-reject-app" class="btn btn-danger text-center">Reject</button>

                </form>
            </div>
            <div class="col-md-2 mb-2" style="justify-content: center; ">

                <button type="button" id="btn-reject-app" class="btn btn-warning text-center" data-toggle="modal"
                    data-target="#reverted_modal" title="Reverted" style="color:#fff;">Reverted</button>

            </div>
        </div>

    </div>
    @endif
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="reverted_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reverted</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form enctype="multipart/form-data" id="remark-form" action="{{route('revertedRiskAuditor')}}"
                method="post">
                @csrf

                <input type="hidden" name="id" value="{{$auditor[0]->id}}">
                <div class="modal-body">
                    <textarea class="form-control" maxlength="512" name="remark" placeholder="Enter Reverted Rmark"
                        style="height:100px;width: 300px;margin:auto;" required></textarea>
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

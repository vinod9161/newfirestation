@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Check NOC Status        </h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Check NOC Status            </li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

    <div class="container">
        <div class="row">

    <div class="col-sm-12 ">
        <h1 style="margin-top: 40px;">
            Check NOC Status

        </h1>


        <div class="row" style="margin-bottom: 50px;">
    
            <div class="col-md-6">
                <div class="pull-right">
                    <button type="button" class="collapsible">Returning Applicants/Print NOC, Kindly Click Here</button>
                    <div class="content">
                        <form id="verifier-forms" action="/fireservice/application/applicationstatus" method="post">    
                            <div class="form-group" style="margin-top: 10px ;">
                              <label for="email">(1) Type Your Previous UID Here</label>
                          <input placeholder="Application UID" class="form-control" name="ApplicationStatus[uuid]" id="ApplicationStatus_uuid" type="text">                <div class="errorMessage" id="ApplicationStatus_uuid_em_" style="display:none"></div>                </div>
              
                           <input class="btn btn-success" style="margin-bottom: 10px;"type="submit" name="yt0" value="Submit"></form> 
                    </div>
                    </div>
                </div>

                <div class="col-md-6">

                </div>
            </div>
</div>








            





            <!-- Name of director-->
       




            <!-- Name of Authorized Coordinator/ Person-->

         
 @endsection
@section('scripts')
 var coll = document.getElementsByClassName("collapsible");
    var i;
    
    for (i = 0; i < coll.length; i++) {
      coll[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var content = this.nextElementSibling;
        if (content.style.display === "block") {
          content.style.display = "none";
        } else {
          content.style.display = "block";
        }
      });
    }
@stop




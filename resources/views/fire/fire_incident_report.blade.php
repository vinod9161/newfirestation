@extends('layouts.fire_new')
@section('content')
<style>
   /* Move submit button to right */
   .form-submit-right {
      display: flex;
      justify-content: flex-end;
   }

   /* Optional: fixed button width */
   .form-submit-right .btn {
      min-width: 150px;
   }
   .btn-danger{
      color: #fff; background-color: #00258e; border-color: #00258e;
   }
   .btn-danger:hover{
      color: #fff; background-color: #00258e; border-color: #00258e;
   }

</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Fire Incident Report</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Fire Incident Report</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<section class="why-us section-bg flagday-section py-5" data-aos="fade-up" date-aos-delay="200">
   <div class="container">
      <div class="row content-card content-text">
         <div class="col-lg-12 d-flex flex-column justify-content-center p-5">
            <h4 class="title text-center">Fire / Rescue / Other Incident Report</h4>
            <p class="description">
               A fire, rescue, or other incident report may be obtained by the concerned person upon payment of the prescribed fee, as per departmental norms.
            </p>
         </div>
         <!-- form -->
         <div class="col-lg-12 mb-2" style="justify-content: center; ">
            <div class="header-page" style="overflow-x: hidden;">
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
         <div class="col-lg-12">
            <h3 style="margin:20px ;" class="text-center">Request for Fire / Rescue / Other Incident Report</h3>
            <form action="{{route('incidentReportPost')}}" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
               @csrf
               @if(auth()->user())
               <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
               @endif
               <div class="form-row" style="margin-bottom:50px">
                  <div class="col-md-4 form-group">
                     <select name="report_type" id="report_type" class="custom-select" required>
                        <option value="">Type of Report</option>
                        <option value=" fire"> Fire</option>
                        <option value="rescue">Rescue</option>
                        <option value="other">Other</option>
                     </select>
                  </div>
                  <div class="col-md-4 form-group">
                     <input type="date" name="date" class="form-control" id="date" placeholder="Date of Incident"  required />
                  </div>
                  <div class="col-md-4 form-group">
                     <input type="number" name="aadhar_no" class="form-control" id="aadhar_no" placeholder="Aadhar Number" required />
                  </div>
                  <div class="col-md-4 form-group">
                     <input type="text" name="name" class="form-control" id="name" placeholder="Name of the person/institution" required />
                  </div>
                  <div class="col-md-4 form-group">
                     <input type="text" name="address" class="form-control" id="address" placeholder="Address" required />
                  </div>
                  <div class="col-md-4 form-group">
                     <select class="form-control" name="district_id" id="district_id" required>
                        <option value="">Select Your District</option>
                        @foreach ($districts as $dist)
                        <option value="{{ $dist->id }}">{{ ucfirst($dist->name) }} </option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-md-4 form-group">
                     <input type="email" class="form-control" name="email" id="email" placeholder="Your Email Address"  required />
                  </div>
                  <div class="col-md-4 form-group">
                     <input type="number" name="mobile_no" class="form-control" id="mobile_no" placeholder="Your Mobile  Number" required />
                  </div>
                  <div class="col-md-4 form-group">
                     <input type="text" name="contact_person" class="form-control" id="contact_person" placeholder="Contact person" required />
                  </div>

                  <!-- <div class="col-md-4">
                     <button type="submit" class="btn btn-danger mb-2 w-100">Submit</button> 
                  </div> -->
                  <div class="col-md-12 form-submit-right">
                     <button type="submit" class="btn btn-danger mb-2">Submit</button> 
                  </div>

               </div>
               
            </form>
         </div>
      </div>
   </div>
</section>
<!-- End form -->
@endsection
@section('scripts')
@stop
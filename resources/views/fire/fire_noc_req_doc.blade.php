@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Require Documents for NOC</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item"><a href="#">NOC <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Require Documents for NOC</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<!-- ======= About Section ======= -->
<section class="flagday-section py-5"> 
   <div class="container">
      <div class="row content-card content-text">
         <div class="col-md-12 pb-3">
            <h3><h2>Require Documents for NOC</h2></h3>
            <!-- <p>List of Public Information Officers / Appellate Officers in Uttarakhand Fire Service under RTI Act 2005</p> -->
         </div>

         <?php if(!empty($getData)):?>

               <table class="table table-bordered table-responsive-sm">
                  <thead>
                     <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Doucment Names</th>
                        <th scope="col">Documents PDF Files </th>
                     </tr>
                  </thead>
                  <tbody>
               <?php foreach($getData as $key => $value):?>
                  <tr>
                     <th>{{ $key+1 }}</th>
                     <th>{{ $value->hadding ?? 'NA' }}</th>
                     <th>
                           <a href="{{ asset('public/fire/service/'. $value->image) }}" class="btn btn-danger"><i class="fa fa-file"></i> Download File</a>
                     </th>
                  </tr>
               <?php endforeach;?>        
               <?php else:?>
                  <tr>
                     <th colspan="3">No Data Found</th>
                  </tr>
               <?php endif;?>         
                     
                  </tbody>
               </table>
               
      </div>
   </div>
</section>
@endsection
@section('scripts')
@stop
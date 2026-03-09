@extends('layouts.fire_new')
@section('content')
<style>
   .btn-primary:hover {
      background-color: #006270;
      border-color: #006270;
      color: #fff;
   }

   .btn-primary{
      background-color: #006270;
      border-color: #006270;
      color: #fff;
   }
</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Public Articles</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Activities <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Public Articles</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<section class="flagday-section py-5">
   <div class="container" style="margin-bottom: 40px;">
      <div class="row content-card content-text">
         <div class="col-md-12">
            <h3>Public Articles</h3>
            <!-- <p>List of Public Information Officers / Appellate Officers in Uttarakhand Fire Service under RTI Act 2005</p> -->
         </div>

         <?php if(!empty($getData)):?>

               <table class="table table-bordered table-responsive-sm">
                  <thead style="background-color:#006270; color: white;">
                     <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Public Articles Name</th>
                        <th scope="col">Public Articles File </th>
                     </tr>
                  </thead>
                  <tbody>
               <?php foreach($getData as $key => $value):?>
                  <tr>
                     <th>{{ $key+1 }}</th>
                     <th>{{ $value->hadding ?? 'NA' }}</th>
                     <th>
                           <a href="{{ asset('public/fire/service/'. $value->image) }}" class="btn btn-primary"><i class="fa fa-file"></i> Download File</a>
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
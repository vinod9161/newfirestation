@extends('layouts.fire_new')
@section('content')
<!-- ======= About Us Section ======= -->
<div class="breadcrumbs">
   <div class="container">
      <div class="d-flex justify-content-between align-items-center">
         <h2>Academy Course</h2>
         <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Academy</li>
         </ol>
      </div>
   </div>
</div>
<!-- End About Us Section -->
<!-- ======= About Section ======= -->
<div class="container" style="margin-bottom: 40px;">
   <div class="row">
      <div class="col-md-12">
         <h3 style="margin-top: 40px;"><h2>Academy Course</h2></h3>
         <!-- <p>List of Public Information Officers / Appellate Officers in Uttarakhand Fire Service under RTI Act 2005</p> -->
      </div>
   </div>
</div>
<div class="container" style="margin-bottom: 40px;">
   <div class="row">

        <?php if(!empty($getData)):?>

            <table class="table table-bordered table-responsive-sm">
               <thead>
                  <tr>
                     <th scope="col">S.No.</th>
                     <th scope="col">Course Name</th>
                     <th scope="col">Course File </th>
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
</div>
@endsection
@section('scripts')
@stop
@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Academy Results</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Academy <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Academy Results</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<div class="container" style="margin-bottom: 40px;">
   <div class="row">
      <div class="col-md-12">
         <h3 style="margin-top: 40px;"><h2>Academy Results</h2></h3>
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
                     <th scope="col">Result Name</th>
                     <th scope="col">Result File </th>
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
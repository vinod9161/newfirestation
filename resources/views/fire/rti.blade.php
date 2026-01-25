@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">RTI</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item"><a href="#">RTI & RTS <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">RTI</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<div class="container" style="margin-bottom: 40px;">
   <div class="row">
      <div class="col-md-12">
         <h3 style="margin-top: 40px;">Right To Information</h3>
         <p>List of Public Information Officers / Appellate Officers in Uttarakhand Fire Service under RTI Act 2005</p>
      </div>
   </div>
</div>
<div class="container" style="margin-bottom: 40px;">
   <div class="row">

      <?php if(!empty($getData)):?>
         <?php foreach($getData as $key => $value):?>
            <div class="col-md-12">
               <h3 style="margin-top: 40px;">{{ $value->category_name??'NA'}}</h3>
            </div>
            <table class="table table-bordered table-responsive-sm">
               <thead>
                  <tr>
                     <th scope="col">S.No.</th>
                     <th scope="col">Name of Officer </th>
                     <th scope="col">Address </th>
                     <th scope="col">Contact Number</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>{{ $value->name??'NA' }}</td>
                     <td>{{ strip_tags($value->address)??'NA' }}</td>
                     <td>{{ $value->phone??'NA' }}</td>
                  </tr>
               </tbody>
            </table>
         <?php endforeach;?>   
         <?php else: ?>
            <div class="col-md-12">
               <h3 style="margin-top: 40px;">Headquarter level public information officer</h3>
            </div>
            <table class="table table-bordered table-responsive-sm">
               <thead>
                  <tr>
                     <th scope="col">S.No.</th>
                     <th scope="col">Name of Officer </th>
                     <th scope="col">Address </th>
                     <th scope="col">Contact Number</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>Shri S.K. Rana <br>Deputy Director (Technical)</td>
                     <td>Police Headquarter 12-subhash Road, Dehradun, Uttarakhand</td>
                     <td>9412028879</td>
                  </tr>
               </tbody>
            </table>


            <div class="col-md-12">
               <h3 style="margin-top: 40px;">Headquarter level appellate authority</h3>
            </div>
            <table class="table table-bordered table-responsive-sm">
               <thead>
                  <tr>
                     <th scope="col">S.No.</th>
                     <th scope="col">Name of Officer </th>
                     <th scope="col">Address </th>
                     <th scope="col">Contact Number</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>Smt. NEERU GARG<br>DIG FIRE SERVICE</td>
                     <td>Police Headquarter 12-subhash Road, Dehradun, Uttarakhand</td>
                     <td>0135-2712685</td>
                  </tr>
               </tbody>
            </table>
      <?php endif;?>        
      
   </div>
</div>
</div>
@endsection
@section('scripts')
@stop
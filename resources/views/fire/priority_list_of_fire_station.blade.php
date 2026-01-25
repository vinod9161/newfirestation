@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Priority list of fire station</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Priority list of fire station</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

    <!-- ======= About Section ======= -->
    <div class="container">
        <div class="row">

  <h3 class="table-heading">Priority list of fire station</h3>
    <table class="table table-bordered table-responsive-sm ">
          <tr>
            <td>District</td>
            <td>Name proposed Fire Station</td>
           
          </tr>

        

          <tr class="table-color1">
              <td><strong>Pauri Garhwal </strong></td>
              <td>Satpuli</td>

          </tr>
   
        <tr class="table-color2">
            <td><strong>Chamoli</strong></td>
            <td>Gairsain </td>
        </tr>

        
          
        <tr class="table-color1">
            <td><strong>Uttarkashi</strong></td>
            <td>Purola</td>
          
        </tr>

        <tr class="table-color2">
            <td><strong>Champawat   </strong></td>
            <td>Champawat   </td>
        </tr>

        <tr class="table-color1">
            <td><strong>Udhamsingh Nagar</strong></td>
            <td>Kichchha  </td>
        </tr>
       
      </table>

 





    </div>
</div>

@endsection
@section('scripts')
@stop
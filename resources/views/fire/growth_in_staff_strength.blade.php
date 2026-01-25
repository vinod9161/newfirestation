@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Growth in staff Strength</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Growth in staff Strength</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<!-- ======= About Section ======= -->
<div class="container">
    <div class="row">

  <h3 class="table-heading">Growth in staff Strength</h3>
    <table class="table table-bordered table-responsive-sm ">
          <tr>
            <td rowspan=2 >Year</td>
            <td colspan= 7>Rank</td>
           
          </tr>

          <tr>
         
            <td ><strong>DDT</strong></td>
            <td ><strong>CFO</strong></td>
            <td ><strong>FSO</strong></td>
            <td ><strong>FSSO</strong></td>
            <td ><strong>LMF</strong></td>
            <td ><strong>F.S.Dvr</strong></td>
            <td ><strong>FM</strong></td>

          </tr>

          <tr class="table-color1">
              <td><strong>2010</strong></td>
              <td>01</td>
              <td>09</td>
              <td>33</td>
              <td>34</td>
              <td>141</td>
              <td>171</td>
              <td>870</td>

          </tr>

          
          <tr class="table-color2">
            <td><strong>2019</strong></td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
            <td>9</td>
            <td>9</td>
            <td>18</td>
            <td>54</td>
        </tr>
     


        
        <tr class="table-color1">
            <td><strong>2020</strong></td>
            <td>-</td>
            <td>-</td>
            <td>1</td>
            <td>1</td>
            <td>4</td>
            <td>4</td>
            <td>16</td>
        </tr>
       
      </table>

 





    </div>
</div>

@endsection
@section('scripts')
@stop

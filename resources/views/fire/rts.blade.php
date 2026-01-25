@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Growth in staff Strength
        </h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home
            </a></li>
            <li >Growth in staff Strength</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

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

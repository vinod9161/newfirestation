@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Organisational Structure</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Organisational Structure</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<!-- ======= About Section ======= -->
<div class="container" style="margin-bottom: 40px;">
  <div class="row">

    <section class="col-md-12">
      <h2 class="text-center">Headquarter</h2>
      @foreach($headquater as $head)
      <div class="person">
        <div class="col-md-6">
          <h4><strong><i class="fa fa-user"></i> {{ucfirst($head->name)}}</strong></h4>
          <p>{{ucfirst($head->designation)}}</p>
        </div>
        <div class="col-md-6 text-right">
          <h5><i class="fa fa-envelope"></i> <a href="mailto:{{$head->email}}">{{ucfirst($head->email)}}</a></h5>
          <p><i class="fa fa-phone"></i> {{$head->mobile}}</p>
        </div>
      </div>
      
      @endforeach 
    </section>

    
    <section class="col-md-12">
      <h2 class="text-center">District</h2>
      @foreach($district as $dist)
      <div class="person">
        <div class="col-md-6">
          <h4><strong><i class="fa fa-user"></i> {{ucfirst($dist->name)}}</strong></h4>
          <p>{{ucfirst($dist->designation)}}</p>
          <p>{{ucfirst($dist->firestation)}}, {{ucfirst($dist->district)}}</p>
        </div>
        <div class="col-md-6 text-right">
          <h5><i class="fa fa-envelope"></i> <a href="mailto:{{$dist->email}}">{{ucfirst($dist->email)}}</a></h5>
          <p><i class="fa fa-phone"></i> {{$dist->mobile}}</p>
        </div>
      </div>
      
      @endforeach 
    </section>

    
    <section class="col-md-12">
      <h2 class="text-center">Fire Station</h2>
      @foreach($firestation as $fs)
      <div class="person">
        <div class="col-md-6">
          <h4><strong><i class="fa fa-user"></i> {{ucfirst($fs->name)}}</strong></h4>
          <p>{{ucfirst($fs->designation)}}</p>
          <p>{{ucfirst($dist->firestation)}}, {{ucfirst($dist->district)}}</p>
        </div>
        <div class="col-md-6 text-right">
          <h5><i class="fa fa-envelope"></i> <a href="mailto:{{$fs->email}}">{{ucfirst($fs->email)}}</a></h5>
          <p><i class="fa fa-phone"></i> {{$fs->mobile}}</p>
        </div>
      </div>
      
      @endforeach 
    </section>


  </div>
</div>
<style>
  .person {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px 0;
    display: inline-flex;
    width:100%;
    border-radius:5px;
  }
  .person h4 , h5, a {
    color:blue;
  }
  .person p {
    margin-bottom:0px !important;
  }
</style>
@endsection
@section('scripts')
@stop
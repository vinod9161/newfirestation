@extends('layouts.main_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Special Risk Area</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Special Risk Area</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<div class="container">
    <div class="row">

        <h3 class="table-heading">Special Risk Area</h3>
        <table class="table table-bordered table-responsive-sm ">
            <thead>
                <tr>
                    <th style="width:20%;">District</th>
                    <th style="width:20%;">Fire Station</th>
                    <th style="width:60%;">Vulnerable Areas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($specialriskarea as $sra)
                <tr>
                    <td>{{$sra->district}}</td>
                    <td>{{$sra->firestation}}</td>
                    <td>{{$sra->vulnerable_areas}}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
    </div>
</div>

@endsection
@section('scripts')
@stop
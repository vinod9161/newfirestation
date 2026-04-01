@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">DG's Message</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">DG's Message</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<section class="flagday-section py-5">
    <div class="container">
        @if(!empty($dg_message))
            @foreach($dg_message as $mission)
            <div class="row message content-card content-text">
                <div class="col-md-2">
                </div>
                <div class="col-md-8 text-center">
                    <img src="{{asset('public/admin/about/dg_massage/'. $mission->image)}}" class="img-fluid img-responsive"
                        style="height:350px;object-fit:cover">
                    {!! $mission->hadding !!}
                </div>
                <div class="col-md-2">
                </div>

                <div class="col-md-12 message dg-message">
                    <p>  {!! $mission->content !!}</p>
                </div>
            </div>
            @endforeach
        @else

            <div class="row message content-card content-text">
                <h2 class="text-center">No Data Found</h2>
            </div>

        @endif
    </div>
</section>
@endsection
@section('scripts')
@stop

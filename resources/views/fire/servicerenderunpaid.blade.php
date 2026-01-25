@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Service rendered unpaid</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Service rendered unpaid</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
    <div class="container">
        @if(!empty($unpaid_data))
        @foreach($unpaid_data as $paid)
        <div class="row">
            <div class="col-lg-6 video-box <?php echo ($paid->image_position == 'left') ? '' : 'order-1 order-md-2';?>">
                <img src="{{asset('/public/admin/services/service_rendered_unpaid/'.$paid->image)}}"
                    class="img-fluid img-reponsive" alt="">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
                <h4 class="title">{{ $paid->hadding}}</a></h4>
                <p class="description"> {!! $paid->content !!}

                </p>
            </div>
        </div>
        @endforeach
        @else
        <div class="row">
            <div class="col-lg-6 video-box">
                <img src="{{asset('/public/fire/gallery/standby.jpg')}}" class="img-fluid img-reponsive" alt="">
            </div>
            <div class="col-lg-6 d-flex flex-column justify-content-center p-5">
                <h4 class="title">Service rendered unpaid</a></h4>
                <p class="description"> Fire service provides its services free of cost during disaster & emergency.
                    Fire fighting and rescue is free services. Standby duties during government authorities, law and
                    order duties and other duties as per direction of director of fire and emergency service shall be
                    free.
                </p>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
@section('scripts')
@stop

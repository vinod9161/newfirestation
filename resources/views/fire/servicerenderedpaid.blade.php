@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Service rendered paid</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Services <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Service rendered paid</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->
<!-- ======= About Section ======= -->
<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
    <div class="container">
        @if(!empty($paid_data))
            @foreach($paid_data as $paid)
            <div class="row">
                <div class="col-lg-6 video-box <?php echo ($paid->image_position == 'left') ? '' : 'order-1 order-md-2';?>">
                    <img src="{{asset('/public/admin/services/service_rendered_paid/'.$paid->image)}}" class="img-fluid img-reponsive" alt="">
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
                <h4 class="title">Service rendered paid</a></h4>
                <p class="description"> fire service provides its paid services other than the situation of disaster &
                    emergency. Personal request for standby and pumping duty shall be paid.
                </p>
            </div>
        </div>
        @endif
    </div>
</section>

@endsection
@section('scripts')
@stop

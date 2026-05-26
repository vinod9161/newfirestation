@extends('layouts.fire_new')

@section('content')

<section class="breadcrumb-section">

    <div class="overlay"></div>

    <div class="breadcrumb-content">

        <h1 class="breadcrumb-item">
            Fire Service Day
        </h1>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="{{ route('actionIndex') }}">

                        Home <i class="fa fa-angle-double-right"></i>

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="#">

                        About Us <i class="fa fa-angle-double-right"></i>

                    </a>

                </li>

                <li class="breadcrumb-item active" aria-current="page">

                    Fire Service Day

                </li>

            </ol>

        </nav>

    </div>

</section>

@if(!empty($fire_service_day) && count($fire_service_day) > 0)

    @foreach($fire_service_day as $flag)

    <section class="why-us section-bg py-5" data-aos="fade-up">

        <div class="container">

            <div class="row align-items-stretch">

                <div class="col-lg-6 mb-4">

                    <div class="content-card h-100">

                        <img
                            src="{{ asset('/public/admin/about/fire_service_day/'.$flag->image) }}"
                            class="img-fluid rounded w-100"
                            alt="{{ $flag->hadding }}"
                        >

                    </div>

                </div>

                <div class="col-lg-6 mb-4">

                    <div class="content-card h-100">

                        <img
                            src="{{ asset('/public/admin/about/fire_service_day/'.$flag->image1) }}"
                            class="img-fluid rounded w-100"
                            alt="{{ $flag->hadding }}"
                        >

                    </div>

                </div>

                <div class="col-12">

                    <div class="content-card content-text">

                        <h3 class="mb-3">
                            {{ $flag->hadding }}
                        </h3>

                        {!! $flag->content !!}

                    </div>

                </div>

            </div>

        </div>

    </section>

    @endforeach

@else

<section class="flagday-section py-5">

    <div class="container">

        <div class="alert alert-warning text-center">

            No Fire Service Day content available.

        </div>

    </div>

</section>

@endif

@endsection

@section('scripts')
@stop
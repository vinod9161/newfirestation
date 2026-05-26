@extends('layouts.fire_new')

@section('content')

<section class="breadcrumb-section">
    <div class="overlay"></div>

    <div class="breadcrumb-content">
        <h1 class="breadcrumb-item">
            {{ $history->hadding }}
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
                    History
                </li>
            </ol>
        </nav>
    </div>
</section>

<section class="about flagday-section py-5" data-aos="fade-up">
    <div class="container">

        <div class="row content-card content-text">

            <div class="col-lg-6">
                <img 
                    src="{{ asset('public/admin/about/history/'.$history->image) }}"
                    class="img-fluid rounded w-100"
                    alt="{{ $history->hadding }}"
                >
            </div>

            <div class="col-lg-6 pt-4 pt-lg-0">
                {!! $history->content !!}
            </div>

        </div>

    </div>
</section>

@endsection

@section('scripts')
@stop
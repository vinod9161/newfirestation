@extends('layouts.fire_new')

@section('content')

<section class="breadcrumb-section">

    <div class="overlay"></div>

    <div class="breadcrumb-content">

        <h1 class="breadcrumb-item">
            Tutorial
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

                <li class="breadcrumb-item active">

                    Tutorial

                </li>

            </ol>

        </nav>

    </div>

</section>

<section class="flagday-section py-5">

    <div class="container">

        <div class="row">

            @foreach($tutorials as $tutorial)

            <div class="col-lg-12 mb-12">

                <div class="content-card content-text">

                    <h4 class="mb-3">
                        {{ $tutorial->hadding }}
                    </h4>

                    <iframe
                        width="100%"
                        height="350"
                        src="{{ trim($tutorial->content) }}"
                        title="{{ $tutorial->hadding }}"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endsection

@section('scripts')
@stop
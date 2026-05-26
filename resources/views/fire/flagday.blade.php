@extends('layouts.fire_new')

@section('content')

<style>

.flagday-section{
    background:#f5f7fb;
}

.section-title{
    font-size:32px;
    font-weight:600;
    color:#0b2c6d;
}

.section-subtitle{
    font-size:16px;
    color:#555;
    margin-top:8px;
}

.content-card{
    background:#ffffff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 4px 16px rgba(0,0,0,0.08);
}

.content-text{
    font-size:16px;
    line-height:1.8;
    color:#333;
}

ul{
    margin:revert;
    padding:revert;
    list-style:revert;
}

</style>

<section class="breadcrumb-section">

    <div class="overlay"></div>

    <div class="breadcrumb-content">

        <h1 class="breadcrumb-item">
            Flag Day
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

                    Flag Day

                </li>

            </ol>

        </nav>

    </div>

</section>

<section class="flagday-section py-5">

    <div class="container">

        @if(!empty($flag_day) && count($flag_day) > 0)

            @foreach($flag_day as $flag)

            <div class="row align-items-stretch mb-4">

                <div class="col-lg-6 mb-4">

                    <div class="content-card h-100">

                        <img
                            src="{{ asset('/public/admin/about/flag_day/'.$flag->image) }}"
                            class="img-fluid rounded w-100"
                            alt="{{ $flag->hadding }}"
                        >

                    </div>

                </div>

                <div class="col-lg-6 mb-4">

                    <div class="content-card h-100">

                        <img
                            src="{{ asset('/public/admin/about/flag_day/'.$flag->image1) }}"
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

            @endforeach

        @else

        <div class="alert alert-warning text-center">

            No Flag Day content available.

        </div>

        @endif

    </div>

</section>

@endsection

@section('scripts')
@stop
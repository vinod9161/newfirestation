@extends('layouts.fire_new')

@section('content')

<style>
.flagday-section{
    background:#f5f7fb;
}

.content-card{
    background:#ffffff;
    padding:20px;
    border-radius:10px;
    box-shadow:0 4px 16px rgba(0,0,0,0.08);
}


.objective-icon{
    font-size:40px;
    color:#0b2a6f;
    margin-bottom:10px;
}

.objective-title{
    font-weight:600;
}

.detail-card{
    background:#f8f9fa;
    border-left:5px solid #0b2a6f;
}

ul{
    margin:revert;
    padding:revert;
    list-style:revert;
}

.objective-card{
    border:1px solid #dee2e6;
    border-top:4px solid #0b2a6f;
    transition:0.3s;
    height:100%;
    cursor:pointer;
}

.objective-card:hover{
        background: linear-gradient(90deg, rgb(17, 94, 89) 0%, rgb(17, 94, 89, 1) 30%, rgb(0, 37, 142, .3) 100%);
    box-shadow:0 4px 14px rgba(0,0,0,0.15);
    transform:translateY(-5px);
}

.objective-card:hover .objective-title,
.objective-card:hover .text-muted,
.objective-card:hover .read-more,
.objective-card:hover .objective-icon{
    color:#ffffff !important;
}

.objective-card .card-body{
    transition:0.3s;
}

.read-more{
    font-weight:500;
    color:#0b2a6f;
    text-decoration:none;
}
.card:hover p{
    color: #fff !important;
}
</style>

<section class="breadcrumb-section">
    <div class="overlay"></div>

    <div class="breadcrumb-content">

        <h1 class="breadcrumb-item">
            {{ $topSection->hadding ?? 'Our Objective' }}
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
                    Our Objective
                </li>

            </ol>
        </nav>

    </div>
</section>

@if($topSection)

<section class="flagday-section py-5">

    <div class="container">

        <div class="row align-items-stretch content-text">

            <div class="col-lg-6 mb-4">

                <div class="content-card h-100">

                    <img
                        src="{{ asset('public/admin/about/our_objective/'.$topSection->image) }}"
                        class="img-fluid rounded w-100"
                        alt="{{ $topSection->hadding }}"
                    >

                </div>

            </div>

            <div class="col-lg-6 mb-4">

                <div class="content-card content-text">

                    {!! $topSection->content !!}

                </div>

            </div>

        </div>

    </div>

</section>

@endif

@if(count($cards) > 0)

<section class="flagday-section">

    <div class="container pb-5">

        <div class="row">

            @foreach($cards as $key => $card)

            <div class="col-md-4 mb-4">

                <div class="card objective-card text-center">

                    <div class="card-body">

                        <div class="objective-icon">

                            @if($key == 0)
                                🛡️
                            @elseif($key == 1)
                                🏛️
                            @else
                                🚑
                            @endif

                        </div>

                        <h5 class="objective-title">
                            {{ $card->hadding }}
                        </h5>

                        <p class="text-muted">
                            {{ $card->short_content }}
                        </p>

                        <a
                            class="read-more"
                            data-toggle="collapse"
                            href="#objective{{ $key }}"
                            role="button"
                            aria-expanded="false"
                            aria-controls="objective{{ $key }}"
                        >
                            Read More →
                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

        @foreach($cards as $key => $card)

        <div id="objective{{ $key }}" class="collapse mt-4">

            <div class="card detail-card">

                <div class="card-body">

                    {!! $card->content !!}

                </div>

            </div>

        </div>

        @endforeach

    </div>

</section>

@endif

@if($bottomSection)

<section class="flagday-section pb-5">

    <div class="container">

        <div class="row align-items-stretch">

            <div class="col-12">

                <div class="content-card content-text">

                    <h4 class="title">
                        {{ $bottomSection->hadding }}
                    </h4>

                    {!! $bottomSection->content !!}

                </div>

            </div>

        </div>

    </div>

</section>

@endif

@endsection

@section('scripts')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

@stop
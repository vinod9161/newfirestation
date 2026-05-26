@extends('layouts.fire_new')

@section('content')

<style>

body{
    background:#f4f6f9;
}

.status-card{
    border-radius:15px;
    border:none;
    position:relative;
    overflow:hidden;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
    transition:0.3s;
    background:#fff;
}

.status-card:hover{
    transform:translateY(-10px);
}

.status-card .card-body{
    padding:15px;
}

.left-border{
    position:absolute;
    top:0;
    left:0;
    width:6px;
    height:100%;
    border-radius:15px 0 0 15px;
}

.status-text{
    font-size:20px;
    font-weight:600;
}

</style>

<section class="breadcrumb-section">

    <div class="overlay"></div>

    <div class="breadcrumb-content">

        <h1 class="breadcrumb-item">

            {{ $topSection->hadding ?? 'Fire Fighting and Rescue Operation' }}

        </h1>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="{{ route('actionIndex') }}">

                        Home
                        <i class="fa fa-angle-double-right"></i>

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="#">

                        Services
                        <i class="fa fa-angle-double-right"></i>

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    {{ $topSection->hadding ?? 'Fire Fighting and Rescue Operation' }}

                </li>

            </ol>

        </nav>

    </div>

</section>

<section class="services flagday-section py-5">

    <div class="container">

        <div class="row content-card content-text">

            @if($topSection)

            <div class="col-md-12">

                <h3 class="text-center">

                    {{ $topSection->hadding }}

                </h3>

                <div class="why-us section-bg aos-init aos-animate">

                    {!! $topSection->content !!}

                </div>

            </div>

            @endif

            <div class="col-md-12">

                <h3 class="text-center heading pb-4">
                    Fire Fighting
                </h3>

            </div>

            @php

            $colors = [
                'bg-success',
                'bg-primary',
                'bg-warning',
                'bg-danger'
            ];

            $customColors = [
                '#6f42c1',
                '#00258e',
                '#f44336',
                '#8bc34a',
                '#9e9e9e',
                '#2a16e9d1',
                '#fa00d8d1'
            ];

            @endphp

            @foreach($fireFighting as $key => $item)

            <div class="col-md-6 mb-4">

                <div class="status-card">

                    @if(isset($colors[$key]))

                        <div class="left-border {{ $colors[$key] }}"></div>

                    @else

                        <div
                            class="left-border"
                            style="background:{{ $customColors[$key % count($customColors)] }}"
                        ></div>

                    @endif

                    <div class="card-body">

                        <div class="status-text text-dark">

                            {{ $item->hadding }}

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

            <div class="col-md-12">

                <h3 class="text-center heading py-4">
                    Rescue
                </h3>

            </div>

            @foreach($rescue as $key => $item)

            <div class="col-md-4 mb-4">

                <div class="status-card">

                    @if(isset($colors[$key]))

                        <div class="left-border {{ $colors[$key] }}"></div>

                    @else

                        <div
                            class="left-border"
                            style="background:{{ $customColors[$key % count($customColors)] }}"
                        ></div>

                    @endif

                    <div class="card-body">

                        <div class="status-text text-dark">

                            {{ $item->hadding }}

                        </div>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

@endsection

@section('scripts')
@stop
@extends('layouts.fire_new')
@section('content')
<style>
    h2 {
        color: #e67e22;
        margin-bottom: 40px;
    }

    .medal-container {
        display: flex;
        justify-content: center;
        gap: 50px;
        flex-wrap: wrap;
    }

    .medal-card {
        width: 200px;
        text-align: center;
    }

    .medal-card img {
        width: auto;
        height: 300px;
    }

    .count {
        background: #1e7e34;
        color: #fff;
        padding: 8px 20px;
        border-radius: 20px;
        display: inline-block;
        margin-top: 15px;
        font-weight: bold;
    }

    .medal-name {
        margin-top: 10px;
        font-size: 17px;
        font-weight: 600;
    }

    .divider {
        width: 2px;
        background: #ccc;
        height: 300px;
    }

    @media(max-width: 768px) {
        .medal-container {
            flex-direction: column;
            align-items: center;
        }
        .divider {
            display: none;
        }
    }
</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Medal Winners</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Medal Winners</li>
        </ol>
    </nav>
    </div>
</section>
<!--Sub Header End-->

<!--Main Content Start-->
<section class="flagday-section pb-5">
    <div class="main-content p80">
        <!--Department Details Page Start-->
        <div class="department-details">
            <div class="container-fluid">
                <div class="row content-card content-text">
                    <div class="col-md-12 pb-40">
                        <div class="row">
                            
                            <!-- <div class="col-lg-12 text-center mb-3">
                                <div class="medal-container">
                                    <a href="{{ route('actionAwards') }}">
                                        <div class="medal-card">
                                            <img src="{{ asset('public/new_assets/img/content/President-Medal-Distinguished-Service.png') }}" alt="Medal 1">
                                            <div class="count">21</div>
                                            <div class="medal-name">President Fire Service Medal for Distinguished Service</div>
                                        </div>
                                    </a>

                                    <div class="divider"></div>
                                    
                                    <a href="{{ route('actionAwards') }}">
                                        <div class="medal-card">
                                            <img src="{{ asset('public/new_assets/img/content/President-Meritorious-Service.png') }}" alt="Medal 2">
                                            <div class="count">214</div>
                                            <div class="medal-name">President Fire Service Medal for Meritorious Service</div>
                                        </div>
                                    </a>

                                    <div class="divider"></div>

                                    <a href="{{ route('actionAwards') }}">
                                        <div class="medal-card">
                                            <img src="{{ asset('public/new_assets/img/content/Governor-Excellent-Service-Medal.png') }}" alt="Medal 3">
                                            <div class="count">133</div>
                                            <div class="medal-name">Governor Excellent Service Medal</div>
                                        </div>
                                    </a>

                                    <div class="divider"></div>

                                    <a href="{{ route('actionAwards') }}">
                                        <div class="medal-card">
                                            <img src="{{ asset('public/new_assets/img/content/Chief-Minister-Meritorious-Service-Medal.png') }}" alt="Medal 4">
                                            <div class="count">98</div>
                                            <div class="medal-name">Chief Minister Meritorious Service Medal</div>
                                        </div>
                                    </a>

                                </div>
                            </div> -->
                            
                            
                            <div class="col-lg-12 text-center mb-3">
                                <div class="medal-container">

                                    @foreach($categories as $category)

                                        <a href="{{ route('actionAwards', ['id' => $category->id]) }}">
                                            <div class="medal-card">

                                                {{-- Medal Image --}}
                                                <!-- <img src="{{ asset('public/new_assets/img/content/President-Medal-Distinguished-Service.png') }}" alt="Medal"> -->
                                                @if($category->image && $category->image != '')
                                                    <img src="{{ asset('public/'.$category->image) }}" alt="Medal">
                                                @else
                                                    <img src="{{ asset('public/new_assets/img/content/President-Medal-Distinguished-Service.png') }}" alt="Medal">
                                                @endif                                            

                                                {{-- Winner Count --}}
                                                <div class="count">
                                                    {{ $category->total }}
                                                </div>

                                                {{-- Category Name --}}
                                                <div class="medal-name">
                                                    {{ $category->category_name }}
                                                </div>

                                            </div>
                                        </a>

                                        <div class="divider"></div>

                                    @endforeach

                                </div>
                            </div>


                            
                            
                            
                        </div>
                    </div>
                    
                </div>
            
                
            </div>
        </div>
        <!--Department Details Page End-->
    </div>
</section>
<!--Main Content End-->
@endsection
@section('scripts')
@stop

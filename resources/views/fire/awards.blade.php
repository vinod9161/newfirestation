@extends('layouts.fire_new')
@section('content')
<style>

    /* ===== HEADER ===== */
    .header1{
        background:#ffffff;
        padding:15px 40px;
        border-bottom:3px solid #904861;
        font-weight:bold;
        font-size:20px;
    }

    /* ===== ADVANCED SEARCH BAR ===== */
    .search-section{
        background:#004861;
        padding:25px 40px;
        color:#fff;
    }

    .search-title{
        font-size:20px;
        margin-bottom:15px;
    }

    .search-row{
        display:flex;
        gap:15px;
    }

    .search-row input{
        flex:1;
        padding:12px;
        border-radius:25px;
        border:none;
        font-size:14px;
    }

    .search-row button{
        background:#1e7e34;
        border:none;
        padding:12px 30px;
        color:#fff;
        border-radius:25px;
        cursor:pointer;
        font-weight:bold;
    }

    .search-row button:hover{
        background:#149925;
    }

    /* ===== CARD GRID ===== */
    .card-container{
        padding:40px;
        display:grid;
        grid-template-columns: repeat(auto-fit, minmax(250px,1fr));
        gap:25px;
    }

    /* ===== CARD ===== */
    .card{
        background:#fff;
        border-radius:10px;
        box-shadow:0 0px 20px rgba(0,0,0,0.15);
        text-align:center;
        padding:25px 15px;
        position:relative;
    }

    .card img.profile{
        width:130px;
        height:130px;
        border-radius:50%;
        object-fit:cover;
        margin-left: 33%;
    }

    /* .medal-icon{
        position:absolute;
        top:15px;
        right:15px;
        width:50px;
        font-weight: 600;
        color: #c2291d;
    } */
    .medal-icon {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 5px 12px;
        border-radius: 20px;
        color: #fff;
        font-size: 14px;
        font-weight: bold;
        max-width: 120px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .bg-primary {
        background-color: #006270 !important;
    }

    .name{
        font-weight:bold;
        margin-top:15px;
        /* color:#2c3e50; */
    }

    /* .award{
        color:#f26c23;
        margin:8px 0 15px 0;
        font-size:14px;
    } */

    .view-btn{
        background:#00258e;
        color:#fff;
        border:none;
        padding:8px 20px;
        border-radius:20px;
        cursor:pointer;
    }

    .view-btn:hover{
        background:#004861;
    }
    .card:hover {
        /* background: linear-gradient(90deg, rgb(0, 37, 142) 0%, rgb(0, 37, 142, .5) 50%, rgb(0, 37, 142, .3) 100%); */
        background: linear-gradient(90deg, rgb(17, 94, 89) 0%, rgb(17, 94, 89, 1) 30%, rgb(0, 37, 142, .3) 100%);
        transform: translateY(-5px);
        border-color: #3ec0ff;
        color: #fff;
    }

    /* ===== GREEN SECTION BUTTONS ===== */
    .section-buttons{
        padding:0 40px 40px;
        display:flex;
        gap:20px;
        flex-wrap:wrap;
    }

    .section-buttons button{
        flex:1;
        background:#1e7e34;
        color:#fff;
        padding:15px;
        border:none;
        border-radius:6px;
        font-size:16px;
        cursor:pointer;
    }
</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
    <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Awards</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Awards</li>
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
                            
                            <div class="col-lg-12 text-center mb-3">

                                <!-- SEARCH SECTION -->
                                <div class="search-section">
                                    <div class="search-title">Advanced Search</div>
                                    <div class="search-row">
                                        <input type="text" placeholder="Name of Awardees">
                                        <button>Advanced Search</button>
                                    </div>
                                </div>

                                <!-- CARD GRID -->
                                <!-- <div class="card-container">

                                    <div class="card">
                                        <img src="{{ asset('public/new_assets/img/content/medal-4.png') }}" class="profile">
                                        <span class="medal-icon">2026</span>
                                        <div class="name">CAPTAIN VIKRAM BATRA</div>
                                        <div class="designation">(FSSO)</div>
                                        <div class="occasion">Republic Day 2025</div>
                                        <div class="award">Param Vir Chakra</div>
                                    </div>
                                    <div class="card">
                                        <img src="{{ asset('public/new_assets/img/content/medal-4.png') }}" class="profile">
                                        <span class="medal-icon">2026</span>
                                        <div class="name">CAPTAIN VIKRAM BATRA</div>
                                        <div class="designation">(FSSO)</div>
                                        <div class="occasion">Republic Day 2025</div>
                                        <div class="award">Param Vir Chakra</div>
                                    </div>
                                    <div class="card">
                                        <img src="{{ asset('public/new_assets/img/content/medal-4.png') }}" class="profile">
                                        <span class="medal-icon">2026</span>
                                        <div class="name">CAPTAIN VIKRAM BATRA</div>
                                        <div class="designation">(FSSO)</div>
                                        <div class="occasion">Republic Day 2025</div>
                                        <div class="award">Param Vir Chakra</div>
                                    </div>
                                    <div class="card">
                                        <img src="{{ asset('public/new_assets/img/content/medal-4.png') }}" class="profile">
                                        <span class="medal-icon">2026</span>
                                        <div class="name">CAPTAIN VIKRAM BATRA</div>
                                        <div class="designation">(FSSO)</div>
                                        <div class="occasion">Republic Day 2025</div>
                                        <div class="award">Param Vir Chakra</div>
                                    </div>


                                </div> -->

                                <div class="card-container">

                                    @foreach($awards as $award)
                                        <div class="card">
                                            <img src="{{ asset('public/new_assets/img/content/medal-4.png') }}" class="profile">

                                            <span class="medal-icon bg-primary">{{ $award->year }}</span>

                                            <div class="name">{{ strtoupper($award->name) }}</div>

                                            <div class="designation">
                                                ({{ $award->designation }})
                                            </div>

                                            <div class="occasion">
                                                {{ $award->occassion ?? 'N/A' }}
                                            </div>

                                            <div class="award">
                                                {{ $award->category_name }}
                                            </div>
                                        </div>
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

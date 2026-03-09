@extends('layouts.fire_new')
@section('content')
<style>
  .content-card .nav-tabs  {
    list-style: none !important;
  }
  /* Custom Dropdown Style */
  #districtFilter {
      border-radius: 30px;
      padding: 5px 20px;
      border: 2px solid #0d2c7d;
      font-weight: 500;
      min-width: 220px;
      transition: 0.3s;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      appearance: none;
      background-color: #fff;
      background-image: url("data:image/svg+xml;utf8,<svg fill='%230d2c7d' height='20' viewBox='0 0 24 24' width='20' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/></svg>");
      background-repeat: no-repeat;
      background-position: right 15px center;
      background-size: 18px;
  }

  #districtFilter:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 0 3px rgba(0,123,255,0.2);
  }
</style>
<style>

    .header1{
        background:#ffffff;
        padding:15px 40px;
        border-bottom:3px solid #904861;
        font-weight:bold;
        font-size:20px;
    }

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

    .card-container{
        padding:40px;
        display:grid;
        /* grid-template-columns: repeat(auto-fit, minmax(250px,1fr)); */
        grid-template-columns: repeat(3, 1fr);
        gap:25px;
    }

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

    .name{
        font-weight:bold;
        margin-top:15px;
    }

    /* .award{
        color:#f26c23;
        margin:8px 0 15px 0;
        font-size:14px;
        font-weight: 400;
    } */

    .view-btn{
        background:#006270;
        color:#fff;
        border:none;
        padding:8px 20px;
        border-radius:20px;
        cursor:pointer;
    }

    .view-btn:hover{
        background:#004861;
    }

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
    .bg-primary {
        background-color: #006270 !important;
    }
    .bg-secondary {
        background-color: #006270 !important;
    }
    .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        background-color: #006270;
        color: #fff !important;
    }
    
    .card:hover {
        /* background: linear-gradient(90deg, rgb(0, 37, 142) 0%, rgb(0, 37, 142, .5) 50%, rgb(0, 37, 142, .3) 100%); */
        background: linear-gradient(90deg, rgb(17, 94, 89) 0%, rgb(17, 94, 89, 1) 30%, rgb(0, 37, 142, .3) 100%);
        transform: translateY(-5px);
        border-color: #3ec0ff;
        color: #fff;
    }
    .name:hover {
        color: #fff;
    }
</style>

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Organisational Structure</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Organisational Structure</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->


<section class="flagday-section py-5">
  <div class="container content-card content-text">

      <ul class="nav nav-tabs justify-content-center mb-4">
          <li class="nav-item">
              <a class="nav-link active filter-tab" data-filter="all" href="#">All</a>
          </li>
          <li class="nav-item">
              <a class="nav-link filter-tab" data-filter="hq" href="#">HQ</a>
          </li>
          <li class="nav-item">
              <a class="nav-link filter-tab" data-filter="district" href="#">District</a>
          </li>
          <li class="nav-item">
              <a class="nav-link filter-tab" data-filter="firestation" href="#">Fire Station</a>
          </li>
      </ul>

      <div class="text-center mb-4 d-none" id="districtDropdown">
          <!-- <select class="form-control w-auto mx-auto" id="districtFilter">
              <option value="all">Select District</option>
              @foreach($district->pluck('district')->unique() as $districtName)
                  <option value="{{ strtolower($districtName) }}">
                      {{ ucfirst($districtName) }}
                  </option>
              @endforeach
          </select> -->
            @php
                $allDistricts = $district->pluck('district')
                    ->merge($firestation->pluck('district'))
                    ->unique()
                    ->filter()
                    ->sort();
            @endphp

            <select class="form-control w-auto mx-auto" id="districtFilter">
                <option value="all">Select District</option>
                @foreach($allDistricts as $districtName)
                    <option value="{{ strtolower($districtName) }}">
                        {{ ucfirst($districtName) }}
                    </option>
                @endforeach
            </select>
      </div>

    <div class="row">
        <div class="col-lg-12 text-center mb-3">

            <div class="card-container">

                {{-- ================= HQ ================= --}}
                @foreach($headquater as $head)
                <div class="card officer-card" data-type="hq">

                    <img src="{{ $head->profile_pic ? asset('public/'.$head->profile_pic) : '' }}"
                        onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($head->name) }}&size=150&background=006270&color=fff';"
                        class="profile">

                    <span class="medal-icon bg-primary">HQ</span>

                    <div class="name">
                        {{ strtoupper($head->name) }}
                    </div>

                    <div class="designation">
                        ({{ $head->designation }})
                    </div>

                    <div class="occasion">
                        {{ $head->email }}
                    </div>

                    <div class="award">
                        Mobile: {{ $head->mobile }}
                    </div>

                </div>
                @endforeach



                {{-- ================= DISTRICT ================= --}}
                @foreach($district as $dist)
                <div class="card officer-card"
                    data-type="district"
                    data-district="{{ strtolower($dist->district) }}">

                    <img src="{{ $dist->profile_pic ? asset('public/'.$dist->profile_pic) : '' }}"
                        onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($dist->name) }}&size=150&background=006270&color=fff';"
                        class="profile">

                    <span class="medal-icon bg-primary">
                        <!-- {{ ucfirst($dist->district) }} -->
                        {{ strtoupper(substr($dist->district, 0, 3)) }}
                    </span>

                    <div class="name">
                        {{ strtoupper($dist->name) }}
                    </div>

                    <div class="designation">
                        ({{ $dist->designation }})
                    </div>

                    <div class="occasion">
                        {{ $dist->email }}
                    </div>

                    <div class="award">
                        Mobile: {{ $dist->mobile }}
                    </div>

                </div>
                @endforeach



                {{-- ================= FIRE STATION ================= --}}
                @foreach($firestation as $fs)
                <div class="card officer-card"
                    data-type="firestation"
                    data-district="{{ strtolower($fs->district) }}">

                    <img src="{{ $fs->profile_pic ? asset('public/'.$fs->profile_pic) : '' }}"
                        onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($fs->name) }}&size=150&background=006270&color=fff';"
                        class="profile">

                    <span class="medal-icon bg-dark">
                        <!-- {{ ucfirst($fs->firestation) }} -->
                        {{ strtoupper(substr($fs->firestation, 0, 3)) }}
                    </span>

                    <div class="name">
                        {{ strtoupper($fs->name) }}
                    </div>

                    <div class="designation">
                        ({{ $fs->designation }})
                    </div>

                    <div class="occasion">
                        {{ $fs->email }}
                    </div>

                    <div class="award">
                        Mobile: {{ $fs->mobile }}
                    </div>

                </div>
                @endforeach

            </div>
        </div>
    </div>
  </div>
</section>

<!-- ================= SCRIPT ================= -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script>
$(document).ready(function(){

    $('.filter-tab').click(function(e){
        e.preventDefault();

        $('.filter-tab').removeClass('active');
        $(this).addClass('active');

        var filter = $(this).data('filter');

        if(filter === "district" || filter === "firestation"){
            $('#districtDropdown').removeClass('d-none');
        } else {
            $('#districtDropdown').addClass('d-none');
            $('#districtFilter').val('all');
        }

        if(filter === "all"){
            $('.officer-card').show();
        } else {
            $('.officer-card').hide();
            $('.officer-card[data-type="'+filter+'"]').show();
        }
    });

    $('#districtFilter').change(function(){
        var district = $(this).val();

        var filter = $('.filter-tab.active').data('filter');
        if(filter === "district"){
            if(district === "all"){
                $('.officer-card[data-type="district"]').show();
            } else {
                $('.officer-card[data-type="district"]').hide();
                $('.officer-card[data-district="'+district+'"]').show();
            }
        }else if(filter === "firestation"){
            if(district === "all"){
                $('.officer-card[data-type="firestation"]').show();
            } else {
                $('.officer-card[data-type="firestation"]').hide();
                $('.officer-card[data-type="firestation"][data-district="'+district+'"]').show();
            }
        }        
    });

});
</script>


<!-- ======= About Section ======= -->
<!-- <section class="flagday-section py-5">
  <div class="container" style="margin-bottom: 40px;">
    <div class="row content-card content-text">

      <section class="col-md-12">
        <h2 class="text-center">Headquarter</h2>
        @foreach($headquater as $head)
        <div class="person">
          <div class="col-md-6">
            <h4><strong><i class="fa fa-user"></i> {{ucfirst($head->name)}}</strong></h4>
            <p>{{ucfirst($head->designation)}}</p>
          </div>
          <div class="col-md-6 text-right">
            <h5><i class="fa fa-envelope"></i> <a href="mailto:{{$head->email}}">{{ucfirst($head->email)}}</a></h5>
            <p><i class="fa fa-phone"></i> {{$head->mobile}}</p>
          </div>
        </div>
        
        @endforeach 
      </section>

      
      <section class="col-md-12">
        <h2 class="text-center">District</h2>
        @foreach($district as $dist)
        <div class="person">
          <div class="col-md-6">
            <h4><strong><i class="fa fa-user"></i> {{ucfirst($dist->name)}}</strong></h4>
            <p>{{ucfirst($dist->designation)}}</p>
            <p>{{ucfirst($dist->firestation)}}, {{ucfirst($dist->district)}}</p>
          </div>
          <div class="col-md-6 text-right">
            <h5><i class="fa fa-envelope"></i> <a href="mailto:{{$dist->email}}">{{ucfirst($dist->email)}}</a></h5>
            <p><i class="fa fa-phone"></i> {{$dist->mobile}}</p>
          </div>
        </div>
        
        @endforeach 
      </section>

      
      <section class="col-md-12">
        <h2 class="text-center">Fire Station</h2>
        @foreach($firestation as $fs)
        <div class="person">
          <div class="col-md-6">
            <h4><strong><i class="fa fa-user"></i> {{ucfirst($fs->name)}}</strong></h4>
            <p>{{ucfirst($fs->designation)}}</p>
            <p>{{ucfirst($dist->firestation)}}, {{ucfirst($dist->district)}}</p>
          </div>
          <div class="col-md-6 text-right">
            <h5><i class="fa fa-envelope"></i> <a href="mailto:{{$fs->email}}">{{ucfirst($fs->email)}}</a></h5>
            <p><i class="fa fa-phone"></i> {{$fs->mobile}}</p>
          </div>
        </div>
        
        @endforeach 
      </section>


    </div>
  </div>
</section>
<style>
  .person {
    border: 1px solid #ccc;
    padding: 10px;
    margin: 10px 0;
    display: inline-flex;
    width:100%;
    border-radius:5px;
  }
  .person h4 , h5, a {
    color:blue;
  }
  .person p {
    margin-bottom:0px !important;
  }
</style> -->

@endsection
@section('scripts')
@stop
@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Welfare Amenity</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Establishment <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Welfare Amenity</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<style>
  body {
    font-family: 'Circular Std Book', sans-serif;
    font-size: 14px;
    color: #333;
    background-color: #f4f4f9;
  }

  .mt-20 {
    margin-top: 50px !important;
  }

  h1, h2, h3, h4, h5, h6 {
    color: #3d405c;
    font-family: 'Circular Std Medium', sans-serif;
  }

  h2 {
    font-size: 28px;
    line-height: 1.2;
    margin-bottom: 20px;
  }

  p {
    margin: 0 0 20px;
    line-height: 1.6;
/*    color: #555;*/
  }

  a {
    color: #007bff;
    text-decoration: none;
  }

  a:hover {
    color: #0056b3;
    text-decoration: underline;
  }

  .btn-secondary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn {
    font-size: 14px;
    padding: 10px 20px;
    border-radius: 4px;
  }

  .tab-vertical .nav.nav-tabs {
    border-bottom: none;
    display: flex;
    flex-direction: column;
    width: 300px; /* Adjust the width as needed */
  }

  .tab-vertical .nav-item {
    margin-bottom: 5px;
  }

  .tab-vertical .nav-tabs .nav-link {
    background-color: #e9ecef;
    border: 1px solid #ddd;
    color: #333;
    border-radius: 4px 0 0 4px;
    padding: 15px 20px;
    text-align: left;
    transition: background-color 0.3s ease;
  }

  .tab-vertical .nav-tabs .nav-link:hover {
    background-color: #ddd;
  }

  .tab-vertical .nav-tabs .nav-link.active {
    background-color: #d73502;
    color: #fff;
    border-color: #d73502;
  }

  .tab-vertical .tab-content {
    flex-grow: 1;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 0 4px 4px 4px;
    padding: 30px;
    margin-left: 10px;
  }

  .tab-vertical .nav-tabs {
    margin-right: 0;
  }

  .tab-pane p {
    margin-bottom: 15px;
  }
</style>
<style>
  body {
    font-family: 'Circular Std Book', sans-serif;
    font-size: 14px;
    color: #333;
    background-color: #f4f4f9;
  }

  .mt-20 {
    margin-top: 50px !important;
  }

  h1, h2, h3, h4, h5, h6 {
    color: #3d405c;
    font-family: 'Circular Std Medium', sans-serif;
  }

  h2 {
    font-size: 28px;
    line-height: 1.2;
    margin-bottom: 20px;
  }

  p {
    margin: 0 0 20px;
    line-height: 1.6;
/*    color: #555;*/
  }

  a {
    color: #007bff;
    text-decoration: none;
  }

  a:hover {
    color: #0056b3;
    text-decoration: underline;
  }

  .btn-secondary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn {
    font-size: 14px;
    padding: 10px 20px;
    border-radius: 4px;
  }

  .tab-vertical .nav.nav-tabs {
    border-bottom: none;
    display: flex;
    flex-direction: column;
    width: 300px; /* Adjust the width as needed */
  }

  .tab-vertical .nav-item {
    margin-bottom: 5px;
  }

  .tab-vertical .nav-tabs .nav-link {
    background-color: #e9ecef;
    border: 1px solid #ddd;
    color: #333;
    border-radius: 4px 0 0 4px;
    padding: 15px 20px;
    text-align: left;
    transition: background-color 0.3s ease;
  }

  .tab-vertical .nav-tabs .nav-link:hover {
    background-color: #ddd;
  }

  .tab-vertical .nav-tabs .nav-link.active {
    background-color: #d73502;
    color: #fff;
    border-color: #d73502;
  }

  .tab-vertical .tab-content {
    flex-grow: 1;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 0 4px 4px 4px;
    padding: 30px;
    margin-left: 10px;
  }

  .tab-vertical .nav-tabs {
    margin-right: 0;
  }

  .tab-pane p {
    margin-bottom: 15px;
  }
</style>
<style>

/* Make vertical layout */
#myTab3 {
    width: 280px;
    border-bottom: none;
    list-style: none;     /* removes dots */
    padding-left: 0;      /* removes left space */
    margin-left: 0;
}

#myTab3 .nav-item {
    width: 100%;
    margin-bottom: 20px;
    list-style: none;
}

/* Card Style */
#myTab3 .nav-link {
    background: #e9ecef;
    border: none;
    padding: 18px 25px;
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    position: relative;
    transition: all 0.3s ease;
}

/* Left color strip */
#myTab3 .nav-link::before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    height: 100%;
    width: 6px;
    border-radius: 20px 0 0 20px;
    background: linear-gradient(180deg, #28a745, #1e7e34);
}

/* Hover effect */
#myTab3 .nav-link:hover {
    transform: translateY(-4px);
}

/* Active tab */
#myTab3 .nav-link.active {
    background: linear-gradient(90deg, rgb(17, 94, 89) 0%, rgb(17, 94, 89, 1) 60%, rgb(0, 37, 142, .8) 100%);
    color: #fff;
}

.btn-primary:hover {
    background-color: #006270;
    border-color: #006270;
    color: #fff;
}

.btn-primary{
    background-color: #006270;
    border-color: #006270;
    color: #fff;
}
/* Layout side by side */
.tab-wrapper {
    display: flex;
    gap: 30px;
}

/* Content side */
#myTabContent3 {
    flex: 1;
}

</style>

<section class="services flagday-section py-5">
  <div class="container d-flex">
    <div class="tab-vertical d-flex content-card content-text" style="width:100%;">
      <ul class="nav nav-tabs" id="myTab3" role="tablist">
        @foreach($circularType as $type)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ str_replace(' ','_',strtolower($type)) }}-vertical-tab" data-toggle="tab" href="javascript:void(0);" data-target="#{{ str_replace(' ','_',strtolower($type)) }}" role="tab" aria-controls="{{ str_replace(' ','_',strtolower($type)) }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">{{ ucfirst($type) }}</a>
            </li>
        @endforeach
      </ul>
      <div class="tab-content" id="myTabContent3">
        @foreach($circularType as $type)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : 'd-none' }}" id="{{ str_replace(' ','_',strtolower($type)) }}" role="tabpanel" aria-labelledby="{{ str_replace(' ','_',strtolower($type)) }}-vertical-tab">
              @foreach($goCircular as $circular)
                @if($circular->type == $type)
                <div class="col-md-12 d-flex" style="border-bottom:1px solid #eee;padding:10px 0;">
                    <div class="col-md-10">
                      <h5>{{ ucfirst($circular->title) }}</h5>
                      <p>{{ ucfirst($circular->subject) }}</p>
                    </div>
                    <div class="col-md-2">
                      <a href="{{ asset('/public/'.$circular->file) }}" alt="client" class="btn btn-primary mb-2" title="View File" target="_blank">Download</a>
                    </div>
                </div>
                @endif
              @endforeach
            </div>
        @endforeach
      </div>
    </div>
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    $(".nav-link").click(function(){
        var targetDiv = $(this).attr("data-target");
        $(".nav-link").removeClass("active");
        $(".tab-pane").addClass("d-none");
        $(this).addClass("active");
        $(targetDiv).removeClass("d-none").addClass("show active");
    });
});
</script>


@endsection
@section('scripts')
@stop

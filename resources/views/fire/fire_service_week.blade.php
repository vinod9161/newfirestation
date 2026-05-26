@extends('layouts.fire_new')
@section('content')
<style>
  body {
    background: #f4f6f9;
  }

  .status-card {
    border-radius: 15px;
    border: none;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
  }

  .card:hover {
    transform: translateY(-10px) !important;
  }

  .status-card .card-body {
    padding: 15px;
  }

  .left-border {
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    border-radius: 15px 0 0 15px;
  }

  .count-badge {
    font-size: 20px;
    padding: 6px 14px;
    border-radius: 8px;
    font-weight: 600;
    color: #fff;
  }

  .status-title {
    font-size: 14px;
    color: #6c757d;
  }

  .status-text {
    font-size: 20px;
    font-weight: 600;
  }

  .icon-style {
    font-size: 30px;
  }
</style>
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Fire Service Week</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Activities <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Fire Service Week</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
<section class="services flagday-section py-5">
  <div class="container">
    <div class="row content-card content-text">
      <div class="col-md-12">
        @php
            use Carbon\Carbon;
          


            // Get start and end of the current week
            $startOfWeek = Carbon::now()->startOfWeek()->format('d');
            $endOfWeek = Carbon::now()->endOfWeek()->format('d F'); // 'd F' ensures the month name appears for the end date

            // Hindi month names
            $monthsHindi = [
                'January' => 'जनवरी',
                'February' => 'फरवरी',
                'March' => 'मार्च',
                'April' => 'अप्रैल',
                'May' => 'मई',
                'June' => 'जून',
                'July' => 'जुलाई',
                'August' => 'अगस्त',
                'September' => 'सितंबर',
                'October' => 'अक्टूबर',
                'November' => 'नवंबर',
                'December' => 'दिसंबर'
            ];

            // Extract the month from the end date and convert it to Hindi
            $endMonthEnglish = Carbon::now()->endOfWeek()->format('F'); 
            $endMonthHindi = $monthsHindi[$endMonthEnglish] ?? $endMonthEnglish;

            // Final formatted string
            // $weekText = "अग्निशमन सेवा सप्ताह – $startOfWeek से $endOfWeek";
            $weekText = "अग्निशमन सेवा सप्ताह";
            $weekText = str_replace($endMonthEnglish, $endMonthHindi, $weekText);
            @endphp
        <h3 class="text-center">{{ $weekText }} </h3>
        <p class="why-us section-bg aos-init aos-animate text-center">
          {{ $category[0]->title }} <br/>
          {{ $category[0]->hindi_title }}
        </p>
      </div>

      @foreach($fireEvents as $event)
        <div class="col-md-12 mb-4">
          <div class="status-card">
              <div class="left-border bg-success"></div>
              <div class="card-body">
                <div class="status-text text-dark">दिनांक {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y') }}</div>
                <p class="description">{{ $event->title }} </p>
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

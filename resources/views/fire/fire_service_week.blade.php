@extends('layouts.fire_new')
@section('content')

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

<section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
    <div class="container">
        <div class="row">
            <div class="col-md-1">
            </div>
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
            <div class="col-md-10">
                <h1 class="heading">{{ $weekText }}</h1>
                <p class="text-center">{{ $category[0]->title }}</p>
                <p class="text-center">{{ $category[0]->hindi_title }}</p>
            </div>

            <div class="col-md-1">
            </div>
            <div class="col-lg-12 d-flex flex-column justify-content-center p-5">
                @if($fireEvents->isEmpty())
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक 14.04.2020</h4>
                    <p class="description">अग्नि सुरक्षा सम्बन्धी रैली.</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक 15.04.2020</h4>
                    <p class="description"> शिक्षण संस्थानों में फायर सर्विस ड्रिल का प्रशिक्षण व अभ्यास.</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक 16.04.2020</h4>
                    <p class="description">बैंको, व्यवसायिक प्रतिष्ठानों में अग्निशमन मानकों का निरीक्षण व अभ्यास .</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक 17.04.2020</h4>
                    <p class="description"> औधौगिक क्षेत्रों में अग्नि सुरक्षा व समीक्षा का अभ्यास .</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक 18.04.2020</h4>
                    <p class="description"> स्वयंसेवी संस्थाओं के साथ गोष्ठी .</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक 19.04.2020</h4>
                    <p class="description"> सभी अग्निशमन केन्द्रों पर श्रमदान के माध्यम से सौन्दर्यीकरण.</p>
                </div>
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक 20.04.2020 </h4>
                    <p class="description">अग्निशमन सप्ताह समापन रैली .</p>
                </div>
                @else
                @foreach($fireEvents as $event)
                <div class="icon-box">
                    <div class="icon"><i class='bx bxs-badge-check'></i></div>
                    <h4 class="title">दिनांक {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y') }}</h4>
                    <p class="description">{{ $event->title }} </p>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
@stop

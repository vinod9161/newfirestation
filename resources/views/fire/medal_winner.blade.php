@extends('layouts.fire_new')
@section('content')

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

<!-- ======= Medal Winners Section ======= -->
<div class="container">
    <div class="row">
        @foreach($grouped_medal_winners as $categoryId => $winners)
            <h3 class="table-heading">
                <span><img src="{{ asset('/public/fire/gallery/medal.png') }}"></span>
                {{ $winners['category_name'] }}
            </h3>

            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th scope="col">S.No.</th>
                        <th scope="col">Year</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Name</th>
                        <th scope="col">Occasion</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($winners['medals']) && count($winners['medals']) > 0)
                        @foreach($winners['medals'] as $index => $winner)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $winner->year ?? 'N/A' }}</td>
                                <td>{{ $winner->designation ?? 'N/A' }}</td>
                                <td>{{ $winner->name ?? 'N/A' }}</td>
                                <td>{{ $winner->occassion ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No data available for this category.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        @endforeach
    </div>
</div>

@endsection
@section('scripts')
@stop

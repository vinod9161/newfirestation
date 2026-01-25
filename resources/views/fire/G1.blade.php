@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Gallery</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Activities <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Gallery</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<!-- ======= Portfolio Section ======= -->
<section class="portfolio">
    <div class="container">

        <!-- Portfolio Filters -->
        <div class="row">
            <div class="col-lg-12">
                <ul id="portfolio-flters">
                    <li data-filter="*" class="filter-active">All</li>
                    <li data-filter=".filter-indoor_event">Indoor Event</li>
                    <li data-filter=".filter-Outdoor_Event">Outdoor Event</li>
                    <li data-filter=".filter-Official_Event">Official Event</li>
                </ul>
            </div>
        </div>

        <div class="row portfolio-container">
            @if (!empty($galalry) && count($galalry) > 0)
                @foreach ($galalry as $item)
                    <div class="col-lg-4 col-md-6 portfolio-item filter-{{ strtolower(str_replace(' ', '-', $item->category)) }}">
                        <div class="portfolio-item">
                            <img src="{{ asset('public/admin/activities/galary/' . $item->image) }}" class="img-fluid" alt="{{ $item->category }}">
                            <div class="portfolio-info">
                                <h3>
                                    <a href="{{ asset('public/admin/activities/galary/' . $item->image) }}" data-gall="portfolioGallery" class="venobox" title="{{ $item->category }}">
                                        {{ $item->category }}
                                    </a>
                                </h3>
                                <div>
                                    <a href="{{ asset('fire/gallery/event/' . $item->image) }}" data-gall="portfolioGallery" class="venobox" title="{{ $item->category }}">
                                        <i class="bx bx-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else

            <div class="col-lg-4 col-md-6 filter-app">
              <div class="portfolio-item">
                <img src="{{asset('/public/fire/gallery/event/1.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h3><a href="{{asset('/public/fire/gallery/event/1.jpg')}}" data-gall="portfolioGallery" class="venobox" title="Image 1">Image 1</a></h3>
                  <div>
                    <a href="{{asset('/public/fire/gallery/event/1a.JPG')}}" data-gall="portfolioGallery" class="venobox" title="Image 1"><i class="bx bx-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 filter-card">
              <div class="portfolio-item">
                <img src="{{asset('/public/fire/gallery/event/2.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h3><a href="{{asset('/public/fire/gallery/event/2.jpg')}}" data-gall="portfolioGallery" class="venobox" title="Web 3">Image 2</a></h3>
                  <div>
                    <a href="{{asset('/public/fire/gallery/event/2a.jpg')}}" data-gall="portfolioGallery" class="venobox" title="Web 3"><i class="bx bx-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 filter-web">
              <div class="portfolio-item">
                <img src="{{asset('/public/fire/gallery/event/3.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h3><a href="{{asset('/public/fire/gallery/event/3.jpg')}}" data-gall="portfolioGallery" class="venobox" title="App 2">Image 3</a></h3>
                  <div>
                    <a href="{{asset('/public/fire/gallery/event/3a.jpg')}}" data-gall="portfolioGallery" class="venobox" title="App 2"><i class="bx bx-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 filter-web">
              <div class="portfolio-item">
                <img src="{{asset('/public/fire/gallery/event/4.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h3><a href="{{asset('/public/fire/gallery/event/4.jpg')}}" data-gall="portfolioGallery" class="venobox" title="Card 2">Image 4</a></h3>
                  <div>
                    <a href="{{asset('/public/fire/gallery/event/4a.JPG')}}" data-gall="portfolioGallery" class="venobox" title="Card 2"><i class="bx bx-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 filter-card">
              <div class="portfolio-item">
                <img src="{{asset('/public/fire/gallery/event/5.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h3><a href="{{asset('/public/fire/gallery/event/5.jpg')}}" data-gall="portfolioGallery" class="venobox" title="Web 2">Image 5</a></h3>
                  <div>
                    <a href="{{asset('/public/fire/gallery/event/5a.JPG')}}" data-gall="portfolioGallery" class="venobox" title="Web 2"><i class="bx bx-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 filter-app">
              <div class="portfolio-item">
                <img src="{{asset('/public/fire/gallery/event/6.jpg')}}" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h3><a href="{{asset('/public/fire/gallery/event/6.jpg')}}" data-gall="portfolioGallery" class="venobox" title="App 3">Image 6</a></h3>
                  <div>
                    <a href="{{asset('/public/fire/gallery/event/6a.JPG')}}" data-gall="portfolioGallery" class="venobox" title="App 3"><i class="bx bx-plus"></i></a>
                  </div>
                </div>
              </div>
            </div>
            @endif
        </div>
    </div>
</section>

@endsection

@section('scripts')
    <!-- Include jQuery (Required for Isotope) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Isotope for Filtering -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/isotope/3.0.6/isotope.pkgd.min.js"></script>

    <!-- Include Venobox for Image Preview -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/venobox/1.9.3/venobox.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize Isotope
            var $portfolioContainer = $('.portfolio-container').isotope({
                itemSelector: '.portfolio-item',
                layoutMode: 'fitRows'
            });

            // Filter items on button click
            $('#portfolio-flters li').on('click', function () {
                $('#portfolio-flters li').removeClass('filter-active');
                $(this).addClass('filter-active');

                var filterValue = $(this).attr('data-filter');
                $portfolioContainer.isotope({ filter: filterValue });
            });

            // Initialize Venobox
            $('.venobox').venobox();
        });
    </script>
@endsection

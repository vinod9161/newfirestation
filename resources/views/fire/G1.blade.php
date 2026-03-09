@extends('layouts.fire_new')
@section('content')
<style>

	/* Category Title */
	.category-title {
		font-size: 25px;
		margin: 30px 0 10px;
		font-weight: 500;
		color: #00258e;
		text-transform: uppercase;
	}

	/* Gallery Wrapper */
	.gallery-wrapper {
		position: relative;
		display: flex;
		align-items: center;
	}

	.gallery {
		display: flex;
		overflow-x: auto;
		scroll-behavior: smooth;
		gap: 10px;
		padding: 10px 0;
	}

	.gallery img {
		height: 220px;
		border-radius: 8px;
		cursor: pointer;
		transition: 0.3s;
	}

	.gallery img:hover {
		transform: scale(1.05);
	}

	/* Arrows */
	.arrow {
		font-size: 28px;
		cursor: pointer;
		padding: 10px;
		user-select: none;
	}

	/* ===== Modal ===== */
	.modal {
		display: none;
		position: fixed;
		z-index: 1000;
		padding-top: 60px;
		left: 0;
		top: 0;
		width: 100%;
		height: 100%;
		background: rgba(0,0,0,0.9);
	}

	.modal-content1 {
		display: block;
		margin: auto;
		max-width: 80%;
		max-height: 80%;
	}

	.close {
		position: absolute;
		top: 20px;
		right: 40px;
		font-size: 40px;
		color: white;
		cursor: pointer;
	}

	.modal-arrow {
		position: absolute;
		top: 50%;
		font-size: 50px;
		color: white;
		cursor: pointer;
		transform: translateY(-50%);
	}

	.prev { left: 30px; }
	.next { right: 30px; }
	
	.close:hover{
		color: #fff;
	}
	</style>
	
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

<!--Main Content Start-->
<?php $galleryIndex = 1; ?>
<?php foreach($gallery as $category => $images): ?>
  <section class="flagday-section @if($galleryIndex == 1) pt-5 pb-5 @else pb-5 @endif">
    <div class="main-content p80">
      <!--Department Details Page Start-->
      <div class="department-details">
        <div class="container">
          <div class="row content-card content-text">
            <div class="col-md-12 pb-40">
              <div class="row">
                
                <div class="col-lg-12 text-center mb-3">

                  

                      <div class="category-title">
                          <?= str_replace('_',' ', $category); ?>
                      </div>

                      <div class="gallery-wrapper">
                          <div class="arrow" onclick="scrollGallery('gallery<?= $galleryIndex ?>', -1)">&#10094;</div>

                          <div class="gallery" id="gallery<?= $galleryIndex ?>">
                              
                              <?php $imgIndex = 0; ?>
                              <?php foreach($images as $img): ?>
                                  <img src="{{ asset('public/admin/activities/galary/' . $img->image) }}" 
                                      onclick="openModal('gallery<?= $galleryIndex ?>', <?= $imgIndex ?>)">
                              <?php $imgIndex++; endforeach; ?>

                          </div>

                          <div class="arrow" onclick="scrollGallery('gallery<?= $galleryIndex ?>', 1)">&#10095;</div>
                      </div>

                  

                  <div id="myModal" class="modal">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <span class="modal-arrow prev" onclick="changeImage(-1)">&#10094;</span>
                    <img class="modal-content1" id="modalImage">
                    <span class="modal-arrow next" onclick="changeImage(1)">&#10095;</span>
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
<?php $galleryIndex++; endforeach; ?>
<!--Main Content End-->
<!-- ======= Portfolio Section ======= -->
<!-- <section class="portfolio">
    <div class="container">

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
</section> -->

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

<script>
  let currentGallery = null;
  let currentIndex = 0;

  function scrollGallery(id, direction) {
      const gallery = document.getElementById(id);
      gallery.scrollBy({
          left: direction * 300,
          behavior: "smooth"
      });
  }

  function openModal(galleryId, index) {
      currentGallery = document.getElementById(galleryId);
      currentIndex = index;

      const images = currentGallery.getElementsByTagName("img");

      document.getElementById("myModal").style.display = "block";
      document.getElementById("modalImage").src = images[currentIndex].src;
  }

  function closeModal() {
      document.getElementById("myModal").style.display = "none";
  }

  function changeImage(direction) {
      const images = currentGallery.getElementsByTagName("img");

      currentIndex += direction;

      if (currentIndex < 0) {
          currentIndex = images.length - 1;
      }

      if (currentIndex >= images.length) {
          currentIndex = 0;
      }

      document.getElementById("modalImage").src = images[currentIndex].src;
  }

  /* Keyboard Support */
  document.addEventListener("keydown", function(e) {
      const modal = document.getElementById("myModal");

      if (modal.style.display === "block") {

          if (e.key === "ArrowLeft") {
              changeImage(-1);
          }

          if (e.key === "ArrowRight") {
              changeImage(1);
          }

          if (e.key === "Escape") {
              closeModal();
          }
      }
  });
</script>


@endsection

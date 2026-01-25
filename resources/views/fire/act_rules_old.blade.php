@extends('layouts.fire_new')

@section('content')


    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Acts & Rules</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Acts & Rules</li>
          </ol>
        </div>

      </div>
    </div><!-- End About Us Section -->

    <!-- ======= About Section ======= -->
    <section class="services">
        <div class="container">
  
          <div class="row">
            
            <div class="col-md-4 col-lg-4 d-flex align-items-stretch" data-aos="fade-up">
              <div class="icon-box icon-box-pink" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                <div class="icon"><i class='bx bxs-book-content'></i></div>
                <h4 class="title" data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample"><a href="#collapseExample">Fire Service Act</a></h4>
                <p class="description"><a href="{{asset('/public/fire/gallery/pdf/The Uttarakhand Fire & Emergency Service, Fire Prevention and Fire Safety Act, 2016.pdf')}}" target="_blank">Click Here</a></p>
              </div>
            </div>
  
            <div class="col-md-4 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-cyan" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                <div class="icon"><i class='bx bxs-book-alt' ></i></div>
                <h4 class="title" data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample2"><a href="#collapseExample2">Subordinate Service Rules </a></h4>
                <p class="description"><a href="{{asset('/public/fire/gallery/pdf/UKFS-Subordinate-Officers-Employees-Service-Rules-2016_compressed.pdf')}}" target="_blank">Click Here</a></p>
              </div>
            </div>

            <div class="col-md-4 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-pink" data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                <div class="icon"><i class='bx bxs-book-content'></i></div>
                <h4 class="title" data-toggle="collapse"  role="button" aria-expanded="false" aria-controls="collapseExample3"><a href="#collapseExample3">UNITED PROVINCE FIRE SERVICE ACT 1944 </a></h4>
                <p class="description"><a href="{{asset('/public/fire/gallery/pdf/PI-03.pdf')}}" target="_blank">Click Here</a></p>
              </div>
            </div>

            <div class="col-md-4 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-cyan" data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
                <div class="icon"><i class='bx bxs-book-alt' ></i></div>
                <h4 class="title"data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4"><a href="#collapseExample3">UTTAR PRADESH FIRE SERVICE (AMENDMENT ACT), 1952 </a></h4>
                <p class="description"><a href="{{asset('/public/fire/gallery/pdf/PI-01.pdf')}}" target="_blank">Click Here</a></p>
              </div>
            </div>

            <div class="col-md-4 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-pink">
                <div class="icon"><i class='bx bxs-book-content'></i></div>
                <h4 class="title"><a href="{{asset('/public/fire/gallery/pdf/PI-02.pdf')}}" target="_blank"> UTTAR PRADESH FIRE SERVICE (GAZETTED OFFICERS SERVICE RULES), 1984 </a></h4>
                <p class="description"><a href="{{asset('/public/fire/gallery/pdf/PI-02.pdf')}}" target="_blank">Click Here</a></p>
              </div>
            </div>

            <div class="col-md-4 col-lg-4 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-cyan">
                <div class="icon"><i class='bx bxs-book-alt' ></i></div>
                <h4 class="title"><a href="{{asset('/public/fire/gallery/pdf/NBC-2016-VOL.1-Part-4-Fire-and-Life-Saftey.pdf')}}" target="_blank"> National Building Code of India 2016 – Part-4 Fire and Life Safety </a></h4>
                <p class="description"><a href="{{asset('/public/fire/gallery/pdf/NBC-2016-VOL.1-Part-4-Fire-and-Life-Saftey.pdf')}}" target="_blank">Click Here</a></p>
              </div>
            </div>

            <div class="col-md-6 col-lg-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-pink">
                <div class="icon"><i class='bx bxs-book-content'></i></div>
                <h4 class="title"><a href="http://uhuda.org.in/?page_id=3112" target="_blank"> Uttarakhand Building Bye Laws </a></h4>
                <p class="description"><a href="http://uhuda.org.in/?page_id=3112" target="_blank">Click Here</a></p>
              </div>
            </div>

            <div class="col-md-6 col-lg-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
              <div class="icon-box icon-box-cyan">
                <div class="icon"><i class='bx bxs-book-alt' ></i></div>
                <h4 class="title"><a href="https://investuttarakhand.com/rules" target="_blank"> Uttarakhand Single Window Act & Rules </a></h4>
                <p class="description"><a href="https://investuttarakhand.com/rules" target="_blank">Click Here</a></p>
              </div>
            </div>



          </div>

  
        </div>
      </section>


@endsection
@section('scripts')
@stop

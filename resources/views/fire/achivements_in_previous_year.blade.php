@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Achievements</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Achievements</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

    <!-- ======= About Section ======= -->
    <div class="container">
        <div class="row">

  <h3 class="table-heading">President fire service Medal for distinguished service</h3>
    <table class="table table-bordered table-responsive-sm ">
        <thead>
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">Year</th>
            <th scope="col">Name</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>2020</td>
            <td>Shri Anil Kumar Tyagi, Fire Station Second Officer, Pauri</td>
          </tr>
    
        </tbody>
      </table>




        <h3 class="table-heading">President fire service Medal for Meritorious Service    </h3>
        <table class="table table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th scope="col">S.No.</th>
                <th scope="col">Year</th>
                <th scope="col">Name</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>2020</td>
                <td> Shri Rakesh Kumar, Leading fireman Dehradun</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>2020</td>
                <td> shri Sunil Kumar Singh, Fire service Driver Dehradun</td>
              </tr>

              <tr>
                <th scope="row">3</th>
                <td>2019</td>
                <td> Shri Bansh Bahadur Yadav Chief Fire officer Almora</td>
              </tr>

              <tr>
                <th scope="row">4</th>
                <td>2019</td>
                <td> Shri Prem Singh, Fire Station Officer, Pauri </td>
              </tr>

              <tr>
                <th scope="row">5</th>
                <td>2019</td>
                <td> Shri Arjun Singh Leading fireman, Nainital </td>
              </tr>
          
            </tbody>
          </table>


          <h3 class="table-heading">Chief Minister Medal <br>Meritorious service medal for distinguished work :-        </h3>
          <table class="table table-bordered table-responsive-sm">
              <thead>
                <tr>
                  <th scope="col">S.No.</th>
                  <th scope="col">Year</th>
                  <th scope="col">Name</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>2020</td>
                  <td>  Shri Maneesh Prasad, Fireman, Dehradun</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>2020</td>
                  <td> Shri Manoj Khatri, Fireman, Rudraprayag</td>
                </tr>

                <tr>
                    <th scope="row">3</th>
                    <td>2020</td>
                    <td>  Shri Anvar Ali, Fireman Udhamsingh Nagar </td>
                  </tr>
            
              </tbody>
            </table>

         
              <h3 class="table-heading">Achievement in sports</h3>
              <table class="table table-bordered table-responsive-sm">
                <thead>
                  <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Year</th>
                    <th scope="col">Name</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>2019</td>
                    <td> Shri Dinesh Chandra Bhatt</td>
                  </tr>

                </tbody>
              </table>
              <p>Shri Dinesh Chandra Bhatt, Fire service driver won 05 gold medal in Indian fire service games in year 2019.<br>
                5 fireman participated in fire combat 360 Mumbai with 17 other counties in 2018.</p>
            </div>

</div>

           
 @endsection
@section('scripts')
@stop

@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Vehicle</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Establishment <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Vehicle</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

    <!-- ======= About Section ======= -->
    <div class="container-fluid" style="margin-bottom: 40px; max-width:85%">
    <div class="row">
        <div class="col-md-12">

            <h3 style="margin-top: 40px;"> Availability of Vehicle/Machine  </h3>
        </div>


    <!-- <table class="table table-bordered table-responsive-sm text-center" >
        <thead>
          <tr>
            <th scope="col">S.No.</th>
            <th scope="col">District Name   </th>
            <th scope="col">Hydraulic Arial Ladder</th>
            <th scope="col">Foam Tender</th>
            <th scope="col">Water Tender</th>
            <th scope="col">DCP Tender  </th>
            <th scope="col">Mini Water Tender</th>
            <th scope="col">Water Mixed High Pressure</th>
            <th scope="col">Water Bowser    </th>
            <th scope="col">Portable Pump Caring Vehicle </th>
            <th scope="col">Portable Pump</th>
            <th scope="col">Back Pack Set Motor Cycle</th>
            <th scope="col">Rescue Tender/ Ambulance</th>




          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Dehradun        </td>
            <td>01  </td>
            <td>02  </td>
            <td>15  </td>
            <td>01</td>
            <td>08</td>
            <td>02</td>
            <td>01</td>
            <td>04</td>
            <td>07</td>
            <td>08</td>
            <td>04</td>


          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Haridwar        </td>
            <td>-   </td>
            <td>02  </td>
            <td>10  </td>
            <td>-</td>
            <td>08</td>
            <td>05</td>
            <td>-</td>
            <td>01</td>
            <td>05</td>
            <td>07</td>
            <td>01</td>


          </tr>

          <tr>
            <th scope="row">3</th>
            <td>Tehri Garhwal</td>
            <td>-   </td>
            <td>01  </td>
            <td>03  </td>
            <td>-</td>
            <td>01</td>
            <td>02</td>
            <td>-</td>
            <td>02</td>
            <td>02</td>
            <td>02</td>
            <td>02</td>


          </tr>


          <tr>
            <th scope="row">4</th>
            <td>Uttarkashi</td>
            <td>-   </td>
            <td>01  </td>
            <td>03  </td>
            <td>-</td>
            <td>02</td>
            <td>01</td>
            <td>-</td>
            <td>02</td>
            <td>02</td>
            <td>02</td>
            <td>02</td>


          </tr>


          <tr>
            <th scope="row">5</th>
            <td>Chamoli </td>
            <td>-   </td>
            <td>01  </td>
            <td>03  </td>
            <td>-</td>
            <td>03</td>
            <td>01</td>
            <td>-</td>
            <td>02</td>
            <td>02</td>
            <td>02</td>
            <td>01</td>


          </tr>


          <tr>
            <th scope="row">6</th>
            <td>Rudraprayag     </td>
            <td>-   </td>
            <td>01  </td>
            <td>01  </td>
            <td>-</td>
            <td>02</td>
            <td>01</td>
            <td>-</td>
            <td>01</td>
            <td>01</td>
            <td>01</td>
            <td>01</td>


          </tr>


          <tr>
            <th scope="row">7</th>
            <td>Pauri Garhwal</td>
            <td>-</td>
            <td>01  </td>
            <td>05  </td>
            <td>-</td>
            <td>04</td>
            <td>-</td>
            <td>-</td>
            <td>01</td>
            <td>02</td>
            <td>03</td>
            <td>01</td>


          </tr>


          <tr>
            <th scope="row">8</th>
            <td>Almora</td>
            <td>-</td>
            <td>01  </td>
            <td>03 </td>
            <td>-</td>
            <td>03</td>
            <td>-</td>
            <td>-</td>
            <td>02</td>
            <td>02</td>
            <td>01</td>
            <td>01</td>


          </tr>

          <tr>
            <th scope="row">9</th>
            <td>Bageshwar</td>
            <td>-</td>
            <td>01  </td>
            <td>03 </td>
            <td>-</td>
            <td>03</td>
            <td>02</td>
            <td>-</td>
            <td>01</td>
            <td>02</td>
            <td>01</td>
            <td>02</td>

            <tr>
                <th scope="row">10</th>
                <td>Champawat</td>
                <td>-</td>
                <td>02  </td>
                <td>02 </td>
                <td>-</td>
                <td>04</td>
                <td>01</td>
                <td>-</td>
                <td>01</td>
                <td>02</td>
                <td>02</td>
                <td>01</td>
    
    
              </tr>


          <tr>
            <th scope="row">11</th>
            <td>Pithoragarh </td>
            <td>-   </td>
            <td>01  </td>
            <td>02  </td>
            <td>-</td>
            <td>03</td>
            <td>01</td>
            <td>-</td>
            <td>-</td>
            <td>02</td>
            <td>01</td>
            <td>01</td>


          </tr>

          <tr>
            <th scope="row">12</th>
            <td>Nainital    </td>
            <td>-   </td>
            <td>01  </td>
            <td>06 </td>
            <td>-</td>
            <td>07</td>
            <td>02</td>
            <td>-</td>
            <td>02</td>
            <td>04</td>
            <td>04</td>
            <td>01</td>


          </tr>


          <tr>
            <th scope="row">13</th>
            <td>Udham Singh Nagar</td>
            <td>-   </td>
            <td>04  </td>
            <td>12  </td>
            <td>-</td>
            <td>05</td>
            <td>05</td>
            <td>-</td>
            <td>05</td>
            <td>05</td>
            <td>06</td>
            <td>02</td>


          </tr>


          <tr>
            <th scope="row"></th>
            <td><strong>Total</strong></td>
            <td>01  </td>
            <td>19  </td>
            <td>68 </td>
            <td>04</td>
            <td>53</td>
            <td>23</td>
            <td>01</td>
            <td>24</td>
            <td>29</td>
            <td>40</td>
            <td>20</td>


          </tr>


    
        </tbody>
      </table> -->


        <!-- Dyanmic Data -->
        <table class="table table-bordered table-striped text-center">
          <thead>
              <tr style="background-color:#D73502; color :#ffffff;">
                  <th>S.No</th>
                  <th>District</th>
                  <th>वाटर बाउजर</th>
                  <th>फोम टेण्डर</th>
                  <th>वाटर टेण्डर</th>
                  <th>मिनी हाईप्रेशर</th>
                  <th>मल्टीपरपज फायर टेण्डर</th>
                  <th>वाटर मिस्ट</th>
                  <th>बैक पैक सैट</th>
                  <th>एम्बुलेंस</th>
                  <th>बाइक</th>
                  <th>हाईड्रोलिक प्लेटफार्म</th>
                  <th>डीसीपी टेण्डर</th>
                  <th>पीपीसीवी</th>
              </tr>
          </thead>
          <tbody>
              <?php 
              $sn = 1; 
              $totals = [
                  'वाटर बाउजर' => 0,
                  'फोम टेण्डर' => 0,
                  'वाटर टेण्डर' => 0,
                  'मिनी हाईप्रेशर' => 0,
                  'मल्टीपरपज फायर टेण्डर' => 0,
                  'वाटर मिस्ट' => 0,
                  'बैक पैक सैट' => 0,
                  'एम्बुलेंस' => 0,
                  'बाइक' => 0,
                  'हाईड्रोलिक प्लेटफार्म' => 0,
                  'डीसीपी टेण्डर' => 0,
                  'पीपीसीवी' => 0
              ];
              if (!empty($data)): 
                  foreach ($data as $key => $row): ?>
                      <tr>
                          <td><?= $sn; ?></td>
                          <td><?= $row['district_name'] ?? 'NA'; ?></td>
                          <?php foreach (array_keys($totals) as $type): ?>
                              <td>
                                  <?php 
                                  $count = 0;
                                  if (!empty($row['vehicles'])) {
                                      foreach ($row['vehicles'] as $val) {
                                          if ($val['vehicle_type_name'] === $type) {
                                              $count += (int) $val['count_vehicle_type'];
                                          }
                                      }
                                  }
                                  $totals[$type] += $count;
                                  echo $count;
                                  ?>
                              </td>
                          <?php endforeach; ?>
                      </tr>
                      <?php $sn++; endforeach; ?>
              <?php endif; ?>
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="2"> Total</td>
                  <?php foreach ($totals as $total): ?>
                      <td><?= $total; ?></td>
                  <?php endforeach; ?>
              </tr>
          </tfoot>
      </table>


            <?php //echo "<pre>"; print_r($data); echo "</pre>";?>
        <!-- End Dyanmic Data -->
    </div>
</div>
</div>
 @endsection
@section('scripts')
@stop

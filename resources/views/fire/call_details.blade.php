@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Emergency Calls (Fire & Rescue)</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">Achievements <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Emergency Calls (Fire & Rescue)</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
<!--Main Content Start-->
<style>
   /* Move submit button to right */
   .form-submit-right {
      display: flex;
      justify-content: flex-end;
   }

   /* Optional: fixed button width */
   .form-submit-right .btn {
      min-width: 150px;
   }
   .btn-danger{
      color: #fff; background-color: #006270; border-color: #006270;
   }
   .btn-danger:hover{
      color: #fff; background-color: #006270; border-color: #006270;
   }

</style>
<section class="flagday-section py-5" id="chart-section">
  <div class="main-content" >
      <div class="department-details">
          <div class="container">
        <div class="row content-card content-text">
          <div class="col-md-12 pb-40">
            <div class="row">
              <div class="col-md-12 form-submit-right">
                <button type="button" class="btn btn-danger mb-2 show-grid" id="viewGrid">Grid View</button> 
              </div>
              <div class="col-lg-12 text-center mb-3">
                <!-- <button class="btn btn-primary">Grid View</button> -->
                <div class="chart-container">
                  <canvas id="comboChart" style="min-height:275px"></canvas>
                </div>
              </div>
            </div>
          </div>
        </div>
          </div>
      </div>
  </div>
</section>
<!--Main Content End-->

<section class="flagday-section py-5" id="grid-section" style="display:none">
  <div class="container">
        <div class="row content-card content-text">
          <div class="col-md-12 form-submit-right">
            <button type="button" class="btn btn-danger mb-2 show-grid" id="chartView">Chart View</button> 
          </div>

          <h3 class="table-heading">Emergency Calls (Fire & Rescue)</h3>
          <p >
            With a continuous rise in fire and rescue calls, the Uttarakhand Fire Service faces ever-growing challenges. Rapid urbanization, increasing high-rise buildings, dense slums, expanding transport systems, and industrial development have significantly increased risks to life and property. To meet these evolving demands, the Fire Service consistently strengthens its preparedness, response capability, and rescue operations.
          </p>

          <div class="col-md-9 mb-3">
          </div>
          <div class="col-md-3 mb-3">
              <input type="text" id="yearSearch" class="form-control" placeholder="Search by Year (e.g. 2001)">
          </div>
        <table class="table table-bordered table-striped text-center">
          <thead  style="background-color:#006270; color: white;">
            <tr>
              <th scope="col">S.No.</th>
              <th scope="col">Year</th>
              <th scope="col">Fire Calls</th>
              <th scope="col">Rescue Calls    </th>
              <th scope="col">Total</th>
              <th scope="col">Property Saved  (<span><i class='bx bx-rupee'></i></span>)  </th>

              <th scope="col">Property Lost   </th>

              <th scope="col">Life Saved (Hum)    </th>

              <th scope="col">Life Saved (Ani)    </th>

              <th scope="col">Life Lost (Hum) </th>

              <th scope="col">Life Lost (Ani)  </th>


      

            </tr>
          </thead>
          <!-- <tbody>
            <tr>
              <th scope="row">1</th>
              <td>2000</td>
              <td> 475</td>

              <td> 77</td>

              <td> 552</td>

              <td> 244069900  </td>

              <td> 38287400   </td>

              <td> 328    </td>

              <td>44</td>

              <td> 166</td>
              <td> 50</td>

            </tr>


            <tr>
              <th scope="row">2</th>
              <td>2001</td>
              <td> 630</td>

              <td> 50</td>

              <td> 680</td>

              <td>200760665   </td>

              <td> 41218334   </td>

              <td> 249</td>

              <td>47</td>

              <td> 100</td>
              <td> 30</td>

            </tr>


            <tr>
              <th scope="row">3</th>
              <td>2002</td>
              <td> 620</td>

              <td> 86</td>

              <td> 706</td>

              <td> 134534950  </td>

              <td>23165150</td>

              <td> 291    </td>

              <td>76</td>

              <td> 148</td>
              <td> 44</td>

            </tr>

            <tr>
              <th scope="row">4</th>
              <td>2003</td>
              <td> 694</td>

              <td> 96</td>

              <td>790</td>

              <td>553798300       </td>

              <td>25391950    </td>

              <td>395 </td>

              <td>48</td>

              <td> 64</td>
              <td> 81</td>

            </tr>

            <tr>
              <th scope="row">5</th>
              <td>2004</td>
              <td> 823</td>

              <td>181</td>

              <td> 1011</td>

              <td>186677940   </td>

              <td> 47914460   </td>

              <td> 626</td>

              <td>42</td>

              <td> 254</td>
              <td> 28</td>

            </tr>

            
            <tr>
              <th scope="row">6</th>
              <td>2005</td>
              <td> 301    </td>

              <td>181</td>

              <td>1482</td>

              <td>572140092   </td>

              <td>128791020</td>

              <td> 758</td>

              <td>89</td>

              <td>180</td>
              <td> 205</td>

            </tr>


            
            <tr>
              <th scope="row">7</th>
              <td>2006</td>
              <td> 1008</td>

              <td>237 </td>

              <td> 1245</td>

              <td>622775019</td>

              <td> 179275181</td>

              <td> 1074</td>

              <td>65</td>

              <td>242</td>
              <td> 48</td>

            </tr>


            
            <tr>
              <th scope="row">8</th>
              <td>2007</td>
              <td> 1318</td>

              <td>286</td>

              <td> 1604</td>

              <td>894194050</td>

              <td>112298650</td>

              <td>1095</td>

              <td>77</td>

              <td> 300</td>
              <td> 66</td>

            </tr>


            
            <tr>
              <th scope="row">9</th>
              <td>2008</td>
              <td> 1492</td>

              <td>260</td>

              <td>1752</td>

              <td>638621795</td>

              <td>126696755</td>

              <td>1154</td>

              <td>62</td>

              <td> 369</td>
              <td> 46</td>

            </tr>


            
            <tr>
              <th scope="row">10</th>
              <td>2009</td>
              <td> 2244</td>

              <td>229</td>

              <td>2473</td>

              <td>1272298136</td>

              <td>396733628</td>

              <td> 765</td>

              <td>140</td>

              <td>174</td>
              <td> 442</td>

            </tr>


            
            <tr>
              <th scope="row">11</th>
              <td>2010</td>
              <td>2135</td>

              <td>232</td>

              <td>2367</td>

              <td>1220434766</td>

              <td>365323942</td>

              <td>1008</td>

              <td>128</td>

              <td>157</td>
              <td>171</td>

            </tr>


            
            <tr>
              <th scope="row">12</th>
              <td>2011</td>
              <td>1580    </td>

              <td>191</td>

              <td>1771</td>

              <td>1835270334</td>

              <td>337315419</td>

              <td>549</td>

              <td>67</td>

              <td>179 </td>
              <td> 60</td>

            </tr>



            
            <tr>
              <th scope="row">13</th>
              <td>2012</td>
              <td>3314</td>

              <td>199 </td>

              <td>3513    </td>

              <td>2147483647</td>

              <td>530515745</td>

              <td>419</td>

              <td>84</td>

              <td> 254</td>
              <td> 97</td>

            </tr>



            
            <tr>
              <th scope="row">14</th>
              <td>2013</td>
              <td>1701</td>

              <td>255 </td>

              <td>1956</td>

              <td>2001916174</td>

              <td>465444117</td>

              <td>627</td>

              <td>51</td>

              <td> 249</td>
              <td> 51</td>

            </tr>


            
            <tr>
              <th scope="row">15</th>
              <td>2014</td>
              <td>1821</td>

              <td>266</td>

              <td> 2087</td>

              <td>1774776695</td>

              <td>490920881   </td>

              <td>519 </td>

              <td>150</td>

              <td>222</td>
              <td> 129</td>

            </tr>

            <tr>
              <th scope="row">16</th>
              <td>2015</td>
              <td>1922</td>

              <td>293 </td>

              <td>2215</td>

              <td>2147483647</td>

              <td>391046611</td>

              <td>580</td>

              <td>85</td>

              <td> 279</td>
              <td> 50</td>

            </tr>


            
            <tr>
              <th scope="row">17</th>
              <td>2016</td>
              <td>2890</td>

              <td>297 </td>

              <td>3187</td>

              <td>1703698112</td>

              <td>570369073</td>

              <td>958</td>

              <td>86</td>

              <td> 277</td>
              <td> 207</td>

            </tr>


            
            <tr>
              <th scope="row">18</th>
              <td>2017</td>
              <td>2306</td>

              <td>264</td>

              <td> 2570</td>

              <td>2147483647</td>

              <td>780603996   </td>

              <td>530</td>

              <td>150</td>

              <td> 218</td>
              <td> 299</td>

            </tr>


            
            <tr>
              <th scope="row">19</th>
              <td>2018</td>
              <td>2553</td>

              <td>441 </td>

              <td>2994</td>

              <td>1717654383</td>

              <td>435645373</td>

              <td>1184</td>

              <td>384</td>

              <td>327</td>
              <td> 270</td>

            </tr>


            <tr>
              <th scope="row">20</th>
              <td>2019</td>
              <td>2665</td>

              <td>349</td>

              <td>3014</td>

              <td>2004521989</td>

              <td>351966430</td>

              <td>1547</td>

              <td>2099</td>

              <td> 200</td>
              <td> 647</td>

            </tr>

            <tr>
              <th scope="row">21</th>
              <td>2020</td>
              <td>1571</td>

              <td>321</td>

              <td>1892</td>

              <td>109648806</td>

              <td>142738380</td>

              <td>421</td>

              <td>65</td>

              <td> 104</td>
              <td> 42</td>

            </tr>

          </tbody> -->
          <tbody>
              @foreach($stats as $index => $row)
                  <tr>
                      <th scope="row">{{ $loop->iteration }}</th>
                      <td>{{ $row->year }}</td>
                      <td>{{ $row->fire_calls }}</td>
                      <td>{{ $row->rescue_calls }}</td>
                      <td>{{ $row->total_calls }}</td>
                      <td>{{ number_format($row->property_saved, 0) }}</td>
                      <td>{{ number_format($row->property_lost, 0) }}</td>
                      <td>{{ $row->human_saved }}</td>
                      <td>{{ $row->animal_saved }}</td>
                      <td>{{ $row->human_lost ?? 0 }}</td>
                      <td>{{ $row->animal_lost ?? 0 }}</td>
                  </tr>
              @endforeach
          </tbody>
        </table>

    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data passed from the controller
    const allLabels = @json($years);           // e.g., [2026,2025,2024,2023,...]
    const allFire   = @json($fireCalls);
    const allRescue = @json($rescueCalls);
    const allHuman  = @json($humanSaved);
    const allAnimal = @json($animalSaved);

    // Show only the most recent 3 years (or adjust as needed)
    const count = Math.min(3, allLabels.length);
    const labels = allLabels.slice(0, count);
    const fireCalls = allFire.slice(0, count);
    const rescueCalls = allRescue.slice(0, count);
    const humanSaved = allHuman.slice(0, count);
    const animalSaved = allAnimal.slice(0, count);

    const ctx = document.getElementById('comboChart').getContext('2d');
    new Chart(ctx, {
        data: {
            labels: labels,
            datasets: [
                {
                    type: 'bar',
                    label: 'Fire Calls',
                    data: fireCalls,
                    backgroundColor: 'rgba(212, 0, 0, 0.85)',
                    stack: 'stack1',
                    barThickness: 20,
                    maxBarThickness: 25,
                    categoryPercentage: 0.6,
                    barPercentage: 0.6
                },
                {
                    type: 'bar',
                    label: 'Rescue Calls',
                    data: rescueCalls,
                    backgroundColor: 'rgba(0, 37, 142, 0.85)',
                    stack: 'stack1',
                    barThickness: 20,
                    maxBarThickness: 25,
                    categoryPercentage: 0.6,
                    barPercentage: 0.6
                },
                {
                    type: 'line',
                    label: 'Human Life Saved',
                    data: humanSaved,
                    borderColor: 'green',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: 'green'
                },
                {
                    type: 'line',
                    label: 'Animal Life Saved',
                    data: animalSaved,
                    borderColor: 'red',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: false,
                    pointRadius: 4,
                    pointBackgroundColor: 'red'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true }
            },
            plugins: {
                legend: { position: 'top' }
            }
        }
    });
</script>
<script>
document.getElementById("viewGrid").addEventListener("click", function () {
  // alert();
  $("#grid-section").show();
  $("#chart-section").hide();

});
document.getElementById("chartView").addEventListener("click", function () {
  // alert();
  $("#grid-section").hide();
  $("#chart-section").show();

});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    $("#yearSearch").on("keyup", function(){

        var value = $(this).val().trim().toLowerCase();

        $("table tbody tr").each(function(){

            var year = $(this).find("td").eq(0).text().trim().toLowerCase();

            if(year.indexOf(value) !== -1){
                $(this).show();
            } else {
                $(this).hide();
            }

        });

    });

});
</script>
@endsection
@section('scripts')
@stop

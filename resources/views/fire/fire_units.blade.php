@extends('layouts.fire_new')
@section('content')
<!-- DataTables CSS -->
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"> -->

<!-- jQuery & DataTables JS -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> -->

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Fire Station List</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Fire Station List</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->


    <div class="container">
        <div class="row"><h3 class="table-heading">Uttarakhand Fire Station List</h3>
        <table class="table table-bordered table-responsive-sm" id="fireStationsTable">
          <thead>
              <tr>
                  <th>S.No.</th>
                  <th>District</th>
                  <th>Fire Station/Units</th>
                  <th>Phone</th>
                  <th>Contact</th>
                  <th>Email</th>
              </tr>
          </thead>
          <tbody>
              <?php if (!empty($getData)): ?>
                  <?php $serial = 1; ?>
                  <?php foreach ($getData as $districtData): ?>
                      <?php
                      $districtName = $districtData['district']->name;
                      $fireStations = $districtData['fireStations'];

                      // Check if the district has fire stations
                      if (!empty($fireStations)) {
                          $rowCount = count($fireStations);
                          $firstRow = true;

                          foreach ($fireStations as $station): ?>
                              <tr>
                                  <td><?= $serial++; ?></td>
                                  <?php if ($firstRow): ?>
                                      <td rowspan="<?= $rowCount; ?>"><?= $districtName; ?></td>
                                      <?php $firstRow = false; ?>
                                  <?php endif; ?>
                                  <td><?= $station->name; ?></td>
                                  <td><?= $station->fs_contact_no ?: 'N/A'; ?></td>
                                  <td><?= $station->fs_mobile_no ?: 'N/A'; ?></td>
                                  <td><?= $station->fs_email_address ?: 'N/A'; ?></td>
                              </tr>
                          <?php endforeach;
                      } else { ?>
                          <tr>
                              <td><?= $serial++; ?></td>
                              <td><?= $districtName; ?></td>
                              <td colspan="4" class="text-center text-muted">No Fire Stations</td>
                          </tr>
                      <?php } ?>
                  <?php endforeach; ?>
              <?php else: ?>
                  <tr>
                      <td class="text-danger text-center" colspan="6">No Data Found</td>
                  </tr>
              <?php endif; ?>
          </tbody>
      </table>
    </div>


    <!-- <script>
    $(document).ready(function () {
        $('#fireStationsTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script> -->



</div>

@endsection
@section('scripts')




@stop


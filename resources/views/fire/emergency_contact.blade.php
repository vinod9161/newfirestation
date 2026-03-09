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
    <h1 class="breadcrumb-item">Other Emergency No</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="{{ route('actionDisasterSearch') }}">Disaster search <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Other Emergency No</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

<section class="flagday-section py-5">
    <div class="container">
        <div class="row content-card content-text"><h3 class="table-heading">Other Emergency No</h3>
        <table class="table table-bordered table-responsive-sm" id="fireStationsTable">
          <thead style="background-color:#006270; color: white;">
              <tr>
                  <th>S.No.</th>
                  <th>Contact No</th>
              </tr>
          </thead>
          <tbody>

            <tr>
                <td>1</td>
                <td>0135 2410197</td>
            </tr>
            <tr>
                <td>2</td>
                <td>9456596190</td>
            </tr>
            <tr>
                <td>3</td>
                <td>18001804375</td>
            </tr>

        </tbody>
      </table>
    </div>
</div>

</div>

@endsection
@section('scripts')




@stop


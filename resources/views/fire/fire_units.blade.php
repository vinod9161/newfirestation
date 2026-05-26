@extends('layouts.fire_new')
@section('content')

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

<section class="flagday-section py-5">
    <div class="container">
        <div class="row content-card content-text"><h3 class="table-heading">Fire Station List</h3>
        <table class="table table-bordered table-responsive-sm" id="fireStationsTable">
          <thead style="background-color:#006270; color: white;">
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
            @if($getData->isNotEmpty())
                @php $serial = 1; @endphp

                @foreach($getData as $row)
                    <tr>
                        <td>{{ $serial++ }}</td>
                        <td>{{ $row->district_name ?? 'N/A' }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->fs_contact_no ?? 'N/A' }}</td>
                        <td>{{ $row->fs_mobile_no ?? 'N/A' }}</td>
                        <td>{{ $row->fs_email_address ?? 'N/A' }}</td>
                    </tr>
                @endforeach

            @else
                <tr>
                    <td class="text-danger text-center" colspan="6">
                        No Data Found
                    </td>
                </tr>
            @endif
        </tbody>
      </table>
    </div>
</div>

</div>

@endsection
@section('scripts')




@stop


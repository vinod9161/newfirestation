@extends('layouts.fire_new')
@section('content')
<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
    <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Staff Strength of Fire Service</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
        <li class="breadcrumb-item active" aria-current="page">Staff Strength of Fire Service</li>
        </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->

    <!-- ======= Table Section ======= -->
    <div class="container">
        <div class="row">
            <h3 class="table-heading">Staff Strength of Fire Service</h3>
            <table class="table table-bordered table-responsive-sm">
                <thead>
                    <tr>
                        <th rowspan="2">क्र0सं0</th>
                        <th rowspan="2">जनपद</th>
                        <th colspan="2">मुख्य अग्निशमन अधिकारी</th>
                        <th colspan="2">अग्निशमन अधिकारी</th>
                        <th colspan="2">अग्निशमन द्वितीय अधिकारी</th>
                        <th colspan="2">लीडिंग फायरमैन</th>
                        <th colspan="2">फायर सर्विस चालक</th>
                        <th colspan="2">फायरमैन</th>
                    </tr>
                    <tr>
                        <th>स्वीकृत</th>
                        <th><strong>उपलब्ध</strong></th>
                        <th>स्वीकृत</th>
                        <th><strong>उपलब्ध</strong></th>
                        <th>स्वीकृत</th>
                        <th><strong>उपलब्ध</strong></th>
                        <th>स्वीकृत</th>
                        <th><strong>उपलब्ध</strong></th>
                        <th>स्वीकृत</th>
                        <th><strong>उपलब्ध</strong></th>
                        <th>स्वीकृत</th>
                        <th><strong>उपलब्ध</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totals = [
                            "cfo_approve" => 0, "cfo_available" => 0,
                            "fso_approve" => 0, "fso_available" => 0,
                            "fsso_approve" => 0, "fsso_available" => 0,
                            "leading_fireman_approve" => 0, "leading_fireman_available" => 0,
                            "fs_driver_approve" => 0, "fs_driver_available" => 0,
                            "fireman_approve" => 0, "fireman_available" => 0
                        ];
                    @endphp

                    @foreach($getData as $key => $row)
                        <tr class="table-color1">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $row->d_name ?? 'NA' }}</td>
                            @foreach($totals as $field => $value)
                                @php $totals[$field] += $row->$field ?? 0; @endphp
                                <td>{{ $row->$field ?? 0 }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"><strong>Total</strong></td>
                        @foreach($totals as $total)
                            <td><strong>{{ $total }}</strong></td>
                        @endforeach
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

@endsection
@section('scripts')
@stop

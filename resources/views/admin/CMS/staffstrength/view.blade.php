@extends('layouts.admin.template')
@section('title')
<title>Staff Strength</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
<style>
    thead {
        background-color: #343a40 !important;
        color: white !important;
    }
    tfoot {
        background-color: #f8f9fa !important;
        font-weight: bold !important;
    }
</style>
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mg-b-4 mb-0">Manage Staff Strength</h5>
    </div>
    <div class="d-flex app-header-btn">
        @if(Auth::user()->type == 0)
        <div>
            <a href="<?php echo route('admin.add-staffstrength'); ?>" class="btn ripple btn-wave btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add Staff Strength
            </a>
        </div>
        @endif    
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">Staff Strength</div>
            </div>
            <div class="card-body">
                @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if (session('failed'))
                <div class="alert alert-danger">{{ session('failed') }}</div>
                @endif
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr>
                                <td rowspan=2>#</td>
                                <td rowspan=2>District जनपद</td>
                                <td colspan=2>CFO मुख्य अग्निशमन अधिकारी</td>
                                <td colspan=2>FSO अग्निशमन अधिकारी</td>
                                <td colspan=2>FSSO अग्निशमन द्वितीय अधिकारी</td>
                                <td colspan=2>Leading Fireman लीडिंग फायरमैन</td>
                                <td colspan=2>Fire Service Driver फायर सर्विस चालक</td>
                                <td colspan=2>FireMan फायरमैन</td>
                                <td>Action</td>
                            </tr>
                            <tr>
                                <td>Accepted स्वीकृत</td>
                                <td><strong>Available उपलब्ध</strong></td>
                                <td>Accepted स्वीकृत</td>
                                <td><strong>Available उपलब्ध</strong></td>
                                <td>Accepted स्वीकृत</td>
                                <td><strong>Available उपलब्ध</strong></td>
                                <td>Accepted स्वीकृत</td>
                                <td><strong>Available उपलब्ध</strong></td>
                                <td>Accepted स्वीकृत</td>
                                <td><strong>Available उपलब्ध</strong></td>
                                <td>Accepted स्वीकृत</td>
                                <td><strong>Available उपलब्ध</strong></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $totals = ["cfo_approve" => 0, "cfo_available" => 0, "fso_approve" => 0, "fso_available" => 0,
                                           "fsso_approve" => 0, "fsso_available" => 0, "leading_fireman_aprove" => 0, "leading_fireman_available" => 0,
                                           "fs_driver_approve" => 0, "fs_driver_available" => 0, "fireman_approve" => 0, "fireman_available" => 0];
                            @endphp
                            @foreach($getData as $key => $row)
                            <tr class="table-color1">
                                <td>{{ $key+1 }}</td>
                                <td>{{ $row->d_name ?? 'NA'}}</td>
                                @foreach($totals as $field => $value)
                                    <td>{{ $row->$field ?? '--' }}</td>
                                    @php $totals[$field] += $row->$field ?? 0; @endphp
                                @endforeach
                                <td>
                                    <a href="{{ route('admin.savestaffstrength.edit', $row->id ) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan=2><strong>Total</strong></td>
                                @foreach($totals as $total)
                                    <td><strong>{{ $total }}</strong></td>
                                @endforeach
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.6/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script>
$(function(e) {
    $('#datatable-basic').DataTable({
        dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
    });
});
</script>
@stop

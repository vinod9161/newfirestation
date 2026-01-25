@extends('layouts.admin.template')
@section('title')
<title>Categories | Admin Dashboard</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Category / Types</h5>
    </div>
    <div class="d-flex app-header-btn">
       
        <div>
            <a href="<?php echo route('admin.addtype');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add New Type
            </a>
        </div>
    </div>
</div>



<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Category
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                    @endif
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100">
                        <thead>
                            <tr role="row">
                                <th style="width: 76px;" class="sorting_asc" tabindex="0"
                                    aria-controls="employee-table" rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="S No.: activate to sort column descending">S No.<div
                                        style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Employee Code: activate to sort column ascending"
                                    style="width: 134px;">Types<div style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Name: activate to sort column ascending"
                                    style="width: 153px;">Categories<div style="height: 25px;"></div>
                                </th>


                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Name: activate to sort column ascending"
                                    style="width: 153px;">Sub Categories<div style="height: 25px;"></div>
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Designation: activate to sort column ascending"
                                    style="width: 127px;">Status
                                </th>

                                <th class="sorting" tabindex="0" aria-controls="employee-table" rowspan="1"
                                    colspan="1" aria-label="Gender: activate to sort column ascending"
                                    style="width: 67px;">Created at
                                </th>
                                
                                <th class="d-none d-md-table-cell text-right sorting" style="width: 133px;"
                                    tabindex="0" aria-controls="employee-table" rowspan="1" colspan="1"
                                    aria-label="Actions: activate to sort column ascending">Actions<div
                                        style="height: 25px;"></div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach ($getTypes as $index => $type)
                            <tr>
                                <td>{{ $index + 1 }}</td> 
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->category_name }}</td>
                                <td>{{ $type->subcategory_name }}</td> 
                                <td>{{ $type->status == 1 ? 'Active' : 'Inactive' }}</td> 
                                <td>{{ $type->created_at ? $type->created_at : 'N/A' }}</td>
                                <td class="text-right">
                                    <!-- Edit Button -->
                                    <a href="{{ route('admin.edittype', $type->id) }}" class="btn btn-primary btn-sm"><i class="fe fe-eye"></i></a> 
                                    <!-- Delete Button -->
                                    <a href="{{ route('admin.deletetype', $type->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this type?');"><i class="fe fe-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')

<!-- Datatables Cdn -->
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

    // file export datatable
    $('#datatable-basic').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        },
    });
});
</script>
@stop
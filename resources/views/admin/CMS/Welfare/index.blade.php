@extends('layouts.admin.template')
@section('title')
<title> Welfare and Amenity Fund List</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Welfare and Amenity Fund</h5>
    </div>
    <div class="d-flex app-header-btn">
       
    @if(Auth::user()->type == 0)
        <div>
            <a href="<?php echo route('admin.welfareamenity.add');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> Add  Welfare and Amenity Fund
            </a>
        </div>
    @endif    


    </div>
</div>

<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Welfare and Amenity Fund List
                </div>
            </div>
            <div class="card-body">
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
                <div class="table-responsive">
                    <table id="datatable-basic" class="table table-bordered text-wrap w-100">
                        <thead>
                            <tr role="row">
                                <th style="width: 76px;" class="sorting_asc" tabindex="0" aria-controls="hydrant-table"
                                    rowspan="1" colspan="1" aria-sort="ascending"
                                    aria-label="S No.: activate to sort column descending">S No.<div
                                        style="height: 25px;"></div>
                                </th>
                                <th class="sorting" tabindex="0" aria-controls="hydrant-table" rowspan="1" colspan="1"
                                    aria-label="District: activate to sort column ascending" style="width: 138px;">
                                    Order Number</th>
                                <th class="sorting" tabindex="0" aria-controls="hydrant-table" rowspan="1" colspan="1"
                                    aria-label="Fire Station: activate to sort column ascending" style="width: 263px;">
                                    Date</th>
                                <th class="sorting" tabindex="0" aria-controls="hydrant-table" rowspan="1" colspan="1"
                                    aria-label="Address: activate to sort column ascending" style="width: 111px;">
                                    Category</th>

                                <th class="sorting" tabindex="0" aria-controls="hydrant-table" rowspan="1" colspan="1"
                                    aria-label="Address: activate to sort column ascending" style="width: 111px;">
                                    Title</th>
                                <th class="sorting" tabindex="0" aria-controls="hydrant-table" rowspan="1" colspan="1"
                                    aria-label="Address: activate to sort column ascending" style="width: 111px;">
                                    Subject</th> 
                                <th class="sorting" tabindex="0" aria-controls="hydrant-table" rowspan="1" colspan="1"
                                    aria-label="Address: activate to sort column ascending" style="width: 111px;">
                                    File</th>           

                                @if (Auth::user()->type == '0' || Auth::user()->type == '1' || Auth::user()->type == '4')
                                <th class="sorting" tabindex="0" aria-controls="hydrant-table" rowspan="1" colspan="1"
                                    aria-label="Type: activate to sort column ascending" style="width: 131px;">
                                    ACTION</th>
                                @endif    
                                
                            </tr>
                        </thead>
                            <?php $sn=1; if(!empty($getData)):?>
                            <?php foreach($getData as $key => $val):?>
                                <tr>
                                    <td>{{ $sn; }}</td>
                                    <td>{{ ucfirst($val->number); }}</td>
                                    <td>{{ date('d-m-Y', strtotime($val->date)) }}</td>
                                    <td>{{ $val->type }}</td>
                                    <td>{{ ucfirst($val->title) }}</td>
                                    <td>{{ ucfirst($val->subject) }}</td>
                                    <td>
                                        @if($val->file == '' )
                                        <p class="text-danger">NA</p>
                                        @else
                                        <a href="{{'/'.$val->file}}" class="btn btn-primary btn-sm" download><i class="fa fa-cloud-download"></i> Download</a>
                                        @endif
                                    </td>
                                    
                                    @if (Auth::user()->type == '0' || Auth::user()->type == '1' || Auth::user()->type == '4')
                                        <td> 
                                            <a href="{{ route('admin.welfareamenity.edit', $val->id) }}" class="btn btn-primary btn-delete btn-sm" title="Edit Walfare Amenity"><i class="far fa-edit"></i></a>
                                            <a  onclick="return confirm('Are you sure you want to delete this?')" 
                                                    href="{{ route('admin.welfareamenity.delete', $val->id) }}" 
                                                    class="btn btn-danger btn-delete btn-sm" 
                                                    title="Delete Walfare Amenity">
                                                    <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>    
                                    @endif
                                </tr>   
                            <?php $sn++; endforeach?>
                            <?php else:?>
                                <tr>
                                    <td colspan="7" class="text-danger">No Data Found</td>
                                </tr>
                            <?php endif;?>            
                                
                            
                        <tbody>
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
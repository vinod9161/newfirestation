@extends('admin.dashboard')
@section('child-content')
<div class="header-page">
   <div class="row">
      <div class="col-md-8">
         <h1 class="title-page">Manage Category</h1>
      </div>
      <div class="col-md-4 text-right">
         <div class="search-form" style="padding-right: 0px">
            <a href="{{route('admin.addSubCategoryForm')}}" class="btn btn-light-green">Add New Category</a>
         </div>
      </div>
   </div>
</div>
<section class="box-admin">

   <div class="body-box-admin p-0">
    @if(session()->has('message'))
      <div class="alert alert-success fade in alert-dismissible show" style="margin-top:10px;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true" style="font-size:20px">×</span>
        </button>
         {{ session()->get('message') }}
      </div>
      @elseif(session()->has('error'))
      <div class="alert alert-danger fade in alert-dismissible show" style="margin-top:10px;">                
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true" style="font-size:20px">×</span>
         </button>
         {{ session()->get('error') }}
      </div>
      @endif
      <div class="table-responsive">
         <table class="table ucp-table table-hover table-bordered display" cellpadding="0" cellspacing="0" width="100%" id="category-table">
            <thead>
               <tr>
                  <th style="width: 9%;">S No.</th>
                  <th style="width:30%;">Category Name</th>
                  <th style="width:20%;">Project</th>
                  <th>Status</th>
                  <th class="d-none d-md-table-cell text-right">Actions</th>
               </tr>
            </thead>
            @php
            $i = 1;
            @endphp 
            @foreach($categories as $cat)
            <tr class="my-job-item">
               <td class="d-none d-xl-table-cell text-center number-application" style="width: 9%;">{{$i }}</td>
               <td class="d-none d-xl-table-cell number-application">{{ucfirst($cat->name)}}</td>
               <td  class="d-none d-xl-table-cell text-center number-application">{{ucfirst($cat->project->name)}}</td>
               <td class="d-none d-xl-table-cell text-center number-application">
                  @if($cat->status ==0)
                  @php echo "In-active" @endphp
                  @else 
                  @php echo "Active" @endphp
                  @endif
               </td>
               <td class="d-none d-md-table-cell text-right">
                  <a href="{{route('admin.editCategoryForm', $cat->id)}}" class="btn btn-light btn-edit" title="Edit"><i class="fas fa-pencil-alt"></i> &nbsp;</a>
                  <a onclick="return confirm('Are you sure you Want to Delete ?')" href="{{route('admin.deleteCategory', $cat->id)}}" class="btn btn-light btn-delete" title="Delete"><i class="far fa-trash-alt"></i> </a>
               </td>
            </tr>
            @php
            $i++;
            @endphp 
            @endforeach 
            </tbody>
         </table>
      </div>
   </div>
</section>
@endsection

@section('scripts')

$(document).ready(function() {

   $('#category-table').DataTable( {
        initComplete: function () {
          //  this.api().columns().every( function () {
             this.api().columns([2,3]).every( function () {
                var column = this;
                var select = $('<select class="form-control"><option value="" selected>Select</option></select>')
                    .appendTo( $(column.header()) )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(

                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );

@stop
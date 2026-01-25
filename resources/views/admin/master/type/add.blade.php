@extends('admin.dashboard')
@section('child-content')
<style type="text/css">
     .edit-profile label {
    margin-bottom: 5px;
    margin-top: 10px;
}

.form-group  input{
   height: 30px;
   font-size: .8em;
}

.form-group label {
   font-size: 12px;
    margin-bottom: 4
px
;
    font-weight: 600;
}
.form-group  select{
   height: 30px;
   font-size: .8em;
}

.form-group {
   margin-bottom: 0px;
}

.row {
   margin-top: 10px;
}
</style>
<div class="header-page">
<div class="row">
 
<div class="col-md-9 mb-2" style="justify-content: center; ">
      @if(session()->has('message'))
      <div class="alert alert-success fade in alert-dismissible show" style="margin-bottom: 0px;">   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true" style="font-size:20px">×</span>
         </button>
         {{ session()->get('message') }}
      </div>
      @elseif(session()->has('error'))
      <div class="alert alert-danger fade in alert-dismissible show" style="margin-bottom: 0px;">                
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true" style="font-size:20px">×</span>
         </button>
         {{ session()->get('error') }}
      </div>
      @endif
   </div>
</div>

</div>
<section class="box-admin edit-profile">

         <form action="{{route('admin.saveType')}}" method="POST" enctype="multipart/form-data">
          @csrf
      <div class="body-box-admin">
          <div class="body-box-admin tab-content card" style="padding:0px">
   <h2 class="text-center heading_info">Add Type Details</h2>
    <p class="note" style="margin-left:10px">Fields with <span class="required">*</span> are required.</p>
   <div class="row mt-3" style="padding: 0 30px 25px;">
         <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="form-group">
                  <label class="form-label">Type Name*</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Type Name" required>
               </div>
</div>
 <div class="col-md-4 col-sm-6 col-xs-12">
               <div class="form-group">
                    <label class="form-control-label" for="input-username">Category*</label>
                    <select class="form-control"  name="category_id" id="category_id" required>
                         <option value="" disabled selected>Select Category</option>
                         @foreach ($categories as $ct)
                         <option value="{{ $ct->id }}">{{ ucfirst($ct->name) }} </option>
                         @endforeach
                      </select>
                </div>
</div>
 <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label class="form-control-label" for="input-username">Sub Category*</label>
                    <select class="form-control"  name="subcategory_id" id="subcategory_id" required>
                        <option value="" disabled selected>Select Sub Category</option>
                         
                     </select>
                </div>
          </div>
          </div>     
               <div class="pl-lg-4 text-center mb-3">
               <a href="{{route('admin.type')}}" class="btn btn-sm btn-secondary">Back</a>
               <button class="save-btn hover-btn btn btn-primary" type="submit">Submit</button>
              </div>
            </div>
       </div>
       </form>
  

@endsection
@section('scripts')

 var category = '';
 var subcategory = '';
$("#category_id").change(function () {
   category= @json($categories);
    subcategory =  category[$("#category_id").prop('selectedIndex')-1]['subcategory']; 
        $('#subcategory_id').find('option:not(:first)').remove();
        $("select#subcategory_id").prop('selectedIndex', 0);
   
        $.each(subcategory, function (index, value) {
              $('#subcategory_id').append($("<option></option>").attr("value", value["id"]).text(value["name"]));
        });
    });

 



@stop






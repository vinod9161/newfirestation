@extends('admin.dashboard')
@section('child-content')
<div class="header-page">
   <div class="row">
      <div class="col-md-3">
         <h1 class="title-page">Edit Type</h1>
      </div>
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
<form action="{{route('admin.updateType')}}" method="POST" enctype="multipart/form-data">
   @csrf
   <div class="body-box-admin">
      <div class="row">
         <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="hidden" name="id" value="{{$type['id']}}">
            <div class="form-group">
               <label class="form-label">Type Name*</label>
               <input type="text" class="form-control" id="name" name="name" value="{{$type['name']}}" placeholder="Type Name" required>
            </div>
         </div>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
               <label class="form-control-label" for="input-username">Category</label>
               <select class="form-control"  name="category_id" id="category_id" required>
                  <option value="" disabled selected>Select Category</option>
                  @foreach ($categories as $ct)
                  <option value="{{ $ct->id }}" @if ($ct->id == $type['category_id']) selected @endif>{{ ucfirst($ct->name) }} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
               <label class="form-control-label" for="input-username">Sub Category</label>
               <select class="form-control"  name="subcategory_id" id="subcategory_id" required>
                  <option value="" disabled selected>Select Sub Category</option>
                  @foreach ($categories as $ct)
                  @if($ct->id == $type['category_id']))
                  @foreach ($ct->subcategory as $sub)
                  <option value="{{ $sub->id }}" @if ($sub->id == $type['subcategory_id']) selected @endif>{{ ucfirst($sub->name) }} </option>
                  @endforeach
                  @endif
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
               <label class="form-label">Status</label>
               <select class="form-control" name="status" id="status">
                  <option value="1" <?php if($type['status'] ==1) { echo "selected"; } ?>>Active</option>
                  <option value="0" <?php if($type['status'] ==0) { echo "selected"; } ?>>In-Active</option>
               </select>
            </div>
         </div>
      </div>
      <div class="pl-lg-4 text-right">
         <a href="{{route('admin.type')}}" class="btn btn-sm btn-neutral">Back</a>
         <button class="save-btn hover-btn btn btn-primary" type="submit">Submit</button>
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
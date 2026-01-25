@extends('admin.dashboard')
@section('child-content')
<div class="header-page">
   <div class="row">
      <div class="col-md-3">
         <h1 class="title-page">Edit Sub Category</h1>
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
<form action="{{route('admin.updateSubCategory')}}" method="POST" enctype="multipart/form-data">
   @csrf
   <div class="body-box-admin">
      <div class="row">
         <div class="col-md-4 col-sm-6 col-xs-12">
            <input type="hidden" name="id" value="{{$subcategory['id']}}">
            <div class="form-group">
               <label class="form-label">Sub Category Name*</label>
               <input type="text" class="form-control" id="name" name="name" value="{{$subcategory['name']}}" placeholder="Sub Category Name" required>
            </div>
         </div>
         <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
               <label class="form-control-label" for="input-username">Category</label>
               <select class="form-control"  name="category_id" id="category_id" required>
                  <option value="" disabled selected>Select Category</option>
                  @foreach ($categories as $ct)
                  <option value="{{ $ct->id }}" @if ($ct->id == $subcategory['id']) selected @endif>{{ ucfirst($ct->name) }} </option>
                  @endforeach
               </select>
            </div>
         </div>
         <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
               <label class="form-label">Status</label>
               <select class="form-control" name="status" id="status">
                  <option value="1" <?php if($subcategory['status'] ==1) { echo "selected"; } ?>>Active</option>
                  <option value="0" <?php if($subcategory['status'] ==0) { echo "selected"; } ?>>In-Active</option>
               </select>
            </div>
         </div>
      </div>
      <div class="pl-lg-4 text-right">
         <a href="{{route('admin.subcategory')}}" class="btn btn-sm btn-neutral">Back</a>
         <button class="save-btn hover-btn btn btn-primary" type="submit">Update</button>
      </div>
   </div>
</form>
@endsection
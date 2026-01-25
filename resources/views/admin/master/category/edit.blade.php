@extends('admin.dashboard')
@section('child-content')

<div class="header-page">
<div class="row">
<div class="col-md-3">
<h1 class="title-page">Edit Category</h1>
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

   <form action="{{route('admin.updateCategory')}}" method="POST" enctype="multipart/form-data">
    @csrf
   <div class="body-box-admin">
       <div class="row">
         <div class="col-md-4 col-sm-6 col-xs-12">
         <div class="form-group">
            <input type="hidden" name="id" value="{{$category->id}}">
            <label class="form-label">Category Name*</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Category Name" value="{{$category->name}}" required>
         </div>
        </div>

        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="form-group">
               <label class="form-control-label" for="input-username">Project*</label>
               <select class="form-control"  name="project_id" id="project_id" required>
                  <option value="" disabled selected>Select Project</option>
                  @foreach ($projects as $ct)
                  <option value="{{ $ct->id }}" @if ($ct->id == $category->project_id) selected @endif>{{ ucfirst($ct->name) }} </option>
                  @endforeach
               </select>
            </div>
         </div>
            
        <div class="col-md-4 col-sm-6 col-xs-12">
         <div class="form-group">
            <label class="form-label">Status</label>
            <select class="form-control" name="status" id="status">
              <option value="1" <?php if($category->status ==1) { echo "selected"; } ?>>Active</option>
              <option value="0" <?php if($category->status ==0) { echo "selected"; } ?>>In-Active</option>
            </select>
         </div>
        </div>
        
        </div> 
         <div class="pl-lg-4 text-right">
         <a href="{{route('admin.category')}}" class="btn btn-sm btn-neutral">Back</a>
         <button class="save-btn hover-btn btn btn-primary" type="submit">Submit</button>
        </div>
      </div>
   </form>




@endsection







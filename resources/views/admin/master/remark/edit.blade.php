@extends('layouts.admin.template')
@section('title')
<title>Edit Noc Remark</title>
@endsection
@section('style')


@endsection
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{route('admin.updateRemarkPost')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="body-box-admin tab-content card" style="padding:0px">
        <h2 class="text-center" style="background-color:#42425d;color:#ffffff">Edit Remark</h2>
        <p class="note" style="margin-left:10px; color:red">Fields with <span class="required">*</span> are required.</p>
        <div class="row mt-3" style="padding: 0 30px 25px;">
            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                 <input type="hidden" name="id" value="{{$remark->id}}">
                    <label class="form-label">Remark Title*</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Remark Title" value="{{$remark->title}}" required>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                <label class="form-label">Status</label>
                    <select class="form-control" name="status" id="status">
                    <option value="1" <?php if($remark->status ==1) { echo "selected"; } ?>>Active</option>
                    <option value="0" <?php if($remark->status ==0) { echo "selected"; } ?>>In-Active</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="pl-lg-4 text-center mb-3" style="margin-right:85%;">
            <a href="{{ route('admin.remark') }}" class="save-btn hover-btn btn btn-secondary">Back</a>
            <button class="save-btn hover-btn btn btn-primary" type="submit">Update</button>
        </div>
    </div>
</form>


@endsection

@section('scripts')
@stop
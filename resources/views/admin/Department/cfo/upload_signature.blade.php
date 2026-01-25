@extends('layouts.admin.template')
@section('title')
<title>Departments | Admin Dashboard</title>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Departments / CFO</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.cfo');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View CFO List
            </a>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Upload Signature
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    
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

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                  <form action="{{route('admin.uploadSignaturePost')}}" method="POST" enctype="multipart/form-data"> 
                                        @csrf
                                        <div class="row">
                                           <input type="hidden" name="id" value="{{$cfo->id}}">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Signature <sup class="text-danger">*</sup></label>
                                                    <input type="file" class="form-control" id="signature" name="signature" value="" required style="height:33px;">
                                                      @if($errors->has('signature'))
                                                      <div class="validation-error">{{ $errors->first('signature') }}</div>
                                                      @endif
                                                    <span class="text-danger" id="signatureError"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-6 col-xs-12">
                                                @if($cfo->signature !='')
                                                <img src="{{ asset($cfo->signature) }}" alt="client" width="70" height="70" class="shadow-sm mr-3"/>
                                                @endif
                                             </div>

                                            

                                            <div class="col-md-12">
                                                <button type="submit" id="addCfo" class="btn btn-primary btn-sm" style="width:20%">Update</button>
                                            </div>
                                        </div>
                                    </form>
                                   
                                       
                                 </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>

@stop






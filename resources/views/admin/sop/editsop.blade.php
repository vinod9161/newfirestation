@extends('layouts.admin.template')
@section('title')
<title>Edit Sop</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage SOP</h5>
    </div>
    <div class="d-flex app-header-btn">
       
        <div>
            <a href="<?php echo route('admin.sop');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> View SOP List
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
                    Edit SOP
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-7" style="margin:0 auto">
                        <div class="card">
                            <div class="card-body">
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

                                
                                <form action="{{ route('admin.sop.update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Subject<sup class="text-danger">*</sup></label>
                                                <input type="text" name="subject" id="subject" class="form-control" required value="{{ $getSop[0]->subject }}">
                                                <span id="subErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Upload SOP</label>
                                                <input type="file" name="file" id="file" class="form-control" placeholder="Select SOP File">
                                                <span id="fileErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="input-username">status <span class="text-danger">*</span></label>
                                                <select class="form-control" name="status" id="status" data-trigger>
                                                    <option {{ $getSop[0]->status == 0 ? 'selected' : '' }} value="0">Inactive </option>
                                                    <option {{ $getSop[0]->status == 1 ? 'selected' : '' }} value="1">Active </option>
                                                </select>
                                                <span id="statusErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{ $getSop[0]->id }}">
                                                <input type="hidden" name="type" value="upload-sop">
                                                <button type="submit" class="btn btn-primary btn-sm w-100" id="addsop">Upload</button>
                                            </div>
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
<!--End::row-1 -->
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $('#addsop').on('click', function(){
            let subject = $('#subject').val();
            let file = $('#file').val();
            let status = $('#status').val();
            let id = $('#id').val();
            let fileExtension = file.split('.').pop().toLowerCase();

            if(subject === '')
            {
                $('#subErr').html('Required SOP Subject').delay(3000).fadeOut().css('display','block');
                return false;
            }
            else if(status === '')
            {
                $('#statusErr').html('Required SOP Status').delay(3000).fadeOut().css('display','block');
                return false;  
            }
            else if(id == '')
            {
                alert("UserId Missing");
                return false;  
            }
            else{
                return true;
            }
        });
    });
</script>
@stop
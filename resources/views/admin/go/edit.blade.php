@extends('layouts.admin.template')
@section('title')
<title>Edit GO Circular</title>
@endsection
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.bootstrap5.min.css">
@endsection
@section('content')
<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Go Circular</h5>
    </div>
    <div class="d-flex app-header-btn">
       
        <div>
            <a href="<?php echo route('admin.go.circular');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-plus me-1"></i> View Go Circuler List
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
                    Edit Go Circular
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col-md-12" style="margin:0 auto">
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

                                <form action="{{ route('admin.go.circular.post.update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Act/Rule/Order Number<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" name="number" id="number" placeholder="Act/Rule/Order Number" value="{{ $getData->number }}" required>
                                                <span id="actErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Date<sup class="text-danger">*</sup></label>
                                                <input type="date" class="form-control" name="date" id="date" placeholder="Select date." value="{{ $getData->date }}" required>
                                                <span id="dateErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Type<sup class="text-danger">*</sup></label>
                                                <select class="form-control js-example-basic-single" name="type" id="type" required>
                                                    <option value="">--Select Type Of GO Circular--</option>
                                                    <option value="Act" @selected($getData->type == 'Act')>Act</option>
                                                    <option value="Rules" @selected($getData->type == 'Rules')>Rules</option>
                                                    <option value="Regulations" @selected($getData->type == 'Regulations')>Regulations</option>
                                                    <option value="Notifications" @selected($getData->type == 'Notifications')>Notifications</option>
                                                    <option value="Government Orders" @selected($getData->type == 'Government Orders')>Government Orders</option>
                                                    <option value="Circulars" @selected($getData->type == 'Circulars')>Circulars</option>
                                                    <option value="Ordinance" @selected($getData->type == 'Ordinance')>Ordinance</option>
                                                    <option value="Statutes" @selected($getData->type == 'Statutes')>Statutes</option>
                                                    <option value="Code/Norms" @selected($getData->type == 'Code/Norms')>Code/Norms</option>
                                                    <option value="Court Decision" @selected($getData->type == 'Court Decision')>Court Decision</option>
                                                    <option value="Other" @selected($getData->type == 'Other')>Other</option>
                                                </select>

                                                <span id="typeErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Title<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title" value="{{ $getData->title }}" required>
                                                <span id="titleErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Subject<sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter Subject" value="{{ $getData->subject }}" required>
                                                <span id="subjectErr" class="text-danger"></span>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Go Circular</label>
                                                <input type="file" class="form-control" name="file" id="file" placeholder="Select File For Go Circular">
                                                <span id="fileErr" class="text-danger"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @php
                                        $visibility = explode(',', $getData->visibility ?? '');
                                        @endphp

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Visibility <sup class="text-danger">*</sup></label><br>

                                                <input type="checkbox" name="visibility[]" value="HQ"
                                                {{ in_array('HQ',$visibility) ? 'checked' : '' }}>
                                                HQ (Employees except CFO & FSO)
                                                <br>

                                                <input type="checkbox" name="visibility[]" value="FIELD"
                                                {{ in_array('FIELD',$visibility) ? 'checked' : '' }}>
                                                Field Staff (CFO & FSO)
                                                <br>

                                                <input type="checkbox" name="visibility[]" value="PUBLIC"
                                                {{ in_array('PUBLIC',$visibility) ? 'checked' : '' }}>
                                                Public (View on Website)
                                            </div>
                                        </div>


                                        <div class="col-md-4" style="margin:0 auto; margin-top:30px">
                                            <div class="form-group">
                                                <input type="hidden" name="goid" value="{{ $getData->id }}">
                                                <button type="submit" class="btn btn-primary btn-sm w-100" id="addgo">Update</button>
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
<script>
    $(document).ready(function(){
        $('#addgo').on('click', function(){
            let number = $('#number').val();
            let date = $('#date').val();
            let type = $('#type').val();
            let title = $('#title').val();
            let subject = $('#subject').val();
            let file = $('#file').val();
            let id = $('#id').val();
            let fileExtension = file.split('.').pop().toLowerCase();

            if(number === '')
            {
                $('#actErr').html('Required Act/Rule/Order Number').delay(3000).fadeOut().css('display','block');
                return false;
            }
            else if(date === '')
            {
                $('#dateErr').html('Required Date').delay(3000).fadeOut().css('display','block');
                return false;
            }
            else if(type === '')
            {
                $('#typeErr').html('Required Type').delay(3000).fadeOut().css('display','block');
                return false;
            }
            else if(title === '')
            {
                $('#titleErr').html('Required title').delay(3000).fadeOut().css('display','block');
                return false;
            }
            else if(subject === '')
            {
                $('#subjectErr').html('Required subject').delay(3000).fadeOut().css('display','block');
                return false;
            }
            else if (file !== '' && fileExtension !== 'pdf') {
                $('#fileErr').html('Only PDF files are allowed').css('display', 'block').delay(3000).fadeOut();
                return false;
            }
            else{
                return true;
            }
        });
    });
</script>
@stop
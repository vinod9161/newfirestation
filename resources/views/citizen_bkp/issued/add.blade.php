@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Issued NOC</h5>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
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

                    <form action="{{route('citizen.addIssuedNocPost')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Application Number <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="application_no" id="application_no" placeholder="Application Number" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Application For <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple"  name="project" id="project" required>
                                        <option value="" disabled selected>-- Select An Option --</option>
                                        @foreach ($projects as $prd)
                                            <option value="{{ ucfirst($prd->name) }}">{{ ucfirst($prd->name) }} </option>
                                        @endforeach
                                    </select>    
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Application Type <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple"  name="application_type" id="application_type" required onclick="chooseCategory();">
                                        <option value="" disabled selected>-- Select An Option --</option>
                                        <option value="Pre Establishment">Select Pre Establishment</option>
                                        <option value="Pre Operational">Select Pre Operational</option>
                                        <option value="Renewal">Select Renewal</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Building Name <span class="text-danger">*</span></label>
                                    <input class="form-control" size="60" maxlength="255" name="building_name" id="building_name" type="text"  value="{{ ucfirst(Auth::user()->building_name) ?? ''}}" required readonly />
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> District जनपद <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple"  name="district_id" id="district_id" required readonly>
                                        @foreach ($districts as $dist)
                                            @if(Auth::user()->district_id ==$dist->id)
                                                <option value="{{ $dist->id }}" selected >{{ ucfirst($dist->name) }} </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Uploaded New File <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="upload_file" id="upload_file" required>
                                </div>
                            </div>
                            <div class="col-md-12" style="display: inline-table;">
                                <a href="{{route('citizen.upload.sop')}}" id="addOrganisational" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary" style="margin-left:10px;">Upload</button>
                            </div>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>
 <script>  
     $(document).ready(function(){ 
        $('.js-example-basic-multiple').select2();
    });
  
 </script>
@stop
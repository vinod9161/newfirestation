@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Safety Officer</h5>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-body">
                <div class="table-responsive">
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

                    <form action="{{route('citizen.safety.officer.post')}}"method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Name of fire safety officer <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name of fire safety officer" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Minimum Qualifications <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="minimum_qualification" id="minimum_qualification" placeholder="Minimum Qualifications" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Phone No. (Office) <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone No. (Office)" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Mobile No. <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="mobile_no" id="mobile_no" placeholder="Mobile No." required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Number of fire safety trained person in Institution <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="person" id="person" placeholder="Number of fire safety trained person in Institution" required>
                                </div>
                            </div>
                            <div class="col-md-12" style="display: inline-table;">
                                <input type="hidden" name="user_id" value="{{$citizen[0]->id}}">
                                <a href="{{route('citizen.account')}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary" style="margin-left:10px;">Submit</button>
                            </div>
                        </div>
                    </form>  

                    
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100" style="margin-top:20px;">
                        <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Name of fire safety officer</th>
                                <th>Minimum Qualifications</th>
                                <th>Phone No. (Office)</th>
                                <th>Mobile No.</th>
                                <th>Number of fire safety trained person in Institution</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($safety as $key => $sf)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sf->name }}</td>
                                <td>{{ $sf->minimum_qualification }}</td>
                                <td>{{ $sf->phone_no }}</td>
                                <td>{{ $sf->mobile_no }}</td>
                                <td>{{ $sf->person }}</td>
                                <td>
                                    <a href="{{route('citizen.safety.officer.delete', $sf->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this organisational structure?');"><i class="fe fe-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
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
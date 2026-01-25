@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Upload Fire Escape Plan</h5>
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

                    <form action="{{route('citizen.saveFireEscapePlan')}}"method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Floor <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="floor" id="floor" placeholder="Enter Floor No.">
                                    <span class="text-danger" id="error_1"></span>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Fire Escape Plan <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file" id="file">
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-12" style="display: inline-table;">
                                <input type="hidden" name="id" value="{{$citizen[0]->id}}">
                                <a href="{{route('citizen.account')}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary" style="margin-left:10px;">Upload</button>
                            </div>
                        </div>
                    </form>  

                    
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100" style="margin-top:20px;">
                        <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Type Of Program</th>
                                <th>Program Datetime</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($firePlan as $key => $plan)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $plan->floor }}</td>
                                <td><img src="{{ asset($plan->fire_escape_plan) }}" alt="client" class="shadow-sm mr-3" style="width:150px;"></td>
                                <td>
                                    <!-- Delete Button -->
                                    <a href="{{route('fire.escape.plan.delete', $plan->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this organisational structure?');"><i class="fe fe-trash"></i></a>
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
@stop
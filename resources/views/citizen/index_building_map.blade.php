@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Uploading Building Map</h5>
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

                    <form action="{{route('citizen.uploadDocument')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <input type="hidden" name="id" value="{{$citizen[0]->id}}">
                            <input type="hidden" name="type" value="building-map">
                            <div class="col-md-8 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <input type="file" class="form-control" name="file" id="file" required>
                                </div>
                            </div>
                            <div class="col-md-4" style="display: inline-table;">
                                <button type="submit" id="addOrganisational" class="btn btn-primary" style="margin-left:10px;">Upload</button>
                            </div>
                        </div>
                    </form>   

                    
                    <table id="datatable-basic" class="table table-bordered text-nowrap w-100" style="margin-top:20px;">
                        <thead>
                            <tr role="row">
                                <th>S No.</th>
                                <th>Building Map</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($buildingPlan as $key => $build)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><a href="{{ asset($build->building_map) }}" target="_blank"><img src="{{ asset($build->building_map) }}" alt="client" class="shadow-sm mr-3" style="width:150px;"></a></td>
                                <td>
                                    <!-- Delete Button -->
                                    <a href="{{route('citizen.building.map.delete', $build->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this organisational structure?');"><i class="fe fe-trash"></i></a>
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
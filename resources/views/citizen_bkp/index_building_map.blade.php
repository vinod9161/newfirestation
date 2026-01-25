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
                                <button type="submit" id="addOrganisational" class="btn btn-danger">Cancel</button>
                                <button type="submit" id="addOrganisational" class="btn btn-primary" style="margin-left:10px;">Upload</button>
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
@stop
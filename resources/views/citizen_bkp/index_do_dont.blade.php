@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Upload Do Donts</h5>
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
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Do Donts <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="file" id="file" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 me2">
                                <a href="{{ asset($doDonts[0]->do_and_dont) }}" target="_blank" download>
                                    <img src="{{ asset($doDonts[0]->do_and_dont) }}" alt="client" width="200" height="200" class="shadow-sm mr-3" />
                                </a>
                            </div>
                            <div class="col-md-12" style="display: inline-table;">
                                <input type="hidden" name="id" value="{{$citizen[0]->id}}">
                                <input type="hidden" name="type" value="do-dont">
                                <a href="{{route('citizen.account')}}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-primary" style="margin-left:10px;">Update</button>
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
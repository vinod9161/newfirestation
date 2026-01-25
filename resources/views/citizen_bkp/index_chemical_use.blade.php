@extends('layouts.citizen.template')
@section('content')

<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Chemical Use</h5>
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

                    <form action="{{route('citizen.SaveChemicalUse')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Chemical Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Chemical Name" required>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Chemical Form <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple" name="chemical_form" id="chemical_form" required>
                                        <option value="" style="display:none;">-- Select An Option --</option>
                                        <option value="Solid">Solid</option>
                                        <option value="Liquid">Liquid</option>
                                        <option value="Gas">Gas</option>
                                    </select>
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Health <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple" name="health" id="health" required>
                                        <option value="" style="display:none;">-- Select An Option --</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Fire <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple" name="fire" id="fire" required>
                                        <option value="" style="display:none;">-- Select An Option --</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Reactivity <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple" name="reactivity" id="reactivity" style="height:42px;" required>
                                        <option value="" style="display:none;">-- Select An Option --</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <span class="text-danger" id="error_2"></span>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Special Note <span class="text-danger">*</span></label>
                                    <select class="form-control js-example-basic-multiple" name="note" id="note" required>
                                        <option value="" style="display:none;">-- Select An Option --</option>
                                        <option value="OX">OX</option>
                                        <option value="W">W</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 me2">
                                <div class="form-group">
                                    <label class="form-label"> Other Comment <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="comment" id="comment" placeholder="Enter Floor No." required>
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
                                <th>Chemical Name</th>
                                <th>Chemical Form</th>
                                <th>Health</th>
                                <th>Fire</th>
                                <th>Reactivity</th>
                                <th>Special Note</th>
                                <th>Other Comment</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chemical as $key => $chem)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $chem->name }}</td>
                                <td>{{ $chem->chemical_form }}</td>
                                <td>{{ $chem->health }}</td>
                                <td>{{ $chem->fire }}</td>
                                <td>{{ $chem->reactivity }}</td>
                                <td>{{ $chem->note }}</td>
                                <td>{{ $chem->comment }}</td>
                                <td>
                                    <!-- Delete Button -->
                                    <a href="{{route('citizen.chemical.use.delete', $chem->id)}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this organisational structure?');"><i class="fe fe-trash"></i></a>
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
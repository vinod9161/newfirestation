@extends('layouts.admin.template')

@section('title')
<title>Leadership Section | Admin Dashboard</title>
@endsection

@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@endsection


@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">

    <div>
        <h5 class="main-content-title fs-24 mb-0">Manage Leadership Section</h5>
    </div>

    <div>
        <a href="{{ route('admin.addLeadershipSection') }}" class="btn btn-success">
            <i class="fe fe-plus"></i> Add Leadership
        </a>
    </div>

</div>



<div class="row">
    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">
                <div class="card-title">
                    Leadership Section List
                </div>
            </div>


            <div class="card-body">

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif


                <table id="datatable-basic" class="table table-bordered">

                    <thead>
                        <tr>
                            <th>S No</th>
                            <th>CM</th>
                            <th>DGP</th>
                            <th>Subject</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>


                    <tbody>

                        @foreach($leadership as $index => $row)

                        <tr>

                            <td>{{ $index + 1 }}</td>


                            <td>
                                <img src="{{ url('public/'.$row->cm_image) }}" width="60"><br>
                                {{ $row->cm_name }}
                            </td>


                            <td>
                                <img src="{{ url('public/'.$row->dgp_image) }}" width="60"><br>
                                {{ $row->dgp_name }}
                            </td>


                            <td>{{ $row->subject }}</td>


                            <td>
                                {{ $row->status == 1 ? 'Active' : 'Inactive' }}
                            </td>


                            <td>

                                <a href="{{ route('admin.editLeadershipSectionForm',$row->id) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fe fe-edit"></i>
                                </a>


                                <a href="{{ route('admin.deleteLeadershipSection',$row->id) }}"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
                                    <i class="fe fe-trash"></i>
                                </a>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>
</div>

@endsection



@section('scripts')

<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $('#datatable-basic').DataTable();
</script>

@endsection
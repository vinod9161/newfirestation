@extends('layouts.admin.template')
@section('title')
<title>Achievements | Admin Dashboard</title>
@endsection

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mb-0">
            Achievement List
        </h5>
    </div>

    <div class="d-flex app-header-btn">
        <a href="{{ route('admin.achievement.add') }}" class="btn ripple btn-wave btn-success">
            <i class="fe fe-plus me-1"></i> Add Achievement
        </a>
    </div>
</div>


<div class="row">
    <div class="col-xl-12">

        <div class="card custom-card">

            <div class="card-header">
                <div class="card-title">
                    All Achievements
                </div>
            </div>

            <div class="card-body">

                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif


                <div class="table-responsive">

                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Year</th>
                                <th width="200">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($achievements as $row)

                            <tr>

                                <td>{{ $row->id }}</td>

                                <td>{{ $row->year }}</td>

                                <td>

                                    <a href="{{ route('admin.achievement.edit',$row->id) }}"
                                        class="btn btn-primary btn-sm">

                                        Edit
                                    </a>


                                    <a href="{{ route('admin.achievement.delete',$row->id) }}"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete this record?')">

                                        Delete
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
</div>

@endsection
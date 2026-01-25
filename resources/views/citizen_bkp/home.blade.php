@extends('layouts.citizen.template')
@section('content')
<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">NOC</h5>
    </div>
</div>
<div class="row">
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Building</h6>
                </div>
                <a href="{{route('noc.step.first', ['noc' => 'building', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;">Pre Establishment</a>
                <a href="#" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;">Pre Opertaional</a>
                <a href="#" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;">Renewal</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Temporary Services</h6>
                </div>
                <a href="#" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;">Temporary</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Issued NOC</h6>
                </div>
                <a href="#" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;">Issued NOC</a>
            </div>
        </div>
    </div>
</div>    
@endsection
@section('scripts')
@stop
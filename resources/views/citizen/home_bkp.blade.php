@extends('layouts.citizen.template')
@section('content')
<div class="d-md-flex d-block align-items-center  justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">NOC</h5>
    </div>
</div>
@if(!$application)
<div class="row">
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Building</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'building', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="building-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="building-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Cinema Hall- Multiplex</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'cinema_hall_multiplex', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="cinema_hall_multiplex-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="cinema_hall_multiplex-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Fire Arms Repair</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_repair', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="fire_arms_repair-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="fire_arms_repair-renewal_repair" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Fire Arms Selling</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_selling', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="fire_arms_selling-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="fire_arms_selling-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Fire Arms Storage</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_storage', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="fire_arms_storage-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="fire_arms_storage-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Gas Warehouse and Agency</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'gas_warehouse', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="gas_warehouse-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="gas_warehouse-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Gas-Oil-Depot</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'gas_oil_depot', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="gas_oil_depot-operational;" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="gas_oil_depot-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Sale Of Sulphur</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'sale_of_sulphur', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="sale_of_sulphur-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="sale_of_sulphur-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Storage - Magazine</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'storage_magazine', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="storage_magazine-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="storage_magazine-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Petrol Pump-CNG Station</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'petrol_pump_cng_station', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="petrol_pump_cng_station-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="petrol_pump_cng_station-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Fire Works</h6>
                </div>
                <a href="{{route('noc.apply', ['noc' => 'fire_works', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                <a id="fire_works-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a id="fire_works-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3">
        <div class="card custom-card" style="min-height: 260px;">
            <div class="card-body user-card">
                <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                    <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                    <h6>Temporary services</h6>
                </div>
                <a href="{{route('citizen.temporary_noc')}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Temporary</a>
            </div>
        </div>
    </div>
</div>
@endif

@if($application)
<div class="row">
    @if($application[0]->status == 'approved')
        @if($application[0]->noc_type=='building')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Building</h6>
                    </div>
                        @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                        <button type="button" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                        @else
                        <a href="{{route('noc.apply', ['noc' => 'building', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        @endif
                        <button type="button" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;" data-bs-toggle="modal" data-bs-target="#approvedOpApplications">Pre Opertaional</button>
                        

                        @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                        <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                        @else
                        <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                        @endif
                </div>
            </div>
        </div>
        @endif


        @if($application[0]->noc_type=='cinema_hall_multiplex')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Cinema Hall- Multiplex</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'cinema_hall_multiplex', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='fire_arms_repair')

        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Fire Arms Repair</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'fire_arms_repair', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='fire_arms_selling')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Fire Arms Selling</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'fire_arms_selling', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='fire_arms_storage')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Fire Arms Storage</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'fire_arms_storage', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='gas_warehouse')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Gas Warehouse and Agency</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'gas_warehouse', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='gas_oil_depot')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Gas-Oil-Depot</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'gas_oil_depot', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='sale_of_sulphur')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Sale Of Sulphur</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'sale_of_sulphur', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='storage_magazine')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Storage - Magazine</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'storage_magazine', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='petrol_pump_cng_station')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Petrol Pump-CNG Station</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'petrol_pump_cng_station', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        @if($application[0]->noc_type=='fire_works')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Fire Works</h6>
                    </div>
                    @if(isset($application[0]->application_type) && $application[0]->application_type =='pre establishment noc')
                    <a href="{{route('citizen.viewNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @else
                    <a href="{{route('noc.apply', ['noc' => 'fire_works', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                    @endif

                    @if(isset($application[0]->operational_application->application_type) && $application[0]->operational_application->application_type =='pre operational noc')
                    <a href="{{route('citizen.viewOperationalNocDetail', $application[0]->operational_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @else
                    <a href="{{route('citizen.applyOperationalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                    @endif

                    @if(isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type =='pre renewal noc')
                    <a href="{{route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @else
                    <a href="{{route('citizen.applyRenewalNocDetail', $application[0]->id)}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Temporary Services</h6>
                    </div>
                    <a href="{{route('citizen.temporary_noc')}}" class="btn ripple btn-primary mt-3 openMOdal" style="width:100%;justify-content:normal;margin-bottom:10px;">Temporary</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                        <h6>Issued NOC</h6>
                    </div>
                    <a href="{{route('citizen.issuedNoc')}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Issued NOC</a>
                </div>
            </div>
        </div>

    @else
        @if($application[0]->status == 'pending' || $application[0]->status == 'processed')
            <div class="card custom-card" id="additional-alerts">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="alert alert-info mb-0" role="alert">
                                <h2 class="alert-heading">Pending!</h2>
                                <h4>Your application is under review. Please come back after sometime.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($application[0]->status == 'reverted')
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Building</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'building', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="building-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="building-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Cinema Hall- Multiplex</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'cinema_hall_multiplex', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="cinema_hall_multiplex-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="cinema_hall_multiplex-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Fire Arms Repair</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'fire_arms_repair', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="fire_arms_repair-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="fire_arms_repair-renewal_repair" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Fire Arms Selling</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'fire_arms_selling', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="fire_arms_selling-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="fire_arms_selling-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Fire Arms Storage</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'fire_arms_storage', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="fire_arms_storage-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="fire_arms_storage-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Gas Warehouse and Agency</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'gas_warehouse', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="gas_warehouse-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="gas_warehouse-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Gas-Oil-Depot</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'gas_oil_depot', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="gas_oil_depot-operational;" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="gas_oil_depot-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Sale Of Sulphur</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'sale_of_sulphur', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="sale_of_sulphur-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="sale_of_sulphur-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Storage - Magazine</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'storage_magazine', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="storage_magazine-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="storage_magazine-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Petrol Pump-CNG Station</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'petrol_pump_cng_station', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="petrol_pump_cng_station-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="petrol_pump_cng_station-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Fire Works</h6>
                        </div>
                        <a href="{{route('noc.apply', ['noc' => 'fire_works', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Establishment</a>
                        <a id="fire_works-operational" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                        <a id="fire_works-renewal" class="btn ripple btn-primary mt-3 openModal" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height: 260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px; height:60px; object-fit:contain">
                            <h6>Temporary services</h6>
                        </div>
                        <a href="{{route('citizen.temporary_noc')}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Temporary</a>
                    </div>
                </div>
            </div>
        @elseif($application[0]->status == 'incomplete')
            <div class="card custom-card" id="additional-alerts">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="alert alert-warning mb-0" role="alert">
                                <h2 class="alert-heading">Incomplete!</h2>
                                <h4>Your application is incomplete. Please fill all necessay details.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>


@endif

<!-- Modal -->
<div class="modal fade" id="openApplication" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{route('citizen.checkNoc')}}">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-6 col-xs-12">
                            <div class="form-group">
                                <input type="hidden" name="noc_type" id="noc_type">
                                <input type="hidden" name="noc_step" id="noc_step">
                                <label class="form-label">If you already have application no please enter same application no. if you do not remember application no please contact fire officer.</label>
                                <input type="text" class="form-control" id="application_no" name="application_no" placeholder="Enter Your Application No.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Go Next</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="approvedApplications" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Extension & Diversity</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('noc.extension.post')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose Your Application</label>
                        <select class="form-control" id="application_id" name="application_id">
                            <option value="" style="display:none;">-- Select An Option --</option>
                            @foreach($approvedApplication as $key => $app)
                            <option value="{{ $app->application_no }}">{{ $app->application_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="extension">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="approvedOpApplications" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="staticBackdropLabel">Extension & Diversity</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{route('noc.operational.post')}}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Choose Your Application</label>
                        <select class="form-control" id="application_id" name="application_id">
                            <option value="" style="display:none;">-- Select An Option --</option>
                            @foreach($approvedApplication as $key => $app)
                            <option value="{{ $app->application_no }}">{{ $app->application_no }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="extension">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $(document).on('click','.openModal', function(){
            var id = $(this).attr('id');
            let split = id.split('-');
            var type = split[0];
            var noc = split[1];
            $('#noc_type').val(type);
            $('#noc_step').val(noc);
            $('#openApplication').modal('show');
        });
    });
</script>
@stop
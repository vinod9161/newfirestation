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
                <button type="button" class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#preOpModal">
                    Pre Opertaional
                </button>
                <button type="button" class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#renewalModal">
                    Renewal
                </button>
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
                <a href="{{ route('noc.apply', ['noc' => 'cinema_hall_multiplex', 'type' => 'pre operational noc']) }}" id="building-operational" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{ route('noc.apply', ['noc' => 'cinema_hall_multiplex', 'type' => 'renewal noc']) }}" id="building-renewal" class="btn ripple btn-primary mt-3 " style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_repair', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_repair', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_selling', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_selling', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_storage', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'fire_arms_storage', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'gas_warehouse', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'gas_warehouse', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'gas_oil_depot', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'gas_oil_depot', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'sale_of_sulphur', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'sale_of_sulphur', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'storage_magazine', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'storage_magazine', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'petrol_pump_cng_station', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'petrol_pump_cng_station', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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
                <a href="{{route('noc.apply', ['noc' => 'fire_works', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Pre Opertaional</a>
                <a href="{{route('noc.apply', ['noc' => 'fire_works', 'type' => 'established'])}}" class="btn ripple btn-primary mt-3" style="width:100%;justify-content:normal;margin-bottom:10px;">Renewal</a>
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

        {{-- BUILDING --}}
        @if($application[0]->noc_type == 'building')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Building</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    <!-- @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button type="button" class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'building', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif -->

                    {{-- PRE ESTABLISHMENT --}}
                    @if(count($preEstApps) > 0)
                        <button type="button" class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#preEstModal">
                            Pre Establishment
                        </button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'building', 'type' => 'established']) }}"
                        class="btn ripple btn-primary mt-3 w-100">
                            Pre Establishment
                        </a>
                    @endif


                    {{-- PRE OPERATIONAL --}}
                    @if(count($preEstApps) > 0 || count($preOpApps) > 0)
                        <button type="button"
                                class="btn ripple btn-primary mt-3 w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#preOpModal">
                            Pre Operational
                        </button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'building', 'type' => 'pre operational noc']) }}"
                        class="btn ripple btn-primary mt-3 w-100">
                            Pre Operational
                        </a>
                    @endif


                    {{-- RENEWAL --}}
                    @if(count($preOpApps) > 0 || count($renewalApps) > 0)
                        <button type="button"
                                class="btn ripple btn-primary mt-3 w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#renewalModal">
                            Renewal
                        </button>
                    @else
                        <!-- <a href="{{ route('noc.apply', ['noc' => 'building', 'type' => 'renewal noc']) }}"
                        class="btn ripple btn-primary mt-3 w-100">
                            Renewal
                        </a> -->
                        <button type="button"
                                class="btn ripple btn-primary mt-3 w-100"
                                data-bs-toggle="modal"
                                data-bs-target="#renewalModal">
                            Renewal
                        </button>
                    @endif

                </div>
            </div>
        </div>
        @endif


        {{-- CINEMA HALL - MULTIPLEX --}}
        @if($application[0]->noc_type == 'cinema_hall_multiplex')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Cinema Hall- Multiplex</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'cinema_hall_multiplex', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- FIRE ARMS REPAIR --}}
        @if($application[0]->noc_type == 'fire_arms_repair')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Fire Arms Repair</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'fire_arms_repair', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- FIRE ARMS SELLING --}}
        @if($application[0]->noc_type == 'fire_arms_selling')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Fire Arms Selling</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'fire_arms_selling', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- FIRE ARMS STORAGE --}}
        @if($application[0]->noc_type == 'fire_arms_storage')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height: 260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Fire Arms Storage</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'fire_arms_storage', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- GAS WAREHOUSE --}}
        @if($application[0]->noc_type == 'gas_warehouse')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Gas Warehouse and Agency</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'gas_warehouse', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- GAS OIL DEPOT --}}
        @if($application[0]->noc_type == 'gas_oil_depot')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Gas-Oil-Depot</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'gas_oil_depot', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- SALE OF SULPHUR --}}
        @if($application[0]->noc_type == 'sale_of_sulphur')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Sale Of Sulphur</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'sale_of_sulphur', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- STORAGE - MAGAZINE --}}
        @if($application[0]->noc_type == 'storage_magazine')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Storage - Magazine</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'storage_magazine', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- PETROL PUMP - CNG STATION --}}
        @if($application[0]->noc_type == 'petrol_pump_cng_station')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Petrol Pump-CNG Station</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'petrol_pump_cng_station', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- FIRE WORKS --}}
        @if($application[0]->noc_type == 'fire_works')
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Fire Works</h6>
                    </div>

                    {{-- PRE ESTABLISHMENT --}}
                    @if(isset($application[0]->application_type) && $application[0]->application_type == 'pre establishment noc')
                        <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Establishment</button>
                    @else
                        <a href="{{ route('noc.apply', ['noc' => 'fire_works', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                    @endif

                    {{-- PRE OPERATIONAL --}}
                    <button class="btn ripple btn-primary mt-3 w-100" data-bs-toggle="modal" data-bs-target="#approvedApplications">Pre Opertaional</button>

                    {{-- RENEWAL --}}
                    @if(isset($application[0]->renewal_application) && isset($application[0]->renewal_application->application_type) && $application[0]->renewal_application->application_type == 'pre renewal noc')
                        <a href="{{ route('citizen.viewRenewalNocDetail', $application[0]->renewal_application->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @else
                        <a href="{{ route('citizen.applyRenewalNocDetail', $application[0]->id) }}" class="btn ripple btn-primary mt-3 w-100">Renewal</a>
                    @endif
                </div>
            </div>
        </div>
        @endif

        {{-- TEMPORARY SERVICES CARD (always show) --}}
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Temporary Services</h6>
                    </div>
                    <a href="{{ route('citizen.temporary_noc') }}" class="btn ripple btn-primary mt-3 w-100">Temporary</a>
                </div>
            </div>
        </div>

        {{-- ISSUED NOC CARD (always show) --}}
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="card custom-card" style="min-height:260px;">
                <div class="card-body user-card">
                    <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                        <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                        <h6>Issued NOC</h6>
                    </div>
                    <a href="{{ route('citizen.issuedNoc') }}" class="btn ripple btn-primary mt-3 w-100">Issued NOC</a>
                </div>
            </div>
        </div>

    @else
        {{-- Status not approved: pending/processed/reverted/incomplete --}}
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
            {{-- Show fresh cards allowing user to start new actions (same pattern as no-application view) --}}
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height:260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                            <h6>Building</h6>
                        </div>
                        <a href="{{ route('noc.apply', ['noc' => 'building', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                        <a id="building-operational" class="btn ripple btn-primary mt-3 openModal w-100">Pre Opertaional</a>
                        <a id="building-renewal" class="btn ripple btn-primary mt-3 openModal w-100">Renewal</a>
                    </div>
                </div>
            </div>

            {{-- Repeat the "fresh" pattern for other noc types (cinema, fire_arms_repair, etc.) --}}
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height:260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                            <h6>Cinema Hall- Multiplex</h6>
                        </div>
                        <a href="{{ route('noc.apply', ['noc' => 'cinema_hall_multiplex', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                        <a id="cinema_hall_multiplex-operational" class="btn ripple btn-primary mt-3 openModal w-100">Pre Opertaional</a>
                        <a id="cinema_hall_multiplex-renewal" class="btn ripple btn-primary mt-3 openModal w-100">Renewal</a>
                    </div>
                </div>
            </div>

            {{-- Fire Arms Repair --}}
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height:260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                            <h6>Fire Arms Repair</h6>
                        </div>
                        <a href="{{ route('noc.apply', ['noc' => 'fire_arms_repair', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                        <a id="fire_arms_repair-operational" class="btn ripple btn-primary mt-3 openModal w-100">Pre Opertaional</a>
                        <a id="fire_arms_repair-renewal_repair" class="btn ripple btn-primary mt-3 openModal w-100">Renewal</a>
                    </div>
                </div>
            </div>

            {{-- Fire Arms Selling --}}
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="card custom-card" style="min-height:260px;">
                    <div class="card-body user-card">
                        <div class="main-img-user avatar avatar-xl" style="width:100%;justify-content:normal;margin-bottom:10px;">
                            <img src="{{ asset('/public/citizen/edit-1.webp') }}" alt="" style="width:60px;height:60px;object-fit:contain">
                            <h6>Fire Arms Selling</h6>
                        </div>
                        <a href="{{ route('noc.apply', ['noc' => 'fire_arms_selling', 'type' => 'established']) }}" class="btn ripple btn-primary mt-3 w-100">Pre Establishment</a>
                        <a id="fire_arms_selling-operational" class="btn ripple btn-primary mt-3 openModal w-100">Pre Opertaional</a>
                        <a id="fire_arms_selling-renewal" class="btn ripple btn-primary mt-3 openModal w-100">Renewal</a>
                    </div>
                </div>
            </div>

            {{-- You can replicate the above "fresh" cards for the other types similarly --}}
        @elseif($application[0]->status == 'incomplete')
            <div class="card custom-card" id="additional-alerts">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="alert alert-warning mb-0" role="alert">
                                <h2 class="alert-heading">Incomplete!</h2>
                                <h4>Your application is incomplete. Please fill all necessary details.</h4>
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
                            <option value="new">New Application</option>
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

<div class="modal fade" id="preEstModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Pre Establishment Applications</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('noc.apply', ['noc' => 'building', 'type' => 'established']) }}">
                @csrf
                <div class="modal-body">
                    <label>Select Application</label>
                    <select class="form-control" name="application_id">
                        <option value="" style="display:none;">-- Select An Option --</option>
                        @foreach($preEstApps as $app)
                            <option value="{{ $app->application_no }}">{{ $app->application_no }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continue</button>

                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="preOpModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Apply for Pre-Operational</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('noc.apply', ['noc' => 'building', 'type' => 'established']) }}">

                @csrf
                <div class="modal-body">
                    @if(count($preOpApps) == 0 && count($renewalApps) == 0)

                        {{-- SHOW MESSAGE LIKE ATTACHMENT --}}
                        <p class="text-center fw-bold">
                            ( NO Pre-Establishment Found )
                        </p>

                        <p class="text-center">
                            Proceed if Pre-Establishment OR Pre-OperationalNOC is obtained from other Account and / or want to apply for

                            fresh Pre-Operational NOC
                        </p>

                        {{-- Hidden default selection for fresh apply --}}
                        <input type="hidden" name="application_no" value="new">

                    @else
                        <label>Select Application</label>
                        <select class="form-control" name="application_id">
                            <option value="" style="display:none;">-- Select An Option --</option>
                            @foreach($preEstApps as $app)
                                <option value="{{ $app->application_no }}">{{ $app->application_no }}</option>
                            @endforeach
                            @foreach($preOpApps as $app)
                                <option value="{{ $app->application_no }}">{{ $app->application_no }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <a href="{{route('noc.apply', ['noc' => 'building', 'type' => 'established'])}}" class="btn ripple btn-primary" >Submit</a>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="renewalModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Apply for Renewal</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('noc.apply', ['noc' => 'building', 'type' => 'established']) }}">

                @csrf

                <div class="modal-body">

                    @if(count($preOpApps) == 0 && count($renewalApps) == 0)

                        {{-- SHOW MESSAGE LIKE ATTACHMENT --}}
                        <p class="text-center fw-bold">
                            ( NO Pre-Operational or Renewal NOC Found )
                        </p>

                        <p class="text-center">
                            Submit if Pre-Operational or Renewal NOC is obtained 
                            from other Account and/or want to apply for fresh 
                            Renewal NOC.
                        </p>

                        {{-- Hidden default selection for fresh apply --}}
                        <input type="hidden" name="application_no" value="new">

                    @else

                        {{-- SHOW DROPDOWN IF DATA AVAILABLE --}}
                        <label>Select Application</label>
                        <select class="form-control" name="application_no">
                            @foreach($preOpApps as $app)
                                <option value="{{ $app->application_no }}">
                                    {{ $app->application_no }}
                                </option>
                            @endforeach

                            @foreach($renewalApps as $app)
                                <option value="{{ $app->application_no }}">
                                    {{ $app->application_no }}
                                </option>
                            @endforeach
                        </select>

                    @endif
                </div>

                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</a>
                    <a href="{{route('noc.apply', ['noc' => 'building', 'type' => 'established'])}}" class="btn ripple btn-primary" >Submit</a>
                </div>

            </form>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="renewalModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Renewal Applications</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="POST" action="{{ route('noc.extension.post') }}">
                @csrf
                <div class="modal-body">
                    <label>Select Application</label>
                    <select class="form-control" name="application_id">
                        <option value="" style="display:none;">-- Select An Option --</option>
                        @foreach($preOpApps as $app)
                            <option value="{{ $app->application_no }}">{{ $app->application_no }}</option>
                        @endforeach
                        @foreach($renewalApps as $app)
                            <option value="{{ $app->application_no }}">{{ $app->application_no }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
    </div>
</div> -->

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
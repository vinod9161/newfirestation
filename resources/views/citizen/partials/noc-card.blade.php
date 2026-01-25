@php
if (!function_exists('safe_get')) {
    function safe_get($obj, $prop) {
        return (is_object($obj) && property_exists($obj, $prop)) ? $obj->$prop : null;
    }
}
@endphp


<div class="col-sm-6 col-md-6 col-xl-3">
    <div class="card custom-card" style="min-height:260px;">
        <div class="card-body user-card">

            <div class="main-img-user avatar avatar-xl" style="width:100%;margin-bottom:10px;">
                <img src="{{ asset('/public/citizen/edit-1.webp') }}" style="width:60px;height:60px;object-fit:contain">
                <h6>{{ $title }}</h6>
            </div>
        
            {{-- PRE ESTABLISHMENT --}}
            @php
                $preEst = ($current && safe_get($current,'application_type') == 'pre establishment noc');
            @endphp

            @if($preEst)
                {{-- If previous app exists → modal --}}
                <button class="btn btn-primary w-100 mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#approvedApplications">
                    Pre Establishment
                </button>
            @else
                {{-- else → Apply page --}}
                <a href="{{ route('noc.apply',['noc'=>$type,'type'=>'established']) }}"
                    class="btn btn-primary w-100 mt-2">Pre Establishment</a>
            @endif


            {{-- PRE OPERATIONAL --}}
            @php
                $opApp = safe_get($current, 'operational_application');
                $preOp = ($opApp && $opApp->application_type == 'pre operational noc');
            @endphp


            @if($preOp)
                <button class="btn btn-primary w-100 mt-2"
                    data-bs-toggle="modal"
                    data-bs-target="#approvedOpApplications">
                    Pre Operational
                </button>
            @else
                <a href="{{ route('citizen.applyOperationalNocDetail', $current->id ?? 0) }}"
                    class="btn btn-primary w-100 mt-2">Pre Operational</a>
            @endif


            {{-- RENEWAL --}}
            @php
                $ren = safe_get($current, 'renewal_application');
                $isRenew = ($ren && $ren->application_type == 'pre renewal noc');
            @endphp


            @if($isRenew)
                <a href="{{ route('citizen.viewRenewalNocDetail',$ren->id) }}"
                    class="btn btn-primary w-100 mt-2">Renewal</a>
            @else
                <a href="{{ route('citizen.applyRenewalNocDetail',$current->id ?? 0) }}"
                    class="btn btn-primary w-100 mt-2">Renewal</a>
            @endif

        </div>
    </div>
</div>

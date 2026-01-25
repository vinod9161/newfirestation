<div class="col-sm-6 col-md-6 col-xl-3 mb-3">
    <div class="card custom-card" style="min-height:260px;">
        <div class="card-body user-card text-center">

            {{-- ICON --}}
            <div class="main-img-user avatar avatar-xl mb-2">
                <img src="{{ asset($noc->image ?? 'public/citizen/edit-1.webp') }}"
                     alt="{{ $noc->name }}"
                     style="width:60px;height:60px;object-fit:contain;">
            </div>

            <h6>{{ $noc->name }}</h6>

            @if($preEstApps->where('status','approved')->count() > 0)
                
                <button class="btn btn-primary w-100 mt-3 openEstPopup"
                        data-noc="{{ $noc->entity }}" data-type="established">
                    Pre Establishment
                </button>
            @else

                <a href="{{ route('noc.apply', ['noc' => $noc->entity, 'type' => 'established']) }}"
                   class="btn btn-primary w-100 mt-3">
                    Pre Establishment
                </a>

            @endif

            <button class="btn btn-primary w-100 mt-3 openPreOpUnified" data-noc="{{ $noc->entity }}" data-type="pre operational">
                Pre Operational
            </button>
            <button class="btn btn-primary w-100 mt-3 openRenewalUnified" data-noc="{{ $noc->entity }}" data-type="renewal noc">
                Renewal
            </button>
        </div>
    </div>
</div>

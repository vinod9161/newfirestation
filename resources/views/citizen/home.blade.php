@extends('layouts.citizen.template')

@section('content')

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default fs-24 mb-0">NOC</h5>
    </div>
</div>

@if($inProcess->count() > 0)
    <div class="card custom-card" id="additional-alerts">
        <div class="card-body">
            <div class="text-wrap">
                <div class="example">
                    <div class="alert alert-info mb-0" role="alert">
                        <h2 class="alert-heading">Pending!</h2>
                        <h4>“Sorry, Try after closure of your one of the application is Process / Under Investigation”</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="row">
    @if($inProcess->count() == 0 && ($apps->count() == 0 || $approved->count() == 0))
        @foreach($nocTypes as $noc)
            @include('citizen.cards.item', ['noc' => $noc])
        @endforeach
    @endif

    @if($approved->count() > 0 && $inProcess->count() == 0)
        @php 
            $mainType = $approved->first()->noc_type;
            $selectedCard = $nocTypes->firstWhere('entity', $mainType);
        @endphp

        @if($selectedCard)
            @include('citizen.cards.item', ['noc' => $selectedCard])
        @endif
    @endif

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

<div class="modal fade" id="modalEst">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Extension & Diversity</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="GET" action="{{ route('noc.apply') }}">
                <!-- @csrf -->

                <input type="hidden" name="noc" id="noc_category" class="noc_category">
                <input type="hidden" name="type" id="noc_type" class="noc_type">
                <input type="hidden" name="noc_step" value="pre_est">

                <div class="modal-body">
                    <label>Select Approved Pre-Establishment NOC</label>
                    <select name="application_id" class="form-control">
                        <option value="">-- Select --</option>

                        @foreach($preEstApps as $app)
                            @if($app->status == 'approved')
                                <option value="{{ $app->application_no }}">
                                    {{ $app->application_no }}
                                </option>
                            @endif
                        @endforeach

                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="extension">Submit</button>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPreOpUnified">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Apply for Pre-Operational</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="GET" action="{{ route('noc.apply') }}">
                <input type="hidden" name="noc" class="noc_category">
                <input type="hidden" name="type"  class="noc_type">
                <input type="hidden" name="noc_step" value="pre_op">
                <div class="modal-body">
                    @if($preEstApps->where('status','approved')->count() > 0)
                        <label>Select Approved Pre-Establishment NOC</label>
                        <select name="application_id" class="form-control">
                            <option value="">-- Select --</option>
                            @foreach($preEstApps as $app)
                                @if($app->status == 'approved')
                                    <option value="{{ $app->application_no }}">
                                        {{ $app->application_no }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <div class="text-center">
                            <strong>( NO Pre-Establishment Found )</strong>
                            <p class="mt-2">
                                Proceed if Pre-Establishment OR Pre-Operational NOC is obtained 
                                from another account or apply fresh.
                            </p>
                        </div>
                        <!-- <input type="hidden" name="application_no" value="new"> -->
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if($preOpApps->where('status','approved')->count() > 0)
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @else
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <!-- <a id="preop_fresh_link" href="#" class="btn btn-primary">Submit</a> -->
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ================= SINGLE POPUP: Renewal ================= --}}
<div class="modal fade" id="modalRenewalUnified">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Apply for Renewal</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form method="GET" action="{{ route('noc.apply') }}">

                <input type="hidden" name="noc" class="noc_category">
                <input type="hidden" name="type"  class="noc_type">
                <input type="hidden" name="noc_step" value="renewal">
                <div class="modal-body">

                    @if(
                        $preOpApps->where('status', 'approved')->count() > 0 ||
                        $renewalApps->where('status', 'approved')->count() > 0
                    )

                        <label>Select Approved NOC</label>
                        <select name="application_id" class="form-control">
                            <option value="">-- Select --</option>

                            @foreach($preOpApps as $app)
                                @if($app->status == 'approved')
                                    <option value="{{ $app->application_no }}">
                                        {{ $app->application_no }}
                                    </option>
                                @endif
                            @endforeach
                            @foreach($renewalApps as $app)
                                @if($app->status == 'approved')
                                    <option value="{{ $app->application_no }}">
                                        {{ $app->application_no }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <div class="text-center">
                            <strong>( NO Pre-Operational or Renewal NOC Found )</strong>
                            <p class="mt-2">
                                Submit if Pre-Operational or Renewal NOC is obtained 
                                from another account and/or want to apply for fresh Renewal NOC.
                            </p>
                        </div>
                        <!-- <input type="hidden" name="application_no" value="new"> -->
                    @endif

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @if(
                        $preOpApps->where('status','approved')->count() > 0 ||
                        $renewalApps->where('status','approved')->count() > 0
                    )
                        <button type="submit" class="btn btn-primary">Submit</button>
                    @else
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <!-- <a id="renewal_fresh_link" href="#" class="btn btn-primary">Submit</a> -->
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>

    $(document).on("click", ".openEstPopup", function () {
        $(".noc_category").val($(this).data("noc"));
        $(".noc_type").val($(this).data("type"));
        $("#modalEst").modal("show");
    });

    $(document).on("click", ".openPreOpUnified", function () {

        $(".noc_category").val($(this).data("noc"));
        $(".noc_type").val($(this).data("type"));

        $("#modalPreOpUnified").modal("show");
    });

    $(document).on("click", ".openRenewalUnified", function () {
        $(".noc_category").val($(this).data("noc"));
        $(".noc_type").val($(this).data("type"));
        $("#modalRenewalUnified").modal("show");
    });

</script>

@stop

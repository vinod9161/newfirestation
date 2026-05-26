@extends('layouts.fire_new')

@section('content')

<style>

.icon-box {
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    height: 100%;
    display: flex;
    flex-direction: column;
    border-top: 5px solid #006270;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.icon-box img {
    border-radius: 8px;
    height: 180px;
    object-fit: cover;
}

.mission-content {
    margin-top: 15px;
    flex-grow: 1;
}

.read-more-btn {
    color: #00258e;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
    display: inline-block;
}

</style>

<section class="breadcrumb-section">

    <div class="overlay"></div>

    <div class="breadcrumb-content">

        <h1 class="breadcrumb-item">
            Mission & Vision
        </h1>

        <nav aria-label="breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="{{ route('actionIndex') }}">

                        Home
                        <i class="fa fa-angle-double-right"></i>

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="#">

                        About Us
                        <i class="fa fa-angle-double-right"></i>

                    </a>

                </li>

                <li class="breadcrumb-item active">
                    Mission & Vision
                </li>

            </ol>

        </nav>

    </div>

</section>

<section class="flagday-section py-5">

    <div class="department-details">

        <div class="container">

            <div class="row content-card content-text">

                <div class="col-md-12 pb-40">

                    <div class="row">

                        <div class="col-lg-12 text-center mb-3">

                            <h3>
                                The Mission of the Department
                            </h3>

                        </div>

                        @foreach($missionCards as $card)

                        <div class="col-6 col-md-4 col-lg-3 mb-4">

                            <div class="icon-box">

                                @if($card->image)

                                <img
                                    src="{{ asset('public/admin/about/mission_vision/'.$card->image) }}"
                                    style="width:100%;"
                                >

                                @endif

                                <p class="mission-content">

                                    {!! strip_tags($card->content) !!}

                                </p>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                @if($visionSection)

                <div class="col-md-12">

                    <div class="deprt-txt">

                        <div class="row">

                            <div class="col-md-6">

                                <h3>

                                    {{ $visionSection->hadding ?: 'The Vision of the Department' }}

                                </h3>

                                {!! $visionSection->content !!}

                            </div>

                            <div class="col-md-6">

                                @if($visionSection->image)

                                <img
                                    src="{{ asset('public/admin/about/mission_vision/'.$visionSection->image) }}"
                                    class="rounded"
                                    width="100%"
                                    style="border:1px solid #e2e2e2;"
                                >

                                @endif

                            </div>

                        </div>

                    </div>

                </div>

                @endif

            </div>

        </div>

    </div>

</section>

<script>

$(document).ready(function(){

    $(".mission-content").each(function(){

        var fullText = $(this).text().trim();

        if(fullText.length > 200){

            var shortText = fullText.substring(0, 200);

            $(this).html(

                shortText +

                '<span class="dots">...</span>' +

                '<span class="more-text d-none">' +

                fullText.substring(200) +

                '</span>' +

                '<br><span class="read-more-btn">Show More</span>'
            );
        }

    });

    $(document).on("click", ".read-more-btn", function(){

        var parent = $(this).parent();

        parent.find(".more-text").toggleClass("d-none");

        parent.find(".dots").toggle();

        if($(this).text() == "Show More"){

            $(this).text("Show Less");

        } else {

            $(this).text("Show More");
        }

    });

});

</script>

@endsection

@section('scripts')
@stop
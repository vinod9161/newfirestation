@extends('layouts.fire_new')
@section('content')
<style>
	.icon-box {
		border-top: 5px solid #006270;
	}
</style>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Message</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div style="text-align: left;">This will lead you to हिंदी Language</div>
			</div>
			<div class="modal-footer">
				<form class="mb-0" id="frmChLag" name="frmChLag" action="https://fireservice.bihar.gov.in/setCookies" method="POST">
					<input type="hidden" name="_token" value="rw1FQQ7ZUzKmyEdLmwQ20PajjlFYaO6HG5jir8N4" autocomplete="off">                            <input type="hidden" name="language" value="hi">
					<button type="submit" class="form-control btn btn-primary " data-bs-dismiss="modal">Confirm</button>
				</form>

			</div>

		</div>
	</div>
</div>

<!--Sub Header Start-->
<section class="breadcrumb-section">
	<div class="overlay"></div>
	<div class="breadcrumb-content">
		<h1 class="breadcrumb-item">Mission & Vision</h1>
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
				<li class="breadcrumb-item"><a href="#">About Us <i class="fa fa-angle-double-right"></i></a> </li>
				<li class="breadcrumb-item active" aria-current="page">Mission & Vision</li>
			</ol>
		</nav>
	</div>
</section>
<!--Sub Header End-->
<style>
.icon-box {
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    height: 100%;                 /* equal height */
    display: flex;
    flex-direction: column;
}

.icon-box img {
    border-radius: 8px;
}

.mission-content {
    margin-top: 15px;
    flex-grow: 1;                 /* push button bottom */
}

.read-more-btn {
    color: #00258e;
    font-weight: 600;
    cursor: pointer;
    margin-top: 10px;
    display: inline-block;
}
</style>
<!--Main Content Start-->
	<section class="flagday-section py-5">
		<!--Department Details Page Start-->
		<div class="department-details">
			<div class="container">
				<div class="row content-card content-text">
					<div class="col-md-12 pb-40">
						<div class="row">
							<div class="col-lg-12 text-center mb-3"><h3>The Mission of the Department</h3></div>
							<div class="col-6 col-md-4 col-lg-3">
								<a href="javascript:void(0);" target="_blank">
									<div class="icon-box">
										<img src="{{ asset('public/new_assets/img/content/event1.jpg') }}" style="width: 100%">
										<p class="mission-content">Develop well organized and trained Fire & Rescue Services so that human resources of the department measure up to multiple challenges of a Fire & Rescue Service</p>
									</div>
								</a>
							</div>
							<div class="col-6 col-md-4 col-lg-3">
								<a href="javascript:void(0);" target="_blank">
									<div class="icon-box">
										<img src="{{ asset('public/new_assets/img/content/event2.jpg') }}" style="width: 100%">
										<p class="mission-content">To carry out effective and timely fire fighting, rescue and life saving operations and Disaster Management activities and thereby ensure maximum performance and render remarkable service to the public.</p>
									</div>
								</a>
							</div>
							<div class="col-6 col-md-4 col-lg-3">
								<a href="javascript:void(0);" target="_blank">
									<div class="icon-box">
										<img src="{{ asset('public/new_assets/img/content/event3.jpg') }}" style="width: 100%">
										<p class="mission-content">To protect our community from all possible hazards by providing progressive high quality emergency services and preventive measures.</p>
									</div>
								</a>
							</div>
							<div class="col-6 col-md-4 col-lg-3">
								<a href="javascript:void(0);" target="_blank">
									<div class="icon-box">
										<img src="{{ asset('public/new_assets/img/content/event4.jpg') }}" style="width: 100%">
										<p class="mission-content">Develop well organized and trained Fire & Rescue Services so that human resources of the department measure up to multiple challenges of a Fire & Rescue Service</p>
									</div>
								</a>
							</div>

						</div>
					</div>

				<!-- </div>

				<div class="row content-card content-text"> -->
					<div class="col-md-12">
						<!--Department Details Txt Start-->
						<div class="deprt-txt">
							<div class="row">
								<div class="col-md-6">
									<h3>The Vision of the Department</h3>
									<ul>
										<li>Dedicated and best community focused Fire & Rescue Services ensuring a safe and secure environment for all.</li>
										<li>To honor the trust of the society by demonstrating commitment to deliver professional Fire Fighting & Rescue Services activities with compassion, respect and utmost courtesy.</li>
										<li>To ensure community safety by creating basic awareness regarding fire safety, life safety and Disaster Management among the people and thereby mitigate the fire loss and improve effective and timely rescue and life saving activities.</li>
										<li>Minimize the response time in urban and rural areas by increasing the number of Fire & Rescue Stations and mobility profile of the Department.</li>
									</ul>
								</div>

								<div class="col-md-6">
									<img src="{{ asset('public/new_assets/img/content/event4.jpg') }}" class="rounded" alt="" width="100%" style="border: 1px solid #e2e2e2;">
								</div>
							</div>


						</div>
					</div>
					<!--Sidebar Start-->
				</div>
			</div>
		</div>
		<!--Department Details Page End-->
	</section>
<!--Main Content End-->
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

    // Toggle Show More / Less
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
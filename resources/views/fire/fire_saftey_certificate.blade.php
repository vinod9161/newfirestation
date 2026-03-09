@extends('layouts.fire_new')
@section('content')

<!--Sub Header Start-->
<section class="breadcrumb-section">
  <div class="overlay"></div>
  <div class="breadcrumb-content">
    <h1 class="breadcrumb-item">Fire Safety Certificate/NOC</h1>
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('actionIndex') }}">Home <i class="fa fa-angle-double-right"></i></a></li>
        <li class="breadcrumb-item active" aria-current="page">Fire Safety Certificate/NOC</li>
      </ol>
    </nav>
  </div>
</section>
<!--Sub Header End-->
<style>
    body {
        background: #f4f6f9;
    }

    .status-card {
        border-radius: 15px;
        border: none;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    }
    .card:hover{
        transform: translateY(-10px) !important;
    }

    .status-card .card-body {
        padding: 25px;
    }

    .left-border {
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        border-radius: 15px 0 0 15px;
    }

    .count-badge {
        font-size: 20px;
        padding: 6px 14px;
        border-radius: 8px;
        font-weight: 600;
        color: #fff;
    }

    .status-title {
        font-size: 14px;
        color: #6c757d;
    }

    .status-text {
        font-size: 20px;
        font-weight: 600;
    }

    .icon-style {
        font-size: 30px;
    }
</style>


<style>
        .hidden-content {
            display: none;
        }

        .read-btn {
            color: #fff; background-color: #00258e; border-color: #00258e;
        }

        .read-btn:hover {
            background: #e65c00;
        }
    </style>

   <!-- ======= About Section ======= -->
    <section class="services flagday-section py-5">
        <div class="container">
            <div class="row content-card content-text">
              <div class="col-md-12">
                <h3 class="text-center">Fire Safety Certificate/NOC </h3>
                <div class="why-us section-bg">

                    <!-- Always Visible Paragraphs -->
                    <p>
                        A Fire Safety No Objection Certificate (NOC) is issued by the Fire Department after a detailed verification and audit of a building’s fire resistance and fire safety systems. The inspection ensures that all fire prevention, detection, and firefighting arrangements comply with the applicable fire safety standards and guidelines prescribed by the Bureau of Indian Standards (BIS), National Building Code (NBC – Part 4), and the concerned State Government’s guidelines.
                    </p>
                
                    <p>
                        Upon completion of the inspection, if the Fire Department is satisfied that the installed fire safety measures meet the prescribed standards, a Fire Safety NOC is issued to the applicant for the concerned building or premises.
                    </p>
                
                
                </div>
              </div>
                

                  <!-- RECEIVED -->
                  <div class="col-md-3 mb-4">
                      <div class="card status-card">
                          <div class="left-border bg-success"></div>
                          <div class="card-body">
                              <!-- <div class="d-flex justify-content-between align-items-center">
                                  <i class="fas fa-inbox icon-style text-success"></i>
                                  <span class="count-badge bg-success">102</span>
                              </div> -->
                              <!-- <p class="status-title mt-3 mb-1">Apply For NOC</p> -->
                              <div class="status-text text-dark"><a href="{{ route('login')}}">Apply For NOC</a></div>
                          </div>
                      </div>
                  </div>

                  <!-- APPROVED -->
                  <div class="col-md-3 mb-4">
                      <div class="card status-card">
                          <div class="left-border bg-primary"></div>
                          <div class="card-body">
                              <!-- <div class="d-flex justify-content-between align-items-center">
                                  <i class="fas fa-check-square icon-style text-primary"></i>
                                  <span class="count-badge bg-primary">32</span>
                              </div> -->
                              <!-- <p class="status-title mt-3 mb-1">Apply For NOC</p> -->
                              <div class="status-text text-dark"><a href="{{ route('applicationtrackstatus')}}">Track Your NOC</a></div>
                          </div>
                      </div>
                  </div>

                  <!-- REVERTED -->
                  <div class="col-md-3 mb-4">
                      <div class="card status-card">
                          <div class="left-border" style="background:#6f42c1;"></div>
                          <div class="card-body">
                              <!-- <div class="d-flex justify-content-between align-items-center">
                                  <i class="fas fa-undo icon-style" style="color:#6f42c1;"></i>
                                  <span class="count-badge" style="background:#6f42c1;">12</span>
                              </div> -->
                              <!-- <p class="status-title mt-3 mb-1">Number of Application</p> -->
                              <div class="status-text text-dark"><a href="{{ route('applicationverificationtrackstatus')}}">Verify your NOC </a></div>
                          </div>
                      </div>
                  </div>

                  <!-- IN PROCESS -->
                  <div class="col-md-3 mb-4">
                      <div class="card status-card">
                          <div class="left-border bg-warning"></div>
                          <div class="card-body">
                              <!-- <div class="d-flex justify-content-between align-items-center">
                                  <i class="fas fa-hourglass-half icon-style text-warning"></i>
                                  <span class="count-badge bg-warning">33</span>
                              </div> -->
                              <!-- <p class="status-title mt-3 mb-1">Number of Application</p> -->
                              <!-- <div class="status-text text-dark">Required Documents for Fire NOC</div> -->
                              <div class="status-text text-dark"><a href="{{ route('nocdocrequiredata')}}">Documents</a></div>
                          </div>
                      </div>
                  </div>
                  
                  <div class="col-md-12">
                        <div class="why-us section-bg">
                            <!-- Hidden Paragraphs -->
                            <div id="moreContent" class="hidden-content">
                                <p>
                                    Fire safety, timely preventive measures, and preparedness are critical concerns in today’s built environment. With the increasing number of fire incidents in office buildings, hospitals, coaching centres, commercial establishments, Hospitals, Schools and industrial premises, the Fire Department, under the directions of the Government, is mandated to conduct fire safety audits of buildings falling under the provisions of NBC Part 4.
                                </p>
                        
                                <p>
                                    Therefore, to prevent loss of life and property due to fire incidents, it is imperative for all building owners, occupiers, and users to strictly adhere to fire safety provisions and procedures, not only in documentation but also in practical implementation. Obtaining a Fire Safety NOC ensures regulatory compliance and significantly enhances overall safety and emergency preparedness.
                                </p>
                            </div>
                        
                            <button class="btn btn-primary btn-sm pull-right" onclick="toggleContent()" id="toggleBtn" style="color: #fff; background-color: #00258e; border-color: #00258e;margin-bottom: 20px; font-weight: bold; font-size: 18px;">
                                Importance of Obtaining a Fire Safety NOC
                            </button>
                        
                        </div>
                      </div>


              </div>
          </div>

    </section>


    <!-- <div class="container">
        <div class="row">
            <div class="col-md-2">
            </div>

            <div class="col-md-4">
                <a href="#" class="btn btnc">Required document for fire NOC</a>
            </div>

            <div class="col-md-4">
                <a href="=#" class="btn btnc">How to apply for fire NOC</a>
            </div>

            <div class="col-md-2">
            </div>
        </div>
    </div> -->

    <!-- <div class="container">
        <div class="row">
            <div class="col-md-12 why-us section-bg aos-init aos-animate" style="padding: 30px; margin: 20px 0px 30px 0px;">
              <h3 class="text-center"><strong>Why it is so important to take fire NOC</strong></h3>
              <p> Fire safety, timely safety measures, and precautions are few of the important factors which are concerning everyone these days. As with the growing incidents of break of fire in office buildings, hospitals, coaching centers, commercial buildings, industries,  the Fire Department is under the direction of government to make the necessary audit of all buildings falling under the category of NBC Part 4 and taking legal action an can stop/seal it from further use till the compliance is done as per recommendations. Hence, In order to avoid any undesirable happenings or danger to life due to sudden break of fire, it is need of the hour for all users to strictly comply with provisions and procedures of fire safety measures not only in papers but practically too. </p>

              <div class="row">
              <div class="col-md-3">
              </div>
      
              <div class="col-md-6">
                <a href="loginform.html" class="btn btnc">Apply For Fire NOC</a>
              </div>
      
              <div class="col-md-3">
              </div>

              </div>
            </div>
        </div>


    </div> -->
    
    <script>
    function toggleContent() {
        var moreContent = document.getElementById("moreContent");
        var btn = document.getElementById("toggleBtn");

        if (moreContent.style.display === "none" || moreContent.style.display === "") {
            moreContent.style.display = "block";
            btn.innerText = "Show Less";
        } else {
            moreContent.style.display = "none";
            btn.innerText = "Importance of Obtaining a Fire Safety NOC";
        }
    }
</script>
    

@endsection
@section('scripts')
@stop

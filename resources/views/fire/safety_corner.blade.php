@extends('layouts.fire_new')
@section('content')

<!-- ======= Breadcrumbs Section ======= -->
<div class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Safety Corner</h2>
      <ol style="padding-top: 45px;">
        <li><a href="{{ route('actionIndex') }}">Home</a></li>
        <li>Safety Corner</li>
      </ol>
    </div>
  </div>
</div><!-- End Breadcrumbs Section -->

<!-- ======= Services Section ======= -->
<section class="services">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <p class="why-us section-bg aos-init aos-animate active" style="padding: 30px;">Mass Awareness On Fire Safety</p>
        <ul>
          <li><a href="#english" class="scroll-link">Mass Awareness (English)</a></li>
          <li><a href="#hindi" class="scroll-link">Mass Awareness (Hindi)</a></li>
        </ul>
      </div>

      <div class="col-md-8">
        <!-- English PDFs -->
        <div id="english" class="views-field views-field-php">
          <h4>Mass Awareness - English</h4>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://example.com/english-fire-safety-1.pdf" target="_blank">Fire Safety in Factories</a>
            <p><strong>Size: 3.2 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://example.com/english-fire-safety-2.pdf" target="_blank">Fire Safety Tips at Home</a>
            <p><strong>Size: 2.8 MB</strong></p>
          </div>
        </div>

        <!-- Hindi PDFs -->
        <div id="hindi" class="views-field views-field-php">
          <h4>Mass Awareness - Hindi</h4>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-13.pdf" target="_blank">कारखानों मे आग से बचाव</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-14.pdf" target="_blank">विकलांगों के अग्नि सुरक्षा के उपाय</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-15.pdf" target="_blank">घर में सुरक्षा</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-16.pdf" target="_blank">बिजली से लगने वाली आग से सुरक्षा</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-17.pdf" target="_blank">अग्निशामक का उपयोग कैसे करें</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-18.pdf" target="_blank">आग से बचाव के निर्देश</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-19.pdf" target="_blank">पटाखे चलाने में सावधानियाँ</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
          <div class="file">
            <i class="fas fa-file-pdf text-danger me-2"></i>
            <a href="https://dgfscdhg.gov.in/sites/default/files/Pages from Books_Brochers_2_2_2_2-21.pdf" target="_blank">विकास योजना बनाएं</a>
            <p><strong>Size: 4.97 MB</strong></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('scripts')
<!-- Font Awesome 6 Free CDN -->
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<!-- Smooth Scroll JavaScript -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.scroll-link').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
          window.scrollTo({
            top: targetElement.offsetTop - 80, // Adjust offset for fixed headers if needed
            behavior: 'smooth'
          });
        }
      });
    });
  });
</script>
@stop
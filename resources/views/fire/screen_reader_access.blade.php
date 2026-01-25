@extends('layouts.fire_new')
@section('content')

    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Screen Reader Access</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Screen Reader Access</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- End About Us Section -->


    <section class="services">
        <div class="container">
  
          <div class="row">
              <div class="col-md-12">
                  <h2 class="heading">SCREEN READER ACCESS</h2>
                  <p>The website complies with World Wide Web Consortium (W3C) Web Content Accessibility Guidelines (WCAG) 2.0 level AA. This will enable people with visual impairments access the website using assistive technologies, such as screen readers. The information of the website is accessible with different screen readers, such as JAWS, NVDA, SAFA, Supernova and Window-Eyes.</p>
              </div>

  
            
  
          </div>
  
        </div>
      </section><!-- End Services Section -->
  
      <!-- ======= Why Us Section ======= -->
      <section class="why-us section-bg" data-aos="fade-up" date-aos-delay="200">
        <div class="container">
            <table class="head table">

                <thead>
                <tr>
                    <td tabindex="0">Screen Reader </td>
                    <td tabindex="0">Website </td>
                    <td tabindex="0">Free / Commercial </td>
                </tr>
            </thead>
            <tbody> 
            <tr>
            <td tabindex="0">Screen Access For All (SAFA)</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.nabdelhi.org/NAB_SAFA.htm" target="blank" onclick="openChild(this.href,'win'); return false;">http://www.nabdelhi.org/NAB_SAFA.htm</a><span class="ext"> (External website that opens in a new window)</span></td>
            <td tabindex="0">Free</td>
            </tr>
            <tr>
            <td tabindex="0">Non Visual Desktop Access (NVDA)</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.nvda-project.org/" target="blank" onclick="openChild(this.href,'win'); return false;">http://www.nvda-project.org/</a><span class="ext"> (External website that opens in a new window)</span></td>
            
            <td tabindex="0">Free</td>
            </tr>
            <tr>
            <td tabindex="0">System Access To Go</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.satogo.com/" target="blank" onclick="openChild(this.href,'win'); return false;">http://www.satogo.com/</a><span class="ext"> (External website that opens in a new window)</span></td>
            <td tabindex="0">Free</td>
            </tr>
            <tr>
            <td tabindex="0">Thunder</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.screenreader.net/index.php?pageid=2" target="blank" onclick="openChild(this.href,'win'); return false;">http://www.screenreader.net/index.php? pageid=2</a><span class="ext"> (External website that opens in a new window)</span></td>
            
            <td tabindex="0">Free</td>
            </tr>
            <tr>
            <td tabindex="0">WebAnywhere</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://webanywhere.cs.washington.edu/wa.php" target="blank" onclick="openChild(this.href,'win'); return false;">http://webanywhere.cs.washington.edu/ wa.php</a><span class="ext"> (External website that opens in a new window)</span></td>
            <td tabindex="0">Free</td>
            </tr>
            <tr>
            <td tabindex="0">Hal</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.yourdolphin.co.uk/productdetail.asp?id=5" target="blank" onclick="openChild(this.href,'win'); return false;">http://www.yourdolphin.co.uk/ productdetail.asp?id=5</a><span class="ext"> (External website that opens in a new window)</span></td>
            
            <td tabindex="0">Commercial</td>
            </tr>
            <tr>
            <td tabindex="0">JAWS</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.freedomscientific.com/jaws-hq.asp" target="blank" onclick="openChild(this.href,'win'); return false;">http://www.freedomscientific.com/jaws- hq.asp</a><span class="ext"> (External website that opens in a new window)</span></td>
            <td tabindex="0">Commercial</td>
            </tr>
            <tr>
            <td tabindex="0">Supernova</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.yourdolphin.co.uk/productdetail.asp?id=1" target="blank" onclick="openChild(this.href,'win'); return false;">http://www.yourdolphin.co.uk / productdetail.asp ?id=1</a><span class="ext"> (External website that opens in a new window)</span></td>
            
            <td tabindex="0">Commercial</td>
            </tr>
            <tr>
            <td tabindex="0">Window-Eyes</td>
            <td tabindex="0"><a title="External website that opens in a new window" href="http://www.gwmicro.com/Window-Eyes/" target="blank"  onclick="openChild(this.href,'win'); return false;">http://www.gwmicro.com/Window-Eyes/</a><span class="ext"> (External website that opens in a new window)</span></td>
            <td tabindex="0">Commercial</td>
            </tr>
            </tbody>
            </table>
  
        </div>
      </section><!-- End Why Us Section -->
@endsection
@section('scripts')
@stop

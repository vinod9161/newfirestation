@extends('layouts.fire_new')
@section('content')
    <!-- ======= About Us Section ======= -->
    <div class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Governer Message</h2>
          <ol style="padding-top: 45px;">
            <li><a href="{{ route('actionIndex')}}">Home</a></li>
            <li >Governer Message</li>
          </ol>
        </div>

      </div>
    </div>
    <!-- End About Us Section -->


<div class="container">
    <div class="row message">
        <div class="col-md-2">
        </div>
        <div class="col-md-8 text-center">
            <img src="{{asset('/public/fire/gallery/governor1.png')}}" class="img-fluid img-responsive">
        </div>
        <div class="col-md-2">
        </div>

        <div class="col-md-12 message dg-message">
            <p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I am glad to know that Uttarakhand Fire and Emergency service a unique part of Police Department is launching its own website for benefit of state govt. and public. 
                <br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; It is appreciable that department has implemented online services for public. Common people can access the information about fire and life safety through this website. Through this website I want to appeal to the people of Uttarakhand that the fire hazards are no longer confined to big cities and manufacturing centers only, but it is need of hour to extend its approach up to rural and remote areas. The people must implement fire safety regulations in their premises, buildings or work area. The fire service need to be organizing properly with adequate infrastructure, advance training, modern equipment for keeping pace with advancement of technology and economic growth. If the objective of ensuring safety of life and property in urban and rural areas is to be achieved, then a complete over-hauling of fire service organization is called for.  </p>
               <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;I convey my good wishes for the initiative of Uttarakhand Fire and Emergency service. </p>
                
        </div>
    </div>
</div>
@endsection
@section('scripts')
@stop
@extends('layouts.admin.template')
@section('title')
<title>Departments | Admin Dashboard</title>
@endsection
@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
@endsection
@section('content')

<style>
	#map {
        height: 400px;
      }

      #pac-input {
        position: absolute;
        top: 10px;
        left: 61%;
        transform: translateX(-50%);
        width: 300px;
        z-index: 5;
        padding: 8px;
        font-size: 14px;
		border: 1px solid #777777;
      }

</style>

<div class="d-md-flex d-block align-items-center justify-content-between my-4">
    <div>
        <h5 class="main-content-title text-default  fs-24  mg-b-4 mb-0">Manage Departments / Stations</h5>
    </div>
    <div class="d-flex app-header-btn">
        
        <div>
            <a href="<?php echo route('admin.stations');?>" class="btn ripple btn-wave  btn-success mb-0">
                <i class="fe fe-eye me-1"></i> View Station List
            </a>
        </div>
    </div>
</div>




<!-- Start::row-2 -->

<div class="row">
    <div class="col-xl-12">
        <div class="card custom-card">
            <div class="card-header">
                <div class="card-title">
                    Add Fire Station
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive---">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                    @endif

                    <div class="col-md-12">
                        <div class="col-md-12" style="margin:0 auto;">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('admin.storestations') }}" method="post">
                                        @csrf
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>District जनपद <sup class="text-danger">*</sup></label>
                                                    <select name="district_id" id="district_id" class="form-control js-example-basic-single">
                                                        <option value="">--- Select District जनपद ---</option>
                                                        @foreach($districts as $district)
                                                            <option value="{{ $district->id }}">{{ $district->name }}</option> <!-- Adjust property names based on your model -->
                                                        @endforeach
                                                    </select>
                                                    <span class="text-danger" id="districtsError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Name of Fire Station <sup class="text-danger">*</sup></label>
                                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Fire Station Name">
                                                    <span class="text-danger" id="stationError"></span>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Address <sup class="text-danger">*</sup></label>
                                                    <input type="test" name="address" id="address" class="form-control" placeholder="Enter Address">
                                                    <span class="text-danger" id="addressError"></span>
                                                </div>
                                            </div>
											
											<div class="col-md-12">
                                                <div class="form-group">
                                                    <input id="pac-input" type="text" placeholder="Search Location..." />
													<div id="map"></div>
													<input type="hidden" name="PolygonCoordinates" id="polygon-coordinates">
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-12">
                                                <button type="submit" id="addStation" class="btn btn-primary btn-sm" style="width:20%">Submit</button>
                                            </div>
                                        </div>
                                    </form>    
                                </div>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
</div>
<!--End::row-1 -->
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/public/admin/js/select2.js') }}"></script>


<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBfkkKGSZZ4Y7wiFpo09j77-hLjq3AzPVY&libraries=places,drawing&callback=initMap" async defer></script>

    <script>
      let map;
      let drawingManager;
      let selectedPolygon = null;

      function initMap() {
        const defaultLocation = { lat: 30.3165, lng: 78.0322 };
		
        map = new google.maps.Map(document.getElementById("map"), {
          center: defaultLocation,
          zoom: 13,
        });

        const input = document.getElementById("pac-input");
        const searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);

        map.addListener("bounds_changed", () => {
          searchBox.setBounds(map.getBounds());
        });

        searchBox.addListener("places_changed", () => {
          const places = searchBox.getPlaces();
          if (places.length === 0) return;

          const bounds = new google.maps.LatLngBounds();
          places.forEach((place) => {
            if (!place.geometry || !place.geometry.location) return;
            bounds.extend(place.geometry.location);
          });
          map.fitBounds(bounds);
        });

        // Drawing Manager for Polygon
        drawingManager = new google.maps.drawing.DrawingManager({
          drawingMode: google.maps.drawing.OverlayType.POLYGON,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_LEFT,
            drawingModes: ["polygon"],
          },
          polygonOptions: {
            fillColor: "#FF0000",
            fillOpacity: 0.3,
            strokeWeight: 2,
            clickable: true,
            editable: true,
            draggable: false,
          },
        });

        drawingManager.setMap(map);

        // Handle new polygon
        google.maps.event.addListener(drawingManager, "overlaycomplete", function (event) {
          if (event.type === "polygon") {
            if (selectedPolygon) {
              selectedPolygon.setMap(null);
            }
            selectedPolygon = event.overlay;

            const coords = selectedPolygon.getPath().getArray().map((latLng) => ({
              lat: latLng.lat(),
              lng: latLng.lng(),
            }));

            // Display in input box
            document.getElementById("polygon-coordinates").value = JSON.stringify(coords, null, 2);
          }
        });
      }

      window.initMap = initMap;
    </script>




@stop
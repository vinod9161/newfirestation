@extends('layouts.admin.template')
@section('title')
<title>Temporary Noc | Admin Dashboard</title>
@endsection
@section('style')
@endsection
@section('content')

<style>
    body {
	  margin: 0;
	  padding: 20px;
	  background-color: #f5f7fa;
	  font-family: 'Poppins', sans-serif;
	}

	h2 {
	  text-align: center;
	  margin-bottom: 30px;
	  color: #333;
	}

	.dashboard {
	  display: grid;
	  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
	  gap: 24px;
	}

	a {
	  text-decoration: none;
	}

	.card {
	  background: linear-gradient(to right, #ffffff, #f8f9fc);
	  border-left: 6px solid;
	  border-radius: 16px;
	  padding: 20px;
	  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
	  transition: all 0.3s ease-in-out;
	  color: inherit;
	  display: flex;
	  flex-direction: column;
	  justify-content: space-between;
	}

	.card:hover {
	  transform: translateY(-5px);
	  box-shadow: 0 10px 24px rgba(0, 0, 0, 0.1);
	}

	.card-header1 {
	  display: flex;
	  justify-content: space-between;
	  align-items: center;
	  margin-bottom: 14px;
	}

	.card .icon {
	  font-size: 34px;
	  color: #4e73df;
	}

	.card .number {
	  color: #fff;
	  font-size: 18px;
	  font-weight: bold;
	  padding: 6px 14px;
	  border-radius: 20px;
	  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
	}

	.card h4 {
	  font-size: 14px;
	  color: #777;
	  margin: 0;
	}

	.card .value {
	  font-size: 18px;
	  font-weight: 600;
	  color: #2c3e50;
	}

  </style>
<!--div class="row">
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'pandal')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Pandal</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'public-function')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Public Function</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'entertainment-activity')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Entertainment Activity</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'film-shooting')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Film Shooting</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'games')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Game</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'helipad')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Helipad</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'kerosene')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Kerosene</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'fire-crackers')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Fire Cracker</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'transportation')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Transportaion Of Material</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-6 col-md-6 col-xl-3"> 
        <div class="card custom-card"> 
            <a href="{{route('admin.temporary.noc.list', 'other-services')}}">
                <div class="card-body d-flex justify-content-between align-items-center">  
                    <div class="service-image" style="width: 20%;text-align: center;font-size: 45px;"> 
                        <i class="fe fe-book" style="color:#63ba16;"></i>
                    </div> 
                    <div class="service-info" style="width: 80%;text-align: left;padding-left:10px;"> 
                        <p style="font-size: 15px;font-weight:500;line-height: 1.2;">NOC For Other service</p> 
                    </div>
                </div>
            </a>
        </div>
    </div>
</div-->    

<div class="row">
    <div class="col-md-12">
		<div class="dashboard">
			<a href="{{route('admin.temporary.noc.list', 'pandal')}}">
				<div class="card" style="border-left-color:#f54242;">
					<div class="icon">🏕️</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Pandal</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'public-function')}}">
				<div class="card" style="border-left-color:#fff700;">
					<div class="icon">🧩</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Public Function</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'entertainment-activity')}}">
				<div class="card" style="border-left-color:#0bd61c;">
					<div class="icon">🎭</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Entertainment Activity</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'film-shooting')}}">
				<div class="card" style="border-left-color:#960000;">
					<div class="icon">🎬</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Film Shooting</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'games')}}">
				<div class="card" style="border-left-color:#c300ff;">
					<div class="icon">🎮</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Game</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'helipad')}}">
				<div class="card" style="border-left-color:#ff00a2;">
					<div class="icon">🚁</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Helipad</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'kerosene')}}">
				<div class="card" style="border-left-color:#00ffff;">
					<div class="icon">🛢️</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Kerosene</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'fire-crackers')}}">
				<div class="card" style="border-left-color:#4c00ff;">
					<div class="icon">🎇</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Fire Cracker</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'transportation')}}">
				<div class="card" style="border-left-color:#764082;">
					<div class="icon">🚚</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Transportaion Of Material</div>
				</div>
			</a>
			
			<a href="{{route('admin.temporary.noc.list', 'other-services')}}">
				<div class="card" style="border-left-color:#078ae8;">
					<div class="icon">🛠️</div>
					<h4>Temporary NOC for</h4>
					<div class="value">Other service</div>
				</div>
			</a>
	  </div>
	</div>
</div>



<!--div class="row">
    <div class="col-md-12">
		<div class="dashboard">
		
			<a href="#" class="card" style="border-left-color:#b5abbc;">
				<div class="card-header1">
					<div class="icon">🏢</div>
					<div class="number" style="background-color: #b5abbc;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Building</div>
			</a>
			<a href="#" class="card" style="border-left-color:#58a6f6;">
				<div class="card-header1">
					<div class="icon">🎦</div>
					<div class="number" style="background-color: #58a6f6;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Cinema Hall- Multiplex</div>
			</a>
			
			<a href="#" class="card" style="border-left-color:#8edb6e;">
				<div class="card-header1">
					<div class="icon">🔫</div>
					<div class="number" style="background-color: #8edb6e;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Fire Arms Repair</div>
			</a>

			<a href="#" class="card" style="border-left-color:#fdd560;">
				<div class="card-header1">
					<div class="icon">🔫💰</div>
					<div class="number" style="background-color: #fdd560;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Fire Arms Selling</div>
			</a>
			
			<a href="#" class="card" style="border-left-color:#5a337f;">
				<div class="card-header1">
					<div class="icon">🔫🗄️</div>
					<div class="number" style="background-color: #5a337f;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Fire Arms Storage</div>
			</a>
			
			<a href="#" class="card" style="border-left-color:#be5f76;">
				<div class="card-header1">
					<div class="icon">🏭</div>
					<div class="number" style="background-color: #be5f76;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Gas and Warehouse Agency</div>
			</a>
			
			<a href="#" class="card" style="border-left-color:#3f67bd;">
				<div class="card-header1">
					<div class="icon">🛢️</div>
					<div class="number" style="background-color: #3f67bd;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Gas-Oil-Depot</div>
			</a>
			
			<a href="#" class="card" style="border-left-color:#dd3569;">
				<div class="card-header1">
					<div class="icon">⛽</div>
					<div class="number" style="background-color: #dd3569;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Petrol Pump CNG Station</div>
			</a>
			
			<a href="#" class="card" style="border-left-color:#bdfa87;">
				<div class="card-header1">
					<div class="icon">🧪</div>
					<div class="number" style="background-color: #bdfa87;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Sale of Sulphur Sale Sulphur Category</div>
			</a>
			
			<a href="#" class="card" style="border-left-color:#d29c77;">
				<div class="card-header1">
					<div class="icon">📦</div>
					<div class="number" style="background-color: #d29c77;">25</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Storage - Magazine</div>
			</a>
	  </div>
	</div>
</div-->


<!--End::row-1 -->
@endsection
@section('scripts')
@stop
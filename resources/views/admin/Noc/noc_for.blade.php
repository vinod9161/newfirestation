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
	  font-size: 24px;
	  font-weight: bold;
	  padding: 0px 10px;
	  border-radius: 5px;
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

<div class="row">
    <div class="col-md-12">
		<div class="dashboard">
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'building'])}}" class="card" style="border-left-color:#b5abbc;">
				<div class="card-header1">
					<div class="icon">🏢</div>
					<div class="number" style="background-color: #b5abbc;">{{ $data['countBuilding']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Building</div>
			</a>
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'cinema_hall_multiplex'])}}" class="card" style="border-left-color:#58a6f6;">
				<div class="card-header1">
					<div class="icon">🎦</div>
					<div class="number" style="background-color: #58a6f6;">{{ $data['countCinema']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Cinema Hall- Multiplex</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'fire_arms_repair'])}}" class="card" style="border-left-color:#793b64;">
				<div class="card-header1">
					<div class="icon">🧯🛠️</div>
					<div class="number" style="background-color: #793b64;">{{ $data['countFireRepair']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Fire Arms Repair</div>
			</a>

			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'fire_arms_selling'])}}" class="card" style="border-left-color:#fdd560;">
				<div class="card-header1">
					<div class="icon">🧯💰</div>
					<div class="number" style="background-color: #fdd560;">{{ $data['countFireSelling']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Fire Arms Selling</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'fire_arms_storage'])}}" class="card" style="border-left-color:#5a337f;">
				<div class="card-header1">
					<div class="icon">🧯🗄️</div>
					<div class="number" style="background-color: #5a337f;">{{ $data['countFireStorage']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Fire Arms Storage</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'gas_warehouse'])}}" class="card" style="border-left-color:#be5f76;">
				<div class="card-header1">
					<div class="icon">🏭</div>
					<div class="number" style="background-color: #be5f76;">{{ $data['countGasWarehouse']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Gas and Warehouse Agency</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'gas_oil_depot'])}}" class="card" style="border-left-color:#3f67bd;">
				<div class="card-header1">
					<div class="icon">🛢️</div>
					<div class="number" style="background-color: #3f67bd;">{{ $data['countGasOilDepot']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Gas-Oil-Depot</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'petrol_pump_cng_station'])}}" class="card" style="border-left-color:#dd3569;">
				<div class="card-header1">
					<div class="icon">⛽</div>
					<div class="number" style="background-color: #dd3569;">{{ $data['countPetrol']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Petrol Pump CNG Station</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'sale_of_sulphur'])}}" class="card" style="border-left-color:#60cb01;">
				<div class="card-header1">
					<div class="icon">🧪</div>
					<div class="number" style="background-color: #60cb01;">{{ $data['countSaleSulphur']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Sale of Sulphur</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'storage_magazine'])}}" class="card" style="border-left-color:#d29c77;">
				<div class="card-header1">
					<div class="icon">📦</div>
					<div class="number" style="background-color: #d29c77;">{{ $data['countStorageMagazine']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Storage - Magazine</div>
			</a>
			
			<a href="{{ route('admin.Noc',['status'=> $type, 'type' => 'fire_works'])}}" class="card" style="border-left-color:#8854b6;">
				<div class="card-header1">
					<div class="icon">🎇</div>
					<div class="number" style="background-color: #8854b6;">{{ $data['countFireWorks']}}</div>
				</div>
				<h4>Fire NOC for</h4>
				<div class="value">Fire Works</div>
			</a>
	  </div>
	</div>
</div>


<!--End::row-1 -->
@endsection
@section('scripts')
@stop
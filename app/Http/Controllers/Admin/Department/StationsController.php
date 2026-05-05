<?php

namespace App\Http\Controllers\Admin\Department;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\location\TehsilModel;
use App\Models\location\DistrictModel;
use App\Models\Models\Station;
use Illuminate\Support\Facades\DB;
use App\Models\Common\CommonModel;

class StationsController extends Controller
{
    protected $stationModel;
    public function __construct()
    {
        $this->stationModel = new Station();
    }
    public function index()
    {
		if(Auth::user()->type == 2)
		{
			$stations = Station::with('district.state')->where('district_id', Auth::user()->district_id)->get();
		}
		else if(Auth::user()->type == 3)
		{
			$stations = Station::with('district.state')->where('id', Auth::user()->station_id)->get();
		}
		else if(Auth::user()->type == 1)
		{
			$stations = Station::with('district.state')->get();
		}
		else
		{
			$stations = Station::with('district.state')->get();
		}

        $commonModel = new CommonModel();
        $district_id = Auth::user()->district_id;
        if(Auth::user()->type == 2)
        {
            $getAlldata = $commonModel->getDataByOneCondition('fire_stations', array('district_id' => $district_id));
        }
        else if(Auth::user()->type == 3)
		{
			$getAlldata = $commonModel->getDataByOneCondition('fire_stations', array('district_id' => $district_id));
		}
		else if(Auth::user()->type == 1)
		{
			$getAlldata = $commonModel->getData('fire_stations');
		}
		else
		{
			$getAlldata = $commonModel->getData('fire_stations');
		}
        $stations = [];
        foreach($getAlldata as $key => $row)
        {
            $count_strength = $row->fire_station_officer + $row->fire_station_second_officer + $row->leading_fireman + $row->fire_service_driver + $row->fireman + $row->cook_peon_followers + $row->sweeper;

            $count_avail = $row->fire_station_officer_avail + $row->fire_station_second_officer_avail + $row->leading_fireman_avail + $row->fire_service_driver_avail + $row->fireman_avail + $row->cook_peon_followers_avail + $row->sweeper_avail;
            $districts = $commonModel->getDataByOneCondition('districts', array('id' => $row->district_id));
            $resultArray = [
                'id' => $row->id,
                'name' => $row->name,
                'dname' => $districts[0]->name,
                'land' => $row->land,
                'building' => $row->building,
                'count_strength' => $count_strength,
                'count_avail' => $count_avail,
                'status' => $row->status
            ];
            array_push($stations,$resultArray);
        }
 		$data['stations'] = $stations;
        return view('admin.Department.stations.index',$data);
    }

    public function add()
    {
        $data['districts'] = DistrictModel::with('stations')->take(13)->get();
        return view('admin.Department.stations.add',$data);
    }

    public function store(Request $request)
    {
        
		$validatedData = Validator::make($request->all(), 
            [
			'name' => 'required|max:255|regex:/^[A-Za-z0-9 ]+$/',
			'district_id' => 'required',
			'address' => 'required',
			]);

			if ($validatedData->fails()){
				return redirect()->back()->withErrors($validatedData->errors())->withInput();
			}
			//Station::create($request->all());

            $data = $request->all();

            // Ensure polygon_coordinates is stored as JSON
            if ($request->has('PolygonCoordinates')) {

                $polygonCordinates = json_decode($request->input('PolygonCoordinates'), true);
                $data['polygon_coordinates'] = json_encode($polygonCordinates);
            }

            Station::create($data);
        return redirect()->route('admin.stations')->with('success', 'Stations added successfully!');

    }






	public function editStation($id)
    {
        $station  = Station::where('id', '=', $id)->first();
        return view('admin.Department.stations.edit', [
            'districts' => DistrictModel::take(13)->get(),
        ])->with('station',$station);
    }


	public function updateStation(Request $request)
    {
        $data = $request->except(['_token', '_method', 'PolygonCoordinates']);

        if ($request->filled('PolygonCoordinates')) {
            $data['polygon_coordinates'] = json_encode(
                json_decode($request->PolygonCoordinates, true)
            );
        }

        Station::where('id', $request->id)->update($data);

        return redirect()->route('admin.stations')
            ->with('success', 'Station Updated Successfully!');
    }



    public function destroy($id){
        $record = Station::findOrFail($id);
        $record->delete();
        return redirect()->route('admin.stations')->with('success', 'Stations deleted successfully.');
    }

    public function filter(Request $request)
    {
        $commonModel = new CommonModel();
        $user = Auth::user();

        // Base query (same as index logic)
        if ($user->type == 2 || $user->type == 3) {
            $query = DB::table('fire_stations')
                        ->where('district_id', $user->district_id);
        } else {
            $query = DB::table('fire_stations');
        }

        // Apply filters
        if ($request->filled('filter_name')) {
            $query->where('name', 'like', '%' . $request->filter_name . '%');
        }

        if ($request->filled('district_name')) {
            $districtIds = DB::table('districts')
                            ->where('name', 'like', '%' . $request->district_name . '%')
                            ->pluck('id');

            $query->whereIn('district_id', $districtIds);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $getAlldata = $query->get();

        $stations = [];

        foreach ($getAlldata as $row) {

            $count_strength =
                $row->fire_station_officer +
                $row->fire_station_second_officer +
                $row->leading_fireman +
                $row->fire_service_driver +
                $row->fireman +
                $row->cook_peon_followers +
                $row->sweeper;

            $count_avail =
                $row->fire_station_officer_avail +
                $row->fire_station_second_officer_avail +
                $row->leading_fireman_avail +
                $row->fire_service_driver_avail +
                $row->fireman_avail +
                $row->cook_peon_followers_avail +
                $row->sweeper_avail;

            $district = DB::table('districts')
                            ->where('id', $row->district_id)
                            ->first();

            $stations[] = [
                'id' => $row->id,
                'name' => $row->name,
                'dname' => $district->name ?? '',
                'land' => $row->land,
                'building' => $row->building,
                'count_strength' => $count_strength,
                'count_avail' => $count_avail,
                'status' => $row->status
            ];
        }

        return view('admin.Department.stations.index', ['stations' => $stations]);
    }
}

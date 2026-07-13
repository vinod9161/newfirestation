<?php

namespace App\Http\Controllers\Citizen;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\Common\FilterModel;
use Illuminate\Support\Facades\Validator;
use App\Models\Models\{Application, User, BuildingMap, FireEscapePlan, ChemicalUse, UploadSop, SafetyOfficer, DoAndDonts, Declaration, Issued, Project, District, Category};
use Illuminate\Support\Facades\Auth; 
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class NocController extends Controller
{
    protected $commonModel;
    public function __construct()
    {
        $this->commonModel = new CommonModel;
    }

    public function indexAdminNoc(Request $request)
    {
        $status = $request->status;
        $data = [];
        if($status == 'all')
        {
            if (Auth::user()->type == 0)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building']),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex']),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair']),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling']),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage']),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse']),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot']),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur']),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine']),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station']),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works'])
                ];
            }
            else if (Auth::user()->type == 1)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'large_small_category' => '1']),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'large_small_category' => '1']),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'large_small_category' => '1']),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'large_small_category' => '1']),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'large_small_category' => '1']),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'large_small_category' => '1']),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'large_small_category' => '1']),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur', 'large_small_category' => '1']),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'large_small_category' => '1']),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'large_small_category' => '1']),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'large_small_category' => '1'])
                ];
            }
            else if (Auth::user()->type == 2)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'assigned_cfo' => Auth::user()->id]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'assigned_cfo' => Auth::user()->id]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'assigned_cfo' => Auth::user()->id]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'assigned_cfo' => Auth::user()->id]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'assigned_cfo' => Auth::user()->id]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'assigned_cfo' => Auth::user()->id]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'assigned_cfo' => Auth::user()->id]),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur', 'assigned_cfo' => Auth::user()->id]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'assigned_cfo' => Auth::user()->id]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'assigned_cfo' => Auth::user()->id]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'assigned_cfo' => Auth::user()->id])
                ];
            }
            else if (Auth::user()->type == 3)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'assigned_id' => Auth::user()->id]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'assigned_id' => Auth::user()->id]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'assigned_id' => Auth::user()->id]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'assigned_id' => Auth::user()->id]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'assigned_id' => Auth::user()->id]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'assigned_id' => Auth::user()->id]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'assigned_id' => Auth::user()->id]),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur', 'assigned_id' => Auth::user()->id]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'assigned_id' => Auth::user()->id]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'assigned_id' => Auth::user()->id]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'assigned_id' => Auth::user()->id])
                ];
            }
            else  if (Auth::user()->type == 5 && Auth::user()->district_id != '')
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'district_id' => Auth::user()->district_id]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'district_id' => Auth::user()->district_id]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'district_id' => Auth::user()->district_id]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'district_id' => Auth::user()->district_id]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'district_id' => Auth::user()->district_id]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'district_id' => Auth::user()->district_id]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'district_id' => Auth::user()->district_id]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'district_id' => Auth::user()->district_id]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'district_id' => Auth::user()->district_id]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'district_id' => Auth::user()->district_id])
                ];
            }
            else  if (Auth::user()->type == 5 && Auth::user()->district_id == '')
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building']),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex']),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair']),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling']),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage']),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse']),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot']),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine']),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station']),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works'])
                ];
            }
        }
        else
        {
            if (Auth::user()->type == 0)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'status' => $status]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'status' => $status]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'status' => $status]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'status' => $status]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'status' => $status]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'status' => $status]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'status' => $status]),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur', 'status' => $status]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'status' => $status]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'status' => $status]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'status' => $status])
                ];
            }
            else if (Auth::user()->type == 1)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'large_small_category' => '1', 'status' => $status]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'large_small_category' => '1', 'status' => $status]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'large_small_category' => '1', 'status' => $status]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'large_small_category' => '1', 'status' => $status]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'large_small_category' => '1', 'status' => $status]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'large_small_category' => '1', 'status' => $status]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'large_small_category' => '1', 'status' => $status]),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur', 'large_small_category' => '1', 'status' => $status]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'large_small_category' => '1']),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'large_small_category' => '1', 'status' => $status]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'large_small_category' => '1', 'status' => $status])
                ];
            }
            else if (Auth::user()->type == 2)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'assigned_cfo' => Auth::user()->id]),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'assigned_cfo' => Auth::user()->id, 'status' => $status]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'assigned_cfo' => Auth::user()->id])
                ];
            }
            else if (Auth::user()->type == 3)
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countSaleSulphur' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'sale_of_sulphur', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'assigned_id' => Auth::user()->id, 'status' => $status]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'assigned_id' => Auth::user()->id, 'status' => $status])
                ];
            }
            else  if (Auth::user()->type == 5 && Auth::user()->district_id != '')
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'district_id' => Auth::user()->district_id, 'status' => $status]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'district_id' => Auth::user()->district_id, 'status' => $status])
                ];
            }
            else  if (Auth::user()->type == 5 && Auth::user()->district_id == '')
            {
                $data = [
                    'countBuilding' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'building', 'status' => $status]),
                    'countCinema' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'cinema_hall_multiplex', 'status' => $status]),
                    'countFireRepair' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_repair', 'status' => $status]),
                    'countFireSelling' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_selling', 'status' => $status]),
                    'countFireStorage' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_arms_storage', 'status' => $status]),
                    'countGasWarehouse' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_warehouse', 'status' => $status]),
                    'countGasOilDepot' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'gas_oil_depot', 'status' => $status]),
                    'countStorageMagazine' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'storage_magazine', 'status' => $status]),
                    'countPetrol' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'petrol_pump_cng_station', 'status' => $status]),
                    'countFireWorks' => $this->commonModel->countAllDataByConditions('applications', ['noc_type' => 'fire_works', 'status' => $status])
                ];
            }
        }
        return view('admin.Noc.noc_for', ['type' => $status, 'data' => $data]);
    } 
    public function indexNoc(Request $request)
    {
        $application = array();
        $noc_type = $request->type;
        if ($request->status == 'all')
        {
            if (Auth::user()->type == 3)
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('assigned_id', '=', Auth::user()->id)->where('status', '!=', 'incomplete')->where('noc_type', '=', $noc_type)->orderBy('id', 'desc')->get();
            }
            else if (Auth::user()->type == 0)
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('status', '!=', 'incomplete')->where('noc_type', '=', $noc_type)->orderBy('id', 'desc')->get();
            }
            else if (Auth::user()->type == 1)
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('status', '!=', 'incomplete')->where('large_small_category', '1')->where('noc_type', '=', $noc_type)->orderBy('id', 'desc')->get();
            }
            else if (Auth::user()->type == 2)
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('status', '!=', 'incomplete')->where('noc_type', '=', $noc_type)->where('assigned_cfo', Auth::user()->id)->orderBy('id', 'desc')->get();
            }
            else  if (Auth::user()->type == 5 && Auth::user()->district_id != '')
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('district_id', '=', Auth::user()->district_id)->where('status', 'pre approval')->where('noc_type', '=', $noc_type)->orwhere('status', 'pending')->orwhere('status', 'approved')->orderBy('id', 'desc')->get();
            }
            else  if (Auth::user()->type == 5 && Auth::user()->district_id == '')
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('status', 'pre approval')->where('noc_type', '=', $noc_type)->orwhere('status', 'pending')->orwhere('status', 'approved')->orderBy('id', 'desc')->get();
            }
        }
        else {

            if (Auth::user()->type == 3) 
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('assigned_id', '=', Auth::user()->id)->orderBy('id', 'desc')->where('status', $request->status)->where('noc_type', '=', $noc_type)->get();
            } 
            else if (Auth::user()->type == 0 || Auth::user()->type == 1) 
            {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('status', $request->status)->where('noc_type', '=', $noc_type)->orderBy('id', 'desc')->get();
            } 
            else  if (Auth::user()->type == 2) {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('status', $request->status)->where('noc_type', '=', $noc_type)->where('assigned_cfo', Auth::user()->id)->orderBy('id', 'desc')->get();
            } 
            else  if (Auth::user()->type == 5 && Auth::user()->district_id != '') {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('district_id', '=', Auth::user()->district_id)->where('status', $request->status)->where('noc_type', '=', $noc_type)->orderBy('id', 'desc')->get();
            } 
            else  if (Auth::user()->type == 5 && Auth::user()->district_id == '') {
                $application  = Application::with('operational_applications', 'renewal_applications')->where('status', $request->status)->where('noc_type', '=', $noc_type)->orwhere('status', 'pending')->orwhere('status', 'approved')->orderBy('id', 'desc')->get();
            }
        }
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');

        return view('admin.Noc.list_noc', ['applications' => $application,'projects' => $projects,'categories' => $categories, 'noc_type' => $noc_type]);
    }

    public function applyTempNOC($noc_type='')
    {
        $user = Auth::user();
        $districts = $this->commonModel->getData('districts');
        $tehsil = $this->commonModel->getData('tehsils');
        $block = $this->commonModel->getData('blocks');
        $panchayat = $this->commonModel->getData('panchayats');
        return view('citizen.temporary.apply_temporary_noc', compact('districts', 'tehsil', 'block', 'panchayat','noc_type'));
    }

    public function adminviewNocDetail($id)
    {

        $app = Application::find($id);
        if (Auth::user()->type == 0) {
            $app->admin_read = '1';
        } else if (Auth::user()->type == 1) {
            $app->dd_read = '1';
        } else if (Auth::user()->type == 2) {
            $app->cfo_read = '1';
        } else if (Auth::user()->type == 3) {
            $app->fso_read = '1';
        } else if (Auth::user()->type == 5) {
            $app->dm_read = '1';
        }

        $app->update();

        $applicationDetail  = Application::with('category', 'subcategory', 'type', 'district', 'assigned', 'block', 'panchayat', 'tehsil')->where('id', '=', $id)->first();

        $buildingMap  = BuildingMap::where('user_id', '=', $applicationDetail->user_id)->first();

        $firePlan  = FireEscapePlan::where('user_id', '=', $applicationDetail->user_id)->get();

        $chemical = ChemicalUse::where('user_id', '=', $applicationDetail->user_id)->get();

        $sop  = UploadSop::where('user_id', '=', $applicationDetail->user_id)->first();

        $officer = SafetyOfficer::where('user_id', '=', $applicationDetail->user_id)->get();

        $doDonts  = DoAndDonts::where('user_id', '=', $applicationDetail->user_id)->first();

        $declaration  = $this->commonModel->getDataByOneCondition('ct_declaration', array('user_id' => $applicationDetail->user_id));
        
        $issued = Issued::with('district')->where('user_id', '=', $applicationDetail->user_id)->orderBy('id', 'desc')->get();

        $user_id = Auth::user()->id;
        $citizen  = User::where('id', '=', $user_id)->first();
        if (Auth::user()->type == 4) {
            $declaration  = $this->commonModel->getDataByOneCondition('ct_declaration', array('user_id' => $applicationDetail->user_id));
        } else {
            $applicationDetail  = Application::with('category', 'subcategory', 'type', 'district', 'assigned', 'block', 'panchayat', 'tehsil')->where('id', '=', $id)->first();
            $declaration  = $this->commonModel->getDataByOneCondition('ct_declaration', array('user_id' => $applicationDetail->user_id));
        }
        $users = User::with('station')->where('type', '=', '3')->where('district_id', '=', $applicationDetail->district_id)->get();
        
        return view('admin.Noc.view_noc', [
            'projects' => Project::with('category')->get(),
            'districts' => District::with('tehsil', 'block.panchayat')->take(13)->get(),
        ])->with('applicationDetail', $applicationDetail)->with('users', $users)->with('inspection_step', '')->with('buildingMap', $buildingMap)->with('firePlan', $firePlan)->with('chemical', $chemical)->with('sop', $sop)->with('officer', $officer)->with('doDonts', $doDonts)->with('declaration', $declaration)->with('issued', $issued);
    }
    public function viewOperationalNocDetail($id)
    {
        return view('citizen.noc.view_operational_noc');
    }
    public function viewNocDetail($id, Request $request)
    {
        $applicationDetail = $this->commonModel->getDataByOneCondition('applications', array('id' => $id));
        $preOperationalDetail = $this->commonModel->getDataByOneCondition('operational_applications', array('application_id' => $id));
        $preRenewalDetail  = $this->commonModel->getDataByOneCondition('renewal_applications', array('application_id' => $id));
        $operational_application = $this->commonModel->getDataByOneCondition('operational_applications', array('application_no' => $applicationDetail[0]->application_no));

        $district = $this->commonModel->getData('districts');
        $categories = $this->commonModel->getData('categories');
        $sub_categories = $this->commonModel->getData('sub_categories');
        $projects = $this->commonModel->getData('projects');
        $types = $this->commonModel->getData('types');
        $block = $this->commonModel->getData('blocks');
        $panchayat = $this->commonModel->getData('panchayats');
        $tehsil = $this->commonModel->getData('tehsils');
        return view('citizen.noc.view_noc', compact('applicationDetail', 'preOperationalDetail', 'preRenewalDetail', 'district', 'categories', 'sub_categories', 'projects', 'types', 'block', 'panchayat', 'tehsil','operational_application'));
    }
    // public function downloadApplication(Request $request)
    // {
    //     $applicationDetail = $this->commonModel->getDataByOneCondition('applications', array('id' => $request->id));
    //     $preOperationalDetail = $this->commonModel->getDataByOneCondition('operational_applications', array('application_id' => $request->id));
    //     $preRenewalDetail  = $this->commonModel->getDataByOneCondition('renewal_applications', array('application_id' => $request->id));
    //     $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $applicationDetail[0]->district_id));
    //     $station = $this->commonModel->getDataByOneCondition('fire_stations', array('id' => $applicationDetail[0]->station_id));
    //     $categoriesArr = $this->commonModel->getDataByOneCondition('categories', array('id' => $applicationDetail[0]->category_id));
    //     $categories = $categoriesArr[0] ?? null;
    //     $sub_categories = $this->commonModel->getDataByOneCondition('sub_categories', array('id' => $applicationDetail[0]->subcategory_id ));
    //     $projects = $this->commonModel->getDataByOneCondition('projects', array('id' => $applicationDetail[0]->project));
    //     $types = $this->commonModel->getDataByOneCondition('types', array('id' => $applicationDetail[0]->type_id));
    //     $block = $this->commonModel->getDataByOneCondition('blocks', array('id' => $applicationDetail[0]->block_id));
    //     $panchayat = $this->commonModel->getDataByOneCondition('panchayats', array('id' => $applicationDetail[0]->panchayat_id));
    //     $tehsil = $this->commonModel->getDataByOneCondition('tehsils', array('id' => $applicationDetail[0]->tehsil_id));
    //     // echo "<pre>";
    //     // print_r($applicationDetail);die;
    //     return view('admin.Noc.reports.noc_building_report', compact('applicationDetail', 'preOperationalDetail', 'preRenewalDetail', 'district', 'categories', 'sub_categories', 'projects', 'types', 'block', 'panchayat', 'tehsil', 'station'));
    // }
    public function downloadApplication(Request $request)
    {
        $applicationDetailArr = $this->commonModel
            ->getDataByOneCondition('applications', ['id' => $request->id]);

        $applicationDetail = $applicationDetailArr ?: [ (object) [] ];

        $app = $applicationDetail[0];

        $preOperationalDetail = $this->commonModel->getDataByOneCondition('operational_applications', ['application_id' => $request->id]);

        $preRenewalDetail = $this->commonModel->getDataByOneCondition('renewal_applications', ['application_id' => $request->id]);

        $district = $this->commonModel->getDataByOneCondition('districts', ['id' => $app->district_id ?? null]);

        $station = $this->commonModel->getDataByOneCondition('fire_stations', ['id' => $app->station_id ?? null]);

        $categoriesArr = $this->commonModel->getDataByOneCondition('categories', ['id' => $app->category_id ?? null]);

        $categories = $categoriesArr[0] ?? null;

        $sub_categories = $this->commonModel->getDataByOneCondition('sub_categories', ['id' => $app->subcategory_id ?? null]);

        $projects = $this->commonModel->getDataByOneCondition('projects', ['id' => $app->project ?? null]);

        $types = $this->commonModel->getDataByOneCondition('types', ['id' => $app->type_id ?? null]);

        $block = $this->commonModel->getDataByOneCondition('blocks', ['id' => $app->block_id ?? null]);

        $panchayat = $this->commonModel->getDataByOneCondition('panchayats', ['id' => $app->panchayat_id ?? null]);

        $tehsil = $this->commonModel->getDataByOneCondition('tehsils', ['id' => $app->tehsil_id ?? null]);
        // echo "<pre>";
        // print_r($applicationDetail);die;
        return view(
            'admin.Noc.reports.noc_building_report',
            compact('applicationDetail', 'preOperationalDetail', 'preRenewalDetail', 'district', 'categories', 'sub_categories', 'projects', 'types', 'block', 'panchayat', 'tehsil', 'station')
        );
    }

    public function editNoc($id)
    {
        $applicationDetail = $this->commonModel->getDataByOneCondition('applications', array('id' => $id));

        $district = $this->commonModel->getData('districts');
        $categories = $this->commonModel->getData('categories');
        $sub_categories = $this->commonModel->getData('sub_categories');
        $projects = $this->commonModel->getData('projects');
        $types = $this->commonModel->getData('types');
        $nocProject = $this->commonModel->getDataByOneCondition('projects', array('name' => $applicationDetail[0]->noc_type));
        $nocfor = isset($nocProject) ? $nocProject[0]->id : '';
        return view('citizen.noc.edit_noc', compact('applicationDetail', 'district', 'categories', 'sub_categories', 'projects', 'types', 'nocfor'));
    }
    public function applyOperationalNocDetail($id, Request $request)
    {
        return Redirect::route('citizen.viewNocDetail', $id)->with('failed', 'Please fill Pre Operational Application Detail...!!!');
    }
    public function applyRenewalNocDetail($id, Request $request)
    {
        return Redirect::route('citizen.viewNocDetail', $id)->with('failed', 'Please fill Renewal Application Detail...!!!');
    }
    public function checkNoc(Request $request)
    {

        $user = Auth::user();
        $data = $request->all();

        if ($data['noc_step'] == 'operational') 
        {

            $request->session()->put('noc_step', 'operational');

            $request->session()->put('noc_type', $data['noc_type']);

            $request->session()->put('application_no', $data['application_no']);

            $app = Application::where('application_no', $data['application_no'])
                ->where('user_id', $user->id)
                ->where('noc_type', $data['noc_type'])
                //->where('status', 'approved')
                ->first();
   

            if ($app)
            {

                // $users = User::with('state')->where('type', '=', '3')->get();
                $users = User::where('type', '=', '3')->get();
                $applicationDetail  = Application::with('category', 'subcategory', 'type', 'district', 'assigned', 'block', 'panchayat', 'tehsil')->where('application_no', '=', $data['application_no'])->first();

                $getSubCategories   = Category::with('subcategory.type')->get();
                $district           = District::with('tehsil', 'block.panchayat')->take(13)->get();
                $categories         = Category::with('subcategory.type')->get();
                $projects           = Project::with('category')->get();


               // return Redirect::route('citizen.viewNocDetail', $applicationDetail->id)->with('message', 'Please fill Pre Operational Application Detail...!!!');

               return view('citizen.noc.pre_operational_noc_step_one', [
                    'district' => District::with('tehsil', 'block.panchayat')->take(13)->get(),
                    'categories' => Category::with('subcategory.type')->get(),
                    'projects' => Project::with('category')->get(),
                    'application_no' => $data['application_no'],
                    'noc_type' => $data['noc_type']
                ])->with('message', 'Please fill basic application detail')->with('noc', '')->with('pre_perational', '0')->with('application', $applicationDetail)->with('noc_step', $data['noc_step']);
            } 
            else {

                $application = new Application();

                 
                $application->step = '0';
                $application->noc_type = $data['noc_type'];
                $application->noc_step = $data['noc_step'];
                $application->pre_operational = 1;

                $nocProject = $this->commonModel->getDataByOneCondition('projects', array('entity' => $data['noc_type']));
               
                $nocfor = isset($nocProject) ? $nocProject[0]->id : '';

                $check_application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $data['application_no']));
                
                $old_application_no = '';

                if ($check_application)
                {
                    $old_application_no = $check_application[0]->application_no;
                }
                else{
                    $old_application_no = '';
                }

                return view('citizen.noc.pre_operational_noc_step_one', [
                    'district' => District::with('tehsil', 'block.panchayat')->take(13)->get(),
                    'categories' => Category::with('subcategory.type')->get(),
                    'projects' => Project::with('category')->get(),
                    'nocfor' => $nocfor,
                    'noc_type' => $data['noc_type'],
                    'application_no' => $old_application_no,
                ])->with('message', 'Please fill basic application detail')->with('noc', '')->with('pre_operational', '0')->with('application', $application)->with('noc_step', $data['noc_step']);
            }
        } else if ($data['noc_step'] == 'renewal') {

            $request->session()->put('noc_step', 'renewal');

            $request->session()->put('noc_type', $data['noc_type']);

            $request->session()->put('application_no', $data['application_no']);

            $app = Application::where('application_no', $data['application_no'])
                ->where('user_id', $user->id)
                ->where('noc_type', $data['noc_type'])
                ->where('status', 'approved')
                ->first();

            if ($app) {

                // $users = User::where('type', '=', '3')->get();
                // $applicationDetail  = Application::with('category', 'subcategory', 'type', 'district', 'assigned', 'block', 'panchayat', 'tehsil')->where('id', '=', $app['application_id'])->first();

                // return Redirect::route('citizen.viewOperationalNocDetail', $applicationDetail->id)->with('message', 'Please fill Pre Renewal Application Detail...!!!');

                $users = User::where('type', '=', '3')->get();
                $applicationDetail  = Application::with('category', 'subcategory', 'type', 'district', 'assigned', 'block', 'panchayat', 'tehsil')->where('application_no', '=', $data['application_no'])->first();

                $getSubCategories   = Category::with('subcategory.type')->get();
                $district           = District::with('tehsil', 'block.panchayat')->take(13)->get();
                $categories         = Category::with('subcategory.type')->get();
                $projects           = Project::with('category')->get();


               // return Redirect::route('citizen.viewNocDetail', $applicationDetail->id)->with('message', 'Please fill Pre Operational Application Detail...!!!');

               return view('citizen.noc.renewal_noc_step_one', [
                    'district' => District::with('tehsil', 'block.panchayat')->take(13)->get(),
                    'categories' => Category::with('subcategory.type')->get(),
                    'projects' => Project::with('category')->get(),
                    'application_no' => $data['application_no'],
                    'noc_type' => $data['noc_type']
                ])->with('message', 'Please fill basic application detail')->with('noc', '')->with('pre_perational', '0')->with('application', $applicationDetail)->with('noc_step', $data['noc_step']);
            }
            else {

                $application = new Application();

                 
                $application->step = '0';
                $application->noc_type = $data['noc_type'];
                $application->noc_step = $data['noc_step'];
                $application->pre_operational = 1;

                $nocProject = $this->commonModel->getDataByOneCondition('projects', array('entity' => $data['noc_type']));
               
                $nocfor = isset($nocProject) ? $nocProject[0]->id : '';

                $check_application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $data['application_no']));
                
                $old_application_no = '';

                if ($check_application)
                {
                    $old_application_no = $check_application[0]->application_no;
                }
                else{
                    $old_application_no = '';
                }

                return view('citizen.noc.renewal_noc_step_one', [
                    'district' => District::with('tehsil', 'block.panchayat')->take(13)->get(),
                    'categories' => Category::with('subcategory.type')->get(),
                    'projects' => Project::with('category')->get(),
                    'nocfor' => $nocfor,
                    'noc_type' => $data['noc_type'],
                    'application_no' => $old_application_no,
                ])->with('message', 'Please fill basic application detail')->with('noc', '')->with('pre_operational', '0')->with('application', $application)->with('noc_step', $data['noc_step']);
            }
        }
    }
    
    public function addNocStepFirstPost(Request $request)
    {
        $filterModel = new FilterModel;
        $user = Auth::user();

        // ---------- Build occupancy data (original logic) ----------
        $occupancy_data = [];
        if ($request->filled('no_of_rooms')) {
            $occupancy_data['no_of_rooms'] = $request->no_of_rooms;
        }
        if ($request->filled('no_of_beds')) {
            $occupancy_data['no_of_beds'] = $request->no_of_beds;
        }
        if ($request->filled('for_educational')) {
            $occupancy_data['for_educational'] = $request->for_educational;
        }
        if ($request->filled('seating_capacity')) {
            $occupancy_data['seating_capacity'] = $request->seating_capacity;
        }
        if ($request->filled('no_of_employee')) {
            $occupancy_data['no_of_employee'] = $request->no_of_employee;
        }
        if ($request->filled('is_hazardous_material')) {
            $occupancy_data['is_hazardous_material'] = $request->is_hazardous_material;
        }
        if ($request->filled('hazardous_material')) {
            $occupancy_data['hazardous_material'] = $request->hazardous_material;
        }
        if ($request->filled('occupancy_value')) {
            $occupancy_data['value'] = $request->occupancy_value;
            $occupancy_data['category_id'] = $request->category_id;
            $occupancy_data['subcategory_id'] = $request->subcategory_id;
        }
        // DO NOT reset $occupancy_data

        $occupancy_detail = json_encode($occupancy_data);

        // ---------- Common base data ----------
        $baseData = [
            'application_type'       => $request->input('application_type', ''),
            'building_name'          => $request->input('building_name', ''),
            'building_ownership'     => $request->input('building_ownership', ''),
            'gst_pan_tan'            => $request->input('gst_pan_tan', ''),
            'gst_pan_tan_no'         => $request->input('gst_pan_tan_no', ''), // never null
            'project_type'           => $request->input('project_type', ''),
            'category_id'            => $request->input('category_id', ''),
            'subcategory_id'         => $request->input('subcategory_id', ''),
            'type_id'                => (int) $request->input('type_id', 0),
            'project_status'         => $request->input('project_status', ''),
            'google_address'         => $request->input('google_address', ''),
            'latitude'               => $request->input('latitude', ''),
            'longitude'              => $request->input('longitude', ''),
            'email'                  => $request->input('email', ''),
            'mobile_no'              => $request->input('mobile_no', ''),
            'office_telephone'       => $request->input('office_telephone', ''),
            'district_id'            => $request->input('district_id', ''),
            'rural_urban'            => $request->input('rural_urban', ''),
            'plot_khasra_khatauni'   => $request->input('plot_khasra_khatauni', ''),
            'plot_khasra_khatauni_no'=> $request->input('plot_khasra_khatauni_no', ''),
            'landmark'               => $request->input('landmark', ''),
            'city'                   => $request->input('city', ''),
            'pincode'                => (int) $request->input('pincode', 0),
            'occupancy_detail'       => $occupancy_detail,
            'noc_type'               => $request->input('noc_type', ''),
            'pre_perational'         => '0',          // FIX: string, not integer
            'step'                   => '1',          // FIX: string (if column is enum)
            'status'                 => 'incomplete',
            'user_id'                => $user->id,
        ];

        // ---------- Conditional urban/rural fields ----------
        if ($request->input('rural_urban') === 'urban') {
            $baseData['tehsil_id']     = (int) $request->input('tehsil_id', 0);
            $baseData['urban_body_id'] = (int) $request->input('urban_body_id', 0);
            $baseData['ward_id']       = (int) $request->input('ward_id', 0);
            $baseData['street']        = $request->input('street', '');
        }
        if ($request->input('rural_urban') === 'rural') {
            $baseData['block_id']     = (int) $request->input('block_id', 0);
            $baseData['panchayat_id'] = (int) $request->input('panchayat_id', 0);
            $baseData['village']      = $request->input('village', '');
        }

        // ---------- Update existing ----------
        if ($request->filled('application_no')) {
            $application_no = $request->application_no;
            $result = $filterModel->updateDataByOneCondition('applications', ['application_no' => $application_no], $baseData);
            if ($result == 1) {
                return ['status' => '1', 'msg' => 'Data updated successfully.', 'application_no' => $application_no];
            } elseif ($result == 2) {
                return ['status' => '0', 'msg' => 'Nothing to update'];
            } else {
                return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
            }
        }

        // ---------- New application ----------
        $application_no = time();
        $baseData['application_no'] = $application_no;

        // application_flag & old_application_no (original logic)
        $check_application = [];
        if ($request->application_type == 'pre operational noc' && $request->filled('old_application_no')) {
            $check_application = $this->commonModel->getDataByOneCondition('applications', ['application_no' => $request->old_application_no]);
        }
        if (!empty($check_application) && $request->application_type == 'pre operational noc' && $request->filled('old_application_no')) {
            $baseData['application_flag'] = 3;
            $baseData['old_application_no'] = $request->old_application_no;
        } elseif ($request->application_type == 'pre establishment noc') {
            $baseData['application_flag'] = 1;
            $baseData['old_application_no'] = null;
        } elseif ($request->application_type == 'pre operational noc' && !$request->filled('old_application_no')) {
            $baseData['application_flag'] = 2;
            $baseData['old_application_no'] = null;
        } elseif ($request->application_type == 'renewal noc' && $request->filled('old_application_no')) {
            $baseData['application_flag'] = 4;
            $baseData['old_application_no'] = $request->old_application_no;
        }

        // ---------- Insert with duplicate handling ----------
        try {
            DB::beginTransaction();
            $insertedId = $this->commonModel->lastInsertData('applications', $baseData);
            DB::commit();
            return ['status' => '1', 'msg' => 'Data submitted successfully.', 'application_no' => $application_no];
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error('Insert failed: ' . $e->getMessage());
            if ($e->getCode() == 23000 || $e->getCode() == 1062 || str_contains($e->getMessage(), 'Duplicate entry')) {
                $existing = $this->commonModel->getDataByOneCondition('applications', ['application_no' => $application_no]);
                if (!empty($existing)) {
                    return ['status' => '1', 'msg' => 'Application already exists.', 'application_no' => $existing[0]->application_no];
                }
            }
            return ['status' => '0', 'msg' => 'Data was not saved. Please try again.'];
        }
    }

    public function addNocStepSecondPost(Request $request)
    {
        try {
            $user = Auth::user();
            // Process person data
            $person_data = [];
            if (!empty($request->p_salutation) && is_array($request->p_salutation)) {
                foreach ($request->p_salutation as $index => $salutation) {
                    $person_data[] = [
                        'p_salutation' => $salutation ?? '',
                        'p_first_name' => $request->p_first_name[$index] ?? '',
                        'p_middle_name' => $request->p_middle_name[$index] ?? '',
                        'p_last_name' => $request->p_last_name[$index] ?? '',
                        'p_mobile_no' => $request->p_mobile_no[$index] ?? '',
                        'p_percentage_share' => $request->p_percentage_share[$index] ?? 0,
                        'p_point_of_contact' => $index === 0 ? ($request->p_point_of_contact[0] ?? 'no') : 'no',
                    ];
                }
            }

            // Prepare owner data
            $own_data = [
                'salutation' => $request->salutation ?? '',
                'first_name' => $request->first_name ?? '',
                'middle_name' => $request->middle_name ?? '',
                'last_name' => $request->last_name ?? '',
                'mobile_no' => $request->mobile_no ?? '',
                'email' => $request->email ?? '',
                'percentage_share' => $request->percentage_share ?? 0,
                'point_of_contact' => $request->point_of_contact ?? '',
            ];

            // Prepare contact data
            $contact_data = [
                'person_appointed' => $request->person_appointed ?? '',
                'con_salutation' => $request->con_salutation ?? '',
                'con_first_name' => $request->con_first_name ?? '',
                'con_middle_name' => $request->con_middle_name ?? '',
                'con_last_name' => $request->con_last_name ?? '',
                'con_mobile_no' => $request->con_mobile_no ?? '',
                'con_email' => $request->con_email ?? '',
            ];

            // Prepare architect data
            $arc_data = [
                'arc_salutation' => $request->arc_salutation ?? '',
                'arc_first_name' => $request->arc_first_name ?? '',
                'arc_middle_name' => $request->arc_middle_name ?? '', // Fixed: using name_of_firm correctly
                'arc_last_name' => $request->arc_last_name ?? '',
                'name_of_firm' => $request->name_of_firm ?? '',
                'arc_mobile_no' => $request->arc_mobile_no ?? '',
                'arc_email' => $request->arc_email ?? '',
                'firm_gst_pan_tan' => $request->firm_gst_pan_tan ?? '',
                'firm_gst_pan_tan_no' => $request->firm_gst_pan_tan_no ?? '',
            ];

            // Prepare data for update
            $data = [
                'proprietary_rights' => $request->proprietary_rights,
                'partner_detail' => json_encode($person_data),
                'owner_detail' => json_encode($own_data),
                'contact_person' => json_encode($contact_data),
                'architect_detail' => json_encode($arc_data),
                'step' => 2
            ];

            // Update application
            $application = $this->commonModel->getDataByOneCondition('applications', ['application_no' => $request->application_no]);

            $res = $this->commonModel->updateDataByOneCondition('applications', ['application_no' => $request->application_no], $data);
            // Handle response
            if ($res == 1) {
                return response()->json([
                    'status' => '1',
                    'msg' => 'Data updated successfully.',
                    'application_no' => $application[0]->application_no ?? $request->application_no
                ]);
            } else {
                return response()->json(['status' => '0', 'msg' => 'Data update failed. Please try again.'], 500);
            }

        } catch (\Exception $e) {
            return response()->json([
                'status' => '0',
                'msg' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
    public function addNocStepThirdPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $total_plot_area = [];
        $total_plot_area['total_plot_area'] = $request->total_plot_area;
        $total_covered_area = [];
        $total_covered_area['total_covered_area'] = $request->total_covered_area;
        $ground_floor_covered = [];
        $ground_floor_covered['ground_floor_covered'] = $request->ground_floor_covered;
        $max_height_building = [];
        $max_height_building['max_height_building'] = $request->max_height_building;
        $basement_covered_area = [];
        $basement_covered_area['basement_covered_area'] = $request->basement_covered_area;
        $height_of_tallest_block = [];
        $height_of_tallest_block['height_of_tallest_block'] = $request->height_of_tallest_block;
        $min_distance_block = [];
        $min_distance_block['min_distance_block'] = $request->min_distance_block;
        $approach_road_width = [];
        $approach_road_width['approach_road_width'] = $request->approach_road_width;
        $setback = [];
        $setback['front'] = $request->front;
        $setback['rear'] = $request->rear;
        $setback['side1'] = $request->side1;
        $setback['side2'] = $request->side2;
        $max_height = $request->max_height_building;
        $max_covered_area = $request->total_covered_area;
        $application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_no));
        $username = $this->commonModel->getDataByTwoCondition('users', array('district_id' => $application[0]->district_id), array('type' => '2'));
        if ($max_height >= 15 || $max_covered_area >= 5000) {
            $large_small_category =   '1';
            $assigned_cfo =   '0';
        } else {
            $large_small_category =   '0';
            $assigned_cfo =   $username[0]->id;
        }
        $data = [
            'total_plot_area' => json_encode($total_plot_area),
            'total_covered_area' => json_encode($total_covered_area),
            'ground_floor_covered' => json_encode($ground_floor_covered),
            'max_height_building' => json_encode($max_height_building),
            'no_of_floor' => $request->no_of_floor,
            'basement_covered_area' => json_encode($basement_covered_area),
            'no_of_basement' => $request->no_of_basement,
            'no_of_blocks' => $request->no_of_blocks,
            'height_of_tallest_block' => json_encode($height_of_tallest_block),
            'min_distance_block' => json_encode($min_distance_block),
            'approach_road_width' => json_encode($approach_road_width),
            'provision_no_enterance' => $request->provision_no_enterance,
            'provision_no_exit' => $request->provision_no_exit,
            'set_back_detail' => json_encode($setback),
            'large_small_category' => $large_small_category,
            'assigned_cfo' => $assigned_cfo,
            'step' => 3,
        ];
        $res = $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $request->application_no), $data);
        if ($res == 1)
        {
            return ['status' => '1', 'msg' => 'Data updated successfully.', 'application_no' => $application[0]->application_no];
        }
        else if ($res == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
        }
    }
    public function addNocStepForthPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $updateData['ess_provision_detail'] = json_encode($data);

        if ($request->pre_perational == '0') {
            $updateData['step'] = 4;
            $res = $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $request->application_no), $updateData);
            $application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_no));
            return view('citizen.noc.noc_step_five', compact('application'));
        } else {
            $updateData['step'] = 4;
            $updateData['admin_read'] = 0;
            $updateData['dd_read'] = 0;
            $updateData['cfo_read'] = 0;
            $updateData['fso_read'] = 0;
            $updateData['dm_read'] = 0;
            $res = $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $request->application_no), $updateData);
            $application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_no));
            if ($res == 1)
            {
                return ['status' => '1', 'msg' => 'Data updated successfully.', 'application_no' => $application[0]->application_no];
            }
            else if ($res == 2)
            {
                return ['status' => '0', 'msg' => 'Nothing to update'];
            }
            else
            {
                return ['status' => '0', 'msg' => 'Data was not updated. Please try again.'];
            }
        }
    }
    public function addNocStepFivePost(Request $request)
    {
        $input_data = $request->all();
        if ($request->hasFile('reference_letter')) {
            $file = $request->file('reference_letter');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $imageName);
            $reference_letter = 'public/citizen/file/' . $imageName;
        } 
        else 
        {
            return ['status' => '0', 'msg' => 'Reference Letter upload failed. Please try again.'];
        }

        if ($request->hasFile('proposed_map')) {
            $file = $request->file('proposed_map');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $imageName);
            $proposed_map = 'public/citizen/file/' . $imageName;
        } 
        else 
        {
            return ['status' => '0', 'msg' => 'Proposed Map upload failed. Please try again.'];
        }
        if ($request->hasFile('fire_plan')) {
            $file = $request->file('fire_plan');
            $imageName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('citizen/file'), $imageName);
            $fire_plan = 'public/citizen/file/' . $imageName;
        } 
        else 
        {
            return ['status' => '0', 'msg' => 'Fire plan upload failed. Please try again.'];
        }
        $docu = [
            'reference_letter' => $reference_letter,
            'proposed_map' => $proposed_map,
            'fire_plan' => $fire_plan
        ];
        $data = [
            'attachments' => json_encode($docu),
            'step' => 5
        ];
        $res = $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $request->application_no), $data);
        if($res)
        {
            $application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_no));
            return ['status' => '1', 'msg' => 'File uploaded successfully.', 'data' => isset($application) ? json_encode($application[0]): ''];
        }
        else{
            return ['status' => '0', 'msg' => 'Something went wrong. Please try again.'];
        }
    }
    public function addNocStepSixPost(Request $request)
    {
        $input_data = $request->all();
        foreach ($input_data as $key => $value) {
            if ($key != "_token" && $key != "application_no") {
                $validator = Validator::make(
                    $request->all(),
                    [
                        $key => 'required|mimes:pdf',
                    ],
                    [
                        $key . '.required' => 'Please upload a PDF document',
                        $key . '.mimes' => 'Only PDF files are allowed'
                    ]
                );
                if ($validator->fails()) {
                    return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
                }
                if ($request->hasFile($key)) {
                    $fileName = time() . '.' . $request->$key->getClientOriginalExtension();
                    $request->$key->move(public_path('uploads'), $fileName);
                    $request['upload'] = 'uploads/' . $fileName;
                }
            }
        }
        $application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_no));
        $data = [
            'challan' => $request['upload'],
            'step' => 6
        ];
        $res = $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $request->application_no), $data);
        $districts = $this->commonModel->getData('districts');
        $block = $this->commonModel->getData('blocks');
        $panchayat = $this->commonModel->getData('panchayats');
        return view('citizen.noc.noc_step_submit', compact('application','districts','block','panchayat'));
    }
    public function addNocStepSevenPost(Request $request)
    {
        $input_data = $request->all();
        $application = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_no));

        $large_small_category = $application[0]->large_small_category;

        $history = array();
        $historys = [];
        
        if($large_small_category ==1)
        {
            $historys['history'] = 'Application has been submitted to Deputy Director';
        }
        else
        {
            $historys['history'] = 'Application has been submitted to CFO';
        }
        $historys['date'] = date('m/d/Y h:i:s a', time());
        if(empty($application[0]->history))
        {
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($application[0]->history);
            $history[] = $historys;
        }
        $data = [
            'history' => json_encode($history),
            'step' => 7,
            'status' =>   'pending',
            'assigned_id' => null,
            'fso_signature' => null,
            'fso_name' => null
        ];

        if (empty($application[0]->submitted_at)) {
            $data['submitted_at'] = now();
        }
        
        $res = $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $request->application_no), $data);
        
        $category = $this->commonModel->getData('categories');
        $subcategory = $this->commonModel->getData('sub_categories');
        $type = $this->commonModel->getData('types');
        if ($res == 1)
        {
            return ['status' => '1', 'msg' => 'Application submitted successfully.', 'application_no' => $application[0]->application_no, 'application_type' => $application[0]->application_type];
        }
        else if ($res == 2)
        {
            return ['status' => '0', 'msg' => 'Nothing to update'];
        }
        else
        {
            return ['status' => '0', 'msg' => 'Application was not submitted. Please try again.'];
        }      
    }
    public function assignedNocToFSO(Request $request)
    {
        $tbl = '';
        if($request->application_type =='established')
        {
            $tbl = 'applications';
            $app = $this->commonModel->getDataByOneCondition($tbl, array('id' => $request->id));
        }
        else if($request->application_type =='operational')
        {
            $tbl = 'operational_applications';
            $app = $this->commonModel->getDataByOneCondition($tbl, array('id' => $request->id));
        }
        else if($request->application_type =='renewal')
        {
            $tbl = 'renewal_applications';
            $app = $this->commonModel->getDataByOneCondition($tbl, array('id' => $request->id));
        }

        $user_name = $this->get_user_name($request->assigned_id);

        $historys = array();
        $historys['history'] = 'Application has been assigned to FSO '.ucfirst($user_name);
        $historys['date'] = date('m/d/Y h:i:s a', time());
        
        if(!empty($app[0]->history))
        {
            $history = json_decode($app[0]->history);
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($app[0]->history);
            $history[] = $historys;
        }
        $station = $this->commonModel->getDataByOneCondition('users', array('id' => $request->assigned_id));

        $data = [
            'status' => 'processed',
            'assigned_id' => $request->assigned_id,
            'station_id' => $station[0]->station_id,
            'history' => json_encode($history)
        ];
        $this->commonModel->updateDataByOneCondition($tbl, array('application_no' => $app[0]->application_no), $data);

        return redirect()->back()->with('message', 'Application has been Assined To FSO '.ucfirst($user_name).' Successfully!');
    }
    public function assignedNocToCFO(Request $request)
    {
        if($request->application_type =='established')
        {
            $tbl = 'applications';
            $app = $this->commonModel->getDataByOneCondition($tbl, array('id' => $request->id));
        }
        else if($request->application_type =='operational')
        {
            $tbl = 'operational_applications';
            $app = $this->commonModel->getDataByOneCondition($tbl, array('id' => $request->id));
        }
        else if($request->application_type =='renewal')
        {
            $tbl = 'renewal_applications';
            $app = $this->commonModel->getDataByOneCondition($tbl, array('id' => $request->id));
        }

        $user_name = $this->get_user_name($request->assigned_id);

        $historys = array();
        $historys['history'] = 'Application has been assigned to CFO '.ucfirst($user_name);
        $historys['date'] = date('m/d/Y h:i:s a', time());
               
        if(!empty($app[0]->history))
        {
            $history = json_decode($app[0]->history);
            $history[] = $historys;
        }
        else
        {
            $history = json_decode($app[0]->history);
            $history[] = $historys;
        }

        $data = [
            'status' => 'processed',
            'assigned_cfo' => '1',
            'history' => json_encode($history)
        ];
        $this->commonModel->updateDataByOneCondition('applications', array('application_no' => $app[0]->application_no), $data);

        return redirect()->back()->with('message', 'Application has been assigned To CFO '.ucfirst($user_name).' Successfully!');
    }
    public function get_user_name($id)
    {
        if($id!='')
        {
            $user  = User::where('id', '=', $id)->first();
            $user_name = $user->name;
            return $user_name;
        }
        else
        {
            return "";
        }
    }
    
    public function filter_noc_data(Request $request)
    {
        $filterModel = new FilterModel();

        $startDate     = $request->filter_from_date ?? '';
        $endDate       = $request->filter_to_date ?? '';
        $projects      = $request->filter_projects ?? '';
        $categories    = $request->filter_category ?? '';
        $filterNocType = $request->filter_noc_type ?? '';

        // URL params
        $currentStatus = $request->current_status ?? 'all';
        $currentType   = $request->current_type ?? '';

        $length = $request->length ?? 10;
        $start  = $request->start ?? 0;

        $tbl = 'applications';

        /*
        |--------------------------------------------------------------------------
        | Main Fields
        |--------------------------------------------------------------------------
        */

        $fields = [
            'date' => [
                'start' => $startDate,
                'end'   => $endDate
            ],

            'project_type' => $projects,
            'category_id'  => $categories,

            'noc_type' => $currentType,
            'application_type' => $filterNocType,

            'date_column' => 'created_at',
            'desc_column' => 'id'
        ];


        /*
        |--------------------------------------------------------------------------
        | Status Handling
        |--------------------------------------------------------------------------
        */

        if ($currentStatus == 'all') {

            $fields['status'] = ['incomplete'];

        } else {

            $fields['status'] = [$currentStatus];
        }

        /*
        |--------------------------------------------------------------------------
        | User Type Filters
        |--------------------------------------------------------------------------
        */

        if (Auth::user()->type == 1) {

            $fields['large_small_category'] = '1';
        }

        elseif (Auth::user()->type == 2) {

            $fields['assigned_cfo'] = Auth::user()->id;
            $fields['district_id'] = Auth::user()->district_id;
        }

        elseif (Auth::user()->type == 3) {

            $fields['assigned_id'] = Auth::user()->id;
        }

        elseif (Auth::user()->type == 5) {

            if (!empty(Auth::user()->district_id)) {

                $fields['district_id'] = Auth::user()->district_id;
            }

            // DM allowed statuses
            if ($currentStatus == 'all') {

                $fields['status'] = [
                    'pre approval',
                    'pending',
                    'approved'
                ];
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Count & Fetch Data
        |--------------------------------------------------------------------------
        */

        $totalCount = $filterModel->countFilterData($tbl, $fields);

        $allData = $filterModel->filterAllData(
            $tbl,
            $fields,
            $length,
            $start
        );

        $resultData = [];

        if (!empty($allData))
        {
            $i = $start + 1;

            foreach ($allData as $row)
            {
                /*
                |--------------------------------------------------------------------------
                | Supporting Data
                |--------------------------------------------------------------------------
                */

                $category = DB::table('categories')
                    ->where('id', $row->category_id)
                    ->value('name');

                $district = DB::table('districts')
                    ->where('id', $row->district_id)
                    ->value('name');

                $station = DB::table('fire_stations')
                    ->where('id', $row->station_id)
                    ->value('name');

                /*
                |--------------------------------------------------------------------------
                | Building Height
                |--------------------------------------------------------------------------
                */

                $building_height = json_decode(
                    $row->max_height_building,
                    true
                );

                $maxHeight = $building_height['max_height_building'] ?? 'NA';

                /*
                |--------------------------------------------------------------------------
                | NOC Type Label
                |--------------------------------------------------------------------------
                */

                $nocTypeLabel = match ($row->noc_type) {

                    'building' => 'Noc For Building',

                    'cinema_hall_multiplex' =>
                        'Noc For Cinema Hall- Multiplex',

                    'fire_arms_repair' =>
                        'Noc For Fire Arms Repair',

                    'fire_arms_selling' =>
                        'Noc For Fire Arms Selling',

                    'fire_arms_storage' =>
                        'Noc For Fire Arms Storage',

                    'gas_warehouse' =>
                        'Noc For Gas Warehouse and Agency',

                    'gas_oil_depot' =>
                        'Noc For Gas-Oil-Depot',

                    'sale_of_sulphur' =>
                        'Noc For Sale Of Sulphur',

                    'storage_magazine' =>
                        'Noc For Storage - Magazine',

                    'petrol_pump_cng_station' =>
                        'Noc For Petrol Pump-CNG Station',

                    'fire_works' =>
                        'Noc For Fire Works',

                    default => 'NA',
                };

                /*
                |--------------------------------------------------------------------------
                | Status Label
                |--------------------------------------------------------------------------
                */

                $status = match ($row->status) {

                    'pending' => 'New',
                    'processed' => 'Verifier Assign',
                    'for approval' => 'Verified',
                    'pre approval' => 'For Pre Approval',
                    'pre approved' => 'Pre Approved',
                    'reverted' => 'Reverted',
                    'approved' => 'Approved',

                    default => 'NA',
                };

                /*
                |--------------------------------------------------------------------------
                | Days Since Applied
                |--------------------------------------------------------------------------
                */

                $daysDiff = 'NA';

                if (!empty($row->submitted_at))
                {
                    $submittedAt = new DateTime($row->submitted_at);

                    $today = new DateTime();

                    $interval = $submittedAt->diff($today);

                    $daysDiff = $interval->days . ' days';
                }

                /*
                |--------------------------------------------------------------------------
                | Expiry Date
                |--------------------------------------------------------------------------
                */

                $expDateText = 'NA';

                if (!empty($row->validity))
                {
                    $validityDate = strtotime($row->updated_at);

                    if ($row->validity == 3) {

                        $expDate = strtotime('+3 years', $validityDate);

                    } elseif ($row->validity == 5) {

                        $expDate = strtotime('+5 years', $validityDate);

                    } else {

                        $expDate = null;
                    }

                    if ($expDate)
                    {
                        $daysLeft = floor(
                            ($expDate - time()) / (60 * 60 * 24)
                        );

                        if ($daysLeft <= 90 && $daysLeft > 0)
                        {
                            $expDateText =
                                date('d-M-Y', $expDate)
                                . " ({$daysLeft} days left)";
                        }
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Action Buttons
                |--------------------------------------------------------------------------
                */

                $action = '';

                $action .= '
                    <a href="'.route("admin.adminviewNocDetail", $row->id).'"
                    class="btn btn-primary btn-sm"
                    title="View">
                    <i class="fa fa-eye"></i>
                    </a>
                ';

                if ($row->status == 'approved')
                {
                    $action .= '
                        <a href="'.route("noc.download", $row->id).'"
                        class="btn btn-dark btn-sm"
                        target="_blank"
                        title="Download">
                        <i class="fa fa-print"></i>
                        </a>
                    ';
                }

                /*
                |--------------------------------------------------------------------------
                | Highlight Rows
                |--------------------------------------------------------------------------
                */

                $highlightRow = '';

                if ($row->status == 'pending')
                {
                    $createdDate = new DateTime($row->created_at);

                    $today = new DateTime();

                    $interval = $today->diff($createdDate);

                    $daysOld = $interval->days;

                    if ($interval->invert === 1)
                    {
                        if ($daysOld >= 25 && $daysOld <= 30) {

                            $highlightRow = 'highlight-red';

                        } elseif ($daysOld >= 13 && $daysOld <= 15) {

                            $highlightRow = 'highlight-orange';
                        }
                    }
                }

                /*
                |--------------------------------------------------------------------------
                | Final Output
                |--------------------------------------------------------------------------
                */

                $output = [];

                $output[] = $i;

                $output[] = $row->application_no ?? 'NA';

                $output[] = $row->old_application_no ?? '-----';

                $output[] = $row->application_flag ?? '-----';

                $output[] = Carbon::parse(
                    $row->created_at
                )->format('d-m-Y H:i:s');

                $output[] = $daysDiff;

                $output[] = $nocTypeLabel;

                $output[] = ucwords(
                    $row->application_type ?? 'NA'
                );

                $output[] = $row->building_name ?? 'NA';

                $output[] = $category ?? 'NA';

                $output[] = $maxHeight;

                $output[] = $district ?? 'NA';

                $output[] = $station ?? 'NA';

                $output[] = $expDateText;

                $output[] = $status;

                $output[] = $row->declaration_status ?? 'Valid';

                $output[] = $action;

                // LAST hidden column
                $output[] = $highlightRow;

                $resultData[] = $output;

                $i++;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | DataTable Response
        |--------------------------------------------------------------------------
        */

        return response()->json([
            "draw" => intval($request->draw),
            "recordsTotal" => $totalCount,
            "recordsFiltered" => $totalCount,
            "data" => $resultData
        ]);
    }

    public function generateQrCode()
    {
        $data = "https://newfirestation.test-uat.site/download-noc/132";
        $publicQrPath = public_path('qrcodes');
        if (!File::exists($publicQrPath)) {
            File::makeDirectory($publicQrPath, 0755, true);
        }
        $filename = 'qrcode_'.time().'.png';
        $path = 'qrcodes/'.$filename;
        QrCode::format('png')
            ->size(200)
            ->generate($data, public_path($path));
        return $filename;
    }

    public function previewNoc(Request $request)
    {
        $application_no = $request->id;
        $applicationDetail = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $application_no));
        $preOperationalDetail = $this->commonModel->getDataByOneCondition('operational_applications', array('application_id' => $request->id));
        $preRenewalDetail  = $this->commonModel->getDataByOneCondition('renewal_applications', array('application_id' => $request->id));
        $district = $this->commonModel->getDataByOneCondition('districts', array('id' => $applicationDetail[0]->district_id));
        $categories = $this->commonModel->getDataByOneCondition('categories', array('id' => $applicationDetail[0]->category_id));
        $sub_categories = $this->commonModel->getDataByOneCondition('sub_categories', array('id' => $applicationDetail[0]->subcategory_id ));
        $projects = $this->commonModel->getDataByOneCondition('projects', array('id' => $applicationDetail[0]->project_type));
        $types = $this->commonModel->getDataByOneCondition('types', array('id' => $applicationDetail[0]->type_id));
        $block = $this->commonModel->getDataByOneCondition('blocks', array('id' => $applicationDetail[0]->block_id));
        $panchayat = $this->commonModel->getDataByOneCondition('panchayats', array('id' => $applicationDetail[0]->panchayat_id));
        $tehsil = $this->commonModel->getDataByOneCondition('tehsils', array('id' => $applicationDetail[0]->tehsil_id));
        // echo "<pre>";
        // print_r($applicationDetail);die;
        return view('citizen.noc.preview_noc', compact('applicationDetail', 'preOperationalDetail', 'preRenewalDetail', 'district', 'categories', 'sub_categories', 'projects', 'types', 'block', 'panchayat', 'tehsil'));
    }

    public function nocExtension(Request $request)
    {
        $applicationDetail = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_id));
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        return view('citizen.noc.extension_noc', compact('applicationDetail', 'district', 'projects', 'categories'));
    }
    
    public function nocOperational(Request $request)
    {
        $applicationDetail = $this->commonModel->getDataByOneCondition('applications', array('application_no' => $request->application_id));
        $district = $this->commonModel->getData('districts');
        $projects = $this->commonModel->getData('projects');
        $categories = $this->commonModel->getData('categories');
        $pre_operational = '0';
        return view('citizen.noc.pre_operational_noc_step_one', compact('applicationDetail', 'district', 'projects', 'categories', 'pre_operational'));
    }
}

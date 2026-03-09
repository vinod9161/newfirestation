<?php
namespace App\Http\Controllers\Admin\CMS\Achivements;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;

class MedalWinnersController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index()
    {
        $tbl = "medals";
        $data['madel_winners'] = $this->commonModel->getDataWithJoin(
            $tbl,
            [
                ['medal_category', 'medals.medal_category', '=', 'medal_category.id'],
                ['fire_stations', 'medals.fire_station', '=', 'fire_stations.id'],
                ['districts', 'medals.districts', '=', 'districts.id']
            ],
            ['medals.*', 'medal_category.category_name', 'fire_stations.name as fire_station_name', 'districts.name as district_name']
        );
        return view('admin.CMS.Achivements.medal_winners.index', $data);
    }
    public function add(){
        $tbl = "medal_category";
        $fire_stationstbl = "fire_stations";
        $districtstbl = "districts";
        $data['medal_category'] = $this->commonModel->getData($tbl);
        $data['fire_stations'] = $this->commonModel->getData($fire_stationstbl);
        $data['districts'] = $this->commonModel->getData($districtstbl);

        
        return view('admin.CMS.Achivements.medal_winners.add',$data);
    }

    public function Save(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:medal_category,id',
            'fire_station' => 'required|exists:fire_stations,id',
            'district' => 'required|exists:districts,id',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'occassion' => 'required|string|max:1024',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'medal_category' => $request->category_id,
            'fire_station' => $request->fire_station,
            'districts' => $request->district,
            'year' => $request->year,
            'designation' => $request->designation,
            'name' => $request->name,
            'occassion' => $request->occassion
        ];

        $insertData = $this->commonModel->insertData('medals', $data);
        if($insertData){
            return redirect()->route('admin.achivements.medal_winners')
                 ->with('success', 'Madel Winners added successfully.');
        }else{
            return redirect()->route('admin.achivements.medal_winners')
                 ->with('error', 'Madel Winners not added successfully.');
        }
    }

    public function edit($id){
    
        $tbl = "medals";
        $data['medal_winners'] = $this->commonModel->getDataWithJoin(
            $tbl,
            [
                ['medal_category', 'medals.medal_category', '=', 'medal_category.id'],
                ['fire_stations', 'medals.fire_station', '=', 'fire_stations.id'],
                ['districts', 'medals.districts', '=', 'districts.id']
            ],
            ['medals.*', 'medal_category.category_name', 'fire_stations.name as fire_station_name', 'districts.name as district_name'],
            ['medals.id'=>$id]
        );
        // echo "<pre>";print_r($data['medal_winners']); die;
        $tbl = "medal_category";
        $data['medal_category'] = $this->commonModel->getData($tbl);
        $tbl = "fire_stations";
        $data['fire_stations'] = $this->commonModel->getData($tbl);
        $tbl = "districts";
        $data['districts'] = $this->commonModel->getData($tbl);
        $data['medal_winners'] = $data['medal_winners'][0];
        return view('admin.CMS.Achivements.medal_winners.edit',$data);
    }


    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:medal_category,id',
            'fire_station' => 'required|exists:fire_stations,id',
            'district' => 'required|exists:districts,id',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'occassion' => 'required|string|max:1024',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = [
            'medal_category' => $request->category_id,
            'fire_station' => $request->fire_station,
            'districts' => $request->district,
            'year' => $request->year,
            'name' => $request->name,
            'designation' => $request->designation,
            'occassion' => $request->occassion
        ];

        $updateData = $this->commonModel->updateDataByOneCondition('medals', ['id'=>$id], $data);
        if($updateData){
            return redirect()->route('admin.achivements.medal_winners')
                 ->with('success', 'Madel Winners updated successfully.');
        }else{
            return redirect()->route('admin.achivements.medal_winners')
                 ->with('error', 'Madel Winners not updated successfully.');
        }
    }

    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('medals', array('id'=>$id));
        return redirect()->route('admin.achivements.medal_winners')->with('success', 'Madel Winners deleted successfully.');
    }

    public function medalCategory(){
        $tbl = "medal_category";
        $data['medal_category'] = $this->commonModel->getData($tbl);
        return view('admin.CMS.Achivements.medal_category.index', $data);
    }

    public function addMedalCategory(){
        return view('admin.CMS.Achivements.medal_category.add');
    }

    public function saveMedalCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'category_name' => $request->category_name,
        ];

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('medal_category_images'), $imageName);
            $data['image'] = 'medal_category_images/' . $imageName;
        }

        $insertData = $this->commonModel->insertData('medal_category', $data);
        if($insertData){
            return redirect()->route('admin.achivements.medal_category')
                 ->with('success', 'Medal Category added successfully.');
        }else{
            return redirect()->route('admin.achivements.medal_category')
                 ->with('error', 'Medal Category not added successfully.');
        }
    }

    public function editMedalCategory($id){
        $tbl = "medal_category";
        $data['medal_category'] = $this->commonModel->getDataByOneCondition($tbl, ['id'=>$id]);
        // echo "<pre>";print_r($data); die;
        return view('admin.CMS.Achivements.medal_category.edit',$data);
    }

    public function updateMedalCategory(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [
            'category_name' => $request->category_name,
        ];

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('medal_category_images'), $imageName);
            $data['image'] = 'medal_category_images/' . $imageName;
        }

        $updateData = $this->commonModel->updateDataByOneCondition('medal_category', ['id'=>$id], $data);
        if($updateData){
            return redirect()->route('admin.achivements.medal_category')
                    ->with('success', 'Medal Category updated successfully.');
        }else{
            return redirect()->route('admin.achivements.medal_category')
                    ->with('error', 'Medal Category not updated successfully.');
        }
    }

    public function destroyMedalCategory($id){
        $this->commonModel->deleteDataByOneCondition('medal_category', array('id'=>$id));
        return redirect()->route('admin.achivements.medal_category')->with('success', 'Medal Category deleted successfully.');
    }   


}

<?php

namespace App\Http\Controllers\Admin\CMS\Activities;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;

class GalaryController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function index(){
        $tbl = "gallery";
        $data['history'] = $this->commonModel->getData($tbl);
        return view('admin.CMS.Activities.gallery.index',$data);
    }

    public function add(){
        $tbl = "medal_category";
        $data['categories'] = $this->commonModel->getData($tbl);
        return view('admin.CMS.Activities.gallery.add',$data);
    }
    public function Save(Request $request){
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048,required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $card_image = $request->file('image');
        $card_image_name = time().'.'.$card_image->getClientOriginalExtension();
        $card_image->move(public_path('admin/activities/galary'), $card_image_name);
        $data = [
            'category' => $request->category_id,
            'image' => $card_image_name
        ];
        $this->commonModel->insertData('gallery',$data);
        return redirect()->route('admin.activities.galary')->with('success', 'galary added successfully.');
    }

    public function edit($id)
    {
        $tbl = "medal_category";
        $data['categories'] = $this->commonModel->getData($tbl);

        $data['gallery'] = $this->commonModel->getSingleData('gallery', ['id' => $id]);

        return view('admin.CMS.Activities.gallery.edit', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $gallery = $this->commonModel->getSingleData('gallery', ['id' => $id]);

        $imageName = $gallery->image;

        // If new image uploaded
        if ($request->hasFile('image')) {

            // Delete old image
            if (file_exists(public_path('admin/activities/galary/' . $gallery->image))) {
                unlink(public_path('admin/activities/galary/' . $gallery->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('admin/activities/galary'), $imageName);
        }

        $data = [
            'category' => $request->category_id,
            'image' => $imageName
        ];

        $this->commonModel->updateData('gallery', ['id' => $id], $data);

        return redirect()->route('admin.activities.galary')
            ->with('success', 'Gallery updated successfully.');
    }

    public function destroy($id){
        $this->commonModel->deleteDataByOneCondition('gallery', array('id'=>$id));
        return redirect()->route('admin.activities.galary')->with('success', 'galary deleted successfully.');
    }

}

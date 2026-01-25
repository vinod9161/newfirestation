<?php

namespace App\Http\Controllers\Admin\CMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Common\CommonModel;
use App\Models\ContactModel;
use Illuminate\Support\Facades\Validator;


class ContactController extends Controller
{
    protected $commonModel;
    public function __construct(){
        $this->commonModel = new CommonModel;
    }

    public function contactinfo(){
        $data['contact'] = ContactModel::first(); 
        // echo "<pre>"; print_r($data);die;
        return view('admin.CMS.contact.contact',$data);
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'map' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        
        $validated = $validator->validated();
        try {
            ContactModel::create($validated);
            return redirect()->back()->with('success', 'Contact information submitted successfully!');
        } catch (QueryException $e) {
            \Log::error('Database Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an error saving the contact information. Please try again.');
        }
    }





    public function update(Request $request, $id){
        $contact = ContactModel::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'map' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $contact->update($validator->validated());
        return redirect()->back()->with('success', 'Contact information updated successfully!');
    }

}
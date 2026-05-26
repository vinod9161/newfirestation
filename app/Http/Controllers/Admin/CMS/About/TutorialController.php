<?php

namespace App\Http\Controllers\Admin\CMS\About;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TutorialController extends Controller
{
    public function actionTutorial()
    {
        $tbl = "pages_card";

        $where = [
            'page_name' => 'tutorial'
        ];

        $tutorials = DB::table($tbl)
            ->where($where)
            ->orderBy('id', 'DESC')
            ->get();

        return view(
            'fire.tutorial',
            compact('tutorials')
        );
    }



    public function tutorialIndex()
    {
        $tbl = "pages_card";

        $where = [
            'page_name' => 'tutorial'
        ];

        $data['tutorials'] = DB::table($tbl)
            ->where($where)
            ->orderBy('id', 'DESC')
            ->get();

        return view(
            'admin.CMS.About.tutorial.index',
            $data
        );
    }



    public function addTutorial()
    {
        return view('admin.CMS.About.tutorial.add');
    }



    public function saveTutorial(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'youtube_url' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $youtubeUrl = $request->youtube_url;

        parse_str(parse_url($youtubeUrl, PHP_URL_QUERY), $query);

        $videoId = $query['v'] ?? '';

        $embedUrl = 'https://www.youtube.com/embed/'.$videoId;

        $data = [
            'page_name' => 'tutorial',
            'hadding' => $request->hadding,
            'content' => $embedUrl,
            'image' => '',
            'image1' => '',
            'status' => 'Active',
            'create_by' => '',
        ];

        DB::table('pages_card')->insert($data);

        return redirect()
            ->route('admin.about.tutorial')
            ->with('success', 'Tutorial added successfully.');
    }



    public function editTutorial($id)
    {
        $data['tutorial'] = DB::table('pages_card')
            ->where('id', $id)
            ->first();

        return view(
            'admin.CMS.About.tutorial.edit',
            $data
        );
    }



    public function updateTutorial(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hadding' => 'required',
            'youtube_url' => 'required',
        ]);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $youtubeUrl = $request->youtube_url;

        parse_str(parse_url($youtubeUrl, PHP_URL_QUERY), $query);

        $videoId = $query['v'] ?? '';

        $embedUrl = 'https://www.youtube.com/embed/'.$videoId;

        $data = [
            'hadding' => $request->hadding,
            'content' => $embedUrl,
        ];
        $data['image'] = '';
        $data['image1'] = '';

        DB::table('pages_card')
            ->where('id', $id)
            ->update($data);

        return redirect()
            ->route('admin.about.tutorial')
            ->with('success', 'Tutorial updated successfully.');
    }



    public function destroyTutorial($id)
    {
        DB::table('pages_card')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.about.tutorial')
            ->with('success', 'Tutorial deleted successfully.');
    }
}
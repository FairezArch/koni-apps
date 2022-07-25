<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\MediaModel;

class SettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = Setting::first();
        return view('backend.pages.settings.index-setting', compact('lists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, MediaModel $mediaModel)
    {
        //
        $folder = 'setting_general';
        $section = 'insert';
        $up = Setting::find(1);
        $filename = $up->file_koni;
        ($request->hasFile('file_koni')) ? $filename = $mediaModel->AddMedia($request->file_koni,$folder,$section) : $filename;
        $up->update([
            'address' => $request->address,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'file_koni' => $filename,
            'instagram' => $request->instagram,
            'facebook' => $request->facebook,
            'youtube' => $request->youtube,
            'twitter' => $request->twitter
        ]);

        return redirect()->route('settings.index')
        ->with('success','Setting successfully');
    }
}

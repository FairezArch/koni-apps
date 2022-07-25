<?php

namespace App\Http\Controllers;

use App\Models\SettingLandingPage;
use Illuminate\Http\Request;

class SettingLandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = SettingLandingPage::first();
        $listsUser = SettingLandingPage::ListsUser();
        return view('backend.pages.settingLandingPage.index-setLandingPage', compact('lists','listsUser'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $up = SettingLandingPage::find(1);
        $up->update([
            'about_koni' => $request->about_koni,
            'profile_koni' => $request->koni_profile,
            'data_users' => (!empty(json_decode($request->info_person))) ? $request->info_person : null
        ]);

        if($up){
            $data = [
                'success' => true,
                'messages' => "Setting successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Setting unsuccessfully"
            ];

        }

        return response()->json($data);
    }

}

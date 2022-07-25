<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SettingLandingPage;
use App\Models\User;
class FrontProfilesController extends Controller
{
    //

    public function index()
    {
        # code...
        $lists = SettingLandingPage::first();
        return view('frontend.pages.profiles.profile', compact('lists'));
    }
}

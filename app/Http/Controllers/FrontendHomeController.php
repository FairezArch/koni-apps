<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\SettingLandingPage;
use App\Models\CalendarActivitie;

class FrontendHomeController extends Controller
{
    //
    public function index()
    {
        # code...
        $topNewsSlider = null;
        
        $topNews = News::where('type_news',1)->orderBy('id','DESC')->first();
        if(!empty($topNews)){
            $topNewsSlider = News::where('type_news',1)->where('id','!=',$topNews->id)->orderBy('id','DESC')->get();
        }
        $landingPage = SettingLandingPage::first()->about_koni;
        $events = CalendarActivitie::FrontEndActivitie();
        return view('frontend.pages.home.home', compact('topNews','topNewsSlider','landingPage','events'));
    }
}

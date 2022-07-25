<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sport;

class FrontSportsController extends Controller
{
    //

    public function index()
    {
        # code...
        $lists = Sport::IndexPage();
        return view('frontend.pages.sports.sports', compact('lists'));
    }

    public function detail($slug)
    {
        # code...
        $lists = Sport::SearchFirst($slug);
        return view('frontend.pages.sports.sportsDetail', compact('lists'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\News;
use App\Models\Atlet;
use App\Models\Judge;
use App\Models\Sport;
use App\Models\Referee;
use App\Models\Trainner;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\CalendarActivitie;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        # code...
        $atlet = Atlet::count();
        $trainer = Trainner::count();
        $referee = Referee::count();
        $judge = Judge::count();
        $sport = Sport::count();
        $club = Club::count();
        $news = News::where('type_news',1)->count();
        $atletVerify = Atlet::where('verify_atlet',1)->count();
        
        $calendars =  CalendarActivitie::IndexPageMatch();
        $periods = range(Carbon::now()->format('Y') - 5,Carbon::now()->format('Y'));
                
        return view('backend.pages.dashboard.dashboard', compact('atlet','trainer','referee','judge','sport','club','news','atletVerify','calendars','periods'));
    }
}

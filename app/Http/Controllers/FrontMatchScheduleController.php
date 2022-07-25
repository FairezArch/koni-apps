<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\CalendarActivitie;
use App\Models\MediaModel;

class FrontMatchScheduleController extends Controller
{
    //
    public function attrFormat($someFirst, $someSecond)
    {
        return $someFirst . '|###|' . $someSecond;
    }

    public function index(Request $request)
    {
        # code...
        $sports = Sport::all();
        if ($request->ajax()) {
            $data = CalendarActivitie::MenuActivitie($request->sports_id, $request->show_list, $request->year_list);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('match_names', function ($row) {
                    if(!empty($row->file_event)){
                        // $link = '<a href="'.route("match-schedule.download",$row->file_event).'" target="_blank">Lihat Jadwal</a>';
                        $link = "<small><div onclick='documentLink(this)' data-image='".$row->file_event."' class='text-primary'>Lihat Jadwal</div></small>";
                        // dd($link);
                    }else{
                        $link = '';
                    }
                    return $this->attrFormat($row->match_name, $link); 
                })
                ->addColumn('date', function ($row) {
                    return $this->attrFormat(Carbon::parse($row->date_from)->translatedFormat('d/m/Y').' '.$row->datetime_from, Carbon::parse($row->date_to)->translatedFormat('d/m/Y').' '.$row->datetime_to);
                })
                ->addColumn('sports_branch', function ($row) {
                    return $row->sports->sportbranch_name;
                })
                ->addColumn('match_place', function ($row) {
                    return '<a href="'.$row->address.'" target="_blank">Maps</a>';
                })
                ->rawColumns(['match_names','date','sports_branch','match_place'])
                ->make(true);
        }
        return view('frontend.pages.match-schedule.match-schedule', compact('sports'));
    }
    
    public function download($filename)
    {
        #code...
        $media = new MediaModel();
        $folder = storage_path().'/app/public/event';
        
        return $media->Download($folder, $filename);
    }
}

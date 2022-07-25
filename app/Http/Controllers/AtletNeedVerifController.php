<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Atlet;
use App\Models\Nomor;
use App\Models\Sport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Yajra\DataTables\DataTables;
use App\Models\HistoryVerifyAtlet;


class AtletNeedVerifController extends Controller
{
    //
    public function attrFormat($someFirst, $someSecond)
    {
        return $someFirst . '|###|' . $someSecond;
    }

    public function index(Request $request, Atlet $atlet)
    {
        # code...
        if ($request->ajax()) {
            $data = Atlet::IndexAtletNeedVerif();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $dateNow = Carbon::now();
                    $date_born = Carbon::parse($row->users->date_of_birth);
                    $age = $date_born->diffInYears($dateNow);

                    return $this->attrFormat($row->users->name, $age . ' Tahun');
                })
                ->addColumn('cabor', function ($row) {
                    return $row->sports->sportbranch_name;
                })
                ->addColumn('trainingplace', function ($row) {
                    return $row->training_place;
                })
                ->addColumn('internasional', function ($row) {
                    return $row->id;
                })
                ->addColumn('nasional', function ($row) {
                    return $row->id;
                })
                ->addColumn('daerah', function ($row) {
                    return $row->id;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['name', 'cabor', 'trainingplace', 'internasional', 'nasional', 'daerah', 'action'])
                ->make(true);
        }
        return view('backend.pages.atletNeedVerify.index-atlet');
    }

    public function edit($id)
    {
        # code...
        $lists = Atlet::with('users')->find($id);
        $sports = Sport::all();
        $clubs = Club::all();
        $nomors = Nomor::all();

        return view('backend.pages.atletNeedVerify.edit-atlet', compact('sports', 'clubs', 'nomors', 'lists'));
    }

    public function update(Request $request, $id)
    {
        # code...
        $atlet = new Atlet();
        $arr = array();
        $i = 0;

        $arr[$i]['section'] = $request->section_one;
        $arr[$i]['message'] = $atlet->MessageInfo($request->section_one);
        $i++;

        $arr[$i]['section'] = $request->section_two;
        $arr[$i]['message'] = $atlet->MessageInfo($request->section_two);
        $i++;

        $arr[$i]['section'] = $request->section_there;
        $arr[$i]['message'] = $atlet->MessageInfo($request->section_there);
        $i++;

        $arr[$i]['section'] = $request->section_four;
        $arr[$i]['message'] = $atlet->MessageInfo($request->section_there);
        $i++;

        $to_encode = json_encode($arr);

        if ($request->status_verif > 0) {
            $up = Atlet::find($id);
            $up->update(['verify_atlet' => $request->status_verif]);
        }

        $save = HistoryVerifyAtlet::create([
            'list_result' => $to_encode,
            'atlets_id' => $id,
            'conclusion_status' => $request->status_verif
        ]);

        if ($save) {
            $data = [
                'success' => true,
                'messages' => "Atlet updated status successfully"
            ];
        } else {
            $data = [
                'success' => false,
                'messages' => "Atlet updated status unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}

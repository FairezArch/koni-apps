<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\SettingJudgeRefereeLicence;
use App\Http\Requests\StoreSettingJugdeRefereeLicenceRequest;
use App\Http\Requests\UpdateSettingJugdeRefereeLicenceRequest;

class SettingJugdeRefereeLicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // return dd($data);
        if ($request->ajax()) {
            $data = SettingJudgeRefereeLicence::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('licence_name', function ($row) {
                    return $row->licence_name;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['licence_name', 'action'])
                ->make(true);
        }

        return view('backend.pages.settingJugdeReferee.index-jugdeReferee');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.settingJugdeReferee.licence.add-licence');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingJugdeRefereeLicenceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingJugdeRefereeLicenceRequest $request)
    {
        //
        $save = SettingJudgeRefereeLicence::create([
            'licence_name' => $request->licence_name,
        ]);

        if($save){
            $data = [
                'success' => true,
                'messages' => "Licence created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Licence created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingJugdeRefereeLicence  $settingJugdeRefereeLicence
     * @return \Illuminate\Http\Response
     */
    public function show(SettingJudgeRefereeLicence $settingJugdeRefereeLicence)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingJugdeRefereeLicence  $settingJugdeRefereeLicence
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists = SettingJudgeRefereeLicence::find($id);
        return view('backend.pages.settingJugdeReferee.licence.edit-licence', compact('lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingJugdeRefereeLicenceRequest  $request
     * @param  \App\Models\SettingJugdeRefereeLicence  $settingJugdeRefereeLicence
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingJugdeRefereeLicenceRequest $request, $id)
    {
        //
        $up = SettingJudgeRefereeLicence::find($id);
        $up->update([
            'licence_name' => $request->licence_name,
        ]);

        if($up){
            $data = [
                'success' => true,
                'messages' => "Licence created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Licence created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingJugdeRefereeLicence  $settingJugdeRefereeLicence
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = SettingJudgeRefereeLicence::find($id);
        $del->delete();

        if($del){
            $data = [
                'success' => true,
                'messages' => "Licence deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Licence deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}

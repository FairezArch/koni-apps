<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\SettingJudgeReferee;
use App\Http\Requests\StoreSettingJugdeRefereeRequest;
use App\Http\Requests\UpdateSettingJugdeRefereeRequest;

class SettingJugdeRefereeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $data = SettingJudgeReferee::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('certificate_name', function ($row) {
                    return $row->certificate_name;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['certificate_name', 'action'])
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
        return view('backend.pages.settingJugdeReferee.certificateProfession.add-certificateProfession');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSettingJugdeRefereeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSettingJugdeRefereeRequest $request)
    {
        //
        $save = SettingJudgeReferee::create([
            'certificate_name' => $request->certificate_name,
        ]);

        if($save){
            $data = [
                'success' => true,
                'messages' => "Certificate created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Certificate created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SettingJugdeReferee  $settingJugdeReferee
     * @return \Illuminate\Http\Response
     */
    public function show(SettingJudgeReferee $settingJugdeReferee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SettingJugdeReferee  $settingJugdeReferee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists = SettingJudgeReferee::find($id);
        return view('backend.pages.settingJugdeReferee.certificateProfession.edit-certificateProfession', compact('lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSettingJugdeRefereeRequest  $request
     * @param  \App\Models\SettingJugdeReferee  $settingJugdeReferee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingJugdeRefereeRequest $request, $id)
    {
        //
        $up = SettingJudgeReferee::find($id);
        $up->update([
            'certificate_name' => $request->certificate_name,
        ]);
    
        if($up){
            $data = [
                'success' => true,
                'messages' => "Certificate updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Certificate updated unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingJugdeReferee  $settingJugdeReferee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = SettingJudgeReferee::find($id);
        $del->delete();
    
        if($del){
            $data = [
                'success' => true,
                'messages' => "Certificate deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Certificate deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}

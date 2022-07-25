<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SupportTrainner;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreSupportTrainnerRequest;
use App\Http\Requests\UpdateSupportTrainnerRequest;

class SupportTrainnerController extends Controller
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
            $data = SupportTrainner::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('support_name', function ($row) {
                    return $row->support_name;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['support_name','action'])
                ->make(true);
        }
        return view('backend.pages.settingTrainner.index-settingTrainner');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.settingTrainner.trainnerSupport.add-trainnerSupport');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSupportTrainnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupportTrainnerRequest $request)
    {
        //
        $save = SupportTrainner::create([
            'support_name' => $request->support_name
        ]);


        if($save){
            $data = [
                'success' => true,
                'messages' => "Support created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Support created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupportTrainner  $supportTrainner
     * @return \Illuminate\Http\Response
     */
    public function show(SupportTrainner $supportTrainner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupportTrainner  $supportTrainner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists = SupportTrainner::find($id);
        return view('backend.pages.settingTrainner.trainnerSupport.edit-trainnerSupport', compact('lists'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSupportTrainnerRequest  $request
     * @param  \App\Models\SupportTrainner  $supportTrainner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupportTrainnerRequest $request, $id)
    {
        //
        $up = SupportTrainner::find($id);
        $up->update([
            'support_name' => $request->support_name
        ]);

        if($up){
            $data = [
                'success' => true,
                'messages' => "Support updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Support updated unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupportTrainner  $supportTrainner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = SupportTrainner::find($id);
        $del->delete();

        if($del){
            $data = [
                'success' => true,
                'messages' => "Support deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Support deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}

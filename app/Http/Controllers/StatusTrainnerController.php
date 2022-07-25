<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusTrainner;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreStatusTrainnerRequest;
use App\Http\Requests\UpdateStatusTrainnerRequest;

class StatusTrainnerController extends Controller
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
            $data = StatusTrainner::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_trainner', function ($row) {
                    return $row->status_trainner;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['status_trainner','action'])
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
        return view('backend.pages.settingTrainner.statusTrainner.add-statusTrainner');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStatusTrainnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStatusTrainnerRequest $request)
    {
        //
        $save = StatusTrainner::create([
            'status_trainner' => $request->status_trainner
        ]);

        if($save){
            $data = [
                'success' => true,
                'messages' => "Status trainner created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Status trainner created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StatusTrainner  $statusTrainner
     * @return \Illuminate\Http\Response
     */
    public function show(StatusTrainner $statusTrainner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StatusTrainner  $statusTrainner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists = StatusTrainner::find($id);
        return view('backend.pages.settingTrainner.statusTrainner.edit-statusTrainner', compact('lists'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStatusTrainnerRequest  $request
     * @param  \App\Models\StatusTrainner  $statusTrainner
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStatusTrainnerRequest $request, $id)
    {
        //
        $up = StatusTrainner::find($id);
        $up->update([
            'status_trainner' => $request->status_trainner
        ]);

        if($up){
            $data = [
                'success' => true,
                'messages' => "Status trainner updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Status trainner updated unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StatusTrainner  $statusTrainner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = StatusTrainner::find($id);
        $del->delete();

        if($del){
            $data = [
                'success' => true,
                'messages' => "Status trainner deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Status trainner deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}

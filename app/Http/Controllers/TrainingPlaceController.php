<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingPlace;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreTrainingPlaceRequest;
use App\Http\Requests\UpdateTrainingPlaceRequest;

class TrainingPlaceController extends Controller
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
            $data = TrainingPlace::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('place_name', function ($row) {
                    return $row->place_name;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['place_name', 'action'])
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
        return view('backend.pages.settingTrainner.trainningPlace.add-trainingPlace');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTrainingPlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainingPlaceRequest $request)
    {
        //
        $folder = 'setting_training_place';
        $section = 'insert';
        $save = TrainingPlace::create([
            'place_name' => $request->place_name,
            // 'file_training' => $media->AddMedia($request->file_training, $folder, $section)
        ]);

        if($save){
            $data = [
                'success' => true,
                'messages' => "Training Place created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Training Place created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TrainingPlace  $trainingPlace
     * @return \Illuminate\Http\Response
     */
    public function show(TrainingPlace $trainingPlace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TrainingPlace  $trainingPlace
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists = TrainingPlace::find($id);
        return view('backend.pages.settingTrainner.trainningPlace.edit-trainingPlace', compact('lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTrainingPlaceRequest  $request
     * @param  \App\Models\TrainingPlace  $trainingPlace
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTrainingPlaceRequest $request, $id)
    {
        //
        $folder = 'setting_training_place';
        $section = 'update';
        $update = TrainingPlace::find($id);
        // $filename = $update->file_training;
        // ($request->hasFile('file_training')) ? $filename = $media->AddMedia($request->file_training, $folder, $section) : $filename;
        $update->update([
            'place_name' => $request->place_name,
            // 'file_training' => $filename
        ]);

        if($update){
            $data = [
                'success' => true,
                'messages' => "Training Place updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Training Place updated unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TrainingPlace  $trainingPlace
     * @return \Illuminate\Http\Response
     */
    public function destroy(TrainingPlace $trainingPlace, $id)
    {
        //
        $delete = $trainingPlace::find($id);
        $delete->delete();
        if($delete){
            $data = [
                'success' => true,
                'messages' => "Training Place deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Training Place deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}

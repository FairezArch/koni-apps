<?php

namespace App\Http\Controllers;

use App\Models\Employ;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreEmployRequest;
use App\Http\Requests\UpdateEmployRequest;

class EmployController extends Controller
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
            $data = Employ::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return $row->name_employ;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['name','action'])
                ->make(true);
        }

        return view('backend.pages.employ.index-employ');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.employ.add-employ');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployRequest $request)
    {
        //
        $save = Employ::create([
            'name_employ' => $request->name_employ
        ]);

        if($save){
            $data = [
                'success' => true,
                'messages' => "Employ created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Employ created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function show(Employ $employ)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists= Employ::find($id);
        return view('backend.pages.employ.edit-employ', compact('lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployRequest  $request
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployRequest $request, $id)
    {
        //

        $update = Employ::find($id);
        $update->update(['name_employ'=> $request->name_employ]);

        if($update){
            $data = [
                'success' => true,
                'messages' => "Employ updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Employ updated unsuccessfully"
            ];

        }

        return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employ  $employ
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = Employ::find($id);
        $del->delete();

        if($del){
            $data = [
                'success' => true,
                'messages' => "Employ deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Employ deleted unsuccessfully"
            ];

        }

        return response()->json($data);
    }
}

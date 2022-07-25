<?php

namespace App\Http\Controllers;

use App\Models\Nomor;
use App\Models\Sport;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Requests\StoreNomorRequest;
use App\Http\Requests\UpdateNomorRequest;
use App\Repository\Nomor\EloquentRepository;

class NomorController extends Controller
{
    protected $nomor;
    protected $sport;

    public function __construct(EloquentRepository $repository)
    {
        # code...
        $this->nomor = $repository;
        $this->sport = 'sports_id';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Sport $sport_branch)
    {
        //
        if ($request->ajax()) {
            $data = Nomor::where($this->sport, $sport_branch->id)->with(['atlets', 'trainers']);
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('nomor', function ($row) {
                    return $row->nomor_code;
                })
                ->addColumn('sum_atlet', function ($row) {
                    return $row->atlets->count().' Atlet';
                })
                ->addColumn('sum_trannier', function ($row) {
                    return $row->trainers->count().' Pelatih';
                })
                ->addColumn('status', function ($row) {
                    return ($row->status == 1) ? "Aktif" : "Tidak Aktif";
                })
                ->addColumn('action', function ($row) {
                    return $row->id.','.$row->sports_id;
                })
                ->rawColumns(['nomor','sum_atlet','sum_trannier','status','action'])
                ->make(true);
        }

        return view('backend.pages.sportBranch.nomor.index-nomor', compact('sport_branch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Sport $sport_branch)
    {
        //
        return view('backend.pages.sportBranch.nomor.add-nomor', compact('sport_branch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreNomorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNomorRequest $request, Sport $sport_branch)
    {
        //
        $save = $this->nomor->storeData($request, [$this->sport => $sport_branch->id]);

        if($save){
            $data = [
                'success' => true,
                'messages' => "Nomor created successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Nomor created unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Nomor  $nomor
     * @return \Illuminate\Http\Response
     */
    public function show(Nomor $nomor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Nomor  $nomor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sport $sport_branch, Nomor $nomor)
    {
        //
        $lists = $nomor;
        return view('backend.pages.sportBranch.nomor.edit-nomor', compact('sport_branch','lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateNomorRequest  $request
     * @param  \App\Models\Nomor  $nomor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNomorRequest $request, Sport $sport_branch, Nomor $nomor)
    {
        //
        $update = $this->nomor->updateData($request, [$this->sport => $sport_branch->id], $nomor);

        if($update){
            $data = [
                'success' => true,
                'messages' => "Nomor updated successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Nomor updated unsuccessfully"
            ];

        }

        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Nomor  $nomor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sport $sport_branch, Nomor $nomor)
    {
        //
        $del = $this->nomor->deleteData($nomor);

        if($del){
            $data = [
                'success' => true,
                'messages' => "Nomor deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Nomor deleted unsuccessfully"
            ];
        }

        return response()->json($data);
    }
}

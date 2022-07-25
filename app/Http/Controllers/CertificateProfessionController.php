<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\CertificateProfession;
use App\Http\Requests\StoreCertificateProfessionRequest;
use App\Http\Requests\UpdateCertificateProfessionRequest;


class CertificateProfessionController extends Controller
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
            $data = CertificateProfession::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('certificate_name', function ($row) {
                    return $row->certificate_name;
                })
                ->addColumn('action', function ($row) {
                    return $row->id;
                })
                ->rawColumns(['certificate_name','action'])
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
        return view('backend.pages.settingTrainner.certificateProfession.add-certificateProfession');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCertificateProfessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCertificateProfessionRequest $request)
    {
        //
        $save = CertificateProfession::create([
            'certificate_name' => $request->certificate_name
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
     * @param  \App\Models\CertificateProfession  $certificateProfession
     * @return \Illuminate\Http\Response
     */
    public function show(CertificateProfession $certificateProfession)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CertificateProfession  $certificateProfession
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $lists = CertificateProfession::find($id);
        return view('backend.pages.settingTrainner.certificateProfession.edit-certificateProfession', compact('lists'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCertificateProfessionRequest  $request
     * @param  \App\Models\CertificateProfession  $certificateProfession
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCertificateProfessionRequest $request, $id)
    {
        //
        $up = CertificateProfession::find($id);
        $up->update([
            'certificate_name' => $request->certificate_name
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
     * @param  \App\Models\CertificateProfession  $certificateProfession
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $del = CertificateProfession::find($id);
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

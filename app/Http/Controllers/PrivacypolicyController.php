<?php

namespace App\Http\Controllers;

use App\Models\Privacypolicy;
use Illuminate\Http\Request;

class PrivacypolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lists = Privacypolicy::first();
        return view('backend.pages.privacyPolicy.index-privacyPolicy', compact('lists'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $up = Privacypolicy::find(1);
        $up->update([
            'privacy' => $request->privacy,
            'policy' => $request->policy,
        ]);

        return redirect()->route('set-privacy-policy.index')
            ->with('success', 'Setting Privacy Policy successfully');
    }

    public function listData()
    {
        # code...
        $lists =  Privacypolicy::find(1);

        return view('frontend.pages.privacypolicy.privacypolicy', compact('lists'));
    }
}

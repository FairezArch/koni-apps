<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Gallery;
use Illuminate\Http\Request;

class FrontGalleryController extends Controller
{
    //
    public function index()
    {
        # code...
        $lists = Gallery::where('status',1)->get();
        // $file_sports = Gallery::with('sport')->take(4)->get();
        // $lists = Gallery::where('info_upload', !=, 'cabor')->get();
        // $file_sports = Gallery::where('info_upload', 'cabor')->take(8)->get();
        $file_sports = Sport::whereHas('gallery')->with('gallery')->get()->map(function ($sport){
            if($sport->gallery){
                return [
                    'id' => $sport->id,
                    'name' => $sport->sportbranch_name,
                    'files' => $sport->gallery->sortByDesc('id')->take(4)
                ];
            }
        });
        
        return view('frontend.pages.gallery.gallery', compact('lists','file_sports'));
    }
}

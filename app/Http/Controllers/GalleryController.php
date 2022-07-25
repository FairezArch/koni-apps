<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class GalleryController extends Controller
{
    //

    public function index()
    {
        # code...
        // $lists = Gallery::where('users_id',Auth::user()->id)->get();
        $lists = Gallery::where('info_upload', Auth::user()->roles->first()->name)->get();

        return view('backend.pages.gallery.index-gallery', compact('lists'));
    }

    public function store(Request $request)
    {
        Gallery::StoreData($request);
        return response()->json(['success' => true, 'message' => 'add media success']);
    }

    public function destroy(Gallery $photo_gallery)
    {
        # code...

        $del = Gallery::DeleteData($photo_gallery);

        if($del){
            $data = [
                'success' => true,
                'messages' => "Gallery deleted successfully"
            ];
        }else{
            $data = [
                'success' => false,
                'messages' => "Gallery deleted successfully"
            ];
        }

        return response()->json($data);
    }
}
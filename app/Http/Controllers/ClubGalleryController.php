<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Repository\Gallery\EloquentGalleryRepository;

class ClubGalleryController extends Controller
{
    //
    protected $clubGallery;
    protected $fieldData;

    public function __construct(EloquentGalleryRepository $galleryRepo)
    {
        # code...
        $this->clubGallery = $galleryRepo;
        $this->fieldData = 'club_id';
    }

    public function index(Club $club)
    {
        # code...
        $club_id = $club->id;
        $lists = $this->clubGallery->indexData($this->fieldData, $club->id)->get();

        return view('backend.pages.club.subViews.gallery.index-gallery', compact('lists', 'club_id'));
    }

    public function store(Request $request, Club $club)
    {
         # code...
        $dataInput = [$this->fieldData => $club->id];
        $this->clubGallery->storeData($request, $club->id, $dataInput);
        return response()->json(['success' => true, 'message' => 'add media success']);
    }

    public function destroy(Club $club, Gallery $photo_gallery)
    {
        # code...
        $delete = $this->clubGallery->deleteData($photo_gallery);

        if($delete){
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

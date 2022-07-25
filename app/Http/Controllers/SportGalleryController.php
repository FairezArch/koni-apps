<?php

namespace App\Http\Controllers;

use App\Models\Sport;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Repository\Gallery\EloquentGalleryRepository;

class SportGalleryController extends Controller
{
    //
    protected $sportGallery;
    protected $fieldData;

    public function __construct(EloquentGalleryRepository $galleryRepo)
    {
        $this->sportGallery = $galleryRepo;
        $this->fieldData = 'sports_id';
    }

    public function index(Sport $sport_branch)
    {
        # code...
        $sport_id = $sport_branch->id;

        $lists = $this->sportGallery->indexData($this->fieldData, $sport_branch->id)->get();

        return view('backend.pages.sportBranch.subViews.gallery.index-gallery', compact('lists', 'sport_id'));
    }

    public function store(Request $request, Sport $sport_branch)
    {
        $dataInput = [$this->fieldData => $sport_branch->id];
        $this->sportGallery->storeData($request, $sport_branch->id, $dataInput);
        return response()->json(['success' => true, 'message' => 'add media success']);
    }

    public function destroy(Sport $sport_branch, Gallery $photo_gallery)
    {
        # code...

        $delete = $this->sportGallery->deleteData($photo_gallery);

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

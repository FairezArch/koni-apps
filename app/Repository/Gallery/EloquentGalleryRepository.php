<?php

namespace App\Repository\Gallery;

use App\Models\Gallery;
use App\Models\MediaModel;
use Illuminate\Support\Facades\Auth;
use App\Repository\Gallery\GalleryRepository;


class EloquentGalleryRepository implements GalleryRepository
{
    protected $model;
    protected $upload;
    protected $folder;
    protected $sectionInsert;
    protected $sectionUpdate;

    public function __construct(Gallery $gallery, MediaModel $media)
    {
        $this->model = $gallery;
        $this->upload = $media;
        $this->folder = 'gallery';
        $this->sectionInsert = 'insert';
        $this->sectionUpdate = 'update';
    }

    public function indexData($param, $set)
    {
        return $this->model->where($param, $set);
    }

    public function storeData($request, $sport_id, $extraData)
    {
        $userId = Auth::user()->id;

        $setName = str_replace(' ', '_', pathinfo($request->file->getClientOriginalName(), PATHINFO_FILENAME));
        $filename = $this->upload->addMedia($request->file, $this->folder, $this->sectionInsert);

        $thumb_image = $this->upload->compressMedia($request->file, $this->folder);

        $dataInput = [
            'title' => $setName,
            'filename' => $filename,
            'folder' => $this->folder,
            'users_id' => $userId,
            'thumb_image' => $thumb_image,
            'info_upload' => Auth::user()->roles->first()->name,
            'status' => (Auth::user()->id <= 3) ? 1 : 0
        ];

        return $this->model->create(array_merge($dataInput, $extraData));
    }

    public function deleteData($gallery)
    {
        if (!empty($gallery->filename)) {
            $this->upload->deleteMedia($this->folder, $gallery->filename);
        }

        if (!empty($gallery->thumb_image)) {
            $this->upload->deleteMedia($this->folder, $gallery->thumb_image);
        }

        return $gallery->delete();
    }
}

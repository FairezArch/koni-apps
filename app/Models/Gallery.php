<?php

namespace App\Models;

use App\Models\MediaModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function sport()
    {
        # code...
        $this->belongsTo(Sport::class)->withDefault();
    }

    public function scopeStoreData(Builder $query, $request)
    {
        # code...
        $media = new MediaModel();

        // $folder = 'gallery_'.Auth::user()->id;
        $folder = 'gallery';
        $section = 'insert';
        $userId = Auth::user()->id;

        $setName = str_replace(' ','_',pathinfo($request->file->getClientOriginalName(),PATHINFO_FILENAME));
        $filename = $media->addMedia($request->file, $folder, $section);
        
        $thumb_image = $media->compressMedia($request->file, $folder);

        return $query->create([
            'title' => $setName,
            'filename' => $filename,
            'folder' => $folder,
            'users_id' => $userId,
            'thumb_image' => $thumb_image,
            'info_upload' => Auth::user()->roles->first()->name,
            'status' => (Auth::user()->id <= 3) ? 1 : 0
        ]);
    }

    public function scopeDeleteData(Builder $query, $galleries)
    {
        # code...
        $media = new MediaModel();
        // $folder = 'gallery_'.Auth::user()->id;
        $folder = 'gallery';

        if (!empty($galleries->filename)) {
            $media->deleteMedia($folder, $galleries->filename);
        }

        if(!empty($galleries->thumb_image)) {
            $media->deleteMedia($folder, $galleries->thumb_image);
        }

        return $galleries->delete();
    }
}

<?php

namespace App\Models;

use Illuminate\Http\File;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class MediaModel extends Model
{
    use HasFactory;

    public function AddMedia($file, $folder, $hasRoute = 'insert', $oldFile = null)
    {
        # code...
        if ($hasRoute == 'insert') {
            $path = Storage::disk('public')->put($folder, $file);
        } else {
            if (!empty($oldFile)) {
                Storage::disk('public')->delete($folder . '/' . $oldFile);
            }
            $path = Storage::disk('public')->put($folder, $file);
        }

        return basename($path);
    }

    public function deleteMedia($folder, $file)
    {
        # code...
        return Storage::disk('public')->delete($folder . '/' . $file);
    }

    public function compressMedia($file, $folder)
    {
        # code...
        $file = Image::make($file)
            ->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg', 40);

        $hashfile = time() . md5($file->__toString()) . time();
        $path = $folder . '/' . $hashfile . '.jpg';
        $file->save(storage_path("app/public/".$path));
        // $file->save(public_path('storage/' . $path));
        // $url = '/' . $path;
        // Storage::put('public/' . $path, $file->__toString());
    
        return $hashfile . '.jpg';
    }

    public function Download($folder, $file)
    {
        # code...
        return response()->download($folder.'/'.$file);
    }
}

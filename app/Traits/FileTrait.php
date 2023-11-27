<?php

namespace App\Traits;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Files;

trait FileTrait{
    private function uploadFile($file, $imageFor, $user){
        $filename = File::name($file->getClientOriginalName());
        $newName = $imageFor.sha1(microtime(true).File::name($file->getClientOriginalName()));
        $mime = $file->getMimeType();
        $extension = File::extension($file->getClientOriginalName());

        // File upload location
        $location = 'uploads'. '/' . $newName.'.'.$extension;
        $thumb_location = 'uploads'. '/200X200-' . $newName.'.'.$extension;

        $img = Image::make($file->getRealPath())
            ->resize(800, null, function ($constraint) {
            $constraint->aspectRatio();
            });

        $img->save(public_path($location));

        $thumbImg = Image::make($file->getRealPath())
            ->fit(200, 200);

        $thumbImg->save(public_path($thumb_location));

        // Insert record
        $insertData_arr = array(
            'name' => $filename,
            'mime_type' => $mime,
            'file_extension' => $extension,
            'created_by' => $user->id,
            'status'=> 1,
            'imagepath' => '/'.$location,
        );

        $file = Files::create($insertData_arr);
        return $file;
    }
}

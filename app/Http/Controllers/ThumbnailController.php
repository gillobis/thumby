<?php

namespace App\Http\Controllers;

use App\Models\Thumbnail;
use Illuminate\Http\Request;
use Image;
use Str;

class ThumbnailController extends Controller
{
    public function store(Request $request) {
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $path = 'app/thumbnails/'.Str::random(32).".".$request->image->extension();
        $fullpath = storage_path($path);

        $thumbnailImage = Image::make($request->image);
        $thumbnailImage->resize(300, 300, function ($constraint) {
            $constraint->aspectRatio();
        });
        $thumbnailImage->save($fullpath, 90);

        $thumbnail = Thumbnail::create([
            'filename' => $path
        ]);

        return response()->json(['url' => url('thumbnails/'.$thumbnail->id)]);
    }

    public function show(Thumbnail $thumbnail) {
        $thumbnail->touch();
        $file = storage_path($thumbnail->filename);

        return response()->file($file);
    }
}

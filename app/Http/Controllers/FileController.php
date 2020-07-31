<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function all()
    {
        return response(File::cursor(), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        /**
         * 使用前須先執行
         * php artisan storage:link
         */
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $validated = $request->validate([
                    'type' => 'regex:(patent)',
                    'name' => 'string|max:40',
                    'image' => 'mimes:jpeg,png|max:1024',
                ]);
                $extension = $request->image->extension();
                $filename = time()."_".$validated['name'].".".$extension;
                $request->image->storeAs('public', $request->type.'/'.$filename);
                $path = Storage::url($request->type.'/'.$filename);
                $file = File::create([
                    'name' => $validated['name'],
                    'path' => $path,
                ]);

                return response($file, Response::HTTP_OK);
            }
        }
        return response([], Response::HTTP_BAD_REQUEST);
    }
}

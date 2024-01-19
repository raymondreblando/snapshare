<?php

namespace App\Services;

use App\Services\ResizeImage;
use Illuminate\Http\Request;

class UploadService 
{
    public function upload(Request $request, string $id, string $type = null): array|null
    {
        $filenames = [];
        $files = $request->allFiles();

        if (empty($files)) {
            return null;
        }

        foreach ($files as $key => $file) {
            $uploadPath = 'public/' . $key . 's/';
            $resizeImagePath = storage_path('app/public/' . $key . 's/');
            $filename = $id . ".". $file->getClientOriginalExtension();

            if ($type === 'profile') {
                ResizeImage::resize($file, $resizeImagePath, $filename);
            } else {
                $file->storeAs($uploadPath, $filename, 'local');
                ResizeImage::resize($file, $resizeImagePath, $filename);
            }

            $filenames[] = $filename;
        }

        return $filenames;
    }

    public function delete(array $filenames, array $paths): void
    {
        foreach ($filenames as $key => $filename) {
            $path = 'public/' . $paths[$key] . '/' . $filename;
            Storage::delete($path);
        }
    }
}
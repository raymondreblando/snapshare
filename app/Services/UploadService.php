<?php

namespace App\Services;
use Illuminate\Http\Request;
use Spatie\Glide\GlideImage;

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
                GlideImage::create($file)->modify(['w' => 120])->save($resizeImagePath . $filename);
            } else {
                $file->storeAs($uploadPath, $filename, 'local');
                GlideImage::create($file)->modify(['w' => 40])->save($resizeImagePath . 'optimize-' . $filename);
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
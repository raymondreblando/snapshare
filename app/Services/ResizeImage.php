<?php

namespace App\Services;

use Gumlet\ImageResize;

class ResizeImage
{
    public static function resize(string $file, string $path, string $filename, int $size): void
    {
        $image = new ImageResize($file);
        $image->resizeToWidth($size);
        $image->save($path . $filename);
    }
}
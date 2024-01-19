<?php

namespace App\Services;

use Gumlet\ImageResize;

class ResizeImage
{
    public static function resize(string $file, string $path, string $filename): void
    {
        $image = new ImageResize($file);
        $image->resizeToWidth(20);
        $image->save($path . 'optimize-' . $filename);
    }
}
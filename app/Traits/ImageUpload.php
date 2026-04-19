<?php

namespace App\Traits;

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

trait ImageUpload
{
    public function uploadImage($file,$path)
    {
        $gd = new Driver();
        $manager = new ImageManager($gd);

        $name = uniqid().".webp";
        $image = $manager->read($file)->toWebp(90 /*Quality of Image*/);
        Storage::disk('public')->put("$path/$name", (string) $image);
        
        return $name;
    }
}

<?php

namespace App\Traits;

use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;

trait AvatarUpload
{
    public function uploadAvatar($file)
    {
        $gd = new Driver();
        $manager = new ImageManager($gd);

        $name = uniqid().".webp";
        $image = $manager->read($file)->toWebp(90 /*Quality of Image*/);
        Storage::disk('public')->put('images/avatars/'.$name, (string) $image);
        
        return $name;
    }
}

<?php

namespace Katsitu\Http\Controllers;

use Illuminate\Http\Request;

use Katsitu\Contracts\ImageHandler;
use Katsitu\Http\Requests;
use Katsitu\Http\Controllers\Controller;

class AssetController extends Controller
{
    //
    public function profileImage(ImageHandler $imageHandler, $profile_image)
    {
        return $imageHandler->make( storage_path('app/profile_images/' . $profile_image) )->response();
    }
}
